<?php
    include 'config/config.php';
    include 'config/sessionUser.php';

    $idContact = $_POST['id'];
    $id = $_SESSION['id'];
    $sql = "DELETE FROM contact WHERE idContact=? && idAccount=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("is", $idContact, $id);
        if ($stmt->execute()) {
            echo 1;
        }
        else{
            echo $stmt->error;
        }
    }
    else{
        echo $mysqli->error;
    }
?>