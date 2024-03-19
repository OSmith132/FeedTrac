-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 07:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedtracdb`
--

--
-- Truncate table before insert `building`
--

TRUNCATE TABLE `building`;
--
-- Truncate table before insert `comments`
--

TRUNCATE TABLE `comments`;
--
-- Truncate table before insert `course`
--

TRUNCATE TABLE `course`;
--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `departmentID`, `name`) VALUES
(0, 0, 'Default Course');

--
-- Truncate table before insert `department`
--

TRUNCATE TABLE `department`;
--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `name`) VALUES
(0, 'Default Department');

--
-- Truncate table before insert `report`
--

TRUNCATE TABLE `report`;
--
-- Truncate table before insert `report_tags`
--

TRUNCATE TABLE `report_tags`;
--
-- Truncate table before insert `room`
--

TRUNCATE TABLE `room`;
--
-- Truncate table before insert `tags`
--

TRUNCATE TABLE `tags`;
--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `courseID`, `email`, `username`, `passwordHash`, `fName`, `lName`, `yearOfStudy`, `pronouns`, `position`) VALUES
(1, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith', '$2y$10$QPf3iCF2jkZ6J/52ho/w9.9y2X9tucyYNJ8FTqQIUTFZRTznD47g6', 'Oliver', 'Smith', 2, 'hehim', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
