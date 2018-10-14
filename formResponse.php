<!DOCTYPE html>
<html lang="en">
<head>
	<title>Query Entry</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/database.png"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>

	<div class="bg-contact2" style="background-image: url('images/bg-02.jpg');">
		<div class="container-contact2">
			<div class="wrap-contact2" style="text-align: center">
				<div style="text-align: center">


					<?php 

					// Accepts the query and choice of database from the user and stores them in variables
					$sqlQuery = $_REQUEST['textArea'];
					$choice = $_REQUEST['radio'];
					
					// Conditional statements to check for users choice and execute the relevant database connections. For MySQL.
					if ($choice == "1") {


						// MySQLi connection to the database through the database credentials
						$link = mysqli_connect('instacartdb.c0fzivotwa6o.us-east-1.rds.amazonaws.com', 'ttomar', 'RutgersSavita21', 'instacart', 3306);


						// Error handling for a failed connection to the database
						if(!$link){
							echo "Connection Failed. Reason :".mysqli_connect_error();
						}

						// Incase of successful connection to the MySQL Database
						else{

							// Query the database and store the results and calculates the time taken for the query to be executed.
							$time_start = microtime(true);
							$results = mysqli_query($link, $sqlQuery);
							$time_end = microtime(true);

							// Error handling incase the query doesn't yield results
							if (!$results) {
								die('Could not query:' . mysqli_error());
							}

							// HTML tags for the result table
							echo "<div style='text-align: center'>";
							echo "<span class='contact2-form-title' style='padding-bottom: 30px'>
								  RESULT
								  </span>";

							echo "<table border='1'>";
							echo "<tr>";

							// Loop to print the headers of the query result
							while ($fieldinfo=mysqli_fetch_field($results)){
								printf("<th>%s</th>",$fieldinfo->name);
							}
							echo "</tr>";

							// Fetch the number of fields in the result to be used as loop variable in future
							$count = mysqli_num_fields($results);

							// Fetch each individual row as an array to be printed to the frontend
							while($row = mysqli_fetch_array($results)) {

								echo "<tr>";
								// Loops through the row and prints each field under the respective field
								for ($x = 0; $x < $count; $x++) {
									echo "<td>".$row[$x]."</td>";
								} 
								echo "</tr>";
							}
							echo "</table>";
							echo "</div>";
							//prints the time taken to execute query
							$time = $time_end - $time_start;
							echo "<br>";
							echo "<div>Time taken to execute: ".$time." seconds</div>";

						}
					}

					// Code block to run query on AWS Redshift
					else{

						// PostgreSQL command to connect to AWS Redshift Cluster
						$connection = pg_connect("host=redshift-cluster-1.ctlxufsutwdi.us-east-1.redshift.amazonaws.com port=5439 dbname=instacart user=ttomar password=RutgersSavita21");

						// Pinging the DB to ensure connection status
						if(!pg_ping($connection)){
							die("Connection to DB Broken");
						}

						
						// Query the database and store the results and calculates the time taken for the query to be executed.
						$time_start = microtime(true);
						$results = pg_query($connection, $sqlQuery);
						$time_end = microtime(true);
						// Error handling incase the query doesn't yield results
						if (!$results) {
							die('Could not query:' . pg_last_error($connection));
						}
						// HTML tags for the result table
						echo "<div style='text-align: center'>";
						echo "<table border='1'>";
						echo "<tr>";

						// Fetch the number of fields in the result to be used as loop variable in future
						$count = pg_num_fields($results);

						// Loop to print the headers of the query result
						for ($x = 0; $x < $count; $x++) {
							echo "<th style='text-align: center'>".pg_field_name($results, $x)."</th>";
						}
						echo "</tr>";

						// Fetch each individual row as an array to be printed to the frontend
						while ($row = pg_fetch_array($results)) {
							echo "<tr>";
							// Loops through the row and prints each field under the respective field
							for ($x = 0; $x < $count; $x++) {
								echo "<td>".$row[$x]."</td>";
							}
							echo "</tr>";
						}
						echo "</table>";
						echo "</div>";
						//prints the time taken to execute query
						$time = $time_end - $time_start;
						echo "<div>Time taken to execute: ".$time." seconds</div>";
					}

					?>







				</div>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>

</body>
</html>
