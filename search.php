<?php require('includes/header.php') ?>

<form action="" method="post">
    <input type="text" name="search_name" id="search_name" placeholder="Search Your Name" required>
    <input type="submit" name="search" value="search">
</form>

<?php
    // Establish a database connection
    $connection = mysqli_connect('localhost', 'root', '', 'users');
    
    // Check if the connection was successful
    if (!$connection) {
        die("DB Not Connected: " . mysqli_connect_error());
    }

    if (isset($_REQUEST['search'])) {
        $search = $_REQUEST['search_name'];

    // Query to fetch all user information from the database
    $query = "SELECT * FROM user_info WHERE username LIKE '%$search%'";
    $result = mysqli_query($connection, $query);

    // Count the number of records returned
    $count = mysqli_num_rows($result);

    // Check if there are any records
    if ($count > 0) {

        // Display a success message if data was updated or deleted
        if (isset($_REQUEST['updated'])) {
            echo "<p style='color: green;'>Data Updated Successfully.</p>";
        } else if (isset($_REQUEST['deleted'])) {
            echo "<p style='color: green;'>Data Deleted Successfully.</p>";
        }
?>

    <!-- Display the data in a table -->
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>ID</th>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ACTION</th>
            </tr>
        </thead>
<?php
    $serial = 0;
    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $serial++;
        $id = htmlspecialchars($row['id']);
        $image = htmlspecialchars($row['image']);
        $username = htmlspecialchars($row['username']);
        $email = htmlspecialchars($row['email']);
        $password = htmlspecialchars($row['password']);
?>
    <tbody>
        <tr>
            <td><?php echo $serial; ?></td>
            <td><?php echo $id; ?></td>
            <td><img style="width: 50px" src="uploads/<?php echo $image; ?>" alt="<?php echo $username; ?>'s profile picture" /></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $password; ?></td>
            <td><a href="edit.php?id=<?php echo $id; ?>">Edit</a> || <a onclick="return confirm('Are You Sure Want to Delete?')" href="delete.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>">Delete</a></td>
        </tr>
    </tbody>
<?php
    }
?>
    </table>
<?php
    } else {
        // Display a message if no records were found
        echo "<p style='color: red;'>You don't have any data in your database.</p>";
    }

}
?>

<?php require('includes/footer.php') ?>