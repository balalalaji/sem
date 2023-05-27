<?php
$conn=mysqli_connect('localhost','root','','shop');
if(!$conn){
    echo "Connection Unsucessful";
}//else{
//     echo "Connection Unsucessful";
//     // die(mysqli_error($conn));
// }
?>
            

            <!-- DML Querys:
Category table:
CREATE TABLE Category (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_title VARCHAR(255) NOT NULL,
    PRIMARY KEY (category_id)
);
Product table:
CREATE TABLE Product (
    product_id INT(11) NOT NULL AUTO_INCREMENT,
    category_id INT(11) NOT NULL,
    product_title VARCHAR(255) NOT NULL,
    product_desc TEXT NOT NULL,
    product_key VARCHAR(255) NOT NULL,
    product_img VARCHAR(255) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES Category(category_id)
);
Cart_Details table:
CREATE TABLE Cart_Details (
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);
User table:
CREATE TABLE User (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_address TEXT NOT NULL,
    user_mobile VARCHAR(20) NOT NULL,
    PRIMARY KEY (user_id)
);
Order_Details table:
CREATE TABLE Order_Details (
    order_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    invoice VARCHAR(255) NOT NULL,
    total_products INT(11) NOT NULL,
    order_date DATE NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

DDL Querys:
1.Home Page
Query  used to show all category in the side bar:
•	$select_query = "SELECT * FROM `product` ";

Query  used to show all category in the side bar:
•	"Select * from `category` ";

Query  used to filter through catogories:
•	"SELECT * FROM `product`  where category_id=$category_id";

Query  used to see price  of items in nav bar:
•	$cart_query = "SELECT * FROM cart_details";
•	$select_products = "SELECT * FROM product WHERE product_id='$product_id'"

Query  used to insert items into cart:
•	$insert_query="insert into `cart_details` (product_id,quantity) values ($get_product_id,0)";

Query  used to check wether item exists in cart items into cart:
•	$select_query = "SELECT * FROM `cart_details` WHERE product_id=$get_product_id";

2.Cart
Query  used to display items into cart:
•	$select_products = "SELECT * FROM product WHERE product_id='$product_id'";
Query used to update product quantity from the cart:
•	$update_cart_qty = "UPDATE `cart_details` SET quantity='$quantities' ";
Query used to delete products from the cart:
•	$delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";  


3.Payment
Query used to see which user is making the payment:
•	$get_user="Select * from `user_table` ";

Block of Querys used to get total amount of products in the cart:
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

Orders:
Query used to insert cart order in the order table:
$insert_orders = "INSERT INTO `orders` (user_id, amount, invoice, total_products, order_date) VALUES ($user_id, $subtotal, '$invoice_number', $count_products, NOW())";




 -->