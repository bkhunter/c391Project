<html>
	<head>

	<title>

		Ocean Observation System
	</title>


	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="login.css">
	<body>

		<div class ="page">
		<div class = "page-header">
		<h1 class ="title"> Ocean Observation System</h1>			
		</div>
		

		<div class="loginForm container">


		
			
		<form name = "login" method="post"  action="OOSLogin.php"> <!-- needs to be made, it will connect to database w/ login & pass -->
					<h2 class ="loginHeader"> Login </h2>
					Username: <input type="text" name ="username"><br>
					Password: <input type = "password" name = "password"><br>
					<input type="submit" value="Login">
	
		</form>
		</div>
		</div>
	</body>


</html>
