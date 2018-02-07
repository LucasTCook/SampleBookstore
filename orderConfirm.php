<div align=right>
<form action="orderBack.php">
<input type="submit" value="Back to Order Page">
</form>
</div>
<h1>Order Confirmation</h1>
<?php
    include("config.php");
    session_start();
    $book = '"'.$_SESSION['orderISBN'].'"';
    $sql = "SELECT * FROM Books WHERE ISBN = ".$book."";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h3> Title: ". $row["Title"]." <br> Edition: ". $row["Edition"]. " <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"];
            $bookPrice = $row["Price"];
        }
    }
?>
<br>
<br>
<?php echo "Credit Card Number: ".$_SESSION['CC']; ?> <br>
<?php echo "CVV: ".$_SESSION['CVV']; ?> <br>
<?php echo "Expiration Date: ".$_SESSION['exp']; ?> <br><br>

<?php echo "Shipping Address: <br>". $_SESSION['Add1']." ".$_SESSION['Add2']; ?>
<?php echo "<br>". $_SESSION['City']." ".$_SESSION['Zip']; ?>

<?php echo "<br><br>Item Cost: $".$bookPrice; ?><br>
<?php echo "Shipping Cost: $".$_SESSION['shipping']; ?><br><br>
<?php echo "Total: $".($bookPrice+$_SESSION['shipping']);
    $_SESSION['totalCost'] = ($bookPrice+$_SESSION['shipping'])?><br>

<div align=left>
<form action="thankYou.php">
<input type="submit" value="Confirm Order!">
</form>
</div>
