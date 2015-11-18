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

foreach($rows as $row => $data)
{
	$stmt = oci_parse($conn, "insert into scalar_data values (1,".$rows[$i].", SYSDATE,".$rows[$i+2].")");
	$i += 3;
}
   

if (oci_execute($stmt, OCI_NO_AUTO_COMMIT)){
	oci_commit($conn);
	echo "<center>Blob successfully uploaded</center><br/>";
	echo '<center><form method="post">
			<input type="submit" name="submit" value="continue" />
			</form></center>';
}else{
	echo "<center>Couldn't upload Blob</center><br/>";
	echo '<center><form method="post">
			<input type="submit" name="submit" value="continue" />
			</form></center>';
}
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
