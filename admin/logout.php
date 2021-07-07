<?php

session_destroy();
echo "<script>alert('Anda berhasil logout.');</script>";
echo "<script>location='login.php';</script>";

?>