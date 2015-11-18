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

if (!$_FILES['photo']['name'] || ($_FILES['photo']['type'] != 'image/jpeg') ){
?>


<table align="center">

<form method="post" enctype="multipart/form-data">
	<tr>
		<td>
		Sensor Id: <input type="text" name ="sid">
		</td>
	</tr>
	<tr>
		<td> <input type="submit" name="submit" value="Upload" />
		Your Photo: (jpeg only)<input type="file" name="photo" size="25" /></td>
	</tr>
	<tr>
		<td> <input type="reset" value="Reset" > </td>
	</tr>
</form>

</table>

<?php
} else {

$image = addslashes($_FILES['photo']['tmp_name']);
$name  = addslashes($_FILES['photo']['name']);
$image = file_get_contents($image);
$image = base64_encode($image);


$conn = connect(); 

$stmt = oci_parse($conn, "select * from idtracker");
oci_execute($stmt);
oci_fetch($stmt);
$id = oci_result($stmt, 'IMAGE_ID');

//found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php 
$lob  = oci_new_descriptor($conn, OCI_D_LOB);
$lob1  = oci_new_descriptor($conn, OCI_D_LOB);
$stmt = oci_parse($conn, "insert into images (image_id, sensor_id,date_created,description,thumbnail,recoreded_data)
               values (".$id.", ".$_POST['sid'].",SYSDATE,'ayylmaoz',EMPTY_BLOB(), EMPTY_BLOB()) 
               returning thumbnail, recoreded_data into :thumbnail, :recoreded_data");
$id += 1;

oci_bind_by_name($stmt, ':thumbnail', $lob, -1,  OCI_B_BLOB);   
oci_bind_by_name($stmt, ':recoreded_data', $lob1, -1,  OCI_B_BLOB);
@oci_execute($stmt, OCI_NO_AUTO_COMMIT);

if (@$lob1->save($image)){
	oci_commit($conn);
	//update idtracker for image_id 
	$stmt = oci_parse($conn, "update idtracker SET IMAGE_ID=".$id."WHERE colid=0");
	oci_execute($stmt);
	oci_commit($conn);
	echo "<center>Image successfully uploaded!</center><br/>";
}else{
	echo "<table align='center'>
			<tr><td>Couldn't upload image. </td></tr>
			<tr><td>Please check you have correct sensor id.</td></tr>
			</table><br/>";
}
echo '<center><form method="post">
			<input type="submit" name="submit" value="continue" />
			</form></center>';
$lob->free();
oci_free_statement($stmt);
oci_close($conn);

/* example of how to get images from database 
$image = download($conn,'image',1);
echo '<img height="300" width="300" src="data:image/jpeg;base64, '.$image.'" >';	
oci_close($conn);
*/

}




?>

</body>

</html>
