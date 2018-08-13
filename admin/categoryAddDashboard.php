<?php
    //include "../config/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kategori : Admin</title>
</head>
<body>
    <form action="categoryAdd.php" method="post">
        Nama : <input type="text" name="name" required>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>