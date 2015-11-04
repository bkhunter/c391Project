<html>

	<head>

		<title>

			Add User Account

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
	
			<h1>Create Account</h1>
			<form name= "Create Sensor" method="post" action="sensorAddSubmit.php"> 
				User Name<input type="text" name="usrName"/> <br/>
				Password<input type="text" name="pwd"/> <br/>
				First Name<input type="text" name="fName"/> <br/>
				Last Name<input type="text" name="lName"/> <br/>
				Address<input type="text" name="addr"/> <br/>
				Email Address<input type="text" name="email"/> <br/>
				Phone Number<input type="text" name="phone"/> <br/>
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
