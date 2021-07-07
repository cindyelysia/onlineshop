<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Let me fill you!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>

<style>
.page {
position: relative;
width: auto;
height: auto;
padding: 2%;
margin-bottom: 3%;
margin-left:2%;
}

.foto img {
margin-bottom:1%;
margin-left:4%;
}

</style>

<?php include 'menu.php'; ?>

<?php include 'pilihmenu.php'; ?>

<div class="foto">
<img src="header/h1.jpg">
</div>

<div class="page">
<?php
		if(isset($_GET['halaman']))
		{
			if($_GET['halaman']=="toast")
			{
				include 'toast.php';
			}
			if($_GET['halaman']=="cake")
			{
				include 'cake.php';
			}
			if($_GET['halaman']=="coffee")
			{
				include 'coffee.php';
			}
			else if($_GET['halaman']=="juice")
			{
				include 'juice.php';
			}
			else if($_GET['halaman']=="register")
			{
				include 'register.php';
			}
			else if($_GET['halaman']=="login")
			{
				include 'login.php';
			}
			else if($_GET['halaman']=="profilpelanggan")
			{
				include 'profilpelanggan.php';
			}
			else if($_GET['halaman']=="editprofil")
			{
				include 'editprofil.php';
			}
		}
		else
		{
			include 'produkterbaru.php';
		}          
	      ?>
</div>


<?php include 'kaki.php'; ?>

</body>
</html>