<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>

<style>
img {
width: 250px;
margin-left:0%;
margin-top :20%;
position: absolute;
}

.registerform {
position: relative;
width: 45%;
padding: 2%;
margin-bottom :3%;
margin-top :3%;
margin-left:19%;
}

.registerform h2 {
font-family: Times new roman;
text-align: left;
}

.registerform p {
font-family: Times new roman;
text-align: left;
margin-bottom: 3%;
padding-bottom: 2%;
border-bottom: 1px solid black;
}

button{
background-color: #606060;
color: white;
text-decoration: none;
padding: 1%;
border: none;
margin-left: 93%;
margin-top :2%;
}

button:hover{
background-color: #CC0066;
color: white;
}

.form-group{
margin-bottom	: 2%;
}

input{
width		: 98%;
padding		: 5px;
margin-top	: 1%;
}

select {
width		: 100%;
padding		: 5px;
margin-top	: 1%;
}

textarea{
width		: 98%;
padding		: 5px;
font-family: Times new roman;
}
</style>

<?php include 'menu.php' ?>

<img src="header/blossom2.png">

<form method="post" class="registerform">

<h2>Registrasi</h2>
<p>Daftarkan dirimu untuk menjadi pelanggan setia kami.</p>

	<div class="form-group">
	<label>Nama:</label> <br>
	<input type="text" class="form-control" name="nama_pelanggan" placeholder=" Nama lengkap anda" required>
	</div>

	<div class="form-group">
	<label>Jenis Kelamin:</label> <br>
	<select class="form-control" name="jk_pelanggan" required>
	<option value="">Pilih Gender</option>
	<option value="Perempuan">Perempuan</option>
	<option value="Laki-Laki">Laki-Laki</option>
	</select>
	</div>

	<div class="form-group">
	<label>Email:</label> <br>
	<input type="email" class="form-control" name="email_pelanggan" placeholder=" Email anda" required>
	</div>

	<div class="form-group"
	<label>Password:</label> <br>
	<input type="text" class="form-control" name="password_pelanggan" placeholder=" Password anda" required>
	</div>

	<div class="form-group">
	<label>No.Hp:</label> <br>
	<input type="number" class="form-control" name="telepon_pelanggan" placeholder=" Nomor anda" required>
	</div>

	<div class="form-group">
	<label>Alamat:</label> <br>
	<textarea type="text" class="form-control" name="alamat_pelanggan" placeholder=" Alamat lengkap anda" required></textarea>
	</div>

	<button class="btn btn-primary" name="register">Daftar</button><br>
</form>
<?php
// jika tekan register
if(isset($_POST["register"]))
{
	// mengambil isi form
	$nama = $_POST["nama_pelanggan"];
	$email = $_POST["email_pelanggan"];
	$password = $_POST["password_pelanggan"];
	$telepon = $_POST["telepon_pelanggan"];
	$alamat = $_POST["alamat_pelanggan"];
	$jk = $_POST["jk_pelanggan"];
	
	//validasi apakah email sudah digunakan atau belum
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok==1)
	{
		echo "<script>alert('Registrasi Gagal, Silahkan coba lagi.');</script>";
		echo "<script>location='register.php';</script>";
	}
	else
	{
		// mengisi ke database
		$koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,jk_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES('$email','$password','$nama','$jk','$telepon','$alamat')");

		echo "<script>alert('Registrasi Berhasil, Silahkan kunjungi halaman login.');</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>

</body>
</html>