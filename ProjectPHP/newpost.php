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

<link rel="stylesheet" href="main_body.css">
<link rel="stylesheet" href="new_post.css">

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
    <div class="middle-section">
		
		<form class="content-form" action="add_post.php" method="post">
			
			<label class="TitlePost">Title:</label><br>
			<input type="text" id="Tpost" name='Tpost' maxlength="90" required><br><br>
			
			<label class="NewPost">Post:</label><br>
			
			<div class="textarea-wrapper">
				<textarea class="ActualPost" id="NewPost" name='NewPost' rows="6" cols="50" maxlength="500" required></textarea>
				<p id="charCount" class="char-count">Characters left: 500</p>
			</div>
			
			<input type="submit" value="Post" class="post-button">
			
		</form>

		
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
				<button onclick="location.href='profile.php'">Profile</button>
				
				<!--LogOut-->
				<form method="post" action="logout.php">
					<button type="submit">Sign Out</button>
				</form>
				
			</div>
		</div>
    </div>
	
</div>

<script src="toggle_dropdown.js"></script>
<script src="character_counter.js"></script>
</body>

</html>