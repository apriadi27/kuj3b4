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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
    <title>Admin - Akun</title>
    <script src="../js/ajax.js"></script>
    <script src="../js/sosmed.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/w3.css">
    <link rel="stylesheet" type="text/css" href="../style/css.css">
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="w3-modal" style="display: none;" id="sosmedAdd">
    <form action="sosmedAdd.php" method="post" style="margin: 50px 500px; background-color: white; padding: 30px;">
        <button class="cancel w3-btn w3-blue" onclick="document.getElementById('sosmedAdd').style.display='none'">X</button>
        <center><input type="text" name="addUser" requiblue class="search" placeholder="Masukkan Username" style="margin: 0 0 20px;" autofocus><br>
        <input type="password" name="addPass" id="addPass1" requiblue class="search" placeholder="Masukkan Password" style="margin: 0 0 20px;" oninput="confirmAddPass()"><br>
        <input type="password" id="addPass2" requiblue class="search" placeholder="Konfirmasi Password" style="margin: 0 0 20px;" oninput="confirmAddPass()">
        <label id="labelAddPass"></label>
        <br>
        <select name="addType">
            <option value="Facebook">Facebook</option>
            <option value="Instagram">Instagram</option>
            <option value="Google+">Google+ </option>
        </select><br>
        <input type="submit" value="Submit" name="addSubmit" onclick="document.getElementById('sosmedAdd').style.display='none'" class="w3-btn w3-blue" style="margin-top: 20px;"></center>
    </form>
</div>

<div class="w3-modal" style="display: none;" id="sosmedEdit">
    <form action="sosmedEdit.php" method="post" style="margin: 50px 500px; background-color: white; padding: 30px;">
        <button class="cancel w3-btn w3-blue" onclick="document.getElementById('sosmedEdit').style.display='none'">X</button>
        <center><label id="labelEditUser"></label><br>
        <input type="hidden" name="editIdSosmed" id="editIdSosmed">
        <input type="password" id="editOldPass" requiblue class="search" placeholder="Masukkan Password Lama" style="margin: 0 0 20px;" onchange="checkPass()">
        <label id="labelEditOldPass"></label>
        <br>
        <input type="password" name="editPassSosmed" id="editPass1" requiblue class="search" placeholder="Masukkan Password Baru" style="margin: 0 0 20px;" oninput="confirmEditPass()"><br>
        <input type="password" id="editPass2" requiblue class="search" placeholder="Konfirmasi Password" style="margin: 0 0 0px;" oninput="confirmEditPass()">
        <label id="labelEditPass"></label>
        <br>
        <input type="hidden" name="editTypeSosmed" requiblue class="search" placeholder="Jenis Akun" style="margin: 0 0 0px;"><br>
        <input type="submit" value="Submit" disabled id="editSubmit" name="editSubmit" onclick="document.getElementById('sosmedEdit').style.display='none'" class="w3-btn w3-blue" style="margin: 0 0 20px 0;"></center>
    </form>
</div>

<div class="isi" style="margin: 0 200px;">
  <button class="w3-btn w3-blue" onclick="document.getElementById('sosmedAdd').style.display='block'" style="margin-bottom: 20px">Tambah Akun</button>
  <table class="w3-table w3-hoverable w3-striped">
    <tr class="w3-blue">
      <td>ID</td>
      <td>Jenis</td>
      <td colspan="2"><center>Option</center></td>
    </tr>
    <?php
	    $sql = "SELECT idSosmed, userSosmed, type FROM sosmed";
        $query = $mysqli->query($sql);
        while($row = $query->fetch_assoc()){
    ?>
    <tr>
    	<td><?php echo $row['userSosmed']; ?></td>
    	<td><?php echo $row['type']; ?></td>
        <td><center><a class="option" onclick="editSosmed(<?php echo $row['idSosmed'].",'".$row['userSosmed']."','".$row['type']."'"; ?>)">Edit</a></center></td>
        <td><center><a onclick="sosmedDelete(<?php echo $row['idSosmed']; ?>,'<?php echo $row['userSosmed']; ?>')" class="option">Hapus</a></center></td>
    </tr>
    <?php
    	}
        $mysqli->close();
    ?>
  </table>
</div>    
</body>
</html>