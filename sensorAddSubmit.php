<?php
include("PHPconnectionDB.php");
?>

<html>
    <body>
	
		<TABLE BORDER=1>
		<?php   // first method    	 
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
	    			echo 'invalid! input cannot be empty';	    		
	    		} else if (strlen($sType) != 1) {
	    			echo 'Sensor Type must be in {a,i,s}';    		
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
						echo 'Sensor Added' ;
		    		}
		    		  
		    		// Free the statement identifier when closing the connection
		    		oci_free_statement($stid);
		    		oci_close($conn);
		    	}
	    		  
			} ?>

		<br/>
		<form name= "Finish" method="post" action="sensorModule.php"> 
			<input type="submit" name="Return"value="Return To Menu"/>
		</form>
		<br/>
		<form name= "Back" method="post" action="sensorAdd.php"> 
			<input type="submit" name="Back"value="Add Another Sensor"/>
		</form>		
	
    </body>
    
</html>