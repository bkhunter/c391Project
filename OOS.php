<!DOCTYPE HTML>

<html>
	<head>

	<title>

		Ocean Observation System
	</title>


	</head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
	integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" 
	crossorigin="anonymous">
	<link rel ="stylesheet" type ="text/css" href="login.css">
	<body>
		<div class ="page">
		<div class = "page-header">
		
		<h1 class ="title"> Ocean Observation System</h1>		
		</div>
		
		<?php
		session_start();
		if($_SESSION['validate'] != 'true') {
			echo $_SESSION['validate']; 
		}
		if($_SESSION['login']   == 'true'){
			header('Location: OOSLogin.php', true, 301);
			exit();
		}
		session_destroy();
		?>
		
		 <div align="right">
			<form name = "login" method="post"  action="help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
		</div> 

		<div class="loginForm container">


		
			
		<form name = "login" method="post"  action="OOSLogin.php"> 
					<h2 class ="loginHeader"> Login </h2>
					Username: <input type="text" name ="username"><br>
					Password: <input type = "password" name = "pass"><br>
					<input type="submit" name="validate" value="Login">
		</form>
		</div>
		</div>
	</body>


</html>
