<html>

	<head>

		<title>

			Create Sensor

		</title>

	</head>

	<body>
	
		<h1>Create a Sensor</h1>
		<form name= "Create Sensor" method="post" action="sensorSubmit.php"> 
			Location--------<input type="text" name="location"/> <br/>
			Sensor Type--<input type="text" name="sensor_type"/> <br/>
			Description---<input type="text" name="description"/> <br/>
			<input type="submit" name="create"value="Create!"/>
		</form>
				
	<!--tells the web server where the PHP code starts and finishes
	any text between tags is interpreted as php-->
	<?php
		
	?>

	</body>

</html>