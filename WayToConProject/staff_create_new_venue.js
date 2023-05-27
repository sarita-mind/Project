document.addEventListener("DOMContentLoaded", function () {
  let zoneCounter = 1;

  // Function to create a new zone slot
  function createNewZoneSlot() {
    var zonesContainer = document.getElementById("zones-container");

    var newZoneSlot = document.createElement("div");
    newZoneSlot.className = "zone-slot";

    var slotLabel = document.createElement("p");
    slotLabel.textContent = "Zone ";

    var newZoneSelect = document.createElement("select");
    newZoneSelect.name = "show_type[]";

    var disabledOption = document.createElement("option");
    disabledOption.disabled = true;
    disabledOption.selected = true;
    disabledOption.style.color = "gray";
    disabledOption.hidden = true;
    disabledOption.textContent = "Type";

    var SitOption = document.createElement("option");
    SitOption.value = "Sit";
    SitOption.textContent = "Sit";

    var StandOption = document.createElement("option");
    StandOption.value = "Stand";
    StandOption.textContent = "Stand";

    newZoneSelect.appendChild(disabledOption);
    newZoneSelect.appendChild(SitOption);
    newZoneSelect.appendChild(StandOption);

    var newZoneCapacityInput = document.createElement("input");
    newZoneCapacityInput.type = "text";
    newZoneCapacityInput.name = "zonecapacity[]";
    newZoneCapacityInput.placeholder = "Capacity(Seats)";

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
    newZoneSlot.appendChild(newZoneSelect);
    newZoneSlot.appendChild(newZoneCapacityInput);
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
  var zonesContainer = document.getElementById("zones-container");
  zonesContainer.addEventListener("click", function (event) {
    if (event.target.classList.contains("add-seat-button")) {
      createNewSeatSlot(event);
    }
  });
});
