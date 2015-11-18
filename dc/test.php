<html>

<?php
unlink('test.wav');
include("../PHPconnectionDB.php");
include("download.php");
if(!isset($_POST['downloaded'])) {
?>

<form name = "download" method="post"  > 
	<center><input type="submit" name="downloaded" value="download"></center>
</form>

<?php
} else{

$conn = connect(); 
$file = download($conn,'audio',1);
$file2 = file_put_contents('test.wav', $file);
header('Location: test.wav', true, 301);


/*
if (file_exists('test.wav')) {
    header('Content-Description: File Transfer');
    header('Content-Type: audio/x-wav');
    header('Content-Disposition: attachment; filename="'.basename('test.wav').'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('test.wav'));
    readfile('test.wav');
}
*/

}

?>

</html>
