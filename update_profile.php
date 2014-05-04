<?php
  $title = " | Profile";
  include("header.php");

  $username = $_SESSION['username'];

  $dbconnect = pg_connect("port=5432 dbname=hokiemedia user=homerunh password=soccer") or die ('failed to connect:'.pg_last_error());

  if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['age']) && isset($_POST['gender']) 
      && isset($_POST['location']) && isset($_POST['password'])) {

    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];

    $query = "SELECT uid FROM logininfo WHERE username='{$username}'";
    $result = pg_query($dbconnect, $query);
    $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);

    $uid = $array['uid'];

    if ($uid != "") {
      $update = "UPDATE logininfo SET (password) = ('{$password}') WHERE uid='{$uid}'";
      pg_query($dbconnect, $update);

      $update = "UPDATE userinfo SET (first_name, last_name, age, gender, location) = ('{$firstName}', '{$lastName}','{$age}', '{$gender}', '{$location}') WHERE uid='{$uid}'";
      pg_query($dbconnect, $update);

      pg_close($dbconnect);
      header('Location: profile.php');
    }
  }
  
  pg_close($dbconnect);

  include("footer.php");
?>
