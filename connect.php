<?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  //create connection
  $con = mysqli_connect($host, $username, $password, $dbname);
  //check connection if it is working or not
  if (!$con)
  {
      die("Connection failed!" . mysqli_connect_error());
  }
  ?>