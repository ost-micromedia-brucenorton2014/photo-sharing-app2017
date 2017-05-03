<?php
  
  $host = "localhost";
  $user = "photo_sharing17";
  $password = "***your_password***";
  $db = "photo_sharing2017";
  $mysqli = new mysqli($host, $user, $password, $db);
  if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }else{
    //echo("Connected successfully to $db as $user");
  }
?>