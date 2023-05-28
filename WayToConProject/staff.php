<?php
    session_start();
    
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['StaffEmail']);
        header('location:stafflogin.php');
    }
/*
    if(!isset($_SESSION['StaffEmail'])){
        $_SESSION['message'] = 'You must log in first';
        header('location:stafflogin.php');
    }
*/
?>

<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToCon Staff</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel = "stylesheet" href = "staff.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/" >
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include_once('staffheader.php'); ?>
    <div class="welcome">
        <h1>Welcome 
            <br> 
            WayToCon 
            <br> 
            Staff</h1>
    </div>
    
    
</body>
</html>
