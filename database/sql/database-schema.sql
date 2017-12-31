-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2017 at 03:05 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connect_global`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'full', 'Full access to dashboard', '2017-07-27 22:00:00', '2017-07-27 22:00:00'),
(2, 'users.manage', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(3, 'members.add', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(4, 'members.manage', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(5, 'events.add', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(6, 'events.manage', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(7, 'preferences.add', NULL, '2017-08-24 22:00:00', '2017-08-24 22:00:00'),
(8, 'preferences.manage', NULL, '2017-08-25 22:00:00', '2017-08-25 22:00:00'),
(9, 'interviews.add', 'Adding interview dates to unpublished, upcoming, and opened events.', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(10, 'interviews.manage', 'Manage interview dates', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(11, 'group_discussions.add', 'Adding interview dates to unpublished and upcoming events.', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(12, 'group_discussions.manage', 'Manage group discussion dates', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(13, 'events.statistics', 'View previous and current events\' statistics', '2017-09-02 22:00:00', '2017-09-02 22:00:00'),
(14, 'recruitment', 'For Recruitment event. View Interview dates that you has already added. View and Manage participants who applied to your committee.', '2017-09-15 05:00:00', '2017-09-15 05:00:00'),
(15, 'participants.manage', 'Manage participants for specific event.', '2017-09-17 05:00:00', '2017-09-17 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `created_at`, `updated_at`) VALUES
(80400, 'Preparatory Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80401, '1st Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80402, '2nd Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80403, '3rd Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80404, '4th Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80405, '5th Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80406, '6th Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80407, '7th Year', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80408, 'Graduated', '2017-03-29 05:00:00', '2017-03-29 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `additional_informations`
--

CREATE TABLE `additional_informations` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_abilities`
--

CREATE TABLE `admin_abilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `ability_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `magazine_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture_src` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image_src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birthdays`
--

CREATE TABLE `birthdays` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `day` tinyint(2) UNSIGNED NOT NULL,
  `month` tinyint(2) UNSIGNED NOT NULL,
  `year` smallint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `years` int(1) UNSIGNED NOT NULL DEFAULT '7',
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `years`, `type`, `created_at`, `updated_at`) VALUES
(80201, 'Faculty of Engineering', 5, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80202, 'Faculty of Education', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80203, 'Faculty of Computer Sciences', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80204, 'Faculty of Commerce', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80205, 'Faculty of Alsun', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80206, 'Faculty of Sciences', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80207, 'Faculty of Arts', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80208, 'Faculty of Laws', 4, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80209, 'Faculty of Dentistry', 5, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80210, 'Faculty of pharmacy', 6, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80211, 'Faculty of Medicine', 7, 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80221, 'Other', 7, 'main', '2017-03-02 21:13:19', '2017-03-02 21:13:19'),
(80222, 'Aswan University', 7, 'other', '2017-04-28 03:32:30', '2017-04-28 03:32:30'),
(80223, 'arts', 7, 'other', '2017-11-18 17:47:22', '2017-11-18 17:47:22'),
(80224, 'faculty of applied art', 7, 'other', '2017-11-20 21:33:59', '2017-11-20 21:33:59'),
(80225, 'faculty of applied art', 7, 'other', '2017-11-20 21:35:42', '2017-11-20 21:35:42'),
(80226, 'faculty of applied art', 7, 'other', '2017-11-20 21:39:26', '2017-11-20 21:39:26'),
(80227, 'Mangement Information System', 7, 'other', '2017-11-21 06:38:53', '2017-11-21 06:38:53'),
(80228, 'Management Information System', 7, 'other', '2017-11-21 06:39:31', '2017-11-21 06:39:31'),
(80229, 'Management Information System', 7, 'other', '2017-11-21 06:43:26', '2017-11-21 06:43:26'),
(80230, 'Computer Science', 7, 'other', '2017-11-24 02:33:40', '2017-11-24 02:33:40'),
(80231, 'Computer Science', 7, 'other', '2017-11-24 02:34:29', '2017-11-24 02:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `name`, `short_name`, `description`, `created_at`, `updated_at`) VALUES
(70101, 'Information Technology', 'IT', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70102, 'Multimedia', 'MM', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70103, 'Social Media Marketing', 'SMM', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70104, 'Logistics and Reception', 'L&R', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70105, 'Fundraising', 'FR', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70106, 'Public Relations', 'PR', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70107, 'Academic Committee', 'AC', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70108, 'Project Management', 'PM', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70109, 'Human Resources Management', 'HRM', NULL, '2016-11-06 15:07:23', '2016-11-06 15:07:23'),
(70110, 'Media and Publications', 'M&Pubs', NULL, '2017-09-15 05:00:00', '2017-09-15 05:00:00'),
(70111, 'Marketing', 'Marketing', NULL, '2017-09-15 05:00:00', '2017-09-15 05:00:00'),
(70118, 'Top Management', 'TM', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70119, 'Consultants', 'Consultants', NULL, '2017-10-11 05:00:00', '2017-10-11 05:00:00'),
(70120, 'Founders', 'Founders', NULL, '2017-03-29 05:00:00', '2017-03-29 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `college_id` int(11) UNSIGNED NOT NULL DEFAULT '80201',
  `department_group_id` int(11) UNSIGNED NOT NULL DEFAULT '5',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `college_id`, `department_group_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(80301, 80201, 1, 'Electrical', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80302, 80201, 2, 'Mechanical', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80303, 80201, 3, 'Civil', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80304, 80201, 4, 'Architecture Engineering', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80305, 80201, 5, 'Preparatory', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80306, 80201, 5, 'Other', 'main', '2017-02-16 10:01:26', '2017-02-16 10:01:26'),
