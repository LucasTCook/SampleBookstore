<?php
   session_start();
    unset($_SESSION['CC']);
    unset($_SESSION['CVV']);
    unset($_SESSION['exp']);
    unset($_SESSION['shipping']);
    unset($_SESSION['disablethispage']);
   header("Location: search.php");
?>
