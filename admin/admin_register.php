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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin  Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8516d77cbd.js" crossorigin="anonymous"></script>

<style type="text/css">

body
{
background-image: linear-gradient(rgba(60,179,113,0.1), rgba(0,0,0,0.4)),url('images/lr.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
background-position: center;
}

.form_heading
{
color: black;
background-color: darkgreen;
border-radius: 12px 12px 0px 0px;
padding: 6px;
}

.form_heading *
{
vertical-align: middle;
}

.form_border
{
padding: 0px;
margin: 0px;
display: inline;
border-radius: 12px;
box-shadow: 2px 2px 20px 0px green;
background-color: rgba(255,255,255,0.8);
text-align: left;
border-top : none;
}

.field_heading
{
width : 170px;
display: inline-block;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-size: 22px;
font-family: fantasy;
margin-left: 6px;
text-align: center;
}

.field
{
width: 535px;
padding: 8px 8px;
margin: 8px 8px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: 900;
font-size: 18px;
}

.field::placeholder
{
color: navy;
font-weight: bold;
}

input:focus
{
background-color: lightgreen;
}

input:focus::placeholder
{
color: transparent;
}

#gender_heading
{
width : 170px;
display: inline-block;
margin: 0px 8px 0px 0px;
width: 180px;
text-align: center;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-size: 22px;
font-family: fantasy;
}

.gender_type
{
margin: 0px 40px 0px 2px;
padding: 5px;
width: 66px;
text-align: center;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: bold;
font-size: 20px;
}

.select_choice
{
width: 21.9%;
padding: 4px 4px;
margin: 8px 10px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: bold;
font-size: 18px;
}

.select_choice::placeholder
{
color: navy;
font-weight: bold;
}

.select_choice:focus
{
background-color: lightgreen;
}


.address *
{
vertical-align: middle;
}

#address_heading
{
display: inline-block;
width : 185px;
text-align: center;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-size: 22px;
font-family: fantasy;
}

#address_field
{
margin-right: 20px;
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-size: 18px;
font-weight: 900;
}

#address_field::placeholder
{
color: navy;
font-weight: bold;
}

#address_field:focus
{
background-color: lightgreen;
}

#address_field:focus::placeholder
{
color: transparent;
}

#submit_button
{
width: 200px;
letter-spacing: 3px;
text-transform: uppercase;
color: honeydew;
background-image: linear-gradient(90deg,green,greenyellow);
border-style: solid;
border-width: 3px;
border-radius: 15px 0px 0px 15px;
border-color: navy;
box-shadow: inset 0 0 0 0 azure;
transition: ease-out 0.5s;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#submit_button:hover
{
color: darkolivegreen;
cursor: pointer;
border-width: 3px;
border-radius: 15px 0px 0px 15px;
border-color: darkgreen;
box-shadow: inset -300px 0 0 0 honeydew;
}

#reset_button
{
width: 200px;
letter-spacing: 3px;
text-transform: uppercase;
color: honeydew;
background-image: linear-gradient(90deg,greenyellow,green);
border-style: solid;
border-width: 3px;
border-radius: 0px 15px 15px 0px;
border-color: navy;
box-shadow: inset 0 0 0 0 azure;
transition: ease-out 0.3s;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#reset_button:hover
{
color: darkolivegreen;
cursor: pointer;
border-width: 3px;
border-radius: 0px 15px 15px 0px;
border-color: darkgreen;
box-shadow: inset 300px 0 0 0 honeydew;
}

h2
{
display: inline;
letter-spacing: 2px;
color: darkgreen;
text-shadow: 2px 2px 10px greenyellow;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#login
{
color: navy;
text-shadow: 2px 2px 10px yellow;
font-weight: 900;
font-size: 22px;
font-family: arial;
}

#uploadfile
{
border-style: solid;
border-width: 2px 4px;
border-radius: 15px;
border-color: green;
box-sizing: border-box;
color: navy;
background-color: honeydew;
font-weight: 700;
font-size: 18px;
margin: 0px 0px 0px 10px;
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

#login_icon
{
margin-left: 0px;
margin-right: 0px;
font-size: 30px;
color: black;
}

#logout_icon
{
margin-left: 0px;
margin-right: 0px;
font-size: 30px;
color: black;
border: 3px solid red;
}

@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

:root{
  --green:#27ae60;
  --black:#2c2c54;
}

*{
  font-family: 'Nunito', sans-serif;
  margin:0; 
padding:0;
  box-sizing: border-box;
  outline: none; 
border:none;
  text-decoration: none;
}

*::selection{
  background:var(--green);
  color:#fff;
}

html{
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-padding-top: 6.5rem;
  scroll-behavior: smooth;
}

.header-1{
  background:#eee;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding:2rem 9%;
}

.logo{
  color:var(--black);
  font-weight: bolder;
  font-size: 3rem;
}

.logo i{
  padding-right: .5rem;
  color:var(--green);
}

.header-1 .search-box-container{
  display: flex;
  height:5rem;
}

.header-1 .search-box-container #search-box{
  height: 100%;
  width:100%;
  padding:1rem;
  font-size: 2rem;
  color:#333;
  border:.1rem solid rgba(0,0,0,.3);
  text-transform: none;
}

.header-1 .search-box-container label{
  height: 100%;
  width:8rem;
  font-size: 2.5rem;
  line-height: 5rem;
  color:#fff;
  background:var(--green);
  text-align: center;
  cursor: pointer;
}

.header-1 .search-box-container label:hover{
  background:var(--black);
}


#menu-bar{
  font-size: 3rem;
  border-radius: .5rem;
  border:.1rem solid var(--black);
  padding:.8rem 1.5rem;
  color:var(--black);
  cursor: pointer;
  display: none;
}

#card_count
{
text-align: center; 
padding: 0px 5px 0px 5px; 
color: white:
}

.header-2{
  background:#fff;
  display: flex;
  align-items: center;
  justify-content: center;
  padding:2rem 9%;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
  position: relative;
}

.header-2.active{
  position: fixed;
  top:0; left: 0; right:0;
  z-index: 10000;
}

.header-2 .navbar a{
  padding:.5rem 1.5rem;
  font-size: 2rem;
  border-radius: .5rem;
  color:var(--black);
}

.header-2 .navbar a:hover{
  background:var(--green);
  color:#fff;
}

.header-2 .icons a{
  font-size: 2.5rem;
  color:var(--black);
  padding-left: 1rem;
}

.header-2 .icons a:hover{
  color:var(--green);
}

</style>

<script type="text/javascript">
function form_validation()
{
var valid=true;
var name_success=1;
var password_success=1;
var cpassword_success=1;
var email_success=1;
var phone_success=1;
var gender_success=1;
var dob_success=1;
var address_success=1;
var name=document.rform.uname.value;
var password=document.rform.upassword.value;
var confirm_password=document.rform.cupassword.value;
var email_id=document.rform.uemail.value;
var a_position=email_id.indexOf("@");
var dot_position=email_id.lastIndexOf(".");
var phone_no=document.rform.uphone.value;
var male=document.rform.gender[0].checked;
var female=document.rform.gender[1].checked;
var other=document.rform.gender[2].checked;
var day=document.rform.days.value;
var month=document.rform.months.value;
var year=document.rform.years.value;
var address=document.rform.address.value;
if (name=="")
{
alert("Please enter your Name!");
name_success=0;
valid=false;
}
if (password=="")
{
alert("Please enter new Password!");
password_success=0;
valid=false;
}
else if ((password.length<8) || (password.length>15))
{
alert("Password length should be between 8 - 15 characters!\nPlease re-enter your password in 'Password' box!");
password_success=0;
valid=false;
}
if (confirm_password=="")
{
alert("Please re-enter your Password!");
cpassword_success=0;
valid=false;
}
else if ((confirm_password.length<8) || (confirm_password.length>15))
{
alert("Password length should be between 8 - 15 characters!\nPlease re-enter your password in 'Confirm Password' box!");
cpassword_success=0;
valid=false;
}
if (password!=confirm_password)
{
alert("Error!, Password doesn't match.\nPlease re-enter your password in 'Confirm Password' box!");
cpassword_success=0;
valid=false;
}
if (email_id=="")
{
alert("Please enter your Email-Id!");
email_success=0;
valid=false;
}
else if ((a_position==-1) || (dot_position==-1))
{
alert("Please enter a valid Email-Id!");
email_success=0;
valid=false;
}
else if ((a_position < 1) || ((dot_position-a_position)<2))
{
alert("Please enter a valid Email-Id!");
email_success=0;
valid=false;
}
if (phone_no=="")
{
alert("Please enter your Phone-number!");
phone_success=0;
valid=false;
}
else if (isNaN(phone_no))
{
alert("Characters are not allowed!\nPlease enter a valid Phone-number!\nPhone-number must contain 10 numbers in it.");
phone_success=0;
valid=false;
}
else if (phone_no.length<10 || phone_no.length>10)
{
alert("Please enter a valid Phone-number!\nPhone-number must contain 10 numbers in it.");
phone_success=0;
valid=false;
}
if (male==false && female==false && other==false)
{
alert("Please choose your Gender! ( Male or Female or Other )");
gender_success=0;
valid=false;
}
if (day=='day' || month=='month' || year=='year')
{
alert("Please enter your Date-Of-Birth!");
dob_success=0;
valid=false;
}
if (address=="")
{
alert("Please enter your Address!");
address_success=0;
valid=false;
}
if(name_success==1 && password_success==1 && cpassword_success==1 && email_success==1 && phone_success==1 && gender_success==1 && dob_success==1 && address_success==1)
{
alert("You are successfully registered!");
}
return valid;
}
</script>

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
            <a href="index.php"><i class="fa-solid fa-house"></i></a>
            <a class="current_button" href="admin_register.php" style="margin-right: 35px;">Register</a>
<?php
if(isset($_SESSION['username']))
{
?>
<div class="tooltip">
            <a href="admin_logout.php" class="fas fa-user-circle" id="logout_icon"></a>
            <span class="tooltiptext">Logout</span>
        </div>
            <label for="login_username" id="login_username"><b style="font-size: 14px; color: blue;"><?php echo($_SESSION['username']); ?></b></label> 
<?php
}
else
{
?>
<div class="tooltip">
            <a href="admin_login.php" class="fas fa-user-circle" id="login_icon"></a>
            <span class="tooltiptext">Admin Login</span>
</div>
<?php
}
?>
        </nav>

</div>

</header>
<br>
<br>
<div align="center">
<form action="admin_registration_db.php" method="post" name="rform" onsubmit="return form_validation();" enctype="multipart/form-data">
<fieldset class="form_border">
<div class="form_heading">
<img style="padding: 0px 90px 0px 0px; width: 200px; height: 100px;" src="images/register.png">
<label style="width: 400px; color: white;  text-align: center; font-size: 40px; font-variant: small-caps; font-family: Arial;"><b>Registration Form</b></label>
</div>
<br>
<br>
<label class="field_heading">Name</label>
	<input type="text" class="field" name="uname" placeholder="Enter your Name!">
<br>
<br>
<label class="field_heading">E-mail ID</label>
	<input type="text" class="field" name="uemail" placeholder="Enter your Email-Id!">
<br>
<br>
<label class="field_heading">Password</label>
	<input type="text" class="field" name="upassword" placeholder="Enter your Password!" onkeydown="keyDown(this)" onkeypress="keyPress(this)" onkeyup="keyUp(this)">
<br>
<br>
<label class="field_heading">Confirm Password</label>
	<input type="text" class="field" name="cupassword" placeholder="Re-enter Password!" onkeydown="keyDown(this)" onkeypress="keyPress(this)" onkeyup="keyUp(this)">
<script type="text/javascript">
function keyDown(n)
{
n.style.webkitTextSecurity="none";
}
function keyPress(n)
{
n.style.webkitTextSecurity="none";
}
function keyUp(n)
{
n.style.webkitTextSecurity="disc";
}
</script>
<br>
<br>
<label class="field_heading">Phone Number</label>
	<input type="text" class="field" name="uphone" placeholder="Enter your Phone Number!">
<br>
<br>
<label id="gender_heading">Gender</label>
	<input type="radio" name="gender" value="Male" id="male">
	<label class="gender_type" for="male" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)">Male</label>

	<input type="radio" name="gender" value="Female" id="female">
	<label class="gender_type" for="female" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)">Female</label>

	<input type="radio" name="gender" value="Other" id="other">
	<label class="gender_type" for="other" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)">Other</label>
