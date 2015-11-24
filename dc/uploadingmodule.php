<html>

<body>
<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
</div> 
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

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
	<form name = "logout" method="post"  action="../OOSLogin.php"> 
					<h2 class ="main page"> </h2>
					<center><input type="submit" name="validate" value="  main page  "></center>
	</form>
	<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="  log out  "></center>
	</form> 


</body>

</html>
