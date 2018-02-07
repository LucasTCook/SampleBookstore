   <head>
      <title>Order Preview</title>
   </head>
   
   <body>
	<div align=right>
    <form action="home.php">
    <input type="submit" value="Back to Search">
    </form>
	</div>
      <h1>Order Preview</h1>
   </body>
   <?php
       error_reporting(0);
       include("config.php");
       session_start();
       
       if(isset($_SESSION['shipping']) && isset($_SESSION['CC'])){
           header("location:orderConfirm.php");
       }
       #echo $_SESSION['CC']." ".$_SESSION['CVV']." ".$_SESSION['exp']." ".$_SESSION['shipping'];
       $usernameSQL = '"'.$_SESSION['username'].'"';
       $book = '"'.$_SESSION['orderISBN'].'"';
       $sql = "SELECT * FROM Books WHERE ISBN = ".$book."";
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {
               echo "<h3> Title: ". $row["Title"]." <br> Edition: ". $row["Edition"]. " <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"]. " <br> Price: $". $row["Price"]. "";
               $price = $row["Price"];
           }
       }
       ?>
   <br>
<br>
<?php
    if(!isset($_SESSION['shipping'])){
        echo "Method of Shipment: ";
    ?>
    <form method="post" action="">
    <input type="submit" name="action" value="Ground Shipping ($4.99) (5-8 Days)"/>
    <input type="hidden" name="id" value="4.99"/>
    </form>
    <form method="post" action="">
    <input type="submit" name="action" value="Express Shipping ($9.99) (3-5 Days)"/>
    <input type="hidden" name="id" value="9.99"/>
    </form>

<?php
    }
    if ($_POST['action'] && $_POST['id']) {
        $_SESSION['shipping'] = $_POST['id'];
        header("Refresh:0");
    }
    
    $username = '"'.$_SESSION['username'].'"';
    $ccCheckSql = "SELECT * FROM Customers WHERE Username = ".$username." AND CC_Num = 0";
    $resultCC = $conn->query($ccCheckSql);
    
    if($resultCC->num_rows > 0){
?>
            <br>
            <form action="" method="post">
            Credit Card Number: <input type="text" name="CC" /><br />
            CVV: <input type="text" name="CVV" /><br />
            Expiration Date (XX/XX): <input type="text" name="exp" /><br />
            <input type="submit" name="submit" value="Enter" />
            </form>
<?php
    }
    else{
        $getCCInfo = "SELECT * FROM Customers WHERE Username = ".$usernameSQL;
        $resultCC = $conn->query($getCCInfo);
        while ($row = $resultCC->fetch_assoc()) {
            $_SESSION['CC'] = $row["CC_Num"];
            $_SESSION['CVV'] = $row["CVV"];
            $_SESSION['exp'] = $row["Exp_Date"];
            echo "Credit Card Number: ".$_SESSION['CC'];
    ?> <br>
        <?php echo "CVV: ".$_SESSION['CVV']; ?> <br>
        <?php echo "Expiration Date: ".$_SESSION['exp']; ?> <br><br>
            <div align=left>
            <form action="clearCC.php">
            <input type="submit" value="Change Credit Card Information">
            </form>
            </div>

<?php
}
}

    if(isset($_POST['CC']) && isset($_POST['CVV']) && isset($_POST['exp'])){
        $CC = '"'.$_POST['CC'].'"';
        $CVV = '"'.$_POST['CVV'].'"';
        $exp = '"'.$_POST['exp'].'"';
        $_SESSION['CC'] = $_POST['CC'];
        $_SESSION['CVV'] = $_POST['CVV'];
        $_SESSION['exp'] = $_POST['exp'];
        $addCCSql = "UPDATE Customers SET CC_Num =".$CC.", CVV =".$CVV.", Exp_Date = ".$exp." WHERE Username =".$usernameSQL;
        
        $conn->query($addCCSql);
        header("Refresh:0");
    }
    
        $addressCheckSql = "SELECT * FROM Customers WHERE Username = ".$username." AND Zip = 0";
        $resultAdd = $conn->query($addressCheckSql);
        if($resultAdd->num_rows > 0){
    ?>
            <br>
            <form action="" method="post">
            Address Line 1: <input type="text" name="Add1" /><br />
            Address Line 2: <input type="text" name="Add2" /><br />
            City: <input type="text" name="City" /><br />
            Zip Code: <input type="text" name="Zip" /><br />
            <input type="submit" name="submit" value="Enter" />
            </form>
    <?php
        }
        else{
            $getInfo = "SELECT * FROM Customers WHERE Username = ".$usernameSQL;
            $resultInfo = $conn->query($getInfo);
            while ($row = $resultInfo->fetch_assoc()) {
                echo "Shipping Address: <br>".$row["Address"]." ".$row["Address2"]."<br>".$row["City"]." ".$row["Zip"];
                $_SESSION['Add1'] = $row["Address"];
                $_SESSION['Add2'] = $row["Address2"];
                $_SESSION['City'] = $row["City"];
                $_SESSION['Zip'] = $row["Zip"];
            }
    ?>
        <div align=left>
        <form action="clearAddress.php">
        <input type="submit" value="Change Shipping Address">
        </form>
        </div>

<?php
    }
        if(isset($_POST['Add1']) && isset($_POST['Add2']) && isset($_POST['City']) && isset($_POST['Zip'])){
            $add1 = '"'.$_POST['Add1'].'"';
            $add2 = '"'.$_POST['Add2'].'"';
            $city = '"'.$_POST['City'].'"';
            $zip = '"'.$_POST['Zip'].'"';
            $addAddSql = "UPDATE Customers SET Address =".$add1.", Address2 =".$add2.", City = ".$city.", Zip = ".$zip." WHERE Username =".$usernameSQL;
    
            $conn->query($addAddSql);
            header("Refresh:0");
        }




?>
