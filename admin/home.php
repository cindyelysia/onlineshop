<div class="part">
<img src="logo.png">
</div>

<div class="part">

<div class="text">
<h2>Selamat Datang The Crown Toast.'s Admin!</h2>
<br>

<?php
$ambil = $koneksi->query("SELECT * FROM admin");
$pecah = $ambil->fetch_assoc();
?>

<p>Hello <?php echo $pecah[nama_lengkap]; ?>! <br>
Selamat Datang di Admin Page, anda bisa melihat semua data di The Crown Toast.
</p>
</div>
</div>

<style>
.part{
float: left;
padding: 3%;
}

.text{
padding-top: 25%;
padding-left: 1%;
width: 600px;
}
</style>

