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
    <title>Event_detail</title>
    <link rel = "stylesheet" href = "user_concert_detail.css">
    <link rel = "stylesheet" href = "css/bootstrap-grid.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/" >
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>


<body>
    <?php include_once('header.php'); ?>
    <?php 
    
            $sql = 'SELECT * FROM showinfo,showtime WHERE showinfo.showID = showtime.showID ';
            $query1 = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($query1)) { 
        ?>

        <h1 class="font-weight-bold mb-2">Concert Name</h1>
        <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                        <a href="#" class="card-button">Buy Now</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="info-card">
                        <div class="row">
                            <div class="col-5">
                                <div class="showdate" >
                                    <div class="row">
                                        <div class="col-2 align-self-md-center px0" >
                                                <img src="./image/fi-rs-calendar.png" alt="">
                                        </div>
                                        <div class="col-10">
                                             <h5 class="card-title">Show Date</h5>
                                        </div>
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                </div>
                                <div class="venue">
                                    <div class="row">
                                        <div class="col-2 align-self-md-center px0" >
                                                <img src="./image/Vector.png" alt="">
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title">Venue</h5>
                                        </div>
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                </div>
                                <div class="gateopen">
                                    <div class="row">
                                        <div class="col-2 align-self-md-center px0" >
                                                <img src="./image/Vector-1.png" alt="">
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title">Gate Open</h5>
                                        </div>
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                </div>                               
                                
                            </div>
                            <div class="col-5">
                                <div class="saleopen">
                                    <div class="row">
                                        <div class="col-2 align-self-md-center px0" >
                                                <img src="./image/Vector-2.png" alt="">
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title">Sale Date</h5>
                                        </div>
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                </div>
                                <div class="price">
                                    <div class="row">
                                        <div class="col-2 align-self-md-center px0" >
                                                <img src="./image/Vector-3.png" alt="">
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title">Ticket Price</h5>
                                        </div>
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-2 ">
                <div class="card">
                    <h3 class="Seating">Seating Plan</h3>                   
                    <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                </div>
                <div class="card">
                    <h3 class="condition">Condition of Sale</h3>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-2 ">
                <div class="card">
                    <h3 class="detail">Detail</h3>
                    <div class="detail-body">
                        <p class="card-text">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
        </div>
        <script src = js/bootstrap-grid.min.js></script>
</body>
    <?php  }  ?> 
</html>

