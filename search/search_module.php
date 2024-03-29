<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");

session_start();
//data curator
if ($_SESSION['role'] != 's') {
		header('Location: ../OOSLogin.php', true, 301);
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
	<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
	</div> 
	<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="  log out  "></center>
	</form>

	<div class = 'container'>




	<div class ='col-sm-2'></div>
	<div class = "col-sm-8">
		
		<form name = 'Search' class="keyWords" method="post"  action="sensorDataDisplay.php">

				<h2>Search subscribed Sensors</h2>
				Keywords:<br> <input type="text" name ="keyWordSearch"><br>
				<!-- from http://stackoverflow.com/questions/153759/jquery-datepicker-with-text-input-that-doesnt-allow-user-input -->
				From<br> <input type="text" name ="FromSearch"  readonly='true' class='datePick' id ='date1'><br>
				
				Until <br> <input type="text" name = "UntilSearch" readonly='true' class='datePick' id='date2'><br>
				<script>

				$(function(){
					//from https://jqueryui.com/datepicker
					$(".datePick").datepicker({

            onSelect:function(date){
                //from http://api.jquery.com/attribute-equals-selector/
               $("input[value='Submit']").prop("disabled",true);
               if($("#date2").val()!='' && $("#date1").val()!=''){

                $("input[value='Submit']").prop("disabled",false);

               }    

            }

          });

				});


					

				</script>



				Sensor Location<br> <input type ="text" name = "locationSearch"><br>
				<input type ="checkbox" value ="a" name = "dataTypeA" class='checkbox' checked>Audio Recordings
				<input type="checkbox" value ="i" name ="dataTypeI" class='checkbox'> Images
				<input type="checkbox" value="s" name="dataTypeS" class ="checkbox">Scalar Measurements <br>
				<input type="submit" name="SubmitSearch" value="Submit" id='submitButton'><br>  	


				<script>
				$(document).ready(function(){


				


				});

				</script>		


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
