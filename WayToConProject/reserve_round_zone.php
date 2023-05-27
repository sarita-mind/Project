<?php
    include('server.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Round and Zone</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel = "stylesheet" href = "reserve_round_zone.css">
    <link rel = "stylesheet" href = "css/bootstrap-grid.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/" >
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include_once('header.php'); ?>
    <div class = container-fluid>
        <h1 class="font-weight-bold mb-2">Concert Name</h1>
        <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                        <div class="card-body">
                            <h2 class="card-title mt-2">Concert</h2>
                            <h5 class="card-title ">Venue</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 ">
                    <div class="inner-wrapper">
                        <div class="col-12">
                            <h3 class = "align-self-center">STEP 1  Select Round and Zone</h3>
                            <div class="box">
                                <div class="row">
                                    <div class="col-5">
                                        <select id="show_time" name="show_time">
                                            <option value="concert">Concert</option>
                                            <option value="sport">Sport</option>
                                            <option value="show">Show</option>
                                        </select>
                                    </div>
                                    <div class="col-4 ">
                                        <select id="zone" name="zone">
                                            <option value="concert">Concert</option>
                                            <option value="sport">Sport</option>
                                            <option value="show">Show</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h4 class = "align-self-center">preview</h4>
                            <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "40%"alt="">
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 mt-3 align-self-md-center">
                <a href="user_concert_detail.php" class="back-button mb-2">Back</a>
            </div>
            <div class="col-12 col-lg-6 mt-2 align-self-md-center">
                <a href="reserve_seat.php" class="next-button mb-2">Next</a>
            </div>
        </div>
        
    </div> 
        <script src = js/bootstrap-grid.min.js></script>
</body>
</html>

