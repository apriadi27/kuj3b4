<?php
	include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Toko Kamanda Shop</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php
        include 'head.php';
    ?>
</head>
<body>

<?php
  include 'header.php';
?>

<div class="isi">
<center>
    <table class="w3-table w3-centered" style="width: 800px; margin-top: 20px;">
        <tr class="w3-cyan">
            <th>No. Transaksi</th>
            <th>No. Resi</th>
            <th>Status</th>
        <tr>
    </table>
</div>

</body>
</html>
<?php
	$mysqli->close();
?>