<html>
	<style>
		table#results {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			width: 100%;
		}

		table#sensors {
			width: 100%
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

		<div class="LoginForm container">
				<h2 class ="LoginHeader"> Select Parameters </h2>
		</div>	

		<div class = "LoginForm container">
		  <form role="form" action="OlapDaily.php">
			<div class="checkbox">
			  <label><input type="checkbox" name="loc" value="">Location</label>
			</div>
			<div class="checkbox">
			  <label><input type="checkbox" name="sID" value="">Sensor ID</label>
			</div>
		  </form>
		<form method="post" >
			<select id = 'id' name="time">
			  	<option value="">Select...</option>
			  	<option value="none">None</option>
			  	<option value="day">Daily</option>
				<option value="week">Weekly</option>
				<option value="month">Monthly</option>
				<option value="quarter">Quarterly</option>
				<option value="year">Yearly</option>
			</select>
			<input type="submit" value="Submit">
		</form>
		</div>
		<div>
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





</body>
</html>


