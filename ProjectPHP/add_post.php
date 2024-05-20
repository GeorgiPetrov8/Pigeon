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

session_start();

// Retrieve the value of the session variable
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    echo "404 page not found, please login again";
}

//get id of user
$stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id']; 
    }
} else {
    echo "User with email $userEmail not found.";
}
$stmt->close();

//get name of user
$stmt = $conn->prepare("SELECT username FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user = $row['username']; 
    }
} else {
    echo "User with email $userEmail not found.";
}
$stmt->close();

$title = $_POST['Tpost'];
$post = $_POST['NewPost'];
$date = date("Y-m-d");

$stmt = $conn->prepare("INSERT INTO user_posts (id, User, userEmail, Title, Post, date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $id, $user, $email, $title, $post, $date);
$stmt->execute();

$stmt->close();

//update the number of posts
$sql = "SELECT postsNumber FROM user WHERE id = $id"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPostCount = $row["postsNumber"];

    $updateNumber = $currentPostCount + 1;

    $updateSql = "UPDATE user SET postsNumber = $updateNumber WHERE id = $id";
    $updateResult = $conn->query($updateSql);

} else {
    echo "No posts found for the user.";
}

$conn->close();

header('Location: main.php'); 
?>