-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2013 at 07:15 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_category`
--

CREATE TABLE IF NOT EXISTS `about_us_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `about_us_category`
--

INSERT INTO `about_us_category` (`id`, `name`) VALUES
(6, 'Madanmohan Prabhu'),
(7, 'Test'),
(8, 'sfsf'),
(9, 'cat 2'),
(10, 'cat 3'),
(11, 'cat 4'),
(12, 'cat 5'),
(13, 'cat 6'),
(14, 'Latest Category'),
(15, 'casdcdas'),
(16, 'scsdcsasdss');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_content`
--

CREATE TABLE IF NOT EXISTS `about_us_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `about_us_content`
--

INSERT INTO `about_us_content` (`id`, `category_id`, `title`, `description`, `image`) VALUES
(6, 7, 'Test Title Mod', 'Test Desc Mod', 'Test_TestTitleMod_06072013185412.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `album_media_gallery`
--

CREATE TABLE IF NOT EXISTS `album_media_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `album_media_gallery`
--

INSERT INTO `album_media_gallery` (`id`, `name`) VALUES
(3, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `album_photo_gallery`
--

CREATE TABLE IF NOT EXISTS `album_photo_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `album_photo_gallery`
--

INSERT INTO `album_photo_gallery` (`id`, `name`) VALUES
(1, 'God');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `is_testimonial` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `mobile`, `content`, `is_testimonial`) VALUES
(6, 'Madanmohan Prabhu', 'kishanpatadia@gmail.com', '8460895048', 'kasjfsdklj', '0'),
(7, 'Chirag', 'chiragparekhn@gmail.com', '9016263659', 'asfasdfsdfsadsdaf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `image_photo_gallery`
--

CREATE TABLE IF NOT EXISTS `image_photo_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `path` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `image_photo_gallery`
--

INSERT INTO `image_photo_gallery` (`id`, `album_id`, `name`, `path`, `description`) VALUES
(1, 1, 'Shreenathji New', 'God_ShreenathjiNew_06072013144420.jpg', 'Test Description'),
(2, 1, 'Test', 'God_Test_06072013144400.jpg', 'asdfsafsdfs');

-- --------------------------------------------------------

--
-- Table structure for table `latest_news`
--

CREATE TABLE IF NOT EXISTS `latest_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_date` datetime NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `latest_news`
--


-- --------------------------------------------------------

--
-- Table structure for table `track_media_gallery`
--

CREATE TABLE IF NOT EXISTS `track_media_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `path` text NOT NULL,
  `description` text NOT NULL,
  `secure` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `track_media_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE IF NOT EXISTS `user_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`id`, `user_id`, `post_content`, `post_datetime`) VALUES
