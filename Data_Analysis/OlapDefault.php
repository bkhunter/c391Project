<html>
	<style>
			<style>
			
			table#sTimeF {
				
				background-color: gray;
			}

			table#results {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				width: 88%;
			}
	
			table#sensors {
				width: 100%
			}


			ul#Times {
				border: 1px black;
				list-style-type: none;
				padding: 0;
			}

			ul#Times li a {
				background-color: gray;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
			}

			ul#Times li a:hover {
				background-color: black;
			}


			ul#default {
				border: 1px black;
				list-style-type: none;
				padding: 0;
			}

			ul#default li a {
				background-color: black;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
			}

			ul#default li a:hover {
				background-color: black;
			}

		</style>

	<head>
		<title>
			Olap Analysis
		</title>
		
		<meta charset="utf-8">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="Olap.css">
	
	<body>
		<div class ="page">
			<div class = "page-header">
			<h1 class ="title"> Olap Analysis</h1>			
		</div>

		<div class="LoginForm container">
					<h2 class ="LoginHeader"> Select Search Criteria </h2>
						
				</div>	

		<div class>
		  <h2>Paramters</h2>
		  <form role="form">
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
		</form>
		</div>

		<div class="floatLeft">
			<table id = "sTimeF" border = "1">
				<th> Select Timeframe </th>
					<tr>
						<td>	
							<ul id="default">
								<li><a href="OlapDefault.php">Total</a></li>
							</ul> 
						</td>
					</tr>
					<tr>
						<td>	
							<ul id="Times">
							  <li><a href="OlapDaily.php">Daily</a></li>
							</ul> 
						</td>
					</tr>
					<tr>
						<td>
							<ul id="Times">
							  <li><a href="OlapWeekly.php">Weekly</a></li>
							</td>
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
							  	<li><a href="OlapMonthly.php">Monthly</a></li>
							</ul> 
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
							  <li><a href="OlapQuarterly.php">Quarterly</a></li>
							</ul> 
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
								<li>
									<a href="OlapYearly.php">Yearly</a>
								</li>
							</ul> 
						</td>
					</tr>
			</table>
		</div>
			<div class="floatRight">
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


