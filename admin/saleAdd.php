<?php
    include "../config/session.php";
    include "../config/config.php";
    if (isset($_POST['addSubmit'])) {
        $idProduct = $_POST['addIdProduct'];
        $discount = htmlspecialchars($_POST['addDiscount']);
        $startSale = $_POST['startDate']." ".$_POST['startTime'];
        $finishSale = $_POST['finishDate']." ".$_POST['finishTime'];
        $limitStock = htmlspecialchars($_POST['limitStock']);

        $sql = "INSERT INTO sale (idProduct, discount, startSale, finishSale, stock, status)
                VALUES(?, ?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("iissii", $idProduct, $discount, $startSale, $finishSale, $limitStock, 1);
            if ($stmt->execute()) {
                header("Location: sale.php");
            }
            else{
                //header("Location: sale.php?message=Gagal mengeksekusi sql");
            }
        }
        else{
            header("Location: sale.php?message=Gagal menyiapkan sql");
        }
    }
    else{
        header("Location: sale.php");
    }

    
?>