<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToConheader</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel = "stylesheet" href = "header.css">

</head>
<body>
    <div class="header">
                <div class="container">
                    <div class="header-con">
                        <div class="logo-container">
                            <a href="#">
                                <img src='./image/Logo.png' alt="Logo"/>
                            </a>
                        </div>
                        <div class="line-container">
                            <img src='./image/Line 3.png' alt=""/>
                        </div>
                            
                        <ul class= "menu">
                            <li class="menu-link" onClick={closeMobileMenu}>
                                <a href="index.php">Home</a>
                            </li>

                            <li class="dropdown" >
                                <a href="#">Event</a>
                                <div class="dropdown-content">
                                    <a href="concert.php">Concert</a>
                                    <a href="sport.php">Sport</a>
                                    <a href="show.php">Show</a>
                                </div>
                            </li>
                        <li class="menu-link">
                            <a href="giftshop.php">Gift Shop</a>
                        </li>
                        <li class="menu-link">
                            <a href="user.php">User</a>
                        </li>
                    </ul>
                    <div class="login-btn">
                        <a href="index.php?logout='1'" class="login-btn">Log Out</a>
                    </div>
                </div>
                >
            </div>
        </div> 
         
</body>
</html>