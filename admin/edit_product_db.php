<!DOCTYPE HTML>
<html>
<head>
<title>
Display
</title>
<meta charset="utf-8">
</head>
<body>
<?php
if(isset($_FILES['productImage']) && $_POST["changeImageSuccess"]==1)
{
$errors= array();
$file_name = $_FILES['productImage']['name'];
$file_size =$_FILES['productImage']['size'];
$file_tmp =$_FILES['productImage']['tmp_name'];
$file_type=$_FILES['productImage']['type'];
$file_image=addslashes(file_get_contents($file_tmp));
$file_ext=explode('.',$file_name);
$fileext=strtolower(end($file_ext));
$extensions= array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)=== true)
{
$errors[]="Extension not allowed, please choose a JPEG or JPG or PNG file.";
}
if($file_size > 2097152)
{
$errors[]='File size must be excately 2 MB';
}
if(empty($errors)==true)
{
move_uploaded_file($file_tmp,"productImages/".$file_name);
}
else
{
print_r($errors);
}
}
$productName=$_POST['pname'];
$productBrand=$_POST['pbrand'];
$productCategory=$_POST['pcategory'];
$productQuantity=$_POST['pquantity'];
$productcPrice=$_POST['pcprice'];
$productsPrice=$_POST['psprice'];
$productDiscount=$_POST['pdiscount'];
$productdAmount=$_POST['pdamount'];
$productdPrice=$_POST['pdprice'];
$productDescription=$_POST['pdescription'];
date_default_timezone_set('Asia/Calcutta'); 
$currentDateTime=date("Y-m-d H:i:s");
// Database Connection
$servername = "localhost";
$username = "root"; //default user name is root
$password = ""; //default password is blank
$conn = new mysqli($servername, $username, $password,'Stationary');
if($conn->connect_error)
{
die("Connection Failed : ".$conn->connect_error);
}
else
{
$pid=$_POST['productId'];
$update = $conn->query("
UPDATE items SET
category_id='$productCategory',
pname='$productName',
pbrand='$productBrand',
pdescription='$productDescription',
pquantity='$productQuantity',
cprice='$productcPrice',
sprice='$productsPrice',
discount='$productDiscount',
damount='$productdAmount',
dprice='$productdPrice',
date_created='$currentDateTime'
WHERE
product_id='$pid';
");

if($_POST["changeImageSuccess"]==1)
{
$update_image = $conn->query("UPDATE items SET pImage_path='$file_name', pImage='$file_image' WHERE product_id='$pid'");
}

header("location: view_product.php");
$conn->close();
}
?>
</body>
</html>