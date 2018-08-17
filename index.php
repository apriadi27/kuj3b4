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
	<title>Toko Kamanda Shop</title>
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
		function menuProfilIn(){
            document.getElementById('menuProfil').classList.add('in');
            document.getElementById('menuProfil').classList.remove('out');
        }
        function menuProfilOut(){
            document.getElementById('menuProfil').classList.remove('in');
            document.getElementById('menuProfil').classList.add('out');
        }
	</script>
</head>
<body>
<?php include "header.php"; ?>

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
	$sql = "SELECT product.idProduct, 
			product.sellingPrice, 
			dataproduct.name,
			dataproduct.picture
			FROM product
			INNER JOIN dataproduct
			ON product.idProduct = dataproduct.idProduct";
	if ($query = $mysqli->query($sql)) {
		while ($row = $query->fetch_assoc()) {
			?>
			<a href="detailProduct.php?idProduct=<?php echo $row['idProduct']; ?>">
                <div class="w3-card-4" style="width: 200px; float: left; margin: 0 20px 40px">
                    <img src="productPicture/<?php echo $row['picture']; ?>" alt="Norway" class="produk">
                    <div style="padding: 10px 20px;">
                        <div style="margin: 0 0 20px; height: 50px"><b><?php $name = (strlen($row['name']) > 40) ? substr($row['name'],0, 40)."..." : substr($row['name'],0, 40); echo $name; ?></b></div><br>
                        <p style="margin-top: -20px;"><?php echo $row['sellingPrice']; ?></p>
                    </div>
                </div>
            </a>
			<?php
		}
	}
?>
</div>
</body>
</html>
<?php
	$mysqli->close();
?>