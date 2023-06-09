<!DOCTYPE html>
<html>
<?php
include_once('server.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$error = array();
session_start();
if (isset($_SESSION['upload_status'])) {
    echo '<p>' . $_SESSION['upload_status'] . '</p>';
    unset($_SESSION['upload_status']);
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff_create_new_event</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel="stylesheet" href="staff_create_new_event.css">
    <script src="staff_create_new_event.js"></script>
</head>
<body>
    <?php include_once('staffheader.php'); ?>
    <div class="container">
        <form action="staff_create_new_eventdb.php" method="post" enctype="multipart/form-data">
            <h1>Create New Event</h1>

            <h2>Cover Page</h2>
            <div class="box upload-box1">
                <p>Upload a picture of the event poster</p>
                <input type="file" id="cover_image" name="cover_image">
                <!-- <label for="cover_image" class="custom-file-upload">Choose File</label> -->
            </div>

            <h2>Event Name and Show Type</h2>
            <div class="box">
                <input type="text" id="event_name" name="event_name" placeholder="Event name">
                <select id="show_type" name="show_type"> <!-- Make sure the name attribute matches -->
                    <option value="Concert">Concert</option>
                    <option value="Sport">Sport</option>
                    <option value="Show">Show</option>
                </select>
            </div>

            <h2>Event Details</h2>
            <div class="box">
                <textarea id="event_detail" name="event_detail" style="width: 100%;"></textarea>
            </div>

            <h2>Show Dates</h2>
            <div class="box" id="show-dates-container">
                <div class="show-date-slot">
                    <p>Slot 1</p>
                    <input type="datetime-local" name="show_date[]">
                    <button type="button">Delete this slot</button>
                </div>
                <button id="add_date_new_slot" type="button">Add new slot</button>
            </div>

            <h2>Sale Date</h2>
            <div class="box" id="sale-dates-container">
                <input type="datetime-local" id="sale_date" name="sale_date"><br><br>
            </div>

            <h2>Condition of sales</h2>
            <div class="box">
                <h3>Limit of Ticket(s)</h3>
                <input type="number" id="limit_of_tickets" name="limit_of_tickets" min="1" max="9" placeholder="Select a number"><br><br>
            </div>

            <h2>Location</h2>
            <div class="box">
                <select id="location" name="location" required>
                    <option value="" disabled selected hidden>Select Location</option>
                    <?php
                    $locationQuery = "SELECT * FROM location ORDER BY LocationName";
                    $locationResult = mysqli_query($con, $locationQuery);

                    if ($locationResult && mysqli_num_rows($locationResult) > 0) {
                        while ($row = mysqli_fetch_assoc($locationResult)) {
                            echo '<option value="' . $row['LocationName'] . '">' . $row['LocationName'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No locations found</option>';
                    }

                    mysqli_close($con);
                    ?>
                </select>
            </div>

            <h2>Zone</h2>
            <div class="box" id="zones-container">
                <div class="zone-slot">
                    <p>Zone 1</p>
                    <input type="text" name="zone_name[]" placeholder="Zone Name">
                    <input type="number" name="zone_price[]" min="0" placeholder="Zone Price">
                    <select name="zone_type[]">
                        <option value="stand">Stand</option>
                        <option value="sit">Sit</option>
                    </select>
                    <input type="number" name="zone_seats[]" min="0" placeholder="Number of Seats">
                    <button type="button">Delete this zone</button>
                </div>
                <button type="button" id="add_zone_new_slot">Add New Zone</button>
            </div>

            <h2>Zone and Seating Picture</h2>
            <div class="box upload-box2">
                <p>Upload a picture of Zone and Seating</p>
                <input type="file" id="zone_image" name="zone_image">
            </div>

            <input type="submit" value="Create New Event">
        </form>
    </div>
</body>
</html>