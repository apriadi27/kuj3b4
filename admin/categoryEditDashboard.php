<?php
    //include "../config/session.php";
    if (!isset($_GET['id'])) {
        header("Location: category.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category : Admin</title>
</head>
<body>
    <form action="categoryEdit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        Nama : <input type="text" name="name" value="<?php echo $_GET['name']; ?>">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>