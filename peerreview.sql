-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 09:50 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peerreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `artifact`
--

CREATE TABLE `artifact` (
  `name` varchar(256) NOT NULL,
  `group_number` varchar(8) CHARACTER SET utf8 NOT NULL,
  `link` varchar(1024) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artifact`
--

INSERT INTO `artifact` (`name`, `group_number`, `link`, `id`) VALUES
('Analysis Report IT 1', '2M', 'https://www.youtube.com/', 3),
('Design Report IT 1', '2M', 'https://w3.bilkent.edu.tr/www/akademiktakvim/', 4),
('Final Report ', '2M', 'http://localhost/phpmyadmin/index.php?route=/sql&server=1&db=peerreview&table=student&pos=0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `artifact_comment`
--

CREATE TABLE `artifact_comment` (
  `comment` varchar(2048) NOT NULL,
  `author_id` varchar(110) NOT NULL,
  `date_of_submission` date NOT NULL,
  `group_num` varchar(32) NOT NULL,
  `artifact_name` varchar(32) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artifact_comment`
--

INSERT INTO `artifact_comment` (`comment`, `author_id`, `date_of_submission`, `group_num`, `artifact_name`, `id`) VALUES
('    adsadf', '0', '2021-04-29', '4', 'as', 1),
('    caasdadaddasda', '0', '2021-04-29', '4', '1', 2),
('    aasddddddddddddddddddddddddddddd', '0', '2021-04-29', '1', '2', 3),
('    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0', '2021-04-29', '2', '2', 4),
('    wq', '0', '2021-04-29', '11', '\"\"', 5),
('    ads', '0', '2021-04-29', '15b', '2', 6),
('    aewesdadsadsfasdafasdfswederfrerewfrfewrew', '1', '2021-04-30', '11', '22', 7),
('    12312', '1', '2021-04-30', '4', '2', 8),
('    very good', '1', '2021-04-30', '1b', 'iteration2', 9),
('sfadfsa', '0', '2021-05-03', '2H', 'Analysis Report IT1', 10),
('5-3-2021', '0', '2021-05-03', '2H', 'Analysis Report IT2', 11),
('4-5-6-7', 'admin@liltasarim', '2021-05-03', '2H', 'Design Report IT2', 12),
('adsfdsfasdf', '313133', '2021-05-03', '2H', 'Analysis Report IT2', 13),
('güzel ', '21212121', '2021-05-03', '2M', 'Analysis Report IT1', 14);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `sectionCount` int(10) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `totalStuCount` int(20) NOT NULL,
  `InstructorName` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deadline`
--

CREATE TABLE `deadline` (
  `artifact_name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deadline`
--

INSERT INTO `deadline` (`artifact_name`, `date`, `id`) VALUES
('Design Report IT1', '2023-10-10', 1),
('Analysis Report IT1', '2073-10-10', 2),
('Final Report', '2023-02-23', 3),
('Analysis Report IT2', '2071-01-01', 4),
('Design Report IT2', '2071-01-01', 5);

-- --------------------------------------------------------

--
-- Table structure for table `group_request`
--

CREATE TABLE `group_request` (
  `student_id` int(11) NOT NULL,
  `state` int(10) NOT NULL,
  `target_group` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_request`
--

INSERT INTO `group_request` (`student_id`, `state`, `target_group`, `id`) VALUES
(91113, 1, 'F', 1),
(1000, 3, 'F', 2),
(91112, 3, 'L', 3);

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `section` int(10) NOT NULL,
  `grupNumber` varchar(10) NOT NULL,
  `studentNumberInAGrup` int(11) NOT NULL,
  `minStudentCount` int(10) NOT NULL,
  `maxStudentCount` int(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`section`, `grupNumber`, `studentNumberInAGrup`, `minStudentCount`, `maxStudentCount`, `id`) VALUES
(2, 'H', 8, 7, 8, 23),
(2, 'I', 7, 7, 8, 24),
(2, 'J', 8, 7, 8, 25),
(2, 'L', 8, 7, 8, 27),
(1, 'A', 0, 4, 3, 28),
(2, 'M', 6, 7, 8, 30),
(2, 'N', 7, 7, 8, 31),
(1, 'B', 0, 8, 5, 32),
(1, 'C', 0, 8, 5, 33),
(1, 'D', 0, 3, 10, 34),
(1, 'E', 0, 3, 10, 35),
(1, 'F', 0, 3, 10, 36),
(1, 'G', 0, 3, 10, 37),
(1, 'H', 0, 3, 10, 38);

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(64) NOT NULL,
  `profile_picture` blob DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`email`, `password`, `name`, `profile_picture`, `id`) VALUES
