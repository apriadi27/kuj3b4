<?php
    include "../config/session.php";
    include "../config/config.php";

    if (isset($_POST['editSubmit'])) {
        $pass = htmlspecialchars($_POST['editPassSosmed']);
        $id = htmlspecialchars($_POST['editIdSosmed']);
        $type = $_POST['editTypeSosmed'];

        //encrypt password
        $pass = base64_encode($pass);
        $sql = "UPDATE sosmed SET
                pass=?,
                WHERE idSosmed=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("si", $pass, $id);
            if ($stmt->execute()) {
                header("Location: sosmed.php?message=Berhasil");
            }
            else{
                header("Location: sosmed.php?message=Gagal mengeksekusi sql");
            }
        }
        else{
            header("Location: sosmed.php?message=Gagal menyiapkan sql");
        }
    }
    else {
        header("Location: sosmed.php");
    }
?>