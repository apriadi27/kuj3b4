<?php
    include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Konfirmasi Pembayaran</title>
    <script src="../js/ajax.js"></script>
    <script src="../js/category.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
    <link rel="stylesheet" type="text/css" href="../style/all.css">
    <script src="../js/all.js"></script>
    <script>
		function openNav(){
			document.getElementById('sidenav').style.display="block";
		}
		function closeNav(){
			document.getElementById('sidenav').style.display="none";
		}
    </script>
    <style>
        .icon{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<?php
    include 'menu.php';
?>

    <div class="isi" style="margin: 0 200px;">
        <table class="w3-table w3-centeblue w3-striped" style="width: 800px; margin-top: 20px;">
            <tr class="w3-blue">
                <th>No. Transaksi</th>
                <th>No. Resi</th>
                <th>Status</th>
                <th>Konfirmasi</th>
            <tr>
        </table>
    </div>
</body>
</html>