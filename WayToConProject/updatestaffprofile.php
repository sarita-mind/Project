<?php

session_start();
include('server.php');

$staff_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {

    $update_firstname = mysqli_real_escape_string($con, $_POST['update_firstname']);
    $update_lastname = mysqli_real_escape_string($con, $_POST['update_lastname']);
    $update_phone = mysqli_real_escape_string($con, $_POST['update_phone']);
    $update_email = mysqli_real_escape_string($con, $_POST['update_email']);

    mysqli_query($con, "UPDATE `staff` SET StaffFirstName = '$update_firstname', StaffLastName = '$update_lastname', StaffEmail = '$update_email', StaffPhone = '$update_phone' WHERE StaffID = '$staff_id'") or die('query failed');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="update-profile">

        <?php
        $select = mysqli_query($con, "SELECT * FROM Staff WHERE StaffID = '$staff_id'") or die('Query failed');
        if (mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (!empty($fetch['image'])) {
                echo '<img src="uploaded_img/' . $fetch['image'] . '">';
            } else {
                echo '<img src="image/default-avatar.png">';
            }
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <div class="flex">
                <div class="inputBox">
                    <span>First Name :</span>
                    <input type="text" maxlength="20" name="update_firstname"
                        value="<?php echo $fetch['StaffFirstName']; ?>" class="box">
                    <span>Last Name :</span>
                    <input type="text" maxlength="20" name="update_lastname"
                        value="<?php echo $fetch['StaffLastName']; ?>" class="box">
                    <span>Phone :</span>
                    <input type="text" maxlength="10" minlength="10" name="update_phone"
                        value="<?php echo $fetch['StaffPhone']; ?>" class="box">
                    <span>email :</span>
                    <input type="email" maxlength="30" name="update_email" value="<?php echo $fetch['StaffEmail']; ?>"
                        class="box">
                </div>
            </div>
            <input type="submit" value="update profile" name="update_profile" class="btn">
            <a href="staffprofile.php" class="delete-btn">go back</a>
        </form>

    </div>

</body>

</html>