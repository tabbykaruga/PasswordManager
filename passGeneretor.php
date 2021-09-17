<?php
require_once('config.php');
 session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/passGeneratorr.css">
    

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div class="text" style="font-size: xx-large;">PASSWORD GENERETOR</div>
        <div class="result">
            <div class="result__title field-title">Generated Password</div>
            <div class="result__info right">click to copy</div>
            <div class="result__info left">copied</div>
            <div class="result__viewbox" id="result">CLICK GENERATE</div>
            <button id="copy-btn" style="--x: 0; --y: 0"><i class="far fa-copy"></i></button>
        </div>
        <div class="length range__slider" data-min="4" data-max="32">
            <div class="length__title field-title" data-length='0'>length:</div>
            <input id="slider" type="range" min="4" max="32" value="16" />
        </div>

        <div class="settings">
            <span class="settings__title field-title">settings</span>
            <div class="setting">
                <input type="checkbox" id="uppercase" checked />
                <label for="uppercase">Include Uppercase</label>
            </div>
            <div class="setting">
                <input type="checkbox" id="lowercase" checked />
                <label for="lowercase">Include Lowercase</label>
            </div>
            <div class="setting">
                <input type="checkbox" id="number" checked />
                <label for="number">Include Numbers</label>
            </div>
            <div class="setting">
                <input type="checkbox" id="symbol" />
                <label for="symbol">Include Symbols</label>
            </div>
        </div>

        <button class="btn generate" id="generate">Generate Password</button>
    </div>

    </section>
    <script src="js/script.js "></script>
    <script src="js/passGenerator.js "></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>

