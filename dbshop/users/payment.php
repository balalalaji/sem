 <!DOCTYPE html>
 <html lang="en">
 <head>
<body>
<?php
/* $get_user="Select * from `user_table` ";
 $result=mysqli_query($conn, $get_user);
$run_query=mysqli_fetch_array($result);
print_r($run_query);
$user_id=$run_query['user_id']; */

?>
<div class="container">
        <div style="text-align:center;">
            <a href="order.php?user_id=<?php echo $_SESSION['id']; ?>">
                <h2>Click to Pay and Place order</h2>
            </a>
        </div>
</div>
</body> 
</html>
