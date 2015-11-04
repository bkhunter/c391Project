<html>

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

		<div class="LoginForm container">
	
			<h1>Create a Sensor</h1>
			<form name= "Create Sensor" method="post" action="sensorAddSubmit.php"> 
				Location<input type="text" name="location"/> <br/>
				Sensor Type<input type="text" name="sensor_type"/> <br/>
				Description<input type="text" name="description"/> <br/>
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
