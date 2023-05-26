<?php
    session_start();
    include('server.php');
    $error = array();
    if(isset($_POST['login_staff']))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        if(empty($email)){
            array_push($error, "Please Input data Email");
        }
        if(empty($password)){
            array_push($error, "Please Input data Password");
        }

        if(count($error) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM Staff WHERE StaffEmail = '$email' AND StaffPassword = '$password'";
            $result = mysqli_query($con,$query);
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['StaffEmail'] = $email;
                $_SESSION['success'] = 'You are logged in';
                header('location:staff.php');
            } else {
                array_push($error,'Wrong email or/and password');
                $_SESSION['error'] = 'Wrong Username or Password';
                header('location:stafflogin.php');
            }
        }
    }

?>