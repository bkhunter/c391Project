<!DOCTYPE HTML>

<?php
include("PHPconnectionDB.php");
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
		
		<h1 class ="title"> Ocean Observation System</h1>		
		</div>
		
		
		<?php
		
		session_start();
		if($_SESSION['login'] != 'true') {
			header('Location: OOS.php', true, 301);
			exit();	
		}
		
		if (isset ($_POST['validate'])){
			$conn=connect();
			$password = $_POST["newpass"];
			$_SESSION['login'] = 'true';
			$username = $_SESSION['username'];
			if($password == ''){
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as password!</font></center>';
			}			
			else {
				$sql = 'update users set password=\''.$password.'\' where user_name=\''.$username.'\'';
				$stid = oci_parse($conn, $sql);
				@oci_execute($stid);
			
				$sql = 'select * from users where user_name = \''.$username.'\' and  password = \''.$password.'\'';
				$stid = oci_parse($conn, $sql);
				@oci_execute($stid);
				if ( !oci_fetch_array($stid, OCI_ASSOC) ) {
					$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as password!</font></center>';
				}
				else {
					$_SESSION['validatePass'] = '<center><font color="#FF88FF">password changed!</font></center>';
				}
			}
			echo $_SESSION['validatePass'];
		}
		if (isset ($_POST['editfirst'])){
			echo $_POST['first'];
		}
		if (isset ($_POST['editlast'])){
			echo $_POST['last'];
		}
		if (isset ($_POST['editaddress'])){
			echo $_POST['address'];
		}
		if (isset ($_POST['editemail'])){
			echo $_POST['email'];
		}
		if (isset ($_POST['editphone'])){
			echo $_POST['phone'];
		}
		
		?>
		
		<form name = "continue" method="post"  action="OOSLogin.php"> 
					<h2 class ="continue"> </h2>
					<center><input type="submit" name="validate" value="continue"></center>
		</form>
		
	</body>


</html>