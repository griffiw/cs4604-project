<?php
	$queryNumber = $_REQUEST['title'][strlen($_REQUEST['title']) - 1];
	$title = " | Query #".$queryNumber;
	include("header.php");

	echo "<h1>Query #{$queryNumber}</h1>";

	$requestedQuery = $_REQUEST['title'];
	$query = "";
	switch ($requestedQuery) {
		case 'query1':
			$query = "SELECT * FROM videoinfo WHERE vid IN (SELECT vid FROM actin WHERE pid = (SELECT pid FROM performer WHERE first_name = 'Brad' AND last_name = 'Pitt')) ORDER BY release_year DESC LIMIT 10;";
			break;

		case 'query2':
			$query = "SELECT first_name, last_name, numfriends FROM userinfo, numberoffriends WHERE (numfriends = (SELECT MAX(numfriends) FROM numberoffriends) AND uid = uid1);";
			break;

		case 'query3':
			$query = "SELECT U.first_name, U.last_name, B.numratings FROM userinfo as U, (SELECT uid, COUNT(*) AS numratings FROM ratings GROUP BY uid ORDER BY numratings DESC limit 20) AS B WHERE U.uid = B.uid;";
			break;

		case 'query4':
			$query = "SELECT performer.*, moviesstarredin from performer, (SELECT pid AS pp, COUNT(*) AS moviesstarredin FROM actin GROUP BY pid ORDER BY COUNT(*) DESC LIMIT 20) AS sub1 WHERE performer.pid=sub1.pp";
			break;

		case 'query5':
			$query = "SELECT performer.*, moviesStarredIn from performer, (select pid as pp, count(*) as moviesStarredIn from actin, videoinfo where actin.vid = videoinfo.vid and videoinfo.release_year >= 1990 and videoinfo.release_year <= 2000 group by pid order by count(*) desc limit 20) as sub1 where performer.pid=sub1.pp;";
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
		echo '<table align="center" class="table table-striped table-bordered">';
		echo '<tr>';
			for ($i = 0; $i < $numberOfFields; $i++) {
				$fieldName = pg_field_name($result, $i);
				$fieldType = pg_field_type($result, $i);
				echo '<th>'.$fieldName.' ('.$fieldType.')</th>';
			}
		echo '</tr>';
		

		//Then, print all the results of the query.
		while ($array = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
			echo '<tr>';
			foreach ($array as $elem) {
				echo '<td>'.$elem.'</td>';
			}
			echo '</tr>';	
		}

		echo '</table>';
	}
				
	//Close the database when done.
	pg_close($dbconnect);

	include("footer.php");
?>
