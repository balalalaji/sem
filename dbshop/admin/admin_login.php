<?php
include('../connect/connect.php') ;
 ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">Admin Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-x1-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <!-- username field -->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                </div>
                <div class="form-outline mb-4">

                    <!-- username field -->
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>
                <div class="text-center">
<input type="submit"  value="Login " name="login" class="bg-primary text light">
</div>
            </form>
        </div>
    </div>

</div>
 </body> 
 </html>
 <?php
if (isset($_POST['submit'])) {
    $username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT); // hash the password

    // check if username already exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($conn, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        echo "<script> alert('Username already exists')</script>";
    } else {
        // insert user details into table
        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_address, user_mobile) VALUES ('$username', '$user_email', '$user_password', '$user_address', '$user_mobile')";
        $sql_execute = mysqli_query($conn, $insert_query);

        if ($sql_execute) {
            echo "<script> alert('Data inserted successfully') </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
}
?>





