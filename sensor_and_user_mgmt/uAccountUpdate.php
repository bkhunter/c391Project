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
		
				
		<form name = "logout" method="post"  action="../logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="log out"></center>
		</form>


		<?php 
			if(isset($_POST['criteria'])){
				$choice = $_POST['criteria'];
		?> 
				<div class="LoginForm container">
					<h2 class ="LoginHeader"> Select Search Criteria </h2>
						<form method="post" >
							<select id = 'id' name="criteria" onchange = "this.form.submit()";>
							  	<option value="">Select...</option>
							  	<option value="usrID">User ID</option>
							  	<option value="email">User Email</option>
								<option value="usrName">Username</option>
							</select>
						</form>
				</div>	

				<?php	
					if ($choice == "usrID") {
				?>
						<div class="LoginForm container">
								<form name= "userID_search" method="post" action="uAccountUpdateRes.php"> 
									User ID<input type="text" name="usrID"/> <br/>
									<input type="submit" value="search" name="IDSearch"/>
								</form>
						</div>	

				
						<div class="LoginForm container">
								<form name= "Back" method="post" action="sensorModule.php"> 
										<input type="submit" name="Return"value="Return To Menu"/>
								</form>
						</div>
				<?php
					} else if ($choice == "email") {
				?>

						<div class="LoginForm container">
								<form name= "email_search" method="post" action="uAccountUpdateRes.php"> 
									Email<input type="text" name="email"/> <br/>
									<input type="submit" value="search" name="emailSearch"/>
								</form>
						</div>	

				
						<div class="LoginForm container">
								<form name= "Back" method="post" action="sensorModule.php"> 
										<input type="submit" name="Return"value="Return To Menu"/>
								</form>
						</div>

				<?php
					} else {
				?>
						<div class="LoginForm container">
								<form name= "usrName_search" method="post" action="uAccountUpdateRes.php"> 
									Username<input type="text" name="usrName"/> <br/>
									<input type="submit" value="search" name="usrNameSearch"/>
								</form>
						</div>	

				
						<div class="LoginForm container">
								<form name= "Back" method="post" action="sensorModule.php"> 
										<input type="submit" name="Return"value="Return To Menu"/>
								</form>
						</div>
				<?php
					}
				?>

		<?php
			} else {
		?>
			<div class="LoginForm container">
					<h2 class ="LoginHeader"> Select Search Criteria </h2>
						<form method="post" >
							<select id = 'id' name="criteria" onchange = "this.form.submit()";>
							  	<option value="">Select...</option>
							  	<option value="usrID">User ID</option>
							  	<option value="email">User Email</option>
								<option value="usrName">Username</option>
							</select>
						</form>
			</div>	

			<div class="LoginForm container">
					<form name= "Back" method="post" action="sensorModule.php"> 
							<input type="submit" name="Return"value="Return To Menu"/>
					</form>
			</div>

		
		<?php
			}
		?>
		
	</body>

</html>
