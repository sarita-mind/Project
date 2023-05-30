<?php
include('server.php');

mysqli_query($con, "SET SESSION group_concat_max_len = 1000000;");

$eventquery = "SELECT 
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
LEFT JOIN
    seat st ON z.ZoneID = st.ZoneID
ORDER BY
    s.ShowID, t.ShowDateTime";

$result = mysqli_query($con, $eventquery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WayToCon Staff</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel="stylesheet" href="all_event.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include_once('staffheader.php'); ?>
    <div class="container">
        <div class="h5 text-center mb-5 mt-5"> All Events </div>
        <table class="table table-striped">
            <tr class="table-secondary">
                <!-- <th>Show ID</th> -->
                <th>Event Name</th>
                <th>Show Type</th>
                <th>Show Dates</th>
                <th>Zone Names</th>
                <th>Zone Prices</th>
                <th>Type of Zones</th>
                <th>Number of Seats</th>
                <th>Sale Date</th>
                <th>Location Name</th>
                <th>Poster</th>
                <!-- <th>Seating Map</th> -->
                <th>Limit Ticket</th>
                <!-- <th>Event Details</th> -->
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            $previousShowID = '';
            $previousShowDate = '';
            $rowspanCount = 0;
            while ($row = mysqli_fetch_array($result)) {
                if ($previousShowID != $row['ShowID'] || $previousShowDate != $row['ShowDate']) {
                    if ($rowspanCount > 0) {
                        echo '</tr>';
                    }
                    $previousShowID = $row['ShowID'];
                    $previousShowDate = $row['ShowDate'];
                    $rowspanCount = 1;
                    // Fetch the count of all zones for this ShowID
                    $zone_count_query = "SELECT COUNT(*) as count FROM zoneforshow WHERE ShowID = {$row['ShowID']}";
                    $zone_count_result = mysqli_query($con, $zone_count_query);
                    $zone_count_data = mysqli_fetch_assoc($zone_count_result);
                    $rowspanCount = $zone_count_data['count'];
                    echo "<tr>
         
                       <td rowspan='{$rowspanCount}'>{$row['ShowName']}</td>
                       <td rowspan='{$rowspanCount}'>{$row['ShowType']}</td>
                       <td rowspan='{$rowspanCount}'>{$row['ShowDate']}</td>
                       <td>{$row['ZoneName']}</td>
                       <td>{$row['ZonePrice']}</td>
                       <td>{$row['TypeofZones']}</td>


                       <td>{$row['NumberofSeats']}</td>
                       <td rowspan='{$rowspanCount}'>{$row['SaleDate']}</td>
                       <td rowspan='{$rowspanCount}'>{$row['LocationName']}</td>

                       <td rowspan='{$rowspanCount}'><img src='image/{$row['Poster']}' alt='Poster'  height='100'></td>
                       
                       <td rowspan='{$rowspanCount}'>{$row['LimitTicket']}</td>
                      
                       <td rowspan='{$rowspanCount}'><a class='edit_event mt-1' href='updateevent.php?id={$row['ShowID']}'>Edit</a></td>
                       <td rowspan='{$rowspanCount}'><a class='delete_event mt-1' href='deleteevent.php?id={$row['ShowID']}' onclick='confirmdel(this.href);return false;'>Delete</a></td>
                   </tr>";
                } else {
                    echo "<tr>
                       <td>{$row['ZoneName']}</td>
                       <td>{$row['ZonePrice']}</td>
                       <td>{$row['TypeofZones']}</td>
                       <td>{$row['NumberofSeats']}</td>
                   </tr>";
                }
            }
            if ($rowspanCount > 0) {
                echo '</tr>';
            }
            ?>
        </table>

        <a class='add_event mt=1' href="staff_create_new_event.php">Add New Event</a>
        <a class='add_event mt=1' href="newzone_event.php">Add Zone</a>
    </div>
</body>

</html>


<script>
    function confirmdel(page) {
        var agree = confirm('Are you sure to delete this event?');
        if (agree) {
            window.location = page;
        }
    }
</script>