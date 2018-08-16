<?php
    $string = file_get_contents("config.json");
    $json = json_decode($string, true);
    if ($json['new'] == 0) {
        header("Location: admin/");
    }
    
    if (isset($_POST['submit'])) {
        //buat database awal
        $db = htmlspecialchars($_POST['database']);
        $host = htmlspecialchars($_POST['host']);
        $user = htmlspecialchars($_POST['dbUser']);
        $pass = htmlspecialchars($_POST['dbPass']);

        $sql = "CREATE DATABASE $db";
        $mysqli = mysqli_connect($host, $user, $pass);
        if ($query = $mysqli->query($sql)) {
                $json['new'] = 0;
                $json['host'] = $host;
                $json['user'] = $user;
                $json['pass'] = $pass;
                $json['database'] = $db;

                $conn =new mysqli($host, $user, $pass , $db);
                $query = '';
                $sqlScript = file('Database/database.sql');
                foreach ($sqlScript as $line)	{
                    
                    $startWith = substr(trim($line), 0 ,2);
                    $endWith = substr(trim($line), -1 ,1);
                    
                    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                        continue;
                    }
                        
                    $query = $query . $line;
                    if ($endWith == ';') {
                        mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
                        $query= '';	
                    }
                }
                echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';

                //rewrite json
                $fp = fopen("config.json", 'w');
                fwrite($fp, json_encode($json));
                fclose($fp);
            }
        else{
            echo "Error create database";
        }


        //profile
        $nameProfile = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $instagram = htmlspecialchars($_POST['instagram']);
        $facebook = htmlspecialchars($_POST['facebook']);
        $google = htmlspecialchars($_POST['google']);

        $accept = array("jpg", "png", "svg", "webp");

        $name = $_FILES['logo']['name'];
        $name = explode(".", $name);

        $extension = $name[count($name) - 1];
        $name = $name[0];
        $tmpFile = $_FILES['logo']['tmp_name'];
        $a = false;
        for ($i=0; $i < count($accept); $i++) { 
            if ($accept[$i] == $extension) {
                $a = true;
                break;
            }
        }

        //check pixel di dalam file
        $uploaddir = "icon/";
        $fileName = "logo.".$extension;
        $uploadfile = $uploaddir.$fileName;
        $imageInfo = getimagesize($tmpFile);
        if ($a) {
            if($imageInfo[0] > 0 && $imageInfo[1] > 0){
                if (move_uploaded_file($tmpFile, $uploadfile)) {
                    $mysqli = mysqli_connect($host, $user, $pass, $db);
                    $sql = "INSERT INTO profile(name, address, logo, instagram, facebook, google)
                            VALUES (?, ?, ?, ?, ?, ?)";
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("ssssss", $nameProfile, $address, $fileName, $instagram, $facebook, $google);
                        if ($stmt->execute()) {
                            echo "berhasil";
                        }
                        else{
                            echo "Gagal mengeksekusi sql";
                        }
                    }
                    else{
                        echo "Gagal menyiapkan sql";
                    }
                    $sql = "INSERT INTO category(name) VALUES('unknown')";
                    if ($query = $mysqli->query($sql)) {
                        header("Location: admin/");
                    }
                } else {
                    header("Location: init.php?message=Gagal mengunggah file");
                    //echo "Possible file upload attack!\n";
                }
            }
            else{
                header("Location: init.php?message=File bukan gambar");
                //echo "file bukan gambar";
            }
        }
        

    }
?>
<link rel="stylesheet" type="text/css" href="style/w3.css">
<link rel="stylesheet" type="text/css" href="style/css.css">
<div class="w3-modal" style="display: block;">
    <form action="init.php" method="post" enctype="multipart/form-data" style="margin: 20px 100px; background-color: white; padding: 30px 15px 30px 50px;">
        <center><input type="text" name="name" required class="search" placeholder="Masukkan Nama" style="margin: 0 20px 20px -20px;" autofocus>
        <input type="text" name="facebook" required class="search" placeholder="Masukkan Link Facebook" style="margin: 0 20px 20px;">
        <input type="text" name="instagram" required class="search" placeholder="Masukkan Link Instagram" style="margin: 0 20px 20px;">
        <input type="text" name="google" required class="search" placeholder="Masukkan Link Google+" style="margin: 0 20px 20px;"><br>
        <input type="text" name="database" required class="search" placeholder="Masukkan Nama Database" style="margin: 0 20px 20px -20px;">
        <input type="text" name="host" required class="search" placeholder="Masukkan Host Database" style="margin: 0 20px 20px;">
        <input type="text" name="dbUser" required class="search" placeholder="Masukkan User Database" style="margin: 0 20px 20px;">
        <input type="text" name="dbPass" class="search" placeholder="Masukkan Password Database" style="margin: 0 20px 20px;"><br></center>
        <textarea name="address" required class="search" placeholder="Masukkan Alamat" style="margin: 0 0px 20px 0px"></textarea><br>
        Upload logo : <input type="file" accept="image/*" name="logo" required style="margin: 0 20px 20px;"><br>
        <center><input type="submit" value="Submit" name="submit" class="w3-btn w3-red" style="margin: 20px 0 0 -40px;"></center>
    </form>
</div>
