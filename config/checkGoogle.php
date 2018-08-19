<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
    $idGoogle = $_POST['idGoogle'];
    $picture = $_POST['picture'];
    
    $sql = "SELECT idEmail, status, picture FROM account WHERE idEmail='$idGoogle'";
    if($query = $mysqli->query($sql)){
        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
            $_SESSION['id'] = $row['idEmail'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['picture'] = $row['picture'];
            if($_SESSION['status'] == 1){
                echo '{"status":"1","message":"","picture":"'.$row['picture'].'"}';
            }
            else{
                echo '{"status":"0","message":"","picture":"'.$row['picture'].'"}';
            }
        }
        else{
            $sql = "INSERT INTO account (idEmail, picture, status) VALUES ('$idGoogle', '$picture', '0')";
            if($query = $mysqli->query($sql)){
                $row = $query->fetch_assoc();
                echo '{"status":"0","message":"","picture":"'.$row['picture'].'"}';
                $_SESSION['id'] = $idAccount;
                $_SESSION['status'] = 0;
                $_SESSION['picture'] = $picture;
            }
            else{
                echo '{"status":"0","message":"'.$mysqli->error.'"}';
            }
        }
    }
    else{
        echo '{"status":"0","message":"'.$mysqli->error.'"}';
    }
?>