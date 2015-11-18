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
    'text/csv'
);

if ( !in_array( $_FILES['batch']['type'], $mimetypes ) ){
?>


<table align="center">

<form method="post" enctype="multipart/form-data">
	<tr>
		<td> <input type="submit" name="submit" value="Upload" />
		Your Batch: (.csv files only)<input type="file" name="batch" size="25" /></td>
	</tr>
	<tr>
		<td> <input type="reset" value="Reset" > </td>
	</tr>
</form>

</table>

<?php
} else {

$image = addslashes($_FILES['batch']['tmp_name']);
$name  = addslashes($_FILES['batch']['name']);
$image = file_get_contents($image);

$rows = explode(",", $image);
$i = 0;
$conn = connect(); 

$rs = sizeof($rows)-3;


$stmt = oci_parse($conn, "select * from idtracker");
oci_execute($stmt);
oci_fetch($stmt);
$id = oci_result($stmt, 'SCALAR_ID');

//used for seeing in a tuple can be added 
$check = 1;
foreach($rows as $row => $data){
	echo $row[$i+2].'<br/>';
	$stmt = oci_parse($conn, "insert into scalar_data values (".$id.",".$rows[$i].", TO_DATE('".$rows[$i+1]."', 'DD/MM/YYYY HH24:MI:SS'),".$rows[$i+2].")");
	$id += 1;
	$i  += 3;
	if (!@oci_execute($stmt, OCI_NO_AUTO_COMMIT)){
		$e = $i / 3;
		echo "<center>Couldn't upload on scalar ".$e."</center><br/>";
		$check = 0;
		break;
	}

	if($i>=$rs) {
		break;
	}
}
if($check == 1){
	oci_commit($conn);
	$stmt = oci_parse($conn, "update idtracker SET SCALAR_ID=".$id."WHERE colid=0");
	oci_execute($stmt);
	oci_commit($conn);
	/*
	$stmt = oci_parse($conn, "select TO_DATE(date_created, 'DD/MM/YYYY HH24:MI:SS') from scalar_data");
	//$stmt = oci_parse($conn, "select date_created from scalar_data");
	oci_execute($stmt);
	oci_fetch($stmt);
	oci_result($stmt, 'date_created');
	*/
	echo "<center>Batch successfully uploaded</center><br/>";
}

echo '<center><form method="post">
			<input type="submit" name="submit" value="continue" />
			</form></center>';


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
