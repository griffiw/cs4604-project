<?php
  session_start();

  $signedIn = false;
  if ($_SESSION['username'] !== NULL) {
    $signedIn = true;
  }

  // Connect to the database.
  $dbconnect = pg_connect("host=hokiemedia.c6m7wbbcpd0w.us-east-1.rds.amazonaws.com port=5432 dbname=hokiemedia user=hokiemedia password=soccer12")or die('failed to connect:'.pg_last_error());
?>

<html>
  <head>
    <title>CS 4604 Project 3<?php echo ($title == null ? '' : $title)?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/friends_search.js"></script>
  </head>
  <body>
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HokieMedia</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="http://courses.cs.vt.edu/~cs4604/Spring14/project/Project-Assignment3.html">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
              if ($signedIn) {
             ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              	  Manage
              	  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="profile.php">Profile</a></li>
                  <li><a href="friends.php">Friends</a></li>
                  <li><a href="users.php">Users</a></li>
                </ul>
              </li>
              <li><a href="signout.php">Sign Out</a></li>
             <?php
             } else {
             ?>
              <li><a href="signin.php">Sign In</a></li>
             <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  	<div class="container">
