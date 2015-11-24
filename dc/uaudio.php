
<html>

	<body>
	//help button
	<div align="right">
				<form name = "login" method="post"  action="../help.html"> 
						<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
				</form>
	</div> 
	
	<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	
	include("../PHPconnectionDB.php");
	
	
	session_start();
	
	//data curator
	if ($_SESSION['role'] != 'd') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
	}
	
	
	$mimetypes = array(
	    'audio/wav',
	    'audio/x-wav',
	    'audio/wave',
	    'audio/vnd.wave'
	);
	//check if a wav file types
	if ( !in_array( $_FILES['audio']['type'], $mimetypes )  ){
	?>
		//form for uploading a wav file
		//tables are formating form 
		<form name = "logout" method="post"  action="../OOSLogin.php"> 
			<h2 class ="main page"> </h2>
			<center><input type="submit" name="validate" value="  main page  "></center>
		</form>
		
		
		<table align="center" >
		
		<form method="post" enctype="multipart/form-data">
			<tr>
				<td>
				Sensor Id: </td><td><input type="text" name ="sid">
				</td>
			</tr>
			<tr>
				<td>
				Description: </td><td><input type="text" name ="des">
				</td>
			</tr>
			<tr>
				<td>
				Audio length: </td><td><input type="number" name ="len" min="0" value="0">
				</td>
				<td>seconds</td>
			</tr>
		</table>
		<table align="center">
				<tr>
					<td> <input type="submit" name="submit" value="Upload" />
					Your Audio (.wav only with a max size is 1mb): <input type="file" name="audio" /></td>
				</tr>
				<tr>
					<td> <input type="reset" value="Reset" > </td>
				</tr>
			</form>
			
		</table>
	
	<?php
	} else {
		//file is being uploaded!
		
		//get the file
		$image = addslashes($_FILES['audio']['tmp_name']);
		$name  = addslashes($_FILES['audio']['name']);
		$image = file_get_contents($image);
		
		
		$conn = connect(); 
		
		//get the id of where to save file 
		$stmt = oci_parse($conn, "select * from idtracker");
		oci_execute($stmt);
		oci_fetch($stmt);
		$id = oci_result($stmt, 'AUDIO_ID');
		
		//found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php 
		$lob  = oci_new_descriptor($conn, OCI_D_LOB);

		$stmt = oci_parse($conn, "insert into audio_recordings (recording_id, sensor_id,date_created,
							length,description,recorded_data)
		               values (".$id.", ".$_POST['sid'].",to_date( TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ),".$_POST['len'].",'".$_POST['des']."', EMPTY_BLOB()) 
		               returning recorded_data into :recoreded_data");
		               
		//id value need be increased by 1 since we just used current id 		
		$id += 1;
		   
		oci_bind_by_name($stmt, ':recoreded_data', $lob, -1,  OCI_B_BLOB);
		@oci_execute($stmt, OCI_NO_AUTO_COMMIT);
		
		if (@$lob->save($image)){
			//save was able 
			oci_commit($conn);
			//update idtracker for audio_id 
			$stmt = oci_parse($conn, "update idtracker SET AUDIO_ID=".$id."WHERE colid=0");
			oci_execute($stmt);
			oci_commit($conn);
			echo "<center>Audio successfully uploaded</center><br/>";
		}else{
			//error msg
			echo "<table align='center'>
					<tr><td>Couldn't upload audio. </td></tr>
					<tr><td>Please check you have correct sensor id.</td></tr>
					</table><br/>";
		}
		//continue button
		echo '<center><form method="post">
					<input type="submit" name="submit" value="continue" />
					</form></center>';
		
		//free space used to make such a save 
		$lob->free();
		oci_free_statement($stmt);
		oci_close($conn);
		
		
	}
	
	
	
	
	?>
	
	</body>
	 
</html>
