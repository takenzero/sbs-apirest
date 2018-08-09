-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2018 at 12:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mlmproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_auth`
--

CREATE TABLE `tb_auth` (
  `seq_id` int(11) NOT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  `id_user` varchar(10) NOT NULL,
  `token_code` varchar(32) NOT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `device_id` varchar(30) DEFAULT NULL,
  `token_exp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `uuid` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` varchar(10) NOT NULL,
  `token_code` varchar(30) NOT NULL,
  `activity` varchar(30) NOT NULL,
  `status_code` int(11) NOT NULL,
  `status_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`uuid`, `creation_date`, `id_user`, `token_code`, `activity`, `status_code`, `status_description`) VALUES
('0e01df2d-2277-4eb6-b652-aba870878308', '2018-07-26 19:07:14', 'admin', '119ba7556cddb1b', 'Login', 200, 'SUCCESS'),
('1094d444-942c-4329-81a6-c93269bc90c9', '2018-07-28 18:51:59', 'admin', '2863b581719e60e', 'Logout', 200, 'SUCCESS'),
('16efcc0e-be16-48fc-8947-3895aa6fb978', '2018-07-28 22:35:19', 'admin', '8ffc80b54175c08', 'Login', 200, 'SUCCESS'),
('4cf8c933-096a-43be-9ef5-b2124b589987', '2018-07-28 22:30:33', 'admin', 'b277d4b4311ff79f65a20929bfba09', 'Login', 401, 'UNAUTHORIZED'),
('5eed0c87-d487-431e-bd13-9892bb5569bd', '2018-07-28 22:20:37', 'admin', 'd7bd6b35b91fd9a', 'Logout', 200, 'SUCCESS'),
('6263d359-ac20-4531-92ab-975b5fdf1f51', '2018-07-28 18:54:06', 'admin', '2863b581719e60e', 'Logout', 200, 'SUCCESS'),
('72792d3e-a418-4dc9-9ad0-1d87fb65b23c', '2018-07-28 22:21:36', 'admin', 'd7bd6b35b91fd9a', 'Logout', 200, 'SUCCESS'),
('79467b42-e9cb-467a-9c0d-331eddde148c', '2018-07-26 18:42:27', 'admin', 'bae83dfc9d4f12a', 'Login', 200, 'SUCCESS'),
('7d18ddfe-6822-4a36-bace-be43155edf7c', '2018-07-26 18:37:07', 'admin', 'd74ce40c6111034', 'Login', 200, 'SUCCESS'),
('7f4ae4e4-091d-400d-bdc4-9e0e0556524e', '2018-07-28 22:42:20', 'admin', 'd4b244c7a53dd67', 'Login', 200, 'SUCCESS'),
('841a378f-79b8-43b4-9c85-af66bb7cea83', '2018-07-28 21:47:19', 'admin', '5500427aafcab41', 'Login', 200, 'SUCCESS'),
('9086d6f2-6d75-4cde-bfe3-f2fef840b588', '2018-07-28 21:49:35', 'admin', '3c01fe372415216', 'Logout', 200, 'SUCCESS'),
('932ff1b6-9111-450b-b713-5fb716664021', '2018-07-28 21:49:09', 'admin', '3c01fe372415216', 'Login', 200, 'SUCCESS'),
('94703a13-4bf3-4987-ad25-c0b0d41a4b8a', '2018-07-28 22:43:01', 'admin', 'd4b244c7a53dd67', 'Logout', 200, 'SUCCESS'),
('96f0c20b-b365-4e2f-bc47-7b12dd3c6434', '2018-07-28 18:01:04', 'admin', '634fc3c02f898dd', 'Login', 200, 'SUCCESS'),
('ad6fa6f3-3e80-4eb1-aa07-fe34ea592f3d', '2018-07-28 22:40:39', 'admin', '26384375887dee1', 'Login', 200, 'SUCCESS'),
('b1a3d990-6699-4213-9952-51eff4ffcc2c', '2018-07-28 22:41:52', 'admin', '26384375887dee1', 'Logout', 200, 'SUCCESS'),
('b6797907-ba0d-4eb1-818e-8e1a28a86298', '2018-07-28 22:21:54', 'admin', 'a943e849dfdd019', 'Logout', 200, 'SUCCESS'),
('c02458e8-52b6-49ae-afe3-e8105fec8933', '2018-07-28 22:35:25', 'admin', '8ffc80b54175c08', 'Logout', 200, 'SUCCESS'),
('c0e362df-3a8e-4447-9b31-9bf150c681ae', '2018-07-28 22:32:32', 'admin', 'eedf6e59ee67d59', 'Login', 200, 'SUCCESS'),
('c19c0b3b-1078-4de4-b884-21203f499dcd', '2018-07-26 18:40:35', 'admin1', 'POST', 'Login', 204, 'USER_NOT_FOUND'),
('c6b60130-83f6-412d-99f5-bd4d8a6faf67', '2018-07-28 22:20:15', 'admin', 'd7bd6b35b91fd9a', 'Login', 200, 'SUCCESS'),
('cef2044d-38e6-4b3a-84da-0e88c125f9c5', '2018-07-28 22:21:44', 'admin', 'a943e849dfdd019', 'Login', 200, 'SUCCESS'),
('d8f120e4-9388-483d-9a65-184a56e03edf', '2018-07-26 19:06:28', 'admin', 'POST', 'Login', 204, 'WRONG_PASSWORD'),
('e7fe4488-8613-4d19-a20f-09bbbf11af96', '2018-07-28 22:32:44', 'admin', 'eedf6e59ee67d59', 'Logout', 200, 'SUCCESS'),
('f3e2d8ee-34d8-46aa-b08e-9288fc81c4ca', '2018-07-26 18:39:39', 'admin', 'POST', 'Login', 204, 'WRONG_PASSWORD'),
('ff9f9947-3d50-4083-8ea3-5e34091634c9', '2018-07-28 18:38:28', 'admin', '2863b581719e60e', 'Login', 200, 'SUCCESS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sharedvar`
--

CREATE TABLE `tb_sharedvar` (
  `id` int(11) NOT NULL,
  `group` varchar(15) NOT NULL,
  `name` varchar(15) NOT NULL,
  `value` varchar(50) NOT NULL,
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sharedvar`
--

INSERT INTO `tb_sharedvar` (`id`, `group`, `name`, `value`, `creation_date`) VALUES
(1, 'header_rq', 'client_service', 'frontend-client', '2018-07-26 11:07:16'),
(2, 'header_rq', 'auth_key', 'b277d4b4311ff79f65a20929bfba09d5', '2018-07-26 11:07:44'),
(3, 'app_config', 'check_token_exp', 'FALSE', '2018-07-28 19:56:34'),
(4, 'app_config', 'token_duration', '+24 hours', '2018-07-28 22:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_type` varchar(10) DEFAULT 'KTP',
  `id_number` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `level_code` int(11) NOT NULL DEFAULT '1',
  `id_upline` varchar(10) NOT NULL DEFAULT 'TOP',
  `password` varchar(64) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `name`, `id_type`, `id_number`, `phone`, `level_code`, `id_upline`, `password`, `creation_date`) VALUES
('admin', 'Muhammad Tahir Lahadi', 'KTP', '7371141809910003', '081807946651', 1, 'TOP', '7fe0e0a4d1ea6b823f59e6b1a6f1c77c', '2018-07-26 13:17:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`seq_id`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `tb_sharedvar`
--
ALTER TABLE `tb_sharedvar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_auth`
--
ALTER TABLE `tb_auth`
  MODIFY `seq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sharedvar`
--
ALTER TABLE `tb_sharedvar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
