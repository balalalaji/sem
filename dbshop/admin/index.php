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
    <div class="container-fluid">
        <!-- nav1 -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light my-2">
            <div class="container-fluid">
                <h1>DBShop</h1>
                <nav class="navbar bar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome admin,</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    <!-- HEADER -->
<div class="bg-light my-2">
    <h3 class="text-center">Admin Panel</h3>
</div>
<!-- body -->
<div class="container">
    <div class="col-md-12 bg-primary align-items-center">
        <div class="button text-center">
            <button ><a href="insert_product.php" class="btn btn-dark">Insert Product</a></button>
            <button ><a href="index.php?insert_category" class="btn btn-dark">Insert Category</a></button>
            <button ><a href="index.php?view_order" class="btn btn-dark">All Order</a></button>
            <button ><a href="index.php?view_prod" class="btn btn-dark">View Products</a></button>
            <button ><a href="index.php?list_users" class="btn btn-dark">List Users</a></button>
           <!-- <button ><a href="" class="btn btn-dark">LogOut</a></button> -->
        </div>
    </div>
</div>
    </div>
<!-- container -->
<div class="container my-5">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_category.php');
    }

    if(isset($_GET['view_prod'])){
        include('view_prod.php');
    }

    if(isset($_GET['view_order'])){
        include('view_order.php');
    }

    if(isset($_GET['list_users'])){
        include('list_users.php');
    }
    ?>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
  </html>