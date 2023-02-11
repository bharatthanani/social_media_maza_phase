-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 01:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mazephaze`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `about_function` longtext DEFAULT NULL,
  `company` longtext DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `member` longtext DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `user_id`, `about_function`, `company`, `web`, `member`, `joining_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Developer', NULL, NULL, NULL, NULL, '2022-02-09 01:13:46', '2022-02-09 01:13:46'),
(2, 2, 'Nihil ut minus volup', 'Powers and Long Co', 'https://www.moqugufifoq.org.uk', 'Autem dicta optio u', '2008-10-03', '2022-02-09 01:13:54', '2022-02-09 01:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'amazing', 1, '2022-02-09 00:48:43', '2022-02-09 00:48:43'),
(2, 4, 1, 'Thanks', 1, '2022-02-09 00:49:00', '2022-02-09 00:49:00'),
(4, 6, 2, 'like image profile', 1, '2022-02-09 01:04:18', '2022-02-09 01:04:18'),
(5, 3, 1, 'adddd', 1, '2022-02-09 01:04:25', '2022-02-09 01:04:25'),
(6, 8, 2, 'excellent working', 1, '2022-02-09 01:20:47', '2022-02-09 01:20:47'),
(7, 9, 2, 'nice post', 1, '2022-02-09 01:22:39', '2022-02-09 01:22:39'),
(9, 8, 1, 'asas', 1, '2022-12-07 13:46:29', '2022-12-07 13:46:29'),
(10, 8, 1, 'asas', 1, '2022-12-07 13:46:32', '2022-12-07 13:46:32'),
(11, 6, 2, 'fgfg', 1, '2022-12-12 20:06:49', '2022-12-12 20:06:49'),
(12, 6, 2, 'fgf', 1, '2022-12-12 20:06:51', '2022-12-12 20:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `education` longtext DEFAULT NULL,
  `institution` longtext DEFAULT NULL,
  `employment` longtext DEFAULT NULL,
  `year` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `user_id`, `education`, `institution`, `employment`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'CS', NULL, NULL, NULL, '2022-02-09 01:13:34', '2022-02-09 01:13:34'),
(2, 2, 'Dicta unde voluptate', 'Qui praesentium et e', 'Adipisci odit qui cu', '2018-02-04', '2022-02-09 01:14:02', '2022-02-09 01:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_title` longtext DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_cover_img` varchar(255) NOT NULL DEFAULT 'event_cover_img.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_title`, `event_location`, `event_date`, `event_cover_img`, `created_at`, `updated_at`) VALUES
(2, 1, 'Anniversary Celebrations', 'Newyark', '2022-02-09', 'Robert_181644349575.png', '2022-02-09 00:46:15', '2022-02-09 00:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `event_followers`
--

CREATE TABLE `event_followers` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_followers`
--

INSERT INTO `event_followers` (`id`, `event_id`, `follower_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2022-02-09 00:46:47', '2022-02-09 00:46:47'),
(3, 2, 2, '2022-02-09 00:49:51', '2022-02-09 00:49:51'),
(5, 2, 6, '2022-02-23 01:18:19', '2022-02-23 01:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 for pending and 2 for accepted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 2, '2022-02-09 00:37:33', '2022-02-09 00:37:44'),
(4, 2, 3, 2, '2022-02-09 00:51:05', '2022-02-09 01:38:54'),
(7, 4, 3, 2, '2022-02-09 00:54:12', '2022-02-09 01:38:55'),
(9, 2, 4, 2, '2022-02-09 01:05:08', '2022-02-09 01:06:49'),
(10, 4, 1, 2, '2022-02-09 01:07:33', '2022-02-09 01:17:31'),
(15, 9, 2, 1, '2022-04-05 21:56:54', '2022-04-05 21:56:54'),
(17, 2, 6, 1, '2022-12-12 20:07:51', '2022-12-12 20:07:51'),
(18, 2, 7, 1, '2022-12-12 20:07:52', '2022-12-12 20:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_title` longtext DEFAULT NULL,
  `group_privacy_type` varchar(255) DEFAULT 'public',
  `group_profile_img` varchar(255) DEFAULT NULL,
  `group_cover_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `group_title`, `group_privacy_type`, `group_profile_img`, `group_cover_img`, `created_at`, `updated_at`) VALUES
(2, 1, 'Tempor nesciunt est', 'public', 'Robert_481644349656.png', 'Robert_21644349656.png', '2022-02-09 00:47:36', '2022-02-09 00:50:06'),
(3, 4, 'Iconis', 'public', NULL, 'Steph_71644350363.png', '2022-02-09 00:52:59', '2022-02-09 00:59:23'),
(6, 2, 'fgh', 'public', NULL, 'Amela_131670893596.png', '2022-12-12 20:06:17', '2022-12-12 20:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `group_followers`
--

CREATE TABLE `group_followers` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `is_active` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_followers`
--

INSERT INTO `group_followers` (`id`, `group_id`, `follower_id`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 'active', '2022-02-09 00:50:03', '2022-02-09 00:50:03'),
(4, 3, 2, 'active', '2022-02-09 00:54:37', '2022-02-09 00:54:37'),
(5, 2, 4, 'active', '2022-02-09 01:05:21', '2022-02-09 01:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `help_support`
--

CREATE TABLE `help_support` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_support`
--

INSERT INTO `help_support` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(6, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout?', 'Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Eaque dolore dignissimos omnis neque quam voluptas ut, optio nostrum dolores ab beatae aperiam. Obcaecati molestias repellendus, eaque, alias atque odio laudantium cumque cum voluptas id aut reiciendis nihil repudiandae neque illo.', '2022-01-18 14:37:46', '2022-01-18 14:37:46'),
(8, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout?', 'Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Eaque dolore dignissimos omnis neque quam voluptas ut, optio nostrum dolores ab beatae aperiam. Obcaecati molestias repellendus, eaque, alias atque odio laudantium cumque cum voluptas id aut reiciendis nihil repudiandae neque illo.', '2022-01-18 14:40:50', '2022-01-18 14:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies_interests`
--

CREATE TABLE `hobbies_interests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hobbies` longtext DEFAULT NULL,
  `music` longtext DEFAULT NULL,
  `tv` longtext DEFAULT NULL,
  `books` longtext DEFAULT NULL,
  `movies` longtext DEFAULT NULL,
  `activities` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hobbies_interests`
--

INSERT INTO `hobbies_interests` (`id`, `user_id`, `hobbies`, `music`, `tv`, `books`, `movies`, `activities`, `created_at`, `updated_at`) VALUES
(1, 1, 'aaaaaaa', NULL, 'ulta', NULL, NULL, NULL, '2022-02-09 01:10:38', '2022-02-09 01:12:41'),
(2, 4, 'fnfn cbnjdzbvjhvsdnv dn vbn', 'Reprehenderit aut ut', 'Ut id labore vel nis', 'Quaerat commodi ulla', 'Fuga Laudantium la', 'Iusto iure natus mag', '2022-02-09 01:13:33', '2022-02-09 01:14:48'),
(3, 2, 'Laborum Amet facil', 'abc', 'hj', NULL, 'jkljk', 'xyz', '2022-02-09 01:14:12', '2022-12-12 20:06:07'),
(4, 3, 'gfdgfdg', NULL, NULL, NULL, NULL, NULL, '2022-02-09 01:15:02', '2022-02-09 01:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_like` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `is_like`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, 1, '2022-02-09 00:43:16', '2022-02-09 00:43:16'),
(5, 4, 1, 1, 1, '2022-02-09 00:48:30', '2022-02-09 00:48:30'),
(11, 6, 1, 1, 1, '2022-02-09 01:17:53', '2022-02-09 01:17:53'),
(13, 1, 1, 1, 1, '2022-02-09 01:18:05', '2022-02-09 01:18:05'),
(15, 8, 2, 1, 1, '2022-02-09 01:20:30', '2022-02-09 01:20:30'),
(19, 8, 1, 1, 1, '2022-12-07 13:46:26', '2022-12-07 13:46:26'),
(20, 14, 2, 1, 1, '2022-12-12 20:06:31', '2022-12-12 20:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `time_at` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `time_at`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 'Hi', 0, '2022-02-08 19:36:38', '2022-02-09 00:36:38', '2022-02-09 00:36:38'),
(2, 1, 2, 'replya me zalim', 0, '2022-02-08 19:36:59', '2022-02-09 00:36:59', '2022-02-09 00:36:59'),
(3, 1, 3, 'hi William', 0, '2022-02-08 19:38:01', '2022-02-09 00:38:01', '2022-02-09 00:38:01'),
(4, 2, 1, 'abha kahan hai', 0, '2022-02-08 19:47:34', '2022-02-09 00:47:34', '2022-02-09 00:47:34'),
(5, 2, 1, 'QA kar zalim', 0, '2022-02-08 19:48:00', '2022-02-09 00:48:00', '2022-02-09 00:48:00'),
(6, 4, 2, 'Hello', 0, '2022-02-08 19:54:58', '2022-02-09 00:54:58', '2022-02-09 00:54:58'),
(7, 2, 4, 'nwdn', 0, '2022-02-08 19:55:14', '2022-02-09 00:55:14', '2022-02-09 00:55:14'),
(8, 2, 1, 'hvhvhbv', 0, '2022-02-08 19:55:41', '2022-02-09 00:55:41', '2022-02-09 00:55:41'),
(9, 1, 2, 'testtttttttttttttttttttttttt', 0, '2022-02-08 20:01:41', '2022-02-09 01:01:41', '2022-02-09 01:01:41'),
(10, 3, 1, 'hi', 0, '2022-02-08 20:23:53', '2022-02-09 01:23:53', '2022-02-09 01:23:53'),
(11, 1, 3, 'fdfdfd', 0, '2022-02-08 20:24:46', '2022-02-09 01:24:46', '2022-02-09 01:24:46'),
(12, 3, 4, 'hi', 0, '2022-02-09 22:03:49', '2022-02-10 03:03:49', '2022-02-10 03:03:49'),
(13, 3, 2, 'hi', 0, '2022-02-09 22:03:59', '2022-02-10 03:03:59', '2022-02-10 03:03:59'),
(14, 1, 4, 'ass', 0, '2022-12-09 22:30:17', '2022-12-09 17:30:17', '2022-12-09 17:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `post_type` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `post_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is Lorem Ipsum?', 'general', '2022-02-09 00:35:23', '2022-02-09 00:35:23'),
(4, 1, 'Earum sit aut sequi', '2', '2022-02-09 00:48:01', '2022-02-09 00:48:01'),
(6, 4, 'HACKER', 'general', '2022-02-09 01:03:47', '2022-02-09 01:03:47'),
(8, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'general', '2022-02-09 01:19:37', '2022-02-09 01:19:37'),
(9, 2, NULL, '1', '2022-02-09 01:22:13', '2022-02-09 01:22:13'),
(13, 1, 'asasas', 'general', '2022-12-07 13:46:16', '2022-12-07 13:46:16'),
(14, 2, 'fgfgfgf', '6', '2022-12-12 20:06:28', '2022-12-12 20:06:28'),
(15, 2, 'asasas', 'general', '2022-12-23 12:20:49', '2022-12-23 12:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `post_medias`
--

CREATE TABLE `post_medias` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `media_type` enum('image','video','audio') NOT NULL DEFAULT 'image',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_medias`
--

INSERT INTO `post_medias` (`id`, `post_id`, `media`, `media_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'post_1_0_1644348923.png', 'image', '2022-02-08 19:35:23', NULL),
(2, 1, 'post_1_1_1644348923.png', 'image', '2022-02-08 19:35:23', NULL),
(3, 1, 'post_1_2_1644348923.png', 'image', '2022-02-08 19:35:23', NULL),
(4, 1, 'post_1_3_1644348923.png', 'image', '2022-02-08 19:35:23', NULL),
(5, 4, 'post_4_0_1644349681.png', 'image', '2022-02-08 19:48:01', NULL),
(6, 4, 'post_4_1_1644349681.png', 'image', '2022-02-08 19:48:01', NULL),
(7, 4, 'post_4_2_1644349681.png', 'image', '2022-02-08 19:48:01', NULL),
(8, 4, 'post_4_3_1644349681.png', 'image', '2022-02-08 19:48:01', NULL),
(9, 6, 'post_6_0_1644350627.jpg', 'image', '2022-02-08 20:03:47', NULL),
(11, 8, 'post_8_0_1644351577.png', 'image', '2022-02-08 20:19:37', NULL),
(12, 8, 'post_8_1_1644351577.png', 'image', '2022-02-08 20:19:37', NULL),
(13, 8, 'post_8_2_1644351577.png', 'image', '2022-02-08 20:19:37', NULL),
(14, 9, 'post_9_0_1644351733.png', 'image', '2022-02-08 20:22:13', NULL),
(15, 9, 'post_9_1_1644351733.png', 'image', '2022-02-08 20:22:13', NULL),
(18, 13, 'post_13_0_1670438777.jpg', 'image', '2022-12-07 18:46:17', NULL),
(19, 13, 'post_13_1_1670438777.', 'image', '2022-12-07 18:46:17', NULL),
(20, 13, 'post_13_2_1670438777.png', 'image', '2022-12-07 18:46:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `heading_1` longtext DEFAULT NULL,
  `heading_1_des` longtext DEFAULT NULL,
  `heading_2` longtext DEFAULT NULL,
  `heading_2_des` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `heading_1`, `heading_1_des`, `heading_2`, `heading_2_des`, `created_at`, `updated_at`) VALUES
(1, 'Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'Consent & Information Collection and Use', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2022-01-12 01:01:41', '2022-01-12 01:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `code` char(2) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `code`, `name`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AS', 'American Samoa'),
(4, 'AZ', 'Arizona'),
(5, 'AR', 'Arkansas'),
(6, 'CA', 'California'),
(7, 'CO', 'Colorado'),
(8, 'CT', 'Connecticut'),
(9, 'DE', 'Delaware'),
(10, 'DC', 'District of Columbia'),
(11, 'FM', 'Federated States of Micronesia'),
(12, 'FL', 'Florida'),
(13, 'GA', 'Georgia'),
(14, 'GU', 'Guam'),
(15, 'HI', 'Hawaii'),
(16, 'ID', 'Idaho'),
(17, 'IL', 'Illinois'),
(18, 'IN', 'Indiana'),
(19, 'IA', 'Iowa'),
(20, 'KS', 'Kansas'),
(21, 'KY', 'Kentucky'),
(22, 'LA', 'Louisiana'),
(23, 'ME', 'Maine'),
(24, 'MH', 'Marshall Islands'),
(25, 'MD', 'Maryland'),
(26, 'MA', 'Massachusetts'),
(27, 'MI', 'Michigan'),
(28, 'MN', 'Minnesota'),
(29, 'MS', 'Mississippi'),
(30, 'MO', 'Missouri'),
(31, 'MT', 'Montana'),
(32, 'NE', 'Nebraska'),
(33, 'NV', 'Nevada'),
(34, 'NH', 'New Hampshire'),
(35, 'NJ', 'New Jersey'),
(36, 'NM', 'New Mexico'),
(37, 'NY', 'New York'),
(38, 'NC', 'North Carolina'),
(39, 'ND', 'North Dakota'),
(40, 'MP', 'Northern Mariana Islands'),
(41, 'OH', 'Ohio'),
(42, 'OK', 'Oklahoma'),
(43, 'OR', 'Oregon'),
(44, 'PW', 'Palau'),
(45, 'PA', 'Pennsylvania'),
(46, 'PR', 'Puerto Rico'),
(47, 'RI', 'Rhode Island'),
(48, 'SC', 'South Carolina'),
(49, 'SD', 'South Dakota'),
(50, 'TN', 'Tennessee'),
(51, 'TX', 'Texas'),
(52, 'UT', 'Utah'),
(53, 'VT', 'Vermont'),
(54, 'VI', 'Virgin Islands'),
(55, 'VA', 'Virginia'),
(56, 'WA', 'Washington'),
(57, 'WV', 'West Virginia'),
(58, 'WI', 'Wisconsin'),
(59, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `media_type_id` int(11) DEFAULT NULL,
  `media_name` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `title`, `media_type_id`, `media_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'my new profile', 1, 'story_1644348864.png', 1, '2022-02-09 00:34:24', '2022-02-09 00:34:24'),
(2, 2, 'robert', 1, 'story_1644349512.png', 1, '2022-02-09 00:45:12', '2022-02-09 00:45:12'),
(3, 4, NULL, 1, 'story_1644351539.jpg', 1, '2022-02-09 01:18:59', '2022-02-09 01:18:59'),
(4, 1, 'asass', 1, 'story_1644352497.png', 1, '2022-02-09 01:34:57', '2022-02-09 01:34:57'),
(5, 3, NULL, 1, 'story_1644352514.jpg', 1, '2022-02-09 01:35:14', '2022-02-09 01:35:14'),
(6, 3, NULL, 1, 'story_1644352670.png', 1, '2022-02-09 01:37:50', '2022-02-09 01:37:50'),
(7, 3, NULL, 2, 'story_1644352909.mp4', 1, '2022-02-09 01:41:49', '2022-02-09 01:41:49'),
(9, 6, 'Chuttiyapa', 1, 'story_1645560640.png', 1, '2022-02-23 01:10:40', '2022-02-23 01:10:40'),
(10, 6, 'xyz', 2, 'story_1645560900.mp4', 1, '2022-02-23 01:15:00', '2022-02-23 01:15:00'),
(11, 8, NULL, 1, 'story_1648396011.jpg', 1, '2022-03-27 19:46:51', '2022-03-27 19:46:51'),
(12, 9, NULL, 1, 'story_1649181136.jpg', 1, '2022-04-05 21:52:16', '2022-04-05 21:52:16'),
(13, 9, NULL, 1, 'story_1649181149.jpg', 1, '2022-04-05 21:52:29', '2022-04-05 21:52:29'),
(14, 2, 'fgfg', 1, 'story_1670893624.png', 1, '2022-12-12 20:07:04', '2022-12-12 20:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` longtext DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_img`, `banner_img`, `contact_num`, `address`, `state`, `city`, `role`, `created_at`, `updated_at`) VALUES
(1, 'James', 'Patricia', 'James@gmail.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', 'James_231670438850.png', 'James_251644351195.png', NULL, NULL, 55, NULL, 'user', '2022-02-09 00:32:48', '2022-12-07 13:47:30'),
(2, 'Amela', 'Mays', 'admin@gmail.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', 'Amela_131670893008.png', 'Amela_221670893417.png', '+1 (128) 312-7179', 'Enim dignissimos fug', 34, '12', 'user', '2022-02-09 00:35:40', '2022-12-12 20:05:40'),
(3, 'Olivia', 'Amelia', 'olivia@demo.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', 'Olivia_211644444630.png', NULL, NULL, NULL, 1, NULL, 'user', '2022-02-09 00:36:26', '2022-02-10 03:10:30'),
(4, 'Stephen', 'Baristow', 'veros85834@chinamkm.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', 'Stephen_251644351337.png', 'Stephen_231644351378.jpg', '012315121', 'vfdgvdfbfgbfgbn', 41, 'New York', 'user', '2022-02-09 00:49:40', '2022-02-09 01:20:25'),
(5, 'Super', 'Admin', 'admin@demo.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2022-02-09 23:44:42', '2022-02-09 23:44:42'),
(6, 'demo', 'test', 'demo@demo.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', 'demo_291645560975.png', 'demo_251645561362.jpg', NULL, NULL, 1, NULL, 'user', '2022-02-23 01:09:48', '2022-02-23 01:23:04'),
(7, 'rixak', 'konywypys', 'vywusog@mailinator.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2022-03-09 05:46:08', '2022-03-09 05:46:08'),
(8, 'fonov', 'tiquni', 'mewoh@mailinator.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2022-03-27 19:45:37', '2022-03-27 19:45:37'),
(9, 'koxoxuda', 'xyhoce', 'qyjuky@mailinator.com', '$2a$12$N/IR0LPUuPMzhln7p170Pu9Ipc6wHG2X3MaVk52bRz.QHsFv.YqPe', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2022-04-05 21:51:07', '2022-04-05 21:51:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_followers`
--
ALTER TABLE `event_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_followers`
--
ALTER TABLE `group_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_support`
--
ALTER TABLE `help_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobbies_interests`
--
ALTER TABLE `hobbies_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_medias`
--
ALTER TABLE `post_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_followers`
--
ALTER TABLE `event_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_followers`
--
ALTER TABLE `group_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `help_support`
--
ALTER TABLE `help_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hobbies_interests`
--
ALTER TABLE `hobbies_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_medias`
--
ALTER TABLE `post_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
