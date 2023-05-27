 <?php
 include('./connect/connect.php');
 function getproducts(){
    if(!isset($_GET['category'])){
        global $conn;
        $select_query = "SELECT * FROM `product` ";
        $result_query = mysqli_query($conn, $select_query);
        while ($row_data = mysqli_fetch_assoc($result_query)) {
            $product_id = $row_data['product_id'];
            $product_title = $row_data['product_title'];
            $product_desc = $row_data['product_desc'];
            $product_img = $row_data['product_img'];
            $product_price = $row_data['product_price'];
            $category_id = $row_data['category_id'];
            echo '<div class="col-md-4 mb-2">
                    <div class="card">
                      <img src="admin/product_image/'.$product_img.'" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">'.$product_title.'</h5>
                        <p class="card-text">'.$product_desc.'</p>
                        <p class="card-text">Price: '.$product_price.'/-</p>
                        <a href="index.php?add_to_cart='.$product_id.' " class="btn btn-primary">Add to Cart</a>
                      </div>
                    </div>
                  </div>
            ';
        }}
 }

function cart(){
    if(isset($_GET['add_to_cart'])){
            global $conn;
            $get_product_id=$_GET['add_to_cart'];
            $select_query = "SELECT * FROM `cart_details` WHERE product_id=$get_product_id";
            $result_query = mysqli_query($conn, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if ($num_of_rows>0){//number of rows
            echo "<script>alert('already in cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            }else{
                $insert_query="insert into `cart_details` (product_id,quantity) values ($get_product_id,0)";
                $result_query = mysqli_query($conn, $insert_query);
                echo"<script>alert('Added in cart')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } 
    }
}

function cart_item() {
    global $conn;    
    if (isset($_GET['add_to_cart'])) {
        $select_query = "SELECT * FROM cart_details";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        $select_query = "SELECT * FROM cart_details";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }    
    echo $count_cart_items;
}

function nav_cart_price() {
    global $conn;
    $total_price = 0;
    $cart_query = "SELECT * FROM cart_details";
    $result = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM product WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']); 
            $product_values = array_sum($product_price); 
            $total_price += $product_values; 
        }        
    }
    echo $total_price;
}



 function getuniquecategory(){
    if(isset($_GET['category'])){
        global $conn;
        $category_id=$_GET['category'];
        $select_query = "SELECT * FROM `product`  where category_id=$category_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if ($num_of_rows==0){//checks if a tacle has zero rows
        echo "<h2>No stock for this category</h2>";
        } 
        while ($row_data = mysqli_fetch_assoc($result_query)) {
            $product_id = $row_data['product_id'];
            $product_title = $row_data['product_title'];
            $product_desc = $row_data['product_desc'];
            $product_img = $row_data['product_img'];
            $product_price = $row_data['product_price'];
            $category_id = $row_data['category_id'];
            echo '<div class="col-md-4 mb-2">
                    <div class="card">
                      <img src="admin/product_image/'.$product_img.'" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">'.$product_title.'</h5>
                        <p class="card-text">'.$product_desc.'</p>
                        <a href="index.php?add_to_cart='.$product_id.' " class="btn btn-primary">Add to Cart</a>
                      </div>
                    </div>
                  </div>
            ';
        }
    }
}
