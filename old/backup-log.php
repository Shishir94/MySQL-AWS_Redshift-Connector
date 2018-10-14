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
		$row_vals = $results;
		if (!$results) {
			die('Could not query:' . mysqli_error());
		}

		$values = mysqli_fetch_all($results,MYSQLI_ASSOC);
		// $columns = array();

		// if(!empty($values)){
		// 	$columns = array_keys($values[0]);
		// }

		$count = mysqli_num_fields($results);
		echo "<table border='1'>";
		// echo "<tr>";
		// for ($y = 0; $y < $count; $y++) {
		// 		echo "<th>".$columns[$y]."</th>";
		// } 
		// echo "</tr>";
		// while($row = mysqli_fetch_array($results)) {
			echo "<tr>";
			for ($x = 0; $x < $count; $x++) {
				echo "<td>".$row[$x]."</td>";
			} 
			echo "</tr>";
		}
		echo "</table>";
	}





	


		// while ($fieldinfo=mysqli_fetch_field($results))
		// {
		// 	printf("Name: %s\n",$fieldinfo->name);
		// 	printf("Table: %s\n",$fieldinfo->table);
		// 	printf("max. Len: %d\n",$fieldinfo->max_length);
		// }
		// ________________________________________________________________________
		// ________________________________________________________________________
		// $i = 0;
		// echo mysqli_num_fields($results);
		// echo mysqli_fetch_field_direct($results,1);
		// echo "<table border='1'>";
		


		// while ($i < mysqli_num_fields($results))
		// {
		// 	$meta = mysqli_fetch_field($results, $i);
		// 	echo '<td>' . $meta->name . '</td>';
		// 	$i = $i + 1;
		// }
		// echo '</tr>';

		// $i = 0;
		// while ($row = mysqli_fetch_row($result)) 
		// {
		// 	echo '<tr>';
		// 	$count = count($row);
		// 	$y = 0;
		// 	while ($y < $count)
		// 	{
		// 		$c_row = current($row);
		// 		echo '<td>' . $c_row . '</td>';
		// 		next($row);
		// 		$y = $y + 1;
		// 	}
		// 	echo '</tr>';
		// 	$i = $i + 1;
		// }
		// echo '</table>';
		// mysql_free_result($results);
		// ________________________________________________________________________
		// ________________________________________________________________________













		


	?>