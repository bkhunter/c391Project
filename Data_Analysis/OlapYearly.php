<?php
include("PHPconnectionDB.php");
?>
<html>
	<head>
		<style>
			
			table#year {
				
				background-color: gray;
				border: 3px solid black;
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
			if (isset($_GET['sid'])) {  	 
				$sid = $_GET['sid'];
				session_start();
				$pID = $_SESSION['pID'];
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
					<input type="button" name="back" value="Back" onClick="history.go(-1);return true;"/>
				</form>
			</div>	

			<div class="container">
				<form action= "../OOS.php"> 
					<input type="button" name="back" value="Main Menu"/>
				</form>
			</div>	
			
			<div class="container">
				<h4> ID : <?php echo $sid ?> </h4>  
				<h4>  Location : <?php echo $loc ?> </h4>
				<table id = "year" border = "1">
					<th> Year </th>
					<th> Sum </th>
					<th> Min </th>
					<th> Max    </th>

			<?php   	 

				$yearRes = 'SELECT extract(year from date_created) as YEAR, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
				FROM	'.$tableName.' f
				WHERE	f.sensor_id = \''.$sid.'\'	
				GROUP BY extract(year from date_created)';

				//prepare
				$stid1 = oci_parse($conn,$yearRes);

				$res = oci_execute($stid1);
				$i = 0;
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					echo '<tr>';
					foreach($row as $item) {
						if ($i%4 == 0) {

							echo "<td>"; 
							echo "<ul id='Times'>";
							echo "<li><a href='OlapQuarterly.php?sid=$sid&year=$item'>" .$item. "</a></li>";
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
