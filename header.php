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
				<a href="category.php?id=<?php echo $row['idCategory']; ?>" style="width: 100%" class="w3-hover-cyan" onmouseover="kategoriColorWhite()" onmouseout="kategoriColorCyan()"><?php echo ucfirst($row['name']); ?></a>
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
	<img src="<?php echo $_SESSION['picture']; ?>" alt="Profil" class="profil" id="profileGoogle" style="display: none">
    <script> 
    function onSignIn(googleUser) {
    	var idGoogle;
    	var profile = googleUser.getBasicProfile(); 
    	idGoogle = profile.getEmail(); 
    	var picture = profile.getImageUrl();
    	document.getElementById("googleSignIn").style.display = "none";
    	// The ID token you need to pass to your backend: 
    	sendBack(idGoogle, picture);
    };
    function sendBack(idGoogle, picture){
        var input = "idGoogle=" + idGoogle + "&picture=" + picture;
        var request =  ajax(request);
        request.onreadystatechange = function() {
            if (request.status == 200 && request.readyState == 4) {
               var respon = request.responseText;
                    
                var json = JSON.parse(respon);
                if(json.status == 1){
                    window.location = "https://stromzivota.web.id/admin/index.php";
                }
				else if(json.status == 0){
					document.getElementById('googleSignIn').style.display = "none";
					document.getElementById('profileGoogle').style.display = "block";
					document.getElementById('profileGoogle').src = picture;
				}
                else{
                    console.log(json.message);
                }
            }
        };
        request.open("POST", "config/checkGoogle.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(input);
    };
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });
        window.location = 'index.php';
    }
</script>
	
</div>
