<html>

<body>
<?php
include("../PHPconnectionDB.php");
include("download.php");


session_start();

//data curator
if ($_SESSION['role'] != 'd') {
		header('Location: ../OOSLogin.php', true, 301);
		exit();	
}

?>
	<center><h4>Upload:</h4></center>
	<form name = "uimage" method="post"  action="uimage.php"> 
					<center><input type="submit" name="image" value="image"></center>
	</form>
	<form name = "uimage" method="post"  action="uaudio.php"> 
					<center><input type="submit" name="image" value="audio"></center>
	</form>
	<form name = "uimage" method="post"  action="uscalar.php"> 
					<center><input type="submit" name="image" value="scalar"></center>
	</form>


</body>

</html>
