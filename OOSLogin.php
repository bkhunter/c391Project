<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("PHPconnectionDB.php");

session_start();

$pID = $_SESSION['person_id'];
$pID = (string)$pID;
$f = "fact";
$tableName = "{$f}{$pID}";

ini_set('display_errors', 1);
	
error_reporting(E_ALL);

$conn=connect();
	
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} 

// Drop data analysis fact table
$dropQ = 'drop table '.$tableName.' ';

//prepare
$stid = oci_parse($conn, $dropQ );

error_reporting(0);

//execute
$res=oci_execute($stid);

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
		oci_fetch($stid);

		

		if((is_numeric ( oci_result($stid, 'PERSON_ID') )==1)) {
			$_SESSION['login'] = 'true';
			$_SESSION['validate'] = 'true';
			$_SESSION['username'] = $username;
			$_SESSION['person_id'] = oci_result($stid, 'PERSON_ID');
			$_SESSION['role'] = oci_result($stid, 'ROLE');
		}
		
		//if not login in or not an account 
		if ( $_SESSION['login'] != 'true' ) {

			$_SESSION['validate'] = '<center><font color="#D00000">Wrong username or password!</font></center>';
			header('Location: OOS.php', true, 301);
			exit();			
		}	
				
	}
	if($_SESSION['login'] != 'true') {
		header('Location: OOS.php', true, 301);
		exit();	
	}
	
	echo '<center>Welcome '.$_SESSION[username].'!</center><br/>';
	
		//if scientist 
		if($_SESSION['role'] == 's'){

			echo '<form name = "subscribe" method="post"  action="subs/subscribe_module.php"> 
					<h2 class ="subscribe"> </h2>
					<center><input type="submit" name="subscription" value="subscribe"></center>
					</form>';
			echo '<form name = "search" method="post"  action="search/search_module.php"> 
					<h2 class ="subscribe"> </h2>
					<center><input type="submit" name="searchSubmit" value="search"></center>
					</form>';

			echo '<form name = "olap" method="post"  action="Data_Analysis/Olap.php"> 
					<center><input type="submit" name="olap" value="Data Analysis Module"></center>
					</form>';
		}
		
		//administrator
		if($_SESSION['role'] == 'a'){

			echo '<form name = "sensor" method="post"  action="./sensor_and_user_mgmt/sensorModule.php"> 
					<h2 class ="search"> </h2>
					<center><input type="submit" name="search" value="user and sensor management"></center>
					</form>';
					

		}
		
		//data curator
		if($_SESSION['role'] == 'd'){

			echo '<form name = "subscribe" method="post"  action="./dc/uploadingmodule.php"> 
					<h2 class ="subscribe"> </h2>
					<center><input type="submit" name="upload" value="upload data"></center>
					</form>';
		}


	
	?>
	
	<form name = "logout" method="post"  action="logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="  log out  "></center>
	</form>
	
	<center><h4 class ="editHeader"> personal account settings you can change: </h4></center>
	<form name = "editInfo" method="post"  action="./acc_edit/changepass.php"> 
					<center><input type="submit" name="validate" value="change password"></center>
	</form>
	
	<form name = "editInfo" method="post"  action="./acc_edit/accountinfo.php"> 
					<center><input type="submit" name="validateAcc" value="edit account"></center>
	</form>

	





</body>





</html>