(68, 1, 'casdfs', '2013-07-06 14:54:07'),
(69, 1, 'c', '2013-07-06 15:18:52'),
(70, 1, 'd', '2013-07-06 15:18:54'),
(71, 1, 'e', '2013-07-06 15:18:55'),
(72, 1, 'f', '2013-07-06 15:18:56'),
(73, 1, 'g', '2013-07-06 15:18:58'),
(74, 1, 'h', '2013-07-06 15:19:05'),
(75, 1, 'hi', '2013-07-06 15:19:09'),
(76, 1, 'o', '2013-07-06 15:19:11'),
(77, 1, 'z', '2013-07-06 15:19:15'),
(78, 1, 'q', '2013-07-06 15:19:16'),
(79, 1, 'x', '2013-07-06 15:19:19'),
(80, 1, 'q', '2013-07-06 15:19:33'),
(81, 1, 'asdf', '2013-07-06 15:19:37'),
(82, 1, 'asdf', '2013-07-06 15:19:39'),
(83, 1, 'sdf', '2013-07-06 15:19:39'),
(84, 1, 'sadf', '2013-07-06 15:19:40'),
(85, 1, 'sadf', '2013-07-06 15:19:41'),
(86, 1, 'dfgh', '2013-07-06 15:19:42'),
(87, 1, 'hj', '2013-07-06 15:19:44'),
(88, 1, 'zcv', '2013-07-06 15:19:45'),
(89, 1, 'yr', '2013-07-06 15:19:47'),
(90, 1, 'n,n', '2013-07-06 15:19:48'),
(91, 1, 'asdas', '2013-07-06 15:19:50'),
(92, 1, 'czcjjtn', '2013-07-06 15:19:53'),
(93, 1, 'qeqw', '2013-07-06 15:19:54'),
(94, 1, 'vxvxcv', '2013-07-06 15:19:56'),
(95, 1, 'cvbxcvb', '2013-07-06 15:19:58'),
(96, 1, 'ngnhg', '2013-07-06 15:19:59'),
(47, 1, 'How are you?', '2013-07-06 01:52:12'),
(67, 1, 'asfsfccxzvzxc', '2013-07-06 14:46:22'),
(63, 1, 'What\\''s up?', '2013-07-06 13:51:06'),
(64, 1, 'safsadfasdfsaf', '2013-07-06 14:45:58'),
(65, 1, 'asfsdsdasdfsf', '2013-07-06 14:46:11'),
(66, 1, 'sdfsdfsdfsdfsdf', '2013-07-06 14:46:14'),
(97, 1, 'werw', '2013-07-06 15:20:01'),
(98, 1, 'za', '2013-07-06 15:20:03'),
(99, 1, 'sfsdfs', '2013-07-06 15:20:07'),
(100, 1, 'sfsdfs', '2013-07-06 15:20:09'),
(101, 1, 'xvxcv', '2013-07-06 15:20:10'),
(102, 1, 'sdfsd', '2013-07-06 15:20:12'),
(103, 1, 'weqweqwe', '2013-07-06 15:20:19'),
(104, 1, 'xvxcv', '2013-07-06 15:20:21'),
(105, 1, 'xcvxcv', '2013-07-06 15:20:22'),
(106, 1, 'sfsdfs', '2013-07-06 15:20:24'),
(107, 1, 'fsdfsd', '2013-07-06 15:20:25'),
(108, 1, 'asdsafsa', '2013-07-06 15:21:26'),
(109, 1, 'sfsdfs', '2013-07-06 15:21:27'),
(110, 1, 'csadsc', '2013-07-06 15:21:29'),
(111, 1, 'csdacdscas', '2013-07-06 15:21:30'),
(112, 1, 'asdfsd', '2013-07-06 15:21:31'),
(113, 1, 'qeqwe', '2013-07-06 15:21:33'),
(114, 1, 'sadfsdaf', '2013-07-06 15:21:44'),
(115, 1, 'fsdfsdf', '2013-07-06 15:21:46'),
(116, 1, 'csdcsdcsc', '2013-07-06 15:21:47'),
(117, 1, 'rewrwere', '2013-07-06 15:21:49'),
(118, 1, 'csaasdcs', '2013-07-06 15:21:50'),
(119, 1, 'sasdafsdaf', '2013-07-06 15:21:52'),
(120, 1, 'asdfsdfsad', '2013-07-06 15:21:53'),
(121, 1, 'asfsdfcsdcasd', '2013-07-06 15:21:54'),
(122, 1, 'jgjghjgh', '2013-07-06 15:21:57'),
(123, 1, 'nghnhgn', '2013-07-06 15:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_post_reply`
--

CREATE TABLE IF NOT EXISTS `user_post_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_content` text NOT NULL,
  `reply_datetime` datetime NOT NULL,
  `isapprove` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `user_post_reply`
--

INSERT INTO `user_post_reply` (`id`, `post_id`, `user_id`, `reply_content`, `reply_datetime`, `isapprove`) VALUES
(39, 47, 1, 'how are you.....', '2013-07-06 13:48:27', '1'),
(40, 67, 1, 'safsafas xcvxvxc', '2013-07-06 14:53:48', '1'),
(41, 123, 1, '', '2013-07-06 15:30:53', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE IF NOT EXISTS `user_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(18) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `mobile`, `birth_date`, `gender`) VALUES
(1, 'Chirag', 'Parekh', 'chiragparekhn@gmail.com', 'chirag', 'Rajkot', '9016263659', '1991-09-25', 'male'),
(2, 'Kishan', 'Patadia', 'kishanpatadia@gmail.com', 'kishan', 'Kevdavadi', '8460895048', '1991-05-17', 'male');
