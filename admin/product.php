<?php
    include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
    <title>Admin - Produk</title>
    <script src="../js/ajax.js"></script>
    <script src="../js/product.js"></script>
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

<div class="w3-modal" style="display: none;" id="productAdd">
    <form action="productAdd.php" method="post" enctype="multipart/form-data" style="margin: -35px 450px; background-color: white; padding: 30px 0px 30px 60px;">
        <button class="cancel w3-btn w3-blue" onclick="document.getElementById('productAdd').style.display='none'" style="margin: -30px 0px">X</button>
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
        <input type="submit" value="Submit" name="submit" onclick="document.getElementById('productAdd').style.display='none'" class="w3-btn w3-blue" style="margin: 10px 0 0 130px;"></center>
    </form>
</div>

<div class="isi">
  <button class="w3-btn w3-blue" onclick="document.getElementById('productAdd').style.display='block'">Tambah Produk</button>
  <input type="text" name="search" placeholder="Cari produk" class="search" style="margin: 0 0 20px 0; float: right;">
  <table class="w3-table w3-hoverable w3-striped">
    <tr class="w3-blue">
      <td>ID Produk</td>
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
        <td><center><a class="option" onclick="document.getElementById('dataProductEdit').style.display='block'">Edit</a></center></td>
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