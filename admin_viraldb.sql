-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2020 at 06:47 AM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_viraldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `addTweet`
--

CREATE TABLE `addTweet` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `memberadvertise`
--

CREATE TABLE `memberadvertise` (
  `id` int(11) NOT NULL,
  `upline_member` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_message` text COLLATE utf8_unicode_ci,
  `redirect_url` text COLLATE utf8_unicode_ci,
  `youtube_video_url` text COLLATE utf8_unicode_ci,
  `active_inactive` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MemberAdvertise`
--

CREATE TABLE `MemberAdvertise` (
  `id` int(11) NOT NULL,
  `upline_member` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `banner_path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `push_message` text COLLATE utf8_unicode_ci,
  `redirect_url` text COLLATE utf8_unicode_ci,
  `youtube_video_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_inactive` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `u_id` int(11) NOT NULL,
  `ibm` varchar(100) NOT NULL,
  `level` int(10) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `btc_add` varchar(100) NOT NULL,
  `user_password` varchar(35) NOT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `refer_ibm` varchar(100) NOT NULL,
  `passad_up_to` varchar(100) DEFAULT NULL,
  `4_by_4` varchar(100) DEFAULT NULL,
  `matrix_level` int(11) DEFAULT NULL,
  `is_root` enum('true','false') NOT NULL DEFAULT 'false',
  `user_role` int(11) NOT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  `gender` varchar(50) DEFAULT NULL,
  `wallet_number` text,
  `wallet_email` varchar(150) DEFAULT NULL,
  `wallet_xpub` text,
  `transaction_password` mediumtext NOT NULL,
  `hash` varchar(32) NOT NULL,
  `accept_emails` enum('0','1') NOT NULL DEFAULT '1',
  `newsletter_hash` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`u_id`, `ibm`, `level`, `first_name`, `last_name`, `btc_add`, `user_password`, `user_email`, `date_register`, `refer_ibm`, `passad_up_to`, `4_by_4`, `matrix_level`, `is_root`, `user_role`, `is_active`, `gender`, `wallet_number`, `wallet_email`, `wallet_xpub`, `transaction_password`, `hash`, `accept_emails`, `newsletter_hash`) VALUES
(1, 'IBM1', NULL, 'Viral', 'Marketer', '1K96WUYfbzPX2Dvm8B4npLkK4zaUo3Grwk', '1fa0c443971f95127522b9af6ce7e13d', 'theviralmarketer2015@gmail.com', '2020-08-18 18:49:17', '', NULL, NULL, NULL, 'true', 0, '1', NULL, '1PjzYXPVpsB8jRKBUQKbA8XpKVWSbUpQgT', 'theviralmarketer2015@gmail.com', 'xpub6DGV4HMDgvFM2ceF9HHrgEe8fvcqqXqQ89pHQxgzTEQFtJaJNzS1w8TjADWLhrFEXA4N9zDTEZ9G6kDaZfbmprK8AW2URaVGNB5a3bqXWr8', 'XH5MDh2D', '', '', ''),
(250, 'IBM20', NULL, 'Abdul', 'Razzaq', '', '036cf57cde8102417ce584a42a142ce8', 'a.razzaq4085@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL, '', 'a.razzaq4085@gmail.com110', '19231moasmio123m1i23j1j039130913', '', 'GLAyjuSW4XlWNgEzSFt9GLGjy0GC7pJC', '1', 'S7eXff14dKn7N8apSmqMfs1zwttsXuX6'),
(235, 'IBM5', NULL, 'test', 'user', '', '1fa0c443971f95127522b9af6ce7e13d', 'mfaizan044@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL, '', 'test@gmail.com402', '19231moasmio123m1i23j1j039130913', '123456', '9QiD3IpL3bcb34lx49r5UwydTRfYoHL1', '1', 'jkAuP7pWCel24Mn2Sr4UYSGiX8k1PDhk'),
(236, 'IBM6', NULL, 'Muhammad', 'Raza', '', '33d403e86a266347fe3d264951eb0720', 'muhammad.r8040@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM5', NULL, 'false', 0, '0', NULL, '', 'muhammad.r8040@gmail.com867', '19231moasmio123m1i23j1j039130913', '', 'EnSWkrbqpmlgOYTiIh1aGd0Uo5trGjf0', '1', 'Q6k1foe77bqsAYIBfa5eTJQuHcXI8SB9'),
(237, 'IBM7', NULL, 'Muhammad', 'Raza', '', '33d403e86a266347fe3d264951eb0720', 'ssdasd123a@gmail.com', '2020-08-19 05:39:50', 'ibm1', '', 'IBM5', NULL, 'false', 0, '0', NULL, '', 'ssdasd123a@gmail.com548', '19231moasmio123m1i23j1j039130913', '', 'AKQM6bwaX5ROnCJaEtkQg0di5DF4Ol36', '1', 'yy5QMObCiwhWFFDHxGTSzbb0Fx6LHUCe'),
(238, 'IBM8', NULL, 'Muhammad', 'Raza', '', '33d403e86a266347fe3d264951eb0720', 'ssdadaasd123a@gmail.com', '2020-08-19 05:39:50', 'ibm1', '', 'IBM5', NULL, 'false', 0, '0', NULL, '', 'ssdadaasd123a@gmail.com665', '19231moasmio123m1i23j1j039130913', '', 'ZzbKshro614nehHwmJSacwrcIuIoejho', '1', '7CPZT7ZSL74ueOMgcKDoabqXwizrHwGg'),
(239, 'IBM9', NULL, 'Muhammad', 'Raza', '', '33d403e86a266347fe3d264951eb0720', 'asdassadoas@gmail.com', '2020-08-19 05:39:50', 'ibm1', '', 'IBM5', NULL, 'false', 0, '0', NULL, '', 'asdassadoas@gmail.com531', '19231moasmio123m1i23j1j039130913', '', 'LPGuARyaQre3krAmjf4Ia4m0dDQDULxB', '1', 'PaZ8oKpb5jGmKfezCflyOAlzQ0dQMx5o'),
(257, 'IBM24', NULL, 'Saad', 'Awan', '', '25f9e794323b453885f5181f1b624d0b', 'saadraza.official@gmail.com', '2020-08-21 12:29:57', 'IBM24', 'IBM1', 'IBM24', NULL, 'false', 0, '1', NULL, '15oPxLtHHiYWLXK8UXujU2A4w5v36vA5Fn', 'saadraza.official@gmail.com163', 'xpub6DGV4HMDgvFMbBkLxx4g1F7FF45KEFVxq5kYHm5tAfxH487AtuSJWpSxZEW4GcTrajaSu6e8NHovLFkpcJb2V8VeHy5To4wj5vjH18EsbFF', '', 'qeSnCWmlj6L6PHiawuXlynxRBeyQIl5k', '1', 'OZfEgHJtP2jJ7hMUUe3qTKBttl06LoWL'),
(241, 'IBM11', NULL, 'Saad', 'Raza', '', '969b01addd342a54e3afc9252b0cad3d', 'bitf18a038@pucit.edu.pk', '2020-08-19 05:39:50', 'IBM1', '', 'IBM2', NULL, 'false', 0, '0', NULL, '', 'bitf18a038@pucit.edu.pk763', '19231moasmio123m1i23j1j039130913', '', '41jfqMNKG5YxGyqUCufb7P1KAXIxK7Ke', '1', 'bQJYtcydQyEQLohCW5kTxj4oGBzRdKbl'),
(242, 'IBM12', NULL, 'Demo ', 'Account', '', '33d403e86a266347fe3d264951eb0720', 'geval86577@aenmail.net', '2020-08-19 05:39:50', 'IBM1', '', 'IBM2', NULL, 'false', 0, '0', NULL, '', 'geval86577@aenmail.net714', '19231moasmio123m1i23j1j039130913', '', '3lSU9W6jeZS3moefqPGmtg2dpkqT8fx0', '1', 'S0KIAuyqhH7fcxp2rbZ15EBtQ7b5PMkd'),
(243, 'IBM13', NULL, 'Saad', 'Ali', '', '33d403e86a266347fe3d264951eb0720', 'saadrazaza771@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM2', NULL, 'false', 0, '0', NULL, '', 'saadrazaza771@gmail.com401', '19231moasmio123m1i23j1j039130913', '', 'Ri6l8HyDx52Qw1E2xtm254bLKhTnDye8', '1', 'X25c895jdjBaNISFZL1cKuoNa1IKsXZZ'),
(244, 'IBM14', NULL, 'Demo', 'asd', '', '33d403e86a266347fe3d264951eb0720', 'rtyygsnbvufs@novaemail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM3', NULL, 'false', 0, '0', NULL, '', 'rtyygsnbvufs@novaemail.com996', '19231moasmio123m1i23j1j039130913', '', 'pU2QyOKRCo8m1BjXfc1FheSKlufdmwc6', '1', 'mrhlnBkS03N2fia1josUSAOpYAwDRXoQ'),
(245, 'IBM15', NULL, 'Muhammad', 'Raza', '', '25f9e794323b453885f5181f1b624d0b', 'saadi@accordmail.net', '2020-08-19 05:39:50', 'IBM5', 'IBM1', 'IBM6', NULL, 'false', 0, '1', NULL, '', 'saadi@accordmail.net159', '19231moasmio123m1i23j1j039130913', '', 'Q8o5xrlQhgjCFZmdbw2Qr3PQqaKR6Pzc', '1', '5esjZInQdg0waylbmgIMWHSN8f5JhhGI'),
(246, 'IBM16', NULL, 'Muhammad', 'Raza', '', '25f9e794323b453885f5181f1b624d0b', 'asdasd@arasj.net', '2020-08-19 05:39:50', 'IBM1', '', 'IBM3', NULL, 'false', 0, '0', NULL, '', 'asdasd@arasj.net160', '19231moasmio123m1i23j1j039130913', '', '1rlufYmbcwhgyQ4HqN9bxZJkHJNHMnDX', '1', 'd9ajR5r3WeKWUf2oRlUg5Jcl1L6ky6Np'),
(247, 'IBM17', NULL, 'Saad', 'Raza', '', '25f9e794323b453885f5181f1b624d0b', 'amirjut7890@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM3', NULL, 'false', 0, '0', NULL, '', 'amirjut7890@gmail.com373', '19231moasmio123m1i23j1j039130913', '', 'SJyqopncIbMFyyp7IROYu1LQcu3ktyGb', '1', 'BzApG3I1mT4ZJXrwjHU18P1IsW3Eog8w'),
(252, 'IBM21', NULL, 'Saad', 'Raza', '', '25f9e794323b453885f5181f1b624d0b', 'saadraza351@gmail.com', '2020-08-21 10:12:15', 'IBM1', '', 'IBM3', NULL, 'false', 0, '1', NULL, '', 'saadraza351@gmail.com334', '19231moasmio123m1i23j1j039130913', '12345678', '7uKdYBkAIiEI1bRDlRtP7awfAfGs6Ocx', '1', 'omOSUBrdZiqxhQeqMWeXprzcijI1B0KA'),
(249, 'IBM19', NULL, 'Muhammad', 'Raza', 'asdae123123asda', '123456789', 'fatima.altaf7786@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL, '', 'fatima.altaf7786@gmail.com802', '19231moasmio123m1i23j1j039130913', '12345678', 'pgehMobISazE7y5cdQzkDpLj3DcFfEI8', '1', 'zuKEAdb4rro9bQFcAdgid4ABat4EaFLD'),
(251, 'IBM21', NULL, 'Abdul', 'Razzaq', '', '01ec974f91ae972f0f135cf21b42d776', 'abdulrazzaq4085@gmail.com', '2020-08-19 05:39:50', 'IBM20', 'IBM1', 'IBM20', NULL, 'false', 0, '1', NULL, '', 'abdulrazzaq4085@gmail.com249', '19231moasmio123m1i23j1j039130913', '', 'YgL59leJ7XCnCKaKwy8gYIjryoCWmfCQ', '1', 'hTigkf7dtDCf4Ue0aD3lrLdXGn5wFXf8'),
(254, 'IBM22', NULL, 'Amir', 'Jutt', '', '25f9e794323b453885f5181f1b624d0b', 'amirjutt.official1@gmail.com', '2020-08-21 11:55:38', 'IBM22', '', 'IBM22', NULL, 'false', 0, '1', NULL, '', 'amirjutt.official1@gmail.com151', '19231moasmio123m1i23j1j039130913', 'd3JcCDJl', 'FGwp9flSax86PxdWalIU8a3sP8gcTMBU', '1', 'WrZBFegu58ohwbHltwHucOyqfgu9NHHM'),
(260, 'IBM25', NULL, 'DEmo', 'Account', '', '25f9e794323b453885f5181f1b624d0b', 'fakeali771@gmail.com', '2020-08-21 14:39:28', 'IBM25', 'IBM1', 'IBM25', NULL, 'false', 0, '1', NULL, '19c3ftXV4yagdz3iRMasusswUKTsMtVPcc', 'fakeali771@gmail.com708', 'xpub6DGV4HMDgvFMjPb2S59esnbYDW8KwM6LiUGntUrqx88Ja69NV1Gdr84phjyWZnQQ4hSQtCGcuAgDUfLJybquCTjZFW4jsAoapwYa71McAr3', '', '6CDi7XFdpXDsKxFnwFZi38Gw7ttxLus8', '1', 'GzXJYW28hFDsW8sm10puSjr6E6GjjI4K'),
(255, 'IBM23', NULL, 'Asim', 'asd', '', '25f9e794323b453885f5181f1b624d0b', 'asim56101@gmail.com', '2020-08-21 11:46:34', 'IBM22', '', 'IBM22', NULL, 'false', 0, '0', NULL, '12FspmFp5uMDp4E8hSsAbmCVeGt1fMErrV', 'asim56101@gmail.com404', 'xpub6DGV4HMDgvFMX8CwWqjEy4jKBRqsf1LPA3By3yMiwa32NTiggBJppw121RdhZjtdjBtC2bfPi1DErm67dGrWZLEPDfkRWbX3B49V66CQroR', '', 'N1LO0bt32kWSuQZM13pt4ql0dlYYIsj1', '1', 'sErwi3sPtIKhObRBZ7a83yYrg2BQs3j5'),
(259, 'IBM25', NULL, 'SAmi', 'Khan', '', '25f9e794323b453885f5181f1b624d0b', 'samiraza7091@gmail.com', '2020-08-21 14:33:07', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL, '1G2FphSjM84Vp86FxzDfCM5PL9gFDtcBRb', 'samiraza7091@gmail.com532', 'xpub6DGV4HMDgvFMi6KMY2ig1k3yoVvwF9FMJCMipwCDg8Yjfhyb4FKZxHCpkz6fBSbCgRkpMGPDsxtekzCULKahm23wQXeQ35RZJpW4uAenG25', '', '3a5h9JQucwhBFFj11dhOw7Bcg2a2JLQY', '1', '1Za7kcOD1DiwS4OFkNiikHUYhJST7rTc'),
(230, 'IBM2', NULL, 'Ephron', 'Maralack', '', '1fa0c443971f95127522b9af6ce7e13d', 'ermaralack@gmail.com', '2020-07-01 19:45:52', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL, '1CdcUkhY1tezLWg2i1MZ6hFrqoL1JfRTcH', 'ermaralack@gmail.com341', 'xpub6DGV4HMDgvFMT47WMjmuE6LjcUda6bTpyZtt1odLtsLmRDAbYpaAg7mcCsgAiyATgvMYYdTbd12BD87m5crFFK8GZFHEk7fZggtfqkUDuw2', 'qarKCRO4', 'jhhYlEpwQbjy3ayARBKmNfoxKFbYWYGj', '1', 'pxwsmD9ALd2RYIHMlGjDNIr7gF1lECXa'),
(233, 'IBM3', NULL, 'muhammad', 'Raza', '', '33d403e86a266347fe3d264951eb0720', 'mraza8040@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM1', NULL, 'false', 0, '0', NULL, '', 'mraza8040@gmail.com893', '19231moasmio123m1i23j1j039130913', '', 'cxAbzA1uBMXiYbiNkdycNaPs1gUOhHe8', '1', '4ZE20Yhi1feI9qZCAsXuCd0obdbcwg1t'),
(234, 'IBM4', NULL, 'live', 'admin', '', '946b3c8c3af70bb9bbd61dd3cfd72f37', 'live2@gmail.com', '2020-08-19 05:39:50', 'IBM1', '', 'IBM1', NULL, 'false', 0, '0', NULL, '', 'live2@gmail.com130', '19231moasmio123m1i23j1j039130913', '', 'qUlpSxg5kDOlMaxrIQXHE4Pen4ale7WJ', '1', 'yhFAY5LboEOhRawymMyzSfWCcw6YmNfD');

-- --------------------------------------------------------

--
-- Table structure for table `members-test`
--

CREATE TABLE `members-test` (
  `u_id` int(11) NOT NULL,
  `ibm` varchar(100) NOT NULL,
  `level` int(10) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `btc_add` varchar(100) NOT NULL,
  `user_password` varchar(35) NOT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `refer_ibm` varchar(100) NOT NULL,
  `passad_up_to` varchar(100) DEFAULT NULL,
  `4_by_4` varchar(100) DEFAULT NULL,
  `matrix_level` int(11) DEFAULT NULL,
  `is_root` enum('true','false') NOT NULL DEFAULT 'false',
  `user_role` int(11) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `gender` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members-test`
--

INSERT INTO `members-test` (`u_id`, `ibm`, `level`, `first_name`, `last_name`, `btc_add`, `user_password`, `user_email`, `date_register`, `refer_ibm`, `passad_up_to`, `4_by_4`, `matrix_level`, `is_root`, `user_role`, `is_active`, `gender`) VALUES
(1, 'IBM1', NULL, 'root', 'root', 'root-btc-123', 'hadi1234', 'hamad.pixiders@gmail.com', '2018-05-07 10:15:44', '', NULL, NULL, NULL, 'true', 0, '1', NULL),
(2, 'IBM2', NULL, 't2', 't', 't2-btc-123', 'test1234', 'ermaralack@gmail.com', '2018-05-07 10:32:26', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL),
(3, 'IBM3', NULL, 't3', 't', '', 'test1234', 't3t@gmail.com', '2018-04-01 02:21:16', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL),
(4, 'IBM4', NULL, 't4', 't', '', 'test1234', 't4t@gmail.com', '2018-04-01 02:21:44', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL),
(5, 'IBM5', NULL, 't5', 't', '', 'test1234', 't5t@gmail.com', '2018-04-01 02:22:17', 'IBM1', '', 'IBM1', NULL, 'false', 0, '1', NULL),
(6, 'IBM6', NULL, 't7', 't', '', 'test1234', 't7t@gmail.com', '2018-04-01 02:24:27', 'IBM1', '', 'IBM2', NULL, 'false', 0, '1', NULL),
(7, 'IBM7', NULL, 't8', 't', '', 'test1234', 't8t@gmail.com', '2018-04-01 02:24:53', 'IBM1', '', 'IBM2', NULL, 'false', 0, '1', NULL),
(8, 'IBM8', NULL, 't9', 't', '', 'test1234', 't9t@gmail.com', '2018-04-01 02:25:22', 'IBM1', '', 'IBM2', NULL, 'false', 0, '1', NULL),
(9, 'IBM9', NULL, 't10', 't', '', 'test1234', 't10t@gmail.com', '2018-04-01 02:25:51', 'IBM1', '', 'IBM2', NULL, 'false', 0, '1', NULL),
(10, 'IBM10', NULL, 't11', 't', '', 'test1234', 't11t@gmail.com', '2018-04-01 02:26:16', 'IBM1', '', 'IBM3', NULL, 'false', 0, '1', NULL),
(11, 'IBM11', NULL, 't12', 't', '', 'test1234', 't12t@gmail.com', '2018-04-01 02:26:46', 'IBM1', '', 'IBM3', NULL, 'false', 0, '1', NULL),
(12, 'IBM12', NULL, 't13', 't', '', 'test1234', 't13t@gmail.com', '2018-04-01 02:27:18', 'IBM1', '', 'IBM3', NULL, 'false', 0, '1', NULL),
(13, 'IBM13', NULL, 't14', 't', '', 'test1234', 't14t@gmail.com', '2018-04-01 02:27:46', 'IBM1', '', 'IBM3', NULL, 'false', 0, '1', NULL),
(14, 'IBM14', NULL, 't15', 't', '', 'test1234', 't15t@gmail.com', '2018-04-01 02:29:17', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL),
(15, 'IBM15', NULL, 't16', 't', '', 'test1234', 't16t@gmail.com', '2018-04-01 02:29:48', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL),
(16, 'IBM16', NULL, 't17', 't', '', 'test1234', 't17t@gmail.com', '2018-04-01 02:30:16', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL),
(17, 'IBM17', NULL, 't18', 't', '', 'test1234', 't18t@gmail.com', '2018-04-01 02:30:55', 'IBM1', '', 'IBM4', NULL, 'false', 0, '1', NULL),
(18, 'IBM18', NULL, 't19', 't', '', 'test1234', 't19t@gmail.com', '2018-04-01 02:31:20', 'IBM1', '', 'IBM5', NULL, 'false', 0, '1', NULL),
(19, 'IBM19', NULL, 't20', 't', '', 'test1234', 't20t@gmail.com', '2018-04-01 02:31:45', 'IBM1', '', 'IBM5', NULL, 'false', 0, '1', NULL),
(20, 'IBM20', NULL, 't21', 't', '', 'test1234', 't21t@gmail.com', '2018-04-01 02:32:20', 'IBM1', '', 'IBM5', NULL, 'false', 0, '1', NULL),
(21, 'IBM21', NULL, 't22', 't', '', 'test1234', 't22t@gmail.com', '2018-04-01 02:32:50', 'IBM1', '', 'IBM5', NULL, 'false', 0, '1', NULL),
(22, 'IBM22', NULL, 't23', 't', '', 'test1234', 't23t@gmail.com', '2018-04-01 02:33:15', 'IBM1', '', 'IBM6', NULL, 'false', 0, '1', NULL),
(23, 'IBM23', NULL, 't24', 't', '', 'test1234', 't24t@gmail.com', '2018-04-01 02:33:40', 'IBM1', '', 'IBM6', NULL, 'false', 0, '1', NULL),
(24, 'IBM24', NULL, 't25', 't', '', 'test1234', 't25t@gmail.com', '2018-04-01 02:34:13', 'IBM1', '', 'IBM6', NULL, 'false', 0, '1', NULL),
(25, 'IBM25', NULL, 't26', 't', '', 'test1234', 't26t@gmail.com', '2018-04-01 02:34:41', 'IBM1', '', 'IBM6', NULL, 'false', 0, '1', NULL),
(26, 'IBM26', NULL, 't27', 't', '', 'test1234', 't27t@gmail.com', '2018-04-01 02:35:06', 'IBM1', '', 'IBM7', NULL, 'false', 0, '1', NULL),
(27, 'IBM27', NULL, 't28', 't', '', 'test1234', 't28t@gmail.com', '2018-04-01 02:35:51', 'IBM1', '', 'IBM7', NULL, 'false', 0, '1', NULL),
(28, 'IBM28', NULL, 't29', 't', '', 'test1234', 't29t@gmail.com', '2018-04-01 02:36:26', 'IBM1', '', 'IBM7', NULL, 'false', 0, '1', NULL),
(29, 'IBM29', NULL, 't30', 't', '', 'test1234', 't30t@gmail.com', '2018-04-01 09:51:47', 'IBM3', 'IBM1', 'IBM10', NULL, 'false', 0, '1', NULL),
(30, 'IBM30', NULL, 't31', 't', '', 'test1234', 't31t@gmail.com', '2018-04-01 09:52:45', 'IBM14', 'IBM1', 'IBM14', NULL, 'false', 0, '1', NULL),
(31, 'IBM31', NULL, 't32', 't', '', 'test1234', 't32t@gmail.com', '2018-04-01 09:53:08', 'IBM14', '', 'IBM14', NULL, 'false', 0, '1', NULL),
(32, 'IBM32', NULL, 't33', 't', '', 'test1234', 't33t@gmail.com', '2018-04-01 19:01:01', 'IBM2', 'IBM1', 'IBM7', NULL, 'false', 0, '1', NULL),
(33, 'IBM33', NULL, 't34', 't', '', 'test1234', 't34t@gmail.com', '2018-04-01 19:01:37', 'IBM2', '', 'IBM8', NULL, 'false', 0, '1', NULL),
(34, 'IBM34', NULL, 't35', 't', '', 'test1234', 't35t@gmail.com', '2018-04-01 19:02:11', 'IBM2', 'IBM1', 'IBM8', NULL, 'false', 0, '1', NULL),
(35, 'IBM35', NULL, 't36', 't', '', 'test1234', 't36t@gmail.com', '2018-04-01 19:02:55', 'IBM2', '', 'IBM8', NULL, 'false', 0, '1', NULL),
(36, 'IBM36', NULL, 't37', 't', '', 'test1234', 't37t@gmail.com', '2018-04-01 19:03:41', 'IBM2', 'IBM1', 'IBM8', NULL, 'false', 0, '1', NULL),
(37, 'IBM37', NULL, 't40', 't', '', 'test1234', 't40t@gmail.com', '2018-04-02 06:59:24', 'IBM29', 'IBM1', 'IBM29', NULL, 'false', 0, '1', NULL),
(38, 'IBM38', NULL, 't41', 't', '', 'test1234', 't41t@gmail.com', '2018-04-02 07:00:13', 'IBM29', '', 'IBM29', NULL, 'false', 0, '1', NULL),
(39, 'IBM39', NULL, 't42', 't', '', 'test1234', 't42t@gmail.com', '2018-04-02 07:00:36', 'IBM29', 'IBM1', 'IBM29', NULL, 'false', 0, '1', NULL),
(40, 'IBM40', NULL, 't43', 't', '', 'test1234', 't43t@gmail.com', '2018-04-02 07:01:04', 'IBM29', '', 'IBM29', NULL, 'false', 0, '1', NULL),
(41, 'IBM41', NULL, 't44', 't', '', 'test1234', 't44t@gmail.com', '2018-04-02 07:01:41', 'IBM29', 'IBM1', 'IBM37', NULL, 'false', 0, '1', NULL),
(42, 'IBM42', NULL, 't45', 't', '', 'test1234', 't45t@gmail.com', '2018-04-02 07:02:03', 'IBM29', '', 'IBM37', NULL, 'false', 0, '1', NULL),
(43, 'IBM43', NULL, 't46', 't', '', 'test1234', 't46t@gmail.com', '2018-04-02 07:02:27', 'IBM29', 'IBM1', 'IBM37', NULL, 'false', 0, '1', NULL),
(44, 'IBM44', NULL, 't47', 't', '', 'test1234', 't47t@gmail.com', '2018-04-02 07:05:52', 'IBM37', 'IBM1', 'IBM37', NULL, 'false', 0, '1', NULL),
(45, 'IBM45', NULL, 't50', 't', '', 'test1234', 't50t@gmail.com', '2018-04-02 09:00:04', 'IBM5', 'IBM1', 'IBM18', NULL, 'false', 0, '1', NULL),
(46, 'IBM46', NULL, 't51', 't', '', 'test1234', 't51t@gmail.com', '2018-04-02 09:01:26', 'IBM45', 'IBM1', 'IBM45', NULL, 'false', 0, '1', NULL),
(47, 'IBM47', NULL, 't52', 't', '', 'test1234', 't52t@gmail.com', '2018-04-02 09:16:50', 'IBM46', 'IBM1', 'IBM46', NULL, 'false', 0, '1', NULL),
(48, 'IBM48', NULL, 't1', 't', '', 'test1234', 't1t@gmail.com', '2018-04-03 18:59:16', 'IBM1', '', 'IBM9', NULL, 'false', 0, '1', NULL),
(49, 'IBM49', NULL, 't60', 't', '', 'test1234', 't60t@gmail.com', '2018-04-05 07:27:50', 'IBM7', 'IBM1', 'IBM26', NULL, 'false', 0, '1', NULL),
(50, 'IBM50', NULL, 't61', 't', '', 'test1234', 't61t@gmail.com', '2018-04-05 07:34:37', 'IBM49', 'IBM1', 'IBM49', NULL, 'false', 0, '1', NULL),
(51, 'IBM51', NULL, 't62', 't', '', 'test1234', 't62t@gmail.com', '2018-04-05 07:37:51', 'IBM50', 'IBM1', 'IBM50', NULL, 'false', 0, '1', NULL),
(52, 'IBM52', NULL, 't63', 't', '', 'test1234', 't63t@gmail.com', '2018-04-05 10:09:27', 'IBM31', 'IBM14', 'IBM31', NULL, 'false', 0, '1', NULL),
(53, 'IBM53', NULL, 't64', 't', '', 'test1234', 't64t@gmail.com', '2018-04-05 10:10:45', 'IBM52', 'IBM14', 'IBM52', NULL, 'false', 0, '1', NULL),
(54, 'IBM54', NULL, 't65', 't', '', 'test1234', 't65t@gmail.com', '2018-04-09 01:10:21', 'IBM51', 'IBM1', 'IBM51', NULL, 'false', 0, '1', NULL),
(55, 'IBM55', NULL, 't66', 't', '', 'test1234', 't66t@gmail.com', '2018-04-09 01:11:43', 'IBM54', 'IBM1', 'IBM54', NULL, 'false', 0, '1', NULL),
(56, 'IBM56', NULL, 't67', 't', '', 'test1234', 't67t@gmail.com', '2018-04-09 01:12:47', 'IBM55', 'IBM1', 'IBM55', NULL, 'false', 0, '1', NULL),
(57, 'IBM57', NULL, 't70', 't', '', 'test1234', 't70t@gmail.com', '2018-04-11 02:16:38', 'IBM47', 'IBM1', 'IBM47', NULL, 'false', 0, '1', NULL),
(58, 'IBM58', NULL, 't71', 't', '', 'test1234', 't71t@gmail.com', '2018-04-11 02:18:09', 'IBM57', 'IBM1', 'IBM57', NULL, 'false', 0, '1', NULL),
(59, 'IBM59', NULL, 't72', 't', '', 'test1234', 't72t@gmail.com', '2018-04-11 02:19:35', 'IBM58', 'IBM1', 'IBM58', NULL, 'false', 0, '1', NULL),
(60, 'IBM60', NULL, 't73', 't', '', 'test1234', 't73t@gmail.com', '2018-04-11 02:20:53', 'IBM59', 'IBM1', 'IBM59', NULL, 'false', 0, '1', NULL),
(61, 'IBM61', NULL, 't74', 't', '', 'test1234', 't74t@gmail.com', '2018-04-11 02:22:30', 'IBM60', 'IBM1', 'IBM60', NULL, 'false', 0, '1', NULL),
(62, 'IBM62', NULL, 't75', 't', '', 'test1234', 't75t@gmail.com', '2018-04-11 02:23:27', 'IBM61', 'IBM1', 'IBM61', NULL, 'false', 0, '1', NULL),
(63, 'IBM63', NULL, 't80', 't', '', 'test1234', 't80t@gmail.com', '2018-04-11 18:40:04', 'IBM6', 'IBM1', 'IBM22', NULL, 'false', 0, '1', NULL),
(64, 'IBM64', NULL, 't81', 't', '', 'test1234', 't81t@gmail.com', '2018-04-11 18:42:00', 'IBM6', '', 'IBM22', NULL, 'false', 0, '1', NULL),
(65, 'IBM65', NULL, 't82', 't', '', 'test1234', 't82t@gmail.com', '2018-04-11 18:42:36', 'IBM6', 'IBM1', 'IBM22', NULL, 'false', 0, '1', NULL),
(66, 'IBM66', NULL, 't83', 't', '', 'test1234', 't83t@gmail.com', '2018-04-11 18:43:02', 'IBM6', '', 'IBM22', NULL, 'false', 0, '1', NULL),
(67, 'IBM67', NULL, 't84', 't', '', 'test1234', 't84t@gmail.com', '2018-04-11 18:43:28', 'IBM6', 'IBM1', 'IBM23', NULL, 'false', 0, '1', NULL),
(68, 'IBM68', NULL, 't85', 't', '', 'test1234', 't85t@gmail.com', '2018-04-11 18:43:58', 'IBM6', '', 'IBM23', NULL, 'false', 0, '1', NULL),
(69, 'IBM69', NULL, 't86', 't', '', 'test1234', 't86t@gmail.com', '2018-04-11 18:45:26', 'IBM6', 'IBM1', 'IBM23', NULL, 'false', 0, '1', NULL),
(70, 'IBM70', NULL, 't87', 't', '', 'test1234', 't87t@gmail.com', '2018-04-11 18:45:54', 'IBM6', '', 'IBM23', NULL, 'false', 0, '1', NULL),
(71, 'IBM71', NULL, 't88', 't', '', 'test1234', 't88t@gmail.com', '2018-04-11 18:46:18', 'IBM6', 'IBM1', 'IBM24', NULL, 'false', 0, '1', NULL),
(72, 'IBM72', NULL, 't89', 't', '', 'test1234', 't89t@gmail.com', '2018-04-11 18:46:47', 'IBM6', '', 'IBM24', NULL, 'false', 0, '1', NULL),
(73, 'IBM73', NULL, 't90', 't', '', 'test1234', 't90t@gmail.com', '2018-04-11 18:47:41', 'IBM6', 'IBM1', 'IBM24', NULL, 'false', 0, '1', NULL),
(74, 'IBM74', NULL, 't91', 't', '', 'test1234', 't91t@gmail.com', '2018-04-11 19:14:20', 'IBM67', 'IBM1', 'IBM67', NULL, 'false', 0, '1', NULL),
(75, 'IBM75', NULL, 't92', 't', '', 'test1234', 't92t@gmail.com', '2018-04-11 19:14:50', 'IBM67', '', 'IBM67', NULL, 'false', 0, '1', NULL),
(76, 'IBM76', NULL, 't93', 't', '', 'test1234', 't93t@gmail.com', '2018-04-11 19:15:15', 'IBM67', 'IBM1', 'IBM67', NULL, 'false', 0, '1', NULL),
(77, 'IBM77', NULL, 't94', 't', '', 'test1234', 't94t@gmail.com', '2018-04-11 19:15:46', 'IBM67', '', 'IBM67', NULL, 'false', 0, '1', NULL),
(78, 'IBM78', NULL, 't95', 't', '', 'test1234', 't95t@gmail.com', '2018-04-11 19:16:20', 'IBM67', 'IBM1', 'IBM74', NULL, 'false', 0, '1', NULL),
(79, 'IBM79', NULL, 't96', 't', '', 'test1234', 't96t@gmail.com', '2018-04-11 19:16:50', 'IBM67', '', 'IBM74', NULL, 'false', 0, '1', NULL),
(80, 'IBM80', NULL, 't97', 't', '', 'test1234', 't97t@gmail.com', '2018-04-11 19:20:29', 'IBM63', 'IBM1', 'IBM63', NULL, 'false', 0, '1', NULL),
(81, 'IBM81', NULL, 't98', 't', '', 'test1234', 't98t@gmail.com', '2018-04-11 19:23:31', 'IBM63', '', 'IBM63', NULL, 'false', 0, '1', NULL),
(82, 'IBM82', NULL, 't99', 't', '', 'test1234', 't99t@gmail.com', '2018-04-11 19:23:55', 'IBM63', 'IBM1', 'IBM63', NULL, 'false', 0, '1', NULL),
(83, 'IBM83', NULL, 't100', 't', '', 'test1234', 't100t@gmail.com', '2018-04-11 19:24:19', 'IBM63', '', 'IBM63', NULL, 'false', 0, '1', NULL),
(84, 'IBM84', NULL, 't110', 't', '', 'test1234', 't110t@gmail.com', '2018-04-14 07:12:21', 'IBM16', 'IBM1', 'IBM16', NULL, 'false', 0, '1', NULL),
(85, 'IBM85', NULL, 't111', 't', '', 'test1234', 't111t@gmail.com', '2018-04-14 07:12:55', 'IBM16', '', 'IBM16', NULL, 'false', 0, '1', NULL),
(86, 'IBM86', NULL, 't112', 't', '', 'test1234', 't112t@gmail.com', '2018-04-14 07:13:21', 'IBM16', 'IBM1', 'IBM16', NULL, 'false', 0, '1', NULL),
(87, 'IBM87', NULL, 't113', 't', '', 'test1234', 't113t@gmail.com', '2018-04-14 07:13:49', 'IBM16', '', 'IBM16', NULL, 'false', 0, '1', NULL),
(88, 'IBM88', NULL, 't114', 't', '', 'test1234', 't114t@gmail.com', '2018-04-14 07:14:19', 'IBM16', 'IBM1', 'IBM84', NULL, 'false', 0, '1', NULL),
(89, 'IBM89', NULL, 't115', 't', '', 'test1234', 't115t@gmail.com', '2018-04-14 07:18:03', 'IBM16', '', 'IBM84', NULL, 'false', 0, '1', NULL),
(90, 'IBM90', NULL, 't116', 't', '', 'test1234', 't116t@gmail.com', '2018-04-14 07:18:28', 'IBM16', 'IBM1', 'IBM84', NULL, 'false', 0, '1', NULL),
(91, 'IBM91', NULL, 't117', 't', '', 'test1234', 't117t@gmail.com', '2018-04-14 07:18:57', 'IBM16', '', 'IBM84', NULL, 'false', 0, '1', NULL),
(92, 'IBM92', NULL, 't118', 't', '', 'test1234', 't118t@gmail.com', '2018-04-14 07:19:17', 'IBM16', 'IBM1', 'IBM85', NULL, 'false', 0, '1', NULL),
(93, 'IBM93', NULL, 't119', 't', '', 'test1234', 't119t@gmail.com', '2018-04-14 07:19:44', 'IBM16', '', 'IBM85', NULL, 'false', 0, '1', NULL),
(94, 'IBM94', NULL, 't120', 't', '', 'test1234', 't120t@gmail.com', '2018-04-14 08:02:06', 'IBM84', 'IBM1', 'IBM88', NULL, 'false', 0, '1', NULL),
(95, 'IBM95', NULL, 't121', 't', '', 'test1234', 't121t@gmail.com', '2018-04-14 08:13:43', 'IBM94', 'IBM1', 'IBM94', NULL, 'false', 0, '1', NULL),
(96, 'IBM96', NULL, 't122', 't', '', 'test1234', 't122t@gmail.com', '2018-04-14 09:56:55', 'IBM95', 'IBM1', 'IBM95', NULL, 'false', 0, '1', NULL),
(97, 'IBM97', NULL, 't123', 't', '', 'test1234', 't123t@gmail.com', '2018-04-14 09:59:24', 'IBM96', 'IBM1', 'IBM96', NULL, 'false', 0, '1', NULL),
(98, 'IBM98', NULL, 't124', 't', '', 'test1234', 't124t@gmail.com', '2018-04-14 10:03:33', 'IBM97', 'IBM1', 'IBM97', NULL, 'false', 0, '1', NULL),
(99, 'IBM99', NULL, 't125', 't', '', 'test1234', 't125t@gmail.com', '2018-04-14 10:04:40', 'IBM98', 'IBM1', 'IBM98', NULL, 'false', 0, '1', NULL),
(100, 'IBM100', NULL, 't126', 't', '', 'test1234', 't126t@gmail.com', '2018-04-14 10:50:29', 'IBM99', 'IBM1', 'IBM99', NULL, 'false', 0, '1', NULL),
(110, 'IBM109', NULL, 't150', 't', '', 'test1234', 't150t@gmail.com', '2018-04-21 07:35:04', 'IBM1', '', 'IBM9', NULL, 'false', 0, '1', NULL),
(102, 'IBM102', NULL, 't128', 't', '', 'test1234', 't128t@gmail.com', '2018-04-14 10:54:18', 'IBM100', '', 'IBM100', NULL, 'false', 0, '1', NULL),
(103, 'IBM103', NULL, 't129', 't', '', 'test1234', 't129t@gmail.com', '2018-04-14 10:56:08', 'IBM99', '', 'IBM99', NULL, 'false', 0, '1', NULL),
(104, 'IBM104', NULL, 't130', 't', '', 'test1234', 't130t@gmail.com', '2018-04-14 10:57:41', 'IBM102', 'IBM100', 'IBM102', NULL, 'false', 0, '1', NULL),
(105, 'IBM105', NULL, 't131', 't', '', 'test1234', 't131t@gmail.com', '2018-04-14 10:58:46', 'IBM104', 'IBM100', 'IBM104', NULL, 'false', 0, '1', NULL),
(106, 'IBM106', NULL, 't132', 't', '', 'test1234', 't132t@gmail.com', '2018-04-14 10:59:54', 'IBM105', 'IBM100', 'IBM105', NULL, 'false', 0, '1', NULL),
(107, 'IBM107', NULL, 't133', 't', '', 'test1234', 't133t@gmail.com', '2018-04-14 11:01:05', 'IBM106', 'IBM100', 'IBM106', NULL, 'false', 0, '1', NULL),
(108, 'IBM108', NULL, 't134', 't', '', 'test1234', 't134t@gmail.com', '2018-04-14 11:02:06', 'IBM107', 'IBM100', 'IBM107', NULL, 'false', 0, '1', NULL),
(109, 'IBM109', NULL, 't135', 't', '', 'test1234', 't135t@gmail.com', '2018-04-14 11:03:20', 'IBM108', 'IBM100', 'IBM108', NULL, 'false', 0, '1', NULL),
(111, 'IBM110', NULL, 't151', 't', '', 'test1234', 't151t@gmail.com', '2018-04-21 07:35:53', 'IBM1', '', 'IBM9', NULL, 'false', 0, '1', NULL),
(112, 'IBM111', NULL, 't152', 't', '', 'test1234', 't152t@gmail.com', '2018-04-21 07:36:22', 'IBM1', '', 'IBM9', NULL, 'false', 0, '1', NULL),
(113, 'IBM112', NULL, 't153', 't', '', 'test1234', 't153t@gmail.com', '2018-04-21 07:36:52', 'IBM1', '', 'IBM10', NULL, 'false', 0, '1', NULL),
(114, 'IBM113', NULL, 't154', 't', '', 'test1234', 't154t@gmail.com', '2018-04-21 07:37:16', 'IBM1', '', 'IBM10', NULL, 'false', 0, '1', NULL),
(115, 'IBM114', NULL, 't155', 't', '', 'test1234', 't155t@gmail.com', '2018-04-21 07:37:41', 'IBM1', '', 'IBM10', NULL, 'false', 0, '1', NULL),
(116, 'IBM115', NULL, 't156', 't', '', 'test1234', 't156t@gmail.com', '2018-04-21 07:38:09', 'IBM1', '', 'IBM11', NULL, 'false', 0, '1', NULL),
(117, 'IBM116', NULL, 't157', 't', '', 'test1234', 't157t@gmail.com', '2018-04-21 07:38:35', 'IBM1', '', 'IBM11', NULL, 'false', 0, '1', NULL),
(118, 'IBM117', NULL, 't158', 't', '', 'test1234', 't158t@gmail.com', '2018-04-21 07:38:58', 'IBM1', '', 'IBM11', NULL, 'false', 0, '1', NULL),
(119, 'IBM118', NULL, 't159', 't', '', 'test1234', 't159t@gmail.com', '2018-04-21 07:39:23', 'IBM1', '', 'IBM11', NULL, 'false', 0, '1', NULL),
(120, 'IBM119', NULL, 't160', 't', '', 'test1234', 't160t@gmail.com', '2018-04-21 07:39:57', 'IBM1', '', 'IBM12', NULL, 'false', 0, '1', NULL),
(121, 'IBM120', NULL, 't161', 't', '', 'test1234', 't161t@gmail.com', '2018-04-21 07:40:28', 'IBM1', '', 'IBM12', NULL, 'false', 0, '1', NULL),
(122, 'IBM121', NULL, 't162', 't', '', 'test1234', 't162t@gmail.com', '2018-04-21 07:41:04', 'IBM1', '', 'IBM12', NULL, 'false', 0, '1', NULL),
(123, 'IBM122', NULL, 't163', 't', '', 'test1234', 't163t@gmail.com', '2018-04-21 07:41:26', 'IBM1', '', 'IBM12', NULL, 'false', 0, '1', NULL),
(124, 'IBM123', NULL, 't164', 't', '', 'test1234', 't164t@gmail.com', '2018-04-21 07:41:51', 'IBM1', '', 'IBM13', NULL, 'false', 0, '1', NULL),
(125, 'IBM124', NULL, 't165', 't', '', 'test1234', 't165t@gmail.com', '2018-04-21 07:42:12', 'IBM1', '', 'IBM13', NULL, 'false', 0, '1', NULL),
(126, 'IBM125', NULL, 't170', 't ', '', 'test1234', 't170t@gmail.com', '2018-04-23 11:32:52', 'IBM110', 'IBM1', 'IBM110', NULL, 'false', 0, '1', NULL),
(127, 'IBM126', NULL, 't171', 't', '', 'test1234', 't171t@gmail.com', '2018-04-23 12:04:50', 'IBM125', 'IBM1', 'IBM125', NULL, 'false', 0, '1', NULL),
(128, 'IBM127', NULL, 't172', 't', '', 'test1234', 't172t@gmail.com', '2018-04-23 12:06:49', 'IBM126', 'IBM1', 'IBM126', NULL, 'false', 0, '1', NULL),
(129, 'IBM128', NULL, 't173', 't', '', 'test1234', 't173t@gmail.com', '2018-04-23 12:08:30', 'IBM127', 'IBM1', 'IBM127', NULL, 'false', 0, '1', NULL),
(130, 'IBM129', NULL, 't174', 't', '', 'test1234', 't174t@gmail.com', '2018-04-23 12:09:53', 'IBM128', 'IBM1', 'IBM128', NULL, 'false', 0, '1', NULL),
(131, 'IBM130', NULL, 't175', 't', '', 'test1234', 't175t@gmail.com', '2018-04-23 12:11:47', 'IBM129', 'IBM1', 'IBM129', NULL, 'false', 0, '1', NULL),
(132, 'IBM131', NULL, 't176', 't', '', 'test1234', 't176t@gmail.com', '2018-04-23 12:14:39', 'IBM130', 'IBM1', 'IBM130', NULL, 'false', 0, '1', NULL),
(133, 'IBM132', NULL, 't177', 't', '', 'test1234', 't177t@gmail.com', '2018-04-23 12:16:42', 'IBM131', 'IBM1', 'IBM131', NULL, 'false', 0, '1', NULL),
(134, 'IBM133', NULL, 't178', 't', '', 'test1234', 't178t@gmail.com', '2018-04-23 12:17:56', 'IBM132', 'IBM1', 'IBM132', NULL, 'false', 0, '1', NULL),
(135, 'IBM134', NULL, 't179', 't', '', 'test1234', 't179t@gmail.com', '2018-04-23 12:20:09', 'IBM133', 'IBM1', 'IBM133', NULL, 'false', 0, '1', NULL),
(136, 'IBM135', NULL, 't180 ', 't', '', 'test1234', 't180t@gmail.com', '2018-04-23 12:22:21', 'IBM134', 'IBM1', 'IBM134', NULL, 'false', 0, '1', NULL),
(137, 'IBM136', NULL, 't181', 't', '', 'test1234', 't181t@gmail.com', '2018-04-23 12:28:15', 'IBM135', 'IBM1', 'IBM135', NULL, 'false', 0, '1', NULL),
(138, 'IBM137', NULL, 't182', 't', '', 'test1234', 't182t@gmail.com', '2018-04-23 12:30:02', 'IBM136', 'IBM1', 'IBM136', NULL, 'false', 0, '1', NULL),
(139, 'IBM138', NULL, 't183', 't', '', 'test1234', 't183t@gmail.com', '2018-04-23 12:31:19', 'IBM137', 'IBM1', 'IBM137', NULL, 'false', 0, '1', NULL),
(140, 'IBM139', NULL, 't184', 't', '', 'test1234', 't184t@gmail.com', '2018-04-23 12:32:23', 'IBM138', 'IBM1', 'IBM138', NULL, 'false', 0, '1', NULL),
(141, 'IBM140', NULL, 't185', 't', '', 'test1234', 't185t@gmail.com', '2018-04-23 12:45:21', 'IBM139', 'IBM1', 'IBM139', NULL, 'false', 0, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members_otp_codes`
--

CREATE TABLE `members_otp_codes` (
  `otp_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `otp_code` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actions` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members_otp_codes`
--

INSERT INTO `members_otp_codes` (`otp_id`, `member_id`, `otp_code`, `created_date`, `actions`) VALUES
(1, 1, '647596', '2020-08-18 18:39:05', ''),
(2, 1, '139243', '2020-08-18 18:40:07', ''),
(3, 235, '636503', '2020-08-18 18:40:27', ''),
(4, 1, '282924', '2020-08-18 20:16:28', ''),
(5, 250, '218882', '2020-08-19 07:15:11', ''),
(6, 1, '390005', '2020-08-19 08:58:23', ''),
(7, 1, '973861', '2020-08-19 14:58:17', ''),
(8, 235, '498112', '2020-08-20 00:20:14', ''),
(9, 235, '715120', '2020-08-20 00:32:53', ''),
(10, 235, '125255', '2020-08-20 00:34:39', ''),
(11, 1, '953614', '2020-08-20 09:30:25', ''),
(12, 235, '697690', '2020-08-20 15:32:29', ''),
(13, 235, '286215', '2020-08-20 15:35:42', '1'),
(14, 235, '110051', '2020-08-20 16:13:05', '1'),
(15, 1, '615091', '2020-08-20 16:13:45', '1'),
(16, 1, '941632', '2020-08-20 16:15:08', '1'),
(17, 1, '580944', '2020-08-20 16:39:27', '1'),
(18, 1, '521647', '2020-08-20 16:39:35', '1'),
(19, 235, '666113', '2020-08-20 16:39:52', '1'),
(20, 1, '462164', '2020-08-20 17:24:44', '1'),
(21, 1, '227582', '2020-08-21 09:12:05', '1'),
(22, 1, '599834', '2020-08-21 09:31:14', '1'),
(23, 235, '201724', '2020-08-21 09:36:06', '1'),
(24, 252, '945784', '2020-08-21 10:10:28', '1'),
(25, 252, '803649', '2020-08-21 10:12:28', '1'),
(26, 252, '643633', '2020-08-21 10:16:14', '1'),
(27, 252, '220986', '2020-08-21 10:16:14', '1'),
(28, 252, '425823', '2020-08-21 10:17:10', '1'),
(29, 253, '235230', '2020-08-21 10:29:37', '1'),
(30, 1, '463283', '2020-08-21 10:58:33', '1'),
(31, 1, '346221', '2020-08-21 11:02:36', '1'),
(32, 235, '176550', '2020-08-21 11:20:11', '1'),
(33, 235, '260056', '2020-08-21 11:20:35', '1'),
(34, 1, '835261', '2020-08-21 11:21:54', '1'),
(35, 1, '836155', '2020-08-21 11:22:00', '1'),
(36, 1, '815379', '2020-08-21 12:18:11', '1'),
(37, 1, '345373', '2020-08-21 12:18:29', '1'),
(38, 256, '912707', '2020-08-21 12:18:38', '1'),
(39, 1, '994893', '2020-08-21 12:43:29', '1'),
(40, 1, '918394', '2020-08-21 12:47:33', '1'),
(41, 1, '616301', '2020-08-21 12:47:41', '1'),
(42, 1, '654604', '2020-08-21 12:48:22', '1'),
(43, 1, '131492', '2020-08-21 12:51:16', '1'),
(44, 1, '505230', '2020-08-21 12:51:24', '1'),
(45, 1, '892741', '2020-08-21 14:04:02', '1'),
(46, 1, '545670', '2020-08-21 14:33:15', '1'),
(47, 1, '803101', '2020-08-21 14:33:41', '1'),
(48, 259, '547446', '2020-08-21 14:33:52', '1'),
(49, 259, '532194', '2020-08-21 14:36:06', '1'),
(50, 259, '191491', '2020-08-21 15:14:26', '1'),
(51, 254, '177801', '2020-08-21 15:18:09', '1'),
(52, 1, '805447', '2020-08-21 17:02:07', '1'),
(53, 1, '565674', '2020-08-21 17:16:18', '1'),
(54, 1, '892080', '2020-08-21 17:27:14', '1'),
(55, 1, '258127', '2020-08-21 17:28:43', '1'),
(56, 1, '750550', '2020-08-21 17:28:47', '1'),
(57, 235, '203734', '2020-08-21 17:32:15', '1'),
(58, 1, '899830', '2020-08-21 17:50:24', '1'),
(59, 259, '597715', '2020-08-21 18:01:13', '2'),
(60, 1, '567626', '2020-08-21 19:47:52', '2'),
(61, 1, '335057', '2020-08-21 20:02:17', '2'),
(62, 1, '702224', '2020-08-22 12:58:39', '2'),
(63, 1, '379084', '2020-08-22 12:59:01', '2'),
(64, 1, '749891', '2020-08-22 16:03:14', '2'),
(65, 235, '662404', '2020-08-22 18:09:42', '2'),
(66, 1, '773925', '2020-08-22 18:16:44', '2'),
(67, 1, '527230', '2020-08-23 06:53:27', '2'),
(68, 235, '478923', '2020-08-23 10:16:58', '1'),
(69, 235, '476201', '2020-08-23 10:41:54', '2'),
(70, 235, '503745', '2020-08-23 10:44:16', '2'),
(71, 235, '349011', '2020-08-23 10:47:26', '2'),
(72, 1, '945808', '2020-08-23 11:30:07', '1'),
(73, 1, '515007', '2020-08-23 13:17:48', '2'),
(74, 1, '757007', '2020-08-23 13:18:04', '2'),
(75, 1, '726654', '2020-08-23 13:18:14', '1'),
(76, 1, '700737', '2020-08-24 21:03:16', '1'),
(77, 259, '349847', '2020-08-24 21:12:44', '2'),
(78, 259, '523803', '2020-08-24 21:16:38', '2'),
(79, 257, '214684', '2020-08-24 21:16:53', '2'),
(80, 257, '930521', '2020-08-24 21:17:11', '2'),
(81, 257, '998185', '2020-08-24 21:18:01', '2'),
(82, 257, '246941', '2020-08-24 21:19:11', '2');

-- --------------------------------------------------------

--
-- Table structure for table `members_tweets_category`
--

CREATE TABLE `members_tweets_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(100) NOT NULL,
  `twitter_account_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members_tweets_category`
--

INSERT INTO `members_tweets_category` (`id`, `name`, `description`, `uid`, `twitter_account_id`) VALUES
(15, 'Political', '', 1, 1),
(16, 'TheViralMarketer', 'Gathering leads for theviralmarketer', 1, 1),
(17, 'Scientifc', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members_twitter_accounts`
--

CREATE TABLE `members_twitter_accounts` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `pid` text,
  `screen_name` text,
  `avatar` text,
  `access_token` text,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `data_profile` text,
  `data_logs` text,
  `list_data` varchar(1000) DEFAULT NULL,
  `followed_list_data` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members_twitter_accounts`
--

INSERT INTO `members_twitter_accounts` (`id`, `uid`, `pid`, `screen_name`, `avatar`, `access_token`, `changed`, `created`, `status`, `data_profile`, `data_logs`, `list_data`, `followed_list_data`) VALUES
(1, 1, '3569406679', 'mraza8040', 'https://pbs.twimg.com/profile_images/643699146168242176/exHKw0h4_normal.jpg', '{\"oauth_token\":\"3569406679-wW5zUjlPZ17DRv8dbfVSi0Adh1encbYruHqeBki\",\"oauth_token_secret\":\"bvb3D8XKqkMAj0nSDuErqPzb15SNO8DBsT78ZdEqg9jCM\",\"user_id\":\"3569406679\",\"screen_name\":\"mraza8040\"}', NULL, '2020-03-02 01:32:26', 1, '{\"followers_count\":4,\"friends_count\":75,\"statuses_count\":72,\"name\":\"MUhammad Raza\"}', NULL, '{\"id\":1239286068098281475,\"name\":\"viral-pending-follow\",\"uri\":\"/mraza8040/lists/viral-pending-follow\",\"slug\":\"viral-pending-follow\"}', '{\"id\":1240757770380619778,\"name\":\"viral-followed-list\",\"uri\":\"/mraza8040/lists/viral-followed-list2\",\"slug\":\"viral-followed-list\"}'),
(2, 1, '19438656', 'ephron1969', 'https://pbs.twimg.com/profile_images/960783565012291584/nML_sxOk_normal.jpg', '{\"oauth_token\":\"19438656-Af2zYaBwlZsJlf0DmaPOuyK7Nr37JYeWaLJBnEXQO\",\"oauth_token_secret\":\"2OTth9KKlN841TJ63HFbie1V5hGLHVtYIFAFBkHjcdFjy\",\"user_id\":\"19438656\",\"screen_name\":\"ephron1969\"}', NULL, '2020-03-07 12:21:36', 1, '{\"followers_count\":951,\"friends_count\":2449,\"statuses_count\":566,\"name\":\"Ephron Maralack\"}', NULL, '{\"id\":1239286339662741504,\"name\":\"viral-pending-follow\",\"uri\":\"/ephron1969/lists/viral-pending-follow\",\"slug\":\"viral-pending-follow\"}', '{\"id\":1240758031455043588,\"name\":\"viral-followed-list\",\"uri\":\"/ephron1969/lists/viral-followed-list\",\"slug\":\"viral-followed-list\"}\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `members_twitter_logs`
--

CREATE TABLE `members_twitter_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `twitter_user_id` bigint(20) NOT NULL,
  `twitter_account_id` int(11) NOT NULL,
  `status` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members_twitter_logs`
--

INSERT INTO `members_twitter_logs` (`id`, `uid`, `twitter_user_id`, `twitter_account_id`, `status`, `date`) VALUES
(2, 1, 3282082410, 1, 'Followed', '2020-03-23 06:00:00'),
(8, 1, 1240140128175128577, 1, 'Unfollow', '2020-03-23 06:00:00'),
(9, 1, 3483332237, 1, 'Followed', '2020-03-23 06:00:00'),
(10, 1, 1170839669535363072, 1, 'Followed', '2020-03-23 06:00:00'),
(11, 1, 1242170656659103744, 1, 'Followed', '2020-03-23 06:00:00'),
(12, 1, 1242396954392268800, 1, 'Followed', '2020-03-24 06:00:00'),
(13, 1, 2835261848, 1, 'Unfollow', '2020-03-24 06:00:00'),
(14, 1, 228518368, 1, 'Followed', '2020-03-28 06:00:00'),
(15, 1, 1054413451018162177, 1, 'Followed', '2020-03-30 06:00:00'),
(16, 1, 1105821946451648517, 1, 'Followed', '2020-03-30 06:00:00'),
(17, 1, 25830688, 1, 'Followed', '2020-03-31 06:00:00'),
(18, 0, 1294907930420981760, 1, 'Followed', '2020-08-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members_twitter_posts`
--

CREATE TABLE `members_twitter_posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `tweet_id` bigint(20) DEFAULT NULL,
  `type` text,
  `data` text,
  `status` int(2) DEFAULT NULL,
  `result` text,
  `url` varchar(10000) DEFAULT NULL,
  `time_post` varchar(1000) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `changed` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members_twitter_posts`
--

INSERT INTO `members_twitter_posts` (`id`, `uid`, `account_id`, `category_id`, `tweet_id`, `type`, `data`, `status`, `result`, `url`, `time_post`, `created`, `changed`) VALUES
(262, 1, 1, 15, 1246476157744222211, 'text', '{\"media\":[],\"caption\":\"good night. \",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-04 10:34', '2020-04-04 16:34:09', '2020-04-04 16:34:09'),
(263, 1, 1, 15, 1246477717253619712, 'text', '{\"media\":[],\"caption\":\"hello gd nit\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-04 10:40', '2020-04-04 16:40:20', '2020-04-04 16:40:20'),
(264, 1, 1, 15, 1246478179545550849, 'text', '{\"media\":[],\"caption\":\"hello  working\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-04 10:42', '2020-04-04 16:42:11', '2020-04-04 16:42:11'),
(269, 1, 1, 15, 1246483541082415109, 'image', '\"269\"', 1, 'Published Successfully', NULL, '2020-04-04 11:03', '2020-04-04 17:03:29', '2020-04-04 17:03:29'),
(271, 1, 1, 15, 1246540553006788610, 'text', '{\"media\":[],\"caption\":\"good night . :) and...\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-04 14:50', '2020-04-04 17:54:13', '2020-04-04 17:54:13'),
(272, 1, 2, 1, 1246778166905057281, 'text', '{\"media\":[],\"caption\":\"# corona fighter https://t.co/NKOOCs4sSB\"}', 1, 'Successfully retweet', NULL, '2020-04-05 06:34', '2020-04-05 12:34:13', '2020-04-05 12:34:13'),
(273, 1, 1, 15, 1246779148925898752, 'text', '{\"media\":[],\"caption\":\"@Aaoux Is forcing me to pause mine because you donu2019t have a computer your final solution?\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-05 06:38', '2020-04-05 12:38:07', '0000-00-00 00:00:00'),
(274, 1, 1, 1, 1246862382833586179, 'text', '{\"media\":[],\"caption\":\"#NEW \"a wild, action packed, suspenseful story\" Assassinu2019s Game by @AuthorESheridan https://t.co/mHRPoh9x02 https://t.co/cMDSDBBn1I\"}', 1, 'Successfully retweet', NULL, '2020-04-05 12:08', '2020-04-05 18:08:52', '2020-04-05 18:08:52'),
(275, 1, 1, 16, 0, 'text', '{\"media\":[],\"caption\":\"This is a test\",\"url\":\"null\"}', 0, 'Pending', NULL, '2020-04-06 19:50', '2020-04-06 07:40:26', '2020-04-06 07:40:26'),
(276, 1, 1, 17, 1247068208898736128, 'text', '{\"media\":[],\"caption\":\"Stop Corona stay Safe\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-06 01:47', '2020-04-06 07:46:45', '0000-00-00 00:00:00'),
(279, 1, 1, 16, 0, 'text', '{\"media\":[],\"caption\":\"This is a test to see if this tweet successfully saves in the tweet Library\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-06 01:58', '2020-04-06 07:56:02', '0000-00-00 00:00:00'),
(281, 1, 1, 17, 1247105682337300485, 'text', '{\"media\":[],\"caption\":\"Stop Corona\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-06 04:15', '2020-04-06 10:15:39', '2020-04-06 10:15:39'),
(283, 1, 1, 16, 0, 'text', '{\"media\":[],\"caption\":\"test for save tweet Library\",\"url\":\"null\"}', 1, 'Unpublished', NULL, '2020-04-06 11:43', '2020-04-06 11:43:10', '2020-04-06 11:43:10'),
(284, 1, 1, 17, 0, 'text', '{\"media\":[],\"caption\":\"Test for Tweet Library\",\"url\":\"null\"}', 1, 'Unpublished', NULL, '2020-04-06 11:55', '2020-04-06 11:55:43', '2020-04-06 11:55:43'),
(286, 1, 1, 17, 0, 'text', '{\"media\":[],\"caption\":\"The students are getting online piano lessons during the lockdown\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-07 11:46', '2020-04-07 11:43:14', '0000-00-00 00:00:00'),
(287, 1, 1, 15, 0, 'text', '{\"media\":[],\"caption\":\"There is a theory now that 5G network might be the cause of the Corona virus. Who agrees with me...Would like your feedback.\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-07 15:53', '2020-04-07 15:49:58', '0000-00-00 00:00:00'),
(288, 1, 1, 1, 1247553995880779784, 'text', '{\"media\":[],\"caption\":\"There is a theory now that 5G network might be the cause of the Corona virus. Who agrees with me...Would like your feedback.\"}', 1, 'Successfully retweet', NULL, '2020-04-07 09:57', '2020-04-07 15:57:05', '2020-04-07 15:57:05'),
(289, 1, 1, 16, 1248691523375509504, 'text', '{\"media\":[],\"caption\":\"adsad\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-10 12:15', '2020-04-10 19:17:13', '2020-04-10 19:17:13'),
(292, 1, 1, 17, 0, 'text', '{\"media\":[],\"caption\":\"Stop Corona\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-04-12 11:33', '2020-04-12 18:32:11', '0000-00-00 00:00:00'),
(293, 1, 1, 17, 0, 'text', '{\"media\":[],\"caption\":\"We Want Semester Break with Enjoyment\",\"url\":\"null\"}', 1, 'Unpublished', NULL, '2020-04-16 05:51', '2020-04-16 12:51:02', '2020-04-16 11:51:00'),
(294, 1, 1, 1, 1293872786566504450, 'text', '{\"media\":[],\"caption\":\"10 Legit Ways To Make Money Online During This Lockdown https://t.co/CWECeLMAVW #LayconandVee #QueenErica #ATAPSGu2026 https://t.co/f88bp51bf2\"}', 1, 'Successfully retweet', NULL, '2020-08-13 11:31', '2020-08-13 11:31:26', '2020-08-13 11:31:26'),
(295, 1, 1, 16, 1297500604076642306, 'text', '{\"media\":[],\"caption\":\"Never Stop Learing Bcz life never stop Teaching\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-08-23 04:47', '2020-08-23 11:47:05', '2020-08-23 11:47:05'),
(296, 1, 1, 16, 1297501789487587328, 'text', '{\"media\":[],\"caption\":\"it Cost $0.00 to treat someone with respect\",\"url\":\"null\"}', 1, 'Published Successfully', NULL, '2020-08-23 04:50', '2020-08-23 11:51:47', '2020-08-23 11:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `paid_memberships`
--

CREATE TABLE `paid_memberships` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `is_show` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paid_member_relationship`
--

CREATE TABLE `paid_member_relationship` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `paid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_Transaction`
--

CREATE TABLE `paypal_Transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_with_tax` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paypal_Transaction`
--

INSERT INTO `paypal_Transaction` (`id`, `user_id`, `amount`, `amount_with_tax`, `status`, `token`) VALUES
(1, 1, 0, 'NaN', 0, 'eea9de7509e9f9db928db2fbf9d7b683c91bee8e8fa01d1739a21baed9a2855a8a5862bc43ca14aba13003f62242c11b8d4c1d423d77588249ab84f193de06cf'),
(2, 1, 100, '111.7', 0, '69a4410ce10457d9f5b827d74013e4a6e491dd7ffae96b99e2a2fbfca5ad58770698bcec46886bf3b68bfe71cc577a3157f23575bb65562c3fb805d65389a578'),
(3, 235, 10, '12.69', 0, '71ce2374c19104f957dd9876b0f2c9f2aa6a407188081fcfaae17048d03992117362c41cf9bae666e88dba02195772d9bb5e8207cbe899088c811b1afc136af0');

-- --------------------------------------------------------

--
-- Table structure for table `pending_tasks`
--

CREATE TABLE `pending_tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `task_priority` enum('Medium','High','Low') NOT NULL,
  `completion_date` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_tasks`
--

INSERT INTO `pending_tasks` (`id`, `title`, `description`, `task_priority`, `completion_date`, `status`) VALUES
(10, 'fdsffsfasfFDSF', 'FSDFSASAFDFdfdfdffsazc', 'High', '23-12-2017 12:00:00', 'inactive'),
(11, 'ddgdsdsd', 'sgdgfdgafgfgfg', 'High', '23-12-2017 12:00:00', 'active'),
(8, 'afsfsafsafsfsaf', 'dfdsfsafsfsaf', 'High', '14-12-2017 12:00:00', 'inactive'),
(9, 'sadsadsadsa', 'adssadasdsadfsafsaf', 'Medium', '10-03-2017 12:00:00', 'inactive'),
(12, 'hello', 'test&nbsp;', 'Medium', '10-12-2017 12:00:00', 'inactive'),
(13, 'fdfdsfdsfsdf', 'dfdsfdsfdsfdsfdsfdsfdsfdfdsfsdgfdgdgdgfsd', 'High', '29-12-2017 12:00:00', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `profile_access_tokens`
--

CREATE TABLE `profile_access_tokens` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `access_token` varchar(100) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `requested_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_access_tokens`
--

INSERT INTO `profile_access_tokens` (`id`, `member_id`, `access_token`, `requested_by`, `requested_on`) VALUES
(1, 1, '47c9b7f11f91148ae2553f65cce48601c5fe8b6638808f8d1bf07b36bbf1b0e6', 1, '2018-05-07 09:21:41'),
(2, 1, '0c2fac54718b4b4ce27e47b51e4f15eb0ec5967fa36fb0a93bab1779321dfbf6', 1, '2018-05-07 09:22:50'),
(3, 2, 'f248130032ba07f70d16643a503c016a43df31d5b10ef2f4551265587200f6ae', 1, '2018-05-07 09:23:31'),
(4, 3, '77394f2d2e4834667b1d9b1f3ecf67fb036f2d748b0b2ac61f26c4e007285531', 1, '2018-05-07 09:24:45'),
(5, 10, 'b09d3cf37611b1bc3b501dd9f709fd049c4dbac50cdeb8bab9e01abd09ce20b3', 1, '2018-05-07 09:27:55'),
(6, 1, '0f5551428146e2f6eabc2094ec7f8f5025dd68280a78b81d3240db0ce6ba3dc4', 1, '2018-05-07 09:28:57'),
(7, 1, '9b7d4c4dab8b68236821aa3b5fc9c7d6514b464c598940b5d9323518789c71d8', 1, '2018-05-07 10:00:53'),
(8, 1, 'f2047d35565cde1add3f77180318e6f18ef58bebd8b539b286e03ee4597e74bd', 1, '2018-05-17 09:21:05'),
(9, 1, '17998f50f34ef827cca75ca2849b35f5e527b0624ec04d6bad66d4ed62841037', 1, '2018-05-24 04:04:35'),
(10, 117, '34408ab68f219474421a392f044fffd4bbec10b2ca432a3590c8430b4ac0ee1e', 1, '2018-08-11 08:09:13'),
(11, 1, '9897bb326ab7658eb9ac4b3d8a1f6a594429bc52a517ff4138ae75c1c2787d81', 1, '2018-10-25 16:15:07'),
(12, 144, 'f49f875577b649ca049682626d6d34201340fa375ced3226e98c86261cba9316', 1, '2018-10-25 16:15:55'),
(13, 155, '1cbae73d392ead68aad223eb3d3a397d04f9d6b13462927f5a35e0f40fe7bbe0', 1, '2018-10-29 18:41:45'),
(14, 1, 'd53e0d7e974d4d6c097e238d206d1e5dce835848d13ca56aed34532437f75a68', 1, '2018-11-01 05:43:12'),
(15, 156, '3c1ab4fc2aa45c009699f650d4a645c1621ac007d8f29d34096a77e17cb3d852', 1, '2018-11-01 05:47:35'),
(16, 154, '2a9c1839b4f2b3e6521221ce5b18087c4807032cee8437a736a681a21869338e', 1, '2018-11-01 05:47:46'),
(17, 154, '13b2c778758f3b7052d97807914eb4ddbd595559d746aca956f30e9792054050', 1, '2018-11-01 12:15:16'),
(18, 145, '478fd1353a2da79fcb4f9cf0a6e50fd123d43bdada92a438366eb1252246922f', 1, '2018-11-01 12:16:20'),
(19, 142, '789eaab0785ea906c085cc8cde08ca23954c6a629e91513f7fb934d527e05866', 1, '2018-11-01 12:24:01'),
(20, 141, '5a2be745bae14dc9439f1d7b5a35215a3c17af7212f1a1ae2d5c0345c093e812', 1, '2018-11-01 12:26:55'),
(21, 154, 'd74deba223fd2f3ce62484070d1b9855fc56b56ca344a7e9a9db2cb98bd1be16', 1, '2018-11-01 14:39:21'),
(22, 155, 'ab9f07f6fd61c718aa78ae9e481ba2506ebdc54f9b38a0d91e56c6a87cc13d42', 1, '2018-11-01 14:39:32'),
(23, 155, 'fdaedadd42f28c5c6ca78d9dd09b872bccd28256194efcd887dc478998457825', 1, '2018-11-01 14:56:47'),
(24, 1, 'fe504ae5ca4021c82ecb9774cdef8ee3b7ccfa123387305efa7da1319e5ecc7f', 1, '2018-11-01 15:00:48'),
(25, 170, 'cc43b2395073d3baa919adfada6ac63c0737f18c5046791f4aae0ff3a3cba420', 1, '2018-11-07 12:50:40'),
(26, 168, '3832c9b56d94e736c5a817537cd74fb9f37f6705a05517352016eed73eeb3b31', 1, '2018-11-07 12:51:29'),
(27, 170, '61656bb57ee8d426ba6dee2790961492bd656840b08c76289386e12f2c68906b', 1, '2018-11-07 12:51:47'),
(28, 167, '6e2cdd92be6d12c4d22d174050fd22fecef04b19aa6eab9c3ac5ff8685355798', 1, '2018-11-07 12:52:15'),
(29, 170, '61c4d77eff97aeffb1f5bf136e7f45ea84c2bec053c0239a6b300b9e2b195ef6', 1, '2018-11-07 13:47:25'),
(30, 170, '6c99960ff2860139b7e87af35f9d7e3f854d78688f9c2b9400dfae022edcc970', 1, '2018-11-07 13:52:24'),
(31, 170, '6a4ade6501da9c92756b1b608c90afd01d020fbb35529cb2803d4b6a9f6043d0', 1, '2018-11-07 13:54:00'),
(32, 170, 'd20f8b7c97698bfed111856c57e99b0c58094edfff02ee8b99da9d5394d13811', 1, '2018-11-07 14:08:06'),
(33, 141, '83639d351b70800f923afd71cdbf1e29a19258264abe119faaeef77b951f932f', 1, '2018-11-07 14:09:25'),
(34, 151, '9f0f7409940c979e48071bdc920c34263aba97e63bf73e4c2338256bc4314ad6', 1, '2018-11-07 14:42:31'),
(35, 170, 'a81a54a25157cf4a520a8972759c8167307f23745925a8e33c985b1f3b9fa7eb', 1, '2018-11-07 14:44:11'),
(36, 143, '847e48b7cfb4a4338cc89332e2d3775ed9d33d9da7fe9d1cb8a1735b89569194', 1, '2018-11-07 14:47:06'),
(37, 141, '29e89e1b60d8bf83582ba14f48dbfdc7e1521c6be1f1b7acb1623e2a3b0e687e', 1, '2018-11-07 14:50:17'),
(38, 159, 'f945886872e9f597f113cd3a8d33b137f57a7bf36b52ed2e45ba970457496edf', 1, '2018-11-09 21:19:46'),
(39, 159, '3e728e9841274312c30a249dd6eaeaac7771a04cec6fab0c71c7a1d083a8bb87', 1, '2018-11-09 21:22:43'),
(40, 159, '6e8874ffe614a121fcbe8019e65a5dce9d6972b20956864441aaf678077f8d02', 1, '2018-11-10 07:34:00'),
(41, 154, '1be0591df0f736d5289daf26cbc29b56db2c7bfe741bdfd6bfbe5ddda69b975a', 1, '2018-11-10 07:34:16'),
(42, 186, 'de2d63984bf354cf3e64503f0b6efc14a12fc1f097e77c562ed55e5599c23143', 1, '2018-11-10 07:34:34'),
(43, 159, 'f66ba5081a8b502f49e41ea7bfed257de8183992728f8a46f5709668bf8e6397', 1, '2018-11-11 09:08:45'),
(44, 159, '087b405995e0c79afe27ee217b9732b9fcb735b690f30f8200e310fc553dff3c', 1, '2018-11-11 10:29:59'),
(45, 1, 'b3e9cc940b6461fbdbbdf0bad23f792fb8974fe0df060e82084657a8cf7e20eb', 1, '2018-11-11 10:37:58'),
(46, 143, '08f9cdfd831d7b593a4f92023e25432196682f4060c34d145c95545d7bf1b9b5', 1, '2018-11-11 10:40:27'),
(47, 144, '8d3e18a3e13839f6e6fafcf9239e30558d57aac5d80e6a7f64df68af24651d77', 1, '2018-11-11 10:41:42'),
(48, 159, 'd139ca10f1f803a2e95322c4e6a937cdfbc7937803da4dd5b6b0f044acd0760f', 1, '2018-11-11 10:46:21'),
(49, 154, 'b6d1eadd6748b267cc34312a37ab3492c6ae820a16d08807acce44d3de01f01c', 1, '2018-11-11 10:47:28'),
(50, 154, '99410077ffae2f09589c2035c526b1b624b22705d9e9d6846ef0e36ebee4bac5', 1, '2018-11-11 16:02:45'),
(51, 143, '3240b8edae48ee08f5b39b99d8e640a95f62b6a0c22d92db5a419242a038eee5', 1, '2018-11-11 16:03:25'),
(52, 1, '2fb088eb743e1b071fec190529e1b93ac9f59f2ba01815bee436b5d3cc092d95', 1, '2018-11-11 16:49:44'),
(53, 154, '3a2e047ac5b74674901f93b288290f42e2b9ba6e2ff971012b93043dad80b8c6', 1, '2018-11-11 16:59:06'),
(54, 1, '107d3c4c246db555974cc80819f2fdbf192e8f133088d7f0a2aa0babb35c48b3', 1, '2018-11-12 04:07:59'),
(55, 1, '74819d31ee537e0d1f86ae25ad69a7ca6a35dd4076e2f679f10af3d521e3e283', 1, '2018-11-12 09:46:39'),
(56, 1, 'a10c39463d68eac95444d8e8e0e80d37ad5f8e1ff40fd003b3875baa7748e5cc', 1, '2018-11-12 10:10:32'),
(57, 141, '0e75f2e838aa3d931382d99f0fe41490f25d76dfd7ccc80fd37229c5236bdcab', 1, '2018-11-12 10:39:49'),
(58, 143, 'd3e047cab8bc18111bfe7ad4e759d827fdbc010e6e628d413552855365d9fb72', 1, '2018-11-12 10:40:12'),
(59, 168, '8e6a2b3278a84789e5cfd1b9d4dd7f60158be14abf208007cbcd9d4a5232c150', 1, '2018-11-12 10:46:57'),
(60, 184, '30e40e107f4dd1a29446566bad9a7bf787ff787823fad90ce95df577fde0ef60', 1, '2018-11-12 14:43:28'),
(61, 155, 'e4089fcf18923c4dff665fad74eccef99e8ed9a8037de591e25a9650ec21913f', 1, '2018-11-12 14:44:02'),
(62, 198, '71f2cbea3af774733dee288ffb0d59eeaa6069de0215bb8d903380869b036101', 1, '2018-11-12 16:39:50'),
(63, 184, '2df918951172d6863842bae1144b95d112bbb23f06f866b48256fdadbe963f57', 1, '2018-11-12 20:12:51'),
(64, 168, '042e4f01e91dc4c7c00b04652f74ff217e81dc1622a61a622be947d6877b1559', 1, '2018-11-12 20:13:24'),
(65, 151, '8c460616dcb7cc2f87bfce084706682d79af27161ab00b330fbb7fd3ce2df449', 1, '2018-11-13 03:26:41'),
(66, 1, 'c06416f6eef07da9e82d6869c1b10db80d4d91513c2d8a44887ae57c2a0b0fe3', 1, '2018-11-13 08:44:23'),
(67, 1, 'c0ad0a16959f482ede87527be3429f2395f675fbaf41a8bd6472dca22b55cae6', 1, '2018-11-13 11:30:50'),
(68, 184, '3f462b95efba0bcdda85527ee1ea342e8f962b00c5ce14be7c9b4c5b5e6108ff', 1, '2018-11-13 14:10:07'),
(69, 159, 'eb7cfb9bb31b206f911470e55f89046494a70b20902e181df37ff0e82098615c', 1, '2018-11-13 16:37:08'),
(70, 141, '37f45ce43389fa62f70b590586cf1d620de02900f21ea18ccfd6b5b8ca01b72f', 1, '2018-11-14 02:41:33'),
(71, 168, 'b8f0d9c8ca1508195dd477c5f5560c126e0175f19d0cf7637477b04a5cccfde2', 1, '2018-11-14 02:42:47'),
(72, 1, '5e16b8cd2be101a9d080b88a2ddd33b5e67841ef630547d9c95d050ebb45ec6f', 1, '2018-11-14 02:44:35'),
(73, 1, '7a2e5d4f1511e492903565a47c2db18666cb767666532df9a40744b8df72ebdb', 1, '2018-11-14 03:33:53'),
(74, 198, '081d34aad061c888572ceb1f348abdfa6f49ca50df2c4e5520c79eb9c3dfd63e', 1, '2018-11-14 05:20:59'),
(75, 141, '9616c7f9b64581ecf47631561f897c1f3b709f90a20f441133e6879eabab33e1', 1, '2018-11-14 10:58:22'),
(76, 1, '3b6ed2bc83259bb43bbccab726cf449b06c8babfe8342c36b8a17ea7d98ebc43', 1, '2018-11-14 10:59:43'),
(77, 156, '9817540167a435b03560417724b344cb0048076069fb1e563c3a39c898897f71', 1, '2018-11-14 14:24:38'),
(78, 155, '075def806c541fcb3e6d8ab778075ed681ff2704067fbc5b2e2924907fde1d1b', 1, '2018-11-14 14:25:24'),
(79, 153, 'e282a7150061dda451d4b56de3509e51ae05e2cac8884d9c68641d822d9373ec', 1, '2018-11-14 14:26:41'),
(80, 141, 'a9f8c3cee7cb63a05e3617c33f26aa8eb784fd7a790b47e31aceeed2ddec218f', 1, '2018-11-14 14:28:06'),
(81, 141, '6a188b3b2c9b93dffc5719e1555bc3b4def4f87aeb5b7f8b5e765581cce3fa1f', 1, '2018-11-14 19:40:00'),
(82, 141, '11f71dad59b5ef2e059512d8d5262e4c24d82ebf63eb762c58f6a4882546482d', 1, '2018-11-15 03:38:00'),
(83, 1, '1e03e8d2d51fbcefcd0b3f0ad71531ea27be5a2a636c3440885ba603f2542a6c', 1, '2018-11-15 03:39:00'),
(84, 184, '945e8f7916416d2cc89991c055213f52705410565a254f8fbba81da5c34f8bc3', 1, '2018-11-15 07:45:49'),
(85, 1, 'cee27b12d4ffccb5099003edbe6334009f76b2ce13f5a49c6a2c3bfcfe75f277', 1, '2018-11-15 11:45:57'),
(86, 176, '77145b54dad15b5fedc26b62227222c2fbb8e8f0c9ea0e4f792736a7f8274252', 1, '2018-11-16 00:10:20'),
(87, 154, 'c4536dcbe2cd7fd9f356d2394861c489c77679bcaf2448b6dd39f43233deb47f', 1, '2018-11-16 00:11:14'),
(88, 168, 'c9d4c30fc66dd6bcb044c790d40463f11e7e18c1cf54258e125be31bdb78a6ad', 1, '2018-11-16 00:12:06'),
(89, 178, 'd697b1a601613cab5fae9534af747959c02c249fefdd6f908e5b3a29b2dfcdaf', 1, '2018-11-16 00:12:48'),
(90, 1, '3a91d78883866abcbd10866da43f13bc1d7f8f179500af3806fe1b4e0bd8b0a9', 1, '2018-11-16 16:59:38'),
(91, 205, '54c17418ec03fad239abe8cb11916488847d484d3d5cb6e2701e3f370d4e8d33', 1, '2018-11-17 07:55:17'),
(92, 205, 'cc6624d81acf709449881ed465b88fe96c5f78397332ac3de188e309595ba47a', 1, '2018-11-17 07:59:30'),
(93, 143, '70932e862ff36d6edec4260f948f7eaa61569f83a6c41688d9bb8461f8c50949', 1, '2018-11-17 07:59:44'),
(94, 216, 'e3c8157f2a7f92f091f0da9605887567254540d214f5d47fa6de33a988fb2c34', 1, '2018-11-17 09:33:38'),
(95, 156, '7172288ad53e829df50d4063719cc91c0a468af56e0fb3d53869decf0d62cc03', 1, '2018-11-18 18:50:46'),
(96, 175, '4d3091a19fddf3ea9d9211dc3e791b80255104571589ec765a7d79d8210e130c', 1, '2018-11-20 03:39:45'),
(97, 1, 'f936eb70d41eeea380c3c8559c891d495c16c3a7d799eda748ca2db246742f0a', 1, '2018-11-20 08:32:33'),
(98, 156, 'd9c6a857f4792d31325c6dfb018dc44746ce3026fcd0548c6cd492193d567aa2', 1, '2018-11-20 08:34:59'),
(99, 1, '3e5fc01dd0f7f9226b887a8c6acc54bcb564eda8c97d28e3a26828992dc928fe', 1, '2018-11-20 08:55:40'),
(100, 218, 'e4cf9fdfc1749479dc580566d6ba79c40a1a6d4c79aac09467a03404230205e8', 1, '2018-11-20 19:09:03'),
(101, 219, 'b4c7e73a64af6ad632885f5529b6f5e78c13d10b54609b34fe6840053c63d215', 1, '2018-11-21 08:53:26'),
(102, 1, 'eef9aa533d8024c8ed9257663b661c72981c329601259a397ab20c5066238f16', 1, '2018-11-23 13:16:22'),
(103, 178, 'e117dff8d753719720a924ef388eaf8aca3b714faf650cec902ac846e560f519', 1, '2018-11-24 05:47:57'),
(104, 221, '711c47be4a890abfa47e2c4f222c2882ee12b1b9e3eecbd7c89c1e2d7812b34f', 1, '2018-11-24 05:48:07'),
(105, 186, 'f4ce617b25952b3d0f04ee08d3f8a9ce5a96d7e9b5529e05c0d5ee1393462b4b', 1, '2018-11-25 14:55:19'),
(106, 159, '4c03c1c545b178967eb11a3596c33823e6ae3e605ce217504df1abad9100bc93', 1, '2018-11-25 14:55:34'),
(107, 191, '58d3af45268bb086da775998ae1b817c76df52ac355e4da029bab4fd36bd6375', 1, '2018-11-25 14:55:52'),
(108, 193, 'aedc9c1672dc6f9058672d3b30ab99315ca284c2ced2178f0dc001433a929ad0', 1, '2018-11-25 14:56:00'),
(109, 213, '09f456f360ba4d6b649f1741b65519679dd6854652af0fd55ea2a40c8b03c0f9', 1, '2018-11-25 14:56:07'),
(110, 213, 'd3ffb50d35bcef606e0a536ec9b9e2937cd1cc2dfe050e1ceeed3cf0b3d80e9d', 1, '2018-11-25 14:56:14'),
(111, 215, '13e667ba1fab0d551873891c0921137d7735ebe4e461a80ed9592c9b3f48734e', 1, '2018-11-25 14:56:22'),
(112, 222, 'a7a29dc9868d0a28fbe360248c6b64fdee98283e2b9c8b4933bd6363403a7268', 1, '2018-11-25 14:56:28'),
(113, 159, 'f51a342822fa8aef5c75953e873f30ab4730b1dfa316b0d5728ffafb6654ba75', 1, '2018-11-26 16:30:38'),
(114, 178, '4efdb0c1c7cb0f86fce0c16df9f20e6386e5591956c304b399292cd0b2dfee7f', 1, '2018-11-27 09:46:14'),
(115, 1, 'a8d22d7d7adfb60581397bcf674aadacb07feb3168456a607c3a1e9e97471364', 1, '2018-11-27 09:50:21'),
(116, 1, '46970220efbec4507648ff5ecc1badef0724b371fb226e4972328c12c324c0f1', 1, '2018-11-27 10:41:31'),
(117, 1, '290866fa89cd87bee870b66b11fe2d529331f6d452490d269ce5ece2f7a71e3f', 1, '2018-11-27 11:00:24'),
(118, 216, '86eba25b7946b6ebeb01c8169d168a01c3f4b260e3ad56d5779e271415dd3197', 1, '2018-11-28 08:11:32'),
(119, 216, '7b13ebdf80571728e57968e257e85d71621615d5fd38850648b683e1e08ee2eb', 1, '2018-11-28 08:17:07'),
(120, 1, '001b5ca781bb88c41c742074c70f86909dcbcdeadeb88fed60b4773fb6e65a02', 1, '2018-12-24 08:03:09'),
(121, 219, '499d2a4910dfb627458035e3f4e14315edb01480c41a3f906a7288c55f80733c', 1, '2018-12-24 08:08:53'),
(122, 1, 'bcc87375676c72dec6570ccd21f785c6fb12300c48867c22f883505f9a50e4f2', 1, '2018-12-24 08:18:27'),
(123, 1, '434a7b4f31eda534b3e6b68bd72ae255d711146f7bbc04e2dc8898f284939f9f', 1, '2018-12-24 08:20:37'),
(124, 1, '02508774ffa79056b7d820a599d2071887295d87beaa355cf88a99b6a5ae9611', 1, '2018-12-24 08:55:07'),
(125, 151, '4260b9305c926a9d5245d1a488548fe16a037173a1056598425e2cb9b625760d', 1, '2018-12-24 08:56:04'),
(126, 1, 'f7d7447d158ccbbb46f000a1c91954dc31e402cf8f3d7cce33ef9e19cfa777c8', 1, '2018-12-24 08:56:16'),
(127, 1, 'cd7ee4009496cf44557299df413d9e4d14eea5e6abdfd09b47a673e9b769a815', 1, '2018-12-24 13:27:54'),
(128, 1, '531e8a4a9ae3ef51d53ef8a32668f936b96ef47837984427164706b31d48114e', 1, '2018-12-27 16:37:05'),
(129, 1, 'e002b2047dc12941292a38ff1ba11d023fdad65725811edc1f8459ec1312cbfb', 1, '2019-01-05 16:51:06'),
(130, 156, '62623cc4ecea9142401b7838703bb1b2354c4a5ae2dd9807b02a94426ac2b687', 1, '2019-01-05 16:52:39'),
(131, 1, '25f65e7abdeae6e6a64ddef15df57fb26a548b222203c1d0c2acb92f25b19890', 1, '2019-01-18 13:10:20'),
(132, 159, 'e7aea931eb561b8ff9a56da5bfa8d32563562992901ba1192036ee05257c9fda', 1, '2019-01-25 17:12:06'),
(133, 154, '3373129f04f141d479de3820463194f6c612f27da75842573548eaec50c6aa7e', 1, '2019-01-25 17:13:01'),
(134, 159, 'e72b96efb2231ff26b08ab751b91e0e365df74712a51ab01ada957d7372a589e', 1, '2019-01-26 12:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_levels`
--

CREATE TABLE `subscribed_levels` (
  `id` int(11) NOT NULL,
  `sender_ibm` varchar(100) NOT NULL,
  `receiver_ibm` varchar(100) NOT NULL,
  `level_amount` float NOT NULL,
  `level` int(11) NOT NULL,
  `sender_address` varchar(100) NOT NULL,
  `receiver_address` varchar(100) NOT NULL,
  `payment_status` enum('0','1') NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_levels-test-data`
--

CREATE TABLE `subscribed_levels-test-data` (
  `id` int(11) NOT NULL,
  `sender_ibm` varchar(100) NOT NULL,
  `receiver_ibm` varchar(100) NOT NULL,
  `level_amount` float NOT NULL,
  `level` int(11) NOT NULL,
  `sender_address` varchar(100) NOT NULL,
  `receiver_address` varchar(100) NOT NULL,
  `payment_status` enum('0','1') NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribed_levels-test-data`
--

INSERT INTO `subscribed_levels-test-data` (`id`, `sender_ibm`, `receiver_ibm`, `level_amount`, `level`, `sender_address`, `receiver_address`, `payment_status`, `paid_date`) VALUES
(1, 'IBM2', 'IBM1', 1.75, 1, '1', '1', '1', '2018-04-06 07:29:21'),
(2, 'IBM3', 'IBM1', 1.75, 1, '1', '1', '1', '2018-04-06 07:40:33'),
(3, 'IBM29', 'IBM3', 1.75, 1, '1', '1', '1', '2018-04-06 07:41:04'),
(4, 'IBM37', 'IBM29', 1.75, 1, '1', '1', '1', '2018-04-06 07:41:31'),
(5, 'IBM44', 'IBM37', 1.75, 1, '1', '1', '1', '2018-04-06 07:42:24'),
(6, 'IBM29', 'IBM1', 5, 2, '1', '1', '1', '2018-04-06 07:45:00'),
(7, 'IBM3', 'IBM1', 5, 2, '1', '1', '1', '2018-04-06 07:45:57'),
(8, 'IBM37', 'IBM3', 5, 2, '1', '1', '1', '2018-04-06 07:46:24'),
(9, 'IBM44', 'IBM29', 5, 2, '1', '1', '1', '2018-04-06 07:46:54'),
(10, 'IBM3', 'IBM1', 10, 3, '1', '1', '1', '2018-04-06 07:47:51'),
(11, 'IBM29', 'IBM1', 10, 3, '1', '1', '1', '2018-04-06 07:48:33'),
(12, 'IBM37', 'IBM1', 10, 3, '1', '1', '1', '2018-04-06 07:49:30'),
(13, 'IBM44', 'IBM3', 10, 3, '1', '1', '1', '2018-04-07 09:07:50'),
(14, 'IBM3', 'IBM1', 20, 4, '1', '1', '1', '2018-04-07 10:46:01'),
(15, 'IBM29', 'IBM1', 20, 4, '1', '1', '1', '2018-04-07 10:46:34'),
(16, 'IBM37', 'IBM1', 20, 4, '1', '1', '1', '2018-04-07 10:47:03'),
(17, 'IBM44', 'IBM1', 20, 4, '1', '1', '1', '2018-04-07 10:47:36'),
(18, 'IBM3', 'IBM1', 40, 5, '1', '1', '1', '2018-04-08 02:44:44'),
(19, 'IBM29', 'IBM3', 40, 5, '1', '1', '1', '2018-04-08 02:45:29'),
(20, 'IBM37', 'IBM29', 40, 5, '1', '1', '1', '2018-04-08 02:46:05'),
(21, 'IBM44', 'IBM37', 40, 5, '1', '1', '1', '2018-04-08 02:46:42'),
(22, 'IBM3', 'IBM1', 80, 6, '1', '1', '1', '2018-04-08 02:56:27'),
(23, 'IBM37', 'IBM3', 80, 6, '1', '1', '1', '2018-04-08 02:57:18'),
(24, 'IBM29', 'IBM1', 80, 6, '1', '1', '1', '2018-04-08 02:58:01'),
(25, 'IBM44', 'IBM29', 80, 6, '1', '1', '1', '2018-04-08 02:58:34'),
(26, 'IBM3', 'IBM1', 160, 7, '1', '1', '1', '2018-04-08 02:59:27'),
(27, 'IBM44', 'IBM3', 160, 7, '1', '1', '1', '2018-04-08 03:06:42'),
(28, 'IBM29', 'IBM1', 160, 7, '1', '1', '1', '2018-04-08 19:00:48'),
(29, 'IBM3', 'IBM1', 320, 8, '1', '1', '1', '2018-04-08 19:01:52'),
(30, 'IBM29', 'IBM1', 320, 8, '1', '1', '1', '2018-04-08 19:02:46'),
(31, 'IBM37', 'IBM1', 160, 7, '1', '1', '1', '2018-04-08 19:04:24'),
(32, 'IBM37', 'IBM1', 320, 8, '1', '1', '1', '2018-04-08 19:04:45'),
(33, 'IBM44', 'IBM1', 320, 8, '1', '1', '1', '2018-04-08 19:05:53'),
(34, 'IBM7', 'IBM1', 1.75, 1, '1', '1', '1', '2018-04-09 01:17:17'),
(35, 'IBM49', 'IBM7', 1.75, 1, '1', '1', '1', '2018-04-09 01:20:01'),
(36, 'IBM50', 'IBM49', 1.75, 1, '1', '1', '1', '2018-04-09 01:22:47'),
(37, 'IBM51', 'IBM50', 1.75, 1, '1', '1', '1', '2018-04-09 01:23:29'),
(38, 'IBM54', 'IBM51', 1.75, 1, '1', '1', '1', '2018-04-09 01:24:17'),
(39, 'IBM55', 'IBM54', 1.75, 1, '1', '1', '1', '2018-04-09 01:24:50'),
(40, 'IBM56', 'IBM55', 1.75, 1, '1', '1', '1', '2018-04-09 01:25:23'),
(41, 'IBM7', 'IBM1', 5, 2, '1', '1', '1', '2018-04-09 01:26:20'),
(42, 'IBM49', 'IBM1', 5, 2, '1', '1', '1', '2018-04-09 01:26:56'),
(43, 'IBM50', 'IBM7', 5, 2, '1', '1', '1', '2018-04-09 01:29:20'),
(44, 'IBM51', 'IBM49', 5, 2, '1', '1', '1', '2018-04-09 01:30:03'),
(45, 'IBM54', 'IBM50', 5, 2, '1', '1', '1', '2018-04-09 01:30:39'),
(46, 'IBM55', 'IBM51', 5, 2, '1', '1', '1', '2018-04-09 01:31:10'),
(47, 'IBM56', 'IBM54', 5, 2, '1', '1', '1', '2018-04-09 01:31:49'),
(48, 'IBM7', 'IBM1', 10, 3, '1', '1', '1', '2018-04-09 01:32:57'),
(49, 'IBM49', 'IBM1', 10, 3, '1', '1', '1', '2018-04-10 01:54:15'),
(50, 'IBM54', 'IBM49', 10, 3, '1', '1', '1', '2018-04-10 01:56:42'),
(51, 'IBM51', 'IBM7', 10, 3, '1', '1', '1', '2018-04-10 01:57:44'),
(52, 'IBM51', 'IBM1', 20, 4, '1', '1', '1', '2018-04-10 01:58:00'),
(53, 'IBM50', 'IBM1', 10, 3, '1', '1', '1', '2018-04-10 01:58:45'),
(54, 'IBM50', 'IBM1', 20, 4, '1', '1', '1', '2018-04-10 01:58:57'),
(55, 'IBM55', 'IBM50', 10, 3, '1', '1', '1', '2018-04-10 02:13:21'),
(56, 'IBM56', 'IBM51', 10, 3, '1', '1', '1', '2018-04-10 02:15:22'),
(57, 'IBM56', 'IBM50', 20, 4, '1', '1', '1', '2018-04-10 02:17:57'),
(58, 'IBM7', 'IBM1', 20, 4, '1', '1', '1', '2018-04-10 08:22:43'),
(59, 'IBM54', 'IBM7', 20, 4, '1', '1', '1', '2018-04-10 08:24:28'),
(60, 'IBM49', 'IBM1', 20, 4, '1', '1', '1', '2018-04-10 08:27:02'),
(61, 'IBM55', 'IBM49', 20, 4, '1', '1', '1', '2018-04-10 08:31:24'),
(62, 'IBM7', 'IBM1', 40, 5, '1', '1', '1', '2018-04-10 08:41:05'),
(63, 'IBM49', 'IBM7', 40, 5, '1', '1', '1', '2018-04-10 17:01:27'),
(64, 'IBM50', 'IBM49', 40, 5, '1', '1', '1', '2018-04-10 17:02:41'),
(65, 'IBM51', 'IBM50', 40, 5, '1', '1', '1', '2018-04-10 17:04:27'),
(66, 'IBM54', 'IBM51', 40, 5, '1', '1', '1', '2018-04-10 17:05:39'),
(67, 'IBM55', 'IBM54', 40, 5, '1', '1', '1', '2018-04-10 17:13:42'),
(68, 'IBM56', 'IBM55', 40, 5, '1', '1', '1', '2018-04-10 17:14:09'),
(69, 'IBM7', 'IBM1', 80, 6, '1', '1', '1', '2018-04-10 17:20:33'),
(70, 'IBM50', 'IBM7', 80, 6, '1', '1', '1', '2018-04-10 17:21:36'),
(71, 'IBM54', 'IBM50', 80, 6, '1', '1', '1', '2018-04-10 17:22:27'),
(72, 'IBM56', 'IBM54', 80, 6, '1', '1', '1', '2018-04-10 17:23:03'),
(73, 'IBM49', 'IBM1', 80, 6, '1', '1', '1', '2018-04-10 17:26:07'),
(74, 'IBM51', 'IBM49', 80, 6, '1', '1', '1', '2018-04-10 17:26:42'),
(75, 'IBM55', 'IBM51', 80, 6, '1', '1', '1', '2018-04-10 17:27:48'),
(76, 'IBM7', 'IBM1', 160, 7, '1', '1', '1', '2018-04-10 17:29:09'),
(77, 'IBM51', 'IBM7', 160, 7, '1', '1', '1', '2018-04-10 17:29:52'),
(78, 'IBM56', 'IBM51', 160, 7, '1', '1', '1', '2018-04-10 17:30:37'),
(79, 'IBM49', 'IBM1', 160, 7, '1', '1', '1', '2018-04-10 17:31:30'),
(80, 'IBM54', 'IBM49', 160, 7, '1', '1', '1', '2018-04-10 17:32:23'),
(81, 'IBM50', 'IBM1', 160, 7, '1', '1', '1', '2018-04-10 17:33:19'),
(82, 'IBM7', 'IBM1', 320, 8, '1', '1', '1', '2018-04-10 17:49:13'),
(83, 'IBM54', 'IBM7', 320, 8, '1', '1', '1', '2018-04-10 17:49:58'),
(84, 'IBM49', 'IBM1', 320, 8, '1', '1', '1', '2018-04-10 17:50:34'),
(85, 'IBM55', 'IBM50', 160, 7, '1', '1', '1', '2018-04-10 17:52:15'),
(86, 'IBM55', 'IBM49', 320, 8, '1', '1', '1', '2018-04-10 17:52:49'),
(87, 'IBM50', 'IBM1', 320, 8, '1', '1', '1', '2018-04-10 17:54:20'),
(88, 'IBM56', 'IBM50', 320, 8, '1', '1', '1', '2018-04-10 17:54:55'),
(89, 'IBM5', 'IBM1', 1.75, 1, '1', '1', '1', '2018-04-11 02:35:40'),
(90, 'IBM45', 'IBM5', 1.75, 1, '1', '1', '1', '2018-04-11 02:39:24'),
(91, 'IBM46', 'IBM45', 1.75, 1, '1', '1', '1', '2018-04-11 02:43:00'),
(92, 'IBM47', 'IBM46', 1.75, 1, '1', '1', '1', '2018-04-11 02:45:42'),
(93, 'IBM57', 'IBM47', 1.75, 1, '1', '1', '1', '2018-04-11 02:50:10'),
(94, 'IBM58', 'IBM57', 1.75, 1, '1', '1', '1', '2018-04-11 02:53:11'),
(95, 'IBM59', 'IBM58', 1.75, 1, '1', '1', '1', '2018-04-11 02:55:28'),
(96, 'IBM60', 'IBM59', 1.75, 1, '1', '1', '1', '2018-04-11 02:56:51'),
(97, 'IBM61', 'IBM60', 1.75, 1, '1', '1', '1', '2018-04-11 02:58:14'),
(98, 'IBM62', 'IBM61', 1.75, 1, '1', '1', '1', '2018-04-11 02:58:50'),
(99, 'IBM5', 'IBM1', 5, 2, '1', '1', '1', '2018-04-11 03:00:19'),
(100, 'IBM46', 'IBM5', 5, 2, '1', '1', '1', '2018-04-11 03:05:08'),
(101, 'IBM57', 'IBM46', 5, 2, '1', '1', '1', '2018-04-11 03:07:31'),
(102, 'IBM59', 'IBM57', 5, 2, '1', '1', '1', '2018-04-11 03:09:45'),
(103, 'IBM61', 'IBM59', 5, 2, '1', '1', '1', '2018-04-11 03:12:44'),
(104, 'IBM45', 'IBM1', 5, 2, '1', '1', '1', '2018-04-11 03:16:32'),
(105, 'IBM47', 'IBM45', 5, 2, '1', '1', '1', '2018-04-11 03:17:14'),
(106, 'IBM58', 'IBM47', 5, 2, '1', '1', '1', '2018-04-11 03:18:06'),
(107, 'IBM60', 'IBM58', 5, 2, '1', '1', '1', '2018-04-11 03:18:46'),
(108, 'IBM62', 'IBM60', 5, 2, '1', '1', '1', '2018-04-11 03:19:21'),
(109, 'IBM5', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 03:20:16'),
(110, 'IBM47', 'IBM5', 10, 3, '1', '1', '1', '2018-04-11 03:22:06'),
(111, 'IBM59', 'IBM47', 10, 3, '1', '1', '1', '2018-04-11 03:24:17'),
(112, 'IBM62', 'IBM59', 10, 3, '1', '1', '1', '2018-04-11 03:27:41'),
(113, 'IBM45', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 03:28:19'),
(114, 'IBM57', 'IBM45', 10, 3, '1', '1', '1', '2018-04-11 03:29:35'),
(115, 'IBM60', 'IBM57', 10, 3, '1', '1', '1', '2018-04-11 03:30:33'),
(116, 'IBM46', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 03:32:41'),
(117, 'IBM58', 'IBM46', 10, 3, '1', '1', '1', '2018-04-11 03:33:32'),
(118, 'IBM61', 'IBM58', 10, 3, '1', '1', '1', '2018-04-11 03:34:23'),
(119, 'IBM5', 'IBM1', 20, 4, '1', '1', '1', '2018-04-11 03:59:55'),
(120, 'IBM57', 'IBM5', 20, 4, '1', '1', '1', '2018-04-11 04:00:57'),
(121, 'IBM61', 'IBM57', 20, 4, '1', '1', '1', '2018-04-11 04:01:37'),
(122, 'IBM45', 'IBM1', 20, 4, '1', '1', '1', '2018-04-11 04:02:10'),
(123, 'IBM58', 'IBM45', 20, 4, '1', '1', '1', '2018-04-11 04:03:17'),
(124, 'IBM62', 'IBM58', 20, 4, '1', '1', '1', '2018-04-11 04:03:50'),
(125, 'IBM46', 'IBM1', 20, 4, '1', '1', '1', '2018-04-11 04:04:22'),
(126, 'IBM59', 'IBM46', 20, 4, '1', '1', '1', '2018-04-11 04:04:59'),
(127, 'IBM47', 'IBM1', 20, 4, '1', '1', '1', '2018-04-11 07:33:36'),
(128, 'IBM60', 'IBM47', 20, 4, '1', '1', '1', '2018-04-11 07:38:57'),
(129, 'IBM5', 'IBM1', 40, 5, '1', '1', '1', '2018-04-11 07:59:52'),
(130, 'IBM45', 'IBM5', 40, 5, '1', '1', '1', '2018-04-11 08:04:19'),
(131, 'IBM46', 'IBM45', 40, 5, '1', '1', '1', '2018-04-11 08:09:12'),
(132, 'IBM47', 'IBM46', 40, 5, '1', '1', '1', '2018-04-11 08:12:14'),
(133, 'IBM57', 'IBM47', 40, 5, '1', '1', '1', '2018-04-11 08:15:14'),
(134, 'IBM58', 'IBM57', 40, 5, '1', '1', '1', '2018-04-11 08:18:09'),
(135, 'IBM59', 'IBM58', 40, 5, '1', '1', '1', '2018-04-11 08:19:43'),
(136, 'IBM60', 'IBM59', 40, 5, '1', '1', '1', '2018-04-11 08:21:17'),
(137, 'IBM61', 'IBM60', 40, 5, '1', '1', '1', '2018-04-11 08:22:07'),
(138, 'IBM62', 'IBM61', 40, 5, '1', '1', '1', '2018-04-11 08:23:24'),
(139, 'IBM5', 'IBM1', 80, 6, '1', '1', '1', '2018-04-11 08:24:05'),
(140, 'IBM46', 'IBM5', 80, 6, '1', '1', '1', '2018-04-11 08:28:41'),
(141, 'IBM57', 'IBM46', 80, 6, '1', '1', '1', '2018-04-11 08:29:22'),
(142, 'IBM59', 'IBM57', 80, 6, '1', '1', '1', '2018-04-11 08:30:05'),
(143, 'IBM61', 'IBM59', 80, 6, '1', '1', '1', '2018-04-11 08:30:41'),
(144, 'IBM45', 'IBM1', 80, 6, '1', '1', '1', '2018-04-11 08:31:27'),
(145, 'IBM47', 'IBM45', 80, 6, '1', '1', '1', '2018-04-11 08:31:57'),
(146, 'IBM58', 'IBM47', 80, 6, '1', '1', '1', '2018-04-11 08:32:36'),
(147, 'IBM60', 'IBM58', 80, 6, '1', '1', '1', '2018-04-11 08:33:14'),
(148, 'IBM62', 'IBM60', 80, 6, '1', '1', '1', '2018-04-11 08:33:43'),
(149, 'IBM46', 'IBM1', 160, 7, '1', '1', '1', '2018-04-11 08:34:42'),
(150, 'IBM5', 'IBM1', 160, 7, '1', '1', '1', '2018-04-11 08:35:31'),
(151, 'IBM47', 'IBM5', 160, 7, '1', '1', '1', '2018-04-11 08:36:21'),
(152, 'IBM59', 'IBM47', 160, 7, '1', '1', '1', '2018-04-11 08:37:05'),
(153, 'IBM58', 'IBM46', 160, 7, '1', '1', '1', '2018-04-11 08:37:43'),
(154, 'IBM45', 'IBM1', 160, 7, '1', '1', '1', '2018-04-11 08:40:39'),
(155, 'IBM57', 'IBM45', 160, 7, '1', '1', '1', '2018-04-11 08:41:11'),
(156, 'IBM60', 'IBM57', 160, 7, '1', '1', '1', '2018-04-11 08:41:45'),
(157, 'IBM5', 'IBM1', 320, 8, '1', '1', '1', '2018-04-11 08:42:23'),
(158, 'IBM62', 'IBM59', 160, 7, '1', '1', '1', '2018-04-11 08:43:13'),
(159, 'IBM45', 'IBM1', 320, 8, '1', '1', '1', '2018-04-11 08:43:47'),
(160, 'IBM57', 'IBM5', 320, 8, '1', '1', '1', '2018-04-11 08:45:07'),
(161, 'IBM61', 'IBM58', 160, 7, '1', '1', '1', '2018-04-11 08:45:56'),
(162, 'IBM61', 'IBM57', 320, 8, '1', '1', '1', '2018-04-11 08:46:06'),
(163, 'IBM47', 'IBM1', 320, 8, '1', '1', '1', '2018-04-11 08:46:43'),
(164, 'IBM60', 'IBM47', 320, 8, '1', '1', '1', '2018-04-11 08:47:34'),
(165, 'IBM46', 'IBM1', 320, 8, '1', '1', '1', '2018-04-11 08:48:54'),
(166, 'IBM59', 'IBM46', 320, 8, '1', '1', '1', '2018-04-11 08:49:40'),
(167, 'IBM58', 'IBM45', 320, 8, '1', '1', '1', '2018-04-11 08:52:16'),
(168, 'IBM62', 'IBM58', 320, 8, '1', '1', '1', '2018-04-11 08:52:43'),
(169, 'IBM6', 'IBM2', 1.75, 1, '1', '1', '1', '2018-04-11 18:56:19'),
(170, 'IBM63', 'IBM6', 1.75, 1, '1', '1', '1', '2018-04-11 18:59:04'),
(171, 'IBM64', 'IBM6', 1.75, 1, '1', '1', '1', '2018-04-11 18:59:41'),
(172, 'IBM65', 'IBM6', 1.75, 1, '1', '1', '1', '2018-04-11 19:00:10'),
(173, 'IBM66', 'IBM6', 1.75, 1, '1', '1', '1', '2018-04-11 19:01:10'),
(174, 'IBM67', 'IBM63', 1.75, 1, '1', '1', '1', '2018-04-11 19:02:17'),
(175, 'IBM68', 'IBM63', 1.75, 1, '1', '1', '1', '2018-04-11 19:02:55'),
(176, 'IBM69', 'IBM63', 1.75, 1, '1', '1', '1', '2018-04-11 19:03:58'),
(177, 'IBM70', 'IBM63', 1.75, 1, '1', '1', '1', '2018-04-11 19:04:30'),
(178, 'IBM71', 'IBM64', 1.75, 1, '1', '1', '1', '2018-04-11 19:05:00'),
(179, 'IBM72', 'IBM64', 1.75, 1, '1', '1', '1', '2018-04-11 19:05:30'),
(180, 'IBM73', 'IBM64', 1.75, 1, '1', '1', '1', '2018-04-11 19:06:10'),
(181, 'IBM6', 'IBM1', 5, 2, '1', '1', '1', '2018-04-11 19:08:19'),
(182, 'IBM80', 'IBM67', 1.75, 1, '1', '1', '1', '2018-04-11 19:25:43'),
(183, 'IBM81', 'IBM67', 1.75, 1, '1', '1', '1', '2018-04-11 19:26:14'),
(184, 'IBM74', 'IBM67', 1.75, 1, '1', '1', '1', '2018-04-11 19:27:35'),
(185, 'IBM75', 'IBM67', 1.75, 1, '1', '1', '1', '2018-04-11 19:28:01'),
(186, 'IBM76', 'IBM80', 1.75, 1, '1', '1', '1', '2018-04-11 19:29:33'),
(187, 'IBM63', 'IBM1', 5, 2, '1', '1', '1', '2018-04-11 19:32:00'),
(188, 'IBM80', 'IBM63', 5, 2, '1', '1', '1', '2018-04-11 19:32:28'),
(189, 'IBM67', 'IBM6', 5, 2, '1', '1', '1', '2018-04-11 19:33:05'),
(190, 'IBM76', 'IBM67', 5, 2, '1', '1', '1', '2018-04-11 19:33:45'),
(191, 'IBM63', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 19:34:27'),
(192, 'IBM76', 'IBM63', 10, 3, '1', '1', '1', '2018-04-11 19:34:53'),
(193, 'IBM6', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 19:36:01'),
(194, 'IBM80', 'IBM6', 10, 3, '1', '1', '1', '2018-04-11 19:36:28'),
(195, 'IBM67', 'IBM1', 10, 3, '1', '1', '1', '2018-04-11 19:37:02'),
(196, 'IBM2', 'IBM1', 5, 2, '1', '1', '1', '2018-04-12 03:57:07'),
(197, 'IBM2', 'IBM1', 10, 3, '1', '1', '1', '2018-04-12 03:57:18'),
(198, 'IBM2', 'IBM1', 20, 4, '1', '1', '1', '2018-04-12 03:59:10'),
(199, 'IBM67', 'IBM1', 20, 4, '1', '1', '1', '2018-04-12 04:00:02'),
(200, 'IBM2', 'IBM1', 40, 5, '1', '1', '1', '2018-04-12 04:00:47'),
(201, 'IBM6', 'IBM1', 20, 4, '1', '1', '1', '2018-04-12 04:01:39'),
(202, 'IBM6', 'IBM2', 40, 5, '1', '1', '1', '2018-04-12 17:18:42'),
(203, 'IBM63', 'IBM1', 20, 4, '1', '1', '1', '2018-04-12 18:55:09'),
(204, 'IBM63', 'IBM6', 40, 5, '1', '1', '1', '2018-04-12 18:55:28'),
(205, 'IBM67', 'IBM63', 40, 5, '1', '1', '1', '2018-04-12 19:05:56'),
(206, 'IBM6', 'IBM1', 80, 6, '1', '1', '1', '2018-04-12 19:07:14'),
(207, 'IBM67', 'IBM6', 80, 6, '1', '1', '1', '2018-04-12 19:10:01'),
(208, 'IBM76', 'IBM6', 20, 4, '1', '1', '1', '2018-04-14 06:07:23'),
(209, 'IBM80', 'IBM2', 20, 4, '1', '1', '1', '2018-04-14 06:08:37'),
(210, 'IBM80', 'IBM67', 40, 5, '1', '1', '1', '2018-04-14 06:08:57'),
(211, 'IBM2', 'IBM1', 80, 6, '1', '1', '1', '2018-04-14 06:12:19'),
(212, 'IBM2', 'IBM1', 160, 7, '1', '1', '1', '2018-04-14 06:12:37'),
(213, 'IBM76', 'IBM80', 40, 5, '1', '1', '1', '2018-04-14 06:13:34'),
(214, 'IBM67', 'IBM2', 160, 7, '1', '1', '1', '2018-04-14 06:15:31'),
(215, 'IBM76', 'IBM67', 80, 6, '1', '1', '1', '2018-04-14 06:16:32'),
(216, 'IBM63', 'IBM2', 80, 6, '1', '1', '1', '2018-04-14 06:19:25'),
(217, 'IBM63', 'IBM1', 160, 7, '1', '1', '1', '2018-04-14 06:20:24'),
(218, 'IBM80', 'IBM63', 80, 6, '1', '1', '1', '2018-04-14 06:21:14'),
(219, 'IBM6', 'IBM1', 160, 7, '1', '1', '1', '2018-04-14 06:22:32'),
(220, 'IBM80', 'IBM6', 160, 7, '1', '1', '1', '2018-04-14 06:23:16'),
(221, 'IBM6', 'IBM1', 320, 8, '1', '1', '1', '2018-04-14 06:40:01'),
(222, 'IBM76', 'IBM63', 160, 7, '1', '1', '1', '2018-04-14 06:41:50'),
(223, 'IBM76', 'IBM6', 320, 8, '1', '1', '1', '2018-04-14 06:42:08'),
(224, 'IBM2', 'IBM1', 320, 8, '1', '1', '1', '2018-04-14 06:43:36'),
(225, 'IBM80', 'IBM2', 320, 8, '1', '1', '1', '2018-04-14 06:44:05'),
(226, 'IBM67', 'IBM1', 320, 8, '1', '1', '1', '2018-04-14 06:47:06'),
(227, 'IBM63', 'IBM1', 320, 8, '1', '1', '1', '2018-04-14 06:47:39'),
(228, 'IBM16', 'IBM2', 1.75, 1, '1', '1', '1', '2018-04-14 11:32:02'),
(229, 'IBM84', 'IBM16', 1.75, 1, '1', '1', '1', '2018-04-14 11:33:00'),
(230, 'IBM85', 'IBM16', 1.75, 1, '1', '1', '1', '2018-04-14 11:33:38'),
(231, 'IBM86', 'IBM16', 1.75, 1, '1', '1', '1', '2018-04-14 11:34:02'),
(232, 'IBM87', 'IBM16', 1.75, 1, '1', '1', '1', '2018-04-14 11:34:30'),
(233, 'IBM88', 'IBM84', 1.75, 1, '1', '1', '1', '2018-04-14 11:36:11'),
(234, 'IBM89', 'IBM84', 1.75, 1, '1', '1', '1', '2018-04-14 11:44:47'),
(235, 'IBM90', 'IBM84', 1.75, 1, '1', '1', '1', '2018-04-14 11:45:22'),
(236, 'IBM91', 'IBM84', 1.75, 1, '1', '1', '1', '2018-04-14 11:45:52'),
(237, 'IBM94', 'IBM88', 1.75, 1, '1', '1', '1', '2018-04-14 12:03:51'),
(238, 'IBM95', 'IBM94', 1.75, 1, '1', '1', '1', '2018-04-14 12:08:35'),
(239, 'IBM96', 'IBM95', 1.75, 1, '1', '1', '1', '2018-04-14 12:16:33'),
(240, 'IBM97', 'IBM96', 1.75, 1, '1', '1', '1', '2018-04-14 12:20:43'),
(241, 'IBM98', 'IBM97', 1.75, 1, '1', '1', '1', '2018-04-14 12:24:33'),
(242, 'IBM99', 'IBM98', 1.75, 1, '1', '1', '1', '2018-04-14 12:29:09'),
(243, 'IBM103', 'IBM99', 1.75, 1, '1', '1', '1', '2018-04-14 12:32:07'),
(244, 'IBM102', 'IBM99', 1.75, 1, '1', '1', '1', '2018-04-14 14:44:02'),
(245, 'IBM104', 'IBM102', 1.75, 1, '1', '1', '1', '2018-04-14 14:45:12'),
(246, 'IBM105', 'IBM104', 1.75, 1, '1', '1', '1', '2018-04-14 14:46:47'),
(247, 'IBM106', 'IBM105', 1.75, 1, '1', '1', '1', '2018-04-14 14:47:47'),
(248, 'IBM107', 'IBM106', 1.75, 1, '1', '1', '1', '2018-04-14 14:49:04'),
(249, 'IBM108', 'IBM107', 1.75, 1, '1', '1', '1', '2018-04-14 14:49:29'),
(250, 'IBM109', 'IBM108', 1.75, 1, '1', '1', '1', '2018-04-14 14:50:02'),
(251, 'IBM16', 'IBM1', 5, 2, '1', '1', '1', '2018-04-14 14:53:03'),
(252, 'IBM84', 'IBM2', 5, 2, '1', '1', '1', '2018-04-14 14:54:53'),
(253, 'IBM88', 'IBM16', 5, 2, '1', '1', '1', '2018-04-14 14:56:38'),
(254, 'IBM95', 'IBM88', 5, 2, '1', '1', '1', '2018-04-14 14:58:30'),
(255, 'IBM97', 'IBM95', 5, 2, '1', '1', '1', '2018-04-14 14:59:47'),
(256, 'IBM94', 'IBM84', 5, 2, '1', '1', '1', '2018-04-14 15:01:02'),
(257, 'IBM99', 'IBM97', 5, 2, '1', '1', '1', '2018-04-14 15:01:49'),
(258, 'IBM96', 'IBM94', 5, 2, '1', '1', '1', '2018-04-14 15:03:42'),
(259, 'IBM98', 'IBM96', 5, 2, '1', '1', '1', '2018-04-14 15:04:19'),
(260, 'IBM102', 'IBM98', 5, 2, '1', '1', '1', '2018-04-14 15:04:56'),
(261, 'IBM88', 'IBM2', 10, 3, '1', '1', '1', '2018-04-14 15:08:12'),
(262, 'IBM96', 'IBM88', 10, 3, '1', '1', '1', '2018-04-14 15:10:50'),
(263, 'IBM16', 'IBM1', 10, 3, '1', '1', '1', '2018-04-14 15:12:33'),
(264, 'IBM99', 'IBM96', 10, 3, '1', '1', '1', '2018-04-14 15:14:05'),
(265, 'IBM104', 'IBM99', 5, 2, '1', '1', '1', '2018-04-14 15:14:42'),
(266, 'IBM84', 'IBM1', 10, 3, '1', '1', '1', '2018-04-14 15:18:10'),
(267, 'IBM94', 'IBM16', 10, 3, '1', '1', '1', '2018-04-14 15:20:49'),
(268, 'IBM94', 'IBM2', 20, 4, '1', '1', '1', '2018-04-14 15:21:12'),
(269, 'IBM95', 'IBM84', 10, 3, '1', '1', '1', '2018-04-14 15:23:33'),
(270, 'IBM84', 'IBM1', 20, 4, '1', '1', '1', '2018-04-14 15:37:38'),
(271, 'IBM96', 'IBM84', 20, 4, '1', '1', '1', '2018-04-14 15:38:20'),
(272, 'IBM97', 'IBM94', 10, 3, '1', '1', '1', '2018-04-14 15:40:38'),
(273, 'IBM97', 'IBM84', 20, 4, '1', '1', '1', '2018-04-14 15:40:56'),
(274, 'IBM98', 'IBM95', 10, 3, '1', '1', '1', '2018-04-14 15:42:17'),
(275, 'IBM98', 'IBM94', 20, 4, '1', '1', '1', '2018-04-14 15:42:57'),
(276, 'IBM102', 'IBM97', 10, 3, '1', '1', '1', '2018-04-14 15:43:51'),
(277, 'IBM102', 'IBM96', 20, 4, '1', '1', '1', '2018-04-14 15:44:24'),
(278, 'IBM104', 'IBM98', 10, 3, '1', '1', '1', '2018-04-14 15:45:26'),
(279, 'IBM104', 'IBM97', 20, 4, '1', '1', '1', '2018-04-14 15:45:48'),
(280, 'IBM105', 'IBM102', 5, 2, '1', '1', '1', '2018-04-14 15:47:13'),
(281, 'IBM105', 'IBM99', 10, 3, '1', '1', '1', '2018-04-14 15:47:35'),
(282, 'IBM105', 'IBM98', 20, 4, '1', '1', '1', '2018-04-14 15:48:52'),
(283, 'IBM106', 'IBM104', 5, 2, '1', '1', '1', '2018-04-14 15:49:34'),
(284, 'IBM106', 'IBM102', 10, 3, '1', '1', '1', '2018-04-14 15:49:42'),
(285, 'IBM16', 'IBM1', 20, 4, '1', '1', '1', '2018-04-14 15:52:01'),
(286, 'IBM95', 'IBM16', 20, 4, '1', '1', '1', '2018-04-14 15:52:41'),
(287, 'IBM99', 'IBM95', 20, 4, '1', '1', '1', '2018-04-14 15:53:27'),
(288, 'IBM106', 'IBM99', 20, 4, '1', '1', '1', '2018-04-14 15:54:08'),
(289, 'IBM107', 'IBM105', 5, 2, '1', '1', '1', '2018-04-14 15:55:10'),
(290, 'IBM107', 'IBM104', 10, 3, '1', '1', '1', '2018-04-14 15:55:24'),
(291, 'IBM107', 'IBM102', 20, 4, '1', '1', '1', '2018-04-14 15:55:39'),
(292, 'IBM108', 'IBM106', 5, 2, '1', '1', '1', '2018-04-14 15:56:12'),
(293, 'IBM108', 'IBM105', 10, 3, '1', '1', '1', '2018-04-14 15:56:20'),
(294, 'IBM108', 'IBM104', 20, 4, '1', '1', '1', '2018-04-14 15:56:28'),
(295, 'IBM109', 'IBM107', 5, 2, '1', '1', '1', '2018-04-14 15:57:06'),
(296, 'IBM109', 'IBM106', 10, 3, '1', '1', '1', '2018-04-14 15:57:14'),
(297, 'IBM109', 'IBM105', 20, 4, '1', '1', '1', '2018-04-14 15:57:24'),
(298, 'IBM16', 'IBM2', 40, 5, '1', '1', '1', '2018-04-14 16:06:18'),
(299, 'IBM16', 'IBM1', 80, 6, '1', '1', '1', '2018-04-14 21:44:56'),
(300, 'IBM84', 'IBM16', 40, 5, '1', '1', '1', '2018-04-14 21:45:58'),
(301, 'IBM84', 'IBM2', 80, 6, '1', '1', '1', '2018-04-14 21:46:15'),
(302, 'IBM84', 'IBM1', 160, 7, '1', '1', '1', '2018-04-14 21:46:50'),
(303, 'IBM84', 'IBM1', 320, 8, '1', '1', '1', '2018-04-14 21:47:01'),
(304, 'IBM88', 'IBM1', 20, 4, '1', '1', '1', '2018-04-16 09:28:51'),
(305, 'IBM88', 'IBM84', 40, 5, '1', '1', '1', '2018-04-16 09:29:07'),
(306, 'IBM94', 'IBM88', 40, 5, '1', '1', '1', '2018-04-16 09:30:11'),
(307, 'IBM95', 'IBM94', 40, 5, '1', '1', '1', '2018-04-16 09:31:07'),
(308, 'IBM96', 'IBM95', 40, 5, '1', '1', '1', '2018-04-16 09:32:27'),
(309, 'IBM102', 'IBM96', 40, 5, '1', '1', '1', '2018-04-16 09:33:31'),
(310, 'IBM98', 'IBM96', 40, 5, '1', '1', '1', '2018-04-16 09:34:37'),
(311, 'IBM97', 'IBM96', 40, 5, '1', '1', '1', '2018-04-16 09:35:11'),
(312, 'IBM99', 'IBM98', 40, 5, '1', '1', '1', '2018-04-16 09:35:59'),
(313, 'IBM104', 'IBM102', 40, 5, '1', '1', '1', '2018-04-16 09:37:00'),
(314, 'IBM107', 'IBM104', 40, 5, '1', '1', '1', '2018-04-16 09:37:39'),
(315, 'IBM106', 'IBM104', 40, 5, '1', '1', '1', '2018-04-16 09:38:17'),
(316, 'IBM105', 'IBM104', 40, 5, '1', '1', '1', '2018-04-16 09:38:52'),
(317, 'IBM109', 'IBM107', 40, 5, '1', '1', '1', '2018-04-16 09:39:44'),
(318, 'IBM108', 'IBM107', 40, 5, '1', '1', '1', '2018-04-16 09:40:33'),
(319, 'IBM88', 'IBM16', 80, 6, '1', '1', '1', '2018-04-16 19:42:32'),
(320, 'IBM94', 'IBM84', 80, 6, '1', '1', '1', '2018-04-16 19:59:57'),
(321, 'IBM16', 'IBM1', 160, 7, '1', '1', '1', '2018-04-16 20:00:58'),
(322, 'IBM94', 'IBM16', 160, 7, '1', '1', '1', '2018-04-16 20:02:08'),
(323, 'IBM95', 'IBM88', 80, 6, '1', '1', '1', '2018-04-16 20:02:51'),
(324, 'IBM95', 'IBM84', 160, 7, '1', '1', '1', '2018-04-16 20:03:11'),
(325, 'IBM16', 'IBM1', 320, 8, '1', '1', '1', '2018-04-16 20:05:26'),
(326, 'IBM88', 'IBM2', 160, 7, '1', '1', '1', '2018-04-16 20:06:38'),
(327, 'IBM88', 'IBM1', 320, 8, '1', '1', '1', '2018-04-16 20:06:47'),
(328, 'IBM94', 'IBM2', 320, 8, '1', '1', '1', '2018-04-16 20:09:11'),
(329, 'IBM95', 'IBM16', 320, 8, '1', '1', '1', '2018-04-16 20:09:52'),
(330, 'IBM96', 'IBM94', 80, 6, '1', '1', '1', '2018-04-16 20:10:26'),
(331, 'IBM96', 'IBM88', 160, 7, '1', '1', '1', '2018-04-16 20:10:36'),
(332, 'IBM96', 'IBM84', 320, 8, '1', '1', '1', '2018-04-16 20:10:44'),
(333, 'IBM97', 'IBM95', 80, 6, '1', '1', '1', '2018-04-16 20:11:15'),
(334, 'IBM97', 'IBM94', 160, 7, '1', '1', '1', '2018-04-16 20:11:25'),
(335, 'IBM97', 'IBM88', 320, 8, '1', '1', '1', '2018-04-16 20:11:41'),
(336, 'IBM98', 'IBM96', 80, 6, '1', '1', '1', '2018-04-16 20:12:34'),
(337, 'IBM98', 'IBM95', 160, 7, '1', '1', '1', '2018-04-16 20:12:44'),
(338, 'IBM98', 'IBM94', 320, 8, '1', '1', '1', '2018-04-16 20:12:54'),
(339, 'IBM99', 'IBM97', 80, 6, '1', '1', '1', '2018-04-16 20:13:23'),
(340, 'IBM99', 'IBM96', 160, 7, '1', '1', '1', '2018-04-16 20:13:42'),
(341, 'IBM99', 'IBM95', 320, 8, '1', '1', '1', '2018-04-16 20:13:52'),
(342, 'IBM102', 'IBM98', 80, 6, '1', '1', '1', '2018-04-16 20:14:26'),
(343, 'IBM102', 'IBM97', 160, 7, '1', '1', '1', '2018-04-16 20:14:35'),
(344, 'IBM102', 'IBM96', 320, 8, '1', '1', '1', '2018-04-16 20:14:43'),
(345, 'IBM104', 'IBM99', 80, 6, '1', '1', '1', '2018-04-16 20:15:18'),
(346, 'IBM104', 'IBM98', 160, 7, '1', '1', '1', '2018-04-16 20:15:27'),
(347, 'IBM104', 'IBM97', 320, 8, '1', '1', '1', '2018-04-16 20:15:36'),
(348, 'IBM107', 'IBM104', 80, 6, '1', '1', '1', '2018-04-16 20:17:06'),
(349, 'IBM105', 'IBM102', 80, 6, '1', '1', '1', '2018-04-16 20:17:44'),
(350, 'IBM105', 'IBM99', 160, 7, '1', '1', '1', '2018-04-16 20:17:56'),
(351, 'IBM105', 'IBM98', 320, 8, '1', '1', '1', '2018-04-16 20:18:11'),
(352, 'IBM106', 'IBM104', 80, 6, '1', '1', '1', '2018-04-16 20:19:27'),
(353, 'IBM106', 'IBM102', 160, 7, '1', '1', '1', '2018-04-16 20:19:39'),
(354, 'IBM106', 'IBM99', 320, 8, '1', '1', '1', '2018-04-16 20:19:47'),
(355, 'IBM107', 'IBM104', 160, 7, '1', '1', '1', '2018-04-16 20:21:26'),
(356, 'IBM107', 'IBM102', 320, 8, '1', '1', '1', '2018-04-16 20:21:34'),
(357, 'IBM108', 'IBM106', 80, 6, '1', '1', '1', '2018-04-16 20:22:03'),
(358, 'IBM108', 'IBM105', 160, 7, '1', '1', '1', '2018-04-16 20:22:11'),
(359, 'IBM108', 'IBM104', 320, 8, '1', '1', '1', '2018-04-16 20:22:20'),
(360, 'IBM109', 'IBM107', 80, 6, '1', '1', '1', '2018-04-16 20:22:47'),
(361, 'IBM109', 'IBM106', 160, 7, '1', '1', '1', '2018-04-16 20:23:00'),
(362, 'IBM109', 'IBM105', 320, 8, '1', '1', '1', '2018-04-16 20:23:08'),
(363, 'IBM110', 'IBM2', 1.75, 1, '1', '1', '1', '2018-04-23 11:16:42'),
(364, 'IBM111', 'IBM2', 1.75, 1, '1', '1', '1', '2018-04-23 11:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_levels`
--

CREATE TABLE `system_levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(100) NOT NULL,
  `level_price` float NOT NULL,
  `level_desc` varchar(200) NOT NULL,
  `level_logo` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_levels`
--

INSERT INTO `system_levels` (`id`, `level_name`, `level_price`, `level_desc`, `level_logo`, `date_added`, `date_updated`) VALUES
(1, 'Bronze', 5, '', '', '2017-12-23 15:20:06', NULL),
(2, 'Silver', 15, '', '', '2017-12-23 15:20:06', NULL),
(3, 'Ruby', 30, '', '', '2017-12-23 15:21:48', NULL),
(4, 'Pearl', 60, '', '', '2017-12-23 15:21:48', NULL),
(5, 'Gold', 120, '', '', '2017-12-23 15:21:48', NULL),
(6, 'Platinum', 240, '', '', '2017-12-23 15:21:48', NULL),
(7, 'Titanium', 480, '', '', '2017-12-23 15:21:48', NULL),
(8, 'Diamond', 960, '', '', '2017-12-23 15:21:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_templates`
--

CREATE TABLE `tbl_email_templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(150) NOT NULL,
  `time_delay` int(11) NOT NULL,
  `template_type` enum('1','2','3') NOT NULL COMMENT '1. Automated Emails 2. Follow up Email 3. Broadcast Email ',
  `template_content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `is_active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_email_templates`
--

INSERT INTO `tbl_email_templates` (`id`, `template_name`, `time_delay`, `template_type`, `template_content`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'new user register', 0, '1', '<p>welcome,</p>', '2018-01-22 00:57:08', '2018-01-31 13:06:59', '0'),
(2, 'successful upgrade', 0, '1', '<p>Hi {#first_name#}</p><p>Congratulations!</p><p><b>You have successfully UPGRADED to {#level#}</b></p><p>It is important that you upgrade through all 8 levels in order to receive payment from all your downline members. If you do not upgrade in time for a specific level, payments that was due to you will be passed up to your upline until you have successfully upgraded for that specific level. Please read your FAQ for a full explanation.<br></p>\r\n\r\n<p>Have a lovely day!</p><p>Yours Sincerely</p><p>TheViralMarketer Team</p>', '2018-10-29 01:53:49', '0000-00-00 00:00:00', '1'),
(3, 'payment notification', 0, '1', '<p>Hi {#first_name#}</p><p>Congratulations!! </p><p><b>You have just been paid {#amount#} USD for  {#level#}  by  {#name#}</b></p><p>Check your Transactional History in your member\'s area. <br></p><p>Make sure you are UPGRADED for all 8 levels to ensure that you receive future payments from all downline members. </p><p>Have a great day!</p>\r\n\r\n<p>Yours Sincerely</p><p>TheViralMarketer Team</p>', '2018-10-29 01:53:15', '0000-00-00 00:00:00', '1'),
(4, 'new register', 0, '1', '<div><div>Hi {#<b>first_name</b>#},</div><div>A BIG WELCOME to TheVIralmarketer. </div><div>Your IBM number is  {#<b>ibm</b>#}.</div><div>Your username is {#<b>email</b>#} .</div><div>You can now log in to your back office by going to www.theviralmarketer.biz...</div></div><div><br></div><div>Thanks</div><div>Regard</div><div>Viral Marketing</div><div><br></div>', '2018-01-25 21:31:16', '2018-07-10 14:43:31', '0'),
(5, 'time delay', 48, '2', 'time delay 48 hours&nbsp;', '2018-01-31 19:18:18', '2018-01-31 13:05:15', '0'),
(7, 'welcome to theviralmarketer', 0, '2', '<br>Hi {#first_name#}<div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android store. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div><div><br></div>', '2018-07-10 19:35:51', '2018-07-10 14:43:17', '0'),
(8, 'welcome to theviralmarketer', 0, '2', '<br>Hi {#first_name#}<div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is {#ibm#}</div><div>Your username is {#email#}</div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div><div><br></div><br><br>', '2018-07-10 19:43:04', '2018-07-10 15:12:36', '0'),
(9, 'welcome to theviralmarketer', 1, '2', '<br>Hi {#first_name#}<div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is {#ibm#}</div><div>Your username is {#email#}</div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div><div><br></div><br><br>', '2018-07-10 20:11:56', '2018-07-10 15:16:52', '0'),
(10, 'welcome to theviralmarketer', 0, '1', '<br>Hi {#first_name#}<div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is {#ibm#}</div><div>Your username is {#email#}</div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div><div><br></div><br><br>', '2018-07-10 20:16:39', '2018-10-16 17:48:38', '0'),
(11, 'welcome to theviralmarketer', 0, '1', '&lt;style type=\"text/css\" rel=\"stylesheet\" media=\"all\"&gt;\r\n    /* Base ------------------------------ */\r\n    \r\n    *:not(br):not(tr):not(html) {\r\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\r\n      box-sizing: border-box;\r\n    }\r\n    \r\n    body {\r\n      width: 100% !important;\r\n      height: 100%;\r\n      margin: 0;\r\n      line-height: 1.4;\r\n      background-color: #F2F4F6;\r\n      color: #74787E;\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    p,\r\n    ul,\r\n    ol,\r\n    blockquote {\r\n      line-height: 1.4;\r\n      text-align: left;\r\n    }\r\n    \r\n    a {\r\n      color: #3869D4;\r\n    }\r\n    \r\n    a img {\r\n      border: none;\r\n    }\r\n    \r\n    td {\r\n      word-break: break-word;\r\n    }\r\n    /* Layout ------------------------------ */\r\n    \r\n    .email-wrapper {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #F2F4F6;\r\n    }\r\n    \r\n    .email-content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    /* Masthead ----------------------- */\r\n    \r\n    .email-masthead {\r\n      padding: 25px 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-masthead_logo {\r\n      width: 94px;\r\n    }\r\n    \r\n    .email-masthead_name {\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      color: #bbbfc3;\r\n      text-decoration: none;\r\n      text-shadow: 0 1px 0 white;\r\n    }\r\n    /* Body ------------------------------ */\r\n    \r\n    .email-body {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      border-top: 1px solid #EDEFF2;\r\n      border-bottom: 1px solid #EDEFF2;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-body_inner {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-footer {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-footer p {\r\n      color: #AEAEAE;\r\n    }\r\n    \r\n    .body-action {\r\n      width: 100%;\r\n      margin: 30px auto;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .body-sub {\r\n      margin-top: 25px;\r\n      padding-top: 25px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .content-cell {\r\n      padding: 35px;\r\n    }\r\n    \r\n    .preheader {\r\n      display: none !important;\r\n      visibility: hidden;\r\n      mso-hide: all;\r\n      font-size: 1px;\r\n      line-height: 1px;\r\n      max-height: 0;\r\n      max-width: 0;\r\n      opacity: 0;\r\n      overflow: hidden;\r\n    }\r\n    /* Attribute list ------------------------------ */\r\n    \r\n    .attributes {\r\n      margin: 0 0 21px;\r\n    }\r\n    \r\n    .attributes_content {\r\n      background-color: #EDEFF2;\r\n      padding: 16px;\r\n    }\r\n    \r\n    .attributes_item {\r\n      padding: 0;\r\n    }\r\n    /* Related Items ------------------------------ */\r\n    \r\n    .related {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .related_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .related_item-title {\r\n      display: block;\r\n      margin: .5em 0 0;\r\n    }\r\n    \r\n    .related_item-thumb {\r\n      display: block;\r\n      padding-bottom: 10px;\r\n    }\r\n    \r\n    .related_heading {\r\n      border-top: 1px solid #EDEFF2;\r\n      text-align: center;\r\n      padding: 25px 0 10px;\r\n    }\r\n    /* Discount Code ------------------------------ */\r\n    \r\n    .discount {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 24px;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #EDEFF2;\r\n      border: 2px dashed #9BA2AB;\r\n    }\r\n    \r\n    .discount_heading {\r\n      text-align: center;\r\n    }\r\n    \r\n    .discount_body {\r\n      text-align: center;\r\n      font-size: 15px;\r\n    }\r\n    /* Social Icons ------------------------------ */\r\n    \r\n    .social {\r\n      width: auto;\r\n    }\r\n    \r\n    .social td {\r\n      padding: 0;\r\n      width: auto;\r\n    }\r\n    \r\n    .social_icon {\r\n      height: 20px;\r\n      margin: 0 8px 10px 8px;\r\n      padding: 0;\r\n    }\r\n    /* Data table ------------------------------ */\r\n    \r\n    .purchase {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 35px 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .purchase_heading {\r\n      padding-bottom: 8px;\r\n      border-bottom: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_heading p {\r\n      margin: 0;\r\n      color: #9BA2AB;\r\n      font-size: 12px;\r\n    }\r\n    \r\n    .purchase_footer {\r\n      padding-top: 15px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_total {\r\n      margin: 0;\r\n      text-align: right;\r\n      font-weight: bold;\r\n      color: #2F3133;\r\n    }\r\n    \r\n    .purchase_total--label {\r\n      padding: 0 15px 0 0;\r\n    }\r\n    /* Utilities ------------------------------ */\r\n    \r\n    .align-right {\r\n      text-align: right;\r\n    }\r\n    \r\n    .align-left {\r\n      text-align: left;\r\n    }\r\n    \r\n    .align-center {\r\n      text-align: center;\r\n    }\r\n    /*Media Queries ------------------------------ */\r\n    \r\n    @media only screen and (max-width: 600px) {\r\n      .email-body_inner,\r\n      .email-footer {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    \r\n    @media only screen and (max-width: 500px) {\r\n      .button {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    /* Buttons ------------------------------ */\r\n    \r\n    .button {\r\n      background-color: #3869D4;\r\n      border-top: 10px solid #3869D4;\r\n      border-right: 18px solid #3869D4;\r\n      border-bottom: 10px solid #3869D4;\r\n      border-left: 18px solid #3869D4;\r\n      display: inline-block;\r\n      color: #FFF;\r\n      text-decoration: none;\r\n      border-radius: 3px;\r\n      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    .button--green {\r\n      background-color: #22BC66;\r\n      border-top: 10px solid #22BC66;\r\n      border-right: 18px solid #22BC66;\r\n      border-bottom: 10px solid #22BC66;\r\n      border-left: 18px solid #22BC66;\r\n    }\r\n    \r\n    .button--red {\r\n      background-color: #FF6136;\r\n      border-top: 10px solid #FF6136;\r\n      border-right: 18px solid #FF6136;\r\n      border-bottom: 10px solid #FF6136;\r\n      border-left: 18px solid #FF6136;\r\n    }\r\n    /* Type ------------------------------ */\r\n    \r\n    h1 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 19px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h2 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h3 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 14px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    p {\r\n      margin-top: 0;\r\n      color: #74787E;\r\n      font-size: 16px;\r\n      line-height: 1.5em;\r\n      text-align: left;\r\n    }\r\n    \r\n    p.sub {\r\n      font-size: 12px;\r\n    }\r\n    \r\n    p.center {\r\n      text-align: center;\r\n    }\r\n    &lt;/style&gt;<blockquote xss=removed><br>Hi, <b>{#first_name#}</b><div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is<b> {#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to <a href=\"www.theviralmarketer.biz\" title=\"\" target=\"_blank\">www.theviralmarketer.biz</a> </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div></blockquote><div><br></div><br><br>', '2018-07-12 16:35:03', '2018-07-12 12:01:51', '0'),
(12, 'welcome to theviralmarketer', 0, '1', '&lt;style type=\"text/css\" rel=\"stylesheet\" media=\"all\"&gt;\r\n    /* Base ------------------------------ */\r\n    \r\n    *:not(br):not(tr):not(html) {\r\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\r\n      box-sizing: border-box;\r\n    }\r\n    \r\n    body {\r\n      width: 100% !important;\r\n      height: 100%;\r\n      margin: 0;\r\n      line-height: 1.4;\r\n      background-color: #F2F4F6;\r\n      color: #74787E;\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    p,\r\n    ul,\r\n    ol,\r\n    blockquote {\r\n      line-height: 1.4;\r\n      text-align: left;\r\n    }\r\n    \r\n    a {\r\n      color: #3869D4;\r\n    }\r\n    \r\n    a img {\r\n      border: none;\r\n    }\r\n    \r\n    td {\r\n      word-break: break-word;\r\n    }\r\n    /* Layout ------------------------------ */\r\n    \r\n    .email-wrapper {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #F2F4F6;\r\n    }\r\n    \r\n    .email-content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    /* Masthead ----------------------- */\r\n    \r\n    .email-masthead {\r\n      padding: 25px 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-masthead_logo {\r\n      width: 94px;\r\n    }\r\n    \r\n    .email-masthead_name {\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      color: #bbbfc3;\r\n      text-decoration: none;\r\n      text-shadow: 0 1px 0 white;\r\n    }\r\n    /* Body ------------------------------ */\r\n    \r\n    .email-body {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      border-top: 1px solid #EDEFF2;\r\n      border-bottom: 1px solid #EDEFF2;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-body_inner {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-footer {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-footer p {\r\n      color: #AEAEAE;\r\n    }\r\n    \r\n    .body-action {\r\n      width: 100%;\r\n      margin: 30px auto;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .body-sub {\r\n      margin-top: 25px;\r\n      padding-top: 25px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .content-cell {\r\n      padding: 35px;\r\n    }\r\n    \r\n    .preheader {\r\n      display: none !important;\r\n      visibility: hidden;\r\n      mso-hide: all;\r\n      font-size: 1px;\r\n      line-height: 1px;\r\n      max-height: 0;\r\n      max-width: 0;\r\n      opacity: 0;\r\n      overflow: hidden;\r\n    }\r\n    /* Attribute list ------------------------------ */\r\n    \r\n    .attributes {\r\n      margin: 0 0 21px;\r\n    }\r\n    \r\n    .attributes_content {\r\n      background-color: #EDEFF2;\r\n      padding: 16px;\r\n    }\r\n    \r\n    .attributes_item {\r\n      padding: 0;\r\n    }\r\n    /* Related Items ------------------------------ */\r\n    \r\n    .related {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .related_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .related_item-title {\r\n      display: block;\r\n      margin: .5em 0 0;\r\n    }\r\n    \r\n    .related_item-thumb {\r\n      display: block;\r\n      padding-bottom: 10px;\r\n    }\r\n    \r\n    .related_heading {\r\n      border-top: 1px solid #EDEFF2;\r\n      text-align: center;\r\n      padding: 25px 0 10px;\r\n    }\r\n    /* Discount Code ------------------------------ */\r\n    \r\n    .discount {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 24px;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #EDEFF2;\r\n      border: 2px dashed #9BA2AB;\r\n    }\r\n    \r\n    .discount_heading {\r\n      text-align: center;\r\n    }\r\n    \r\n    .discount_body {\r\n      text-align: center;\r\n      font-size: 15px;\r\n    }\r\n    /* Social Icons ------------------------------ */\r\n    \r\n    .social {\r\n      width: auto;\r\n    }\r\n    \r\n    .social td {\r\n      padding: 0;\r\n      width: auto;\r\n    }\r\n    \r\n    .social_icon {\r\n      height: 20px;\r\n      margin: 0 8px 10px 8px;\r\n      padding: 0;\r\n    }\r\n    /* Data table ------------------------------ */\r\n    \r\n    .purchase {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 35px 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .purchase_heading {\r\n      padding-bottom: 8px;\r\n      border-bottom: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_heading p {\r\n      margin: 0;\r\n      color: #9BA2AB;\r\n      font-size: 12px;\r\n    }\r\n    \r\n    .purchase_footer {\r\n      padding-top: 15px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_total {\r\n      margin: 0;\r\n      text-align: right;\r\n      font-weight: bold;\r\n      color: #2F3133;\r\n    }\r\n    \r\n    .purchase_total--label {\r\n      padding: 0 15px 0 0;\r\n    }\r\n    /* Utilities ------------------------------ */\r\n    \r\n    .align-right {\r\n      text-align: right;\r\n    }\r\n    \r\n    .align-left {\r\n      text-align: left;\r\n    }\r\n    \r\n    .align-center {\r\n      text-align: center;\r\n    }\r\n    /*Media Queries ------------------------------ */\r\n    \r\n    @media only screen and (max-width: 600px) {\r\n      .email-body_inner,\r\n      .email-footer {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    \r\n    @media only screen and (max-width: 500px) {\r\n      .button {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    /* Buttons ------------------------------ */\r\n    \r\n    .button {\r\n      background-color: #3869D4;\r\n      border-top: 10px solid #3869D4;\r\n      border-right: 18px solid #3869D4;\r\n      border-bottom: 10px solid #3869D4;\r\n      border-left: 18px solid #3869D4;\r\n      display: inline-block;\r\n      color: #FFF;\r\n      text-decoration: none;\r\n      border-radius: 3px;\r\n      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    .button--green {\r\n      background-color: #22BC66;\r\n      border-top: 10px solid #22BC66;\r\n      border-right: 18px solid #22BC66;\r\n      border-bottom: 10px solid #22BC66;\r\n      border-left: 18px solid #22BC66;\r\n    }\r\n    \r\n    .button--red {\r\n      background-color: #FF6136;\r\n      border-top: 10px solid #FF6136;\r\n      border-right: 18px solid #FF6136;\r\n      border-bottom: 10px solid #FF6136;\r\n      border-left: 18px solid #FF6136;\r\n    }\r\n    /* Type ------------------------------ */\r\n    \r\n    h1 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 19px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h2 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h3 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 14px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    p {\r\n      margin-top: 0;\r\n      color: #74787E;\r\n      font-size: 16px;\r\n      line-height: 1.5em;\r\n      text-align: left;\r\n    }\r\n    \r\n    p.sub {\r\n      font-size: 12px;\r\n    }\r\n    \r\n    p.center {\r\n      text-align: center;\r\n    }\r\n    &lt;/style&gt;<blockquote xss=\"removed\"><br>Hi, <b>{#first_name#}</b><div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is<b> {#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to <a href=\"www.theviralmarketer.biz\" title=\"\" target=\"_blank\">www.theviralmarketer.biz</a> </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div></blockquote><div><br></div><br><br>', '2018-07-12 16:50:23', '2018-07-12 12:01:38', '0'),
(13, 'welcome to theviralmarketer', 0, '1', '<blockquote xss=\"removed\"><br>Hi, <b>{#first_name#}</b><div><br></div><div>Trust all is well.</div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is<b> {#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to <a href=\"www.theviralmarketer.biz\" title=\"\" target=\"_blank\">www.theviralmarketer.biz</a> </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div><div><br></div></blockquote><div><br></div><br><br>\r\n &lt;style&gt;\r\n    /* Base ------------------------------ */\r\n    \r\n    *:not(br):not(tr):not(html) {\r\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\r\n      box-sizing: border-box;\r\n    }\r\n    \r\n    body {\r\n      width: 100% !important;\r\n      height: 100%;\r\n      margin: 0;\r\n      line-height: 1.4;\r\n      background-color: #F2F4F6;\r\n      color: #74787E;\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    p,\r\n    ul,\r\n    ol,\r\n    blockquote {\r\n      line-height: 1.4;\r\n      text-align: left;\r\n    }\r\n    \r\n    a {\r\n      color: #3869D4;\r\n    }\r\n    \r\n    a img {\r\n      border: none;\r\n    }\r\n    \r\n    td {\r\n      word-break: break-word;\r\n    }\r\n    /* Layout ------------------------------ */\r\n    \r\n    .email-wrapper {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #F2F4F6;\r\n    }\r\n    \r\n    .email-content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    /* Masthead ----------------------- */\r\n    \r\n    .email-masthead {\r\n      padding: 25px 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-masthead_logo {\r\n      width: 94px;\r\n    }\r\n    \r\n    .email-masthead_name {\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      color: #bbbfc3;\r\n      text-decoration: none;\r\n      text-shadow: 0 1px 0 white;\r\n    }\r\n    /* Body ------------------------------ */\r\n    \r\n    .email-body {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      border-top: 1px solid #EDEFF2;\r\n      border-bottom: 1px solid #EDEFF2;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-body_inner {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #FFFFFF;\r\n    }\r\n    \r\n    .email-footer {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      -premailer-width: 570px;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .email-footer p {\r\n      color: #AEAEAE;\r\n    }\r\n    \r\n    .body-action {\r\n      width: 100%;\r\n      margin: 30px auto;\r\n      padding: 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      text-align: center;\r\n    }\r\n    \r\n    .body-sub {\r\n      margin-top: 25px;\r\n      padding-top: 25px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .content-cell {\r\n      padding: 35px;\r\n    }\r\n    \r\n    .preheader {\r\n      display: none !important;\r\n      visibility: hidden;\r\n      mso-hide: all;\r\n      font-size: 1px;\r\n      line-height: 1px;\r\n      max-height: 0;\r\n      max-width: 0;\r\n      opacity: 0;\r\n      overflow: hidden;\r\n    }\r\n    /* Attribute list ------------------------------ */\r\n    \r\n    .attributes {\r\n      margin: 0 0 21px;\r\n    }\r\n    \r\n    .attributes_content {\r\n      background-color: #EDEFF2;\r\n      padding: 16px;\r\n    }\r\n    \r\n    .attributes_item {\r\n      padding: 0;\r\n    }\r\n    /* Related Items ------------------------------ */\r\n    \r\n    .related {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .related_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .related_item-title {\r\n      display: block;\r\n      margin: .5em 0 0;\r\n    }\r\n    \r\n    .related_item-thumb {\r\n      display: block;\r\n      padding-bottom: 10px;\r\n    }\r\n    \r\n    .related_heading {\r\n      border-top: 1px solid #EDEFF2;\r\n      text-align: center;\r\n      padding: 25px 0 10px;\r\n    }\r\n    /* Discount Code ------------------------------ */\r\n    \r\n    .discount {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 24px;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n      background-color: #EDEFF2;\r\n      border: 2px dashed #9BA2AB;\r\n    }\r\n    \r\n    .discount_heading {\r\n      text-align: center;\r\n    }\r\n    \r\n    .discount_body {\r\n      text-align: center;\r\n      font-size: 15px;\r\n    }\r\n    /* Social Icons ------------------------------ */\r\n    \r\n    .social {\r\n      width: auto;\r\n    }\r\n    \r\n    .social td {\r\n      padding: 0;\r\n      width: auto;\r\n    }\r\n    \r\n    .social_icon {\r\n      height: 20px;\r\n      margin: 0 8px 10px 8px;\r\n      padding: 0;\r\n    }\r\n    /* Data table ------------------------------ */\r\n    \r\n    .purchase {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 35px 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_content {\r\n      width: 100%;\r\n      margin: 0;\r\n      padding: 25px 0 0 0;\r\n      -premailer-width: 100%;\r\n      -premailer-cellpadding: 0;\r\n      -premailer-cellspacing: 0;\r\n    }\r\n    \r\n    .purchase_item {\r\n      padding: 10px 0;\r\n      color: #74787E;\r\n      font-size: 15px;\r\n      line-height: 18px;\r\n    }\r\n    \r\n    .purchase_heading {\r\n      padding-bottom: 8px;\r\n      border-bottom: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_heading p {\r\n      margin: 0;\r\n      color: #9BA2AB;\r\n      font-size: 12px;\r\n    }\r\n    \r\n    .purchase_footer {\r\n      padding-top: 15px;\r\n      border-top: 1px solid #EDEFF2;\r\n    }\r\n    \r\n    .purchase_total {\r\n      margin: 0;\r\n      text-align: right;\r\n      font-weight: bold;\r\n      color: #2F3133;\r\n    }\r\n    \r\n    .purchase_total--label {\r\n      padding: 0 15px 0 0;\r\n    }\r\n    /* Utilities ------------------------------ */\r\n    \r\n    .align-right {\r\n      text-align: right;\r\n    }\r\n    \r\n    .align-left {\r\n      text-align: left;\r\n    }\r\n    \r\n    .align-center {\r\n      text-align: center;\r\n    }\r\n    /*Media Queries ------------------------------ */\r\n    \r\n    @media only screen and (max-width: 600px) {\r\n      .email-body_inner,\r\n      .email-footer {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    \r\n    @media only screen and (max-width: 500px) {\r\n      .button {\r\n        width: 100% !important;\r\n      }\r\n    }\r\n    /* Buttons ------------------------------ */\r\n    \r\n    .button {\r\n      background-color: #3869D4;\r\n      border-top: 10px solid #3869D4;\r\n      border-right: 18px solid #3869D4;\r\n      border-bottom: 10px solid #3869D4;\r\n      border-left: 18px solid #3869D4;\r\n      display: inline-block;\r\n      color: #FFF;\r\n      text-decoration: none;\r\n      border-radius: 3px;\r\n      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);\r\n      -webkit-text-size-adjust: none;\r\n    }\r\n    \r\n    .button--green {\r\n      background-color: #22BC66;\r\n      border-top: 10px solid #22BC66;\r\n      border-right: 18px solid #22BC66;\r\n      border-bottom: 10px solid #22BC66;\r\n      border-left: 18px solid #22BC66;\r\n    }\r\n    \r\n    .button--red {\r\n      background-color: #FF6136;\r\n      border-top: 10px solid #FF6136;\r\n      border-right: 18px solid #FF6136;\r\n      border-bottom: 10px solid #FF6136;\r\n      border-left: 18px solid #FF6136;\r\n    }\r\n    /* Type ------------------------------ */\r\n    \r\n    h1 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 19px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h2 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    h3 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 14px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    \r\n    p {\r\n      margin-top: 0;\r\n      color: #74787E;\r\n      font-size: 16px;\r\n      line-height: 1.5em;\r\n      text-align: left;\r\n    }\r\n    \r\n    p.sub {\r\n      font-size: 12px;\r\n    }\r\n    \r\n    p.center {\r\n      text-align: center;\r\n    }\r\n    &lt;/style&gt;', '2018-07-12 16:57:59', '2018-07-12 12:01:33', '0'),
(14, 'welcome to theviralmarketer', 0, '1', '<blockquote xss=removed><blockquote xss=removed><br></blockquote><blockquote xss=removed>Hi <b>{#first_name#}</b><br></blockquote><div>           Trust all is well.<br></div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is <b>{#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear. </div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div><br></div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div></blockquote><div><br></div><div><br></div><br><br>', '2018-07-12 17:03:56', '2018-07-16 08:39:43', '0'),
(15, 'welcome to theviralmarketer', 0, '1', '<blockquote xss=\"removed\"><blockquote xss=\"removed\">Hi <b>{#first_name#}</b><br></blockquote><div>Trust all is well.<br></div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is <b>{#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!!</div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear.</div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div></blockquote><div><br></div><div><br></div><br><br>', '2018-07-12 17:07:53', '2018-07-13 07:59:41', '0');
INSERT INTO `tbl_email_templates` (`id`, `template_name`, `time_delay`, `template_type`, `template_content`, `created_at`, `updated_at`, `is_active`) VALUES
(16, 'welcome to theviralmarketer', 0, '1', '<blockquote xss=\"removed\"><blockquote xss=\"removed\">Hi <b>{#first_name#}</b><br></blockquote><div>Trust all is well.<br></div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is <b>{#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!! </div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear.</div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div></blockquote><div><br></div><div><br></div><br><br>', '2018-07-12 17:11:28', '2018-07-13 07:59:49', '0'),
(17, 'welcome to theviralmarketer', 0, '1', '<blockquote xss=\"removed\"><blockquote xss=\"removed\">Hi <b>{#first_name#}</b><br></blockquote><div>Trust all is well.<br></div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is <b>{#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>Click <u>HERE</u> to download the app. </div><div>You can login to your admin area by going to www.theviralmarketer.biz </div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!! </div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear.</div><div><br></div><div>Finally, your success in using this powerful tool as well generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div>P.S. Please join our <u>Facebook group</u> where we share best practices, tricks and tips that can help you on your path. </div></blockquote><div><br></div><div><br></div><br><br>', '2018-07-13 12:49:20', '2018-07-13 07:59:32', '0'),
(18, 'welcome to viral-marketer', 0, '1', '<blockquote xss=\"removed\"><blockquote xss=\"removed\">Hi <b>{#first_name#}</b><br></blockquote><div>Trust all is well.<br></div><div><br></div><div><b>A Big Welcome to TheViralMarketer!</b></div><div><b><br></b></div><div>Your IBM is <b>{#ibm#}</b></div><div>Your username is <b>{#email#}</b></div><div>You can login to your admin area by going to www.theviralmarketer.biz</div><div><br></div><div>Let\'s get you off to a quick start...</div><div><br></div><div>First, TheViralMarketer is not in competition with any other MLM company. In fact, it is designed to assist you in your primary MLM business that you are currently building. On the contrary, it is also very newbie friendly and allows the complete novice to explore the world of MLM before seriously committing. </div><div>And then the best part of all, You can make money in the process!!! </div><div><br></div><div>By now you should be able to access your member\'s area which is accessible on your computer OR in the form of an APP in the IOS or Android stores. So no more excuses, you have a business in your pocket. We have a created video presentations which are placed within the member\'s area on strategic places. The very first one that you should watch is TheViralMarketer Explained and can be found on your dashboard in the member\'s area. We recommend that you watch this video carefully in order to avoid confusion. Watch it AGAIN and AGAIN until all things are clear.</div><div><br></div><div>Should you decide to UPGRADE your membership, it is required that you fund TheViralMarketer bitcoin wallet in your member\'s area. If you do not have an existing bitcoin wallet already, we suggest that you register with luno.com and transfer from your Luno wallet to your TheViralMarketer wallet that will enable you to UPGRADE. If Luno is not available in your country, you need to find a bitcoin exchanger that operates in your country. We are also working aggressively to make the funding of wallets available on the website. </div><div><br></div><div>Finally, your success in using this powerful tool as well as generating an income from it will be a result of your CONSISTENCY. </div><div><br></div><div>We are a positive community of people and want to change the world one person at a time, BE PART OF THE MOVEMENT. </div><div><br></div><div>See you on the inside.</div><div><br></div><div>Have a SUPERDAY!</div><div><br></div><div>Yours in business</div><div><br></div><div>TheViralMarketer TEAM</div><div>P.S. Please join our <a href=\"https://www.facebook.com/groups/414090752418384/\" title=\"\" target=\"_blank\"><u>Facebook Group</u> </a>where we share best practices, tricks and tips that can help you on your path. </div><div><br></div><div>Please Click on the link below to install TheViralMarketer on your phone:</div><div><br></div><a href=\"https://itunes.apple.com/DE/app/id1397141987\" title=\"\" target=\"_blank\"><img src=\"https://i.imgur.com/ZVNWhiM.jpg\" width=\"100\"></a>   <a href=\"https://play.google.com/store/apps/details?id=com.maralack.theviralmarketer\" title=\"\" target=\"_blank\"><img src=\"https://i.imgur.com/ocUmysp.jpg\" width=\"100\"></a><br><div><br></div></blockquote><div><br></div><div><br></div><br><br><br>', '2018-10-16 23:27:54', '0000-00-00 00:00:00', '1'),
(19, 'OTP Verification', 0, '1', '<blockquote xss=\"removed\"><blockquote xss=\"removed\">Hi <b>{#first_name#}</b><br></blockquote><div>Trust all is well.<br></div><div><br></div><div><b>Your One Time Password (OTP) for Payment on The Viral Marketer is {#otp_code#}.</b></div><div><b><br></b></div><div>Please do not share this OTP with anyone.</b></div><div>This code will expire in 10 minutes.</b></div><div><br></div><div><br></div></blockquote><div><br></div><div><br></div><br><br><p>Thanks,  <br>\r\n                        <strong>The Viral Marketer Team</strong>\r\n                        <a href=\"https://www.theviralmarketer.biz\">The Viral Marketer</a>\r\n                      </p><br>', '2020-08-16 02:10:12', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_landing_pages`
--

CREATE TABLE `tbl_landing_pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `youtube_video` varchar(100) NOT NULL,
  `min_level` int(10) NOT NULL,
  `page_path` varchar(100) NOT NULL,
  `page_images` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_landing_pages`
--

INSERT INTO `tbl_landing_pages` (`id`, `page_name`, `youtube_video`, `min_level`, `page_path`, `page_images`, `added_by`, `created_at`, `is_active`) VALUES
(2, 'Landing Page#2', 'youtueb.com/watch=tst', 0, 'landing_page_2', '70b39e1eccc8f664f1907febe78bcbe22.jpg', 1, '2018-02-11 01:43:26', '0'),
(3, 'Main Landing Page', 'https://www.youtube.com/watch?v=oRVXndd2Xlw&t=14s', 0, 'test_page', 'theviralmarketer3.png', 1, '2018-07-20 16:03:29', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-21 02:11:26'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-21 02:16:23'),
(3, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-21 03:24:51'),
(4, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-21 03:44:44'),
(5, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-21 03:57:26'),
(6, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.52.205.200', 'Chrome 62.0.3202.75', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.75 Safari/537.36', 'Windows 10', '2018-01-21 04:51:39'),
(7, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Mac OS X', '2018-01-21 06:27:02'),
(8, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.111', 'Mozilla/5.0 (Linux; Android 7.0; SM-N920T Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.111 Mobile Safari/537.36', 'Android', '2018-01-21 22:52:21'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-01-22 01:47:30'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-22 05:17:05'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Mac OS X', '2018-01-22 05:25:09'),
(12, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-22 05:37:21'),
(13, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-22 09:30:26'),
(14, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-01-23 00:23:20'),
(15, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-23 01:55:56'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-23 04:48:57'),
(17, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.68.129', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-23 08:13:49'),
(18, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.69.18', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-25 05:36:26'),
(19, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.69.18', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-25 08:33:17'),
(20, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Mac OS X', '2018-01-25 08:41:59'),
(21, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.69.18', 'Chrome 63.0.3239.111', 'Mozilla/5.0 (Linux; Android 7.0; SM-N920T Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.111 Mobile Safari/537.36', 'Android', '2018-01-26 01:05:49'),
(22, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-01-29 02:52:17'),
(23, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.69.115', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-30 04:05:20'),
(24, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-01-30 05:13:05'),
(25, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-01-31 00:28:55'),
(26, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.66.123', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-31 05:07:59'),
(27, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.66.123', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-31 06:52:07'),
(28, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.66.123', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 10', '2018-01-31 11:28:38'),
(29, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-02-01 00:10:39'),
(30, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-02-01 03:37:10'),
(31, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.65.190', 'Chrome 64.0.3282.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', 'Windows 10', '2018-02-07 03:25:59'),
(32, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.65.190', 'Chrome 64.0.3282.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', 'Windows 10', '2018-02-07 03:27:34'),
(33, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-02-07 05:54:50'),
(34, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Windows 7', '2018-02-08 00:31:50'),
(35, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 63.0.3239.132', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', 'Mac OS X', '2018-02-09 01:09:38'),
(36, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.64.15', 'Chrome 64.0.3282.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36', 'Windows 10', '2018-02-10 10:49:51'),
(37, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 64.0.3282.167', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', 'Mac OS X', '2018-02-16 01:05:37'),
(38, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.64.70', 'Chrome 64.0.3282.167', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', 'Windows 10', '2018-02-22 04:33:31'),
(39, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.97.152', 'Chrome 64.0.3282.137', 'Mozilla/5.0 (Linux; Android 6.0.1; SM-J500H Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.137 Mobile Safari/537.36', 'Android', '2018-02-22 08:37:44'),
(40, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 64.0.3282.167', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', 'Mac OS X', '2018-02-22 08:55:23'),
(41, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.76.222.166', 'Chrome 64.0.3282.167', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36', 'Mac OS X', '2018-02-22 21:53:14'),
(42, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.160.66.196', 'Chrome 64.0.3282.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', 'Windows 10', '2018-03-11 13:43:04'),
(43, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.96', 'Chrome 64.0.3282.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', 'Windows 10', '2018-03-22 07:12:35'),
(44, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.27', 'Firefox 60.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0', 'Windows 10', '2018-04-24 07:00:20'),
(45, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.99', 'Firefox 60.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0', 'Windows 10', '2018-04-27 01:05:15'),
(46, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.53', 'Firefox 60.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0', 'Windows 10', '2018-05-02 05:14:42'),
(47, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '165.144.225.18', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-02 06:12:33'),
(48, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.147.147.46', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-02 11:02:47'),
(49, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.115', 'Firefox 61.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0', 'Windows 10', '2018-05-06 13:00:39'),
(50, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.4.75', 'Firefox 61.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0', 'Windows 10', '2018-05-07 03:08:27'),
(51, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.4.75', 'Firefox 61.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0', 'Windows 10', '2018-05-07 03:58:58'),
(52, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.30', 'Internet Explorer 11.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko', 'Windows 10', '2018-05-07 04:00:32'),
(53, 11, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Ephron Maralack\"}', '197.229.2.27', 'Internet Explorer 11.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko', 'Windows 10', '2018-05-07 04:18:25'),
(54, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.27', 'Internet Explorer 11.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko', 'Windows 10', '2018-05-07 04:30:55'),
(55, 11, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Ephron Maralack\"}', '197.229.2.27', 'Internet Explorer 11.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko', 'Windows 10', '2018-05-07 04:31:51'),
(56, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.27', 'Internet Explorer 11.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko', 'Windows 10', '2018-05-07 04:32:37'),
(57, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.5.78', 'Firefox 61.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0', 'Windows 10', '2018-05-08 07:27:22'),
(58, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.20', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-08 07:27:42'),
(59, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.4.76', 'Chrome 67.0.3396.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.40 Safari/537.36', 'Windows 10', '2018-05-10 03:16:13'),
(60, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '105.12.5.241', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-10 05:49:39'),
(61, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '119.158.56.223', 'Chrome 67.0.3396.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.40 Safari/537.36', 'Windows 10', '2018-05-12 08:40:05'),
(62, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.26', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-16 06:12:59'),
(63, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.170.151', 'Chrome 67.0.3396.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.40 Safari/537.36', 'Windows 10', '2018-05-16 08:25:37'),
(64, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.31', 'Chrome 66.0.3359.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Mac OS X', '2018-05-17 03:16:50'),
(65, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.91.161', 'Chrome 67.0.3396.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.48 Safari/537.36', 'Windows 10', '2018-05-22 00:08:48'),
(66, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '124.29.217.76', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Windows 7', '2018-05-22 00:10:47'),
(67, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.30', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Mac OS X', '2018-05-23 21:57:17'),
(68, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '139.190.34.2', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Windows 10', '2018-06-04 09:27:35'),
(69, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.45.195', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Windows 10', '2018-06-04 14:22:01'),
(70, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.45.195', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Windows 10', '2018-06-04 14:22:01'),
(71, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.55.188.78', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Windows 10', '2018-06-05 00:04:19'),
(72, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '175.110.70.227', 'Chrome 67.0.3396.62', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36', 'Windows 10', '2018-06-05 04:38:09'),
(73, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '105.12.2.159', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Mac OS X', '2018-06-05 07:06:35'),
(74, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.39.244', 'Chrome 68.0.3440.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.33 Safari/537.36', 'Windows 10', '2018-06-21 12:31:04'),
(75, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.46.166.72', 'Chrome 68.0.3440.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.33 Safari/537.36', 'Windows 10', '2018-06-25 13:53:44'),
(76, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '105.0.6.129', 'Chrome 66.0.3359.181', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Mac OS X', '2018-06-26 01:50:46'),
(77, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '27.255.26.158', 'Chrome 68.0.3440.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.33 Safari/537.36', 'Windows 10', '2018-06-26 06:42:35'),
(78, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.99.22.25', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Mac OS X', '2018-07-09 06:20:52'),
(79, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.99.22.25', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Mac OS X', '2018-07-09 10:45:07'),
(80, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.99.90.173', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Mac OS X', '2018-07-10 08:55:06'),
(81, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '182.179.139.214', 'Chrome 68.0.3440.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.42 Safari/537.36', 'Windows 10', '2018-07-12 06:28:10'),
(82, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.99.79.64', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Mac OS X', '2018-07-13 02:47:19'),
(83, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '27.255.26.158', 'Chrome 68.0.3440.59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.59 Safari/537.36', 'Windows 10', '2018-07-15 08:56:30'),
(84, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.55.201.119', 'Chrome 68.0.3440.59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.59 Safari/537.36', 'Windows 10', '2018-07-16 03:38:56'),
(85, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.255.4.32', 'Chrome 68.0.3440.59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.59 Safari/537.36', 'Windows 10', '2018-07-19 06:29:36'),
(86, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '82.196.2.172', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-19 07:59:19'),
(87, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '82.196.2.172', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-19 10:32:48'),
(88, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.55.238.216', 'Chrome 68.0.3440.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.68 Safari/537.36', 'Windows 10', '2018-07-20 04:26:41'),
(89, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '146.185.157.250', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-20 04:39:16'),
(90, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '175.110.68.51', 'Chrome 68.0.3440.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.68 Safari/537.36', 'Windows 10', '2018-07-20 22:34:03'),
(91, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '175.110.68.51', 'Chrome 68.0.3440.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.68 Safari/537.36', 'Windows 10', '2018-07-20 22:34:03'),
(92, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.91', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Mac OS X', '2018-07-21 03:41:57'),
(93, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.84', 'Chrome 68.0.3440.84', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', 'Mac OS X', '2018-08-11 03:05:29'),
(94, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.185', 'Chrome 68.0.3440.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'Mac OS X', '2018-08-14 04:45:02'),
(95, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.130', 'Chrome 68.0.3440.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'Mac OS X', '2018-09-03 02:56:32'),
(96, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '182.185.220.139', 'Chrome 70.0.3538.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.16 Safari/537.36', 'Windows 10', '2018-09-22 12:19:28'),
(97, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '192.140.150.215', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Windows 10', '2018-09-28 04:01:33'),
(98, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.134', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-16 10:01:20'),
(99, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '182.179.171.243', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Windows 10', '2018-10-16 11:00:31'),
(100, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '42.201.170.239', 'Chrome 70.0.3538.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.54 Safari/537.36', 'Windows 10', '2018-10-16 11:25:12'),
(101, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.116', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-21 08:04:38'),
(102, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.153', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-23 13:38:46'),
(103, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.138', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-25 01:40:52'),
(104, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.145', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-25 06:25:36'),
(105, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '103.217.177.20', 'Chrome 70.0.3538.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36', 'Windows 10', '2018-10-25 06:29:06'),
(106, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.250', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-25 10:14:32'),
(107, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.156', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-25 13:19:08'),
(108, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '42.201.170.239', 'Chrome 71.0.3578.20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.20 Safari/537.36', 'Windows 10', '2018-10-28 13:52:03'),
(109, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.48', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-29 12:41:29'),
(110, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.59', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-31 04:56:37'),
(111, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.63', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-31 10:05:07'),
(112, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.63', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-31 13:18:19'),
(113, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.55', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-10-31 23:43:02'),
(114, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.92', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-11-01 06:14:56'),
(115, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.92', 'Chrome 69.0.3497.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'Mac OS X', '2018-11-01 08:39:10'),
(116, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.92', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-02 13:05:06'),
(117, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.38', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-07 02:15:09'),
(118, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.38', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-07 05:50:19'),
(119, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.27', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-09 14:19:14'),
(120, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.124', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-10 00:33:19'),
(121, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.172', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-11 02:08:29'),
(122, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.172', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-11 09:02:35'),
(123, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.172', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-11 21:07:36'),
(124, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.180', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-12 02:46:30'),
(125, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.212', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-12 07:42:55'),
(126, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.162', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-12 13:12:36'),
(127, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.212', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-12 20:26:21'),
(128, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.175', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-13 01:08:06'),
(129, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.193', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-13 04:30:32'),
(130, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.175', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-13 07:09:47'),
(131, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.220', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-13 09:36:55'),
(132, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.210', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-13 19:40:56'),
(133, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.214', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-14 03:58:04'),
(134, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.169', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-14 06:37:36'),
(135, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.210', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-14 12:39:44'),
(136, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.212', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-14 20:37:41'),
(137, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.179', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-15 00:45:36'),
(138, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.222', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-15 04:45:48'),
(139, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.180', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-15 10:14:41'),
(140, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.189', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-15 17:09:23'),
(141, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.216', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-15 20:59:07'),
(142, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.201', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-16 02:31:04'),
(143, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.201', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-16 06:04:40'),
(144, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.3.169', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-16 09:54:19'),
(145, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.141', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-17 00:04:28'),
(146, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.27', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-18 11:49:13'),
(147, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.211', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-19 20:38:48'),
(148, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.114.195.43', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Mac OS X', '2018-11-20 01:32:04'),
(149, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.168', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-20 12:08:43'),
(150, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.197', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-21 01:42:37'),
(151, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.221', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-21 06:37:47'),
(152, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.193', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-23 06:15:46'),
(153, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.161', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-23 22:47:23'),
(154, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.202', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-25 07:54:14'),
(155, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.202', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-26 04:01:52'),
(156, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.186', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-26 09:29:58'),
(157, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.190', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Mac OS X', '2018-11-27 02:45:44'),
(158, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.161', 'Chrome 70.0.3538.110', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', 'Mac OS X', '2018-11-28 01:11:17'),
(159, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.211', 'Chrome 70.0.3538.110', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', 'Mac OS X', '2018-12-07 22:45:07'),
(160, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.138', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-24 01:03:01'),
(161, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.79.193.95', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-24 06:21:39'),
(162, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.79.193.95', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-24 11:49:00'),
(163, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.79.193.95', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-24 18:23:22'),
(164, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.119', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-26 09:51:32'),
(165, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.114', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2018-12-27 09:36:48'),
(166, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.108', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-05 09:50:57'),
(167, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.2.1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-12 13:00:41'),
(168, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.10', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-17 08:22:09'),
(169, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.0.110', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-18 06:08:41');
INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(170, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.49', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-25 10:11:25'),
(171, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.56', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-26 05:56:02'),
(172, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '197.229.1.160', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Mac OS X', '2019-01-28 02:29:18'),
(173, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.37.139.181', 'Chrome 79.0.3945.88', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'Linux', '2020-08-19 18:34:31'),
(174, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '41.193.49.71', 'Chrome 84.0.4147.105', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 'Mac OS X', '2020-08-19 18:38:23'),
(175, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.37.139.181', 'Chrome 79.0.3945.88', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'Linux', '2020-08-19 18:41:09'),
(176, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.37.139.181', 'Chrome 79.0.3945.88', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'Linux', '2020-08-19 18:41:18'),
(177, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '39.37.139.181', 'Chrome 79.0.3945.88', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 'Linux', '2020-08-19 18:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_landingpage`
--

CREATE TABLE `tbl_member_landingpage` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_ibm` varchar(70) NOT NULL,
  `page_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member_landingpage`
--

INSERT INTO `tbl_member_landingpage` (`id`, `member_id`, `member_ibm`, `page_id`, `created_at`, `updated_at`) VALUES
(27, 134, 'IBM10', 3, '2018-09-23 14:45:25', '2018-09-23 08:45:25'),
(26, 133, 'IBM9', 3, '2018-08-18 12:45:26', '2018-08-18 13:10:47'),
(25, 132, 'IBM8', 3, '2018-08-16 11:31:37', '2018-08-16 06:31:37'),
(24, 131, 'IBM7', 3, '2018-08-14 17:11:18', '2018-08-14 12:11:18'),
(23, 130, 'IBM6', 3, '2018-08-14 17:05:46', '2018-08-14 12:05:46'),
(22, 129, 'IBM5', 3, '2018-08-14 16:59:16', '2018-08-14 11:59:16'),
(21, 128, 'IBM4', 3, '2018-08-14 16:55:34', '2018-08-14 11:55:34'),
(20, 127, 'IBM3', 3, '2018-08-14 16:53:03', '2018-08-14 11:53:03'),
(19, 126, 'IBM2', 3, '2018-08-14 16:50:59', '2018-08-14 11:50:59'),
(18, 1, 'IBM1', 3, '2018-08-14 16:49:42', '2020-08-13 07:07:17'),
(28, 135, 'IBM11', 3, '2018-09-24 15:32:39', '2018-09-24 09:32:39'),
(29, 136, 'IBM12', 3, '2018-09-24 15:34:16', '2018-09-24 09:34:16'),
(30, 137, 'IBM13', 3, '2018-09-24 15:50:48', '2018-09-24 09:50:48'),
(31, 138, 'IBM14', 3, '2018-10-03 08:06:44', '2018-10-03 02:06:44'),
(32, 139, 'IBM15', 3, '2018-10-03 08:08:56', '2018-10-03 02:08:56'),
(33, 140, 'IBM16', 3, '2018-10-03 08:12:44', '2018-10-03 02:12:44'),
(34, 141, 'IBM2', 3, '2018-10-16 11:19:58', '2018-10-16 05:19:58'),
(35, 142, 'IBM3', 3, '2018-10-16 11:35:21', '2018-10-16 05:35:21'),
(36, 143, 'IBM4', 3, '2018-10-16 11:38:26', '2018-10-16 05:38:26'),
(37, 144, 'IBM5', 3, '2018-10-16 12:21:55', '2018-10-16 06:21:55'),
(38, 145, 'IBM6', 3, '2018-10-16 12:43:14', '2018-10-16 06:43:14'),
(39, 146, 'IBM7', 3, '2018-10-16 18:17:37', '2020-03-25 08:41:09'),
(40, 147, 'IBM8', 3, '2018-10-16 20:27:21', '2018-10-16 14:27:21'),
(41, 148, 'IBM9', 3, '2018-10-17 07:10:51', '2018-10-17 01:10:51'),
(42, 149, 'IBM8', 3, '2018-10-24 15:53:22', '2018-10-24 09:53:22'),
(43, 150, 'IBM9', 3, '2018-10-27 12:01:00', '2018-10-27 06:01:00'),
(44, 151, 'IBM10', 3, '2018-10-27 18:04:57', '2018-10-27 12:04:57'),
(45, 152, 'IBM11', 3, '2018-10-29 03:28:06', '2018-10-28 21:28:06'),
(46, 153, 'IBM12', 3, '2018-10-29 14:49:22', '2018-11-05 18:25:54'),
(47, 154, 'IBM13', 3, '2018-10-29 15:28:55', '2018-11-01 13:15:03'),
(48, 155, 'IBM14', 3, '2018-10-29 17:10:53', '2018-10-29 11:10:53'),
(49, 156, 'IBM15', 3, '2018-10-29 18:27:26', '2018-10-29 12:27:26'),
(50, 157, 'IBM16', 3, '2018-10-30 07:09:12', '2018-10-30 07:44:54'),
(51, 158, 'IBM17', 3, '2018-10-30 08:32:52', '2018-10-30 02:32:52'),
(52, 159, 'IBM18', 3, '2018-10-30 09:41:34', '2018-10-30 03:41:34'),
(53, 160, 'IBM19', 3, '2018-10-31 07:30:47', '2018-10-31 01:30:47'),
(54, 161, 'IBM20', 3, '2018-11-05 16:00:01', '2018-11-05 09:00:01'),
(55, 162, 'IBM20', 3, '2018-11-05 17:05:08', '2018-11-05 10:05:08'),
(56, 163, 'IBM20', 3, '2018-11-05 17:51:30', '2018-11-05 10:51:30'),
(57, 164, 'IBM21', 3, '2018-11-05 18:17:42', '2018-11-05 11:17:42'),
(58, 165, 'IBM22', 3, '2018-11-05 18:23:23', '2018-11-05 11:23:23'),
(59, 166, 'IBM23', 3, '2018-11-05 18:27:51', '2018-11-05 11:27:51'),
(60, 167, 'IBM20', 3, '2018-11-05 18:50:44', '2018-11-05 11:50:44'),
(61, 168, 'IBM21', 3, '2018-11-05 19:59:23', '2018-11-05 12:59:23'),
(62, 169, 'IBM22', 3, '2018-11-05 20:54:19', '2018-11-05 13:54:19'),
(63, 170, 'IBM23', 3, '2018-11-06 05:09:14', '2018-11-05 22:09:14'),
(64, 171, 'IBM24', 3, '2018-11-06 06:33:16', '2018-11-05 23:33:16'),
(65, 172, 'IBM25', 3, '2018-11-06 08:16:27', '2018-11-06 01:16:27'),
(66, 173, 'IBM26', 3, '2018-11-06 08:37:52', '2018-11-06 01:37:52'),
(67, 174, 'IBM27', 3, '2018-11-06 11:25:14', '2018-11-06 04:25:14'),
(68, 175, 'IBM28', 3, '2018-11-06 14:55:00', '2018-11-06 07:55:00'),
(69, 176, 'IBM29', 3, '2018-11-06 17:14:42', '2018-11-06 10:14:42'),
(70, 177, 'IBM30', 3, '2018-11-06 17:34:13', '2018-11-06 10:34:13'),
(71, 178, 'IBM31', 3, '2018-11-06 22:08:49', '2018-11-21 12:35:17'),
(72, 179, 'IBM32', 3, '2018-11-07 10:12:28', '2018-11-07 03:12:28'),
(73, 180, 'IBM33', 3, '2018-11-07 15:48:39', '2018-11-07 08:48:39'),
(74, 181, 'IBM34', 3, '2018-11-07 16:44:09', '2018-11-08 10:11:38'),
(75, 182, 'IBM35', 3, '2018-11-07 17:47:42', '2018-11-07 10:47:42'),
(76, 183, 'IBM36', 3, '2018-11-07 21:14:19', '2018-11-07 21:20:32'),
(77, 184, 'IBM37', 3, '2018-11-08 07:12:47', '2018-11-08 00:12:47'),
(78, 185, 'IBM38', 3, '2018-11-08 13:16:21', '2018-11-08 06:16:21'),
(79, 186, 'IBM39', 3, '2018-11-08 16:15:18', '2018-11-08 09:15:18'),
(80, 187, 'IBM40', 3, '2018-11-08 20:04:59', '2018-11-08 13:04:59'),
(81, 188, 'IBM41', 3, '2018-11-08 21:49:38', '2018-11-08 14:49:38'),
(82, 189, 'IBM42', 3, '2018-11-09 08:12:50', '2018-11-09 01:12:50'),
(83, 190, 'IBM43', 3, '2018-11-09 10:52:26', '2018-11-09 03:52:26'),
(84, 191, 'IBM44', 3, '2018-11-09 12:05:54', '2018-11-09 05:05:54'),
(85, 192, 'IBM45', 3, '2018-11-09 13:46:59', '2018-11-09 06:46:59'),
(86, 193, 'IBM46', 3, '2018-11-09 14:41:46', '2018-11-09 07:41:46'),
(87, 194, 'IBM47', 3, '2018-11-09 20:05:34', '2018-11-09 13:05:34'),
(88, 195, 'IBM48', 3, '2018-11-09 21:40:37', '2018-11-09 14:40:37'),
(89, 196, 'IBM49', 3, '2018-11-10 13:12:57', '2018-11-10 06:12:57'),
(90, 197, 'IBM50', 3, '2018-11-11 18:43:06', '2018-11-11 11:43:06'),
(91, 198, 'IBM51', 3, '2018-11-12 13:27:59', '2018-11-12 06:27:59'),
(92, 199, 'IBM52', 3, '2018-11-12 18:27:01', '2018-11-12 11:27:01'),
(93, 200, 'IBM53', 3, '2018-11-12 18:28:28', '2018-11-12 11:28:28'),
(94, 201, 'IBM54', 3, '2018-11-12 19:13:06', '2018-11-12 12:13:06'),
(95, 202, 'IBM55', 3, '2018-11-12 19:19:27', '2018-11-12 12:19:27'),
(96, 203, 'IBM56', 3, '2018-11-12 20:10:26', '2018-11-12 13:10:26'),
(97, 204, 'IBM57', 3, '2018-11-12 20:40:53', '2018-11-12 13:40:53'),
(98, 205, 'IBM58', 3, '2018-11-13 07:39:25', '2018-11-13 00:39:25'),
(99, 206, 'IBM59', 3, '2018-11-13 10:43:36', '2018-11-13 03:43:36'),
(100, 207, 'IBM60', 3, '2018-11-13 17:40:12', '2018-11-13 10:40:12'),
(101, 208, 'IBM61', 3, '2018-11-13 17:58:28', '2018-11-13 10:58:28'),
(102, 209, 'IBM62', 3, '2018-11-13 18:44:45', '2018-11-13 11:44:45'),
(103, 210, 'IBM63', 3, '2018-11-14 07:56:07', '2018-11-14 00:56:07'),
(104, 211, 'IBM64', 3, '2018-11-14 08:57:09', '2018-11-14 01:57:09'),
(105, 212, 'IBM65', 3, '2018-11-14 12:15:19', '2018-11-14 05:15:19'),
(106, 213, 'IBM66', 3, '2018-11-14 15:03:57', '2018-11-14 08:03:57'),
(107, 214, 'IBM67', 3, '2018-11-15 19:10:34', '2018-11-15 12:10:34'),
(108, 215, 'IBM68', 3, '2018-11-16 09:12:17', '2018-11-16 02:12:17'),
(109, 216, 'IBM69', 3, '2018-11-17 08:50:27', '2018-11-17 01:50:27'),
(110, 217, 'IBM70', 3, '2018-11-18 10:19:28', '2018-11-18 03:19:28'),
(111, 218, 'IBM71', 3, '2018-11-18 21:20:55', '2018-11-18 14:20:55'),
(112, 219, 'IBM72', 3, '2018-11-20 20:23:22', '2018-11-20 13:23:22'),
(113, 220, 'IBM73', 3, '2018-11-21 16:19:53', '2018-11-21 09:19:53'),
(114, 221, 'IBM74', 3, '2018-11-22 10:51:48', '2018-11-22 03:51:48'),
(115, 222, 'IBM75', 3, '2018-11-24 09:39:24', '2018-11-24 02:39:24'),
(116, 223, 'IBM76', 3, '2018-11-28 19:43:28', '2018-11-28 12:43:28'),
(117, 224, 'IBM77', 3, '2018-12-19 15:18:31', '2019-10-14 09:07:50'),
(118, 225, 'IBM78', 3, '2019-05-27 07:26:49', '2019-05-27 02:26:49'),
(119, 226, 'IBM79', 3, '2020-03-25 15:20:10', '2020-03-25 09:20:10'),
(120, 227, 'IBM80', 3, '2020-03-25 16:33:31', '2020-03-25 10:33:31'),
(121, 228, 'IBM80', 3, '2020-06-21 16:35:24', '2020-06-21 16:35:24'),
(122, 229, 'IBM80', 3, '2020-06-21 18:56:49', '2020-06-21 18:56:49'),
(123, 230, 'IBM2', 3, '2020-07-01 19:33:08', '2020-07-01 19:33:08'),
(124, 231, 'IBM3', 3, '2020-07-04 10:38:52', '2020-07-04 10:38:52'),
(125, 232, 'IBM3', 3, '2020-07-04 12:41:12', '2020-07-04 12:41:12'),
(126, 233, 'IBM3', 3, '2020-07-04 13:03:29', '2020-07-04 13:03:29'),
(127, 234, 'IBM4', 3, '2020-07-11 15:23:08', '2020-07-11 15:23:08'),
(128, 235, 'IBM5', 3, '2020-07-11 16:08:38', '2020-07-11 16:08:38'),
(129, 236, 'IBM6', 3, '2020-08-09 13:49:12', '2020-08-09 13:49:12'),
(130, 237, 'IBM7', 3, '2020-08-14 02:14:59', '2020-08-14 02:14:59'),
(131, 238, 'IBM8', 3, '2020-08-14 02:16:01', '2020-08-14 02:16:01'),
(132, 239, 'IBM9', 3, '2020-08-14 02:32:58', '2020-08-14 02:32:58'),
(133, 240, 'IBM10', 3, '2020-08-17 05:55:05', '2020-08-17 05:55:05'),
(134, 241, 'IBM11', 3, '2020-08-17 06:42:34', '2020-08-17 06:42:34'),
(135, 242, 'IBM12', 3, '2020-08-17 07:02:50', '2020-08-17 07:02:50'),
(136, 243, 'IBM13', 3, '2020-08-17 09:07:34', '2020-08-17 09:07:34'),
(137, 244, 'IBM14', 3, '2020-08-17 09:40:54', '2020-08-17 09:40:54'),
(138, 245, 'IBM15', 3, '2020-08-17 13:00:12', '2020-08-17 13:00:12'),
(139, 246, 'IBM16', 3, '2020-08-17 13:04:43', '2020-08-17 13:04:43'),
(140, 247, 'IBM17', 3, '2020-08-18 15:53:33', '2020-08-18 15:53:33'),
(141, 248, 'IBM18', 3, '2020-08-18 16:15:59', '2020-08-18 16:15:59'),
(142, 249, 'IBM19', 3, '2020-08-18 16:28:19', '2020-08-18 16:28:19'),
(143, 250, 'IBM20', 3, '2020-08-19 05:30:42', '2020-08-19 05:30:42'),
(144, 251, 'IBM21', 3, '2020-08-19 05:36:33', '2020-08-19 05:36:33'),
(145, 252, 'IBM21', 3, '2020-08-21 10:08:46', '2020-08-21 10:08:46'),
(146, 253, 'IBM22', 3, '2020-08-21 10:27:46', '2020-08-21 10:27:46'),
(147, 254, 'IBM22', 3, '2020-08-21 10:49:27', '2020-08-21 10:49:27'),
(148, 255, 'IBM23', 3, '2020-08-21 11:46:34', '2020-08-21 11:46:34'),
(149, 256, 'IBM24', 3, '2020-08-21 12:16:17', '2020-08-21 12:16:17'),
(150, 257, 'IBM24', 3, '2020-08-21 12:29:04', '2020-08-21 12:29:04'),
(151, 258, 'IBM24', 3, '2020-08-21 12:42:12', '2020-08-21 12:42:12'),
(152, 259, 'IBM25', 3, '2020-08-21 14:32:48', '2020-08-21 14:32:48'),
(153, 260, 'IBM25', 3, '2020-08-21 14:39:10', '2020-08-21 14:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_content` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `page_name`, `page_content`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'faq', '<b><font size=\"2\">Q:1 What is TheViralMarketer System?</font></b><div><div><font size=\"2\"><b>Answer:</b> TheViralMarketer is a tool that can be used by any Networker/MlM\'er to build an email list for any MLM business that they are promoting. You can access TheViralMarketer from the web or download it from the Google Playstore or IOS store.&nbsp;</font></div><div><b><font size=\"2\">Q:2 Is this a pyramid scheme?</font></b></div><div><font size=\"2\"><b>Answer:</b>&nbsp; The perception of pyramid schemes are so easily connected to the MLM/Network marketing industry because it requires the recruitment of people to build an organisation. Hence it remains important to understand and explain the MLM concept to Anti-MLM\'ers as almost all of them have no clue of how the MLM concept is suppose to function and what a pyramid scheme is. Hence, let\'s do that here.</font></div><div><font size=\"2\">&nbsp;&nbsp;<span style=\"color: var(--ytd-comment-text-color); white-space: pre-wrap; background-color: transparent; font-family: Roboto, Arial, sans-serif;\">There is a lot of anti MLM people leaving comments here and unfortunately most of them is very emotional with lack of understanding of what the business model is all about. For any MLM there must be a product and not an over priced product. In a regular business; let\'s say you go to a retail store, you buy a product and all. the profit will be rightfully earned by the shop owner. Then profit of cause is the cost of product minus selling price. In MLM/Network marketing the profit generated from selling the product is distributed amongst several people in some form of a compensation plan. So instead of just the shop owner earning alll of the profit, MLM allows more people to earn from the profit generated by selling the product. However many MLM\'s place too much weight on the sign-up fee. This makes it wrong. There can be a sign-up fee, but it cannot be driving force to earn in a MLM company. The driving force must be the profits generated from selling of products. And YES, the more people in your network will ultimately result in more money to be made. Yes, and those that starts FIRST will earn FIRST than those that start later provided that both make a consistent effort. Those that start later will just earn in a later timeframe as long as effort remains consistent. </span></font></div><ytd-comment-thread-renderer class=\"style-scope ytd-item-section-renderer\" style=\"display: block; margin-bottom: var(--ytd-comment-thread-margin-bottom, 16px); color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif;\"><ytd-comment-renderer id=\"comment\" class=\"style-scope ytd-comment-thread-renderer\" comment-style=\"unknown\" style=\"--ytd-pinned-comment-badge-margin-left:-2px; display: block; margin-bottom: 0px;\"><div id=\"body\" class=\"style-scope ytd-comment-renderer\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; display: flex; flex-direction: row;\"><div id=\"main\" class=\"style-scope ytd-comment-renderer\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; min-width: 0px; flex: 1 1 1e-09px; display: flex; flex-direction: column;\"><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><div id=\"content\" class=\"style-scope ytd-expander\" style=\"word-wrap: break-word; min-width: 0px; margin: 0px; padding: 0px; border: 0px; background: transparent;\"><yt-formatted-string id=\"content-text\" slot=\"content\" split-lines=\"\" class=\"style-scope ytd-comment-renderer\" style=\"white-space: pre-wrap; --yt-endpoint-visited-color:var(--yt-spec-icon-active-button-link); color: var(--ytd-comment-text-color); line-height: 2rem;\"><font size=\"2\">Please note: In all types of industries, let\'s name a few: Banking, Real Estate, MLM, etc... you will find con artist that gives the industry a bad name, however you cannot condemn the concept in it\'s totality. The same thing happened in MLM...that doesn\'t make the concept bad. You just need to discern between the good and the bad. Watch out for high sign up fees. That should be your first RED light. Next is to look out for the price of products and make sure that it is not over priced. There are good companies out there and I fully agree with Dave that you need to learn the tricks of the trade.\r\nIn conclusion: Statistically MLM is on top of the list as it still creates the most wealthy people world wide. No other industry can do this cause when they sell the products, they keep all the profit whereas MLM distributes the profit amongst several people in a compensation plan...?</font></yt-formatted-string></div><div id=\"content\" class=\"style-scope ytd-expander\" style=\"word-wrap: break-word; min-width: 0px; margin: 0px; padding: 0px; border: 0px; background: transparent;\"><yt-formatted-string slot=\"content\" split-lines=\"\" class=\"style-scope ytd-comment-renderer\" style=\"white-space: pre-wrap; --yt-endpoint-visited-color:var(--yt-spec-icon-active-button-link); color: var(--ytd-comment-text-color); line-height: 2rem;\"><font size=\"2\"><br></font></yt-formatted-string></div></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\" style=\"\"><b>Q3: How to transfer bitcoin to TheViralMarketer bitcoin wallet.&nbsp;</b></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\" style=\"\"><b>Answer:&nbsp;</b></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">Step 1:</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">If you\'ve never had a bitcoin wallet, we suggest that you open a Luno bitcoin wallet. Go to www.luno.com click on Sign Up. The process is very simple.&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">Just follow the process from page to page and read carefully.&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><img src=\"https://i.imgur.com/31vut24.png\" width=\"411\"><br></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><br></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">Step 2:&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">After Sign Up is complete, login to your Luno account and click on HOME</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/yzqle1o.png\" width=\"233\"></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">Click on BUY</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><br></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/I6dwZxp.png\" width=\"354\"></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><br class=\"Apple-interchange-newline\">This will allow you to transfer money from your local bank account to your Luno wallet. If you\'re not yet verified with Luno, they will perform a verification process on your&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">account before you can transfer.&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><br></font></span></paper-button></ytd-expander></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Click on DEPOSIT MONEY</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/rglkv0f.png\" width=\"298\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Deposit an amount equivalent to 7usd. This will cover all transactional cost for Transfer and Upgrade.</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Click on NEXT</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/ijt1zrL.png\" width=\"317\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">The bank account details of Luno will know appear. Please read the instructions on this screen carefully in order to make a successful deposit.&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"text-align: center; display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/F1dXkxw.png\" width=\"523\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">You click DONE either before or after making the deposit. Make sure the reference number is used in the recipient reference field.&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/lGEIl9P.png\" width=\"486\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">This note confirms that you have followed the steps correctly. Remember to pay the deposit from your local bank account.&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/OtBivx5.png\" width=\"459\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">The Money will now reflect in your wallet in your local currency. In order to convert it from local currency to bitcoin, click on \"WALLETS\" in left panel of Luno&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">and you will arrive at the following screen.</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/hTUUaZn.png\" width=\"955\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Now click on \"BUY\" and the following screen will provide you with an option to convert your local currency balance to bitcoin.</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Step 3:&nbsp;<br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">In this step we will show you how to transfer bitcoins from Luno to TheViralMarketer wallet.</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">After you have logged in to theviralmarketer.biz click on TRANSACTIONS</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/qbGq4vu.png\" width=\"228\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Click on REQUEST</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/vcQ6pqT.png\" width=\"235\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Copy your bitcoin wallet address by clicking on CLICK HERE TO COPY</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/G5vhUE6.png\" width=\"595\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Go to Luno and click on SEND</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/JObF5pT.png\" width=\"353\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Paste the bitcoin wallet address of TheViralMarketer Wallet in the SEND BITCOIN TO field. Click on the BTC amount in the AVAILABLE field to complete the&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">amount you want to transfer. Remember to transfer the minimum amount of 7 dollars. Click Next and CONFIRM your transfer.&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\">Next is to login into TheViralMarketer member\'s area and your bitcoins will reflect in top right corner.&nbsp;</span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><img src=\"https://i.imgur.com/AG5BOEa.png\" width=\"509\"><br></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"--paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\"><br></font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><paper-button aria-expanded=\"true\" noink=\"\" class=\"style-scope ytd-expander\" role=\"button\" tabindex=\"0\" animated=\"\" aria-disabled=\"false\" elevation=\"0\" style=\"font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; --paper-material-elevation-5_-_box-shadow:0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4); display: inline-block; align-items: center; justify-content: center; position: relative; min-width: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; -webkit-tap-highlight-color: transparent; outline-width: 0px; border-radius: 3px; user-select: none; z-index: 0; padding: 0px; -webkit-font-smoothing: antialiased; background-color: var(--paper-button_-_background-color); border: var(--paper-button_-_border); color: var(--paper-button_-_color); width: var(--paper-button_-_width); margin-top: 0px; margin-right: var(--ytd-expander-button-margin-right, auto); margin-bottom: 0px; margin-left: 0px; text-transform: var(--paper-button_-_text-transform, uppercase); overflow-wrap: break-word; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s; text-align: center;\"><span class=\"less-button style-scope ytd-comment-renderer\" slot=\"less-button\" style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; text-transform: none; color: var(--ytd-comment-text-color); line-height: 1.6rem;\"><font size=\"2\">Step 4:&nbsp;</font></span></paper-button></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Now that the bitcoin is transferred to your wallet, the next important step is to upgrade. Login to TheViralMarketer member\'s area and click on PROFILE which you will find by clicking on the drop down arrow next to your name.</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/n2xZNRK.png\" width=\"207\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">In order to transfer bitcoin from your wallet or to do UPGRADES, you need to have a TRANSACTION password. The importance of this password is to ensure that your bitcoins remains protected in your wallet. You can register for a transactional password by clicking REGISTER/RESET TRANSACTION PASSWORD. Once you click this link, our system will forward you an email with a default password. Copy and PASTE this password and enter it into the OLD TRANSACTION PASSWORD. Make sure not to copy any spaces before or at the back of the password.&nbsp;</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Now create a new password in the NEW TRANSACTION PASSWORD field of with only 8 characters. Nothing more, nothing less. Click on CHANGE TRANSACTION PASSWORD. Remember to save your new password in a save place. Whenever you need to reset your TRANSACTION password. You can just repeat this procedure.&nbsp;</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/PiVh9XI.png\" width=\"469\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Next is to click on UPGRADE</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/AidTJMt.jpg\" width=\"226\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Click on PAY NOW</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/13weJQB.png\" width=\"209\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Complete the missing characters of your TRANSACTION password and click SUBMIT.</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/FrTnttw.png\" width=\"578\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">All that is left to do is to tick the box next to the Terms and Conditions and click PAY NOW and you\'re UPGRADED.&nbsp;</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/pu4oiMp.png\" width=\"589\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Note that you will never have to transfer money again from Luno in order to upgrade. All future upgrades will paid from your profit and not out of your pocket. Every member needs to upgrade 8 times. All payments received from downline members will be a profit to you.&nbsp;</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><b>Q:4</b></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><b>Where can I find my Referral Link?</b></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><b><br></b></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Step 1:</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Click on REFERRAL LINK</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/a7sxS1o.png\" width=\"227\"><b><br></b></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><b><br></b></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Step 2:&nbsp;<br><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\">Your referral link will display as below. Click on the small icon in red to copy the link on your clipboard. For members doing Whatsapp Marketing, you need to copy this link exactly as it is and paste it in WAM2 at the bottom.&nbsp;</ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><img src=\"https://i.imgur.com/x8g8DNB.png\" width=\"370\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander><ytd-expander id=\"expander\" class=\"style-scope ytd-comment-renderer\" style=\"display: block; --ytd-expander-collapsed-height:80px;\"><br></ytd-expander></div></div></ytd-comment-renderer></ytd-comment-thread-renderer></div>', 1, '2018-02-22 11:37:44', '2018-11-17 07:10:39');
INSERT INTO `tbl_pages` (`id`, `page_name`, `page_content`, `added_by`, `created_at`, `updated_at`) VALUES
(2, 'terms-conditions', '<style type=\"text/css\">\r\n	<!--\r\n		@page { margin: 2cm }\r\n		P { margin-bottom: 0.21cm }\r\n	-->\r\n	</style>\r\n\r\n\r\n<p class=\"western\" style=\"margin-bottom: 0cm;\"><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>TERMS\r\nAND CONDITIONS OF IBM AGREEMENT</b></font></font></font></p><p class=\"western\" style=\"margin-bottom: 0cm;\"><font style=\"font-size: 11pt\"><font color=\"#56565a\" face=\"ITCFranklinGothicW01-Bk\"><b><br></b></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">1.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>ACCEPTANCE:</b></font></font></font><font color=\"#56565a\"><font style=\"font-size: 11pt\">&nbsp;By\r\nclicking “Sign -Up” </font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">This\r\ndocument, including the IBM Registration form overleaf, if completed\r\naccurately and in full and signed by the Applicant, if accepted and\r\nconfirmed by TheViralMarketer in terms of this agreement, constitutes\r\nthe IBM agreement between TheViralMarketer and the Applicant whose\r\nsignature and details appear overleaf. However, should this\r\nregistration form be accepted by TheViralMarketer, whether or not\r\ncompleted in full, the terms and conditions as set out in this\r\nagreement, will govern the relationship between TheViralMarketer and\r\nthe Applicant whose details appear in the database after clicking\r\n“Sign-Up”.</font></font></font><font style=\"font-size: 11pt\"><br><br></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">2.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>AGREEMENT:</b></font></font></font><font color=\"#56565a\"><font style=\"font-size: 11pt\">&nbsp;</font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">Upon\r\nacceptance of this registration form, TheViralMarketer appoints the\r\nApplicant, as an Independent Business Owner (hereinafter referred to\r\nindividually and collectively as “IBM”) of TheViralMarketer\r\nproducts and the IBM accepts such appointment on the terms and\r\nconditions herein. The acceptance by TheViralMarketer of this\r\napplication for registration as an IBM is at the sole discretion of\r\nTheViralMarketer.</font></font></font><font style=\"font-size: 11pt\"><br><br></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">2.1&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>THE\r\nIBM CONFIRMS THAT</b></font></font></font><font color=\"#56565a\"><font style=\"font-size: 11pt\">&nbsp;</font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">he/she\r\nis at least 18 years of age and has the legal capacity to enter into\r\nthis agreement and carry out the duties under this agreement.\r\nParental consent is required for any person below the age of 18\r\nyears. </font></font></font><font style=\"font-size: 11pt\"><br><br></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">2.2&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>No\r\nRefunds </b></font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">will\r\nbe processed by TheViralMarketer as a member to member payment system\r\nis in place. </font></font></font><font style=\"font-size: 11pt\"><br><br></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">4.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>RELATIONSHIP\r\nBETWEEN THE PARTIES:</b></font></font></font><font color=\"#56565a\"><font style=\"font-size: 11pt\">&nbsp;</font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">Nothing\r\nin this Agreement shall establish an employment relationship, or\r\nother labour relationship, between the IBM and TheViralMarketer and\r\nnothing shall establish the IBM\'s position as procurer, broker,\r\nmandatory, agent, contracting representative or other representative\r\nof TheViralMarketer. The IBM will be liable for his/her own taxes\r\nfrom income generated through marketing efforts of TheViralMarketer. </font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">\r\n</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">5.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>COMMENCEMENT\r\nAND TERM:</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">This\r\nAgreement shall come into force on the date of acceptance by\r\nTheViralMarketer and the Applicant clicking “Sign Up” which\r\ngenerate an IBM number for the Applicant. </font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">6.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>RENEWAL:</b></font></font></font><font color=\"#56565a\">&nbsp;The\r\nIBM will be regarded as a LIFETIME member for the duration of\r\nTheViralMarketer and no action will be required to renew membership.\r\n</font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">7.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>Membership\r\nCancellation</b></font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>:</b></font></font></font><font color=\"#56565a\">&nbsp;An\r\nIBM may request to be removed from the electronic database of\r\n</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">TheViralMarketer\r\nat any time through their email address as registered within the\r\ndatabase of TheViralMarketer. </font></font></font>\r\n</p>\r\n<p class=\"western\" style=\"margin-bottom: 0cm;\"><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">8.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>MODIFICATION\r\nOF TERMS:</b></font></font></font><font color=\"#56565a\">&nbsp;TheViralMarketer\r\n</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">may\r\nmodify the terms and conditions in this agreement, by providing\r\nnotice of such changes by publication on our website:\r\nwww.theviralmarketer.biz, which the IBM has an obligation to read\r\ncarefully. All modifications shall take effect from the date of\r\npublication or any later date expressed in the notification.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>THE\r\nIBM EXPRESSLY ACCEPTS THAT</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">he/she\r\nwill be bound by modifications to these terms and conditions as\r\nprovided for in this agreement. But for the modification provided for\r\nin this paragraph, any other modification must be done in writing and\r\nsigned by both parties.</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">9.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>CESSION\r\nAND ASSIGNMENT:</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">The\r\nIBM may not assign, cede, delegate, transfer or otherwise make over\r\nthe terms and conditions of this Agreement to any third party without\r\nthe prior written consent of TheViralMarketer.</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">10.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>USE\r\nOF NAME AND LIKENESS: THE IBM AUTHORISES AND CONSENTS</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">to\r\nthe use by TheViralMarketer of the IBM\'s name and likeness in any\r\nmedia produced or authorised by TheViralMarker for any lawful\r\npurpose, including but not limited to: use on the Internet (world\r\nwide web), in photography, in other audio-visual material, and in\r\nTheViralMarketer brochures and advertisements, for marketing and\r\nother purposes. On the other hand, the IBM is not entitled to use the\r\nTheViralMarketer trade name, trademark, service mark, design, symbol,\r\ncopyrighted material or any other asset of TheViralMarketer, other\r\nthan as set forth herein.</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">11.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>USE\r\nAND DISSEMINATION OF INFORMATION:</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">Subject\r\nto mandatory applicable law:</font></font></font><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">11.1&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>THE\r\nIBM CONSENTS THAT TheViralMarketer</b></font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">\r\nmay collect, retain, use, compile, pool, process and disseminate the\r\ninformation on the online registration form. The only personal data\r\nthat will be collected is the name and email address of the IBM.\r\nTheViralMarketer primary business operations are that of collecting\r\n“leads”. These data of the IBM will only be distributed to the\r\nappropriate “upline” designated to receive the data of the IBM.\r\nThe “upline” at his/her discretion will be allowed to add the IBM\r\ndata to an email marketing campaign. The IBM must be presented by the\r\n“upline” the option to unsubscribe from such email marketing\r\ncampaign. </font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">11.2</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>THE\r\nIBM CONSENTS</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">that\r\nTheViralMarketer and may use the IBM\'s personal data for the purposes\r\nof (a) facilitating performance of this agreement; (b) contacting the\r\nIBM for further information; (c) improving TheViralMarketer\'s\r\ncommunication techniques and channels; (d) personalising the level,\r\ntype and method of contact TheViralMarketer has with the IBM; (e)\r\nevaluating the IBM\'s satisfaction with current products and services\r\noffered by TheViralMarketer; (f) improving products and services\r\noffered by TheViralMarketer; (g) correction or amendment of the IBM\'s\r\npersonal data; (h) prevention of fraud; (i) providing information on\r\nthe purchase volumes and earned commissions and levels of awards of\r\nyour IBM or IBMs connected with you or your IBM under\r\nTheViralMarketer Sales and Marketing Plan. Furthermore,\r\nTheViralMarketer and the Third Parties identified above may use the\r\nIBM’s personal data for the purposes of tailoring product or\r\nservice offers to the IBM or a group of individuals with the same\r\ncharacteristics as the IBM and/or compiling a demographic\r\nstudy,&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>PROVIDED\r\nTHAT THE IBM HAS EXPLICITLY CONSENTED</b></font></font></font><font color=\"#56565a\">&nbsp;\r\nduring the online registration process form</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">\r\nthat the IBM\'s information may be used for direct marketing and\r\nresearch purposes.</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">11.8\r\nTheViralMarketer shall maintain its data warehouse in a secured\r\nstand-alone server located in a controlled and secure area. Personal\r\ndata will be available only to users employed or authorised by\r\nTheViralMarketer, affiliates, subsidiaries and/or divisions of\r\nTheViralMarketer, Third Parties and IBMs who can present\r\nidentification and are approved users who have signed a declaration\r\nthat they will not use the data for any purpose other than the\r\npurposes stated herein. Personal data stored electronically, will\r\nonly be accessible to users employed or authorised by\r\nTheViralMarketer, affiliates, subsidiaries and/or divisions of\r\nTheViralMarketer, Third Parties and IBMs who have approved login\r\nidentification numbers and password protection. Personal data that is\r\nstored electronically shall be backed up periodically. The backup\r\ndata shall be retained in a second controlled and secure area.\r\n</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">13.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>GOVERNING\r\nLAWS, DISPUTES:</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">This\r\nagreement shall be construed, governed and interpreted in accordance\r\nwith the laws of the Republic of South Africa and should a dispute\r\narise from this agreement, the parties shall negotiate in good faith\r\nwith each other to resolve the dispute.</font></font></font><br><br><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">14.&nbsp;</font></font></font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\"><b>CHOSEN\r\nADDRESS FOR SERVING DOCUMENTS AND NOTICES:</b></font></font></font><font color=\"#56565a\">&nbsp;</font><font color=\"#56565a\"><font face=\"ITCFranklinGothicW01-Bk\"><font style=\"font-size: 11pt\">The\r\nparties choose the addresses as set out overleaf (or as amended by\r\nnotice in writing) as their respective addresses for the purposes of\r\nserving and receiving documents and notices.</font></font></font></p>', 1, '2018-02-22 11:38:11', '2018-08-14 10:15:29'),
(3, 'income-disclaimer', '<h1 class=\"entry-title\" style=\"font-size: 30px; margin-top: 0px; margin-bottom: 12px; color: rgb(0, 0, 0); font-family: proxima-nova, sans-serif; line-height: 1;\">Income Disclaimer</h1><div class=\"clear\" style=\"clear: both; overflow: hidden; visibility: hidden; width: 0px; height: 0px; font-family: proxima-nova, sans-serif; font-size: 16px;\"></div><div class=\"featured-img\" style=\"font-family: proxima-nova, sans-serif; font-size: 16px;\"></div><div class=\"clear\" style=\"clear: both; overflow: hidden; visibility: hidden; width: 0px; height: 0px; font-family: proxima-nova, sans-serif; font-size: 16px;\"></div><p style=\"margin-bottom: 2.4rem; padding: 0px; -webkit-font-smoothing: antialiased; font-family: proxima-nova, sans-serif; font-size: 16px;\">While we make every effort to ensure that we accurately represent all the products and services reviewed on this website and their potential for income, it should be noted that earnings and income statements made by IncomeDiary.com and its advertisers / sponsors are estimates only of what we think you can possibly earn. There is no guarantee that you will make these levels of income and you accept the risk that the earnings and income statements differ by individual.</p><p style=\"margin-bottom: 2.4rem; padding: 0px; -webkit-font-smoothing: antialiased; font-family: proxima-nova, sans-serif; font-size: 16px;\">As with any business, your results may vary, and will be based on your individual capacity, business experience, expertise, and level of desire. There are no guarantees concerning the level of success you may experience. The testimonials and examples used are exceptional results, which do not apply to the average purchaser, and are not intended to represent or guarantee that anyone will achieve the same or similar results. Each individual’s success depends on his or her background, dedication, desire and motivation.</p><p style=\"margin-bottom: 2.4rem; padding: 0px; -webkit-font-smoothing: antialiased; font-family: proxima-nova, sans-serif; font-size: 16px;\">There is no assurance that examples of past earnings can be duplicated in the future. We cannot guarantee your future results and/or success. There are some unknown risks in business and on the internet that we cannot foresee which could reduce results you experience. We are not responsible for your actions.</p><p style=\"margin-bottom: 2.4rem; padding: 0px; -webkit-font-smoothing: antialiased; font-family: proxima-nova, sans-serif; font-size: 16px;\">The use of our information, products and services should be based on your own due diligence and you agree that IncomeDiary.com and the advertisers / sponsors of this website are not liable for any success or failure of your business that is directly or indirectly related to the purchase and use of our information, products and services reviewed or advertised on this website.</p>', 1, '2018-02-22 11:38:24', '2018-11-02 19:05:58'),
(4, 'contact-us', '<legend><span class=\"fa fa-globe\"></span>&nbsp;Our office</legend>', 1, '2018-02-22 11:38:34', '2018-07-21 09:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reset_password`
--

INSERT INTO `tbl_reset_password` (`id`, `email`, `activation_id`, `agent`, `client_ip`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@test.com', '1OfzJiGWPLCcXAT', 'Chrome 63.0.3239.111', '119.160.68.129', 0, 1, '2018-01-22 06:05:49', NULL, NULL),
(2, 'admin@test.com', 'sapJTM0GyvOmfSr', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-22 16:56:03', NULL, NULL),
(3, 'admin@test.com', 'agUlvFuMknE97qi', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-22 16:57:21', NULL, NULL),
(4, 'hamad.pixiders@gmail.com', 'v1VWewk2HGMKBqD', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:09:22', NULL, NULL),
(5, 'hamad.pixiders@gmail.com', 'K6ph17XIFbm8jTl', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:13:18', NULL, NULL),
(6, 'hamad.pixiders@gmail.com', 'y9S53wZMimBeYcz', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:21:51', NULL, NULL),
(7, 'hamad.pixiders@gmail.com', 'SwXTyNJilOHb93c', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:24:30', NULL, NULL),
(8, 'hamad.pixiders@gmail.com', 'FTMHaX698JZCoU5', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:26:30', NULL, NULL),
(9, 'hamad.pixiders@gmail.com', 'LwD5BKzviWu0R9s', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:34:19', NULL, NULL),
(10, 'hamad.pixiders@gmail.com', 'PUwmFVvITs4rMOn', 'Chrome 63.0.3239.132', '119.160.68.129', 0, 1, '2018-01-23 11:37:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'ermaralack@gmail.com', '$2y$10$.nAklPO4grG3upr4NYe7eeI6s9RQoTYdUuBL0GFncTHOUohWVgj3m', 'System Administrator', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-01-21 09:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `description` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `sender_Ibm` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_ibm` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `sender_wallet_address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_wallet_address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `miner_fee` float NOT NULL,
  `tvm_fee` float NOT NULL,
  `admin_trans` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `description`, `transaction_id`, `sender_Ibm`, `receiver_ibm`, `sender_wallet_address`, `receiver_wallet_address`, `amount`, `date`, `status`, `miner_fee`, `tvm_fee`, `admin_trans`) VALUES
(134, 'send wallet to wallet test', 'test12345', 'IBM1', 'IBM2', '1PjzYXPVpsB8jRKBUQKbA8XpKVWSbUpQgT', '1CdcUkhY1tezLWg2i1MZ6hFrqoL1JfRTcH', '5', '2020-07-15 06:07:09', 'completed', 0.03, 0.03, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `date_added`) VALUES
(1, '12345', '2017-12-09 19:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addTweet`
--
ALTER TABLE `addTweet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `memberadvertise`
--
ALTER TABLE `memberadvertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MemberAdvertise`
--
ALTER TABLE `MemberAdvertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `members-test`
--
ALTER TABLE `members-test`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `members_otp_codes`
--
ALTER TABLE `members_otp_codes`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `members_tweets_category`
--
ALTER TABLE `members_tweets_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_twitter_accounts`
--
ALTER TABLE `members_twitter_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_twitter_logs`
--
ALTER TABLE `members_twitter_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_twitter_posts`
--
ALTER TABLE `members_twitter_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_memberships`
--
ALTER TABLE `paid_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid_member_relationship`
--
ALTER TABLE `paid_member_relationship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_Transaction`
--
ALTER TABLE `paypal_Transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_tasks`
--
ALTER TABLE `pending_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_access_tokens`
--
ALTER TABLE `profile_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed_levels`
--
ALTER TABLE `subscribed_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed_levels-test-data`
--
ALTER TABLE `subscribed_levels-test-data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_levels`
--
ALTER TABLE `system_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_landing_pages`
--
ALTER TABLE `tbl_landing_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member_landingpage`
--
ALTER TABLE `tbl_member_landingpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addTweet`
--
ALTER TABLE `addTweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberadvertise`
--
ALTER TABLE `memberadvertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `MemberAdvertise`
--
ALTER TABLE `MemberAdvertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `members-test`
--
ALTER TABLE `members-test`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `members_otp_codes`
--
ALTER TABLE `members_otp_codes`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `members_tweets_category`
--
ALTER TABLE `members_tweets_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `members_twitter_accounts`
--
ALTER TABLE `members_twitter_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members_twitter_logs`
--
ALTER TABLE `members_twitter_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `members_twitter_posts`
--
ALTER TABLE `members_twitter_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `paid_memberships`
--
ALTER TABLE `paid_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paid_member_relationship`
--
ALTER TABLE `paid_member_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paypal_Transaction`
--
ALTER TABLE `paypal_Transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_tasks`
--
ALTER TABLE `pending_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profile_access_tokens`
--
ALTER TABLE `profile_access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `subscribed_levels`
--
ALTER TABLE `subscribed_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `subscribed_levels-test-data`
--
ALTER TABLE `subscribed_levels-test-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `system_levels`
--
ALTER TABLE `system_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_email_templates`
--
ALTER TABLE `tbl_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_landing_pages`
--
ALTER TABLE `tbl_landing_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `tbl_member_landingpage`
--
ALTER TABLE `tbl_member_landingpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
