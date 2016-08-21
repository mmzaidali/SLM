-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 22, 2015 at 11:00 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

-- 
-- Database: `oprs`
-- 
CREATE DATABASE `oprs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `oprs`;

-- --------------------------------------------------------

-- 
-- Table structure for table `academic`
-- 

CREATE TABLE `academic` (
  `idacademic` int(11) NOT NULL auto_increment,
  `fname` varchar(50) NOT NULL,
  `programme` varchar(50) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `coursework` varchar(100) NOT NULL,
  `completion_d` date NOT NULL,
  `commitment` varchar(50) NOT NULL,
  `integrity` varchar(50) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  `work_q` varchar(50) NOT NULL,
  `ability` varchar(50) NOT NULL,
  `attendance` varchar(50) NOT NULL,
  `e_write` varchar(50) NOT NULL,
  `e_speak` varchar(50) NOT NULL,
  `overall` varchar(50) NOT NULL,
  `svName` varchar(50) NOT NULL,
  `date_submit` date NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY  (`idacademic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `academic`
-- 

INSERT INTO `academic` VALUES (1, 'MASLITA BT ABD AZIZ', 'SOFTWARE', 'KEEP IT UP', 'ALL GOOD', '2015-12-26', 'Excellent', 'Excellent', 'Good', 'Excellent', 'Good', 'Excellent', 'Good', 'Excellent', 'Excellent', 'NOR HASLINDA ISMAIL', '2015-12-22', 'PASS');
INSERT INTO `academic` VALUES (2, 'RAJA HUDA BINTI RAJA SEHAR', 'ENTREEPRENEUR', 'ALL GOOD', 'EXCELLENT', '2015-12-25', 'Good', 'Excellent', 'Good', 'Excellent', 'Good', 'Excellent', 'Excellent', 'Good', 'Excellent', 'Nor Haslinda Ismail', '2015-12-26', 'PASS');

-- --------------------------------------------------------

-- 
-- Table structure for table `achievement`
-- 

