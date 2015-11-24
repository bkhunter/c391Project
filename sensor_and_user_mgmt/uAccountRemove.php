<html>

  <?php
		session_cache_limiter(false);
		session_start();

		//check account type 
		if ($_SESSION['role'] != 'a') {
				header('Location: ../OOSLogin.php', true, 301);
				exit();	
		}
 
  		if($_SESSION['login'] != 'true') {
			header('Location: ../OOS.php', true, 301);
			exit();	
		}
	?>

	<head>

		<title>

			Remove User Account

		</title>

	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

	<body>
		
		<div class ="page">
		<div class = "page-header">
		<h1 class ="title"> Sensor and User Management </h1>			
		</div>
		
		<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
		</div> 
		
				
		<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="log out"></center>
		</form>
		
			<div class="LoginForm container">
				<h1>Search for User Account</h1>
				<form name= "user_search" method="post" action="uAccountUpdateRes.php"> 
					Person Name<input type="text" name="usrName"/> <br/>
					<input type="submit" value="search" name="search"/>
				</form>
			</div>

		<div class="LoginForm container">
				<form name= "Back" method="post" action="sensorModule.php"> 
						<input type="submit" name="Return"value="Return To Menu"/>
				</form>
		</div>	

	</body>

</html>
