-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 04:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alphago`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_12_votes`
--

CREATE TABLE `1_12_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_12_votes`
--

INSERT INTO `1_12_votes` (`user`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `1_13_votes`
--

CREATE TABLE `1_13_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_13_votes`
--

INSERT INTO `1_13_votes` (`user`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `1_14_votes`
--

CREATE TABLE `1_14_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_14_votes`
--

INSERT INTO `1_14_votes` (`user`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `1_main`
--

CREATE TABLE `1_main` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `post` text,
  `time` int(11) NOT NULL,
  `details` varchar(250) DEFAULT NULL,
  `privacy` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_main`
--

INSERT INTO `1_main` (`id`, `user`, `post`, `time`, `details`, `privacy`, `status`) VALUES
(7, '2', 'Hello there!\r\nHow are you guys?', 1478786163, '10/11/16 19:56', 'public', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `1_mates`
--

CREATE TABLE `1_mates` (
  `user` int(11) NOT NULL,
  `relation` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_mates`
--

INSERT INTO `1_mates` (`user`, `relation`, `status`) VALUES
(2, 'friend', 'friend');

-- --------------------------------------------------------

--
-- Table structure for table `1_notify`
--

CREATE TABLE `1_notify` (
  `id` int(11) NOT NULL,
  `notify` varchar(250) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `details` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_notify`
--

INSERT INTO `1_notify` (`id`, `notify`, `time`, `details`, `status`) VALUES
(2, '<a href="profile.php?id=2">Indres</a> wants to be your mate.', 1478521301, '07/11/16 13:21', 'read'),
(3, '<a href="profile.php?id=2">Indres</a> wants to be your mate.', 1478521945, '07/11/16 13:32', 'read'),
(4, '<a href="profile.php?id=2">Indres</a> is now your mate.', 1478522107, '07/11/16 13:35', 'read'),
(5, '<a href="profile.php?id=2">Indres</a> is now your mate.', 1478693235, '09/11/16 13:07', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `1_posts`
--

CREATE TABLE `1_posts` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `post` text,
  `time` int(11) DEFAULT NULL,
  `details` varchar(250) DEFAULT NULL,
  `privacy` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_posts`
--

INSERT INTO `1_posts` (`id`, `user`, `post`, `time`, `details`, `privacy`, `status`) VALUES
(12, '1', 'Kaisa h bhai!?', 1478787552, '10/11/16 20:19', 'public', 'active'),
(13, '2', 'Bol be', 1478787697, '10/11/16 20:21', 'public', 'active'),
(14, '1', 'rtergtberg', 1478788027, '10/11/16 20:27', 'public', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `2_6_votes`
--

CREATE TABLE `2_6_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `2_7_votes`
--

CREATE TABLE `2_7_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_7_votes`
--

INSERT INTO `2_7_votes` (`user`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `2_8_votes`
--

CREATE TABLE `2_8_votes` (
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_8_votes`
--

INSERT INTO `2_8_votes` (`user`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `2_main`
--

CREATE TABLE `2_main` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `post` text,
  `time` int(11) NOT NULL,
  `details` varchar(250) DEFAULT NULL,
  `privacy` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_main`
--

INSERT INTO `2_main` (`id`, `user`, `post`, `time`, `details`, `privacy`, `status`) VALUES
(12, '1', 'Kaisa h bhai!?', 1478787552, '10/11/16 20:19', 'public', 'active'),
(14, '1', 'rtergtberg', 1478788027, '10/11/16 20:27', 'public', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `2_mates`
--

CREATE TABLE `2_mates` (
  `user` int(11) NOT NULL,
  `relation` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_mates`
--

INSERT INTO `2_mates` (`user`, `relation`, `status`) VALUES
(1, 'friend', 'friend');

-- --------------------------------------------------------

--
-- Table structure for table `2_notify`
--

CREATE TABLE `2_notify` (
  `id` int(11) NOT NULL,
  `notify` varchar(250) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `details` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_notify`
--

INSERT INTO `2_notify` (`id`, `notify`, `time`, `details`, `status`) VALUES
(2, '<a href="profile.php?id=1">Swapnil Sharma</a> is now your mate.', 1478521332, '07/11/16 13:22', 'read'),
(3, '<a href="profile.php?id=1">Swapnil Sharma</a> wants to be your mate.', 1478522084, '07/11/16 13:34', 'read'),
(4, '<a href="profile.php?id=1">Swapnil Sharma</a> wants to be your mate.', 1478693005, '09/11/16 13:03', 'read'),
(5, '<a href="profile.php?id=1">Swapnil Sharma</a> posted on your profile. <a href="profile.php?id=2">View post.</a>', 1478788051, '10/11/16 20:27', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `2_posts`
--

CREATE TABLE `2_posts` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `post` text,
  `time` int(11) DEFAULT NULL,
  `details` varchar(250) DEFAULT NULL,
  `privacy` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2_posts`
--

INSERT INTO `2_posts` (`id`, `user`, `post`, `time`, `details`, `privacy`, `status`) VALUES
(7, '2', 'Hello there!\r\nHow are you guys?', 1478786163, '10/11/16 19:56', 'public', 'active'),
(8, '1', 'Kya hua?', 1478788051, '10/11/16 20:27', 'public', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `members_details`
--

CREATE TABLE `members_details` (
  `id` int(11) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `about` longtext NOT NULL,
  `hobbies` longtext NOT NULL,
  `clubs` longtext NOT NULL,
  `courses` longtext NOT NULL,
  `projects` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_details`
--

INSERT INTO `members_details` (`id`, `gender`, `dob`, `contact`, `about`, `hobbies`, `clubs`, `courses`, `projects`) VALUES
(1, 'Male', '22/12/1996', '8629015435', 'oregheo\r\nersgser', 'oweriuh wrotiu', 'weigtuhr o', 'woeriguwrh', '6oiuwghoeiruh'),
(2, 'Male', '12/21/1996', 'fnfgnfgn', 'gfngdnfgn', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `members_list`
--

CREATE TABLE `members_list` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_list`
--

INSERT INTO `members_list` (`id`, `fullname`, `email`, `password`, `status`) VALUES
(1, 'Swapnil Sharma', 's_sharma@students.iitmandi.ac.in', '3fc0a7acf087f549ac2b266baf94b8b1', 'active'),
(2, 'Indres', 'a@b.com', '3fc0a7acf087f549ac2b266baf94b8b1', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1_12_votes`
--
ALTER TABLE `1_12_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `1_13_votes`
--
ALTER TABLE `1_13_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `1_14_votes`
--
ALTER TABLE `1_14_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `1_main`
--
ALTER TABLE `1_main`
  ADD PRIMARY KEY (`time`);

--
-- Indexes for table `1_mates`
--
ALTER TABLE `1_mates`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `1_notify`
--
ALTER TABLE `1_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1_posts`
--
ALTER TABLE `1_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2_6_votes`
--
ALTER TABLE `2_6_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `2_7_votes`
--
ALTER TABLE `2_7_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `2_8_votes`
--
ALTER TABLE `2_8_votes`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `2_main`
--
ALTER TABLE `2_main`
  ADD PRIMARY KEY (`time`);

--
-- Indexes for table `2_mates`
--
ALTER TABLE `2_mates`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `2_notify`
--
ALTER TABLE `2_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2_posts`
--
ALTER TABLE `2_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_details`
--
ALTER TABLE `members_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_list`
--
ALTER TABLE `members_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1_notify`
--
ALTER TABLE `1_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `1_posts`
--
ALTER TABLE `1_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `2_notify`
--
ALTER TABLE `2_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `2_posts`
--
ALTER TABLE `2_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `members_list`
--
ALTER TABLE `members_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
