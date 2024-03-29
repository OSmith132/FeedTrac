-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 01:32 PM
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
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingID`, `buildingName`) VALUES
(0, 'Default Building');

--
-- Truncate table before insert `course`
--

TRUNCATE TABLE `course`;
--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `departmentID`, `name`) VALUES
(0, 0, 'Default Course'),
(1, 1, 'Computer Science'),
(2, 2, 'Engineering');

--
-- Truncate table before insert `department`
--

TRUNCATE TABLE `department`;
--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `name`) VALUES
(0, 'Default Department'),
(1, 'School Of Computer Science'),
(2, 'School Of Engineering');

--
-- Truncate table before insert `room`
--

TRUNCATE TABLE `room`;
--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `buildingID`) VALUES
(0, 'Default Room', 0);

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
(1, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith', '$2y$10$QPf3iCF2jkZ6J/52ho/w9.9y2X9tucyYNJ8FTqQIUTFZRTznD47g6', 'Oliver', 'Smith', 2, 'hehim', 'admin'),
(2, 0, '1234@gmail.com', 'Oliver_Smith', 'feedtrac', 'Oliver', 'Smith', 4, 'hehim', 'Admin'),
(3, 0, '26357261@students.lincoln.ac.uk', 'Oliver_smith_2', '$2y$10$llceTeX.qiz7f5/yLhe/o.nR3ctP43hStF949L/tZCG8x/8zEfEp2', 'Oliver', 'Smith', 3, 'sheher', 'student'),
(4, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith_3', '$2y$10$KJFCq.qNYcjbrR6mrbAL2u9Ib7G0GxeBYHImUTF/lwwuQuqgGsWG2', 'Oliver', 'Smith', 4, 'sheher', 'staff'),
(5, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith_3', '$2y$10$3w90ThloObWAwgSh8doQyODfWpQBSWKccDu2hlVjHlgcA4rAFBnca', 'Oliver', 'Smith', 4, 'sheher', 'staff'),
(6, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith_4', '$2y$10$LGqPKXSPr/LSagioSOwBjeFo8Gb8QegqTdv.04zuwEkdKMINLvLv.', 'Oliver', 'Smith', 1, 'hehim', 'student'),
(7, 0, '26357261@students.lincoln.ac.uk', 'Oliver_Smith_5', '$2y$10$VdvqDP5xUCYbS53kQpi9SuljKxxKz2VbGIpJ4tFWSZIMAXiNlxTfC', 'oliver', 'smith', 1, 'hehim', 'student'),
(8, 0, 'svaztcfhjgizxotjjc@cwmxc.com', 'Oliver_Smith_6', '$2y$10$PDqYTkGVP/gVMIvoQHbqsOcTJA9rPmutMgXLXHGFYFPp6RCZ7A1f6', 'Oliver', 'Smith', 4, 'sheher', 'student'),
(9, 2, 'ikvrpxmsdaxdcihttg@cazlq.com', 'Oliver_Smith_7', '$2y$10$F1W5Bh2eXkqXGrFfqRQ/KOO68S/KVGoGREaeTVS3QFIx2/urYws1W', 'Oliver', 'Smith', 1, 'hehim', 'student');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
