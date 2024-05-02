-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 11:13 PM
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

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingID`, `buildingName`) VALUES
(0, 'Default Building'),
(1, 'Computer Science Building A'),
(2, 'Computer Science Building B'),
(3, 'Engineering Workshop'),
(4, 'Engineering Garage'),
(5, 'Cafeteria');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `ratingPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `feedbackID`, `text`, `date`, `ratingPoints`) VALUES
(1, 2, 1, 'Sorry, I was listening to Skrillex on my phone.', '2024-05-01 16:43:38', 0),
(2, 6, 1, 'test', '2024-05-02 17:58:51', 0),
(3, 6, 1, 'test', '2024-05-02 17:59:49', 0),
(4, 6, 1, 'testing again', '2024-05-02 18:35:34', 0),
(5, 6, 1, 'I\'m only here for the bants.', '2024-05-02 18:37:39', 0),
(6, 6, 2, 'test', '2024-05-02 18:38:51', 0),
(7, 6, 5, 'hahaha', '2024-05-02 18:43:25', 0),
(8, 6, 9, 'test', '2024-05-02 22:03:03', 0),
(9, 6, 1, 'Toby it works.\r\n', '2024-05-02 22:12:33', 0);

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

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `departmentID`, `name`) VALUES
(0, 0, 'Default Course'),
(1, 1, 'Computer Science'),
(2, 2, 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `name`) VALUES
(0, 'Default Department'),
(1, 'School Of Computer Science'),
(2, 'School Of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `roomID` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedDate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'The last date this feedback was interracted with',
  `urgency` varchar(10) NOT NULL COMMENT 'Low - 0\r\nMedium - 1\r\nHigh - 2\r\nCritical - 3',
  `resolved` tinyint(1) NOT NULL COMMENT 'Unresolved - 0\r\nResolved - 1',
  `closed` tinyint(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `ratingPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `userID`, `roomID`, `date`, `modifiedDate`, `urgency`, `resolved`, `closed`, `title`, `text`, `ratingPoints`) VALUES
(1, 2, 10, '2024-05-01 18:48:32', '2024-05-01 16:01:37', '3', 0, 0, 'Someone ate my lunch!!!', 'I cant believe it! Someone\'s gone and taken my Tesco meal deal (£3.40 with clubcard) out of the shared fridge! Im absolutely furious!', 17),
(2, 3, 7, '2024-05-01 18:48:32', '2024-05-01 16:05:40', '1', 1, 1, 'May i have some help please?', 'Hello,\r\n\r\nI was enjoying my Sainsbury\'s Meal Deal (£3.50 with Nectar card) in my usual spot under the car lift when I accidentally lent on the remote and the 1994 Toyota Corolla above me fell right on my head! I\'m now stuck and can\'t quite reach the remote to engage the lift. Would someone in the area mind giving me a hand?', -3),
(3, 1, 9, '2024-05-01 18:48:32', '2024-05-01 16:15:38', '0', 0, 1, 'I think that fellas meal deal was out of date', 'I had a Tesco meal deal (free with communal fridge) for lunch today, and now i\'m feeling a bit iffy. Does anyone have a gaviscon or something I can have? I\'ll be waiting in the mens loo near the mess hall.', 5),
(4, 5, 4, '2024-05-01 18:48:32', '2024-05-01 16:35:34', '2', 1, 0, 'Really annoying noise', 'There is a really annoying noise comming from one of the PCs at the back of the lab. Not sure what is as I was too scared it was going to blow up and left before checking.', 15),
(5, 4, 8, '2024-05-01 18:48:32', '2024-05-01 16:37:36', '1', 1, 1, 'Missing Tools', 'We seem to be missing a fair few tools from the tool cupboard. Could we please refrain from stealing the uni\'s equipment? If you\'re that desperate for tools, there is a B&Q round the corner that I would urge you to steal from instead.', 24),
(6, 6, 8, '2024-05-01 18:48:32', '0000-00-00 00:00:00', '3', 0, 0, 'test', 'test', 0),
(7, 6, 10, '2024-05-01 18:48:32', '2024-05-01 18:44:23', '2', 0, 0, 'asdasasd', 'asdasdas', 0),
(8, 6, 1, '2024-05-01 00:00:00', '2024-05-01 18:48:55', '1', 0, 0, 'new', 'bew', 0),
(9, 6, 4, '2024-05-01 19:29:33', '2024-05-01 19:29:33', '2', 0, 0, 'afasaf', 'asfasfas', 0),
(10, 6, 4, '2024-05-01 19:29:55', '2024-05-01 19:29:55', '1', 0, 0, 'fhdfh', 'dfhfdh', 0),
(11, 6, 9, '2024-05-01 22:40:57', '2024-05-01 22:40:57', '3', 0, 0, 'new', 'test', 0);

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

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `buildingID`) VALUES
(0, 'Default Room', 0),
(1, 'Lecture Hall 1', 1),
(2, 'Lecture Hall 2', 1),
(3, 'Computer Lab 1', 2),
(4, 'Computer Lab 2', 2),
(5, 'Workshop 1', 3),
(6, 'Storage Cupboard', 3),
(7, 'Vehicle Lift Room', 4),
(8, 'Tool Cupboard', 4),
(9, 'Mess Hall', 5),
(10, 'Kitchen', 5);

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
  `description` varchar(255) DEFAULT NULL,
  `activeAccount` tinyint(1) NOT NULL DEFAULT 1,
  `sub` tinyint(1) NOT NULL DEFAULT 1,
  `alert` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `accountDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='User Information';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `courseID`, `email`, `username`, `passwordHash`, `fName`, `lName`, `yearOfStudy`, `pronouns`, `position`, `description`, `activeAccount`, `sub`, `alert`, `accountDate`) VALUES
(1, 1, '11122233@students.lincoln.ac.uk', 'John_Smith', '$2y$10$OVmvdLRZJ3rwh64o0AKStOJcZG58TY/UXZ1NqWCFBsSSTMagW3xgW', 'John', 'Smith', 2, 'hehim', 'student', NULL, 1, 1, 6, '2024-05-01 13:45:07'),
(2, 1, '26357261@students.lincoln.ac.uk', 'Oliver_Smith', '$2y$10$QPf3iCF2jkZ6J/52ho/w9.9y2X9tucyYNJ8FTqQIUTFZRTznD47g6', 'Oliver', 'Smith', 2, 'hehim', 'admin', NULL, 1, 1, 6, '2024-05-01 13:45:07'),
(3, 1, '16617508@students.lincoln.ac.uk', 'Earl_Smalley', '$2y$10$4ep5axoX8YQn2OqOuUusruozyW295ccroQBfg87IbnrENqxEyPmZu', 'Earl', 'Smalley', 2, 'hehim', 'admin', NULL, 1, 1, 6, '2024-05-01 13:45:07'),
(4, 1, 'jdoe@lincoln.ac.uk', 'John Doe', 'feedtrac', 'John', 'Doe', NULL, 'hehim', 'staff', NULL, 1, 1, 6, '2024-05-01 15:34:15'),
(5, 2, 'BDoe@lincoln.ac.uk', 'Billy_Doe', 'feedtrac', 'Billy', 'Doe', 3, '', 'student', NULL, 1, 0, 0, '2024-05-01 15:34:15'),
(6, 1, 'test@test.com', 'test', '$2y$10$mZMYmL6SN/joN/8Qi/mp/esZVoTvqIACKSUWkil1jzs48pspR2yza', 'test', 'test', 3, 'hehim', 'student', NULL, 1, 1, 5, '2024-05-01 18:33:25');

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
  MODIFY `buildingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
