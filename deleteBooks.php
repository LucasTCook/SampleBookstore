<div align="right">
<form action="welcomeAdmin.php">
<input type="submit" value="Back to Admin Page">
</form>
</div>
<?php
    error_reporting(0);
    include("config.php");
    session_start();
    $ScreenName = $_SESSION['username'];
    setcookie("$ScreenName", "$ScreenName", time() + (300), "/");
    
    $sqlCust="SELECT username FROM Customers WHERE username='".$ScreenName."'";
    $result = $conn->query($sqlCust);
    if ($result->num_rows > 0) {
        header("location: welcomeCust.php");
    }
    $book = "SELECT * FROM Books";
    $resultBook = $conn->query($book);
    if ($resultBook->num_rows > 0) {
        // output data of each row
        while($row = $resultBook->fetch_assoc()) {
            echo "<h3> Title: ". $row["Title"]." <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Quantity: ". $row["Quantity"]. "";
            ?>
                <br>
                <form method="post" action="">
                <input type="submit" name="action" value="Delete"/>
                <input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
                </form>
            <?php
        }
    }

                
    if ($_POST['action'] && $_POST['id']) {
        if ($_POST['action'] == 'Delete') {
            if(isset($_POST['id'])){
                $delete='"'.$_POST['id'].'"';
                $sqlDelete = "DELETE FROM Books WHERE ISBN = ".$delete."";
                $conn->query($sqlDelete);
                header("Refresh:0");
            }
        }
    }
?>
