<?php
    $title = " | Users";
    include("header.php");
  
    echo "<h1>Users</h1>";

    $username = $_SESSION['username'];
  
    $query = "SELECT uid FROM logininfo WHERE username='{$username}'";
    $result = pg_query($dbconnect, $query);
    $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);

    $uid = $array['uid'];

    if ($_REQUEST['requestFriend'] != NULL) {
        $requestedFriendUid = $_REQUEST['requestFriend'];

        $timestamp = date("Y-m-d H:i:s");

        $query = "INSERT INTO friendrequests (uid1, uid2, requesttime, response, responsetime) VALUES ('{$uid}', '{$requestedFriendUid}', '{$timestamp}', '', NULL)";

        pg_query($dbconnect, $query);
    }

    if ($uid != "") {
        // Create form
	    echo "<form class=\"form-inline\" action=\"users.php\" method=\"post\">\n" .
             "  <div class=\"form-group\">\n" .
             "    <input class=\"form-control\" type=\"text\" name=\"first_name\" placeholder=\"First Name\">" .
             "    &nbsp;" .
             "    <input class=\"form-control\" type=\"text\" name=\"last_name\" placeholder=\"Last Name\">" .
             "    &nbsp" .
             "    <input class=\"btn btn-primary\" type=\"reset\" value=\"Reset\">" .
             "    <input class=\"btn btn-primary\" type=\"submit\" value=\"Search\">" .
             "  </div>\n" .
             "</form>\n";

        if ($_REQUEST['first_name'] != NULL && $_REQUEST['last_name'] != NULL) {
            $firstName = $_REQUEST['first_name'];
            $lastName = $_REQUEST['last_name'];
            $query = "SELECT * FROM userinfo WHERE first_name='{$firstName}' AND last_name='{$lastName}'";
            $result = pg_query($dbconnect, $query);
            $numberOfFields = pg_num_fields($result);

 	        echo "<form action=\"users.php\" method=\"post\">\n";

	        // Print the table header with the field names.  Use bold font.
	        echo "<table id=\"user_table\" align=\"center\" class=\"table table-striped\">\n";
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
                     "  <button name=\"requestFriend\" value=\"{$array['uid']}\" class=\"btn btn-primary btn-xs\">" . 
                     "  <span class=\"glyphicon glyphicon-add\">" .
                     "  </span>&nbsp;Friend Request</button>" .
                     "</td>";
		        echo "</tr>\n";	
	        }

	        echo "</table>\n";
            echo "</form>\n";
        }

        
    }
	
	//Close the database when done.
	pg_close($dbconnect);

	include("footer.php");
?>
