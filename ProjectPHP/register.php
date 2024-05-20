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
$username = $_POST["text"];
$pass = $_POST["pass1"];
$email = $_POST["email"]; 


// SQL query to check if the email exists in the database
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    // Email exists in the database
    echo "Email exists in the database.";
	
	// Close the connection
	$conn->close();
	
	header("Location: index.php?error=email_in_use");
    exit();
	
} else {
	
    // Email does not exist in the database
    $sql = "INSERT INTO user (username, email, password, postsNumber)
	VALUES ('$username', '$email', '$pass', '0')";
	
	$conn->query($sql);
	
	// Close the connection
	$conn->close();
	
	//Create session
	
	session_start();
	$_SESSION['username'] = $username;
	
	header("Location: main.php");
	exit();
}

?>
