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
		
		
		$sql = 'select * from users where user_name = \''.$username.'\' and  password = \''.$password.'\'';
		
		
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		
		if ( !oci_fetch_array($stid, OCI_ASSOC) ) {
			echo 'Wrong username or password!';
			echo '<br/>';
			}
			else {
				echo 'Welcome '.$username;
				echo '<br/>';
			}
		

	}



	?>

	



</body>





</html>
