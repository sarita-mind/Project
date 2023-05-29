<?php
include('server.php');

$sid = $_GET['id'];
$sql = "SELECT * FROM location WHERE LocationID = '$sid'";
$result = mysqli_query($con, $sql);

// Fetch the location details
$location = mysqli_fetch_assoc($result);

$sql = "SELECT l.*, z.*, zo.*, z.*, s.*
        FROM location l
        LEFT JOIN zone z ON l.LocationID = z.LocationID
        LEFT JOIN seat s ON z.ZoneID = s.ZoneID
        LEFT JOIN zonetype zo ON zo.ZoneTypeID = z.ZoneTypeID
        WHERE l.LocationID = '$sid'
        ORDER BY l.LocationID, z.ZoneID, zo.ZoneTypeID, s.SeatID";
$result = mysqli_query($con, $sql);

// Fetch all the zones
$zones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $zones[] = $row;
}

$errors = array();

if (isset($_POST['edit_location'])) {
    $locationID = mysqli_real_escape_string($con, $_POST['location_id']);
    $locationName = mysqli_real_escape_string($con, $_POST['location_name']);
    $capacity = mysqli_real_escape_string($con, $_POST['location_capacity']);
    $address = mysqli_real_escape_string($con, $_POST['location_address']);
    $zoneIDs = $_POST['zone_id'];
    $zoneTypes = $_POST['zone_type'];
    $zoneCapacities = $_POST['zone_capacity'];
    $seatNumbers = $_POST['seat_numbers'];
    $seatRows = $_POST['seat_rows'];
    $seatIDs = $_POST['seat_ids']; // Retrieve the seat IDs from the form

    if (empty($locationName)) {
        array_push($errors, "Please input the Location Name");
    }
    if (empty($capacity)) {
        array_push($errors, "Please input the Capacity (Seats)");
    }
    if (empty($address)) {
        array_push($errors, "Please input the Location Address");
    }
    if (empty($zoneIDs)) {
        array_push($errors, "Please input the Zone IDs");
    }
    if (empty($zoneTypes)) {
        array_push($errors, "Please input the Zone Types");
    }
    if (empty($zoneCapacities)) {
        array_push($errors, "Please input the Zone Capacities");
    }
    if (empty($seatNumbers)) {
        array_push($errors, "Please input the Seat Numbers");
    }
    if (empty($seatRows)) {
        array_push($errors, "Please input the Seat Rows");
    }

    if (count($errors) == 0) {
        // Update location information
        $sqlLocation = "UPDATE location SET LocationName = '$locationName', Capacity = '$capacity', LocationAddress = '$address' WHERE LocationID = '$locationID'";
        $resultLocation = mysqli_query($con, $sqlLocation);

        if (!$resultLocation) {
            die('Error: ' . mysqli_error($con));
        }

        // Update zone information
        for ($i = 0; $i < count($zoneIDs); $i++) {
            $zoneID = mysqli_real_escape_string($con, $zoneIDs[$i]);
            $zoneType = mysqli_real_escape_string($con, $zoneTypes[$i]);
            $zoneCapacity = mysqli_real_escape_string($con, $zoneCapacities[$i]);

            $sqlZone = "UPDATE zone SET ZoneTypeID = '$zoneType', ZoneCapacity = '$zoneCapacity' WHERE ZoneID = '$zoneID'";
            $resultZone = mysqli_query($con, $sqlZone);

            if (!$resultZone) {
                die('Error: ' . mysqli_error($con));
            }
        }

        // Update seat information
        for ($i = 0; $i < count($zoneIDs); $i++) {
            $zoneID = mysqli_real_escape_string($con, $zoneIDs[$i]);
            $zoneType = mysqli_real_escape_string($con, $zoneTypes[$i]);
            $zoneCapacity = mysqli_real_escape_string($con, $zoneCapacities[$i]);
            $seatNumber = mysqli_real_escape_string($con, $seatNumbers[$i]);
            $seatRow = mysqli_real_escape_string($con, $seatRows[$i]);
            $seatID = mysqli_real_escape_string($con, $seatIDs[$i]);

            $sqlSeat = "UPDATE seat SET SeatNo = '$seatNumber', SeatRow = '$seatRow' WHERE ZoneID = '$zoneID' AND SeatID = '$seatID'";
            $resultSeat = mysqli_query($con, $sqlSeat);

            if (!$resultSeat) {
                die('Error: ' . mysqli_error($con));
            }
        }

        echo "<script>alert('Update Location Information Successfully');</script>";
        echo "<script>window.location='all_venue.php';</script>";
    } else {
        echo "<script>alert('Error! Please try again');</script>";
        echo "<script>window.location='all_venue.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToCon</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel="stylesheet" href="staffmember.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include_once('staffheader.php'); ?>
    <div class="h5 text-center mb-5 mt-5"> Edit Staff Information </div>
    <form action="" method="POST">
        <div class='container'>
            <div class='row'>
                <div class='col-sm-1'></div>
                <div class='col-sm-10'>
                    <div class="form-group">
                        <label class="id">Location ID :</label>
                        <div class="col-sm-8">
                            <input class="form-control mt-2" name="location_id" type="text"
                                value="<?= $location['LocationID'] ?? $sid ?>" readonly />
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="first_name">Location Name :</label>
                        <div class="col-sm-8">
                            <input class="form-control mt-2" name="location_name" type="text"
                                value="<?= $location['LocationName'] ?? '' ?>" />
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="last_name">Capacity(Seats) :</label>
                        <div class="col-sm-8">
                            <input class="form-control mt-2" name="location_capacity" type="text"
                                value="<?= $location['Capacity'] ?? '' ?>" />
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="dob">Location Address:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control mt-2" name="location_address"><?= isset($location['LocationAddress']) ? $location['LocationAddress'] : '' ?></textarea>
                        </div>
                    </div>
                    <br>

                    <div id="zones-container">
                        <?php foreach ($zones as $index => $zone): ?>
                            <div class="box">
                                <label>Zone Information:</label>
                                <input class="form-control mt-2" type="text" name="zone_id[]"
                                    value="<?= $zone['ZoneID'] ?>" readonly />
                                <label>Zone Type:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="zone_type[<?= $index ?>]" value="1"
                                        <?= $zone['ZoneTypeID'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label">Sit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="zone_type[<?= $index ?>]" value="2"
                                        <?= $zone['ZoneTypeID'] == 2 ? 'checked' : '' ?>>
                                    <label class="form-check-label">Stand</label>
                                </div>
                                <label>Zone Capacity:</label>
                                <input class="form-control mt-2" type="text" name="zone_capacity[]"
                                    value="<?= $zone['ZoneCapacity'] ?>" />
                                <label>Zone Seat ID:</label>
                                <input class="form-control mt-2" type="text" name="seat_ids[]"
                                    value="<?= $zone['SeatID'] ?>" readonly />

                                <label>Zone Seat Numbers:</label>
                                <input class="form-control mt-2" type="text" name="seat_numbers[]"
                                    value="<?= $zone['SeatNo'] ?>" />
                                <label>Zone Seat Rows:</label>
                                <input class="form-control mt-2" type="text" name="seat_rows[]"
                                    value="<?= $zone['SeatRow'] ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="submit" name="edit_location" class="add_staff" value="Update Location" />
                            <a href="all_venue.php" class="cancel_staff">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class='col-sm-1'></div>
            </div>
        </div>
    </form>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
