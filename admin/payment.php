<?php
    include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
    <script src="../js/payment.js"></script>
    <style>
        .icon{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<?php
    include 'menu.php';
?>
    <div class="isi" style="margin: 0 100px;">
<?php
    $sql = "SELECT
            confirmation.idConfirmation,
            nonota.status,
            nonota.idNota,
            confirmation.date,
            confirmation.bank,
            confirmation.numberAccount,
            confirmation.accountOwner
            FROM confirmation
            INNER JOIN nonota
            ON confirmation.idNota = nonota.idNota";
    if ($stmt = $mysqli->prepare($sql)) {
        if ($stmt->execute()) {
            $stmt->bind_result($sqlIdConfirmation, $sqlStatus, $sqlIdNota, $sqlDate, $sqlBank, $sqlNumerAccount, $sqlAccountOwner);
            ?>
            <table class="w3-table w3-striped w3-bordered" style="margin-top: 20px;">
<<<<<<< HEAD
            <tr class="w3-blue">
=======
            <tr class="w3-cyan">
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
                <th>Id Nota</th>
                <th>Tanggal</th>
                <th>Nama Bank</th>
                <th>No. Rek</th>
                <th>Pemilik Rek</th>
                <th>Status</th>
                <th>Detail</th>
            <tr>
            <?php
            while($stmt->fetch()){
                if ($sqlStatus == 1) {
            ?>
            <tr>
                <td><?php echo $sqlIdNota; ?></td>
                <td><?php echo $sqlDate; ?></td>
                <td><?php echo $sqlBank; ?></td>
                <td><?php echo $sqlNumerAccount; ?></td>
                <td><?php echo $sqlAccountOwner; ?></td>
                <td><?php echo "Lunas"; ?></td>
<<<<<<< HEAD
                <td><a href="paymentDetail.php?confirmation=<?php echo $sqlIdConfirmation; ?>"><button class="w3-btn w3-blue">Detail</button></a></td>
=======
                <td><a href="paymentDetail.php?confirmation=<?php echo $sqlIdConfirmation; ?>"><button class="w3-btn w3-cyan">Detail</button></a></td>
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
            </tr>
            <?php
                }
                else{
            ?>
            <tr>
                <td><?php echo $sqlIdNota; ?></td>
                <td><?php echo $sqlDate; ?></td>
                <td><?php echo $sqlBank; ?></td>
                <td><?php echo $sqlNumerAccount; ?></td>
                <td><?php echo $sqlAccountOwner; ?></td>
                <td><?php echo "Belum Lunas"; ?></td>
<<<<<<< HEAD
                <td><a href="paymentDetail.php?confirmation=<?php echo $sqlIdConfirmation; ?>"><button class="w3-btn w3-blue">Detail</button></a></td>
=======
                <td><a href="paymentDetail.php?confirmation=<?php echo $sqlIdConfirmation; ?>"><button class="w3-btn w3-cyan">Detail</button></a></td>
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
            </tr>
            <?php
                }
            }
            ?>
            </table>
            <?php
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        echo $mysqli->error;
    }
?>
    </div>
</body>
</html>
<?php
    $mysqli->close();
?>