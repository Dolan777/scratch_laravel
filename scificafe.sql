-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2018 at 05:12 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scificafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_track_id` varchar(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `page_type` enum('static','dynamic') NOT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=>Inactive,1=>Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `page_track_id`, `title`, `content`, `page_type`, `added_at`, `updated_at`, `status`) VALUES
(1, '123456789', 'Test', '<p>Hello World!</p>\r\n', 'dynamic', '2018-05-23 00:00:00', '2018-05-23 14:34:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_section`
--

CREATE TABLE `cms_page_section` (
  `id` int(11) NOT NULL COMMENT 'Block ID',
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_content` mediumtext,
  `image` mediumtext,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>Inactive,1=>Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_page_section`
--

INSERT INTO `cms_page_section` (`id`, `page_name`, `section_name`, `section_content`, `image`, `added_at`, `updated_at`, `status`) VALUES
(1, 'Home_Page', 'welcome_image', '', 'zqFRundVpEQ94i.png', '2015-01-02 00:00:00', '2018-05-23 15:11:22', '1'),
(2, 'Home_Page', 'welcome_video', '', 'sljuwaHkEVRqyL.mp4', '2015-01-02 00:00:00', '2018-05-23 15:03:38', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=>New,1=>Read,3=>Delete',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arunava Ghosh', 'arunava.ghosh@infway.us', '9038345917', 'Help', 'Please contact with me.', 1, '2018-05-23 00:00:00', '2018-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `email_content`
--

CREATE TABLE `email_content` (
  `id` int(11) NOT NULL,
  `email_code` varchar(250) DEFAULT NULL,
  `about` text,
  `subject` text,
  `body` text,
  `status` enum('0','1','3') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_content`
--

INSERT INTO `email_content` (`id`, `email_code`, `about`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'registration', 'Registration Mail.', 'Registration', '<div style="text-align: center; color: #3399FF; padding-bottom: 10px; font-size: 16px; font-weight: bold;">Hi {{FULL_NAME}}</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Your account is created in Sci-fi Cafe.</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Here is some important information about your new account.</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Email: {{UEMAIL}}</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Password: {{PASSWORD}}</div>\r\n\r\n<div style="text-align: center; font-size: 13px;"><a href="{{SITE_URL}}" style="background-color: #3399FF; padding:12px 20px; color: #fff; display: inline-block; border-radius: 5px; text-decoration: none;"><img alt="" src="{{RIGHT_ARROW_IMAGE}}" style="padding-right:6px" />Click here</a></div>\r\n', '1', '2014-12-19 00:00:00', '2018-05-23 13:30:14'),
(2, 'forgot_password', 'Forgot Password', 'Forgot Password', '<div style="text-align: center; color: #3399FF; padding-bottom: 10px; font-size: 16px; font-weight: bold;">Hi {{FULL_NAME}}</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Recently you have requested to reset your password</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;">Click the link below to change your password.</div>\r\n\r\n\r\n<div style="text-align: center; font-size: 13px;"><a href="{{SITE_URL}}" style="background-color: #3399FF; padding:12px 20px; color: #fff; display: inline-block; border-radius: 5px; text-decoration: none;"><img alt="" src="{{RIGHT_ARROW_IMAGE}}" style="padding-right:6px" />Click here</a></div>\r\n\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;"> If previous button is not working then copy and paste the below link to your browser url and hit enter.</div>\r\n\r\n<div style="text-align: center; color: #666; padding-bottom: 30px; font-size: 13px;"> {{SITE_URL}}</div>', '1', '2014-12-19 00:00:00', '2018-03-20 09:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answere` text NOT NULL,
  `status` enum('0','1','3') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answere`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Are group lessons better to start with or private lessons?', '<p>This will depend on the student. For many group lessons are a great place to learn the concepts of music and to start to enjoy playing an instrument. Intermediate and advanced students will need private lessons to focus on specific techniques and pieces.</p>\r\n', '0', '2018-04-10 10:27:11', '2018-04-11 03:16:10'),
(3, 'How old do you need to be before starting lessons?', '<p>This will vary for each person. We are looking at starting toddler classes but currently our group lessons are aimed at preschool and school age and above. For individual lessons it also will depend on the instrument. Feel free to contact us for more specific information.</p>\r\n', '0', '2018-04-10 10:27:26', '2018-04-11 03:15:40'),
(4, 'Do I need my own instrument?', '<p>The biggest improvement will come from practise at home. We learn best that way so all students need to have an instrument at home and to bring to lessons (unless it is for keyboard, piano or drums).</p>', '0', '2018-04-11 03:17:51', '2018-04-11 03:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('login','logout') NOT NULL DEFAULT 'login',
  `user_master_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `type`, `user_master_id`, `ip`, `created_at`) VALUES
(1, 'login', 1, '::1', '2018-05-22 13:05:47'),
(2, 'logout', 1, '::1', '2018-05-22 13:05:53'),
(3, 'login', 1, '::1', '2018-05-22 13:05:53'),
(4, 'logout', 1, '::1', '2018-05-23 09:32:00'),
(5, 'login', 1, '::1', '2018-05-23 09:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` bigint(20) NOT NULL,
  `link_id` varchar(128) NOT NULL COMMENT 'it is may be category id or page id or product id etc',
  `slug` varchar(256) NOT NULL,
  `routes_to` varchar(256) NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `link_type` varchar(75) CHARACTER SET utf8 NOT NULL COMMENT 'category,page or product etc'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `link_id`, `slug`, `routes_to`, `meta_title`, `meta_description`, `meta_keywords`, `link_type`) VALUES
(1, '1457515717YZBJEIWAFDCH', 'terms-conditions', 'cms_content/static_page/1457515717YZBJEIWAFDCH', '', '', '', 'static_page');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` set('text','textarea','password','select','select-multiple','radio','checkbox') COLLATE utf8_unicode_ci NOT NULL,
  `default` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL,
  `is_required` int(1) NOT NULL,
  `is_gui` int(1) NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `row_order` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `title`, `description`, `type`, `default`, `value`, `options`, `is_required`, `is_gui`, `module`, `row_order`) VALUES
(1, 'admin_email', 'Admin Email', 'Admin Email', 'text', 'admin@infoway.us', 'admin@infoway.us', '', 1, 1, 'General', 1),
(2, 'admin_contact', 'Admin Contact', 'Admin Contact', 'text', '+9198454646474', '+9198454646474', '', 1, 1, 'General', 2),
(3, 'facebook_url', 'Facebook', '', 'text', 'https://www.facebook.com/', 'https://www.facebook.com', '', 1, 1, 'Social Link', 5),
(5, 'instagram_url', 'Instagram', '', 'text', 'https://www.instagram.com', 'https://www.instagram.com', '', 1, 1, 'Social Link', 4),
(6, 'twitter_url', 'Twitter', '', 'text', 'https://twitter.com/', 'https://twitter.com/MorganMusicAU', '', 1, 1, 'Social Link', 0),
(14, 'support_email', 'Support Email', 'This would be used as a sender email.', 'text', 'support@morganmusic.com', 'support@morganmusic.com', '', 1, 1, 'Support', 4),
(15, 'support_name', 'Support Name', 'In mail this name will be use a sender name', 'text', 'admin', 'Morgan Music Site Support', '', 1, 1, 'Support', 3),
(16, 'paypal_client_id', 'Paypal Client Id', 'Paypal Client Id', 'text', 'ARwMQMvpe5VqNOd_9Lzl7ULVBce9x7Z9Fvga6ATflVggrKuK_PwtNEhVEz3nBje7p08j873F_f_rc94G', 'ARwMQMvpe5VqNOd_9Lzl7ULVBce9x7Z9Fvga6ATflVggrKuK_PwtNEhVEz3nBje7p08j873F_f_rc94G', '', 1, 1, 'Paypal', 1),
(17, 'paypal_secret_id', 'Paypal Secret Id', 'Paypal Secret Id', 'text', 'EG-hdUIZzFdUw404zsH-jbTqQB1kH60swU9V9-ale1TCG_xUxWkH5PDTkeQAL1RhTNeK2R2DZUDdX037', 'EG-hdUIZzFdUw404zsH-jbTqQB1kH60swU9V9-ale1TCG_xUxWkH5PDTkeQAL1RhTNeK2R2DZUDdX037', '', 1, 1, 'Paypal', 2),
(18, 'paypal_currency', 'Paypal Currency', 'Paypal Currency', 'text', 'AUD', 'AUD', '', 1, 1, 'Paypal', 3),
(19, 'gst', 'GST', 'GST', 'text', '10', '10', '', 1, 1, 'General', 3),
(20, 'site_location', 'Site Location', 'Site Location', 'text', 'Shop 1050,Westfield Hornsby 2077', 'Shop 1050,Westfield Hornsby 2077', '', 1, 1, 'Location', 1),
(21, 'site_phone', 'Site Phone No', 'Site Phone No', 'text', '0451 771 768', '0451 771 768', '', 1, 1, 'Location', 2),
(22, 'site_email', 'Site Contact Email', 'Site Contact Email', 'text', 'info@morganmusic.com.au', 'info@morganmusic.com.au', '', 1, 1, 'Location', 3),
(23, 'mailchimp_api_key', 'Mailchimp API Kay', 'Mailchimp API Kay', 'text', 'ac4bb16a6fae70f2490e02587513ec8a-us12', 'ac4bb16a6fae70f2490e02587513ec8a-us12', '', 1, 1, 'Mailchimp', 1),
(24, 'mailchimp_list_id', 'Mailchimp List Id', 'Mailchimp List Id', 'text', '7f9e41abae', '7f9e41abae', '', 1, 1, 'Mailchimp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) NOT NULL,
  `background_image` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `status` enum('0','1','3') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `background_image`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kEs9KMZbuxCVa7.png', 'HOME PAGE BACKGROUD IMAGE', 'Group lessons are currently available for keyboard and guitar.', '1', '2018-03-31 12:49:35', '2018-05-23 14:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `status_master`
--

CREATE TABLE `status_master` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_master`
--

INSERT INTO `status_master` (`status_id`, `status_name`) VALUES
(0, 'InActive'),
(1, 'Active'),
(3, 'Delete'),
(4, 'Yes'),
(5, 'No'),
(6, 'Male'),
(7, 'Female'),
(8, 'Today'),
(11, 'InActive by admin'),
(12, 'Registration Complete'),
(14, 'Registred'),
(16, 'Refund Request'),
(18, 'Exchange'),
(19, 'Expired'),
(20, 'Not Expired'),
(22, 'Cash'),
(25, 'pending'),
(26, 'Confirmed'),
(27, 'Approved'),
(28, 'Under Review'),
(29, 'Cancel'),
(33, 'Gift'),
(38, 'Both'),
(39, 'Read'),
(40, 'UnRead'),
(41, 'Earn'),
(42, 'Spent'),
(45, 'Sales'),
(55, 'New'),
(56, 'Opened'),
(57, 'Closed'),
(58, 'Money back'),
(61, 'Refunded'),
(65, 'Not Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` bigint(20) NOT NULL,
  `user_track_id` varchar(128) NOT NULL,
  `type_id` tinyint(2) DEFAULT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `image` text,
  `password` varchar(128) DEFAULT NULL,
  `password_token` varchar(128) DEFAULT NULL,
  `remember_token` varchar(128) DEFAULT NULL,
  `activation_token` varchar(128) DEFAULT NULL,
  `reset_password_token` varchar(128) DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT '0' COMMENT '0=>in hold ,  1=>active , 2=> block  , 3=>Deleted',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `user_track_id`, `type_id`, `full_name`, `email`, `image`, `password`, `password_token`, `remember_token`, `activation_token`, `reset_password_token`, `status`, `created_at`, `updated_at`, `last_login`) VALUES
(1, '1490508467YHOXMA', 1, 'Super Amin', 'admin@infoway.us', 'hpmTYzgMONF6IP.png', '$2y$10$3UNvMLfh/I5QS30etH6g..GwAVdJEhBj6Zen52Tjfc5vb5p1k1IUe', NULL, NULL, NULL, NULL, '1', '2018-05-22 00:00:00', '2018-05-22 13:31:46', '2018-05-22 00:00:00'),
(2, '', 2, 'Test Artist', NULL, 'oaFWCHwb9MynZU.jpg', NULL, NULL, NULL, NULL, NULL, '1', '2018-05-22 14:04:05', '2018-05-22 14:55:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` tinyint(2) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type_name`, `status`) VALUES
(1, 'Super Admin', '1'),
(2, 'Artist', '1'),
(3, 'Customer', '1'),
(4, 'Guest', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page_section`
--
ALTER TABLE `cms_page_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`page_name`,`section_name`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_content`
--
ALTER TABLE `email_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slug` (`slug`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_master`
--
ALTER TABLE `status_master`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_page_section`
--
ALTER TABLE `cms_page_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Block ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_content`
--
ALTER TABLE `email_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
