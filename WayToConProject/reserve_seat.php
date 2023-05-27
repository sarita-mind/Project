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
    <title>Reserve Seat</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel = "stylesheet" href = "reserve_seat.css">
    <link rel = "stylesheet" href = "css/bootstrap-grid.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/" >
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include_once('header.php'); ?>
    <?php 
    
            $event = 'SELECT * FROM showinfo,showtime WHERE showinfo.showID = showtime.showID ';
            $query1 = mysqli_query($con,$sql);

            $seat = 'SELECT * FROM zoneforshow,seatforshow,showID WHERE showinfo.ShowID = zoneforshow.ShowID AND zoneforshow.ZoneID = seatforshow.ZoneID' ;
            $query2 = mysqli_query($con,$sql);

            while($row1 = mysqli_fetch_array($query1) &  $row2 = mysqli_fetch_array($query2)) { 
    ?>
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
                    <div class="booking">
                        <div class="col-12">
                            <h3 class = "align-self-center">STEP 2  Select Seats</h3>
                            <div class="booking-body bg-dark">
                                <div class="container">
                                    <div class="row">
                                        <div class="col seat-map-container">
                                            <div class="seat-map">
                                                <div class="seat-map-info">
                                                    <ul class="seat-type">
                                                        <li>
                                                            <span class="ico" style = "background-color : #ADFF00;"></span>
                                                            <span class="txt">3,500</span>
                                                        </li>
                                                        <li>
                                                            <span class="ico ico-seat-select" style = "background-color : #00D1FF"></span>
                                                            <span class="txt">selected seat</span>
                                                        </li>
                                                        <li>
                                                            <span class="ico ico-not-available" style = "background-color : #FF0000"></span>
                                                            <span class="txt">not available seat</span>
                                                        </li>
                                                    </ul>
                                                    <div class="seat-map-stage">
                                                        <span class="txt">STAGE</span>
                                                    </div>
                                                    <div class="seat-map-body" style = "height : 306px;">
                                                        <form id="frmSeat" name="frmseat">
                                                            <div class="seat-table">
                                                                <table id = "tableseats" style="transform : scale(0.915751)">
                                                                    <tbody>
                                                                        <!-- <tr class = "<?php /*echo $row1['ZoneID']*/ ?>"> -->
                                                                        <tr class = "H12345">
                                                                            <!-- <td class="headrow"><?php /* echo $row1['SeatRow']*/ ?></td> -->
                                                                            <td class="headrow">Q</td>
                                                                            <td class="skiprow" colspan="2"></td>
                                                                            <td title="Q-13" class="not-available">
                                                                                <div class="seatnotavail">&nbsp;</div>
                                                                            </td>
                                                                            <td title="Q-14">
                                                                                <div class="seatuncheck ">&nbsp;</div>
                                                                            </td>
                                                                            <td title="Q-13" class="not-available">
                                                                                <div class="seatnotavail">&nbsp;</div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 mt-3 align-self-md-center">
                <a href="user_concert_detail.php" class="back-button mb-2">Back</a>
            </div>
            <div class="col-12 col-lg-6 mt-2 align-self-md-center">
                <a href="user_concert_detail.php" class="next-button mb-2">Next</a>
            </div>
        </div>
        
    </div> 
        <script src = js/bootstrap-grid.min.js></script>
        <?php  }  ?> 
</body>
</html>
