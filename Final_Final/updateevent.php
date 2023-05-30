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

$datesQuery = "SELECT ShowDateTime FROM showtime WHERE ShowID = '$sid'";
$datesResult = mysqli_query($con, $datesQuery);

$showDates = array();
while ($row = mysqli_fetch_array($datesResult)) {
    $showDates[] = $row['ShowDateTime'];
}

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$errors = array();

if (isset($_POST['edit_event'])) {
    $showID = mysqli_real_escape_string($con, $_POST['show_id']);
    $showName = mysqli_real_escape_string($con, $_POST['show_name']);
    $showType = mysqli_real_escape_string($con, $_POST['show_type']);
    $showDates = isset($_POST['show_date']) ? $_POST['show_date'] : array();
    $saleDate = mysqli_real_escape_string($con, $_POST['sale_date']);
    $locationID = mysqli_real_escape_string($con, $_POST['location_id']);
    $zoneNames = isset($_POST['zone_name']) ? $_POST['zone_name'] : array();
    $zonePrices = isset($_POST['zone_price']) ? $_POST['zone_price'] : array();
    $limitTicket = mysqli_real_escape_string($con, $_POST['limit_ticket']);
    $eventDetails = mysqli_real_escape_string($con, $_POST['event_details']);

    // Loop through the show dates array
    foreach ($showDates as $key => $showDate) {
        $showDate = mysqli_real_escape_string($con, $showDate);
        $zoneName = mysqli_real_escape_string($con, $zoneNames[$key]);
        $zonePrice = mysqli_real_escape_string($con, $zonePrices[$key]);
        $zoneType = mysqli_real_escape_string($con, $zoneTypes[$key]);
        $zoneCapacity = mysqli_real_escape_string($con, $zoneCapacities[$key]);

        // Rest of your code for handling each show date and zone
    }
    // if (empty($showName)) {
    //     array_push($errors, "Please input the Event Name");
    // }
    // if (empty($showType)) {
    //     array_push($errors, "Please select the Show Type");
    // }
    // if (empty($showDates)) {
    //     array_push($errors, "Please select at least one Show Date");
    // }
    // if (empty($saleDate)) {
    //     array_push($errors, "Please input the Sale Date");
    // }
    // if (empty($locationID)) {
    //     array_push($errors, "Please input the Location ID");
    // }
    // if (empty($zoneNames)) {
    //     array_push($errors, "Please input the Zone Names");
    // }
    // if (empty($zonePrices)) {
    //     array_push($errors, "Please input the Zone Prices");
    // }
    // if (empty($zoneTypes)) {
    //     array_push($errors, "Please input the Zone Types");
    // }
    // if (empty($zoneCapacities)) {
    //     array_push($errors, "Please input the Zone Capacities");
    // }

    // if (empty($limitTicket)) {
    //     array_push($errors, "Please input the Limit Ticket");
    // }
    // if (empty($eventDetails)) {
    //     array_push($errors, "Please input the Event Details");
    // }

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
        $zoneIDs = isset($_POST['zone_id']) ? $_POST['zone_id'] : array();

        for ($i = 0; $i < count($zoneNames); $i++) {
            $zoneName = mysqli_real_escape_string($con, $zoneNames[$i]);
            $zonePrice = mysqli_real_escape_string($con, $zonePrices[$i]);
            $zoneID = mysqli_real_escape_string($con, $zoneIDs[$i]);

            $updateZoneForShowSql = "UPDATE zoneforshow SET ZoneForShowName = '$zoneName', Price = '$zonePrice' WHERE ShowID = '$showID' AND ZoneID = '$zoneID'";
            $updateZoneForShowResult = mysqli_query($con, $updateZoneForShowSql);

            if (!$updateZoneForShowResult) {
                die('Error: ' . mysqli_error($con));
            }
        }

        // if (is_uploaded_file($_FILES['new_poster_image']['tmp_name'])) {
        //     $new_image_name = $_FILES['new_poster_image']['name'];
        //     $image_upload_path = "./uploads/" . $new_image_name;
        //     move_uploaded_file($_FILES['new_poster_image']['tmp_name'], $image_upload_path);
        // } else {
        //     $new_image_name = "";
        // }
    
        // if (is_uploaded_file($_FILES['new_seating_image']['tmp_name'])) {
        //     $new_image_name = $_FILES['new_seating_image']['name'];
        //     $image_upload_path = "./uploads/" . $new_image_name;
        //     move_uploaded_file($_FILES['new_seating_image']['tmp_name'], $image_upload_path);
        // } else {
        //     $new_image_name = "";
        // }

//         // Update cover page
        if (isset($_FILES['new_poster_image']) && $_FILES['new_poster_image']['error'] == 0) {
    $coverImage = $_FILES['new_poster_image'];
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
    <link rel="preconnect" href="https://fonts.googleapis.com/">
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
            <?php
                foreach ($showDates as $showDate) {
                    echo '<input class="form-control mt-2" name="show_date[]" type="datetime-local" value="'.date('Y-m-d\TH:i', strtotime($showDate)).'" />';
                }
            ?>
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
                $zoneQuery = "SELECT zfs.Price AS ZonePrice, zfs.ZoneForShowName, z.ZoneCapacity AS NumberofSeats, z.ZoneTypeID, z.ZoneID, l.LocationName, zt.ZoneTypeName
                            FROM zoneforshow zfs 
                            JOIN zone z ON zfs.ZoneID = z.ZoneID 
                            JOIN location l ON z.LocationID = l.LocationID
                            JOIN zonetype zt ON z.ZoneTypeID = zt.ZoneTypeID
                            WHERE zfs.ShowID = '$sid'";

                $zoneResult = mysqli_query($con, $zoneQuery);

                $selectedZones = []; // Array to store the selected zone IDs

                
                while ($zoneRow = mysqli_fetch_array($zoneResult)) {
                    $zoneID = isset($zoneRow['ZoneID']) ? $zoneRow['ZoneID'] : '';
                    $zoneName = isset($zoneRow['ZoneForShowName']) ? $zoneRow['ZoneForShowName'] : '';
                    $zonePrice = isset($zoneRow['ZonePrice']) ? $zoneRow['ZonePrice'] : '';
                    $locationName = isset($zoneRow['LocationName']) ? $zoneRow['LocationName'] : '';
                    $zoneType = isset($zoneRow['ZoneTypeName']) ? $zoneRow['ZoneTypeName'] : '';
                    $zoneCapacity = isset($zoneRow['NumberofSeats']) ? $zoneRow['NumberofSeats'] : '';

                    echo "<div class='box'>
                        <label>Zone Name</label>
                        <input class='form-control mt-2' type='text' name='zone_name[]' value='{$zoneName}' />
                        <label>Zone Price:</label>
                        <input class='form-control mt-2' type='number' name='zone_price[]' min='0' value='{$zonePrice}' />";

                    // Check if the current zone is selected
                    if (in_array($zoneID, $selectedZones)) {
                        echo "<option value='$zoneID' selected>$locationName | Zone: $zoneID | Zone Type: $zoneType | Capacity: $zoneCapacity</option>";
                    } else {
                        echo "<option value='$zoneID'>$locationName | Zone: $zoneID | Zone Type: $zoneType | Capacity: $zoneCapacity</option>";
                    }

                    echo "</div>";

                    // Add the zone ID to the selected zones array
                    $selectedZones[] = $zoneID;
                }
                ?>
</div><br>


 <h2>Cover Page</h2>
                <div class="box upload-box1">
                    <img id="cover_output" class="img-fluid" src="image/<?= $row['Poster'] ?>" />
                    <input type="hidden" name="old_poster_image" value="<?= $row['Poster'] ?>">
                    <input type="file" id="new_poster_image" name="new_poster_image" accept="image/png, image/jpg" onchange="loadFile(event, 'cover_output')">
                </div>
                

                <script>
                    var loadFile = function(event, imageId) {
                        var image = document.getElementById(imageId);
                        var input = event.target;

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                var img = new Image();

                                img.onload = function() {
                                    var maxWidth = 250;
                                    var maxHeight = 300;
                                    var width = img.width;
                                    var height = img.height;

                                    if (width > maxWidth || height > maxHeight) {
                                        var ratio = Math.min(maxWidth / width, maxHeight / height);
                                        width *= ratio;
                                        height *= ratio;
                                    }

                                    image.style.width = width + 'px';
                                    image.style.height = height + 'px';
                                    image.src = e.target.result;
                                };

                                img.src = e.target.result;
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    };
                </script>



                <h2>Seating Picture</h2>
                    <div class="box upload-box2">
                        <img id="seating_output" class="img-fluid" src="image/<?= $row['SeatingMap'] ?>" />
                        <input type="hidden" name="old_seating_image" value="<?= $row['SeatingMap'] ?>">
                        <input type="file" id="new_seating_image" name="new_seating_image" accept="image/png, image/jpg" onchange="loadFile(event, 'seating_output')">
                    </div>
                
                    <script>
                        var loadFile = function(event, imageId) {
                            var image = document.getElementById(imageId);
                            var input = event.target;

                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    var img = new Image();

                                    img.onload = function() {
                                        var maxWidth = 600;
                                        var maxHeight = 400;
                                        var width = img.width;
                                        var height = img.height;

                                        if (width > maxWidth || height > maxHeight) {
                                            var ratio = Math.min(maxWidth / width, maxHeight / height);
                                            width *= ratio;
                                            height *= ratio;
                                        }

                                        image.style.width = width + 'px';
                                        image.style.height = height + 'px';
                                        image.src = e.target.result;
                                    };

                                    img.src = e.target.result;
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        };
                    </script>



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