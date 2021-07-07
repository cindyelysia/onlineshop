<?php
session_start();

// mendapatkan id_produk dari url dan jumlah
$id_produk = $_GET['id'];

// jika sudah ada produk itu dikeranjang, maka +jumlah
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

// selain itu, belum ada dikeranjang maka dianggap beli 1
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}



// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//ke halaman keranjang
echo "<script>alert('Pesanan anda telah ditambahkan ke keranjang belanja.');</script>";
echo "<script>location='keranjang.php';</script>";
?>