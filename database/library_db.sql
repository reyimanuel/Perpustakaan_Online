-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 02:24 AM
-- Server version: 10.4.32-MariaDB
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
('A001', 'touche', 'Windhy Puspitadewi', 2011, 'teenlit', 'dipinjam'),
('A002', 'touche#2', 'Windhy Puspitadewi', 2014, 'teenlit', 'dipinjam'),
('A003', 'touche#3', 'Windhy Puspitadewi', 2017, 'teenlit', 'dipinjam'),
('B001', 'Bumi', 'Tere Liye', 2014, 'Fantasi', 'tersedia'),
('B002', 'Bulan', 'Tere Liye', 2015, 'Fantasi', 'dipinjam'),
('B003', 'Matahari', 'Tere Liye', 2016, 'Fantasi', 'dipinjam');

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

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`borrowings_id`, `borrow_date`, `return_date`, `username`, `books_id`, `title`) VALUES
(24, '2024-06-02', '2024-06-16', 'marlin', 'A001', 'touche'),
(25, '2024-06-02', '2024-06-16', 'marlin', 'A002', 'touche#2'),
(26, '2024-06-02', '2024-06-16', 'veronica', 'A003', 'touche#3'),
(28, '2024-06-02', '2024-06-16', 'marlin', 'B002', 'Bulan'),
(29, '2024-06-02', '2024-06-16', 'veronica', 'B003', 'Matahari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`, `email`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'administrator@admin.com'),
('marlin', '5045a8bf1d18894bb7ad47c08f95c22c', 'user', 'marlin@user.com'),
('veronica', 'f769a4ee2a3651d2abedabcf543e59c9', 'user', 'veronica@user.com');

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
  MODIFY `borrowings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
