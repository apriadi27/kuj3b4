<?php
    //include "../config.session.php";
    include '../config/config.php';

    $valueSql = array();
    if (isset($_POST['submit'])) {
        $accept = array("jpg", "png", "svg", "webp");

        for ($i=0; $i < count($_FILES['picture']['name']); $i++) {
            
            $uploaddir = "../productPicture/";
            $imageInfo = getimagesize($_FILES['picture']['tmp_name'][$i]);
            $image = $_FILES['picture']['name'][$i];
            $tmp = explode(".", $image);
            $extension = count($tmp) - 1;
            $fileName = md5($tmp[0]);
            $uploadfile = $uploaddir.$fileName.".".$tmp[$extension];
            $a = false;

            //cek ekstensi
            for ($j=0; $j < count($accept); $j++) { 
                if($accept[$j] == $tmp[$extension]) {
                    $a = true;
                    break;
                }
            }
            if ($a) {
                if($imageInfo[0] > 0 && $imageInfo[1] > 0){
                    if (move_uploaded_file($_FILES['picture']['tmp_name'][$i], $uploadfile)) {
                        array_push($valueSql, $fileName.".".$tmp[$extension]);
                    } else {
                        header("Location: product.php?message=Gagal mengunggah file");
                        //echo "Possible file upload attack!\n";
                    }
                }
                else{
                    header("Location: product.php?message=File bukan gambar");
                    //echo "file bukan gambar";
                }
            }
            else{
                header("Location: product.php?message=Extensi tidak diterima");
                //echo "exteksi tidak diterima";
            }
        }
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $category = $_POST['category'];
        $smallSize = htmlspecialchars($_POST['smallSize']);
        $bigSize = htmlspecialchars($_POST['bigSize']);
        $color = $_POST['color'];
        $capital = htmlspecialchars($_POST['capital']);
        $sellingPrice = htmlspecialchars($_POST['sellingPrice']);
        $stock = htmlspecialchars($_POST['stock']);
        echo $color;
        $size = $smallSize."-".$bigSize;
        //insert to product
        $sql = "INSERT INTO product (idCategory, capital, sellingPrice, stock)
                VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iiii", $category, $capital, $sellingPrice, $stock);
            if ($stmt->execute()) {
                $idProduct = $stmt->insert_id;
            }
            else{
                header("Location: product.php?message=Produk gagal dieksekusi");
                //echo "execute failed";
            }
        }
        else{
            header("Location: product.php?message=Produk gagal disiapkan");
            //echo "prepare failed";
        }

        //insert detail to dataproduct
        $sql = "INSERT INTO dataproduct (idProduct, name, description, size, color)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("issss", $idProduct, $name, $description, $size, $color);
            if ($stmt->execute()) {

            }
            else{
                header("Location: product.php?message=Data produk gagal dieksekusi");
                //echo "execute failed";
            }
        }
        else{
            header("Location: product.php?message=Data produk gagal disiapkan");
            //echo "prepare failed";
        }

        $stringSql = "";
        for ($i=0; $i < count($valueSql); $i++) {
            if ($i != count($valueSql) - 1) {
                $stringSql .= "('".$idProduct."','".$idProduct.$valueSql[$i]."'),";
            } 
            else{
                $stringSql .= "('".$idProduct."','".$idProduct.$valueSql[$i]."')";
            }
        }
        $sql = "INSERT INTO picture (idProduct, picture) VALUES ".$stringSql;
        $query = $mysqli->query($sql);
        if (query) {
            header("Location: product.php");
            //echo "prepare failed";
        }
        //$imageInfo = getimagesize($_FILES['picture']["tmp_name"]);
        /*for ($i=0; $i < count($accept); $i++) { 
            for ($j=0; $j < count($_FILES['picture']['name']); $j++) { 
                echo $j."<br>";
                $image = $_FILES['picture']['name'][$j];
                $tmp = explode(".", $image);
                $extension = count($tmp) - 1;
                
                //cek ekstensi
                if($accept[$i] == $tmp[$extension]) {
                    
                    //cek ukuran pixel
                    $imageInfo = getimagesize($_FILES['picture'])['tmp_name'][$j];
                    if ($imageInfo[0] > 0 && $imageInfo[1] > 0) {
                        echo "accepted";
                    }
                    else{
                        echo "bukan gambar";
                    }
                }
                else{
                    echo "not accepted";
                }
            }
        }*/
    }
?>