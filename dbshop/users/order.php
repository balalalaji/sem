<?php
include('../connect/connect.php');
session_start();
if (isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
// getting total items and total price of all items 
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details`";
$result_cart_price = mysqli_query($conn, $cart_query_price);
$invoice_number = mt_rand();
$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM `product` WHERE product_id=$product_id";
    $run_price = mysqli_query($conn, $select_product);
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}

$get_cart = "SELECT * FROM `cart_details`"; 
$run_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart); 
$quantity = $get_item_quantity['quantity'];

if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;
}

$insert_orders = "INSERT INTO `orders` (user_id, amount, invoice, total_products, order_date) 
                  VALUES ($user_id, $subtotal, '$invoice_number', $count_products, NOW())";
$result_query = mysqli_query($conn, $insert_orders);

if ($result_query) {
    echo "<script>alert('Orders are submitted successfully')</script>"; 
    echo "<script>window.open('profile.php', '_self')</script>";
}
}else{
    echo "not setl";
}
?>
