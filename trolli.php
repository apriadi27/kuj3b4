<?php
    include "config/config.php";
    include "config/session.php";

    $idProduct = $_POST['idProduct'];
    $idAccount = $_POST['idAccount'];
    $stock = $_POST['stock'];

    $sql = "SELECT idEmail FROM account WHERE idEmail='$idAccount'";
    if($query = $mysqli->query($sql)){
        if ($query->num_rows == 1) {
            $sql = "INSERT INTO trolli (idAccount, idProduct, total)
                VALUES ('$idAccount', '$idProduct', '$stock')";
            if ($query = $mysqli->query($sql)) {
                echo '{"status":1,"message":""}';
            }
            else{
                echo '{"status":0,"message":"Gagal query"}';
            }
        }
        else{
            echo '{"status":0,"message":"User invalid"}';
        }
    }
    else{
        echo '{"status":0,"message":"User invalid"}';
    }

    
?>