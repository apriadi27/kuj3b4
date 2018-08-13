<?php
    session_start();
    if(isset($_SESSION['status']) && isset($_SESSION['idToken'])){
        if ($_SESSION['status'] == 1) {
            header("Location: ../admin");
        }
        else{
            header("Location: ../");
        }
    }
    else{
        header("Location: ../");
    }
?>