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
			if(isset($_POST['submit'])) {

				$timeT = $_POST['to'];
				$timeF = $_POST['from'];

				$DateTimeT = DateTime::createFromFormat('Y-m-d', $timeT);
				$formattedDateT = $DateTimeT->format('F dS Y');
				$DayT = $DateTimeT->format('d');
				$MonthT = $DateTimeT->format('m');
				$YearT = $DateTimeT->format('Y');
				
				$DateTimeF = DateTime::createFromFormat('Y-m-d', $timeF);
				$formattedDateF = $DateTimeF->format('F dS Y');
				$DayF = $DateTimeF->format('d');
				$MonthF = $DateTimeF->format('m');
				$YearF = $DateTimeF->format('Y');
			}

		?>
		<div class="container">
				<h2 class ="LoginHeader"> Range: </h2>
				<h4> <?php echo $formattedDateF ?> </h4>
				<h4>      To     </h4>
				<h4> <?php echo $formattedDateT ?></h4>
		</div>	

		<div class="container">
				<h2 class ="LoginHeader"> Select Parameters </h2>
		</div>	

		<div class = "container">
		  <form method="post" action="OlapDefault.php">

			  <div class="checkbox">
				<label><input type="checkbox" name="loc" value="">Location</label>
			  </div>

			  <div class="checkbox">
				<label><input type="checkbox" name="sID" value="">Sensor ID</label>
			  </div>

		  	  <select id = 'id' name="time">
			  	  <option value="none">All Time</option>
			  	  <option value="day">Daily</option>
				  <option value="week">Weekly</option>
				  <option value="month">Monthly</option>
				  <option value="quarter">Quarterly</option>
				  <option value="year">Yearly</option>
			  </select>
			  	<input type="submit" name = "submit" value="Submit">
		  </form>
		</div>


