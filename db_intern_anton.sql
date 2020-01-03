-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 09:20 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_intern_anton`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `adminID` int(11) NOT NULL,
  `loginID` int(11) DEFAULT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `telePhone` varchar(255) DEFAULT NULL,
  `avataR` varchar(255) DEFAULT NULL,
  `deptID` varchar(11) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`adminID`, `loginID`, `emaiL`, `fullName`, `telePhone`, `avataR`, `deptID`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(11001, 11001, 'root@mail.gg', 'Anton Purnama', '082118115288', NULL, 'MDT-001', '11001', '2019-11-27 16:26:46', NULL, NULL),
(22001, 22001, 'masantonpurnama@gmail.com', 'Naruto Uzumaki', '01019299291', NULL, 'MDT-002', '11001', '2019-07-16 10:42:27', NULL, NULL),
(22002, 22002, 'minato@gmail.com', 'Minato Hokage', '11223344112', NULL, 'MDT-003', '11001', '2019-11-27 15:00:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_admin_campus`
--

CREATE TABLE `t_admin_campus` (
  `adminCampusID` int(11) NOT NULL,
  `loginID` int(11) DEFAULT NULL,
  `universityID` varchar(11) DEFAULT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `telePhone` varchar(22) DEFAULT NULL,
  `avataR` varchar(55) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin_campus`
--

INSERT INTO `t_admin_campus` (`adminCampusID`, `loginID`, `universityID`, `emaiL`, `fullName`, `telePhone`, `avataR`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(33001, 33001, 'MUV-001', 'antonpurnama9878@gmail.com', 'Anton Purnama', '081929291911', NULL, '11001', '2019-11-27 14:30:47', NULL, NULL),
(33002, 33002, 'MUV-002', 'ridho@gmail.com', 'Ridho Lilahitaala', '082188292919', NULL, '11001', '2019-11-27 14:13:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `categoryID` varchar(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_category`
--

INSERT INTO `t_category` (`categoryID`, `categoryName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('CAT-001', 'Software', '22001', '2019-07-16 11:13:09', NULL, NULL),
('CAT-002', 'Hardware', '22001', '2019-07-16 11:13:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_company`
--

CREATE TABLE `t_company` (
  `companyID` varchar(11) NOT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_company`
--

INSERT INTO `t_company` (`companyID`, `companyName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('CP-001', 'PT. Indah Sejahtera', '11001', '2019-10-14 08:27:24', NULL, NULL),
('CP-002', 'PT. Andromedia', '11001', '2019-10-11 13:03:47', NULL, NULL),
('CP-003', 'Bima Sakti Corporation Ltd', '11001', '2019-10-11 13:04:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_company_profile`
--

CREATE TABLE `t_company_profile` (
  `companyProfileID` varchar(22) NOT NULL,
  `companyID` varchar(11) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `sectorCompany` varchar(255) DEFAULT NULL,
  `CompanyDirector` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `CompanyAddress` text DEFAULT NULL,
  `FoundedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_company_profile`
--

INSERT INTO `t_company_profile` (`companyProfileID`, `companyID`, `companyName`, `sectorCompany`, `CompanyDirector`, `EmailAddress`, `CompanyAddress`, `FoundedDate`) VALUES
('ID-CP-001-01', 'CP-001', 'PT. Indah Sejahtera', 'Perdagangan', 'Indah Kartika S.Mn', 'indah-sejahtera@ins.co.id', 'Jakarta Barat', '1995-02-10'),
('ID-CP-002-01', 'CP-002', 'PT. Andromedia', 'Industri', 'Ucok Hidayat M.M.dst', 'andro-media@andromedia.cp.id', 'Sukabumi, Jawa Barat', '1995-10-11'),
('ID-CP-003-01', 'CP-003', 'Bima Sakti Corporation Ltd', 'Ekstraktif', 'Bima Suprapto M.M. kom', 'bima-sakti@bsc.com', 'Bandung, Jawa Barat', '1994-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `t_company_sector`
--

CREATE TABLE `t_company_sector` (
  `sectorID` int(11) NOT NULL,
  `sectorCompany` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_company_sector`
--

INSERT INTO `t_company_sector` (`sectorID`, `sectorCompany`) VALUES
(1, 'Ekstraktif'),
(2, 'Industri'),
(3, 'Agraris'),
(4, 'Perdagangan'),
(5, 'Telekomunikasi');

-- --------------------------------------------------------

--
-- Table structure for table `t_comunity`
--

CREATE TABLE `t_comunity` (
  `comunityID` varchar(11) NOT NULL,
  `comunityName` varchar(11) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_comunity`
--

INSERT INTO `t_comunity` (`comunityID`, `comunityName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('CM-001', 'Komunitas L', '11001', '2019-10-14 04:52:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_comunity_profile`
--

CREATE TABLE `t_comunity_profile` (
  `comunityProfileID` varchar(22) NOT NULL,
  `comunityID` varchar(11) DEFAULT NULL,
  `comunityName` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `typeComunity` varchar(255) DEFAULT NULL,
  `WebsiteAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_comunity_profile`
--

INSERT INTO `t_comunity_profile` (`comunityProfileID`, `comunityID`, `comunityName`, `EmailAddress`, `typeComunity`, `WebsiteAddress`) VALUES
('ID-CM-001-01', 'CM-001', 'Komunitas Linux', 'kamilinux@kamilinux.com', 'Information & Technology', 'kamilinux.forum.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_comunity_type`
--

CREATE TABLE `t_comunity_type` (
  `typeID` int(11) NOT NULL,
  `typeComunity` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_comunity_type`
--

INSERT INTO `t_comunity_type` (`typeID`, `typeComunity`) VALUES
(1, 'Blogger'),
(2, 'Petani/Peternak'),
(3, 'Seni'),
(4, 'Photography'),
(5, 'Operation System'),
(6, 'Information & Technology');

-- --------------------------------------------------------

--
-- Table structure for table `t_department`
--

CREATE TABLE `t_department` (
  `deptID` varchar(11) NOT NULL,
  `deptName` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_department`
--

INSERT INTO `t_department` (`deptID`, `deptName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('MDT-001', 'Departemen HC (Human Capability)', '11001', '2019-07-16 10:30:56', NULL, NULL),
('MDT-002', 'Department CST', '11001', '2019-07-16 10:31:07', NULL, NULL),
('MDT-003', 'Department HCD', '11001', '2019-07-16 10:31:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_dosen`
--

CREATE TABLE `t_dosen` (
  `dosenID` int(11) NOT NULL,
  `loginID` int(11) DEFAULT NULL,
  `universityID` varchar(11) DEFAULT NULL,
  `facultyID` varchar(11) DEFAULT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `dosenNumber` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `fixedPhone` varchar(20) DEFAULT NULL,
  `mobilePhone` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_faculty`
--

CREATE TABLE `t_faculty` (
  `facultyID` varchar(11) NOT NULL,
  `facultyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_faculty`
--

INSERT INTO `t_faculty` (`facultyID`, `facultyName`) VALUES
('FAC-01', 'Ekonomi'),
('FAC-02', 'Teknik'),
('FAC-03', 'Multimedia'),
('FAC-04', 'Jaringan'),
('FAC-05', 'UI Design'),
('FAC-06', 'Design Graphic');

-- --------------------------------------------------------

--
-- Table structure for table `t_login`
--

CREATE TABLE `t_login` (
  `loginID` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `passworD` varchar(255) DEFAULT NULL,
  `avataR` varchar(255) DEFAULT NULL,
  `statuS` varchar(55) DEFAULT NULL,
  `createdTime` datetime DEFAULT NULL,
  `lastLog` datetime DEFAULT NULL,
  `cookie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_login`
--

INSERT INTO `t_login` (`loginID`, `roleID`, `emaiL`, `passworD`, `avataR`, `statuS`, `createdTime`, `lastLog`, `cookie`) VALUES
(11001, 11, 'root@mail.gg', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-06-15 00:00:00', '2019-12-06 15:56:09', NULL),
(22001, 22, 'masantonpurnama@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-16 10:42:27', '2019-11-28 17:31:52', NULL),
(22002, 22, 'minato@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-30 10:37:28', '2019-11-04 14:58:55', NULL),
(33001, 33, 'antonpurnama9878@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-16 10:44:16', '2019-11-04 14:54:14', NULL),
(33002, 33, 'ridho@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-18 14:13:15', '2019-07-23 15:16:02', NULL),
(550001, 55, 'apurnama075@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-11-29 10:27:15', '2019-11-29 11:07:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_log_activity`
--

CREATE TABLE `t_log_activity` (
  `logID` int(11) NOT NULL,
  `logUsrID` int(11) DEFAULT NULL,
  `logTime` datetime DEFAULT NULL,
  `logTypeID` varchar(11) DEFAULT NULL,
  `logDesc` text DEFAULT NULL,
  `logBrowser` varchar(255) DEFAULT NULL,
  `logIP` varchar(20) DEFAULT NULL,
  `logPlatform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_log_activity`
--

INSERT INTO `t_log_activity` (`logID`, `logUsrID`, `logTime`, `logTypeID`, `logDesc`, `logBrowser`, `logIP`, `logPlatform`) VALUES
(836, 11001, '2019-11-27 11:41:45', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(837, 11001, '2019-11-27 14:10:44', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(838, 11001, '2019-11-27 14:13:01', 'TYP-04', 'Edit Admin Campus Account ( ridho@gmail.com )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(839, 11001, '2019-11-27 14:13:22', 'TYP-04', 'Edit Admin Campus Account ( ridho@gmail.com )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(840, 11001, '2019-11-27 14:30:08', 'TYP-04', 'Edit Admin Campus Account ( antonpurnama9878@gmail.com )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(841, 11001, '2019-11-27 14:30:48', 'TYP-04', 'Edit Admin Campus Account ( antonpurnama9878@gmail.com )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(842, 11001, '2019-11-27 15:00:59', 'TYP-04', 'Edit Admin Department Account ( minato@gmail.com )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(843, 11001, '2019-11-27 15:01:44', 'TYP-04', 'Edit Profile', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(844, 11001, '2019-11-27 16:26:46', 'TYP-04', 'Edit Profile', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(845, NULL, '2019-11-27 16:54:28', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(846, 11001, '2019-11-27 16:54:34', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(847, 11001, '2019-11-27 17:01:45', 'TYP-03', 'Add New Project ( tes )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(848, 11001, '2019-11-27 17:02:08', 'TYP-04', 'Edit Project ( tes )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(849, 11001, '2019-11-27 17:02:20', 'TYP-05', 'Delete Project ( tes )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(850, 11001, '2019-11-27 17:10:20', 'TYP-04', 'Edit Project ( E-Learning Intranet System )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(851, 11001, '2019-11-27 17:10:40', 'TYP-04', 'Edit Project ( Internship Web Portal )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(852, 11001, '2019-11-27 17:10:51', 'TYP-04', 'Edit Project ( Cloud Computing )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(853, 11001, '2019-11-27 17:32:35', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(854, 11001, '2019-11-28 10:10:52', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(855, 11001, '2019-11-28 10:56:00', 'TYP-03', 'Add New Project Scope ( tesssssssss )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(856, 11001, '2019-11-28 14:20:06', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(857, 11001, '2019-11-28 16:12:36', 'TYP-03', 'Add New Faculty ( UI Design )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(858, 11001, '2019-11-28 17:29:05', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(859, 22001, '2019-11-28 17:29:16', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(860, 22001, '2019-11-28 17:31:38', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(861, 22001, '2019-11-28 17:31:52', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(862, 22001, '2019-11-28 17:34:21', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(863, 11001, '2019-11-28 17:44:12', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(864, 11001, '2019-11-28 17:45:08', 'TYP-03', 'Add New University ( Bina Nusantara )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(865, 11001, '2019-11-28 17:45:43', 'TYP-03', 'Add New Faculty ( Design Graphic )', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(866, 11001, '2019-11-29 09:58:17', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(867, 11001, '2019-11-29 10:19:23', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(868, 11001, '2019-11-29 10:19:34', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(869, 11001, '2019-11-29 10:21:56', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(870, NULL, '2019-11-29 10:27:15', 'TYP-15', 'New application mahasiswa apurnama075@gmail.com', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(871, 11001, '2019-11-29 10:27:29', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(872, 11001, '2019-11-29 11:00:58', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(873, 550001, '2019-11-29 11:07:12', 'TYP-08', 'Success reset password ', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(874, 550001, '2019-11-29 11:16:35', 'TYP-04', 'Edit Profile', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(875, 550001, '2019-11-29 11:17:54', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(876, 11001, '2019-11-29 11:19:59', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(877, 11001, '2019-11-29 11:22:29', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(878, 11001, '2019-12-02 10:36:11', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(879, 11001, '2019-12-02 10:36:12', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(880, 11001, '2019-12-02 13:00:08', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(881, 11001, '2019-12-04 14:58:06', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(882, 11001, '2019-12-04 14:59:00', 'TYP-02', 'Logout Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(883, 11001, '2019-12-06 15:56:09', 'TYP-01', 'Login Application', 'Chrome 78.0.3904.108', '::1', 'Windows 8.1'),
(884, 11001, '2019-12-23 04:26:13', 'TYP-05', 'Delete University (  )', 'Chrome 79.0.3945.88', '::1', 'Windows 8.1'),
(885, 11001, '2019-12-23 04:29:58', 'TYP-03', 'Add New University ( Bina Nusantara )', 'Chrome 79.0.3945.88', '::1', 'Windows 8.1');

-- --------------------------------------------------------

--
-- Table structure for table `t_log_type`
--

CREATE TABLE `t_log_type` (
  `logTypeID` varchar(11) NOT NULL,
  `typeName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_log_type`
--

INSERT INTO `t_log_type` (`logTypeID`, `typeName`) VALUES
('TYP-01', 'login'),
('TYP-02', 'logout'),
('TYP-03', 'add'),
('TYP-04', 'edit'),
('TYP-05', 'delete'),
('TYP-06', 'revoke'),
('TYP-07', 'resend'),
('TYP-08', 'reset'),
('TYP-09', 'approve'),
('TYP-10', 'notapprove'),
('TYP-11', 'deny'),
('TYP-12', 'apply'),
('TYP-13', 'cancel'),
('TYP-15', 'register'),
('TYP-16', 'forgot'),
('TYP-17', 'download'),
('TYP-18', 'accept'),
('TYP-19', 'reject'),
('TYP-20', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa`
--

CREATE TABLE `t_mahasiswa` (
  `mahasiswaID` int(11) NOT NULL,
  `loginID` int(11) DEFAULT NULL,
  `universityID` varchar(11) DEFAULT NULL,
  `facultyID` varchar(11) DEFAULT NULL,
  `residenceID` varchar(11) DEFAULT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `mahasiswaNumber` varchar(11) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `birthPlace` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `gender` varchar(22) DEFAULT NULL,
  `religion` varchar(55) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fixedPhone` varchar(20) DEFAULT NULL,
  `mobilePhone` varchar(20) DEFAULT NULL,
  `hobby` text DEFAULT NULL,
  `strength` text DEFAULT NULL,
  `weakness` text DEFAULT NULL,
  `organizationExp` text DEFAULT NULL,
  `projectEverMade` text DEFAULT NULL,
  `semester` varchar(11) DEFAULT NULL,
  `sksTotal` varchar(11) DEFAULT NULL,
  `indexTotal` varchar(11) DEFAULT NULL,
  `statusActive` tinyint(1) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_mahasiswa`
--

INSERT INTO `t_mahasiswa` (`mahasiswaID`, `loginID`, `universityID`, `facultyID`, `residenceID`, `emaiL`, `mahasiswaNumber`, `fullName`, `birthPlace`, `birthDate`, `gender`, `religion`, `city`, `zip`, `address`, `fixedPhone`, `mobilePhone`, `hobby`, `strength`, `weakness`, `organizationExp`, `projectEverMade`, `semester`, `sksTotal`, `indexTotal`, `statusActive`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(550001, 550001, 'MUV-001', 'FAC-04', 'RSD-03', 'apurnama075@gmail.com', '312015051', 'Anton Purnama', 'Sukabumi', '1995-01-21', 'male', 'Islam', 'Sukabumi', 42169, 'Tegalbuleud, Sukabumi', '082118115288', '082118115288', 'Badminton', 'Otot Baja\r\nKawat Besi\r\nTekad Berlian', 'Tak bisa terbang\r\nTak bisa menghilang\r\nTak bisa melupakanmu', 'Pramuka, Paskibra, HIMTEK, BEM', 'Portal Dinas Sosial\r\nBot Telegram\r\ndan lainnya', '6', '72', '3,48', 1, 'Register', '2019-11-29 10:27:15', '550001', '2019-11-29 11:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa_file`
--

CREATE TABLE `t_mahasiswa_file` (
  `fileID` int(11) NOT NULL,
  `mahasiswaID` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `academicTranscipt` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_mahasiswa_file`
--

INSERT INTO `t_mahasiswa_file` (`fileID`, `mahasiswaID`, `photo`, `resume`, `academicTranscipt`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(1, 550001, 'fileupload/pic_mahasiswa/pic_550001.jpg', 'fileupload/file_mahasiswa/resume_550001.pdf', 'fileupload/file_mahasiswa/transcipt_550001.pdf', NULL, NULL, '550001', '2019-11-29 11:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `t_notice`
--

CREATE TABLE `t_notice` (
  `noticeID` varchar(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_notice`
--

INSERT INTO `t_notice` (`noticeID`, `title`, `notice`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('NOTE-001', 'Monthly Report Agustus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua.\r\n\r\nHari & Tgl = Jum\'at 9 Agustus 2019,\r\nTempat = R. Creativity, Lt.8\r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea\r\ncommodo consequat', '11001', '2019-07-29 14:16:07', '11001', '2019-07-29 15:51:23'),
('NOTE-002', 'Monthly Report', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', '11001', '2019-07-29 15:53:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_notification`
--

CREATE TABLE `t_notification` (
  `notifID` int(11) NOT NULL,
  `notifType` varchar(255) DEFAULT NULL,
  `notifTitle` varchar(255) DEFAULT NULL,
  `notification` text DEFAULT NULL,
  `notifUrl` text DEFAULT NULL,
  `notifStatus` int(1) NOT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_notification`
--

INSERT INTO `t_notification` (`notifID`, `notifType`, `notifTitle`, `notification`, `notifUrl`, `notifStatus`, `create_by`, `create_at`) VALUES
(1, 'New', 'Faculty', 'UI Design', 'faculty/index', 1, '11001', '2019-11-28 16:12:36'),
(2, 'New', 'University', 'Bina Nusantara', 'university/index', 1, '11001', '2019-11-28 17:45:08'),
(3, 'New', 'Faculty', 'Design Graphic', 'faculty/index', 1, '11001', '2019-11-28 17:45:43'),
(4, 'New', 'Mahasiswa', 'Anton Purnama', 'mahasiswa/index', 1, NULL, '2019-11-29 10:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `t_passwordreset`
--

CREATE TABLE `t_passwordreset` (
  `id` int(11) NOT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `tokeN` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_project`
--

CREATE TABLE `t_project` (
  `projectID` varchar(11) NOT NULL,
  `deptID` varchar(11) DEFAULT NULL,
  `adminID` varchar(11) DEFAULT NULL,
  `projectName` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_project`
--

INSERT INTO `t_project` (`projectID`, `deptID`, `adminID`, `projectName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('PRJ-001', 'MDT-002', '22001', 'E-Learning Intranet System', '22001', '2019-07-16 11:13:29', '11001', '2019-11-27 17:10:20'),
('PRJ-002', 'MDT-002', '22001', 'Internship Web Portal', '22001', '2019-07-16 11:13:48', '11001', '2019-11-27 17:10:40'),
('PRJ-003', 'MDT-003', '22002', 'Cloud Computing', '22002', '2019-07-30 10:51:23', '11001', '2019-11-27 17:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `t_project_scope`
--

CREATE TABLE `t_project_scope` (
  `projectScopeID` varchar(11) NOT NULL,
  `deptID` varchar(11) DEFAULT NULL,
  `categoryID` varchar(11) DEFAULT NULL,
  `projectID` varchar(11) DEFAULT NULL,
  `projectScope` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `reqQuantity` int(11) DEFAULT NULL,
  `isTaken` tinyint(1) NOT NULL,
  `isApproved` char(1) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_project_scope`
--

INSERT INTO `t_project_scope` (`projectScopeID`, `deptID`, `categoryID`, `projectID`, `projectScope`, `description`, `qualification`, `startDate`, `endDate`, `reqQuantity`, `isTaken`, `isApproved`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('PSC-001', 'MDT-002', 'CAT-001', 'PRJ-002', 'Web Developer', 'Description ...\r\nasasdfasdfjaskdjfasdf\r\nasdfsadjkfjskldjflksjdlf', 'Qualification ...\r\n1. ajsdkfjlksjfjsldjfksdjf\r\n2. askdjkasjdfksjdfkjaskdjf', '2019-09-24', '2019-10-31', 1, 0, 'Y', '22001', '2019-09-23 15:24:35', '22001', '2019-09-30 11:24:42'),
('PSC-002', 'MDT-003', 'CAT-002', 'PRJ-003', 'Android Developer', 'Description...', 'Qualification...', '2019-09-24', '2019-10-21', 2, 0, 'Y', '22002', '2019-09-23 15:47:33', NULL, '2019-09-23 17:54:00'),
('PSC-004', 'MDT-002', 'CAT-001', 'PRJ-001', 'Android Developer', 'dsfasdfsdf', 'sdfsdfsdf', '2019-11-01', '2019-11-30', 1, 1, 'Y', '22001', '2019-10-31 10:18:33', NULL, '2019-10-31 10:19:34'),
('PSC-005', 'MDT-001', 'CAT-001', 'PRJ-003', 'tesssssssss', 'adfffffffffff', 'adfffffffffffffffff', '2019-12-02', '2019-12-25', 1, 1, 'P', '11001', '2019-11-28 10:55:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_project_scope_temp`
--

CREATE TABLE `t_project_scope_temp` (
  `tempID` int(11) NOT NULL,
  `projectScopeID` varchar(11) DEFAULT NULL,
  `mahasiswaID` varchar(11) DEFAULT NULL,
  `type` varchar(22) DEFAULT NULL,
  `statusTemp` varchar(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_residence`
--

CREATE TABLE `t_residence` (
  `residenceID` varchar(11) NOT NULL,
  `residenceName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_residence`
--

INSERT INTO `t_residence` (`residenceID`, `residenceName`) VALUES
('RSD-01', 'Sendiri'),
('RSD-02', 'Bersama Orang Tua'),
('RSD-03', 'Sewa / Kost'),
('RSD-04', 'Bersama Saudara');

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`roleID`, `roleName`) VALUES
(11, 'Admin HC'),
(22, 'Admin Department'),
(33, 'Admin Campus'),
(44, 'Dosen'),
(55, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `t_status_mou`
--

CREATE TABLE `t_status_mou` (
  `id` int(11) NOT NULL,
  `stats` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_status_mou`
--

INSERT INTO `t_status_mou` (`id`, `stats`) VALUES
(1, 'On Process'),
(2, 'Expired'),
(3, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `t_task`
--

CREATE TABLE `t_task` (
  `taskID` int(11) NOT NULL,
  `workscopeID` varchar(11) DEFAULT NULL,
  `taskName` varchar(255) DEFAULT NULL,
  `taskDesc` text DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `startDelay` date DEFAULT NULL,
  `endDelay` date DEFAULT NULL,
  `closeDate` date DEFAULT NULL,
  `statusTask` varchar(11) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_task_progress`
--

CREATE TABLE `t_task_progress` (
  `progressID` int(11) NOT NULL,
  `taskID` int(11) DEFAULT NULL,
  `progress` text DEFAULT NULL,
  `finding` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` text DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_type_data`
--

CREATE TABLE `t_type_data` (
  `id` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_type_data`
--

INSERT INTO `t_type_data` (`id`, `Type`) VALUES
(1, 'INT'),
(2, 'VARCHAR'),
(3, 'DATE'),
(4, 'TEXT');

-- --------------------------------------------------------

--
-- Table structure for table `t_university`
--

CREATE TABLE `t_university` (
  `universityID` varchar(11) NOT NULL,
  `universityName` varchar(255) DEFAULT NULL,
  `mou` enum('YES','NO') DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_university`
--

INSERT INTO `t_university` (`universityID`, `universityName`, `mou`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('MUV-001', 'Politeknik Sukabumi', 'YES', '11001', '2019-10-10 10:50:48', NULL, NULL),
('MUV-002', 'Politeknik Bandung', 'YES', '11001', '2019-10-10 10:02:30', NULL, NULL),
('MUV-003', 'Universitas Negeri Jakarta', 'YES', '11001', '2019-10-10 10:02:53', NULL, NULL),
('MUV-004', 'Institut Teknologi Bandung', 'NO', '11001', '2019-10-14 09:05:48', NULL, NULL),
('MUV-005', 'Bina Nusantara', 'YES', '11001', '2019-12-23 04:29:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_university_profile`
--

CREATE TABLE `t_university_profile` (
  `universityProfileID` varchar(22) NOT NULL,
  `universityID` varchar(11) DEFAULT NULL,
  `universityName` varchar(255) DEFAULT NULL,
  `UniversityRector` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `WebsiteAddress` varchar(255) DEFAULT NULL,
  `UniversityAddress` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_university_profile`
--

INSERT INTO `t_university_profile` (`universityProfileID`, `universityID`, `universityName`, `UniversityRector`, `EmailAddress`, `WebsiteAddress`, `UniversityAddress`) VALUES
('ID-MUV-001-01', 'MUV-001', 'Politeknik Sukabumi', 'Nonda Muldani S.T M.Kom', 'polikami@polteksmi.ac.id', 'polteksmi.ac.id', 'Kota Sukabumi , Jawa Barat'),
('ID-MUV-002-01', 'MUV-002', 'Politeknik Bandung', 'Rektor Polban M M.T', 'polban@itb.ac.id', 'polban.ac.id', 'Kota Bandung, Jawa Barat'),
('ID-MUV-003-01', 'MUV-003', 'Universitas Negeri Jakarta', 'Rektor Unj M M.pd', 'unjcampus@unj.ac.id', 'unj.ac.id', 'Jakarta, DKI Jakarta'),
('ID-MUV-004-01', 'MUV-004', 'Institut Teknologi Bandung', NULL, NULL, NULL, NULL),
('ID-MUV-005-01', 'MUV-005', 'Bina Nusantara', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_workscope`
--

CREATE TABLE `t_workscope` (
  `workscopeID` varchar(11) NOT NULL,
  `projectScopeID` varchar(11) DEFAULT NULL,
  `mahasiswaID` varchar(11) DEFAULT NULL,
  `statusWorkscope` varchar(11) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `t_admin_campus`
--
ALTER TABLE `t_admin_campus`
  ADD PRIMARY KEY (`adminCampusID`);

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `t_company`
--
ALTER TABLE `t_company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `t_company_profile`
--
ALTER TABLE `t_company_profile`
  ADD PRIMARY KEY (`companyProfileID`);

--
-- Indexes for table `t_company_sector`
--
ALTER TABLE `t_company_sector`
  ADD PRIMARY KEY (`sectorID`);

--
-- Indexes for table `t_comunity`
--
ALTER TABLE `t_comunity`
  ADD PRIMARY KEY (`comunityID`);

--
-- Indexes for table `t_comunity_profile`
--
ALTER TABLE `t_comunity_profile`
  ADD PRIMARY KEY (`comunityProfileID`);

--
-- Indexes for table `t_comunity_type`
--
ALTER TABLE `t_comunity_type`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `t_department`
--
ALTER TABLE `t_department`
  ADD PRIMARY KEY (`deptID`);

--
-- Indexes for table `t_dosen`
--
ALTER TABLE `t_dosen`
  ADD PRIMARY KEY (`dosenID`);

--
-- Indexes for table `t_faculty`
--
ALTER TABLE `t_faculty`
  ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `t_login`
--
ALTER TABLE `t_login`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `t_log_activity`
--
ALTER TABLE `t_log_activity`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `t_log_type`
--
ALTER TABLE `t_log_type`
  ADD PRIMARY KEY (`logTypeID`);

--
-- Indexes for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  ADD PRIMARY KEY (`mahasiswaID`);

--
-- Indexes for table `t_mahasiswa_file`
--
ALTER TABLE `t_mahasiswa_file`
  ADD PRIMARY KEY (`fileID`);

--
-- Indexes for table `t_notice`
--
ALTER TABLE `t_notice`
  ADD PRIMARY KEY (`noticeID`);

--
-- Indexes for table `t_notification`
--
ALTER TABLE `t_notification`
  ADD PRIMARY KEY (`notifID`);

--
-- Indexes for table `t_passwordreset`
--
ALTER TABLE `t_passwordreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_project`
--
ALTER TABLE `t_project`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `t_project_scope`
--
ALTER TABLE `t_project_scope`
  ADD PRIMARY KEY (`projectScopeID`);

--
-- Indexes for table `t_project_scope_temp`
--
ALTER TABLE `t_project_scope_temp`
  ADD PRIMARY KEY (`tempID`);

--
-- Indexes for table `t_residence`
--
ALTER TABLE `t_residence`
  ADD PRIMARY KEY (`residenceID`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `t_status_mou`
--
ALTER TABLE `t_status_mou`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_task`
--
ALTER TABLE `t_task`
  ADD PRIMARY KEY (`taskID`);

--
-- Indexes for table `t_task_progress`
--
ALTER TABLE `t_task_progress`
  ADD PRIMARY KEY (`progressID`);

--
-- Indexes for table `t_type_data`
--
ALTER TABLE `t_type_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_university`
--
ALTER TABLE `t_university`
  ADD PRIMARY KEY (`universityID`);

--
-- Indexes for table `t_university_profile`
--
ALTER TABLE `t_university_profile`
  ADD PRIMARY KEY (`universityProfileID`);

--
-- Indexes for table `t_workscope`
--
ALTER TABLE `t_workscope`
  ADD PRIMARY KEY (`workscopeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_company_sector`
--
ALTER TABLE `t_company_sector`
  MODIFY `sectorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_comunity_type`
--
ALTER TABLE `t_comunity_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_log_activity`
--
ALTER TABLE `t_log_activity`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=886;

--
-- AUTO_INCREMENT for table `t_mahasiswa_file`
--
ALTER TABLE `t_mahasiswa_file`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_notification`
--
ALTER TABLE `t_notification`
  MODIFY `notifID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_passwordreset`
--
ALTER TABLE `t_passwordreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_project_scope_temp`
--
ALTER TABLE `t_project_scope_temp`
  MODIFY `tempID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_status_mou`
--
ALTER TABLE `t_status_mou`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_task`
--
ALTER TABLE `t_task`
  MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_task_progress`
--
ALTER TABLE `t_task_progress`
  MODIFY `progressID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_type_data`
--
ALTER TABLE `t_type_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
