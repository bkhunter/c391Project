<?php
include("PHPconnectionDB.php");


session_start();



if (isset($_POST['id'])){


	//echo $_POST['id'];


    $sql  = 'insert into subscriptions
            values (\''.$_POST['id'].'\' , \''.$_SESSION['person_id'].'\')';

	$conn = connect();
	$stid = oci_parse($conn, $sql);
	$res = oci_execute($stid);
	

    if(!$res){

        $message = "there was an error subscribing.";
        echo $message;


    } 


}





?>
