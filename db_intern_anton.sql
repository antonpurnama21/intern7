-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2019 at 04:38 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_intern_anton`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE IF NOT EXISTS `t_admin` (
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
(11001, 11001, 'root@mail.gg', 'Anton Purnama', '082118115288', NULL, 'MDT-001', NULL, NULL, NULL, NULL),
(22001, 22001, 'masantonpurnama@gmail.com', 'Naruto Uzumaki', '01019299291', NULL, 'MDT-002', '11001', '2019-07-16 10:42:27', NULL, NULL),
(22002, 22002, 'minato@gmail.com', 'Yondaime', '11223344112', NULL, 'MDT-003', '11001', '2019-07-30 10:37:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_admin_campus`
--

CREATE TABLE IF NOT EXISTS `t_admin_campus` (
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
(33001, 33001, 'MUV-001', 'antonpurnama9878@gmail.com', 'Sasuke Uchiha', '081929291911', NULL, '11001', '2019-07-16 10:44:16', NULL, NULL),
(33002, 33002, 'MUV-002', 'kangin@gmail.com', 'Kang In', '082188292919', NULL, '11001', '2019-07-18 14:13:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE IF NOT EXISTS `t_category` (
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

CREATE TABLE IF NOT EXISTS `t_company` (
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

CREATE TABLE IF NOT EXISTS `t_company_profile` (
  `companyProfileID` varchar(22) NOT NULL,
  `companyID` varchar(11) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `sectorCompany` varchar(255) DEFAULT NULL,
  `CompanyDirector` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `CompanyAddress` text,
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

CREATE TABLE IF NOT EXISTS `t_company_sector` (
`sectorID` int(11) NOT NULL,
  `sectorCompany` varchar(255) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `t_comunity` (
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

CREATE TABLE IF NOT EXISTS `t_comunity_profile` (
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

CREATE TABLE IF NOT EXISTS `t_comunity_type` (
`typeID` int(11) NOT NULL,
  `typeComunity` varchar(255) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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

CREATE TABLE IF NOT EXISTS `t_department` (
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

CREATE TABLE IF NOT EXISTS `t_dosen` (
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
  `address` text,
  `profilePic` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_dosen`
--

INSERT INTO `t_dosen` (`dosenID`, `loginID`, `universityID`, `facultyID`, `emaiL`, `dosenNumber`, `fullName`, `fixedPhone`, `mobilePhone`, `city`, `zip`, `address`, `profilePic`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(440001, 440001, 'MUV-001', 'FAC-02', 'midaspurnama@gmail.com', '11223344', 'Nila Nurilah M Kom', '123124123432', '234234213443', 'Sukabumi', 42169, 'Sukabumi, Lembur Situ', 'fileupload/pic_dosen/pic_4400011.png', '11001', '2019-09-24 10:12:28', '11001', '2019-10-18 09:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_faculty`
--

CREATE TABLE IF NOT EXISTS `t_faculty` (
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
('FAC-04', 'Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `t_login`
--

CREATE TABLE IF NOT EXISTS `t_login` (
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
(11001, 11, 'root@mail.gg', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-06-15 00:00:00', '2019-10-23 13:55:47', NULL),
(22001, 22, 'masantonpurnama@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-16 10:42:27', '2019-10-21 16:14:34', NULL),
(22002, 22, 'minato@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-30 10:37:28', '2019-09-23 15:45:16', NULL),
(33001, 33, 'antonpurnama9878@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-16 10:44:16', '2019-10-21 16:53:00', NULL),
(33002, 33, 'kangin@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-07-18 14:13:15', '2019-07-23 15:16:02', NULL),
(440001, 44, 'midaspurnama@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-09-24 10:12:28', '2019-10-21 16:53:26', NULL),
(550001, 55, 'apurnama075@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', NULL, 'verified', '2019-09-24 09:36:41', '2019-10-21 16:07:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_log_activity`
--

CREATE TABLE IF NOT EXISTS `t_log_activity` (
`logID` int(11) NOT NULL,
  `logUsrID` int(11) DEFAULT NULL,
  `logTime` datetime DEFAULT NULL,
  `logTypeID` varchar(11) DEFAULT NULL,
  `logDesc` text,
  `logBrowser` varchar(255) DEFAULT NULL,
  `logIP` varchar(20) DEFAULT NULL,
  `logPlatform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=756 ;

--
-- Dumping data for table `t_log_activity`
--

INSERT INTO `t_log_activity` (`logID`, `logUsrID`, `logTime`, `logTypeID`, `logDesc`, `logBrowser`, `logIP`, `logPlatform`) VALUES
(446, 11001, '2019-09-22 17:30:25', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '::1', 'Windows 8.1'),
(447, 11001, '2019-09-23 09:56:12', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '::1', 'Windows 8.1'),
(448, 11001, '2019-09-23 11:15:06', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '::1', 'Windows 8.1'),
(449, 11001, '2019-09-23 13:33:04', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(450, 11001, '2019-09-23 14:10:27', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(451, 22001, '2019-09-23 14:10:37', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(452, 22001, '2019-09-23 15:24:36', 'TYP-03', 'Add New Project Scope ( Web Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(453, 22001, '2019-09-23 15:44:08', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(454, 11001, '2019-09-23 15:44:19', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(455, 11001, '2019-09-23 15:45:05', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(456, 22002, '2019-09-23 15:45:16', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(457, 22002, '2019-09-23 15:47:33', 'TYP-03', 'Add New Project Scope ( Android Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(458, 22002, '2019-09-23 15:47:58', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(459, 11001, '2019-09-23 15:48:13', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(460, 11001, '2019-09-23 17:53:40', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(461, 11001, '2019-09-23 17:54:00', 'TYP-09', 'Approved Project Scope ( Android Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(462, 11001, '2019-09-23 17:54:06', 'TYP-09', 'Approved Project Scope ( Web Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(463, NULL, '2019-09-24 09:36:41', 'TYP-15', 'New application mahasiswa apurnama075@gmail.com', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(464, 550001, '2019-09-24 09:40:29', 'TYP-08', 'Success reset password ', 'Chrome 77.0.3865.92', '114.124.134.115', 'Android'),
(465, 11001, '2019-09-24 09:59:51', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(466, 550001, '2019-09-24 10:08:31', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.140.242', 'Android'),
(467, 11001, '2019-09-24 10:12:28', 'TYP-03', 'Add New Dosen ( midaspurnama@gmail.com )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(468, 11001, '2019-09-24 10:47:47', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(469, 550001, '2019-09-24 10:56:54', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(470, 550001, '2019-09-24 10:57:54', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(471, 11001, '2019-09-24 10:58:02', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(472, 11001, '2019-09-24 10:59:55', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(473, 550001, '2019-09-24 11:00:05', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(474, 550001, '2019-09-24 11:04:41', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(475, 22001, '2019-09-24 11:04:48', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(476, 22001, '2019-09-24 11:05:37', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(477, 550001, '2019-09-24 11:05:44', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(478, 550001, '2019-09-24 11:19:02', 'TYP-04', 'Edit Profile', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(479, 550001, '2019-09-24 11:20:00', 'TYP-04', 'Edit Profile', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(480, NULL, '2019-09-24 11:23:27', 'TYP-17', 'Download Resume, 550001', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(481, NULL, '2019-09-24 11:23:32', 'TYP-17', 'Download Resume, 550001', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(482, 550001, '2019-09-24 11:24:53', 'TYP-04', 'Edit Profile', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(483, 550001, '2019-09-24 11:31:56', 'TYP-04', 'Edit Profile', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(484, 550001, '2019-09-24 11:37:15', 'TYP-13', 'Applied Project Scope ( Web Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(485, 550001, '2019-09-24 11:37:23', 'TYP-13', 'Applied Project Scope ( Android Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(486, 550001, '2019-09-24 11:37:35', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(487, 22001, '2019-09-24 11:37:42', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(488, NULL, '2019-09-24 11:38:22', 'TYP-17', 'Download Resume, 550001', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(489, NULL, '2019-09-24 11:39:16', 'TYP-18', 'Accepted Applier Anton Purnama for Web Developer ( Internship Web Portal )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(490, 22001, '2019-09-24 11:39:40', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(491, 22001, '2019-09-24 11:39:47', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(492, 22001, '2019-09-24 11:40:02', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(493, 550001, '2019-09-24 11:40:10', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(494, 550001, '2019-09-24 11:44:21', 'TYP-03', 'Add New Task ( Task Pertama )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(495, 550001, '2019-09-24 11:44:21', 'TYP-03', 'Add New Task ( Task Kedua )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(496, 550001, '2019-09-24 11:44:21', 'TYP-03', 'Add New Task ( Task Ketiga )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(497, 550001, '2019-09-24 11:44:21', 'TYP-03', 'Add New Task ( Task Keempat )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(498, 550001, '2019-09-24 11:45:38', 'TYP-03', 'Add New Task ( Presentasi Akhir )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(499, 550001, '2019-09-24 14:12:34', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(500, 11001, '2019-09-24 14:12:42', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(501, 11001, '2019-09-24 14:24:37', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(502, 550001, '2019-09-25 17:12:27', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(503, 550001, '2019-09-25 17:30:03', 'TYP-03', 'Added New Progress Task (Task Pertama)', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(504, 550001, '2019-09-25 17:31:36', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(505, 22001, '2019-09-25 17:31:44', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(506, 22001, '2019-09-25 17:32:30', 'TYP-04', 'Edit Project Scope ( Web Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(507, 22001, '2019-09-25 17:33:09', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(508, 11001, '2019-09-25 17:35:34', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(509, 11001, '2019-09-25 17:43:09', 'TYP-07', 'Resend Setup Link to midaspurnama@gmail.com', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(510, 440001, '2019-09-25 17:44:23', 'TYP-08', 'Success reset password ', 'Chrome 77.0.3865.92', '114.124.213.183', 'Android'),
(511, 11001, '2019-09-25 17:52:41', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(512, 440001, '2019-09-25 18:05:23', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.197.183', 'Android'),
(513, 11001, '2019-09-27 15:34:41', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(514, 11001, '2019-09-27 15:35:16', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(515, 550001, '2019-09-27 15:35:23', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(516, 550001, '2019-09-27 15:37:58', 'TYP-03', 'Added New Progress Task (Task Pertama)', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(601, 550001, '2019-09-27 16:21:05', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Pertama )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(602, 11001, '2019-09-27 20:07:33', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '114.124.169.226', 'Android'),
(603, 11001, '2019-09-27 20:09:53', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.169.226', 'Android'),
(604, 11001, '2019-09-27 20:13:36', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '182.0.203.253', 'Android'),
(605, 11001, '2019-09-27 20:15:59', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.212.30', 'Android'),
(606, 550001, '2019-09-27 20:16:17', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '114.124.212.30', 'Android'),
(607, 550001, '2019-09-27 20:18:10', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.212.30', 'Android'),
(608, 550001, '2019-09-30 10:50:56', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(609, 550001, '2019-09-30 10:52:03', 'TYP-03', 'Added New Progress Task (Task Kedua)', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(610, 550001, '2019-09-30 11:21:28', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(611, 11001, '2019-09-30 11:21:43', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(612, 11001, '2019-09-30 11:23:41', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(613, 22001, '2019-09-30 11:23:49', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(614, 22001, '2019-09-30 11:24:42', 'TYP-04', 'Edit Project Scope ( Web Developer )', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(615, 22001, '2019-09-30 11:27:19', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 8.1'),
(616, 11001, '2019-10-03 15:25:52', 'TYP-01', 'Login Application', 'Firefox 48.0', '202.158.50.27', 'Mac OS X'),
(617, 11001, '2019-10-03 15:40:53', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '114.124.244.145', 'Android'),
(618, 22001, '2019-10-03 15:45:03', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '114.124.244.10', 'Android'),
(619, 22001, '2019-10-03 15:45:47', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.213.196', 'Android'),
(620, 11001, '2019-10-03 15:46:18', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.92', '114.124.212.68', 'Android'),
(621, 11001, '2019-10-03 15:47:27', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.92', '114.124.212.68', 'Android'),
(622, 550001, '2019-10-08 10:57:48', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 10'),
(623, 550001, '2019-10-08 10:58:42', 'TYP-03', 'Added New Progress Task (Task Kedua)', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 10'),
(624, 550001, '2019-10-08 10:59:43', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.90', '202.158.50.24', 'Windows 10'),
(625, 11001, '2019-10-08 06:11:52', 'TYP-03', 'Add New Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(626, 11001, '2019-10-08 06:12:13', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(627, 11001, '2019-10-08 06:19:18', 'TYP-03', 'Add New Coloumn Field ( CompanyAddress ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(628, 11001, '2019-10-08 06:20:01', 'TYP-03', 'Add New Coloumn Field ( EmailAddress ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(629, 11001, '2019-10-08 06:23:37', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(630, 11001, '2019-10-08 06:25:19', 'TYP-03', 'Add New Coloumn Field ( CompanyDirector ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(631, 11001, '2019-10-08 06:27:22', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(632, 11001, '2019-10-08 06:34:08', 'TYP-03', 'Add New Comunity ( Komunitas Linux )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(633, 11001, '2019-10-08 08:06:08', 'TYP-03', 'Add New Company ( PT. Andromedia )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(634, 11001, '2019-10-08 09:21:57', 'TYP-03', 'Add New Coloumn Field ( FieldTest ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(635, 11001, '2019-10-08 09:22:09', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(636, 11001, '2019-10-08 10:27:49', 'TYP-03', 'Add New Coloumn Field ( UniversityAddress ) In Table university Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(637, 11001, '2019-10-08 10:28:09', 'TYP-03', 'Add New Coloumn Field ( EmailAddress ) In Table university Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(638, 11001, '2019-10-08 10:28:41', 'TYP-03', 'Add New Coloumn Field ( UniversityRector ) In Table university Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(639, 11001, '2019-10-08 10:33:45', 'TYP-04', 'Update Profile University ( Politeknik Sukabumi )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(640, 11001, '2019-10-08 10:34:58', 'TYP-03', 'Add New Coloumn Field ( EmailAddress ) In Table Comunity Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(641, 11001, '2019-10-08 10:36:28', 'TYP-04', 'Update Profile Comunity ( Komunitas Linux )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(642, 11001, '2019-10-09 06:31:07', 'TYP-04', 'Update Profile Company ( PT. Andromedia )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(643, 11001, '2019-10-09 08:50:44', 'TYP-03', 'Add New Company ( Bima Sakti Corporation )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(644, 11001, '2019-10-09 08:50:59', 'TYP-04', 'Edit Company ( Bima Sakti Corporation Ltd )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(645, 11001, '2019-10-09 08:51:35', 'TYP-03', 'Add New Company ( Bima Sakti Corporation Ltd )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(646, 11001, '2019-10-09 08:53:51', 'TYP-04', 'Update Profile Company ( Bima Sakti Corporation Ltd )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(647, 11001, '2019-10-09 09:05:40', 'TYP-03', 'Add New Coloumn Field ( GajahMada ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(648, 11001, '2019-10-10 09:55:41', 'TYP-04', 'Update Profile University ( Politeknik Bandung )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(649, 11001, '2019-10-10 09:58:14', 'TYP-04', 'Update Profile University ( Universitas Negeri Jakarta )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(650, 11001, '2019-10-10 10:01:37', 'TYP-03', 'Add New Coloumn Field ( WebsiteAddress ) In Table university Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(651, 11001, '2019-10-10 10:02:05', 'TYP-04', 'Update Profile University ( Politeknik Sukabumi )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(652, 11001, '2019-10-10 10:02:30', 'TYP-04', 'Update Profile University ( Politeknik Bandung )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(653, 11001, '2019-10-10 10:02:53', 'TYP-04', 'Update Profile University ( Universitas Negeri Jakarta )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(654, 11001, '2019-10-10 10:03:16', 'TYP-03', 'Add New University ( tesssssssss )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(655, 11001, '2019-10-10 10:03:42', 'TYP-03', 'Add New University ( tesssssssss33 )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(656, 11001, '2019-10-10 10:15:49', 'TYP-03', 'Add New University ( tesssssssss )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(657, 11001, '2019-10-10 10:16:17', 'TYP-03', 'Add New University ( tesssssssss33 )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(658, 11001, '2019-10-10 10:28:00', 'TYP-03', 'Add New University ( tesssssssss )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(659, 11001, '2019-10-10 10:50:48', 'TYP-04', 'Update Profile University ( Politeknik Sukabumi )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(660, 11001, '2019-10-10 12:46:16', 'TYP-04', 'Update Profile Comunity ( Komunitas Linux )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(661, 11001, '2019-10-10 12:47:22', 'TYP-03', 'Add New Coloumn Field ( FoundedDate ) In Table Company Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(662, 11001, '2019-10-10 12:48:18', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(663, 11001, '2019-10-10 12:52:07', 'TYP-03', 'Add New Coloumn Field ( WebsiteAddress ) In Table Comunity Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(664, 11001, '2019-10-10 12:52:39', 'TYP-03', 'Add New Coloumn Field ( tessssgg ) In Table Comunity Profile', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(665, 11001, '2019-10-11 13:03:48', 'TYP-04', 'Update Profile Company ( PT. Andromedia )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(666, 11001, '2019-10-11 13:04:49', 'TYP-04', 'Update Profile Company ( Bima Sakti Corporation Ltd )', 'Chrome 77.0.3865.90', '::1', 'Windows 10'),
(667, 11001, '2019-10-14 04:52:53', 'TYP-04', 'Update Profile Comunity ( Komunitas Linux )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(668, 11001, '2019-10-14 08:27:25', 'TYP-04', 'Update Profile Company ( PT. Indah Sejahtera )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(669, 11001, '2019-10-14 09:05:48', 'TYP-03', 'Add New University ( Institut Teknologi Bandung )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(670, 11001, '2019-10-15 06:25:50', 'TYP-03', 'Add New Sector ( Telekomunikasi )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(671, 11001, '2019-10-15 06:25:57', 'TYP-04', 'Edit Sector ( Telekomunikasi2 )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(672, 11001, '2019-10-15 06:26:04', 'TYP-04', 'Edit Sector ( Telekomunikasi )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(673, 11001, '2019-10-15 06:26:17', 'TYP-03', 'Add New Sector ( tess )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(674, 11001, '2019-10-15 06:32:03', 'TYP-05', 'Delete Sector ( tess )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(675, 11001, '2019-10-15 06:48:32', 'TYP-03', 'Add New Type Comunity ( Tess )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(676, 11001, '2019-10-15 06:48:40', 'TYP-04', 'Edit Type ( Tesse )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(677, 11001, '2019-10-15 06:48:45', 'TYP-05', 'Delete Type Comunity ( Tesse )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(678, 11001, '2019-10-18 09:52:21', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(679, 11001, '2019-10-18 09:54:02', 'TYP-04', 'Edit Mahasiswa Data ( apurnama075@gmail.com )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(680, 11001, '2019-10-18 09:54:36', 'TYP-04', 'Edit Mahasiswa Data ( apurnama075@gmail.com )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(681, 11001, '2019-10-18 09:55:19', 'TYP-04', 'Edit Mahasiswa Data ( apurnama075@gmail.com )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(682, 11001, '2019-10-18 09:55:44', 'TYP-04', 'Edit Dosen Data ( midaspurnama@gmail.com )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(683, 11001, '2019-10-18 09:55:48', 'TYP-04', 'Edit Dosen Data ( midaspurnama@gmail.com )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(684, 11001, '2019-10-18 10:00:03', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(685, 11001, '2019-10-18 10:08:55', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(686, 11001, '2019-10-18 10:09:23', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(687, 11001, '2019-10-18 10:23:28', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(688, NULL, '2019-10-18 13:42:26', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(689, 11001, '2019-10-18 13:46:16', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(690, 11001, '2019-10-18 13:46:28', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(691, 11001, '2019-10-18 13:46:34', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(692, 11001, '2019-10-18 13:46:55', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(693, 11001, '2019-10-18 14:20:57', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(694, 11001, '2019-10-18 14:21:17', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(695, 550001, '2019-10-18 14:21:30', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(696, 550001, '2019-10-18 14:21:43', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(697, 550001, '2019-10-18 14:22:40', 'TYP-03', 'Added New Progress Task (Task Ketiga)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(698, 550001, '2019-10-18 14:22:56', 'TYP-03', 'Added New Progress Task (Task Ketiga)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(699, 550001, '2019-10-18 14:56:40', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(700, 550001, '2019-10-18 16:20:29', 'TYP-03', 'Added New Progress Task (Task Kedua)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(701, 550001, '2019-10-18 16:27:02', 'TYP-03', 'Added New Progress Task (Task Kedua)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(702, 550001, '2019-10-18 16:27:30', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(703, 550001, '2019-10-18 16:30:26', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(704, 550001, '2019-10-18 16:43:07', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(705, 550001, '2019-10-18 16:45:10', 'TYP-03', 'Added New Progress Task (Task Ketiga)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(706, 550001, '2019-10-18 16:45:39', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(707, 550001, '2019-10-18 17:05:10', 'TYP-03', 'Added New Progress Task (Task Kedua)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(708, 550001, '2019-10-18 17:05:35', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(709, 550001, '2019-10-18 17:05:53', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(710, 550001, '2019-10-18 17:14:34', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Kedua )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(711, 550001, '2019-10-18 17:15:37', 'TYP-20', 'Anton Purnama Menyelesaikan Task ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(712, 550001, '2019-10-18 17:19:11', 'TYP-04', 'Edit Progress ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(713, 550001, '2019-10-18 17:19:29', 'TYP-04', 'Edit Progress ( Task Ketiga )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(714, 550001, '2019-10-18 17:19:38', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(715, 11001, '2019-10-18 17:19:54', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(716, 11001, '2019-10-18 17:20:41', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(717, 11001, '2019-10-18 17:20:47', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(718, 11001, '2019-10-18 17:23:04', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(719, 11001, '2019-10-18 17:23:28', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(720, 11001, '2019-10-18 17:26:16', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(721, 11001, '2019-10-18 17:26:27', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(722, 11001, '2019-10-21 09:42:08', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(723, 550001, '2019-10-21 10:07:05', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(724, 550001, '2019-10-21 10:07:13', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(725, 11001, '2019-10-21 10:07:24', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(726, 11001, '2019-10-21 11:25:12', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(727, 11001, '2019-10-21 11:25:32', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(728, 11001, '2019-10-21 11:56:32', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(729, 11001, '2019-10-21 13:28:16', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(730, 11001, '2019-10-21 14:14:02', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(731, 550001, '2019-10-21 14:14:15', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(732, 550001, '2019-10-21 14:14:51', 'TYP-03', 'Added New Progress Task (Task Ketiga)', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(733, 550001, '2019-10-21 14:15:30', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(734, 11001, '2019-10-21 14:15:40', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(735, 11001, '2019-10-21 16:07:26', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(736, 550001, '2019-10-21 16:07:34', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(737, 550001, '2019-10-21 16:08:52', 'TYP-04', 'Edit Profile', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(738, NULL, '2019-10-21 16:09:06', 'TYP-17', 'Download Resume, 550001', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(739, NULL, '2019-10-21 16:09:15', 'TYP-17', 'Download Academic Transcipt, 550001', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(740, NULL, '2019-10-21 16:10:59', 'TYP-17', 'Download Resume, 550001', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(741, 550001, '2019-10-21 16:14:26', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(742, 22001, '2019-10-21 16:14:34', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(743, 22001, '2019-10-21 16:14:47', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(744, 11001, '2019-10-21 16:14:56', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(745, 11001, '2019-10-21 16:38:01', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(746, 33001, '2019-10-21 16:38:27', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(747, 33001, '2019-10-21 16:52:29', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(748, 33001, '2019-10-21 16:53:00', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(749, 33001, '2019-10-21 16:53:09', 'TYP-02', 'Logout Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(750, 440001, '2019-10-21 16:53:27', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(751, 11001, '2019-10-23 13:55:48', 'TYP-01', 'Login Application', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(752, 11001, '2019-10-25 05:42:59', 'TYP-03', 'Add New Company (  )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(753, 11001, '2019-10-25 05:43:58', 'TYP-05', 'Delete Company (  )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(754, 11001, '2019-10-25 05:46:20', 'TYP-03', 'Add New Company ( gfgfh hhjghg )', 'Chrome 77.0.3865.120', '::1', 'Windows 10'),
(755, 11001, '2019-10-25 05:47:23', 'TYP-05', 'Delete Company ( gfgfh hhjghg )', 'Chrome 77.0.3865.120', '::1', 'Windows 10');

-- --------------------------------------------------------

--
-- Table structure for table `t_log_type`
--

CREATE TABLE IF NOT EXISTS `t_log_type` (
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

CREATE TABLE IF NOT EXISTS `t_mahasiswa` (
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
  `address` text,
  `fixedPhone` varchar(20) DEFAULT NULL,
  `mobilePhone` varchar(20) DEFAULT NULL,
  `hobby` text,
  `strength` text,
  `weakness` text,
  `organizationExp` text,
  `projectEverMade` text,
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
(550001, 550001, 'MUV-001', 'FAC-02', 'RSD-03', 'apurnama075@gmail.com', '312015051', 'Anton Purnama', 'Sukabumi', '1995-01-18', 'male', 'Islam', 'Sukabumi', 43169, 'Lembur situ, kota sukabumi', '123124123432', '082118115288', 'hobi1\r\nhobi2', 'aaaaaaaaaa\r\nssssssssss\r\ndddddddddd', 'qqqqqqqqqq\r\nsssssssssss\r\ndddddddddd', 'sssssssss ssssssssssssss sssssssssssssss\r\nddddddddddddddd ddddddddddddd', 'sssssss ssssssssssssss sssssssss dddddddd\r\nsssssssss sssssssssssssd', '6', '72', '3,48', 1, 'Register', '2019-09-24 09:36:41', '550001', '2019-10-21 16:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa_file`
--

CREATE TABLE IF NOT EXISTS `t_mahasiswa_file` (
`fileID` int(11) NOT NULL,
  `mahasiswaID` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `academicTranscipt` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_mahasiswa_file`
--

INSERT INTO `t_mahasiswa_file` (`fileID`, `mahasiswaID`, `photo`, `resume`, `academicTranscipt`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(2, 550001, 'fileupload/pic_mahasiswa/pic_550001.png', 'fileupload/file_mahasiswa/resume_550001.pdf', 'fileupload/file_mahasiswa/transcipt_550001.pdf', NULL, NULL, '550001', '2019-10-21 16:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `t_notice`
--

CREATE TABLE IF NOT EXISTS `t_notice` (
  `noticeID` varchar(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notice` text,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_notice`
--

INSERT INTO `t_notice` (`noticeID`, `title`, `notice`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('NOTE-001', 'Monthly Report Agustus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua.\r\n\r\nHari & Tgl = Jum''at 9 Agustus 2019,\r\nTempat = R. Creativity, Lt.8\r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea\r\ncommodo consequat', '11001', '2019-07-29 14:16:07', '11001', '2019-07-29 15:51:23'),
('NOTE-002', 'Monthly Report', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', '11001', '2019-07-29 15:53:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_passwordreset`
--

CREATE TABLE IF NOT EXISTS `t_passwordreset` (
`id` int(11) NOT NULL,
  `emaiL` varchar(255) DEFAULT NULL,
  `tokeN` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_project`
--

CREATE TABLE IF NOT EXISTS `t_project` (
  `projectID` varchar(11) NOT NULL,
  `deptID` varchar(11) DEFAULT NULL,
  `projectName` varchar(255) DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` datetime DEFAULT NULL,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_project`
--

INSERT INTO `t_project` (`projectID`, `deptID`, `projectName`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('PRJ-001', 'MDT-002', 'E-Learning Intranet System', '22001', '2019-07-16 11:13:29', NULL, NULL),
('PRJ-002', 'MDT-002', 'Internship Web Portal', '22001', '2019-07-16 11:13:48', NULL, NULL),
('PRJ-003', 'MDT-003', 'Cloud Computing', '22002', '2019-07-30 10:51:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_project_scope`
--

CREATE TABLE IF NOT EXISTS `t_project_scope` (
  `projectScopeID` varchar(11) NOT NULL,
  `deptID` varchar(11) DEFAULT NULL,
  `categoryID` varchar(11) DEFAULT NULL,
  `projectID` varchar(11) DEFAULT NULL,
  `projectScope` varchar(255) DEFAULT NULL,
  `description` text,
  `qualification` text,
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
('PSC-002', 'MDT-003', 'CAT-002', 'PRJ-003', 'Android Developer', 'Description...', 'Qualification...', '2019-09-24', '2019-10-21', 2, 0, 'Y', '22002', '2019-09-23 15:47:33', NULL, '2019-09-23 17:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_project_scope_temp`
--

CREATE TABLE IF NOT EXISTS `t_project_scope_temp` (
`tempID` int(11) NOT NULL,
  `projectScopeID` varchar(11) DEFAULT NULL,
  `mahasiswaID` varchar(11) DEFAULT NULL,
  `type` varchar(22) DEFAULT NULL,
  `statusTemp` varchar(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_project_scope_temp`
--

INSERT INTO `t_project_scope_temp` (`tempID`, `projectScopeID`, `mahasiswaID`, `type`, `statusTemp`, `date`) VALUES
(1, 'PSC-001', '550001', 'applied', 'accepted', '2019-09-24 11:37:16'),
(2, 'PSC-002', '550001', 'applied', NULL, '2019-09-24 11:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `t_residence`
--

CREATE TABLE IF NOT EXISTS `t_residence` (
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

CREATE TABLE IF NOT EXISTS `t_role` (
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
-- Table structure for table `t_task`
--

CREATE TABLE IF NOT EXISTS `t_task` (
`taskID` int(11) NOT NULL,
  `workscopeID` varchar(11) DEFAULT NULL,
  `taskName` varchar(255) DEFAULT NULL,
  `taskDesc` text,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `t_task`
--

INSERT INTO `t_task` (`taskID`, `workscopeID`, `taskName`, `taskDesc`, `startDate`, `endDate`, `startDelay`, `endDelay`, `closeDate`, `statusTask`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(1, 'WSC-001', 'Task Pertama', 'asdfsadf sadfsdf\r\nasdfasdfa dfasdfas', '2019-09-25', '2019-09-27', NULL, NULL, '2019-09-27', 'done', '550001', '2019-09-24 11:44:21', '550001', '2019-09-27 16:21:05'),
(2, 'WSC-001', 'Task Kedua', 'asdfasdfsadf asdfasdf \r\nsdfsdf dsf asdfsdf asd', '2019-09-30', '2019-10-11', NULL, NULL, '2019-10-18', 'done', '550001', '2019-09-24 11:44:21', '550001', '2019-10-18 17:14:34'),
(3, 'WSC-001', 'Task Ketiga', 'adfsdfsdf sdf dsf asdfa fadsfa\r\nsdfsdfsd sdf sdfsdfsdf sdfasdf', '2019-10-14', '2019-10-18', '2019-10-19', '2019-10-21', NULL, 'delay', '550001', '2019-09-24 11:44:21', '550001', '2019-10-18 17:15:36'),
(4, 'WSC-001', 'Task Keempat', 'asdfsdfs dfsdf sdfa sdf asdf sadf\r\ns dfsadf asdf dsf sd sdf asdfsdff', '2019-10-21', '2019-10-30', NULL, NULL, NULL, 'on-progress', '550001', '2019-09-24 11:44:21', NULL, NULL),
(5, 'WSC-001', 'Presentasi Akhir', 'asdfasdfjksadf asdjfsakdjf asdf\r\nasdfjsakdjflkjsd fsadfjsdfjsladjf', '2019-10-31', '2019-10-31', NULL, NULL, NULL, 'pending', '550001', '2019-09-24 11:45:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_task_progress`
--

CREATE TABLE IF NOT EXISTS `t_task_progress` (
`progressID` int(11) NOT NULL,
  `taskID` int(11) DEFAULT NULL,
  `progress` text,
  `finding` text,
  `date` date DEFAULT NULL,
  `createdBY` varchar(11) DEFAULT NULL,
  `createdTIME` text,
  `updatedBY` varchar(11) DEFAULT NULL,
  `updatedTIME` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `t_task_progress`
--

INSERT INTO `t_task_progress` (`progressID`, `taskID`, `progress`, `finding`, `date`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
(1, 1, 'mengumpulkan requirement yang di butuhkan user', 'tak ada', '2019-09-25', '550001', '2019-09-25 17:30:03', NULL, NULL),
(2, 1, 'Selesei mengumpulkan requirement yang dibutuhkan ', 'beberapa fitur yang ingin di ada pada sistem yaiitu responsive dan dinamis', '2019-09-27', '550001', '2019-09-27 15:37:57', NULL, NULL),
(3, 2, 'Mock up Desain', 'Dream weaper', '2019-09-30', '550001', '2019-09-30 10:52:03', NULL, NULL),
(4, 2, 'Progress', 'progress', '2019-10-08', '550001', '2019-10-08 10:58:42', NULL, NULL),
(5, 3, 'task 3', 'not found', '2019-10-18', '550001', '2019-10-18 14:22:40', NULL, NULL),
(6, 3, 'on progress', 'sadfasdf', '2019-10-18', '550001', '2019-10-18 14:22:56', '550001', '2019-10-18 17:19:29'),
(9, 3, 'belum uy', 'askdjfksajfkasf', '2019-10-18', '550001', '2019-10-18 16:45:10', '550001', '2019-10-18 17:19:11'),
(10, 2, 'Ada penambahn fitur', 'selesai', '2019-10-11', '550001', '2019-10-18 17:05:10', NULL, NULL),
(11, 3, 'masiihhh mengerjakan', 'found API', '2019-10-21', '550001', '2019-10-21 14:14:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_type_data`
--

CREATE TABLE IF NOT EXISTS `t_type_data` (
`id` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `t_university` (
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
('MUV-004', 'Institut Teknologi Bandung', 'NO', '11001', '2019-10-14 09:05:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_university_profile`
--

CREATE TABLE IF NOT EXISTS `t_university_profile` (
  `universityProfileID` varchar(22) NOT NULL,
  `universityID` varchar(11) DEFAULT NULL,
  `universityName` varchar(255) DEFAULT NULL,
  `UniversityRector` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `WebsiteAddress` varchar(255) DEFAULT NULL,
  `UniversityAddress` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_university_profile`
--

INSERT INTO `t_university_profile` (`universityProfileID`, `universityID`, `universityName`, `UniversityRector`, `EmailAddress`, `WebsiteAddress`, `UniversityAddress`) VALUES
('ID-MUV-001-01', 'MUV-001', 'Politeknik Sukabumi', 'Nonda Muldani S.T M.Kom', 'polikami@polteksmi.ac.id', 'polteksmi.ac.id', 'Kota Sukabumi , Jawa Barat'),
('ID-MUV-002-01', 'MUV-002', 'Politeknik Bandung', 'Rektor Polban M M.T', 'polban@itb.ac.id', 'polban.ac.id', 'Kota Bandung, Jawa Barat'),
('ID-MUV-003-01', 'MUV-003', 'Universitas Negeri Jakarta', 'Rektor Unj M M.pd', 'unjcampus@unj.ac.id', 'unj.ac.id', 'Jakarta, DKI Jakarta'),
('ID-MUV-004-01', 'MUV-004', 'Institut Teknologi Bandung', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_workscope`
--

CREATE TABLE IF NOT EXISTS `t_workscope` (
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
-- Dumping data for table `t_workscope`
--

INSERT INTO `t_workscope` (`workscopeID`, `projectScopeID`, `mahasiswaID`, `statusWorkscope`, `createdBY`, `createdTIME`, `updatedBY`, `updatedTIME`) VALUES
('WSC-001', 'PSC-001', '550001', 'on-progress', NULL, '2019-09-24 11:39:16', NULL, NULL);

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
MODIFY `sectorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_comunity_type`
--
ALTER TABLE `t_comunity_type`
MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `t_log_activity`
--
ALTER TABLE `t_log_activity`
MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=756;
--
-- AUTO_INCREMENT for table `t_mahasiswa_file`
--
ALTER TABLE `t_mahasiswa_file`
MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_passwordreset`
--
ALTER TABLE `t_passwordreset`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_project_scope_temp`
--
ALTER TABLE `t_project_scope_temp`
MODIFY `tempID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_task`
--
ALTER TABLE `t_task`
MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_task_progress`
--
ALTER TABLE `t_task_progress`
MODIFY `progressID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_type_data`
--
ALTER TABLE `t_type_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
