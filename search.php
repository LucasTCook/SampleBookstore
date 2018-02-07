<!DOCTYPE html>
<html>
<body>
<p><body>
<div align="right">
<?php
    error_reporting(0);
    include("config.php");
    session_start();
    $ScreenName = $_SESSION['username'];
    setcookie("$ScreenName", "$ScreenName", time() + (300), "/");
    
    
    
    if( isset( $_COOKIE[$_SESSION['username']]  ) )
    {
        echo $_SESSION['username'];
        ?>
        <form action="logout.php">
        <input type="submit" value="Logout">
        </form>
        </div>

<?php
    
    
    $username=$_SESSION['username'];
    $sqlCust="SELECT username FROM Customers WHERE username='".$username."'";
    $result = $conn->query($sqlCust);
    if ($result->num_rows > 0) {
        ?>
        <div align="right">
        <form action="welcomeCust.php">
        <input type="submit" value="Account">
        </form>
        </div>
<?php
    }
    $sqlAdmin="SELECT username FROM Admins WHERE username='".$username."'";
    $result = $conn->query($sqlAdmin);
    if ($result->num_rows > 0) {
        ?>
        <div align="right">
        <form action="welcomeAdmin.php">
        <input type="submit" value="Account">
        </form>
        </div>
<?php
    }
    }
    else{
?>
        <div align="right">
        <form action="login.php">
        <input type="submit" value="Member's Login">
        </form>
        <form action="addCust.php">
        <input type="submit" value="Create an Account">
        </form>
        </div>
<?php
    }
    
    ?>

    <div align="center">
    <h3>Welcome to the CS Bookstore!</h3>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <input type="text" value="Search by Title, ISBN, Author, or Publisher" name="fname" size="40">
    <input type="submit">
    </form>
    </div>
    <div align="left">
<?php
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    
    if (empty($name)) {
        $books = "SELECT * FROM Books";
        $resultBooks = $conn->query($lowStock);
        if ($resultBooks->num_rows > 0) {
            // output data of each row
            while($row = $resultBooks->fetch_assoc()) {
                echo "<h3> Title: ". $row["Title"]." <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Quantity: ". $row["Quantity"]. "";
            }
        }
    }
    
    $sql = "SELECT * FROM Books WHERE Title LIKE '%".$name."%' OR ISBN LIKE '%".$name."%' OR Author LIKE '%".$name."%' OR Publisher LIKE '%".$name."%'";
    $result = $conn->query($sql);
    $resultCust = $conn->query($sqlCust);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
            echo "<h3> Title: ". $row["Title"]." <br> Edition: ". $row["Edition"]. " <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Price: $". $row["Price"]. "";
            if(isset( $_COOKIE[$_SESSION['username']])){
                if ($resultCust->num_rows > 0) {
                
?>

            <form method="post" action="">
            <input type="submit" name="action" value="Order"/>
            <input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
            </form>
<?php
    }
    }
    }
    } else {
        echo "0 results";
    }
    $conn->close();
    }
    if ($_POST['action'] && $_POST['id']) {
        if ($_POST['action'] == 'Order') {
            $_SESSION['orderISBN'] = $_POST['id'];
            header("location: order.php");
        }
    }
    
    ?>
</div>
</body>
</html>
