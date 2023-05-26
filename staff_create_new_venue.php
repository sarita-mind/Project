<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['upload_status'])) {
    echo '<p>' . $_SESSION['upload_status'] . '</p>';
    unset($_SESSION['upload_status']);
}
?>

<head>
    <link rel="stylesheet" href="staff_create_new_venue.css">
</head>

<body>

    <form action="staff_create_new_vanuedb.php" method="post" enctype="multipart/form-data">
        <h1>Create New Venue</h1>

        <h2>Venue Detail</h2>
        <div class="box">
            <input type="text" id="venue_name" name="venue_name" placeholder="Venue name">
            <img src="https://cdn-icons-png.flaticon.com/128/1159/1159633.png"
                data-src="https://cdn-icons-png.flaticon.com/128/1159/1159633.png" alt="Edit " title="Edit " width="25"
                height="25" class="lzy lazyload--done"
                srcset="https://cdn-icons-png.flaticon.com/128/1159/1159633.png 4x"
                style="position: absolute; top: 9.7%; left: 93%; transform: translate(-50%, -50%); filter: invert(70%)">
            <p>Capacity</p>
            <div class="text-small-venue">
                <input type="text" id="Capacity" name="Capacity" placeholder="Capacity">
            </div>
            <span class="text-behind">Seats</span>
            <p>Address</p>
            <textarea id="Address" name="Address" rows="10" cols="103"></textarea>
            <img src="https://cdn-icons-png.flaticon.com/128/1159/1159633.png"
                data-src="https://cdn-icons-png.flaticon.com/128/1159/1159633.png" alt="Edit " title="Edit " width="25"
                height="25" class="lzy lazyload--done"
                srcset="https://cdn-icons-png.flaticon.com/128/1159/1159633.png 4x"
                style="position: absolute; top: 53%; left: 93%; transform: translate(-50%, -50%); filter: invert(70%)">
        </div>


        <h2>Zone</h2>
        <div class="box">
            <div class="text-small">
                <div id="zones-container">
                    <div class="zone-slot">
                        <span style="font-weight: bold;">Zone</span>
                        <!-- <input type="text" id="zone_name" name="zone_name[]" placeholder="Zone Name">
                        <select id="show_type" name="show_type[]">
                            <option disabled selected style="color: gray;" disabled hidden>Type</option>
                            <option value="concert">Concert</option>
                            <option value="sport">Sport</option>
                            <option value="show">Show</option>
                        </select>
                        <input type="text" id="Capacity" name="Capacity[]" placeholder="Capacity">
                        <span>Seats</span> -->
                        <button type="button" class="add-seat-button">Add Seat</button>
                        <button type="button" class="delete-zone-button">Delete this zone</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add_zone_new_slot">Add New Zone</button>
        </div>




        <input type="submit" value="Create New Event">
    </form>
    <script src="staff_create_new_venue.js"></script>
</body>

</html>