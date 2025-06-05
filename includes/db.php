<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "booknest";

$conn = new mysqli($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!";
