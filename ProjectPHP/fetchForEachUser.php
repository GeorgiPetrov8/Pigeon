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

if(isset($_POST['post_id_user'])){
	
	$idOfPostUser = $_POST['post_id_user'];
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
	$skip = isset($_POST['skip']) ? intval($_POST['skip']) : 0;
	$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 0;

	$sql = "SELECT * FROM user_posts WHERE userEmail = ? ORDER BY idOfPost DESC LIMIT $limit OFFSET $skip";
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
	
} else if (isset($_POST['email_user'])){
	
	$getUserEmail = $_POST['email_user'];
	
	// Get limit and skip values from the request
	$skip = isset($_POST['skip']) ? intval($_POST['skip']) : 0;
	$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 0;

	$sql = "SELECT * FROM user_posts WHERE userEmail = ? ORDER BY idOfPost DESC LIMIT $limit OFFSET $skip";
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