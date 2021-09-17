<?php
require_once('config.php');
 session_start();
 
$LicenceKey = $ProductName =  "";
$LicenceKey_err = $Product_err = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_ProductName = trim($_POST['ProductName']);
	if(empty($input_ProductName)){
		$URL_err = "Product Name is required";
	}else{
		$sql = "SELECT * FROM softwareLicence WHERE ProductName = '$input_ProductName'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $ProductName_err = "Product Name already exists!";
			}else{
				$ProductName = $input_ProductName;
			}
		}else{
			 echo "Something went wrong with Product name";
		}

	}

    $input_LicenceKey = trim($_POST['LicenceKey']);
	if(empty($input_LicenceKey)){
		$LicenceKey_err = "Licence Key is required";
	}else{
		$LicenceKey = $input_LicenceKey;
	}


   
	// create payment form
	if(empty($Product_err) && empty($LicenceKey_err)){
		$sql = "INSERT INTO softwareLicence (ProductName,LicenceKey)
				VALUES('$ProductName', '$LicenceKey')";
		if(mysqli_query($conn, $sql)){
			header("Location:softwareLicence.php");
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
            <div class="text" style="font-size: xx-large;margin-left: 300px;">SOFTWARE LICENCE FORM</div>
                <div class="row">  
                    <div class="col-sm-5" style="margin-left: 50px; margin-top: 15px;" >
                        <form class="form" action="softwareLicence.php" method="post"> 
                            <div>
                                <label for='ProductName' >Product Name: </label>
                                <span class="text-danger"><?php echo $ProductName_err; ?></span>
                                <input type="name" class="form-control" id="ProductName" name="ProductName">                              
                            </div>
                        </div> 
                            <div class="col-sm-5" style="margin-left: 30px;">
                            <label for='LicenceKey'style="margin-top: 15px;">Licence Key:</label>
                                <span class="text-danger"><?php echo $LicenceKey_err; ?></span>
                                <input type="text" class="form-control" id="LicenceKey" name="LicenceKey">

                            <div class="form-group" style="margin-top: 40px;">
                                <button type="cancel" class="btn btn-primary" value="cancel"> Cancel</button>
                                <button type="submit" class="btn btn-primary" value="Save"> Save</button>
                                
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

