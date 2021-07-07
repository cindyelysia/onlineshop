<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
*{
        margin: 0;
	padding: 0;
}

html{
    background-color	: white;
}

.headermenu ul {
list-style: none;
}

.headermenu {
  overflow: hidden;
  background-color: #CC0066;
}

.headermenu a {
  background-color: #CC0066;
  color: #FFFACD;
  float: left;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 18px;
  font-family: times new roman;
}

.headermenu a:hover {
  background-color: #FFFFCC;
  color: black;
}

.headertext {
  background-color: #FFFFCC;
  padding: 1%;
  font-family: times new roman;
  text-align: center;
  margin-bottom: 0%;
}

.cari{
margin-bottom: 2px;
margin-top: 11px;
width: 16%;
margin-left: 1%;
padding: 5px;
border:none;
}

.tombol{
width: 5%;
background-color: white;
color: black;
padding: 6px;
border: none;
margin-right: 1%;
}

.tombol:hover{
background-color: #FFFFCC;
color: black;
cursor: pointer;
}

.salam a {
position: absolute;
text-align: right;
margin-left: 72%;
margin-top: 15px;
color: white;
width: 17%;
text-decoration: none;
}

.ava {
position: absolute;
margin-left: 90%;
margin-top: 9px;
}

.ava img {
width: 30px;
border-radius: 50%;
}

.logout a {
position: absolute;
margin-left: 93%;
width: 5%;
background-color: #606060;
color: white;
padding: 6px;
margin-bottom: 3px;
margin-top: 8px;
text-align: center;
text-decoration: none;
font-size: 18px;
font-family: times new roman;
}

.logout a:hover {
box-shadow: 2px 2px 4px grey;
}
</style>

<?php if(isset($_SESSION["pelanggan"])): ?>
<div class="logout">	
<a href="logout.php">Logout</a>
<?php endif ?>
</div>

<?php if(isset($_SESSION["pelanggan"])): ?>
<?php $jk = $_SESSION["pelanggan"]["jk_pelanggan"]; ?>
<?php if($jk=="Perempuan"): ?>
<div class="ava">
<img src="avatar/female.jpg">
</div>
<?php else: ?>
<div class="ava">
<img src="avatar/male.jpg">
</div>
<?php endif ?>
<?php endif ?>

<div class="salam">
<?php if(isset($_SESSION["pelanggan"])): ?>
<a href="profilpelanggan.php"><h4><?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?> </h4></a>
<?php endif ?>
</div>

<div class="headermenu">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="keranjang.php">Cart</a></li>
<!-- jika sudah login  -->
<?php if(isset($_SESSION["pelanggan"])): ?>
<li><a href="riwayat.php">History</a></li>	
<!-- jika blm login-->
<?php else: ?>
<li><a href="login.php">Login</a></li>
<li><a href="register.php">Registration</a></li>
<?php endif ?>
</ul>

<form action="pencarian.php" method="get">
<input class="cari" type="text" name="keyword" placeholder=" Cari disini ...">
<input class="tombol" type="submit" value="Cari">
</form>
</div>


<div class="headertext">
<h1>The Crown Cafe</h1>
<p>Let me fill you!</p>
</div>

</body>
</html>