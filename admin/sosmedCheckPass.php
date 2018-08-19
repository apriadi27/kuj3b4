<?php
    include "../config/session.php";
    include "../config/config.php";

    $pass = htmlspecialchars($_POST['pass']);
    $id = $_POST['id'];
    $type = $_POST['type'];

    $sql = "SELECT pass FROM sosmed WHERE idSosmed=? AND type=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("is", $id, $type);
        if ($stmt->execute()) {
            $stmt->bind_result($tmpPass);
            $stmt->fetch();
            
            if ($tmpPass == base64_encode($pass)) {
                echo 1;
            }
            else{
                echo "Password tidak sama";
            }
        }
        else{
            echo "Gagal mengeksekusi sql";
        }
    }
    else{
        echo $mysqli->error;
        echo "Gagal menyiapkan sql";
    }

?>