<?php
    session_start();
    include('server.php');
    $error = array();

    if(isset($_POST['event_name']))
    {
        $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
        $show_type = mysqli_real_escape_string($con, $_POST['show_type']);
        $event_detail = mysqli_real_escape_string($con, $_POST['event_detail']);
        $show_date = mysqli_real_escape_string($con, $_POST['show_date']);
        $sale_date = mysqli_real_escape_string($con, $_POST['sale_date']);
        $limit_of_tickets = mysqli_real_escape_string($con, $_POST['limit_of_tickets']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $zone = $_POST['zone'];
        $zone_price = $_POST['zone_price'];

        if(move_uploaded_file($file_tmp, $target_dir . $file_name)){
            $_SESSION['upload_status'] = "The file ". $file_name. " has been uploaded successfully.";
        }else{
            $_SESSION['upload_status'] = "File upload failed!";
        }

        if(count($error) == 0) {
            $sql = "INSERT INTO Event (event_name, show_type, event_detail, show_date, sale_date, limit_of_tickets, location)
	        VALUES ('$event_name', '$show_type', '$event_detail', '$show_date', '$sale_date', '$limit_of_tickets', '$location')";
            if (!mysqli_query($con,$sql)) {
                die('Error: ' . mysqli_error($con));
            }

            $event_id = mysqli_insert_id($con);
            for ($i=0; $i < count($zone); $i++) {
                $zone_name = mysqli_real_escape_string($con, $zone[$i]);
                $zone_price = mysqli_real_escape_string($con, $zone_price[$i]);
                $sql = "INSERT INTO Zone (event_id, zone_name, zone_price)
                    VALUES ('$event_id', '$zone_name', '$zone_price')";
                if (!mysqli_query($con,$sql)) {
                    die('Error: ' . mysqli_error($con));
                }
            }
            header('location:index.php');
        } else {
            $_SESSION['error'] = $error;
            header('location:staff_create_new_event.php');
        }
    }
?>
