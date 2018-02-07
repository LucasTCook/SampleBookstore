<?php
    error_reporting(0);
    include("config.php");
    ?>
<div align="right">
<form action="search.php">
<input type="submit" value="Back to Search">
</form>
</div>
<div align="center">
<h3>Create a Customer Account!</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Name" name="Name" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Address" name="Address" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Address Line 2" name="Address2" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="City, State" name="City" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Zip Code" name="Zip" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Phone Number" name="Phone" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Username" name="Username" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="password" value-"Password" name="Password" size="40">
<br><input type="submit">
</form>
</div>

<?php
    if(isset($_POST['Username'])){
        $username=$_POST['Username'];
        $sql="SELECT username FROM Customers WHERE username='".$username."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Username already exists";
        }
        else{
            $name=$_POST['Name'];
            $address1=$_POST['Address'];
            $address2=$_POST['Address2'];
            $city=$_POST['City'];
            $zip=$_POST['Zip'];
            $phone=$_POST['Phone'];
            $password=$_POST['Password'];
            
            $sql = "INSERT INTO Customers (Name, Address, Address2, City, Zip, Phone, Username, Password) VALUES ('$name', '$address1', '$address2', '$city', '$zip', '$phone', '$username', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "New Account Successfully Created!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>
