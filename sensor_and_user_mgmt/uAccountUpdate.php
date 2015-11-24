<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- dropdown list functionality created with help of the following sources
-http://stackoverflow.com/questions/12293939/select-dropdown-default-value
-http://stackoverflow.com/questions/9870838/how-to-submit-a-select-menu-without-a-submit-button
-http://stackoverflow.com/questions/18884713/dynamic-drop-down-list-using-html-and-php
-http://stackoverflow.com/questions/14652144/how-to-change-content-depending-on-a-select
-http://www.html-form-guide.com/php-form/php-form-select.html
-->

<!-- The user is able to update or remove a user account after searching here -->
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
			Update User Account
		</title>
	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

	<body>
		<!-- define navigation options -->
		<div class ="page">
			<div class = "page-header">
				<h1 class ="title"> Sensor and User Management </h1>			
			</div>
		
			<div align="right">
				<form name = "login" method="post"  action="../help.html"> 
						<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
				</form>
			</div> 
				
			<form name = "logout" method="post"  action="../logout.php"> 
						<h2 class ="logout"> </h2>
						<center><input type="submit" name="validate" value="log out"></center>
			</form>


			<?php 
				// in case the user selected a criteria, and this form has been re-submitted
				if(isset($_POST['criteria'])){
					
					$choice = $_POST['criteria'];
			?> 
					<!-- drop down list for re-search-->
					<div class="LoginForm container">
						<h2 class ="LoginHeader"> Select Search Criteria </h2>
							<form method="post" >
								<!-- this.form.submit is javascript, see resources for reference-->
								<select id = 'id' name="criteria" onchange = "this.form.submit()";>
								  	<option value="">Select...</option>
								  	<option value="usrID">User ID</option>
								  	<option value="email">User Email</option>
									<option value="usrName">Username</option>
								</select>
							</form>
					</div>	

					<?php	
						// display appropriate field for user ID search and back button
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
						 // display appropriate field for email search and back button
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
						 // display appropriate field for username search and back button
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
				//If the form has not been re-submitted, present as default
				} else {
			?>
				<!-- dropdown list -->
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
		</div>
	</body>
</html>
