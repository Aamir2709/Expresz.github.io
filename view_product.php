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
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="stationary_css.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>
    <title>View Product</title>

<style type="text/css">

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

.product .box-container img{
  height: 20rem;
}

.product .box-container .discount{
  position: absolute;
  top:1rem; left: 1rem;
  background:rgba(0,255,0,.1);
  color:var(--green);
  padding:.7rem 1rem;
  font-size: 2rem;
}

.product .box-container .stars i{
  padding:1rem .1rem;
  font-size: 1.7rem;
  color:gold;
}

.product .box-container .price{
  font-size: 2rem;
  color:#333;
  padding:.5rem 0;
}

.product .box-container .price span{
  font-size: 1.5rem;
  color:#999;
  text-decoration: line-through;
}

.product .box-container .quantity{
  display: flex;
  align-items: center;
  padding-top: 1rem;
  padding-bottom: .5rem;
}

.product .box-container .quantity span{
  padding:0 .7rem;
  font-size: 1.7rem;
}

.product .box-container .quantity input{
  border:.1rem solid rgba(0,0,0,.3);
  font-size: 1.5rem;
  font-weight: bolder;
  color:var(--black);
  padding:.5rem;
  background:rgba(0,0,0,.05);
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

</style>

</head>
<body>
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
            <a href="all_product.php" style="">All</a>
<?php
$query="SELECT * FROM categories";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
?>
<a class="current_button" id="category<?php echo($row['id']); ?>" href="<?php echo($row['name']); ?>.php" onmouseover="mouseOver(<?php echo($_GET['cid']); ?>);"><?php echo($row['name']); ?></a>

<script type="text/javascript">
document.getElementById("category<?php echo($_GET['cid']); ?>").style.backgroundColor="honeydew";
document.getElementById("category<?php echo($_GET['cid']); ?>").style.border="2px solid darkgreen";
document.getElementById("category<?php echo($_GET['cid']); ?>").style.borderRadius="10px";
</script>

<script type="text/javascript">
function mouseOver(cid)
{
document.getElementById("category"+cid).style.color="green";
document.getElementById("category"+cid).style.backgroundColor="honeydew";
document.getElementById("category"+cid).style.border="2px solid darkgreen";
document.getElementById("category"+cid).style.borderRadius="10px";
}
</script>

<?php
}
?>

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

<br>
<br>

<!-- product section starts  -->
<section class="product" id="product">

    <div class="box-container">


<?php
$pid=(int)$_GET["pid"];
$cid=(int)$_GET["cid"];
$query1="SELECT * FROM items WHERE product_id='$pid'";
$query2="SELECT * FROM categories WHERE id='$cid'";
$query_run1=mysqli_query($conn,$query1);
$query_run2=mysqli_query($conn,$query2);
while($row=mysqli_fetch_array($query_run1))
{
?>

<div class="small-container">
    <div class="row">

<div class="col-2 mag">
            <img data-toggle="magnify" id="myimage<?php echo($row['product_id']);?>" src="images/<?php echo($row['pImage_path']); ?>" alt="<?php echo($row['pImage_path']); ?>">
            <div class="stars">
<center>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
</center>
            </div>
</div>
<script>
!function ($) {

    "use strict"; // jshint ;_;


    /* MAGNIFY PUBLIC CLASS DEFINITION
     * =============================== */

    var Magnify = function (element, options) {
        this.init('magnify', element, options)
    }

    Magnify.prototype = {

        constructor: Magnify

        , init: function (type, element, options) {
            var event = 'mousemove'
                , eventOut = 'mouseleave';

            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.nativeWidth = 0
            this.nativeHeight = 0

            this.$element.wrap('<div class="magnify" \>');
            this.$element.parent('.magnify').append('<div class="magnify-large" \>');
            this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

            this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
            this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
        }

        , getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                    , hide: options.delay
                }
            }

            return options
        }

        , check: function (e) {
            var container = $(e.currentTarget);
            var self = container.children('img');
            var mag = container.children(".magnify-large");

            // Get the native dimensions of the image
            if(!this.nativeWidth && !this.nativeHeight) {
                var image = new Image();
                image.src = self.attr("src");

                this.nativeWidth = image.width;
                this.nativeHeight = image.height;

            } else {

                var magnifyOffset = container.offset();
                var mx = e.pageX - magnifyOffset.left;
                var my = e.pageY - magnifyOffset.top;

                if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                    mag.fadeIn(100);
                } else {
                    mag.fadeOut(100);
                }

                if(mag.is(":visible"))
                {
                    var rx = Math.round(mx/container.width()*this.nativeWidth - mag.width()/2)*-1;
                    var ry = Math.round(my/container.height()*this.nativeHeight - mag.height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";

                    var px = mx - mag.width()/2;
                    var py = my - mag.height()/2;

                    mag.css({left: px, top: py, backgroundPosition: bgp});
                }
            }

        }
    }


    /* MAGNIFY PLUGIN DEFINITION
     * ========================= */

    $.fn.magnify = function ( option ) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('magnify')
                , options = typeof option == 'object' && option
            if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.magnify.Constructor = Magnify

    $.fn.magnify.defaults = {
        delay: 0
    }


    /* MAGNIFY DATA-API
     * ================ */

    $(window).on('load', function () {
        $('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })
    })

} ( window.jQuery );
</script>



        <div class="col-2">
            <p style="font-size: 25px; font-weight: 700;">Name : <?php echo($row['pname']); ?></p>
            <p style="font-size: 20px; font-weight: 500; color: grey;">Brand : <?php echo($row['pbrand']); ?></p>
