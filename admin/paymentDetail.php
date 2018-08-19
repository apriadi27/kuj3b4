<?php
    include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include "head.php"; ?>
    <script src="../js/payment.js"></script>
</head>
<body>
<?php
    include 'menu.php';
?>
    <div class="isi">
<?php
    if (!isset($_GET['confirmation'])) {
        header("Location: payment.php");
    }
    else{
        $idConfirmation = $_GET['confirmation'];
    }

    //detail nota
    $status;
    $idNota;
    $ongkir;
    $sql = "SELECT 
            confirmation.idNota,
            confirmation.date,
            confirmation.bank,
            confirmation.numberAccount,
            confirmation.accountowner,
            confirmation.picture,
            nonota.tanggal,
            nonota.service,
            nonota.ongkir,
            nonota.status
            FROM confirmation
            INNER JOIN nonota
            ON confirmation.idNota = nonota.idNota
            WHERE idConfirmation=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $idConfirmation);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlIdNota, $sqlDate, $sqlBank, $sqlNumberAccount, $sqlAccountOwner, $sqlPicture,
                $sqlTanggalNota, $sqlService, $sqlOngkir, $sqlStatus);
            ?> 
            <table class="w3-table w3-bordered">
<<<<<<< HEAD
                <tr class="w3-blue">
=======
                <tr class="w3-cyan">
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
                    <th style="width: 400px"><center>Bukti Pembayaran</center></th>
                    <th colspan="3"><center>Detail<center></th>
                </tr>
            <?php
            while ($stmt->fetch()) {
                $status = $sqlStatus;
                ?>
                <tr>
                    <td rowspan="8"><img src="<?php echo "../confirmationPicture/".$sqlPicture; ?>" alt="Gambar Bukti Pembayaran" srcset="" class="buktiPembayaran"></td>
                    <td style="padding-left: 17px">Id Nota</td>
                    <td>:</td>
                    <td><?php echo $sqlIdNota; $idNota = $sqlIdNota ?></td>
                </tr>
                <tr>
                    <td>Tanggal konfirmasi pengirim</td>
                    <td>:</td>
                    <td><?php echo $sqlDate; ?></td>
                </tr>
                <tr>
                    <td>Nama bank pengirim</td>
                    <td>:</td>
                    <td><?php echo $sqlBank; ?></td>
                </tr>
                <tr>
                    <td>No rekening pengirim</td>
                    <td>:</td>
                    <td><?php echo $sqlBank; ?></td>
                </tr>
                <tr>
                    <td>Nama pemilik rekening</td>
                    <td>:</td>
                    <td><?php echo $sqlAccountOwner; ?></td>
                </tr>
                <tr>
                    <td>Tanggal nota dibuat</td>
                    <td>:</td>
                    <td><?php echo $sqlTanggalNota; ?></td>
                </tr>
                <tr>
                    <td>Nama jenis pengiriman</td>
                    <td>:</td>
                    <td><?php echo $sqlService; ?></td>
                </tr>
                <tr>
                    <td>Harga ongkir</td>
                    <td>:</td>
                    <td><?php echo $sqlOngkir; $ongkir = $sqlOngkir?></td>
                </tr>
                <?php    
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

    //detail produk yang dipesan
    $hargaProduk = array();
    $jumlahPesanan = array();

    $sql = "SELECT 
            product.sellingPrice,
            category.name,
            dataproduct.name,
            dataproduct.description,
            dataproduct.picture,
            orderr.total,
            orderr.message
            FROM product
            INNER JOIN dataproduct
            ON product.idProduct = dataproduct.idProduct
            INNER JOIN category
            ON product.idCategory = category.idCategory
            INNER JOIN orderr
            ON product.idProduct = orderr.idProduct
            WHERE orderr.idNota = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $idNota);
        if ($stmt->execute()) {
            $stmt->bind_result($sqlPrice, $sqlCategory, $sqlProduct, $sqlDescription, $sqlPicture,
                $sqlTotal, $sqlMessage);
            ?>
            <center><p style="font-size: 18px; margin: 60px 0 20px">Produk yang dipesan</p></center>
            <table class="w3-table w3-bordered">
<<<<<<< HEAD
                <tr class="w3-blue">
=======
                <tr class="w3-cyan">
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
                    <th style="width: 400px"><center>Gambar Produk</center></th>
                    <th colspan="3"><center>Detail Produk</center</th>
                </tr>
            <?php
            while ($stmt->fetch()) {
                ?>
                <tr>
<<<<<<< HEAD
                    <td rowspan="6"><img src="<?php echo "../productPicture/".$sqlPicture ?>" alt="Gambar Produk" srcset="" class="buktiPembayaran"></td>
=======
                    <td rowspan="6"><img src="<?php echo "../productPicture/".$sqlPicture ?>" class="buktiPembayaran" alt="Gambar Produk" srcset=""></td>
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
                    <td style="padding-left: 17px; width: 200px">Nama Produk</td>
                    <td>:</td>
                    <td><?php echo $sqlProduct; ?></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><?php echo $sqlCategory; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi produk</td>
                    <td>:</td>
                    <td><?php echo $sqlDescription; ?></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td><?php echo $sqlPrice; array_push($hargaProduk, $sqlPrice); ?></td>
                </tr>
                <tr>
                    <td>Jumlah Pesanan</td>
                    <td>:</td>
                    <td><?php echo $sqlTotal; array_push($jumlahPesanan, $sqlTotal); ?></td>
                </tr>
                <tr>
                    <td>Pesan Pembeli</td>
                    <td>:</td>
                    <td><?php echo $sqlMessage; ?></td>
                </tr>
                <?php
            }
            ?></table><?php
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        echo $mysqli->error;
    }

    if ($status != 1) {
?>
<<<<<<< HEAD
<button onclick="updateNota(<?php echo $idNota; ?>)" class="w3-btn w3-blue" style="margin-top: 40px">Terima</button>
=======
<button onclick="updateNota(<?php echo $idNota; ?>)" class="w3-btn w3-cyan" style="margin-top: 40px">Terima</button>
>>>>>>> 08646123d3a4bb092a5c8f0315aba3b37354431a
<?php
    }
?>
</div>
</body>
</html>

