<?php
    include("config.php");
    session_start();
    $username = '"'.$_SESSION['username'].'"';
    $sql = "UPDATE Customers SET CC_Num = 0 WHERE Username =".$username;
    $conn->query($sql);
    header("location:order.php");
?>
