<?php
require_once "config.php";

session_start();

// Define variables and initialize with empty values
$notename =  $password= $confirm_password=$notedetails="" ;
$notename_err = $password_err= $confirm_password_err=$notedetails_err="" ;


// check if submit is clicked

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_notename = trim($_POST['NoteName']);
	if(empty($input_notename)){
		$notename_err = "Note name  is required";
	}else{
		$sql = "SELECT * FROM notes WHERE NoteName = '$input_notename'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $notename_err= "Note with this name already exists!";
			}else{
				$notename = $input_notename;
			}
		}else{
			 echo "Something went wrong";
		}

	}

	$input_password = trim($_POST['Password']);
	if(empty($input_password)){
		$password_err = "Password is required";
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

    $input_notedetails= trim($_POST['NoteDetails']);
	if(empty($input_notedetails)){
		$notedetails_err = "Add some notes";

	}else{
		$notedetails = $input_notedetails;
	}

   
/*

	
 $input_data=trim($_POST['real-file']);
        if(empty($input_data)){
            $data_err="Attach a document";
        }else{
           $data=$input_data;
        }
    if(isset($_POST['btn'])){
        $data=file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt=$conn->prepare("insert into notes(Doc) values($data)");
        $stmt->bind_param(1,$data);
        $stmt->execute();

    }
*/

	// create account
	if(empty($notename_err)&& empty($password_err) && empty($confirm_password_err) && empty($notedetails_err)){
		$sql = "INSERT INTO notes (NoteName, Password,NoteDetails)
				VALUES('$notename','$password','$notedetails')";
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
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .open-button {
    background-color: #555;
    color: white;
    padding: 20px 10px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    width: 280px;
    }

    /* The popup form - hidden by default */
    .form-popup {
    display: none;
    position: center;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
    max-width: 100px;
    padding: 10px;
    background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=password] {
    width: 300%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
    background-color: #04AA6D;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
</style>
</head>
<body>
<div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxs-parking'></i>
            <span class="logo_name">Password Manager</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="notes.php">
                    <i class='bx bx-notepad'></i>
                    <span class="link_name">Notes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="notes.php">Notes</a></li>
                </ul>
            </li>
            <li>
                <a href="Address.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Address</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="Address.php">Address</a></li>
                </ul>
            </li>
            <li>
                <a href="payment.php">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Payment Method</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="payment.php">Payment Method</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-low-vision'></i>
                        <span class="link_name">Password</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="socialmedia.php">Password</a></li>
                    <li><a href="socialmedia.php">Social Media</a></li>
                    <li><a href="entertainment.php">Entertainment</a></li>
                    <li><a href="education.php">Education</a></li>
                    <li><a href="mail.php">Mail</a></li>
                </ul>
            </li>
            <li>
                <a href="softwareLicence.php">
                    <i class='bx bxs-key'></i>
                    <span class="link_name">Software Licence</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="softwareLicence.php">software Licence</a></li>
                </ul>
            </li>
            <li>
                <a href="breaches.php">
                    <i class='bx bx-bug-alt'></i>
                    <span class="link_name">Breached Accounts</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="breaches.php">Breached Accounts</a></li>
                </ul>
            </li>
            <li>
                <a href="passGeneretor.php">
                <i class='bx bxs-shield-alt-2'></i>
                    <span class="link_name">Password Generater</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="passGeneretor.php">Password Generater</a></li>
                </ul>
            </li>
            <li>
                <a href="login.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <span class="link_name">LogOut</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="login.php">LogOut</a></li>
                </ul>
            </li>
            
            </li>
        </ul>
</div>
    
    <!-- The Note Form -->
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Password Manager</span>
        </div>
        <div class="container">
            <div class="text" style="font-size: xx-large; margin-left: 300px;">NOTES PAGE</div>
				<div class="row">
					<div class="column" style="margin-left: 100px; margin-top: 15px;">
                        <form role="form" method="post" action="notes.php">
					  		<div>
							    <label for="NoteName">Note Name:</label>
					    	    <input type="text" class="form-control" id="NoteName" name="NoteName" >
					  		
                                <label  style="margin-top: 15px;">Require master password promt: </label>
                                <input class="open-button" type="checkbox" name="advsetting" id="advsetting" name="advsetting" onclick="openForm()"/>
                                    <!-- Pop Up Form-->
                                        <div class="form-popup" id="myForm">
                                            <form  action="notes.php" class="form-container" method="post">
                                               
                                                <div class="form-group">
                                                    <label for='Password'>Password: </label>
                                                    <input type="password" class="form-control" id="Password" name="Password">
                                                    <span class="text-danger"><?php echo $password_error; ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for='confirm_password'>Confirm Password: </label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                                    <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                                                </div>
                                                <button type="cancel" class="btn btn-primary" onclick="closeForm()">Close</button>
                                            </form>
                                            
                                        </div>
                                        
                                        <div class="col-sm-4" style=" margin-top: 15px;" >
                                        <label for="NoteDetails">Note Details:</label>
                                            <textarea style="margin-left: 30px;" rows = "15" cols = "25" name = "NoteDetails" id="NoteDetails" placeholder="Add some">
                                      </textarea> 
                                        </div>
                                        <div style="margin-top: 15px;">
                                <button type="submit" class="btn btn-primary" value="Save">Save</button>
                                <button type="cancel" class="btn btn-primary" value="cancel">Cancel</button> 
                            </div> 
					  		</div>  
                              <!-- 
                                   
					  		<div class="form-group">
								<input type="file" id="real-file" name="real-file" hidden="hidden" />
								<button type="button"  id="custom-button" class="btn btn-primary" name="Doc">Attach</button>
								<span id="custom-text">No file chosen, yet.</span>	
							</div>
-->
                    </div>
                        
                        </form>
                    </div>
				</div> 
			
						
		</div>
    </section>
    <script src="js/note.js "></script>
    <script src="js/script.js "></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>


</body>
</html>
