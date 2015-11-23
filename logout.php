<?php
		include("PHPconnectionDB.php");
		
		session_start();
		/*
		$_SESSION['validate'] != 'true' is checked in OOS.php 
		if it's true than an account is valid 
		but if it is not true echo the msg and destroy session thus logging out the user. 
		*/
		$pID = $_SESSION['person_id'];
		$pID = (string)$pID;
		$f = "fact";
		$tableName = "{$f}{$pID}";

		$_SESSION['validate'] = '<center><font color="#DF88FD">Please log in</font></center>';
		$_SESSION['login']   = 'false';

		ini_set('display_errors', 1);
	
		error_reporting(E_ALL);
		
		$conn=connect();
			
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		} 

		// Drop data analysis fact table
		$dropQ = 'drop table '.$tableName.' ';

		//prepare
		$stid = oci_parse($conn, $dropQ );
	
		error_reporting(0);

		//execute
		$res=oci_execute($stid);

		header('Location: OOS.php', true, 301);
		exit();

?>
