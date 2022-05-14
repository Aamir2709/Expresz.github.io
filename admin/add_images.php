<?php
session_start();
?>
<?php 
// Database conn
$servername = "localhost";
$username = "root"; //default user name is root
$password = ""; //default password is blank
$conn = new mysqli($servername, $username, $password,'Stationary');
if($conn->connect_error)
{
die("conn Failed : ".$conn->connect_error);
}
?>

<?php
if(isset($_POST["add_product_wishlist"]))
{
if(isset($_SESSION['wishlist']))
{
$item_array_id=array_column($_SESSION['wishlist'],"product_id");
if(in_array($_POST['product_id'],$item_array_id))
{
echo "<script>alert('Product is already added in the Wishlist!')</script>";
echo "<script>window.location='all_product.php'</script>";
}
else
{
$count=count($_SESSION['wishlist']);
$item_array=array(
'product_id' => $_POST['product_id']
);
$_SESSION['wishlist'][$count]=$item_array;
}
}
else
{
$item_array=array(
'product_id' => $_POST['product_id']
);
$_SESSION['wishlist'][0]=$item_array;
print_r($_SESSION['wishlist']);
}
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
$item_array=array(
'product_id' => $_POST['product_id']
);
$_SESSION['cart'][$count]=$item_array;
}
}
else
{
$item_array=array(
'product_id' => $_POST['product_id']
);
$_SESSION['cart'][0]=$item_array;
print_r($_SESSION['cart']);
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>

<style type="text/css">

body
{
background-image: linear-gradient(rgba(60,179,113,0.1), rgba(0,0,0,0.4)),url('images/lr.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
background-position: center;
}

.form_heading
{
color: black;
background-color: darkgreen;
border-radius: 12px 12px 0px 0px;
padding: 6px;
}

.form_heading *
{
vertical-align: middle;
}

.form_border
{
padding: 0px;
margin: 0px;
display: inline;
border-radius: 12px;
box-shadow: 2px 2px 20px 0px green;
background-color: rgba(255,255,255,0.8);
text-align: left;
border-top : none;
}

.field_heading
{
width : 170px;
display: inline-block;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-size: 22px;
font-family: fantasy;
margin-left: 6px;
text-align: center;
}

.field
{
width: 535px;
padding: 8px 8px;
margin: 8px 8px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: 900;
font-size: 18px;
}

.field::placeholder
{
color: navy;
font-weight: bold;
}

input:focus
{
background-color: lightgreen;
}

input:focus::placeholder
{
color: transparent;
}

.select_choice
{
width: 72%;
height: 44px;
padding: 4px 4px;
margin: 8px 10px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: bold;
font-size: 18px;
}

.select_choice::placeholder
{
color: navy;
font-weight: bold;
}

.select_choice:focus
{
background-color: lightgreen;
}


.description *
{
vertical-align: middle;
}

#description_heading
{
display: inline-block;
width : 185px;
text-align: center;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-size: 22px;
font-family: fantasy;
}

#description_field
{
margin-right: 20px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-size: 18px;
font-weight: 900;
}

#description_field::placeholder
{
padding-top: 10px;
color: navy;
font-weight: bold;
}

#description_field:focus
{
background-color: lightgreen;
}

#description_field:focus::placeholder
{
color: transparent;
}

#submit_button
{
width: 200px;
letter-spacing: 3px;
text-transform: uppercase;
color: honeydew;
background-image: linear-gradient(90deg,green,greenyellow);
border-style: solid;
border-width: 3px;
border-radius: 15px 0px 0px 15px;
border-color: navy;
box-shadow: inset 0 0 0 0 azure;
transition: ease-out 0.5s;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#submit_button:hover
{
color: darkolivegreen;
cursor: pointer;
border-width: 3px;
border-radius: 15px 0px 0px 15px;
border-color: darkgreen;
box-shadow: inset -300px 0 0 0 honeydew;
}

#reset_button
{
width: 200px;
letter-spacing: 3px;
text-transform: uppercase;
color: honeydew;
background-image: linear-gradient(90deg,greenyellow,green);
border-style: solid;
border-width: 3px;
border-radius: 0px 15px 15px 0px;
border-color: navy;
box-shadow: inset 0 0 0 0 azure;
transition: ease-out 0.3s;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#reset_button:hover
{
color: darkolivegreen;
cursor: pointer;
border-width: 3px;
border-radius: 0px 15px 15px 0px;
border-color: darkgreen;
box-shadow: inset 300px 0 0 0 honeydew;
}

h2
{
display: inline;
letter-spacing: 2px;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#login
{
color: navy;
text-shadow: 2px 2px 10px yellow;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#uploadfile
{
width: 530px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: 700;
font-size: 18px;
margin: 0px 0px 0px 10px;
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

@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

:root{
  --green:#27ae60;
  --black:#2c2c54;
}

*{
  font-family: 'Nunito', sans-serif;
  margin:0; 
padding:0;
  box-sizing: border-box;
  outline: none; 
border:none;
  text-decoration: none;
}

*::selection{
  background:var(--green);
  color:#fff;
}

html{
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-padding-top: 6.5rem;
  scroll-behavior: smooth;
}

.header-1{
  background:#eee;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding:2rem 9%;
}

.logo{
  color:var(--black);
  font-weight: bolder;
  font-size: 3rem;
}

.logo i{
  padding-right: .5rem;
  color:var(--green);
}

.header-1 .search-box-container{
  display: flex;
  height:5rem;
}

.header-1 .search-box-container #search-box{
  height: 100%;
  width:100%;
  padding:1rem;
  font-size: 2rem;
  color:#333;
  border:.1rem solid rgba(0,0,0,.3);
  text-transform: none;
}

.header-1 .search-box-container label{
  height: 100%;
  width:8rem;
  font-size: 2.5rem;
  line-height: 5rem;
  color:#fff;
  background:var(--green);
  text-align: center;
  cursor: pointer;
}

.header-1 .search-box-container label:hover{
  background:var(--black);
}

.header-2{
  background:#fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding:2rem 9%;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
  position: relative;
}

.header-2.active{
  position: fixed;
  top:0; left: 0; right:0;
  z-index: 10000;
}

.header-2 .navbar a{
  padding:.5rem 1.5rem;
  font-size: 2rem;
  border-radius: .5rem;
  color:var(--black);
}

.header-2 .navbar a:hover{
  background:var(--green);
  color:#fff;
}

.header-2 .icons a{
  font-size: 2.5rem;
  color:var(--black);
  padding-left: 1rem;
}

.header-2 .icons a:hover{
  color:var(--green);
}

#menu-bar{
  font-size: 3rem;
  border-radius: .5rem;
  border:.1rem solid var(--black);
  padding:.8rem 1.5rem;
  color:var(--black);
  cursor: pointer;
  display: none;
}

#card_count
{
text-align: center; 
padding: 0px 5px 0px 5px; 
color: white:
}
.header-2 .navbar .navbar_btn{
  padding:.5rem 1.5rem;
  font-size: 2rem;
  border: 2px solid darkgreen;
  border-radius: .8rem;
  color:var(--black);
  background-color: honeydew;
}

.header-2 .navbar .navbar_btn:hover{
  background:var(--green);
  color:#fff;
}

.header-2 .icons .navbar_btn{
  font-size: 2.5rem;
  color:var(--black);
  padding-left: 1rem;
}

.header-2 .icons .navbar_btn:hover{
  color:var(--green);
}

.add_item_icon
{
width: 120px;
height:100px;
padding: 8px 10px 12px 12px;
margin: 10px 150px 10px 10px;
color: forestgreen;
background-color: honeydew;
border: 5px dashed green;
border-radius: 20px;
}
</style>

<script type="text/javascript">
let selling_price_success=0;
let product_discount_success=0;
function form_validation()
{
var valid=true;
var pname_success=1;
var pbrand_success=1;
var pcategory_success=1;
var pquantity_success=1;
var pcprice_success=1;
var psprice_success=1;
var pdiscount_success=1;
var pdescription_success=1;
var pname=document.pform.pname.value;
var pbrand=document.pform.pbrand.value;
var pcategory=document.pform.pcategory.value;
var pquantity=document.pform.pquantity.value;
var pcprice=document.pform.pcprice.value;
var psprice=document.pform.psprice.value;
var pdiscount=document.pform.pdiscount.value;
var pdescription=document.pform.pdescription.value;
if (pname=="")
{
alert("Please enter Product Name!");
pname_success=0;
valid=false;
}
if (pbrand=="")
{
alert("Please enter Product Brand!");
pbrand_success=0;
valid=false;
}
if (pcategory=="Category")
{
alert("Please select Product Category!");
pcategory_success=0;
valid=false;
}
if (pquantity=="")
{
alert("Please enter Product Quantity!");
pquantity_success=0;
valid=false;
}
if (pcprice=="")
{
alert("Please enter Product Cost Price!");
pcprice_success=0;
valid=false;
}
if (psprice=="")
{
alert("Please enter Product Selling Price!");
psprice_success=0;
valid=false;
}
if (pdiscount=="")
{
alert("Please enter Product Discount!");
pdiscount_success=0;
valid=false;
}
if (pdescription=="")
{
alert("Please enter Product Description!");
pdescription_success=0;
valid=false;
}

if(pname_success==1 && pbrand_success==1 && pcategory_success==1 && pquantity_success==1 && pcprice_success==1 && psprice_success==1 && pdiscount_success==1 && pdescription_success==1)
{
alert("Product Added Successfully!");
}
return valid;
}
</script>

</head>
<body>
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
            <a class="current_button" href="all_product.php" style="">All</a>
<?php
$query="SELECT * FROM categories";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>
<a id="category<?php echo($row['id']); ?>" href="<?php echo($row['name']); ?>.php" ><?php echo($row['name']); ?></a>
<?php
}
?>
            <a href="#">Contact</a>
        </nav>

        <div class="icons">
<button class="w3-btn w3-black" style="background-color: white;">            
<a href="shopping_cart.php" class="fas fa-shopping-cart"></a>
<?php 
if(isset($_SESSION['cart']))
{
$count=count($_SESSION['cart']);
echo "<span id=\"card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px;\">$count</span>";
}
else
{
echo "<span id=\"card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px;\">0</span>";
}
?>

</button>

<button class="w3-btn w3-black" style="background-color: white;">            
<a href="shopping_wishlist.php" class="fas fa-heart" style="padding: 0px 0px 0px 5px;"></a>
<?php 
if(isset($_SESSION['wishlist']))
{
$count=count($_SESSION['wishlist']);
echo "<span id=\"card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px; margin-right: 5px;\">$count</span>";
}
else
{
echo "<span id=\"card_count\" class=\"w3-badge w3-margin-left w3-white\" style=\"background-color: red; color: white; border: 2px solid green; border-radius: 10px; margin-right: 5px;\">0</span>";
}
?>

</button>

<?php
if(isset($_SESSION['username']))
{
?>
<div class="tooltip">
            <a href="logout.php" class="fas fa-user-circle" style="padding: 0px; border: 3px solid darkgreen; background-color: darkgreen; color: honeydew;"></a>
            <span class="tooltiptext">Logout</span>
</div>
            <label for="login_username" id="login_username"><b style="font-size: 14px; color: blue;"><?php echo($_SESSION['username']); ?></b></label> 
</div>
<?php
}
else
{
?>
<div class="tooltip">
            <a href="login.php" class="fas fa-user-circle"  style="padding: 0px; border: 3px solid darkgreen; background-color: honeydew;"></a>
            <span class="tooltiptext">Login</span>
</div>
<?php
}
?>
        </div>

    </div>

</header>
<br>
<br>
<div align="center">
<form action="add_images_db.php" method="post" name="pform" onsubmit="return form_validation();" enctype="multipart/form-data">
<fieldset class="form_border">
<div class="form_heading">
<span><i class="fa-solid fa-cart-plus fa-7x add_item_icon"></i></span>
<label style="width: 400px; color: white;  text-align: center; font-size: 40px; font-variant: small-caps; font-family: Arial;"><b>Add Product</b></label>
</div>
<br>
<br>
<br>
<br>
<label class="field_heading">Product Photo</label>
        <input type="file" name="productImage" id="uploadfile" accept="image/jpg,image/jpeg,image/png">
<br>
<br>
<br>
<br>
<br>
<div class="container" align="center">
	<input id="submit_button" type="submit" name="submit" value="Add">
	<input type="hidden" name="register_success" value="1">
	<button type="button" id="reset_button" name="reset" onclick="pform_reset();">Reset</button>
<script type="text/javascript">
document.pform.name.focus();
function pform_reset()
{
document.pform.pname.value="";
document.pform.pbrand.value="";
document.pform.pcategory.value="Category";
document.pform.pquantity.value="";
document.pform.pcprice.value="";
document.pform.psprice.value="";
document.pform.pdiscount.value="";
document.pform.pdamount.value="";
document.pform.pdprice.value="";
document.pform.pdescription.value="";
document.pform.pname.focus();
}
</script>
<br>
<br>
<br>
<br>
</div>
</fieldset>
</form>
</div>
<br>
<br>
<br>
</body>
</html>