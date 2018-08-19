<?php
    include "config/config.php";
    include "config/sessionUser.php";

    if (isset($_POST['editSubmit'])) {
        $id = $_POST['editIdContact'];
        $address = htmlspecialchars($_POST['editAddress']);
        $province = $_POST['editProvince'];
        $city = $_POST['editCity'];
        $postalCode = htmlspecialchars($_POST['editPostalCode']);
        $sql = "UPDATE contact SET 
                address=?,
                idCity=?,
                idProvince=?,
                postalCode=?
                WHERE idContact=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("siiii", $address, $city, $province, $postalCode, $id);
            if ($stmt->execute()) {
                header("Location: kontak.php?message=Berhasil");
            }
            else{
                header("Location: kontak.php?message=".$stmt->error);
            }
        }
        else{
            header("Location: kontak.php?message=".$mysqli->error);
        }
    }
    else{
        header("Location: kontak.php");
    }
    
?>