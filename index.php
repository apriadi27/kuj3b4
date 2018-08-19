<?php
	include "config/sessionUser.php";
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
    include "header.php";
?>

<div style="margin: 30px -20px 20px 80px;">
<?php
	$sql = "SELECT product.idProduct, 
			product.sellingPrice, 
			dataproduct.name,
			dataproduct.picture
			FROM product
			INNER JOIN dataproduct
            ON product.idProduct = dataproduct.idProduct
            WHERE product.stock > 0";
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