<?php
$semuadata = array();
$tgl_mulai = "..";
$tgl_selesai = "..";
$status = "";
if (isset($_POST["kirim"]))
{
	$tgl_mulai = $_POST["tglm"];
	$tgl_selesai = $_POST["tgls"];
	$status = $_POST["status"];
	$ambil = $koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
	while ($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}
}
?>

<style>

h2, p{
color		: black;
text-align	: center;
}

.form-group{
padding: 1%;
float:left;
}

input{
width		: 100%;
padding		: 1px;
}

select{
width		: 100%;
padding		: 1px;
}

.tombolkuning, .tombolkuning a{
width	: 200%;
background-color: #CC0066;
color: white;
text-decoration: none;
padding: 15%;
margin-top: 3%;
border-radius	: 15px;
}

.tombolkuning:hover , .tombolkuning a:hover{
box-shadow: 2px 2px 4px #000000;
border: none;
}

.table {
border: none;
margin-bottom: 2%;
width: 100%;
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

echo{
font-family	: Times new roman;
text-align	: center;
}

</style>




<h2>Laporan Pembelian</h2>
<p>Laporan Pembelian dari <?php echo date("d F Y",strtotime($tgl_mulai)) ?> hingga <?php echo date("d F Y",strtotime($tgl_selesai)) ?> di The Crown Toast.</p>
<br>
<hr>
<br>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label>Dari Tanggal: </label>
	<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>" >
	</div>

	<div class="form-group">
	<label>Sampai Tanggal: </label>
	<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
	</div>

	<div class="form-group">
	<label>Status: </label>
	<select class="form-control" name="status">
	<option>Pilih Status</option>
	<option value="Belum Dibayar" <?php echo $status=="Belum Dibayar"?"selected":"";?>  >Belum Dibayar</option>
	<option value="Telah Dibayar" <?php echo $status=="Telah Dibayar"?"selected":"";?>  >Telah Dibayar</option>
	<option value="Telah Dikirim" <?php echo $status=="Telah Dikirim"?"selected":"";?>  >Telah Dikirim</option>
	<option value="Telah Dibatalkan"  <?php echo $status=="Telah Dibatalkan"?"selected":"";?> >Telah Dibatalkan</option>
	<option value="Telah Diterima"  <?php echo $status=="Telah Diterima"?"selected":"";?> >Telah Diterima</option>
	</select>
	</div>
	
	<div class="form-group">
	<input type="submit" class="tombolkuning" name="kirim" value="Lihat Laporan">
        </div>	
</form>

<br>
<table class="table" border="1">
	<thead>
		<tr>
		<th width="40px">No.</th>
		<th width="200px">Nama Pelanggan</th>
		<th width="120px">Tanggal</th>
		<th width="100px">Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php $total = 0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian'] ?>
		<tr>
		<td class="tengah"><?php echo $key+1; ?></td>
		<td class="rata"><?php echo $value["nama_pelanggan"]; ?></td>
		<td class="rata"><?php echo date("d F Y",strtotime($value["tanggal_pembelian"])) ?></td>
		<td class="rata">Rp. <?php echo number_format($value["total_pembelian"]); ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
		<th colspan="2">Total Pembelian</th>
		<td colspan="2" class="tengah">Rp. <?php echo number_format($total); ?></td>
		</tr>
	</foot>
</table>
