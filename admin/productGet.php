<?php
    include "../config/config.php";
    include "../config/session.php";

    $id = $_POST['id'];
    $json = '{"product": {';
    $sql = "SELECT dataproduct.name,
            dataproduct.description,
            dataproduct.size,
            dataproduct.color,
            dataproduct.picture,
            product.capital,
            product.idCategory,
            product.sellingPrice,
            product.stock
            FROM product
            INNER JOIN dataproduct
            ON product.idProduct = dataproduct.idProduct
            WHERE product.idProduct = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlName, $sqlDescription, $sqlSize, $sqlColor, $sqlPicture, $sqlCapital,
                $sqlIdCategory, $sqlSellingPrice, $sqlStock);
            while ($stmt->fetch()) {
                $json .= '"name":"'.$sqlName.'",'.'"description":"'.$sqlDescription.'",'.
                '"size":"'.$sqlSize.'",'.'"color":"'.$sqlColor.'",'.'"picture":"'.$sqlPicture.'",'.
                '"capital":"'.$sqlCapital.'",'.'"sellingprice":"'.$sqlSellingPrice.'",'.
                '"category":"'.$sqlIdCategory.'",'.'"stock":"'.$sqlStock.'"}';
            }
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        echo $mysqli->error;
    }
    $json .= '}';

    echo $json;
?>