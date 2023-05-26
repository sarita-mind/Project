document.addEventListener("DOMContentLoaded", function () {
  let zoneCounter = 1;

  // Function to create a new zone slot
  function createNewZoneSlot() {
    var zonesContainer = document.getElementById("zones-container");

    var newZoneSlot = document.createElement("div");
    newZoneSlot.className = "zone-slot";

    var slotLabel = document.createElement("p");
    slotLabel.textContent = "Zone ";

    var newZoneInput = document.createElement("input");
    newZoneInput.type = "text";
    newZoneInput.name = "zone_name[]";
    newZoneInput.placeholder = "Zone Name";

    var newZoneSelect = document.createElement("select");
    newZoneSelect.name = "show_type[]";

    var disabledOption = document.createElement("option");
    disabledOption.disabled = true;
    disabledOption.selected = true;
    disabledOption.style.color = "gray";
    disabledOption.hidden = true;
    disabledOption.textContent = "Type";

    var concertOption = document.createElement("option");
    concertOption.value = "concert";
    concertOption.textContent = "Concert";

    var sportOption = document.createElement("option");
    sportOption.value = "sport";
    sportOption.textContent = "Sport";

    var showOption = document.createElement("option");
    showOption.value = "show";
    showOption.textContent = "Show";

    newZoneSelect.appendChild(disabledOption);
    newZoneSelect.appendChild(concertOption);
    newZoneSelect.appendChild(sportOption);
    newZoneSelect.appendChild(showOption);

    var newZoneCapacityInput = document.createElement("input");
    newZoneCapacityInput.type = "text";
    newZoneCapacityInput.name = "Capacity[]";
    newZoneCapacityInput.placeholder = "Capacity";

    var seatsLabel = document.createElement("span");
    seatsLabel.textContent = "Seats";

    var seatsContainer = document.createElement("div");
    seatsContainer.className = "seats-container";

    var addSeatButton = document.createElement("button");
    addSeatButton.textContent = "Add Seat";
    addSeatButton.type = "button";
    addSeatButton.addEventListener("click", createNewSeatSlot);

    var deleteZoneButton = document.createElement("button");
    deleteZoneButton.textContent = "Delete this zone";
    deleteZoneButton.type = "button";
    deleteZoneButton.addEventListener("click", function () {
      newZoneSlot.remove();
      --zoneCounter;
    });

    newZoneSlot.appendChild(slotLabel);
    newZoneSlot.appendChild(newZoneInput);
    newZoneSlot.appendChild(newZoneSelect);
    newZoneSlot.appendChild(newZoneCapacityInput);
    newZoneSlot.appendChild(seatsLabel);
    newZoneSlot.appendChild(seatsContainer);
    newZoneSlot.appendChild(addSeatButton);
    newZoneSlot.appendChild(deleteZoneButton);

    zonesContainer.appendChild(newZoneSlot);
    zoneCounter++;
  }

  // Function to create a new seat slot
  function createNewSeatSlot(event) {
    var seatContainer =
      event.target.parentNode.querySelector(".seats-container");

    var newSeatSlot = document.createElement("div");
    newSeatSlot.className = "seat-slot";

    var seatLabel = document.createElement("span");
    seatLabel.style.fontWeight = "bold";
    seatLabel.textContent = "Seat";

    var newSeatNumberInput = document.createElement("input");
    newSeatNumberInput.type = "text";
    newSeatNumberInput.name = "seat_number[]";
    newSeatNumberInput.placeholder = "Seat Number";

    var newSeatRowInput = document.createElement("input");
    newSeatRowInput.type = "text";
    newSeatRowInput.name = "seat_row[]";
    newSeatRowInput.placeholder = "Seat Row";

    var deleteSeatButton = document.createElement("button");
    deleteSeatButton.textContent = "Delete this seat";
    deleteSeatButton.type = "button";
    deleteSeatButton.addEventListener("click", function () {
      newSeatSlot.remove();
    });

    newSeatSlot.appendChild(seatLabel);
    newSeatSlot.appendChild(newSeatNumberInput);
    newSeatSlot.appendChild(newSeatRowInput);
    newSeatSlot.appendChild(deleteSeatButton);

    seatContainer.appendChild(newSeatSlot);
  }

  // Add event listener to the "Add New Zone" button
  var addZoneButton = document.getElementById("add_zone_new_slot");
  addZoneButton.addEventListener("click", createNewZoneSlot);

  // Add event listener to the "Add Seat" button in the existing zone
  var addSeatButtons = document.getElementsByClassName("add-seat-button");
  for (var i = 0; i < addSeatButtons.length; i++) {
    addSeatButtons[i].addEventListener("click", createNewSeatSlot);
  }
});
