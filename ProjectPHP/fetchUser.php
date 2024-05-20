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

if(isset($_POST['id_post_email'])){
	
	$idOfPostUser = $_POST['id_post_email'];
	//get email of user
	$stmt = $conn->prepare("SELECT userEmail FROM user_posts WHERE idOfPost = ?");
	$stmt->bind_param("i", $idOfPostUser);
	$stmt->execute();
	
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$getUserEmail = $row['userEmail']; 
		}
	} else {
		echo "User not found.";
	}
	$stmt->close();
	
	// Get limit and skip values from the request
	$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
	$stmt->bind_param("s", $getUserEmail);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$posts1 = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($posts1);
	} else {
		echo json_encode([]);
	}

	$stmt->close();
	
} else if (isset($_POST['email_user'])){
	
	$getUserEmail = $_POST['email_user'];

	$sql = "SELECT * FROM user WHERE email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $getUserEmail);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$posts = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($posts);
	} else {
		echo json_encode([]);
	}

	$stmt->close();
	
} else { echo 'No id';}


$conn->close();
?>