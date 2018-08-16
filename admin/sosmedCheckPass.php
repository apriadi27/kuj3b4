<?php
    include "../config/session.php";
    include "../config/config.php";

    $pass = htmlspecialchars($_POST['pass']);
    $id = $_POST['id'];
    $type = $_POST['type'];


    $tmp = "";
    $key = "";
    $iv = "";
    $sql = "SELECT pass, keySosmed, ivSosmed FROM sosmed WHERE idSosmed=? AND type=?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("is", $id, $type);
        if ($stmt->execute()) {
            $stmt->bind_result($tmpPass, $key, $iv);
            $stmt->fetch();

            $cipher = "aes-128-gcm";
            if (in_array($cipher, openssl_get_cipher_methods())) {
                $cipherPass = openssl_encrypt($pass, $cipher, $key, $options=0, $iv, $tag);
                //echo $cipherText."<br>";
                if ($cipherPass == $tmpPass) {
                    echo "1";
                }
                else{
                    echo "Password salah";
                }
                //$originalText = openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv, $tag);
            }
        }
        else{
            echo "Gagal mengeksekusi sql";
        }
    }
    else{
        echo $mysqli->error;
        echo "Gagal menyiapkan sql";
    }

?>