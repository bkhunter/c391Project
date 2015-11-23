<?php
include("PHPconnectionDB.php");
?>
<html>
	<head>
		<style>
			
			table#Week {
				
				background-color: gray;
				border: 3px solid black;
				text-align:left;
			}

			ul#Times {
				list-style-type: none;
				padding: 0;
				text-align: left;
				border: 1px solid black;
			}

			ul#Times li a {
				background-color: gray;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
				list-style-position:inside;
				text-align:left;
   				
			}

			ul#Times li a:hover {
				background-color: black;
			}

			ul#Res {
				background-color: white;
				list-style-type: none;
				text-align: center;
				border: 1px solid black;
				text-decoration: none;
				padding: 10px 20px;
				display: block;
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
		<?php
			if (isset($_GET['week'])) {
				$week = $_GET['week']; 
				$month = $_GET['month'];  
				$quarter = $_GET['quarter']; 	 
				$year = $_GET['year'];
				$sid = $_GET['sid']; 

				//get week date range 
				$datet = new DateTime();
				$datef = new DateTime();
				$datet->setISODate($year, $week+1, 0);
				$datef->setISODate($year, $week+1, 6);

				$start =  $datet->format('Y-m-d') . "\n";
				$end =  $datef->format('Y-m-d') . "\n";

				//get month
				$mObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $mObj->format('F');
				
				session_start();
				$tableName = $_SESSION['table'];
			
				//get location
				$conn=connect();
		
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}

				// get locations attached to subcribed sensors
				$lQ = 'select location from sensors where sensor_id = \''.$sid.'\' ';

				// prepare
				$stid = oci_parse($conn, $lQ );
	
				// execute
				$res=oci_execute($stid);

				// strange because in a loop, but only 1 location per sensor ID
				while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
					foreach($row as $item) {
						$loc = $item;
					}
				}

				?>

			<div class ="page">
				<div class = "page-header">
				<h1 class ="title"> Olap Analysis</h1>			
			</div>
		
			<div class="container">
				<h4> ID : <?php echo $sid ?> </h4>  
				<h4>  Location : <?php echo $loc ?> </h4>
				<h4>  Year : <?php echo $year ?> </h4>
				<h4>  Quarter : <?php echo $quarter ?> </h4>
				<h4>  Month : <?php echo $monthName ?> </h4>
				<h4>  Week : <?php echo $start ?> to <?php echo $end?> </h4>
				<table id = "Week" border = "1">
					<th> Day </th>
					<th> Sum </th>
					<th> Min </th>
					<th> Max </th>

			<?php

/*
				$week_start = new DateTime();
				$week = strftime("%U");  //this gets you the week number starting Sunday
				$week_start->setISODate(2015,$week,0); //return the first day of the week with offset 0
				echo $week_start -> format('d-M-Y'); //and just prints with formatting 
*/

				$weekRes = 'SELECT date_created, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
				FROM	'.$tableName.' f
				WHERE	f.sensor_id = \''.$sid.'\' and extract(year from date_created) = \''.$year.'\' and extract(month from date_created) = \''.$month.'\' and f.week = \''.$week.'\'
				GROUP BY date_created';

				//prepare
				$stid1 = oci_parse($conn,$weekRes);
					
				$res = oci_execute($stid1);
				$i = 0;
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					echo '<tr>';
					foreach($row as $item) {
						if ($i%4 == 0) {
							$timeStr = "{$month}/{$item}/{$year}";
							$datetime = DateTime::createFromFormat('m/d/Y', $timeStr);
							$timeStr = $datetime->format('D, Y-M-d');
							//echo $timeStr;

							//$time = strtotime($timeStr);
							//$newformat = date('Y-m-d',$time);
							//$newDate = date("d-m-Y", strtotime($item));

							//echo $newformat;

							echo "<td>"; 
							echo "<ul id='Times'>";
							echo "<li><a href='OlapWeekly.php?sid=$sid&year=$year&quarter=$quarter&month=$month&$week=$item'>" .$timeStr."</a></li>";
							//echo "<li><a href='OlapWeekly.php?sid=$sid&year=$year&quarter=$quarter&month=$month&$quarter=$item'>" .$item. "</a></li>";							
							echo "</ul>";
							echo "</td>"; 


						} else {
							echo "<td>"; 
							echo "<ul id='Res'>";
							echo "<li>" .$item. "</li>";
							echo "</ul>";
							echo "</td>"; 
						}
						$i++;
					}
					echo '</tr>';
				}

				oci_free_statement($stid1);
				oci_close($conn);

			}
		?>
		</table>
		</div>
	</body>
</html>
