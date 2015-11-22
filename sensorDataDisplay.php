<?php
include("PHPconnectionDB.php");

session_start();
?>
<html>
	<head>

		<title>
		
			Sensor Data 

		</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	</head>


	<body>

	<div>
	
	<div class='container'>
	<h1>Ocean Observation System
    	<small> Search Sensor Data</small>
    </h1>
	<?php


		$data;
		//$conn = connect();
		if($_POST['keyWordSearch']!=''){
			
			$data['keywords'] = preg_split('/(\s)+|,/m', $_POST['keyWordSearch']);

		} 
		
		if($_POST['locationSearch']!=''){
				
			$data['location'] = $_POST['locationSearch'];


			

		}

		if($_POST['FromSearch']!=''){
			$data['FromSearch']=$_POST['FromSearch'];
			$data['UntilSearch']=$_POST['UntilSearch'];
	
			

		}


		if(isset($_POST['dataTypeA'])){
			getAudioData($data);

			
		}//if audioRecordings

		if(isset($_POST['dataTypeI'])){
			getImageData($data);

		}//end if images

		if(isset($_POST['dataTypeS'])){

			getScalarData($data);
		

		}//end if scalardata
		


		if(!isset($_POST['dataTypeA']) && !isset($_POST['dataTypeI']) && !isset($_POST['dataTypeS'])){

			getAudioData($data);
			getImageData($data);
			getScalarData($data);
			

		}


function getAudioData($data){

	$sqlA = 'select audio_recordings.recording_id ,audio_recordings.sensor_id ,audio_recordings.date_created ,audio_recordings.length, audio_recordings.description, 			audio_recordings.recorded_data , sensors.location
		from audio_recordings, subscriptions, sensors	
		where subscriptions.person_id = 1
		and subscriptions.sensor_id = sensors.sensor_id
		and audio_recordings.sensor_id = subscriptions.sensor_id ';
		
	if($data['location']!=''){

		$sqlA = $sqlA .'and sensors.location = \''.$data['location'].'\' ';

	}


	if(sizeof($data['keywords'])>0){
		//check all keywords
		foreach($data['keywords'] as  $keyword){
			$sqlA = $sqlA .'and audio_recordings.description LIKE \'%'.$keyword.'%\' ';		

		}

	}

	if($data['FromSearch']!=''){

		$formattedFromDate = explode('/', $data['FromSearch']);

		$month = $formattedFromDate[0];
		$day = $formattedFromDate[1];
		$year = $formattedFromDate[2];
		
		$sqlFromDate = $day.'/'.$month.'/'.$year;
		$formattedUntilDate = explode('/', $data['UntilSearch']);
					
		$month = $formatttedUntilDate[0];
		$day = $formattedUntilDate[1];
		$year = $formattedUntilDate[2];
					

		$sqlUntilDate = $day.'/'.$month.'/'.$year;
		echo 'from: '.$sqlFromDate.'<br>';
		echo 'until: '.$sqlUntilDate.'<br>';
		$sqlA = $sqlA . 'and audio_recordings.date_created between TO_DATE(\''.$sqlFromDate.'\' ,\'dd/mm/yyyy\')  and  TO_DATE( \''.$sqlUntilDate.'\',\'dd/mm/yyyy\') ';
	}
	echo $sqlA;
	$conn = connect();
	$parsedAudioData = oci_parse($conn,$sqlA);
	$res = oci_execute($parsedAudioData);
	
	echo '<h3>Audio Recordings</h3>';	
	echo'<table> <thead> <tr> 
	<th> ID </th> <th> SensorID</th> <th>length</th> <th>date</th> <th> Description</th> <th>Download</th> </tr>
	</thead><tbody>';


	while(oci_fetch($parsedAudioData)){
		$audioData['audioID'] = oci_result($parsedAudioData,'RECORDING_ID');
		$audioData['sensorID'] = oci_result($parsedAudioData, 'SENSOR_ID');
		$audioData['length'] = oci_result($parsedAudioData,'LENGTH');
		$audioData['date'] = oci_result($parsedAudioData , 'DATE_CREATED');
		$audioData['description'] = oci_result($parsedAudioData , 'DESCRIPTION');

		echo '<tr><td>'.$audioData['audioID'].'</td><td>'.$audioData['sensorID'].'</td>
		<td>'.$audioData['length'].'</td> <td>'.$audioData['date'].'</td> <td>'.$audioData['description'].'</td>
		<td> <button id = '.$audioData['audioID'].'>Download</button></td></tr>';


	}	

	echo '</table>';




}

