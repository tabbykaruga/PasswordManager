<?php
require_once('config.php');
 session_start();

$URL = $Name  = $UserName = $SitePassword = "";
$URL_err = $Name_err= $UserName_err = $SitePassword_err = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_URL = trim($_POST['URL']);
	if(empty($input_URL)){
		$URL_err = "URL is required";
	}else{
		$sql = "SELECT * FROM socialmedia WHERE URL = '$input_URL'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $URL_err = "URL already exists!";
			}else{
				$URL = $input_URL;
			}
		}else{
			 echo "Something went wrong with url";
		}

	}

	$input_Name = trim($_POST['Name']);
	if(empty($input_Name)){
		$Name_err = "Name is required";
	}else{
		$Name = $input_Name;
	}


    $input_UserName = trim($_POST['UserName']);
	if(empty($input_UserName)){
		$UserName_err = "username is required";
	}else{
		$UserName = $input_UserName;
	}

    $input_SitePassword = trim($_POST['SitePassword']);
	if(empty($input_SitePassword)){
		$SitePassword_err = "site password is required";
	}else{
		$SitePassword = $input_SitePassword;
	}

	// create payment form
	if(empty($URL_err) && empty($Name_err) && empty($UserName_err) && empty($SitePassword_err)){
		$sql = "INSERT INTO socialmedia (URL,Name,UserName, SitePassword)
				VALUES('$URL', '$Name','$UserName','$SitePassword')";
		if(mysqli_query($conn, $sql)){
			header("Location:socialmedia.php");
			exit();
		}else{
			echo "Error creating database";
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
<section class="home-section"> 
 <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Password Manager</span>
    </div>
        <div class="container">
            <div class="text" style="font-size: xx-large;margin-left: 300px;">SOCIAL MEDIA FORM</div>
                <div class="row">  
                    <div class="col-sm-8" style="margin-left: 100px; margin-top: 15px;" >
                        <form class="form" action="socialmedia.php" method="post"> 
                            <div>
                            <label for='URL'>URL: </label>
                            <span class="text-danger"><?php echo $URL_err; ?></span>
                            <input type="url" class="form-control" id="URL" name="URL" style="line-height:8%;">
                             
                            </div>
                    </div> 
                    
                    <div class="col-sm-4" style="margin-left: 100px;margin-top: 15px;">
                            <label for='Name'>Name:</label>
                                <span class="text-danger"><?php echo $Name_err; ?></span>
                                    <select class="form-control" id="Name" name="Name">
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Discord">Discord</option>
                                        <option value="Reddit">Reddit</option>
                                    </select>
                                    <label for='SitePassword'style="margin-top: 15px;">Site password:</label>
                                <span class="text-danger"><?php echo $SitePassword_err; ?></span>
                                <input type="password" class="form-control" id="SitePassword" name="SitePassword">
                </div>
                            <div class="col-sm-4">
                                <label for='UserName' style="margin-top: 15px;">User Name: </label>
                                <span class="text-danger"><?php echo $UserName_err; ?></span>
                                <input type="name" class="form-control" id="UserName" name="UserName">

                                <div class="form-group" style="margin-top: 50px;">
                                <button type="cancel" class="btn btn-primary" value="cancel"> Cancel</button>
                                <button type="submit" class="btn btn-primary" value="Save"> Save</button>
                           </div>
                                
                                
                            </div>
                            
                            
                    </div>
                 </form>
                    </div>
                </div>
        </div>
    </section>
    <script src="js/script.js "></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>

