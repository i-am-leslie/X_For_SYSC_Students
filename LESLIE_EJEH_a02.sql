
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2024 at 05:40 AM
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
-- Database: `LESLIE_EJEH_syscx`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_address`
--
CREATE DATABASE IF NOT EXISTS LESLIE_EJEH_syscx;
USE LESLIE_EJEH_syscx;

CREATE TABLE `users_address` (
  `student_id` int(10) NOT NULL,
  `street_number` int(5) DEFAULT NULL,
  `street_name` varchar(150) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `province` varchar(2) DEFAULT NULL,
  `postal_vcode` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_address`
--

INSERT INTO `users_address` (`student_id`, `street_number`, `street_name`, `city`, `province`, `postal_vcode`) VALUES
(100134, 11, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100135, NULL, NULL, NULL, NULL, NULL),
(100136, NULL, NULL, NULL, NULL, NULL),
(100137, NULL, NULL, NULL, NULL, NULL),
(100138, NULL, NULL, NULL, NULL, NULL),
(100139, NULL, NULL, NULL, NULL, NULL),
(100140, NULL, NULL, NULL, NULL, NULL),
(100141, NULL, NULL, NULL, NULL, NULL),
(100142, NULL, NULL, NULL, NULL, NULL),
(100143, NULL, NULL, NULL, NULL, NULL),
(100144, 111, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100145, 111, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100146, 111, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100147, NULL, NULL, NULL, NULL, NULL),
(100148, 11, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100149, 33, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100150, NULL, NULL, NULL, NULL, NULL),
(100151, 0, NULL, NULL, NULL, NULL),
(100152, 0, NULL, NULL, NULL, NULL),
(100153, 0, NULL, NULL, NULL, NULL),
(100154, 0, NULL, NULL, NULL, NULL),
(100155, 0, NULL, NULL, NULL, NULL),
(100156, 0, NULL, NULL, NULL, NULL),
(100157, 0, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100158, 0, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100159, 0, NULL, NULL, NULL, NULL),
(100160, 0, 'colonel ', 'ottawa', 'on', 'k1s 5b6'),
(100161, 0, NULL, NULL, NULL, NULL),
(100162, 0, NULL, NULL, NULL, NULL),
(100163, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_avatar`
--

CREATE TABLE `users_avatar` (
  `student_id` int(10) NOT NULL,
  `avatar` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_avatar`
--

INSERT INTO `users_avatar` (`student_id`, `avatar`) VALUES
(100133, NULL),
(100134, 4),
(100135, NULL),
(100136, NULL),
(100137, NULL),
(100138, NULL),
(100139, NULL),
(100140, NULL),
(100141, NULL),
(100142, NULL),
(100143, NULL),
(100144, 1),
(100145, 1),
(100146, 1),
(100147, NULL),
(100148, 0),
(100149, 1),
(100150, NULL),
(100151, NULL),
(100152, NULL),
(100153, NULL),
(100154, NULL),
(100155, NULL),
(100156, NULL),
(100157, 1),
(100158, 2),
(100159, NULL),
(100160, 1),
(100161, NULL),
(100162, NULL),
(100163, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `student_id` int(10) NOT NULL,
  `student_email` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`student_id`, `student_email`, `first_name`, `last_name`, `dob`) VALUES
(100132, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-13'),
(100133, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-13'),
(100134, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejehllleee', '2024-03-20'),
(100135, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-05'),
(100136, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-20'),
(100137, 'ejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-26'),
(100138, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-28'),
(100139, 'ejeh@cmail.carleton.ca', 'John', 'ejeh', '2024-04-02'),
(100140, 'ejeh@cmail.carleton.ca', 'll', 'ejeh', '2024-04-02'),
(100141, 'leslieejeh@cmail.carleton.ca', 'bbbb', 'ejeh', '2024-03-28'),
(100142, 'ieejeh@cmail.carleton.ca', 'Leslie', 'ejeh', '2024-03-20'),
(100143, 'ieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-13'),
(100144, '', 'ejeh', 'ww', '2024-03-27'),
(100145, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-04-03'),
(100146, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'ejeh', '2024-03-06'),
(100147, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'ejeh', '2024-03-12'),
(100148, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-05'),
(100149, 'ejeh@cmail.carleton.ca', 'Leslie', 'ww', '2024-02-28'),
(100150, 'ejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-13'),
(100151, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-06'),
(100152, 'leslieejeh@cmail.carleton.ca', 'charles', 'Ejeh', '2024-03-06'),
(100153, 'ejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-13'),
(100154, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-02-28'),
(100155, 'ejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-06'),
(100156, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-06'),
(100157, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-05'),
(100158, 'ejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-05'),
(100159, 'leslieejeh@cmail.carleton.ca', 'www', 'ww', '2024-03-19'),
(100160, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'ejeh', '2024-03-13'),
(100161, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-06'),
(100162, 'leslieejeh@cmail.carleton.ca', 'Leslie', 'Ejeh', '2024-03-05'),
(100163, 'ejeh@cmail.carleton.ca', 'www', 'Ejeh', '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `users_posts`
--

CREATE TABLE `users_posts` (
  `post_id` int(11) NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `new_post` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_posts`
--

INSERT INTO `users_posts` (`post_id`, `student_id`, `new_post`, `post_date`) VALUES
(1, 100134, 'what is happening?! (max character 200)qssdsd', '2024-03-25 19:33:11'),
(2, 100134, 'what is happening?! (max character 200dddddd', '2024-03-25 19:33:33'),
(3, 100134, 'lests go', '2024-03-25 19:34:07'),
(4, 100153, 'wHATS up  ', '2024-03-25 23:20:33'),
(5, 100153, 'lets gooo it works ', '2024-03-25 23:20:50'),
(6, 100154, 'lets go', '2024-03-25 23:28:58'),
(7, 100154, 'lettss ggiooo', '2024-03-25 23:51:27'),
(8, 100157, 'lets stop therer', '2024-03-26 02:09:10'),
(9, 100160, '', '2024-03-26 02:23:03'),
(10, 100163, 'pppppppplkomkmkm', '2024-03-26 21:09:49'),
(11, 100163, 'jnj j j jj ', '2024-03-26 21:09:53'),
(12, 100163, '333', '2024-03-26 21:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `users_program`
--

CREATE TABLE `users_program` (
  `student_id` int(10) NOT NULL,
  `Program` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_program`
--

INSERT INTO `users_program` (`student_id`, `Program`) VALUES
(100132, 'Communications Engineering'),
(100133, 'Communications Engineering'),
(100134, 'Electrical Engineering'),
(100135, 'Software Engineering'),
(100136, 'Communications Engineering'),
(100137, 'Electrical Engineering'),
(100138, 'Software Engineering'),
(100139, 'Software Engineering'),
(100140, 'Communications Engineering'),
(100141, 'Biomedical and Electrical'),
(100142, 'Electrical Engineering'),
(100143, 'Communications Engineering'),
(100144, 'Software Engineering'),
(100145, 'Software Engineering'),
(100146, 'Software Engineering'),
(100147, 'Software Engineering'),
(100148, 'Software Engineering'),
(100149, 'Communications Engineering'),
(100150, 'Software Engineering'),
(100151, 'Software Engineering'),
(100152, 'Communications Engineering'),
(100153, 'Communications Engineering'),
(100154, 'Software Engineering'),
(100155, 'Software Engineering'),
(100156, 'Communications Engineering'),
(100157, 'Communications Engineering'),
(100158, 'Computer Systems Engineering'),
(100159, 'Communications Engineering'),
(100160, 'Communications Engineering'),
(100161, 'Communications Engineering'),
(100162, 'Communications Engineering'),
(100163, 'Communications Engineering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_address`
--
ALTER TABLE `users_address`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users_avatar`
--
ALTER TABLE `users_avatar`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users_program`
--
ALTER TABLE `users_program`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100164;

--
-- AUTO_INCREMENT for table `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_address`
--
ALTER TABLE `users_address`
  ADD CONSTRAINT `users_address_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users_info` (`student_id`);

--
-- Constraints for table `users_avatar`
--
ALTER TABLE `users_avatar`
  ADD CONSTRAINT `users_avatar_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users_info` (`student_id`);

--
-- Constraints for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD CONSTRAINT `users_posts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users_info` (`student_id`);

--
-- Constraints for table `users_program`
--
ALTER TABLE `users_program`
  ADD CONSTRAINT `users_program_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users_info` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