(80307, 80201, 5, 'Petroleum Engineering', 'main', '2017-02-20 03:01:18', '2017-02-20 03:01:18'),
(80308, 80201, 1, 'Computer and Sytems Engineering', 'main', '2017-03-05 06:41:44', '2017-03-05 06:41:44'),
(80309, 80201, 4, 'Landscape', 'main', '2017-03-09 02:21:16', '2017-03-09 02:21:16'),
(80310, 80201, 1, 'Energy and Renewable Energy', 'main', '2017-03-10 20:59:10', '2017-03-10 20:59:10'),
(80311, 80201, 2, 'Mechatronics and Robotics', 'main', '2017-03-27 15:08:08', '2017-03-27 15:08:08'),
(80316, 80201, 5, 'Biomedical Engineering', 'main', '2017-04-21 05:28:54', '2017-04-21 05:28:54'),
(80319, 80201, 2, 'Production', 'main', '2017-04-23 03:51:38', '2017-04-23 03:51:38'),
(80320, 80201, 1, 'Communication and Electronics', 'main', '2017-04-24 04:33:25', '2017-04-24 04:33:25'),
(80321, 80201, 1, 'Power and Machines', 'main', '2017-08-15 22:00:00', '2017-08-15 22:00:00'),
(80322, 80201, 4, 'Planning and Urban Design', 'main', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(80323, 80201, 4, 'Architecture', 'main', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(80324, 80201, 3, 'Public', 'main', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(80325, 80201, 3, 'Structure', 'main', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(80326, 80201, 2, 'Power', 'main', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(80327, 80201, 5, 'Building Engineering', 'other', '2017-09-18 13:42:09', '2017-09-18 13:42:09'),
(80328, 80201, 5, 'Perparatory', 'other', '2017-09-19 02:03:27', '2017-09-19 02:03:27'),
(80329, 80201, 3, 'Building', 'main', '2017-11-17 06:00:00', '2017-11-17 06:00:00'),
(80330, 80201, 5, 'Computer Seinice', 'other', '2017-11-22 20:31:46', '2017-11-22 20:31:46'),
(80331, 80201, 5, 'Preparatory', 'other', '2017-11-24 03:40:53', '2017-11-24 03:40:53'),
(80332, 80201, 5, 'Preparatory year', 'other', '2017-11-24 09:03:49', '2017-11-24 09:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `department_group`
--

CREATE TABLE `department_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_group`
--

INSERT INTO `department_group` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Electrical', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(2, 'Mechanical', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(3, 'Civil', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(4, 'Architecture', '2017-08-29 22:00:00', '2017-08-29 22:00:00'),
(5, 'Other', '2017-08-29 22:00:00', '2017-08-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `educational_informations`
--

CREATE TABLE `educational_informations` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `uni_id` int(11) UNSIGNED NOT NULL,
  `college_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED DEFAULT NULL,
  `academic_year_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_confirmations`
--

CREATE TABLE `email_confirmations` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `confirmed` tinyint(1) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) UNSIGNED NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `started_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ended_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `preferences_type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_discussion_dates`
--

CREATE TABLE `group_discussion_dates` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `max` int(11) NOT NULL,
  `taken` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `idea_votes`
--

CREATE TABLE `idea_votes` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `idea_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview_dates`
--

CREATE TABLE `interview_dates` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `max` int(11) NOT NULL,
  `taken` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailer`
--

CREATE TABLE `mailer` (
  `id` int(11) NOT NULL,
  `date` varchar(13) NOT NULL,
  `send` int(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mailer_queue`
--

CREATE TABLE `mailer_queue` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `other_attributes` text,
  `sender` varchar(255) NOT NULL DEFAULT 'no-reply',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `committee_id` int(11) UNSIGNED NOT NULL,
  `position_id` int(11) UNSIGNED NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE `mobiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `updatable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant_group_discussions`
--

CREATE TABLE `participant_group_discussions` (
  `id` int(11) UNSIGNED NOT NULL,
  `participant_id` int(11) UNSIGNED NOT NULL,
  `group_discussion_date_id` int(11) UNSIGNED NOT NULL,
  `result` tinyint(1) UNSIGNED DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) UNSIGNED DEFAULT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_interviews`
--

CREATE TABLE `participant_interviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `participant_id` int(11) UNSIGNED NOT NULL,
  `interview_date_id` int(11) UNSIGNED NOT NULL,
  `result` tinyint(1) UNSIGNED DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) UNSIGNED DEFAULT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_preferences`
--

CREATE TABLE `participant_preferences` (
  `id` int(11) UNSIGNED NOT NULL,
  `participant_id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant_psts`
--

CREATE TABLE `participant_psts` (
  `id` int(11) UNSIGNED NOT NULL,
  `participant_id` int(11) UNSIGNED NOT NULL,
  `end_at` int(11) UNSIGNED NOT NULL,
  `degree` int(3) UNSIGNED DEFAULT NULL,
  `result` int(1) UNSIGNED DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) UNSIGNED DEFAULT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_tests`
--

CREATE TABLE `participant_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `participant_id` int(11) UNSIGNED DEFAULT NULL,
  `degree` int(11) UNSIGNED DEFAULT NULL,
  `result` tinyint(1) UNSIGNED DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) UNSIGNED DEFAULT NULL,
  `preference_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset` tinyint(1) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(70201, 'Member', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70202, 'Team Leader', NULL, '2017-10-11 05:00:00', '2017-10-11 05:00:00'),
(70203, 'Vice Head', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70205, 'Head', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70206, 'Event PM', NULL, '2017-10-11 05:00:00', '2017-10-11 05:00:00'),
(70207, 'Advisor', NULL, '2017-09-10 05:00:00', '2017-09-10 05:00:00'),
(70208, 'Consultant', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70211, 'External Operational Director', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70212, 'Internal Operational Director', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70213, 'External Director', NULL, '2017-09-10 05:00:00', '2017-09-10 05:00:00'),
(70214, 'Designing Director', NULL, '2017-09-10 05:00:00', '2017-09-10 05:00:00'),
(70219, 'Vice President', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70220, 'President', NULL, '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(70221, 'Founder', NULL, '2017-03-29 05:00:00', '2017-03-29 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `steps` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preference_colleges`
--

CREATE TABLE `preference_colleges` (
  `id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED NOT NULL,
  `college_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preference_departments`
--

CREATE TABLE `preference_departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preference_min_academic_year`
--

CREATE TABLE `preference_min_academic_year` (
  `id` int(11) UNSIGNED NOT NULL,
  `preference_id` int(11) UNSIGNED NOT NULL,
  `academic_year_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privacies`
--

CREATE TABLE `privacies` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psts`
--

CREATE TABLE `psts` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'multi-text',
  `question` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `remember` tinyint(1) UNSIGNED DEFAULT NULL,
  `ip` varchar(45) NOT NULL,
  `user_agent` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting_logs`
--

CREATE TABLE `setting_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `setting_id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `social_informations`
--

CREATE TABLE `social_informations` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linked` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unis`
--

CREATE TABLE `unis` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unis`
--

INSERT INTO `unis` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(80101, 'Ain Shams University', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80102, 'Cairo University', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80103, 'Benha (Shobra) University', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80104, 'Helwan (Helwan) University', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80105, 'Helwan (Matareya) University', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80106, 'Al Asher men Ramadan', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80107, 'Al Shorouk', 'main', '2016-11-06 15:07:24', '2016-11-06 15:07:24'),
(80122, 'Nile University ', 'main', '2017-02-20 00:22:20', '2017-02-20 00:22:20'),
(80123, 'Al Azhar University', 'main', '2017-02-22 01:02:25', '2017-02-22 01:02:25'),
(80200, 'Al Shoruok Acadimy', 'other', '2017-03-08 09:31:17', '2017-03-08 09:31:17'),
(80201, 'Alshoruok Acadimy', 'other', '2017-03-08 09:32:38', '2017-03-08 09:32:38'),
(80202, 'HIETT', 'other', '2017-04-21 01:51:54', '2017-04-21 01:51:54'),
(80203, 'New Cairo Academy', 'other', '2017-04-21 02:17:27', '2017-04-21 02:17:27'),
(80204, 'Ain shams university', 'other', '2017-04-21 04:45:43', '2017-04-21 04:45:43'),
(80205, 'Zagazig University', 'main', '2017-04-21 04:49:44', '2017-04-21 04:49:44'),
(80206, 'Benha University', 'main', '2017-04-21 23:21:21', '2017-04-21 23:21:21'),
(80207, 'Higher instante of engineering and technology', 'other', '2017-04-22 00:51:07', '2017-04-22 00:51:07'),
(80208, 'Alexandria University', 'main', '2017-04-23 03:51:38', '2017-04-23 03:51:38'),
(80209, 'obour high insititute for engineering', 'other', '2017-04-24 01:02:42', '2017-04-24 01:02:42'),
(80210, 'Benha  University', 'other', '2017-04-24 02:15:02', '2017-04-24 02:15:02'),
(80211, 'Benha University', 'other', '2017-04-24 03:57:22', '2017-04-24 03:57:22'),
(80212, 'benha university', 'other', '2017-04-24 04:12:50', '2017-04-24 04:12:50'),
(80213, 'Benha', 'other', '2017-04-24 06:02:20', '2017-04-24 06:02:20'),
(80214, 'Benha University', 'other', '2017-04-24 06:28:05', '2017-04-24 06:28:05'),
(80215, 'Assiout university', 'main', '2017-04-27 04:31:10', '2017-04-27 04:31:10'),
(80216, 'Assiut University', 'other', '2017-04-27 06:15:16', '2017-04-27 06:15:16'),
(80217, 'Aswan University', 'main', '2017-04-28 03:32:30', '2017-04-28 03:32:30'),
(80218, 'Arab Academy for Science Technology', 'other', '2017-09-17 21:20:39', '2017-09-17 21:20:39'),
(80219, 'Arab Academy for Science Technology AASTMT', 'other', '2017-09-17 21:21:02', '2017-09-17 21:21:02'),
(80220, 'Arab Academy for Science Technology', 'other', '2017-09-17 21:25:17', '2017-09-17 21:25:17'),
(80221, 'CIC', 'other', '2017-09-18 05:16:49', '2017-09-18 05:16:49'),
(80222, 'Other', 'main', '2017-02-16 09:04:56', '2017-02-16 09:04:56'),
(80223, 'modern academy', 'other', '2017-11-18 11:44:37', '2017-11-18 11:44:37'),
(80224, 'modern academy', 'other', '2017-11-18 11:45:25', '2017-11-18 11:45:25'),
(80225, 'German University In Egypt', 'other', '2017-11-21 04:51:25', '2017-11-21 04:51:25'),
(80226, 'Modern Academy', 'other', '2017-11-21 06:38:53', '2017-11-21 06:38:53'),
(80227, 'Modern Academy', 'other', '2017-11-21 06:39:31', '2017-11-21 06:39:31'),
(80228, 'Modern Acdemy', 'other', '2017-11-21 06:43:26', '2017-11-21 06:43:26'),
(80229, 'Modern Academy', 'other', '2017-11-21 06:44:25', '2017-11-21 06:44:25'),
(80230, 'Sanayaa', 'other', '2017-11-22 20:31:46', '2017-11-22 20:31:46'),
(80231, 'معهد العالى للهندسة الصفوة', 'other', '2017-11-22 20:45:29', '2017-11-22 20:45:29'),
(80232, 'Sanayaa', 'other', '2017-11-24 02:33:40', '2017-11-24 02:33:40'),
(80233, 'Sanayaa', 'other', '2017-11-24 02:34:29', '2017-11-24 02:34:29'),
(80234, 'German University in Cairo', 'other', '2017-11-28 01:17:58', '2017-11-28 01:17:58'),
(80235, 'The american university in cairo', 'other', '2017-12-03 12:08:36', '2017-12-03 12:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_picture`
--

CREATE TABLE `user_profile_picture` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `src` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abilities_name_unique` (`name`) USING BTREE;

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_informations`
--
ALTER TABLE `additional_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additional_informations_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `admin_abilities`
--
ALTER TABLE `admin_abilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_abilities_admin_id_foreign` (`admin_id`),
  ADD KEY `admin_abilities_ability_id_foreign` (`ability_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_magazine_id_foreign` (`magazine_id`);

--
-- Indexes for table `birthdays`
--
ALTER TABLE `birthdays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `birthdays_user_id_foreign` (`user_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_college_id_foreign` (`college_id`);

--
-- Indexes for table `department_group`
--
ALTER TABLE `department_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_informations`
--
ALTER TABLE `educational_informations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `educational_informations_user_id_unique` (`user_id`),
  ADD KEY `educational_informations_uni_id_foreign` (`uni_id`),
  ADD KEY `educational_informations_college_id_foreign` (`college_id`),
  ADD KEY `educational_informations_academic_year_id_foreign` (`academic_year_id`),
  ADD KEY `educational_informations_department_id_foreign` (`department_id`);

--
-- Indexes for table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_confirmations_user_id_foreign` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_discussion_dates`
--
ALTER TABLE `group_discussion_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_discussion_dates_event_id_foreign` (`event_id`),
  ADD KEY `group_discussion_dates_preference_id_foreign` (`preference_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ideas_user_id_foreign` (`user_id`);

--
-- Indexes for table `idea_votes`
--
ALTER TABLE `idea_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idea_votes_user_id_foreign` (`user_id`),
  ADD KEY `idea_votes_idea_id_foreign` (`idea_id`);

--
-- Indexes for table `interview_dates`
--
ALTER TABLE `interview_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interview_dates_event_id_foreign` (`event_id`),
  ADD KEY `interview_dates_preference_id_foreign` (`preference_id`),
  ADD KEY `interview_dates_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailer`
--
ALTER TABLE `mailer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailer_queue`
--
ALTER TABLE `mailer_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mailer_queue_user_id_foreign` (`user_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_user_id_foreign` (`user_id`),
  ADD KEY `members_committee_id_foreign` (`committee_id`),
  ADD KEY `members_position_id_foreign` (`position_id`);

--
-- Indexes for table `mobiles`
--
ALTER TABLE `mobiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`number`),
  ADD KEY `mobiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_user_id_foreign` (`user_id`),
  ADD KEY `participants_event_id_foreign` (`event_id`);

--
-- Indexes for table `participant_group_discussions`
--
ALTER TABLE `participant_group_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_group_discussions_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_group_discussions_group_discussion_date_id_foreign` (`group_discussion_date_id`),
  ADD KEY `participant_group_discussions_preference_id_foreign` (`preference_id`);

--
-- Indexes for table `participant_interviews`
--
ALTER TABLE `participant_interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_interviews_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_interviews_preference_id_foreign` (`preference_id`),
  ADD KEY `participant_interviews_interview_date_id_foreign` (`interview_date_id`);

--
-- Indexes for table `participant_preferences`
--
ALTER TABLE `participant_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_preferences_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_preferences_preference_id_foreign` (`preference_id`);

--
-- Indexes for table `participant_psts`
--
ALTER TABLE `participant_psts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_psts_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_psts_preference_id_foreign` (`preference_id`);

--
-- Indexes for table `participant_tests`
--
ALTER TABLE `participant_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_tests_preference_id_foreign` (`preference_id`),
  ADD KEY `participant_tests_participant_id_foreign` (`participant_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_user_id_foreign` (`user_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferences_event_id_foreign` (`event_id`);

--
-- Indexes for table `preference_colleges`
--
ALTER TABLE `preference_colleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preference_colleges_preference_id_foreign` (`preference_id`),
  ADD KEY `preference_colleges_college_id_foreign` (`college_id`);

--
-- Indexes for table `preference_departments`
--
ALTER TABLE `preference_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preference_departments_department_id_foreign` (`department_id`),
  ADD KEY `preference_departments_preference_id_foreign` (`preference_id`);

--
-- Indexes for table `preference_min_academic_year`
--
ALTER TABLE `preference_min_academic_year`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preference_min_academic_year_preference_id_foreign` (`preference_id`),
  ADD KEY `preference_min_academic_year_academic_year_id_foreign` (`academic_year_id`);

--
-- Indexes for table `privacies`
--
ALTER TABLE `privacies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privacies_user_id_foreign` (`user_id`);

--
-- Indexes for table `psts`
--
ALTER TABLE `psts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `psts_event_id_foreign` (`event_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_logs`
--
ALTER TABLE `setting_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_logs_admin_id_foreign` (`admin_id`),
  ADD KEY `setting_logs_setting_id_foreign` (`setting_id`);

--
-- Indexes for table `social_informations`
--
ALTER TABLE `social_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_informations_user_id_foreign` (`user_id`);

--
-- Indexes for table `unis`
--
ALTER TABLE `unis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`) USING BTREE;

--
-- Indexes for table `user_profile_picture`
--
ALTER TABLE `user_profile_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profile_picture_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80409;
--
-- AUTO_INCREMENT for table `additional_informations`
--
ALTER TABLE `additional_informations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `admin_abilities`
--
ALTER TABLE `admin_abilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `birthdays`
--
ALTER TABLE `birthdays`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;
--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80232;
--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70121;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80333;
--
-- AUTO_INCREMENT for table `department_group`
--
ALTER TABLE `department_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `educational_informations`
--
ALTER TABLE `educational_informations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10203487;
--
-- AUTO_INCREMENT for table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1248;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11007;
--
-- AUTO_INCREMENT for table `group_discussion_dates`
--
ALTER TABLE `group_discussion_dates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40037;
--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `idea_votes`
--
ALTER TABLE `idea_votes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interview_dates`
--
ALTER TABLE `interview_dates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60838;
--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mailer`
--
ALTER TABLE `mailer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;
--
-- AUTO_INCREMENT for table `mailer_queue`
--
ALTER TABLE `mailer_queue`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17111161;
--
-- AUTO_INCREMENT for table `mobiles`
--
ALTER TABLE `mobiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10103460;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17203927;
--
-- AUTO_INCREMENT for table `participant_group_discussions`
--
ALTER TABLE `participant_group_discussions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
--
-- AUTO_INCREMENT for table `participant_interviews`
--
ALTER TABLE `participant_interviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10901858;
--
-- AUTO_INCREMENT for table `participant_preferences`
--
ALTER TABLE `participant_preferences`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8599;
--
-- AUTO_INCREMENT for table `participant_psts`
--
ALTER TABLE `participant_psts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=666;
--
-- AUTO_INCREMENT for table `participant_tests`
--
ALTER TABLE `participant_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70222;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12093;
--
-- AUTO_INCREMENT for table `preference_colleges`
--
ALTER TABLE `preference_colleges`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `preference_departments`
--
ALTER TABLE `preference_departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `preference_min_academic_year`
--
ALTER TABLE `preference_min_academic_year`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `privacies`
--
ALTER TABLE `privacies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1279;
--
-- AUTO_INCREMENT for table `psts`
--
ALTER TABLE `psts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `setting_logs`
--
ALTER TABLE `setting_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_informations`
--
ALTER TABLE `social_informations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10701839;
--
-- AUTO_INCREMENT for table `unis`
--
ALTER TABLE `unis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80236;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21705426;
--
-- AUTO_INCREMENT for table `user_profile_picture`
--
ALTER TABLE `user_profile_picture`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19200203;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_informations`
--
ALTER TABLE `additional_informations`
  ADD CONSTRAINT `additional_informations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin_abilities`
--
ALTER TABLE `admin_abilities`
  ADD CONSTRAINT `admin_abilities_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_abilities_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_magazine_id_foreign` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `birthdays`
--
ALTER TABLE `birthdays`
  ADD CONSTRAINT `birthdays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educational_informations`
--
ALTER TABLE `educational_informations`
  ADD CONSTRAINT `educational_informations_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educational_informations_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educational_informations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educational_informations_uni_id_foreign` FOREIGN KEY (`uni_id`) REFERENCES `unis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educational_informations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  ADD CONSTRAINT `email_confirmations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_discussion_dates`
--
ALTER TABLE `group_discussion_dates`
  ADD CONSTRAINT `group_discussion_dates_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_discussion_dates_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idea_votes`
--
ALTER TABLE `idea_votes`
  ADD CONSTRAINT `idea_votes_idea_id_foreign` FOREIGN KEY (`idea_id`) REFERENCES `ideas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idea_votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interview_dates`
--
ALTER TABLE `interview_dates`
  ADD CONSTRAINT `interview_dates_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interview_dates_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mailer_queue`
--
ALTER TABLE `mailer_queue`
  ADD CONSTRAINT `mailer_queue_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_committee_id_foreign` FOREIGN KEY (`committee_id`) REFERENCES `committees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobiles`
--
ALTER TABLE `mobiles`
  ADD CONSTRAINT `mobiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_group_discussions`
--
ALTER TABLE `participant_group_discussions`
  ADD CONSTRAINT `participant_group_discussions_group_discussion_date_id_foreign` FOREIGN KEY (`group_discussion_date_id`) REFERENCES `group_discussion_dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_group_discussions_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_group_discussions_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_interviews`
--
ALTER TABLE `participant_interviews`
  ADD CONSTRAINT `participant_interviews_interview_date_id_foreign` FOREIGN KEY (`interview_date_id`) REFERENCES `interview_dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_interviews_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_interviews_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_preferences`
--
ALTER TABLE `participant_preferences`
  ADD CONSTRAINT `participant_preferences_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_preferences_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_psts`
--
ALTER TABLE `participant_psts`
  ADD CONSTRAINT `participant_psts_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_psts_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_tests`
--
ALTER TABLE `participant_tests`
  ADD CONSTRAINT `participant_tests_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_tests_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference_colleges`
--
ALTER TABLE `preference_colleges`
  ADD CONSTRAINT `preference_colleges_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preference_colleges_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference_departments`
--
ALTER TABLE `preference_departments`
  ADD CONSTRAINT `preference_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preference_departments_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference_min_academic_year`
--
ALTER TABLE `preference_min_academic_year`
  ADD CONSTRAINT `preference_min_academic_year_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preference_min_academic_year_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privacies`
--
ALTER TABLE `privacies`
  ADD CONSTRAINT `privacies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `psts`
--
ALTER TABLE `psts`
  ADD CONSTRAINT `psts_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setting_logs`
--
ALTER TABLE `setting_logs`
  ADD CONSTRAINT `setting_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setting_logs_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_informations`
--
ALTER TABLE `social_informations`
  ADD CONSTRAINT `social_informations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile_picture`
--
ALTER TABLE `user_profile_picture`
  ADD CONSTRAINT `user_profile_picture_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
