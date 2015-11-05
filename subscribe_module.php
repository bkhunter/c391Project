<?php
include("PHPconnectionDB.php");

session_start();

?>

<html>


  <head>
    <title>Subscribe to Sensors - OOS</title>



    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="subscribeModule.css">
    
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  </head>
  <body>
  <?php
  		session_start();
  		if($_SESSION['login'] != 'true') {
			header('Location: OOS.php', true, 301);
			exit();	
		}
	?>
  

  <div class="container">
  <div class="row">
  <div class = "col-sm-3"></div>
  <div class="col-sm-6">
  <div class="page-header">
    <h1>Ocean Observation System
      <small> Subscribe/Unsubscribe from sensors</small>
    </h1>
  </div>
  </div>
  </div>
  	<form name = "logout" method="post"  action="logout.php"> 
					<h2 class ="logout"> </h2>
					<center><input type="submit" name="validate" value="log out"></center>
	</form>
  <div class="sidebar">Welcome, <?php echo $_SESSION["username"]?>!
	<br>

    <ul class="nav nav-tabs" id="tabs">
      <li class="active"><a href="#Subscribed" data-toggle="tab" role="tab">Subscribed</a></li>
      <li><a href="#Not" data-toggle="tab" role="tab">Not subscribed</a></li>
    </ul>


		<!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="Subscribed">This is subscribed
			<?php


				$sql = 'select sensors.sensor_id , sensors.sensor_type
    from users, subscriptions , sensors
    where users.user_name = \''.$_POST['username'].'\'
		and users.person_id = subscriptions.person_id
    and subscriptions.sensor_id = sensors.sensor_id';


			$conn=connect();


			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);

		if ( !oci_fetch_array($stid, OCI_ASSOC) ) {


			while(($data =oci_fetch_array($stid,OCI,ASSOC))){
					

				foreach($data as $sensor){
					
							echo $data["sensor_id"]. ' : ' .$data["sensor_type"].'<button id ="$data["sensor_id"]">Unsubscribe</button>';

				}			

			}

		


		}

			?>



		</div>
    <div role="tabpanel" class="tab-pane" id="Not">This is not subscribed	</div>
  </div>

	</div>
  <div class="dataDisplay">
    
    Data then button to subscribe or unsubscribe
    <!--
    
    this is for side bar
    need person_id from username
    i dunno how to get that
    
    fill side bar with sensor_type and sensor_id
    
    
		this is for stuff that is subscribed 

    select sensor_id , sensor_type
    from users, subscriptions , sensors
    where users.user_name = $_SESSION["username"]
		and users.person_id = subscriptions.person_id
    and subscriptions.sensor_id = sensors.sensor_id
    
    
    while getting $data from sql result array{
    
    echo $data["sensor_id"] " : " $data["sensor_type"];
    <button id ="$data["sensor_id"]">Sub/Unsub</button>
    
    }
    
    
    for actual data
    
    
    select
    
    
    
    
    -->
    
  </div>



  </div>
  </body>



</html>



