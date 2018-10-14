	<?php 


	$sqlQuery = $_REQUEST['textArea'];

	$link = mysqli_connect('instacartdb.c0fzivotwa6o.us-east-1.rds.amazonaws.com', 'ttomar', 'RutgersSavita21', 'instacart', 3306);

	if(!$link){
		echo "Connection Failed. Reason :".mysqli_connect_error();
		echo "<br>";
	}

	else{

	// $sql = "SELECT * FROM departments";

		$results = mysqli_query($link, $sqlQuery);
		if (!$results) {
			die('Could not query:' . mysqli_error());
		}

		$count = mysqli_num_fields($results);
		echo "<table border='1'>";
			echo "<tr>";
			for ($x = 0; $x < $count; $x++) {
				echo "<td>".$row[$x]."</td>";
			} 
			echo "</tr>";
		}
		echo "</table>";
	}


	?>