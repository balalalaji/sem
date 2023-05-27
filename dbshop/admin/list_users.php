<h3 class="text-center text-success">All Users</h3> 
<table class="table table-bordered mt-5">
<thead class="bg-primary">
    <tr>
        <th>Sr.no</th>
        <th>Username</th>
        <th>Email</th>
        <th>Address</th>
        <th>Mobile</th>
    </tr> 
</thead>
<tbody class='bg-secondary text-light'>
    <?php
    // Connect to database
    include('../connect/connect.php');

    // Fetch all users from user_table
    $get_users = "SELECT * FROM `user_table`";
    $result_users = mysqli_query($conn, $get_users);

    // Check if any users exist
    if (mysqli_num_rows($result_users) > 0) {
        $count = 1;
        while ($row_users = mysqli_fetch_assoc($result_users)) {
            $user_id = $row_users['user_id'];
            $username = $row_users['username'];
            $email = $row_users['user_email'];
            $address = $row_users['user_address'];
            $mobile = $row_users['user_mobile'];
            echo "<tr>
                    <td>$count</td>
                    <td>$username</td>
                    <td>$email</td>
                    <td>$address</td>
                    <td>$mobile</td>
                </tr>";
            $count++;
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</tbody>
</table>
