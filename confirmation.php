<?php
	include "config/config.php";
	include "config/sessionUser.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Toko Kamanda Shop</title>
	<meta name="google-signin-scope" content="profile email"> 
    <meta name="google-signin-client_id" content="571963356124-9nhkogpvo06cmqjnav3qh8cv3848n6na.apps.googleusercontent.com"> 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<?php
		include 'head.php';
	?>
</head>
<body>

<?php
  include 'header.php';
?>

<div class="isi">
<?php
	$id = $_SESSION['id'];
	$status = 0;
	$checkPayment;
	//check confirmation
	$banyakNota = array();
	$sql = "SELECT nonota.idNota
			FROM nonota
				LEFT JOIN confirmation
				ON confirmation.idNota = nonota.idNota
			WHERE nonota.idAccount = ?
			AND confirmation.idNota IS NULL";
	if ($stmt = $mysqli->prepare($sql)) {
		$stmt->bind_param("s", $id);
		if ($stmt->execute()) {
			$stmt->bind_result($idNota);
			while ($stmt->fetch()) {
				array_push($banyakNota, $idNota);
			}
			unset($idNota);
		}
		else{
			echo $stmt->error;
		}
		$stmt->close();
	}
	else{
		echo $mysqli->error;
	}
	//end check nota and confirmation

	
	if (count($banyakNota) == 0) {
		$sql = "SELECT 
			nonota.status,
			confirmation.idConfirmation, 
			confirmation.bank, 
			confirmation.numberAccount, 
			confirmation.accountOwner 
			FROM confirmation
			INNER JOIN nonota
			ON confirmation.idNota = nonota.idNota
			WHERE nonota.idAccount = ?";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("s", $id);
			if ($stmt->execute()) {
				$stmt->bind_result($sqlStatus, $sqlIdConfirmation, $sqlBank, $sqlNumberAccount, $sqlAccountOwner);
				?>
				<table class="w3-table w3-striped">
				<tr class="w3-cyan">
					<th>Bank</th>
					<th>No. Rek</th>
					<th>Nama Pemilik</th>
					<th>Status</th>
				</tr><?php
				while ($stmt->fetch()) {
					?>
					<tr>
						<td><?php echo $sqlBank; ?></td>
						<td><?php echo $sqlNumberAccount; ?></td>
						<td><?php echo $sqlAccountOwner; ?></td>
						<td><?php if ($sqlStatus == 1) {
							echo "Konfirmasi selesai";
						}
						else{
							echo "Admin belum mengkonfirmasi pesanan";
						} ?></td>
					</tr>
					<?php
				}
				?></table><?php
			}
			else{
				echo $stmt->error;
			}
			$stmt->close();
		}
		else{
			echo $mysqli->error;
		}
	}
	else{
?>
	<form action="addConfirmation.php" method="post" enctype="multipart/form-data">
		<p><?php echo "Id Nota : ".$banyakNota[0]; ?></p>
		<input type="hidden" name="idNota" value="<?php echo $banyakNota[0]; ?>">
		<input type="text" name="bankName" placeholder="Nama Bank" class="search" style="width: 400px; margin: 20px 0 40px -27px;"><br>
		<input type="text" name="numberAccount" placeholder="Nomor Rekening" class="search" style="width: 400px; margin: 20px 0 40px -27px;"><br>
		<input type="text" name="accountOwner" placeholder="Nama Pemilik Rekening" class="search" style="width: 400px; margin: 20px 0 40px -27px;"><br>
		Upload bukti pembayaran : <input type="file" name="picture" style="margin-bottom: 40px;" accept="image/*"><br>
		<input type="submit" value="Bayar" name="addSubmit" class="w3-btn w3-cyan" style="margin: 40px 0 0 -27px">
	</form>
</div>
<?php
	}
?>

</body>
</html>
<?php
	$mysqli->close();
?>