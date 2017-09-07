-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2017 at 09:52 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sytem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userid` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `profile` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userid`, `name`, `password`, `active`, `profile`) VALUES
(1, '111-000000-111', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'img/profile/f4f6ba630f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `allcourses`
--

CREATE TABLE `allcourses` (
  `id` int(11) NOT NULL,
  `cid` varchar(32) NOT NULL,
  `cname` varchar(32) NOT NULL,
  `credit` varchar(32) NOT NULL,
  `semester` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allcourses`
--

INSERT INTO `allcourses` (`id`, `cid`, `cname`, `credit`, `semester`) VALUES
(1, 'CSC1101', 'Computer Fundamental', '3/Lab', 'semester 1'),
(2, 'CSC1102', 'Programming Language 1', '3/Lab', 'semester 1'),
(3, 'MAT1102', 'Math1(differential Calculus)', '3', 'semester 1'),
(4, 'PHY1101', 'Physics 1(Machanics)', '3', 'semester 1'),
(5, 'PHY1102', 'Physics 1 Lab', '1', 'semester 1'),
(6, 'CSC1203', 'Programming Language 2', '3/Lab', 'semester 2'),
(7, 'CSC1204', 'Discrete Mathmatics', '3', 'semester 2'),
(8, 'MAT1205', 'Math2(Intregal Calculus)', '3', 'semester 2'),
(9, 'ENG1101', 'English Reading Skill', '3', 'semester 1'),
(10, 'PHY1203', 'Physics 2(Elictricity)', '3', 'semester 2'),
(11, 'PHY1204', 'Physics 2 Lab', '1', 'semester 2'),
(12, 'ENG1202', 'English Writing Skill', '3', 'semester 2'),
(13, 'BBA1102', 'Principal of Accounting', '3', 'semester 2'),
(14, 'CSC2105', 'Data Structure', '3/Lab', 'semester 3'),
(15, 'CSC2106', 'Computer Organization(COA)', '3/Lab', 'semester 3'),
(16, 'CSC2107', 'Intro to Database', '3/Lab', 'semester 3'),
(17, 'EEE1201', 'Electric Circuit 1', '3', 'semester 3'),
(18, 'EEE1202', 'Electric Circuit 1 Lab', '1', 'semester 3'),
(19, 'MAT2202', 'Matrix,Vector, Analysis', '3', 'semester 3'),
(20, 'ENG2101', 'Bussiness Comunication', '3', 'semester 3'),
(21, 'CSC2208', 'Operating System', '3/Lab', 'semester 4'),
(22, 'CSC2209', 'OOP1', '3/Lab', 'semester 4'),
(23, 'CSC2210', 'OOAD', '3', 'semester 4'),
(24, 'CSC2211', 'Algorithms', '3/Lab', 'semester 4'),
(25, 'EEE2205', 'Digital Logic Design', '3', 'semester 4'),
(26, 'EEE2206', 'Digital Logic Design Lab', '1', 'semester 4'),
(27, 'BBA1204', 'Principals of Economics', '3', 'semester 4');

-- --------------------------------------------------------

--
-- Table structure for table `coursereg`
--

CREATE TABLE `coursereg` (
  `id` int(11) NOT NULL,
  `cid` varchar(32) NOT NULL,
  `cname` varchar(32) NOT NULL,
  `csec` varchar(15) NOT NULL,
  `ctime` varchar(32) NOT NULL,
  `credit` int(15) NOT NULL,
  `limit` int(15) NOT NULL,
  `session` varchar(32) NOT NULL,
  `fid` varchar(11) NOT NULL,
  `fname` varchar(55) NOT NULL,
  `fill` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursereg`
--

INSERT INTO `coursereg` (`id`, `cid`, `cname`, `csec`, `ctime`, `credit`, `limit`, `session`, `fid`, `fname`, `fill`) VALUES
(5, 'CSC1101', 'Computer Fundamental', 'A', '12:30', 3, 40, 'summer 15-16', '13-246502-1', 'Shuvro Das Sir', 1),
(6, 'CSC1102', 'Programming Language 1', 'C', '8:00', 3, 40, 'summer 15-16', '11-246300-2', 'Faculty', 1),
(7, 'PHY1101', '	Physics 1(Machanics)', 'A', '8:00', 3, 40, 'summer 15-16', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `id` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id`, `subject`, `description`, `post_time`) VALUES
(2, 'Php problem', 'I''ve searched around this site for an answer but couldnt find any.I have a form and I''d like to get the contents of the input written into a txt file. ', '2016-11-19 03:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `userid` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `profile` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `userid`, `username`, `password`, `active`, `profile`) VALUES
(1, '11-246300-2', 'Faculty', 'd561c7c03c1f2831904823a95835ff5f', 1, 'img/profile/da6da55ea7.png'),
(6, '13-246502-1', 'Shuvro Das Sir', '9095a17ed07b9a53cd951db509606a70', 1, ''),
(7, '08-246502-1', 'Sabbir Hossain sir	', '7001ba9ee8f8fd53a8e3b625c899dd9a', 1, ''),
(8, '13-246302-2', 'Hafiz sir', 'c3185f7c7e92a2c34149cc324d30f8ff', 1, ''),
(9, '13-246305-2', 'Bayzid Ashiq sir', 'bb830f112b80639d12d5fc2915cd6f28', 1, ''),
(11, '11-246306-2', 'Imran sir', '11c214f9594c6e4d47a125b4e389500e', 1, ''),
(12, '13-246300-2', 'ashik', 'd98dc399b4bfabb288a05139a4e8592d', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `from` varchar(32) NOT NULL,
  `to` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `open` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `from`, `to`, `name`, `subject`, `message`, `date`, `open`) VALUES
(9, '111-000000-111', '11-246300-2', 'Admin', 'Question Paper', 'Ready Mid term ques Paper', '2017-01-09 03:31:45', 1),
(13, '111-000000-111', '13-246502-1', 'Admin', 'Important Metting', 'Urgent meet in my room.', '2016-10-12 17:55:46', 1),
(15, '111-000000-111', '13-246502-1', 'Admin', 'for check faculty', 'Hello faculty', '2016-10-13 01:18:34', 1),
(16, '111-000000-111', '11-246300-2', 'Admin', 'Cs fest', 'Cs Fest held on next day. so make and arrangement.\r\nSincearly,\r\nAdmin ', '2017-01-09 03:26:33', 1),
(18, '111-000000-111', '11-246300-2', 'admin', 'dhhsd', 'fada', '2017-01-09 15:21:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jnct_course_student`
--

CREATE TABLE `jnct_course_student` (
  `id` int(11) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnct_course_student`
--

INSERT INTO `jnct_course_student` (`id`, `cid`, `userid`) VALUES
(1, 'CSC1101', '14-24630-2'),
(2, 'CSC1102', '14-24630-2'),
(3, 'PHY1101', '14-24630-2');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `size` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `path` varchar(32) NOT NULL,
  `usersessoin` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `name`, `size`, `type`, `path`, `usersessoin`) VALUES
(54, 'faad.docx', '11246', 'application/vnd.openxmlformats-o', '', ''),
(55, 'faad.docx', '11246', 'application/vnd.openxmlformats-o', '', ''),
(56, 'faad.docx', '11246', 'application/vnd.openxmlformats-o', 'downloads/68903fdf87.txt', '11-246300-2'),
(57, 'link.txt', '455', 'text/plain', 'downloads/68903fdf87.txt', '11-246300-2'),
(58, 'link.txt', '455', 'text/plain', 'downloads/68903fdf87.txt', '11-246300-2'),
(59, 'dadad.txt', '6', 'text/plain', 'downloads/68903fdf87.txt', '11-246300-2'),
(60, 'dadad.txt', '6', 'text/plain', 'downloads/68903fdf87.txt', '11-246300-2'),
(61, 'dadad.txt', '6', 'text/plain', 'downloads/68903fdf87.txt', '11-246300-2'),
(62, 'readme.txt', '754', 'text/plain', 'downloads/dee1cc9624.txt', '13-246300-2');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `notice` varchar(300) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `notice`, `post_time`) VALUES
(22, 'Notice Regarding financial Aid issue (Fall-2016-2017)', '\r\nAfter that No Claim/Application Will be entertained.', '2016-10-10 22:25:59'),
(23, 'Title:Notice Regarding financial Aid issue (Fall-2016-2017)', ' After that No Claim/Application Will be entertained.', '2016-10-10 22:26:44'),
(36, 'check Issue', 'This is for check issue!!!!!!!!!', '2016-10-10 23:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `replay`
--

CREATE TABLE `replay` (
  `Rid` int(11) NOT NULL,
  `usersession` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `userid` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `profile` varchar(55) NOT NULL,
  `dob` varchar(55) NOT NULL,
  `session` varchar(20) NOT NULL,
  `phnnum` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `userid`, `username`, `password`, `active`, `profile`, `dob`, `session`, `phnnum`, `address`) VALUES
(1, '14-24630-2', 'student', 'cd73502828457d15655bbd7a63fb0bc8', 1, 'img/profile/eede985480.jpg', '12/11/2016', 'summer-15-16', '01670836862', 'shymoli Dhaka'),
(2, '13-24630-2', 'Rahman.Md.Ashiqur', 'd98dc399b4bfabb288a05139a4e8592d', 1, '', '', '', '', ''),
(6, '13-24631-2', 'polin', '4ba8c020db23d19351fe13cc4ea7fa6f', 1, '', '', '', '', ''),
(7, '13-24645-2', 'mustakim', '960320781b72cb5aa79858739f19132d', 1, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allcourses`
--
ALTER TABLE `allcourses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursereg`
--
ALTER TABLE `coursereg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnct_course_student`
--
ALTER TABLE `jnct_course_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replay`
--
ALTER TABLE `replay`
  ADD PRIMARY KEY (`Rid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `allcourses`
--
ALTER TABLE `allcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `coursereg`
--
ALTER TABLE `coursereg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `jnct_course_student`
--
ALTER TABLE `jnct_course_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `replay`
--
ALTER TABLE `replay`
  MODIFY `Rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
