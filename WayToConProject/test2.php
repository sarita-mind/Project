<!DOCTYPE html>
<html>
<head>
  <title>Concert Seat Map</title>
  <style>
    .seat {
      width: 30px;
      height: 30px;
      background-color: #ccc;
      border: 1px solid #000;
      margin: 5px;
      display: inline-block;
      cursor: pointer;
    }

    .seat.selected {
      background-color: #ff0000;
    }
  </style>
</head>
<body>
  <h1>Concert Seat Map</h1>
  <div id="seat-map">
    <!-- Seat elements will be dynamically added here -->
  </div>
  <script>
    // Seat availability data (true for available, false for reserved)
    var seatAvailability = [true, false, true, true, true, true, false, true, true, true];

    // Function to create a seat element
    function createSeatElement(seatIndex) {
      var seat = document.createElement('div');
      seat.className = 'seat';
      seat.addEventListener('click', function() {
        if (seatAvailability[seatIndex]) {
          seat.classList.toggle('selected');
          seatAvailability[seatIndex] = !seatAvailability[seatIndex];
        } else if (!seatAvailability[seatIndex] && seat.classList.contains('selected')) {
          seat.classList.toggle('selected');
          seatAvailability[seatIndex] = !seatAvailability[seatIndex];
        }
      });
      return seat;
    }

    // Function to generate the seat map
    function generateSeatMap() {
      var seatMapDiv = document.getElementById('seat-map');
      for (var i = 0; i < seatAvailability.length; i++) {
        var seat = createSeatElement(i);
        if (!seatAvailability[i]) {
          seat.classList.add('reserved');
        }
        seatMapDiv.appendChild(seat);
      }
    }

    // Generate the initial seat map
    generateSeatMap();
  </script>
</body>
</html>
