<div align="right">
<form action="modifyBooks.php">
<input type="submit" value="Back">
</form>
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
    $ISBNnum=$_SESSION['modify'];


$modify = "SELECT * FROM Books WHERE ISBN='".$ISBNnum."'";
$result = $conn->query($modify);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h3> Title: ". $row["Title"]." <br> Author: ". $row["Author"]. " <br> Publisher: ". $row["Publisher"]. " <br> ISBN: ". $row["ISBN"];
?>

<form method="post" action="">
<input type="submit" name="action" value="Title"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
</form>
<form method="post" action="">
<input type="submit" name="action" value="Author"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
</form>
<form method="post" action="">
<input type="submit" name="action" value="Publisher"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
</form>
<form method="post" action="">
<input type="submit" name="action" value="ISBN"/>
<input type="hidden" name="id" value="<?php echo $row['ISBN']; ?>"/>
</form>
            <?php
                
        }
                
    }
                if ($_POST['action'] && $_POST['id']) {
                    if ($_POST['action'] == 'Title') {
                        $_SESSION['modifyAtr'] = "Title";
                    }
                    if ($_POST['action'] == 'Author') {
                        $_SESSION['modifyAtr'] = "Author";
                    }
                    if ($_POST['action'] == 'Publisher') {
                        $_SESSION['modifyAtr'] = "Publisher";
                    }
                    if ($_POST['action'] == 'ISBN') {
                        $_SESSION['modifyAtr'] = "ISBN";
                    }
                        echo "Update " . $_SESSION['modifyAtr'];
                    ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="text" value="Insert Updated Info Here..." name="update" size="40">
<input type="submit" value="UPDATE">
</form>

<?php
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['update'])){
            $_SESSION['updateInfo'] = $_POST['update'];
            $modifyAtr = $_SESSION['modifyAtr'];
            $updateInfo = '"'.$_SESSION['updateInfo'].'"';
            $ISBNnumSQL = '"'.$ISBNnum.'"';
            $updateSql = "UPDATE Books SET ". $modifyAtr ." = ". $updateInfo ." WHERE ISBN = ". $ISBNnumSQL ."";
            $conn->query($updateSql);
            header("Refresh:0");
        }
    }

?>
