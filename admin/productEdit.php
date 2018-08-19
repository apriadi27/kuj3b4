<?php
    include "../config/session.php";
    include "../config/config.php";

    $idProduct = $_POST['idProductEdit'];

    $accept = "jpg";
    $image = $_FILES['pictureEdit']['name'];
    $tmpImage = $_FILES['pictureEdit']['tmp_name'];
    $tmp = explode(".", $image);
    $extension = count($tmp) - 1;
    $fileName = md5($tmp[0]);

    $uploaddir = "../productPicture/";
    $filPictureName = $idProduct.$fileName.".".$tmp[$extension];
    $uploadfile = $uploaddir.$filPictureName;

    if ($extension = $accept) {
        if (move_uploaded_file($tmpImage, $uploadfile)) {
            $name = htmlspecialchars($_POST['nameEdit']);
            $description = htmlspecialchars($_POST['descriptionEdit']);
            $category = $_POST['categoryEdit'];
            $smallSize = htmlspecialchars($_POST['smallSizeEdit']);
            $bigSize = htmlspecialchars($_POST['bigSizeEdit']);
            $color = $_POST['colorEdit'];
            $capital = htmlspecialchars($_POST['capitalEdit']);
            $sellingPrice = htmlspecialchars($_POST['sellingPriceEdit']);
            $stock = htmlspecialchars($_POST['stockEdit']);
            $size = $smallSize."-".$bigSize;

            //update product
            $sql = "UPDATE product
                    SET idCategory=?,
                    capital=?,
                    sellingPrice=?,
                    stock=?
                    WHERE idProduct=?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("iiiii", $category, $capital, $sellingPrice, $stock, $idProduct);
                if ($stmt->execute()) {
                    
                }
                else{
                    header("Location: product.php?message=".$stmt->error);
                }
                $stmt->close();
            }
            else{
                header("Location: product.php?message=".$mysqli->error);
            }
            //end update product

            //update data product
            $sql = "UPDATE dataproduct
                    SET name=?,
                    description=?,
                    size=?,
                    color=?,
                    picture=?
                    WHERE idProduct=?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssssi", $name, $description, $size, $color, $filPictureName, $idProduct);
                if ($stmt->execute()) {
                    header("Location: product.php");
                }
                else{
                    header("Location: product.php?message=".$stmt->error);
                }
                $stmt->close();
            }
            else{
                header("Location: product.php?message=".$mysqli->error);
            }
        } else {
            header("Location: product.php?message=Gagal mengunggah file");
        }
    }
    else{
        header("Location: product.php?message=Hanya menerima format gambar jpg");
    }

    
    

?>