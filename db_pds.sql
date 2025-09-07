-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 12:07 PM
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
-- Database: `db_pds`
--

-- --------------------------------------------------------

--
-- Table structure for table `pds_cschildren`
--

CREATE TABLE `pds_cschildren` (
  `CSID` int(11) DEFAULT NULL,
  `children_name` varchar(255) DEFAULT NULL,
  `children_dateofbirth` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pds_educ`
--

CREATE TABLE `pds_educ` (
  `CSID` int(11) DEFAULT NULL,
  `elem_name` varchar(255) DEFAULT NULL,
  `elem_course` varchar(255) DEFAULT NULL,
  `elem_start` date DEFAULT NULL,
  `elem_end` date DEFAULT NULL,
  `elem_highestlevel` varchar(255) DEFAULT NULL,
  `elem_yrgrad` date DEFAULT NULL,
  `elem_honor` varchar(255) DEFAULT NULL,
  `secondary_name` varchar(255) DEFAULT NULL,
  `secondary_course` varchar(255) DEFAULT NULL,
  `secondary_start` date DEFAULT NULL,
  `secondary_end` date DEFAULT NULL,
  `secondary_highestlevel` varchar(255) DEFAULT NULL,
  `secondary_yrgrad` date DEFAULT NULL,
  `secondary_honor` varchar(255) DEFAULT NULL,
  `vocational_name` varchar(255) DEFAULT NULL,
  `vocational_course` varchar(255) DEFAULT NULL,
  `vocational_start` date DEFAULT NULL,
  `vocational_end` date DEFAULT NULL,
  `vocational_highestlevel` varchar(255) DEFAULT NULL,
  `vocational_yrgrad` date DEFAULT NULL,
  `vocational_honor` varchar(255) DEFAULT NULL,
  `college_name` varchar(255) DEFAULT NULL,
  `college_course` varchar(255) DEFAULT NULL,
  `college_start` date DEFAULT NULL,
  `college_end` date DEFAULT NULL,
  `college_highestlevel` varchar(255) DEFAULT NULL,
  `college_yrgrad` date DEFAULT NULL,
  `college_honor` varchar(255) DEFAULT NULL,
  `grad_name` varchar(255) DEFAULT NULL,
  `grad_course` varchar(255) DEFAULT NULL,
  `grad_start` date DEFAULT NULL,
  `grad_end` date DEFAULT NULL,
  `grad_highestlevel` varchar(255) DEFAULT NULL,
  `grad_yrgrad` date DEFAULT NULL,
  `grad_honor` varchar(255) DEFAULT NULL,
  `cs_sig` varchar(255) DEFAULT NULL,
  `cs_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pds_familybackground`
--

CREATE TABLE `pds_familybackground` (
  `CSID` int(11) DEFAULT NULL,
  `spouse_surname` varchar(255) DEFAULT NULL,
  `spouse_firstname` varchar(255) DEFAULT NULL,
  `spouse_middlename` varchar(255) DEFAULT NULL,
  `spouse_nameext` varchar(255) DEFAULT NULL,
  `spouse_occupation` varchar(255) DEFAULT NULL,
  `spouse_employer` varchar(255) DEFAULT NULL,
  `spouse_businessadd` varchar(255) DEFAULT NULL,
  `spouse_telno` varchar(255) DEFAULT NULL,
  `father_surname` varchar(255) DEFAULT NULL,
  `father_firstname` varchar(255) DEFAULT NULL,
  `father_middlename` varchar(255) DEFAULT NULL,
  `father_nameext` varchar(255) DEFAULT NULL,
  `mother_surname` varchar(255) DEFAULT NULL,
  `mother_firstname` varchar(255) DEFAULT NULL,
  `mother_middlename` varchar(255) DEFAULT NULL,
  `mother_nameext` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pds_personalinfo`
--

CREATE TABLE `pds_personalinfo` (
  `CSID` int(11) NOT NULL,
  `cs_surname` varchar(255) DEFAULT NULL,
  `cs_firstname` varchar(255) DEFAULT NULL,
  `cs_middlename` varchar(255) DEFAULT NULL,
  `cs_nameext` varchar(255) DEFAULT NULL,
  `cs_dateofbirth` date DEFAULT NULL,
  `cs_placeofbirth` varchar(255) DEFAULT NULL,
  `cs_sex` varchar(255) DEFAULT NULL,
  `cs_civilstatus` varchar(255) DEFAULT NULL,
  `cs_height` int(11) DEFAULT NULL,
  `cs_weight` int(11) DEFAULT NULL,
  `cs_bloodtype` varchar(255) DEFAULT NULL,
  `cs_gsis` varchar(255) DEFAULT NULL,
  `cs_pagibig` varchar(255) DEFAULT NULL,
  `cs_philhealth` varchar(255) DEFAULT NULL,
  `cs_sss` varchar(255) DEFAULT NULL,
  `cs_tin` varchar(255) DEFAULT NULL,
  `cs_agencyempno` varchar(255) DEFAULT NULL,
  `cs_citizenship` varchar(255) DEFAULT NULL,
  `cs_dualcitizenship` varchar(255) DEFAULT NULL,
  `cs_res_house` varchar(255) DEFAULT NULL,
  `cs_res_street` varchar(255) DEFAULT NULL,
  `cs_res_subdi` varchar(255) DEFAULT NULL,
  `cs_res_barangay` varchar(255) DEFAULT NULL,
  `cs_res_city` varchar(255) DEFAULT NULL,
  `cs_res_province` varchar(255) DEFAULT NULL,
  `cs_res_zipcode` int(11) DEFAULT NULL,
  `cs_per_house` varchar(255) DEFAULT NULL,
  `cs_per_street` varchar(255) DEFAULT NULL,
  `cs_per_subdi` varchar(255) DEFAULT NULL,
  `cs_per_barangay` varchar(255) DEFAULT NULL,
  `cs_per_city` varchar(255) DEFAULT NULL,
  `cs_per_province` varchar(255) DEFAULT NULL,
  `cs_per_zipcode` int(11) DEFAULT NULL,
  `cs_per_telno` varchar(255) DEFAULT NULL,
  `cs_per_mobileno` varchar(255) DEFAULT NULL,
  `cs_per_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pds_personalinfo`
--
ALTER TABLE `pds_personalinfo`
  ADD PRIMARY KEY (`CSID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
