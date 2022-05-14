<!DOCTYPE HTML>
<html>
<head>
<title>
Delete Category
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
$cid=$_POST['delete_category_id'];
$delete_product=$conn->query("DELETE FROM categories WHERE id='$cid'");

header("location: view_category.php");
$conn->close();
}
?>
</body>
</html>