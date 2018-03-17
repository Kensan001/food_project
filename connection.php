<?php

// Load configuration as an array. Use the actual location of your configuration file
$config = parse_ini_file ('C:\wamp64\www\brackets\Projectwerk\config.ini');

// Try and connect to the database
$connection = mysqli_connect('localhost:3306',$config['username'],$config['password'],$config['dbname']);

// If connection was not successful, handle the error
if($connection == false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
    die("Connection failed: " . $conn->connect_error);
}

?>
