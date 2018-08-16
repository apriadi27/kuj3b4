<?php
	include "config/config.php";
	session_start();

	if (isset($_SESSION['status']) && isset($_SESSION['idToken'])) {
		# code...
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Toko Baju 2</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" type="text/css" href="style/w3.css">
	<link rel="stylesheet" type="text/css" href="style/css.css">
	<link rel="stylesheet" type="text/css" href="style/all.css">
	<script src="js/ajax.js"></script>
	<script src="js/login.js"></script>
	<script src="js/all.js"></script>
	<script>
		function openNav(){
			document.getElementById('sidenav').style.display="block";
		}
		function closeNav(){
			document.getElementById('sidenav').style.display="none";
		}
		function kategoriColorWhite(){
			document.getElementById('kategori').classList.add('w3-white');
		}
		function kategoriColorCyan(){
			document.getElementById('kategori').classList.remove('w3-white');
		}
	</script>
</head>
<body>

<nav class="w3-sidenav w3-animate-left w3-cyan w3-card-12" style="display: none; width: 20%;" id="sidenav">
<a class="w3-hover-white" style="color: white; font-size: 19px; padding-top: 10px; cursor: pointer;" onclick="closeNav()"><b>Close X</b></a>
<a href="index.php" class="w3-hover-white" style="color: white;"><i class="fas fa-home" style="margin-right: 20px;"></i>Home</a>
	<div class="w3-dropdown-hover">
      <a class="w3-hover-white" id="kategori"><i class="fas fa-chart-pie" style="margin-right: 20px;"></i>Kategori</a>
      <div class="w3-dropdown-content w3-card-4" style="width: 200px; transition: 0.5s;">
      	<?php
			$sql = "SELECT * FROM category";
			$query = $mysqli->query($sql);
			while ($row = $query->fetch_assoc()) {
				if($row['idCategory'] != 1){
		?>		
				<a href="#" style="width: 100%" class="w3-hover-cyan" onmouseover="kategoriColorWhite()" onmouseout="kategoriColorCyan()"><?php echo ucfirst($row['name']); ?></a>
		<?php
				}
			}
		?>
      </div>
    </div>
</nav>

<div class="header w3-cyan">
	<button class="menuButton w3-hover-white" onclick="openNav()"><i class="fas fa-bars fa-2x"></i></button>
	<p class="toko"><i>Toko Kamanda Shop</i></p>
	<input type="text" name="search" placeholder="Cari produk" class="search">

	<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float: right;"></div> 
    <script> 
      function onSignIn(googleUser) { 
        // Useful data for your client-side scripts: 
        var profile = googleUser.getBasicProfile(); 
        console.log("ID: " + profile.getId()); // Don't send this directly to your server! 
        console.log('Full Name: ' + profile.getName()); 
        console.log('Given Name: ' + profile.getGivenName()); 
        console.log('Family Name: ' + profile.getFamilyName()); 
        console.log("Image URL: " + profile.getImageUrl()); 
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend: 
        var id_token = googleUser.getAuthResponse().id_token; 
        console.log("ID Token: " + id_token); 
      }; 
	</script>
	
</div>

<div class="isi">
<?php
	$sql = "SELECT ";
?>
	<div class="w3-card-12" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="picture/jilbab1.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Hijab Instan Khimar Simpel Pet</b><br>
		    15000
		</div>
	</div>
	<div class="w3-card-12" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="picture/jilbab2.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>jilbab2Ciput DE'CANTIQU - Ankem/Antem/Inner - Rose</b><br>
		    25000
		</div>
	</div>
	<div class="w3-card-12" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="picture/jilbab3.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Jilbab Satin Velvet Segiempat Square Polos</b><br>
		    20000
		</div>
	</div>
	<div class="w3-card-12" style="width: 200px; float: left; margin: 0 55px 50px 0;">
		<img src="picture/jilbab4.jpg" alt="Norway" style="width: 200px">
		<div style="padding: 10px;">
		    <b>Hijab / Jilbab Hasya Rempel</b><br>
		    34000
		</div>
	</div>
</div>
</body>
</html>
<?php
	$mysqli->close();
?>