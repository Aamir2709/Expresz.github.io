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
if(isset($_FILES['productImage']))
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
$product_count=$query="SELECT COUNT(*) FROM items";
$insert = $conn->query("INSERT into items (category_id,pname,pbrand,pdescription,pquantity,cprice,sprice,discount,damount,dprice,pimage_path,pImage,date_created) VALUES ('$productCategory', '$productName','$productBrand','$productDescription','$productQuantity','$productcPrice','$productsPrice','$productDiscount','$productdAmount','$productdPrice','$file_name','$file_image','$currentDateTime')");
header("location: view_product.php");
$conn->close();
}
?>
</body>
</html>