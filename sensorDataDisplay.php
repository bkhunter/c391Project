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

	<?php


		$sql = 'select *
						from users, subscriptions, images, scalar_data, audio_recordings,sensors
						where users.person_id = \''.$_SESSION['person_id'].'\'
						and users.person_id = subscriptions.person_id
						and sensors.sensor_id = subscriptions.sensor_id
						and images.sensor_id = subscriptions.sensor_id
						and scalar_data.sensor_id = subscriptions.sensor_id
						and audio_recordings.sensor_id = subscriptions.sensor_id';

		$conn=connect();

		if($_POST["keyWordSearch"]!=''){

			$sql = $sql . ' and images.description LIKE \''.$_POST['keyWordSearch'].'\'
		  and audio_recordings.description LIKE \''.$_POST['keyWordSearch'].'\'';

		}
	
		if($_POST["locationSearch"]!=''){
			$sql = $sql . ' and sensors.location = \''.$_POST['locationSearch'].'\'';


		}

		if($_POST["personType"]!=''){
			$sql = $sql . 'and users.role = \''.$_POST["personType"].'\'';


		}


		if($_POST["FromSearch"]!="" && $_POST["UntilSearch"]!=''){
			//echo'why am i checking dates?';
			$sql = $sql. ' and images.date_created >= \''.$_POST['FromSearch'].'\' and images.date_created <=\''.$_POST['UntilSearch'].'\'
										and audio_recordings.date_created >= \''.$_POST['FromSearch'].'\' and audio_recordings.date_created <=\''.$_POST['UntilSearch'].'\'
										and scalar_data.date_created >= \''.$_POST['FromSearch'].'\' and scalar_data.date_created<= \''.$_POST['UntilSearch'].'\''; 

		}


		if($_POST["FromSearch"]!='' && $_POST["UntilSearch"]==''){
				
			$sql = $sql. ' and images.date_created >= \''.$_POST['FromSearch'].'\'
										and audio_recordings.date_created >= \''.$_POST['FromSearch'].'\'
										and scalar_data.date_created >= \''.$_POST['FromSearch'].'\''; 


		}


		if($_POST["UntilSearch"]!='' && $_POST['FromSearch']==''){

			$sql = $sql. ' and images.date_created <=\''.$_POST['UntilSearch'].'\'
										and audio_recordings.date_created <=\''.$_POST['UntilSearch'].'\'
									  and scalar_data.date_created<= \''.$_POST['UntilSearch'].'\''; 


		}



		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
    echo $sql;
    echo '<br/>';
    echo "do i come here?";
    echo '<br/>';
	  while(oci_fetch($stid)){
      echo 'yes<br/>';
			echo "sup";
			


		}


	?>

	


	</body>





</html>
