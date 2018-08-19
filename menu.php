<div class="header w3-cyan">
	<button class="menuButton w3-hover-white" onclick="openNav()"><i class="fas fa-bars fa-2x"></i></button>
	<p class="toko">Toko Kamanda Shop</p>
    <img id="profilePicture" class="profil" onmouseover="menuProfilIn()" onmouseout="menuProfilOut()">

        <div class="menuProfil w3-card-4 out" id="menuProfil" onmouseover="menuProfilIn()" onmouseout="menuProfilOut()">
			<a href="keranjang.php"><button>Keranjang</button></a><br>
			<a href="confirmation.php"><button>Konfirmasi Pesanan</button></a><br>
			<a href="kontak.php"><button>Pengaturan Kontak</button></a><br>
			<a href="index.php" onclick="signOut();"><button>Log Out</button></a>
		</div>

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