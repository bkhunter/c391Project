<!--http://www.w3schools.com/html/html_forms.asp-->
<!--code also taken from class notes -->

<!-- Handles actually adding the user into the database, after fields filled in, updating the database entry, or removing a user account -->

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
			// If the user selected 'create', it is a new account
			if(isset($_POST['create'])){   
				// all input fields are set to variables     	
				$usrName=$_POST['usrName'];
	        	$ID=$_POST['ID'];
			    $role=$_POST['role'];
				$pw=$_POST['pwd'];
				$fName=$_POST['fName'];
			    $lName=$_POST['lName'];
			    $addr=$_POST['addr'];
			    $email=$_POST['email'];
			    $phone=$_POST['phone'];
				
				//create current date and format it into a string
				// http://php.net/manual/en/function.date.php
				// http://php.net/manual/en/function.strtoupper.php

				$day=date('j');
				$month=date('M');
				$month=strtoupper($month);
				$year=date('Y');
				$DATE = 'TO_DATE(\''.$day.'-'.$month.'-'.$year.'\', \'DD-MON-YYYY\' )';

				// db connect
				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				
				// validate data - and display error message if invalid
				if (($usrName == '') || ($ID == '') || ($email == '')){
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Fill In All Required Fields </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>

					<?php 	
				// validate data - and display error message if invalid	
				} else if (strlen($role) != 1) {
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Role Must Be One Of {'a','d','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 
				// validate data - and display error message if invalid
				} else if (($role != 'a') && ($role != 'd') && ($role != 's')) {
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Role  Must Be One Of {'a','d','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountAdd.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 	
 		
				} else {
					// create account!

					//insert statements																
					$addPer = 'INSERT INTO PERSONS (person_id, first_name, last_name, address, email, phone) VALUES (\''.$ID.'\',\''.$fName.'\',\''.$lName.'\',\''.$addr.'\',\''.$email.'\',\''.$phone.'\')';
				
					$addUsr = 'INSERT INTO USERS (user_name, password, role, person_id, date_registered) VALUES (\''.$usrName.'\',\''.$pw.'\',\''.$role.'\',\''.$ID.'\','.$DATE.')';	
			
					//prepare
					$stid1 = oci_parse($conn, $addPer );
					$stid2 = oci_parse($conn, $addUsr );

					//execute
					$res1=oci_execute($stid1);
					$res2=oci_execute($stid2);

				
					if (!$res1) {
						$err = oci_error($stid1); 
						echo htmlentities($err['There was an error, please try again']);

				   } else if (!$res2) {
						$err = oci_error($stid2); 
						echo htmlentities($err['There was an error, please try again']);

				   } else {
						// create success message and appropriate buttons
						?>
							<div class="LoginForm container">
								<h2 class ="LoginHeader"> Success! </h2>
								<form name= "Finish" method="post" action="sensorModule.php"> 
									<input type="submit" name="Return"value="Return To Menu"/>
								</form>
							</div>

							<div class="LoginForm container">
								<form name= "Back" method="post" action="uAccountAdd.php"> 
									<input type="submit" name="Back"value="Create Another Account"/>
								</form>
							</div>
						<?php	
					}
					  
					// Free the statement identifiers when closing the connection
					oci_free_statement($stid1);
					oci_free_statement($stid2);
					oci_close($conn);
				}
				  
			// if the user selected update, update based on the data
			} else if(isset($_POST['update'])) {

				$KEY=$_POST['key'];
				$usrName=$_POST['usrName'];
	        	$ID=$_POST['ID'];
			    $role=$_POST['role'];
				$pw=$_POST['pwd'];
				$fName=$_POST['fName'];
			    $lName=$_POST['lName'];
			    $addr=$_POST['addr'];
			    $email=$_POST['email'];
			    $phone=$_POST['phone'];

				// create date all the same because this will be the date registered
				$day=date('j');
				$month=date('M');
				$month=strtoupper($month);
				$year=date('Y');
				$DATE = 'TO_DATE(\''.$day.'-'.$month.'-'.$year.'\', \'DD-MON-YYYY\' )';

				ini_set('display_errors', 1);
				error_reporting(E_ALL);
			
				$conn=connect();
				
				if (!$conn) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				
				// validate data - and display error message if invalid
				if (($usrName == '') || ($ID == '') || ($email == '')){
					?> 
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Invalid - Fill In All Required Fields </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountUpdate.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>

					<?php 	
				// validate data - and display error message if invalid	
				} else if (strlen($role) != 1) {

					?> 
						<div class="LoginForm container">
						<h2 class ="LoginHeader"> Invalid - Role Must Be One Of {'a','d','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountUpdate.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 

				// validate data - and display error message if invalid
				} else if (($role != 'a') && ($role != 'd') && ($role != 's')) {
					?> 
						<div class="LoginForm container">
						<h2 class ="LoginHeader"> Invalid - Role  Must Be One Of {'a','d','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
	
						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountUpdate.php"> 
								<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 

				// valid - update!	 		
				} else {

					// update statements
					$updPer = 'UPDATE PERSONS set first_name = \''.$fName.'\', last_name = \''.$lName.'\', address = \''.$addr.'\', email = \''.$email.'\', phone = \''.$phone.'\' WHERE person_id = \''.$KEY.'\'';

					$updUsr = 'UPDATE USERS set user_name =\''.$usrName.'\', password = \''.$pw.'\', role = \''.$role.'\', date_registered ='.$DATE.' WHERE person_id=\''.$KEY.'\'';
		
					//prepare
					$stid1 = oci_parse($conn, $updPer );
					$stid2 = oci_parse($conn, $updUsr );

					//execute
					$res1=oci_execute($stid1);
					$res2=oci_execute($stid2);

			
					//check
					if (!$res1) {
						$err = oci_error($stid1); 
						echo htmlentities($err['There was an error, please try again']);

				   } else if (!$res2) {
						$err = oci_error($stid2); 
						echo htmlentities($err['There was an error, please try again']);

				   } else {
						// success
						// create success message and appropriate buttons
						?>
							<div class="LoginForm container">
							<h2 class ="LoginHeader"> Success! </h2>
								<form name= "Finish" method="post" action="sensorModule.php"> 
									<input type="submit" name="Return"value="Return To Menu"/>
								</form>
							</div>

							<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountUpdate.php"> 
								<input type="submit" name="Back"value="Update Another Account"/>
								</form>
							</div>
						<?php	
					}
					  
					// Free the statement identifiers when closing the connection
					oci_free_statement($stid1);
					oci_free_statement($stid2);
					oci_close($conn);
			
				}
			
			// finally, if the user selected remove
			} else if(isset($_POST['delete']))  {
					$ID=$_POST['ID'];

					ini_set('display_errors', 1);
					error_reporting(E_ALL);
			
					$conn=connect();
				
					if (!$conn) {
						$e = oci_error();
						trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					}

					// unsubscribe from all sensors

					// get sensors attatched to scientist
					$sQ = 'select * from subscriptions where person_id = \''.$ID.'\'';	
	
					//prepare
					$stid = oci_parse($conn, $sQ );

					//execute
					$res=oci_execute($stid);

					$s_res = array();
					while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
						// only get sensor_id's
						$i = 0;
						foreach($row as $item) {
							if ($i%2 == 0) {
								array_push($s_res, $item);
							}
							$i++;	
						}
					}

					// for each sensor, unsubscribe
					foreach($s_res as &$sensorID) {
					
						 $sql  = 'delete from subscriptions
								where subscriptions.sensor_id =\''.$sensorID.'\'
								and subscriptions.person_id = \''.$ID.'\'';

						$conn = connect();
						$stid = oci_parse($conn, $sql);
						$res = oci_execute($stid);

						if(!$res){

							$message = "there was an error unsubscribing ";
							echo $message;
						}
					}

			  
					// Delete user and person rows
					$delUser = 'DELETE FROM USERS WHERE person_id = \''.$ID.'\'';		
					$delPer = 'DELETE FROM PERSONS WHERE person_id = \''.$ID.'\'';
				
					$del1 = oci_parse($conn, $delUser );
					$del2 = oci_parse($conn, $delPer);

					$delres1=oci_execute($del1);					
					$delres2=oci_execute($del2);
				

					// check
					if (!$delres1) {
						$err = oci_error($del1); 
						echo htmlentities($err['There was an error, please try again']);

				   } else if (!$delres2) {
						$err = oci_error($del2); 
						echo htmlentities($err['There was an error, please try again']);

				   } else {
						?>
						<div class="LoginForm container">
							<h2 class ="LoginHeader"> Delete Successful </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>

						<div class="LoginForm container">
							<form name= "Back" method="post" action="uAccountUpdate.php"> 
								<input type="submit" name="Back"value="Update Another Account"/>
							</form>
						</div>
						<?php
				  }	
				  	// Free the statement identifiers when closing the connection
					oci_free_statement($del1);
					oci_free_statement($del2);
					oci_close($conn);
			}
			?>	
		</div>
    </body>
</html>
