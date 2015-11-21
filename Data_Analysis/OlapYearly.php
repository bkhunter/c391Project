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

			table#results {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				width: 88%;
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

		<div class ="page">
			<div class = "page-header">
			<h1 class ="title"> Olap Analysis</h1>			
		</div>
		
		<div class="container">
			<table id = "year" border = "1">
				<th> Year </th>
				<th> Sum </th>
				<th> Max </th>
				<th> Min    </th>

		<?php   	 

			if(isset($_POST['gen'])) {        	
				$sID=$_POST['sID'];

				session_start();
				$pID = $_SESSION['pID'];
				$tableName = $_SESSION['table'];

				$conn=connect();
			
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}

				$yearRes = 'SELECT extract(year from date_created) as YEAR, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
				FROM   fact3 f
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
							echo "<li><a href='OlapMonthly.php'>" .$item. "</a></li>";
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
