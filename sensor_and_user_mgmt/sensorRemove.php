<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- lets user remove sensors by input or search -->

<html>
  <?php
    	ini_set('session.cache_limiter','public');
		session_cache_limiter(false);
  		session_start();

		//check account type 
		if ($_SESSION['role'] != 'a') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
		}
	?>
	<head>
		<title>
			Remove Sensor
		</title>
	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

	<body>
		<div class ="page">

			<div class = "page-header">
				<h1 class ="title"> Sensor and User Management </h1>			
			</div>
		
			<!-- help -->
			<div align="right">
				<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
				</form>
			</div> 
		
			<!-- logout button -->
			<form name = "logout" method="post"  action="../logout.php"> 
				<h2 class ="logout"> </h2>
				<center><input type="submit" name="validate" value="log out"></center>
			</form>
		
			<!-- remove a sensor by id -->
			<div class="LoginForm container">
				<h3>Remove a Sensor</h3>
				<form name= "Remove Sensor" method="post" action="sensorRemoveSubmit.php"> 
					Sensor ID <input type="text" name="sID"/> <br/>
					<input type="submit" name="rmv"value="Remove"/>
				</form>
			</div>
	
			<!-- Search for sensor by id -->
			<div class="LoginForm container">
				<h3> Search </h3>
				<form name= "sensor_ID search" method="post" action="sensorRemoveRes.php"> 
					Sensor ID<input type="text" name="sensID"/> <br/>
					<input type="submit" value="search" name="IDSearch"/>
				</form>
			</div>	
				
			<!-- main menu button -->
			<div class="LoginForm container">
				<form name= "Finish" method="post" action="sensorModule.php"> 
					<input type="submit" name="Return"value="Return To Menu"/>
				</form>
			</div>

		</div>
	</body>
</html>
