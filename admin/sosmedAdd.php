<?php
    include "../config/session.php";
    include "../config/config.php";

    if (isset($_POST['addSubmit'])) {
        $pass = htmlspecialchars($_POST['addPass']);
        $user = htmlspecialchars($_POST['addUser']);
        $type = $_POST['addType'];

        $pass = base64_encode($pass);

        $sql = "INSERT INTO sosmed (userSosmed, pass, type)
                VALUES (?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sss", $user, $pass, $type);
            if ($stmt->execute()) {
                header("Location: sosmed.php");
            }
            else{
                header("Location: sosmed.php?message=Gagal mengeksekusi sql");
            }
        }
        else{
            header("Location: sosmed.php?message=Gagal mensiapkan sql");
        }
    }
    else{
        header("Location: sosmed.php");
    }
    $stmt->close();
    $mysqli->close();
?>