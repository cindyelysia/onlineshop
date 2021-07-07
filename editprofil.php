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
.editprofil {
position: relative;
width: 50%;
height: auto;
padding: 2%;
margin-bottom :3%;
margin-top :3%;
margin-left:22%;
box-shadow: 2px 2px 3px 3px grey;
}

.editprofil h2 {
font-family: Times new roman;
text-align: center;
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
margin-top: 10px;
}

table {
width: 100%;
margin-bottom: 2%;
}

table tr th {
background-color: white;
padding: 1%;
border-top: 1px solid black;
color: black;
font-size: 14px;
width:18%;
text-align: left;
}

table tr td {
background-color: white;
font-size: 14px;
height	: auto;
margin-left: 10px;
}

input, select {
width: 100%;
padding: 1%;
}

button {
border: none;
padding-top:1%;
padding-bottom:1%;
padding-left:2%;
padding-right:2%;
background-color: #CC0066;
color: white;
margin-left: 88%;
margin-top: 1%;
text-align: center;
}

button:hover {
background-color: #606060;
color: white;
}
</style>

<?php include 'menu.php' ?>

<div class="editprofil">

<?php
$id = $_SESSION["pelanggan"]["id_pelanggan"];
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$data = $ambil->fetch_assoc();
?>

<h2>Ubah Profil Anda</h2>

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
<form method="post" enctype="multipart/form-data">
<table>
<thead>
<tr>
<th>Nama Lengkap</th>
<td><input type="text" name="nama" value="<?php echo $data["nama_pelanggan"]; ?>"></td>
</tr>

<tr>
<th>Jenis Kelamin</th>
<td>
<select name="jk">
<?php if($data["jk_pelanggan"]=="Perempuan"): ?>
<option value="<?php echo $data["jk_pelanggan"]; ?>"><?php echo $data["jk_pelanggan"]; ?></option>
<option value="Laki-Laki">Laki-Laki</option>
<?php else: ?>
<option value="<?php echo $data["jk_pelanggan"]; ?>"><?php echo $data["jk_pelanggan"]; ?></option>
<option value="Perempuan">Perempuan</option>
<?php endif ?>
</select>
</td>
</tr>

<tr>
<th>No.Telepon</th>
<td><input type="number" name="telepon" value="<?php echo $data["telepon_pelanggan"]; ?>"></td>
</tr>

<tr>
<th>Alamat Lengkap</th>
<td><input type="text" name="alamat" value="<?php echo $data["alamat_pelanggan"]; ?>"></td>
</tr>
</thead>
</table>

<table>
<tr>
<th>Email</th>
<td><input type="text" name="email" value="<?php echo $data["email_pelanggan"]; ?>"></td>
</tr>
<th>Password</th>
<td><input type="text" name="password" value="<?php echo $data["password_pelanggan"]; ?>"></td>
</tr>
</table>

<button name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan']))
{

	$koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama]' ,jk_pelanggan='$_POST[jk]' ,telepon_pelanggan='$_POST[telepon]', alamat_pelanggan='$_POST[alamat]', email_pelanggan='$_POST[email]', password_pelanggan='$_POST[password]' WHERE id_pelanggan='$id'");

	echo "<script>alert('Perubahan profil telah disimpan.');</script>";
	echo "<script>location='profilpelanggan.php';</script>";
}
?>
</div>
</div>

<?php include 'kaki.php' ?>

</body>
</html>