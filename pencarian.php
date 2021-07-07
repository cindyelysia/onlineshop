<?php include 'koneksi.php'; ?>
<?php
$keyword = $_GET["keyword"];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' ");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.page {
position: relative;
width: auto;
height: auto;
padding: 2%;
margin-bottom: 20%;
margin-top: 5%;
margin-left: 150px;
}

.page p {
  font-size: 15px;
  font_Family: times new roman;
  border: 1px solid grey;
  background-color: black;
  color: white;
  width: 81%;
  padding: 1%;
}

.menu {
  position: relative;;
  padding: 2%;
  width: 79%;
  background-color: transparent;
  height: auto;
  margin-bottom: 30px;
  margin-top: 30px;
  box-shadow: 2px 2px 3px 3px grey;
}

.menu img{
  max-width: 300px;
}

.judulmenu {
  position: absolute;
  background-color: transparent;
  margin-top: 0px;
  margin-left: 350px;
  font-family: times new roman;
}

.judulmenu h3{
  font-size: 30px;
  font-family: times new roman;
}

.berat {
  font-size: 16px;
  font-family: times new roman;
}

.harga {
  font-size: 18px;
  color: black;
  border-bottom: 1px solid black;
  width: 85px;
  font-family: times new roman;
}

.stoktersedia {
  font-size: 17px;
  color: green;
  font-family: times new roman;
}

.stokhabis {
  font-size: 17px;
  color: red;
  font-family: times new roman;
}

.tombolmenu {
  position: absolute;
  margin-top: 140px;
  margin-left: 350px;
}

.tombolmenu a{
  text-decoration: none;
}

.klik h5 {
  background-color: #CC0066;
  float: left;
  color: white;
  padding-right: 90px;
  padding-left: 90px;
  padding-top: 15px;
  padding-bottom: 15px;
  box-shadow: 2px 2px 4px #000000;
  margin-right: 8px;
}

.klik h5:hover, a:hover {
  background-color: #606060;
    color: white;
}


</style>

<?php include 'menu.php'; ?>

<div class="page">
<h2>Hasil Pencarian</h2>

<?php if(empty($semuadata)): ?>
<p>Yang anda cari tidak tersedia.</p>
<?php else: ?>
<p><?php echo $keyword ?></p>
<?php endif ?>

<?php foreach ($semuadata as $key => $value): ?>
<div class="menu">

<div class="judulmenu">
<h3><?php echo $value['nama_produk']; ?></h3>
<h4 class="harga">Rp. <?php echo number_format($value['harga_produk']); ?></h4>
<h5 class="berat"><?php echo number_format($value['berat']); ?> gram</h5>

<?php if($value['stok_produk']==0): ?>
<h4 class="stokhabis">Habis</h4>
<?php else: ?>
<h4 class="stoktersedia">Tersedia</h4>
<?php endif ?>
</div>

<?php if($value['stok_produk']>0): ?>
<div class="tombolmenu">
<a class="klik" href="beli.php?id=<?php echo $value['id_produk']; ?>"><h5>Beli Sekarang</h5></a>
<a class="klik" href="detailproduk.php?id=<?php echo $value['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>
<?php endif ?>

<img src="fotoproduk/<?php echo $value['foto_produk'];?>">
</div>
<?php endforeach ?>


</div>

<?php include 'kaki.php'; ?>

</body>
</html>