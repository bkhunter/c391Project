


<?php
include("PHPconnectionDB.php");


session_start();



if (isset($_POST['id'])){


    echo $_POST['id'];

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
