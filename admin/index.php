<?php
    include "../config/session.php";
    include "../config/config.php";
    $string = file_get_contents('../config.json');
	$json = json_decode($string, true);
	if ($json['new'] == 1) {
		header("Location: ../init.php");
    }
    if (isset($_GET['logout'])) {
        if ($_GET['logout']) {
            header("Location: ../index.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<?php include "head.php"; ?>
    
</head>
<body>
<?php
    include 'menu.php';
?>

<div class="isi">
<canvas id="productCanvas" style="width: 80%; height:auto"></canvas>
    <?php
    $result = array();
    $result['labels'] = array();
    $result['data'] = array();
    $result['bgColor'] = array();
    $sql = "SELECT productName, sum(total) as total
            FROM transaction
            GROUP BY productName
            ORDER BY total DESC LIMIT 10";
    if ($stmt = $mysqli->prepare($sql)) {
        if ($stmt->execute()) {
            $stmt->bind_result($sqlProductName, $sqlTotal);
            while ($stmt->fetch()) {
                array_push($result['labels'], $sqlProductName);
                array_push($result['data'], intval($sqlTotal));
                array_push($result['bgColor'], "rgba(".rand(0, 255).",".rand(0, 255).",".rand(0, 255).",1)");
            }
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        echo $mysqli->error;
    }
    ?><script>adminCharts("productCanvas", '<?php echo json_encode($result); ?>', "Penjualan Items")</script><?php
    ?>
<canvas id="keuntunganCanvas" style="width: 80%; height:auto"></canvas>
    <?php
    $result = array();
    $result['labels'] = array();
    $result['data'] = array();
    $result['bgColor'] = array();
    $sql = "SELECT productName, sum(sellingPrice - capital * total) as neto
            FROM transaction
            GROUP BY productName
            ORDER BY neto DESC LIMIT 10";
    if ($stmt = $mysqli->prepare($sql)) {
        if ($stmt->execute()) {
            $stmt->bind_result($sqlProductName, $sqlTotal);
            while ($stmt->fetch()) {
                array_push($result['labels'], $sqlProductName);
                array_push($result['data'], intval($sqlTotal));
                array_push($result['bgColor'], "rgba(".rand(0, 255).",".rand(0, 255).",".rand(0, 255).",1)");
            }
        }
        else{
            echo $stmt->error;
        }
        $stmt->close();
    }
    else{
        echo $mysqli->error;
    }
    ?><script>adminCharts("keuntunganCanvas", '<?php echo json_encode($result); ?>', "Keuntungan per Items")</script><?php
    ?>
</div>
</body>
</html>