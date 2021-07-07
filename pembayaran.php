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
<title>The Crown Cafe : Payment</title>
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

<h2>Konfirmasi Pembayaran</h2>

<h3>Senilai Rp. <?php echo number_format($detpem["total_bayar"]); ?></h3>

<p>Konfirmasi pembayaran anda dengan mengisi form dibawah ini.</p>

<form method="post" class="form" enctype="multipart/form-data">

	<div class="form-group">
	<label>Nama Pengirim: </label> <br>
	<input type="text" class="form-control" name="nama">
	</div>

	<div class="form-group">
	<label>Bank: </label> <br>
	<input type="text" class="form-control" name="bank">
	</div>

	<div class="form-group">
	<label>Total Pembayaran: </label> <br>
	<input type="number" class="form-control" name="jumlah" min="1">
	</div>

	<div class="form-group">
	<label>Bukti Pembayaran: </label> <br>
	<input type="file" class="form-control" name="bukti">
	</div>

	<div class="caution">
	<p>Foto harus dengan format JPG max. 2MB</p> <br><br>
	</div>

	<button class="tombolh" name="kirim">Kirim Konfirmasi Pembayaran</button>

</form>

<?php
if (isset($_POST["kirim"]))
{
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");


	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES('$idpem','$nama','$bank','$jumlah','$tanggal','$namafix') ");

	//update data pembelian
	$koneksi->query("UPDATE pembelian SET status_pembelian='Telah Dibayar' WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terimakasih telah melakukan konfirmasi pembayaran.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
</div>

<?php include 'kaki.php'; ?>

</body>
</html>