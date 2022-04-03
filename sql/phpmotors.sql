-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Apr 03, 2022 at 03:52 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(14, 'Starships');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Serius', 'Black', 'seriusB@orderofthepheonix.com', 'padfoot', '1', NULL),
(5, 'Jaden', 'Mounteer', 'mounteerjaden@gmail.com', '$2y$10$lNJUjQjv5YO0IeB5vCYprOHYKoHugfQBcBtH00H.VTm00JrONlcjW', '1', NULL),
(6, 'Ilove', 'cookies', 'ilovecookies@gmail.com', '$2y$10$R8R5RvfkLqqx51acOFpMrewQRFqYT63VzwmaYYMubvwwwTFPdcWXa', '1', NULL),
(7, 'Admin', 'superUser2', 'admin@cse340.net', '$2y$10$aYORSc9TBdUIoVmrP9MG9OzduRG1nIXKhIgb9.J/78kfaWu4pTIke', '3', NULL),
(8, 'test', 'user', 'testuser@gmail.com', '$2y$10$qZOQGwb6JsEW5Nhww5qYRuefvPKuUkbnaKyRlWh6DyIRVAtHfz672', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(5, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2022-03-21 13:34:44', 1),
(6, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2022-03-21 13:34:44', 1),
(7, 13, 'aerocar.jpeg', '/phpmotors/images/vehicles/aerocar.jpeg', '2022-03-21 13:36:02', 1),
(8, 13, 'aerocar-tn.jpeg', '/phpmotors/images/vehicles/aerocar-tn.jpeg', '2022-03-21 13:36:02', 1),
(9, 6, 'batmobile.jpeg', '/phpmotors/images/vehicles/batmobile.jpeg', '2022-03-21 13:36:25', 1),
(10, 6, 'batmobile-tn.jpeg', '/phpmotors/images/vehicles/batmobile-tn.jpeg', '2022-03-21 13:36:25', 1),
(11, 10, 'camaro.jpeg', '/phpmotors/images/vehicles/camaro.jpeg', '2022-03-21 13:37:07', 1),
(12, 10, 'camaro-tn.jpeg', '/phpmotors/images/vehicles/camaro-tn.jpeg', '2022-03-21 13:37:07', 1),
(13, 9, 'crwn-vic.jpeg', '/phpmotors/images/vehicles/crwn-vic.jpeg', '2022-03-21 13:37:31', 1),
(14, 9, 'crwn-vic-tn.jpeg', '/phpmotors/images/vehicles/crwn-vic-tn.jpeg', '2022-03-21 13:37:31', 1),
(15, 11, 'escalade.jpeg', '/phpmotors/images/vehicles/escalade.jpeg', '2022-03-21 13:38:19', 1),
(16, 11, 'escalade-tn.jpeg', '/phpmotors/images/vehicles/escalade-tn.jpeg', '2022-03-21 13:38:19', 1),
(17, 8, 'fire-truck.jpeg', '/phpmotors/images/vehicles/fire-truck.jpeg', '2022-03-21 13:38:46', 1),
(18, 8, 'fire-truck-tn.jpeg', '/phpmotors/images/vehicles/fire-truck-tn.jpeg', '2022-03-21 13:38:46', 1),
(19, 12, 'hummer.jpeg', '/phpmotors/images/vehicles/hummer.jpeg', '2022-03-21 13:39:13', 1),
(20, 12, 'hummer-tn.jpeg', '/phpmotors/images/vehicles/hummer-tn.jpeg', '2022-03-21 13:39:13', 1),
(21, 5, 'mechanic.jpeg', '/phpmotors/images/vehicles/mechanic.jpeg', '2022-03-21 13:39:32', 1),
(22, 5, 'mechanic-tn.jpeg', '/phpmotors/images/vehicles/mechanic-tn.jpeg', '2022-03-21 13:39:32', 1),
(23, 2, 'model-t.jpeg', '/phpmotors/images/vehicles/model-t.jpeg', '2022-03-21 13:39:53', 1),
(24, 2, 'model-t-tn.jpeg', '/phpmotors/images/vehicles/model-t-tn.jpeg', '2022-03-21 13:39:53', 1),
(25, 4, 'monster-truck.jpeg', '/phpmotors/images/vehicles/monster-truck.jpeg', '2022-03-21 13:40:10', 1),
(26, 4, 'monster-truck-tn.jpeg', '/phpmotors/images/vehicles/monster-truck-tn.jpeg', '2022-03-21 13:40:10', 1),
(27, 7, 'mystery-van.jpeg', '/phpmotors/images/vehicles/mystery-van.jpeg', '2022-03-21 13:40:28', 1),
(28, 7, 'mystery-van-tn.jpeg', '/phpmotors/images/vehicles/mystery-van-tn.jpeg', '2022-03-21 13:40:28', 1),
(29, 14, 'van.jpeg', '/phpmotors/images/vehicles/van.jpeg', '2022-03-21 13:40:51', 1),
(30, 14, 'van-tn.jpeg', '/phpmotors/images/vehicles/van-tn.jpeg', '2022-03-21 13:40:51', 1),
(31, 1, 'wrangler.jpeg', '/phpmotors/images/vehicles/wrangler.jpeg', '2022-03-21 13:41:07', 1),
(32, 1, 'wrangler-tn.jpeg', '/phpmotors/images/vehicles/wrangler-tn.jpeg', '2022-03-21 13:41:07', 1),
(33, 15, 'no-image.jpeg', '/phpmotors/images/vehicles/no-image.jpeg', '2022-03-21 13:41:46', 1),
(34, 15, 'no-image-tn.jpeg', '/phpmotors/images/vehicles/no-image-tn.jpeg', '2022-03-21 13:41:46', 1),
(35, 32, 'delorean.jpeg', '/phpmotors/images/vehicles/delorean.jpeg', '2022-03-22 13:11:49', 1),
(36, 32, 'delorean-tn.jpeg', '/phpmotors/images/vehicles/delorean-tn.jpeg', '2022-03-22 13:11:49', 1),
(37, 7, 'mystery_machine_-_additional_image.jpeg', '/phpmotors/images/vehicles/mystery_machine_-_additional_image.jpeg', '2022-03-22 13:19:44', 0),
(38, 7, 'mystery_machine_-_additional_image-tn.jpeg', '/phpmotors/images/vehicles/mystery_machine_-_additional_image-tn.jpeg', '2022-03-22 13:19:44', 0),
(39, 2, 'Model-T-1909.jpeg', '/phpmotors/images/vehicles/Model-T-1909.jpeg', '2022-03-22 13:20:20', 0),
(40, 2, 'Model-T-1909-tn.jpeg', '/phpmotors/images/vehicles/Model-T-1909-tn.jpeg', '2022-03-22 13:20:20', 0),
(41, 4, 'monster truck - additional.jpeg', '/phpmotors/images/vehicles/monster truck - additional.jpeg', '2022-03-22 13:20:29', 0),
(42, 4, 'monster truck - additional-tn.jpeg', '/phpmotors/images/vehicles/monster truck - additional-tn.jpeg', '2022-03-22 13:20:29', 0),
(43, 32, 'delorean-no-background.jpeg', '/phpmotors/images/vehicles/delorean-no-background.jpeg', '2022-03-22 13:25:21', 0),
(44, 32, 'delorean-no-background-tn.jpeg', '/phpmotors/images/vehicles/delorean-no-background-tn.jpeg', '2022-03-22 13:25:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '../images/vehicles/wrangler.jpg', '../images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '../images/vehicles/model-t.jpg', '../images/vehicles/model-t-tn.jpg', '30000', 3, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '../images/vehicles/adventador.jpg', '../images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '../images/vehicles/monster-truck.jpg', '../images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '../images/vehicles/mechanic.jpg', '../images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '../images/vehicles/batmobile.jpg', '../images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '../images/vehicles/mystery-van.jpg', '../images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '../images/vehicles/fire-truck.jpg', '../images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '../images/vehicles/crwn-vic.jpg', '../images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '../images/vehicles/camaro.jpg', '../images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '../images/vehicles/escalade.jpg', '../images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '../images/vehicles/hummer.jpg', '../images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '../images/vehicles/aerocar.jpg', '../images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '../images/vehicles/van.jpg', '../images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '../images/vehicles/no-image.png', '../images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(32, 'DMC', 'DeLorean', 'The car from back to the future', 'www/phpmotors/images/vehicles/adventador-tn.jpg', 'www/phpmotors/images/vehicles/adventador-tn.jpg', '6000', 1, 'Grey', 2),
(33, 'Starship', 'Enterprise', 'Boldly go...', 'test', 'test', '200000', 1, 'Silver', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL,
  `screenName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`, `screenName`) VALUES
(38, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ex congue sem volutpat suscipit. Phasellus volutpat, lorem et euismod condimentum, neque lectus pharetra leo, sit amet malesuada augue ante sed est. Vivamus iaculis dui nec dolor imperdiet, id pulvinar mi maximus. Nulla sit amet tempus ante, ac porta velit. Duis sed urna non metus semper fringilla vitae a tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris placerat, magna et mollis sodales, libero erat pulvinar mi, et porta ipsum neque vitae tellus. Mauris id nibh mattis, tempus mi non, finibus ante. Curabitur vulputate rutrum tempor. Suspendisse eget diam vel magna blandit aliquet. Maecenas laoreet elit vitae libero sodales, cursus lacinia arcu hendrerit. Nulla molestie vulputate mi, non auctor mi fermentum nec. Nunc eget mi vel sapien consectetur volutpat quis ut leo. Donec tempor est id erat mattis, ac dignissim felis ultricies. Nullam ullamcorper augue tellus.', '2022-04-02 18:56:32', 2, 7, 'AsuperUser2'),
(39, 'This is another review', '2022-04-02 19:02:32', 2, 7, 'AsuperUser2'),
(40, 'This is a review for the monster truck', '2022-04-02 19:03:19', 4, 7, 'AsuperUser2'),
(41, 'This is another review', '2022-04-02 19:03:29', 4, 7, 'AsuperUser2'),
(42, 'Scooob!', '2022-04-02 19:04:12', 7, 7, 'AsuperUser2'),
(43, 'This car sucks', '2022-04-02 22:34:59', 2, 7, 'AsuperUser2'),
(44, 'This is a really new car', '2022-04-02 22:44:06', 2, 7, 'AsuperUser2'),
(45, 'My wife likes this car', '2022-04-02 23:21:26', 2, 7, 'AsuperUser2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
