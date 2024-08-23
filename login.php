<?php require('includes/header.php') ?>

<?php
    if (isset($_REQUEST['data_send'])) {
        echo "Your Session is Ended.";
    }
?>

<form action="login2.php" method="post">
    <center>
        <input type="text" name="username" id="username" placeholder="Enter Your Username" required>
        <input type="password" name="password" id="password" placeholder="Enter Your Password" required>
        <input type="submit" name="submit" value="Login">
    </center>
</form>

<?php require('includes/footer.php') ?>