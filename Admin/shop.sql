-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 02:16 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `date`, `item_id`, `user_id`) VALUES
(1, 'good', '1', '2018-04-18 01:30:27', 12, 50),
(2, 'fdnfnfdn', '1', '2018-04-18 19:00:29', 17, 57),
(3, 'wow', '1', '2018-04-18 01:30:12', 17, 57),
(4, 'yeah', '1', '2018-04-18 01:30:14', 17, 57),
(5, 'oh', '1', '2018-04-18 01:30:15', 17, 57),
(6, 'great yeah', '1', '2018-04-18 19:08:17', 17, 57),
(7, 'Comment', '0', '2018-04-17 22:01:43', 25, 105),
(8, 'Comment', '0', '2018-04-17 22:02:08', 25, 105),
(9, 'Comment', '0', '2018-04-17 22:02:15', 25, 105),
(10, 'Comment', '0', '2018-04-17 22:02:59', 25, 105),
(11, 'oh great baby', '0', '2018-04-17 22:04:02', 25, 105),
(12, 'pretty', '1', '2018-04-18 19:08:22', 24, 105),
(13, 'heloo', '1', '2018-04-18 01:31:33', 12, 50),
(14, 'fjfhdn', '1', '2018-04-18 01:31:35', 12, 50),
(15, 'fcjfgc', '0', '2018-04-18 01:31:49', 16, 50),
(17, 'great', '0', '2018-04-18 02:53:32', 33, 105),
(18, 'great', '0', '2018-04-18 02:55:31', 33, 105),
(19, 'nice', '0', '2018-04-18 02:55:48', 33, 105),
(20, 'wow', '0', '2018-04-18 02:56:33', 12, 105),
(21, 'wow', '0', '2018-04-18 02:57:14', 12, 105),
(22, 'yeah, that&#39;s i was looking for it.', '0', '2018-04-18 02:57:45', 12, 105),
(23, 'yeah, that&#39;s i was looking for it.', '0', '2018-04-18 02:59:50', 12, 105),
(24, 'bye', '0', '2018-04-18 03:02:05', 12, 105),
(28, 'sdb', '0', '2018-04-18 14:30:27', 31, 105),
(29, 'sdb', '1', '2018-04-18 14:42:36', 31, 105),
(30, 'asbd', '0', '2018-04-18 14:31:05', 31, 105),
(31, 'asbd', '0', '2018-04-18 14:31:20', 31, 105),
(32, 'ssv', '1', '2018-04-18 14:31:53', 31, 105),
(33, 'ssv', '0', '2018-04-18 14:31:59', 31, 105),
(34, 'ssv', '0', '2018-04-18 14:32:15', 31, 105),
(35, 'sdb', '0', '2018-04-18 14:32:18', 31, 105),
(36, 'sdb', '0', '2018-04-18 14:34:20', 31, 105),
(37, 'dfn', '0', '2018-04-18 14:34:22', 31, 105),
(38, 'fdn', '0', '2018-04-18 14:34:29', 31, 105),
(39, 'db', '1', '2018-04-18 14:35:04', 31, 105),
(40, 'db', '0', '2018-04-18 14:35:09', 31, 105),
(41, 'db', '0', '2018-04-18 14:35:41', 31, 105),
(42, 'sdb', '0', '2018-04-18 14:35:43', 31, 105),
(43, 'cccccccccccccccc', '1', '2018-04-18 14:36:02', 31, 105),
(44, 'cccccccccccccccc', '0', '2018-04-18 14:36:06', 31, 105),
(45, 'cccccccccccccccc', '0', '2018-04-18 14:39:46', 31, 105),
(46, 'sdb', '0', '2018-04-18 14:39:48', 31, 105),
(47, 'sdb', '0', '2018-04-18 14:40:33', 31, 105),
(48, 'sdb', '0', '2018-04-18 14:40:36', 31, 105),
(49, 'sdb', '0', '2018-04-18 14:40:41', 31, 105),
(50, 'sdb', '0', '2018-04-18 14:40:45', 31, 105),
(51, 'sdb', '0', '2018-04-18 14:42:13', 31, 105),
(52, 'sb', '0', '2018-04-18 14:42:19', 31, 105),
(53, 'sb', '0', '2018-04-18 14:42:40', 31, 105),
(54, 'sb', '0', '2018-04-18 14:44:00', 31, 105),
(55, 'fd', '0', '2018-04-18 14:44:12', 31, 105),
(56, 'fd', '0', '2018-04-18 14:44:57', 31, 105),
(57, 'fd', '0', '2018-04-18 14:46:42', 31, 105),
(58, 'fd', '0', '2018-04-18 14:47:56', 31, 105),
(59, 'dbds', '0', '2018-04-18 14:51:11', 31, 105),
(60, 'ds', '0', '2018-04-18 14:51:18', 18, 105),
(61, 'dsb', '0', '2018-04-18 14:51:21', 18, 105),
(62, 'dsb', '0', '2018-04-18 14:53:38', 18, 105),
(63, 'dv', '0', '2018-04-18 14:53:42', 18, 105),
(64, 'dv', '0', '2018-04-18 14:54:39', 18, 105),
(65, 'sdb', '0', '2018-04-18 14:54:42', 18, 105),
(66, 'sdb', '0', '2018-04-18 14:56:10', 18, 105),
(67, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '1', '2018-04-18 14:57:48', 18, 105),
(68, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 14:57:51', 18, 105),
(69, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:00:06', 18, 105),
(70, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:00:17', 18, 105),
(71, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:01:47', 18, 105),
(72, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:03:14', 18, 105),
(73, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:03:24', 18, 105),
(74, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:05:26', 18, 105),
(75, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:05:33', 18, 105),
(76, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:05:44', 18, 105),
(77, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:06:07', 18, 105),
(78, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbb', '0', '2018-04-18 15:07:45', 18, 105),
(79, 'sdb', '0', '2018-04-18 15:10:13', 18, 105),
(80, 'dsb', '0', '2018-04-18 18:57:05', 30, 105),
(81, 'dsb', '0', '2018-04-18 18:57:31', 30, 105),
(82, 'dsb', '0', '2018-04-18 18:58:11', 30, 105),
(83, 'dsb', '0', '2018-04-18 18:58:49', 30, 105),
(84, 'dsb', '0', '2018-04-18 19:08:26', 30, 105),
(85, 'zzzzzz', '1', '2018-04-18 19:08:49', 30, 105),
(86, 'zzzzzz', '0', '2018-04-18 19:08:52', 30, 105),
(99, 'good', '1', '2018-04-20 01:04:16', 40, 105),
(100, 'wow', '1', '2018-04-20 01:04:38', 40, 105),
(101, 'ds', '0', '2018-04-20 20:13:37', 51, 50),
(102, 'j;', '0', '2018-04-20 20:17:05', 51, 50),
(103, 'sdb', '0', '2018-04-20 20:17:09', 51, 50),
(104, 'sdb', '0', '2018-04-20 20:17:13', 51, 50),
(105, 'ds', '0', '2018-04-20 20:21:31', 51, 50),
(106, 'dsb', '1', '2018-04-20 20:31:03', 51, 50);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 NOT NULL,
  `country_made` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(25) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `rating` smallint(6) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `sec_id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `country_made`, `description`, `image`, `status`, `date`, `rating`, `approve`, `sec_id`, `members_id`, `tags`) VALUES
(12, 'speakers', '15', 'china', 'dsdb', '', '2', '2018-04-15', 0, 1, 5, 50, ''),
(13, 'mic', '15', 'china', 'ds', '', '1', '2018-04-15', 0, 0, 6, 50, ''),
(14, 'Desktop', '200$', 'USA', 'Desktop is larger than tablet', '', '1', '2018-04-15', 0, 1, 5, 50, ''),
(15, 'Tablets ', '150$', 'china', 'Tablets is great devises', '', '2', '2018-04-15', 0, 1, 5, 50, ''),
(16, 'laptop', '300$', 'USA', 'laptop is  great devises', '', '1', '2018-04-15', 0, 0, 5, 50, ''),
(17, 'mic', '150$', 'china', 'dssdb', '', '1', '2018-04-16', 0, 0, 5, 57, ''),
(18, 'shop', '200$', 'china', 'computers is so good thing', '', '1', '2018-04-16', 0, 1, 7, 57, ''),
(19, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(20, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(21, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 1, 5, 105, ''),
(22, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(23, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(24, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(25, 'mouse', '14', 'chian', 'mouse new for you', '', '1', '2018-04-17', 0, 0, 5, 105, ''),
(26, 'mobile', '200', 'chian', 'moblie is samung s7 edge ', '', '', '2018-04-18', 0, 0, 6, 124, ''),
(27, 'mobile', '200', 'chian', 'moblie is samung s7 edge ', '', '', '2018-04-18', 0, 0, 6, 124, ''),
(28, 'mobile', '200', 'chian', 'moblie is samung s7 edge ', '', '', '2018-04-18', 0, 0, 6, 124, ''),
(29, 'mobile', '200', 'chian', 'moblie is samung s7 edge ', '', '', '2018-04-18', 0, 0, 6, 124, ''),
(30, 'tablet', '15', 'dbb', 'dvsdbsdbsdbsd', '', '', '2018-04-18', 0, 1, 5, 124, ''),
(31, 'great', '200', 'chian', 'moblie is samung s7 edge ', '', '', '2018-04-18', 0, 1, 6, 124, ''),
(32, 'Egypt', '500', 'Egypt', 'Egypt god country', '', '1', '2018-04-18', 0, 1, 5, 124, ''),
(33, 'mobile', '15', 'chian', 'moblie is samung s7 edge ', '', 'New', '2018-04-18', 0, 0, 6, 124, ''),
(34, 'mobile', '10', 'chian', 'moblie is samung s7 edge ', '', 'Used', '2018-04-18', 0, 1, 5, 105, ''),
(35, 'mobile', '200', 'Egypt', 'moblie is samung s7 edge ', '', '0', '2018-04-19', 0, 1, 5, 105, ''),
(36, 'phone', '500', 'Egypt', 's8 smasung and so on ....', '', 'New', '2018-04-19', 0, 1, 6, 105, ''),
(37, 'rrrrrrrrrrrrrrr', '150', 'ddd', 'rrrrrrrrrrrrrrrrrrrrrrrrrrr', '', 'New', '2018-04-19', 0, 1, 5, 105, ''),
(38, 'loaa', '10', 'chian', 'moblie is samung s7 edge ', '', 'New', '2018-04-19', 0, 1, 5, 105, ''),
(39, 'mobile', '01', 'chian', '.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li.item-box .main ul li', '', 'New', '2018-04-20', 0, 1, 6, 105, ''),
(40, 'great', '10', 'chian', 'moblie is samung s7 edge ', '', 'Used', '2018-04-20', 0, 1, 7, 105, ''),
(41, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '1', '2018-04-20', 0, 0, 5, 50, ''),
(42, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 0, 5, 50, ''),
(43, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 0, 5, 50, ''),
(44, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 0, 5, 50, ''),
(45, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 1, 5, 50, ''),
(47, 's', 's', 's', 's8 smasung and so on ....', '', '0', '2018-04-20', 0, 0, 5, 50, ''),
(48, 'aw', '15', 'china', 'dsb', '', '0', '2018-04-20', 0, 1, 5, 50, ''),
(49, 'mobile', '15$e', 'e', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 1, 5, 50, ''),
(50, 'loaa', '15$', 'china', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 1, 5, 50, ''),
(51, 'loaa', '15$', 'll', 'moblie is samung s7 edge ', '', '0', '2018-04-20', 0, 1, 5, 50, ''),
(52, 'mobile', '15$', 'china', 'icons fonts', '', '1', '2018-04-21', 0, 0, 17, 76, 'note8, s7'),
(53, 'mobile', '15$', 'china', 'moblie is samung s7 edge ', '', '1', '2018-04-21', 0, 1, 17, 76, 'note8, s7, great'),
(54, 'mobile', '10', 'chian', 'moblie is samung s7 edge ', '', 'New', '2018-04-21', 0, 1, 6, 57, 'note, s7, nice');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ordering` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `visibelity` int(11) NOT NULL DEFAULT '1',
  `allow_comment` int(11) NOT NULL DEFAULT '1',
  `allow_ads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `ordering`, `parent`, `visibelity`, `allow_comment`, `allow_ads`) VALUES
(5, 'computers', 'computers is so good thing', 1, 0, 1, 1, 1),
(6, 'phones', 'phones is so good thing', 2, 0, 1, 1, 1),
(7, 'tools', 'tools is so good thing', 3, 0, 1, 1, 1),
(8, 'Ipades', 'I[ades is so good thing', 4, 0, 1, 1, 1),
(9, 'Chargers', 'Chargers is so good thing', 6, 0, 1, 1, 1),
(10, 'phones', 'moblie is samung s7 edge ', 1, 0, 1, 1, 1),
(11, 'icons', 'icons fonts', 1, 0, 1, 1, 1),
(12, 'fonts', 'icons fonts', 2, 0, 1, 1, 1),
(13, 'sdbsd', 'moblie is samung s7 edge ', 0, 0, 1, 1, 1),
(14, 'vsdb', 'moblie is samung s7 edge ', 2, 12, 1, 1, 1),
(15, 'greats', 'moblie is samung s7 edge ', 2, 0, 1, 1, 1),
(16, 'Nokia phone', 'Nokia Nice', 1, 10, 1, 1, 1),
(17, 'Samsungs', 's7 edge', 2, 0, 1, 1, 1),
(18, 'woww', 'moblie is samung s7 edge ', 1, 12, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'To Identify user',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'username to login',
  `password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'password to login',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'identify user group',
  `trust_states` int(11) NOT NULL DEFAULT '0' COMMENT 'rank of sellers ',
  `reg_status` int(11) NOT NULL DEFAULT '0' COMMENT 'approve users ',
  `date` date NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `group_id`, `trust_states`, `reg_status`, `date`, `avatar`) VALUES
(50, 'hesh', 'cd67f53c9e2c3ba60a02afa901630c037713bc49', 'hassan534@gmai.com', 'svghlhgl', 1, 0, 1, '2018-04-07', ''),
(51, 'sbsdbds', '3e9143152496bda59ff1b50a070f2f91a8e29a7a', 'alaa11201050@yahoo.com', 'sv', 1, 0, 1, '2018-04-07', ''),
(52, 'asvsv', 'a10d7eb22d0320b76b1baecfcebe66fa33f30b11', 'alaa11201050@fdnyahoo.com', 'v', 1, 0, 1, '2018-04-07', ''),
(53, 'dsbdsb', '3917e4e7265ff247bcc1ec807ac3e46582ca981f', 'alaa11201050@yahoo.com', 'sdb', 1, 0, 1, '2018-04-07', ''),
(55, 'savsb', '80ea5714a9016e2c4bda9d885573a39137d150ec', 'alaa11201050@fdnyahoo.com', 'sdb', 1, 0, 1, '2018-04-07', ''),
(56, 'hassan ', '39e2f7e1453ffc35221f02be6bceba6f06d5d930', 'hassan534@gmai.com', 'hassan Abdallah', 1, 0, 1, '2018-04-07', ''),
(57, 'lolo', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'lolo5@yahoo.com', 'lolo soss', 1, 0, 1, '2018-04-07', ''),
(58, 'dsbsdb', 'e992ad1523f735638bf10c866a03369914ebd850', 'alaa11201050@yahoo.comsdbds', 'dsbsdb', 1, 0, 1, '2018-04-07', ''),
(59, 'sdbsd', '45b2c4168cfbe80a3d5f4caba2105c00d25c99f4', 'alaa11201050@yahoo.com', 'dsbdsb', 1, 0, 1, '2018-04-07', ''),
(61, 'dsbsdbsd', 'e609f78be8c3810f59d9de987211306a2dd07dff', 'alaa11201050@yahoo.com', 'dbdsb', 1, 0, 1, '2018-04-07', ''),
(62, 'aaasdbsdb', '8805a077aad9ce14afba3aee8a7cedd3877653c2', 'aaav@yahoo.coma', 'a', 1, 0, 1, '2018-04-07', ''),
(64, 'dbdsdb', '89994c96dbf81efda4501bd82c78917abf932654', 'goto11201012@yahoo.com', 'sdb', 0, 0, 1, '2018-04-07', ''),
(65, 'dbdsb', '05aac2f6f37ab170c2022216f8cb3c150acbf296', 'alaa11201050@yahoo.com', 'dsb', 0, 0, 1, '2018-04-07', ''),
(66, 'dbds', '210bac0990135b619f22ca797ab49f998d7289a9', 'aaav@yahoo.com', 'db', 0, 0, 1, '2018-04-07', ''),
(67, 'sdbdsb', 'fa9c336793621885e8b07d557d49b45dbf398efc', 'goto11201012@yahoo.com', 'db', 0, 0, 1, '2018-04-07', ''),
(69, 'zxxx', 'eae0c9dca017d3ce38f9972dec177fde55831460', 'alaaa2083@gmail.com', 'soso zozo', 0, 0, 1, '2018-04-07', ''),
(74, 'asvsb', '4781be2b7f468f150a033fe0a9584bfdd3a2e9fd', 'alaa11201050@yahoo.com', 'savsa', 0, 0, 1, '2018-04-07', ''),
(75, 'body', '7e240de74fb1ed08fa08d38063f6a6a91462a815', 'alaa11201050@yahoo.com', 'sdbsd', 0, 0, 1, '2018-04-07', ''),
(76, 'great', 'fbc8fae6b1390136c802d43f16890134bfe73df7', 'alaa11201050@yahoo.com', 'sv', 0, 0, 1, '2018-04-07', ''),
(78, 'savas', '4e6d2b046b8cd52be26910d2c0568b68f9129bb4', 'alaa11201050@yahoo.com', 'Alaa Abdallahgm', 0, 0, 1, '2018-04-07', ''),
(79, 'dsds', '3fdb13677b10691debb3909dd917b00ee751115a', 'alaa11201050@yahoo.com', 'sdb', 0, 0, 1, '2018-04-07', ''),
(80, 'eeeeeeeeee', '4ee6cbf5889832fd1f11e22976e5330e0e97cf20', 'aaav@yahoo.com', 'eee', 0, 0, 1, '2018-04-07', ''),
(81, 'qqqqqqqqqqqq', '7dab01cd7e66831cbbf50b60ee7b9513310c6d6f', 'goto11201012@yahoo.com', 'qdqdq', 0, 0, 1, '2018-04-07', ''),
(82, 'dddddddddd', 'bcd47d7947c97dc2a67642c3a8da0a6a0868faa5', 'goto11201012@yahoo.com', 'ddd', 0, 0, 1, '2018-04-07', ''),
(83, 'omar', '4a6db2314c199446c0e2d3e48e30295622c96639', 'omar@yahoo.com', 'omar ahmed', 0, 0, 1, '2018-04-07', ''),
(84, 'ccccccccccc', '1bb509cf9a155e56d7c383a92b9f433f5dfe85c7', 'alaa11201050@yahoo.com', 'ccccc', 0, 0, 1, '2018-04-07', ''),
(85, 'sdssss', 'acdcb159463173051144586e6a0df92593147f42', 'alaa11201050@yahoo.com', 'sdb', 0, 0, 1, '2018-04-07', ''),
(86, 'savsav', 'e07e5146068d1e7f2307c7ebcbaa1286d256e6c9', 'soso12@yahoo.com', 'savsav', 0, 0, 1, '2018-04-07', ''),
(87, 'svsavsav', '1c6ab464ae68666736e5175385268f67c4b64e7e', 'alaa11201050@yahoo.com', 'sv', 0, 0, 1, '2018-04-07', ''),
(88, 'savasv', 'a59e3b556c903653cdabd2b18bb44e31c5cc8777', 'soso12@yahoo.com', 'svs', 0, 0, 1, '2018-04-07', ''),
(90, 'dbdbd', '75883031ffb5480d2fabacb80e7b40a734738c9c', 'alaa11201050@yahoo.com', 'dbd', 0, 0, 1, '2018-04-07', ''),
(91, 'svsddsdd', '5510aa9d8c47522d328b18e3542a69536b296fec', 'alaa11201050@yahoo.com', 'ddsbsdb', 0, 0, 1, '2018-04-07', ''),
(101, 'omards', '13f362565453328651a9ae2e503cb8d0408190f0', 'alaa11201050@yahoo.com', 'dsbdsb', 0, 0, 1, '2018-04-08', ''),
(102, 'loaaa', 'd99cb114a0571d60c02e3d9d9ffb556702dc02c0', 'alaa11201050@yahoo.com', 'sv', 0, 0, 1, '2018-04-08', ''),
(103, 'Gamal', '0c31b7d71f376b221cc919f4216d2f95db6c254a', 'gmal56@yahoo.com', 'Gamal Hanafy', 0, 0, 1, '2018-04-09', ''),
(105, 'loaa', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'alaa11201050@yahoo.com', 'sv', 0, 0, 1, '2018-04-09', ''),
(106, 'shoukry', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'alaa11201050@yahoo.com', 'Alaa Abdallahhm', 0, 0, 1, '0000-00-00', ''),
(109, 'aaaa', 'aa', '', '', 0, 0, 1, '0000-00-00', ''),
(111, 'mmmm', 'm', '', '', 0, 0, 0, '0000-00-00', ''),
(112, 'Ahmed', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '', '', 0, 0, 0, '0000-00-00', ''),
(115, 'hesham', '000', 'hassan11@yahoo.com', 'hassan Abdallau', 0, 0, 1, '0000-00-00', ''),
(118, 'bbbb', 'b', '', '', 0, 0, 1, '0000-00-00', ''),
(119, 'loaaaa', '8f0366562534eee225e5840df0e3ac32fe3af096', 'aaav@yahoo.com', 'ascasvvav', 0, 0, 1, '2018-04-09', ''),
(120, 'moha', 'eee411109a229046154bc9d75265a9ccb23a3a9c', 'alaaa2083@gmail.com', 'Alaa loaa', 0, 0, 1, '2018-04-09', ''),
(121, 'ssss', 'c455582f41f589213a7d34ccb3954c67476077da', 'aaav@yahoo.com', 'Alaa loaa', 0, 0, 1, '2018-04-09', ''),
(122, 'vvvv', '54a3ed0aa931b8a2c6666be8f3460ce0c9cde050', 'aaav@yahoo.com', 'ascasvvav', 0, 0, 1, '2018-04-09', ''),
(123, 'mona', 'df04a101c17d5b43359d329f105b8c1fc48b9763', 'alaa11201050@yahoo.com', 'mona osama', 0, 0, 0, '2018-04-14', ''),
(124, 'boka', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'boka525@yahoo.com', 'boka loka', 1, 0, 1, '2018-04-15', ''),
(125, 'gogo', '2ab8e336dbdedd7eeca7b1513e11ec5a37956d4c', 'alaaa2083@gmail.com', 'Alaa loaa', 1, 0, 1, '2018-04-15', ''),
(126, 'kemo', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'kemo155@yahoo.com', 'Alaa loaa', 0, 0, 1, '2018-04-16', ''),
(127, 'wowo', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'alaa11201050@yahoo.com', '', 0, 0, 1, '2018-04-16', ''),
(128, 'hass', '4295e07152351f7fae05e8adafba7a5863c692bc', 'alaa11201050@yahoo.com', 'dbdbd', 1, 0, 1, '2018-04-18', ''),
(129, 'fcnfcfn', 'ed70c57d7564e994e7d5f6fd6967cea8b347efbc', 'goto11201012@yahoo.com', '', 0, 0, 1, '2018-04-18', ''),
(130, 'cxbxb', 'cb4f206721496da6f81be14c0a44f4925f674214', 'alaa11201050@yahoo.com', 'cx xc', 1, 0, 1, '2018-04-20', ''),
(131, 'dsbbdsb', '66f1689998b4d8b4610a4319325f9b854665e85c', 'alaa11201050@yahoo.com', 'dsb', 1, 0, 1, '2018-04-22', ''),
(132, 'roma', 'ea5cda90f1374ea481a43b3cb52518385fce9eac', 'alaa11201050@yahoo.com', 'hager ismail', 0, 0, 0, '2018-04-22', 'index.png'),
(133, 'loaad', 'c92b05144b25307623b2fc41cac0df13a8a51181', 'alaa11201050@yahoo.com', 'Alaa Abdallahgm', 0, 0, 1, '2018-04-22', '28167859_601217770219408_1022818465974283179_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_id` (`members_id`),
  ADD KEY `sec_id` (`sec_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `reg_status` (`reg_status`),
  ADD KEY `reg_status_2` (`reg_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify user', AUTO_INCREMENT=134;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `bn` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mem` FOREIGN KEY (`members_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
