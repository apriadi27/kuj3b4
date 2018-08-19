<?php
    include "../config/session.php";
    include "../config/config.php";
    if (isset($_GET['message'])) {
        ?><script>alert("<?php echo $_GET['message']; ?>")</script><?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
    <script src="../js/product.js"></script>
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="w3-modal" style="display: none;" id="productAdd">
    <form action="productAdd.php" method="post" enctype="multipart/form-data" style="margin: -35px 450px; background-color: white; padding: 30px 0px 30px 60px;">
        <button class="cancel w3-btn w3-cyan" onclick="document.getElementById('productAdd').style.display='none'" style="margin: -30px 0px">X</button>
	    <input type="text" name="name" required class="search" placeholder="Masukkan Nama Produk" style="margin: 0 0 10px 55px;" autofocus><br>
	    Upload gambar : <input type="file" name="picture" required style="margin: 0 0 10px 0;" accept="image/*"><br>
	    <input type="text" name="description" required class="search" placeholder="Masukkan Deskripsi Produk" style="margin: 0 0 10px 55px;"><br>
	    <input type="text" name="smallSize" required class="search" placeholder="Ukuran paling kecil" style="margin: 0 0 10px 55px;"><br>
	    <input type="text" name="bigSize" required class="search" placeholder="Ukuran paling besar" style="margin: 0 0 10px 55px;"><br>
	    Pilih warna produk : <input type="color" name="color" required class="search" style="margin: 0 0 10px 0px;"><br>
        Pilih kategori produk : <select name="category">
            <?php
            $sql = "SELECT * FROM category";
            $query = $mysqli->query($sql);
            while($row = $query->fetch_assoc()){
                if($row['idCategory'] != 1){
                    ?>
                    <option value="<?php echo $row['idCategory']; ?>"><?php echo $row['name']; ?></option>
                    <?php
                }
            }
            ?>
        </select><br>
	    <input type="number" name="capital" required class="search" placeholder="Harga Modal" style="margin: 10px 0 10px 70px;"><br>
	    <input type="number" name="sellingPrice" required class="search" placeholder="Harga Jual" style="margin: 0 0 10px 70px;"><br>
	    <input type="number" name="stock" required class="search" placeholder="Jumlah" style="margin: 0 0 10px 70px;"><br>
        <input type="submit" value="Submit" name="submit" onclick="document.getElementById('productAdd').style.display='none'" class="w3-btn w3-cyan" style="margin: 10px 0 0 130px;"></center>
    </form>
</div>

<div class="w3-modal" style="display: none;" id="productEdit">
    <form action="productEdit.php" method="post" enctype="multipart/form-data" style="margin: -35px 450px; background-color: white; padding: 30px 0px 30px 60px;">
        <button class="cancel w3-btn w3-cyan" onclick="document.getElementById('productEdit').style.display='none'" style="margin: -30px 0px">X</button>
        <input type="hidden" name="idProductEdit" id="idProductEdit">
	    <input type="text" id="nameEdit" name="nameEdit" required class="search" placeholder="Masukkan Nama Produk" style="margin: 0 0 10px 55px;" autofocus><br>
        <center><img id="showPictureEdit" src="" alt="" srcset=""></center><br>
	    Upload gambar : <input id="pictureEdit" type="file" name="pictureEdit" style="margin: 0 0 10px 0;" accept="image/*"><br>
	    <input type="text" id="descriptionEdit" name="descriptionEdit" required class="search" placeholder="Masukkan Deskripsi Produk" style="margin: 0 0 10px 55px;"><br>
	    <input type="text" id="smallSizeEdit" name="smallSizeEdit" required class="search" placeholder="Ukuran paling kecil" style="margin: 0 0 10px 55px;"><br>
	    <input type="text" id="bigSizeEdit" name="bigSizeEdit" required class="search" placeholder="Ukuran paling besar" style="margin: 0 0 10px 55px;"><br>
	    Pilih warna produk : <input id="colorEdit" type="color" name="colorEdit" required class="search" style="margin: 0 0 10px 0px;"><br>
        Pilih kategori produk : <select id="categoryEdit" name="categoryEdit">
            <?php
            $sql = "SELECT * FROM category";
            $query = $mysqli->query($sql);
            while($row = $query->fetch_assoc()){
                if($row['idCategory'] != 1){
                    ?>
                    <option value="<?php echo $row['idCategory']; ?>"><?php echo $row['name']; ?></option>
                    <?php
                }
            }
            ?>
        </select><br>
	    <input type="number" id="capitalEdit" name="capitalEdit" required class="search" placeholder="Harga Modal" style="margin: 10px 0 10px 70px;"><br>
	    <input type="number" id="sellingPriceEdit" name="sellingPriceEdit" required class="search" placeholder="Harga Jual" style="margin: 0 0 10px 70px;"><br>
	    <input type="number" id="stockEdit" name="stockEdit" required class="search" placeholder="Jumlah" style="margin: 0 0 10px 70px;"><br>
        <input type="submit" value="Submit" name="submitEdit" onclick="document.getElementById('productAdd').style.display='none'" class="w3-btn w3-cyan" style="margin: 10px 0 0 130px;"></center>
    </form>
</div>

<div class="isi">
  <button class="w3-btn w3-cyan" onclick="document.getElementById('productAdd').style.display='block'" style="margin-bottom: 20px">Tambah Produk</button>
  <table class="w3-table w3-hoverable w3-striped">
    <tr class="w3-cyan">
      <td style="width: 100px">ID Produk</td>
      <td>Nama Produk</td>
      <td>Deskripsi</td>
      <td>Ukuran</td>
      <td><center>Warna</center></td>
      <td colspan="2"><center>Option</center></td>
    </tr>
    <?php
	    $sql = "SELECT * FROM dataproduct";
        $query = $mysqli->query($sql);
        while($row = $query->fetch_assoc()){
    ?>
    <tr>
    	<td><?php echo $row['idProduct']; ?></td>
    	<td><?php echo $row['name']; ?></td>
    	<td><?php echo $row['description']; ?></td>
    	<td><?php echo $row['size']; ?></td>
    	<td style="padding-right: 20px; padding-left: 20px"><div style="padding: 10px; background-color:<?php echo $row['color']; ?>;"></div></td>
        <td><center><a class="option" onclick="editProduct(<?php echo $row['idProduct']; ?>)">Edit</a></center></td>
        <td><center><a onclick="productDelete(<?php echo $row['idProduct']; ?>,'<?php echo $row['name']; ?>')" class="option">Hapus</a></center></td>
    </tr>
    <?php
    	}
        $mysqli->close();
    ?>
  </table>
</div>    
</body>
</html>