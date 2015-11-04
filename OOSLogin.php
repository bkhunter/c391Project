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
	
	session_start();
	
	if (isset ($_POST['validate'])){
	
		$username = $_POST["username"];
		$password = $_POST["pass"];
		$conn=connect();
				
		$sql = 'select * from users where user_name = \''.$username.'\' and  password = \''.$password.'\'';
		
		
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		
		if ( !oci_fetch_array($stid, OCI_ASSOC) && $_SESSION['login'] != 'true' ) {
			$_SESSION['validate'] = '<center><font color="#D00000">Wrong username or password!</font></center>';
			header('Location: OOS.php', true, 301);
			exit();			
			}
			else {
				if($_SESSION['login'] != 'true'){
					$_SESSION['login']    = 'true';
					$_SESSION['validate'] = 'true';
					$_SESSION['username'] = $username;
				} 
			}	
				
	}
	if($_SESSION['login'] != 'true') {
		header('Location: OOS.php', true, 301);
		exit();	
	}
	
	echo '<center>Welcome '.$_SESSION[username].'!</center><br/>';
	
	
	?>
	
	<form name = "logout" method="post"  action="logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="log out"></center>
	</form>
	
	<form name = "editInfo" method="post"  action="accountupdate.php"> 
					<h2 class ="editHeader"> </h2>
					<center>Change password: <input type = "password" name = "newpass">
					<input type="submit" name="validate" value="confirm"></center>
	</form>

	



</body>





</html>
