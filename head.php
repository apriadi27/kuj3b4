<title>Toko Kamanda Shop</title>
<meta name="google-signin-scope" content="profile email"> 
<meta name="google-signin-client_id" content="44829741526-n8hkhikvhdc03ace9qef0cj4lhm2mo3n.apps.googleusercontent.com"> 
<script src="https://apis.google.com/js/platform.js" async defer></script>
<link rel="stylesheet" type="text/css" href="style/w3.css">
<link rel="stylesheet" type="text/css" href="style/css.css">
<link rel="stylesheet" type="text/css" href="style/all.css">
<script src="js/ajax.js"></script>
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