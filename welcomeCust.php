<html">
<?php
    include("config.php");
    session_start();
    $ScreenName = $_SESSION['username'];
    setcookie("$ScreenName", "$ScreenName", time() + (300), "/");
    
    $sqlCust="SELECT username FROM Admins WHERE username='".$ScreenName."'";
    $result = $conn->query($sqlCust);
    if ($result->num_rows > 0) {
        header("location: welcomeAdmin.php");
    }
    
    if( isset( $_COOKIE["$ScreenName"]  ) )
    {
        ?>
<head>
<title>Welcome </title>
</head>
<body>
<div align="right">
<form action="logout.php">
<input type="submit" value="Logout">
</form>
<form action="home.php">
<input type="submit" value="Back to Search">
</form>
</div>
<h1>Welcome, <?php echo $ScreenName ?>!</h1>
The following are your recent orders:
</body>
</html>
<?php
    }
    else
    {
        header("location: logout.php");
    }

    $sql = "SELECT * FROM Orders WHERE Username = ".'"'.$ScreenName.'"'."";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br><br>Order Number ". $row["OrderNum"]."<br>Price: ". $row["Price"]."<br>Date of Purchase: ".$row["Date"];

            $sql2 = "SELECT * FROM Books WHERE ISBN = ".'"'.$row["ISBN"].'"'."";
            $result2 = $conn->query($sql2);
            
            if ($result2->num_rows > 0) {
                // output data of each row
                while($row2 = $result2->fetch_assoc()) {
                    echo "<br>Title: ". $row2["Title"]." <br> Edition: ". $row2["Edition"]. " <br> Author: ". $row2["Author"]. " <br> Publisher: ". $row2["Publisher"]. " <br> ISBN: ". $row2["ISBN"];
                }
            }
        }
    }
    
    ?>
