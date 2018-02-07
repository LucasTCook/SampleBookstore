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
    
    ?>
<div align="right">
<form action="welcomeAdmin.php">
<input type="submit" value="Back to Admin Page">
</form>
</div>
<div align="center">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Title" name="Title" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Author" name="Author" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="ISBN" name="ISBN" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Publisher" name="Publisher" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Edition" name="Edition" size="40">
<br><form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Price" name="Price" size="40">
<br><input type="submit">
</form>
</div>

<?php
    if(isset($_POST['Title'])){
        $title=$_POST['Title'];
        $author=$_POST['Author'];
        $ISBN=$_POST['ISBN'];
        $publisher=$_POST['Publisher'];
        $edition=$_POST['Edition'];
        $price=$_POST['Price'];
        $sql = "SELECT * FROM Books WHERE ISBN = ".'"'.$ISBN.'"'."";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO Books (Title, Author, ISBN, Publisher, Edition, Price, Quantity) VALUES ('$title', '$author', '$ISBN', '$publisher', '$edition', '$price', 0)";
    
            if ($conn->query($sql) === TRUE) {?>
                <div align="center">
                <?php echo "New book added successfully"; ?>
                </div>
<?php
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else{
            echo "Book already exists in store.";
        }
    }
?>
