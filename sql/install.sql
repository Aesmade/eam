-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2016 at 08:41 PM
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
-- Table structure for table `Book`
--

CREATE TABLE IF NOT EXISTS `Book` (
  `isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `publication_date` date NOT NULL,
  `type` enum('book','magazine','paper') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`isbn`, `title`, `description`, `publication_date`, `type`) VALUES
('123-77712832', 'The C Programming Language', 'The authors present the complete guide to ANSI standard C language programming. Written by the developers of C, this new version helps readers keep up with the finalized ANSI standard for C while showing how to take advantage of C''s rich set of operators, economy of expression, improved control flow, and data structures. The 2/E has been completely rewritten with additional examples and problem sets to clarify the implementation of difficult language constructs. For years, C programmers have let K&R guide them to building well-structured and efficient programs. Now this same help is available to those working with ANSI compilers. Includes detailed coverage of the C language plus the official C language reference manual for at-a-glance help with syntax notation, declarations, ANSI changes, scope rules, and the list goes on and on. ', '1988-04-01', 'book'),
('9782974329-23', 'Algebra - The Very Basics', 'If you''re looking for a gentle introduction to basic mathematics, look no further. This book picks you up at the very beginning and guides you through the foundations of algebra using lots of examples and no-nonsense explanations. Each chapter contains well-chosen exercises as well as all the solutions. No prior knowledge is required. ', '2014-01-06', 'book');

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
('123-77712832', 1, 4),
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
-- Table structure for table `Book_Loans`
--

CREATE TABLE IF NOT EXISTS `Book_Loans` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_isbn` varchar(32) CHARACTER SET utf8 NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `telephone` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Library`
--

INSERT INTO `Library` (`id`, `name`, `description`, `address`, `latitude`, `longitude`, `telephone`, `email`, `opening_time`, `closing_time`) VALUES
(1, 'Βιβλιοθήκη Σχολής Θετικών Επιστημών', 'Γνωστικό Αντικείμενο:\r\nΗ Συλλογή καλύπτει στο μεγαλύτερο μέρος της τις εξής θεματικές κατηγορίες: Βιολογία, Γεωλογία και Γεωπεριβάλλον, Μαθηματικά, Πληροφορική και Τηλεπικοινωνίες, Φαρμακευτική, Φυσική και Χημεία.\r\n\r\nΒιβλία:\r\nΣΥΛΛΟΓΗ ΑΝΟΙΚΤΗΣ ΠΡΟΣΒΑΣΗΣ\r\nΗ Συλλογή Ανοικτής Πρόσβασης περιλαμβάνει βιβλία, περιοδικά, οπτικοακουστικό υλικό, γκρίζα βιβλιογραφία (διδακτορικές διατριβές, διπλωματικές και πτυχιακές εργασίες), ανάτυπα εργασιών, σημειώσεις μαθημάτων, λεξικά, εγκυκλοπαίδειες και χάρτες. Τα βιβλία είναι ταξιθετημένα σύμφωνα με το δεκαδικό σύστημα ταξινόμησης Dewey, ενώ τα περιοδικά έχουν ταξιθετηθεί με απόλυτη αλφαβητική σειρά τίτλου. Το υλικό της συλλογής μπορεί να αναζητηθεί μέσα από τον Ανοικτό Κατάλογο Δημόσιας Πρόσβασης (OPAC: Open Public Access Catalog).\r\n\r\nΣΥΛΛΟΓΗ ΠΕΡΙΟΡΙΣΜΕΝΗΣ ΠΡΟΣΒΑΣΗΣ\r\nΗ  Συλλογή Περιορισμένης Πρόσβασης περιλαμβάνει σπάνιο και πολύτιμο υλικό το οποίο φυλάσσεται σε ειδικά διαμορφωμένη αίθουσα. Οι χρήστες έχουν πρόσβαση ύστερα από ειδική άδεια, για περιορισμένο χρονικό διάστημα και μόνο στο χώρο της βιβλιοθήκης που θα υποδείξει το προσωπικό της. Το υλικό μπορεί να αναζητηθεί μέσα από τον Ανοικτό Κατάλογο Δημόσιας Πρόσβασης (OPAC). ', 'Πανεπιστημιούπολη, Ιλίσια, 157 84 Αθήνα', 37.967259, 23.781945, ' 210726545', 'thet@lib.uoa.gr', '09:00:00', '21:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'test', 'test', 'test@test.gr', '6512bd43d9caa6e02c990b0a82652dca');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `Book_Loans`
--
ALTER TABLE `Book_Loans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Library`
--
ALTER TABLE `Library`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
