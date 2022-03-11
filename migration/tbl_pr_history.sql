-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 09:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fascalab_2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pr_history`
--

CREATE TABLE `tbl_pr_history` (
  `ID` int(11) NOT NULL,
  `PR_NO` varchar(100) NOT NULL,
  `ACTION_DATE` datetime DEFAULT NULL,
  `ACTION_TAKEN` varchar(100) NOT NULL,
  `ASSIGN_EMP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pr_history`
--

INSERT INTO `tbl_pr_history` (`ID`, `PR_NO`, `ACTION_DATE`, `ACTION_TAKEN`, `ASSIGN_EMP`) VALUES
(1, '2022-02-0001', '2022-02-15 14:27:29', '3', 3174),
(2, '2022-02-0001', '2022-02-15 14:27:33', '4', 3174),
(3, '2022-02-0001', '2022-02-15 14:27:54', '5', 3174),
(4, '2022-02-00002', '2022-02-15 14:39:31', '0', 3377),
(5, '2022-02-00002', '2022-02-15 14:40:34', '3', 3377),
(6, '2022-02-00002', '2022-02-15 14:41:21', '4', 3174),
(7, '2022-02-00002', '2022-02-15 14:42:18', '5', 3174),
(8, '2022-02-0003', '2022-02-16 12:06:58', '0', 3174),
(9, '2022-02-0003', '2022-02-16 12:07:02', '3', 3174),
(10, '2022-02-0003', '2022-02-16 12:07:05', '4', 3174),
(11, '2022-02-0003', '2022-02-16 12:07:15', '5', 3174),
(12, '2022-02-0004', '2022-02-16 16:22:29', '0', 3174),
(13, '2022-02-0004', '2022-02-17 08:21:34', '3', 3174),
(14, '2022-02-0004', '2022-02-17 08:21:37', '4', 3174),
(15, '2022-02-0004', '2022-02-17 08:21:54', '5', 3174),
(16, '2022-02-0005', '2022-02-17 08:45:34', '0', 3174),
(17, '2022-02-0005', '2022-02-17 08:45:37', '3', 3174),
(18, '2022-02-0005', '2022-02-17 08:45:40', '4', 3174),
(19, '2022-02-0005', '2022-02-17 08:45:49', '5', 3174),
(20, '2022-02-0006', '2022-02-18 09:51:11', '0', 3174),
(21, '2022-02-0006', '2022-02-18 09:51:15', '3', 3174),
(22, '2022-02-0006', '2022-02-18 09:51:17', '4', 3174),
(23, '2022-02-0006', '2022-02-18 09:51:48', '5', 3174),
(24, '2022-02-0007', '2022-02-18 09:55:42', '0', 3174),
(25, '2022-02-0007', '2022-02-18 09:55:46', '3', 3174),
(26, '2022-02-0007', '2022-02-18 09:55:49', '4', 3174),
(27, '2022-02-0007', '2022-02-18 09:55:57', '5', 3174),
(28, '2022-02-0008', '2022-02-18 09:57:00', '0', 3174),
(29, '2022-02-0008', '2022-02-18 09:57:09', '3', 3174),
(30, '2022-02-0008', '2022-02-18 09:57:11', '4', 3174),
(31, '2022-02-0008', '2022-02-18 09:57:21', '5', 3174),
(32, '2022-02-0005', '2022-02-18 10:16:53', '5', 3174),
(33, '2022-02-0001', '2022-02-18 10:17:54', '5', 3174),
(34, '2022-02-0001', '2022-02-18 10:20:00', '5', 3174),
(35, '2022-02-0001', '2022-02-18 10:20:13', '5', 3174),
(36, '2022-02-0001', '2022-02-18 10:20:32', '5', 3174),
(37, '2022-02-0001', '2022-02-18 10:20:43', '5', 3174),
(38, '2022-02-0009', '2022-02-18 10:21:17', '0', 3174),
(39, '2022-02-0009', '2022-02-18 10:21:25', '5', 3174),
(40, '2022-02-00010', '2022-02-18 10:22:49', '0', 3174),
(41, '2022-02-00010', '2022-02-18 10:22:55', '3', 3174),
(42, '2022-02-00010', '2022-02-18 10:22:58', '4', 3174),
(43, '2022-02-00010', '2022-02-18 10:23:11', '5', 3174),
(44, '2022-02-00011', '2022-02-18 10:30:16', '0', 3174),
(45, '2022-02-00011', '2022-02-18 10:30:22', '3', 3174),
(46, '2022-02-00011', '2022-02-18 10:30:24', '4', 3174),
(47, '2022-02-00011', '2022-02-18 10:30:37', '5', 3174),
(48, '2022-02-0001', '2022-02-18 10:31:00', '5', 3174),
(49, '2022-02-0001', '2022-02-18 10:31:53', '5', 3174),
(50, '2022-02-00011', '2022-02-18 10:32:01', '5', 3174),
(51, '2022-02-00011', '2022-02-18 10:32:27', '5', 3174),
(52, '2022-02-00011', '2022-02-18 10:34:56', '5', 3174),
(53, '2022-02-00011', '2022-02-18 10:35:07', '5', 3174),
(54, '2022-02-00012', '2022-02-18 10:35:38', '0', 3174),
(55, '2022-02-00012', '2022-02-18 10:35:42', '3', 3174),
(56, '2022-02-00012', '2022-02-18 10:35:44', '4', 3174),
(57, '2022-02-00012', '2022-02-18 10:35:57', '5', 3174),
(58, '2022-02-00013', '2022-02-18 10:37:38', '0', 3174),
(59, '2022-02-00013', '2022-02-18 10:37:49', '3', 3174),
(60, '2022-02-00013', '2022-02-18 10:37:52', '4', 3174),
(61, '2022-02-00013', '2022-02-18 10:38:02', '5', 3174),
(62, '2022-02-00014', '2022-02-18 10:39:29', '0', 3174),
(63, '2022-02-00014', '2022-02-18 10:39:42', '3', 3174),
(64, '2022-02-00014', '2022-02-18 10:39:44', '4', 3174),
(65, '2022-02-00014', '2022-02-18 10:39:55', '5', 3174),
(66, '2022-02-00014', '2022-02-18 10:40:40', '5', 3174),
(67, '2022-02-00015', '2022-02-18 10:42:01', '0', 3174),
(68, '2022-02-00015', '2022-02-18 10:42:14', '3', 3174),
(69, '2022-02-00015', '2022-02-18 10:42:17', '4', 3174),
(70, '2022-02-00015', '2022-02-18 10:42:37', '5', 3174),
(71, '2022-02-00016', '2022-02-18 10:44:06', '0', 3174),
(72, '2022-02-00016', '2022-02-18 10:44:10', '3', 3174),
(73, '2022-02-00016', '2022-02-18 10:44:12', '4', 3174),
(74, '2022-02-00016', '2022-02-18 10:44:18', '5', 3174),
(75, '2022-02-00016', '2022-02-18 10:47:24', '5', 3174),
(76, '2022-02-00016', '2022-02-18 10:47:54', '5', 3174),
(77, '2022-02-00016', '2022-02-18 10:48:14', '5', 3174),
(78, '2022-02-00017', '2022-02-18 10:48:55', '0', 3174),
(79, '2022-02-00017', '2022-02-18 10:48:59', '3', 3174),
(80, '2022-02-00017', '2022-02-18 10:49:01', '4', 3174),
(81, '2022-02-00017', '2022-02-18 10:49:09', '5', 3174),
(82, '2022-02-00017', '2022-02-18 10:51:07', '5', 3174),
(83, '2022-02-00017', '2022-02-18 10:51:19', '5', 3174),
(84, '2022-02-00017', '2022-02-18 10:51:55', '5', 3174),
(85, '2022-02-00017', '2022-02-18 10:52:19', '5', 3174),
(86, '2022-02-00017', '2022-02-18 10:52:51', '5', 3174),
(87, '2022-02-00018', '2022-02-18 10:54:19', '0', 3174),
(88, '2022-02-00018', '2022-02-18 10:54:23', '3', 3174),
(89, '2022-02-00018', '2022-02-18 10:54:25', '4', 3174),
(90, '2022-02-00018', '2022-02-18 10:55:07', '5', 3174),
(91, '2022-02-00019', '2022-02-18 10:55:36', '0', 3174),
(92, '2022-02-00019', '2022-02-18 10:55:38', '3', 3174),
(93, '2022-02-00019', '2022-02-18 10:55:41', '4', 3174),
(94, '2022-02-00019', '2022-02-18 10:56:23', '5', 3174),
(95, '2022-02-00019', '2022-02-18 10:56:29', '5', 3174),
(96, '2022-02-00019', '2022-02-18 10:56:47', '5', 3174),
(97, '2022-02-00019', '2022-02-18 10:57:32', '5', 3174),
(98, '2022-02-00019', '2022-02-18 10:58:28', '5', 3174),
(99, '2022-02-00019', '2022-02-18 10:58:49', '5', 3174),
(100, '2022-02-00019', '2022-02-18 10:59:44', '5', 3174),
(101, '2022-02-00019', '2022-02-18 11:00:34', '5', 3174),
(102, '2022-02-00019', '2022-02-18 11:00:43', '5', 3174),
(103, '2022-02-00019', '2022-02-18 11:01:24', '5', 3174),
(104, '2022-02-00019', '2022-02-18 11:02:11', '5', 3174),
(105, '2022-02-00019', '2022-02-18 11:02:37', '5', 3174),
(106, '2022-02-00019', '2022-02-18 11:03:26', '5', 3174),
(107, '2022-02-00019', '2022-02-18 11:03:40', '5', 3174),
(108, '2022-02-00019', '2022-02-18 11:04:37', '5', 3174),
(109, '2022-02-00019', '2022-02-18 11:05:01', '5', 3174),
(110, '2022-02-00019', '2022-02-18 11:05:13', '5', 3174),
(111, '2022-02-00019', '2022-02-18 11:06:56', '5', 3174),
(112, '2022-02-00019', '2022-02-18 11:07:06', '5', 3174),
(113, '2022-02-00019', '2022-02-18 11:08:42', '5', 3174),
(114, '2022-02-00019', '2022-02-18 11:09:11', '5', 3174),
(115, '2022-02-00019', '2022-02-18 11:11:52', '5', 3174),
(116, '2022-02-00019', '2022-02-18 11:12:25', '5', 3174),
(117, '2022-02-00019', '2022-02-18 11:13:57', '5', 3174),
(118, '2022-02-00019', '2022-02-18 11:14:16', '5', 3174),
(119, '2022-02-00019', '2022-02-18 11:14:28', '5', 3174),
(120, '2022-02-00019', '2022-02-18 11:14:55', '5', 3174),
(121, '2022-02-00019', '2022-02-18 11:15:29', '5', 3174),
(122, '2022-02-00019', '2022-02-18 11:15:42', '5', 3174),
(123, '2022-02-0001', '2022-02-18 11:17:40', '0', 3174),
(124, '2022-02-0001', '2022-02-18 11:17:43', '3', 3174),
(125, '2022-02-0001', '2022-02-18 11:17:45', '4', 3174),
(126, '2022-02-0001', '2022-02-18 11:17:59', '5', 3174),
(127, '2022-02-00002', '2022-02-18 11:21:07', '0', 3174),
(128, '2022-02-00002', '2022-02-18 11:21:10', '3', 3174),
(129, '2022-02-00002', '2022-02-18 11:21:12', '4', 3174),
(130, '2022-02-00002', '2022-02-18 11:21:17', '5', 3174),
(131, '2022-02-0003', '2022-02-18 11:22:43', '0', 3174),
(132, '2022-02-0003', '2022-02-18 11:22:46', '3', 3174),
(133, '2022-02-0003', '2022-02-18 11:22:48', '4', 3174),
(134, '2022-02-0003', '2022-02-18 11:22:53', '5', 3174),
(135, '2022-02-0003', '2022-02-18 11:23:31', '5', 3174),
(136, '2022-02-0004', '2022-02-18 15:09:29', '0', 3174),
(137, '2022-02-0004', '2022-02-18 15:11:10', '3', 3174),
(138, '2022-02-0004', '2022-02-18 15:11:14', '4', 3174),
(139, '2022-02-0004', '2022-02-18 15:11:33', '5', 3174),
(140, '2022-02-0005', '2022-02-18 15:13:26', '0', 3174),
(141, '2022-02-0005', '2022-02-18 15:13:34', '3', 3174),
(142, '2022-02-0005', '2022-02-18 15:13:36', '4', 3174),
(143, '2022-02-0005', '2022-02-18 15:14:02', '5', 3174),
(144, '2022-02-0006', '2022-02-18 15:44:58', '0', 3174),
(145, '2022-02-0006', '2022-02-18 15:45:00', '3', 3174),
(146, '2022-02-0006', '2022-02-18 15:45:02', '4', 3174),
(147, '2022-02-0006', '2022-02-19 12:04:43', '5', 3174),
(148, '2022-02-0006', '2022-02-19 12:09:11', '5', 3174),
(149, '2022-02-0006', '2022-02-19 12:09:30', '5', 3174),
(150, '2022-02-0007', '2022-02-19 12:10:35', '0', 3174),
(151, '2022-02-0007', '2022-02-19 12:10:38', '3', 3174),
(152, '2022-02-0007', '2022-02-19 12:10:41', '4', 3174),
(153, '2022-02-0007', '2022-02-19 12:19:03', '5', 3174),
(154, '2022-02-0008', '2022-02-19 12:25:50', '0', 3174),
(155, '2022-02-0008', '2022-02-19 12:25:53', '3', 3174),
(156, '2022-02-0008', '2022-02-19 12:25:56', '4', 3174),
(157, '2022-02-0008', '2022-02-19 12:30:40', '5', 3174),
(158, '2022-02-0001', '2022-02-19 12:50:52', '0', 3174),
(159, '2022-02-0001', '2022-02-19 12:51:13', '3', 3174),
(160, '2022-02-0001', '2022-02-19 12:51:16', '4', 3174),
(161, '2022-02-0001', '2022-02-19 12:51:31', '5', 3174),
(162, '2022-02-00002', '2022-02-19 16:39:54', '0', 3174),
(163, '2022-02-00002', '2022-02-19 16:39:57', '3', 3174),
(164, '2022-02-00002', '2022-02-19 16:40:00', '4', 3174),
(165, '2022-02-00002', '2022-02-19 16:40:19', '5', 3174),
(166, '2022-02-0003', '2022-02-19 21:43:17', '0', 3174),
(167, '2022-02-0003', '2022-02-19 21:43:20', '3', 3174),
(168, '2022-02-0003', '2022-02-19 21:43:23', '4', 3174),
(169, '2022-02-0003', '2022-02-19 21:43:34', '5', 3174),
(170, '2022-02-0004', '2022-02-19 22:15:14', '0', 3174),
(171, '2022-02-0004', '2022-02-19 22:15:17', '3', 3174),
(172, '2022-02-0004', '2022-02-19 22:15:24', '4', 3174),
(173, '2022-02-0004', '2022-02-19 22:16:17', '5', 3174),
(174, '2022-02-0005', '2022-02-19 23:13:27', '0', 3174),
(175, '2022-02-0005', '2022-02-19 23:13:30', '3', 3174),
(176, '2022-02-0005', '2022-02-19 23:13:33', '4', 3174),
(177, '2022-02-0005', '2022-02-19 23:16:09', '5', 3174),
(178, '2022-02-0005', '2022-02-19 23:17:56', '5', 3174),
(179, '2022-02-0005', '2022-02-19 23:18:30', '5', 3174),
(180, '2022-02-0005', '2022-02-19 23:19:19', '5', 3174),
(181, '2022-02-0005', '2022-02-19 23:19:30', '5', 3174),
(182, '2022-02-0005', '2022-02-19 23:19:41', '5', 3174),
(183, '2022-02-0005', '2022-02-19 23:38:06', '5', 3174),
(184, '2022-02-0001', '2022-02-19 23:40:16', '0', 3174),
(185, '2022-02-0001', '2022-02-19 23:40:19', '3', 3174),
(186, '2022-02-0001', '2022-02-19 23:40:21', '4', 3174),
(187, '2022-02-0001', '2022-02-19 23:40:38', '5', 3174),
(188, '2022-02-0001', '2022-02-19 23:44:56', '4', 3174),
(189, '2022-02-0001', '2022-02-19 23:46:03', '0', 3174),
(190, '2022-02-0001', '2022-02-19 23:46:06', '3', 3174),
(191, '2022-02-0001', '2022-02-19 23:46:09', '4', 3174),
(192, '2022-02-0001', '2022-02-19 23:46:17', '5', 3174),
(193, '2022-02-00002', '2022-02-19 23:48:49', '0', 3174),
(194, '2022-02-00002', '2022-02-19 23:48:55', '3', 3174),
(195, '2022-02-00002', '2022-02-19 23:48:58', '4', 3174),
(196, '2022-02-0001', '2022-02-20 00:00:54', '0', 3174),
(197, '2022-02-0001', '2022-02-20 00:00:57', '3', 3174),
(198, '2022-02-0001', '2022-02-20 00:01:00', '4', 3174),
(199, '2022-02-0001', '2022-02-20 00:01:53', '5', 3174),
(200, '2022-02-0001', '2022-02-20 00:09:02', '0', 3174),
(201, '2022-02-0001', '2022-02-20 00:09:04', '3', 3174),
(202, '2022-02-0001', '2022-02-20 00:09:06', '4', 3174),
(203, '2022-02-0001', '2022-02-20 00:09:22', '5', 3174),
(204, '2022-02-00002', '2022-02-21 13:29:10', '0', 3174),
(205, '2022-02-00002', '2022-02-21 13:29:13', '3', 3174),
(206, '2022-02-00002', '2022-02-21 13:29:15', '4', 3174),
(207, '2022-02-00002', '2022-02-21 13:29:24', '5', 3174),
(208, '2022-02-0003', '2022-02-21 13:44:58', '0', 3174),
(209, '2022-02-0003', '2022-02-21 13:45:02', '3', 3174),
(210, '2022-02-0003', '2022-02-21 13:45:05', '4', 3174),
(211, '2022-02-0004', '2022-02-21 14:12:09', '0', 3174),
(212, '2022-02-0004', '2022-02-21 14:12:12', '3', 3174),
(213, '2022-02-0004', '2022-02-21 14:12:15', '4', 3174),
(214, '2022-02-0004', '2022-02-21 14:15:03', '5', 3174),
(215, '2022-02-0004', '2022-02-21 14:15:20', '5', 3174),
(216, '2022-02-0001', '2022-02-21 14:17:19', '0', 3174),
(217, '2022-02-0001', '2022-02-21 14:17:21', '3', 3174),
(218, '2022-02-0001', '2022-02-21 14:17:27', '4', 3174),
(219, '2022-02-0001', '2022-02-21 14:18:15', '5', 3174),
(220, '2022-02-00002', '2022-02-21 14:22:24', '0', 3174),
(221, '2022-02-00002', '2022-02-21 14:22:29', '3', 3174),
(222, '2022-02-00002', '2022-02-21 14:22:32', '4', 3174),
(223, '2022-02-00002', '2022-02-21 14:27:26', '5', 3174),
(224, '2022-02-0003', '2022-02-21 15:31:26', '0', 3174),
(225, '2022-02-0003', '2022-02-21 15:31:28', '3', 3174),
(226, '2022-02-0003', '2022-02-21 15:31:31', '4', 3174),
(227, '2022-02-0003', '2022-02-21 15:31:41', '5', 3174),
(228, '2022-02-0004', '2022-02-21 16:03:40', '0', 3174),
(229, '2022-02-0004', '2022-02-21 16:03:42', '3', 3174),
(230, '2022-02-0004', '2022-02-21 16:03:45', '4', 3174),
(231, '2022-02-0004', '2022-02-21 16:03:54', '5', 3174),
(232, '2022-02-0001', '2022-02-21 16:10:08', '0', 3174),
(233, '2022-02-0001', '2022-02-21 16:10:10', '3', 3174),
(234, '2022-02-0001', '2022-02-21 16:10:13', '4', 3174),
(235, '2022-02-0001', '2022-02-21 16:10:21', '5', 3174),
(236, '2022-02-00002', '2022-02-21 17:05:48', '0', 3174),
(237, '2022-02-00002', '2022-02-21 17:05:51', '3', 3174),
(238, '2022-02-00002', '2022-02-21 17:05:53', '4', 3174),
(239, '2022-02-00002', '2022-02-21 17:06:02', '5', 3174),
(240, '2022-02-0003', '2022-02-21 17:11:30', '0', 3174),
(241, '2022-02-0003', '2022-02-21 17:11:36', '3', 3174),
(242, '2022-02-0003', '2022-02-21 17:11:39', '4', 3174),
(243, '2022-02-0003', '2022-02-21 17:11:47', '5', 3174),
(244, '2022-02-0001', '2022-02-21 17:17:08', '0', 3174),
(245, '2022-02-0001', '2022-02-21 17:17:11', '3', 3174),
(246, '2022-02-0001', '2022-02-21 17:17:13', '4', 3174),
(247, '2022-02-0001', '2022-02-21 17:17:22', '5', 3174),
(248, '2022-02-00002', '2022-02-21 17:19:44', '0', 3174),
(249, '2022-02-00002', '2022-02-21 17:19:47', '3', 3174),
(250, '2022-02-00002', '2022-02-21 17:19:49', '4', 3174),
(251, '2022-02-00002', '2022-02-21 17:20:00', '5', 3174),
(252, '2022-02-0003', '2022-02-21 17:23:09', '0', 3174),
(253, '2022-02-0003', '2022-02-21 17:23:12', '3', 3174),
(254, '2022-02-0003', '2022-02-21 17:23:15', '4', 3174),
(255, '2022-02-0003', '2022-02-21 17:23:27', '5', 3174),
(256, '2022-02-0004', '2022-02-21 17:56:58', '0', 3174),
(257, '2022-02-0004', '2022-02-21 17:57:01', '3', 3174),
(258, '2022-02-0004', '2022-02-21 17:57:03', '4', 3174),
(259, '2022-02-0004', '2022-02-21 17:57:15', '5', 3174),
(260, '2022-02-0005', '2022-02-22 10:14:58', '0', 3174),
(261, '2022-02-0005', '2022-02-22 10:15:01', '3', 3174),
(262, '2022-02-0005', '2022-02-22 10:15:04', '4', 3174),
(263, '2022-02-0005', '2022-02-22 10:18:28', '5', 3174),
(264, '2022-02-0006', '2022-02-22 11:40:04', '0', 3174),
(265, '2022-02-0006', '2022-02-22 11:40:07', '3', 3174),
(266, '2022-02-0006', '2022-02-22 11:40:09', '4', 3174),
(267, '2022-02-0006', '2022-02-22 11:40:27', '5', 3174),
(268, '2022-02-0001', '2022-02-22 11:46:33', '0', 3174),
(269, '2022-02-0001', '2022-02-22 11:46:36', '3', 3174),
(270, '2022-02-0001', '2022-02-22 11:46:38', '4', 3174),
(271, '2022-02-0001', '2022-02-22 11:46:50', '5', 3174),
(272, '2022-02-00002', '2022-02-22 12:02:23', '0', 3174),
(273, '2022-02-00002', '2022-02-22 12:02:26', '3', 3174),
(274, '2022-02-00002', '2022-02-22 12:02:29', '4', 3174),
(275, '2022-02-00002', '2022-02-22 12:02:37', '5', 3174),
(276, '2022-02-0003', '2022-02-22 14:06:02', '0', 3174),
(277, '2022-02-0003', '2022-02-22 14:06:04', '3', 3174),
(278, '2022-02-0003', '2022-02-22 14:06:07', '4', 3174),
(279, '2022-02-0003', '2022-02-22 14:06:19', '5', 3174),
(280, '2022-02-0004', '2022-02-22 16:39:09', '0', 3174),
(281, '2022-02-0004', '2022-02-22 16:39:12', '3', 3174),
(282, '2022-02-0004', '2022-02-22 16:39:14', '4', 3174),
(283, '2022-02-0004', '2022-02-22 16:39:22', '5', 3174),
(284, '2022-02-0001', '2022-02-22 16:44:51', '0', 3174),
(285, '2022-02-0001', '2022-02-22 16:44:53', '3', 3174),
(286, '2022-02-0001', '2022-02-22 16:44:55', '4', 3174),
(287, '2022-02-0001', '2022-02-22 16:45:01', '5', 3174),
(288, '2022-02-00002', '2022-02-23 09:12:25', '0', 3174),
(289, '2022-02-00002', '2022-02-23 09:12:28', '3', 3174),
(290, '2022-02-00002', '2022-02-23 09:12:30', '4', 3174),
(291, '2022-02-00002', '2022-02-23 09:12:38', '5', 3174),
(292, '2022-02-0003', '2022-02-23 15:10:23', '0', 3174),
(293, '2022-02-0003', '2022-02-23 15:10:26', '3', 3174),
(294, '2022-02-0003', '2022-02-23 15:10:30', '4', 3174),
(295, '2022-02-0003', '2022-02-23 15:10:38', '5', 3174),
(296, '2022-02-0004', '2022-02-24 10:55:56', '0', 3174),
(297, '2022-02-0001', '2022-02-24 15:52:56', '5', 3174),
(298, '2022-02-0001', '2022-02-24 16:01:32', '0', 3174),
(299, '2022-02-0001', '2022-02-24 16:02:02', '3', 3174),
(300, '2022-02-0001', '2022-02-24 16:02:04', '4', 3174),
(301, '2022-02-00002', '2022-02-24 16:02:38', '0', 3174),
(302, '2022-02-00002', '2022-02-24 16:02:41', '3', 3174),
(303, '2022-02-00002', '2022-02-24 16:02:44', '4', 3174),
(304, '2022-02-00002', '2022-02-24 16:11:15', '5', 3174),
(305, '2022-02-0001', '2022-02-24 16:11:15', '5', 3174),
(306, '2022-02-0003', '2022-02-24 16:15:01', '0', 3174),
(307, '2022-02-0003', '2022-02-24 16:15:04', '3', 3174),
(308, '2022-02-0003', '2022-02-24 16:15:07', '4', 3174),
(309, '2022-02-0003', '2022-02-24 16:15:33', '5', 3174),
(310, '2022-02-0001', '2022-02-24 16:26:20', '0', 3174),
(311, '2022-02-0001', '2022-02-24 16:26:24', '3', 3174),
(312, '2022-02-0001', '2022-02-24 16:26:26', '4', 3174),
(313, '2022-02-0001', '2022-02-24 16:26:33', '5', 3174),
(314, '2022-02-00002', '2022-02-26 12:03:05', '0', 3174),
(315, '2022-02-00002', '2022-02-26 12:03:08', '3', 3174),
(316, '2022-02-00002', '2022-02-26 12:03:10', '4', 3174),
(317, '2022-02-00002', '2022-02-26 12:08:26', '5', 3174),
(318, '2022-02-0001', '2022-02-26 12:23:05', '0', 3174),
(319, '2022-02-0001', '2022-02-26 12:23:08', '3', 3174),
(320, '2022-02-0001', '2022-02-26 12:23:10', '4', 3174),
(321, '2022-02-0001', '2022-02-26 12:26:45', '5', 3174),
(322, '2022-02-00002', '2022-02-28 11:03:36', '0', 3174),
(323, '2022-02-00002', '2022-02-28 11:03:42', '3', 3174),
(324, '2022-02-00002', '2022-02-28 11:03:44', '4', 3174),
(325, '2022-02-00002', '2022-02-28 11:32:11', '5', 3174),
(326, '2022-02-0001', '2022-02-28 13:05:54', '0', 3174),
(327, '2022-02-0001', '2022-02-28 13:06:00', '3', 3174),
(328, '2022-02-0001', '2022-02-28 13:06:03', '4', 3174),
(329, '2022-02-0001', '2022-02-28 13:06:19', '5', 3174),
(330, '2022-02-00002', '2022-02-28 13:12:02', '0', 3174),
(331, '2022-02-00002', '2022-02-28 13:12:21', '3', 3174),
(332, '2022-02-00002', '2022-02-28 13:12:23', '4', 3174),
(333, '2022-02-00002', '2022-02-28 13:12:30', '5', 3174),
(334, '2022-02-0003', '2022-02-28 13:44:08', '0', 3174),
(335, '2022-02-0003', '2022-02-28 13:44:11', '3', 3174),
(336, '2022-02-0003', '2022-02-28 13:44:13', '4', 3174),
(337, '2022-02-0003', '2022-02-28 13:44:22', '5', 3174),
(338, '2022-02-0004', '2022-02-28 16:37:43', '0', 3174),
(339, '2022-02-0004', '2022-02-28 16:37:45', '3', 3174),
(340, '2022-02-0004', '2022-02-28 16:37:48', '4', 3174),
(341, '2022-03-0005', '2022-03-01 13:47:21', '0', 3174),
(342, '2022-03-0005', '2022-03-01 13:47:25', '3', 3174),
(343, '2022-03-0005', '2022-03-01 13:47:29', '4', 3174),
(344, '2022-03-0005', '2022-03-01 13:47:41', '5', 3174),
(345, '2022-02-0004', '2022-03-02 09:34:20', '5', 3174),
(346, '2022-03-0001', '2022-03-02 10:24:03', '0', 3174),
(347, '2022-03-0001', '2022-03-02 10:24:15', '3', 3174),
(348, '2022-03-0001', '2022-03-02 10:24:19', '4', 3174),
(349, '2022-03-0001', '2022-03-02 10:24:30', '5', 3174);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_pr_history`
--
ALTER TABLE `tbl_pr_history`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pr_history`
--
ALTER TABLE `tbl_pr_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;