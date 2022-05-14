<!doctype html>
<html>
<head>
<title>
Login Form
</title>
</head>
<body onload="myFunction()">
<?php

if(isset($_POST['submit']))
{
// Database Connection
$servername = "localhost";
$username = "root"; //default user name is root
$password = ""; //default password is blank
$connection = new mysqli($servername, $username, $password,'Stationary');
if($connection->connect_error)
{
die("Connection Failed : ".$conn->connect_error);
}
else
{
$success_login=0;
$success_username=0;
$success_password=0;
$query="SELECT user_id,username,password FROM admin_registration";
$query_run=mysqli_query($connection,$query);

while($row=mysqli_fetch_array($query_run))
{
$myname=$row["username"];
$mypassword=$row["password"];
$name=$_POST['uname'];
$password=$_POST['upassword'];
if($name==$myname and $password==$mypassword)
{
$userId=$row['user_id'];
$userName=$_POST['uname'];
$userPassword=$_POST['upassword'];
date_default_timezone_set('Asia/Calcutta'); 
$currentDateTime=date("Y-m-d H:i:s");
$insert = $connection->query("INSERT into admin_login (user_id,username,password,date_time) VALUES ('$userId','$userName', '$userPassword','$currentDateTime')");
$success_login=1;
$success_username=1;
$success_password=1;
if(isset($_POST['remember']))
{
setcookie('username', $name, time()+60*60*1);
setcookie('password', $password, time()+60*60*1);
}
session_start();
$_SESSION['username']=$name;
$_SESSION['uid']=$userId;
header("location: index.php");
break;
} 
else if($name==$myname)
{
$success_username=1;
}
else if($password==$mypassword)
{
$success_password=1;
}
}

if($success_login==0)
{
if($success_username==0 && $success_password==0)
{
echo "<script>
function myFunction() 
{
alert('Sorry ".$name."!'+'\\n'+'Your Username or Password is Incorrect!'+'\\n'+'Please Try Again!');
window.location.replace('http://localhost:7882/project/login.php');
} 
setTimeout('myFunction()', 10000);
</script>";
}
else if($success_username==0)
{
echo "<script>
function myFunction() 
{
alert('Sorry ".$name."!'+'\\n'+'Your Username is Incorrect!'+'\\n'+'Please Try Again!');
window.location.replace('http://localhost:7882/project/login.php');
} 
setTimeout('myFunction()', 10000);
</script>";
}
else if($success_password==0)
{
echo "<script>
function myFunction() 
{
alert('Sorry ".$name."!'+'\\n'+'Your Password is Incorrect!'+'\\n'+'Please Try Again!');
window.location.replace('http://localhost:7882/project/login.php');
} 
setTimeout('myFunction()', 10000);
</script>";
}
}
$connection->close();
}
}
else 
{
header("location: login.php");
}
?>
</body>
</html>
