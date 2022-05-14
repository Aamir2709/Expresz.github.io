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
if(isset($_POST['online_checkout_button']))
{
$userId=$_SESSION['uid'];
$userName=$_SESSION['username'];
$totalPrice=$_POST['atprice'];
$products=array();
$pquantity=array();
$index=0;
foreach($_SESSION['cart'] as $key =>$value)
{
$products[$index]=$value['product_id'];
$pquantity[$index]=$value['quantity'];
$index=$index+1;
}
$arrlength = count($products);
date_default_timezone_set('Asia/Calcutta'); 
$currentDateTime=date("Y-m-d H:i:s");
$status="Completed";
$insert = $conn->query("INSERT into customer_order (user_id,username,total_price,date_time,order_status) VALUES ('$userId','$userName','$totalPrice','$currentDateTime','$status')");
$odate=$currentDateTime;
$query="SELECT * FROM customer_order WHERE date_time='$odate'";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
for($i = 0; $i < $arrlength; $i++) 
{
$orderId=$row['order_id'];
$product=$products[$i];
$qty=$pquantity[$i];
$userId=$row['user_id'];
$userName=$row['username'];
$currentDateTime=$row['date_time'];
$insert = $conn->query("INSERT into products_ordered (order_id,product_id,user_id,quantity,username,date_time) VALUES ('$orderId','$product','$userId','$qty','$userName','$currentDateTime')");
$update = $conn->query("UPDATE items SET pquantity=pquantity-'$qty' WHERE product_id='$product'");
}
}

if($_GET['action']=='checkout')
{
foreach($_SESSION['cart'] as $key =>$value)
{
unset($_SESSION['cart'][$key]);
echo "<script>alert('Order is Submitted!');</script>";
echo "<script>window.location='shopping_cart.php'</script>";
}
}
header("location: invoice.php?odate=$currentDateTime");
}
else if(isset($_POST['offline_checkout_button']))
{
$userId=$_SESSION['uid'];
$userName=$_SESSION['username'];
$totalPrice=$_POST['atprice'];
$products=array();
$pquantity=array();
$index=0;
foreach($_SESSION['cart'] as $key =>$value)
{
$products[$index]=$value['product_id'];
$pquantity[$index]=$value['quantity'];
$index=$index+1;
}
$arrlength = count($products);
date_default_timezone_set('Asia/Calcutta'); 
$currentDateTime=date("Y-m-d H:i:s");
$status="Pending";
$insert = $conn->query("INSERT into customer_order (user_id,username,total_price,date_time,order_status) VALUES ('$userId','$userName','$totalPrice','$currentDateTime','$status')");
$odate=$currentDateTime;
$query="SELECT * FROM customer_order WHERE date_time='$odate'";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
for($i = 0; $i < $arrlength; $i++) 
{
$orderId=$row['order_id'];
$product=$products[$i];
$qty=$pquantity[$i];
$userId=$row['user_id'];
$userName=$row['username'];
$currentDateTime=$row['date_time'];
$insert = $conn->query("INSERT into products_ordered (order_id,product_id,user_id,quantity,username,date_time) VALUES ('$orderId','$product','$userId','$qty','$userName','$currentDateTime')");
$update = $conn->query("UPDATE items SET pquantity=pquantity-'$qty' WHERE product_id='$product'");
}
}

if($_GET['action']=='checkout')
{
foreach($_SESSION['cart'] as $key =>$value)
{
unset($_SESSION['cart'][$key]);
echo "<script>alert('Order is Submitted!');</script>";
echo "<script>window.location='shopping_cart.php'</script>";
}
}
$username = $_SESSION['username'];
$to_email = "aamirbaugwala@gmail.com";
$subject = 'Regarding Appointment';
$body = "Hello $username Your products has been successfully ordered
 Thank you for choosing us :)" ;
$headers = "From: expresz1212@gmail.com\r\n";

