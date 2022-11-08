-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 07:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `bookingID` int(11) NOT NULL COMMENT 'Booking Identification Number',
  `userID` int(11) NOT NULL COMMENT 'Applicant / Student Identification Number',
  `propertyID` int(11) NOT NULL COMMENT 'Property Identification Number',
  `landlordID` int(11) NOT NULL COMMENT 'LandlordID from Property Table',
  `bookingDate` date NOT NULL COMMENT 'Date of Booking',
  `startDate` date NOT NULL COMMENT 'Target Start Date',
  `duration` int(11) NOT NULL COMMENT 'Number of Months , 1< duration <12',
  `status` varchar(50) NOT NULL COMMENT 'Pending , Approved , Confirmed , Cancelled',
  `remarks` varchar(255) DEFAULT NULL COMMENT 'Queries , Suggestions , Request , Info'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`bookingID`, `userID`, `propertyID`, `landlordID`, `bookingDate`, `startDate`, `duration`, `status`, `remarks`) VALUES
(49, 120, 32, 17, '2022-07-17', '2022-08-26', 2, 'Confirmed', 'Holiday '),
(51, 120, 84, 20, '2022-07-18', '2022-09-02', 4, 'Confirmed', 'Holiday '),
(52, 120, 88, 20, '2022-07-21', '2022-07-21', 1, 'Confirmed', 'Test Plan'),
(53, 120, 87, 20, '2022-07-22', '2022-07-22', 2, 'Confirmed', ''),
(55, 143, 90, 20, '2022-07-25', '2022-07-30', 4, 'Approved', 'Pre Booking');

-- --------------------------------------------------------

--
-- Table structure for table `tbllandlord`
--

