<?php
include("PHPconnectionDB.php");
?>

<html>
<head>

	<title>

		User Validation

	</title>


</head>



<body>

	<center><h1>Ocean Observation System</h1></center>

	<?php
	
	if (isset ($_POST['validate'])){
	
		$username = $_POST["username"];
		$password = $_POST["pass"];
		$conn=connect();
		
		session_start();
		if($_SESSION['validate'] == 'true'){
			header('Location: OOS.php', true, 301);
			session_destroy();
			exit();
		}
				
		$sql = 'select * from users where user_name = \''.$username.'\' and  password = \''.$password.'\'';
		
		
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		
		if ( !oci_fetch_array($stid, OCI_ASSOC) ) {
			session_start();
			$_SESSION['validate'] = '<center><font color="#D00000">Wrong username or password!</font></center>';
			header('Location: OOS.php', true, 301);
			exit();			
			}
			else {
				session_start();
				$_SESSION['validate'] = 'true';
				echo '<center>Welcome '.$username.'!</center><br/>';
			}
	}
	
	?>

	



</body>





</html>
