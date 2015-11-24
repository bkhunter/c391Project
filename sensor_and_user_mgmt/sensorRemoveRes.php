<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- If the user opted to search for a sensor, this shows the results -->
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
	<head>
		<title>
			Sensor Remove Search
		</title>
	</head>

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
				// ID must be set, used to populate fields
				if(isset($_POST['IDSearch'])){        	
					$ID=$_POST['sensID'];

					ini_set('display_errors', 1);
					error_reporting(E_ALL);
			
					// connect to DB
					$conn=connect();
				
					if (!$conn) {
						$e = oci_error();
						trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					} 

					//query
					$sensorQ = 'SELECT location, sensor_type, description FROM sensors WHERE sensor_id = \''.$ID.'\'';	
			
					//prepare
					$stid1 = oci_parse($conn, $sensorQ );
				
					//execute
					$SQres=oci_execute($stid1);

					$index = 0;
					// make a default array for storing the output
					// added benefit is that if input is bad, there will still be output in fields
					$res = array("Location","Sensor Type","Description");
					while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
						foreach($row as $item) {
							$res[$index] = $item;
							$index = $index + 1;
						}
					}
		
					// set values found to variables
					$loc = $res[0];
					$sType = $res[1];
					$desc = $res[2];

				?> 
					<!-- display results -->
					<div class="LoginForm container">

						<h1>Sensor Information</h1>
						<form name= "usr_update" method="post" action="sensorRemoveSubmit.php"> 
							Location<input type="text" value= "<?php echo $loc ?>" name="ID" readonly/> <br/>
							ID<input type="text" value= "<?php echo $ID ?>" name="sID" readonly/> <br/>
							Sensor Type<input type="text" value= "<?php echo $sType ?>" name="ID" readonly/> <br/>
							Description<textarea name="description" rows="5" cols="35"  readonly><?php echo $desc ?> </textarea>
							<input type="submit" value="Remove" name="rmv"/>
						</form>

					</div>	
					
					<!-- navigational forms -->
					<div class="LoginForm container">
						<h3> Find Another Sensor </h3>
						<form name= "userID_search" method="post" action="sensorRemoveRes.php"> 
							Sensor ID<input type="text" name="sensID"/> <br/>
							<input type="submit" value="search" name="IDSearch"/>
						</form>
					</div>

					<div class="LoginForm container">
						<form name= "Finish" method="post" action="sensorModule.php"> 
							<input type="submit" name="Return"value="Return To Menu"/>
						</form>
					</div>
				</div>
			<?php
				}
			?>
	</body>
</html>
       
