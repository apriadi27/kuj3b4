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
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
    <title>Admin - Akun</title>
    <script src="../js/ajax.js"></script>
    <script src="../js/product.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="w3-modal" style="display: none;" id="accountAdd">
    <form action="accountAdd.php" method="post" style="margin: 50px 500px; background-color: white; padding: 30px;">
        <button class="cancel w3-btn w3-red" onclick="document.getElementById('accountAdd').style.display='none'">X</button>
        <center><input type="text" name="name" required class="search" placeholder="Masukkan Username" style="margin: 0 0 20px;" autofocus><br>
        <input type="password" name="password" required class="search" placeholder="Masukkan Password" style="margin: 0 0 20px;" oninput(checkPass)><br>
        <input type="password" name="confirmPassword" required class="search" placeholder="Konfirmasi Password" style="margin: 0 0 20px;" oninput(checkPass)><br>
        <input type="text" name="type" required class="search" placeholder="Jenis Akun" style="margin: 0 0 0px;"><br>
        <input type="submit" value="Submit" name="submit" onclick="document.getElementById('accountAdd').style.display='none'" class="w3-btn w3-red" style="margin-top: 20px;"></center>
    </form>
</div>

<div class="w3-modal" style="display: none;" id="accountEdit">
    <form action="accountEdit.php" method="post" style="margin: 50px 500px; background-color: white; padding: 30px;">
        <button class="cancel w3-btn w3-red" onclick="document.getElementById('categoryAdd').style.display='none'">X</button>
        <center><input type="hidden" name="name" required class="search" placeholder="Masukkan Username" style="margin: 0 0 20px;" autofocus><br>
        <input type="password" name="password" required class="search" placeholder="Masukkan Password" style="margin: 0 0 20px;" oninput(checkPass)><br>
        <input type="password" name="confirmPassword" required class="search" placeholder="Konfirmasi Password" style="margin: 0 0 0px;" oninput(checkPass)><br>
        <input type="hidden" name="type" required class="search" placeholder="Jenis Akun" style="margin: 0 0 0px;"><br>
        <input type="submit" value="Submit" name="submit" onclick="document.getElementById('accountEdit').style.display='none'" class="w3-btn w3-red" style="margin: 0 0 20px 0;"></center>
    </form>
</div>

<div class="isi" style="margin: 0 200px;">
  <button class="w3-btn w3-red" onclick="document.getElementById('accountAdd').style.display='block'">Tambah Akun</button>
  <input type="text" name="search" placeholder="Cari akun" class="search" style="margin: 0 0 20px 0; float: right;">
  <table class="w3-table w3-hoverable w3-striped">
    <tr class="w3-red">
      <td>ID</td>
      <td>Jenis</td>
      <td colspan="2"><center>Option</center></td>
    </tr>
    <?php
	    $sql = "SELECT * FROM sosmed";
        $query = $mysqli->query($sql);
        while($row = $query->fetch_assoc()){
    ?>
    <tr>
    	<td><?php echo $row['idSosmed']; ?></td>
    	<td><?php echo $row['type']; ?></td>
        <td><center><a class="option" onclick="document.getElementById('accountEdit').style.display='block'">Edit</a></center></td>
        <td><center><a onclick="accountDelete(<?php echo $row['idSosmed']; ?>,'<?php echo $row['type']; ?>')" class="option">Hapus</a></center></td>
    </tr>
    <?php
    	}
        $mysqli->close();
    ?>
  </table>
</div>    
</body>
</html>