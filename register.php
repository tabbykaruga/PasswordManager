<?php
require_once "config.php";
session_start();


// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// check if submit is clicked

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_username = trim($_POST['username']);
	if(empty($input_username)){
		$username_err = "Username is required";
	}else{
		$sql = "SELECT * FROM users WHERE UserName = '$input_username'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $username_err = "User with this email already exists!";
			}else{
				$username = $input_username;
			}
		}else{
			 echo "Something went wrong";
		}

	}

	$input_email = trim($_POST['email']);
	if(empty($input_email)){
		$email_err = "Email is required";

	}else{
		$email = $input_email;
	}

	$input_password = trim($_POST['password']);
	if(empty($input_password)){
		$password_err = "Password must be generated";
	}else{
		$password = $input_password;
	}


	$input_confirm_password = trim($_POST['confirm_password']);
	if(empty($input_confirm_password)){
		$confirm_password_err = "Confirm password required";
	}else{
		$confirm_password = $input_confirm_password;
		if(empty($password_err) && $password != $confirm_password){
			$confirm_password_err =  "Password's do not match";
		}
	}

	// create account
	if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
		//$hashpassword = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users(UserName, Email, Password)
				VALUES('$username', '$email', '$password')";

		if(mysqli_query($conn, $sql)){
			header("Location:notes.php");
			exit();
		}else{
			echo "Error creating account";
		}
	}else{
		echo "Field errors";
	}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Register</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 
 <body>
 <div class="container">
 	<div class="row">
 		<div class="col-md-6 offset-3">
 			<h3 class="text-center">Password Manager</h3>
 			<form action="register.php" method="post" name="myform">
 				<h3 class="text-center">Register</h3>
 				<div class="form-group">
 				<div class="form-group">
 					<label for='username'>UserName: </label>
 					<input type="text" class="form-control" id="username" name="username">
 					<span class="text-danger"><?php echo $username_err; ?></span>
 				</div>
 				 <div class="form-group">
 					<label for='email'>Email: </label>
 					<input type="email" class="form-control" id="email" name="email">
 					<span class="text-danger"><?php echo $email_err; ?></span>
 				</div>
 				 <div class="form-group ">
				  			<label for='password'>Password: </label>
 							<input type="text" class="form-control" id="password" name="password">
							 <span class="text-danger"><?php echo $password_err; ?></span>
					  
<!--					  <div class="row" style="margin-left: 0px;">
						  <div class="form-group">
						  <label for='password'>Password: </label>
 							<input type="text" class="form-control" id="password" name="password">
						  </div>
 
						 <div style="margin-top: 32px; margin-left:20px;">
						 <input type="button" class="btn btn-primary" value="Generate" onClick="randomPassword(10);" tabindex="2">

						 </div>
-->
						 
					  </div> 	 
 				</div>
				 	<label for='confirm_password'>Confirm Password: </label>
 					<input type="text" class="form-control" id="confirm_password" name="confirm_password">
 					<span class="text-danger"><?php echo $confirm_password_err; ?></span>
 				 
 				 <div class="form-group">
 					<input type="submit" class="btn btn-primary" value="Register">
 				</div>
 				<a href="login.php" class="text-center">I have an account</a>
 			</form>


 		</div>
 	</div>
 </div>
 <script>
	function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*-+ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    myform.password.value = pass;}
</script>
 <script src="js/script.js "></script>
 </body>
 </html>
