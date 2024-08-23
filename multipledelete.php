<?php require('includes/header.php') ?>

<?php
    // Establish a database connection
    $connection = mysqli_connect('localhost', 'root', '', 'users');
    
    // Check if the connection was successful
    if (!$connection) {
        die("DB Not Connected: " . mysqli_connect_error());
    }

    // Handle multiple deletion if form is submitted
    if (isset($_REQUEST['delete_multiple_data'])) {
        if (!empty($_REQUEST['check_data'])) {
            $check = $_REQUEST['check_data'];
            $all = implode(',', array_map('intval', $check)); // Sanitize input

            $query = "DELETE FROM user_info WHERE id IN ($all)";
            $delete_result = mysqli_query($connection, $query);

            if ($delete_result) {
                echo "<p style='color: green;'>Data Deleted Successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error deleting data: " . mysqli_error($connection) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>No records selected for deletion.</p>";
        }
    }

    // Query to fetch all user information from the database
    $query = "SELECT * FROM user_info";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }

    // Count the number of records returned
    $count = mysqli_num_rows($result);

    // Check if there are any records
    if ($count > 0) {

        // Display a success message if data was updated
        if (isset($_REQUEST['updated'])) {
            echo "<p style='color: green;'>Data Updated Successfully.</p>";
        }

?>

    <!-- Display the data in a table -->
<form action="" method="post">
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
                <th><input type="submit" name="delete_multiple_data" value="Multiple Delete"></th>
            </tr>
        </thead>
<?php
    $serial = 0;
    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $serial++;
        $id = $row['id'];
        $image = $row['image'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
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
            <td><center><input type="checkbox" name="check_data[]" value="<?php echo $id; ?>"></center></td>
        </tr>
    </tbody>
<?php
    }
?>
    </table>
</form>
<?php
    } else {
        // Display a message if no records were found
        echo "<p style='color: red;'>You don't have any data in your database.</p>";
    }
?>


<?php require('includes/footer.php') ?>