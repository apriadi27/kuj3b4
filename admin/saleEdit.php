<?php
    include "../config/session.php";
    include "../config/config.php";

    if ($_POST['editSubmit']) {
        $idSale = $_POST['editIdSale'];
        $idProduct = $_POST['editIdProduct'];
        $discount = htmlspecialchars($_POST['editDiscount']);
        $startSale = $_POST['editStartDate']." ".$_POST['editStartTime'];
        $finishSale = $_POST['editFinishDate']." ".$_POST['editFinishTime'];
        $limitStock = htmlspecialchars($_POST['editLimitStock']);
        $sql = "UPDATE sale SET
                idProduct=?,
                discount=?,
                startSale=?,
                finishSale=?,
                stock=?
                WHERE idSale=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("iissii", $idProduct, $discount, $startSale, $finishSale, $limitStock, $idSale);
            if ($stmt->execute()) {
                header("Location: sale.php");
            }
            else{
                header("Location: sale.php?message=Gagal mengeksekusi sql");
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