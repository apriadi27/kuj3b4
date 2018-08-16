-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2018 at 06:02 AM
-- Server version: 5.7.19
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokobaju1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `idEmail` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phoneNumber` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`idEmail`, `picture`, `status`, `phoneNumber`) VALUES
('willychai04@gmail.com', 'jefiwjife', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` tinyint(3) UNSIGNED NOT NULL,
  `name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCategory`, `name`) VALUES
(1, 'Baju Bayi'),
(2, 'Celana pendek bayi'),
(3, 'Celana panjang bayi'),
(4, 'Sarung tangan'),
(5, 'Kaos kaki'),
(6, 'Topi bayi'),
(7, 'Setelan Baju Bayi'),
(8, 'Baju Bayi');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `idContact` tinyint(1) UNSIGNED NOT NULL,
  `idAccount` varchar(50) NOT NULL,
  `idCity` smallint(4) UNSIGNED NOT NULL,
  `idProvince` smallint(4) UNSIGNED NOT NULL,
  `postalCode` mediumint(6) UNSIGNED NOT NULL,
  `Address` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`idContact`, `idAccount`, `idCity`, `idProvince`, `postalCode`, `Address`) VALUES
(1, 'willychai04@gmail.com', 293, 8, 78111, 'Jl .Merdeka'),
(2, 'willychai04@gmail.com', 94, 1, 78111, 'Bali');

-- --------------------------------------------------------

--
-- Table structure for table `dataproduct`
--

