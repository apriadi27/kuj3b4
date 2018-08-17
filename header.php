<nav class="w3-sidenav w3-animate-left w3-cyan w3-card-12" style="display: none; width: 20%;" id="sidenav">
<a class="w3-hover-white" style="color: white; font-size: 19px; padding-top: 10px; cursor: pointer;" onclick="closeNav()"><b>Close X</b></a>
<a href="index.php" class="w3-hover-white" style="color: white;"><i class="fas fa-home" style="margin-right: 20px;"></i>Home</a>
<a class="w3-hover-white" href="keranjang.php"><i class="fas fa-chart-pie" style="margin-right: 20px;"></i>Keranjang</a>
<a class="w3-hover-white" href="confirmation.php"><i class="fas fa-chart-pie" style="margin-right: 20px;"></i>Konfirmasi Pesanan</a>
<a class="w3-hover-white" href="kontak.php"><i class="fas fa-chart-pie" style="margin-right: 20px;"></i>Pengaturan Kontak</a>
<a href="#" onclick="signOut();"><i class="fas fa-chart-pie" style="margin-right: 20px;"></i>Log Out</a>
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

	<div id="googleSignIn" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float: right;"></div> 
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
	<img src="" alt="Profil" id="profileGoogle" style="display: none">
</div>
<div class="menuProfil w3-card-4 out" id="menuProfil" onmouseover="menuProfilIn()" onmouseout="menuProfilOut()">
</div>
