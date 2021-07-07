<?php 
session_start();
include 'koneksi.php';

// mendapatkan id_produk dari url
$id_produk = $_GET["id"];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Menu's Detail</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<style>
.page {
background-color: white;
position: relative;
width: 50%;
height: auto;
padding: 2%;
margin-bottom :3%;
margin-top :3%;
margin-left:42%;
box-shadow: 2px 2px 3px 3px grey;
}

.image img {
position: absolute;
margin-left: 0%;
margin-top: 10%;
}

.detailproduk {
width: 100%;
}

.detailfoto {
width: 100%;
}

.detailfoto h2 {
text-align: justify;
margin-bottom: 1%;
}

.detailfoto p {
text-align: justify;
margin-bottom: 4%;
}

.detailfoto img {
width: 100%;
margin-bottom: 2%;
}

table {
border-top: px solid black;
width: 100%;
}

table tr th {
background-color: white;
padding: 1%;
color: black;
width: 10%;
font-size: 14px;
text-align: left;
}

table tr td {
background-color: white;
font-size: 14px;
height	: auto;
margin-left: 10px;
text-align: left;
}

button {
background-color :#606060;
color: white;
text-decoration: none;
padding: 1%;
text-align: center;
width: 25%;
border: none;
}

button:hover {
background-color: #CC0066;
}

input {
width: 15%;
} 

</style>

<?php include 'menu.php'; ?>

<div class="image">
<img src="header/blossom2.png" width="530px">
</div>

<div class="page">


<div class="detailfoto">

<h2><?php echo $detail["nama_produk"]; ?></h2>
<p class="judul"><?php echo $detail ["deskripsi_produk"]; ?></p>
<img src="fotoproduk/<?php echo $detail ["foto_produk"]; ?>">
</div>

<div class="detailproduk">

<form method="post">
<table>
<tr>
	<th>Harga:</th>
	<td><h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4></td>
</tr>
<tr>
	<th>Berat:</th>
	<td><h4><?php echo $detail ["berat"]; ?> gram</h4></td>
</tr>
<tr>
	<th>Stok:</th>
	<td><h4><?php echo number_format($detail["stok_produk"]); ?></h4></td>
</tr>
<tr>
	<th>Jumlah:</th>
	<td><input type="number" name="jumlah" min="1" value="1" max="<?php echo $detail['stok_produk']; ?>"></td>
</tr>
</table>


<form method="post">


<br> 
<button name="beli"><h4>Beli</h4></button>
</form>
</div>

<?php
//jika klik tombol beli
if (isset($_POST["beli"]))
{
	//mendapatkan jumlah yg dibeli
	$jumlah = $_POST["jumlah"];
	// masukan ke keranjang
	$_SESSION["keranjang"][$id_produk] = $jumlah;

	echo "<script>alert('Pesanan telah dimasukan ke keranjang belanja.');</script>";
	echo "<script>location='keranjang.php';</script>";
}
?>
</div>

<?php include 'kaki.php'; ?>

</body>
</html>