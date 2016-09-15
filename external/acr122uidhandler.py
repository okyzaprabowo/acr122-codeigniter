from __future__ import print_function
from smartcard.scard import *
import smartcard.util
import MySQLdb
import requests
import urllib
import urllib2
import RPi.GPIO as GPIO
import time
    
srTreeATR = \
    [0x3B, 0x77, 0x94, 0x00, 0x00, 0x82, 0x30, 0x00, 0x13, 0x6C, 0x9F, 0x22]
srTreeMask = \
    [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]

def buka_pintu():
    GPIO.setmode(GPIO.BOARD)
    #GPIO.setup(25, GPIO.IN)
    GPIO.setup(13, GPIO.OUT)


    GPIO.output(13,1)
    time.sleep(10)
    GPIO.output(13,0)
    time.sleep(1)
        
    GPIO.cleanup()

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

    hresult, response = SCardTransmit(hcard,dwActiveProtocol,[0xFF,0xCA,0x00,0x00,0x00])
    uidformat = ':'.join(str(x) for x in response)
    a = str(uidformat)
    print(a)
    #kirim data ke server
    params = urllib.urlencode({'uid': a})
    #f = urllib.urlopen("http://indisbuilding.com/smartcampus/index.php/welcome/uidgetter", params)
    #print(f.read())
    
    
    '''
    cursor = db.cursor()
    query = "INSERT INTO tbl_log(uid) VALUES ('%s')" % a
    
    print (query)
    try:
        # Execute the SQL command
        cursor.execute(query)
        # Commit your changes in the database
        db.commit()
    except:
        # Rollback in case there is any error
        db.rollback()
    '''
    

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
