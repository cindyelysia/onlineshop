<?php
session_start();

include 'koneksi.php';

//jika keranjang kosong maka ke halaman menu makanan
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Pilih menu yang ingin anda pesan terlebih dahulu!');</script>";
	echo "<script>location='index.php?halaman=toast';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.page {
background-color: white;
position: relative;
width: 55%;
height: auto;
padding: 1%;
margin-top: 8%;
margin-bottom: 8%;
margin-left: 1%;
}

.image img {
margin-left: 62%;
position: absolute;
}

.table {
margin-bottom: 2%;
border: none;

}

.table th {
background-color: white;
border-bottom: 1px solid black;
padding: 1%;
color: black;
font-size: 14px;
text-align: left;
}

.table td {
background-color: white;
padding: 2%;
border-bottom: 1px solid black;
font-size: 14px;
height	: auto;
}

.rata {
padding-left: 10px;
}

.rata h3 {
position: absolute;
margin-left: 155px;
}

.tengah {
text-align: center;
}

.tombolh, .tombolh a{
box-shadow: 2px 2px 4px grey;
background-color :#606060;
color: white;
text-decoration: none;
padding: 1%;
margin-top: 3%;
border-radius	: px;
}

.tombolh:hover , .tombolh a:hover{
background-color: #CC0066;
}

.tombolp, .tombolp a{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 5%;
}

.tombolp:hover , .tombolp a:hover{
background-color: #606060;
}
</style>




<?php include 'menu.php'; ?>

<div class="image">
<img src="header/blossom3.png" width="530px">
</div>

<div class="page">

<table class="table" width="100%">
	<thead>
	<tr>
		<th width="px" colspan="3">Isi Keranjang</th>
	</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
		<!-- menampilkan produk yang sedang diperulangkan berdasarkan id -->
		<?php
		$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori WHERE id_produk='$id_produk'");
		$pecah = $ambil->fetch_assoc();
		$subtotal = $pecah["harga_produk"]* $jumlah;
		?>
		<tr>
		<td class="tengah"><?php echo $nomor ?></td>
		<td class="rata">
		<h3><?php echo $jumlah ?> Pcs <?php echo $pecah["nama_produk"]; ?> <br> <br>
		Rp. <?php echo number_format($pecah["harga_produk"]); ?> x <?php echo $jumlah ?><br>
		Rp. <?php echo number_format($subtotal); ?>
		</h3>
		<img src="fotoproduk/<?php echo $pecah["foto_produk"]; ?>" width="140px"> <br>
		</td>
		<td class="tengah">
			<a href="hapusdarikeranjang.php?id=<?php echo $id_produk ?>" class="tombolp">Batalkan</a>
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php endforeach ?>
	</tbody>
</table>
<br>

<a href="index.php?halaman=toast" class="tombolh">Beli Lainnya</a>
<a href="checkout.php" class="tombolh">Check Out</a>
</div>

<?php include 'kaki.php'; ?>


</body>
</html>