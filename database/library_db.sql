-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 05:54 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 8.2.12

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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_books_status` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE book_id VARCHAR(11);
    DECLARE cur CURSOR FOR SELECT books_id FROM books;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO book_id;
        IF done THEN
            LEAVE read_loop;
        END IF;

        IF EXISTS (SELECT * FROM borrowings WHERE books_id = book_id) THEN
            UPDATE books SET status = 'dipinjam' WHERE books_id = book_id;
        ELSE
            UPDATE books SET status = 'tersedia' WHERE books_id = book_id;
        END IF;
    END LOOP;

    CLOSE cur;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `books_id` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `published_year` int(11) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `status` enum('tersedia','dipinjam') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`books_id`, `title`, `author`, `published_year`, `genre`, `status`) VALUES
('A001', 'touche', 'Windhy Puspitadewi', 2011, 'teenlit', 'tersedia'),
('A002', 'touche#2', 'Windhy Puspitadewi', 2014, 'teenlit', 'tersedia'),
('A003', 'touche#3', 'Windhy Puspitadewi', 2017, 'teenlit', 'tersedia'),
('B001', 'Bumi', 'Tere Liye', 2014, 'Fantasi', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `borrowings_id` int(11) NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `books_id` varchar(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `role`, `email`) VALUES
('admin', 'Administrator', '$2y$10$hJiAhMbfgUcNLyw46cXjfuHKrgpBR24PPI8ZBB57CTi6pkizEx8S.', 'admin', 'administrator@admin.com'),
('Ica', 'Veronica Waeo', '$2y$10$f26dNUWBqmRf7LH1DN1vKur6UD/h7b7TLa.sqd6dfNFWALWbC99Se', 'user', 'veronica@example.com'),
('Marlin', 'Marlin Pasanda', '$2y$10$21YQLY4OaC0aXQEKIrfJceMBjEMXTmnIbxK30HFur1SeuqqB3Usze', 'user', 'marlin@example.com'),
('wanda', 'Wanda Pantouw', '$2y$10$H6CUOQ0puLEfy6j6XkfiZO0B.ovsoKMYjNp/Trk4GyBUd.bIKDRCW', 'user', 'wanda@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`books_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`borrowings_id`),
  ADD KEY `fkusername` (`username`),
  ADD KEY `fkbooks_id` (`books_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `borrowings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `fkbooks_id` FOREIGN KEY (`books_id`) REFERENCES `books` (`books_id`),
  ADD CONSTRAINT `fkusername` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_books_status_event` ON SCHEDULE EVERY 5 MINUTE STARTS '2024-06-02 07:00:31' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_books_status()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
