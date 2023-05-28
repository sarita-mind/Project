<?php
session_start();
include('server.php');

if (!isset($_SESSION['user_id'])) {
    header('location: stafflogin.php');
    exit;
}

$staff_id = $_SESSION['user_id'];

if (isset($_GET['logout'])) {
    unset($staff_id);
    session_destroy();
    header('location: stafflogin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WayToCon</title>
    <link rel="icon" type="image/x-icon" href="image/Logo.png" />
    <link rel="stylesheet" href="stafflogin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
            $select = mysqli_query($con, "SELECT * FROM Staff WHERE StaffID = '$staff_id'") or die('Query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
                if (!empty($fetch['image'])) {
                    echo '<img src="uploaded_img/' . $fetch['image'] . '">';
                } else {
                    echo '<img src="image/default-avatar.png">';
                }
                echo '<h3>' . $fetch['StaffFirstName'] . '</h3>';
            }
            ?>
            <a href="updatestaffprofile.php" class="btn">Update Profile</a>
            <a href="stafflogin.php?logout=<?php echo $staff_id; ?>" class="delete-btn">Logout</a>
            <p>New <a href="stafflogin.php">login</a> or <a href="staff.php">Go to Staff page</a></p>
        </div>
    </div>
</body>

</html>