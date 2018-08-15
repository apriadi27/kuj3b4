<?php
    include "../config/config.php";
    include "../config/sessionUser.php";
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
	<script src="js/ajax.js"></script>
    <script src="js/login.js"></script>
	<script src="js/user.js"></script>
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
    $totalPrice = 0;
    $id = $_SESSION['id'];
    $sql = "SELECT product.idProduct,
            product.sellingPrice,
            dataproduct.name,
            dataproduct.picture,
            trolli.total
            FROM trolli
            INNER JOIN product
            ON trolli.idProduct = product.idProduct
            INNER JOIN dataproduct
            ON trolli.idProduct = dataproduct.idProduct
            WHERE trolli.idAccount=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($idProduct, $sellingPrice, $name, $picture, $total);
            ?>
            <table class="w3-table w3-bordered" style="margin-bottom: 40px;">
                <tr class="w3-blue">
                    <td>Produk yang Dipesan</td>
                </tr>
            <?php
            $i = 1;
            while ($stmt->fetch()) {
                $i++;
                ?>
                <tr>
                    <td>
                    <div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 0px 0;">
                        <img src="<?php echo "productPicture/".$picture; ?>" alt="Norway" style="width: 200px">
                        <div style="padding: 10px;">
                            <b><?php echo $name; ?></b><br>
                            Jumlah : <?php echo $total ?><br>
                            <?php echo $sellingPrice ?>
                        </div>
                    </div>
                    <div>
                        Total = <?php echo $sellingPrice*$total; $totalPrice += $sellingPrice*$total ?>
                    </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <input type="hidden" id="totalItem" value="<?php echo $i; ?>">
            <?php
        }
        else{
            echo "Execute failed";
        }
    }
    else{
        echo "Prepare failed";
    }
?>
    Pilih alamat : <select name="address" id="address" onchange="changeDestination()">
            <?php
            $sql = "SELECT idContact, Address, idCity FROM contact";
            $query = $mysqli->query($sql);
            while($row = $query->fetch_assoc()){
                ?>
                <option value="<?php echo $row['idCity']; ?>"><?php echo $row['Address']; ?></option>
                <?php
            }
            ?></select><br>
    <script>
        getCost(document.getElementById('address').value);
    </script>
    <table class="w3-table w3-bordered" style="margin-bottom: 40px;">
        <tr class="w3-blue">
            <td>Jasa Pengiriman</td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="margin: -5px 0">Nama Perusahaan : JNE</p><br>
                <p style="margin: -5px 0">Jenis Service : <select name="service" id="service"></select></p><br><br>
            </td>
        </tr>
    </table>

        

    <p style="margin-top: 40px">Total biaya : <p id="totalPrice"><?php echo $totalPrice; ?></p></p><br>
    <button class="w3-btn w3-blue" style="margin-top: 10px">Konfirmasi Pesanan</button>
</div>

</body>
</html>
<?php
	$mysqli->close();
?>