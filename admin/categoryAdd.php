<?php
    include "../config/session.php";
    include "../config/config.php";
    if (isset($_POST['addSubmit'])) {
        $sql = "INSERT INTO category (name) VALUES(?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $_POST['name']);
            if($stmt->execute()){
                header("Location: category.php");
            }
            else{
                echo "execute failed";
            }
        }
        else{
            echo "prepare failed";
        }
    }
    else{
        header("Location: category.php");
    }
    $stmt->close();
    $mysqli->close();
    
?>