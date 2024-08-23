<?php require('includes/header.php') ?>

<?php
    $connection = mysqli_connect('localhost', 'root', '', 'users');
    
    if (!$connection) {
        die("DB Not Connected.".mysqli_error($connection));
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $query = "SELECT * FROM user_info WHERE id = $id";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
?>
    <form action="update.php" method="post">
        <input type="text" name="username" id="username" placeholder="Enter Your Username"  value="<?php echo $username ?>" required>
        <input type="email" name="email" id="email" placeholder="Enter Your Email"  value="<?php echo $email ?>" required>
        <input type="password" name="password" id="password" placeholder="Enter Your Password"  value="<?php echo $password ?>" required>
        <input type="submit" name="submit" value="update">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>
<?php
        }
    }
?>

<?php require('includes/footer.php') ?>