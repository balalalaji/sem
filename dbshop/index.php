<?php
session_start();
include('connect/connect.php') ;
include('functions/functions.php') ;
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBShop</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
 <body>
    <!--Navbar-->
    <div class="container-fluid p-0" > 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DBShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users/user_login.php">
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-basket-shopping"></i><sup><?php cart_item() ; ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Price:<?php nav_cart_price();?>-</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- second nav -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <ul class="navbar-nav me auto">
    <li class="nav-item">
    <?php
if(!isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a class='nav-link' href='users/profile.php'>Welcome Guest</a>
</li>";
}else{
echo "<li class='nav-item'>
<a class='nav-link' href='users/profile.php'>Welcome ".$_SESSION['username']."</a>
</li>";
}
?>
    </li>

    <?php
if(!isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a class='nav-link' href='users/user_login.php'></a>
</li>";
}else{
echo "<li class='nav-item'>
<a class='nav-link' href='logout.php'>Logout</a>
</li>";
}
?>
 </ul>
</nav>   
<!-- HEADER -->
<div class="bg-light">
    <h3 class="text-center">DBShop</h3>
</div>
<!-- body -->
<div class="row">
  <div class="col-md-10">
    <div class="row">
    <?php
   getproducts();
   cart();
   getuniquecategory();
    ?>

      

    </div>
<!-- row end -->
  </div>
<!-- col end -->
</div>

    <div class="order-md-last col-md-2 bg-secondary align-right pl-0 pr-0 ">
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-light">
                <s href="#" class="nav-link text"><h4>Category</h4></a>
                <?php
                    $select_category="Select * from `category` ";
                    $result_select=mysqli_query($conn,$select_category);
                    while($row_data=mysqli_fetch_assoc($result_select)){
                        $category_title=$row_data['category_title'];
                        $category_id=$row_data['category_id'];
                        echo"<li class='nav-item'> 
                        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                        </li>";
                     }
                    ?>
            </li>   
        </ul>
        </div>

        <style>
  .align-right {
    float: right;
  }
</style>
<!-- Footer
<div class="bg-light text-center p-3 ">
Copyright © 2023 [Your Company Name]. All rights reserved. | Privacy Policy | Terms of Use
</div> -->
    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
 </body>
 
 </html>
