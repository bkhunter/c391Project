<?php
include("PHPconnectionDB.php");

session_start();

?>


<html>
	<head>

		<title>
		
			Sensor Data 

		</title>


	</head>


	<body>

	<div>
		<h1>Ocean Observation System
    	<small> Search Sensor Data</small>
    </h1>

	<?php


		$data;

		if($_POST['keywordSearch']!=''){

			$data['keywordSearch'] = $_POST['keywordSearch'];
			$data['keywords'] = preg_split("/(\s)|,/g", $data['keywordSearch']);

		} 
		
		if($_POST['locationSearch']!=''){
				
			$data['location'] = $_POST['locationSearch'];
			

		}

		if($_POST[''])


		if(isset($_POST['dataTypeA'])){


				


		}

		if(isset($_POST['dataTypeI'])){



		}

		if(isset($_POST['dataTypeS'])){



		}
		
		

	?>

	
	<div>

	</body>





</html>
