<?php
    include "../API/rajaOngkir.php";

    $idProvince = $_POST['idProvince'];

    $obj = new RajaOngkir;
    echo $obj->getCity($idProvince);
?>