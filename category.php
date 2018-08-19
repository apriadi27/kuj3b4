<?php
    include "config/config.php";
    include "config/sessionUser.php";

    $id = htmlspecialchars($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'head.php';
    ?>
</head>
<body>
<?php 
    include "header.php";
?>
<div class="isi">
<?php
	$sql = "SELECT product.idProduct, 
			product.sellingPrice, 
			dataproduct.name,
			dataproduct.picture
			FROM product
			INNER JOIN dataproduct
            ON product.idProduct = dataproduct.idProduct
            WHERE product.idCategory=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlIdProduct, $sqlPrice, $sqlName, $sqlPicture);
            while ($stmt->fetch()) {
                ?>
                <a href="detailProduct.php?idProduct=<?php echo $sqlIdProduct; ?>">
                    <div class="w3-card-12" style="width: 200px; float: left; margin: 0 55px 50px 0;">
                        <img src="productPicture/<?php echo $sqlPicture; ?>" alt="Norway" style="width: 200px">
                        <div style="padding: 10px;">
                            <b><?php echo $sqlName; ?></b><br>
                            <?php echo $sqlPrice; ?>
                        </div>
                    </div>
                </a>
                <?php
            }
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        $mysqli->error;
    }
?>
</div>
</body>
</html>