<?php
session_start();
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

// jika blm ada pembayaran
if(empty($detbay))
{
	echo "<script>alert('Belum ada pembayaran yang dilakukan.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

// jika data pembayaran tidak sesuai dengan login
if($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"])
{
	echo "<script>alert('Akses tidak diperbolehkan.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Payment Detail</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<style>
.page {
position: relative;
width: 70%;
height: auto;
padding: 1%;
margin-bottom :5%;
margin-top :5%;
margin-left:27%;
}

.page h2 {
font-family: Times new roman;
text-align: left;
}

.page p {
font-family: Times new roman;
text-align: left;
margin-bottom: 2%;
}

.image img {
position: absolute;
margin-left: 0%;
}

.page img {
position: absolute;
width: 400px;
}

.table {
border: none;
width: 50%;
margin-bottom: 50%;
margin-top: 2%;
margin-left: 45%;
}

.table th{
background-color: #606060;
text-align: left;
padding: 1%;
border: none;
color: white;
font-size: 14px;
margin-left: 10px;
}

.table td{
background-color: white;
padding: 2%;
border-bottom: 2px solid black;
font-size: 14px;
height	: auto;
}

.rata{
padding-left: 10px;
}

.tengah{
text-align: center;
}
</style>



<?php include 'menu.php'; ?>

<div class="image">
<img src="header/blossom-6.png" width="550px">
</div>

<div class="page">
<h2>Detail Pembayaran</h2>
<p>Berikut adalah rincian pembayaran yang telah anda lakukan.</p>

<img src="bukti_pembayaran/<?php echo $detbay["bukti"]; ?>">
<table class="table" border="1" width="100%">
	<tr>
		<th width="30%" >Nama Pengirim</th>
		<td class="rata"><?php echo $detbay["nama"]; ?></td>
	</tr>
        <tr>
		<th>Bank</th>
		<td><?php echo $detbay["bank"]; ?></td>
	</tr>
        <tr>
		<th>Total</th>
		<td class="rata">Rp. <?php echo number_format($detbay["jumlah"]); ?></td>
	</tr>
        <tr>
		<th>Tanggal Pembayaran</th>
		<td class="rata"><?php echo date("d F Y",strtotime($detbay["tanggal"])); ?></td>
	</tr>
</table>

</div>

<?php include 'kaki.php'; ?>

</body>
</html>