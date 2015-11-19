
<html>

<body>
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");
include("download.php");


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

if ( !in_array( $_FILES['audio']['type'], $mimetypes )  ){
?>

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

$image = addslashes($_FILES['audio']['tmp_name']);
$name  = addslashes($_FILES['audio']['name']);
$image = file_get_contents($image);


$conn = connect(); 

$stmt = oci_parse($conn, "select * from idtracker");
oci_execute($stmt);
oci_fetch($stmt);
$id = oci_result($stmt, 'AUDIO_ID');

//found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php 
$lob  = oci_new_descriptor($conn, OCI_D_LOB);
//in dev 
$stmt = oci_parse($conn, "insert into audio_recordings (recording_id, sensor_id,date_created,
					length,description,recorded_data)
               values (".$id.", ".$_POST['sid'].",SYSDATE,".$_POST['len'].",'".$_POST['des']."', EMPTY_BLOB()) 
               returning recorded_data into :recoreded_data");
$id += 1;
   
oci_bind_by_name($stmt, ':recoreded_data', $lob, -1,  OCI_B_BLOB);
@oci_execute($stmt, OCI_NO_AUTO_COMMIT);

if (@$lob->save($image)){
	oci_commit($conn);
	//update idtracker for audio_id 
	$stmt = oci_parse($conn, "update idtracker SET AUDIO_ID=".$id."WHERE colid=0");
	oci_execute($stmt);
	oci_commit($conn);
	echo "<center>Audio successfully uploaded</center><br/>";
}else{
	echo "<table align='center'>
			<tr><td>Couldn't upload audio. </td></tr>
			<tr><td>Please check you have correct sensor id.</td></tr>
			</table><br/>";
}

echo '<center><form method="post">
			<input type="submit" name="submit" value="continue" />
			</form></center>';


$lob->free();
oci_free_statement($stmt);
oci_close($conn);

/* testing if can get wav back 
$file = download($conn,'audio',1);
*/

//$file = download($conn,'audio',1);
//file_put_contents('test.wav', $file);



}




?>

</body>

</html>
