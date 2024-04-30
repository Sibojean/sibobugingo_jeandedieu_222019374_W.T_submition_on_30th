<?php
// Connection details
$host = "localhost";
$user = "sibobugingojeandedieu";
$pass = "222019374";
$database = "online_banking";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}