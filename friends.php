<?php
  $title = " | Friends";
  include("header.php");
  
  echo "<h1>Friends</h1>";
  
  //Connect to the database.
  $dbconnect = pg_connect("port=5432 dbname=hokiemedia user=homerunh password=soccer")or die('failed to connect:'.pg_last_error());

  $username = $_SESSION['username'];
  
  $query = "SELECT uid FROM logininfo WHERE username='{$username}'";
  $result = pg_query($dbconnect, $query);
  $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);

  $uid = $array['uid'];

  if ($_REQUEST['removeFriend'] != null) {
      // If a user deleted a friend, execute that query
      $toBeRemoved = $_REQUEST['removeFriend'];
      $query = "DELETE FROM friends WHERE (uid1={$uid} AND uid2={$toBeRemoved}) OR (uid1={$toBeRemoved} AND uid2={$uid})";

      pg_query($dbconnect, $query);
  }

  if ($uid != "") {
      $query = "SELECT COUNT(*) AS numFriends FROM userinfo, friends WHERE uid=uid2 and uid1={$uid}";
      $result = pg_query($dbconnect, $query);
      $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);
      $numberOfFriends = $array['numfriends'];

      echo '<h4>Displaying '.$numberOfFriends.' friends</h4>';
      
      $query = "SELECT uid, first_name, last_name, age, gender, location FROM userinfo, friends WHERE uid=uid2 AND uid1={$uid}";

	  $result = pg_query($dbconnect, $query);
		
	  // And record the number of fields from the query.
	  $numberOfFields = pg_num_fields($result);

      // Add search bar for friends 
      echo "<div class=\"input-group col-md-4\">" .
           "  <span class=\"input-group-addon\">" .
           "    <span class=\"glyphicon glyphicon-search\"></span>" .
           "  </span>" .
           "  <input type=\"text\" id=\"friends_search\" class=\"form-control\" placeholder=\"Search friends\">" .
           "</div><br>";
  
      // Create form
	  echo "<form action=\"friends.php\" method=\"post\">\n";

	  // Print the table header with the field names.  Use bold font.
	  echo "<table id=\"friends_table\" align=\"center\" class=\"table table-striped\">\n";
	  echo "<tr>\n";
	  for ($i = 0; $i < $numberOfFields; $i++) {
		  $fieldName = pg_field_name($result, $i);
          // Don't display uid in table
          if ($fieldName == 'uid') {
              continue;
          }
          // Remove underscore from field name and capitalize each word
          $fieldName = ucwords(str_replace('_', ' ', $fieldName));      

		  echo "<th>{$fieldName}</th>\n";
	  }
      echo "<th></th>\n";
	  echo "</tr>";
		

	  //Then, print all the results of the query.
	  while ($array = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
		  echo "<tr class=\"table-data\">\n";
          foreach ($array as $key=>$elem) {
              if ($key == 'uid') {
                  continue;
              }
              echo "<td>{$elem}</td>";
          }
          echo "<td class=\"text-center\">" .
               "  <button name=\"removeFriend\" value=\"{$array['uid']}\" class=\"btn btn-danger btn-xs\">" . 
               "  <span class=\"glyphicon glyphicon-remove\">" .
               "  </span>&nbsp;Unfriend</button>" .
               "</td>";
		  echo "</tr>\n";	
	  }

	  echo "</table>\n";
      // Close the form
      echo "</form>\n";
  }
	
	//Close the database when done.
	pg_close($dbconnect);

	include("footer.php");
?>
