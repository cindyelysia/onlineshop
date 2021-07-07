<style>
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
</style>

<h2>Data Pembelian</h2>
<p>Semua data pembelian yang ada di The Crown Toast.</p>
<br>
<br>

<table class="table" border="1" width="100%">
	<thead>
		<tr>
		<th width="30px">No.</th>
		<th width="150px">Nama Pelanggan</th>
		<th width="70px">Tanggal Pembelian</th>
		<th width="70px">Total Pembelian</th>
		<th width="50px">Status Pembelian</th>
		<th width="170px">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * from pembelian JOIN pelanggan on pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
		<td class="tengah"><?php echo $nomor; ?></td>
		<td class="rata"><?php echo $pecah['nama_pelanggan']; ?></td>
		<td class="tengah"><?php echo $pecah['tanggal_pembelian']; ?></td>
		<td class="tengah">Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
		<td class="tengah"><?php echo $pecah['status_pembelian']; ?></td>
		<td class="tengah">
			<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="tombolk">Detail Pembelian</a>

			<?php if ($pecah['status_pembelian']=="Telah Dibayar"): ?>
			<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="tombolhitam">Detail Pembayaran</a>
			<?php endif ?>


		</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>