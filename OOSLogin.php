<html>

<head>

	<title>

		Welcome

	</title>


</head>



<body>

	<center><h1>Ocean Observation System</h1></center>

	<?php
	
	if (isset ($_POST['validate'])){
	
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		echo 'Welcome to OOS '.$username.'!';

	}



	?>

	



</body>





</html>
