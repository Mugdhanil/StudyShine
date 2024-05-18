-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 21, 2024 at 05:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Study@shine1');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `messages` text NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `messages`, `response`) VALUES
(1, 'Hello', 'How can I help you?');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `mail`, `message`) VALUES
(9, 'Demo Demo', 'demo@gmail.com', 'wed'),
(13, 'Demo Demo', 'demo@gmail.com', 'asdasds'),
(14, 'Demo2', 'demo2@gmail.com', 'zcc'),
(15, 'Krishna Thank', 'demo@gmail.com', 'asc');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_desc` varchar(255) NOT NULL,
  `course_author` varchar(255) NOT NULL,
  `course_duration` text NOT NULL,
  `course_img` text NOT NULL,
  `course_original_price` int(11) NOT NULL,
  `course_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `course_author`, `course_duration`, `course_img`, `course_original_price`, `course_price`) VALUES
(3, 'The Complete PHP MYSQL Professional Course with 5 Projects', 'Learn PHP MYSQL by building 5 Projects including PHP Regular Expressions & CMS | Become a Full Stack Back-End Developer.', 'Prof. Khengar', '22', '../images/Course/PHP image.png', 5000, 2999),
(4, 'Data Analyst Skillpath: Zero to Hero in Excel, SQL & Python', 'Begin data analytics by learning Excel, SQL, Python, Analytics &amp; ML concepts from scratch. Must-know for a data analyst.', 'Prof. Patel', '16', '../images/Course/data analytsics.png', 3999, 1599),
(5, 'Learn Ethical Hacking From Scratch', 'Become an ethical hacker that can hack like black hat hackers and secure systems like cybersecurity experts.', 'Prof. Sethi', '15', '../images/Course/ethical.png', 3697, 5499),
(6, 'Flutter Complete Course with Firebase', 'Everything you need to know for building mobile apps with Flutter and Dart, including RxDart and Animations!', 'Stephen Jonas', '31', '../images/Course/flutter2.png', 6999, 4899),
(7, 'Complete C# Unity Game Developer 2D', 'Learn Unity in C# & Code Your First Five 2D Video Games for Web, Mac & PC. The Tutorials Cover Tilemap. Learn how to create video games using Unity.', 'Prof. Das', '10', '../images/Course/unity.png', 3197, 999),
(8, 'Quick Introduction to Postman and API Testing for Beginners', 'Get up to speed with Postman and learn REST API & testing real FAST. You learn 80% of what you need in 20% of the time.', 'Vesco Rama', '6', '../images/Course/postman.png', 999, 499);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_content` text NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` text NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_link` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`, `is_completed`) VALUES
(6, 'Lesson2', 'Lesson desc', '../videos/lessons/lesson4.mp4', 4, 'Data Analyst Skillpath: Zero to Hero in Excel, SQL & Python', 0),
(7, 'Building Blocks of PHP', 'ejkfrkf', '../videos/lessons/l1.mp4', 3, 'The Complete PHP MYSQL Professional Course with 5 Projects', 0),
(8, 'Introduction ', 'How to Install Postman, The HTTP Protocol explained', '../videos/lessons/l5.mp4', 8, 'Quick Introduction to Postman and API Testing for Beginners', 0),
(9, 'Creating requests in Postman', 'Postman Collection and Query Paramaters', '../videos/lessons/l5.mp4', 8, 'Quick Introduction to Postman and API Testing for Beginners', 0),
(10, 'Introduction and Setup', 'Introducing Unity & Set Up Visual Studio Code', '../videos/lessons/l1.mp4', 7, 'Complete C# Unity Game Developer 2D', 0),
(11, 'Delivery Driver', 'Game Design- Delivery Driver, Transform.Translate()', '../videos/lessons/lesson4.mp4', 7, 'Complete C# Unity Game Developer 2D', 0),
(12, 'Introduction, Flutter Setup and Installation', 'What is Flutter? How easy is it to create an app with Flutter?', '../videos/lessons/l1.mp4', 6, 'Flutter Complete Course with Firebase', 0),
(13, 'Firebase Installation for Flutter(Windows)', 'Firebase Installation bug', '../videos/lessons/l1.mp4', 6, 'Flutter Complete Course with Firebase', 0),
(14, 'Course Introduction and Setting Up a Hacking Lab ', 'What Is Hacking & Why Learn It ? Installing Kali Linux as a VM on Windows\r\n', '../videos/lessonsl5.mp4', 5, 'Learn Ethical Hacking From Scratch', 0),
(15, 'Linux Basics', 'Basic Overview of Kali Linux and The Terminal & Linux Commands', '../videos/lessons/l5.mp4', 5, 'Learn Ethical Hacking From Scratch', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `p_date` date NOT NULL,
  `stu_name` text NOT NULL,
  `stu_email` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `p_date`, `stu_name`, `stu_email`, `course_id`, `course_price`) VALUES
(1, '2024-03-28', 'Demo', 'demo@gmail.com', 1, 3999),
(9, '2024-04-13', '   Demo', 'demo@gmail.com', 2, 4499),
(10, '2024-04-13', '   Demo', 'demo@gmail.com', 4, 1599),
(11, '2024-04-17', '     Demo', 'demo@gmail.com', 3, 2999),
(12, '2024-04-17', 'Demo2', 'demo2@gmail.com', 4, 1599),
(13, '2024-04-18', 'Demo2', 'demo2@gmail.com', 3, 2999),
(99, '2024-04-19', 'Foodie', 'foodiestub@gmail.com', 3, 2999),
(103, '2024-04-19', 'Foodie', 'foodiestub@gmail.com', 4, 1599),
(104, '2024-04-19', '     Demo', 'demo@gmail.com', 8, 499),
(105, '2024-04-19', '     Demo', 'demo@gmail.com', 5, 5499),
(106, '2024-04-21', 'Komal Mundhra', 'komalmundhra2000@gmail.com', 4, 1599),
(107, '2024-04-21', 'Komal Mundhra', 'komalmundhra2000@gmail.com', 3, 2999),
(108, '2024-04-21', 'Komal Mundhra', 'komalmundhra2000@gmail.com', 5, 5499);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `p_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `completed_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_pass` varchar(255) NOT NULL,
  `stu_pro` varchar(255) NOT NULL,
  `stu_img` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`, `stu_pass`, `stu_pro`, `stu_img`, `verification_code`, `is_verified`) VALUES
(1, '     Demo', 'demo@gmail.com', 'Demo@12345', '   Student', '../images/faces/face-01.jpg', '', 0),
(17, 'Komal Mundhra', 'komalmundhra2000@gmail.com', 'Qwerty@1234', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
