-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2015 at 09:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zfiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising`
--

CREATE TABLE IF NOT EXISTS `advertising` (
`id` int(10) unsigned NOT NULL,
  `adsPosition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adsPage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adsContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertising`
--

INSERT INTO `advertising` (`id`, `adsPosition`, `adsPage`, `adsContent`, `created_at`, `updated_at`) VALUES
(1, 'top', 'home', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'bottom', 'home', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'top', 'profile', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'bottom', 'profile', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'top', 'download', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'bottom', 'download', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emailsettings`
--

CREATE TABLE IF NOT EXISTS `emailsettings` (
`id` int(10) unsigned NOT NULL,
  `emailFromName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailFromEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPHostAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPHostPort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMailEncryptionProtocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPServerUsername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPServerPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emailsettings`
--

INSERT INTO `emailsettings` (`id`, `emailFromName`, `emailFromEmail`, `SMTPHostAddress`, `SMTPHostPort`, `EMailEncryptionProtocol`, `SMTPServerUsername`, `SMTPServerPassword`, `created_at`, `updated_at`) VALUES
(1, 'Example', 'example@domain.com', '', '', '', '', '', '0000-00-00 00:00:00', '2015-06-29 22:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE IF NOT EXISTS `emailtemplates` (
`id` int(10) unsigned NOT NULL,
  `emailSubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `emailType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `emailSubject`, `emailContent`, `emailType`, `created_at`, `updated_at`) VALUES
(1, 'You have Received new File/s! ', '', 'sendFilesTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Welcome to Zfiles Upload Center', '', 'welcomeTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Password Reset Request ', '', 'recoverPasswordTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(10) unsigned NOT NULL,
  `filePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileExt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `fileDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileSize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileStatus` int(11) NOT NULL,
  `fileDownloadCounter` int(11) NOT NULL,
  `userIp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lockedfiles`
--

CREATE TABLE IF NOT EXISTS `lockedfiles` (
`id` int(10) unsigned NOT NULL,
  `fileId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `filePassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(10) unsigned NOT NULL,
  `pageOrder` int(11) NOT NULL,
  `pageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(10) unsigned NOT NULL,
  `sitename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_status` int(11) NOT NULL,
  `site_favicon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `email`, `description`, `keywords`, `site_status`, `site_favicon`, `site_logo`, `created_at`, `updated_at`) VALUES
(1, 'Z-Files Upload Center', 'zfiles@shicosoft.com', 'Website Description For SEO', 'Website,Keywords,For,SEO', 1, '', '', '0000-00-00 00:00:00', '2015-06-29 22:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
`id` int(10) unsigned NOT NULL,
  `facebookLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitterLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `googlePlusLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `facebookLink`, `twitterLink`, `googlePlusLink`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '0000-00-00 00:00:00', '2015-06-23 01:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `themecustomize`
--

CREATE TABLE IF NOT EXISTS `themecustomize` (
`id` int(10) unsigned NOT NULL,
  `welcomeText` longtext COLLATE utf8_unicode_ci NOT NULL,
  `someHtml` longtext COLLATE utf8_unicode_ci NOT NULL,
  `someCss` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `themecustomize`
--

INSERT INTO `themecustomize` (`id`, `welcomeText`, `someHtml`, `someCss`, `created_at`, `updated_at`) VALUES
(1, '<h1>The easiest way to Upload & send large files fast ...</h1><p>You Can Upload Your Files Directly It''s Free, Also You Can Signup and Get 5GB !</p>', '', '', '0000-00-00 00:00:00', '2015-06-29 00:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
`id` int(10) unsigned NOT NULL,
  `themeStatus` int(11) NOT NULL,
  `themeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `themeFileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `themeStatus`, `themeName`, `themeFileName`, `created_at`, `updated_at`) VALUES
(1, 0, 'Defualt', 'defualt', '0000-00-00 00:00:00', '2015-06-27 02:17:01'),
(2, 1, 'z-Responsive', 'z-Responsive', '0000-00-00 00:00:00', '2015-07-03 08:08:31');


-- --------------------------------------------------------

--
-- Table structure for table `uploadsettings`
--

CREATE TABLE IF NOT EXISTS `uploadsettings` (
`id` int(10) unsigned NOT NULL,
  `maxFileSize` int(11) NOT NULL,
  `maxUploadsFiles` int(11) NOT NULL,
  `allowedFilesExt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileExpireLimit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userDiskSpace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uploadsettings`
--

INSERT INTO `uploadsettings` (`id`, `maxFileSize`, `maxUploadsFiles`, `allowedFilesExt`, `fileExpireLimit`, `userDiskSpace`, `created_at`, `updated_at`) VALUES
(1, 1073741824, 3, 'png,zip,exe,rar,pdf,docx,jpg', '10', '2147483648', '0000-00-00 00:00:00', '2015-06-29 20:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `last_login`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'mohamedsherif', '$2y$10$zyWAGUtjxoPcS1bZOWAM4OOVORQL1VW8ZiCzExZjvE5qTwYttqnxe', 'mohameedsherif@gmail.com', 'admin', '', '2015-06-17 12:15:15', '2015-06-30 04:41:03', 'QI4uTtxVMQ05SUJLfBdh14XJd3UitSgZ7CuveemWMYrovoUD0OjGTNt5zFXH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertising`
--
ALTER TABLE `advertising`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailsettings`
--
ALTER TABLE `emailsettings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lockedfiles`
--
ALTER TABLE `lockedfiles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reminders`
--
ALTER TABLE `password_reminders`
 ADD KEY `password_reminders_email_index` (`email`), ADD KEY `password_reminders_token_index` (`token`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themecustomize`
--
ALTER TABLE `themecustomize`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploadsettings`
--
ALTER TABLE `uploadsettings`
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
-- AUTO_INCREMENT for table `advertising`
--
ALTER TABLE `advertising`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `emailsettings`
--
ALTER TABLE `emailsettings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lockedfiles`
--
ALTER TABLE `lockedfiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `themecustomize`
--
ALTER TABLE `themecustomize`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `uploadsettings`
--
ALTER TABLE `uploadsettings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
