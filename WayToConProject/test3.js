document.addEventListener("DOMContentLoaded", function() {
    var seatMap = document.getElementById("seatMap");
    var selectedSeats = document.getElementById("selectedSeats");
    var seats = [];
  
    // Generate seat map dynamically (you can replace this with your own logic)
    for (var i = 1; i <= 20; i++) {
      var seat = document.createElement("div");
      seat.className = "seat";
      seat.dataset.seatNumber = i;
      seat.addEventListener("click", toggleSeatSelection);
      seatMap.appendChild(seat);
      seats.push(seat);
    }


    
  
    function toggleSeatSelection() {
      this.classList.toggle("selected");
  
      var seatNumber = this.dataset.seatNumber;
      var index = seats.indexOf(this);
  
      if (index !== -1) {
        if (this.classList.contains("selected")) {
          selectedSeats.innerHTML += seatNumber + " ";
        } else {
          selectedSeats.innerHTML = selectedSeats.innerHTML.replace(seatNumber + " ", "");
        }
      }
    }
  });
  