-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2016 at 11:57 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eam`
--

-- --------------------------------------------------------

--
-- Table structure for table `Book_Loans`
--

CREATE TABLE IF NOT EXISTS `Book_Loans` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `library_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book_Loans`
--

INSERT INTO `Book_Loans` (`id`, `user_id`, `book_isbn`, `library_id`, `start_date`, `end_date`) VALUES
(1, 1, '123-77712832', 1, '2016-01-12', '2016-02-12'),
(2, 1, '013937681X', 1, '2016-01-25', '2016-01-26'),
(6, 1, '0544668251', 1, '2016-01-27', '2016-02-05'),
(7, 1, '013937681X', 1, '2016-01-27', '2016-02-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Book_Loans`
--
ALTER TABLE `Book_Loans`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Book_Loans`
--
ALTER TABLE `Book_Loans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
