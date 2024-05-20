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

if (isset($_POST['post_id'], $_POST['user_email'])) {
    $post_id = $_POST['post_id'];
	$email = $_POST['user_email'];
	
	$query = "DELETE FROM user_likes WHERE idOfPost = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$stmt->close();
	
	$query1 = "DELETE FROM user_posts WHERE idOfPost = ? AND userEmail = ?";
	$stmt1 = $conn->prepare($query1);
	$stmt1->bind_param("is", $post_id, $email);
	$stmt1->execute();
	$stmt1->close();
	
	$query2 = "UPDATE user SET postsNumber = postsNumber - 1 WHERE email = ?";
	$stmt2 = $conn->prepare($query2);
	$stmt2->bind_param("s", $email);
	$stmt2->execute();
	$stmt2->close();
    
}else {
    echo 'Missing parameters';
}

$conn->close();
?>