<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Akses tidak dibolehkan.');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Orders History</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.page {
background-color: white;
position: relative;
width: 55%;
height: auto;
padding: 2%;
margin-bottom :20%;
margin-top :8%;
margin-left:3%;
}

.page img {
position: absolute;
margin-left: 92%;
}

.table {
border: none;
margin-bottom: 2%;
}

.table th{
background-color: white;
padding: 1%;
border-bottom: 1px solid black;
color: black;
font-size: 14px;
text-align: left;
}

.table td{
background-color: white;
padding: 1%;
border-bottom: 1px solid black;
font-size: 14px;
height	: auto;
}

.rata{
padding-left: 10px;
}

.tengah{
text-align: center;
}

.tombolhitam, .tombolhitam a{
background-color :#606060;
color: white;
text-decoration: none;
padding: 2%;
}

.tombolhitam:hover , .tombolhitam a:hover{
background-color: #CC0066;
}

.tombolk, .tombolk a{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 2%;
}

.tombolk:hover , .tombolk a:hover{
background-color :#606060;
}

</style>


<?php include 'menu.php'; ?>

<div class="page">

<img src="header/blossom1.png" width="550px">

<table class="table" width="100%">
	<thead>
	<tr>
		<th width="px" colspan="3">Riwayat Pembelian</th>
	</tr>
	</thead>

	<tbody>
		<?php $nomor = 1; ?>
		<?php
		// mendapatkan id pelanggan yang login dari session
		$idpelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
		$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$idpelanggan'");

		while ($pecah = $ambil->fetch_assoc()){
		?>
		<tr>
		<td class="tengah" width="20px"><?php echo $nomor ?></td>
		<td class="rata" width="350px">
		Pada tanggal <?php echo date("d F Y",strtotime($pecah["tanggal_pembelian"])) ?> <br>
  		Dengan total bayar senilai Rp. <?php echo number_format($pecah["total_bayar"]); ?> <br>
		<strong>Status: <?php echo $pecah["status_pembelian"]; ?></strong>
			<br>
			<?php if (!empty($pecah["resi_pengiriman"])): ?>
			No.Resi (<?php echo $pecah["resi_pengiriman"]; ?>)
			<?php endif ?>
		</td>		
		<td class="rata">
			<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="tombolhitam">Nota Pembelian</a>
			
			<?php if ($pecah["status_pembelian"]=="Belum Dibayar"): ?>
			<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="tombolk">Konfirmasi Pembayaran</a>
			<?php endif ?>
			
			<?php if ($pecah["status_pembelian"]=="Telah Dibayar"): ?>
			<a href="lihatpembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="tombolk">Detail Pembayaran</a>
			<?php endif ?>

			<?php if ($pecah["status_pembelian"]=="Telah Dikirim"): ?>
			<a href="penerimaan.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="tombolk">Konfirmasi Penerimaan</a>
			<?php endif ?>

			<?php if ($pecah["status_pembelian"]=="Telah Diterima"): ?>
			<a href="lihatpenerimaan.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="tombolk">Detail Penerimaan</a>
			<?php endif ?>
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>


</div>

<?php include 'kaki.php'; ?>

</body>
</html>