<script type="text/javascript">
function mouseDown(g)
{
g.style.borderStyle="solid";
g.style.borderWidth="2px 4px";
g.style.borderRadius="15px";
g.style.borderColor="green";
g.style.backgroundColor="lightgreen";
g.style.color="navy";
}
function mouseUp(g) 
{
g.style.borderStyle="solid";
g.style.borderWidth="2px 4px";
g.style.borderRadius="15px";
g.style.borderColor="green";
g.style.backgroundColor="honeydew";
g.style.color="navy";
}
</script>
<br>
<br>
<label class="field_heading">Date-Of-Birth</label>
<select class="select_choice" name="days">
	<option value="day">Day</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
</select>
<select class="select_choice" name="months">
	<option value="month">Month</option>
	<option value="01">January</option>
	<option value="02">February</option>
	<option value="03">March</option>
	<option value="04">April</option>
	<option value="05">May</option>
	<option value="06">June</option>
	<option value="07">July</option>
	<option value="08">August</option>
	<option value="09">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">December</option>
</select>
<select class="select_choice" name="years">
	<option value="year">Year</option>
	<option value="2022">2022</option>
	<option value="2021">2021</option>
	<option value="2020">2020</option>
	<option value="2019">2019</option>
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
	<option value="2005">2005</option>
	<option value="2004">2004</option>
	<option value="2003">2003</option>
	<option value="2002">2002</option>
	<option value="2001">2001</option>
	<option value="2000">2000</option>
	<option value="1999">1999</option>
	<option value="1998">1998</option>
	<option value="1997">1997</option>
	<option value="1996">1996</option>
	<option value="1995">1995</option>
	<option value="1994">1994</option>
	<option value="1993">1993</option>
	<option value="1992">1992</option>
	<option value="1991">1991</option>
	<option value="1990">1990</option>
	<option value="1989">1989</option>
	<option value="1988">1988</option>
	<option value="1987">1987</option>
	<option value="1986">1986</option>
	<option value="1985">1985</option>
	<option value="1984">1984</option>
	<option value="1983">1983</option>
	<option value="1982">1982</option>
	<option value="1981">1981</option>
	<option value="1980">1980</option>
	<option value="1979">1979</option>
	<option value="1978">1978</option>
	<option value="1977">1977</option>
	<option value="1976">1976</option>
	<option value="1975">1975</option>
	<option value="1974">1974</option>
	<option value="1973">1973</option>
	<option value="1972">1972</option>
	<option value="1971">1971</option>
	<option value="1970">1970</option>
	<option value="1969">1969</option>
	<option value="1968">1968</option>
	<option value="1967">1967</option>
	<option value="1966">1966</option>
	<option value="1965">1965</option>
