<?php
include("../PHPconnectionDB.php");


session_start();

//make sure the current user is a scientist
if($_SESSION['role'] != 's'){
			
		header('Location: ../OOSLogin.php', true, 301);
		exit();	
		
}


//if an id is passed
if (isset($_POST['id'])){

	
	//subscriptions has two fields
	//person_id and sensor id
	//we receive sensor id posted by
	//subscribe module.php
	//person id is given by the session
	$sql  = 'insert into subscriptions
			values (\''.$_POST['id'].'\' , \''.$_SESSION['person_id'].'\')';

	$conn = connect();
	$stid = oci_parse($conn, $sql);
	$res = oci_execute($stid);
	
	//handle error
    if(!$res){

        $message = "there was an error subscribing.";
        echo $message;


    } 


}





?>