function getScalarData($data){
	
		$sqlS = 'select scalar_data.id, scalar_data.sensor_id , scalar_data.date_created, scalar_data.value
		from scalar_data, subscriptions, sensors	
		where subscriptions.person_id = \''.$_SESSION['person_id'].'\'
		and subscriptions.sensor_id =sensors.sensor_id
		and scalar_data.sensor_id = sensors.sensor_id ';
		
			if($data['location']!=''){

					$sqlS = $sqlS .'and sensors.location = \''.$data['location'].'\' ';

			}

			if($data['FromSearch']!=''){

					$formattedFromDate = explode('/', $data['FromSearch']);

					$month = $formattedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];

					$sqlFromDate = $day.'/'.$month.'/'.$year;
					
					$formattedUntilDate = explode('/', $data['UntilSearch']);
					
					$month = $formattedUntilDate[0];
					$day = $formattedUntilDate[1];
					$year = $formattedUntilDate[2];
					

					$sqlUntilDate = $day.'/'.$month.'/'.$year;


					$sqlS = $sqlS . 'and scalar_data.date_created between TO_DATE(\''.$sqlFromDate.'\' ,\'dd/mm/yyyy\')  and  TO_DATE( \''.$sqlUntilDate.'\',\'dd/mm/yyyy\') ';
			}

			$conn = connect();
			$parsedScalarData = oci_parse($conn,$sqlS);
			$res = oci_execute($parsedScalarData);
			echo $sqlS;
			echo '<h3>Scalar Data</h3>';
			echo'<table> <thead> <tr> 
			<th> ID </th> <th> SensorID</th> <th>value</th> <th>date</th><th>Download</th> </tr>
			</thead><tbody>';

			while(oci_fetch($parsedScalarData)){
				$scalarData['ID'] = oci_result($parsedScalarData,'ID');
				$scalarData['sensorID'] = oci_result($parsedScalarData, 'SENSOR_ID');
				$scalarData['value'] = oci_result($parsedScalarData, 'VALUE');
				$scalarData['date'] = oci_result($parsedScalarData,'DATE_CREATED');
				
				echo '<tr><td>'.$scalarData['ID'].'</td><td>'.$scalarData['sensorID'].'</td> 
				<td>'.$scalarData['value'].'</td> <td>'.$scalarData['date'].'</td>
				<td> <button id = '.$scalarData['ID'].'>Download</button></td></tr>';


			}	

	echo '</table>';





}

function getImageData($data){



	$sqlI = 'select images.image_id , images.sensor_id, images.date_created, images.description , images.thumbnail , images.recoreded_data  
	from images, subscriptions, sensors	
	where subscriptions.person_id = \''.$_SESSION['person_id'].'\'
	and subscriptions.sensor_id =sensors.sensor_id
	and images.sensor_id = sensors.sensor_id';
		
	if($data['location']!=''){

		$sqlI = $sqlI .'and sensor_id.location = \''.$data['location'].'\' ';

	}

	if(sizeof($data['keywords'])>0){

		//check all keywords
		foreach($data['keywords'] as  $keyword){

			$sqlI = $sqlI .'and images.description LIKE \'%'.$keyword.'%\' ';		

		}

	}

	if($data['FromSearch']!=''){
					

					$formattedFromDate = explode('/', $data['FromSearch']);

					$month = $formatttedFromDate[0];
					$day = $formattedFromDate[1];
					$year = $formattedFromDate[2];

					$sqlFromDate = $day.'/'.$formattedFromDate[0].'/'.$year;
					
					$formattedUntilDate = explode('/', $data['UntilSearch']);
					
					$month = $formatttedUntilDate[0];
					$day = $formattedUntilDate[1];
					$year = $formattedUntilDate[2];
					

					$sqlUntilDate = $day.'/'.$formattedUntilDate[0].'/'.$year;


					$sqlI = $sqlI . 'and images.date_created between TO_DATE(\''.$sqlFromDate.'\' ,"dd/mm/yyyy")  and  TO_DATE( \''.$sqlUntilDate.'\',"dd/mm/yyyy") ';
	}

	echo $sqlI;
	$conn = connect();
	$parsedImageData = oci_parse($conn,$sqlI);
	$res = oci_execute($parsedImageData);

	echo '<h3> Image Data</h3>';

	echo'<table> <thead> <tr> 
	<th> ID </th> <th> SensorID</th> <th>Thumbnail</th>  <th>Date</th> <th>Description</th> <th>Download</th> </tr>
	</thead><tbody>';

	
	while(oci_fetch($parsedImageData)){

		$imageData['ID'] = oci_result($parsedImageData,'IMAGE_ID');
		$imageData['sensorID'] = oci_result($parsedImageData, 'SENSOR_ID');
		$imageData['thumbnail'] = oci_result($parsedImageData,'THUMBNAIL');
		$imageData['length'] = oci_result($parsedImageData,'LENGTH');
		$imageData['description'] = oci_result($parsedImageData, 'DESCRIPTION');
				
		echo '<tr><td>'.$imageData['ID'].'</td><td>'.$imageData['sensorID'].'</td> <td> <img src="data:image/jpeg;base64, '.$imageData['thumbnail']->load().'">
		<td>'.$imageData['length'].'</td> <td>'.$imageData['value'].'</td> <td>'.$imageData['date'].'</td>
		<td> <button id = '.$imageData['ID'].'>Download</button></td></tr>';


		


	}


}


	?>

	</div>
	</div>

	</body>





</html>

<?php


?>







