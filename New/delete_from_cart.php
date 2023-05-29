<?php
   ob_start();
   session_start();
   include('server.php');
   if(isset($_GET['rec']))
    {
        $rec = $_GET['rec'];
        $_SESSION['ProductID'][$rec] = "";
        $_SESSION['ProductQty'][$rec] = "";
    }
    header('location:cart.php');


?>