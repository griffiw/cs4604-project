<?php
  $title = "| Sign Out";
  include("header.php");
  $_SESSION['username'] = NULL;
  header('Location: index.php');
  die();
?>
