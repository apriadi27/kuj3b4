<?php
    //include "../config/session.php";
    include "../config/config.php";

    if (isset($_POST['editSubmit'])) {
        $pass = htmlspecialchars($_POST['editPassSosmed']);
        $id = htmlspecialchars($_POST['editIdSosmed']);
        $type = $_POST['editTypeSosmed'];

        //encrypt password
        $cipher = "aes-128-gcm";
        $key = openssl_random_pseudo_bytes(10);
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $cipherPass = openssl_encrypt($pass, $cipher, $key, $options=0, $iv, $tag);
            //echo $cipherText."<br>";

            //$originalText = openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv, $tag);
        }

        $sql = "UPDATE sosmed SET
                pass=?,
                keySosmed=?,
                ivSosmed=?
                WHERE idSosmed=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssi", $cipherPass, $key, $iv, $id);
            if ($stmt->execute()) {
                header("Location: sosmed.php?message=Berhasil");
            }
            else{
                header("Location: sosmed.php?message=Gagal mengeksekusi sql");
            }
        }
        else{
            header("Location: sosmed.php?message=Gagal menyiapkan sql");
        }
    }
    else {
        header("Location: sosmed.php");
    }
?>