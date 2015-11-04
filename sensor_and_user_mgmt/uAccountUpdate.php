<html>

	<head>

		<title>

			Update User Account

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
	
			<h1>Update Account</h1>
			<form name= "Create Sensor" method="post" action="sensorAddSubmit.php"> 
				User Name<input type="text" value= "ayylmao" name="usrName"/> <br/>
				Password<input type="text" value= "********" name="pwd"/> <br/>
				First Name<input type="text" value= "Bob" name="fName"/> <br/>
				Last Name<input type="text" value= "sichurd" name="lName"/> <br/>
				Address<input type="text" value= "123 Fake Street" name="addr"/> <br/>
				Email Address<input type="text" value="example@aol.online" name="email"/> <br/>
				Phone Number<input type="text" value= "555-5555" name="phone"/> <br/>
				<input type="submit" value="Update" name="create"/>
			</form>

		</div>	

		<div class="LoginForm container">
				<form name= "Back" method="post" action="sensorModule.php"> 
						<input type="submit" name="Return"value="Return To Menu"/>
				</form>
		</div>	

	</body>

</html>
