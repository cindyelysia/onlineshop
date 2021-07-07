<h2>Ubah Menu</h2>
<p>Ubah Menu melalui form dibawah ini.</p>

<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<?php 
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}
?>





<style>

h2, p{
color		: black;
text-align	: center;
}

.loginform{
background-color: black;
font-family	: Times new roman;
position	: relative;
margin-left	: 33%;
width		: 30%;
padding		: 2%;
opacity		: 0.8;
height		: 589px;
color		: white;
}

.loginform h2{
text-align	: center;
padding-top	: 20px;
}

.loginform p{
text-align	: center;
margin-top	: 3%;
margin-bottom	: 30px;
padding-bottom	: 20px;
border-bottom	: 1px solid white;
}

.form-group{
padding	: 1%;
}

input{
width		: 100%;
margin-top	: 1%;
padding		: 1px;
}

textarea{
width		: 100%;
margin-top	: 1%;
padding		: 1px;
}

.tombolkuning, .tombolkuning a{
width	: 20%;
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 1%;
margin-top: 3%;
border-radius	: 15px;
}

.tombolkuning:hover , .tombolkuning a:hover{
box-shadow: 2px 2px 4px #000000;
border: none;
}

script{
font-family	: Times new roman;
text-align	: center;
background-color	: #B8860B;
}

</style>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label>Menu:</label>
	<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
	</div>

	<div class="form-group">
	<label>Tanggal:</label>
	<input type="date" class="form-control" name="tanggal" value="<?php echo $pecah['tglproduk']; ?>">
	</div>

	<div class="form-group">
	<label>Kategori:</label>
	<select class="form-control" name="id_kategori">
	<option value="">Pilih Kategori</option>
	<?php foreach($datakategori as $key => $value): ?>

	<option value="<?php echo $value["id_kategori"]; ?>" <?php if($pecah["id_kategori"]==$value["id_kategori"]) { echo "selected"; } ?> ><?php echo $value["nama_kategori"]; ?>
	</option>
	<?php endforeach ?>
	</select>
	</div>


	<div class="form-group">
	<label>Harga:</label>
	<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
	</div>

	<div class="form-group">
	<label>Berat (Gram):</label>
	<input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat']; ?>">
	</div>

	<div class="form-group">
	<label>Stok (Pcs):</label>
	<input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>">
	</div>

	<div class="form-group">
	<label>Deskripsi:</label>
	<textarea name="desc" rows="10">
	<?php echo $pecah['deskripsi_produk']; ?>
	</textarea>
	</div>

	<div class="form-group">
	<label>Foto:</label> <br>
	<img src="../fotoproduk/<?php echo $pecah['foto_produk'] ?>" width="200">
	</div>

	<div class="form-group">
	<label>Ganti Foto:</label>
	<input type="file" class="form-control" name="foto">
	</div>

	<div class="form-group">
	<input type="submit" class="tombolkuning" name="simpan" value="Simpan">
	</div>
	</form>

<?php
if (isset($_POST['simpan']))
{
	$namafoto= $_FILES['foto']['name'];
	$lokasifoto= $_FILES['foto']['tmp_name'];

	//Jika foto diubah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../fotoproduk/".$namafoto);

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]' ,tglproduk='$_POST[tanggal]' ,id_kategori='$_POST[id_kategori]' ,harga_produk='$_POST[harga]'  ,berat='$_POST[berat]' ,stok_produk='$_POST[stok]' ,deskripsi_produk='$_POST[desc]' ,foto_produk='$namafoto' WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]' ,tglproduk='$_POST[tanggal]' ,id_kategori='$_POST[id_kategori]' ,harga_produk='$_POST[harga]'  ,berat='$_POST[berat]' ,stok_produk='$_POST[stok]' ,deskripsi_produk='$_POST[desc]' WHERE id_produk='$_GET[id]'");
	}

	echo "<script>alert('Perubahan menu telah disimpan.');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>








