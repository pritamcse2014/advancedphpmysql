<?php
    $connection = mysqli_connect('localhost', 'root', '', 'users');
    
    if (!$connection) {
        die("DB Not Connected.".mysqli_connect_error());
    }

    $id = $_REQUEST['id'];
    $image = $_REQUEST['image'];

    $query = "DELETE FROM user_info WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        unlink("uploads/$image");
        header("location: read.php?deleted");
    }
?>