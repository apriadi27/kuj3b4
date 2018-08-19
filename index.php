<?php
	include "config/config.php";
	include "config/sessionUser.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head.php"; ?>
</head>
<body>

<?php include "header.php"; ?>

<div style="margin: 30px -20px 20px 80px;">
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