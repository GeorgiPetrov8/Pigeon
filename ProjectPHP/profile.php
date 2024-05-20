<?php
session_start();

if (!isset($_SESSION['email'])) {   
    header('Location: index.php'); 
}
$username = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="mainBody.css">
<link rel="stylesheet" href="posts.css">
<link rel="stylesheet" href="goback.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Pigeon</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
<div class="container">

<!-- Left -->
    <div class="left-section">
        
		<!-- Logo -->
        <a href="main.php" style="text-decoration: none;color: inherit;">
			<div class="pen-title">
				<h1>Pige<img src="logo.png" alt="Pigeon" class="logo" >n </h1>
			</div>
		</a>
			
    </div>
    
<!-- Mid -->
    <div class="middle-section" id="middle-section">
	
		<!-- Profile -->
		<div id="profileContainer" class="profileContainer">
        
		</div>
		
		
        <!-- Posts -->
		<div id="postsContainer">
        
		</div>
		
        <!-- Add posts Button-->
		<div class="button-wrapper">
			<button class="addPost" onclick="location.href='newpost.php'">+</button>
		</div>
		
    </div>
    
<!-- Right -->
    <div class="right-section">
		
		<div class="dropdown">
			
			<!-- User Name -->
			<div class="user-name">
				<span onclick="toggleDropdown()"><?php echo $username; ?></span>
			</div>
			
			<div class="dropdown-content" id="myDropdown">
				
				<!-- Profile -->
				<button onclick="MyProfile()" id="MyProfile">Profile</button>
				
				<!--LogOut-->
				<form method="post" action="logout.php">
					<button type="submit">Sign Out</button>
				</form>
				
			</div>
		</div>
    </div>
	
</div>

<script src="toggle_dropdown.js"></script>
<script src="loadPostsForUsers.js"></script>
<script src="likePost.js"></script>
<script src="deleteFunc.js"></script>
<script src="loadProfile.js"></script>
<script src="goBack.js"></script>
</body>

</html>