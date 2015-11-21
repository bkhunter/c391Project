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


		<?php   	 
			if(isset($_POST['usrNameSearch'])){        	
				$name=$_POST['usrName'];          		
				
				ini_set('display_errors', 1);
	    		error_reporting(E_ALL);
	    	
	    		$conn=connect();
	    		
	    		if (!$conn) {
    				$e = oci_error();
    				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		} 
			
				$userQ = 'SELECT user_name, password, role, person_id FROM users where user_name = \''.$name.'\'';	
				
				//prepare
				$stid1 = oci_parse($conn, $userQ );
					
				//execute
				$UQres=oci_execute($stid1);
				$index = 0;
				$res = array("usrname","pw","role","id");
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					foreach($row as $item) {
						$res[$index] = $item;
						$index = $index + 1;
					}
				}
		
				$pw = $res[1];
				$role = $res[2];
				$id = $res[3];

		
				$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE person_id = \''.$id.'\'';	
				
				//prepare
				$stid2 = oci_parse($conn, $personQ );
					
				//execute
				$PQres=oci_execute($stid2);

				$index = 0;
				$res2 = array("User ID","First Name","Last Name","Address","Email","Phone");
				while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
					foreach($row as $item) {
						$res2[$index] = $item;
						$index = $index + 1;
					}
				}
			
				$fname = $res2[1];
				$lname = $res2[2];
				$addr = $res2[3];
				$email = $res2[4];
				$phone = $res2[5];



			?>
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
		} else if(isset($_POST['emailSearch'])) { 

				$email=$_POST['email'];  

				ini_set('display_errors', 1);
	    		error_reporting(E_ALL);
	    	
	    		$conn=connect();
	    		
	    		if (!$conn) {
    				$e = oci_error();
    				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		} 	

				$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE email = \''.$email.'\'';	
				
				//prepare
				$stid1 = oci_parse($conn, $personQ );
					
				//execute
				$PQres=oci_execute($stid1);

				$index = 0;
				$res = array("User ID","First Name","Last Name","Address","Email","Phone");
				while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
					foreach($row as $item) {
						$res[$index] = $item;
						$index = $index + 1;
					}
				}
			
				$id = $res[0];
				$fname = $res[1];
				$lname = $res[2];
				$addr = $res[3];
				$phone = $res[5];


				$userQ = 'SELECT user_name, password, role, person_id FROM users where person_id = \''.$id.'\'';	
				
				//prepare
				$stid2 = oci_parse($conn, $userQ );
					
				//execute
				$UQres=oci_execute($stid2);
				$index = 0;
				$res2 = array("usrname","pw","role","id");
				while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
					foreach($row as $item) {
						$res2[$index] = $item;
						$index = $index + 1;
					}
				}
			
				$name = $res2[0];
				$pw = $res2[1];
				$role = $res2[2];


			?>
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
		} else {
			$id=$_POST['usrID'];  

			ini_set('display_errors', 1);
    		error_reporting(E_ALL);
    	
    		$conn=connect();
    		
    		if (!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		} 

			$personQ = 'SELECT person_id, first_name, last_name, address, email, phone FROM persons WHERE person_id = \''.$id.'\'';	
			
			//prepare
			$stid1 = oci_parse($conn, $personQ );
				
			//execute
			$PQres=oci_execute($stid1);

			$index = 0;
			$res = array("User ID","First Name","Last Name","Address","Email","Phone");
			while (($row = oci_fetch_array($stid1, OCI_ASSOC))) {
				foreach($row as $item) {
					$res[$index] = $item;
					$index = $index + 1;
				}
			}
		
			$fname = $res[1];
			$lname = $res[2];
			$addr = $res[3];
			$email = $res[4];
			$phone = $res[5];


			$userQ = 'SELECT user_name, password, role, person_id FROM users where person_id = \''.$id.'\'';	
			
			//prepare
			$stid2 = oci_parse($conn, $userQ );
				
			//execute
			$UQres=oci_execute($stid2);
			$index = 0;
			$res2 = array("usrname","pw","role","id");
			while (($row = oci_fetch_array($stid2, OCI_ASSOC))) {
				foreach($row as $item) {
					$res2[$index] = $item;
					$index = $index + 1;
				}
			}

			$name = $res2[0];
			$pw = $res2[1];
			$role = $res2[2];


		?>
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

	</body>

</html>




