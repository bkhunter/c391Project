<?php
include("PHPconnectionDB.php");

session_start();

?>


<html>

<head>

<title>OOS - Search</title>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="searchModule.css">

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
				
				From<br> <input type="date" name ="FromSearch"><br>
				
				Until <br> <input type="date" name = "UntilSearch"><br>

				Sensor Location<br> <input type ="text" name = "locationSearch"><br>
				<input type ="radio" value ="s" name = "personType" class='radio' checked>Scientist
				<input type="radio" value ="a" name ="personType" class='radio'> Administator
				<input type="radio" value="d" name="personType" class ="radio">Data Curator <br>
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
