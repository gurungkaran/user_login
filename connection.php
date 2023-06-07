<?php
 // Server and Database details
 $server = "localhost";
 $database = "sunderland";
 $user = "root";
 $dbpassword = "";

// Save connection instance in a variable
 $connect = new mysqli($server, $user, $dbpassword, $database);

// Check the connection
 if ($connect->connect_error)
 {
   die("Connection failed:");
 }

?>