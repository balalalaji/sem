
<?php
include('../connect/connect.php') ;
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-x1-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <!-- username field -->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                </div>
                <div class="form-outline mb-4">
                    <!-- pasword field -->
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>

<div class="text-center">
<input type="submit"  value="Login " name="login" class="bg-primary text light">
</div>
            </form>
        </div>
<p class="small fw-bold mt-2 pt-1 mb-0">Dont have a account?? <a href="user_reg.php" >Register</a> </p>
    </div>
</div>

 </body>
 
 </html>
<?php
    
    if(isset($_POST['login'])){
    $user_username=$_POST['user_username']; 
    $user_password=$_POST['user_password'];
    $select_query="Select * from `user_table` where  username= '$user_username '"; 
    $result=mysqli_query($conn, $select_query);
    $row_count=mysqli_num_rows($result); $row_data=mysqli_fetch_assoc($result);
    if ($row_count>0){
    if (password_verify($user_password, $row_data['user_password'])){
        $id = $row_data['user_id'];
        $_SESSION['username']=$user_username;
        $_SESSION['id']=$id;
        echo "<script> alert('Login Sucessful')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";

    }else{  echo "<script> alert('Invalid Credentials')</script>";
    }
    }else{
  
    echo "<script> alert('Invalid Credentials')</script>";
    }
}
?>