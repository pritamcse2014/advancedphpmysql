<?php require('includes/header.php') ?>

<?php
    session_start();

    $connection = mysqli_connect('localhost', 'root', '', 'users');

    if(!$connection) {
        die('DB Connection Failed.' .mysqli_connect_error());
    }
    
    if(isset($_REQUEST['submit'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
    
        $query = "SELECT * FROM login_check WHERE username = '$username' && password = '$password'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
    
        if($count) {
            // echo "<p style='color: green;'>Login Successfully.</p>";
            $_SESSION['username'] = $username;
            $_SESSION['current_timestamp'] = time();
            header("location: login3.php");
        } else {
            echo "<p style='color: red;'>Login Failed.</p>";
        }
    }
?>

<?php require('includes/footer.php') ?>