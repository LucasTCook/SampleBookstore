<html>

<?php
    include("config.php");
    session_start();
    $ScreenName = $_SESSION['username'];
    setcookie("$ScreenName", "$ScreenName", time() + (300), "/");
    ?>

<?php
    $username=$_SESSION['username'];
    $sqlCust="SELECT username FROM Customers WHERE username='".$username."'";
    $result = $conn->query($sqlCust);
    if ($result->num_rows > 0) {
        header("location: welcomeCust.php");
    }
    ?>

<div align="right">
<form action="logout.php">
<input type="submit" value="Logout">
</form>
<form action="home.php">
<input type="submit" value="Back to Search">
</form>
</div>
<head>
<title>Welcome </title>
</head>
<body>
<h1>Welcome, <?php echo $ScreenName ?>!</h1>
</body>
<?php
    if( isset( $_COOKIE["$ScreenName"]  ) )
        {
            ?>
                <form action="addBooks.php">
                <input type="submit" value="Add a Book">
                </form>
                <form action="modifyBooks.php">
                <input type="submit" value="Modify a Book">
                </form>
                <form action="deleteBooks.php">
                <input type="submit" value="Remove a Book">
                </form>
                <form action="restock.php">
                <input type="submit" value="Check Inventory">
                </form>
            <?php
        }
        else
        {
            header("location: logout.php");
        }
    ?>
</html>
