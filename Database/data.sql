-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 04:44 PM
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
(0, 'Default Building'),
(1, 'Computer Science Building A'),
(2, 'Computer Science Building B'),
(3, 'Engineering Workshop'),
(4, 'Engineering Garage'),
(5, 'Cafeteria');

--
-- Truncate table before insert `comment`
--

TRUNCATE TABLE `comment`;
--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `feedbackID`, `text`, `date`, `ratingPoints`) VALUES
(1, 2, 4, 'Sorry, I was listening to Skrillex on my phone.', '2024-05-01 16:43:38', 0);

--
-- Truncate table before insert `comment_user_rating`
--

TRUNCATE TABLE `comment_user_rating`;
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
-- Truncate table before insert `feedback`
--

TRUNCATE TABLE `feedback`;
--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `userID`, `roomID`, `date`, `modifiedDate`, `urgency`, `resolved`, `closed`, `title`, `text`, `ratingPoints`) VALUES
(1, 2, 10, '2024-05-01 15:05:37', '2024-05-01 16:01:37', '3', 0, 0, 'Someone ate my lunch!!!', 'I cant believe it! Someone\'s gone and taken my Tesco meal deal (£3.40 with clubcard) out of the shared fridge! Im absolutely furious!', 17),
(2, 3, 7, '2024-05-01 15:13:16', '2024-05-01 16:05:40', '1', 1, 1, 'May i have some help please?', 'Hello,\r\n\r\nI was enjoying my Sainsbury\'s Meal Deal (£3.50 with Nectar card) in my usual spot under the car lift when I accidentally lent on the remote and the 1994 Toyota Corolla above me fell right on my head! I\'m now stuck and can\'t quite reach the remote to engage the lift. Would someone in the area mind giving me a hand?', -3),
(3, 1, 9, '2024-05-01 15:23:06', '2024-05-01 16:15:38', '0', 0, 1, 'I think that fellas meal deal was out of date', 'I had a Tesco meal deal (free with communal fridge) for lunch today, and now i\'m feeling a bit iffy. Does anyone have a gaviscon or something I can have? I\'ll be waiting in the mens loo near the mess hall.', 5),
(4, 5, 4, '2024-05-01 15:37:34', '2024-05-01 16:35:34', '2', 1, 0, 'Really annoying noise', 'There is a really annoying noise comming from one of the PCs at the back of the lab. Not sure what is as I was too scared it was going to blow up and left before checking.', 15),
(5, 4, 8, '2024-05-01 15:41:34', '2024-05-01 16:37:36', '1', 1, 1, 'Missing Tools', 'We seem to be missing a fair few tools from the tool cupboard. Could we please refrain from stealing the uni\'s equipment? If you\'re that desperate for tools, there is a B&Q round the corner that I would urge you to steal from instead.', 24);

--
-- Truncate table before insert `feedback_tags`
--

TRUNCATE TABLE `feedback_tags`;
--
-- Truncate table before insert `feedback_user_rating`
--

TRUNCATE TABLE `feedback_user_rating`;
--
-- Truncate table before insert `recovery`
--

TRUNCATE TABLE `recovery`;
--
-- Truncate table before insert `room`
--

TRUNCATE TABLE `room`;
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

INSERT INTO `user` (`userID`, `courseID`, `email`, `username`, `passwordHash`, `fName`, `lName`, `yearOfStudy`, `pronouns`, `position`, `activeAccount`, `sub`, `alert`, `accountDate`) VALUES
(1, 1, '11122233@students.lincoln.ac.uk', 'John_Smith', '$2y$10$OVmvdLRZJ3rwh64o0AKStOJcZG58TY/UXZ1NqWCFBsSSTMagW3xgW', 'John', 'Smith', 2, 'hehim', 'student', 1, 1, 0, '2024-05-01 13:45:07'),
(2, 1, '26357261@students.lincoln.ac.uk', 'Oliver_Smith', '$2y$10$QPf3iCF2jkZ6J/52ho/w9.9y2X9tucyYNJ8FTqQIUTFZRTznD47g6', 'Oliver', 'Smith', 2, 'hehim', 'admin', 1, 1, 0, '2024-05-01 13:45:07'),
(3, 1, '16617508@students.lincoln.ac.uk', 'Earl_Smalley', '$2y$10$4ep5axoX8YQn2OqOuUusruozyW295ccroQBfg87IbnrENqxEyPmZu', 'Earl', 'Smalley', 2, 'hehim', 'admin', 1, 1, 0, '2024-05-01 13:45:07'),
(4, 1, 'jdoe@lincoln.ac.uk', 'John Doe', 'feedtrac', 'John', 'Doe', NULL, 'hehim', 'staff', 1, 1, 0, '2024-05-01 15:34:15'),
(5, 2, 'BDoe@lincoln.ac.uk', 'Billy_Doe', 'feedtrac', 'Billy', 'Doe', 3, '', 'student', 1, 0, 0, '2024-05-01 15:34:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
