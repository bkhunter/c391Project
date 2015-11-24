<?php
include("../PHPconnectionDB.php");

session_start();
?>
<html>
	<head>

		<title>
		
			Sensor Data 

		</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<lin rel='stylesheet' href ='sensorDataDisplay.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	</head>


	<body>

	<div>
	
	<div class='container'>
	<h1>Ocean Observation System
    	<small> Search Sensor Data</small>
    </h1>
    
    <div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
	</div> 
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
	//echo $sqlA;
	$conn = connect();
	$parsedAudioData = oci_parse($conn,$sqlA);
	$res = oci_execute($parsedAudioData);
	
	echo '<h3>Audio Recordings</h3>';	
	echo'<table class =table> <thead> <tr> 
	 <th> SensorID</th> <th>length</th> <th>date</th> <th> Description</th> <th>Download</th> </tr>
	</thead><tbody>';


	while(oci_fetch($parsedAudioData)){
		$audioData['audioID'] = oci_result($parsedAudioData,'RECORDING_ID');
		$audioData['sensorID'] = oci_result($parsedAudioData, 'SENSOR_ID');
		$audioData['audio'] = oci_result($parsedAudioData , 'RECORDED_DATA');
		$audioData['length'] = oci_result($parsedAudioData,'LENGTH');
		$audioData['date'] = oci_result($parsedAudioData , 'DATE_CREATED');
		$audioData['description'] = oci_result($parsedAudioData , 'DESCRIPTION');

		$a = $audioData['audio']->load();
		file_put_contents('tempAudio'.$audioData['audioID'].'.wav' , $a);



		echo '<tr><td>'.$audioData['sensorID'].'</td>
		<td>'.$audioData['length'].'</td> <td>'.$audioData['date'].'</td> <td>'.$audioData['description'].'</td>
		<td> <button class=downloadAudio id = '.$audioData['audioID'].'>Download</button></td></tr>';


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
			//echo $sqlS;
			echo '<h3>Scalar Data</h3>';
			echo'<table class=table> <thead> <tr> 
			<th> SensorID</th> <th>value</th> <th>date</th></tr>
			</thead><tbody>';

			$index = 0;
			while(oci_fetch($parsedScalarData)){


				$scalar['ID'] = oci_result($parsedScalarData,'ID');
				$scalarData[$index]['sensorID'] = oci_result($parsedScalarData, 'SENSOR_ID');
				$scalarData[$index]['value'] = oci_result($parsedScalarData, 'VALUE');
				$scalarData[$index]['date'] = oci_result($parsedScalarData,'DATE_CREATED');


				

				echo '<tr><td>'.$scalarData[$index]['sensorID'].'</td> 
				<td>'.$scalarData[$index]['value'].'</td> <td>'.$scalarData[$index]['date'].'</td>
				</tr>';
				$index = $index + 1;

			}	

	echo '</table>';

	echo '<center><button class=downloadCSV style="width: 200px; height: 50px">Download Scalar Data</button></center><br/><br/><br/>';

			$fp = fopen('scalar_data.csv','w');
				for( $row = 0 ; $row < $index ; $row++){
					fputcsv($fp,$scalarData[$row]);				
					
				}				
			fclose($fp);			




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

	//echo $sqlI;
	$conn = connect();
	$parsedImageData = oci_parse($conn,$sqlI);
	$res = oci_execute($parsedImageData);

	echo '<h3> Image Data</h3>';

	echo'<table class=table> <thead> <tr> 
	<th> SensorID</th> <th>Thumbnail</th>  <th>Date</th> <th>Description</th> <th>Download</th> </tr>
	</thead><tbody>';

	
	while(oci_fetch($parsedImageData)){

		$imageData['ID'] = oci_result($parsedImageData,'IMAGE_ID');
		$imageData['sensorID'] = oci_result($parsedImageData, 'SENSOR_ID');
		$imageData['thumbnail'] = oci_result($parsedImageData,'THUMBNAIL');
		$imageData['image'] = oci_result($parsedImageData,'RECOREDED_DATA');
		$imageData['date'] = oci_result($parsedImageData, 'DATE_CREATED');
		$imageData['description'] = oci_result($parsedImageData, 'DESCRIPTION');
		//echo'sup';
		file_put_contents('tempPic'.$imageData['ID'].'.jpg', base64_decode($imageData['image']->load()));
		///echo'shamwow';

		
				
		echo '<tr><td>'.$imageData['sensorID'].'</td> <td> <img src="data:image/jpeg;base64, '.$imageData['thumbnail']->load().'">
		<td>'.$imageData['date'].'</td><td>'.$imageData['description'].'</td>
		<td><button href=downloadImage.php?id='.$imageData['ID'].' class=downloadImage id = '.$imageData['ID'].'>Download</button></td></tr>';

	

		/*
		image most likely de encode base 64 0.0 idk 
		
		image/audio NOT scalar (need to make file) 

		//this is on the same location as this file
		file_put_contents('some_temp_name_that_we_remove_after.jpg', $imageData['image']->load());
		//this will ask the to download file , and it should not be broken :)  
		header(Location: some_temp_name_that_we_remove_after.jpg,true,301);
		exit();
		*/


		


	}
	
	echo '</table>';

}


	?>

	<script>

	$('.downloadImage').click(function(){

		//http://php.net/manual/en/reserved.variables.get.php
		window.open('downloadImage.php?id='+$(this).attr('id'));

	});

	$('.downloadCSV').click(function(){


		window.open('downloadScalarData.php?id='+$(this).attr('id'));

	});

	$('.downloadAudio').click(function(){


		window.open('downloadAudio.php?id='+$(this).attr('id'));
	});

	</script>


	</div>
	</div>

	</body>





</html>

<?php


?>








