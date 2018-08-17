<?php
	include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Toko Baju 1</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
	<script src="../js/ajax.js"></script>
	<script src="../js/login.js"></script>
</head>
<script>
	function menuProfilIn(){
		document.getElementById('menuProfil').classList.add('in');
		document.getElementById('menuProfil').classList.remove('out');
	}
	function menuProfilOut(){
		document.getElementById('menuProfil').classList.remove('in');
		document.getElementById('menuProfil').classList.add('out');
	}
</script>
<body>

<?php
  include 'header.php';
?>

<div class="isi">
<center>
    <input type="text" name="bankName" placeholder="Nama Bank" class="search" style="width: 400px; margin: 20px 0 40px -27px;"><br>
    <input type="number" name="amountPayment" placeholder="Jumlah Pembayaran" class="search" style="width: 400px; margin-bottom: 40px;"><br>
    Upload bukti pembayaran : <input type="file" name="picturePayment" style="margin-bottom: 40px;"><br>
    <p style="margin: -10px 0 -20px -355px">No. Transaksi : </p><br>
    <button class="w3-btn w3-blue" style="margin: 40px 0 0 -27px">Bayar</button
</div>

</body>
</html>
<?php
	$mysqli->close();
?>