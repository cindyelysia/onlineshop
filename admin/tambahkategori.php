<style>

h2, p{
color		: black;
text-align	: center;
}

.loginform{
background-color: black;
font-family	: Times new roman;
position	: relative;
margin-left	: 33%;
width		: 30%;
padding		: 2%;
opacity		: 0.8;
height		: 589px;
color		: white;
}

.loginform h2{
text-align	: center;
padding-top	: 20px;
}

.loginform p{
text-align	: center;
margin-top	: 3%;
margin-bottom	: 30px;
padding-bottom	: 20px;
border-bottom	: 1px solid white;
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




<h2>Tambah Kategori</h2>
<p>Tambah kategori baru dengan mengisi form dibawah ini.</p>
<br>
<br>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label>Nama Kategori:</label>
	<input type="text" class="form-control" name="nama">
	</div>
	
	<input type="submit" class="tombolkuning" name="save" value="Simpan">
	
</form>

<?php
if(isset($_POST['save']))
{
	$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES('$_POST[nama]')");

	echo "<script>alert('Kategori baru telah ditambahkan.');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}
?>