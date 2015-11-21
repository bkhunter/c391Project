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
		
		
		<?php
		
		//check if logged in 
		session_start();
		if($_SESSION['login'] != 'true') {
			header('Location: ../OOS.php', true, 301);
			exit();	
		}
		
		//if clicked on edit account 
		if($_POST['validateAcc']) {
			
			$conn=connect();
			$sql = 'select * from persons p, users u where p.person_id = u.person_id and u.person_id = \''.$_SESSION['person_id'].'\'';
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			oci_fetch($stid);
			
			
			echo '<center><table style=width:15%>
			<th>Account Information:</th>
						<tr>
							<td>First Name: '.oci_result($stid, 'FIRST_NAME').'</td>
							<td>
								<form name = "continue" method="post"  action="changeaccinfo.php"> 
									<input type="submit" name="first" value="edit">
								</form>
							</td>
						</tr>
						<tr>
							<td>Last Name: '.oci_result($stid, 'LAST_NAME').'</td>
							<td>
								<form name = "continue" method="post"  action="changeaccinfo.php"> 
									<input type="submit" name="last" value="edit">
								</form>
							</td>
						</tr>
						<tr>
							<td>Address: '.oci_result($stid, 'ADDRESS').'</td>
							<td>
								<form name = "continue" method="post"  action="changeaccinfo.php"> 
									<input type="submit" name="address" value="edit">
								</form>
							</td>
						</tr>
						<tr>
							<td>Email: '.oci_result($stid, 'EMAIL').'</td>
							<td>
								<form name = "continue" method="post"  action="changeaccinfo.php"> 
									<input type="submit" name="email" value="edit">
								</form>
							</td>
						</tr>
						<tr>
							<td>Phone: '.oci_result($stid, 'PHONE').'</td>
							<td>
								<form name = "continue" method="post"  action="changeaccinfo.php"> 
									<input type="submit" name="phone" value="edit">
								</form>
							</td>
						</tr>
						<tr>
						<td>
							<form name = "continue" method="post"  action="../OOSLogin.php"> 
								<h2 class ="continue"> </h2>
								<center><input type="submit" name="validate" value="continue"></center>
							</form>
						</td>
						</tr></center>';
		}		
		
		?>
		
	</body>


</html>