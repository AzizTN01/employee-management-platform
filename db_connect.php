<?php 

$conn= new mysqli('localhost','root','','stage')or die("Could not connect to mysql".mysqli_error($conn));
mysqli_set_charset($conn,"utf8");
