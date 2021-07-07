<?php
session_start();
//skrip koneksi
$koneksi = new mysqli("localhost","root","","onlineshop");
?>

<!DOCTYPE html>
<html>
<head>
<title>The Crown Cafe : Administrator Login</title>
</head>
<body>

<style>
*{
	margin: 0;
	padding: 0;

}

html{
   	background-image:;
	background-color: white;
	background-size: ;
	margin: 0;
	padding: 0;
}

.img {
position: absolute;
margin-top: 0%;
margin-left: 63%;
}

.loginform {
position: relative;
width: 40%;
padding: 2%;
margin-top :12%;
margin-left:20%;
background-color: ;
}

.loginform h2 {
font-family: Times new roman;
text-align: left;
color: #CC0066;
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

<div class="img">
<img src="blossom3.png" width="500px">
</div>

<div class="loginform">
<form method="post">

<h2>The Crown Toast : Login</h2>
<p>Silahkan login sebelum masuk ke dashboard.</p>

	<div class="form-group">
	<label>Username:</label>
	<input type="text" class="form-control" name="user" placeholder=" Username Anda">
	</div>

	<div class="form-group"
	<label>Password:</label>
	<input type="password" class="form-control" name="pass" placeholder=" Password Anda">
	</div>

	<button class="btn btn-primary" name="login">Login</button><br>

	
<?php
if(isset($_POST['login']))
{
	$ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok==1)
	{
		$_SESSION['admin']=$ambil->fetch_assoc();
		echo "<script>alert('Anda berhasil login.');</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php'>";
	}
	else
	{
		echo "<br>";
		echo "<script>alert('Anda gagal login.');</script>";
		echo "<meta http-equiv='refresh' content='1;url=login.php'>";
	}
}
?>
</form>
</div>

</body>
</html>