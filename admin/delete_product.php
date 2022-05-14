<!DOCTYPE HTML>
<html>
<head>
<title>
Delete Product
</title>
<meta charset="utf-8">
</head>
<body>
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
else
{
$pid=$_POST['delete_product_id'];
$delete_product=$conn->query("DELETE FROM items WHERE product_id='$pid'");
header("location: view_product.php");
$conn->close();
}
?>
</body>
</html>