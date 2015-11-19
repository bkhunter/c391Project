<?php 
			if(isset($_POST['time'])){
				$time = $_POST['time'];
				$locCheck = False;
				$idCheck = False;
			}


			if ($time == "day") {
		?>
				<div class = "container">
				  <form method="post" action="OlapDefault.php">
					<?php
					  if (isset($_POST["loc"])) {
						$locCheck = True;
					?>
					 <div class="checkbox">
					    <label><input type="checkbox" checked="checked" name="loc" value="" >Location</label>
			  		</div>

					<?php
					} else {
					?>
						
						<div class="checkbox">
							<label><input type="checkbox" name="loc" value="" >Location</label>
				  		</div>

					<?php
					}

					if (isset($_POST["sID"])) {
						$idCheck = True;
					?>
						<div class="checkbox">
						  	<label><input type="checkbox" checked = "checked" name="sID" value="">Sensor ID</label>
					  	</div>

					<?php
					} else {
						
					?>
						<div class="checkbox">
							<label><input type="checkbox" name="sID" value="" >Sensor ID</label>
				  		</div>

					<?php
					}
					?>
					  	<select id = 'id' name="time">
						  	<option value="day">Daily</option>
						  	<option value="none">All Time</option>
							<option value="week">Weekly</option>
							<option value="month">Monthly</option>
							<option value="quarter">Quarterly</option>
							<option value="year">Yearly</option>
						</select>
						<input type="submit" value="Submit">
					</form>
					
					<?php
						if ($idCheck && $locCheck) {
					?>
						<form method="post" action="Daily/OlapDaily_L_ID.php">
						<h3> Input Range </h3>
							 Date From:<input type="date" name="from">
							 Date To:<input type="date" name="to">
								  	<input type="submit" name = "display" value="Display">
						</form>

					<?php
					 } else if ($idCheck && !$locCheck) {
					?>
						<form method="post" action="Daily/OlapDaily_ID.php">
						<h3> Input Range </h3>
							 Date From:<input type="date" name="from">
							 Date To:<input type="date" name="to">
								  	<input type="submit" name = "display" value="Display">
						</form>

					<?php
					 } else if (!$idCheck && $locCheck) {
					?>
						<form method="post" action="Daily/OlapDaily_L.php">
						<h3> Input Range </h3>
							 Date From:<input type="date" name="from">
							 Date To:<input type="date" name="to">
								  	<input type="submit" name = "display" value="Display">
						</form>
					<?php
					 } else {
					?>
						<form method="post" action="Daily/OlapDaily.php">
						<h3> Input Range </h3>
							 Date From:<input type="date" name="from">
							 Date To:<input type="date" name="to">
								  	<input type="submit" name = "display" value="Display">
						</form>

				</div>
