<?php require('includes/header.php') ?>

<?php
    $connection = mysqli_connect('localhost', 'root', '', 'users');
    
    if (!$connection) {
        die("DB Not Connected.".mysqli_error($connection));
    }

    if (isset($_REQUEST['submit'])) {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $id = $_REQUEST['id'];
        $query = "UPDATE user_info SET username = '$username', email = '$email', password = '$password' WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header("location: read.php?updated");
        }
    }
?>

<?php require('includes/footer.php') ?>