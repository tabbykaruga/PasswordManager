<?php
require_once('config.php');
 session_start();

$cardname = $holdername = $cardnumber = $cvv = $brand = $date ="";
$cardname_err = $holdername_err = $cardnumber_err= $cvv_err = $brand_err = $date_err ="";

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_cardname = trim($_POST['cardname']);
	if(empty($input_cardname)){
		$cardname_err = "Card name is required";
	}else{
		$cardname = $input_cardname;
	}

    $input_holdername = trim($_POST['holdername']);
	if(empty($input_holdername)){
		$holdername_err = "Card holder name is required";
	}else{
		$holdername = $input_holdername;
	}
   

    $input_cardnumber = trim($_POST['cardnumber']);
	if(empty($input_cardnumber)){
		$cardnumber_err = "Card number contains 15 numbers";
	}else{
		$sql = "SELECT * FROM payment WHERE cardnumber = '$input_cardnumber'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $cardnumber_err = "Card number already exists!";
			}else{
				$cardnumber = $input_cardnumber;
			}
		}else{
			 echo "Something went wrong while inputing card Number to databse";
		}
	}
 
    $input_brand = trim($_POST['brand']);
	if(empty($input_brand)){
		$brand_err = "Select a brand";
	}else{
		$brand = $input_brand;
	}

    $input_date = trim($_POST['date']);
	if(empty($input_date)){
		$date_err = "Enter a valid date";
	}else{
		$date = $input_date;
	}

    $input_cvv = trim($_POST['cvv']);
	if(empty($input_cvv)){
		$cvv_err = "cvv contains 3 numbers";
	}else{
		$cvv = $input_cvv;
	}

	// create payment form
	if(empty($cardname_err) && empty($holdername_err) && empty($cardnumber_err)&& empty($brand_err) && empty($date_err) && empty($cvv_err)){
		$sql = "INSERT INTO payment (cardname ,holdername ,cardnumber ,brand, date ,cvv)
				VALUES('$cardname' ,'$holdername','$cardnumber','$brand','$date','$cvv')";
		if(mysqli_query($conn, $sql)){
			header("Location: payment.php");
			exit();
		}else{
			echo "Error creating database".mysqli_errno($conn);
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
            <div class="text" style="font-size: xx-large;margin-left: 300px;">PAYMENT FORM</div>
                <div class="row">  
                    <div class="col-sm-5" style="margin-left: 100px; margin-top: 15px;" >
                        <form class="form" action="payment.php" method="post"> 
                            <div>
                            <label for='cardname'>Card Name: </label>
                            <span class="text-danger"><?php echo $cardname_err; ?></span>
                            <input type="name" class="form-control" id="cardname" name="cardname" style="line-height:8%;">

                            <label for='holdername'>Card Holder Name:</label>
                            <span class="text-danger"><?php echo $holdername_err; ?></span>
                            <input type="name" class="form-control" id="holdername" name="holdername" style="line-height:8%;">

                            <label for='cardnumber'>Card Number: </label>
                            <span class="text-danger"><?php echo $cardnumber_err; ?></span>
                            <input type="number" class="form-control" id="cardnumber" name="cardnumber" style="line-height:8%;">

                            <label for='cvv'>CVV (Security Code): </label>
                            <span class="text-danger"><?php echo $cvv_err; ?></span>
                            <input type="number" class="form-control" id="cvv" name="cvv" style="line-height:8%;">
                                 
                            </div>
                        </div> 
                            <div class="col-sm-5" style="margin-left: 1px; margin-top: 15px;">
                            <div>    
                                <label for='brand'>Brand:</label>
                                <select type="name" class="form-control" id="brand" name="brand">
                                    <option value="Visa">Visa</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Master Card">Master Card</option>
                                    <option value="American Express">American Express</option>
                                </select>
                                <span class="text-danger"><?php echo $brand_err; ?></span>
                              
                                <label for='date'style="margin-top: 0px;">Expiry Date:</label>
                                <span class="text-danger"><?php echo $date_err; ?></span>
                                <input type="date" class="form-control" id="date" name="date">
                       
                            </div>
                            <div class="form-group" style="margin-top: 100px;">
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

