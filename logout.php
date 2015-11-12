<?php
		
		session_start();
		/*
		$_SESSION['validate'] != 'true' is checked in OOS.php 
		if it's true than an account is valid 
		but if it is not true echo the msg and destroy session thus logging out the user. 
		*/
		$_SESSION['validate'] = '<center><font color="#DF88FD">Please log in</font></center>';
		header('Location: OOS.php', true, 301);
		exit();

?>