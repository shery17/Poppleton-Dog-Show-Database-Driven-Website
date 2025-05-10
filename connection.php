<?php
// Login Details
$servername = "localhost:3306";
$username = "u2176796";
$password = "SA17nov01sa";
$dbname = "u2176796";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "<br>";
}
else 
{
    echo "Connection successful.";
    echo "<br>";
}
?>