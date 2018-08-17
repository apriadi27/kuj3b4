<?php
	include "config/config.php";
	include "config/sessionUser.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head.php"; ?>
</head>
<body>
<<<<<<< HEAD
=======
<?php include "header.php"; ?>

<div class="header w3-cyan">
	<button class="menuButton w3-hover-white" onclick="openNav()"><i class="fas fa-bars fa-2x"></i></button>
	<p class="toko">Toko Kamanda Shop</p>
	<input type="text" name="search" placeholder="Cari produk" class="search">

	<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float: right;"></div> 
    <script> 
      function onSignIn(googleUser) { 
        // Useful data for your client-side scripts: 
        var profile = googleUser.getBasicProfile(); 
        console.log("ID: " + profile.getId()); // Don't send this directly to your server! 
        console.log('Full Name: ' + profile.getName()); 
        console.log('Given Name: ' + profile.getGivenName()); 
        console.log('Family Name: ' + profile.getFamilyName()); 
        console.log("Image URL: " + profile.getImageUrl()); 
        console.log("Email: " + profile.getEmail());
>>>>>>> e01b1e30863d553ee5b586c2ae9f0af24a75b151

<?php include "header.php"; ?>

<div style="margin: 30px -20px 20px 80px;">
<?php
	$sql = "SELECT product.idProduct, 
			product.sellingPrice, 
			dataproduct.name,
			dataproduct.picture
			FROM product
			INNER JOIN dataproduct
			ON product.idProduct = dataproduct.idProduct";
	if ($query = $mysqli->query($sql)) {
		while ($row = $query->fetch_assoc()) {
			?>
			<a href="detailProduct.php?idProduct=<?php echo $row['idProduct']; ?>">
                <div class="w3-card-4" style="width: 200px; float: left; margin: 0 20px 40px">
                    <img src="productPicture/<?php echo $row['picture']; ?>" alt="Norway" class="produk">
                    <div style="padding: 10px 20px;">
                        <div style="margin: 0 0 20px; height: 50px"><b><?php $name = (strlen($row['name']) > 40) ? substr($row['name'],0, 40)."..." : substr($row['name'],0, 40); echo $name; ?></b></div><br>
                        <p style="margin-top: -20px;"><?php echo $row['sellingPrice']; ?></p>
                    </div>
                </div>
            </a>
			<?php
		}
	}
?>
	<div class="w3-card-4" style="width: 200px; float: left; margin-right: 40px">
        <img src="picture/jilbab instan meyka (39).png" class="produk"><br>
        <div style="padding: 10px 20px;">
            <div style="margin: 0 0 0px"><b>Jilbab Instan Meyka</b></div><br>
            <p style="margin-top: -20px;">39000</p>
        </div>
    </div>
    <div class="w3-card-4" style="width: 200px; float: left; margin-right: 40px">
        <img src="picture/jilbab instan salwa (16k).jfif" class="produk"><br>
        <div style="padding: 10px 20px;">
            <div style="margin: 0 0 20px"><b>Jilbab Instan Salwa</b></div><br>
            <p style="margin-top: -20px;">16000</p>
        </div>
    </div>
    <div class="w3-card-4" style="width: 200px; float: left; margin-right: 40px">
        <img src="picture/jilbab isaura kancing (18).jfif" class="produk"><br>
        <div style="padding: 10px 20px;">
            <div style="margin-top: 0px"><b>Jilbab Isaura Kancing</b></div><br>
            <p style="margin-top: -20px;">18000</p>
        </div>
    </div>
    <div class="w3-card-4" style="width: 200px; float: left; margin-right: 40px">
        <img src="picture/jilbab segiempat (24).png" class="produk"><br>
        <div style="padding: 10px 20px;">
            <div style="margin: 0 0 20px"><b>Jilbab Segiempat</b></div><br>
            <p style="margin-top: -20px;">24000</p>
        </div>
    </div>
	<div class="w3-card-4" style="width: 200px; float: left; margin-right: 40px">
        <img src="picture/jilbab serut (12k).jfif" class="produk"><br>
        <div style="padding: 10px 20px;">
            <div style="margin: 0 0 20px"><b>Jilbab Serut</b></div><br>
            <p style="margin-top: -20px;">12000</p>
        </div>
    </div>
</div>
</body>
</html>
<?php
	$mysqli->close();
?>