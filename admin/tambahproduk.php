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

echo{
font-family	: Times new roman;
text-align	: center;
}

</style>






<h2>Tambah Menu</h2>
<p>Tambah Menu Baru dengan mengisi form dibawah ini.</p>
<br>
<br>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label>Menu:</label>
	<input type="text" class="form-control" name="nama">
	</div>

	<div class="form-group">
	<label>Tanggal:</label>
	<input type="date" class="form-control" name="tanggal">
	</div>

	<div class="form-group">
	<label>Kategori:</label>
	<select class="form-control" name="id_kategori">
	<option value="">Pilih Kategori</option>
	<?php foreach($datakategori as $key => $value): ?>

	<option value="<?php echo $value["id_kategori"]; ?>"><?php echo $value["nama_kategori"]; ?></option>
	<?php endforeach ?>

	</select>
	</div>

	<div class="form-group">
	<label>Harga:</label>
	<input type="number" class="form-control" name="harga">
	</div>

	<div class="form-group">
	<label>Berat (Gram):</label>
	<input type="number" class="form-control" name="berat">
	</div>

	<div class="form-group">
	<label>Stok (Pcs):</label>
	<input type="number" class="form-control" name="stok_produk">
	</div>

	<div class="form-group">
	<label>Deskripsi:</label> <br>
	<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>

	<div class="form-group">
	<label>Foto:</label>
	<input type="file" class="form-control" name="foto">
	</div>
	
	<input type="submit" class="tombolkuning" name="save" value="Simpan">
	
</form>

<?php
if(isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../fotoproduk/".$nama);
	$koneksi->query("INSERT INTO produk (nama_produk,tglproduk,harga_produk,berat,foto_produk,deskripsi_produk,id_kategori,stok_produk)
VALUES('$_POST[nama]', '$_POST[tanggal]', '$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[id_kategori]','$_POST[stok_produk]')");

	echo "<script>alert('Menu baru telah ditambahkan.');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>
