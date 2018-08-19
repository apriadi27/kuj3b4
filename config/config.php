<?php
    $string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/config.json");
    $json = json_decode($string, true);
    $mysqli = mysqli_connect($json['host'], $json['user'], $json['pass'], $json['database']);
    date_default_timezone_set('Asia/Jakarta');
    unset($string, $json);
?>