CREATE TABLE `dataproduct` (
  `idProduct` smallint(5) UNSIGNED NOT NULL,
  `name` char(70) NOT NULL,
  `description` tinytext NOT NULL,
  `size` char(10) NOT NULL,
  `color` char(7) NOT NULL,
  `picture` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataproduct`
--

INSERT INTO `dataproduct` (`idProduct`, `name`, `description`, `size`, `color`, `picture`) VALUES
(4, 'Topi bonnet bayi perempuan bunga', 'Untuk bayi 0-24 bulan (allsize) Lingkar kepala 36-48 cm Material: cotton Pilihan warna: pink dan putih  Harga untuk 1x topi bayi ', 'S-XL', '#e971f2', '4c7489d8c7ef9dfb4cfbeb61b824a363b.jpg'),
(5, 'Topi Pilot Anak &amp; Bayi Rajut', 'Topi Pilot Anak &amp; Bayi Rajut Untuk usia anak : 6 bulan - 3 tahun Ada 9 pilihan warna B, C, D dan F Kosong', 'S-XL', '#97ac40', '5646dd5120051663f2ecea223e6d6adaf.jpg'),
(6, 'baju setelan anak bayi rompi tentara topi - cool army', 'READY SIZE ( 1 , 2 , 3 , 5 , 6 )  Setelan Baju Bayi Army (tentara) dengan Rompi Pisah dan Topi.', 'S-XL', '#278a15', '6940a7888cc97174dc6a61b594921b2b5.jpg'),
(7, 'Jumper Bayi Nanas + Topi Laki laki Perempuan Baju Kostum Karakter Baby', 'Jumper Bayi Nanas + Topi  Bahan : Kaos (lembut, adem dan nyaman dipakai buah hati)', 'S-XL', '#e1dc11', '74ac6dd06335425875f507c83bbf4eb54.jpg'),
(8, 'Setelan Baju Anak Bayi laki Lucu 2 Dasi + Topi - Thomas', 'Pilihan Warna : MERAH?BIRU NAVY/ABU (MOHON CEK STOK DAHULU) 1 set terdiri dari : Baju + Celana + Topi + 2 Dasi (dasi Kupu kupu dan Dasi Panjang)', 'S-XL', '#e90a0f', '8442a6d451b436d8a04137a0e82320f4d.jpg'),
(9, 'KAOS KAKI LUCU BAYI IMPORT MURAH - 12-24mo, tupaicoklattua', 'bahan premium, halus dan sangat nyaman dipakai untuk kaki si Kecil Mom,  bentuk sangat Lucu, menarik, warna cerah, dan bentuk 3d yah Mom^^', 'S-XL', '#219a10', '90c0b025e19357db01cf77ed348a37be5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaction`
--

CREATE TABLE `detailtransaction` (
  `idDetailTransaction` int(11) UNSIGNED NOT NULL,
  `idTransaction` int(11) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `zipCode` char(6) NOT NULL,
  `city` char(30) NOT NULL,
  `province` char(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nonota`
--

CREATE TABLE `nonota` (
  `idNota` int(11) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `service` char(10) NOT NULL,
  `ongkir` mediumint(11) UNSIGNED NOT NULL,
  `total` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nonota`
--

INSERT INTO `nonota` (`idNota`, `tanggal`, `service`, `ongkir`, `total`) VALUES
(1, '2018-08-16', '48000', 48000, 0),
(2, '2018-08-16', '48000', 48000, 0),
(3, '2018-08-16', '48000', 48000, 0),
(4, '2018-08-16', '48000', 48000, 0),
(5, '2018-08-16', '48000', 48000, 0),
(6, '2018-08-16', '48000', 48000, 0),
(7, '2018-08-16', '48000', 48000, 0),
(8, '2018-08-16', '48000', 48000, 0),
(9, '2018-08-16', '48000', 48000, 0),
(10, '2018-08-16', '48000', 48000, 0),
(11, '2018-08-16', '48000', 48000, 0),
(12, '2018-08-16', '48000', 48000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `idOrder` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `noNota` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idProduct` smallint(5) UNSIGNED NOT NULL,
  `idCategory` tinyint(3) UNSIGNED NOT NULL,
  `capital` mediumint(8) UNSIGNED NOT NULL,
  `sellingPrice` mediumint(8) UNSIGNED NOT NULL,
  `stock` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idProduct`, `idCategory`, `capital`, `sellingPrice`, `stock`) VALUES
(1, 6, 10000, 50000, 100),
(2, 2, 5000, 45000, 10),
(3, 2, 5000, 45000, 10),
(4, 6, 5000, 45000, 10),
(5, 6, 5000, 45000, 10),
(6, 3, 5000, 45000, 10),
(7, 7, 10000, 45000, 10),
(8, 7, 10000, 58000, 10),
(9, 5, 10000, 60000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `name` char(20) NOT NULL,
  `address` tinytext NOT NULL,
  `logo` char(100) NOT NULL,
  `instagram` char(200) NOT NULL,
  `facebook` char(200) NOT NULL,
  `google` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sosmed`
--

CREATE TABLE `sosmed` (
  `idSosmed` tinyint(2) UNSIGNED NOT NULL,
  `userSosmed` char(50) NOT NULL,
  `pass` char(50) NOT NULL,
  `type` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosmed`
--

INSERT INTO `sosmed` (`idSosmed`, `userSosmed`, `pass`, `type`) VALUES
(1, 'nindya@gmail.com', 'SjIxQWZkbjQh', 'Instagram');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `idTransaction` int(11) UNSIGNED NOT NULL,
  `idAccount` varchar(50) NOT NULL,
  `productName` char(100) NOT NULL,
  `total` tinyint(3) NOT NULL,
  `capital` mediumint(8) NOT NULL,
  `sellingPrice` mediumint(8) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `idTransfer` int(11) NOT NULL,
  `noRek` varchar(20) NOT NULL,
  `namaPelanggan` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `namaBank` varchar(20) NOT NULL,
  `pemilikRek` char(20) NOT NULL,
  `jumlah` char(10) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trolli`
--

CREATE TABLE `trolli` (
  `idTrolli` int(11) NOT NULL,
  `idAccount` varchar(50) NOT NULL,
  `idProduct` smallint(5) NOT NULL,
  `total` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trolli`
--

INSERT INTO `trolli` (`idTrolli`, `idAccount`, `idProduct`, `total`) VALUES
(1, 'willychai04@gmail.com', 7, 1),
(2, 'willychai04@gmail.com', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`idEmail`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`),
  ADD KEY `idToken` (`idAccount`),
  ADD KEY `idCity` (`idCity`),
  ADD KEY `idProvince` (`idProvince`);

--
-- Indexes for table `dataproduct`
--
ALTER TABLE `dataproduct`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indexes for table `detailtransaction`
--
ALTER TABLE `detailtransaction`
  ADD PRIMARY KEY (`idDetailTransaction`),
  ADD KEY `idTransaction` (`idTransaction`);

--
-- Indexes for table `nonota`
--
ALTER TABLE `nonota`
  ADD PRIMARY KEY (`idNota`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`idSosmed`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idTransaction`),
  ADD KEY `idAccount` (`idAccount`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`idTransfer`);

--
-- Indexes for table `trolli`
--
ALTER TABLE `trolli`
  ADD PRIMARY KEY (`idTrolli`),
  ADD KEY `idAccount` (`idAccount`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detailtransaction`
--
ALTER TABLE `detailtransaction`
  MODIFY `idDetailTransaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonota`
--
ALTER TABLE `nonota`
  MODIFY `idNota` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `idOrder` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `idSosmed` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idTransaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `idTransfer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trolli`
--
ALTER TABLE `trolli`
  MODIFY `idTrolli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`idEmail`);

--
-- Constraints for table `dataproduct`
--
ALTER TABLE `dataproduct`
  ADD CONSTRAINT `dataproduct_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);

--
-- Constraints for table `detailtransaction`
--
ALTER TABLE `detailtransaction`
  ADD CONSTRAINT `detailtransaction_ibfk_1` FOREIGN KEY (`idTransaction`) REFERENCES `transaction` (`idTransaction`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`idEmail`);

--
-- Constraints for table `trolli`
--
ALTER TABLE `trolli`
  ADD CONSTRAINT `trolli_ibfk_1` FOREIGN KEY (`idAccount`) REFERENCES `account` (`idEmail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
