-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 10:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_creation`
--

-- --------------------------------------------------------

--
-- Table structure for table `archivevideos`
--

CREATE TABLE `archivevideos` (
  `archive_id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(11) NOT NULL,
  `videoPath` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `courseName` varchar(128) NOT NULL,
  `lessons` int(6) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseId`, `instructor_email`, `courseName`, `lessons`, `description`) VALUES
(13, 'John@example.com', 'Paano mag Palaki ng Talong', 2, 'sdadasd');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_name` varchar(80) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_name`, `email`, `address`, `contact_no`) VALUES
('John', 'John@example.com', 'USA', '09765407546');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `correct_answer`) VALUES
(29, 33, 'Ideal Size of Eggplant', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id`, `question_id`, `choice_text`) VALUES
(109, 29, '4inch'),
(110, 29, '8inch'),
(111, 29, '12inch'),
(112, 29, '16inch');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `timer` int(11) NOT NULL,
  `passing_grade` int(11) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(20) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `num_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `timer`, `passing_grade`, `course_Id`, `lessonNumber`, `instructor_email`, `num_questions`) VALUES
(33, 'Multiple Choice Quiz for Paano mag Palaki ng Talong Lesson 2', 1, 1, 13, 'Lesson 2', 'John@example.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videolessons`
--

CREATE TABLE `videolessons` (
  `videoId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(10) NOT NULL,
  `videoPath` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videolessons`
--

INSERT INTO `videolessons` (`videoId`, `instructor_email`, `course_Id`, `lessonNumber`, `videoPath`) VALUES
(32, 'John@example.com', 13, 'Lesson 1', '../courses/John@example.com/Paano mag Palaki ng Talong/Lesson 1/Talong kong Malaki Vol. 1.mp4'),
(33, 'John@example.com', 13, 'Lesson 2', '../courses/John@example.com/Paano mag Palaki ng Talong/Lesson 2/Talong kong Malaki Vol. 2.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivevideos`
--
ALTER TABLE `archivevideos`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `videoId` (`videoId`,`course_Id`),
  ADD KEY `course_Id` (`course_Id`),
  ADD KEY `instructor_email` (`instructor_email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `instructor_email` (`instructor_email`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_email` (`instructor_email`),
  ADD KEY `courseId` (`course_Id`);

--
-- Indexes for table `videolessons`
--
ALTER TABLE `videolessons`
  ADD PRIMARY KEY (`videoId`),
  ADD KEY `instructor_email` (`instructor_email`,`course_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivevideos`
--
ALTER TABLE `archivevideos`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question_choices`
--
ALTER TABLE `question_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `videolessons`
--
ALTER TABLE `videolessons`
  MODIFY `videoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archivevideos`
--
ALTER TABLE `archivevideos`
  ADD CONSTRAINT `archivevideos_ibfk_1` FOREIGN KEY (`instructor_email`) REFERENCES `instructor` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `archivevideos_ibfk_2` FOREIGN KEY (`course_Id`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `archivevideos_ibfk_3` FOREIGN KEY (`videoId`) REFERENCES `videolessons` (`videoId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `question_choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`instructor_email`) REFERENCES `instructor` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quizzes_ibfk_2` FOREIGN KEY (`course_Id`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
