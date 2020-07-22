-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 12:40 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remdiichat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(43, 23, 22, 'test message', '2020-07-12 17:46:08', 0),
(44, 22, 23, '213', '2020-07-12 17:48:26', 0),
(45, 22, 25, 'test pokai', '2020-07-13 07:33:57', 1),
(46, 23, 22, 'pi\\oi', '2020-07-14 10:38:13', 1),
(47, 28, 22, 'meow', '2020-07-14 10:38:22', 1),
(48, 21, 22, 'hahah', '2020-07-14 10:38:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `text`) VALUES
(1, 'image-analysis.png', 'u'),
(2, 'image-analysis.png', 'asd'),
(3, 'image-analysis.png', 'asd'),
(4, 'image-analysis.png', 'asd'),
(5, '2019.03.01-08.13-boundingintocomics-5c7992563a38c.png', 'test'),
(6, '1594558992-2019.03.01-08.13-boundingintocomics-5c7992563a38c.png', '465'),
(7, '1594559104-2019.03.01-08.13-boundingintocomics-5c7992563a38c.png', '465'),
(8, '1594559106-2019.03.01-08.13-boundingintocomics-5c7992563a38c.png', '465'),
(9, '1594562140-image-analysis.png', '413431');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('user','admin') NOT NULL,
  `profile_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `email`, `password`, `user_type`, `profile_image`) VALUES
(21, 'Lee', 'test@gmail.com', '$2y$10$LJyakkzImrGI3gtTkTqxO.KpsULrGSw5NJdp7SoSVdEhQy4KgaF2u', 'user', 'man.png'),
(22, 'Ming', 'test1@gmail.com', '$2y$10$/1YqjN1S5Bb7ILdu7ov2q.VnKyoPhrhu7kMIYi0J0VtBtc9hZSrDi', 'admin', 'cb4f0b0e78efdc6e08f660445837da3f.jpg'),
(23, '123', 'test2@gmail.com', '$2y$10$DzcBB.sv1tPv0uMkb3j3s.yU3HbMHr5TmefdrQ5C98yjC2D4d2bWC', 'user', '2019.03.01-08.13-boundingintocomics-5c7992563a38c.png'),
(24, '123', 'asd@gmail.com', '$2y$10$Q0LGxBN2IObXUPaS2IouD.dwyo7zz53BWq5mgzgc8L.ybgCpTJihm', 'user', '10c9ebd1d1de575796c284c58aac9c44.jpg'),
(28, 'Meow', 'whiteboard2508@gmail.com', '$2y$10$BxE6AwKX/k86UP2GLjIjpuyg8xsHC4s/5Vfa1TY6.owqw081s3jz.', 'user', 'tumblr_o1c7vgfmR41r4089mo1_400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(43, 21, '2020-07-12 16:39:26', 'no'),
(44, 21, '2020-07-12 16:41:01', 'no'),
(45, 21, '2020-07-12 16:42:01', 'no'),
(46, 22, '2020-07-12 17:43:31', 'no'),
(47, 23, '2020-07-12 17:49:12', 'no'),
(48, 22, '2020-07-12 17:43:56', 'no'),
(49, 22, '2020-07-12 17:49:49', 'no'),
(50, 24, '2020-07-13 03:22:49', 'no'),
(51, 24, '2020-07-13 03:28:06', 'no'),
(52, 25, '2020-07-13 07:36:57', 'no'),
(53, 26, '2020-07-13 15:03:41', 'no'),
(54, 25, '2020-07-14 04:28:54', 'no'),
(55, 27, '2020-07-14 04:40:43', 'no'),
(56, 27, '2020-07-14 05:24:34', 'no'),
(57, 27, '2020-07-14 05:45:21', 'no'),
(58, 27, '2020-07-14 05:45:35', 'no'),
(59, 28, '2020-07-14 05:54:28', 'no'),
(60, 28, '2020-07-14 06:18:48', 'no'),
(61, 28, '2020-07-14 06:26:53', 'no'),
(62, 28, '2020-07-14 06:30:13', 'no'),
(63, 28, '2020-07-14 06:30:34', 'no'),
(64, 28, '2020-07-14 06:32:19', 'no'),
(65, 28, '2020-07-14 06:38:37', 'no'),
(66, 28, '2020-07-14 06:40:07', 'no'),
(67, 24, '2020-07-14 06:41:44', 'no'),
(68, 28, '2020-07-14 06:54:56', 'no'),
(69, 28, '2020-07-14 06:55:49', 'no'),
(70, 28, '2020-07-14 06:55:58', 'no'),
(71, 28, '2020-07-14 06:56:27', 'no'),
(72, 28, '2020-07-14 06:56:43', 'no'),
(73, 28, '2020-07-14 06:56:51', 'no'),
(74, 28, '2020-07-14 06:58:33', 'no'),
(75, 28, '2020-07-14 06:59:26', 'no'),
(76, 28, '2020-07-14 07:22:06', 'no'),
(77, 22, '2020-07-14 10:34:28', 'no'),
(78, 28, '2020-07-14 10:36:33', 'no'),
(79, 28, '2020-07-14 10:36:43', 'no'),
(80, 28, '2020-07-14 10:36:58', 'no'),
(81, 28, '2020-07-14 10:37:13', 'no'),
(82, 28, '2020-07-14 10:37:33', 'no'),
(83, 22, '2020-07-14 10:38:35', 'no'),
(84, 22, '2020-07-14 10:40:39', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `questionnaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question1` varchar(200) NOT NULL,
  `question2` int(11) NOT NULL,
  `question3` enum('Male','Female') NOT NULL,
  `question4` varchar(500) NOT NULL,
  `question5` enum('Yes','No') NOT NULL,
  `question6` varchar(500) NOT NULL,
  `question7` varchar(500) NOT NULL,
  `question8` varchar(500) NOT NULL,
  `question9` enum('Yes','No') NOT NULL,
  `question10` enum('Yes','No') NOT NULL,
  `question11` enum('Yes','No') NOT NULL,
  `question12` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaire_id`, `user_id`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`) VALUES
(4, 6, '123', 11, 'Female', '213', 'No', 'yes', 'sss', 'sadssdasd', 'No', 'Yes', 'Yes', 'No'),
(5, 24, 'HAHHA', 12, 'Female', 'no', 'Yes', 'yes', 'yes', 'meow', 'Yes', 'No', 'No', 'Yes'),
(7, 25, 'HAHHA', 34, 'Male', 'no', 'Yes', 'yes', 'NO', 'HAHA', 'Yes', 'No', 'Yes', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`questionnaire_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
