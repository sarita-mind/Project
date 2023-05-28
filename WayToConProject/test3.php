<!DOCTYPE html>
<html>
<head>
  <title>Seat Reservation System</title>
  <style>
    .seat {
      width: 30px;
      height: 30px;
      background-color: green;
      border-radius: 50%;
      margin: 5px;
      display: inline-block;
      cursor: pointer;
    }
    .seat.selected {
      background-color: red;
    }
  </style>
</head>
<body>
  <h1>Seat Reservation System</h1>
  <div id="seatMap">
    <!-- Seat map will be dynamically generated here -->
  </div>
  <h2>Selected Seats:</h2>
  <div id="selectedSeats"></div>

  <script src="test3.js"></script>
</body>
</html>
