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
				$loc=$_POST['location'];            		
				$sType=$_POST['sensor_type'];
				$desc=$_POST['description'];
				
				ini_set('display_errors', 1);
	    		error_reporting(E_ALL);
	    	
	    		$conn=connect();
	    		
	    		if (!$conn) {
    				$e = oci_error();
    				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		}
	    		
	    		if (($loc == '') || ($sType == '') || ($desc == '')){
	    			?> 
						<div class="LoginForm container">
						<h2 class ="LoginHeader"> Invalid - Input Fields Cannot Be Empty </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
		
						<div class="LoginForm container">
						<form name= "Back" method="post" action="sensorAdd.php"> 
							<input type="submit" name="Back"value="Back"/>
							</form>
						</div>

				<?php 		
	    		} else if (strlen($sType) != 1) {
	    			?> 
						<div class="LoginForm container">
						<h2 class ="LoginHeader"> Invalid - Sensor Type Must Be One Of {'a','i','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
		
						<div class="LoginForm container">
						<form name= "Back" method="post" action="sensorAdd.php"> 
							<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 

				} else if (($sType != 'a') && ($sType != 'i') && ($sType != 's')) {
	    			?> 
						<div class="LoginForm container">
						<h2 class ="LoginHeader"> Invalid - Sensor Type Must Be One Of {'a','i','s'} </h2>
							<form name= "Finish" method="post" action="sensorModule.php"> 
								<input type="submit" name="Return"value="Return To Menu"/>
							</form>
						</div>
		
						<div class="LoginForm container">
						<form name= "Back" method="post" action="sensorAdd.php"> 
							<input type="submit" name="Back"value="Back"/>
							</form>
						</div>	
					<?php 		 		
	    		} else {
		    		//insert statement
		    		$sql = 'INSERT INTO SENSORS (location, sensor_type, description) VALUES (\''.$loc.'\',\''.$sType.'\',\''.$desc.'\')';	
				
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
