<?php
    session_start();
    if(isset($_SESSION['status']) && isset($_SESSION['idToken'])){
        if ($_SESSION['status'] == 0) {
            header("Location: ../");
        }
        else{
            header("Location: ../admin");
        }
    }
    else{
        header("Location: ../");
    }
?>