-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2024 at 11:10 AM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$12$cb0xH8YsCeij6smxfdoID.sj/iS33VpzBAz4MVhj6U5/ZCSJOPSC6');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nas`
--

CREATE TABLE `nas` (
  `id` int NOT NULL,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nas`
--

INSERT INTO `nas` (`id`, `nasname`, `shortname`, `type`, `ports`, `secret`, `server`, `community`, `description`) VALUES
(1, '172.60.20.229', 'mikrotik1', 'other', NULL, '1234', NULL, NULL, 'RADIUS Client');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radacct`
--

CREATE TABLE `radacct` (
  `radacctid` bigint NOT NULL,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(32) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctupdatetime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctinterval` int DEFAULT NULL,
  `acctsessiontime` int UNSIGNED DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(128) DEFAULT NULL,
  `connectinfo_stop` varchar(128) DEFAULT NULL,
  `acctinputoctets` bigint DEFAULT NULL,
  `acctoutputoctets` bigint DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `framedipv6address` varchar(45) NOT NULL DEFAULT '',
  `framedipv6prefix` varchar(45) NOT NULL DEFAULT '',
  `framedinterfaceid` varchar(44) NOT NULL DEFAULT '',
  `delegatedipv6prefix` varchar(45) NOT NULL DEFAULT '',
  `class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active\r\n0 = disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radcheck`
--

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`, `status`) VALUES
(2, 'roihan', 'Cleartext-Password', ':=', '123radius', 0),
(3, 'tes', 'Cleartext-Password', ':=', '0102030405', 0),
(4, 'pingaja', 'Cleartext-Password', ':=', '223344', 1),
(39, 'baru', 'Cleartext-Password', ':=', 'baru123', 1),
(40, 'testes', 'Cleartext-Password', ':=', 'setset', 1),
(41, 'barubuat', 'Cleartext-Password', ':=', 'buatbaru', 1),
(42, 'tes6', 'Cleartext-Password', ':=', '6tes', 1),
(43, '7tes', 'Cleartext-Password', ':=', 'tes7', 1),
(45, 'tes7', 'Cleartext-Password', ':=', '7tes', 1),
(46, 'roihan12', 'Cleartext-Password', ':=', 'roi123', 1),
(47, 'habibiroihan', 'Cleartext-Password', ':=', 'habib123', 1),
(48, 'buatbaru', 'Cleartext-Password', ':=', '12345', 1),
(49, 'admin00', 'Cleartext-Password', ':=', 'admin12', 1),
(50, 'radius123', 'Cleartext-Password', ':=', 'radius1234567890', 1),
(52, 'tes111111', 'Cleartext-Password', ':=', '12345678910', 1),
(53, '19baru', 'Cleartext-Password', ':=', 'baru19', 1),
(54, 'enabel', 'Cleartext-Password', ':=', 'enabel1', 1),
(55, 'tambahkan', 'Cleartext-Password', ':=', 'pengguna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `radgroupcheck`
--

CREATE TABLE `radgroupcheck` (
  `id` int UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupreply`
--

CREATE TABLE `radgroupreply` (
  `id` int UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radpostauth`
--

CREATE TABLE `radpostauth` (
  `id` int NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `class` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radpostauth`
--

INSERT INTO `radpostauth` (`id`, `username`, `pass`, `reply`, `authdate`, `class`) VALUES
(1, 'roi', '1234', 'Access-Accept', '2024-12-04 02:19:04.453840', NULL),
(2, 'roi', '0x01e78cdd546461d48381cba1b6cf85e7aa', 'Access-Accept', '2024-12-04 02:20:46.101930', NULL),
(3, 'roi', '0x0114508b596bdb11fac42b7e6a689e3e22', 'Access-Accept', '2024-12-04 02:30:34.021613', NULL),
(4, 'roi', '0x0151abc72ed54322e87320113ce10e136d', 'Access-Accept', '2024-12-04 02:31:54.099363', NULL),
(5, 'pppoe', '0x0188efd6d077d4abd52a2caf07d85ff6e7', 'Access-Reject', '2024-12-04 02:32:12.352528', NULL),
(6, 'roihan', '0x0187ccba067c56c78835ae931571196cc2', 'Access-Accept', '2024-12-04 02:32:28.835217', NULL),
(7, 'roi', '0x0120d028ace48a1d91cef042ef4c506c73', 'Access-Accept', '2024-12-04 02:46:36.057023', NULL),
(8, 'roi', '0x01eeed7ce4d2f9a321bfd45cd224a32ba4', 'Access-Reject', '2024-12-04 02:47:40.968179', NULL),
(9, 'roi', '0x01917544a32ca7a2a227273ca48fcea0ac', 'Access-Accept', '2024-12-04 02:48:13.073282', NULL),
(10, 'roi', '0x019a330deac81e80466308ec9b0871b474', 'Access-Accept', '2024-12-04 02:53:22.098531', NULL),
(11, 'roi', '0x012179a4b26cd344e6a2b1b0ad251a093a', 'Access-Accept', '2024-12-04 02:58:45.531957', NULL),
(12, 'roi', '0x01acaa47a05a6d094563dbffaeeca054ee', 'Access-Accept', '2024-12-04 03:04:31.458385', NULL),
(13, 'roi', '0x01876a9fdac2be38b470612a29a4347d7c', 'Access-Accept', '2024-12-04 03:05:21.809464', NULL),
(14, 'roi', '', 'Access-Reject', '2024-12-04 03:06:15.348773', NULL),
(15, 'roi', '', 'Access-Reject', '2024-12-04 03:06:42.955626', NULL),
(16, 'roi', '', 'Access-Reject', '2024-12-04 03:07:27.921137', NULL),
(17, 'roi', '', 'Access-Accept', '2024-12-04 03:10:22.215076', NULL),
(18, 'roi', '0x017b89ad3a2b344e36a04faee44fb51eae', 'Access-Accept', '2024-12-04 03:12:05.191744', NULL),
(19, 'roi', '0x01e58316d5794cbb869fc7c6f4bdb9d844', 'Access-Accept', '2024-12-04 03:19:23.735672', NULL),
(20, 'roihan', '0x018f1fc0fd6931c3d2da373d68680e3ec8', 'Access-Accept', '2024-12-04 03:25:43.453390', NULL),
(21, 'mikrotik', '0x01e93ffc78769a2809cf89e2227d04134e', 'Access-Reject', '2024-12-04 03:25:59.066138', NULL),
(22, 'roi', '0x01c51c185d7b51ff60d95ab85ba95df174', 'Access-Accept', '2024-12-04 03:26:10.100577', NULL),
(23, 'roi', '0x01407eee08f3ff5bcabba649877b3fd312', 'Access-Reject', '2024-12-04 03:26:36.196979', NULL),
(24, 'roi', '0x01c3a4bb2ca580adc9e780576bde7ae74a', 'Access-Reject', '2024-12-04 03:26:44.570247', NULL),
(25, 'roi', '0x019f335a8da63823b9d34e603ac7091df9', 'Access-Reject', '2024-12-04 03:26:47.525217', NULL),
(26, 'roi', '0x01451f6c448b3e64ea9fa33e8952f97bb9', 'Access-Accept', '2024-12-04 03:26:57.296743', NULL),
(27, 'roi', '0x019a7e649fb2677a94ecca82ea7b7cfa36', 'Access-Reject', '2024-12-04 03:27:19.930874', NULL),
(28, 'roi', '0x011c88f7e323d730214fa9aca3a8052d9c', 'Access-Accept', '2024-12-04 03:35:35.809766', NULL),
(29, 'roi', '0x01f2b69d40b9167a0f5b34a4e01e0b1c73', 'Access-Accept', '2024-12-04 03:38:20.477965', NULL),
(30, 'roi', '0x01f6f0ddaddcec7e4d27152f2ecfc87573', 'Access-Accept', '2024-12-04 03:39:26.312892', NULL),
(31, 'roihan', '0x01b6c413f4180e8519979cc68289c10951', 'Access-Accept', '2024-12-04 03:39:44.153014', NULL),
(32, 'roi', '0x015a1a1dddcefb1ce4a67b5255f92eeaf4', 'Access-Accept', '2024-12-04 03:42:24.550279', NULL),
(33, 'roihan', '0x01f4e0f033e40a910565e38106268d763f', 'Access-Accept', '2024-12-04 03:42:45.027566', NULL),
(34, 'roi', '0x01b28365af2d5d4f35a206294f6983ae60', 'Access-Accept', '2024-12-04 03:44:52.728945', NULL),
(35, 'roihan', '0x01b6d4ac336905e148963437c524a534ee', 'Access-Accept', '2024-12-04 03:45:12.372857', NULL),
(36, 'tes', '0x01ff0479e39c564b2c7f96d6c4abc4c7b2', 'Access-Accept', '2024-12-04 03:46:28.401927', NULL),
(37, 'roi', '0x013ba6c7dbbedd8aeb0aeef443774a9a7b', 'Access-Accept', '2024-12-04 03:54:32.787916', NULL),
(38, 'roihan', '0x011bbdbdfb9e7adcd12a2aa74eb5ae396e', 'Access-Accept', '2024-12-04 04:06:57.715320', NULL),
(39, 'tes', '0x01f2897ee2ed025669260833bcba27e6b3', 'Access-Accept', '2024-12-04 04:08:40.296905', NULL),
(40, 'roi', '0x012461198c6872d16b0959aef5e532f8a3', 'Access-Accept', '2024-12-04 04:24:31.102773', NULL),
(41, 'roihan', '0x01874b7a668425bbc361d7dd2d9b53f325', 'Access-Accept', '2024-12-04 04:42:31.971080', NULL),
(42, 'roi', '1234', 'Access-Accept', '2024-12-04 04:46:31.345370', NULL),
(43, 'roi', '0x010c109e8ea82686424f9ace66f6679789', 'Access-Accept', '2024-12-04 06:18:11.621683', NULL),
(44, 'roi', '0x0120fd593d684aebbb78fef79734ff12c7', 'Access-Accept', '2024-12-04 07:00:23.261771', NULL),
(45, 'tes', '0x0102603c7d30b83e35ba943aca7951ac38', 'Access-Accept', '2024-12-04 08:39:02.224582', NULL),
(46, 'roi', '0x0134613c18ebe7caccc4d4b9983de79e19', 'Access-Reject', '2024-12-05 04:45:09.198034', NULL),
(47, 'tes', '0x01dfbb67c564ed1eaad1844c05075e1e96', 'Access-Accept', '2024-12-05 04:45:44.158384', NULL),
(48, 'roihan', '0x014468c09da38a8c64d804d70147133c40', 'Access-Accept', '2024-12-05 04:46:17.535614', NULL),
(49, 'roihan', '', 'Access-Reject', '2024-12-05 04:47:24.302193', NULL),
(50, 'roihan', '', 'Access-Accept', '2024-12-05 04:56:44.681094', NULL),
(51, 'tes', '', 'Access-Accept', '2024-12-05 04:57:18.399834', NULL),
(52, 'roihan', '', 'Access-Accept', '2024-12-05 05:00:06.165808', NULL),
(53, 'roi', '', 'Access-Accept', '2024-12-05 05:17:10.772536', NULL),
(54, 'roihan', '0x015c004e431543def8b0f8047f89f14940', 'Access-Accept', '2024-12-05 05:21:14.576758', NULL),
(55, 'roihan', '', 'Access-Accept', '2024-12-05 05:22:49.757178', NULL),
(56, 'roihan', '', 'Access-Accept', '2024-12-05 05:23:14.021313', NULL),
(57, 'roihan', '', 'Access-Accept', '2024-12-05 05:23:49.371904', NULL),
(58, 'roi', '', 'Access-Accept', '2024-12-05 05:24:06.253501', NULL),
(59, 'roihan', '', 'Access-Accept', '2024-12-05 05:26:42.488177', NULL),
(60, 'tes', '0x012782963f18531f1c477fdbfbab6d9849', 'Access-Accept', '2024-12-05 05:26:58.842841', NULL),
(61, 'roi', '0x016f6ef4b3cfb5c8e9668e67370a351d40', 'Access-Reject', '2024-12-05 23:41:54.727490', NULL),
(62, 'roihan', '0x015b0653ca3546b6d858e4f8e71cd27472', 'Access-Accept', '2024-12-05 23:42:12.919256', NULL),
(63, 'tes', '0x011013f1732bab8bdbe6e3411ba5d2170f', 'Access-Accept', '2024-12-05 23:53:44.642583', NULL),
(64, 'tes', '0x01e97c7a179fadab61228feef5fc699368', 'Access-Accept', '2024-12-06 01:06:25.561857', NULL),
(65, 'ping', '0x015ed0e192444e01ee98587fbc9c0fd4d6', 'Access-Accept', '2024-12-06 01:07:49.813320', NULL),
(66, 'tes', '0x01c3485d70a1df63665dfead72ab096fb6', 'Access-Accept', '2024-12-09 00:16:42.969322', NULL),
(67, 'roihan', '0x0140502387b8794850b1f0c0a493fa87ba', 'Access-Accept', '2024-12-09 02:26:12.170685', NULL),
(68, 'ping', '0x01102d6a31d9efba44c5b7fadbc0cf0bcd', 'Access-Accept', '2024-12-09 02:26:30.662716', NULL),
(69, 'ping', '0x0107c0f11fe4a55cec0d8deaf44e05c912', 'Access-Accept', '2024-12-09 02:29:20.210246', NULL),
(70, 'roihan', '0x01fe931f0591ccf906feb17898db70a3bd', 'Access-Accept', '2024-12-09 02:30:19.884612', NULL),
(71, 'ping', '0x01efebca8c5d6451d9a10b4d0b36d43d1e', 'Access-Accept', '2024-12-09 03:01:10.001671', NULL),
(72, 'ping', '0x0191e5ec41b19dc87e931b5f5f744d669e', 'Access-Accept', '2024-12-09 03:25:31.446504', NULL),
(73, 'ping', '0x0119cb8c0815d5873fb4c0b6c4c5c6de2d', 'Access-Accept', '2024-12-09 03:41:27.719684', NULL),
(74, 'ping', '0x01de4539df3080d0fbce64ee02ecddad7f', 'Access-Accept', '2024-12-09 03:52:13.100720', NULL),
(75, 'roihan', '0x01179a7095af55e9f0dfc31850a6264ccb', 'Access-Accept', '2024-12-09 04:38:05.408458', NULL),
(76, 'koneksi', '0x01851e6e8b6a130cea87bf65243db780d4', 'Access-Accept', '2024-12-09 04:48:23.691544', NULL),
(77, 'ping', '0x01bc97ec9670a5317ddd5a5588d5fe061b', 'Access-Accept', '2024-12-09 06:21:00.838160', NULL),
(78, 'roihan', '0x014e599aa65f428dc049701ad221d98b58', 'Access-Reject', '2024-12-09 06:22:32.233829', NULL),
(79, 'ping', '0x01117601f52090349843ba37443df8a7db', 'Access-Accept', '2024-12-09 06:22:41.446512', NULL),
(80, 'ping', '0x012acc6a7fe989e351b291dcd1823c9c3d', 'Access-Accept', '2024-12-09 06:23:23.433835', NULL),
(81, 'ping', '0x015b299ae0ba76acdc313dcc4730ce820a', 'Access-Accept', '2024-12-09 06:25:10.379202', NULL),
(82, 'ping', '0x019997a2bb9aa9ef06435ef26f1df4d5d7', 'Access-Accept', '2024-12-09 06:26:08.120072', NULL),
(83, 'ping', '0x014c1742f48771586b1b469b9dbc734aa7', 'Access-Accept', '2024-12-09 06:26:19.413623', NULL),
(84, 'ping', '0x01aa8aa37e9970e648ef1fd7d50546f5ae', 'Access-Accept', '2024-12-09 06:27:09.503251', NULL),
(85, 'ping', '0x01e4ddcf029a0786e89ef94a62e7de7ba4', 'Access-Accept', '2024-12-09 06:51:29.717877', NULL),
(86, 'ping', '0x013b42375d9130e93fa0c14346e8f26cd4', 'Access-Accept', '2024-12-09 06:56:39.219416', NULL),
(87, 'roihan', '0x01f3d8ca8ffea36c06e4b5de25859b8672', 'Access-Accept', '2024-12-09 06:57:15.846454', NULL),
(88, 'ping', '0x01370ff55a2572b39bda207d6f4f5423ac', 'Access-Accept', '2024-12-09 07:01:19.947106', NULL),
(89, 'ping', '0x016c2d88fc39763d613317a4e9aed906b4', 'Access-Accept', '2024-12-09 07:01:52.319339', NULL),
(90, 'tes', '0x013288909c310ff666244cae85e82be21d', 'Access-Accept', '2024-12-09 07:04:39.835842', NULL),
(91, 'ping', '0x01fb6246a6f51a47a06d014fe4781345e4', 'Access-Accept', '2024-12-09 07:07:07.222228', NULL),
(92, 'ping', '0x01635448565b7d488206a44daec570ee4d', 'Access-Accept', '2024-12-09 07:12:34.986079', NULL),
(93, 'ping', '0x016718182a8b3b3ec660cdbc0b86ef41a1', 'Access-Accept', '2024-12-09 07:18:05.119819', NULL),
(94, 'roihan', '0x012aee37753675cce404125f2eb3afdbcb', 'Access-Accept', '2024-12-09 07:18:53.419957', NULL),
(95, 'ping', '0x010504562f33d8faa3f7a0c0d3adba334e', 'Access-Accept', '2024-12-09 07:21:59.087190', NULL),
(96, 'ping', '0x011d14e9563114263dac694ebbd0e690f0', 'Access-Accept', '2024-12-09 07:23:07.184659', NULL),
(97, 'roihan', '0x012c7bda5e2a5d1fb47d57a895e1efbb41', 'Access-Accept', '2024-12-09 07:23:23.981098', NULL),
(98, 'ping', '0x0133c16eb9fefbd8f4df608e4609865e29', 'Access-Accept', '2024-12-09 07:24:16.365084', NULL),
(99, 'ping', '0x0114624637942951851be44f383ee42abc', 'Access-Accept', '2024-12-09 07:30:13.985208', NULL),
(100, 'roihan', '0x01a9496d8b19f49927d97a4f5fd46e5fc3', 'Access-Accept', '2024-12-09 07:33:37.694800', NULL),
(101, 'roihan', '0x01979db9b129fd303c391170ffd8956c62', 'Access-Accept', '2024-12-09 07:35:28.464009', NULL),
(102, 'ping', '0x0113b77f6a186167baed7461116611d48b', 'Access-Accept', '2024-12-09 07:41:49.644689', NULL),
(103, 'ping', '0x0170265e6cc3c5d7fada5c78fe483dd225', 'Access-Accept', '2024-12-09 07:56:42.935148', NULL),
(104, 'roihan', '0x01fa7514d5013855d174dabcd0aafa4755', 'Access-Accept', '2024-12-09 07:59:55.240157', NULL),
(105, 'pp', '0x01a09d296d5f5e2de2691c67e77b00d78f', 'Access-Reject', '2024-12-09 08:01:04.103999', NULL),
(106, 'ping', '0x018d9890b5436fa61b9b502710c3e02c4f', 'Access-Accept', '2024-12-09 08:01:38.173643', NULL),
(107, 'ping', '0x01583719a5b26326f546b85a0350a64e93', 'Access-Accept', '2024-12-09 08:06:03.599890', NULL),
(108, 'ping', '0x01565dab0fbff5312ca85532d200f4d4b1', 'Access-Accept', '2024-12-09 08:10:49.049031', NULL),
(109, 'roihan', '0x01ff46f8c45b863014666beca1760f33a5', 'Access-Reject', '2024-12-09 08:12:19.490191', NULL),
(110, 'ping', '0x0172a65c175347adc34c268fc3c6179e96', 'Access-Accept', '2024-12-09 08:12:30.577643', NULL),
(111, 'ping', '0x01e9fd8c75094a154da0a8dff5cb73b83c', 'Access-Accept', '2024-12-09 08:18:34.028865', NULL),
(112, 'roihan', '0x01700c5b9491be5ffaa1a3baa577c06981', 'Access-Accept', '2024-12-09 08:18:43.939518', NULL),
(113, 'roihan', '0x010c1d767636bbb99e0c1fa6d1c3d6e7e7', 'Access-Accept', '2024-12-09 08:19:04.719374', NULL),
(114, 'roihan', '0x01643999e126ccd33a1c4425d14d7ec31a', 'Access-Accept', '2024-12-09 08:19:24.094376', NULL),
(115, 'roihan', '0x01bc53f2c28e677311f3dbfe6111b49359', 'Access-Accept', '2024-12-09 08:20:20.068605', NULL),
(116, 'koneksi', '0x01f03e34819b35e774cbb61b7394b241a8', 'Access-Accept', '2024-12-09 08:22:56.567450', NULL),
(117, 'koneksi', '0x015149e888c123c17f980cc554dfa025e0', 'Access-Accept', '2024-12-09 08:24:03.755342', NULL),
(118, 'koneksi', '0x01323604c0e70b0f8fa0447ee3c0998652', 'Access-Accept', '2024-12-09 08:24:51.478314', NULL),
(119, 'ping', '0x017b639c41957e74c0c80f622c55e924a2', 'Access-Accept', '2024-12-09 08:32:55.905576', NULL),
(120, 'ping', '0x01376279646447068b71ad0638fed45315', 'Access-Accept', '2024-12-09 08:33:10.455111', NULL),
(121, 'ping', '0x01884a4054b4ebf9ad0f4afc6083b0fca9', 'Access-Accept', '2024-12-09 08:35:28.588372', NULL),
(122, 'ping', '0x01fe4bd0a8be11e1ef7fa8257642062563', 'Access-Accept', '2024-12-09 08:40:24.818392', NULL),
(123, 'ping', '0x01b29c73e735b27348e93ff509902c8c44', 'Access-Accept', '2024-12-09 08:43:45.220183', NULL),
(124, 'ping', '0x01cff6b7f9df2701e7e874a852ebce01a0', 'Access-Reject', '2024-12-09 23:40:53.717101', NULL),
(125, 'ping', '0x01d1c4775e60f5a3c3ee242301346101ba', 'Access-Accept', '2024-12-09 23:41:05.170242', NULL),
(126, 'ping', '0x01a7a5585da4a6c1e6267a8028d3b9490a', 'Access-Accept', '2024-12-09 23:41:53.978403', NULL),
(127, 'ping', '0x01abeb0df030f353ea26798fc841ff7fd4', 'Access-Accept', '2024-12-09 23:42:43.091657', NULL),
(128, 'ping', '0x015b836d86bf3cd87735bcf20e4d17bd77', 'Access-Accept', '2024-12-09 23:43:21.913467', NULL),
(129, 'ping', '0x016d10445b209d11933f036a28f31532ac', 'Access-Accept', '2024-12-10 00:30:20.001794', NULL),
(130, 'ping', '0x01625767cb7df2d01f05f9ae001e8dc3fd', 'Access-Accept', '2024-12-10 00:33:45.574876', NULL),
(131, 'ping', '0x01a31a6b72bd74efdf11d527014ec6cb07', 'Access-Accept', '2024-12-10 00:36:10.092473', NULL),
(132, 'ping', '0x012cc2396c7996436a7de66a3286a61347', 'Access-Accept', '2024-12-10 00:38:25.234298', NULL),
(133, 'ping', '0x0199820cc9df8f78f6af1c4a3ba5f02464', 'Access-Accept', '2024-12-10 00:41:08.191359', NULL),
(134, 'ping', '0x01524b5232ef6ae761f82e7bde5b50fbdc', 'Access-Accept', '2024-12-10 01:07:52.955950', NULL),
(135, 'roihan', '0x01413a6af2fced794ed70967bb9600a423', 'Access-Accept', '2024-12-10 01:14:45.717067', NULL),
(136, 'roihan', '0x01e81bf0e5d56dde44429cbb0528327e99', 'Access-Accept', '2024-12-10 01:22:06.186381', NULL),
(137, 'ping', '0x01ef45eead082396c3101ddf35193c730c', 'Access-Accept', '2024-12-10 01:27:54.894230', NULL),
(138, 'ping', '0x01ae98805d5b6bfd767b033bbe06d30bad', 'Access-Accept', '2024-12-10 01:31:31.162270', NULL),
(139, 'roihan', '0x018847b1dc80345c97ecb7bd3feff924aa', 'Access-Accept', '2024-12-10 01:33:37.716695', NULL),
(140, 'roihan', '0x01b121e89064786df8357e51389c0c286e', 'Access-Accept', '2024-12-10 01:34:10.615522', NULL),
(141, 'ping', '0x014eba4e40b15fa44a76844d5b44049995', 'Access-Accept', '2024-12-10 01:35:24.443374', NULL),
(142, 'ping', '0x01c03dc012ded1355fc94de82ad7d4c024', 'Access-Accept', '2024-12-10 01:37:06.960593', NULL),
(143, 'ping', '0x015862a75bb8c9a328a426bd8c92235634', 'Access-Accept', '2024-12-10 01:38:40.215961', NULL),
(144, 'ping', '0x01de2d4dcbc2bc69bd2ec3d5b37d620982', 'Access-Accept', '2024-12-10 01:39:14.250502', NULL),
(145, 'ping', '0x01f92a9bdc1257e47b5993d70e32fd9cdc', 'Access-Accept', '2024-12-10 01:40:11.115282', NULL),
(146, 'ping', '0x014c29aa78a4d7300fdcfc44ca86ba4c7b', 'Access-Accept', '2024-12-10 01:40:49.679675', NULL),
(147, 'ping', '0x018eba2a789d6a96febb435c59575ae8f2', 'Access-Accept', '2024-12-10 01:42:39.310578', NULL),
(148, 'roihan', '0x01dbcf964d92a7943bbe39b7674350a2a2', 'Access-Accept', '2024-12-10 01:43:34.194900', NULL),
(149, 'ping', '0x013adbdb25a08d2b83f68cd6aea578a7f1', 'Access-Accept', '2024-12-10 01:44:45.490865', NULL),
(150, 'ping', '0x014964c2a54515d3f056c881f5aec7c356', 'Access-Accept', '2024-12-10 01:51:09.887820', NULL),
(151, 'roihan', '0x017e8d89924ef36b24ca77acce5e6cf42b', 'Access-Accept', '2024-12-10 02:03:09.539697', NULL),
(152, 'ping', '0x01e25916fba56d16a1f3bfe685a826efbd', 'Access-Accept', '2024-12-10 02:04:47.659506', NULL),
(153, 'tes', '0x010b5cbc525d382cd1891d181e6f0e03b8', 'Access-Accept', '2024-12-10 02:07:52.113241', NULL),
(154, 'tes', '0x0167b60e4427064c1ba9ec960c327a8880', 'Access-Accept', '2024-12-10 02:11:32.295205', NULL),
(155, 'roihan', '0x010d3144c9b252b8fded9ae2ae267512b5', 'Access-Reject', '2024-12-10 02:15:08.366257', NULL),
(156, 'ping', '0x013aa142a4d05747b25211aeb7fcaa3abb', 'Access-Accept', '2024-12-10 02:15:19.398359', NULL),
(157, 'koneksi', '0x017022880afb271af2160ec18a159f1007', 'Access-Accept', '2024-12-10 02:20:22.785372', NULL),
(158, 'ping', '0x01499635e1c5f4e2b81066f42a04268864', 'Access-Accept', '2024-12-10 02:22:49.490338', NULL),
(159, 'ping', '0x01b57e64c8937ed2fa98b25d1fd1117953', 'Access-Accept', '2024-12-10 02:37:58.523344', NULL),
(160, 'tes', '0x012710b9a7f88edbd204fc803f63dec265', 'Access-Reject', '2024-12-10 02:39:30.608628', NULL),
(161, 'ping', '0x01f4405fadd866bafad34b0bef9ac4672c', 'Access-Accept', '2024-12-10 02:39:39.683487', NULL),
(162, 'ping', '0x01a893a7eb67c30f0e6b616d7af4d329a6', 'Access-Accept', '2024-12-10 02:50:03.823964', NULL),
(163, 'roihan', '0x01c9b827570fa3fd39160a21f52d858bfd', 'Access-Accept', '2024-12-10 02:52:21.564756', NULL),
(164, 'roihan', '0x01dcc2dbdf891a0ceb144d38aba6874ac0', 'Access-Accept', '2024-12-10 02:57:08.457675', NULL),
(165, 'ping', '0x0135542e89ab20fa1257e81f90456a95f7', 'Access-Accept', '2024-12-10 02:59:04.063343', NULL),
(166, 'ping', '0x01538e828dbdcfbc7f513a1c40d8a5dd51', 'Access-Accept', '2024-12-10 03:04:20.739606', NULL),
(167, 'roihan', '0x012865fd1fc3ea64a788e8c528f49386b4', 'Access-Accept', '2024-12-10 03:28:26.538961', NULL),
(168, 'ping', '0x01c340549cbafa21fef1c3047e91759fc7', 'Access-Accept', '2024-12-10 04:29:50.517806', NULL),
(169, 'ping', '0x01bd6149874db4133120d1e370e751451d', 'Access-Accept', '2024-12-10 04:31:51.722524', NULL),
(170, 'ping', '0x011e9492f6aea418176ee454b50684cb71', 'Access-Accept', '2024-12-10 04:33:50.004472', NULL),
(171, 'ping', '0x01bf3590237f5b64659a8842c5366dc781', 'Access-Accept', '2024-12-10 04:38:43.015096', NULL),
(172, 'ping', '0x01d6adedfe21d2c15fa490b13a372efb8c', 'Access-Accept', '2024-12-10 04:39:45.772528', NULL),
(173, 'ping', '0x01800561438f50b5568d690a5bffc35b72', 'Access-Accept', '2024-12-10 04:40:08.208731', NULL),
(174, 'ping', '0x01042e06519dabac71b50c21e340adb952', 'Access-Accept', '2024-12-10 04:42:24.137922', NULL),
(175, 'ping', '0x0129688148fa9aaa741e6ae68440599945', 'Access-Accept', '2024-12-10 04:45:23.424570', NULL),
(176, 'roihan', '0x019fdde26fdb920165d34370228bdd2469', 'Access-Accept', '2024-12-10 04:46:09.058802', NULL),
(177, 'ping', '0x0109efd0f5fd765959cc69aa9c52ddfa65', 'Access-Accept', '2024-12-10 04:48:05.929380', NULL),
(178, 'roihan', '0x01fec513a40864d151c94c2fe78f35f562', 'Access-Accept', '2024-12-10 04:50:58.985651', NULL),
(179, 'ping', '0x0104397425e13d0f612ee9f0aec8a764e1', 'Access-Accept', '2024-12-10 04:54:20.322477', NULL),
(180, 'roihan', '0x01b6c20c8adce885c2103e20b4312c5b02', 'Access-Accept', '2024-12-10 04:55:16.348685', NULL),
(181, 'ping', '0x01f37b7c842f0a11b06aece1ad2fa1f24f', 'Access-Accept', '2024-12-10 04:56:26.861120', NULL),
(182, 'ping', '0x01d1e80e256e5d7904666ffa22338acde9', 'Access-Accept', '2024-12-10 04:57:23.375742', NULL),
(183, 'roihan', '0x019f62b444f82160a6dace44bbfe39d37d', 'Access-Accept', '2024-12-10 04:57:46.129436', NULL),
(184, 'roihan', '0x012018337a976e85cda8fe5ef38764d312', 'Access-Accept', '2024-12-10 05:00:01.711196', NULL),
(185, 'ping', '0x01f6cae12317f50a1082e83b1f3a0637d5', 'Access-Accept', '2024-12-10 05:19:43.635411', NULL),
(186, 'ping', '0x0132c9fd3ba6fe76bcee0f5460b3e9bb9f', 'Access-Accept', '2024-12-10 05:23:59.752065', NULL),
(187, 'ping', '0x01e73a9b0de683f251bd7bd513d7105736', 'Access-Accept', '2024-12-10 05:25:39.419980', NULL),
(188, 'roihan', '0x01b9aa015149650f64279a326a9a3302d4', 'Access-Accept', '2024-12-10 05:25:48.529181', NULL),
(189, 'roihan', '0x019f6a4ce08dac01d25c27560b8380e419', 'Access-Accept', '2024-12-10 05:26:03.968279', NULL),
(190, 'ping', '0x01b75e0a7a3e1e4b325b7cfc325bfedded', 'Access-Accept', '2024-12-10 05:47:15.619412', NULL),
(191, 'roihan', '0x0175a3d9c7904faac2bdc61a2454133b27', 'Access-Accept', '2024-12-10 05:48:22.604797', NULL),
(192, 'roihan', '0x0171aac19e966049012845c2395b947455', 'Access-Accept', '2024-12-10 06:21:57.665992', NULL),
(193, 'ping', '0x0195859667924c8f415889f89f342f0117', 'Access-Accept', '2024-12-10 06:25:56.846004', NULL),
(194, 'ping', '0x01f6b535da6444b500777fd6a60b13d18b', 'Access-Accept', '2024-12-10 06:27:39.142069', NULL),
(195, 'roihan', '0x01db7aaad190563d8b51b92f20c79c1620', 'Access-Accept', '2024-12-10 06:28:41.100691', NULL),
(196, 'ping', '0x01c2b262299152b21e9c82b9868a2f6e58', 'Access-Accept', '2024-12-10 06:33:46.718173', NULL),
(197, 'ping', '0x0190ce27ae1399a1088b2d1c8c2a9f628b', 'Access-Accept', '2024-12-10 06:35:32.502032', NULL),
(198, 'ping', '0x01b3fcddc850da3a4c933f36722e548b5e', 'Access-Accept', '2024-12-10 06:35:48.917720', NULL),
(199, 'ping', '0x01759a3328cb605194efb94dbc19ed3f4f', 'Access-Accept', '2024-12-10 06:48:52.349799', NULL),
(200, 'roihan', '0x01d597e350cdb06592c124e357a562deaf', 'Access-Accept', '2024-12-10 06:49:57.850229', NULL),
(201, 'ping', '0x016b86cde534dc6aa91f4c9bdc0019cb2c', 'Access-Accept', '2024-12-10 06:51:50.759818', NULL),
(202, 'ping', '0x01a77170a11ff285e5f8d2f46da58d1425', 'Access-Accept', '2024-12-10 06:59:37.100199', NULL),
(203, 'ping', '0x011808179a26bea18f5418ee357d0c9ba2', 'Access-Accept', '2024-12-10 07:01:14.094242', NULL),
(204, 'ping', '0x01892c9c6e6b831471f819e7776846b91f', 'Access-Accept', '2024-12-10 07:03:22.013932', NULL),
(205, 'roihan', '0x01994df1ae02cedef2fd2a8683c142fc81', 'Access-Accept', '2024-12-10 07:06:06.341013', NULL),
(206, 'ping', '0x01fa2976eac69fdf6ff539c50d3e409d7c', 'Access-Accept', '2024-12-10 07:09:21.713702', NULL),
(207, 'roihan', '0x01cde2e708d1d33f7121d75a08930cbe60', 'Access-Accept', '2024-12-10 07:10:27.894699', NULL),
(208, 'ping', '0x01730a54dfb0ea6c26fb5039bf2070e156', 'Access-Accept', '2024-12-10 07:16:27.335221', NULL),
(209, 'roihan', '0x01b527fe560ed874c3811e4069e0bf0d40', 'Access-Accept', '2024-12-10 07:16:36.873245', NULL),
(210, 'roihan', '0x01d6d75b7112dbf568a2b71223e4a186a6', 'Access-Accept', '2024-12-10 07:17:04.891452', NULL),
(211, 'roihan', '0x01fd5c79c712e276fa12ab17b4d6d9cdbc', 'Access-Accept', '2024-12-10 07:24:15.868480', NULL),
(212, 'ping', '0x014a0027d90edd2e3fe821517ca18b66e6', 'Access-Accept', '2024-12-10 07:25:30.158914', NULL),
(213, 'ping', '0x017e0fc8041f3d640c413b11f096f465a9', 'Access-Accept', '2024-12-10 07:27:07.505091', NULL),
(214, 'ping', '0x01a18e669f84d8330a104e16f5e9fd769e', 'Access-Accept', '2024-12-10 07:30:11.021693', NULL),
(215, 'ping', '0x01795a905abf427c403782e2df1e92a17a', 'Access-Accept', '2024-12-10 07:31:29.382832', NULL),
(216, 'ping', '0x013bc921bbe6491085a1fcbbe82015cabd', 'Access-Accept', '2024-12-10 07:37:48.226067', NULL),
(217, 'roihan', '0x0182bbf559cebf0ab4170ef643398b2f52', 'Access-Accept', '2024-12-10 07:38:09.372746', NULL),
(218, 'ping', '0x01596cd31225cf17412ae99735f8148cda', 'Access-Reject', '2024-12-10 07:39:14.070614', NULL),
(219, 'ping', '0x010ea7f3e49a784d9175a34e2822033a6f', 'Access-Accept', '2024-12-10 07:39:19.225308', NULL),
(220, 'ping', '0x019be4b14877214b4cb7d61ff6f58e2252', 'Access-Accept', '2024-12-10 07:40:36.301319', NULL),
(221, 'roihan', '0x0138ea6700bc026b67f2c994f35fd0a449', 'Access-Accept', '2024-12-10 07:41:52.977725', NULL),
(222, 'ping', '0x01225e1591fe6a986e4a891e665606f10e', 'Access-Accept', '2024-12-10 07:49:59.852799', NULL),
(223, 'ping', '0x0142cc10d34da99457b8441e95e46b3c23', 'Access-Accept', '2024-12-10 07:50:53.735597', NULL),
(224, 'ping', '0x0157a6e36c41842324d23032c6e8cf77c9', 'Access-Accept', '2024-12-10 07:55:29.959149', NULL),
(225, 'ping', '0x0102938ccdad46a9b1345a0290a5c9d6c1', 'Access-Accept', '2024-12-10 08:00:42.642317', NULL),
(226, 'ping', '0x019dc5528895773ce6626fab6e1746598f', 'Access-Accept', '2024-12-10 08:08:12.170574', NULL),
(227, 'ping', '0x01a8289303c0753362c76a9710adc86e11', 'Access-Accept', '2024-12-10 08:13:37.343284', NULL),
(228, 'ping', '0x0121ebaae8b10070171c04f3f9681d6b74', 'Access-Accept', '2024-12-10 08:40:37.162674', NULL),
(229, 'ping', '0x01274bcf47b3f346a4f472e1c97fee9aaa', 'Access-Accept', '2024-12-10 08:41:39.538572', NULL),
(230, 'ping', '0x0141107be68ecd63e4dc7cf50f984b8e71', 'Access-Accept', '2024-12-10 08:44:44.866449', NULL),
(231, 'roihan', '0x01cd3d71c630d93b15c018bcd0a399c234', 'Access-Reject', '2024-12-10 23:44:32.211880', NULL),
(232, 'ping', '0x01e2bdb5176e3e4c0b5907467027186234', 'Access-Accept', '2024-12-10 23:44:44.218269', NULL),
(233, 'ping', '0x0119738a2bed19278f0f227cbe5dd008fd', 'Access-Accept', '2024-12-11 00:31:15.417438', NULL),
(234, 'ping', '0x013edaaf2b0246ab7cef7923a46c64c34a', 'Access-Accept', '2024-12-11 00:31:39.984027', NULL),
(235, 'ping', '0x01396fd630afbf1ece66653993dd8a737c', 'Access-Accept', '2024-12-11 00:33:28.715520', NULL),
(236, 'ping', '0x01199cf5356e6c54790de2b156d0e2375a', 'Access-Accept', '2024-12-11 00:36:52.139929', NULL),
(237, 'roihan', '0x01419995f49ffc1d90f47e7d3363694ea0', 'Access-Accept', '2024-12-11 00:39:18.021526', NULL),
(238, 'ping', '0x018be375f5d4f0a460cb7f6de741502be6', 'Access-Accept', '2024-12-11 00:40:14.215649', NULL),
(239, 'ping', '0x019b7a3eaecb5b2d46163276bf454c219f', 'Access-Accept', '2024-12-11 00:46:17.417179', NULL),
(240, 'ping', '0x018043b4744789c2a24bf9c7eeb8566aa6', 'Access-Accept', '2024-12-11 00:49:17.931872', NULL),
(241, 'ping', '0x0128f79b16524db754730af78b3ea0638d', 'Access-Accept', '2024-12-11 00:55:21.437671', NULL),
(242, 'ping', '0x01d792926f9d1195d7b815c839ee8cca43', 'Access-Accept', '2024-12-11 01:11:50.989244', NULL),
(243, 'roihan', '0x01d6ca062c8e589ac44015d97d70ec5de5', 'Access-Accept', '2024-12-11 01:12:52.918517', NULL),
(244, 'ping', '0x0129d9ddd2ed2ed6c8ff60e8c4d0eadf28', 'Access-Accept', '2024-12-11 01:13:34.393140', NULL),
(245, 'ping', '0x0102f4f5ba94ac63f8ff84d0f3ac8e59b1', 'Access-Accept', '2024-12-11 01:16:44.250371', NULL),
(246, 'ping', '0x016cc10490b767bc8fa989a2e2a8f67c81', 'Access-Accept', '2024-12-11 01:24:03.013209', NULL),
(247, 'ping', '0x010834ed8f3e0289380e76fade7e5b6b0d', 'Access-Accept', '2024-12-11 01:26:41.176497', NULL),
(248, 'ping', '0x013e12b9faca4fd48387b7818a1ed0cbdb', 'Access-Accept', '2024-12-11 01:27:41.653353', NULL),
(249, 'ping', '0x010d0b49fd406ece197a16ae4f3ec0f28a', 'Access-Accept', '2024-12-11 01:33:34.379858', NULL),
(250, 'ping', '0x0119e6e43addc0f41ca32229c63be96fff', 'Access-Accept', '2024-12-11 01:34:06.277433', NULL),
(251, 'ping', '0x01cdb04556afbab897efccad5531a489dd', 'Access-Accept', '2024-12-11 01:38:30.640478', NULL),
(252, 'roihan', '0x0185fedfaadebf9bf1d47ddf4575307186', 'Access-Accept', '2024-12-11 01:42:29.039748', NULL),
(253, 'ping', '0x01c4914a84d0da39e8bc9e626dfb63f244', 'Access-Accept', '2024-12-11 01:44:12.424024', NULL),
(254, 'ping', '0x01920d45666d3b7dbfce852dbaa530b3a4', 'Access-Accept', '2024-12-11 01:56:52.235887', NULL),
(255, 'roihan', '0x01454648887af787ca5cdf2ee32ac57962', 'Access-Accept', '2024-12-11 01:59:36.421137', NULL),
(256, 'ping', '0x0187542736f1e87f7c7d57b1d12ea13639', 'Access-Accept', '2024-12-11 02:00:07.474219', NULL),
(257, 'roihan', '0x0160ec08534b30417b25487631e772b209', 'Access-Accept', '2024-12-11 02:02:06.324154', NULL),
(258, 'ping', '0x0110e464644d0cbc1ae47de86ec389b3a6', 'Access-Accept', '2024-12-11 02:04:12.113042', NULL),
(259, 'ping', '0x01934752955cd6a28664da7741ace6a188', 'Access-Accept', '2024-12-11 02:09:53.874313', NULL),
(260, 'roihan', '0x01f70644dfcb11678b4e19f3b8525e3ac9', 'Access-Accept', '2024-12-11 02:11:02.282292', NULL),
(261, 'ping', '0x01b44c23c6184c5f9a6deec97521c9b8bb', 'Access-Accept', '2024-12-11 02:15:54.306306', NULL),
(262, 'roihan', '0x01578024a53fec6ca5bb9bc3c0a306670f', 'Access-Accept', '2024-12-11 02:19:13.696282', NULL),
(263, 'roihan', '0x01767a053e4dbd7bc22c48ef34f8f9dfca', 'Access-Accept', '2024-12-11 02:19:41.681293', NULL),
(264, 'roihan', '0x018df010ed39cdb244dbd4b1a134904424', 'Access-Accept', '2024-12-11 02:23:50.849384', NULL),
(265, 'roihan', '0x018099eea9f8168aa2bda2254fb5066af0', 'Access-Accept', '2024-12-11 02:27:16.236458', NULL),
(266, 'ping', '0x0136ab7386259a424513dd993caecce7fa', 'Access-Accept', '2024-12-11 02:28:33.310063', NULL),
(267, 'ikhsan', '0x013afbe45c03cb9481be67707a3c1be55e', 'Access-Accept', '2024-12-11 02:32:24.705470', NULL),
(268, 'admin', '0x01416d2ccdb6244c911d1b8048de7aa799', 'Access-Accept', '2024-12-11 08:05:26.900161', NULL),
(269, 'admin', '0x01e7b48e804c077529b1ca69e60e36faa9', 'Access-Accept', '2024-12-11 08:05:53.502012', NULL),
(270, 'ping', '0x0178d2530befbd12a5d4fd80140ef00ef2', 'Access-Accept', '2024-12-11 08:40:04.874801', NULL),
(271, 'koneksi', '0x01bb68651af6c6dc1961bc95ec1c1efa5a', 'Access-Reject', '2024-12-12 06:27:21.282312', NULL),
(272, 'ikhsan', '0x019b5ab5404c3979dca770566cd17f90fe', 'Access-Accept', '2024-12-12 06:27:34.068055', NULL),
(273, 'testes', '0x010f6a525ed96d8490f31f87889e236c11', 'Access-Reject', '2024-12-17 03:14:27.317487', NULL),
(274, 'tes6', '0x01e6855a49099f3ce0ababaaf235c468e0', 'Access-Accept', '2024-12-17 03:14:45.755712', NULL),
(275, '7tes', '0x018cd66aa3bb902869165d41e69b2607ce', 'Access-Accept', '2024-12-17 03:15:23.760730', NULL),
(276, 'admin', '0x014097a22af39c9402ba93bbff583ce36e', 'Access-Accept', '2024-12-17 04:27:00.193537', NULL),
(277, 'tes6', '0x019a7b9827c9c7bcf86662022bdf30cb3e', 'Access-Accept', '2024-12-17 04:27:23.075282', NULL),
(278, 'testes', '0x01152fbf64cd2105c58177718f64de7f1d', 'Access-Accept', '2024-12-17 04:27:39.213156', NULL),
(279, '19baru', '0x01afee42dea7da98638f100ca591abd6c1', 'Access-Reject', '2024-12-19 01:25:12.384846', NULL),
(280, '19baru', '0x0117135b598118e4c5c182a77b2e778adb', 'Access-Accept', '2024-12-19 01:25:31.439893', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `radreply`
--

CREATE TABLE `radreply` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radusergroup`
--

CREATE TABLE `radusergroup` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radusergroup`
--

INSERT INTO `radusergroup` (`id`, `username`, `groupname`, `priority`) VALUES
(1, 'roi', 'pppoe_group', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nas`
--
ALTER TABLE `nas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nasname` (`nasname`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `radacct`
--
ALTER TABLE `radacct`
  ADD PRIMARY KEY (`radacctid`),
  ADD UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  ADD KEY `username` (`username`),
  ADD KEY `framedipaddress` (`framedipaddress`),
  ADD KEY `framedipv6address` (`framedipv6address`),
  ADD KEY `framedipv6prefix` (`framedipv6prefix`),
  ADD KEY `framedinterfaceid` (`framedinterfaceid`),
  ADD KEY `delegatedipv6prefix` (`delegatedipv6prefix`),
  ADD KEY `acctsessionid` (`acctsessionid`),
  ADD KEY `acctsessiontime` (`acctsessiontime`),
  ADD KEY `acctstarttime` (`acctstarttime`),
  ADD KEY `acctinterval` (`acctinterval`),
  ADD KEY `acctstoptime` (`acctstoptime`),
  ADD KEY `nasipaddress` (`nasipaddress`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Indexes for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Indexes for table `radpostauth`
--
ALTER TABLE `radpostauth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `radreply`
--
ALTER TABLE `radreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `radusergroup`
--
ALTER TABLE `radusergroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nas`
--
ALTER TABLE `nas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radacct`
--
ALTER TABLE `radacct`
  MODIFY `radacctid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radpostauth`
--
ALTER TABLE `radpostauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `radreply`
--
ALTER TABLE `radreply`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radusergroup`
--
ALTER TABLE `radusergroup`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
