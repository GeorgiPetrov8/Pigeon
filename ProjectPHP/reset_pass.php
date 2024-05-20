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

// Email to check
$email = $_POST["email"]; 


// SQL query to check if the email exists in the database
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	// Close the connection
	$conn->close();
	
	header("Location: index1.php");
    exit();
	
} else {
	
	$conn->close();
	
	header("Location: index.php?error=no_user");
	exit();
}

?>
