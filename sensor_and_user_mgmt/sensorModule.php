<html>

  <?php
  		session_start();
  		if($_SESSION['login'] != 'true') {
			header('Location: ../OOS.php', true, 301);
			exit();	
		}
	?>

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

		<form name = "add account" method="post"  action="uAccountAdd.php"> 
					<h2 class ="loginHeader"> Manage User Accounts </h2>
					<input type="submit" value="Add User Account">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "update account" method="post"  action="uAccountUpdate.php"> 
					<input type="submit" value="Update User Account">
	
		</form>
		</div>
		
		<div class="LoginForm container">

		<form name = "remove account" method="post"  action="uAccountRemove.php"> 
					<input type="submit" value="Remove User Account">
	
		</form>
		</div>


		<div class="LoginForm container">

		<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> Exit </h2>
					<input type="submit" name="validate" value="Log Out"></center>
		</form>
		</div>


		<div class="LoginForm container">

		<form name = "Main" method="post"  action="../logout.php"> 
					<input type="submit" name="validate" value="Main Menu"></center>
		</form>
		</div>
		
		</div>
	</body>


</html>
