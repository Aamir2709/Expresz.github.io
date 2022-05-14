<?php
session_start();
?>
<?php 
// Database Connection
$servername = "localhost";
$username = "root"; //default user name is root
$password = ""; //default password is blank
$conn = new mysqli($servername, $username, $password,'Stationary');
if($conn->connect_error)
{
die("Connection Failed : ".$conn->connect_error);
}
?>

<?php
if(isset($_POST["add_product"]))
{
if(isset($_SESSION['cart']))
{
$item_array_id=array_column($_SESSION['cart'],"product_id");
if(in_array($_POST['product_id'],$item_array_id))
{
echo "<script>alert('Product is already added in the Cart!')</script>";
echo "<script>window.location='all_product.php'</script>";
}
else
{
$count=count($_SESSION['cart']);
$_SESSION['cart_pcount']=$_SESSION['cart_pcount']+1;
$item_array=array(
'product_id' => $_POST['product_id'],
'quantity' => $_POST['qty']
);
$_SESSION['cart'][$count]=$item_array;
}
}
else
{
$item_array=array(
'product_id' => $_POST['product_id'],
'quantity' => $_POST['qty']
);
$_SESSION['cart'][0]=$item_array;
$_SESSION['cart_pcount']=1;
print_r($_SESSION['cart']);
}
}
?>


