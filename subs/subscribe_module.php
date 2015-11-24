<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include("../PHPconnectionDB.php");

session_start();

		if($_SESSION['role'] != 's'){
			
			header('Location: ../OOSLogin.php', true, 301);
			exit();	
		
		}

?>

<html>


  <head>
    <title>Subscribe to Sensors - OOS</title>

		<div align="right">
			<form name = "login" method="post"  action="../help.html"> 
					<input type="submit" name="validate" value="help" style="width: 125px; height: 50px;">
			</form>
		</div> 

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="subscribeModule.css">
    <style type=”text/css”>

</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  </head>
  <body>
  

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
  	<form name = "logout" method="post"  action="../logout.php"> 
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
    <div role="tabpanel" class="tab-pane active" id="Subscribed">

			<?php


			$sql = 'select sensors.sensor_id , sensors.sensor_type, sensors.description
    from users, subscriptions , sensors
    where users.user_name = \''.$_SESSION['username'].'\'
		and users.person_id = subscriptions.person_id
    and subscriptions.sensor_id = sensors.sensor_id';
            
			$conn = connect();


			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);



			echo '<table>';


			echo '<thead> <tr> <th> ID </th> <th>TYPE</th> <th> DESCRIPTION</th> <th>Subscribe</th> </tr></thead> <tbody> ';


			while(oci_fetch($stid)){    

				$data1["sensor_id"] = oci_result($stid,"SENSOR_ID");
       			$data1["sensor_type"] = oci_result($stid,"SENSOR_TYPE");
				$data1["description"] = oci_result($stid, "DESCRIPTION");
				echo '<tr><td>' .$data1["sensor_id"]. '</td><td>' .$data1["sensor_type"].'</td><td>'.$data1["description"];
				echo '</td><td><button class=unsubscribe id='.$data1["sensor_id"].'>Unsubscribe</button></td></tr>';
			
			}

		

			echo '</table>';


			?>

		   <script>

		$(document).ready(function(){

			$('.unsubscribe').click(function(){

				alert($(this).attr('id'));
				//referencing http://api.jquery.com/jquery.post/
				$.post('unsubscribe.php', {id:$(this).attr('id')}, function(data){


					alert(data);
					//refresh page 
					window.location.replace("subscribe_module.php");

				} );


			});	


		});
	
					


		</script>









		</div>
    <div role="tabpanel" class="tab-pane" id="Not">





        <?php

            $sql = 'select distinct sensors.sensor_id , sensors.sensor_type, sensors.description
										from sensors, users, subscriptions 
										where sensors.sensor_id not in (
										select subscriptions.sensor_id
										from users, subscriptions
										where users.person_id = \''.$_SESSION["person_id"].'\'
										and users.person_id = subscriptions.person_id
										)';

                    
            $conn=connect();


			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);


			echo '<table>';


			echo '<thead> <tr> <th> ID </th> <th>TYPE</th> <th> DESCRIPTION</th> <th>Subscribe</th> </tr></thead> <tbody> ';
		
    
		
			while(oci_fetch($stid)){    

				$data2["sensor_id"] = oci_result($stid,"SENSOR_ID");
        $data2["sensor_type"] = oci_result($stid,"SENSOR_TYPE");
				$data2["description"] = oci_result($stid, "DESCRIPTION");
				echo '<tr><td>' .$data2["sensor_id"]. '</td><td>' .$data2["sensor_type"].'</td><td>'.$data2["description"];
				echo '</td><td> <button class=subscribe id='.$data2["sensor_id"].'>subscribe</button></td></tr>';
			
			}

			if($data2["sensor_id"]==''){
				$checkSubscriptions = 'select * from subscriptions where subscriptions.person_id = \''.$_SESSION["person_id"].'\' ';
				$newconn = connect();
				$parserino = oci_parse($newconn,$checkSubscriptions);
				$res = oci_execute($parserino);

        while(oci_fetch($parserino)){
          //if there are subscriptions make sure not to display all sensors.
          $data5['sensor_id']=oci_result($parserino,'SENSOR_ID');

        }
      
        if($data5['sensor_id']==''){
          echo 'yo';
				  $newsql = "select sensor_id, sensor_type, description from sensors";
				  $parserino = oci_parse($newconn,$newsql);
				  $res = oci_execute($parserino);
				
				  while(oci_fetch($parserino)){
				
					  $sensorData["sensor_id"] = oci_result($parserino,"SENSOR_ID");
					  $sensorData["sensor_type"] = oci_result($parserino, "SENSOR_TYPE");
					  $sensorData["description"] = oci_result($parserino, "DESCRIPTION");
				  	echo '<tr><td>' .$sensorData["sensor_id"]. '</td><td>' .$sensorData["sensor_type"].'</td><td>'.$sensorData["description"];
				  	echo '</td><td> <button class=subscribe id='.$sensorData["sensor_id"].'>subscribe</button></td></tr>';

				  }

        }
      }
		

            
			
			echo '</table>';
			
        ?>
        <script>

		$(document).ready(function(){

			$('.subscribe').click(function(){

				alert($(this).attr('id'));
				//referencing http://api.jquery.com/jquery.post/
				$.post('subscribe.php', {id:$(this).attr('id')}, function(data){
				
					//refresh page 
					window.location.replace("subscribe_module.php");

				} );


			});	


		});
	
					


		</script>



	</div>
  </div>

	</div>
  <div class="dataDisplay">
    
    <?php 


    $sql = 'select * from sensors';


    $conn=connect();


		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);

		
		echo '<table id=dataTable>';


		echo '<thead> <tr> <th> ID </th> <th>TYPE</th> <th>LOCATION</th> <th> DESCRIPTION</th> </tr> </thead> <tbody> ';
		

		while(oci_fetch($stid)){    

			$data3["sensor_id"] = oci_result($stid,"SENSOR_ID");
      $data3["sensor_type"] = oci_result($stid,"SENSOR_TYPE");
      $data3["location"] = oci_result($stid,"LOCATION");
      $data3["description"] = oci_result($stid,"DESCRIPTION");
			echo '<tr> <td>' .$data3["sensor_id"]. ' </td><td>' .$data3["sensor_type"]. ' </td> <td>' .$data3["location"]. ' </td><td>' .$data3["description"].'</td></tr>';
			
		}

	

		echo '</tbody></table>';


    ?>



  </div>



  </div>
  </body>



</html>



