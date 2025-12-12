<?php
// Database configuration
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "bookmarkDB";    

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to utf8
$conn->set_charset("utf8");
?>
