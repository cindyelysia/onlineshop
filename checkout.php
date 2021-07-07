<?php
session_start();

include 'koneksi.php';

// jika tidak login maka ke halaman login dahulu
if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Anda harus login terlebih dahulu!');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//jika keranjang kosong maka ke halaman menu makanan
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Isi pesanan terlebih dahulu!');</script>";
	echo "<script>location='index.php?halaman=toast';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Customer Check Out</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<style>
.page {
background-color: white;
position: relative;
width: 60%;
height: auto;
padding: 2%;
margin-bottom :3%;
margin-top :6%;
margin-left:30%;
}

.image img {
margin-left: 0%;
position: absolute;
}

.table {
border: none;
margin-bottom: 2%;
width: 100%;
}

.table th{
background-color: white;
padding: 1%;
border: none;
color: black;
font-size: 14px;
text-align: left;
border-bottom: 1px solid black;
}

.table td {
background-color: white;
padding: 2%;
font-size: 14px;
height	: auto;
border-bottom: 1px solid black;
}

.form {
position: ;
}

.rata {
padding-left: 10px;
}

.ratakiri {
text-align: left;
}

.rata h3{
position: absolute;
margin-left: 25%;
}

.tengah{
text-align: center;
}

button{
box-shadow: 2px 2px 4px grey;
background-color :#606060;
color: white;
text-decoration: none;
padding: 2%;
margin-top: 15%;
margin-bottom: 5%;
margin-left: 10%;
border-radius	: px;
border: none;
}

button:hover{
background-color: #CC0066;
}

.form-group{
float: left;
padding-right	: 6%;
margin-bottom	:2%;
}

input{
width		: auto;
padding		: 5px;
}

textarea{
width	: 100%;
height	: auto;
font-family: times new roman;
font-size: 14px;
margin-bottom: 10%;
padding		: 5px;
}

select{
padding		: 5px;
}

</style>


<?php include 'menu.php'; ?>

<div class="image">
<img src="header/blossom4.png" width="530px">
</div>

<div class="page">

<table class="table" width="100%">
	<thead>
	<tr>
		<th width="px" colspan="2">Check Out</th>
	</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $total = 0; ?>
		<?php $totalberat = 0; ?>
		<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
		<!-- menampilkan produk yang sedang diperulangkan berdasarkan id -->
		<?php
		$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		$pecah = $ambil->fetch_assoc();
		$subtotal = $pecah["harga_produk"]* $jumlah;
		$berat = $pecah["berat"];
		?>
		<tr>
		<td class="tengah" width="130px"><?php echo $nomor ?></td>
		<td class="rata">
		<h3>
		<?php echo $jumlah ?> Pcs <?php echo $pecah["nama_produk"]; ?> <br> 
		<?php echo $berat ?> gram <br><br>
		Rp. <?php echo number_format($pecah["harga_produk"]); ?> x <?php echo $jumlah ?> <br>
		Rp. <?php echo number_format($subtotal); ?>
		</h3>
		<img src="fotoproduk/<?php echo $pecah["foto_produk"]; ?>" width="210px">
		</td>
		</tr>
		<?php $nomor++; ?>
		<?php $totalberat+=$berat; ?>
		<?php $total+=$subtotal; ?>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
		<th colspan="1">Total Berat:</th>
		<td colspan="1" class="ratakiri"><h3><?php echo $totalberat; ?> gram</h3></td>
		</tr>
		<tr>
		<th colspan="1">Total Pembelian:</th>
		<td colspan="1" class="ratakiri"><h3>Rp. <?php echo number_format($total); ?></h3></td>
		</tr>
	</tfoot>
</table>

<form method="post" class="form">

	<div class="form-group">
	<label><h4>Nama:</h4></label>
	<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?>"> <br>
	</div>

	<div class="form-group">
	<label><h4>No.Telp:</h4></label>
	<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["telepon_pelanggan"]?>"> <br>
	</div>

	<div class="form-group">
	<label><h4>Alamat Lengkap:</h4></label>
	<textarea type="text" readonly ><?php echo $_SESSION["pelanggan"]["alamat_pelanggan"]?></textarea> <br>
	</div>

	<div class="form-group">
	<label><h4>Kota:</h4></label>
	<select class="form-control" name="id_ongkir" required>
	<option value="">Pilih Wilayah</option>
	<?php 
	$ambil = $koneksi->query("SELECT * FROM ongkir");
	while($perongkir = $ambil->fetch_assoc()){
	?>
	<option value="<?php echo $perongkir["id_ongkir"] ?>">
	<?php echo $perongkir['nama_kota'] ?>
	</option>
	<?php } ?>
	</select>
	</div>

	<button class="tombolh" href="" name="checkout">Check Out</button>

</form>



<?php 
if(isset($_POST["checkout"]))
{
	$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
	$id_ongkir = $_POST["id_ongkir"];
	$tanggal_pembelian = date("Y-m-d");
	$alamat_pengiriman = $_SESSION["pelanggan"]["alamat_pelanggan"];

	$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
	$arrayongkir = $ambil->fetch_assoc();
	$nama_kota = $arrayongkir['nama_kota'];
	$tarif = $arrayongkir['tarif'];

	$total_pembelian = $total;

	// menyimpan data ke tabel pembelian
	$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') ");

	// mendapatkan id_pembelian barusan terjadi
	$id_pembelian_barusan = $koneksi->insert_id;

	foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
	{
		// mendapatkan data produk berdasarkan id_produk
		$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
		$perproduk = $ambil->fetch_assoc();
		
		$nama = $perproduk['nama_produk'];
		$harga = $perproduk['harga_produk'];
		$berat = $perproduk['berat'];
		$subberat = $perproduk['berat']*$jumlah;
		$subharga = $perproduk['harga_produk']*$jumlah;
		
		$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");
	}

		//skrip update stok
		$koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");

	//mengkosongkan keranjang belanja
	unset($_SESSION["keranjang"]);
	

	//tampilan dialihkan kehalaman nota, nota dari pembelian barusan
	echo "<script>alert('Terimakasih telah melakukan pembelian.');</script>";
	echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
}
?>

</div>

<?php include 'kaki.php'; ?>

</body>
</html>