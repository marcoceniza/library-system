-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 10:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_isbn` int(11) NOT NULL,
  `book_title` varchar(60) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_genre` varchar(30) NOT NULL,
  `book_published_year` datetime NOT NULL,
  `book_copies_available` int(11) NOT NULL,
  `book_total_copies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_isbn`, `book_title`, `book_author`, `book_genre`, `book_published_year`, `book_copies_available`, `book_total_copies`) VALUES
(1, 'Html5 and Css3 Responsive Web Design Cookbook', 'Benjamin LaGrone', 'Programming', '2024-01-26 23:24:18', 3, 5),
(2, 'Responsive Web Design with jQuery', 'Gilberto Carlos', 'Programming', '2024-01-26 23:25:30', 2, 8),
(7, 'test3', 'test3', 'Programming', '0000-00-00 00:00:00', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Programming'),
(2, 'Data Science');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `librarian_id` int(11) NOT NULL,
  `librarian_name` varchar(30) NOT NULL,
  `librarian_address` varchar(50) NOT NULL,
  `librarian_phone_number` int(11) NOT NULL,
  `librarian_email` varchar(30) NOT NULL,
  `librarian_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`librarian_id`, `librarian_name`, `librarian_address`, `librarian_phone_number`, `librarian_email`, `librarian_password`) VALUES
(1, 'test', 'test', 123, 'test@gmail.com', '$2y$10$QLTfDdXefrSfTiSqh8op9uUuJ1eQo8eoY/9clmrDUxE8w2QDJpoGO'),
(2, 'test2', 'test2', 456, 'test2@gmail.com', '$2y$10$BDyUNZ6MdUmgnhPtGNBX1.PPdT3XUUGV2lQMwz5lSD2QeOjkIcPFS');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `student_address` varchar(50) NOT NULL,
  `student_phone_number` int(11) NOT NULL,
  `student_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_book_isbn` int(11) NOT NULL,
  `transaction_student_id` int(11) NOT NULL,
  `transaction_librarian_id` int(11) NOT NULL,
  `transaction_date_borrowed` datetime NOT NULL,
  `transaction_due_date` datetime NOT NULL,
  `transaction_date_returned` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_isbn`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`librarian_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `FK_book_isbn` (`transaction_book_isbn`),
  ADD KEY `FK_student_id` (`transaction_student_id`),
  ADD KEY `FK_librarian_id` (`transaction_librarian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_isbn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `librarian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_book_isbn` FOREIGN KEY (`transaction_book_isbn`) REFERENCES `book` (`book_isbn`),
  ADD CONSTRAINT `FK_librarian_id` FOREIGN KEY (`transaction_librarian_id`) REFERENCES `librarian` (`librarian_id`),
  ADD CONSTRAINT `FK_student_id` FOREIGN KEY (`transaction_student_id`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
