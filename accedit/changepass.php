<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");


session_start();
if($_SESSION['login'] != 'true') {
	header('Location: OOS.php', true, 301);
	exit();	
}


?>

<html>
<head>

	<title>

		User Validation

	</title>


</head>



<body>

	<center><h1>Ocean Observation System</h1></center>
	
	<form name = "editInfo" method="post"  action="accountupdate.php"> 
					<center><h4 class ="editHeader"> personal account settings you can change: </h4></center>
					<center>Change password: <input type = "password" name = "newpass">
					<input type="submit" name="validate" value="confirm"></center>
	</form>
</body>


</html>