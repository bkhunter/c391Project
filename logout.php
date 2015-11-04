<?php
		
		session_start();
		$_SESSION['validate'] = '<center><font color="#DF88FD">Please log in</font></center>';
		header('Location: OOS.php', true, 301);
		exit();

?>