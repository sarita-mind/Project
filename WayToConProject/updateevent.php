<?php
include('server.php');

$sid = $_GET['id'];
$sql = "SELECT 
        s.ShowID, 
        s.ShowName, 
        typ.TypeName AS ShowType,
        s.TypeID, 
        t.ShowDateTime AS ShowDate,
        s.SaleDate, 
        s.LocationID, 
        l.LocationName,
        zfs.ZoneForShowName AS ZoneName,
        zfs.Price AS ZonePrice,
        zt.ZoneTypeName AS TypeofZones,
        z.ZoneCapacity AS NumberofSeats,
        s.Poster, 
        s.SeatingMap, 
        s.LimitTicket, 
        s.Description AS EventDetails
        FROM 
        showinfo s 
        LEFT JOIN 
        location l ON s.LocationID = l.LocationID
        LEFT JOIN
        showtime t ON s.ShowID = t.ShowID
        LEFT JOIN
        typeofshow typ ON s.TypeID = typ.TypeID
        LEFT JOIN
        zoneforshow zfs ON s.ShowID = zfs.ShowID
        LEFT JOIN
        zone z ON zfs.ZoneID = z.ZoneID
        LEFT JOIN
        zonetype zt ON z.ZoneTypeID = zt.ZoneTypeID
        WHERE
        s.ShowID = '$sid'";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$errors = array();

