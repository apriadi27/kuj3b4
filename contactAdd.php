<?php
    include "config/config.php";
    session_start();

    if (isset($_POST['addSubmit'])) {
        $address = htmlspecialchars($_POST['addAddress']);
        $province = $_POST['addProvince'];
        $city = $_POST['addCity'];
        $postal = htmlspecialchars($_POST['addPostalCode']);
        $id = $_SESSION['id'];
        
        $sql = "INSERT INTO contact(idAccount, idCity, idProvince, postalCode, Address)
                VALUES('$id', '$city', '$province', '$postal', '$address')";
        if ($query = $mysqli->query($sql)) {
            header("Location:kontak.php");
        }
        else{
            header("Location: kontak.php?message=".$mysqli->error);
        }
    }
    header("Location:kontak.php");
    
?>