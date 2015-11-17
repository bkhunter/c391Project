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

		<title>
			Olap Analysis
		</title>

	<link rel="stylesheet" type="text/css" href= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel ="stylesheet" type ="text/css" href="Olap.css">
	
	<body>
	
			<div class ="page">
				<div class = "page-header">
				<h1 class ="title"> Olap Analysis</h1>			
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
		<?php echo "Yearly" ?>
	</body>
</html>



