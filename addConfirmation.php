<?php
    include "config/config.php";
    include "config/sessionUser.php";

    $idNota = $_POST['idNota'];
    $bankName = htmlspecialchars($_POST['bankName']);
    $numberAccount = htmlspecialchars($_POST['numberAccount']);
    $accountOwner = htmlspecialchars($_POST['accountOwner']);
    $picture = $_FILES['picture']['tmp_name'];
    
    $fileName = $_FILES['picture']['name'];
    $ext = explode(".", $fileName);
    $newName = md5($ext[0]);
    $number = count($ext) - 1;
    $uploadfile = $_SERVER['DOCUMENT_ROOT']."/confirmationPicture/".$newName.".".$ext[$number];
    $valueSql = array();

    if ($ext[$number] == "jpg") {
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
            array_push($valueSql, $newName.".".$ext[$number]);
        } else {
            header("Location: confirmation.php?message=Gagal mengunggah file");
            exit();
        }
    }

    //insert data to confirmation table
    $date = date('Y-m-d');
    $sql = "INSERT INTO confirmation (idNota, date, bank, numberAccount, accountOwner, picture)
            VALUES(?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ississ", $idNota, $date, $bankName, $numberAccount, $accountOwner, $valueSql[0]);
        if ($stmt->execute()) {
            $idConfirmation = $stmt->insert_id;
            $newPictureName = $idConfirmation.$newName.".".$ext[$number];
            rename($_SERVER['DOCUMENT_ROOT']."/confirmationPicture/".$newName.".".$ext[$number], $_SERVER['DOCUMENT_ROOT']."/confirmationPicture/".$newPictureName);
        }
        else{
            header("Location: confirmation.php?message=".$stmt->error);
            exit();
        }
        $stmt->close();
    }
    else{
        header("Location: confirmation.php?message=".$mysqli->error);
        exit();
    }
    
    //update picture file after rename
    $sql = "UPDATE confirmation SET picture=? WHERE idConfirmation=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $newPictureName, $idConfirmation);
        if ($stmt->execute()) {
            header("Location: confirmation.php");
            exit();
        }
        else{
            header("Location: confirmation.php?message=".$stmt->error);
            exit();
        }
        $stmt->close();
    }
    else{
        header("Location: confirmation.php?message=".$mysqli->error);
        exit();
    }

?>