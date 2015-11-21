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

		<div class="container">
				<h2 class ="LoginHeader">Generate Olap Report</h2>
		</div>	

		<div class="container">
			<h3>Input Sensor ID</h3>
			<form name= "OlapGen" method="post" action="OlapYearly.php"> 
				Sensor ID <input type="number" name="sID"/> <br/>
				<input type="submit" name="gen"value="Generate!"/>
			</form>
		</div>

		<div class="container">
			<h3> Verify Sensor ID </h3>
			<form name= "userID_search" method="post" action="OlapRes.php"> 
				Sensor ID<input type="number" name="sID"/> <br/>
				<input type="submit" value="search" name="IDSearch"/>
			</form>
		</div>	
	<?php
			$pID = 3;
			$pID = (string)$pID;
			$f = "fact";
			$tableName = "{$f}{$pID}";
			
	
			//http://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
			session_start();
			$_SESSION['pID'] = $pID;
			$_SESSION['table'] = $tableName;

			//construct fact view
			ini_set('display_errors', 1);
	
			error_reporting(E_ALL);
			
			$conn=connect();
				
			if (!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			} 

			//First drop table
			$dropQ = 'drop table '.$tableName.' ';

			//prepare
			$stid = oci_parse($conn, $dropQ );
		
			//error_reporting(0);

			//execute
			$res=oci_execute($stid);

		
			//create temporary table
			$tableQ = 'CREATE TABLE '.$tableName.' (
			location   	varchar(64),
			person_id    int,
			sensor_id	int,
			value 		float,
			date_created date,
			FOREIGN KEY(sensor_id,person_id) REFERENCES subscriptions
			) tablespace c391ware' ;

			//prepare
			$stid = oci_parse($conn, $tableQ );
		
			//error_reporting(1);

			//Warning: oci_execute(): ORA-00903: invalid table name in /compsci/webdocs/bkhunter/web_docs/c391Project/Data_Analysis/Olap.php on line 58
			//execute

			$res=oci_execute($stid);



			// get sensors attached to admin
			$sQ = 'select * from subscriptions where person_id = \''.$pID.'\'';	
			
			//prepare
			$stid = oci_parse($conn, $sQ );
		
			//execute
			$res=oci_execute($stid);

			$s_res = array();
			while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
				// only get sensor_id's
				$i = 0;
				foreach($row as $item) {
					if ($i%2 == 0) {
						array_push($s_res, $item);
					}
					$i++;	
				}
			}

			// with sensor ID get location and values to put into fact table
			foreach($s_res as &$sensorID) {
				
				// get locations attached to subcribed sensors
				$lQ = 'select location from sensors where sensor_id = \''.$sensorID.'\' ';

				//prepare
				$stid = oci_parse($conn, $lQ );
		
				//execute
				$res=oci_execute($stid);

				while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
					foreach($row as $item) {
						$loc = $item;
					}
				}

				//now have loc, next get values	

				$iQ = 'select value, date_created from scalar_data where sensor_id = \''.$sensorID.'\'';

				//prepare
				$stid = oci_parse($conn, $iQ );
		
				//execute
				$res=oci_execute($stid);

				while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
					$i = 0;
					foreach($row as $item) {
						if ($i == 0) {
							$val = $item;
						} else {
							$date = $item;

							//echo $date;
							//echo "--";

							//now insert into fact table
							$insert = 'INSERT INTO '.$tableName.' (location, value, person_id, sensor_id, date_created) VALUES (\''.$loc.'\',\''.$val.'\',\''.$pID.'\',\''.$sensorID.'\',\''.$date.'\')';	
			
							//prepare
							$stid1 = oci_parse($conn, $insert );
				
							//execute
							$res=oci_execute($stid1);

							if (!$res) {
								$err = oci_error($stid1); 
								echo htmlentities($err['There was an error, please try again']);
							}
						}
						
						$i++;
					}
				}
			}
		
		?>
	</body>
</html>
