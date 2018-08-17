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
<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Hijab Instan Khimar Simpel Pet", "Ciput DE'CANTIQU - Ankem/Antem/Inner - Rose", "Jilbab Satin Velvet Segiempat Square Polos", "Hijab / Jilbab Hasya Rempel"],
        datasets: [{
            label: 'Penjualan Item',
            data: [10, 2, 7, 5],
            backgroundColor: [
                'rgba(22, 99, 132, 1)',
                'rgba(54, 12, 235, 1)',
                'rgba(215, 20, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderColor: [
                'rgba(22, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(215, 20, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        layout:{
            padding:{
                left:10,
                right: 0,
                top: 0,
                bottom: 0,
            }
        },
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
</div>