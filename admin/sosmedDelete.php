<?php
    //include "../config/session.php";
    include "../config/config.php";

    $id = $_POST['id'];
    $sql = "DELETE FROM sosmed WHERE idSosmed='$id'";
    if ($query = $mysqli->query($sql)) {
        echo "1";
    }
    else{
        echo "Gagal query sql";
    }

?>