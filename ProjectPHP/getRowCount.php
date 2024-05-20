<?php
	
// Establish a connection to your MySQL database
$serverName = "localhost"; 
$usernameServer = "user1"; 
$passwordServer = "1234"; 
$dbname = "pigeon"; 
$port = 3307;

// Create connection
$conn = new mysqli($serverName, $usernameServer, $passwordServer, $dbname, $port);
	
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT COUNT(*) as totalRows FROM user_posts";

$result = $conn->query($sql);

if ($result) {
	
    $row = $result->fetch_assoc();
    $totalRows = $row['totalRows'];
    echo json_encode(['totalRows' => $totalRows]);
	
} else {
    echo json_encode(['error' => 'Error executing query']);
}

$conn->close();
?>