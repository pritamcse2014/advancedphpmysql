<?php require('includes/header.php') ?>

<?php
    session_start();

    if ($_SESSION['username'] == true) {
        if ((time() - $_SESSION['current_timestamp']) > 10) {
            header("location: logout.php");
        } else {
            echo "Welcome to" . ' ' . $_SESSION['username'];
            echo "<br>";
            echo "<a href='logout.php'>Logout</a>";
        }
    } else {
        header("location: login.php");
    }
?>

<?php require('includes/footer.php') ?>