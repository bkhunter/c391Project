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
			
			table#Quarter {
				
				background-color: gray;
				border: 3px solid black;
				text-align:left;
				width: 100%;
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
			if (isset($_GET['year'])) {    	 
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

				<!-- begin constructing output table -->
				<div class="container">
					<h4> ID : <?php echo $sid ?> </h4>  
					<h4>  Location : <?php echo $loc ?> </h4>
					<h4>  Year : <?php echo $year ?> </h4>
					<table id = "Quarter" border = "1">
						<th> Quarter </th>
						<th> Sum </th>
						<th> Min </th>
						<th> Max </th>

					<?php   
						//drill down to quarters
						$quarterRes = 'SELECT f.quarter, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
						FROM	'.$tableName.' f
						WHERE	f.sensor_id = \''.$sid.'\' and extract(year from date_created) = \''.$year.'\'
						GROUP BY f.quarter';

						//prepare
						$stid1 = oci_parse($conn,$quarterRes);

						// execute
						$res = oci_execute($stid1);

						$i = 0;
						while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
							echo '<tr>';
							foreach($row as $item) {
								// every 4th item should be a link to drill down with
								if ($i%4 == 0) {

									echo "<td>"; 
									echo "<ul id='Times'>";
									//http://stackoverflow.com/questions/13102351/passing-a-variable-with-href-in-html
									echo "<li><a href='OlapMonthly.php?sid=$sid&year=$year&quarter=$item'>" .$item. "</a></li>";
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
