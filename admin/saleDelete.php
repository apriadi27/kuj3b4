<?php
    include "../config/session.php";
    include "../config/config.php";

    $idSale = $_POST['idSale'];
    $sql = "DELETE FROM sale WHERE idSale='$idSale'";
    if ($query = $mysqli->query($sql)) {
        echo "1";
    }
    else{
        echo "Gagal query";
    }
?>