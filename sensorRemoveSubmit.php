<?php
include("PHPconnectionDB.php");
?>

<html>
    <body>
	
		<TABLE BORDER=1>
		<?php   // first method    	 
			if(isset($_POST['rmv'])){        	
				$ID=$_POST['sID'];            		
				
				ini_set('display_errors', 1);
	    		error_reporting(E_ALL);
	    	
	    		$conn=connect();
	    		
	    		if (!$conn) {
    				$e = oci_error();
    				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		}
	    		
	    		if ($ID == 0){
	    			echo 'invalid! ID cannot be zero';		
	    		} else {
		    		//insert statement
		    		$sql = 'DELETE FROM SENSORS WHERE sensor_id = (\''.$ID.'\')'; 
		    		
					//prepare
					$stid = oci_parse($conn, $sql );
					
					//execute
					$res=oci_execute($stid);
	
					
					if (!$res) {
						$err = oci_error($stid); 
						echo htmlentities($err['There was an error, please try again']);
					} else {
						echo 'Sensor Removed' ;
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
		<form name= "Back" method="post" action="sensorRemove.php"> 
			<input type="submit" name="Back"value="Remove Another Sensor"/>
		</form>		
	
    </body>
    
</html>