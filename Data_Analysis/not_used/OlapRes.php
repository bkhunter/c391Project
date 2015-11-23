<?php
include("PHPconnectionDB.php");
?>

<html>
	<head>
		<title>
			Olap Analysis
		</title>
	</head>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="Olap.css">
	
	<body>
		<div class ="page">
			<div class = "page-header">
			<h1 class ="title"> Olap Analysis</h1>			
		</div>

		<?php   	 
		if(isset($_POST['IDSearch'])){        	
			$ID=$_POST['sID'];

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
			<div class="container">

				<h1>Sensor Information</h1>
				<form name= "detailedSensorGen" method="post" action="OlapYearly.php"> 
					Location<input type="text" value= "<?php echo $loc ?>" name="ID" readonly/> <br/>
					Sensor ID<input type="number" value= "<?php echo $ID ?>" name="sID" readonly/> <br/>
					Sensor Type<input type="text" value= "<?php echo $sType ?>" name="ID" readonly/> <br/>
					Description<textarea name="description" rows="5" cols="35"  readonly><?php echo $desc ?> </textarea>
					<input type="submit" value="Generate!" name="gen"/>
				</form>

			</div>	

			<div class="container">
				<h3> Verify Another Sensor </h3>
				<form name= "userID_search" method="post" action="OlapRes.php"> 
					Sensor ID<input type="text" name="sID"/> <br/>
					<input type="submit" value="search" name="IDSearch"/>
				</form>
			</div>

		<?php
		}
		?>
	</body>
</html>

