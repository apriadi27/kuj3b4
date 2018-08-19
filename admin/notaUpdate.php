<?php
    include "../config/config.php";
    include "../config/session.php";

    $idNota = $_POST['idNota'];
    $date = date('Y-m-d');
    $status = 1;
    $json = '{';
    $sql = "UPDATE nonota SET status=? WHERE idNota=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ii", $status, $idNota);
        if ($stmt->execute()) {
            $json .= '"status":1,"message":""}';
        }
        else{
            $json .= '"status":0,"message":"'.$stmt->error.'"}';
        }
    }
    else{
        $json .= '"status":0,"message":"'.$mysqli->error.'"}';
    }

    //insert transaction
    $transactionArray = array();
    $transactionValues = "";
    $sql = "SELECT
            dataproduct.name,
            product.capital,
            product.sellingPrice,
            orderr.total,
            nonota.idAccount
            FROM product
            INNER JOIN dataproduct
            ON product.idProduct = dataproduct.idProduct
            INNER JOIN orderr
            ON orderr.idProduct = product.idProduct
            INNER JOIN nonota
            ON nonota.idNota = nonota.idNota
            WHERE orderr.idNota = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $idNota);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlName, $sqlCapital, $sqlSellingPrice, $sqlTotal, $sqlIdAccount);
            while ($stmt->fetch()) {
                array_push($transactionArray,'("'.$sqlIdAccount.'","'.$sqlName.'","'.$sqlTotal.'","'.$sqlCapital.'","'.$sqlSellingPrice.'","'.$date.'")');
            }  
        }
        else{
            $json .= '"status":0,"message":"'.$stmt->error.'"}';
        }
    }
    else{
        $json .= '"status":0,"message":"'.$mysqli->error.'"}';
    }

    for ($i=0; $i < count($transactionArray); $i++) { 
        if ($i < count($transactionArray) - 1) {
            $transactionValues .= $transactionArray[$i].",";
        }
        else{
            $transactionValues .= $transactionArray[$i];
        }
    }

    $sql = "INSERT INTO transaction (idAccount, productName, total, capital, sellingPrice, date)
            VALUES".$transactionValues;
    if($query = $mysqli->query($sql)){
        
    }


    //end insert transaction
    echo $json;

?>