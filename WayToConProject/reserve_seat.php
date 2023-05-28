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
    <!-- <script src = reserve_seat.js></script> -->
</head>

<body>
    <?php include_once('header.php'); ?>
    <!-- <?php /* 
    
            $event = 'SELECT * FROM (showinfo s JOIN showtime t ON s.ShowID = t.ShowID) JOIN location l ON s.locationID = l.LocationID; ';
            $query1 = mysqli_query($con,$event);

            $seat = 'SELECT * FROM zoneforshow,seatforshow,showinfo WHERE showinfo.ShowID = zoneforshow.ShowID AND zoneforshow.ZoneID = seatforshow.ZoneID' ;
            $query2 = mysqli_query($con,$seat);

            $seat = 'SELECT * FROM (showinfo s JOIN zoneforshow z ON s.ShowID = z.ShowID) JOIN seatforshow f ON z.ZoneID = f.ZoneID';
    */ ?> -->
        <!-- <? /* php while($row1 = mysqli_fetch_array($query1) &  $row2 = mysqli_fetch_array($query2)) {    } */ ?>--> 
    
    <div class = container-fluid>
        <h1 class="font-weight-bold mb-2"><?=$row1['ShowName'] ?></h1>
        <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" width = "100%"alt="">
                        <div class="card-body">
                            <h2 class="card-title mt-2"><?=$row1['ShowName'] ?></h2>
                            <h5 class="card-title ">Venue</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 ">
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
                                                    <div class="seat-map-body">
                                                        <form id="frmSeat" name="frmseat">
                                                            <div class="seat-table">
                                                                <table id = "tableseats" >
                                                                    <tbody>
                                                                        <tr class = "H12345">
                                                                            <td class="headrow">Q</td>
                                                                            <td class="skiprow" colspan="2"></td>
                                                                            <td title="Q-13" class="not-available">
                                                                                <div class="seatnotavail">&nbsp;</div>
                                                                            </td>
                                                                            <td title ="Q-14">
                                                                                <div class="seatuncheck" id = "checkseat-GG-14" data-seat="GG-14-P*1900" data-seatk = "fcc237c2217378d2a759b504a9fdab43" onclick="clicked(this)">
                                                                                    <span>14</span>
                                                                                </div>
                                                                            </td>
                                                                            <td title="Q-15">
                                                                                <div class="seatuncheck" id = "checkseat-GG-15" data-seat="GG-15-P*1900" data-seatk = "8d49d85b404e2602fcdec8fd6baa8f8" onclick="clicked(this)">
                                                                                    <span>15</span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                           
                                                                             <!-- <tr class = <? /* =$row1['ZoneForShowID'] */?>> 
                                                                                <td class="headrow"> <? /* =$row1['SeatRow'] */ ?> </td>
                                                                                <td class="skiprow" colspan="2"></td>
                                                                                <td title=<? /* =$row1['SeatNo'] */?>>
                                                                                    <div class="seatuncheck" id =<? /* =$row1['SeatForShowID'] */?> onclick="clicked(this)">
                                                                                        <span><? /* =$row1['SeatNo'] */ ?></span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr> -->
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
                                    <thead>
                                        <tr>
                                            <th scope = "row">Round</th>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Zone</th>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Seat No</th>

                                        </tr>
                                        <tr>
                                            
                                            <th scope = "row">Quantity</th>
                                            
                                        </tr>
                                        <tr>
                                            <th scope = "row">Unit Price(baht)</th>

                                        </tr>
                                        <tr>
                                            <th scope = "row">Total Price(baht)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <td><?=$row['ShowDateTime']?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><?=$row['ZoneForShowName']?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><?=$row['SeatNo']?></td>

                                        </tr>
                                        <tr>
                                            
                                            <td id="quantity"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td id="unitPrice"><?=$row['Price']?></td>

                                        </tr>
                                        <tr>
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
                <a href="reserve_seat.php" class="next-button mb-2">Next</a>
            </div>
        </div>
        
    </div> 
        
        <?php /*  } */?> 
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
            }

            function showTicketInformation() {
            var checkedSeats = document.getElementsByClassName("seatchecked");
            var ticketTable = document.getElementById("Ticket-Info");
            var quantity = checkedSeats.length;
            var unitPrice = checkedSeats.dataset.Price;
            var totalPrice = quantity * unitPrice;

            // Clear previous ticket information
            ticketTable.innerHTML = "";

            // Iterate over checked seats and populate the ticket information table
            for (var i = 0; i < checkedSeats.length; i++) {
                if (checkedSeats.length <= seat.dataset.LimitTicket)
            var seat = checkedSeats[i];
            var row = document.createElement("tr");
            row.innerHTML = "<td>" + seat.dataset.showDateTime + "</td>" +
                            "<td>" + seat.dataset.zoneForShowName + "</td>" +
                            "<td>" + seat.dataset.seatNo + "</td>";

            ticketTable.appendChild(row);
            }
            var quantityRow = document.createElement("tr");
            quantityRow.innerHTML = "<th scope='row'>Quantity</th><td>" + quantity + "</td>";
            ticketTable.appendChild(quantityRow);

            var unitPriceRow = document.createElement("tr");
            unitPriceRow.innerHTML = "<th scope='row'>Unit Price(baht)</th><td>" + unitPrice + "</td>";
            ticketTable.appendChild(unitPriceRow);

            var totalPriceRow = document.createElement("tr");
            totalPriceRow.innerHTML = "<th scope='row'>Total Price(baht)</th><td>" + totalPrice + "</td>";
            ticketTable.appendChild(totalPriceRow);

            document.getElementById("quantity").textContent = quantity;
            document.getElementById("totalPrice").textContent = totalPrice;

}

        
        </script>
</body>
</html>
