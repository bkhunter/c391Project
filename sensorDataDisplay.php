<?php
include("PHPconnectionDB.php");

session_start();

function getAudioData(){

	$sqlA = 'select * from audio_recordings, subscriptions, sensors	
		where subscriptions.person_id = \''.$_SESSION['person_id'].'\'
		and subscriptions.sensor_id =sensors.sensor_id
		and audio_recordings.sensor_id = sensor_id';
		
	if($data['location']!=''){

		$sqlA = $sqlA .'and sensor_id.location = \''.$data['location'].'\'';

	}


	if(sizeof($data['keywords'])>0){

		//check all keywords
		foreach($data['keywords'] as  $keyword){
			$sqlA = $sqlA .'and audio_recordings.description LIKE \''.$keyword.'\'';		

		}

	}

	if($data['FromSearch']!=''){
					
		//$sqlA = $sqlA .'and audio_recordings.date';
		$formattedFromDate = explode('/', $data['FromSearch']);


		$month = $formatttedFromDate[0];
		$day = $formattedFromDate[1];
		$year = $formattedFromDate[2];
		
		$sqlFromDate = $day.$month.$year;
		$formattedFromDate = explode('/', $data['UntilSearch']);
					
		$month = $formatttedFromDate[0];
		$day = $formattedFromDate[1];
		$year = $formattedFromDate[2];
					

		$sqlUntilDate = $day.$month.$year;

		$sqlA = $sqlA . 'and audio_recordings.date_created between \''.$sqlFromDate.'\' and \''.$sqlUntilDate.'\'';
	}

	$parsedAudioData = oci_parse($conn,$sqlA);
	$res = oci_execute($parsedAudioData);
			






}

function getScalarData(){
	
		$sqlS = 'select * from images, subscriptions, sensors	
							where subscriptions.person_id = \''.$_SESSION['person_id'].'\'
							and subscriptions.sensor_id =sensors.sensor_id
							and audio_recordings.sensor_id = sensor_id
							';
		
			if($data['location']!=''){

					$sqlS = $sqlS .'and sensor_id.location = \''.$data['location'].'\'';

			}

			if($data['FromSearch']!=''){
					
					
					//$sqlA = $sqlA .'and audio_recordings.date';

					$formattedFromDate = explode('/', $data['FromSearch']);

					$month = $formatttedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];

					$sqlFromDate = $day.$month.$year;
					
					$formattedFromDate = explode('/', $data['UntilSearch']);
					
					$month = $formatttedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];
					

					$sqlUntilDate = $day.$month.$year;


					$sqlS = $sqlS . 'and audio_recordings.date_created between \''.$sqlFromDate.'\' and \''.$sqlUntilDate.'\'';
			}


			$parsedScalarData = oci_parse($conn,$sqlS);
			$res = oci_execute($parsedScalarData);





}

function getImageData(){



	$sqlI = 'select * from images, subscriptions, sensors	
							where subscriptions.person_id = \''.$_SESSION['person_id'].'\'
							and subscriptions.sensor_id =sensors.sensor_id
							and audio_recordings.sensor_id = sensor_id
							';
		
	if($data['location']!=''){

		$sqlI = $sqlI .'and sensor_id.location = \''.$data['location'].'\'';

	}

	if(sizeof($data['keywords'])>0){

		//check all keywords
		foreach($data['keywords'] as  $keyword){

			$sqlI = $sqlI .'and audio_recordings.description LIKE \''.$keyword.'\'';		

		}

	}

	if($data['FromSearch']!=''){
					
					
					//$sqlA = $sqlA .'and audio_recordings.date';

					$formattedFromDate = explode('/', $data['FromSearch']);

					$month = $formatttedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];

					$sqlFromDate = $day.$month.$year;
					
					$formattedFromDate = explode('/', $data['UntilSearch']);
					
					$month = $formatttedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];
					

					$sqlUntilDate = $day.$month.$year;


					$sqlI = $sqlI . 'and audio_recordings.date_created between \''.$sqlFromDate.'\' and \''.$sqlUntilDate.'\'';
	}

	$parsedImageData = oci_parse($conn,$sqlI);
	$res = oci_execute($parsedImageData);


}

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
		$conn = connect();

		if($_POST['keywordSearch']!=''){

			$data['keywordSearch'] = $_POST['keywordSearch'];
			$data['keywords'] = preg_split("/(\s)|,/g", $data['keywordSearch']);


		} 
		
		if($_POST['locationSearch']!=''){
				
			$data['location'] = $_POST['locationSearch'];


			

		}

		if($_POST['FromSearch']!=''){

			$data['FromSearch']=$_POST['FromSearch'];
			$data['UntilSearch']=$_POST['UntilSearch'];

	
			

		}


		if(isset($_POST['dataTypeA'])){

			getAudioData();

			
		}//if audioRecordings

		if(isset($_POST['dataTypeI'])){
			getImageData();

		}//end if images

		if(isset($_POST['dataTypeS'])){

			getScalarData();
		

		}//end if scalardata
		


		if(!isset($_POST['dataTypeA']) && !isset($_POST['dataTypeI']) && !isset($_POST['dataTypeS'])){

			getAudioData();
			getImageData();
			getScalarData();
			

		}

	//oci_fetch($parsedAudioData)
	//oci_fetch($parsedScalarData)
	//oci_fetch($parsedImageData)
		

	?>

	
	<div>

	</body>





</html>
