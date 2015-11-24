<html>

<body>
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
    'text/csv'
);

if ( !in_array( $_FILES['batch']['type'], $mimetypes ) ){
?>

<form name = "logout" method="post"  action="../OOSLogin.php"> 
	<h2 class ="main page"> </h2>
	<center><input type="submit" name="validate" value="  main page  "></center>
</form>



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

//$rows = explode("\n", $image);
$rows = str_getcsv($image, "\n"); //parse the rows 

$e = 0;
$conn = connect(); 




$stmt = oci_parse($conn, "select * from idtracker");
oci_execute($stmt);
oci_fetch($stmt);
$id = oci_result($stmt, 'SCALAR_ID');

//used for seeing in a tuple can be added 
$check = 1;
foreach($rows as $myrow) {	
	$row = str_getcsv($myrow, ",");
	$stmt = oci_parse($conn, "insert into scalar_data values (".$id.",".$row[0].", TO_DATE('".$row[1]."', 'DD/MM/YYYY HH24:MI:SS'),".$row[2].")");
	$id += 1;
	$e += 1;
	if (!@oci_execute($stmt, OCI_NO_AUTO_COMMIT)){
		echo "<center>No scalars uploaded. Couldn't upload on scalar ".$e."</center><br/>";
		$check = 0;
		break;
	}


}
if($check == 1){
	oci_commit($conn);
	$stmt = oci_parse($conn, "update idtracker SET SCALAR_ID=".$id."WHERE colid=0");
	oci_execute($stmt);
	oci_commit($conn);
	/* //get data and time!
	$stmt = oci_parse($conn, "select TO_CHAR(date_created, 'DD/MM/YYYY HH24:MI:SS') as A from scalar_data");
	oci_execute($stmt);
	oci_fetch($stmt);
	echo oci_result($stmt, 'A');
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
