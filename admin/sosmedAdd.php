<?php
    //include "../config/session.php";
    include "../config/config.php";

    if (isset($_POST['addSubmit'])) {
        $pass = htmlspecialchars($_POST['addPass']);
        $user = htmlspecialchars($_POST['addUser']);
        $type = $_POST['addType'];

        $cipher = "aes-128-gcm";
        $key = openssl_random_pseudo_bytes(10);
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $cipherPass = openssl_encrypt($pass, $cipher, $key, $options=0, $iv, $tag);
            //echo $cipherText."<br>";

            //$originalText = openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv, $tag);
        }

        $sql = "INSERT INTO sosmed (userSosmed, pass, type, keySosmed, ivSosmed)
                VALUES (?, ?, ?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssss", $user, $cipherPass, $type, $key, $iv);
            if ($stmt->execute()) {
                header("Location: sosmed.php");
            }
            else{
                header("Location: sosmed.php?message=Gagal mengeksekusi sql");
            }
        }
        else{
            header("Location: sosmed.php?message=Gagal mensiapkan sql");
        }
    }
    else{
        header("Location: sosmed.php");
    }
    $stmt->close();
    $mysqli->close();
?>