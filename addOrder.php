<?php
    include "config/config.php";
    include "config/sessionUser.php";

    //$json = array();
    //$json['error'] = array();
    //$json['']['']

    $id = $_SESSION['id'];
    $service = $_POST['service'];
    $price = $_POST['price'];
    $contact = $_POST['contact'];
    $date = date('Y-m-d');
    $status = 0;
    //check nota
    $checkIdNota;
    $idNota;
    $isiNota = 0;
    $sql = "SELECT idNota FROM nonota WHERE idAccount=? and status=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $id, $status);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlIdNota);
            $isiNota = 0;
            while ($stmt->fetch()) {
                $isiNota++;
                $checkIdNota = $sqlIdNota;
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
    
    //create nota
    $json;
    $status = 0;
    if ($isiNota == 0) {
        $service = explode(" Rp ", $service);
        $json = '{';
        $idNota;
        $sql = "INSERT INTO nonota (idAccount, tanggal, service, ongkir, status) VALUES(?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssii", $id, $date, $service[0], $price, $status);
            if ($stmt->execute()) {
                $idNota = $stmt->insert_id;
            }
            else{
                $json .= '"message":"'.$stmt->error.'"';
            }
        }
        else{
            $json .= '"message":"'.$mysqli->error.'"';
        }

        $tmpIdProduk = array();
        $tmpTotal = array();
        $tmpCapital = array();
        $tmpSellingPrice = array();
        $tmpMessage = array();
        //get data from trolli
        $sql = "SELECT trolli.idProduct,
                trolli.total,
                trolli.message,
                product.capital,
                product.sellingPrice
                FROM trolli
                INNER JOIN product
                ON trolli.idProduct = product.idProduct
                WHERE trolli.idAccount=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $stmt->bind_result($idProduct, $total, $message, $capital, $sellingPrice);
                
                while ($stmt->fetch()) {
                    array_push($tmpIdProduk, $idProduct);
                    array_push($tmpTotal, $total);
                    array_push($tmpCapital, $capital);
                    array_push($tmpSellingPrice, $sellingPrice);
                    array_push($tmpMessage, $message);
                }
            }
            else{
                $json .= ',"message":"'.$stmt->error.'"';
            }
            $stmt->close();
        }
        else{
            $json .= ',"message":"'.$mysqli->error.'"';
        }

        //masukkan ke order
        $sql = "INSERT INTO orderr (idProduct, idNota, total, message)
                VALUES(?, ?, ?, ?)";
        for ($i=0; $i < count($tmpIdProduk); $i++) {
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("iiis", $tmpIdProduk[$i], $idNota, $tmpTotal[$i], $tmpMessage[$i]);
                if ($stmt->execute()) {
                    
                }
                else{
                    $json .= ',"message":"'.$stmt->error.'"';
                }
                $stmt->close();
            }
            else{
                $json .= ',"message":"'.$mysqli->error.'"';
            }
        }

        //minus stock
        $sql = "UPDATE product SET stock=stock-? WHERE idProduct=?";
        for ($i=0; $i < count($tmpIdProduk); $i++) { 
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ii", $tmpTotal[$i], $tmpIdProduk[$i]);
                if ($stmt->execute()) {
                    
                }
                else{
                    $json .= ',"message":"'.$stmt->error.'"';
                }
                $stmt->close();
            }
            else{
                $json .= ',"message":"'.$mysqli->error.'"';
            }
        }
        
        
        //delete trolli data
        $sql = "DELETE FROM trolli WHERE idAccount=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $json .= '"status":"1"';
            }
            else{
                $json .= ',"message":"'.$stmt->error.'"';
            }
            $stmt->close();
        }
        else{
            $json .= ',"message":"'.$mysqli->error.'"';
        }
        $json .= ',"nota":"'.$idNota.'"';
        $json .= '}';
        echo $json;
    }
    else{
        $json = '{"status":2,"message":"Tolong bayar dulu nota nomor : '.$checkIdNota.'"}';
        echo $json;
    }
    
?>