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

$email = $_POST['email'];
$pass = $_POST['password'];

// Sanitize inputs before using in the query (to prevent SQL injection)
$email = $conn->real_escape_string($email);
$pass = $conn->real_escape_string($pass);

$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	session_start();
	
	// Fetch the email from the result
	$row = $result->fetch_assoc();
    $username = $row['email'];
	
	$_SESSION['email'] = $username;
	
	$conn->close();
	
	header("Location: main.php");
	exit();
	
} else {
	
	$conn->close();
	
	header("Location: index.php?error=worg_cred");
    exit();
}
?>