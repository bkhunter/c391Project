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
			$conn=connect();
			$password = $_POST["newpass"];
			session_start();
			$username = $_SESSION['username'];
			$sql = 'update users set password=\''.$password.'\' where user_name=\''.$username.'\'';
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			
			$sql = 'select * from users where user_name = \''.$username.'\' and  password = \''.$password.'\'';
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if ( !oci_fetch_array($stid, OCI_ASSOC) ) {
				$_SESSION['validatePass'] = '<center><font color="#D00000">can not use as password!</font></center>';
				header('Location: OOSLogin.php', true, 301);
				exit();	
			}
			else {
				$_SESSION['validatePass'] = '<center><font color="#FF88FF">password changed!</font></center>';
				header('Location: OOSLogin.php', true, 301);
				exit();
			}
		?>
		
	</body>


</html>