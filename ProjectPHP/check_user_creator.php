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

if (isset($_POST['post_id'], $_POST['email'])) {
    $post_id = $_POST['post_id'];
	$email = $_POST['email'];

	$sql = "SELECT COUNT(*) AS count FROM user_posts WHERE idOfPost = ? AND userEmail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $post_id, $email);

	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result) {
        $row = $result->fetch_assoc();
		if($row['count'] > 0){
			echo true;
        }else {
			echo false;
		}
    }else {
		echo 'No results';
	}
    
}else {
    echo 'Missing parameters';
}

$conn->close();
?>