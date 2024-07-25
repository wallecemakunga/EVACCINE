-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 08:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `Full_Name`, `role`, `password`) VALUES
(100, 'Fatuma omary', 'admin', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `clinic_id` int(100) NOT NULL,
  `doctor_id` varchar(100) NOT NULL,
  `date_of_appointment` date NOT NULL,
  `service` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(5) NOT NULL,
  `countryid` int(5) DEFAULT NULL,
  `stateid` int(5) DEFAULT NULL,
  `cityname` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `countryid`, `stateid`, `cityname`) VALUES
(1, 1, 100, 'Moshono'),
(2, 1, 100, 'Majengo'),
(3, 1, 100, 'Sakina'),
(4, 1, 101, 'Tengeru'),
(5, 1, 101, 'Usa_river'),
(6, 1, 101, 'meru'),
(7, 1, 101, 'Nanja'),
(8, 2, 103, 'Majengo'),
(9, 2, 103, 'kcmc'),
(10, 2, 103, 'Uzunguni'),
(11, 2, 104, 'O'),
(12, 2, 104, 'Scholastica'),
(13, 2, 104, 'Mizani'),
(14, 2, 105, 'J'),
(15, 2, 105, 'N'),
(16, 2, 105, 'L'),
(17, 4, 108, 'Kariakoo'),
(18, 4, 108, 'Upanga'),
(19, 4, 108, 'Tabata'),
(20, 4, 109, 'Kigamboni'),
(21, 4, 109, 'Mbagala'),
(22, 5, 110, 'Kikuyu'),
(23, 5, 110, 'Majengo'),
(24, 5, 111, 'Chamwino Ikulu'),
(25, 5, 111, 'Chamwino Mvumi');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `clinic_id` int(100) NOT NULL,
  `clinic_name` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`clinic_id`, `clinic_name`, `region`, `district`, `ward`, `phone_number`, `address`, `email`) VALUES
(9, 'dodoma', '2', '103', ' Majengo', 767985521, 'p.o box,12,,uso', 'dodoma@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(5) NOT NULL,
  `countryname` varchar(250) DEFAULT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `countryname`, `creationdate`) VALUES
(1, 'Arusha', '2023-09-29 05:58:45'),
(2, 'Kilimanjaro', '2023-09-29 05:58:45'),
(3, 'Morogoro', '2023-09-29 05:58:45'),
(4, 'Dar es salaam', '2024-06-18 13:01:34'),
(5, 'dodoma', '2024-06-18 13:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` varchar(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `dob` date NOT NULL,
  `passport` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `clinic_id` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_suffix` int(100) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'Doctor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_id` varchar(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `Phone_number` int(15) NOT NULL,
  `clinic_id` int(100) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `id_suffix` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Nurse',
  `date_added` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` varchar(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Phone_number` int(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_suffix` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `Full_Name`, `dob`, `Gender`, `Phone_number`, `password`, `id_suffix`) VALUES
('F-19970603-2', 'Fatuma Lugulu', '1997-06-03', 'Female', 787021422, '150cc73c4e185f37b734144b0db1f791', 2);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StCode` int(11) NOT NULL,
  `countryid` int(5) DEFAULT NULL,
  `StateName` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StCode`, `countryid`, `StateName`) VALUES
(100, 1, 'Arusha Mjini'),
(101, 1, 'Arumeru'),
(103, 2, 'Moshi Mjini'),
(104, 2, 'Himo'),
(105, 2, 'Marangu'),
(106, 3, 'Mvomero'),
(107, 3, 'Morogoro'),
(108, 4, 'ilala'),
(109, 4, 'Temeke'),
(110, 5, 'Dodoma Mjini'),
(111, 5, 'chamwino');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vaccination_id` int(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `child_name` varchar(100) NOT NULL,
  `child_gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `Dose_number` int(15) NOT NULL,
  `vaccination_Date` date NOT NULL,
  `Next_vaccine` date NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_added` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`clinic_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`nurse_id`),
  ADD UNIQUE KEY `Phone_number` (`Phone_number`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StCode`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `clinic_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vaccination_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`);

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
