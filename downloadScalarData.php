<?php

	include("PHPconnectionDB.php");

	session_start();
	echo'plz';
	echo 'hi: '.$_GET['id'];
	if(isset($_GET['id'])){


		$file = 'scalar_data'.$_GET['ID'].'.csv';


	
		//http://stackoverflow.com/questions/12094080/download-files-from-server-php
		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$file);
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
		ob_clean();
        flush();
		readfile($file);		

		exit();
	}





?>
