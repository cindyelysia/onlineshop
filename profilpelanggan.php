<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Akses tidak diperbolehkan.');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.profil {
position: relative;
width: 50%;
height: auto;
padding: 2%;
margin-bottom :3%;
margin-top :3%;
margin-left:22%;
box-shadow: 2px 2px 3px 3px grey;
}

.foto {
position: relative;
margin-left: 36%;
margin-top: 9px;
}

.foto img {
width : 200px;
border-radius: 50%;
}

.isiprofil {
margin-top: 20px;
}

table {
width: 100%;
margin-bottom: 2%;
}

table tr th {
background-color: white;
padding: 1%;
border-bottom: 1px solid black;
color: black;
font-size: 14px;
width:18%;
text-align: left;
}

table tr td {
background-color: white;
border-bottom: 1px solid black;
padding: 1%;
font-size: 14px;
height	: auto;
margin-left: 10px;
}

.editprofil a{
border: none;
padding-top:1%;
padding-bottom:1%;
padding-left:2%;
padding-right:2%;
background-color: #CC0066;
color: white;
margin-left: 85%;
margin-top: 5%;
text-align: center;
text-decoration: none;
}

.editprofil a:hover {
background-color: #606060;
}
</style>

<?php include 'menu.php' ?>

<div class="profil">
<?php
$id = $_SESSION["pelanggan"]["id_pelanggan"];
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$data = $ambil->fetch_assoc();
?>

<?php if(isset($_SESSION["pelanggan"])): ?>
<?php $jk = $_SESSION["pelanggan"]["jk_pelanggan"]; ?>
<?php if($jk=="Perempuan"): ?>
<div class="foto">
<img src="avatar/female.jpg">
</div>
<?php else: ?>
<div class="foto">
<img src="avatar/male.jpg">
</div>
<?php endif ?>
<?php endif ?>

<div class="isiprofil">
<table>
<thead>
<tr>
<th>Nama Lengkap</th>
<td><?php echo $data["nama_pelanggan"]; ?></td>
</tr>

<tr>
<th>Jenis Kelamin</th>
<td><?php echo $data["jk_pelanggan"]; ?></td>
</tr>

<tr>
<th>No.Telepon</th>
<td><?php echo $data["telepon_pelanggan"]; ?></td>
</tr>

<tr>
<th>Alamat Lengkap</th>
<td><?php echo $data["alamat_pelanggan"]; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $data["email_pelanggan"]; ?></td>
</tr>

</thead>
</table>

<div class="editprofil">
<a href="editprofil.php">Edit Profil</a>
</div>
</div>

</div>

<?php include 'kaki.php' ?>

</body>
</html>