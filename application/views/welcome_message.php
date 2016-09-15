<html>
<head>
    <title>Menambahkan Data</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <h3>Tambah Data</h3>
   <form action="search">
      <input type="text" name="search" value="" size="50" onfocus="getuid(this)"/>
      <br>
      <input type="text" name="uid" value="" size="50"/>
      <div>
        <input type="submit" value="Submit" />
      </div>
    </form>
</body>
<script>
$(document).ready(function(){
	
	$("input[name=uid]").focusin(function(){
		var uidtext;
		$(this).css("background-color", "#FFFFFF");
    	setInterval(function(){
	    		$.get("http://localhost/access/welcome/getuid", function(data, response){
		        $("input[name=uid]").val(data);
	    		console.log(data);
		    });
    	}, 3000);
    	
    	
    });
    $("input[name=uid]").focusout(function(){
        //$(this).css("background-color", "#000000");
    });
});
</script>

</html>