if (isset($_POST['edit_event'])) {
    $showID = mysqli_real_escape_string($con, $_POST['show_id']);
    $showName = mysqli_real_escape_string($con, $_POST['show_name']);
    $showType = mysqli_real_escape_string($con, $_POST['show_type']);
    $showDate = mysqli_real_escape_string($con, $_POST['show_date']);
    $saleDate = mysqli_real_escape_string($con, $_POST['sale_date']);
    $locationID = mysqli_real_escape_string($con, $_POST['location_id']);
    $zoneNames = $_POST['zone_name'];
    $zonePrices = $_POST['zone_price'];
    $zoneTypes = $_POST['zone_type'];
    $zoneCapacities = $_POST['zone_capacity'];

    $limitTicket = mysqli_real_escape_string($con, $_POST['limit_ticket']);
    $eventDetails = mysqli_real_escape_string($con, $_POST['event_details']);

    if (empty($showName)) {
        array_push($errors, "Please input the Event Name");
    }
    if (empty($showType)) {
        array_push($errors, "Please select the Show Type");
    }
    if (empty($showDate)) {
        array_push($errors, "Please select the Show Date");
    }
    if (empty($saleDate)) {
        array_push($errors, "Please input the Sale Date");
    }
    if (empty($locationID)) {
        array_push($errors, "Please input the Location ID");
    }
    if (empty($zoneNames)) {
        array_push($errors, "Please input the Zone Names");
    }
    if (empty($zonePrices)) {
        array_push($errors, "Please input the Zone Prices");
    }
    if (empty($zoneTypes)) {
        array_push($errors, "Please input the Zone Types");
    }
    if (empty($zoneCapacities)) {
        array_push($errors, "Please input the Zone Capacities");
    }

    if (empty($limitTicket)) {
        array_push($errors, "Please input the Limit Ticket");
    }
    if (empty($eventDetails)) {
        array_push($errors, "Please input the Event Details");
    }

    if (count($errors) == 0) {
        // Update showinfo table
        $updateShowInfoSql = "UPDATE showinfo SET ShowName = '$showName', TypeID = '$showType', SaleDate = '$saleDate', LocationID = '$locationID', LimitTicket = '$limitTicket', Description = '$eventDetails' WHERE ShowID = '$showID'";
        $updateShowInfoResult = mysqli_query($con, $updateShowInfoSql);

        if (!$updateShowInfoResult) {
            die('Error: ' . mysqli_error($con));
        }

        // Update showtime table
        $updateShowTimeSql = "UPDATE showtime SET ShowDateTime = '$showDate' WHERE ShowID = '$showID'";
        $updateShowTimeResult = mysqli_query($con, $updateShowTimeSql);

        if (!$updateShowTimeResult) {
            die('Error: ' . mysqli_error($con));
        }

        // Update zoneforshow table
        for ($i = 0; $i < count($zoneNames); $i++) {
            $zoneName = mysqli_real_escape_string($con, $zoneNames[$i]);
            $zonePrice = mysqli_real_escape_string($con, $zonePrices[$i]);
            $zoneType = mysqli_real_escape_string($con, $zoneTypes[$i]);
            $zoneCapacity = mysqli_real_escape_string($con, $zoneCapacities[$i]);


            $updateZoneForShowSql = "UPDATE zoneforshow SET ZoneForShowName = '$zoneName', Price = '$zonePrice' WHERE ShowID = '$showID' AND ZoneID = (SELECT ZoneID FROM zone WHERE ZoneTypeID = '$zoneType' AND ZoneCapacity = '$zoneCapacity' LIMIT 1)";
            $updateZoneForShowResult = mysqli_query($con, $updateZoneForShowSql);

            if (!$updateZoneForShowResult) {
                die('Error: ' . mysqli_error($con));
            }

            $updateZoneSql = "UPDATE zone SET ZoneCapacity = '$zoneCapacity' WHERE ZoneID = (SELECT ZoneID FROM zone WHERE ZoneTypeID = '$zoneType' AND ZoneCapacity = '$zoneCapacity' LIMIT 1)";
            $updateZoneResult = mysqli_query($con, $updateZoneSql);

            if (!$updateZoneResult) {
                die('Error: ' . mysqli_error($con));
            }

            $updateSeatSql = "UPDATE seat SET SeatNo = '$numberOfSeats' WHERE ZoneID = (SELECT ZoneID FROM zone WHERE ZoneTypeID = '$zoneType' AND ZoneCapacity = '$zoneCapacity' LIMIT 1)";
            $updateSeatResult = mysqli_query($con, $updateSeatSql);

            if (!$updateSeatResult) {
                die('Error: ' . mysqli_error($con));
            }
        }

        // Update cover page
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
            $coverImage = $_FILES['cover_image'];
            $fileExtension = pathinfo($coverImage['name'], PATHINFO_EXTENSION);
            $newFileName = 'cover_' . $showID . '.' . $fileExtension;
            $uploadPath = 'uploads/' . $newFileName;

            if (move_uploaded_file($coverImage['tmp_name'], $uploadPath)) {
                // Update showinfo table with new cover page
                $updateCoverPageSql = "UPDATE showinfo SET Poster = '$uploadPath' WHERE ShowID = '$showID'";
                $updateCoverPageResult = mysqli_query($con, $updateCoverPageSql);

                if (!$updateCoverPageResult) {
                    die('Error: ' . mysqli_error($con));
                }
            } else {
                die('Error uploading cover page.');
            }
        }

        // Update seating picture
        if (isset($_FILES['seating_picture']) && $_FILES['seating_picture']['error'] == 0) {
            $seatingPicture = $_FILES['seating_picture'];
            $fileExtension = pathinfo($seatingPicture['name'], PATHINFO_EXTENSION);
            $newFileName = 'seating_' . $showID . '.' . $fileExtension;
            $uploadPath = 'uploads/' . $newFileName;

            if (move_uploaded_file($seatingPicture['tmp_name'], $uploadPath)) {
                // Update showinfo table with new seating picture
                $updateSeatingPictureSql = "UPDATE showinfo SET SeatingMap = '$uploadPath' WHERE ShowID = '$showID'";
                $updateSeatingPictureResult = mysqli_query($con, $updateSeatingPictureSql);

                if (!$updateSeatingPictureResult) {
                    die('Error: ' . mysqli_error($con));
                }
            } else {
                die('Error uploading seating picture.');
            }
        }

        echo "<script>alert('Update Event Information Successfully');</script>";
        echo "<script>window.location='all_event.php';</script>";
    } else {
        echo "<script>alert('Error! Please try again');</script>";
        echo "<script>window.location='all_event.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToCon Staff</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel="stylesheet" href="updateevent.css">
    <link rel="preconnect" href="https://fonts.googleapis.com/" >
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="updateevent.js"></script>

</head>

<body>
    <?php include_once('staffheader.php'); ?>
    <div class="container">
        
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Update New Event</h1>

            <h2>Show ID</h2>
            <div class="box">
                    <input class="box" name="show_id" type="text" value="<?= $row['ShowID'] ?>" readonly />
            </div><br>

            <h2>Event Name</h2>
            <div class="box">
                    <input class="box" name="show_name" type="text" value="<?= $row['ShowName'] ?>" />
            </div><br>

            <h2>Cover Page</h2>
            Upload a new picture of the event poster (optional)
            <div class="box upload-box1">
                <input type="file" id="cover_image" name="cover_image">
                <br>
                <img width="50%" id="imgpreview" src="<?= $row['Poster'] ?>" class="">
            </div> <br>

            <h2>Show Type</h2>
                <div class="box">
                    <select class="form-select mt-2" name="show_type">
                        <?php
                        $typeQuery = "SELECT * FROM typeofshow";
                        $typeResult = mysqli_query($con, $typeQuery);
                        while ($typeRow = mysqli_fetch_array($typeResult)) {
                            if ($typeRow['TypeID'] == $row['TypeID']) {
                                echo "<option value='{$typeRow['TypeID']}' selected>{$typeRow['TypeName']}</option>";
                            } else {
                                echo "<option value='{$typeRow['TypeID']}'>{$typeRow['TypeName']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div><br>

            <h2>Event Details</h2>
                <div class="box"> 
                    <textarea class="form-control mt-2" name="event_details"><?= $row['EventDetails'] ?></textarea>
                </div><br>
                

            <h2>Show Dates</h2>
            <div class="box" id="show-dates-container">   
                    <input class="form-control mt-2" name="show_date" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($row['ShowDate'])) ?>" />
            
            </div><br>

            
            <h2>Sale Dates</h2>
            <div class="box">
                    <input class="form-control mt-2" name="sale_date" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($row['SaleDate'])) ?>" />
            </div><br>

            <h2>Condition of sales</h2>
            Limit ticket(s)
            <div class="box">
                    <input class="form-control mt-2" name="limit_ticket" type="number" value="<?= $row['LimitTicket'] ?>" />
            </div><br>
        
            <h2>Location Name</h2>
                <div class="box">
                    <select class="form-select mt-2" name="location_id">
                        <?php
                        $locationQuery = "SELECT * FROM location";
                        $locationResult = mysqli_query($con, $locationQuery);
                        while ($locationRow = mysqli_fetch_array($locationResult)) {
                            if ($locationRow['LocationID'] == $row['LocationID']) {
                                echo "<option value='{$locationRow['LocationID']}' selected>{$locationRow['LocationName']}</option>";
                            } else {
                                echo "<option value='{$locationRow['LocationID']}'>{$locationRow['LocationName']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div><br>

            <h2>Zone</h2>   
            <div id="zones-container">
                <?php
                $zoneQuery = "SELECT zfs.Price AS ZonePrice, zfs.ZoneForShowName, z.ZoneCapacity, z.ZoneTypeID
                FROM zoneforshow zfs 
                JOIN zone z ON zfs.ZoneID = z.ZoneID 
                WHERE zfs.ShowID = '$sid'";
                $zoneResult = mysqli_query($con, $zoneQuery);
                while ($zoneRow = mysqli_fetch_array($zoneResult)) {
                    echo "<div class='box'>
                    <label>Zone Name</label>
                    <input class='form-control mt-2' type='text' name='zone_name[]' value='{$zoneRow['ZoneForShowName']}' />
                    <label>Zone Price:</label>
                    <input class='form-control mt-2' type='text' name='zone_price[]' value='{$zoneRow['ZonePrice']}' />
                    <label>Type of Zone:</label>
                    <select class='form-select mt-2' name='zone_type[]'>
                        <option value='1' " . ($zoneRow['ZoneTypeID'] == 1 ? 'selected' : '') . ">Sit</option>
                        <option value='2' " . ($zoneRow['ZoneTypeID'] == 2 ? 'selected' : '') . ">Stand</option>
                    </select>
                    <label>Number of Seats</label>
                    <input class='form-control mt-2' type='text' name='zone_capacity[]' value='{$zoneRow['ZoneCapacity']}' />

                </div>";
                }
                
                ?>
                <button type="button" id="add_zone_new_slot">Add New Zone</button>
            </div><br>

                
            <h2>Seating Picture</h2>
            Upload a new picture of the event poster (optional)
            <div class="box upload-box2">

                <input type="file" id="seating_picture" name="seating_picture">
                <img width="50%" id="seatingpreview" src="<?= $row['SeatingMap'] ?>">
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input type="submit" name="edit_event" class="update_event" value="Update Event" />
                    <a href="all_event.php" class="cancel_event">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>