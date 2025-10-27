-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2025 at 11:23 AM
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
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `contributions` text NOT NULL,
  `quote` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `member_name`, `student_id`, `contributions`, `quote`) VALUES
(1, 'Sanduni Yasaransi', '105524495', 'Jobs page sections; About page content & accessibility checks; Dynamic data loading for about page.', 'Code from the heart.'),
(2, 'Samuel (Soph) Newbegin', '105337923', 'Designed Application Page, Created header & footer .inc files, created settings.php, General fix ups', 'Talk about low-budget flights. No food or movies? I’m outta here.'),
(3, 'Nima Adel', '105911262', 'Designed jobs.html, created logo.', 'AI is the future.'),
(4, 'Zoe Ballantyne', '106131320', 'Content reviews; outreach copy. process_eoi.php', 'I really care for the youth.');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(10) UNSIGNED NOT NULL,
  `job_ref` char(5) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other','Prefer not to say') DEFAULT NULL,
  `street_address` varchar(150) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `state` char(3) DEFAULT NULL,
  `postcode` char(4) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `obedient` enum('Yes','No') DEFAULT NULL,
  `ignorance` enum('Yes','No') DEFAULT NULL,
  `social_lack` enum('Yes','No') DEFAULT NULL,
  `cursive` enum('Yes','No') DEFAULT NULL,
  `document_signing` enum('Yes','No') DEFAULT NULL,
  `other_skills` enum('Yes','No') DEFAULT NULL,
  `other_skills_long` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_id`, `job_ref`, `first_name`, `last_name`, `date_of_birth`, `gender`, `street_address`, `town`, `state`, `postcode`, `email`, `phone_number`, `obedient`, `ignorance`, `social_lack`, `cursive`, `document_signing`, `other_skills`, `other_skills_long`, `status`) VALUES
(1, '12345', 'John', 'Smith', '1234-12-12', 'Male', '123 Example Road', 'Example', 'VIC', '1234', 'email@email.com', '0412345678', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'Skills', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `job_reference` varchar(20) NOT NULL,
  `short_desc` text NOT NULL,
  `reporting_line` varchar(255) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `job_reference`, `short_desc`, `reporting_line`, `salary`, `location`, `responsibilities`, `requirements`) VALUES
(1, 'Frontend Developer', 'F9A7B', 'Join our UI team to craft modern and responsive user interfaces.', 'Reporting to: Lead Frontend Architect', '$75,000 - $90,000', 'Remote / Onsite (NY)', 'Convert designs to interactive web pages using HTML, CSS, JS\r\nMaintain component libraries (React.js)\r\nOptimize performance across browsers/devices', 'Essential: Strong HTML5, CSS3, JavaScript knowledge\r\nPreferred: Experience with React or Angular\r\nPreferred: Familiarity with RESTful APIs'),
(2, 'Backend Engineer', 'B2K4Z', 'Develop and maintain scalable server-side applications.', 'Reporting to: Backend Team Lead', '$85,000 - $105,000', 'Remote / Europe', 'Develop secure APIs using Node.js or Python\r\nWork with databases (MongoDB, PostgreSQL)\r\nCollaborate with frontend and DevOps teams', 'Essential: 3+ years in backend development\r\nEssential: Familiarity with Git & Agile workflows\r\nPreferred: AWS, Docker, CI/CD knowledge');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$wrTTDa3Ujf6MV.3SVJThM.TQ6FiuX6zFv76psOa41p9Goy38mgRPO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_reference` (`job_reference`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
