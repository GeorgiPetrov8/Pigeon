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
  
  <!-- Forgotten password -->
  <div class="form">
  
    <h2>Forgotten password</h2>
	
    <form id="reset_pass" action="reset_pass.php" method="post">
	
      <input type="email" name="email" placeholder="E-mail" required>
      
	  <input class="button" type="submit" name="Request Password Reset">
	  
    </form>
	
  </div>
  
</div>

<script src="login_animation.js"></script>

</body>

</html>