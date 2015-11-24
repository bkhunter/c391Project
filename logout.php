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
		
		
		//on login page have Please login message 
		$_SESSION['validate'] = '<center><font color="#DF88FD">Please log in</font></center>';
		//set the login check to be false since they are logged out 
		$_SESSION['login']   = 'false';

		//from school notes 
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


		//http://php.net/manual/en/function.unlink.php#109971
		array_map('unlink', glob("search/*.jpg"));
		array_map('unlink', glob("search/*.csv"));
		array_map('unlink', glob("search/*.wav"));

		//send user back to login page 
		header('Location: OOS.php', true, 301);
		exit();

?>
