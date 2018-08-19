<?php
    include "../config/session.php";
    include '../config/config.php';
    include "../API/instagram.php";

    $valueSql = array();
    if (isset($_POST['submit'])) {
        $accept = "jpg";
        $uploaddir = "../productPicture/";
        $imageInfo = getimagesize($_FILES['picture']['tmp_name']);
        $image = $_FILES['picture']['name'];
        $tmp = explode(".", $image);
        $extension = count($tmp) - 1;
        $fileName = md5($tmp[0]);
        $uploadfile = $uploaddir.$fileName.".".$tmp[$extension];

        if ($accept == $tmp[$extension]) {
            if($imageInfo[0] > 0 && $imageInfo[1] > 0){
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    array_push($valueSql, $fileName.".".$tmp[$extension]);
                } else {
                    header("Location: product.php?message=Gagal mengunggah file");
                }
            }
            else{
                header("Location: product.php?message=File bukan gambar");
            }
        }
        else{
            header("Location: product.php?message=Extensi tidak diterima");
        }
        //end for
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $category = $_POST['category'];
        $smallSize = htmlspecialchars($_POST['smallSize']);
        $bigSize = htmlspecialchars($_POST['bigSize']);
        $color = $_POST['color'];
        $capital = htmlspecialchars($_POST['capital']);
        $sellingPrice = htmlspecialchars($_POST['sellingPrice']);
        $stock = htmlspecialchars($_POST['stock']);
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
            }
        }
        else{
            header("Location: product.php?message=Produk gagal disiapkan");
        }

        //insert detail to dataproduct
        $newImageName = $idProduct.$fileName.".".$tmp[$extension];
        $sql = "INSERT INTO dataproduct (idProduct, name, description, size, color, picture)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("isssss", $idProduct, $name, $description, $size, $color, $newImageName);
            if ($stmt->execute()) {
                rename($_SERVER['DOCUMENT_ROOT']."/productPicture/".$fileName.".".$tmp[$extension], $_SERVER['DOCUMENT_ROOT']."/productPicture/".$newImageName);
            }
            else{
                header("Location: product.php?message=Data produk gagal dieksekusi");
            }
        }
        else{
            header("Location: product.php?message=Data produk gagal disiapkan");
        }

        $sql = "SELECT userSosmed, pass FROM sosmed WHERE type='Instagram'";
        if($query = $mysqli->query($sql)){
            if($query->num_rows > 0){
                
            $row = $query->fetch_assoc();
    
            //decrpt
            $pass = base64_decode($row['pass']);
            $instagram = new InstagramUpload;
            $instagram->Login($row['userSosmed'], $pass);
            $instagram->UploadPhoto($_SERVER['DOCUMENT_ROOT']."/productPicture/".$newImageName, $description);
            header("Location: product.php");    
            }
            else{
                header("Location: product.php?message=Akun instagram belum ada");
            }
        }
    }
?>