CREATE TABLE `tbllandlord` (
  `userID` int(11) NOT NULL COMMENT 'Landlord Identification Number',
  `username` varchar(25) NOT NULL COMMENT 'Foreign Key from tblusers',
  `type` varchar(25) NOT NULL COMMENT 'Company or Individual',
  `email` varchar(150) NOT NULL COMMENT 'Email Address',
  `phone` varchar(12) DEFAULT NULL COMMENT 'Home or Company phone Number',
  `mobile` varchar(14) NOT NULL COMMENT 'Mobile phone number of contact person',
  `bscAddress` text NOT NULL COMMENT 'Blockchain Address'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllandlord`
--

INSERT INTO `tbllandlord` (`userID`, `username`, `type`, `email`, `phone`, `mobile`, `bscAddress`) VALUES
(9, 'Togent', 'Individual', 'baileyreid@gustr.com', '1244617', '50831243', ''),
(10, 'Thaveleation', 'Individual', 'jessicamacdonald@teleworm.us', '2174329', '52174329', ''),
(11, 'Thersen1997', 'Company', 'LouieRose@dayrep.com', '4769264', '54769264', ''),
(12, 'Fortnock', 'Company', 'OliverPugh@rhyta.com', '4551583', '54551583', ''),
(13, 'Quirs2000', 'Individual', 'MelissaCurtis@armyspy.com', '4846512', '54846512', ''),
(14, 'Morlithe', 'Individual', 'MollieRiley@dayrep.com', '2533353', '52533353', ''),
(15, 'Wity1995', 'Individual', 'LouisArmstrong@armyspy.com', '2447826', '52447826', ''),
(16, 'Whispiever', 'Individual', 'EllaShah@gustr.com', '7906602', '57906602', ''),
(17, 'Frome1992', 'Individual', 'NaomiMills@teleworm.us', '4526398', '54526398', ''),
(18, 'Thapplicance', 'Company', 'MasonWatts@gustr.com', '3678255', '53678255', ''),
(20, 'biswajeet', 'Individual', 'gtramlochund@student.udm.ac.mu', '2632207', '57770700', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblproperty`
--

CREATE TABLE `tblproperty` (
  `propertyID` int(11) NOT NULL COMMENT 'Property Identification Number',
  `landlordID` int(11) NOT NULL COMMENT 'Landlord Identification Number',
  `type` varchar(150) NOT NULL COMMENT 'Type of Property: Apartment Room , Detached House , Part Of House',
  `rating` int(11) NOT NULL COMMENT 'Rating in range 1 to 5 (Highest)',
  `capacity` int(11) NOT NULL COMMENT 'Number of person to accommodate',
  `rentalFee` float NOT NULL COMMENT 'Monthly Rental Fee, Rs',
  `depositFee` float NOT NULL COMMENT 'Non-Refundable Deposit Amount Rs',
  `status` varchar(75) NOT NULL COMMENT 'Available , Maintenance , occupied , inactive',
  `area` int(11) NOT NULL COMMENT 'Size of Property in Square Meters ',
  `address` varchar(150) NOT NULL COMMENT 'Location of Property',
  `distance` int(11) NOT NULL COMMENT 'Distance from Nearest Campus',
  `wifi` tinyint(1) NOT NULL COMMENT 'YES / NO',
  `bathroom` tinyint(1) NOT NULL COMMENT 'YES / NO',
  `kitchen` tinyint(1) NOT NULL COMMENT 'YES / NO',
  `pictures` varchar(255) NOT NULL COMMENT 'One or More filenames of pictures of the property',
  `otherFacilities` varchar(150) DEFAULT NULL COMMENT 'TV , Pick-Up , Drop-off , Public Transport Facilities , Shopping Mall , Restaurant  , Neighborhood , Laundry , Cleaning  ',
  `approved` tinyint(1) NOT NULL COMMENT 'Approved by Administration',
  `bscAddress` text NOT NULL COMMENT 'Blockchain Address'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproperty`
--

INSERT INTO `tblproperty` (`propertyID`, `landlordID`, `type`, `rating`, `capacity`, `rentalFee`, `depositFee`, `status`, `area`, `address`, `distance`, `wifi`, `bathroom`, `kitchen`, `pictures`, `otherFacilities`, `approved`, `bscAddress`) VALUES
(32, 17, 'Apartment Room', 4, 3, 1200, 2000, 'Available', 10, 'Moka', 25, 1, 1, 1, '19.jpg', 'Balcony', 1, ''),
(33, 17, 'Detached House', 4, 3, 1500, 1800, 'Available', 15, 'Ebene', 21, 0, 1, 1, '2.jpg', 'IPTV on Demand', 1, ''),
(34, 17, 'Part of House', 3, 1, 800, 700, 'Available', 13, 'Quatre Bornes', 20, 1, 1, 0, 'h2.jpg', 'Washing Machine', 1, ''),
(35, 17, 'Shared Room', 5, 1, 600, 1225.2, 'Available', 9, 'Flacq', 18, 0, 1, 0, '20.jpg', 'Secure Parking', 1, ''),
(36, 17, 'Private Flat', 5, 4, 2500, 3000, 'Available', 25, 'Bagatelle', 19, 1, 1, 1, '6.jpg', 'Security Services', 1, ''),
(37, 16, 'Apartment Room', 5, 2, 1300, 2100, 'Available', 16, 'Triolet', 12, 1, 1, 0, 'apartmentRoom.jpg', 'Gym', 1, ''),
(38, 16, 'Detached House', 5, 2, 600, 2000, 'Available', 25, 'Calebasse', 5, 1, 1, 1, '10.jpg', 'TV', 1, ''),
(39, 16, 'Part of House', 4, 2, 450, 900, 'Available', 16, 'Depinay', 9, 0, 1, 0, '59.jpg', 'Laundry Services', 1, ''),
(40, 16, 'Shared Room', 4, 1, 600, 1300, 'Available', 19, 'Flacq', 10, 1, 1, 1, '60.jpg', 'Gym', 1, ''),
(41, 16, 'Private Flat', 5, 4, 2600, 5000, 'Available', 50, 'Belle Mare', 25, 1, 1, 1, '13.jpg', 'Secure Parking', 1, ''),
(42, 15, 'Apartment Room', 5, 1, 630, 2100, 'Available', 18, 'Flacq', 10, 0, 1, 0, '34.jpg', 'IPTV on Demand', 1, ''),
(43, 15, 'Detached House', 5, 2, 1300, 2700, 'Available', 21, 'Grand Baie', 19, 1, 1, 0, 'h7.jpg', 'Secure Parking', 1, ''),
(44, 15, 'Part of House', 5, 1, 920, 2300, 'Available', 23, 'Port Louis', 21, 1, 0, 1, 'apartmentRoom.jpg', 'Gym', 1, ''),
(45, 15, 'Private Flat', 5, 1, 1100, 2300, 'Available', 23, 'Belle Mare', 22, 0, 1, 0, 'h5.jpg', 'Washing Machine', 1, ''),
(46, 15, 'Private Flat', 5, 1, 2600, 5200, 'Available', 36, 'Triolet', 22, 0, 1, 0, '9.jpg', 'Security Services', 1, ''),
(47, 15, 'Part of House', 5, 3, 650, 2100, 'Available', 33, 'Calebasse', 22, 0, 1, 0, '32.jpg', 'Washing Machine', 1, ''),
(48, 14, 'Apartment Room', 5, 2, 100, 200, 'Available', 11, 'Ebene', 22, 0, 1, 0, '19.jpg', 'Gym', 1, ''),
(49, 14, 'Detached House', 5, 3, 800, 200, 'Available', 52, 'Terre Rouge', 18, 0, 1, 0, '52.jpg', 'Balcony', 1, ''),
(50, 14, 'Shared Room', 5, 1, 652, 1300, 'Available', 33, 'Triolet', 14, 0, 1, 0, '36.jpg', 'Gym', 1, ''),
(51, 14, 'Shared Room', 5, 1, 950, 1500, 'Available', 22, 'Triolet', 16, 0, 1, 0, '45.jpg', 'Washing Machine', 1, ''),
(52, 14, 'Shared Room', 5, 1, 698, 1800, 'Available', 23, 'Mont Choisy', 22, 0, 1, 0, '48.jpg', 'Security Services', 1, ''),
(53, 14, 'Shared Room', 5, 1, 365, 1300, 'Available', 26, 'Mont Choisy', 21, 0, 1, 0, '46.jpg', 'Secure Parking', 1, ''),
(54, 14, 'Shared Room', 5, 1, 789, 1300, 'Available', 33, 'Mont Choisy', 21, 0, 1, 0, '42.jpg', 'Security Services', 1, ''),
(55, 14, 'Shared Room', 5, 1, 654, 1698, 'Available', 32, 'Mont Choisy', 21, 0, 1, 0, '44.jpg', 'IPTV on Demand', 1, ''),
(56, 13, 'Private Flat', 5, 4, 1562, 3000, 'Available', 50, 'Ebene', 20, 1, 1, 1, '8.jpg', 'Parking', 1, ''),
(57, 13, 'Private Flat', 5, 4, 2560, 4201, 'Available', 45, 'Ebene', 19, 1, 1, 1, '18.jpg', 'Gym', 1, ''),
(58, 13, 'Private Flat', 5, 4, 1165, 3620, 'Available', 40, 'Ebene', 19, 1, 1, 1, '13.jpg', 'Balcony', 1, ''),
(59, 13, 'Private Flat', 5, 4, 1256, 3254, 'Available', 45, 'Ebene', 19, 1, 1, 1, '9.jpg', 'Gym', 1, ''),
(60, 13, 'Private Flat', 5, 4, 1265, 2304, 'Available', 56, 'Ebene', 19, 1, 1, 1, 'h6.jpg', 'Pool', 1, ''),
(61, 12, 'Shared Room', 5, 1, 652, 1100, 'Available', 25, 'Triolet', 12, 1, 1, 0, '33.jpg', 'Gym', 1, ''),
(62, 12, 'Shared Room', 5, 2, 965, 1500, 'Available', 25, 'Triolet', 16, 0, 1, 0, '41.jpg', 'Secure Parking', 1, ''),
(63, 12, 'Shared Room', 3, 2, 652, 1500, 'Available', 18, 'Calebasse', 5, 0, 1, 0, '54.jpg', 'Washing Machine', 1, ''),
(64, 12, 'Shared Room', 3, 1, 500, 1600, 'Available', 22, 'Flacq', 25, 0, 1, 0, '46.jpg', 'Washing Machine', 1, ''),
(65, 12, 'Shared Room', 4, 1, 1256, 2500, 'Available', 26, 'Flacq', 16, 0, 1, 0, '43.jpg', '', 1, ''),
(66, 12, 'Shared Room', 5, 1, 562, 1685, 'Available', 55, 'Calebasse', 5, 0, 1, 0, '37.jpg', 'Security Services', 1, ''),
(67, 12, 'Part of House', 5, 1, 562, 1200, 'Available', 25, 'Calebasse', 5, 1, 1, 0, '51.jpg', 'Shopping Mall', 1, ''),
(68, 12, 'Private Flat', 5, 4, 1562, 3600, 'Available', 25, 'Qua', 20, 0, 1, 0, '5.jpg', '', 1, ''),
(69, 18, 'Part of House', 5, 1, 652, 1155, 'Available', 11, 'Palmar', 12, 0, 1, 0, '56.jpg', '', 1, ''),
(70, 18, 'Apartment Room', 3, 1, 223, 1232, 'Available', 22, 'Belle Mare', 20, 1, 1, 0, '50.jpg', '', 1, ''),
(71, 18, 'Apartment Room', 5, 3, 654, 2524, 'Available', 20, 'Belle Mare', 12, 0, 1, 0, '53.jpg', 'Balcony', 1, ''),
(72, 18, 'Apartment Room', 3, 1, 321, 1235, 'Available', 20, 'Flacq', 19, 0, 1, 0, '58.jpg', '', 1, ''),
(73, 18, 'Part of House', 5, 1, 546, 1658, 'Available', 65, 'Triolet', 20, 0, 1, 0, '60.jpg', '', 1, ''),
(74, 11, 'Apartment Room', 3, 1, 1232, 2124, 'Available', 44, 'Calebasse', 2, 0, 1, 0, '56.jpg', 'Mall', 1, ''),
(75, 11, 'Apartment Room', 5, 1, 2145, 3000, 'Available', 22, 'Calebasse', 8, 0, 1, 0, '46.jpg', 'Pool', 1, ''),
(76, 11, 'Apartment Room', 3, 1, 1200, 2000, 'Available', 10, 'Ilot', 10, 0, 1, 0, '13.jpg', 'Pool', 1, ''),
(77, 11, 'Private Flat', 5, 1, 2103, 5000, 'Available', 25, 'Calebasse', 5, 1, 1, 1, '14.jpg', '', 1, ''),
(78, 11, 'Detached House', 3, 1, 657, 1600, 'Available', 25, 'Triolet', 11, 0, 1, 0, '38.jpg', 'Balcony', 1, ''),
(79, 9, 'Part of House', 5, 1, 1256, 3500, 'Available', 25, 'Mont Choisy', 12, 0, 1, 0, '46.jpg', 'Secure Parking', 1, ''),
(80, 9, 'Private Flat', 5, 1, 1560, 200, 'Available', 22, 'Mont Choisy', 10, 1, 1, 1, '8.jpg', 'Secure Parking', 1, ''),
(81, 9, 'Shared Room', 5, 1, 2651, 6500, 'Available', 55, 'Mont Choisy', 16, 0, 1, 0, '58.jpg', 'Washing Machine', 1, ''),
(82, 9, 'Private Flat', 5, 1, 1520, 3500, 'Available', 25, 'Mont Choisy', 12, 0, 1, 0, '56.jpg', 'Balcony', 1, ''),
(83, 9, 'Private Flat', 5, 1, 2156, 5400, 'Available', 20, 'Mont Choisy', 15, 0, 1, 0, '18.jpg', 'IPTV on Demand', 1, ''),
(84, 20, 'Detached House', 5, 2, 2500, 3000, 'Available', 50, 'Pamplemousses', 5, 0, 1, 0, '1.jpg', 'Shopping Mall', 1, ''),
(85, 20, 'Apartment Room', 5, 1, 1250, 1000, 'Available', 25, 'Port Louis', 10, 1, 1, 0, '21.jpg', 'Security Services', 0, ''),
(86, 20, 'Shared Room', 5, 1, 750, 1000, 'Available', 25, 'Riche Terre', 12, 0, 1, 0, '23.jpg', 'Washing Machine', 0, ''),
(87, 20, 'Part of House', 5, 2, 1256, 1200, 'Available', 30, 'Terre Rouge', 9, 0, 1, 0, '7.jpg', '', 1, ''),
(88, 20, 'Shared Room', 5, 1, 523, 1000, 'Available', 20, 'Terre Rouge', 8, 0, 1, 0, '25.jpg', '', 1, ''),
(90, 20, 'Private Flat', 5, 1, 1500, 2000, 'Available', 25, 'Mont Choisy', 6, 1, 1, 1, 'Private_Villa.jpg', 'Secure Parking', 1, 'qpx4tyjmnk70n4y4ukn0ud3fmfpzxj242u8chwxu'),
(91, 20, 'Apartment Room', 3, 1, 500, 1000, 'Available', 100, 'Calebasse', 5, 1, 0, 0, '35.jpg', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblrental`
--

CREATE TABLE `tblrental` (
  `rentalID` int(11) NOT NULL COMMENT 'Rental Identification Number',
  `tenantID` int(11) NOT NULL COMMENT 'Student Identification Number',
  `propertyID` int(11) NOT NULL COMMENT 'Property Identification Number',
  `landlordID` int(11) NOT NULL COMMENT 'Variable to be used to get all informations about rental by using landllordID',
  `bookingID` int(11) DEFAULT NULL COMMENT 'Booking Identification Number',
  `startDate` date NOT NULL COMMENT 'Start Date',
  `endDate` date NOT NULL COMMENT 'End Date',
  `status` varchar(50) NOT NULL COMMENT 'Current , Elapsed , Terminated',
  `remarks` varchar(75) DEFAULT NULL COMMENT 'Relevant Comments',
  `bscAddress` text NOT NULL COMMENT 'Tenant Blockchain Address',
  `cryptoPayment` text NOT NULL COMMENT 'Crypto Payment , completed ,pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrental`
--

INSERT INTO `tblrental` (`rentalID`, `tenantID`, `propertyID`, `landlordID`, `bookingID`, `startDate`, `endDate`, `status`, `remarks`, `bscAddress`, `cryptoPayment`) VALUES
(17, 120, 84, 20, 51, '2022-09-02', '2022-12-02', 'Terminated', 'Read and Approved By Nandani', 'qpx4tyjmnk70n4y4ukn0ud3fmfpzxj242u8chwxu', 'Completed'),
(18, 120, 88, 20, 52, '2022-07-21', '2022-08-21', 'Current', 'Read and Approved By NR', '', ''),
(19, 120, 87, 20, 53, '2022-07-22', '2022-09-22', 'Current', 'Read and Approved By NKR', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltenant`
--

CREATE TABLE `tbltenant` (
  `userID` int(11) NOT NULL COMMENT 'Student Identification Number',
  `username` varchar(25) NOT NULL COMMENT 'Foreign Key from tblusers',
  `gender` varchar(20) NOT NULL COMMENT 'Student Gender',
  `email` varchar(255) NOT NULL COMMENT 'Student Email Address',
  `mobile` varchar(10) NOT NULL COMMENT 'Student Mobile Number',
  `country` varchar(25) NOT NULL COMMENT 'Student Country',
  `nationality` varchar(25) NOT NULL COMMENT 'Student Nationality',
  `passportNo` varchar(25) NOT NULL COMMENT 'Student Passport Number or NID of Student',
  `address` varchar(75) DEFAULT NULL COMMENT 'Student residential Address',
  `course` varchar(250) NOT NULL COMMENT 'Programme in which student is enrolled',
  `dateOfEnrolment` date NOT NULL COMMENT 'Start date of Course',
  `remarks` varchar(125) DEFAULT NULL COMMENT 'Relevant remarks about student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltenant`
--

INSERT INTO `tbltenant` (`userID`, `username`, `gender`, `email`, `mobile`, `country`, `nationality`, `passportNo`, `address`, `course`, `dateOfEnrolment`, `remarks`) VALUES
(40, 'nandani', 'Female', 'nkramlochund@student.udm.ac.mu', '59206952', 'Mauritius', 'Mauritian', 'J221292460087F', 'Geranium Avenue , Grand Baie', 'BSc(Hons) Human Resource Management', '2021-05-14', 'Student ID: I19026'),
(41, 'Witocces', 'Female', 'IsabelDoherty@superrito.com', '52896301', 'Madagascar', 'Malgache', 'D9901242657187', 'Bezuidenhout St , Ermelo', 'BEng(Hons) Civil Engineering', '2021-08-04', ''),
(42, 'Chumake', 'Female', 'FrancescaCole@cuvox.de', '59452280', 'Cameroon', 'Cameroonian', 'F0107122351086', 'Oost St ,  Belfast', 'BEng(Hons) Electrical and Electronic Engineering', '2021-03-26', ''),
(43, 'Easpost', 'Male', 'MuhammadRose@superrito.com', '59687815', 'Congo DRC', 'Congonian', 'R9405195784089', 'Tait St , Letlhabile', 'BSc(Hons) Electrical Engineering and Automation', '2021-02-20', ''),
(44, 'Semorger1996', 'Male', 'PatrickWells@jourrapide.com', '51831325', 'Burundi', 'Burudian', 'M9603205321088', 'Schoeman St , Pretoru', 'BSc(Hons) Electromechanical Engineering', '2021-04-13', ''),
(45, 'Behen1995', 'Female', 'AnnaPerkins@superrito.com', '52789312', 'Rwanda', 'Ruwandais', 'P9505263877085', 'Kamp St , Cape', 'BSc(Hons) Electrotechnics and Renewable Energy', '2021-03-31', ''),
(46, 'Widee1989', 'Female', 'DemiOBrien@fleckens.hu', '59859993', 'Ivory Coast', 'Ivorian', 'O8912042164085', 'Port Elizabeth ,  Eastern Cape', 'BSc(Hons) Facilities Management of Hotels and Real Estates', '2021-06-11', ''),
(47, 'Advaltepi', 'Male', 'KianBartlett@cuvox.de', '56855481', 'Rodrigues', 'Rodrigan', 'B0305276492181', 'Oost St , Middelburg', 'Diploma in Civil Engineering', '2021-01-29', ''),
(48, 'Hiout2003', 'Male', 'MaxThorpe@superrito.com', '56534220', 'Madagascar', 'Malgache', 'T0305276492181', 'Wolmarans St , Witbank', 'BSc(Hons) Accounting and Finance', '2021-05-12', ''),
(49, 'Pritterpron', 'Male', 'MaxHutchinson@superrito.com', '53996001', 'Mauritius', 'Mauritian', 'H8709145675086', 'Brand St , Rouxville', 'BSc(Hons) Banking and Financial Services', '2021-03-25', ''),
(50, 'Oblett', 'Female', 'ShannonWood@cuvox.de', '51453205', 'Cameroon', 'Cameroonian', 'S9201261711183', 'Dorp St , Cape Town', 'BEng(Hons) Civil Engineering', '2021-03-22', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userID` int(11) NOT NULL COMMENT 'User''s Identification Number',
  `surname` varchar(75) NOT NULL COMMENT 'User Surname',
  `name` varchar(75) NOT NULL COMMENT 'User Name',
  `category` varchar(25) NOT NULL COMMENT 'Applicant , Student , Administrator',
  `username` varchar(25) NOT NULL COMMENT 'Unique Password for User',
  `password` varchar(25) NOT NULL COMMENT 'Strong Password'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userID`, `surname`, `name`, `category`, `username`, `password`) VALUES
(49, 'Ramlochund', 'Gitendrajeet', 'Administrator', 'admin', 'Admin123'),
(120, 'Ramlochund', 'Nandani', 'Tenant', 'nandani', 'Nandani2212'),
(121, 'Bailey', 'Reid', 'Landlord', 'Togent', 'foy0Ei43'),
(122, 'Jessica', 'Macdonald', 'Landlord', 'Thaveleation', 'oko3weCh4ph'),
(123, 'Doherty', 'Isabel', 'Tenant', 'Witocces', 'waewoh8AiR'),
(124, 'Cole', 'Francesca', 'Tenant', 'Chumake', 'oomooc9Zee'),
(125, 'Rose', 'Muhammad', 'Tenant', 'Easpost', 'eMu7Eeh3A'),
(126, 'Wells', 'Patrick', 'Tenant', 'Semorger1996', 'sa6Tiech4'),
(127, 'Perkins', 'Anna', 'Tenant', 'Behen1995', 'reew6Vohf'),
(128, 'Obrien', 'Demi', 'Tenant', 'Widee1989', 'Fai9badeip0'),
(129, 'Bartlett', 'Kian', 'Tenant', 'Advaltepi', 'Ub0wae3ae'),
(130, 'Thorpe', 'Max', 'Tenant', 'Hiout2003', 'Ta3aingoo'),
(131, 'Rose', 'Louise', 'Landlord', 'Thersen1997', 'OhPhi3eibee'),
(132, 'Hutchinson', 'Max', 'Tenant', 'Pritterpron', 'fais2iTh2'),
(133, 'Wood', 'Shannon', 'Tenant', 'Oblett', 'Eingo0eig8Iey'),
(134, 'Burton', 'Issac', 'Student', 'Lentreg96', 'ieWiugh1ii'),
(135, 'Hope', 'Connor', 'Student', 'Forintolue', 'iedaiSh2t'),
(136, 'Sanderson', 'Tyler', 'Student', 'Rearclume', 'Airach1Ee'),
(137, 'Lord', 'Benjamin', 'Student', 'Frund2002', 'YaC1ohyoot'),
(138, 'Hudson', 'Lily', 'Student', 'Conelays', 'OhN5eemu'),
(139, 'Hall', 'Daisy', 'Student', 'Andraideve1999', 'dohH2iegah6'),
(140, 'Arnold', 'Jayden', 'Student', 'Sonsiziefall', 'ohquoa2G'),
(141, 'Weston', 'Isabel', 'Student', 'Orproclen', 'Sheiquoh0'),
(142, 'Nicholls', 'Jack', 'Student', 'Pesellai', 'maQu3iv1'),
(143, 'Wilkins', 'Luca', 'Student', 'Fortudieved', 'Mei0eihaang'),
(144, 'Pugh', 'Oliver', 'Landlord', 'Fortnock', 'alaij9Zu'),
(145, 'Curtis', 'Melissa', 'Landlord', 'Quirs2000', 'yaeCh0juhiGh'),
(146, 'Riley', 'Mollie', 'Landlord', 'Morlithe', 'zie7fiThe'),
(147, 'Armstrong', 'Louis', 'Landlord', 'Wity1995', 'Tiav7sir'),
(148, 'Shah', 'Ela', 'Landlord', 'Whispiever', 'rahleiGh8ree'),
(149, 'Mills', 'Naomi', 'Landlord', 'Frome1992', 'Quoo9ahj'),
(150, 'Watts', 'Mason', 'Landlord', 'Thapplicance', 'Eyei5aevah'),
(151, 'Ramlochund', 'Shaivi', 'Student', 'shaivi', 'Shaivi241117'),
(153, 'Ramlochund', 'Biswajeet', 'Landlord', 'biswajeet', 'Biswajeet1605');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `FK_Users` (`userID`);

--
-- Indexes for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `FK_Username` (`username`);

--
-- Indexes for table `tblproperty`
--
ALTER TABLE `tblproperty`
  ADD PRIMARY KEY (`propertyID`),
  ADD KEY `tbllandlord_FK` (`landlordID`);

--
-- Indexes for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD PRIMARY KEY (`rentalID`),
  ADD KEY `FK_Property` (`propertyID`);

--
-- Indexes for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `tblusers_FK` (`username`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Booking Identification Number', AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Landlord Identification Number', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblproperty`
--
ALTER TABLE `tblproperty`
  MODIFY `propertyID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Property Identification Number', AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tblrental`
--
ALTER TABLE `tblrental`
  MODIFY `rentalID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Rental Identification Number', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbltenant`
--
ALTER TABLE `tbltenant`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Student Identification Number', AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s Identification Number', AUTO_INCREMENT=154;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD CONSTRAINT `FK_Users` FOREIGN KEY (`userID`) REFERENCES `tblusers` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  ADD CONSTRAINT `FK_Username` FOREIGN KEY (`username`) REFERENCES `tblusers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblproperty`
--
ALTER TABLE `tblproperty`
  ADD CONSTRAINT `tbllandlord_FK` FOREIGN KEY (`landlordID`) REFERENCES `tbllandlord` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD CONSTRAINT `FK_Property` FOREIGN KEY (`propertyID`) REFERENCES `tblproperty` (`propertyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD CONSTRAINT `tblusers_FK` FOREIGN KEY (`username`) REFERENCES `tblusers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
