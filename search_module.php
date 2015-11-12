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




	<div class ='col-sm-3'></div>
	<div class = "col-sm-6">
		
		<form name = 'search' class="searchForm">

				<h2>Search subscribed Sensors</h2>
				<input type="text" name ="searchBar"><br>
				<input type ="submit" name = "searchSubmit">


		</form>



	</div>



</div>




<?php


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
