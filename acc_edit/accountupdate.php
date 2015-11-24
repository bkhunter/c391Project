<!DOCTYPE HTML>

<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");
?>

<html>
	<head>

	<title>

		Ocean Observation System
	</title>


	</head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
	integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" 
	crossorigin="anonymous">
	<link rel ="stylesheet" type ="text/css" href="login.css">
	<body>
		<div class ="page">
		<div class = "page-header">
		
		<center><h1>Ocean Observation System</h1></center>	
		</div>
		
		<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
		</div> 
		
		<?php
		
		session_start();
		//login check 
		if($_SESSION['login'] != 'true') {
			header('Location: ../OOS.php', true, 301);
			exit();	
		}
		$conn=connect();
		//check that a new password was given 
		if (isset ($_POST['validate'])){
			$password = $_POST["newpass"];
			$_SESSION['login'] = 'true';
			$username = $_SESSION['username'];
			//password can not be no chars 
			if($password == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as password!</font></center>';
			}			
			else {
				//updating password 
				$sql = 'update users set password=\''.$password.'\' where user_name=\''.$username.'\'';
				$stid = oci_parse($conn, $sql);
				
				//messages based on password change attempt 
				if ( !@oci_execute($stid) ) {
					//error -> not alllowed 
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as password!</font></center>';
				}
				else {
					//pass is good to use 
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">password changed!</font></center>';
				}
			}
			//display message of password change attempt 
			echo $_SESSION['validatePass'];
		}
		
		
		
		//edit personal information base on past form clicked 
		if (isset ($_POST['editfirst'])){
			$name = $_POST['first'];
			$_SESSION['login'] = 'true';
			//cannot be blank 
			if($name == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as name!</font></center>';
			}			
			else {
				//name change 
				$sql = 'update persons set first_name=\''.$name.'\' where person_id=\''.$_SESSION['person_id'].'\'';
				$stid = oci_parse($conn, $sql);

				if ( !@oci_execute($stid) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as name!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">name changed!</font></center>';
				}
			}
			//message based of issues or not 
			echo $_SESSION['validatePass'];
		}
		if (isset ($_POST['editlast'])){
			$name = $_POST['last'];
			$_SESSION['login'] = 'true';
			if($name == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as name!</font></center>';
			}			
			else {
				$sql = 'update persons set last_name=\''.$name.'\' where person_id=\''.$_SESSION['person_id'].'\'';
				$stid = oci_parse($conn, $sql);
			
				if ( !@oci_execute($stid) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as name!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">name changed!</font></center>';
				}
			}
			echo $_SESSION['validatePass'];
		}
		if (isset ($_POST['editaddress'])){
			$name = $_POST['address'];
			$_SESSION['login'] = 'true';
			if($name == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as address!</font></center>';
			}			
			else {
				$sql = 'update persons set address=\''.$name.'\' where person_id=\''.$_SESSION['person_id'].'\'';
				$stid = oci_parse($conn, $sql);
			
				if ( !@oci_execute($stid) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as address!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">address changed!</font></center>';
				}
			}
			echo $_SESSION['validatePass'];
		}
		if (isset ($_POST['editemail'])){
			$name = $_POST['email'];
			$_SESSION['login'] = 'true';
			if($name == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as email!</font></center>';
			}			
			else {
				$sql = 'update persons set email=\''.$name.'\' where person_id=\''.$_SESSION['person_id'].'\'';
				$stid = oci_parse($conn, $sql);
			
				if ( !@oci_execute($stid) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as email!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">email changed!</font></center>';
				}
			}
			echo $_SESSION['validatePass'];
		}
		if (isset ($_POST['editphone'])){
			$name = $_POST['phone'];
			$_SESSION['login'] = 'true';
			if($name == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as phone number!</font></center>';
			}			
			else {
				$sql = 'update persons set phone=\''.$name.'\' where person_id=\''.$_SESSION['person_id'].'\'';
				$stid = oci_parse($conn, $sql);

				if ( !@oci_execute($stid) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as phone number!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">phone number changed!</font></center>';
				}
			}
			echo $_SESSION['validatePass'];
		} else {
			
		}
		
		?>
		
		<form name = "continue" method="post"  action="../OOSLogin.php"> 
					<h2 class ="continue"> </h2>
					<center><input type="submit" name="validate" value="continue"></center>
		</form>
		
	</body>


</html>