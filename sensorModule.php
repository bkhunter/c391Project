<html>
	<head>

	<title>

		Sensor and User Management
	</title>


	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">
	
	<body>

		<div class ="page">
		<div class = "page-header">
		<h1 class ="title"> Sensor and User Management</h1>			
		</div>
		

		<div class="LoginForm container">

		<form name = "create sensors" method="post"  action="sensorAdd.php"> 
					<h2 class ="LoginHeader"> Manage Sensors </h2>
					<input type="submit" value="Create Sensors">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "remove sensors" method="post"  action="sensorRemove.php"> 
					<input type="submit" value="Remove Sensors">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "add account" method="post"  action="sensorAdd.php"> 
					<h2 class ="loginHeader"> Manage User Accounts </h2>
					<input type="submit" value="Add User Account">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "update account" method="post"  action="sensorAdd.php"> 
					<input type="submit" value="Update User Account">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "remove account" method="post"  action="sensorAdd.php"> 
					<input type="submit" value="Remove User Account">
	
		</form>
		</div>
		
		</div>
	</body>


</html>
