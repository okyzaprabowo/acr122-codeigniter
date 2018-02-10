from __future__ import print_function
from smartcard.scard import *
import smartcard.util
from smartcard.System import readers
from smartcard.util import toHexString
import MySQLdb
import requests
import urllib
import urllib2
import RPi.GPIO as GPIO
import time
import base64
import json
import string
from pprint import pprint
    
srTreeATR = \
    [0x3B, 0x77, 0x94, 0x00, 0x00, 0x82, 0x30, 0x00, 0x13, 0x6C, 0x9F, 0x22]
srTreeMask = \
    [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]

global respserver
global resp
global uid
global nik
global jsonhasil

GPIO.setmode(GPIO.BOARD)
GPIO.setup(13, GPIO.OUT)

def strip_control_characters(input):

    if input:

        import re

        # unicode invalid characters
        RE_XML_ILLEGAL = u'([\u0000-\u0008\u000b-\u000c\u000e-\u001f\ufffe-\uffff])' + \
                         u'|' + \
                         u'([%s-%s][^%s-%s])|([^%s-%s][%s-%s])|([%s-%s]$)|(^[%s-%s])' % \
                          (unichr(0xd800),unichr(0xdbff),unichr(0xdc00),unichr(0xdfff),
                           unichr(0xd800),unichr(0xdbff),unichr(0xdc00),unichr(0xdfff),
                           unichr(0xd800),unichr(0xdbff),unichr(0xdc00),unichr(0xdfff),
                           )
        input = re.sub(RE_XML_ILLEGAL, "", input)

        # ascii control characters
        input = re.sub(r"[\x01-\x1F\x7F]", "", input)

    return input

def printUID():
    hresult, hcontext = SCardEstablishContext(SCARD_SCOPE_USER)
    assert hresult==SCARD_S_SUCCESS
    hresult, readers = SCardListReaders(hcontext, [])
    assert len(readers)>0
    reader = readers[0]
    hresult, hcard, dwActiveProtocol = SCardConnect(
        hcontext,
        reader,
        SCARD_SHARE_SHARED,
        SCARD_PROTOCOL_T0 | SCARD_PROTOCOL_T1)

    SELECT_MF = [0x00, 0xA4, 0x00, 0x00, 0x02, 0x3F, 0x00]
    READ_CARD_CONFIG = [0x00, 0xCA, 0x08, 0x00, 0x29]
    SELECT_DF  = [0x00, 0xA4, 0x00, 0x00, 0x02 , 0x10, 0x01]
    SELECT_EF  = [0x00, 0xA4, 0x00, 0x00, 0x02 , 0x01, 0x01]
    READ_BIODATA = [0x00, 0xB0, 0x00, 0x00, 0x58]
    hresult, response1 = SCardTransmit(hcard,dwActiveProtocol,SELECT_MF)
    hresult, response2 = SCardTransmit(hcard,dwActiveProtocol,READ_CARD_CONFIG)
    hresult, response3 = SCardTransmit(hcard,dwActiveProtocol,SELECT_DF)
    hresult, response4 = SCardTransmit(hcard,dwActiveProtocol,SELECT_EF)
    hresult, response5 = SCardTransmit(hcard,dwActiveProtocol,READ_BIODATA)
    #print(response5)
    resp = ""

    #blok ambil data nik
    for item in response5:
        #print(chr(item))
        resp+= chr(item)

    newresp = str(resp)
    newresp = unicode(newresp, errors='ignore')
    nik = ""
    nik = newresp[-17:]
    nik = strip_control_characters(nik)

    #print(nik)
    #blok ambil uid
    uid = ""
    for item in response2:
        #print "%x" % (item)
        uid+= '{:02x}'.format(item)
    newuid = uid[0:16]

    
    #Blok capsul json
    data = {}
    data['uid'] = newuid
    data['nik'] = nik
    json_data = json.dumps(data)
    #print(json_data)
    
    golive = base64.b64encode(json_data)
    #print(golive)

    '''
    if (newuid == '1100090000000034'):
        GPIO.output(13,0)
    else:
        GPIO.output(13,1)
    '''
    
    #kirim data ke server
    params = urllib.urlencode({'data': golive})
    
    
    f = urllib.urlopen("http://192.168.137.99/Smart_Campus/index.php/access_control/uidgetter", params)
    respserver = f.read()

    print(respserver)

    
    jsonhasil = json.loads(respserver)
    #print(len(jsonhasil["status"]))

    if (jsonhasil["status"] == 0):
        GPIO.output(13,0)
        print(respserver)
        print('TUTUP')
    elif (jsonhasil["status"] == 1):
        GPIO.output(13,0)
        print(respserver)
        print('BUKA')
        time.sleep(5)
        GPIO.output(13,1)
    else:
        #print(respserver)
        print('ENTAH')

