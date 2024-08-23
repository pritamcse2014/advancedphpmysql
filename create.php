<?php require('includes/header.php') ?>

<?php
    if (isset($_POST['submit'])) {
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = $_POST['gender'];
        $country = $_POST['country'];

        $image = $_FILES['upload'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];

        if ($username && $email && $password && $image && $gender && $country) {
            if (!empty($image_name)) {
                $location = "uploads/";
                if (move_uploaded_file($image_tmp_name, $location.$image_name)) {
                    // Continue processing if file upload succeeds
                } else {
                    echo "Failed to upload file.";
                    exit();
                }
            } else {
                echo "Your File is Empty.";
                exit();
            }

            $connection = mysqli_connect('localhost', 'root', '', 'users');

            if (!$connection) {
                die("DB Connection Failed: " . mysqli_connect_error());
            }

            $query = "INSERT INTO user_info (image, username, email, password, gender, country) VALUES ('$image_name', '$username', '$email', '$password', '$gender', '$country')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                header("Location: create.php");
                exit();
            } else {
                die("Data Insertion Failed: " . mysqli_error($connection));
            }
        } else {
            echo "Please fill in all fields.";
        }
    }
?>

<form action="create.php" method="post" enctype="multipart/form-data">
    <input type="text" name="username" id="username" placeholder="Enter Your Username" required>
    <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
    <input type="password" name="password" id="password" placeholder="Enter Your Password" required>
    <input type="radio" name="gender" id="gender" value="Male">Male
    <input type="radio" name="gender" id="gender" value="Female">Female
    <select name="country" id="country">
        <option value="">Select Your Country</option>
        <option value="China">China</option>
        <option value="India">India</option>
        <option value="Japan">Japan</option>
    </select>
    <input type="file" name="upload" id="upload" value="upload" required>
    <input type="submit" name="submit">
</form>

<?php require('includes/footer.php') ?>