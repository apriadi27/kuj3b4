<?php
    include "../API/rajaOngkir.php";

    $destination = $_POST['idCity'];
    $weight = 1;

    $obj = new RajaOngkir;
    echo $obj->getCost($destination, $weight);
?>