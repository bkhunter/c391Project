<html>

<body>
<?php
include("../PHPconnectionDB.php");

session_start();

//data curator
if ($_SESSION['role'] != 'd') {
		header('Location: ../OOSLogin.php', true, 301);
		exit();	
}


if (!$_FILES['photo']['name']){
?>

<form method="post" enctype="multipart/form-data">
	Your Photo: <input type="file" name="photo" size="25" /><br/>
	<input type="submit" name="submit" value="Upload" /> <input type="reset" value="Reset" >
</form>

<?php
} else {

$sImage = "data: image/jpeg ;base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
echo '<img src="' . $sImage . '" alt="Your Image" />';


$image = addslashes($_FILES['photo']['tmp_name']);
$name  = addslashes($_FILES['photo']['name']);
$image = file_get_contents($image);
$image = base64_encode($image);


$conn = connect(); 
$lob  = oci_new_descriptor($conn, OCI_D_LOB);
$stmt = oci_parse($conn, "insert into images (image_id, sensor_id,date_created,description,thumbnail,recoreded_data)
               values (1, 101,SYSDATE,'ayylmaoz',EMPTY_BLOB(), EMPTY_BLOB()) 
               returning recoreded_data into :recoreded_data");

   
oci_bind_by_name($stmt, ':recoreded_data', $lob, -1,  OCI_B_BLOB);
oci_execute($stmt, OCI_NO_AUTO_COMMIT);

if ($lob->save($image)){
	oci_commit($conn);
	echo "Blob successfully uploaded\n";
}else{
	echo "Couldn't upload Blob\n";
}
$lob->free();
oci_free_statement($stmt);
oci_close($conn);

}




?>

</body>

</html>
