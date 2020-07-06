
<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dbms');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
					}
	if (isset($_POST['upgrade_btn'])) {
	  upgrade(); // put logged in user in session
				}		

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: login.php");
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		$sql_u = "SELECT * FROM users WHERE username='$username'";
  	
  	  $res_u = mysqli_query($db, $sql_u);
  	

  	if (mysqli_num_rows($res_u) > 0) {
  	      array_push($errors,"Sorry... username already taken"); 	
  	}


		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password,premium) 
						  VALUES('$username', '$email', '$user_type', '$password','no')";
		    	  $meh="SELECT id from users where username ='$username'";	
						  
					  
				mysqli_query($db, $query);
				$blah=mysqli_query($db,$meh);
				$id=mysqli_fetch_assoc($blah);
				$in=$id['id'];
				$sql = "INSERT INTO login_track (id,action,username,cur_time,prev_time,count,points,streak) 
						  VALUES('$in', 'Login', '$username', now(),now(),'0','5','0')";
				mysqli_query($db,$sql);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (username, email, user_type, password,premium) 
						  VALUES('$username', '$email', 'user', '$password','no')";
					  
				$meh="SELECT id from users where username ='$username'";		  
				mysqli_query($db, $query);
				$blah=mysqli_query($db,$meh);
				$id=mysqli_fetch_assoc($blah);
				$in=$id['id'];
				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);
				$_SESSION['user'] = getUserById($logged_in_user_id);
				$sql = "INSERT INTO login_track (id,action,username,cur_time,prev_time,count,points,streak) 
						  VALUES('$in', 'Login', '$username', now(),now(),'0','5','0')";		
				//$id=mysqli_query($db,$meh);
				mysqli_query($db,$sql); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
			}

		}

	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);
		$use=$username;
		$pass=$password;

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		//	$cur="UPDATE login_track set prev_time=now(),count=1 where username='$username'and count='0'";
			$s="UPDATE login_track set cur_time=now() where username='$username'"; 
			$time="SELECT login_track.cur_time,login_track.prev_time,login_track.id,login_track.username,users.premium from login_track inner join users ON users.id=login_track.id where users.username='$username'";

			$results = mysqli_query($db, $query);
			mysqli_query($db,$cur);	
	        mysqli_query($db,$s);	
	        $row=mysqli_query($db,$time);
	        $result=mysqli_fetch_assoc($row);
	        $cur=$result["cur_time"];
			$prev=$result["prev_time"]; 
			$hourdiff = round((strtotime($cur) - strtotime($prev))/60, 1);
			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);							//checktime($username);
				if($hourdiff<='3')
				{
///$upd="UPDATE login_track set points=points+5 where id='16' and count='0'";
	//$conn->query($upd);
					$count="UPDATE login_track set count=1 where username='$username'";
					mysqli_query($db,$count);
				}
					elseif($hourdiff>'3' and $hourdiff<='6')
				{
					$count="UPDATE login_track set count=0,points=points+(5*streak),prev_time=now(),streak=streak+1 where username='$username'";
					mysqli_query($db,$count);
				}	
				else
				{
				$count="UPDATE login_track set count=0,points=points+5,prev_time=now(),streak=0 where username='$username'";
				mysqli_query($db,$count);	
				}

				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/admin.php');		  
				}elseif ($logged_in_user['user_type'] == 'user' && $logged_in_user['premium']=='no') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
                   	header('location: index.php');
				}
				elseif($logged_in_user['user_type'] == 'user' && $logged_in_user['premium']=='yes') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
                  	header('location: prem/index.php');
           			}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}


	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

	function upgrade(){

		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		//$point="SELECT login_track.points,login_track.id,login_track.username,users.premium from login_track inner join users ON users.id=login_track.id where users.username='$username'";
		if (count($errors) == 0) {
			$point="SELECT login_track.points from login_track inner join users ON users.id=login_track.id where users.username='$username'";
			$id= mysqli_query($db,$point);
			$res=mysqli_fetch_assoc($id);
			if(mysqli_num_rows($id)==1){
			$cur_point=$res["points"];	
			}
			$password = md5($password);
			
			if($username==$_SESSION['user']['username'])
			{		
				if($cur_point>=50)
				{
			
			$query = "UPDATE users SET premium = 'yes' WHERE username='$username' AND password='$password' LIMIT 1";
			$res = mysqli_query($db, $query);
			$sql= "SELECT * from users WHERE username='$username' AND password='$password' LIMIT 1"; 
			$results = mysqli_query($db, $sql);
			$prem_upgrade="UPDATE login_track SET points=points-50 where username='$username'";
			mysqli_query($db,$prem_upgrade);
			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/admin.php');		  
				}elseif ($logged_in_user['user_type'] == 'user' && $logged_in_user['premium']=='yes') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: ../prem/index.php');
				}
			}
		
			else
			{
				echo "please enter correct username and password";
				header('location: ../index.php');
			}
			}
			 else 
		 {
		 	array_push($errors, "Insufficient points");
		 }
}			
		else {
				array_push($errors, "Wrong username/password combination");
			}
		
		
		}	
		}

		

?>