CREATE TABLE `achievement` (
  `idachievement` int(11) NOT NULL auto_increment,
  `level` varchar(30) NOT NULL,
  `major_course` varchar(70) NOT NULL,
  `college` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `language` varchar(45) NOT NULL,
  `d_start` varchar(17) NOT NULL,
  `d_end` varchar(17) NOT NULL,
  `results` varchar(10) NOT NULL,
  `cgpa` varchar(10) NOT NULL,
  `duration` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `staffNo` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  PRIMARY KEY  (`idachievement`),
  UNIQUE KEY `idachievement_UNIQUE` (`idachievement`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `achievement`
-- 

INSERT INTO `achievement` VALUES (10, 'Master', 'ELECTRIC', 'UTeM', 'MALAYSIA', 'ENGLISH', '2016-01-04', '2016-01-29', 'Passed', '3.5', 4, 'AIDA FAZLIANA BINTI ABDUL KADIR', '00334', 'FKE', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (5, 'Bachelor', 'Networking', 'UiTM Puncak Alam', 'Malaysia', 'English', '1/9/2012', '30/9/2015', 'PASS', '2.99', 36, 'AHMAD AIZAN BIN ZULKEFLE', '00491', 'FKE', 'pensyarah');
INSERT INTO `achievement` VALUES (4, 'PhD', 'Electric & Electronic', 'Universiti Teknologi Malaysia', 'Malaysia', 'English', '1/10/2013', '30/9/2014', 'PASS', '3.21', 12, 'ABDUL RAHIM BIN ABDULLAH', '00345', 'FKE', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (11, 'Degree', 'ENTREPRENEUR', 'UTeM', 'MALAYSIA', 'ENGLISH', '2015-12-01', '2015-12-31', 'Passed', '2.79', 5, 'AMIRUDDIN BIN AHAMAT', '01227', 'FPTT', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (12, 'Master', 'MECHATRONIC', 'UTeM', 'MALAYSIA', 'ENGLISH', '2015-12-02', '2015-12-18', 'Passed', '3', 3, 'MOHD RADUAN BIN KHALIL', '00153', 'FKP', 'penolong jurutera');
INSERT INTO `achievement` VALUES (13, 'PhD', 'multimedia', 'UTeM', 'MALAYSIA', 'ENGLISH', '2015-12-24', '2015-12-24', 'Passed', '3.5', 24, 'AHMAD SHAARIZAN B SHAARANI', '00046', 'FTMK', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (14, 'Master', 'SOFTWARE', 'UTeM', 'MALAYSIA', 'ENGLISH', '2016-02-01', '2016-02-26', 'Passed', '3.69', 4, 'NORZIHANI BT YUSOF', '00071', 'FTMK', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (15, 'PhD', 'ENTREPRENEUR', 'UTeM', 'MALAYSIA', 'ENGLISH', '2015-12-23', '2015-12-19', 'Failed', '3.4', 4, 'NORAIN BINTI ISMAIL', '00287', 'FPTT', 'pensyarah kanan');
INSERT INTO `achievement` VALUES (16, 'PhD', 'multimedia', 'UTeM', 'MALAYSIA', 'ENGLISH', '2015-12-24', '2015-12-24', 'Passed', '3.5', 24, 'AHMAD SHAARIZAN B SHAARANI', '00046', 'FTMK', 'pensyarah kanan');

-- --------------------------------------------------------

-- 
-- Table structure for table `adminuser`
-- 

CREATE TABLE `adminuser` (
  `adminID` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`adminID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `adminuser`
-- 

INSERT INTO `adminuser` VALUES (2, 'Admin', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `children`
-- 

CREATE TABLE `children` (
  `idchildren` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `id_card` bigint(17) NOT NULL,
  `passport_No` varchar(45) default NULL,
  `DOB` varchar(45) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `mom_name` varchar(60) NOT NULL,
  `mom_ic` bigint(17) NOT NULL,
  `age` smallint(5) NOT NULL,
  `birth_place` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `certificate_No` varchar(45) NOT NULL,
  `level_study` varchar(45) default NULL,
  `course` varchar(45) default NULL,
  `d_start` varchar(45) default NULL,
  `d_end` varchar(45) default NULL,
  `college` varchar(45) default NULL,
  `type` varchar(30) default NULL,
  `childPar` varchar(45) NOT NULL,
  `childParNo` varchar(45) NOT NULL,
  PRIMARY KEY  (`idchildren`),
  KEY `id_No_idx` (`childPar`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `children`
-- 

INSERT INTO `children` VALUES (2, 'Nur Ilham', 900303146719, '', '28/5/2015', 'Malaysian', 'Rosmah Binti Mansor', 541001089101, 25, 'HBKT', 'MALE', 'SINGLE', 'J6785011', 'Diploma', 'Interior Design', '8/6/2011', '10/6/2014', 'TwinTech', 'IPTS', 'BURAIRAH B HUSSIN', '00069');

-- --------------------------------------------------------

-- 
-- Table structure for table `cuti`
-- 

CREATE TABLE `cuti` (
  `idleave` int(11) NOT NULL auto_increment,
  `fname` varchar(50) NOT NULL,
  `letterNo` varchar(50) NOT NULL,
  `staffid` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `r_date` date NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  PRIMARY KEY  (`idleave`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `cuti`
-- 

INSERT INTO `cuti` VALUES (1, 'ahmad', '8i3u382', '00046', 'ftmk', 'pensyarah', 'Master', '1500', 'multimedia', 'malaysia', 'MMU', '2015-11-02', '2015-11-03', '2015-11-04');
INSERT INTO `cuti` VALUES (2, 'maslita', 'kjashdiu112', '00047', 'ftmk', 'pensyarah', 'PhD', '2000', 'software', 'malaysia', 'UTeM', '2015-11-25', '2015-11-26', '2015-11-27');
INSERT INTO `cuti` VALUES (3, 'Maslita', '00292KOA01', '00047', 'FTMK', 'PENSYARAH KANAN', 'PhD', '5000', 'SOFTWARE', 'MALAYSIA', 'mmu', '2015-12-02', '2015-12-03', '2015-12-04');
INSERT INTO `cuti` VALUES (4, 'abc', '5RTY6DY6', '00046', 'ftmk', 'LECTURER', 'Master', '1500', 'SOFTWARE', 'MALAYSIA', 'UTeM', '2015-12-03', '2015-12-04', '2015-12-05');

-- --------------------------------------------------------

-- 
-- Table structure for table `marking`
-- 

CREATE TABLE `marking` (
  `idmarking` int(11) NOT NULL auto_increment,
  `staffNo` varchar(45) NOT NULL,
  `chp1_note` varchar(45) NOT NULL,
  `chp1_mark` bigint(10) NOT NULL,
  `chp2_note` varchar(45) NOT NULL,
  `chp2_mark` bigint(10) NOT NULL,
  `chp3_note` varchar(45) NOT NULL,
  `chp3_mark` bigint(10) NOT NULL,
  `chp4_note` varchar(45) NOT NULL,
  `chp4_mark` bigint(10) NOT NULL,
  `chp5_note` varchar(45) NOT NULL,
  `chp5_mark` bigint(10) NOT NULL,
  `chp6_note` varchar(45) NOT NULL,
  `chp6_mark` bigint(10) NOT NULL,
  `comment` varchar(100) NOT NULL,
  PRIMARY KEY  (`idmarking`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `marking`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `offers`
-- 

CREATE TABLE `offers` (
  `idoffers` int(11) NOT NULL auto_increment,
  `staffNo` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `department` text NOT NULL,
  `level` varchar(45) default NULL,
  `field` varchar(45) default NULL,
  `country` varchar(45) default NULL,
  PRIMARY KEY  (`idoffers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `offers`
-- 

INSERT INTO `offers` VALUES (14, '00069', 'BURAIRAH B HUSSIN', 'pengurus', 'FTMK', 'PhD', 'Computer Science', 'India');
INSERT INTO `offers` VALUES (15, '00071', 'NORZIHANI BT YUSOF', 'pensyarah kanan', 'FTMK', 'Degree', 'Electrical', 'Jepun');
INSERT INTO `offers` VALUES (16, '00078', 'ANIZA BT OTHMAN', 'pensyarah', 'FTMK', 'Master', 'Mechatronic', 'German');
INSERT INTO `offers` VALUES (17, '00491', 'AHMAD AIZAN BIN ZULKEFLE', 'pensyarah', 'FKE', 'PhD', 'Mechanical', 'India');
INSERT INTO `offers` VALUES (18, '00148', 'NOOR AZIAN BINTI MAHMOOD', 'setiausaha', 'FKP', 'Master', 'Electrical', 'Local');
INSERT INTO `offers` VALUES (19, '02325', 'RAJA HUDA BINTI RAJA SEHAR', 'pensyarah', 'FPTT', 'Degree', 'Electrical', 'Jepun');
INSERT INTO `offers` VALUES (20, '01491', 'MOHD FAZLI BIN MOHD SAM', 'pensyarah', 'FPTT', 'Master', 'Electrical', 'China');
INSERT INTO `offers` VALUES (21, '00046', 'AHMAD SHAARIZAN B SHAARANI', 'pensyarah kanan', 'FTMK', 'Degree', 'Entrepreneur', 'Jepun');
INSERT INTO `offers` VALUES (22, '00612', 'MOHD SYAKRANI BIN AKHBAR', 'penolong jurutera', 'FKE', 'PhD', 'Mechanical', 'China');
INSERT INTO `offers` VALUES (23, '00612', 'MOHD SYAKRANI BIN AKHBAR', 'penolong jurutera', 'FKE', NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `profile`
-- 

CREATE TABLE `profile` (
  `idprofile` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `id_No` varchar(45) NOT NULL,
  `ic_No` bigint(15) default NULL,
  `passport_No` varchar(15) default NULL,
  `DOB` varchar(20) NOT NULL,
  `birth_place` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `religion` varchar(45) NOT NULL,
  `race` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `division` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `level_user` varchar(45) NOT NULL,
  `photo` longblob,
  PRIMARY KEY  (`idprofile`),
  UNIQUE KEY `idprofile_UNIQUE` (`idprofile`),
  KEY `id_No_idx` (`id_No`),
  KEY `idprofile` (`idprofile`),
  KEY `idprofile_2` (`idprofile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `profile`
-- 

INSERT INTO `profile` VALUES (2, 'AHMAD SHAARIZAN B SHAARANI', 'MR', '00046', 690101145478, NULL, '1/1/1969', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'shaarizan@utem.edu.my', 'ahmad', 'FTMK', 'Interactive Media', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (3, 'MASLITA BT ABD AZIZ', 'DR', '00047', 680314057613, NULL, '14/3/1968', 'HBM', 'FEMALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'maslita@utem.edu.my', 'maslita', 'FTMK', 'Software Development', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (4, 'BURAIRAH B HUSSIN', 'PROFESSOR', '00069', 700228104397, NULL, '28/2/1970', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'burairah@utem.edu.my', 'burairah', 'FTMK', 'Artificial Intelligence', 'pengurus', 'Staff', NULL);
INSERT INTO `profile` VALUES (5, 'NORZIHANI BT YUSOF', 'DR', '00071', 590922047789, NULL, '22/9/1959', 'PENANG', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'norzihani@utem.edu.my', 'norzihani', 'FTMK', 'Artificial Intelligence', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (6, 'ANIZA BT OTHMAN', 'MS', '00078', 830607078913, NULL, '7/6/1983', 'PAHANG', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'aniza@utem.edu.my', 'aniza', 'FTMK', 'Interactive Media', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (11, 'HASAN BIN SALEH', 'MR', '00050', 550101038953, NULL, '1/1/1955', 'TERENGGANU', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'hasansaleh@utem.edu.my', 'hasan', 'FPTT', 'Technology Management', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (12, 'NORAIN BINTI ISMAIL', 'DR', '00287', 701214019953, NULL, '14/12/1970', 'JOHOR', 'FEMALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'norain@utem.edu.my', 'norain', 'FPTT', 'Entreprenuer', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (13, 'AMIRUDDIN BIN AHAMAT', 'DR', '01227', 651125071813, NULL, '25/11/1965', 'PAHANG', 'MALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'amiruddin@utem.edu.my', 'amiruddin', 'FPTT', 'Entreeprenuer', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (14, 'MOHD FAZLI BIN MOHD SAM', 'DR', '01491', 750404145367, NULL, '4/4/1975', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'mohdfazli@utem.edu.my', 'fazli', 'FPTT', 'Technology Management', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (15, 'RAJA HUDA BINTI RAJA SEHAR', 'MS', '02325', 800509119041, NULL, '9/5/1980', 'KEDAH', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'rajahuda@utem.edu.my', 'rajahuda', 'FPTT', 'Technology Management', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (16, 'AIDA FAZLIANA BINTI ABDUL KADIR', 'DR', '00334', 810903017171, NULL, '3/9/1981', 'JOHOR', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'fazliana@utem.edu.my', 'fazliana', 'FKE', 'Power Industrial', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (17, 'ABDUL RAHIM BIN ABDULLAH', 'DR', '00345', 630801146174, NULL, '1/8/1963', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'rahim@utem.edu.my', 'rahim', 'FKE', 'Electronic Engineering', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (18, 'AHMAD AIZAN BIN ZULKEFLE', 'MR', '00491', 850718083201, NULL, '18/7/1985', 'PERAK', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'aizan@utem.edu.my', 'aizan', 'FKE', 'Electronic Engineering', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (19, 'MOHD SYAKRANI BIN AKHBAR', 'MR', '00612', 840329057101, NULL, '29/3/1984', 'PERLIS', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'syakrani@utem.edu.my', 'syakrani', 'FKE', 'Automation & Instrumention', 'penolong jurutera', 'Staff', NULL);
INSERT INTO `profile` VALUES (20, 'NUR HAKIMAH BINTI AB AZIZ', 'MS', '00658', 790417149815, NULL, '17/4/1979', 'SELANGOR', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'hakimah@utem.edu.my', 'hakimah', 'FKE', 'Power Industrial', 'pensyarah', 'Staff', NULL);
INSERT INTO `profile` VALUES (21, 'ZULKEFLEE BIN ABDULLAH', 'MR', '00119', 780606147891, NULL, '6/6/1978', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'zulkeflee@utem.edu.my', 'zulkeflee', 'FKP', 'Manufacture Process', 'pensyarah kanan', 'Staff', NULL);
INSERT INTO `profile` VALUES (22, 'NOOR AZIAN BINTI MAHMOOD', 'MRS', '00148', 690808017612, NULL, '8/8/1969', 'PERAK', 'FEMALE', 'ISLAM', 'MALAY', 'MARRIED', 'MALAYSIAN', 'noorazian@utem.edu.my', 'noorazian', 'FKP', 'Administrative', 'setiausaha', 'Staff', NULL);
INSERT INTO `profile` VALUES (23, 'RAZIFAH BINTI MAT RAIS', 'MS', '00124', 870413016781, NULL, '13/4/1987', 'JOHOR', 'FEMALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'razifah@utem.edu.my', 'razifah', 'FKP', 'Administrative', 'pembantu pentadbiran', 'Staff', NULL);
INSERT INTO `profile` VALUES (24, 'MOHD RADUAN BIN KHALIL', 'MR', '00153', 830919067812, NULL, '19/9/1983', 'NEGERI SEMBILAN', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'raduan@utem.edu.my', 'raduan', 'FKP', 'Technical', 'penolong jurutera', 'Staff', NULL);
INSERT INTO `profile` VALUES (25, 'JEEFFERIE BIN ABD RAZAK', 'MR', '01042', 771010146174, NULL, '10/10/1977', 'HBKL', 'MALE', 'ISLAM', 'MALAY', 'SINGLE', 'MALAYSIAN', 'jeefferie@utem.edu.my', 'jeefferie', 'FKP', 'Engineering Materials', 'pensyarah', 'Staff', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `submission`
-- 

CREATE TABLE `submission` (
  `idsubmission` int(11) NOT NULL auto_increment,
  `fname` varchar(50) NOT NULL,
  `staffid` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `program_c` varchar(10) NOT NULL,
  `date_c` varchar(10) NOT NULL,
  `sem_year` varchar(10) NOT NULL,
  `svName` varchar(50) NOT NULL,
  `subject1` varchar(50) NOT NULL,
  `subject2` varchar(50) NOT NULL,
  `subject3` varchar(50) NOT NULL,
  `code1` varchar(50) NOT NULL,
  `code2` varchar(50) NOT NULL,
  `code3` varchar(50) NOT NULL,
  `credit1` varchar(50) NOT NULL,
  `credit2` varchar(50) NOT NULL,
  `credit3` varchar(50) NOT NULL,
  `grade1` varchar(50) NOT NULL,
  `grade2` varchar(50) NOT NULL,
  `grade3` varchar(50) NOT NULL,
  `submit_date` date NOT NULL,
  PRIMARY KEY  (`idsubmission`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `submission`
-- 

INSERT INTO `submission` VALUES (3, 'asddasd', '00047', 'ftmk', '120', '18', '1/2015', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00');
INSERT INTO `submission` VALUES (4, 'AHMAD SHAARIZAN B SHAARANI', '00046', 'FTMK', '120', '18', '1/2015', 'Hisyammudin Al Amin Bin Ab.Latiff', 'Human Computer Interaction', 'WEB DEVELOPMENT APPLICATION', 'OBJECT ORIENTED PROGRAMMING', 'BITM1212', 'BITU2323', 'BITS1012', '3', '3', '3', 'B+', 'A', 'A-', '2015-12-22');
INSERT INTO `submission` VALUES (5, 'MASLITA BT ABD AZIZ', '00047', 'FTMK', '120', '18', '1/2015', 'Dr Burairah Hussin', 'ARTIFICIAL INTELLIGENCE', 'DATA COMMUNICATION AND NETWORKING', 'INTERNET SECURITY', 'BITI1313', 'BITC2301', 'BITC2121', '3', '3', '3', 'B+', 'A', 'A-', '2015-12-22');
INSERT INTO `submission` VALUES (6, 'RAJA HUDA BINTI RAJA SEHAR', '02325', 'FPTT', '120', '18', '2/2015', 'Mohd Hariz Naim', 'INNOVATION TECHNOLOGY', 'HIGH TECHNOLOGY MARKETING', 'TECHNOPRENEURSHIP', 'BTMI2451', 'BTMI3131', 'BTMI1313', '3', '3', '4', 'A-', 'A-', 'B+', '2015-12-15');
INSERT INTO `submission` VALUES (7, 'RAJA HUDA BINTI RAJA SEHAR', '02325', 'FPTT', '120', '18', '2/2015', 'Nor Haslinda Ismail', 'INNOVATION TECHNOLOGY', 'HIGH TECHNOLOGY MARKETING', 'TECHNOPRENEURSHIP', 'BTMI2451', 'BTMI3131', 'BTMI1313', '6', '6', '6', 'A-', 'A-', 'A-', '2015-12-24');
INSERT INTO `submission` VALUES (8, 'MASLITA BT ABD AZIZ', '00047', 'FTMK', '120', '18', '1/2015', 'Burairah Hussin', 'ARTIFICIAL INTELLIGENCE', 'WEB DEVELOPMENT APPLICATION', 'OBJECT ORIENTED PROGRAMMING', 'BITI1313', 'BTMI3131', 'BITS1012', '6', '6', '6', 'A-', 'A', 'B+', '2015-12-23');

-- --------------------------------------------------------

-- 
-- Table structure for table `svlogin`
-- 

CREATE TABLE `svlogin` (
  `svID` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY  (`svID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `svlogin`
-- 

INSERT INTO `svlogin` VALUES (1, 'haslinda', 'haslinda', 'Nor Haslinda Ismail', 'lynda@utem.edu.my', '019-1234567', 'UTeM', 'Malaysia');
INSERT INTO `svlogin` VALUES (2, 'hariz', 'hariz', 'Mohd Hariz Naim', 'hariz@utem.edu.my', '012345678', 'UTeM', 'Malaysia');
INSERT INTO `svlogin` VALUES (3, 'drburairah', 'burairah', 'Burairah Hussin', 'burairah@utem.edu.my', '012-3456789', 'UTeM', 'Malaysia');
INSERT INTO `svlogin` VALUES (4, 'hisyam', 'hisyam', 'Hisyammudin Al Amin Bin Ab.Latiff', 'hisyam@utem.edu.my', '017-2444476', 'UTeM', 'Malaysia');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_dean`
-- 

CREATE TABLE `tbl_dean` (
  `DeanID` int(11) NOT NULL auto_increment,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `faculty` text NOT NULL,
  PRIMARY KEY  (`DeanID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `tbl_dean`
-- 

INSERT INTO `tbl_dean` VALUES (1, 'deanftmk', 'ftmk', 'ftmk');
INSERT INTO `tbl_dean` VALUES (2, 'deanfkp', 'fkp', 'fkp');
INSERT INTO `tbl_dean` VALUES (3, 'deanfke', 'fke', 'fke');
INSERT INTO `tbl_dean` VALUES (4, 'deanfptt', 'fptt', 'fptt');
INSERT INTO `tbl_dean` VALUES (5, 'deanftk', 'ftk', 'ftk');
INSERT INTO `tbl_dean` VALUES (6, 'deanfkm', 'fkm', 'fkm');
INSERT INTO `tbl_dean` VALUES (7, 'deanfkekk', 'fkekk', 'fkekk');

-- --------------------------------------------------------

-- 
-- Table structure for table `working`
-- 

CREATE TABLE `working` (
  `idworking` int(11) NOT NULL auto_increment,
  `position` varchar(45) NOT NULL,
  `d_start` varchar(20) NOT NULL,
  `d_end` varchar(20) NOT NULL,
  `salary` bigint(10) NOT NULL,
  `reason_leave` varchar(200) default NULL,
  `company` varchar(45) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postcode` bigint(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `region` varchar(20) NOT NULL,
  `workName` varchar(45) NOT NULL,
  `workStaff` varchar(45) NOT NULL,
  PRIMARY KEY  (`idworking`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `working`
-- 

INSERT INTO `working` VALUES (4, 'Kerani Am', '2015-12-14', '2015-12-18', 1300, 'Want to gain new experience', 'Perpustakaan UTeM', 'Jalan Hang Tuah Jaya', 75450, 'Durian Tunggal', 'Melaka', 'HASAN BIN SALEH', '00050');
INSERT INTO `working` VALUES (3, 'Promoter', '2015-12-01', '2015-12-04', 2500, 'Continue study', 'DirectD', 'Subang Jaya', 10000, 'Subang', 'Selangor', 'MOHD RADUAN BIN KHALIL', '00153');

COMMIT;
