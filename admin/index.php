<?php
    $string = file_get_contents('../config.json');
	$json = json_decode($string, true);
	if ($json['new'] == 1) {
		header("Location: ../init.php");
	}
    //include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Baju 1 - Admin</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="isi">
  
</div>