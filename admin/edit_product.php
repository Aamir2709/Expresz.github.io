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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product</title>

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

.pImage *
{
vertical-align: middle;
}

#productImage
{
margin-left: 10px;
width: 350px;
height: 350px;
border: 5px solid green;
border-width: 2px 4px;
border-radius: 15px;
}

#editImage
{
margin-left: 50px;
width: 100px;
height: 40px;
background-color: green;
color: white;
font-size: 18px;
font-weight: 700;
border-radius: 15px;
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
width: 110px;
height:100px;
padding: 8px 10px 12px 12px;
margin: 10px 150px 10px 10px;
color: forestgreen;
background-color: honeydew;
border: 5px dashed green;
border-radius: 20px;
}
</style>

<?php
$pid=$_POST['edit_product_id'];
$query="SELECT * FROM items WHERE product_id='$pid'";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>
<?php
$cid=(int)$row["category_id"];
$query_category="SELECT * FROM categories WHERE id='$cid'";
$query_category_run=mysqli_query($conn,$query_category);
while($category=mysqli_fetch_array($query_category_run))
{
?>

<script type="text/javascript">
function productDetails()
{
document.pform.pname.value="<?php echo($row['pname']); ?>"; 
document.pform.pbrand.value="<?php echo($row['pbrand']); ?>";
document.pform.pcategory.value="<?php echo($category['id']); ?>";
document.pform.pquantity.value="<?php echo($row['pquantity']); ?>";
document.pform.pcprice.value="<?php echo($row['cprice']); ?>";
document.pform.psprice.value="<?php echo($row['sprice']); ?>";
document.pform.pdiscount.value="<?php echo($row['discount']); ?>";
document.pform.pdamount.value="<?php echo($row['damount']); ?>";
document.pform.pdprice.value="<?php echo($row['dprice']); ?>";
document.pform.pdescription.value="<?php echo($row['pdescription']); ?>";
document.getElementById("productImage").src="productImages/<?php echo($row['pImage_path']); ?>";
}
</script>

<?php
}
}
?>

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
alert("Product Details Edited Successfully!");
}
return valid;
}
</script>

</head>
<body onload="productDetails();">
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
            <a class="current_button" href="add_product.php" style="">Add Product</a>
            <a href="view_product.php" style="">View Product</a>
            <a href="add_category.php" style="">Add Category</a>
            <a href="view_category.php" style="">View Category</a>
            <a href="order_details.php" style="">Orders</a>
        </nav>

        <div class="icons">
<?php
if(isset($_SESSION['username']))
{
?>
<div class="tooltip">
            <a href="admin_logout.php" class="fas fa-user-circle" style="padding: 0px; border: 3px solid red; background-color: darkgreen; color: honeydew;"></a>
            <span class="tooltiptext">Logout</span>
        </div>
            <label for="login_username" id="login_username"><b style="font-size: 14px; color: blue;"><?php echo($_SESSION['username']); ?></b></label> 
<?php
}
else
{
?>
<div class="tooltip">
            <a href="admin_login.php" class="fas fa-user-circle"  style="padding: 0px; border: 3px solid darkgreen; background-color: honeydew;"></a>
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
<form action="edit_product_db.php" method="post" name="pform" onsubmit="return form_validation();" enctype="multipart/form-data">
<fieldset class="form_border">
<div class="form_heading">
<span><i class="fa-solid fa-pen-to-square fa-7x add_item_icon"></i></span>
<label style="width: 400px; color: white;  text-align: center; font-size: 40px; font-variant: small-caps; font-family: Arial;"><b>Edit Product</b></label>
</div>
<br>
<br>
<label class="field_heading">Name</label>
	<input type="text" class="field" name="pname" placeholder="Enter Product Name!">
<br>
<br>
<label class="field_heading">Brand</label>
	<input type="text" class="field" name="pbrand" placeholder="Enter Product Brand!">
<br>
<br>
<label class="field_heading">Category</label>
<select class="select_choice" name="pcategory">
<option value="Category">Category</option>
<?php
$query="SELECT * FROM categories";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>
<option value="<?php echo($row['id']); ?>"><?php echo($row['name']); ?></option>
<?php
}
?>
</select>
<br>
<br>
<label class="field_heading">Availability</label>
	<input type="number" class="field" name="pquantity" placeholder="Enter Product Quantity!" min="0" max="100">
<br>
<br>
<label class="field_heading">Cost Price</label>
	<input type="number" class="field" name="pcprice" placeholder="Enter Product Cost Price!" min="1">
<br>
<br>
<label class="field_heading">Selling Price</label>
	<input type="number" class="field" name="psprice" placeholder="Enter Product Selling Price!" min="1" oninput="sellingPrice()">
<script type="text/javascript">
function sellingPrice()
{
selling_price_success=1;
if(selling_price_success==1 && product_discount_success==1)
{
var psprice=parseInt(document.pform.psprice.value);
var pdiscount=parseInt(document.pform.pdiscount.value);
var pdamount=((psprice*pdiscount)/100);
var pdprice=psprice-pdamount;
document.pform.pdamount.value=pdamount;
document.pform.pdprice.value=pdprice;
}
}
</script>
<br>
<br>
<label class="field_heading">Discount</label>
	<input type="number" class="field" name="pdiscount" placeholder="Enter the Discount on Product in Percentage!" min="0" oninput="productDiscount()">
<script type="text/javascript">
function productDiscount()
{
product_discount_success=1;
if(selling_price_success==1 && product_discount_success==1)
{
var psprice=parseInt(document.pform.psprice.value);
var pdiscount=parseInt(document.pform.pdiscount.value);
var pdamount=((psprice*pdiscount)/100);
var pdprice=psprice-pdamount;
document.pform.pdamount.value=pdamount;
document.pform.pdprice.value=pdprice;
}
}
</script>
<br>
<br>
<label class="field_heading">Discount Amount</label>
	<input type="number" class="field" name="pdamount" placeholder="Discounted Amount is Calculated!" min="1" readonly>
<br>
<br>
<label class="field_heading">Final Price</label>
	<input type="number" class="field" name="pdprice" placeholder="Discounted Selling Price is Calculated!" min="1" readonly>
<br>
<br>
<br>
<p class="description">
<label id="description_heading">Description</label>
	<textarea  id="description_field" name="pdescription" cols="42"  rows="4" placeholder=" Enter Product Description!"></textarea>
</p>
<br>
<br>
<br>
<p class="pImage">
<label class="field_heading">Product Photo</label>
<img src="" id="productImage" alt="product Image"> 
<button type="button" name="editImage" id="editImage" onclick="changeImage();">Change</button>
</p>
<br>
<br>
<label class="field_heading" id="changeImage_heading" style="display: none;">Required Photo</label>
        <input style="display: none;" type="file" name="productImage" id="uploadfile" accept="image/jpg,image/jpeg,image/png">

<script type="text/javascript">
function changeImage()
{
document.getElementById("changeImage_heading").style.display="inline-block";
document.getElementById("uploadfile").style.display="inline";
document.getElementById("uploadfile").style.marginTop="15px";
document.getElementById("uploadfile").style.marginBottom="50px";
document.getElementById("changeImageSuccess").value="1";
}
</script>
<br>
<br>
<br>
<div class="container" align="center">
	<input id="submit_button" type="submit" name="submit" value="Edit">
	<input type="hidden" name="register_success" value="1">
	<input type="hidden" name="productId" value="<?php echo($_POST['edit_product_id']); ?>">
	<input type="hidden" name="changeImageSuccess" id="changeImageSuccess" value="0">
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