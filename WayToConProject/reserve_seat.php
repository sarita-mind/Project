<?php
    include('server.php');
    session_start();
?>

<?php 
    $showid = $_GET['id'];
    $roundselect = $_GET['show_time'];
    $zoneselect = $_GET['zone'];

    $all = "SELECT * FROM showinfo s JOIN location l ON s.locationID = l.LocationID WHERE s.ShowID = '$showid'";
    $query1 = mysqli_query($con,$all);
    $row1 = mysqli_fetch_array($query1);

    $showtime = "SELECT * FROM showinfo s JOIN showtime t ON s.ShowID = t.ShowID WHERE s.ShowID = '$roundselect' ORDER BY t.ShowDateTime";
    $query2 = mysqli_query($con,$showtime);
    $row2 = mysqli_fetch_array($query2);

    $zone = "SELECT * FROM showinfo s JOIN zoneforshow h ON s.ShowID = h.ShowID WHERE s.ShowID = '$zoneselect'";
    $query3 = mysqli_query($con,$zone);
    $row3 = mysqli_fetch_array($query3);

    $seat = "SELECT * FROM ((showtime t JOIN showinfo s ON t.ShowID = s.ShowID )JOIN zoneforshow h ON s.ShowID = h.ShowID) JOIN seatforshow f ON h.ZoneForShowID = f.ZoneForShowID JOIN seat z ON f.SeatID = z.SeatID WHERE s.ShowID = '$showid' AND t.ShowTimeID = $roundselect AND h.ZoneforShowID =  $zoneselect ";
    $query4 = mysqli_query($con,$seat);
    
    $seat = "SELECT * FROM ((showtime t JOIN showinfo s ON t.ShowID = s.ShowID )JOIN zoneforshow h ON s.ShowID = h.ShowID) JOIN seatforshow f ON h.ZoneForShowID = f.ZoneForShowID JOIN seat z ON f.SeatID = z.SeatID WHERE s.ShowID = '$showid' AND t.ShowTimeID = $roundselect AND h.ZoneforShowID =  $zoneselect ";
    $query5 = mysqli_query($con,$seat);
    $row5 = mysqli_fetch_array($query5);




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
    <!-- <script src = reserve_seat.js></script> -->
</head>

<body>
    <?php include_once('header.php'); ?>
        <!-- <? /* php while($row1 = mysqli_fetch_array($query1) &  $row2 = mysqli_fetch_array($query2)) {    } */ ?>--> 
    
    <div class = "container-md " >
        <h1 class="font-weight-bold mtb-4"><?=$row1['ShowName'] ?></h1>
        <div class="row ">
                <div class="col-md-3 mt-4">
                    <div class="card">
                        <img src="image/<?=$row1['Poster'] ?>" width = "100%"alt="">
                        <div class="card-body">
                            <h2 class="card-title mt-2"><?=$row1['ShowName'] ?></h2>
                            <h5 class="card-title "><?=$row1['LocationName'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mt-4">
                    <div class="booking">
                        <div class="inner-wrapper">
                        <div class="col-12">
                            <h3 class = "align-self-center">STEP 2  Select Seats</h3>
                            <div class="booking-body">
                                <div class="container" style = " padding-left : 0 px; margin-left : 0px">
                                    <div class="row">
                                        <div class="col seat-map-container">
                                            <div class="seat-map">
                                                <div class="seat-map-info">
                                                    <ul class="seat-type">
                                                        <li>
                                                            <span class="ico" style = "background-color : #ADFF00;"></span>
                                                            <span class="txt"><?=$row5['Price'] ?> THB </span>
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
                                                    <div class="seat-map-body">
                                                        <form id="frmSeat" name="frmseat">
                                                            <div class="seat-table">
                                                                <table id = "tableseats" >
                                                                    <tbody>
                                                                             <tr class = <?= $row5['ZoneForShowID'] ?>> 
                                                                                <td class="headrow"> <?= $row5['SeatRow'] ?> </td>
                                                                                <td class="skiprow" colspan="2"></td>
                                                                                <?php while($row4 = mysqli_fetch_array($query4)) { ?>
                                                                                <td title=<?= $row4['SeatNo'] ?>>
                                                                                    <div class="seatuncheck" id =<?=$row4['SeatForShowID'] ?> onclick="clicked(this)">
                                                                                        <span><?=$row4['SeatNo']?></span>
                                                                                    </div>
                                                                                </td>
                                                                                <?php } ?>
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
                            <h5 class = "align-self-center">Ticket Information</h5>
                            <div class="container-md">
                            <div class="ticketinfo col-11">
                                <table id = "Ticket-Info">
                                    <tbody >
                                        <tr>
                                            <th scope = "row">Round</th>
                                            <td><?=$row2['ShowDateTime']?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Zone</th>
                                            <td><?=$row5['ZoneForShowName']?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Seat No</th>
                                            <td ><ul id="seatNumbers"></ul></td>

                                        </tr>
                                        <tr>
                                            
                                            <th scope = "row">Quantity</th>
                                            <td id="quantity"></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Unit Price (THB)</th>
                                            <td id="unitPrice"><?=$row5['Price']?></td>

                                        </tr>
                                        <tr>
                                            <th scope = "row">Total Price (THB)</th>
                                            <td id="totalPrice"></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 mt-3 align-self-md-center">
                <a href="reserve_round_zone.php" class="back-button mb-2">Back</a>
            </div>
            <div class="col-12 col-lg-6 mt-2 align-self-md-center">
                <a href="#" class="next-button mb-2">Next</a>
            </div>
        </div>
        
    </div> 
        
        <script src = js/bootstrap-grid.min.js></script>
        <script>

            function clicked(element) {
                if (element.classList.contains('seatuncheck')) {
                    element.classList.remove('seatuncheck');
                    element.classList.add('seatchecked');
                } else if (element.classList.contains('seatchecked')) {
                    element.classList.remove('seatchecked');
                    element.classList.add('seatuncheck');
                }

                showTicketInformation();
            }

            function showTicketInformation() {
            var checkedSeats = document.getElementsByClassName("seatchecked");
            var quantity = checkedSeats.length;
            var unitPrice = parseInt(document.getElementById("unitPrice").textContent);
            var totalPrice = quantity * unitPrice;


            document.getElementById("quantity").textContent = quantity;
            document.getElementById("totalPrice").textContent = totalPrice;

            var seatNumbers = document.getElementById("seatNumbers");
            seatNumbers.innerHTML = "";

    
            for (var i = 0; i < checkedSeats.length; i++) {
                var seatNumber = checkedSeats[i].querySelector("span").textContent;
                var seatNumberElement = document.createElement("li");
                seatNumberElement.textContent = seatNumber;
                seatNumbers.appendChild(seatNumberElement);
            }
            
            var nextButton = document.querySelector(".next-button");
            nextButton.addEventListener("click", markCheckedSeatsAsUnavailable);

            function markCheckedSeatsAsUnavailable() {
                var checkedSeats = document.getElementsByClassName("seatchecked"); 
                for (var i = 0; i < checkedSeats.length; i++) {
                    var seat = checkedSeats[i];
                    seat.classList.remove("seatchecked");
                    seat.classList.add("not-available");
                    }
            }

            }

            function addQueryParams(event) {
            event.preventDefault();
            var showTime = encodeURIComponent(document.getElementById('show_time').value);
            var zone = encodeURIComponent(document.getElementById('zone').value);
            var nextUrl = document.getElementById('next').getAttribute('href');
            nextUrl += '&show_time=' + showTime + '&zone=' + zone;
            location.href = nextUrl;
        }
        </script>
</body>
</html>
