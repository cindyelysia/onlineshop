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
text-align: left;
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


.form-group{
padding	: 1%;
font-family:timew new roman;
font-size: 14px;
}

input{
width		: 50%;
margin-top	: 1%;
padding		: 1px;
}

select{
width		: 50%;
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

</style>

<h2>Detail Pembayaran</h2>
<p>Rincian Pembayaran untuk Pembelian yang ada di The Crown Toast.</p>
<br>
<br>

<?php
// mengambil id pembelian dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<table class="table" border="1" width="100%">
	<tr>
		<th>Nama Pengirim</th>
		<td class="rata"><?php echo $detail['nama']; ?></td>
	</tr>
		<th>Bank</th>
		<td><?php echo $detail['bank']; ?></td>
	</tr>
		<th>Total Pembayaran</th>
		<td class="rata">IDR <?php echo number_format($detail['jumlah']); ?></td>
	</tr>
		<th>Tanggal Pembayaran</th>
		<td class="rata"><?php echo $detail['tanggal']; ?></td>
	</tr>
		<th>Bukti Pembayaran</th>
		<td class="tengah"><img src="../bukti_pembayaran/<?php echo $detail['bukti']; ?>" width="500px" ></td>
	</tr>
</table>

<br>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label>Resi Pengiriman:</label><br>
	<input type="text" class="form-control" name="resi">
	</div>

	<div class="form-group">
	<label>Status Pembelian:</label><br>
	<select class="form-control" name="status">
	<option value="">Pilih</option>
	<option value="Telah Dibatalkan">Telah Dibatalkan</option>
	<option value="Telah Dikirim">Telah Dikirim</option>
	</select>
	</div>

	<input type="submit" class="tombolkuning" name="proses" value="Proses">
</form>

<?php
if (isset($_POST["proses"]))
{
	$resi = $_POST["resi"];
	$status = $_POST["status"];
	$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi' , status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

	echo "<script>alert('Data pembelian telah diperbarui.');</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>



