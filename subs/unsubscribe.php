


<?php
include("../PHPconnectionDB.php");


session_start();


//make sure the user is a scientist
//only scientists can subscribe to sensors
if($_SESSION['role'] != 's'){
			
		header('Location: ../OOSLogin.php', true, 301);
		exit();	
		
}


if (isset($_POST['id'])){


	//remove the sensor 
	//with the same id of the id that was posted
	//by subscribe_module.php

	$sql  = 'delete from subscriptions
			where subscriptions.sensor_id =\''.$_POST['id'].'\'
			and subscriptions.person_id = \''.$_SESSION['person_id'].'\'';

	$conn = connect();
	$stid = oci_parse($conn, $sql);
	$res = oci_execute($stid);
	

    if(!$res){

        $message = "there was an error unsubscribing ";
        echo $message;


    }


}





?>