<?php
if(isset($_POST['remove']))
{
if($_GET['action']=='remove')
{
foreach($_SESSION['wishlist'] as $key =>$value)
{
if($value['product_id']==$_GET['id'])
{
unset($_SESSION['wishlist'][$key]);
echo "<script>alert('Product has been Deleted successfully from the wishlist!');</script>";
echo "<script>window.location='shopping_wishlist.php'</script>";
}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="stationary_css.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>
    <title>Shopping Wishlist</title>

<style type="text/css">
.shopping-wishlist
{
padding: 20px;
}

.price-details h6
{
padding: 3% 2%;
}
a:hover
{
text-decoration: none;
}

.wishlist_button
{
background-color: honeydew; 
border: 2px solid darkgreen;
border-radius: 10px;
}


.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: 150%;
  left: 50%;
  margin-left: -60px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent black transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.price  span
{
  font-size: 14px;
  color:#999;
  text-decoration: line-through;
}
</style>

</head>
<body class="bg-light">
    <!-- header section starts  -->

<header>

    <div class="header-1">

        <a href="#" class="logo"><i class="fa-solid fa-pen-ruler"></i>Expresz</a>

        <form action="" class="search-box-container">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>

    </div>

    <div class="header-2" style="padding: 20px 20px 20px 20px;">

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="index.php"><i class="fa-solid fa-house"></i></a>
            <a class="current_button" href="all_product.php">All</a>
<?php
$query="SELECT * FROM categories";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>
<a class="category<?php echo($row['id']); ?>" href="<?php echo($row['name']); ?>.php" ><?php echo($row['name']); ?></a>
<?php
}
?>

        </nav>

        <div class="icons">
<button class="w3-btn w3-black"  style="background-color: white;">            
<a href="shopping_cart.php" class="fas fa-shopping-cart"></a>
<?php 
if(isset($_SESSION['cart_pcount']))
{
$count=$_SESSION['cart_pcount'];
echo "<label class=\"card_count\" id=\"cart_card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px;\">$count</label>";
}
else
{
echo "<label class=\"card_count\" id=\"cart_card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px;\">0</label>";
}
?>

</button>

<button class="w3-btn w3-black" style="background-color: white;">            
<a href="shopping_wishlist.php" class="fas fa-heart" style="padding: 0px 0px 0px 5px;"></a>
<?php 
if(isset($_SESSION['wishlist']))
{
$count=count($_SESSION['wishlist']);
echo "<label class=\"card_count\"  id=\"wishlist_card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px; margin-right: 5px;\">$count</label>";
}
else
{
echo "<label class=\"card_count\"  id=\"wishlist_card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px; margin-right: 5px;\">0</label>";
}
?>

</button>

<?php
if(isset($_SESSION['username']))
{
?>

            <a href="logout.php" class="fas fa-user-circle" style="padding: 0px; border: 3px solid red; background-color: darkgreen; color: honeydew;"></a>

            <label for="login_username" id="login_username"><b style="font-size: 14px; color: blue;"><?php echo($_SESSION['username']); ?></b></label> 
</div>
<?php
}
else
{
?>
            <a href="login.php" class="fas fa-user-circle"  style="padding: 0px; border: 3px solid darkgreen; background-color: honeydew;"></a>
<?php
}
?>
        </div>

    </div>

</header>

<div class="container-fluid">
<div class="row px-0" style="border-top: 3px solid green;">
<div class="col-md-9 mx-auto" style=" padding: 10px; ">
<div class="shopping-wishlist">
<center>
<h1 style="font-weight: 900; color: black;">My <span style="color: green;">wishlist</span></h1>
<hr style="border: 3px solid green; border-radius: 10px;">
</center>
<?php
$total=0;
if(isset($_SESSION['wishlist']))
{
$product_id=array_column($_SESSION['wishlist'],"product_id");
$query="SELECT * FROM items";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
foreach($product_id as $id)
{
if($row['product_id']==$id)
{
?>
<form action="shopping_wishlist.php?action=remove&id=<?php echo($row['product_id']) ?>" method="post" class="wishlist-items">
<div class="border rounded">
<div class="row bg-white">
<div class="col-md-3" style="border: 1px solid green;">

<img src="images/<?php echo($row['pImage_path']); ?>" alt="image" class="img-fluid img-thumbnail mx-auto d-block" style="width: 200px; height: 200px;">

</div>
<div class="col-md-6" style="border-top: 1px solid green; border-bottom: 1px solid green; padding: 10px 0px 15px 15px;">
<h2 class="pt-2"><b><?php echo($row['pname']); ?></b></h2>
<h4 class="text-secondary"><?php echo($row['pbrand']); ?></h4>
<h3 class="text-primary">Availability : <?php echo($row['pquantity']); ?></h3>
<h2 class="pt-2"> <div class="price"><p style="font-size: 20px; font-weight: 700;">Price : &#8377 <?php echo($row['dprice']); ?><span> &#8377 <?php echo($row['sprice']); ?> </span></p></div></h5>

<button type="submit" class="btn btn-primary" style="width: 100px; height: 40px; font-size: 16px;"><a href="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" style="color: white;">View</a></button>
<button type="submit" class="btn btn-danger mx-2" name="remove" style="width: 100px; height: 40px; font-size: 16px;">Remove</button>
</div>
<div class="col-md-3" style="border-top: 1px solid green; border-bottom: 1px solid green; border-right: 1px solid green;">
<div>
<div class="quantity" style="margin: 0px 10px 22px 60px;">
	<button type="button"  id="minus_button" class="btn btn-success btn-minus" onclick="minusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-minus"></i></b></button>
	<input type="number" name="qty" id="quantity<?php echo($row['product_id']); ?>" value="1" style="text-align: center; font-size: 16px; width: 50px; height: 30px; padding: 0px 0px 0px 12px; margin: 70px 0px 0px 0px; border: 2px solid green;" readonly>
	<button type="button"  id="plus_button" class="btn btn-success btn-plus"  onclick="plusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-plus"></i></b></button>
</div>
<form action="all_product.php" method="post">
	<button type="submit" style="width: 200px; height: 40px; font-size: 20px; background-color: green; margin: 20px; color: white;" name="add_product" id="add_to_cart">Add To Cart</button>
	<input type="hidden" name="product_id" value="<?php echo($row['product_id']); ?>">
</form>
</div>
</div>
</div>
</div>
</form>
<?php 
$total=$total+(int)$row['dprice'];
?>
<script type="text/javascript">
document.getElementById("quantity<?php echo($row['product_id']);?>").max=<?php echo($row['pquantity']);?>;
</script>


<?php 
if($row['pquantity']<=0) 
{
?>
<script type="text/javascript">
document.getElementById("quantity<?php echo($row['product_id']);?>").value=0;
document.getElementById("quantity<?php echo($row['product_id']);?>").readOnly = true;
document.getElementById("minus_button").disabled = true;
document.getElementById("plus_button").disabled = true;
document.getElementById("add_to_cart").disabled = true;
</script>
<?php
}
}
}
}
}
if(!isset($_SESSION['wishlist'][0]))
{
echo("Wishlist is Empty!");
}
?>


<script type="text/javascript">
function minusButton(pid)
{
var quantity=document.getElementById("quantity"+pid).value;
if(quantity>1)
{
quantity=quantity-1;
}
else
{
quantity=1;
}
document.getElementById("quantity"+pid).value=quantity;
}

function plusButton(pid)
{
var quantity=document.getElementById("quantity"+pid).value;
if(quantity!=document.getElementById("quantity"+pid).max)
{
quantity=parseInt(quantity)+1;
document.getElementById("quantity"+pid).value=quantity;
}
}
</script>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>