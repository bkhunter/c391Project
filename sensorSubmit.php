<html>
    <body>
	<h1>Sensor Created</h1>
	
	<?php   // first method    	 
		if(isset($_POST['create'])){        	
			$loc=$_POST['location'];            		
			$sType=$_POST['sensor_type'];
			$desc=$_POST['description'];
	           	echo'Your Location is '.$loc.'<br/> 
	           	Your sensor type is '.$sType.'<br/>
	           	Your description says: '.$desc.'';       
		}	
	?>

	<br/>
	
    </body>
    
</html>
