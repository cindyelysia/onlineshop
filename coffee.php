<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Let me fill you!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>

<style>
.isimenu {
  margin-top: 1%;
  margin-bottom: 90%;
  margin-left: 4%;
}

.menu {
  position: relative;
  padding: 1%;
  width: 28%;
  height: 5%;
  background-color: white;
  box-shadow: 2px 2px 3px 3px grey;
  margin-bottom: 60px;
  margin-top: 10px;
  margin-right: 30px;
  float: left;
}

.menu img {
  max-width: 100%;
  max-height: 100%;
  
}

.judulmenu {
  position: relative;
  text-align: center;
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
  color: grey;
  text-align: center;
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
  position: relative;
  opacity: 0.9;
  margin-top: 10px;
  padding-top: 15px;
 border-top : 3px dotted #808080;
} 

.tombolmenu a{
  text-decoration: none;
}

.klik h5 {
  background-color: #606060;
  float: left;
  color: white;
  padding-right: 30px;
  padding-left: 30px;
  padding-top: 15px;
  padding-bottom: 15px;
  box-shadow: 2px 2px 4px #000000;
  margin-right: 10px;
  margin-left: 20px;
}

.klik h5:hover {
background-color: #CC0066;
}
</style>

<div class="isimenu">
<h2>Our Coffee</h2>

<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='3' "); ?>
<?php while ($perproduk = $ambil->fetch_assoc()) {?>

<div class="menu">

<img src="fotoproduk/<?php echo $perproduk['foto_produk'];?>">

<div class="judulmenu">
<h3><?php echo $perproduk['nama_produk']; ?></h3>
<h4 class="harga">Rp. <?php echo number_format($perproduk['harga_produk']); ?></h4>
<h5 class="berat"><?php echo number_format($perproduk['berat']); ?> gram</h5>

<?php if($perproduk['stok_produk']==0): ?>
<h4 class="stokhabis">Habis</h4>
<?php else: ?>
<h4 class="stoktersedia">Tersedia</h4>
<?php endif ?>
</div>

<?php if($perproduk['stok_produk']>0): ?>
<div class="tombolmenu">
<a class="klik" href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"><h5>Beli Sekarang</h5></a>
<a class="klik" href="detailproduk.php?id=<?php echo $perproduk['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>
<?php endif ?>

</div>
<?php } ?>
</div>

</body>
</html>