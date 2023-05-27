<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-primary ">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Description</th>
            <th>Product Key</th>
            <th>Category ID</th>
            <th>Product Price</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        <?php
        include('../connect/connect.php');
        $get_products = "SELECT * FROM `product`";
        $result = mysqli_query($conn, $get_products);
        $row_count = mysqli_num_rows($result);
        if ($row_count > 0) {
            while ($row_data = mysqli_fetch_assoc($result)) {
                $product_id = $row_data['product_id'];
                $product_title = $row_data['product_title'];
                $product_desc = $row_data['product_desc'];
                $product_key = $row_data['product_key'];
                $category_id = $row_data['category_id'];
                $product_price = $row_data['product_price'];
                echo "<tr>
                        <td>$product_id</td>
                        <td>$product_title</td>
                        <td>$product_desc</td>
                        <td>$product_key</td>
                        <td>$category_id</td>
                        <td>$product_price</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No Products found</td></tr>";
        }
        ?>
    </tbody>
</table>
