<?php
    $pass = "password";
    $iterations = 1000;

    $salt = openssl_random_pseudo_bytes(16);

    $hash = hash_pbkdf2("sha256", $pass, $salt, $iterations, 40);
    echo $hash;
?>