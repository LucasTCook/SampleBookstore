<div align=right>
<form action="home.php">
<input type="submit" value="Back to Search">
</form>
</div>
<h1>Thank you for your order!</h1>
<?php
    include("config.php");
    session_start();
    
    if(!isset($_SESSION['disablethispage'])){
        $_SESSION['disablethispage'] = true;
        // serving the page first time
        
    }else{
        header("location:home.php");
        break;
        
    }
    
    $amount = 100; // the amount of ids
    $previousValues = array();
    $rand = rand(0, 9999);
    while (in_array($rand, $previousValues)){
        $rand = rand(0, 9999);
    }
    $previousValues[] = $rand;
    $today = date("Ymd");
    $_SESSION['orderNum'] = ($today.$rand);
    
        $book = '"'.$_SESSION['orderISBN'].'"';
       $sql = "SELECT * FROM Books WHERE ISBN = ".$book."";
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {
               echo "<h3> Title: ". $row["Title"]." <br> Edition: ". $row["Edition"]. " <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br>";
           }
       }
    ?><br><br><?php
        echo "Order Number: ".$_SESSION['orderNum']. "<br>";
        echo "Total cost: $".$_SESSION['totalCost']. "<br>";
    if($_SESSION['shipping'] == 4.99){
        $d=strtotime("+5 Days");
        echo "You've selected Ground Shipping, and your order will arrive between ";
        echo "(" . date("d-m-Y", $d) . " - ";
        $d=strtotime("+8 Days");
        echo date("d-m-Y", $d) . ")<br>";
        $shipping = "Ground";
    }

    if($_SESSION['shipping'] == 9.99){
        $d=strtotime("+3 Days");
        echo "You've selected Express Shipping, and your order will arrive between ";
        echo "(" . date("d-m-Y", $d) . " - ";
        $d=strtotime("+5 Days");
        echo date("d-m-Y", $d) . ")<br>";
        $shipping = "Express";
    }
        echo "<br><br>Shipping Address: <br>". $_SESSION['Add1']." ".$_SESSION['Add2'];
        echo "<br>". $_SESSION['City']." ".$_SESSION['Zip']; 

    $updateOrders = "INSERT INTO Orders (OrderNum, ISBN, Username, Price, Shipping_Method, Date) VALUES (".'"'.$_SESSION['orderNum'].'"'.",".$book.",".'"'.$_SESSION['username'].'"'.", ".$_SESSION['totalCost'].", ".'"'.$shipping.'"'.", ".'"'.date("Y-m-d").'"'.")";
        $conn->query($updateOrders);
        $updateStock = "UPDATE BOOKS SET Quantity = (Quantity - 1) WHERE ISBN = ".$book."";
        $conn->query($updateStock);
    
?>
