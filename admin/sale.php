<?php
    include "../config/session.php";
    include "../config/config.php";
    if (isset($_GET['message'])) {
        ?><script>alert("<?php echo $_GET['message']; ?>")</script><?php
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Promo</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/sale.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
    <link rel="stylesheet" type="text/css" href="../style/all.css">
    <script src="../js/all.js"></script>
    <script>
		function openNav(){
			document.getElementById('sidenav').style.display="block";
		}
		function closeNav(){
			document.getElementById('sidenav').style.display="none";
		}
    </script>
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="isi">
    <div class="w3-modal" style="display: none;" id="saleAdd">
        <form action="saleAdd.php" method="post" style="margin: 30px 450px; background-color: white; padding: 30px;">
            <button class="cancel w3-btn w3-red" onclick="document.getElementById('saleAdd').style.display='none'">X</button>
            <center>Pilih produk : <select name="addIdProduct" style="margin-bottom: 20px">
            <?php
                $sql = "SELECT product.idProduct, dataproduct.name
                        FROM product
                        INNER JOIN dataproduct
                        ON product.idProduct = dataproduct.idProduct";
                $query = $mysqli->query($sql);
                while($row = $query->fetch_assoc()){
                ?>
                    <option value="<?php echo $row['idProduct']; ?>"><?php echo $row['name']; ?></option>
                <?php
                }
            ?>
            </select><br>
            <input type="number" name="addDiscount" required class="search" placeholder="Jumlah Diskon" style="margin: 0 0 20px;"><br>
            Jam dimulai : <input type="date" name="startDate" required style="margin: 0 0 20px;">
            <input type="time" name="startTime" required style="margin: 0 0 20px;"><br>
            Jam berakhir : <input type="date" name="finishDate" required style="margin: 0 0 20px;">
            <input type="time" name="finishTime" required style="margin: 0 0 20px;"><br>
            <input type="number" name="limitStock" required class="search" placeholder="Batas Stock" style="margin: 0 0 20px;"><br>
            <input type="submit" value="Submit" name="addSubmit" onclick="document.getElementById('saleAdd').style.display='none'" class="w3-btn w3-red"></center>
        </form>
    </div>

    <div class="w3-modal" style="display: none;" id="saleEdit">
        <form action="saleEdit.php" method="post" style="margin: 30px 450px; background-color: white; padding: 30px;">
            <button class="cancel w3-btn w3-red" onclick="document.getElementById('saleEdit').style.display='none'">X</button>
            <input type="hidden" name="editIdSale" id="editIdSale">
            <center>Pilih produk : <select name="editIdProduct" id="editProduct" style="margin-bottom: 20px">
            <?php
                $sql = "SELECT product.idProduct, dataproduct.name
                        FROM product
                        INNER JOIN dataproduct
                        ON product.idProduct = dataproduct.idProduct";
                $query = $mysqli->query($sql);
                while($row = $query->fetch_assoc()){
                ?>
                    <option value="<?php echo $row['idProduct']; ?>"><?php echo $row['name']; ?></option>
                <?php
                }
            ?>
            </select><br>
            <input type="number" name="editDiscount" required class="search" placeholder="Jumlah Diskon" style="margin: 0 0 20px;"><br>
            Jam dimulai : <input type="date" name="editStartDate" required style="margin: 0 0 20px;">
            <input type="time" name="editStartTime" required style="margin: 0 0 20px;"><br>
            Jam berakhir : <input type="date" name="editFinishDate" required style="margin: 0 0 20px;">
            <input type="time" name="editFinishTime" required style="margin: 0 0 20px;"><br>
            <input type="number" name="editLimitStock" required class="search" placeholder="Batas Stock" style="margin: 0 0 20px;"><br>
            <input type="submit" value="Submit" name="editSubmit" onclick="document.getElementById('saleEdit').style.display='none'" class="w3-btn w3-red"></center>
        </form>
    </div>

        <button class="w3-btn w3-red" style="margin-bottom: 20px;" onclick="document.getElementById('saleAdd').style.display='block'">Tambah Promo</button>
        <table class="w3-table w3-hoverable w3-striped">
            <tr class="w3-red">
                <th>Nama Produk</th>
                <th>Diskon</th>
                <th>Waktu Dimulai</th>
                <th>Waktu Berakhir</th>
                <th>Batas Stock</th>
                <th colspan="2"><center>Option</center></th>
            </tr>
            <?php
                $sql = "SELECT sale.discount, sale.startSale, sale.finishSale, sale.stock, dataproduct.name, sale.idSale, sale.idProduct,
                        sale.status
                        FROM sale
                        INNER JOIN dataproduct
                        ON sale.idProduct = dataproduct.idProduct
                        ORDER BY sale.idSale DESC";
                $query = $mysqli->query($sql);
                while($row = $query->fetch_assoc()){
                    if ($row['status'] == 1) {
                    ?>
                    <tr style="background-color: green">
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['discount']; ?></td>
                        <td><?php echo $row['startSale']; ?></td>
                        <td><?php echo $row['finishSale']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><center><a class="option" onclick="editDashboard(<?php echo $row['idSale'].",".$row['idProduct'].",'".$row['name']."'"; ?>)">Edit</a></center></td>
                        <td><center><a onclick="deleteSale(<?php echo $row['idSale']; ?>,'<?php echo $row['name']; ?>')" class="option">Delete</a></center></td>
                    </tr>
                    <?php
                    }
                    else{
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['discount']; ?></td>
                        <td><?php echo $row['startSale']; ?></td>
                        <td><?php echo $row['finishSale']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><center><a class="option" onclick="editDashboard(<?php echo $row['idSale'].",".$row['idProduct'].",'".$row['name']."'"; ?>)">Edit</a></center></td>
                        <td><center><a onclick="deleteSale(<?php echo $row['idSale']; ?>,'<?php echo $row['name']; ?>')" class="option">Delete</a></center></td>
                    </tr>
                    <?php
                    }
                }
                $mysqli->close();
            ?>
        </table>
    </div>
</div>