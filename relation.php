<?php
	$relationNumber = $_REQUEST['title'][strlen($_REQUEST['title']) - 1];
	$title = " | Relation #".$relationNumber;
	include("header.php");

	echo "<h1>Relation #{$relationNumber}</h1>";

	$relation = $_REQUEST['title'];
	$query = "";
	switch ($relation) {
		case 'relation1':
			$query = "SELECT * FROM actin limit 20;";
			break;

		case 'relation2':
			$query = "SELECT * FROM director limit 20;";
			break;

		case 'relation3':
			$query = "SELECT * FROM movieinfo limit 20;";
			break;

		case 'relation4':
			$query = "SELECT * FROM performer limit 20;";
			break;

		case 'relation5':
			$query = "SELECT * FROM userinfo limit 20;";
			break;
		
		default:
			break;
	}

	if ($query != '') {
		//Get the result of the query
		$result = pg_query($dbconnect, $query);
		
		//And record the number of fields from the query.
		$numberOfFields = pg_num_fields($result);
		
		//Print the table header with the field names.  Use bold font.
		echo "<table align=\"center\" class=\"table table-striped\">\n";
		echo "<tr>\n";
			for ($i=0; $i<$numberOfFields; $i++) {
				$fieldName = pg_field_name($result, $i);
				$fieldType = pg_field_type($result, $i);
				echo "<th>{$fieldName} ({$fieldType})</th>\n";
			}
		echo "</tr>";
		

		//Then, print all the results of the query.
		while($array = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
			echo "<tr>\n";
			foreach($array as $elem) {
				echo "<td>".$elem."</td>\n";
			}
			echo "</tr>\n";	
		}

		echo "</table>\n";
	} else {
		
	}
	
	//Close the database when done.
	pg_close($dbconnect);

	include("footer.php");
?>
