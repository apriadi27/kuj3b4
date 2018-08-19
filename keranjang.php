<?php
    include "config/config.php";
    include "config/sessionUser.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head.php"; ?>
</head>
<body>

<?php 
    include "header.php"; 
    include 'menu.php';

    $id = $_SESSION['id'];
    $sql = "SELECT idContact FROM contact WHERE idAccount=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows < 1) {
                header("Location: kontak.php?message=Tambah alamat terlebih dahulu untuk bisa beli item");
            }
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        $mysqli->error;
    }
?>

<div class="isi" style="padding-left: 170px">
<?php
    $isi;
    $totalPrice = 0;
    //cek banyaknya trolli pengguna
    $sql = "SELECT idTrolli FROM trolli WHERE idAccount='$id' ORDER BY idTrolli";
    $query = $mysqli->query($sql);
    $isi = $query->num_rows;

    $sql = "SELECT product.idProduct,
            product.sellingPrice,
            dataproduct.name,
            dataproduct.picture,
            trolli.total,
            trolli.message
            FROM trolli
            INNER JOIN product
            ON trolli.idProduct = product.idProduct
            INNER JOIN dataproduct
            ON trolli.idProduct = dataproduct.idProduct
            WHERE trolli.idAccount=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($idProduct, $sellingPrice, $name, $picture, $total, $message);
            ?>
            <table class="w3-table w3-bordered w3-striped" style="margin: 0 100px 40px 0; width: 500px; float: left">
                <tr class="w3-cyan">
                    <td>Produk yang Dipesan</td>
                </tr>
            <?php
            $i = 1;
            while ($stmt->fetch()) {
                $i++;
                ?>
                <tr>
                    <td style="padding: 20px">
                    <div class="w3-card-4" style="width: 200px; float: left; margin: 0 55px 0px 0; background-color: white;">
                        <img src="<?php echo "productPicture/".$picture; ?>" alt="Norway" class="produk">
                        <div style="padding: 10px;">
                            <b><?php echo $name; ?></b><br>
                            Jumlah : <?php echo $total ?><br>
                            <?php echo $sellingPrice ?>
                        </div>
                    </div>
                    <div>
                        Total = <?php echo $sellingPrice*$total; $totalPrice += $sellingPrice*$total ?><br><br><br>
                        Pesan : <?php echo $message; ?><br>
                    </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <input type="hidden" id="totalItem" value="<?php echo $i; ?>">
            <?php
            
        }
        else{
            echo "Execute failed";
        }
    }
    else{
        echo "Prepare failed";
    }
    if($isi > 0){
?>

    <table class="w3-table w3-bordered" style="margin: 0 0 40px 0px; width: 400px;">
        <tr class="w3-cyan">
            <td>Jasa Pengiriman</td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="margin: -5px 0">Nama Perusahaan : JNE</p><br>
                <p style="margin: -5px 0">Jenis Service : <select name="service" id="service" onchange="changeService()"></select></p><br>
                <p><input type="hidden" name="servicePrice" id="servicePrice"></p><br>
            </td>
        </tr>
    </table>

    Pilih alamat : <select name="address" id="address" onchange="changeDestination()">
    <?php
    $sql = "SELECT idContact, Address, idCity FROM contact";
    $query = $mysqli->query($sql);
    while($row = $query->fetch_assoc()){
        ?>
        <option value="<?php echo $row['idContact']." ".$row['idCity']; ?>"><?php echo $row['Address']; ?></option>
        <?php
    }
    ?></select><br>
    <script>
        var a = document.getElementById('address').value;
        var b = a.split(" ");
        getCost(b[1]);
    </script>

    <input type="hidden" id="hiddenTotalPrice" value="<?php echo $totalPrice; ?>">
    <div style="margin-top: 20px">
        <div style="float: left; margin-right: 10px">Total biaya : </div> 
        <div id="totalPrice"><?php echo $totalPrice; ?></div>
    </div><br>
    <button class="w3-btn w3-cyan" style="margin-top: 10px" onclick="addOrder()">Konfirmasi Pesanan</button>
</div>
<?php
    }
?>
</body>
</html>
<?php
	$mysqli->close();
?>