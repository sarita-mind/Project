<?php
    include('server.php');
    session_start();
    
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['UserEmail']);
        header('location:userlogin.php');
    }
/*
    if(!isset($_SESSION['UserEmail'])){
        $_SESSION['message'] = 'You must log in first';
        header('location:userlogin.php');
    }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToCon</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel = "stylesheet" href = "index.css">
    <link rel = "stylesheet" href = "css/bootstrap-grid.min.css">
</head>
<body>
    <?php include_once('header.php'); ?>
        <div class = container-fluid>
            <!-- First Row [Popular]-->
            <h2 class="font-weight-bold mb-2">Popular Event</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="card-button"> Buy Now</a>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="card-button"> Buy Now</a>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="card-button"> Buy Now</a>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="card-button"> Buy Now</a>
                            </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Second Row [Upcoming]-->
            <h2 class="font-weight-bold mb-2">Upcoming Event</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                            <div class="card-body">
                                <h3><a href="#" class="card-title">Concert</a></h3>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>   
        <script src = js/bootstrap-grid.min.js></script> 
</body>
</html>