('admin@liltasarim', '123456', 'depo', 0x5b76616c75652d345d, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peer_comment`
--

CREATE TABLE `peer_comment` (
  `author_id` int(11) NOT NULL,
  `target_student_id` int(11) NOT NULL,
  `date_of_submission` date NOT NULL,
  `contribution_grade` int(11) NOT NULL,
  `participation_grade` int(11) NOT NULL,
  `communication_grade` int(11) NOT NULL,
  `knowledge_grade` int(11) NOT NULL,
  `comment` varchar(2048) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peer_comment`
--

INSERT INTO `peer_comment` (`author_id`, `target_student_id`, `date_of_submission`, `contribution_grade`, `participation_grade`, `communication_grade`, `knowledge_grade`, `comment`, `id`) VALUES
(11111, 78452, '2021-05-01', 1111, 1, 1, 1, 'Add a comment about your peer', 2),
(0, 11111, '0000-00-00', 0, 0, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar quis erat sed auctor. Duis tempor viverra iaculis. Donec ornare fringilla tortor quis mollis. Sed ullamcorper fermentum tortor in vulputate. Vestibulum sagittis pulvinar mauris in bibendum. Quisque ac ipsum cursus, finibus odio nec, rhoncus elit. Pellentesque facilisis maximus tincidunt. Duis consequat tortor vitae dui interdum aliquet. Quisque elementum iaculis leo, a tincidunt enim pretium sed. Suspendisse congue mattis pulvinar.', 3),
(0, 11111, '0000-00-00', 0, 0, 0, 0, 'admçassmasmkasmdlkasjladkdsmmdlaksjdlaksddlaksjdladskdlaksjdldakdjsdlakjsdlasjdlaksjdlaksjdlaksjdlajssdlasjsdlakjdlajdlakjdlkajdla', 4),
(313133, 91311111, '2021-05-03', 10, 10, 10, 10, 'nicezuuuu', 5),
(21212121, 313131, '2021-05-03', 10, 10, 10, 10, 'YAHSİ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `studentCount` int(100) NOT NULL,
  `groupCount` int(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `studentID` int(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `group_number` varchar(64) NOT NULL,
  `section` int(4) NOT NULL,
  `profilePicture` blob DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email`, `password`, `studentID`, `name`, `group_number`, `section`, `profilePicture`, `id`) VALUES
('m.maruf.61@hotmail.com', '$2y$10$D7aAQDRkQCbL0zy1E.e6H.nRTFs.gUW0MtYkrm0tEJlQ7Orbm1oyi', 616161, 'asd', 'H', 2, NULL, 1),
('marufsatir24@gmail.com', '$2y$10$uNJC20aH7DruaZTgLtZnZuC4EZYdzonIDHphpPYUm3DYgTvPmCcfq', 90909009, 'asd', '0', 2, NULL, 2),
('mc', 'aaaaa', 217, 'fsadfsaf', 'M', 2, 0x5b76616c75652d375d, 3),
('fasdsdfasdf', 'sfdadsfdfsa', 0, 'fdasdf', 'M', 2, 0x5b76616c75652d375d, 4),
('fdsa@maruf.com', '$2y$10$vmXYcOax7VDCdjSyXEdvmujNE5X6tVH1OWYt3p7n5rX7cEvjbPW7S', 911, 'ege', 'J', 2, NULL, 5),
('fdsaa@maruf.com', '$2y$10$6fmAg43yYrhFHLEkLf0rmebK4W7JC24F.yTGuuPvAkSzmiiS5rXe2', 123, 'ege', 'J', 2, NULL, 6),
('fdsaaa@maruf.com', '$2y$10$9xaryhny7/BUQt3gD.9w.uiMOacHQZ.FS1eNBtOgdJpAlDO38C6aW', 9131, 'ege', 'J', 2, NULL, 7),
('fdsaaaaa@maruf.com', '$2y$10$LqN8DKPerdtROhqNmpO2XecLHA2XpskOVv8gCHBnFSLv1z5Wx9uQ6', 912, 'ege', 'J', 2, NULL, 8),
('fdsab@maruf.com', '$2y$10$tadRe6sIxpnyUJwb3JnxWOx0mqTHrlZySQ85UZw8UUFP.Ha2Sbo4G', 913, 'ege', 'J', 2, NULL, 9),
('fdsabb@maruf.com', '$2y$10$vkVrdu6RD8HvjVt0tb8nKewM1am/WfWunifaObyM/9d4FXgso/wXG', 914, 'ege', 'J', 2, NULL, 10),
('fdsabbb@maruf.com', '$2y$10$bEH.4IRpVjLWkzwF1ZXgNeb7Sus2tN0x3REuJUvY0pKVpTPeTM376', 916, 'ege', 'I', 2, NULL, 11),
('fdsabbbb@maruf.com', '$2y$10$/REE7EO4TB9rHDdtrlZs1.sIBaG9B9HJYp7oOB9UMkrGhGDM0xXGK', 917, 'ege', 'I', 2, NULL, 12),
('fdsac@maruf.com', '$2y$10$GKgXu/4AZD/2LYv0jPWSwuTqducAjdbL9LDYi3VrKF305JDdSbbaO', 919, 'ege', 'I', 2, NULL, 13),
('fdsacc@maruf.com', '$2y$10$VSLR1Vw7CmB9Z.GWtCXNhui9HCItTm82lX/4T8TLDYwyPe1/4j7oa', 922, 'ege', 'I', 2, NULL, 14),
('fdsacccc@maruf.com', '$2y$10$OFP1yUcY/kdUKXw1wQXf/OuyRy8lJMUULu.zRUyWdt13eDBUoWQxG', 923, 'ege', 'I', 2, NULL, 15),
('fdsaccc@maruf.com', '$2y$10$JnzePz8/A0AStRbndpFd9OxqSdPPLF9/3HeXKjDTBFS/vhn7vrOZy', 924, 'ege', 'I', 2, NULL, 16),
('fdsad@maruf.com', '$2y$10$rPrRXspTPEjLyOcBsHnnzesQM/opGATVItPr3avmn6K.xEy1DEdkO', 925, 'ege', 'I', 2, NULL, 17),
('fdsadd@maruf.com', '$2y$10$e41yjNSZuW2vSTuWOyH0IeAgHW9.MWv45REE1Z7jwKT/F1OAkD13e', 9155, 'ege', 'H', 2, NULL, 18),
('fdsaddddd@maruf.com', '$2y$10$J.2prHfLW0xhQIH379KjFOsbIwZ/euDfHTksHpCExkh3CfxQJrQ9i', 9118, 'ege', 'H', 2, NULL, 19),
('fdsaddd@maruf.com', '$2y$10$8YnnkHkGM7/a2OjFjJeDa.wCS91hyFCnDyJFtx2DbOuPMxqa0RavC', 9119, 'ege', 'H', 2, NULL, 20),
('fdsae@maruf.com', '$2y$10$9P9vLIQQvhB2JQ9Zm9rsteId/LxlXlUoSlALllmJ1NCcHRoywyWNK', 9110, 'ege', 'H', 2, NULL, 21),
('fdsaee@maruf.com', '$2y$10$UExGJGN8eH..V3zoeWL2HOjpRHrjETldu9tlSe7NuVl0ix3IAdM5i', 91110, 'ege', 'H', 2, NULL, 22),
('fdsaeee@maruf.com', '$2y$10$2EvjcpWw24kFW93nlnnn6.i5V0iX7f.IOasN55LqZJLT5c7igRavW', 91111, 'ege', 'H', 2, NULL, 23),
('', '$2y$10$jcSpTwWPkKZ0vYPNgmgQPO1Qw.F6gahJ4IwszLAJX3HREvT78DM2O', 91112, 'ege', 'L', 2, NULL, 24),
('fdsax@maruf.com', '$2y$10$Fc7Lqc5vIcftYhWZYiQq2eHw0czlQAcEwZSsgqK2AOs1KgL.6M83O', 91113, 'ege', 'A', 2, NULL, 25),
('fdsaasdf@maruf.com', '$2y$10$WMBdslR8.UNol7JGW3EGA.KB1DWOikOkhQYqIsmqH2AEsJoMzWxMS', 1000, 'ege', '0', 2, NULL, 26),
('fdsaafsdafsd@maruf.com', '$2y$10$xFip3pP7yBCAZ66ecgYBlOuWqN00qYU4CeMzDlTskLPnTYDat288m', 123111, 'ege', 'H', 2, NULL, 27),
('fdsaasadffdsa@maruf.com', '$2y$10$uWkToercSAKUs9AxQydPruWOKSXv1.7XKZxKm4w1dKPD/ic0rP.DO', 91311111, 'ege', 'M', 2, NULL, 28),
('fdsaaaasdaffdsaa@maruf.com', '$2y$10$3T04/R.orJKbClfAJPgXHO1i8uEYRlB.qxYZFb4Rv2f2C4lqaoY5u', 91211111, 'ege', 'N', 2, NULL, 29),
('fdasfddsafassab@maruf.com', '$2y$10$r9iv9Q30/oW.UeW2.BhPnegoTg/YCG9c7aay4F7HuFvTJl942vftm', 91322222, 'ege', 'M', 2, NULL, 30),
('fdsasdsadabb@maruf.com', '$2y$10$wwRhdmEdxsxDo8/vjxuDa.fQlBrNIs30gbWX.WSqbVaLpmwWDVrvm', 91433333, 'ege', 'M', 2, NULL, 31),
('fdsewaasdfabbb@maruf.com', '$2y$10$6udVz.cvXzMpxtJm6OrWyeYe/p1WllypUZJ67Yr/kXoUbnIeCva/G', 916444444, 'ege', '0', 2, NULL, 32),
('fdqqsabbbb@maruf.com', '$2y$10$GNiQQrAP5.hehjZ0k.QZp.HRWvRyaAt5Nks8XFJ7WNQjfBzVlo.7i', 917555555, 'ege', '0', 2, NULL, 33),
('fdqqqqqssdaac@maruf.com', '$2y$10$Cx/zsxYr/pnSYcvJFHxDouBKMIHqvgVnmlTCm9/DlBoxqGiN/hlPS', 9196666, 'ege', '0', 2, NULL, 34),
('fdsqqqqqacc@maruf.com', '$2y$10$KmRcP3IJADASgLWVyj.7t.nDcyPGreWiNr6xhKssttxTd2FmYvxhK', 2147483647, 'ege', '0', 2, NULL, 35),
('fdsqqqqqqqqacccc@maruf.com', '$2y$10$d5kWOP./LAqcJ0s6rdETMu9VLFHLr7Y3BzPDGl..43iEu5etN/14u', 923999999, 'ege', '0', 2, NULL, 36),
('fdsxxxxxxxxxxxxxxxaccc@maruf.com', '$2y$10$EmROwlPG2AyXJJwtr1H5ae2bJSE2M8UAGjxBmQK5E2PLS0nUsNIni', 2147483647, 'ege', '0', 2, NULL, 37),
('fdsxxxad@maruf.com', '$2y$10$SnYxdDbhcNi1UcNgR9pg5uhx0QB3dX/o3QLS/kfkyAuSB6L3sox0q', 2147483647, 'ege', '0', 2, NULL, 38),
('m@a.com', '$2y$10$8Zxtx/ULznW2BdwXJq.r6.7TWECGxgiqP1pdW174I6YUqlIv3W0YW', 313133, 'Ahmet', 'J', 2, NULL, 39),
('x@gmail.com', '$2y$10$Cvt7wMouYnkQpO3LFtnJr.vXxh71uZU/x26dz/CzFzY6AKuzUtnfu', 21212121, 'aaaaaa', 'M', 2, NULL, 40),
('AFDSAF@gmail.com', 'abcx', 217217217, 'abdulmuttalipebutalipogullari', 'A', 2, NULL, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artifact`
--
ALTER TABLE `artifact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artifact_comment`
--
ALTER TABLE `artifact_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deadline`
--
ALTER TABLE `deadline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_request`
--
ALTER TABLE `group_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peer_comment`
--
ALTER TABLE `peer_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artifact`
--
ALTER TABLE `artifact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artifact_comment`
--
ALTER TABLE `artifact_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deadline`
--
ALTER TABLE `deadline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_request`
--
ALTER TABLE `group_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `host`
--
ALTER TABLE `host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peer_comment`
--
ALTER TABLE `peer_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
