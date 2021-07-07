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

//mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];

//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if($id_pelanggan_login!==$id_pelanggan_beli)
{
	echo "<script>alert('Akses tidak dibolehkan.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Received</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.page{
position: relative;
width: 50%;
padding: 2%;
margin-bottom :3%;
margin-top :3%;
margin-left:3%;
}

.page h2 {
font-family: Times new roman;
text-align: left;
}

.page h3 {
font-family: Times new roman;
text-align: left;
}

.page p {
font-family: Times new roman;
text-align: justify;
margin-bottom: 3%;
padding-bottom: 2%;
border-bottom: 1px dashed black;
}

.image img {
margin-left: 819px;
position: absolute;
}

button{
background-color :#606060;
color: white;
text-decoration: none;
padding: 2%;
border: none;
margin-left: 71%;
margin-bottom: 4%;
}

button:hover{
background-color: #CC0066;
}

.form-group{
margin-bottom	: 2%;
margin-left	: 0%;
font-family	: times new roman;
}

.form-group2 {
margin-bottom	: 2%;
margin-left	: 0%;
font-family	: times new roman;
}

.form-control{
width		: 5%;
margin-top	: 10px;
}

input{
width		: 60%;
padding		: 3px;
margin-top	: 10px;
}

.caution {
width           : 50%;
}

.caution p {
color		:  #CC0066;
padding		: 1%;
text-align	: left;
font-family	: times new roman;
border: none;
}

</style>

<?php include 'menu.php'; ?>

<div class="image">
<img src="header/blossom-5.png" width="530px">
</div>

<div class="page">

<h2>Konfirmasi Penerimaan</h2>
<p>Konfirmasi bahwa anda telah menerima pesanan dengan mengisi form dibawah ini.</p>
<form method="post" class="form" enctype="multipart/form-data">

	<div class="form-group">
	<label>Nama Penerima: </label> <br>
	<input type="text" name="nama">
	</div>

	<div class="form-group">
	<label>Tanggal Terima: </label> <br>
	<input type="date" name="tgl">
	</div>

	<div class="form-group2">
	<label>Penilaian: </label> <br>
	<input type="checkbox" class="form-control" name="nilai" value="Sangat Baik">Sangat Baik <br>
   	<input type="checkbox" class="form-control" name="nilai" value="Baik">Baik <br>
	<input type="checkbox" class="form-control" name="nilai" value="Cukup Baik">Cukup Baik <br>
	<input type="checkbox" class="form-control" name="nilai" value="Kurang Baik">Kurang Baik
	</div>

	<div class="form-group">
	<label>Bukti Penerimaan: </label> <br>
	<input type="file" name="bukti">
	</div>

	<div class="caution">
	<p>Foto harus dengan format JPG max. 2MB</p> <br><br>
	</div>

	<button class="tombolh" name="kirim">Konfirmasi Penerimaan</button>

</form>

<?php
if (isset($_POST["kirim"]))
{
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_penerimaan/$namafix");


	$nama = $_POST["nama"];
	$tgl = $_POST["tgl"];
	$penilaian = $_POST["nilai"];

	$koneksi->query("INSERT INTO penerimaan(id_pembelian,nama_penerima,tanggal_terima,penilaian,bukti_terima) VALUES('$idpem','$nama','$tgl','$penilaian','$namafix') ");

	//update data pembelian
	$koneksi->query("UPDATE pembelian SET status_pembelian='Telah Diterima' WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terimakasih telah melakukan konfirmasi penerimaan.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
</div>

<?php include 'kaki.php'; ?>

</body>
</html>