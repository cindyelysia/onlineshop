<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>

<style>
.menuterbaru{
margin-top: 1%;
margin-bottom: 30%;
}

.menu {
  background-color: white;
  margin-top: 2%;
  width: 22%;
  overflow: hidden;
  padding: 1%;
  margin-top: 1%;
  margin-bottom: 1%;
  float: left;
  color: black;
  margin-right: 1%;
  font-size: 18px;
  font-family: times new roman;
  box-shadow: 2px 2px 3px 3px grey;
  text-align: center;
  height: 310px;
}

.menu h4 {
color: grey;
}

.tomboldetail a {
  text-decoration: none;
  color: white;
}

.tomboldetail {
  position: relative;
  width: 100%;
  background-color: #606060;
  color: white;
  margin-top: 10%;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
  margin-bottom: 0%;
}

.tomboldetail:hover {
background-color: #CC0066;
}

.fotomenuma img{
  width: 280px;
  margin-top: 2%;
}

.fotomenumi img{
  width: 130px;
  margin-top: 1%;
}

</style>


<div class="menuterbaru">
<h2>What's new?</h2>

<div class="menu">
<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='1' ORDER BY tglproduk DESC");
$data = $ambil->fetch_array();
?>
<h3><?php echo $data["nama_produk"]; ?></h3>
<h4>Rp. <?php echo number_format($data["harga_produk"]); ?></h4>

<div class="fotomenuma">
<img src="fotoproduk/<?php echo $data['foto_produk']; ?>">
</div>

<div class="tomboldetail">
<a href="detailproduk.php?id=<?php echo $data['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>

</div>



<div class="menu">
<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='3' ORDER BY tglproduk DESC");
$data = $ambil->fetch_array();
?>
<h3><?php echo $data["nama_produk"]; ?></h3>
<h4>Rp. <?php echo number_format($data["harga_produk"]); ?></h4>

<div class="fotomenumi">
<img src="fotoproduk/<?php echo $data['foto_produk']; ?>">
</div>

<div class="tomboldetail">
<a href="detailproduk.php?id=<?php echo $data['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>

</div>



<div class="menu">
<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='4' ORDER BY tglproduk DESC");
$data = $ambil->fetch_array();
?>
<h3><?php echo $data["nama_produk"]; ?></h3>
<h4>Rp. <?php echo number_format($data["harga_produk"]); ?></h4>

<div class="fotomenuma">
<img src="fotoproduk/<?php echo $data['foto_produk']; ?>">
</div>

<div class="tomboldetail">
<a href="detailproduk.php?id=<?php echo $data['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>

</div>


<div class="menu">
<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='2' ORDER BY tglproduk DESC");
$data = $ambil->fetch_array();
?>
<h3><?php echo $data["nama_produk"]; ?></h3>
<h4>Rp. <?php echo number_format($data["harga_produk"]); ?></h4>

<div class="fotomenumi">
<img src="fotoproduk/<?php echo $data['foto_produk']; ?>">
</div>

<div class="tomboldetail">
<a href="detailproduk.php?id=<?php echo $data['id_produk']; ?>"><h5>Lihat Detail</h5></a>
</div>
</div>

</div>

</body>
</html>