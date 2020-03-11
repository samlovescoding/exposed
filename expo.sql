-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2020 at 02:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expo`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `publisher` varchar(256) NOT NULL,
  `instructors` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_articles`
--

CREATE TABLE `course_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `module` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `video` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `resource` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_learning_path`
--

CREATE TABLE `course_learning_path` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `publisher` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_learning_path_links`
--

CREATE TABLE `course_learning_path_links` (
  `learning_path` int(11) NOT NULL,
  `course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_modules`
--

CREATE TABLE `course_modules` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_modules`
--

INSERT INTO `course_modules` (`id`, `title`, `course`) VALUES
(3, 'Main Course', 3);

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy`
--

CREATE TABLE `taxonomy` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_category`
--

CREATE TABLE `taxonomy_category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `taxonomy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_links`
--

CREATE TABLE `taxonomy_links` (
  `category` int(11) NOT NULL,
  `link` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `screenshot` varchar(256) NOT NULL,
  `source` varchar(256) NOT NULL,
  `links` text NOT NULL,
  `file` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_episodes`
--

CREATE TABLE `tmdb_episodes` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `overview` text NOT NULL,
  `still_path` varchar(256) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `season_number` int(11) NOT NULL,
  `vote_average` float NOT NULL,
  `vote_count` int(11) NOT NULL,
  `production_code` varchar(32) NOT NULL,
  `season_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `air_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_genres`
--

CREATE TABLE `tmdb_genres` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_genre_links`
--

CREATE TABLE `tmdb_genre_links` (
  `genre` int(11) NOT NULL,
  `link_type` varchar(16) NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_images`
--

CREATE TABLE `tmdb_images` (
  `id` int(11) NOT NULL,
  `file_path` varchar(256) NOT NULL,
  `aspect` float DEFAULT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `vote_average` float NOT NULL,
  `vote_count` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `link_type` varchar(16) NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_keywords`
--

CREATE TABLE `tmdb_keywords` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_keyword_links`
--

CREATE TABLE `tmdb_keyword_links` (
  `keyword_id` int(11) NOT NULL,
  `link_type` varchar(16) NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_movies`
--

CREATE TABLE `tmdb_movies` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `tagline` varchar(256) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `poster_path` varchar(256) DEFAULT NULL,
  `backdrop_path` varchar(256) DEFAULT NULL,
  `popularity` float NOT NULL,
  `vote_average` float NOT NULL,
  `vote_count` int(11) NOT NULL,
  `budget` int(11) DEFAULT NULL,
  `revenue` int(11) DEFAULT NULL,
  `runtime` int(11) DEFAULT NULL,
  `video` varchar(256) DEFAULT NULL,
  `homepage` varchar(256) DEFAULT NULL,
  `imdb_id` varchar(32) DEFAULT NULL,
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_movies_similar`
--

CREATE TABLE `tmdb_movies_similar` (
  `id` int(11) NOT NULL,
  `similar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_season`
--

CREATE TABLE `tmdb_season` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `overview` text NOT NULL,
  `poster_path` varchar(256) NOT NULL,
  `season_number` int(11) NOT NULL,
  `air_date` date NOT NULL,
  `show_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_show`
--

CREATE TABLE `tmdb_show` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `overview` text DEFAULT NULL,
  `poster_path` varchar(256) DEFAULT NULL,
  `backdrop_path` varchar(256) DEFAULT NULL,
  `first_air_date` date DEFAULT NULL,
  `number_of_seasons` int(11) DEFAULT NULL,
  `number_of_episodes` int(11) DEFAULT NULL,
  `popularity` float NOT NULL,
  `vote_average` float NOT NULL,
  `vote_count` int(11) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `episode_run_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmdb_show_similar`
--

CREATE TABLE `tmdb_show_similar` (
  `id` int(11) NOT NULL,
  `similar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_authentication`
--

CREATE TABLE `user_authentication` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_authentication`
--

INSERT INTO `user_authentication` (`id`, `name`, `username`, `email`, `password`, `role`, `date_created`) VALUES
(1, 'Super Admin', 'superadmin', 'himself@samlovescoding.com', '$2y$10$6.IfJ8tRaHOp5JHs9r6O/O0fyd7rB6siyQ5lPBmX/7Sv6RwOKZHfG', 2, '2020-02-22 16:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_authentication_tokens`
--

CREATE TABLE `user_authentication_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(256) NOT NULL,
  `user` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_verified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `meta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `id` int(11) NOT NULL,
  `detail` int(11) NOT NULL,
  `information` text NOT NULL,
  `user` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `user` int(11) NOT NULL,
  `ip_address` varchar(256) NOT NULL,
  `date_logged` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `type`, `message`, `user`, `ip_address`, `date_logged`) VALUES
(1, 'auth', 'login', 1, '::1', '2020-03-10 22:15:16'),
(2, 'auth', 'logout', 1, '::1', '2020-03-10 22:43:37'),
(3, 'auth', 'login', 1, '::1', '2020-03-10 22:43:46'),
(4, 'auth', 'logout', 1, '::1', '2020-03-11 00:51:53'),
(5, 'auth', 'login', 1, '::1', '2020-03-11 00:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `name`) VALUES
(1, 'user permissions'),
(2, 'user roles'),
(3, 'user management'),
(4, 'user details'),
(5, 'user logs'),
(6, 'taxonomy'),
(7, 'cloud'),
(8, 'course'),
(9, 'course creator'),
(10, 'movies'),
(11, 'movies creator'),
(12, 'shows'),
(13, 'shows creator'),
(14, 'songs'),
(15, 'songs creator'),
(16, 'templates'),
(17, 'templates creator');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `parent`) VALUES
(1, 'Subscriber', 0),
(2, 'Super Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles_permissions`
--

CREATE TABLE `user_roles_permissions` (
  `permission` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles_permissions`
--

INSERT INTO `user_roles_permissions` (`permission`, `role`) VALUES
(7, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_articles`
--
ALTER TABLE `course_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_learning_path`
--
ALTER TABLE `course_learning_path`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `taxonomy_category`
--
ALTER TABLE `taxonomy_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_episodes`
--
ALTER TABLE `tmdb_episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_genres`
--
ALTER TABLE `tmdb_genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_images`
--
ALTER TABLE `tmdb_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_keywords`
--
ALTER TABLE `tmdb_keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_movies`
--
ALTER TABLE `tmdb_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_season`
--
ALTER TABLE `tmdb_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmdb_show`
--
ALTER TABLE `tmdb_show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_authentication`
--
ALTER TABLE `user_authentication`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_authentication_tokens`
--
ALTER TABLE `user_authentication_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_articles`
--
ALTER TABLE `course_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_learning_path`
--
ALTER TABLE `course_learning_path`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taxonomy`
--
ALTER TABLE `taxonomy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxonomy_category`
--
ALTER TABLE `taxonomy_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_episodes`
--
ALTER TABLE `tmdb_episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_genres`
--
ALTER TABLE `tmdb_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_images`
--
ALTER TABLE `tmdb_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_keywords`
--
ALTER TABLE `tmdb_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_movies`
--
ALTER TABLE `tmdb_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_season`
--
ALTER TABLE `tmdb_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmdb_show`
--
ALTER TABLE `tmdb_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_authentication`
--
ALTER TABLE `user_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_authentication_tokens`
--
ALTER TABLE `user_authentication_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
