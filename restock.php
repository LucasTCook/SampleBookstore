<?php
    include("config.php");
    session_start();
    $ScreenName = $_SESSION['username'];
    setcookie("$ScreenName", "$ScreenName", time() + (300), "/");
        $sqlCust="SELECT username FROM Customers WHERE username='".$ScreenName."'";
        $result = $conn->query($sqlCust);
        if ($result->num_rows > 0) {
            header("location: welcomeCust.php");
        }
?>
    <div align="right">
    <form action="welcomeAdmin.php">
    <input type="submit" value="Back to Admin Page">
    </form>
    </div>
<?php
    $lowStock = "SELECT * FROM Books WHERE Quantity<10";
    $resultLowStock = $conn->query($lowStock);
    if ($resultLowStock->num_rows > 0) {
        // output data of each row
        echo "These books have less than 10 copies!!! (Re-stocking needed)";
        while($row = $resultLowStock->fetch_assoc()) {
            echo "<h3> Title: ". $row["Title"]." <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Quantity: ". $row["Quantity"]. "</h3>";
?>


<form method="post" action="">
<input type="submit" name="action" value="Re-Stock (1)"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
<form method="post" action="">
<input type="submit" name="action" value="Re-Stock (5)"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
<form method="post" action="">
<input type="submit" name="action" value="Re-Stock (10)"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
<form method="post" action="">
<input type="submit" name="action" value="Re-Stock (15)"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
</form>


<?php
    }
    }
    else echo "<br>No books need re-stocking<br>";
    error_reporting(0);
    if ($_POST['action'] && $_POST['id']) {
        if ($_POST['action'] == 'Re-Stock (1)') {
            $id = mysql_real_escape_string($_POST['id']);
            $restockSql="UPDATE Books SET Quantity = Quantity + 1 WHERE ISBN = '$id'";
            $conn->query($restockSql);
            header("Refresh:0");
        }
        if ($_POST['action'] == 'Re-Stock (5)') {
            $id = mysql_real_escape_string($_POST['id']);
            $restockSql="UPDATE Books SET Quantity = Quantity + 5 WHERE ISBN = '$id'";
            $conn->query($restockSql);
            header("Refresh:0");
        }
        if ($_POST['action'] == 'Re-Stock (10)') {
            $id = mysql_real_escape_string($_POST['id']);
            $restockSql="UPDATE Books SET Quantity = Quantity + 10 WHERE ISBN = '$id'";
            $conn->query($restockSql);
            header("Refresh:0");
        }
        if ($_POST['action'] == 'Re-Stock (15)') {
            $id = mysql_real_escape_string($_POST['id']);
            $restockSql="UPDATE Books SET Quantity = Quantity + 15 WHERE ISBN = '$id'";
            $conn->query($restockSql);
            header("Refresh:0");
        }
    }
    ?>
---------------------------------------------------------------------------------------------------------------
<br>

<?php
        $stock = "SELECT * FROM Books";
        $resultStock = $conn->query($stock);
        if ($resultStock->num_rows > 0) {
            // output data of each row
            while($row = $resultStock->fetch_assoc()) {
                echo "<h3> Title: ". $row["Title"]." <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Quantity: ". $row["Quantity"]. "";
        }
    }
    ?>
