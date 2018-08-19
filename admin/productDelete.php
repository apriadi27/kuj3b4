<?php
    include "../config/session.php";
    include "../config/config.php";
    $sql = "DELETE FROM dataproduct WHERE idProduct=".$_POST['id'];
    $query = $mysqli->query($sql);
    if (!$query) {
        echo $mysqli->error;
    }
    
    $sql = "DELETE FROM product WHERE idProduct=".$_POST['id'];
    $query = $mysqli->query($sql);
    if (!$query) {
        echo $mysqli->error;
    }
    else{
        echo "1";
    }
    $mysqli->close();
?>