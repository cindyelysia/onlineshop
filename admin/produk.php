<style>
.tombol{
text-align:center;
}


.tombol a{
float: left;
margin-top: 2%;
}

.tombolhitam, .tombolhitam a{
background-color: #606060;
color: white;
text-decoration: none;
padding: 8%;
}

.tombolhitam:hover , .tombolhitam a:hover{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 8%;
}

.tombolk, .tombolk a{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 5%;
}

.tombolk:hover , .tombolk a:hover{
background-color: #606060;
color: white;
text-decoration: none;
padding: 5%;
}


h2, p{
color		: black;
text-align	: center;
}

.table {
border: none;
margin-bottom: 2%;
}

.table th{
background-color: #606060;
padding: 1%;
border: none;
color: white;
font-size: 14px;
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

.tombolh {
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 1%;
margin-top: 3%;
border-radius	: 15px;
margin-bottom: 15%;
}

.tombolh:hover {
box-shadow: 2px 2px 4px #000000;
}

</style>

<h2>Menu</h2>
<p>Semua menu yang ada di The Crown Toast.</p>
<br>
<br>

<table class="table" border="" width="100%">
	<thead>
	<tr>
		<th width="40px">No.</th>
		<th width="100px">Kategori</th>
		<th width="110px">Menu</th>
		<th width="80px">Harga</th>
		<th width="50px">Berat</th>
		<th width="50px">Stok</th>
		<th width="100px">Foto</th>
		<th width="120px" class="rata">Opsi</th>
	</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * from produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
		<td class="tengah"><?php echo $nomor; ?></td>
		<td class="tengah"><?php echo $pecah['nama_kategori']; ?></td>
		<td class="rata"><?php echo $pecah['nama_produk']; ?></td>
		<td class="tengah">Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
		<td class="tengah"><?php echo $pecah['berat']; ?>  gram</td>
		<td class="tengah"><?php echo $pecah['stok_produk']; ?> pcs</td>
		<td class="tengah">
		<img src="../fotoproduk/<?php echo $pecah['foto_produk'] ?>" width="150">
		</td>
		<td class="tengah">
		<div class="tombol">
			<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="tombolhitam">Hapus Menu</a>
			<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="tombolk">Ubah Menu</a>
		</div>
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>
<br>

<a href="index.php?halaman=tambahproduk" class="tombolh">Tambah Menu Lainnya</a>
