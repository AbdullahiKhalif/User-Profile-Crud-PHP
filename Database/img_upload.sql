-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 07:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `img_upload`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registerUser` (IN `_id` VARCHAR(11) CHARSET utf8, IN `_name` VARCHAR(20) CHARSET utf8, IN `_type` VARCHAR(20) CHARSET utf8, IN `_email` VARCHAR(50) CHARSET utf8, IN `_password` VARCHAR(50) CHARSET utf8, IN `_phone` INT, IN `_image` VARCHAR(250) CHARSET utf8)   BEGIN

if EXISTS (SELECT * from users Where users.name = _name) THEN
SELECT 'Deny' as Message;
ELSE
INSERT INTO users (id,name,type,email,password,phone,image) VALUES(_id,_name,_type,_email,_password,_phone,_image);
SELECT 'Registered' as Message;

END IF;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'User',
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `email`, `password`, `phone`, `image`, `date`) VALUES
('USR001', 'Abdullahi Khalif', 'User Admin', 'abdullahijust2021@edu.so', 'just2012', 618390115, 'USR001.png', '2024-02-27 06:45:32'),
('USR003', 'Iqro Abdi', 'User Admin', 'iqruush@gmail.com', 'iqro12', 612324212, 'USR003.png', '2023-08-06 14:22:40'),
('USR004', 'Abdulrahman ', 'Admin', 'engcj@gmail.com', 'Hacktin', 615523134, 'USR004.png', '2023-08-06 14:23:23'),
('USR005', 'Mohamed Amiin', 'User', 'geedi@hormail.com', 'geedi23', 619059005, 'USR005.png', '2023-08-06 14:24:28'),
('USR006', 'Abdullahi Khalif', 'User Admin', 'khalifa@gmail.com', 'khalufa22', 618390115, 'USR006.png', '2023-08-06 16:15:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
