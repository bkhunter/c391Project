<?php
include("PHPconnectionDB.php");
?>
<html>
	<head>
		<style>
			
			table#Month {
				
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
			if (isset($_GET['quarter'])) {   
				$quarter = $_GET['quarter']; 	 
				$year = $_GET['year'];
				$sid = $_GET['sid'];
				session_start();
				$tableName = $_SESSION['table'];
			

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
		
			<!-- back button from http://www.computerhope.com/issues/ch000317.htm -->
			<div class="container">
				<form> 
					<input type="button" name="back" value="Roll Up" onClick="history.go(-1);return true;"/>
				</form>
			</div>	

			<div class="container">
				<form action= "../OOS.php"> 
					<input type="submit" name="back" value="Main Menu"/>
				</form>
			</div>	

			<div class="container">
				<h4> ID : <?php echo $sid ?> </h4>  
				<h4>  Location : <?php echo $loc ?> </h4>
				<h4>  Year : <?php echo $year ?> </h4>
				<h4>  Quarter : <?php echo $quarter ?> </h4>
				<table id = "Month" border = "1">
					<th> Month </th>
					<th> Sum </th>
					<th> Min </th>
					<th> Max </th>

			<?php   

				$monthRes = 'SELECT extract(month from date_created), SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
				FROM	'.$tableName.' f
				WHERE	f.sensor_id = \''.$sid.'\' and extract(year from date_created) = \''.$year.'\'and f.quarter =\''.$quarter.'\'
				GROUP BY extract(month from date_created)';

				//prepare
				$stid1 = oci_parse($conn,$monthRes);

				$res = oci_execute($stid1);
				$i = 0;
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					echo '<tr>';
					foreach($row as $item) {
						if ($i%4 == 0) {

							echo "<td>"; 
							echo "<ul id='Times'>";
							$mObj   = DateTime::createFromFormat('!m', $item);
							$monthName = $mObj->format('F');
							echo "<li><a href='OlapWeekly.php?sid=$sid&year=$year&quarter=$quarter&month=$item'>" .$monthName. "</a></li>";
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
