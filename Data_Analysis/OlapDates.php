<?php
include("../PHPconnectionDB.php");
?>
<html>
	 <?php
  		ini_set('session.cache_limiter','public');
		session_cache_limiter(false);
		
  		session_start();
		//check account type 
		if ($_SESSION['role'] != 's') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
		}
	?>
	<head>
		<style>
			
			table#Day {
				
				background-color: gray;
				border: 3px solid black;
				text-align:left;
				width: 100%
			}

			ul#disp {
				list-style-type: none;
				text-align: left;
				border: 1px solid black;
				background-color: black;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
				list-style-position:inside;
				text-align:left;
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
			// only display if week selected
			if (isset($_GET['week'])) {
				$week = $_GET['week']; 
				$month = $_GET['month'];  
				$quarter = $_GET['quarter']; 	 
				$year = $_GET['year'];
				$sid = $_GET['sid']; 

				//get week date range 
				$datet = new DateTime();
				$datef = new DateTime();
				$dateFIR = "{$year}-01-01";

				//http://stackoverflow.com/questions/25906836/how-to-get-the-first-day-of-the-current-year
				$first = date('l',strtotime(date($dateFIR)));

				// use same logic as in OlapWeekl.php to determine whether to increment or not
				if (($first == 'Friday') || ($first == 'Saturday')) {

					$datet->setISODate($year, $week, 0);
					$datef->setISODate($year, $week, 6);

				} else {
					$datet->setISODate($year, $week+1, 0);
					$datef->setISODate($year, $week+1, 6);
				}

				// start and end dates
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
			
				<div align="right">
					<form name = "login" method="post"  action="../help.html"> 
							<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
					</form>
				</div> 

				<!-- back button from http://www.computerhope.com/issues/ch000317.htm -->
				<div class="container">
					<form> 
						<input type="button" name="back" value="Roll Up" onClick="history.go(-1);return true;"/>
					</form>
				</div>	

				<div class="container">
					<form action= "../OOSLogin.php"> 
						<input type="submit" name="back" value="Exit"/>
					</form>
				</div>	

				<!-- constuct table to be filled with php echos -->
				<div class="container">
					<h4> ID : <?php echo $sid ?> </h4>  
					<h4>  Location : <?php echo $loc ?> </h4>
					<h4>  Year : <?php echo $year ?> </h4>
					<h4>  Quarter : <?php echo $quarter ?> </h4>
					<h4>  Month : <?php echo $monthName ?> </h4>
					<h4>  Week : <?php echo $start ?> to <?php echo $end?> </h4>
					<table id = "Day" border = "1">
						<th> Day </th>
						<th> Sum </th>
						<th> Min </th>
						<th> Max </th>

					<?php
						//drill down to days
						$dayRes = 'SELECT extract(day from date_created), SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
						FROM	'.$tableName.' f
						WHERE	f.sensor_id = \''.$sid.'\' and extract(year from date_created) = \''.$year.'\' and extract(month from date_created) = \''.$month.'\' and f.week = \''.$week.'\'
						GROUP BY extract(day from date_created)';


						//prepare
						$stid1 = oci_parse($conn,$dayRes);
						//execute
						$res = oci_execute($stid1);

						$i = 0;
						while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
							echo '<tr>';
							foreach($row as $item) {
								if ($i%4 == 0) {
			
									//format date 
									//http://php.net/manual/en/class.datetime.php
									//http://php.net/manual/en/function.date.php

									$timeStr = "{$month}/{$item}/{$year}";
									$datetime = DateTime::createFromFormat('m/d/Y', $timeStr);
									$timeStr = $datetime->format('D, Y-M-d');

									echo "<td>"; 
									echo "<ul id='disp'>";
									echo "<li> $timeStr </li>";
									//echo "<li><a href='OlapWeekly.php?sid=$sid&year=$year&quarter=$quarter&month=$month&$quarter=$item'>" .$item. "</a><li>";							
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
