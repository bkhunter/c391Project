<?php
include("../PHPconnectionDB.php");
?>

<html>
	 <?php
  		ini_set('session.cache_limiter','public');
		session_cache_limiter(false);
		
  		session_start();
		$pID = $_SESSION['person_id'];
		//check account type 
		if ($_SESSION['role'] != 's') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
		}
	?>
	<head>
		<style>

			table#sensors {
				
				background-color: gray;
				border: 3px solid black;
				width: 100%;
				text-align: center;
			}

			ul#item {
				list-style-type: none;
				padding: 0;
				text-align: left;
				border: 1px solid black;
			}

			ul#item li a {
				background-color: gray;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
				list-style-position:inside;
   				
			}

			ul#item li a:hover {
				background-color: black;
			}
	
			</style>

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
		<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
		</div> 

		<div class="container">
				<h2 class ="LoginHeader">Generate Olap Report</h2>
		</div>	

		<div class="container">
			<table id = "sensors" border = "1">
				<th> Subscribed Sensor IDs </th>
	<?php
		
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
		
			error_reporting(0);

			//execute
			$res=oci_execute($stid);

		
			//create temporary table
			$tableQ = 'CREATE TABLE '.$tableName.' (
			location   	varchar(64),
			person_id    int,
			sensor_id	int,
			value 		float,
			date_created date,
			quarter   	varchar(64),
			week		int,
			FOREIGN KEY(sensor_id,person_id) REFERENCES subscriptions
			) tablespace c391ware' ;

			//prepare
			$stid = oci_parse($conn, $tableQ );

			//execute
			$res=oci_execute($stid);

			// get sensors attatched to scientist
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

				//display as list item
				echo "<tr>";
				echo "<td>"; 
				echo "<ul id='item'>";

				//http://stackoverflow.com/questions/13102351/passing-a-variable-with-href-in-html
				echo "<li><a href='OlapYearly.php?sid=$sensorID' >" .$sensorID. "</a></li>";

				echo "</ul>";
				echo "</td>"; 
				echo "</tr>";

				// get locations attached to subcribed sensors
				$lQ = 'select location from sensors where sensor_id = \''.$sensorID.'\' ';

				//prepare
				$stid = oci_parse($conn, $lQ );
		
				//execute
				$res=oci_execute($stid);

				//strange because in a loop, but only 1 location per sensor ID
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
						if ($i%2 == 0) {
							$val = $item;
						} else {
							$date = $item;

							//get week and month number
							$timestamp = strtotime($date);
							$weekNum = strftime('%-U', $timestamp);
							$monthNum = strftime('%-m', $timestamp);


							if ($monthNum < 4) {
								$quart = "Jan-Mar";
							} else if ($monthNum < 7) {
								$quart = "Apr-Jun";
							} else if ($monthNum < 10) {
								$quart = "Jul-Sep";
							} else {
								$quart = "Oct-Dec";
							}


							//now insert into fact table
							$insert = 'INSERT INTO '.$tableName.' (location, value, person_id, sensor_id, date_created, quarter, week) VALUES (\''.$loc.'\',\''.$val.'\',\''.$pID.'\',\''.$sensorID.'\',\''.$date.'\',\''.$quart.'\',\''.$weekNum.'\')';	
			
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
			</table>
		</div>	

		<div class="container">
			<form action= "../OOSLogin.php"> 
				<input type="submit" name="back" value="Exit"/>
			</form>
		</div>	
	</body>
</html>
