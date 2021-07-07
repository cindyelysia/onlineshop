<?php
include 'koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Customer Bill</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<style>
.page {
position: relative;
width: 70%;
height: auto;
padding: %;
margin-top: 2%;
margin-bottom: 2%;
margin-left: 15%;
box-shadow: 2px 2px 3px 3px grey;
}

.page h1 {
font-family: Times new roman;
padding-bottom: 5px;
border-bottom: 3px dotted black;
}

.headertext {
  background-color: #FFFFCC;
  padding: 1%;
  font-family: times new roman;
  text-align: center;
  margin-bottom: 1%;
}

.detail{
    background-color	: transparent;
    position		: relative;
    width		: auto;
    height		: auto;
    margin-bottom	: 2%;
    margin-left: 2%;
    color: black;
}

.part1 {
    float: left;
    padding-right: %;
    margin-right: 2%;
    margin-bottom: 2%;
    width: 17%;
}

.part2 {
    float: left;
    padding-right: %;
    margin-right: 1%;
    margin-bottom: 2%;
    width: 34%;
}

.part3 {
    float: left;
    padding-right: %;
    margin-right: 1%;
    margin-bottom: 2%;
    width: 45%;
}



table {
margin-left: 2%;
width: 96%;
border:1px solid #606060;
border: none;
}

thead tr th {
border: 1px solid #606060;
padding: 10px;
}

tbody tr td {
border: 1px solid #606060;
padding: 10px;
}

tfoot tr td {
border: 1px solid #606060;
}

tfoot tr th {
border: 1px solid #606060;
padding: 10px;
}

.rata{
padding-left: 10px;
}

.tengah{
text-align: center;
}

.caution{
background-color: #FFFFCC;
padding: 2%;
text-align: center;
}

.cetak {
margin-left: 15%;
margin-bottom: 2%;
}

button, a {
background-color: #CC0066;
color: white;
border: none;
padding: 1%;
text-decoration: none;
}

button:hover, a:hover {
background-color :#606060;
}
</style>



<div class="page">
<div class="headertext">
<h1>Nota <br> The Crown Cafe.</h1>
<p>Jl.Delima, No.49, Lebak Bulus, Jakarta | 085888706218 | crowntoast@gmail.com</p>
</div>

<div class="detail">
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!-- jika pelanggan yg beli tidak sama dengan yg login, maka dilarikan ke riwayat.php -->
<!-- pelanggan yg beli harus yg login -->
<?php
//mendapatkan id pelanggan yg beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkanid pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if($idpelangganyangbeli!==$idpelangganyanglogin)
{
	echo "<script>alert('Akses tidak diperbolehkan.');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<div class="part1">
<h4>Detail Pelanggan </h4>
<?php echo $detail['nama_pelanggan']; ?> <br>
<?php echo $detail['email_pelanggan']; ?> <br>
<?php echo $detail['telepon_pelanggan']; ?>
</div>

<div class="part2">
<h4>Detail Pembelian </h4>
No.<?php echo $detail['id_pembelian']; ?> <br>
Pada tanggal <?php echo date("d F Y",strtotime($detail["tanggal_pembelian"])) ?> <br>
Dengan total pembelian senilai Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
* Total sebelum ongkos kirim
</div>

<div class="part3">
<h4>Detail Pengiriman</h4>
Dikirim ke <?php echo $detail['alamat_pelanggan']; ?> <br>
Kota <?php echo $detail['nama_kota']; ?> <br>
Dengan ongkos kirim senilai Rp. <?php echo number_format($detail['tarif']); ?> x berat <br>
* Pengiriman dilakukan oleh kurir kami.
</div>
</div>

<br>


<div class="table">
<table class="table" width="100%">
	<thead>
	<tr>
		<th width="40px">No.</th>
		<th width="200px">Menu</th>
		<th width="100px">Harga</th>
		<th width="50px">Jumlah</th>
		<th width="50px">Berat</th>
		<th width="100px">Subtotal</th>
	</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $totalberat = 0 ?>
		<?php $ambil = $koneksi->query("SELECT * from pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<?php $subtotal = $pecah['subharga']; ?>
		<?php $subberat = $pecah['subberat']; ?>
		<tr>
		<td class="tengah"><?php echo $nomor; ?></td>
		<td class="rata"><?php echo $pecah['nama']; ?></td>
		<td class="tengah">Rp. <?php echo number_format($pecah['harga']); ?></td>
		<td class="tengah"><?php echo $pecah['jumlah']; ?> </td>
		<td class="tengah"><?php echo $subberat; ?> </td>
		<td class="tengah">Rp. <?php echo number_format($subtotal); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php $totalberat+=$subberat; ?>
		<?php } ?>
		<?php $tarif = $totalberat*$detail["tarif"]; ?>
		<?php $totalbayar = $detail["total_pembelian"]+=$tarif; ?>
	</tbody>
	<tfoot>
		<tr>
		<th colspan="5">Total Berat</th>
		<td colspan="1" class="tengah"><?php echo number_format($totalberat); ?> gram</td>
		</tr>
		<tr>
		<th colspan="5">Ongkos Kirim</th>
		<td colspan="1" class="tengah">Rp. <?php echo number_format($tarif); ?></td>
		</tr>
		<tr>
		<th colspan="5">Total Bayar</th>
		<td colspan="1" class="tengah">Rp. <?php echo number_format($totalbayar); ?></td>
		</tr>
	</foot>
</table>
</div>

<br>

<div class="caution">
<p>Terimakasih telah melakukan pembelian, Silahkan segera melakukan pembayaran. <br> Cetak nota anda dan segera kunjungi halaman riwayat belanja.</p> <br>
<strong>BANK MANDIRI | 137-1048358-3627 | The Crown Cafe.</strong>
</div>
</div>

<form method="post">
<div class="cetak">
<a href="javascript:window.print()">Cetak Nota</a>
<button name="input">Lihat Riwayat Belanja</button>

<?php

if(isset($_POST["input"]))
{

	$total_bayar = $totalbayar;
	//skrip update total bayar

	// menyimpan data ke tabel pembelian
	$koneksi->query("UPDATE pembelian SET total_bayar='$total_bayar' WHERE id_pembelian='$_GET[id]'");

	//tampilan dialihkan kehalaman nota, nota dari pembelian barusan
	echo "<script>alert('Terimakasih telah berkunjung ke The Crown Cafe.');</script>";
	echo "<script>location='riwayat.php';</script>";

}
?>

</form>

</div>

</body>
</html>