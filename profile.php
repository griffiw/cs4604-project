<?php
  $title = " | Profile";
  include("header.php");

  $username = $_SESSION['username'];

  $dbconnect = pg_connect("port=5432 dbname=hokiemedia user=homerunh password=soccer") or die ('failed to connect:'.pg_last_error());

  $query = "SELECT username, password, first_name, last_name, age, gender, location FROM logininfo AS L, userinfo AS U WHERE (L.uid=U.uid AND username='{$username}')";

  $result = pg_query($dbconnect, $query);

  $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);

  echo '<form class="form-signin" role="form" method="post" action="edit_profile.php">';
  echo "  <h2 class=\"form-signin-heading\">Profile for {$username}</h2>";

  $i = 0;
  foreach ($array as $elem) {
    $fieldName = pg_field_name($result, $i++);
    $label = ucwords(str_replace('_', ' ', $fieldName));

    echo "  <label>".$label."</label>";
    echo "  <input name=\"{$fieldName}\"type=\"text\" class=\"form-control\" value=\"{$elem}\" disabled>";
  }

  echo "<br>";
  echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Edit</button>";
  echo '</form>';

  pg_close($dbconnect);

  include("footer.php");
?>