if(mail($to_email, $subject, $body, $headers)){
  $mail=true;
}
header("location: invoice.php?odate=$currentDateTime");
}
?>
<?php
if(isset($_POST['remove']))
{
if($_GET['action']=='remove')
{
foreach($_SESSION['cart'] as $key =>$value)
{
if($value['product_id']==$_GET['id'])
{
$_SESSION['cart_pcount']=$_SESSION['cart_pcount']-1;
unset($_SESSION['cart'][$key]);
echo "<script>alert('Product has been Deleted successfully from the Cart!');</script>";
echo "<script>window.location='shopping_cart.php'</script>";
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
    <title>Shopping Cart</title>

<style type="text/css">
.shopping-cart
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

.cart_button
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
<button class="w3-btn w3-black cart_button" style="background-color: white;">            
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
<div class="row px-5" style="border-top: 3px solid green;">
<div class="col-md-7">
<div class="shopping-cart">
<h1 style="font-weight: 900; color: black;">My <span style="color: green;">Cart</span></h1>
<hr style="border: 3px solid green; border-radius: 10px;">

<?php
if(isset($_SESSION['cart']))
{
$query="SELECT * FROM items";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
foreach($_SESSION['cart'] as $key =>$value)
{
if($row['product_id']==$value['product_id'])
{
?>
<form action="shopping_cart.php?action=remove&id=<?php echo($row['product_id']) ?>" method="post" class="cart-items">
<div class="border rounded">
<div class="row bg-white">
<div class="col-md-3" style="border: 1px solid green;">

<img src="images/<?php echo($row['pImage_path']); ?>" alt="image" class="img-fluid img-thumbnail mx-auto d-block" style="width: 150px; height: 180px;">

</div>
<div class="col-md-6" style="border-top: 1px solid green; border-bottom: 1px solid green;">
<h2 class="pt-2"><b><?php echo($row['pname']); ?></b></h2>
<h4 class="text-secondary"><?php echo($row['pbrand']); ?></h4>
<h3 class="text-primary">Availability : <?php echo($row['pquantity']); ?></h3>
<h2 class="pt-2"> <div class="price"><p style="font-size: 20px; font-weight: 700;">Price : &#8377 <?php echo($row['dprice']); ?><span> &#8377 <?php echo($row['sprice']); ?> </span></p></div></h5>

<button type="button" class="btn btn-primary" style="width: 100px; height: 34px; font-size: 16px;"><a href="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" style="color: white;">View</a></button>
<button type="submit" class="btn btn-danger mx-2" name="remove" style="width: 100px; height: 34px; font-size: 16px;">Remove</button>
</div>
<div class="col-md-3" style="border-top: 1px solid green; border-bottom: 1px solid green; border-right: 1px solid green;">
<div>
</form>
<form action="shopping_cart.php?action=checkout" method="post">
<div class="quantity">
	<button type="button"  id="minus_button" class="btn btn-success btn-minus" onclick="minusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-minus"></i></b></button>
	<input type="number" name="qty" id="quantity<?php echo($row['product_id']); ?>" value="<?php echo($value['quantity']); ?>" style="text-align: center; font-size: 16px; width: 50px; height: 30px; padding: 0px 0px 0px 12px; margin: 70px 0px 0px 0px; border: 2px solid green;" readonly>
	<input type="hidden" name="price" id="price<?php echo($row['product_id']); ?>" value="<?php echo($row['dprice']); ?>">
	<input type="hidden" name="ptprice" id="ptprice<?php echo($row['product_id']); ?>" value="<?php echo($row['dprice']); ?>">
	<input type="hidden" name="atprice" id="atprice<?php echo($row['product_id']); ?>">
	<button type="button"  id="plus_button" class="btn btn-success btn-plus"  onclick="plusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-plus"></i></b></button>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
document.getElementById("quantity<?php echo($row['product_id']);?>").max=<?php echo($row['pquantity']);?>;
</script>

<script type="text/javascript">
var quantity=document.getElementById("quantity<?php echo($row['product_id']);?>").value;
var price=document.getElementById("price<?php echo($row['product_id']);?>").value;
document.getElementById("ptprice<?php echo($row['product_id']);?>").value=quantity*price;
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
$products=array();
$index=0;
foreach($_SESSION['cart'] as $key =>$value)
{
$products[$index]=$value['product_id'];
$index=$index+1;
}
$arrlength = count($products);
if(sizeof($_SESSION['cart']) == 0)
{
$_SESSION['cart_pcount']=0;
echo("Cart is Empty!");
$cart_empty=1;
}
else
{
$cart_empty=0;
}
}
else
{
$_SESSION['cart_pcount']=0;
echo("Cart is Empty!");
$cart_empty=1;
}
?>


<script type="text/javascript">
var all_total_price=0;
var products = <?php echo json_encode($products); ?>;
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
all_total_price=all_total_price+parseInt(document.getElementById("ptprice"+products[i]).value);
}
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
document.getElementById("atprice"+products[i]).value=all_total_price;
}
</script>

<script type="text/javascript">
function minusButton(pid)
{
var quantity=document.getElementById("quantity"+pid).value;
var price=document.getElementById("price"+pid).value;
if(quantity>1)
{
quantity=quantity-1;
var per_total_price=quantity*price;
document.getElementById("ptprice"+pid).value=per_total_price;
var all_total_price=0;
var products = <?php echo json_encode($products); ?>;
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
all_total_price=all_total_price+parseInt(document.getElementById("ptprice"+products[i]).value);
}
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
document.getElementById("atprice"+products[i]).value=all_total_price;
}
var card_count=parseInt(document.getElementById('cart_card_count').innerHTML);
document.getElementById('cart_card_count').innerHTML=card_count-1;
document.getElementById('product_count').innerHTML=document.getElementById('cart_card_count').innerHTML;
document.getElementById('total_payment').innerHTML=all_total_price;
document.getElementById('checkout_payment').innerHTML=all_total_price;
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
var price=document.getElementById("price"+pid).value;
if(quantity!=document.getElementById("quantity"+pid).max)
{
quantity=parseInt(quantity)+1;
document.getElementById("quantity"+pid).value=quantity;
var per_total_price=quantity*price;
document.getElementById("ptprice"+pid).value=per_total_price;
var all_total_price=0;
var products = <?php echo json_encode($products); ?>;
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
all_total_price=all_total_price+parseInt(document.getElementById("ptprice"+products[i]).value);
}
for(let i=0;i<(<?php echo($arrlength); ?>);i++)
{
document.getElementById("atprice"+products[i]).value=all_total_price;
}
var card_count=parseInt(document.getElementById('cart_card_count').innerHTML);
document.getElementById('cart_card_count').innerHTML=card_count+1;
document.getElementById('product_count').innerHTML=document.getElementById('cart_card_count').innerHTML;
document.getElementById('total_payment').innerHTML=all_total_price;
document.getElementById('checkout_payment').innerHTML=all_total_price;
}
}
</script>

</div>
</div>

<div class="col-md-4 offset-md-1 mt-5 bg-white h-26"  style="border: 1px solid green; margin-bottom: 20px;" >
<div class="pt-4">
<h1 style="font-weight: 900; color: black;">Price <span style="color: green;">Details</span></h1>
<hr>
<div class="row price-details">
<div class="col-md-6">

<h3 style='font-weight: 600;'>Price (<label id="product_count">0</label> items)</h3>

<script type="text/javascript">
document.getElementById('product_count').innerHTML=document.getElementById('cart_card_count').innerHTML;
</script>

<h3 style='font-weight: 600;'>Delivery Charges</h3>
<hr>
<h2 style='font-weight: 900;'>Amount Payable</h2>
</div>
<div class="col-md-6">
<h3 id="total_payment" style="color: blue;">0</h3>
<h3 class="text-success">FREE</h3>
<hr>
<h2 id="checkout_payment" style="font-weight: 900; color: blue;">0</h2>

<script type="text/javascript">
document.getElementById('total_payment').innerHTML=all_total_price;
document.getElementById('checkout_payment').innerHTML=all_total_price;
</script>

</div>
</div>
<hr>
<div class="col-md-12 text-center">
<center>
<button type="submit" id="online_checkout_button" name="online_checkout_button" class="btn btn-success" style="width: 400px; height: 40px; margin-bottom: 5px; font-size: 20px;" disabled><b>Pay Online</i></b></button>
<button type="submit" id="offline_checkout_button" name="offline_checkout_button" class="btn btn-success" style="width: 400px; height: 40px; margin-bottom: 22px; font-size: 20px;" disabled><b>Pay Offline</i></b></button>
</form>
</center>
</div>
</div>
</div>
</div>
</div>


<?php
if(isset($_SESSION['username']) && isset($_SESSION['uid']) && $cart_empty==0)
{
?>
<script type="text/javascript">
document.getElementById("online_checkout_button").disabled=false;
document.getElementById("offline_checkout_button").disabled=false;
</script>
<?php
}
?>

<?php
if((!(isset($_SESSION['username']) && isset($_SESSION['uid']))) && $cart_empty==1)
{
?>
<script type="text/javascript">
document.getElementById("online_checkout_button").disabled=true;
document.getElementById("offline_checkout_button").disabled=true;
</script>
<?php
}
?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>