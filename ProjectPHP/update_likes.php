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


if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
	$user_email = $_POST['user_email'];

    //$query = "SELECT likes FROM user_posts WHERE idOfPost = ?";
    
    if ($_POST['action'] === 'like') {
        
        $query = "UPDATE user_posts SET likes = likes + 1 WHERE idOfPost = ?";
		$stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        
		$stmt->execute();
        $stmt->close();
		
		$query1 = "INSERT INTO user_likes (idOfPost, userEmail) VALUES (?, ?)";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("is", $post_id, $user_email);
        $stmt1->execute();
        $stmt1->close();

    } elseif ($_POST['action'] === 'unlike') {
        
        $query = "UPDATE user_posts SET likes = GREATEST(likes - 1, 0) WHERE idOfPost = ?";
		$stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        
		$stmt->execute();
        $stmt->close();
		
		$query1 = "DELETE FROM user_likes WHERE idOfPost = ? AND userEmail = ?";
		$stmt1 = $conn->prepare($query1);
		$stmt1->bind_param("is", $post_id, $user_email);
		$stmt1->execute();
		$stmt1->close();
    }

}

$conn->close();
?>