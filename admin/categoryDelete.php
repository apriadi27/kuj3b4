<?php
    include "../config/session.php";
    include "../config/config.php";
    $sql = "DELETE FROM category WHERE idCategory=".$_POST['id'];
    $query = $mysqli->query($sql);
    if ($query) {
        echo "1";
    }
    else{
        echo "0";
    }
    $mysqli->close();
?>