<?php 
while($category=mysqli_fetch_array($query_run2))
{
?>
            <p style="font-size: 20px; font-weight: 700; padding: 5px 0px 5px 0px;">Category : <?php echo($category['name']); ?></p>
<?php
}
?>
<?php 
if($row['pquantity']!=0)
{
?>
    <p><span style="font-size: 20px; font-weight: 700;">Availability : </span><b style="font-size: 18px; color:blue;"><?php echo number_format($row['pquantity'],0) ?></b></p>
<?php 
}
else
{
?>
    <p><span style="font-size: 20px; font-weight: 700;">Availability : </span><b style="font-size: 18px; color:blue;">Out of Stock</b></p>
<?php 
}
?>
            <div class="price"><p style="font-size: 23px; font-weight: 700;">Price : &#8377 <?php echo($row['dprice']); ?><span> &#8377 <?php echo($row['sprice']); ?> </span></p></div>


            <p style="font-size: 20px; font-weight: 900; color: darkgray;"><span style="font-size: 20px; font-weight: 700; color: black;">Description : </span><b><?php echo($row['pdescription']); ?></b></p>

<div class="quantity">
	<button type="button"  id="m_button" class="btn btn-secondary btn-minus" onclick="mButton(<?php echo($_GET['pid']); ?>)" ><b><i class="fa fa-minus"></i></b></button>
	<input type="number" name="qty" id="quantity<?php echo($row['product_id']); ?>" value="1" style="text-align: center; width: 60px; height: 41px; padding: 0px 0px 0px 12px; margin: 10px 0px 0px 0px;" readonly>
	<button type="button"  id="p_button" class="btn btn-secondary btn-plus"  onclick="pButton(<?php echo($_GET['pid']); ?>)" ><b><i class="fa fa-plus"></i></b></button>
</div>
<form action="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" method="post">

	<button type="submit" class="btn" style="width: 220px;" name="add_product" id="add_cart">Add To Cart</button>
	<input type="hidden" name="product_id" value="<?php echo($row['product_id']); ?>">

</form>
</div>
</div>
</div>

<script type="text/javascript">
document.getElementById("quantity<?php echo($_GET['pid']);?>").max=<?php echo($row['pquantity']);?>;
</script>

<?php 
if($row['pquantity']<=0) 
{
?>
<script type="text/javascript">
document.getElementById("quantity<?php echo($row['product_id']);?>").value=0;
document.getElementById("quantity<?php echo($row['product_id']);?>").readOnly = true;
document.getElementById("m_button").disabled = true;
document.getElementById("p_button").disabled = true;
document.getElementById("add_cart").disabled = true;
</script>
<?php 
}
?>
<?php
}
?>
</div>

</section>

<script type="text/javascript">
function mButton(pid)
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

function pButton(pid)
{
var quantity=document.getElementById("quantity"+pid).value;
if(quantity!=document.getElementById("quantity"+pid).max)
{
quantity=parseInt(quantity)+1;
document.getElementById("quantity"+pid).value=quantity;
}
}
</script>

<!-- product section ends -->

<!-- product section starts  -->
<section class="product" id="product">


    <h1 class="heading">Related <span>Products</span></h1>
    <div class="box-container">

    <div class="box-container">



