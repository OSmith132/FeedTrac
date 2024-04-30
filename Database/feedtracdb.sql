-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 10:31 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `buildingID` int(10) UNSIGNED NOT NULL,
  `buildingName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `ratingPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_user_rating`
--

CREATE TABLE `comment_user_rating` (
  `commentID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `positiveRating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(10) UNSIGNED NOT NULL,
  `departmentID` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `roomID` int(10) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `urgency` varchar(10) NOT NULL COMMENT 'Low - 0\r\nMedium - 1\r\nHigh - 2\r\nCritical - 3',
  `resolved` tinyint(1) NOT NULL COMMENT 'Unresolved - 0\r\nResolved - 1\r\nResolved and closed = 2\r\nForce closed - 3',
  `closed` tinyint(1) NOT NULL,
  `title` varchar(30) NOT NULL,
  `text` varchar(500) NOT NULL,
  `ratingPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tags`
--

CREATE TABLE `feedback_tags` (
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `tagID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_user_rating`
--

CREATE TABLE `feedback_user_rating` (
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `positiveRating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recovery`
--

CREATE TABLE `recovery` (
  `userID` int(10) UNSIGNED NOT NULL,
  `token` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(10) UNSIGNED NOT NULL,
  `roomName` varchar(50) NOT NULL,
  `buildingID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagID` int(10) UNSIGNED NOT NULL,
  `tagName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tags for feedback';

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) UNSIGNED NOT NULL,
  `courseID` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `fName` varchar(25) NOT NULL,
  `lName` varchar(25) NOT NULL,
  `yearOfStudy` tinyint(10) UNSIGNED DEFAULT NULL,
  `pronouns` varchar(10) DEFAULT NULL,
  `position` varchar(25) NOT NULL,
  `description` varchar(255),
  `activeAccount` tinyint(1) NOT NULL DEFAULT 1

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='User Information';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`buildingID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `Comments_Feedback` (`feedbackID`),
  ADD KEY `Comments_User` (`userID`);

--
-- Indexes for table `comment_user_rating`
--
ALTER TABLE `comment_user_rating`
  ADD PRIMARY KEY (`commentID`,`userID`),
  ADD KEY `Rating_User_Comment` (`userID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`),
  ADD KEY `Course_Department` (`departmentID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `Feedback_Room` (`roomID`) USING BTREE,
  ADD KEY `Feedback_User` (`userID`) USING BTREE;

--
-- Indexes for table `feedback_tags`
--
ALTER TABLE `feedback_tags`
  ADD PRIMARY KEY (`feedbackID`,`tagID`),
  ADD KEY `Tags_Feedback` (`tagID`);

--
-- Indexes for table `feedback_user_rating`
--
ALTER TABLE `feedback_user_rating`
  ADD PRIMARY KEY (`feedbackID`,`userID`),
  ADD KEY `Rating_User_Feedback` (`userID`);

--
-- Indexes for table `recovery`
--
ALTER TABLE `recovery`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`),
  ADD KEY `Room_Building` (`buildingID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `User_Course` (`courseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `buildingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comments_Feedback` FOREIGN KEY (`feedbackID`) REFERENCES `feedback` (`feedbackID`),
  ADD CONSTRAINT `Comments_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `comment_user_rating`
--
ALTER TABLE `comment_user_rating`
  ADD CONSTRAINT `Rating_Comment` FOREIGN KEY (`commentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `Rating_User_Comment` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `Course_Department` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `Feedback_Room` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`),
  ADD CONSTRAINT `Feedback_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `feedback_tags`
--
ALTER TABLE `feedback_tags`
  ADD CONSTRAINT `Feedback_Tags` FOREIGN KEY (`feedbackID`) REFERENCES `feedback` (`feedbackID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tags_Feedback` FOREIGN KEY (`tagID`) REFERENCES `tags` (`tagID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_user_rating`
--
ALTER TABLE `feedback_user_rating`
  ADD CONSTRAINT `Rating_Feedback` FOREIGN KEY (`feedbackID`) REFERENCES `feedback` (`feedbackID`),
  ADD CONSTRAINT `Rating_User_Feedback` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `recovery`
--
ALTER TABLE `recovery`
  ADD CONSTRAINT `Recovery_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `Room_Building` FOREIGN KEY (`buildingID`) REFERENCES `building` (`buildingID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_Course` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
