<?php
include("PHPconnectionDB.php");

session_start();
//data curator
if ($_SESSION['role'] != 's') {
		header('Location: OOSLogin.php', true, 301);
		exit();	
}
?>


<html>

<head>

<title>OOS - Search</title>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="searchModule.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>




<body>



	<div class = 'page-header'>

			<h1>Ocean Observation System 
				<small>Search your Sensors</small></h1>

	</div>


	<div class = 'container'>




	<div class ='col-sm-2'></div>
	<div class = "col-sm-8">
		
		<form name = 'Search' class="keyWords" method="post"  action="sensorDataDisplay.php">

				<h2>Search subscribed Sensors</h2>
				Keywords:<br> <input type="text" name ="keyWordSearch"><br>
				<!-- from http://stackoverflow.com/questions/153759/jquery-datepicker-with-text-input-that-doesnt-allow-user-input -->
				From<br> <input type="text" name ="FromSearch"  readonly='true' class='datePick'><br>
				
				Until <br> <input type="text" name = "UntilSearch" readonly='true' class='datePick'><br>
				<script>

				$(function(){
					//from https://jqueryui.com/datepicker
					$(".datePick").datepicker();

				});

				

				</script>
				



				Sensor Location<br> <input type ="text" name = "locationSearch"><br>
				<input type ="checkbox" value ="a" name = "dataTypeA" class='checkbox' checked>Audio Recordings
				<input type="checkbox" value ="i" name ="dataTypeI" class='checkbox'> Images
				<input type="checkbox" value="s" name="dataTypeS" class ="checkbox">Scalar Measurements <br>
				<input type="submit" name="SubmitSearch" value="Submit"><br>
				


		</form>


	</div>



</div>






<?php

/*












*/


//EXAMPLE OF HOW TO CREATE .CSV FILE 
/*
$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);

$fp = fopen('file.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
*/
?>









</body>



</html>
