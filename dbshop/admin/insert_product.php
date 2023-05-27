<?php
include('../connect/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_keyword=$_POST['product_key'];
    $product_categories=$_POST['product_categories'];
    $product_price=$_POST['product_price'];
    $product_img=$_FILES['product_img']['name'];
    $status=true;
    $product_tmpimg=$_FILES['product_img']['tmp_name'];
    if($product_title==' ' or  $product_desc==' ' or  $product_keyword==' ' or  $product_img==' ' or  $product_categories==' ' or $product_price==' '){
        echo "<script>alert('Fill All Fields')</script>";
        exit();
    }else{
        move_uploaded_file($product_tmpimg,"./product_image/$product_img" );
        $insert_products="INSERT INTO `product` (product_title, product_desc, product_key, category_id, product_img, product_price, date, status)
        VALUES ('$product_title', '$product_desc', '$product_keyword', '$product_categories', '$product_img', '$product_price', NOW(), '$status')"; $result_query=mysqli_query($conn,$insert_products);
        if($result_query){
            echo "<script>alert('Product Inserted')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="U    TF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center">Insert Products</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required="required">
                <label for="product_desc" class="form-label">Product Description</label>
                <input type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Enter Product Description" autocomplete="off" required="required">
                <label for="product_key" class="form-label">Product Keyword</label>
                <input type="text" name="product_key" id="product_key" class="form-control" placeholder="Enter Product Keyword" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 m-auto">
    <select name="product_categories" id="product_categories" class="form-select">
        <option value="">Select a Category </option>
        <?php
        $select_query="SELECT * FROM `category`";
        $result_query=mysqli_query($conn,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $category_title=$row['category_title'];
            $category_id=$row['category_id'];
            echo "<option value='$category_id'>$category_title</option>";
        }
        ?>
    </select>
</div>

            <label for="product_img" class="form-label">Product Image</label>
            <input type="file" name="product_img" id="product_img" class="form-control" placeholder="Upload Product Image"  required="required" >
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off" required="required"><br><br><br>
            <input type="submit" name="insert_product" class="btn btn-primary" value="Insert Product">
</form>
    </div>
    
</body>
</html>