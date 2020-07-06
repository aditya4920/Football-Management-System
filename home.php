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
  	<link rel="stylesheet" type="text/css" href="style.css">

  
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
			
				<?php  if (isset($_SESSION['user'])) : ?>
					<?php echo "<br />\n";echo "<br />\n";echo "<br />\n"; echo "<br />\n";echo "<br />\n";echo "<br />\n";echo "<br />\n";echo "<br />\n";echo "<br />\n";echo "<br />\n";?>
					  <div class="header" align="center">
    <h2>User Details</h2>
  </div>

					<div class="content">
					<strong><center><?php 
					echo 'Username : ';
					echo $_SESSION['user']['username']; ?></center></strong>
					<div class="profile_info">
					<center><?php 
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "dbms";

// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					$user=$_SESSION['user']['username'];


// Check connection
					if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
						}
						$sql="SELECT points,streak from login_track where username = '$user'";	
						$point=mysqli_query($db,$sql);
						$result=mysqli_fetch_assoc($point);
						echo "Points : ";
						echo $result["points"];	
						echo "<br />\n";
						echo "Your current streak : ";
						echo $result["streak"];	
						?> 
						</center>	
					<?php endif ?>
			</div></div>
		</div>
	</div>
	    <script  src="js/index.js"></script>

</body>
</html>