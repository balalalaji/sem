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
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
 <body>
    <!--Navbar-->
    <div class="container-fluid p-0" > 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="users/user_login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-basket-shopping"></i><sup><?php cart_item() ; ?></sup></a>
                    </li>
                    <li class="nav-item">
                        
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
<a class='nav-link' >Welcome Guest</a>
</li>";
}else{
echo "<li class='nav-item'>
<a class='nav-link'>Welcome ".$_SESSION['username']."</a>
</li>";
}
?>
    </li>

    <?php
if(!isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a class='nav-link' href='/users/user_login.php'>Login</a>
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
    <h3 class="text-center">Cart</h3>
</div>
<!-- body -->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
            <?php
    global $conn;
    $total_price = 0;
    $cart_query = "SELECT * FROM cart_details";
    $result = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM product WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $price_table = $row_product_price['product_price'];
            $product_title = $row_product_price['product_title'];
            $product_img = $row_product_price['product_img'];
            $product_values = array($product_price); 
            $total_price += $product_price; 
       
?>

                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="img/<?php echo $product_img ?>" width="180px" height="200px"></td>
                    <td><input type="text" name="qty"></td>
                    <?php
                    if (isset($_POST['update_cart'])) {
                        $quantities = $_POST['qty'];
                        $update_cart_qty = "UPDATE `cart_details` SET quantity='$quantities' ";
                        mysqli_query($conn, $update_cart_qty);
                        $total_price = $total_price * $quantities;
                    }
                    ?>

                    <td><?php echo $product_price?></td>
                    <td><input type="checkbox" name="remove[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!-- <button class="bg-primary borderless px-3 py-2 mx-3">Update</button> -->
                        <input type="submit"   value="Update" class="bg-primary borderless px-3 py-2 mx-3 text-light" name="update_cart">
                        <input type="submit"   value="Remove" class="bg-primary borderless px-3 py-2 mx-3 text-light" name="remove_cart">
                    </td>
                </tr>
                <?php
                         }        
                       } ?>
            </tbody>

        </table>
        <div class="d-flex mb-3">
            <h4 pd-4>Total:<?php echo $total_price?></h4>
            <button class="bg-primary borderless px-3 py-2 mx-3"><a href='./users/checkout.php' class='text-light'> Checkout</button>
        </div>
    </div>
</div>
</form>

<?php
function remove_cart_item(){
    global $conn;
    if(isset($_POST['remove_cart'])){
        foreach ($_POST['remove'] as $remove_id){
            echo $remove_id;
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id"; 
            $run_delete = mysqli_query($conn, $delete_query);
            if ($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}

echo $remove_item=remove_cart_item();

?>
<!-- row end -->
  </div>
<!-- col end -->
</div>


<!-- Footer -->
<!-- <div class="bg-light text-center p-3 ">
Copyright © 2023 [Your Company Name]. All rights reserved. | Privacy Policy | Terms of Use
</div> -->
    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
 </body>
 
 </html>
