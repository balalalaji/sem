<?php
include('../connect/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    //to check if repeat select * from data from dbs
    $select_query="Select * from `category` where category_title= '$category_title'";
    $result_select=mysqli_query($conn,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){ //count more than one to repeat hora he
        echo "<script>alert('Category already exists!')</script>";
    }else{

    $insert_query="insert into `category` (category_title) values ('$category_title')"; //ADD CATEGORY
    $result=mysqli_query($conn,$insert_query);
    if($result){
        echo "<script>alert('Category added!')</script>";
    }
  }
}
?>
<h2 class="text-center">Insert Category</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
    <span class="input-group-text bg-primary" id="basic-addon1">
    <i class="fa-solid fa-reciept"></i>
</span>
<input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Username" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2">
<input type="submit" class="bg-primary p-2" name="insert_cat" value="Insert categories" aria-label="Username" aria-describedby="basic-addon1">
</div>
</form>