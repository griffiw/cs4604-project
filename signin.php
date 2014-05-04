<?php
  $title = " | Sign In";
  include("header.php");

  if ($_REQUEST['username'] != null && $_REQUEST['password'] != null) {

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $query = "SELECT password FROM logininfo WHERE username='{$username}'";
    
    $result = pg_query($dbconnect, $query);

    $array = pg_fetch_array($result, NULL, PGSQL_ASSOC);

    pg_close($dbconnect);

    if ($password == $array['password']) {
      // success
      $_SESSION['username'] = $username;
      header('Location: index.php');
      die();

    }
    else {
      //failure
    }
  }
?>

<form class="form-signin" role="form" method="post" action="signin.php">
  <h2 class="form-signin-heading">Please sign in</h2>
  <input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
  <input name="password" type="password" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

<?php
  include("footer.php");
?>
