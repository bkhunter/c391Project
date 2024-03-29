<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- if the user chose to remove a sensor, either before or after searching, they end up here -->

<?php
	include("../PHPconnectionDB.php");
	ini_set('session.cache_limiter','public');

	session_cache_limiter(false);
	session_start();

	//check account type 
	if ($_SESSION['role'] != 'a') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();
	}
?>

<html>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

    <body>

		<div class ="page">
			<div class = "page-header">
				<h1 class ="title"> Sensor and User Management </h1>			
			</div>
		
			<div align="right">
				<form name = "login" method="post"  action="../help.html"> 
						<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
				</form>
			</div> 
	
			<?php  	 
			// user must select remove to get here
			if(isset($_POST['rmv'])){  
  	
				$ID=$_POST['sID'];            		
			
				// db connect
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				// checks that input valid - if not display error message and navigation
				if ($ID == 0 || is_int($ID)){
				?>
					<div class="LoginForm container">
						<h2 class ="LoginHeader"> Please Enter a Valid Sensor ID </h2>
						<form name= "Finish" method="post" action="sensorModule.php"> 
							<input type="submit" name="Return"value="Return To Menu"/>
						</form>
						<form name= "Back" method="post" action="sensorRemove.php"> 
							<input type="submit" name="Back"value="Back"/>
						</form>	
					</div>

				<?php
					
				// input valid
				} else {

					//insert statement
					$sql = 'DELETE FROM SENSORS WHERE sensor_id = (\''.$ID.'\')'; 
					
					//prepare
					$stid = oci_parse($conn, $sql );
				
					//execute
					$res=oci_execute($stid);

				
					if (!$res) {
						$err = oci_error($stid); 
						echo htmlentities($err['There was an error, please try again']);
					} else {
						// valid sql
						?>
							<div class="LoginForm container">
								<h2 class ="LoginHeader"> Sensor Removed </h2>
								<form name= "Finish" method="post" action="sensorModule.php"> 
									<input type="submit" name="Return"value="Return To Menu"/>
								</form>

								<form name= "Back" method="post" action="sensorRemove.php"> 
									<input type="submit" name="Back"value="Remove Another Sensor"/>
								</form>	
							</div>

						<?php	
					}
					  
					// Free the statement identifier when closing the connection
					oci_free_statement($stid);
					oci_close($conn);
				}  
			} ?>	
		</div>		
	</body>
</html>
