<?php 
  include('functions.php');

  if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel="stylesheet" href="css/menu.css">
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import 'https://fonts.googleapis.com/css?family=Roboto+Mono:100';
html,
body {
  font-family: 'Roboto Mono', monospace;
  background: #212121;
  height: 100%;
}
.header {
  width: 40%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
.container {
  height: 100%;
  width: 100%;
  justify-content: center;
  align-items: center;
  display: flex;
}
.text {
  font-weight: 100;
  font-size: 28px;
  color: #fafafa;
}
.dud {
  color: #757575;
}
form, .content {
  width: 40%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}

.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>
<body style="background:linear-gradient(to right top, #050744, #004283, #007fb8, #00bee1, #5fffff); overflow: hidden;">
<div class="parent">     

  <ul class="menu cf">
    <li><a href="INDEX.php">Home</a></li>
    <li><a href="player/player.php">Players</a> </li>
    <li><a href="premium/premium.php">Premium</a></li>
    <li><a href="home.php">Profile</a></li>   
    <li><a href="logout.php">Logout</a></li>
  </ul>
  <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
             
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- logged in user information -->
    <div class="profile_info">
     

      <div>
        <?php  if (isset($_SESSION['user'])) : ?>
          

         
        <?php endif ?>
  
      <div class="container" style="margin-top: 20%;">
    <div class="text" style="font-size: 33px; font-weight: 900; outline: inherit; text-decoration-style: doted;"></div>
  </div>
    
      </div>

    <script  src="prem/js/indexx.js"></script>




</body>

</html>
