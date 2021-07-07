<style>
.tombolhitam, .tombolhitam a{
background-color: #606060;
color: white;
text-decoration: none;
padding: 5%;
}

.tombolhitam:hover , .tombolhitam a:hover{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 5%;
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
border:black;
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

.tombolh, .tombolh a{
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 1%;
margin-top: 3%;
border-radius	: 15px;
margin-bottom: 2%;
}

.tombolh:hover , .tombolkuning a:hover{
box-shadow: 2px 2px 4px #000000;
}

.tombolp, .tombolp a{
background-color: white;
color: black;
text-decoration: none;
padding: 5%;
}

.tombolp:hover , .tombolp a:hover{
background-color: black;
color: white;
text-decoration: none;
padding: 5%;
}

</style>

<h2>Kategori</h2>
<p>Semua kategori yang ada di The Crown Toast.</p>
<br>
<br>

<?php
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$semuadata[] = $tiap;
}
?>

<table class="table" border="" width="100%">
	<thead>
	<tr>
		<th width="40px">No.</th>
		<th width="200px">Nama Kategori</th>
		<th width="100px" class="rata">Opsi</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value): ?>


		<tr>
		<td class="tengah"><?php echo $key+1; ?></td>
		<td class="rata"><?php echo $value['nama_kategori']; ?></td>
		<td class="tengah">
			<a href="index.php?halaman=hapuskategori&id=<?php echo $value['id_kategori']; ?>" class="tombolhitam">Hapus Kategori</a>
			<a href="index.php?halaman=ubahkategori&id=<?php echo $value['id_kategori']; ?>" class="tombolk">Ubah Kategori</a>
		</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<br>

<a href="index.php?halaman=tambahkategori" class="tombolh">Tambah Kategori Lainnya</a>