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
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_login.php">
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-basket-shopping"></i><sup></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">-</a>
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
<a class='nav-link' href='users/user_login.php'>Login</a>
</li>";
}else{
echo "<li class='nav-item'>
<a class='nav-link' href='../logout.php'>Logout</a>
</li>";
}
?>
 </ul>
</nav>   

<div class="bg-light my-2">
    <h3 class="text-center">User Panel</h3>
</div>
<?php
$username=$_SESSION['username'];
$get_user="Select * from `user_table` where username='$username'";
$result=mysqli_query($conn, $get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch ['user_id'];
?>
<div class="container">
<table class="table table-bordered mt-5">
    <thead class="bg-primary text-light">
        <tr>
            <th>Sr.no</th>
            <th>Amount</th>
            <th>Total products</th>
            <th>Invoice number</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
$get_order_details="SELECT * FROM `orders` WHERE user_id=$user_id"; 
$result_orders=mysqli_query($conn, $get_order_details);

// Initialize the $number variable before the while loop
$number = 1;

while($row_data=mysqli_fetch_assoc($result_orders)){
    // Move these lines inside the while loop to access $row_data properly
    $order_id=$row_data['order_id'];
    $amount=$row_data['amount'];
    $total_products=$row_data['total_products']; 
    $invoice_number=$row_data['invoice']; // Fix the column name
    $date=$row_data['order_date'];
    
    // Use the $number variable to count the orders
    echo "<tr>
              <td>$number</td>
              <td>$amount</td>
              <td>$total_products</td>
              <td>$invoice_number</td>
              <td>$date</td>
          </tr>";
          
    // Increment the $number variable after each order
    $number++;
}

?>

    </tbody>
  
</table>
</div>
<div class="bg-light text-center p-3  fixed-bottom">
Copyright © 2023 [Your Company Name]. All rights reserved. | Privacy Policy | Terms of Use
</div>
    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
 </body>
 
 </html>
