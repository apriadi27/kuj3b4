<?php
    //include "../config/session.php";
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Product : Admin</title>
</head>
<body>
    <form action="productAdd.php" method="post" enctype="multipart/form-data">
        Nama : <input type="text" name="name" required autofocus><br>
        Gambar : <input type="file" name="picture[]" accept="image/*" multiple required><br>
        Deskripsi : <textarea name="description"></textarea><br>
        Kategori : 
        <select name="category">
        <?php
            $sql = "SELECT * FROM category";
            $query = $mysqli->query($sql);
            while($row = $query->fetch_assoc()){
                if($row['idCategory'] != 1){
                ?>
                    <option value="<?php echo $row['idCategory'] ?>"><?php echo $row['name']; ?></option>
                <?php
                }
            }
            $mysqli->close();
        ?>
        </select><br>
        Ukuran paling kecil <input type="text" name="smallSize"><br>
        Ukuran paling besar <input type="text" name="bigSize"><br>
        Warna : <input type="color" name="color" required><br>
        Harga Modal : <input type="number" name="capital" required><br>
        Harga Jual : <input type="number" name="sellingPrice" required><br>
        Jumlah : <input type="number" name="stock" required><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>