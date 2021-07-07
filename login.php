<?php
session_start();
//skrip koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Customer Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>

<style>
img {
width: 250px;
margin-left:0%;
margin-top :15%;
position: absolute;
}

.loginform {
position: relative;
width: 35%;
padding: 2%;
margin-bottom :3%;
margin-top :5%;
margin-left:19%;
}

.loginform h2 {
font-family: Times new roman;
text-align: left;
}

.loginform p {
font-family: Times new roman;
text-align: left;
margin-bottom: 3%;
padding-bottom: 2%;
border-bottom: 1px solid black;
}

button {
box-shadow: 2px 2px 4px grey;
background-color: #606060;
color: white;
text-decoration: none;
padding-left: 3%;
padding-right: 3%;
padding-top: 2%;
padding-bottom: 2%;
border: none;
margin-left: 88%;
margin-top :2%;
}

button:hover {
background-color: #CC0066;
}

.form-group {
margin-bottom	: 2%;
margin-top	: 4%;
}

input {
width		: 98%;
padding		: 5px;
margin-top	: 1%;
}

</style>

<?php include 'menu.php' ?>

<img src="header/blossom2.png">

<form method="post" class="loginform">

<h2>Login</h2>
<p>Silahkan login sebelum melakukan pembelian.</p>

	<div class="form-group">
	<label>Email:</label>
	<input type="email" class="form-control" name="email" placeholder=" Email Anda">
	</div>

	<div class="form-group"
	<label>Password:</label>
	<input type="password" class="form-control" name="password" placeholder=" Password Anda">
	</div>

	<button class="btn btn-primary" name="login">Login</button><br>

	
<?php
if(isset($_POST['login']))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok==1)
	{
		$_SESSION['pelanggan']=$ambil->fetch_assoc();
		echo "<script>alert('Anda berhasil login.');</script>";

		//jika sudah belanja
		if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
		{
			echo "<meta http-equiv='refresh' content='1;url=checkout.php'>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		}
	}
	else
	{
		echo "<br>";
		echo "<script>alert('Anda gagal login, Silahkan coba lagi.');</script>";
		echo "<meta http-equiv='refresh' content='1;url=login.php'>";
	}
}
?>
</form>

</body>
</html>