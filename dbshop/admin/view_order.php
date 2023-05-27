<h3 class="text-center text-success">All orders</h3> 
<div class="container align=center">
<table class="table table-bordered mt-5">
    <thead class="bg-primary text-light">
   
    <?php
    include('../connect/connect.php');
    $get_orders="Select * from `orders`";
    $result=mysqli_query($conn, $get_orders);
    $row_count=mysqli_num_rows($result);
        echo "<tr>
                    <th>Sr.no</th>
                    <th>Invoice number</th>
                    <th>Total products</th>
                    <th>Order Date</th>
                </tr>";
?>
</thead>
<tbody class='bg-secondary text-light'>
<?php
    if($row_count>0){
        $i=1;
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td>".$i."</td>
                    <td>".$row['invoice']."</td>
                    <td>".$row['total_products']."</td>
                    <td>".$row['order_date']."</td>
                  </tr>";
            $i++;
        }
    }else{
        echo "<tr>
                <td colspan='4'>No orders found</td>
              </tr>";
    }
?>
</tbody>
</table>
</div>