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

    <title>View Category</title>

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
width: 800px;
padding: 0px;
margin-left: 15px;
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
margin: 10px 180px 10px 10px;
color: forestgreen;
background-color: honeydew;
border: 5px dashed green;
border-radius: 20px;
}

.table_caption
{
background-image: linear-gradient(to bottom,honeydew,lightyellow);
color: darkgreen;
font-size: 34px;
font-weight: 900;
border: 5px solid darkgreen;
border-bottom: none;
}

table
{
border-left: 4px solid darkgreen;
border-right: 4px solid darkgreen;
}

th
{
border-top: 4px solid darkgreen;
border-left: 2px solid darkgreen;
border-right: 2px solid darkgreen;
border-bottom: 8px solid darkgreen;
padding: 8px;
background-image: linear-gradient(to bottom,darkgreen,lightgreen);
color: white;
font-size: 24px;
text-align: center;
}

td
{
background-image: linear-gradient(to bottom,honeydew,floralwhite);
text-align: center;
border-left: 2px solid darkgreen;
border-right: 2px solid darkgreen;
border-bottom: 6px solid darkgreen;
}

#cid
{
background-color: navy;
color: white;
padding: 8px 18px 8px 18px;
font-size: 18px;
font-weight: 900;
}

.category_name
{
padding: 15px;
text-align: center;
color: navy;
font-size: 18px;
font-weight: 900;
border-bottom: 6px solid darkgreen;
}

.details_content
{
padding-left: 5px;
text-align: left;
color: navy;
font-size: 18px;
font-weight: 700;
border-bottom: 4px solid darkgreen;
}

.number
{
font-size: 18px;
font-weight: 900;
color: navy;
}

.edit_category
{
margin: 20px;
width: 80px;
height: 40px;
font-size: 20px;
font-weight: 700;
background-color: darkcyan;
color: white;
border: 3px solid red;
}

.delete_category
{
margin: 20px;
width: 80px;
height: 40px;
font-size: 20px;
font-weight: 700;
background-color: crimson;
color: white;
border: 3px solid navy;
}
</style>

<script type="text/javascript">
function confirmDelete()
{
return(confirm("Are you sure you want to delete the Category!"));
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
<fieldset class="form_border">
<div class="form_heading">
<span><i class="fa-solid fa-eye fa-7x add_item_icon"></i></span>
<label style="width: 300px; color: white;  text-align: center; font-size: 40px; font-variant: small-caps; font-family: Arial;"><b>View Category</b></label>
</div>
</fieldset>
</div>
<br>
<div align="center">
<table border="1" cellspacing="0">
<tr>
<th>Category-Id</th>
<th>Name</th>
<th>Total Products</th>
<th>Description</th>
<th>Operation</th>
</tr>

<?php
$query="SELECT * FROM categories";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>

<tr>
<td rowspan="2"><label id="cid"><?php echo($row['id']); ?></label></td>

<td rowspan="2" class="category_name"><?php echo($row['name']); ?></td>

<?php
$cid=$row['id'];
$category_product_count="SELECT * FROM items WHERE category_id='$cid'";
if ($result = mysqli_query($conn, $category_product_count))
{
$rowcount=mysqli_num_rows( $result );
?>
<td rowspan="2" class="number"><?php echo($rowcount); ?></td>
<?php
}
?>

<td rowspan="2" class="details_content" style="width: 350px; border-bottom: 6px solid darkgreen;"><?php echo($row['description']); ?></td>

<td style="border-bottom: 4px solid darkgreen;">
<form action="edit_category.php" name="eform" method="post">
<button type="submit" class="edit_category">Edit</button>
<input type="hidden" name="edit_category_id" id="edit_category_id" value="<?php echo($row['id']); ?>">
</form>
</td>
</tr>

<tr>
<td>
<form action="delete_category.php" name="dform" method="post" onsubmit="return confirmDelete();">
<input type="submit" class="delete_category" value="Delete">
<input type="hidden" name="delete_category_id" id="delete_category_id" value="<?php echo($row['id']); ?>">
</form>
</td>
</tr>
<?php
}
?>
</table>
</div>
<br>
<br>
</body>
</html>