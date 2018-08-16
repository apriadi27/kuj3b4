<?php
	include "../config/config.php";
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
<?php
	$sql = "SELECT * FROM dataproduct";
	$query
?>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 0px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
	<div class="w3-card-4" style="width: 200px; float: left; margin: 0 60px 50px 0;">
		<img src="../picture/sample.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Pedofil</b><br>
		    Rp 1.000,-
		</div>
	</div>
</div>
</body>
</html>
<?php
	$mysqli->close();
?>