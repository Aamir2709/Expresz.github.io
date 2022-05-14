<?php
session_start();
?>

<DOCTYPE HTML>
<HTML>
</HEAD>
<TITLE>
Order Invoice
</TITLE>

<style type="text/css">

#logo
{
color: green;
}

.stationary_logo
{
width: 150px;
height: 150px;
}

#invoice_heading
{
border: 4px solid darkgreen;
padding: 10px 400px 10px 400px; 
font-size: 28px;
font-weight: 900;
}

#oid
{
border: 4px solid darkgreen;
border-left: none;
font-size: 20px;
font-weight: 900;
}

#stationary_heading
{
border: 4px solid darkgreen;
border-top: none;
font-size: 40px;
font-weight: 900;
}

#plist
{
padding: 10px;
border: 4px solid darkgreen;
border-top: none;
color: darkgreen;
font-size: 24px;
font-weight: 700;
text-align: center;
}

#name
{
padding: 10px;
border: 4px solid darkgreen;
border-top: none;
border-right: none;
font-size: 22px;
font-weight: 600;
}

#date_time
{
padding-right: 10px;
border: 4px solid darkgreen;
border-top: none;
border-left: none;
text-align: right;
font-size: 22px;
font-weight: 600;
}

.column_name
{
padding: 5px;
border: 3px solid darkgreen;
border-top: none;
border-left: none;
font-size: 20px;
font-weight: 700;
}

.number
{
padding: 5px;
border: 2px solid darkgreen;
border-top: none;
border-left: none;
text-align: center;
font-size: 20px;
font-weight: 600;
}

#pname
{
padding: 5px;
border: 2px solid darkgreen;
border-top: none;
border-left: none;
font-size: 20px;
font-weight: 600;
}

#signature
{
padding-bottom: 10px;
border-left: none;
border-right: 4px solid darkgreen;
border-top: none;
border-bottom: 4px solid darkgreen;
text-align: center;
font-size: 24px;
font-weight: 900;
}

#total_price
{
border: 4px solid darkgreen;
border-top: 4px solid darkgreen;
color: green;
text-align: center;
font-size: 28px;
font-weight: 900;
}
</style>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>

</HEAD>
<BODY>
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
?>

<?php
$order_date=$_GET['odate'];
$query1="SELECT * FROM customer_order WHERE date_time='$order_date'";
$query_run1=mysqli_query($conn,$query1);
while($row1=mysqli_fetch_array($query_run1))
{
$oid=$row1['order_id'];
$uid=$row1['user_id'];
$uname=$row1['username'];
$odt=$row1['date_time'];
?>
<br>
<br>
<br>
<br>
<center>
<table border="1" cellspacing="0" style="background-color: snow;">
<tr>
<th colspan="4" id="invoice_heading">Invoice</th>
<th id="oid">Order-Id : <?php echo($oid); ?></th>
</tr>
<tr>
<td colspan="4" id="stationary_heading">
<div align="center">
<i id="logo" class="fa-solid fa-pen-ruler fa-1x"></i> Expresz Stationary
</div>
</td>
<td style="border-bottom: 4px solid darkgreen; border-right: 4px solid darkgreen;"><img class="stationary_logo" src="images/stationary_logo.jpeg"></td>
</tr>
<tr>
<td colspan="2" id="name">Name : <?php echo($uname); ?></td>
<td colspan="3" id="date_time">Date-Time : <?php echo($odt); ?></td>
</tr>
<tr>
<td colspan="6" id="plist">Products Ordered List</td>
</tr>
<tr>
<th class="column_name"  style="border-left: 4px solid darkgreen;">Sr_No</th>
<th class="column_name">Product-Id</th>
<th class="column_name">Name</th>
<th class="column_name">Quantity</th>
<th class="column_name" style="border-right: 4px solid darkgreen;">Per-Price</th>
</tr>
<?php
$pcount=0;
$query2="SELECT * FROM products_ordered WHERE order_id='$oid'";
$query_run2=mysqli_query($conn,$query2);
while($row2=mysqli_fetch_array($query_run2))
{
$pcount=$pcount+1;
$pid=$row2['product_id'];
$query3="SELECT * FROM items WHERE product_id='$pid'";
$query_run3=mysqli_query($conn,$query3);
while($row3=mysqli_fetch_array($query_run3))
{
?>
<tr>
<td class="number"  style="border-left: 4px solid darkgreen;"><?php echo($pcount); ?></td>
<td class="number"><?php echo($row3['product_id']); ?></td>
<td id="pname"><?php echo($row3['pname']); ?></td>
<td class="number"><?php echo($row3['pquantity']); ?></td>
<td class="number" style="border-right: 4px solid darkgreen;"><?php echo($row3['dprice']); ?></td>
</tr>
<?php
}
}
?>
<tr>
<td colspan="4" rowspan="2" id="total_price">Total Price <?php echo($row1['total_price']); ?></td>
<th style="border-right: 4px solid darkgreen; border-top: 4px solid darkgreen; border-bottom: none;"><img style="width: 80px; height: 80px;" src="images/signature.png"></th>
</tr>
<tr>
<td id="signature">Signature</td>
</tr>
<?php
}
}
?>

</table>
</center>
</BODY>
</HTML>