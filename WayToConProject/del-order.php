<?php
    ob_start();
    session_start();
    include('server.php');
    if(!isset($_SESSION['record']))
    {
        $_SESSION['record'] = 0;
        $_SESSION['ProductID'][0] = $_GET['id'];
        $_SESSION['ProductQty'][0] = 1;
        header('location:cart.php');
    }
    else
    {
        $key = array_search($_GET['id'],$_SESSION['ProductID']);
        if((string)$key != ""){
            $_SESSION['ProductQty'][$key] = $_SESSION['ProductQty'][$key] - 1;
        }
        else {
            $_SESSION['record'] = $_SESSION['record']+1;
            $newRec = $_SESSION['record'];
            $_SESSION['ProductID'][$newRec] = $_GET['id'];
            $_SESSION['ProductQty'][$newRec] = 1;
        }
        header('location:cart.php');
    }

?>