</select>
<br>
<br>
<br>
<p class="address">
<label id="address_heading">Address</label>
	<textarea  id="address_field" name="address" cols="42"  rows="4" placeholder=" Enter your Address!"></textarea>
</p>
<br>
<br>
<label class="field_heading">Profile Photo</label>
        <input type="file" name="profileImage" id="uploadfile">
<br>
<br>
<br>
<br>
<br>
<div class="container" align="center">
	<input id="submit_button" type="submit" name="submit" value="Submit">
	<input type="hidden" name="register_success" value="1">
	<button type="button" id="reset_button" name="reset" onclick="rform_reset();">Reset</button>
<script type="text/javascript">
document.rform.name.focus();
function rform_reset()
{
document.rform.uname.value="";
document.rform.upassword.value="";
document.rform.cupassword.value="";
document.rform.uemail.value="";
document.rform.uphone.value="";
document.rform.gender[0].checked=false;
document.rform.gender[1].checked=false;
document.rform.gender[2].checked=false;
document.rform.days.value="day";
document.rform.months.value="month";
document.rform.years.value="year";
document.rform.english.checked=false;
document.rform.hindi.checked=false;
document.rform.marathi.checked=false;
document.rform.telgu.checked=false;
document.rform.tamil.checked=false;
document.rform.address.value="";
document.rform.uname.focus();
}
</script>

<br>
<br>
<br>
<h2 id="text" onmousedown="mouse_Down();" onmouseup="mouse_Up();">Already Registered? - </h2><a id="login" href="admin_login.php">Login</a>
<script type="text/javascript">
function mouse_Down()
{
document.getElementById("text").style.color="red";
}
function mouse_Up() 
{
document.getElementById("text").style.color="purple";
}
</script>
<br>
<br>
<br>
</div>
</fieldset>
</form>
</div>
<br>
<br>
</body>
</html>