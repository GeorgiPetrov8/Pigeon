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

// Get limit and skip values from the request
$skip = isset($_GET['skip']) ? intval($_GET['skip']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 0;

$sql = "SELECT * FROM user_posts ORDER BY idOfPost DESC LIMIT $limit OFFSET $skip";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($posts);
} else {
    echo json_encode([]);
}

$conn->close();
?>