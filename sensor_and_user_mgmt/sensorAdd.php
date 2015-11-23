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

			Create Sensor

		</title>

	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

	<body>
		
		<div class ="page">
		<div class = "page-header">
		<h1 class ="title"> Sensor and User Management </h1>			
		</div>
		
		<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="log out"></center>
		</form>

		<div class="LoginForm container">
	
			<h1>Create a Sensor</h1>
			<form name= "Create Sensor" method="post" action="sensorAddSubmit.php"> 
				Location<input type="text" name="location"/> <br/>
				ID<input type="text" name="ID"/> <br/>
				Sensor Type<input type="text" name="sensor_type"/> <br/>
				Description<textarea name="description" rows="5" cols="35"></textarea>
				<input type="submit" name="create"value="Create!"/>
			</form>

		</div>	

		<div class="LoginForm container">
				<form name= "Back" method="post" action="sensorModule.php"> 
						<input type="submit" name="Return"value="Return To Menu"/>
				</form>
		</div>	

	</body>

</html>