def get_perso():
    r=readers()
    connection = r[0].createConnection()
    connection.connect()
    SELECT_MF = [0x00, 0xA4, 0x00, 0x00, 0x02, 0x3F, 0x00]
    READ_CARD_CONFIG = [0x00, 0xCA, 0x08, 0x00, 0x29]
    SELECT_DF  = [0x00, 0xA4, 0x00, 0x00, 0x02 , 0x10, 0x01]
    SELECT_EF  = [0x00, 0xA4, 0x00, 0x00, 0x02 , 0x01, 0x01]
    READ_BIODATA = [0x00, 0xB0, 0x00, 0x00, 0x58]

    data, sw1, sw2 = connection.transmit(SELECT_MF)
    data, sw1, sw2 = connection.transmit(READ_CARD_CONFIG)
    data, sw1, sw2 = connection.transmit(SELECT_DF)
    data, sw1, sw2 = connection.transmit(SELECT_EF)
    data, sw1, sw2 = connection.transmit(READ_BIODATA)
    #print "%x %x" % (sw1, sw2)
    resp = ""

    for item in data:
        #print "%x" % (item)
        resp+= chr(item)

    newresp = str(resp) 
    print ("%s") % (resp)
    print ("Personal ID is %s") % (newresp[-16:])

def printstate(state):
    reader, eventstate, atr = state
    print(reader + " " + smartcard.util.toHexString(atr, smartcard.util.HEX))
    if eventstate & SCARD_STATE_ATRMATCH:
        print('\tCard found')
    if eventstate & SCARD_STATE_UNAWARE:
        print('\tState unware')
    if eventstate & SCARD_STATE_IGNORE:
        print('\tIgnore reader')
    if eventstate & SCARD_STATE_UNAVAILABLE:
        print('\tReader unavailable')
    if eventstate & SCARD_STATE_EMPTY:
        print('\tReader empty')
    if eventstate & SCARD_STATE_PRESENT:
        print('\tCard present in reader')
        printUID()
        #get_perso()
    if eventstate & SCARD_STATE_EXCLUSIVE:
        print('\tCard allocated for exclusive use by another application')
    if eventstate & SCARD_STATE_INUSE:
        print('\tCard in used by another application but can be shared')
    if eventstate & SCARD_STATE_MUTE:
        print('\tCard is mute')
    if eventstate & SCARD_STATE_CHANGED:
        print('\tState changed')
    if eventstate & SCARD_STATE_UNKNOWN:
        print('\tState unknowned')

while 1:
    try:
        hresult, hcontext = SCardEstablishContext(SCARD_SCOPE_USER)
        if hresult != SCARD_S_SUCCESS:
            raise error(
                'Failed to establish context: ' + \
                SCardGetErrorMessage(hresult))
        #print('Context established!')

        try:
            hresult, readers = SCardListReaders(hcontext, [])
            if hresult != SCARD_S_SUCCESS:
                raise error(
                    'Failed to list readers: ' + \
                    SCardGetErrorMessage(hresult))
            #print('PCSC Readers:', readers)

            readerstates = []
            for i in range(len(readers)):
                readerstates += [(readers[i], SCARD_STATE_UNAWARE)]

            #print('----- Current reader and card states are: -------')
            hresult, newstates = SCardGetStatusChange(hcontext, 0, readerstates)
            #for i in newstates:
                #printstate(i)

            #print('----- Please insert or remove a card ------------')
            hresult, newstates = SCardGetStatusChange(
                                    hcontext,
                                    INFINITE,
                                    newstates)

            #print('----- New reader and card states are: -----------')
            for i in newstates:
                printstate(i)

        finally:
            hresult = SCardReleaseContext(hcontext)
            if hresult != SCARD_S_SUCCESS:
                raise error(
                    'Failed to release context: ' + \
                    SCardGetErrorMessage(hresult))
            #print('Released context.')
    except error as e:
        print(e)
