<h2>Data Pelanggan</h2>
<p>Semua data pelanggan yang ada di The Crown Toast.</p>
<br>
<br>

<table class="table" border="1" width="100%">
	<thead>
		<tr>
		<th width="40px">No.</th>
		<th width="150px">Nama Pelanggan</th>
		<th width="80px">Jenis Kelamin</th>
		<th width="80px">Email</th>
		<th width="80px">No. Telp</th>
		<th width="120px">Alamat</th>
		<th width="140px">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
		<td class="tengah"><?php echo $nomor; ?></td>
		<td class="rata"><?php echo $pecah['nama_pelanggan']; ?></td>
		<td class="rata"><?php echo $pecah['jk_pelanggan']; ?></td>
		<td class="tengah"><?php echo $pecah['email_pelanggan']; ?></td>
		<td class="tengah"><?php echo $pecah['telepon_pelanggan']; ?></td>
		<td class="rata"><?php echo $pecah['alamat_pelanggan']; ?></td>
		<td class="tengah">
			<a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="tombolhitam">Hapus Pelanggan</a>
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>



<style>
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

</style>