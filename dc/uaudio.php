
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

if ( !in_array( $_FILES['audio']['type'], $mimetypes ) ){
?>

<table align="center">

<form method="post" enctype="multipart/form-data">
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
$lob  = oci_new_descriptor($conn, OCI_D_LOB);
//in dev 
$stmt = oci_parse($conn, "insert into audio_recordings (recording_id, sensor_id,date_created,
					length,description,recorded_data)
               values (1, 101,SYSDATE,1,'ayylmaoz', EMPTY_BLOB()) 
               returning recorded_data into :recoreded_data");

   
oci_bind_by_name($stmt, ':recoreded_data', $lob, -1,  OCI_B_BLOB);
@oci_execute($stmt, OCI_NO_AUTO_COMMIT);

if (@$lob->save($image)){
	oci_commit($conn);
	echo "<center>Blob successfully uploaded</center><br/>";
}else{
	echo "<center>Couldn't upload Blob</center><br/>";
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
