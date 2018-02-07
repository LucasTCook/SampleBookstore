<?php
    include("config.php");
    session_start();
    $username = '"'.$_SESSION['username'].'"';
    $sql = "UPDATE Customers SET Zip = 0 WHERE Username =".$username;
    $conn->query($sql);
    header("location:order.php");
?>
