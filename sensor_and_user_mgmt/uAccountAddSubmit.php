<?php
include("PHPconnectionDB.php");
?>

<html>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="sensorModule.css">

    <body>

		<div class ="page">
		<div class = "page-header">
		<h1 class ="title"> Sensor and User Management </h1>			
		</div>
		
		<?php   	 
			if(isset($_POST['create'])){        	
				$usrName=$_POST['usrName'];
            	                $ID=$_POST['ID'];
		                $role=$_POST['role'];
				$pw=$_POST['pwd'];
				$fName=$_POST['fName'];
		                $lName=$_POST['lname'];
		                $addr=$_POST['addr'];
		                $email=$_POST['email'];
		                $phone=$_POST['phone'];
		                
				
				ini_set('display_errors', 1);
	    		error_reporting(E_ALL);
	    	
	    		$conn=connect();
	    		
	    		if (!$conn) {
    				$e = oci_error();
    				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		}
	    		
	    		if (($usrName == '') || ($pw == '') || ($email == '')){
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
		    		//insert statements
		$addUsr = 'INSERT INTO USERS (user_name, password, role, person_id, date_registered) VALUES (\''.$usrName.'\',\''.$pw.'\',\''.$role.'\',\''.$ID.'\',\''.$DATE.'\')';	
				
					//prepare
					$stid = oci_parse($conn, $sql );
					
					//execute
					$res=oci_execute($stid);
	
					
					if (!$res) {
						$err = oci_error($stid); 
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
							<form name= "Back" method="post" action="sensorAdd.php"> 
								<input type="submit" name="Back"value="Add Another Sensor"/>
								</form>
							</div>
						<?php	
		    		}
		    		  
		    		// Free the statement identifier when closing the connection
		    		oci_free_statement($stid);
		    		oci_close($conn);
		    	}
	    		  
			} ?>

    </body>
    
</html>