<?php
$pid=(int)$_GET["pid"];
$cid=(int)$_GET["cid"];
$query="SELECT * FROM items WHERE category_id='$cid'";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
if($row['product_id']==$pid)
{
continue;
}
else
{
?>

        <div class="box">
            <span class="discount" style="padding: 3px; border: 2px solid darkgreen; background-color: mediumspringgreen; color: navy;">-<?php echo($row['discount']); ?>%</span>
            <div class="discount" style="margin-left: 70px; padding: 3px; border: 2px dashed green; background-color: palegreen; color: navy;">-&#8377;<?php echo($row['damount']); ?></div>
            <div class="icons">
<form action="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" method="post">
	<button type="submit" name="add_product_wishlist" id="add_to_wishlist" style="background-color: white;"><a class="fas fa-heart"></a></button>
	<input type="hidden" name="product_id" value="<?php echo($row['product_id']); ?>">
</form>
                <a href="#" class="fas fa-share"></a>
                <a href="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" class="fas fa-eye"></a>
            </div>
<div class="mag">
            <img data-toggle="magnify" id="myimage<?php echo($row['product_id']);?>" src="images/<?php echo($row['pImage_path']); ?>" alt="<?php echo($row['pImage_path']); ?>">
</div>
<script>
!function ($) {

    "use strict"; // jshint ;_;


    /* MAGNIFY PUBLIC CLASS DEFINITION
     * =============================== */

    var Magnify = function (element, options) {
        this.init('magnify', element, options)
    }

    Magnify.prototype = {

        constructor: Magnify

        , init: function (type, element, options) {
            var event = 'mousemove'
                , eventOut = 'mouseleave';

            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.nativeWidth = 0
            this.nativeHeight = 0

            this.$element.wrap('<div class="magnify" \>');
            this.$element.parent('.magnify').append('<div class="magnify-large" \>');
            this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

            this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
            this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
        }

        , getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                    , hide: options.delay
                }
            }

            return options
        }

        , check: function (e) {
            var container = $(e.currentTarget);
            var self = container.children('img');
            var mag = container.children(".magnify-large");

            // Get the native dimensions of the image
            if(!this.nativeWidth && !this.nativeHeight) {
                var image = new Image();
                image.src = self.attr("src");

                this.nativeWidth = image.width;
                this.nativeHeight = image.height;

            } else {

                var magnifyOffset = container.offset();
                var mx = e.pageX - magnifyOffset.left;
                var my = e.pageY - magnifyOffset.top;

                if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                    mag.fadeIn(100);
                } else {
                    mag.fadeOut(100);
                }

                if(mag.is(":visible"))
                {
                    var rx = Math.round(mx/container.width()*this.nativeWidth - mag.width()/2)*-1;
                    var ry = Math.round(my/container.height()*this.nativeHeight - mag.height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";

                    var px = mx - mag.width()/2;
                    var py = my - mag.height()/2;

                    mag.css({left: px, top: py, backgroundPosition: bgp});
                }
            }

        }
    }


    /* MAGNIFY PLUGIN DEFINITION
     * ========================= */

    $.fn.magnify = function ( option ) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('magnify')
                , options = typeof option == 'object' && option
            if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.magnify.Constructor = Magnify

    $.fn.magnify.defaults = {
        delay: 0
    }


    /* MAGNIFY DATA-API
     * ================ */

    $(window).on('load', function () {
        $('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })
    })

} ( window.jQuery );
</script>


            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p style="font-size: 25px; font-weight: 700;">Name : <?php echo($row['pname']); ?></p>
            <p style="font-size: 20px; font-weight: 500; color: grey;">Brand : <?php echo($row['pbrand']); ?></p>
<?php 
if($row['pquantity']!=0)
{
?>
    <p><span style="font-size: 20px; font-weight: 700;">Availability : </span><b style="font-size: 18px; color:blue;"><?php echo number_format($row['pquantity'],0) ?></b></p>
<?php 
}
else
{
?>
    <p><span style="font-size: 20px; font-weight: 700;">Availability : </span><b style="font-size: 18px; color:blue;"><?php echo("Out of Stock") ?></b></p>
<?php 
}
?>
            <div class="price"><p style="font-size: 23px; font-weight: 700;">Price : &#8377 <?php echo($row['dprice']); ?><span> &#8377 <?php echo($row['sprice']); ?> </span></p></div>
<div class="quantity">
	<button type="button"  id="minus_button" class="btn btn-secondary btn-minus" onclick="minusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-minus"></i></b></button>
	<input type="number" name="qty" id="quantity<?php echo($row['product_id']); ?>" value="1" style="text-align: center; width: 60px; height: 41px; padding: 0px 0px 0px 12px; margin: 10px 0px 0px 0px;" readonly>
	<button type="button"  id="plus_button" class="btn btn-secondary btn-plus"  onclick="plusButton(<?php echo($row['product_id']); ?>)" ><b><i class="fa fa-plus"></i></b></button>
</div>
<form action="view_product.php?pid=<?php echo($row['product_id']) ?>&cid=<?php echo($row['category_id']) ?>" method="post">
<center>
	<button type="submit" class="btn" style="width: 300px;" name="add_product" id="add_to_cart">Add To Cart</button>
	<input type="hidden" name="product_id" value="<?php echo($row['product_id']); ?>">
</center>
</form>
</div>

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
?>
<?php
}
}
?>
</div>

</section>

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


<!-- product section ends -->

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