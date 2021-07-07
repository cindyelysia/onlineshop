<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","onlineshop");

if(!isset($_SESSION['admin']))
{
	echo "<script>alert('Anda harus login terlebih dahulu!');</script>";
	echo "<script>location='login.php';</script>";
	header('location:login.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Admin Page</title>
</head>
<body>

<style>
*{
        margin: 0;
	padding: 0;
}

html{
    background-color	: white;
}

.headeradmin{
    background-color	: #CC0066;
    position		: relative;
    width		: 100%;
    height		: 65px;
}

.headeradmin .title{
	width			: 250px;
	padding-top		: 10px;
    	text-align		: center;
    	background-color	: #CC0066;
	height			: 100%;
}

button{
	position		: absolute;
	width			: 10%;
	top			: 22%;
	margin-left		: 89%;
	background-color	: black;
	border			: none;
	border-radius		: 15px;
	display			: block;
}

button a{
	text-decoration		: none;
    	font-family		: Times new roman;
	font-size		: 17px;
	color			: white;
	display			: block;
	padding			: 5%;
}

button a:hover{
	background-color: white;
	color: black;	
	border: none;
	display	: block;
	border-radius	: 15px;
}



.headeradmin .title h1{
    font-family	: Times new roman;
    color 	: white;
}

.sidebar{
    background-color	: black;
    position		: absolute;
    height		: 1600px;
    width		: 250px;
}

.sidebar a img{
    margin-top		: 20px;
    text-align		: center;
    margin-bottom	: 20px;
}

.sidebar ul{
        list-style: none;
        position: relative;
        width: auto;
}

.sidebar ul li{
	float:center;
}

.sidebar ul li a:hover{
	background: #CC0066;
	color: white;
	text-decoration : bold;
}

.sidebar ul li a{
	display: block;
        padding: 25px;
        text-decoration: none;
    	font-size		: 17px;
   	font-family	: Times new roman;
    	color 		: white;
	text-decoration : bold;

}

.page{
background-color: transparent;
margin-top	: 28px;
position	: relative;
height		: auto;
width		: 75%;
padding		: 25px;
margin-left	: 280px;
margin-bottom	: 2%;
font-family	: Times new roman;
}

.profil{
text-align	: center;
padding-top	: 8%;
padding-bottom	: 8%;
}
</style>





<div class="headeradmin">

<div class="title">
<h1>ADMIN</h1>
<button><a href="index.php?halaman=logout">Logout</a></button>
</div>

</div>

<div class="sidebar">
<div class="profil">
<img src="iconadmin.png" width="180">
</div>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="index.php?halaman=kategori"><i class="fa fa-dashboard fa-3x"></i>Categories</a></li>
<li><a href="index.php?halaman=produk"><i class="fa fa-dashboard fa-3x"></i>Available Menu</a></li>
<li><a href="index.php?halaman=pembelian"><i class="fa fa-dashboard fa-3x"></i>Purchase Data</a></li>
<li><a href="index.php?halaman=laporan_pembelian"><i class="fa fa-dashboard fa-3x"></i>Purcase Report</a></li>
<li><a href="index.php?halaman=pelanggan"><i class="fa fa-dashboard fa-3x"></i>Customer Data</a></li>
</ul>
</div>



<div class="page">
<?php
		if(isset($_GET['halaman']))
		{
			if($_GET['halaman']=="produk")
			{
				include 'produk.php';
			}
			else if($_GET['halaman']=="pembelian")
			{
				include 'pembelian.php';
			}
			else if($_GET['halaman']=="pelanggan")
			{
				include 'pelanggan.php';
			}
			else if($_GET['halaman']=="detail")
			{
				include 'detail.php';
			}
			else if($_GET['halaman']=="tambahproduk")
			{
				include 'tambahproduk.php';
			}
			else if($_GET['halaman']=="hapusproduk")
			{
				include 'hapusproduk.php';
			}
			else if($_GET['halaman']=="ubahproduk")
			{
				include 'ubahproduk.php';
			}
			else if($_GET['halaman']=="hapuspelanggan")
			{
				include 'hapuspelanggan.php';
			}
			else if($_GET['halaman']=="logout")
			{
				include 'logout.php';
			}
			else if($_GET['halaman']=="kategori")
			{
				include 'kategori.php';
			}
			else if($_GET['halaman']=="tambahkategori")
			{
				include 'tambahkategori.php';
			}
			else if($_GET['halaman']=="hapuskategori")
			{
				include 'hapuskategori.php';
			}
			else if($_GET['halaman']=="ubahkategori")
			{
				include 'ubahkategori.php';
			}
			else if($_GET['halaman']=="pembayaran")
			{
				include 'pembayaran.php';
			}
			else if($_GET['halaman']=="laporan_pembelian")
			{
				include 'laporan_pembelian.php';
			}
		}
		else
		{
			include 'home.php';
		}          
	      ?>
</div>





</body>
</html>