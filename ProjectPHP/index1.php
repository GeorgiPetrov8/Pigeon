<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="login_css.css">

<title>Pigeon</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="pass_check.js"></script>
<style>

.error-message {
  color: red;
  font-weight: bold;
  font-size: 16px;
  text-align: center;
}

</style>
</head>

<body>
<!--Title-->

<div class="pen-title" onclick="redirectToIndex()">
  <h1>Pige<img src="logo.png" alt="Pigeon" class="logo" >n </h1>
</div>

<!-- Form Module-->
<div class="form-module">
  
  <!-- Login -->
  <div class="form">
  
	<div class="toggle">
  
		<div class="tooltip">Register</div>
	
	</div>
  
    <h2>Login to your account</h2>
	
    <form id="login_form" action="login.php" method="post">
	
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="password" placeholder="Password" required>
      
	  <input class="button" type="submit" name="Login">
	  
    </form>
	
	<?php
      if (isset($_GET['error']) && $_GET['error'] === 'worg_cred') {
        echo "<p class='error-message'>Password and E-mail do not match</p>";
      }
    ?>
	
	<?php
      // Check if the error query parameter is present and contains the expected value
      if (isset($_GET['error']) && $_GET['error'] === 'email_in_use') {
        echo "<p class='error-message'>Email is already in use. Please try to login or choose a different email.</p>";
      }
    ?>
	
  </div>
  
  <!-- Create Acc -->
  <div class="form">
  
	<div class="toggle">
  
		<div class="tooltip">Login</div>
	
	</div>
	
    <h2>Create an account</h2>
	
    <form id="createAcc" action="register.php" method="post" onsubmit="return checkPass(event);">
		
		<input type="text" name="text" placeholder="Username" required>
		<input type="password" id="pass1" name="pass1" placeholder="Password" required>
		<input type="password" id="pass2" name="pass2" placeholder="Confirm Password" required>
		<input type="email" name="email" placeholder="Email Address" required>
      
		<input class="button" type="submit" name="Register">
		
	</form>

	
  </div>

  <!-- Forgot Pass -->
  <div class="cta"><a href="forgot.php">Forgot your password?</a></div>
  
</div>

<script src="login_animation.js"></script>
<script>alert("Email was sent to reset password");</script>
</body>

</html>