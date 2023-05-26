document.addEventListener("DOMContentLoaded", function() {

    let showDateCounter = 1;
    let zoneCounter = 1;

    // Manage Show Dates
    function createNewDateSlot() {
        var showDatesContainer = document.getElementById('show-dates-container');
        
        var newDateSlot = document.createElement('div');
        newDateSlot.className = 'show-date-slot';

        var slotLabel = document.createElement('p');
        slotLabel.textContent = "Slot " + (++showDateCounter);

        var newDateInput = document.createElement('input');
        newDateInput.type = 'datetime-local';
        newDateInput.name = 'show_date[]';

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete this slot';
        deleteButton.type = 'button';
        deleteButton.addEventListener('click', function() {
            newDateSlot.remove();
            --showDateCounter;
            manageDeleteButtons('show-date-slot');
        });

        newDateSlot.appendChild(slotLabel);
        newDateSlot.appendChild(newDateInput);
        newDateSlot.appendChild(deleteButton);

        var addDateButton = document.getElementById('add_date_new_slot');
        showDatesContainer.insertBefore(newDateSlot, addDateButton);
    }

    // Manage Zones
    function createNewZoneSlot() {
        var zonesContainer = document.getElementById('zones-container');

        var newZoneSlot = document.createElement('div');
        newZoneSlot.className = 'zone-slot';

        var slotLabel = document.createElement('p');
        slotLabel.textContent = "Zone " + (++zoneCounter);

        var newZoneInput = document.createElement('input');
        newZoneInput.type = 'text';
        newZoneInput.name = 'zone[]';
        newZoneInput.placeholder = 'Zone Name';

        var newZonePriceInput = document.createElement('input');
        newZonePriceInput.type = 'number';
        newZonePriceInput.name = 'zone_price[]';
        newZonePriceInput.min = '0';
        newZonePriceInput.placeholder = 'Zone Price';

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete this zone';
        deleteButton.type = 'button';
        deleteButton.addEventListener('click', function() {
            newZoneSlot.remove();
            --zoneCounter;
            manageDeleteButtons('zone-slot');
        });

        newZoneSlot.appendChild(slotLabel);
        newZoneSlot.appendChild(newZoneInput);
        newZoneSlot.appendChild(newZonePriceInput);
        newZoneSlot.appendChild(deleteButton);

        var addZoneButton = document.getElementById('add_zone_new_slot');
        zonesContainer.insertBefore(newZoneSlot, addZoneButton);
    }

    // Manage Delete Buttons
    function manageDeleteButtons(slotClassName) {
        var slots = document.getElementsByClassName(slotClassName);
        for(let i=0; i < slots.length; i++) {
            var deleteButton = slots[i].querySelector('button');
            deleteButton.disabled = slots.length === 1;
        }
    }

    // Add Event Listeners
    document.getElementById('add_date_new_slot').addEventListener('click', createNewDateSlot);
    document.getElementById('add_zone_new_slot').addEventListener('click', createNewZoneSlot);

    // Manage Delete Buttons on Page Load
    manageDeleteButtons('show-date-slot');
    manageDeleteButtons('zone-slot');
});
