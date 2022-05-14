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

<?php
if(isset($_POST["add_product_wishlist"]))
{
if(isset($_SESSION['wishlist']))
{
$item_array_id=array_column($_SESSION['wishlist'],"product_id");
if(in_array($_POST['product_id'],$item_array_id))
{
echo "<script>alert('Product is already added in the Wishlist!')</script>";
echo "<script>window.location='index.php'</script>";
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

    <link rel="stylesheet" href="static/css/chat.css">
    <link rel="stylesheet" href="static/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
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

.mag {
    width:200px;
    margin: 0 auto;
    float: none;
}
    
.mag img {
    max-width: 100%;
}
        
  

.magnify {
    position: relative;
    cursor: none
}

.magnify-large {
    position: absolute;
    display: none;
    width: 175px;
    height: 175px;

    -webkit-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
       -moz-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
            box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
    border: 2px solid green;
    -webkit-border-radius: 100%;
       -moz-border-radius: 100%;
             border-radius: 50%;
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

img
{
width: 200px;
height: 500px;
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
            <a class="current_button" href="index.php">Home</a>
            <a href="#category">Category</a>
            <a href="all_product.php">Products</a>
            <a href="#deal">deal</a>
            <a href="#contact">contact</a>
        </nav>

        <div class="icons">
<button class="w3-btn w3-black" style="background-color: white;">            
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
<div class="tooltip">
            <a href="logout.php" class="fas fa-user-circle" style="padding: 0px; border: 3px solid red; background-color: darkgreen; color: honeydew;"></a>
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

<!-- header section ends -->
<!-- home section starts  -->

<section class="home" id="home">

    <div class="image">
        
        <img src="images\stationary_logo.jpeg" alt="">
    </div>

    <div class="content">
        <span>Get it in an Instant</span>
        <h3>your daily need products</h3>
        <a href="all_product.php" class="btn">Get Started</a>
    </div>

</section>

<!-- home section ends -->

<!-- banner section starts  -->

<section class="banner-container">

    <div class="banner">
        <img src="images/offer1.jpg" alt="">
        <div class="content">
            <h3>special offer</h3>
            <p>upto 15% off</p>
            <a href="#" class="btn">Check Out</a>
        </div>
    </div>

    <div class="banner">
        <img src="images/offer2.jpg" alt="">
        <div class="content">
            <h3>limited offer</h3>
            <p>upto 50% off</p>
            <a href="#" class="btn">Check Out</a>
        </div>
    </div>

</section>

<!-- banner section ends -->

<!-- category section starts  -->

<section class="category" id="category">

    <h1 class="heading">shop by <span>category</span></h1>

    <div class="box-container">

        <div class="box">
            <h3>Office Supplies</h3>
            <p>upto 10% off</p>
            <img src="images/category-1.jpg" alt="">
            <a href="Office Supplies.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>Art and Crafts</h3>
            <p>upto 35% off</p>
            <img src="images/category-2.png" alt="">
            <a href="Art and Crafts.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>Paper Products </h3>
            <p>upto 25% off</p>
            <img src="images/category-3.jpg" alt="">
            <a href="Paper Products.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>Writing Instruments</h3>
            <p>upto 12% off</p>
            <img src="images/category-4.jpg" alt="">
            <a href="Writing Instruments.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>School Supplies</h3>
            <p>upto 12% off</p>
            <img src="images/category-5.jpg" alt="">
            <a href="School Supplies.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>Sample</h3>
            <p>upto 12% off</p>
            <img src="images/category-5.jpg" alt="" >
            <a href="School Supplies.php" class="btn">shop now</a>
        </div>
    </div>

</section>

<!-- category section ends -->

<!-- deal section starts  -->

<section class="deal" id="deal">

    <div class="content">

        <h3 class="title">Deal of the Day</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam possimus voluptates commodi laudantium! Doloribus sint voluptatibus quaerat sequi suscipit nulla?</p>

        <div class="count-down">
            <div class="box">
                <h3 id="day">00</h3>
                <span>day</span>
            </div>
            <div class="box">
                <h3 id="hour">00</h3>
                <span>hour</span>
            </div>
            <div class="box">
                <h3 id="minute">00</h3>
                <span>minute</span>
            </div>
            <div class="box">
                <h3 id="second">00</h3>
                <span>second</span>
            </div>
        </div>

        <a href="#" class="btn">check the deal</a>

    </div>

</section>

<!-- deal section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <form action="">

        <div class="inputBox">
            <input type="text" placeholder="name">
            <input type="email" placeholder="email">
        </div>

        <div class="inputBox">
            <input type="number" placeholder="number">
            <input type="text" placeholder="subject">
        </div>

        <textarea placeholder="message" name="" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="send message" class="btn">

    </form>

</section>

<!-- contact section ends -->

<!-- newsletter section starts  -->

<section class="newsletter">

    <h3>subscribe us for latest updates</h3>

    <form action="">
        <input class="box" type="email" placeholder="enter your email">
        <input type="submit" value="subscribe" class="btn">
    </form>

</section>

<!-- newsletter section ends -->

<!-- CHAT BAR BLOCK -->
     <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">Chat with us!
            <i id="chat-icon" style="color: #fff;" class="fa fa-fw fa-comments-o"></i>
        </button>

        <div class="content-c">
            <div class="full-chat-block">
                <!-- Message Container -->
                <div class="outer-container">
                    <div class="chat-container">
                        <!-- Messages -->
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                        </div>

                        <!-- User input box -->
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Tap 'Enter' to send a message">
                                <p></p>
                            </div>

                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: crimson;" class="fa fa-fw fa-heart"
                                    onclick="heartButton()"></i>
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"
                                    onclick="sendButton()"></i>
                            </div>
                        </div>

                        <div id="chat-bar-bottom">
                            <p></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="static/scripts/responses.js"></script> <script src="static/scripts/chat.js"></script>
    
</body>
</html>