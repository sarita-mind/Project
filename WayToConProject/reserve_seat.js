document.addEventListener("DOMContentLoaded",function() {
    var seatMap = document.getElementById("seat-map");
    var selectedSeats = document.getElementById("selectedSeats")
    var seats=[]

    function clicked(str)
            {
                obj = document.getElementById(str);
                
                if(obj.className == 'seat available')
                    obj.className = 'seat clicked';
                
                else if(obj.className == 'seat clicked')
                    obj.className = 'seat available';
            }

    // fetch("reserve_seat.php")
    //     .then(function(response){
    //         return response.json()
    //     })
    //     .then(function(seat){
    //         generateSeatMap(seat);
    //     })


    // function generateSeatMap(seatData) {
    //     for (var i = 0; i < seatData.length; i++) {
    //       var seat = seatData[i];
    //       var seatElement = document.createElement("div");
    //       seatElement.className = "seat";
    //       seatElement.dataset.seatNumber = seat.seatNumber;
    //       if (seat.reserved) {
    //         seatElement.classList.add("reserved");
    //       }
    //       seatElement.addEventListener("click", toggleSeatSelection);
    //       seatMap.appendChild(seatElement);
    //       seats.push(seatElement);
    //     }
    //   }

      // function toggleSeatSelection() {
      //   if (this.classList.contains("reserved")) {
      //     return;
      //   }
    
      //   this.classList.toggle("selected");
    
      //   var seatNumber = this.dataset.seatNumber;
      //   var index = seats.indexOf(this);
    
      //   if (index !== -1) {
      //     if (this.classList.contains("selected")) {
      //       selectedSeats.innerHTML += seatNumber + " ";
      //     } else {
      //       selectedSeats.innerHTML = selectedSeats.innerHTML.replace(seatNumber + " ", "");
      //     }
      //   }
      // }
})