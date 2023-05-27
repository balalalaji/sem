<?php
include('../connect/connect.php') ;
session_start();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
 <body>
    <!--Navbar-->

<!-- second nav -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <ul class="navbar-nav me auto">
 </ul>
</nav>   
<!-- HEADER -->
<div class="bg-light">
    <h3 class="text-center">Checkout</h3>
</div>
<!-- body -->
<div class="row">
<?php
if(!isset($_SESSION['username'])){
include('user_login.php');
}else{
    include('payment.php');
}
?>

</div>
<!-- Footer -->
<div class="bg-light text-center p-3 fixed-bottom">
Copyright © 2023. All rights reserved. | Privacy Policy | Terms of Use
</div>
    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
 </body>
 
 </html>
