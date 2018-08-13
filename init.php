<link rel="stylesheet" type="text/css" href="style/w3.css">
<link rel="stylesheet" type="text/css" href="style/css.css">
<div class="w3-modal" style="display: block;">
    <form action="init.php" method="post" style="margin: 20px 100px; background-color: white; padding: 30px 15px 30px 50px;">
        <center><input type="text" name="name" required class="search" placeholder="Masukkan Nama Toko" style="margin: 0 20px 20px -20px;" autofocus>
        <input type="text" name="linkFb" required class="search" placeholder="Masukkan Link Facebook" style="margin: 0 20px 20px;">
        <input type="text" name="linkIg" required class="search" placeholder="Masukkan Link Instagram" style="margin: 0 20px 20px;">
        <input type="text" name="linkGplus" required class="search" placeholder="Masukkan Link Google+" style="margin: 0 20px 20px;"><br>
        <input type="text" name="database" required class="search" placeholder="Masukkan Nama Database" style="margin: 0 20px 20px -20px;">
        <input type="text" name="host" required class="search" placeholder="Masukkan Host Database" style="margin: 0 20px 20px;">
        <input type="text" name="dbUser" required class="search" placeholder="Masukkan User Database" style="margin: 0 20px 20px;">
        <input type="text" name="dbPass" class="search" placeholder="Masukkan Password Database" style="margin: 0 20px 20px;"><br></center>
        <textarea name="name" required class="search" placeholder="Masukkan Alamat" style="margin: 0 0px 20px 0px"></textarea><br>
        Upload logo : <input type="file" name="logo" required style="margin: 0 20px 20px;"><br>
        <center><input type="submit" value="Submit" name="submit" onclick="document.getElementById('categoryAdd').style.display='none'" class="w3-btn w3-red" style="margin: 20px 0 0 -40px;"></center>
    </form>
</div>