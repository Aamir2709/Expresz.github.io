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
$categoryName=$_POST['cname'];
$categoryDescription=$_POST['cdescription'];
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
$insert_category = $conn->query("INSERT into categories (name,description) VALUES ('$categoryName','$categoryDescription')");
header("location: view_category.php");
$conn->close();
}
?>
</body>
</html>