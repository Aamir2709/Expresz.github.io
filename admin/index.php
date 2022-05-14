<?php
session_start();
?>
<?php 
// Database Connection
$servername = "localhost";
$username = "root"; //default user name is root
$password = ""; //default password is blank
$conn = new mysqli($servername, $username, $password,'stationary');
if($conn->connect_error)
{
die("Connection Failed : ".$conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expresz Stationery</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="stationary_css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>

<style type="text/css">

body
{
background-color: white;
}

.current_button
{
background-color: honeydew; 
border: 2px solid darkgreen;
border-radius: 10px;
}
.header-2 .navbar .current_button a:hover
{
background-color: green; 
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

#login_icon
{
margin-left: 0px;
margin-right: 0px;
font-size: 30px;
color: black;
}

#logout_icon
{
margin-left: 0px;
margin-right: 0px;
font-size: 30px;
color: black;
border: 3px solid red;
}

</style>

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
            <a  class="current_button" href="index.php"><i class="fa-solid fa-house"></i></a>
            <a href="admin_register.php" style="margin-right: 35px;">Register</a>
<?php
if(isset($_SESSION['username']))
{
?>
<div class="tooltip">
            <a href="admin_logout.php" class="fas fa-user-circle" id="logout_icon"></a>
            <span class="tooltiptext">Logout</span>
        </div>
            <label for="login_username" id="login_username"><b style="font-size: 14px; color: blue;"><?php echo($_SESSION['username']); ?></b></label> 
<?php
}
else
{
?>
<div class="tooltip">
            <a href="admin_login.php" class="fas fa-user-circle" id="login_icon"></a>
            <span class="tooltiptext">Admin Login</span>
</div>
<?php
}
?>
        </nav>

</div>

</header>

<!-- header section ends -->
<!-- home section starts  -->

<section class="home" id="home">

    <div class="image">
        <img src="images\stationary_logo.jpeg" alt="">
    </div>

    <div class="content">
        <span>Get it in an Instant</span>
        <h3>your daily need products</h3>
        <a href="add_product.php" class="btn">Get Started</a>
    </div>

</section>

<img src="images/admin_logo.jpg" alt="Admin Logo" style="width: 400px; height: 300px; float: right; margin-right: 100px; margin-bottom: 0px;">

<center>
<img src="images/admin.jpg" alt="Admin Image" style="width: 1200px; height: 600px; margin-top: 0px; margin-bottom: 50px; border: 8px dashed black;;">
</center>

<!-- home section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <a href="#" class="logo"><i class="fa-solid fa-pen-ruler"></i>Expresz</a>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam culpa sit enim nesciunt rerum laborum illum quam error ut alias!</p>
            <div class="share">
                <a href="#" class="btn fab fa-facebook-f"></a>
                <a href="#" class="btn fab fa-twitter"></a>
                <a href="#" class="btn fab fa-instagram"></a>
                <a href="#" class="btn fab fa-linkedin"></a>
            </div>
        </div>
        
        <div class="box">
            <h3>our location</h3>
            <div class="links">
                <a href="#">india</a>
                <a href="#">USA</a>
                <a href="#">france</a>
                <a href="#">japan</a>
                <a href="#">russia</a>
            </div>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <div class="links">
                <a href="#">home</a>
                <a href="#">category</a>
                <a href="#">product</a>
                <a href="#">deal</a>
                <a href="#">contact</a>
            </div>
        </div>

        <div class="box">
            <h3>download app</h3>
            <div class="links">
                <a href="#">google play</a>
                <a href="#">window xp</a>
                <a href="#">app store</a>
            </div>
        </div>

    </div>

    <h1 class="credit"> created by <span> Aamir </span> | all rights reserved! </h1>

</section>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
    
</body>
</html>