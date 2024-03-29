<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- handles the actual sql portion of adding a sensor -->
<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);

	include("../PHPconnectionDB.php");
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
			// if the creat button was pressed - get variables  	 
			if(isset($_POST['create'])){        	
				$loc=$_POST['location'];            		
				$sType=$_POST['sensor_type'];
				$desc=$_POST['description'];
				$ID=$_POST['ID'];
			
				// database connection from notes on php
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				
				// guard against empty input - and display buttons and message
				if (($loc == '') || ($sType == '') || ($desc == '')){
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Input Fields Cannot Be Empty </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="sensorAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>

				<?php
				// guard against incorrect sensor type input - and display buttons and message
				} else if (strlen($sType) != 1) {
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Sensor Type Must Be One Of {'a','i','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="sensorAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 

				// guard against inccorrect sensor type input - and display buttons and message
				} else if (($sType != 'a') && ($sType != 'i') && ($sType != 's')) {
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Sensor Type Must Be One Of {'a','i','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="sensorAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	

					<?php 
				// input is valid		 		
				} else {

					//insert statement
					$sql = 'INSERT INTO SENSORS (sensor_id, location, sensor_type, description) VALUES (\''.$ID.'\',\''.$loc.'\',\''.$sType.'\',\''.$desc.'\')';	
			
					//prepare
					$stid = oci_parse($conn, $sql );
				
					//execute
					$res=@oci_execute($stid);

					//check query
					if (!$res) {
						$err = oci_error($stid); 
						echo htmlentities($err['There was an error, please try again']);

					// query okay- create success message and appropriate buttons
					} else {
						?>
							<div class="LoginForm container">
								<h2 class ="LoginHeader"> Success! </h2>
								<form name= "Finish" method="post" action="sensorModule.php"> 
									<input type="submit" name="Return"value="Return To Menu"/>
								</form>
							</div>

							<div class="LoginForm container">
								<form name= "Back" method="post" action="sensorAdd.php"> 
									<input type="submit" name="Back"value="Add Another Sensor"/>
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
