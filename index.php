<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){

header('location:login.php');

};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
};


if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    //  $select_product = mysqli_query() or die ('query failed');

    $select_user = mysqli_query($conn, "SELECT * FROM `users_form` WHERE id ='$user_id'")
 
 or die ('query failed');




}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shoping cart</title>
    <link rel="stylesheet" href="./css/style.css">
   
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
   <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"> -->
</head>
<body>

<div class="container">

<div class="user-profile">

<?php

 $select_user = mysqli_query($conn, "SELECT * FROM `users_form` WHERE id ='$user_id'")
 
 or die ('query failed');

 if(mysqli_num_rows($select_user) >  0 ){
    $fetch_user = mysqli_fetch_assoc($select_user);
 };


 
 ?>

 <P> username:<span><?php echo $fetch_user['name'];?></span> </P>

 <P> email:<span><?php echo $fetch_user['email'];?></span> </P>

 <div class="flex">

 <a href="login.php" class="btn">login</a>

 <a href="register.php" class="option-btn">register</a>

 <a href="index.php?logout=<?php echo $user_id;?>"onclick="return confirm('are your sure you want to logout?');"
       class="delete-btn">logout</a>

 </div>

</div>

<div class="products">

<h1 class="heading">latest products</h1>

<div class="box-container">

<?php

$select_product= mysqli_query($conn, "SELECT * FROM `products`")  or die ('query
 failed');

if(mysqli_num_rows($select_product) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?>
        <form method="post"  class="box" action="">
            <img src="./img/<?php echo $fetch_product['image'];?>" alt="">
            <div class="name"><?php echo $fetch_product['image'];?></div>
            <div class="price">$<?php echo $fetch_product['price'];?>/-</div>
            <input type="number" min="1" name="product_quantity" value="1">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image'];?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'];?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'];?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>
        <?php
    };
};


   
 ?>
 


</div>

</div>

</div>


</body>
</html>