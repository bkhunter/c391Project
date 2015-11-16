<html>

	<head>

		<style>
			<style>
			
			table#sTimeF {
				
				background-color: gray;
			}

			table#results {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				width: 88%;
			}
	
			table#days {
				width: 100%
			}


			ul#Times {
				border: 1px black;
				list-style-type: none;
				padding: 0;
			}

			ul#Times li timeSpec {
				background-color: gray;
				color: white;
				padding: 10px 20px;
				text-decoration: none;
				display: block;
			}

			ul#Times li timeSpec:hover {
				background-color: black;
			}
		</style>

		<title>
			Olap Analysis
		</title>


	</head>

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
							<ul id="Times">
							  <li><timeSpec href="/html/default.asp">Daily</a></li>
							</ul> 
						</td>
					</tr>
					<tr>
						<td>
							<ul id="Times">
							  <li><timeSpec href="/css/default.asp">Weekly</a></li>
							</td>
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
							  	<li><timeSpec href="/js/default.asp">Monthly</a></li>
							</ul> 
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
							  <li><timeSpec href="/php/default.asp">Quarterly</a></li>
							</ul> 
						</td>
					</tr>

					<tr>
						<td>	
							<ul id="Times">
								<li><timeSpec href="/php/default.asp">Yearly</a></li>
							</ul> 
						</td>
					</tr>
			</table>
		</div>
		<div class="floatRight">
			<table id="results" border = "1">
				<tr>
					<th>Sensor ID</th>
					<th>Location1</th>
					<th>Location2</th>
				</tr>
				<tr>
					<td>1</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
					<tr>
					<td>2</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>6</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
							</tr>
						</table>
					</td>
					<td>
						<table id="days" border = "1">
							<th> mon </th>
							<th> tue </th>
							<th> wed </th>
							<th> thu </th>
							<th> fri </th>
							<th> sat </th>
							<th> sun </th>
							<tr>
								<td> value </td>
								<td> value </td>
								<td> value </td>
								<td> value </td>
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



