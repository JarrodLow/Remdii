-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 04:02 PM
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
(45, 22, 24, 'hi', '2020-07-16 10:45:55', 1),
(46, 22, 24, 'nice to meet u\n', '2020-07-16 10:46:01', 1),
(47, 22, 24, 'aaaa\na\na\na\na\n', '2020-07-16 10:46:18', 1),
(48, 22, 24, '', '2020-07-16 10:46:19', 1),
(49, 22, 24, 'a', '2020-07-16 10:46:22', 1),
(50, 22, 24, 'a', '2020-07-16 10:46:23', 1),
(51, 22, 24, 'a\n', '2020-07-16 10:46:26', 1),
(52, 22, 24, 'sddssds', '2020-07-16 10:46:28', 1),
(53, 24, 47, 'hai pokai', '2020-07-16 11:01:15', 0),
(54, 47, 24, 'diam 7 ', '2020-07-16 11:03:09', 0),
(55, 47, 24, 'go cure\n', '2020-07-16 11:03:15', 0),
(56, 22, 50, 'Hi', '2020-07-19 09:55:31', 1),
(57, 22, 51, '123\n', '2020-07-19 13:43:20', 1),
(58, 22, 51, 'Haha', '2020-07-19 13:53:10', 1);

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
  `profile_image` text NOT NULL,
  `verified` varchar(10) NOT NULL DEFAULT 'false',
  `otp` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `email`, `password`, `user_type`, `profile_image`, `verified`, `otp`) VALUES
(21, 'Lee', 'test@gmail.com', '$2y$10$LJyakkzImrGI3gtTkTqxO.KpsULrGSw5NJdp7SoSVdEhQy4KgaF2u', 'user', 'man.png', 'true', 0),
(22, 'Ming', 'test1@gmail.com', '$2y$10$/1YqjN1S5Bb7ILdu7ov2q.VnKyoPhrhu7kMIYi0J0VtBtc9hZSrDi', 'admin', 'girl.png', 'true', 0),
(23, '123', 'test2@gmail.com', '$2y$10$DzcBB.sv1tPv0uMkb3j3s.yU3HbMHr5TmefdrQ5C98yjC2D4d2bWC', 'user', '2019.03.01-08.13-boundingintocomics-5c7992563a38c.png', 'true', 0),
(24, '1235678', '123@gmail.com', '$2y$10$xINcrfLl0Qw1grguOPB7hu7sbSmimR.vR.H4SaOq7abfsBD4ho3Hq', 'user', 'cat-meme-6.png', 'true', 0),
(47, 'meow', 'meow@meow.com', '$2y$10$vxzG4c0cWfjiGkcBxvfEi.YPKylsi8FzlekcQf1ZwcmVBouqKUwO.', 'admin', '661635534375878675.png', 'true', 0),
(51, 'lengzai', 'whiteboard2508@gmail.com', '$2y$10$4U3bjruDkL2BJDtX7n1KBu6t58vHun1rvc40g45toxkh3/kVo3i5y', 'user', 'images.jpeg', 'true', 347017);

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
(50, 21, '2020-07-13 02:36:58', 'no'),
(51, 36, '2020-07-14 18:20:11', 'no'),
(52, 42, '2020-07-15 03:51:52', 'no'),
(53, 46, '2020-07-15 04:14:44', 'no'),
(54, 24, '2020-07-16 10:35:29', 'no'),
(55, 24, '2020-07-16 10:40:15', 'no'),
(56, 24, '2020-07-16 10:46:35', 'no'),
(57, 24, '2020-07-16 10:53:25', 'no'),
(58, 47, '2020-07-16 10:59:47', 'no'),
(59, 24, '2020-07-16 11:00:22', 'no'),
(60, 47, '2020-07-16 11:01:20', 'no'),
(61, 24, '2020-07-16 11:02:07', 'no'),
(62, 24, '2020-07-16 11:10:16', 'no'),
(63, 48, '2020-07-16 13:25:38', 'no'),
(64, 48, '2020-07-16 13:27:58', 'no'),
(65, 47, '2020-07-16 13:45:08', 'no'),
(66, 48, '2020-07-16 13:48:18', 'no'),
(67, 50, '2020-07-19 13:35:39', 'no'),
(68, 51, '2020-07-19 13:53:18', 'no'),
(69, 51, '2020-07-19 14:00:47', 'no');

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
(9, 24, '123', 11, 'Male', 'allergic rhiniti', 'Yes', '123', '2222', 'yehe', 'Yes', 'No', 'Yes', 'Yes'),
(10, 24, 'GUess what', 11, 'Male', 'allergic rhiniti', 'Yes', 'circle', 'yes', '13', 'No', 'No', 'No', 'No'),
(11, 51, '12', 1, 'Male', 'Noob', 'Yes', 'Haha', 'Meow', '123', 'No', 'No', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_condition`
--

CREATE TABLE `user_condition` (
  `condition_id` int(11) NOT NULL,
  `questionnaire_id` int(11) DEFAULT NULL,
  `condition_image` text NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_condition`
--

INSERT INTO `user_condition` (`condition_id`, `questionnaire_id`, `condition_image`, `upload_time`) VALUES
(8, 0, 'cb4f0b0e78efdc6e08f660445837da3f.jpg', '2020-07-16 10:41:58'),
(9, 0, '77fba3f4ed4e90fadd5eac4ae4faa69f.jpg', '2020-07-16 10:42:13'),
(10, 9, '0028f5e6c0aa8a182edde841c4918533.jpg', '2020-07-16 10:43:45'),
(11, 9, 'tumblr_o1c7vgfmR41r4089mo1_400.jpg', '2020-07-16 10:47:52'),
(12, 9, 'Practical2.txt', '2020-07-16 10:48:33'),
(13, 0, 'images.jpeg', '2020-07-19 13:44:01');

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
-- Indexes for table `user_condition`
--
ALTER TABLE `user_condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_condition`
--
ALTER TABLE `user_condition`
  MODIFY `condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
