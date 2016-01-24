-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2016 at 07:25 PM
-- Server version: 5.6.27-0ubuntu0.15.04.1
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
-- Table structure for table `Author`
--

CREATE TABLE IF NOT EXISTS `Author` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`id`, `name`) VALUES
(1, 'Brian Kernighan'),
(2, 'Dennis Ritchie'),
(3, 'Tozer'),
(4, 'Metin Bektas');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE IF NOT EXISTS `Book` (
  `isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `language` varchar(32) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `publication_date` date NOT NULL,
  `type` enum('book','magazine','paper') NOT NULL,
  `imgs` text NOT NULL,
  `imgm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`isbn`, `title`, `language`, `description`, `publication_date`, `type`, `imgs`, `imgm`) VALUES
('013937681X', 'The Unix Programming Environment', 'Αγγλικά', 'Designed for first-time and experienced users, this book describes the UNIX® programming environment and philosophy in detail. Readers will gain an understanding not only of how to use the system, its components, and the programs, but also how these fit into the total environment. ', '1983-07-24', 'book', 'http://ecx.images-amazon.com/images/I/41HMOpkLA2L._SX383_BO1,204,203,200_.jpg', 'http://ecx.images-amazon.com/images/I/41HMOpkLA2L._SX383_BO1,204,203,200_.jpg'),
('123-77712832', 'The C Programming Language', 'Αγγλικά', 'The authors present the complete guide to ANSI standard C language programming. Written by the developers of C, this new version helps readers keep up with the finalized ANSI standard for C while showing how to take advantage of C''s rich set of operators, economy of expression, improved control flow, and data structures. The 2/E has been completely rewritten with additional examples and problem sets to clarify the implementation of difficult language constructs. For years, C programmers have let K&R guide them to building well-structured and efficient programs. Now this same help is available to those working with ANSI compilers.', '1988-04-01', 'book', 'http://ecx.images-amazon.com/images/I/41qX6YdIJ7L._SX379_BO1,204,203,200_.jpg', 'http://ecx.images-amazon.com/images/I/41qX6YdIJ7L._SX379_BO1,204,203,200_.jpg'),
('1503379744A', 'The Pursuit of God', 'Αγγλικά', '“As the heart panteth after the water brooks, so panteth my soul after thee, O God.” This thirst for an intimate relationship with God, claims A.W. Tozer, is not for a select few, but should be the experience of every follower of Christ. But, he asserts, it is all too rare when believers have become conditioned by tradition to accept standards of mediocrity, and the church struggles with formality and worldliness.', '2014-10-22', 'book', 'http://ecx.images-amazon.com/images/I/41NbdDuf0EL._SX331_BO1,204,203,200_.jpg', 'http://ecx.images-amazon.com/images/I/41NbdDuf0EL._SX331_BO1,204,203,200_.jpg'),
('9782974329-23', 'Algebra - The Very Basics', 'Αγγλικά', 'If you''re looking for a gentle introduction to basic mathematics, look no further. This book picks you up at the very beginning and guides you through the foundations of algebra using lots of examples and no-nonsense explanations. Each chapter contains well-chosen exercises as well as all the solutions. No prior knowledge is required. ', '2014-01-06', 'book', 'http://ecx.images-amazon.com/images/I/51oESGdCPbL._SX312_BO1,204,203,200_.jpg', 'http://ecx.images-amazon.com/images/I/51oESGdCPbL._SX312_BO1,204,203,200_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Books_at_Libraries`
--

CREATE TABLE IF NOT EXISTS `Books_at_Libraries` (
  `book_isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `library_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books_at_Libraries`
--

INSERT INTO `Books_at_Libraries` (`book_isbn`, `library_id`, `quantity`) VALUES
('013937681X', 1, 5),
('123-77712832', 1, 4),
('1503379744A', 3, 2),
('9782974329-23', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Books_by_Category`
--

CREATE TABLE IF NOT EXISTS `Books_by_Category` (
  `book_isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books_by_Category`
--

INSERT INTO `Books_by_Category` (`book_isbn`, `category_id`) VALUES
('123-77712832', 3),
('9782974329-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Book_Authors`
--

CREATE TABLE IF NOT EXISTS `Book_Authors` (
  `book_isbn` varchar(32) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Book_Authors`
--

INSERT INTO `Book_Authors` (`book_isbn`, `author_id`) VALUES
('013937681X', 1),
('123-77712832', 1),
('123-77712832', 2),
('1503379744A', 3),
('9782974329-23', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book_Loans`
--

INSERT INTO `Book_Loans` (`id`, `user_id`, `book_isbn`, `library_id`, `start_date`, `end_date`) VALUES
(1, 1, '123-77712832', 1, '2016-01-12', '2016-05-12'),
(2, 1, '013937681X', 1, '2016-01-25', '2016-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
`id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Mathematics'),
(2, 'Physics'),
(3, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `Library`
--

CREATE TABLE IF NOT EXISTS `Library` (
`id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `address` varchar(128) CHARACTER SET utf8 NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `telephone` varchar(12) CHARACTER SET utf8 NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Library`
--

INSERT INTO `Library` (`id`, `name`, `description`, `address`, `latitude`, `longitude`, `telephone`, `email`, `opening_time`, `closing_time`, `img`) VALUES
(1, 'Βιβλιοθήκη Θετικών Επιστημών', 'Η Συλλογή καλύπτει στο μεγαλύτερο μέρος της τις εξής θεματικές κατηγορίες: Βιολογία, Γεωλογία και Γεωπεριβάλλον, Μαθηματικά, Πληροφορική και Τηλεπικοινωνίες, Φαρμακευτική, Φυσική και Χημεία.\r\n\r\n', 'Πανεπιστημιούπολη, Ιλίσσια', 37.967259, 23.781945, ' 210-726545', 'thet@lib.uoa.gr', '09:00:00', '21:00:00', 'http://www.getbusy.gr/Content/ContentFiles/02_vivlio.jpg'),
(2, 'Βιβλιοθήκη Οικονομικών Επιστημών', 'Η συλλογή περιλαμβάνει 22000 τίτλους βιβλίων που χρονολογούνται από τις αρχές του 20 αιώνα έως σήμερα. Διαθέτει 170 τίτλους περιοδικών, 22 από τους οποίους αποτελούν τρέχουσες συνδρομές.  Επίσης διατίθεται  μεγάλος αριθμός τίτλων στις βάσεις των Ηλεκτρονικών  Περιοδικών του Πανεπιστημίου Αθηνών. ', 'Ναυαρίνου 13Α', 37.983522, 23.735471, '210-7834723', 'economy@lib.uoa.gr', '09:00:00', '18:00:00', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Melk_-_Abbey_-_Library.jpg/1280px-Melk_-_Abbey_-_Library.jpg'),
(3, 'Βιβλιοθήκη Θεολογικής Σχολής', 'Η συλλογή της Βιβλιοθήκης καλύπτει τους παρακάτω τομείς: Θεολογία, Θρησκειολογία, Εκκλησιαστικη Ιστορία, Ιστορία Ελλάδος, Ιεραποστολική, Ποιμαντική, Κατηχητική, Κανονικό Δίκαιο, Φιλοσοφία, Δογματική, Χριστιανική Κοινωνιολογία, Παλαιογραφία, Φιλοσοφία, Ψυχολογία, Χριστιανική Αρχαιολογία.', 'Πανεπιστημιούπολη, Ιλίσσια', 37.968994, 23.776117, '210-5623132', 'theology@lib.uoa.gr', '08:00:00', '16:00:00', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Bibl._Malatestiana_3.jpg/800px-Bibl._Malatestiana_3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `first_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'test', 'test', 'test@test.gr', '1a1dc91c907325c69271ddf0c944bc72'),
(2, 'Γιαννης', 'Γιαννης', 'giannis@giannis.gr', '1a1dc91c907325c69271ddf0c944bc72');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
 ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `Books_at_Libraries`
--
ALTER TABLE `Books_at_Libraries`
 ADD PRIMARY KEY (`book_isbn`,`library_id`);

--
-- Indexes for table `Books_by_Category`
--
ALTER TABLE `Books_by_Category`
 ADD PRIMARY KEY (`book_isbn`,`category_id`);

--
-- Indexes for table `Book_Authors`
--
ALTER TABLE `Book_Authors`
 ADD PRIMARY KEY (`book_isbn`,`author_id`);

--
-- Indexes for table `Book_Loans`
--
ALTER TABLE `Book_Loans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Library`
--
ALTER TABLE `Library`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Author`
--
ALTER TABLE `Author`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Book_Loans`
--
ALTER TABLE `Book_Loans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Library`
--
ALTER TABLE `Library`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
