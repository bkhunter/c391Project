<?php
include("PHPconnectionDB.php");
?>

<html>
    <body>
		<h1>Sensor Created</h1>
	
	
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
	    		} else {
	    			echo 'connected' ;	
	    		}
			} ?>
				
				<TR>
					<TD>Location</TD>
					<TD> <?php echo $loc ?></TD>
				</TR>
				<TR>
					<TD>Sensor Type</TD>
					<TD><?php echo $sType ?></TD>
				</TR>
				<TR>
					<TD>Description</TD>
					<TD><?php echo $desc ?></TD>
				</TR>
	        
		</TABLE>

		<br/>
	
    </body>
    
</html>