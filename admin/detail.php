<style>
.detail{
    background-color	: transparent;
    position		: relative;
    width		: auto;
    height		: auto;
    margin-bottom	: 10%;
    color: black;
}

.part{
float: left;
margin-right: 12%;
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

<h2>Detail Pembelian</h2>
<p>Rincian Pembelian yang ada di The Crown Toast.</p>
<br>
<br>

<div class="detail">
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<div class="part">
<h3>Data Pelanggan: </h3>
<?php echo $detail['nama_pelanggan']; ?> <br>
<?php echo $detail['email_pelanggan']; ?> <br>
<?php echo $detail['telepon_pelanggan']; ?>
</div>

<div class="part">
<h3>Data Pembelian: </h3>
No. Pembelian: <?php echo $detail['id_pembelian']; ?> <br>
Tanggal Pembelian: <?php echo $detail['tanggal_pembelian']; ?> <br>
Status Pembelian: <?php echo $detail['status_pembelian']; ?> <br>
<strong>Total Pembelian: Rp. <?php echo number_format($detail['total_pembelian']); ?></strong>
</div>

<div class="part">
<h3>Data Pengiriman:</h3>
Alamat: <?php echo $detail['alamat_pengiriman']; ?> <br>
Kota: <?php echo $detail['nama_kota']; ?> <br>
<strong>Ongkor Kirim: Rp. <?php echo number_format($detail['tarif']); ?></strong>
</div>

</div>

<br>
<h4>
Menu yang dipesan:
</h4>
<table class="table" border="1" width="100%">
	<thead>
	<tr>
		<th width="40px">No.</th>
		<th width="200px">Menu</th>
		<th width="100px">Harga</th>
		<th width="50px">Jumlah</th>
		<th width="100px">Subtotal</th>
	</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * from pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
		<td class="tengah"><?php echo $nomor; ?></td>
		<td class="rata"><?php echo $pecah['nama_produk']; ?></td>
		<td class="rata">Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
		<td class="tengah"><?php echo $pecah['jumlah']; ?> </td>
		<td class="rata">
			IDR <?php echo number_format($pecah['harga_produk']* $pecah['jumlah']); ?>
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>