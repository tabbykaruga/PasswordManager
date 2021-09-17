<?php
require_once('config.php');
 session_start();

$firstname = $lastname = $username = $company = $idno = $passno = $email= $phone = $address1 = $address2 = $address3 = $county  ="";
$firstname_err = $lastname_err = $username_err= $company_err = $idno_err = $passno_err = $email_err = $phone_err = $address1_err = $address2_err= $address3_err= $county_err ="";

if($_SERVER['REQUEST_METHOD']=='POST'){

	$input_firstname = trim($_POST['firstname']);
	if(empty($input_firstname)){
		$firstname_err = "first name is required";
	}else{
		$firstname = $input_firstname;
	}
    
    $input_lastname = trim($_POST['lastname']);
	if(empty($input_lastname)){
		$lastname_err = "Last name is required";
	}else{
		$lastname = $input_lastname;
	}

    $input_username = trim($_POST['username']);
	if(empty($input_username)){
		$username_err = "username is required";
	}else{
		$username = $input_username;
	}

    $input_company = trim($_POST['company']);
	if(empty($input_company)){
		$company_err = "Company name is required";
	}else{
		$company = $input_company;
	}

    $input_idno = trim($_POST['idno']);
	if(empty($input_idno)){
		$idno_err = "ID number contains 8 digits";
	}else{
		$sql = "SELECT * FROM addressForm WHERE idno = '$input_idno'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $idno_err = "ID number already exists!";
			}else{
				$idno = $input_idno;
			}
		}else{
			 echo "Something went wrong while inputing ID Number to databse";
		}
	}

    $input_passno = trim($_POST['passno']);
	if(empty($input_passno)){
		$passno_err = "Passport number contains 15 digits";
	}else{
		$sql = "SELECT * FROM addressForm WHERE passno = '$input_passno'";
		$exQry = mysqli_query($conn,$sql);
		if($exQry){
			if(mysqli_num_rows($exQry) > 0){
				 $passno_err = "Passport number already exists!";
			}else{
				$passno = $input_passno;
			}
		}else{
			 echo "Something went wrong while inputing Passport Number to databse";
		}
	}
 
    $input_email = trim($_POST['email']);
	if(empty($input_email)){
		$email_err = "Email is required";
	}else{
		$email = $input_email;
	}

    $input_phone = trim($_POST['phone']);
	if(empty($input_phone)){
		$phone_err = "Phone Number is required";
	}else{
		$phone = $input_phone;
	}

    $input_address1 = trim($_POST['address1']);
	if(empty($input_address1)){
		$address1_err = "Address is required";
	}else{
		$address1 = $input_address1;
	}

    $input_address2 = trim($_POST['address2']);
	if(empty($input_address2)){
		$address2_err = "Second address is required";
	}else{
		$address2 = $input_address2;
	}

    $input_address3 = trim($_POST['address3']);
	if(empty($input_address3)){
		$address3_err = "Third address is required";
	}else{
		$address3 = $input_address3;
	}

    $input_county = trim($_POST['county']);
	if(empty($input_county)){
		$county_err = "Select a County";
	}else{
		$county = $input_county;
	}


	// create payment form
	if(empty($firstname_err) && empty($lastname_err) && empty($username_err)&& empty($company_err) && empty($idno_err) 
    && empty($passno_err) && empty($email_err) && empty($phone_err) && empty($address1_err) && empty($address2_err)
    && empty($address3_err) && empty($county_err)){
		$sql = "INSERT INTO addressForm (firstname ,lastname ,username ,company, idno ,passno ,email ,phone ,address1 ,address2 ,address3,county)
				VALUES('$firstname' ,'$lastname','$username','$company','$idno','$passno','$email' ,'$phone','$address1','$address2','$address3','$county')";
		if(mysqli_query($conn, $sql)){
			header("Location: Address.php");
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
            <div class="text" style="font-size: xx-large;margin-left: 300px;">ADDRESS FORM</div>
                <div class="row">  
                    <div class="col-sm-5" style="margin-left: 100px; margin-top: 15px;" >
                        <form class="form" action="Address.php" method="post"> 
                            <div>
                            <label for='firstname'>First Name: </label>
                            <span class="text-danger"><?php echo $firstname_err; ?></span>
                            <input type="name" class="form-control" id="firstname" name="firstname" style="line-height:8%;">

                            <label for='username'>UserName:</label>
                            <span class="text-danger"><?php echo $lastname_err; ?></span>
                            <input type="name" class="form-control" id="username" name="username" style="line-height:8%;">

                            <label for='idno'>ID Number: </label>
                            <span class="text-danger"><?php echo $idno_err; ?></span>
                            <input type="number" class="form-control" id="idno" name="idno" style="line-height:8%;">

                            <label for='email'>Email: </label>
                            <span class="text-danger"><?php echo $email_err; ?></span>
                            <input type="email" class="form-control" id="email" name="email" style="line-height:8%;">

                            <label for='address1'>Address: </label>
                            <span class="text-danger"><?php echo $address1_err; ?></span>
                            <input type="address" class="form-control" id="address1" name="address1" style="line-height:8%;">

                            <label for='address3'>Address: </label>
                            <span class="text-danger"><?php echo $address3_err; ?></span>
                            <input type="address" class="form-control" id="address3" name="address3" style="line-height:8%;">
                                 
                            </div>
                        </div> 
                            <div class="col-sm-5" style="margin-left: 1px; margin-top: 15px;">
                            <div> 

                            <label for='lastname'>Last Name:</label>
                            <span class="text-danger"><?php echo $lastname_err; ?></span>
                            <input type="name" class="form-control" id="lastname" name="lastname" style="line-height:8%;">  

                            <label for='company'>Company:</label>
                            <span class="text-danger"><?php echo $company_err; ?></span>
                            <input type="name" class="form-control" id="company" name="company" style="line-height:8%;">  
                    
                            <label for='passno'>Passport Number: </label>
                            <span class="text-danger"><?php echo $passno_err; ?></span>
                            <input type="number" class="form-control" id="passno" name="passno" style="line-height:8%;">

                            <label for='phone'>Phone Number: </label>
                            <span class="text-danger"><?php echo $phone_err; ?></span>
                            <input type="number" class="form-control" id="phone" name="phone" style="line-height:8%;">

                            <label for='address2'>Address 2: </label>
                            <span class="text-danger"><?php echo $address1_err; ?></span>
                            <input type="address" class="form-control" id="address2" name="address2" style="line-height:8%;">
                       
                            <label for='county'>County: </label>
                            <span class="text-danger"><?php echo $county_err; ?></span>
                                <select  class="form-control" id="county" name="county" style="line-height:8%;">
                                        <option value="Nairobi">Nairobi</option> 
                                        <option value="Kwale">Kwale</option>
                                        <option value=" Kilifi">Kilifi</option>
                                        <option value=" Tana River"> Tana River</option>
                                        <option value=" Lamu"> Lamu</option>
                                        <option value=" Taita/Taveta"> Taita/Taveta</option>
                                        <option value=" Mombasa"> Mombasa</option>
                                        <option value=" Garissa">Garissa</option>
                                        <option value=" Wajir"> Wajir</option>
                                        <option value=" Mandera"> Mandera</option>
                                        <option value="  Meru">Meru</option>
                                        <option value=" Tharaka-Nithi"> Tharaka-Nithi</option>
                                        <option value=" Embu">Embu</option>
                                        <option value=" Kitui"> Kitui</option>
                                        <option value=" Machakos"> Machakos</option>
                                        <option value="  Makueni">Makueni</option>
                                        <option value=" Nyandarua"> Nyandarua</option>
                                        <option value=" Nyeri">Nyeri</option>
                                        <option value=" Kirinyaga"> Kirinyaga</option>
                                        <option value="  Murang'a">  Murang'a</option>
                                        <option value="   Kiambu"> Kiambu</option>
                                        <option value=" Turkana">Turkana</option>
                                        <option value=" West Pokot"> West Pokot</option>
                                        <option value=" Samburu"> Samburu</option>
                                        <option value="  Trans Nzoia">Trans Nzoia</option>
                                        <option value="  Uasin Gishu">  Uasin Gishu</option>
                                        <option value=" Elgeyo/Marakwet">Elgeyo/Marakwet</option>
                                        <option value="  Nandi">  Nandi</option>
                                        <option value=" Baringo">Baringo</option>
                                        <option value=" Laikipia"> Laikipia</option>
                                        <option value=" Nakuru"> Nakuru</option>
                                        <option value="  Narok">Narok</option>
                                        <option value="  Kajiado"> Kajiado</option>
                                        <option value=" Kericho">Kericho</option>
                                        <option value=" Bomet"> Bomet</option>
                                        <option value="Kakamega">Kakamega</option> 
                                        <option value="  Vihiga">Vihiga</option>
                                        <option value=" Bungoma">Bungoma</option>
                                        <option value=" Busia"> Busia</option>
                                        <option value=" Siaya"> Siaya</option>
                                        <option value="  Kisumu">Kisumu</option>
                                        <option value="  Homa Bay"> Homa Bay</option>
                                        <option value=" Migori">Migori</option>
                                        <option value=" Kisii"> Kisii</option>
                                        <option value="Nyamira">Nyamira</option> 
                                    </select>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
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

