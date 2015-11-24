<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- after searching for user field, this displays the results and give the options-->

<?php

	include("../PHPconnectionDB.php");
	ini_set('session.cache_limiter','public');

	session_cache_limiter(false);
	session_start();

	//check account type 
	if ($_SESSION['role'] != 'a') {
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
	}
?>

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
		
			<div align="right">
				<form name = "login" method="post"  action="../help.html"> 
						<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
				</form>
			</div> 


			<?php 
			// if they search by user name  	 
			if(isset($_POST['usrNameSearch'])){        	
				$name=$_POST['usrName'];          		
			
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				} 
				
				// query
				$userQ = 'SELECT user_name, password, role, person_id FROM users where user_name = \''.$name.'\'';	
			
				//prepare
				$stid1 = oci_parse($conn, $userQ );
				
				//execute
				$UQres=oci_execute($stid1);
				$index = 0;
				
				// create default array with expected values to store result
				$res = array("usrname","pw","role","id");
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					foreach($row as $item) {
						$res[$index] = $item;
						$index = $index + 1;
					}
				}
	
				// set result to variables
				$pw = $res[1];
				$role = $res[2];
				$id = $res[3];

				// query
				$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE person_id = \''.$id.'\'';	
			
				//prepare
				$stid2 = oci_parse($conn, $personQ );
				
				//execute
				$PQres=oci_execute($stid2);

				$index = 0;
				
				// second array for story results
				$res2 = array("User ID","First Name","Last Name","Address","Email","Phone");
				while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
					foreach($row as $item) {
						$res2[$index] = $item;
						$index = $index + 1;
					}
				}
		
				// these results are set to variables
				$fname = $res2[1];
				$lname = $res2[2];
				$addr = $res2[3];
				$email = $res2[4];
				$phone = $res2[5];



			?>
				<!-- output results!-->
				<div class="LoginForm container">

					<h1>Update Account</h1>
					<form name= "usr_update" method="post" action="uAccountAddSubmit.php"> 
						User Name<input type="text" value= "<?php echo $name ?>" name="usrName"/> <br/>
						ID<input type="text" value= "<?php echo $id ?>" name="ID" readonly/> <br/>
						Role<input type="text" value= "<?php echo $role ?>" name= "role" /> <br/>
						Password<input type="text" value= "<?php echo $pw ?>" name="pwd"/> <br/>
						First Name<input type="text" value= "<?php echo $fname ?>" name="fName"/> <br/>
						Last Name<input type="text" value= "<?php echo $lname ?>" name="lName"/> <br/>
						Address<input type="text" value= "<?php echo $addr ?>" name="addr"/> <br/>
						Email Address<input type="text" value="<?php echo $email ?>" name="email"/> <br/>
						Phone Number<input type="text" value="<?php echo $phone ?>" name="phone"/> <br/>
						<input type="hidden" value= "<?php echo $id ?>" name="key"/>
						<input type="submit" value="Update" name="update"/>
						<input type="submit" value="Remove" name="delete"/>
					</form>

				</div>	
			
				<!-- search for other value -->
				<div class="LoginForm container">
					<h1>New Search</h1>
					<form name= "userName_search" method="post" action="uAccountUpdateRes.php"> 
						 Username<input type="text" value="<?php echo $name ?>" name="usrName"/> <br/>
						<input type="submit" name="usrNameSearch" value = "Search"/>
					</form>

					<form name= "newSearch" method="post" action="uAccountUpdate.php"> 
							<input type="submit" name="back" value="Change Parameter"/>
					</form>
				</div>

				<div class="LoginForm container">
					<form name= "Back" method="post" action="sensorModule.php"> 
							<input type="submit" name="Return"value="Return To Menu"/>
					</form>
				</div>	

		<?php
		// if they search by email - very similar to above
		} else if(isset($_POST['emailSearch'])) { 

				$email=$_POST['email'];  

				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				} 	

				// query
				$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE email = \''.$email.'\'';	
			
				//prepare
				$stid1 = oci_parse($conn, $personQ );
				
				//execute
				$PQres=oci_execute($stid1);

				$index = 0;
				// story values in array
				$res = array("User ID","First Name","Last Name","Address","Email","Phone");
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					foreach($row as $item) {
						$res[$index] = $item;
						$index = $index + 1;
					}
				}
		
				//set array values to variables
				$id = $res[0];
				$fname = $res[1];
				$lname = $res[2];
				$addr = $res[3];
				$phone = $res[5];


				// execute another query
				$userQ = 'SELECT user_name, password, role, person_id FROM users where person_id = \''.$id.'\'';	
			
				//prepare
				$stid2 = oci_parse($conn, $userQ );
				
				//execute
				$UQres=oci_execute($stid2);
				$index = 0;

				// store these results into second array
				$res2 = array("usrname","pw","role","id");
				while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
					foreach($row as $item) {
						$res2[$index] = $item;
						$index = $index + 1;
					}
				}
		
				// put array values into vairables here as well
				$name = $res2[0];
				$pw = $res2[1];
				$role = $res2[2];


			?>
				<!-- using stored values, display results -->
				<div class="LoginForm container">

					<h1>Update Account</h1>
					<form name= "usr_update" method="post" action="uAccountAddSubmit.php"> 
						User Name<input type="text" value= "<?php echo $name ?>" name="usrName"/> <br/>
						ID<input type="text" value= "<?php echo $id ?>" name="ID" readonly/> <br/>
						Role<input type="text" value= "<?php echo $role ?>" name= "role" /> <br/>
						Password<input type="text" value= "<?php echo $pw ?>" name="pwd"/> <br/>
						First Name<input type="text" value= "<?php echo $fname ?>" name="fName"/> <br/>
						Last Name<input type="text" value= "<?php echo $lname ?>" name="lName"/> <br/>
						Address<input type="text" value= "<?php echo $addr ?>" name="addr"/> <br/>
						Email Address<input type="text" value="<?php echo $email ?>" name="email"/> <br/>
						Phone Number<input type="text" value="<?php echo $phone ?>" name="phone"/> <br/>
						<input type="hidden" value= "<?php echo $id ?>" name="key"/>
						<input type="submit" value="Update" name="update"/>
						<input type="submit" value="Remove" name="delete"/>
					</form>

				</div>	

				<!-- user can search again -->
				<div class="LoginForm container">
					<h1>New Search</h1>
					<form name= "Email Search" method="post" action="uAccountUpdateRes.php"> 
						 Email<input type="text" value="<?php echo $email ?>" name="email"/> <br/>
						<input type="submit" name="emailSearch" value="Search"/>
					</form>

					<form name= "newSearch" method="post" action="uAccountUpdate.php"> 
							<input type="submit" name="back" value="Change Parameter"/>
					</form>
				</div>

				<div class="LoginForm container">
					<form name= "Back" method="post" action="sensorModule.php"> 
							<input type="submit" name="Return"value="Return To Menu"/>
					</form>
				</div>	
		<?php
		// finally, if user searches by ID - easiest
		} else {
			$id=$_POST['usrID'];  

			ini_set('display_errors', 1);
			error_reporting(E_ALL);
		
			$conn=connect();
			
			if (!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			} 

			// Query
			$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE person_id = \''.$id.'\'';	
		
			//prepare
			$stid1 = oci_parse($conn, $personQ );
			
			//execute
			$PQres=oci_execute($stid1);

			$index = 0;
			// store results in array - default values used
			$res = array("User ID","First Name","Last Name","Address","Email","Phone");
			while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
				foreach($row as $item) {
					$res[$index] = $item;
					$index = $index + 1;
				}
			}
	
			// set array values to variables
			$fname = $res[1];
			$lname = $res[2];
			$addr = $res[3];
			$email = $res[4];
			$phone = $res[5];


			// do second query 
			$userQ = 'SELECT user_name, password, role, person_id FROM users where person_id = \''.$id.'\'';	
		
			//prepare
			$stid2 = oci_parse($conn, $userQ );
			
			//execute
			$UQres=oci_execute($stid2);
			$index = 0;
			// results are also stored in an array
			$res2 = array("usrname","pw","role","id");
			while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
				foreach($row as $item) {
					$res2[$index] = $item;
					$index = $index + 1;
				}
			}

			// and then array values are set to variables
			$name = $res2[0];
			$pw = $res2[1];
			$role = $res2[2];


		?>
			<!-- display results using stored values -->
			<div class="LoginForm container">

				<h1>Update Account</h1>
				<form name= "usr_update" method="post" action="uAccountAddSubmit.php"> 
					User Name<input type="text" value= "<?php echo $name ?>" name="usrName"/> <br/>
					ID<input type="text" value= "<?php echo $id ?>" name="ID" readonly/> <br/>
					Role<input type="text" value= "<?php echo $role ?>" name= "role" /> <br/>
					Password<input type="text" value= "<?php echo $pw ?>" name="pwd"/> <br/>
					First Name<input type="text" value= "<?php echo $fname ?>" name="fName"/> <br/>
					Last Name<input type="text" value= "<?php echo $lname ?>" name="lName"/> <br/>
					Address<input type="text" value= "<?php echo $addr ?>" name="addr"/> <br/>
					Email Address<input type="text" value="<?php echo $email ?>" name="email"/> <br/>
					Phone Number<input type="text" value="<?php echo $phone ?>" name="phone"/> <br/>
					<input type="hidden" value= "<?php echo $id ?>" name="key"/>
					<input type="submit" value="update" name="update"/>
					<input type="submit" value="Remove" name="delete"/>
				</form>

			</div>	
	
			<!-- user can search again -->

			<div class="LoginForm container">
				<h1>New Search</h1>
				<form name= "Email Search" method="post" action="uAccountUpdateRes.php"> 
					 User ID<input type="text" value="<?php echo $id ?>" name="usrID"/> <br/>
					<input type="submit" name="IDSearch" value="Search"/>
				</form>
				<form name= "newSearch" method="post" action="uAccountUpdate.php"> 
						<input type="submit" name="back" value="Change Parameter" />
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




