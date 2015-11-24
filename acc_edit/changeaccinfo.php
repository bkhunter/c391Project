<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");

//check if logged in 
session_start();
if($_SESSION['login'] != 'true') {
	header('Location: ../OOS.php', true, 301);
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
	
	<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
	</div> 
	
	<?php
	if(isset ($_POST['first'])) {
		echo
		'<form name = "editInfo" method="post"  action="accountupdate.php"> 
						<center>Change first name: <input type = "text" name = "first">
						<input type="submit" name="editfirst" value="confirm"></center>
		</form>';
	}
	if(isset ($_POST['last'])) {
		echo
		'<form name = "editInfo" method="post"  action="accountupdate.php"> 
						<center>Change last name: <input type = "text" name = "last">
						<input type="submit" name="editlast" value="confirm"></center>
		</form>';
	}
	if(isset ($_POST['address'])) {
		echo
		'<form name = "editInfo" method="post"  action="accountupdate.php"> 
						<center>Change address: <input type = "text" name = "address">
						<input type="submit" name="editaddress" value="confirm"></center>
		</form>';
	}
	if(isset ($_POST['email'])) {
		echo
		'<form name = "editInfo" method="post"  action="accountupdate.php"> 
						<center>Change email: <input type = "text" name = "email">
						<input type="submit" name="editemail" value="confirm"></center>
		</form>';
	}
	if(isset ($_POST['phone'])) {
		echo
		'<form name = "editInfo" method="post"  action="accountupdate.php"> 
						<center>Change phone: <input type = "text" name = "phone">
						<input type="submit" name="editphone" value="confirm"></center>
		</form>';
	}
	
	?>
	
</body>

</html>