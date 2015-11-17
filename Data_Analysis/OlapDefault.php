<html>
	<style>
		table#results {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			width: 95%;
		}

		table#sensors {
			width: 100%;
		}

	</style>

	<head>
		<title>
			Olap Analysis
		</title>
	</head>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="Olap.css">
	
	<body>
		<div class ="page">
			<div class = "page-header">
			<h1 class ="title"> Olap Analysis</h1>			
		</div>

		<div class="container">
				<h2 class ="LoginHeader"> Select Parameters </h2>
		</div>	

		<?php 
			if(isset($_POST['time'])){
				$time = $_POST['time'];
			}

			if (isset($_POST['loc'])){
				echo "horray";
			}

			if ($time == "day") {
		?>
				<div class = "container">
				  <form role="form">
					<div class="checkbox">
					  <label><input type="checkbox" checked="checked" name="loc" value="ddd" >Location</label>
					</div>

					<div class="checkbox">
					  <label><input type="checkbox" name="sID" value="">Sensor ID</label>
					</div>
				  </form>
				  <form method="post" action="OlapDefault.php">
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
					<div class="row">
						<div class='col-sm-6'>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
									    <span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker1').datetimepicker();
							});
						</script>
					</div>
				</div>

		<?php

			} else {
		?> 

		<div class = "container">
		  <form role="form">

			<div class="checkbox">
			  <label><input type="checkbox" name="loc" value="">Location</label>
			</div>

			<div class="checkbox">
			  <label><input type="checkbox" name="sID" value="">Sensor ID</label>
			</div>

		  </form>

		  <form method="post" action="OlapDefault.php">
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
		</div>
	<?php
		}
		?>

		<div class="floatMiddle">
			<table id="results" border = "1">
				<tr>
					<th>Location</th>
					<th>ID1</th>
					<th>ID2</th>
					<th>ID3</th>
				</tr>
				<tr>
					<td>texas</td>
					<td>
						<table id="sensors" border = "1">
							<th>Min</th>
							<th>Max</th>
							<th>Average</th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="sensors" border = "1">
							<th>Min</th>
							<th>Max</th>
							<th>Average</th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="sensors" border = "1">
							<th>Min</th>
							<th>Max</th>
							<th>Average</th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
