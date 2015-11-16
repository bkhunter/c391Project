<?php
include("PHPconnectionDB.php");
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


		<?php   	 
			if(isset($_POST['IDSearch'])){        	
				$ID=$_POST['usrID'];

				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				} 

				$sensorQ = 'SELECT location, sensor_type, description FROM sensors WHERE sensor_id = \''.$ID.'\'';	
			
				//prepare
				$stid1 = oci_parse($conn, $sensorQ );
				
				//execute
				$SQres=oci_execute($stid1);

				$index = 0;
				$res = array("Location","Sensor Type","Description");
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					foreach($row as $item) {
						$res[$index] = $item;
						$index = $index + 1;
					}
				}
		
				$loc = $res[0];
				$sType = $res[1];
				$desc = $res[2];

			?> 		
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

				<div class="LoginForm container">
					<h3> Find Another Sensor </h3>
					<form name= "userID_search" method="post" action="sensorRemoveRes.php"> 
						Sensor ID<input type="text" name="usrID"/> <br/>
						<input type="submit" value="search" name="IDSearch"/>
					</form>
				</div>

				<div class="LoginForm container">
					<form name= "Finish" method="post" action="sensorModule.php"> 
						<input type="submit" name="Return"value="Return To Menu"/>
					</form>
				</div>
		<?php
			}
		?>

	</body>

</html>
       
