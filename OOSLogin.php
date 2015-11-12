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
		oci_fetch($stid);

		
		if ( !$res && $_SESSION['login'] != 'true' ) {
			$_SESSION['validate'] = '<center><font color="#D00000">Wrong username or password!</font></center>';
			header('Location: OOS.php', true, 301);
			exit();			
			}
			else {
				if($_SESSION['login'] != 'true'){
					$_SESSION['login']    = 'true';
					$_SESSION['validate'] = 'true';
					$_SESSION['username'] = $username;
					$_SESSION['person_id'] = oci_result($stid, 'PERSON_ID');
					$_SESSION['role'] = oci_result($stid, 'ROLE');
				} 
			}	
				
	}
	if($_SESSION['login'] != 'true') {
		header('Location: OOS.php', true, 301);
		exit();	
	}
	
	echo '<center>Welcome '.$_SESSION[username].'!</center><br/>';
	
	
		if($_SESSION['role'] == 's'){

			echo '<form name = "subscribe" method="post"  action="subscribe_module.php"> 
					<h2 class ="subscribe"> </h2>
					<center><input type="submit" name="subscription" value="subscribe"></center>
					</form>';



			echo '<form name = "search" method="post"  action="search_module.php"> 
					<h2 class ="search"> </h2>
					<center><input type="submit" name="search" value="search"></center>
					</form>';

		}


	
	?>
	
	<form name = "logout" method="post"  action="logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="  log out  "></center>
	</form>
	
	<center><h4 class ="editHeader"> personal account settings you can change: </h4></center>
	<form name = "editInfo" method="post"  action="changepass.php"> 
					<center><input type="submit" name="validate" value="change password"></center>
	</form>
	
	<form name = "editInfo" method="post"  action="accountinfo.php"> 
					<center><input type="submit" name="validateAcc" value="edit account"></center>
	</form>

	





</body>





</html>
