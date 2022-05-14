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
$update1=$conn->query("UPDATE items SET pImage_path='$file_name' WHERE product_id=32");
$update2=$conn->query("UPDATE items SET pImage='$file_image' WHERE product_id=32");

$count=1;
for($i=1;$i<=63;$i++)
{
if($i==4 || $i==5)
{
continue;
}
$update_pid=$conn->query("UPDATE items SET product_id='$count' WHERE product_id='$i'");
$count=$count+1;

$query="SELECT * FROM items";
$query_run=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($query_run))
{
echo '<img src="data:image;charset=utf8;base64,'.base64_encode($row["pImage"]).' " alt="Product Image" style="width: 400px; height:400px;"></image>';
echo "<br>";
}
echo("Product added successfully!");
$conn->close();
}
?>
</body>
</html>