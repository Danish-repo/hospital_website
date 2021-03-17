-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 02:12 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-hospital-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `patient_name` varchar(128) NOT NULL,
  `admission` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id_patient`, `patient_name`, `admission`, `description`, `created`, `modified`) VALUES
(101, 'Umar Bin Hasan', '2021-2-20', 'High fever', '2015-08-02 12:04:03', '2021-03-14 03:36:04'),
(102, 'Dijjah Binti Rahimah', '2021-2-21', 'High fever', '2015-08-02 12:14:29', '2021-03-14 03:36:14'),
(103, 'Shahirah Binti Zul', '2021-2-22', 'Stomach ache', '2015-08-02 12:15:04', '2021-03-14 03:36:16'),
(104, 'Arif Bin Amir', '2021-2-23', 'Diarhea', '2015-08-02 12:18:21', '2021-03-14 03:36:18'),
(105, 'Zamri Bin Abas', '27-2-2021', 'High fever', '0000-00-00 00:00:00', '2021-03-14 03:36:20'),
(106, 'Amin Bin Umar', '2021-2-25', 'Severe dry eyes', '0000-00-00 00:00:00', '2021-03-14 03:36:21'),
(107, 'junaidi binti sams', '28-2-2021', 'Heart Attack', '0000-00-00 00:00:00', '2021-03-14 03:36:24'),
(109, 'Amar', '1-3-2021', 'High fever', '0000-00-00 00:00:00', '2021-03-14 03:36:25'),
(110, 'Amiruddin', '2-3-2021', 'Stomache', '0000-00-00 00:00:00', '2021-03-14 03:36:27'),
(111, 'Najihah', '4-3-2021', 'High fever', '0000-00-00 00:00:00', '2021-03-14 03:36:28'),
(112, 'Amirah', '5-3-2021', 'Diarhea', '0000-00-00 00:00:00', '2021-03-14 03:36:30'),
(113, ' Danish Bin Azam', '19-2-2021', 'fever!', '2021-03-14 13:16:16', '2021-03-14 12:16:16'),
(114, 'Azam jais bin amar', '20-2-2021', 'stomache', '2021-03-14 13:17:41', '2021-03-14 12:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `staff_hospital`
--

CREATE TABLE `staff_hospital` (
  `id_staff` int(30) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(128) NOT NULL,
  `department` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_hospital`
--

INSERT INTO `staff_hospital` (`id_staff`, `fullname`, `username`, `password`, `department`, `created`, `modified`) VALUES
(1001, 'ishak bin abu samad', 'ishak@ICT', 'abc123', 'ICT', '0000-00-00 00:00:00', '2021-03-14 04:51:35'),
(1002, 'Abdillah binti Nor', 'Abdillah@ICT', 'abc123', 'ICT', '0000-00-00 00:00:00', '2021-03-14 04:51:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Indexes for table `staff_hospital`
--
ALTER TABLE `staff_hospital`
  ADD PRIMARY KEY (`id_staff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `staff_hospital`
--
ALTER TABLE `staff_hospital`
  MODIFY `id_staff` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
