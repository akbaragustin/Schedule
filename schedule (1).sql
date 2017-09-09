-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2017 at 06:48 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `invite_jabatan`
--

CREATE TABLE `invite_jabatan` (
  `id_invite_jabatan` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_rapat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invite_jabatan`
--

INSERT INTO `invite_jabatan` (`id_invite_jabatan`, `id_jabatan`, `id_rapat`) VALUES
(8, 14, 31),
(11, 14, 33),
(12, 14, 34),
(17, 15, 39),
(18, 14, 40),
(20, 18, 41),
(21, 18, 42),
(23, 18, 43);

-- --------------------------------------------------------

--
-- Table structure for table `invite_name`
--

CREATE TABLE `invite_name` (
  `id_invite_name` int(11) NOT NULL,
  `id_rapat` int(11) DEFAULT NULL,
  `disposisi_rapat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invite_name`
--

INSERT INTO `invite_name` (`id_invite_name`, `id_rapat`, `disposisi_rapat`) VALUES
(21, 31, 'Fathiya'),
(22, 31, 'Tazkia'),
(23, 31, 'kuda'),
(28, 33, 'asdasdasd'),
(29, 33, 'asdasdasds'),
(30, 34, 'asdsd'),
(31, 34, 'asdasdas'),
(32, 40, 'kutu'),
(33, 40, 'kuman'),
(34, 40, 'kuda'),
(38, 41, 'kutu'),
(39, 41, 'kuman'),
(40, 42, 'asdasdasd'),
(41, 42, 'asdasdasdasdasd'),
(42, 42, 'asdasdasdsdsdsdsds'),
(45, 43, 'kkkk'),
(46, 43, 'jjjj'),
(47, 43, 'kkk4');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `name_jabatan` varchar(15) DEFAULT NULL,
  `label_color` varchar(50) DEFAULT NULL,
  `status_jabatan` int(11) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `name_jabatan`, `label_color`, `status_jabatan`, `creator`, `created`, `editor`, `edited`) VALUES
(11, 'Supar Admin', 'label-default', 1, '1', '2017-08-13', '1', '2017-08-20 15:18:52'),
(13, 'Admin', 'label-primary', 1, '1', '2017-08-13', '1', '2017-08-20 15:18:56'),
(14, 'Kapus', 'label-success', 2, '1', '2017-08-17', NULL, '2017-08-20 15:18:59'),
(15, 'Eselon', 'label-info', 2, '1', '2017-08-17', NULL, '2017-08-20 15:19:01'),
(17, 'User', NULL, 2, '1', '2017-09-01', NULL, NULL),
(18, 'Internal', NULL, 2, '1', '2017-09-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_unit_kerja`
--

CREATE TABLE `master_unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `name_unit_kerja` varchar(70) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_unit_kerja`
--

INSERT INTO `master_unit_kerja` (`id_unit_kerja`, `name_unit_kerja`, `created`, `creator`, `edited`, `editor`) VALUES
(2, 'karyawan', '2017-09-02 17:17:02', '1', NULL, NULL),
(3, 'TIBA', '2017-09-02 17:19:01', '1', '2017-09-02 17:20:35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE `menu_admin` (
  `id_menu` int(10) NOT NULL,
  `level_menu` smallint(6) NOT NULL,
  `parent_menu` int(10) NOT NULL,
  `posisition_menu` tinyint(4) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `name_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(100) DEFAULT NULL,
  `edited` timestamp NULL DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`id_menu`, `level_menu`, `parent_menu`, `posisition_menu`, `url_menu`, `name_menu`, `icon_menu`, `created`, `creator`, `edited`, `editor`) VALUES
(268, 0, 0, 0, '/', 'Config', 'book', '2017-08-17 16:19:15', NULL, NULL, NULL),
(269, 0, 268, 0, 'admin/config/menu', 'Menu', 'menu', '2017-08-17 16:20:12', NULL, NULL, NULL),
(270, 0, 268, 0, 'admin/config/role', 'Role', 'dehaze', '2017-08-17 16:21:49', NULL, NULL, NULL),
(271, 0, 0, 0, '/', 'Forms', 'border_color', '2017-08-17 16:24:04', NULL, NULL, NULL),
(272, 0, 271, 0, 'admin/users', 'Users', 'account_box', '2017-08-17 16:28:54', NULL, NULL, NULL),
(273, 0, 271, 0, 'admin/ruangan', 'Ruangan', 'home', '2017-08-17 16:29:40', NULL, NULL, NULL),
(274, 0, 271, 0, 'admin/jabatan', 'Jabatan', 'assignment_turned_in', '2017-08-17 16:30:46', NULL, NULL, NULL),
(275, 0, 0, 0, 'admin', 'Calender', 'web', '2017-08-17 16:32:00', NULL, NULL, NULL),
(277, 0, 271, 0, 'admin/kapus', 'Kapus', 'description', '2017-08-21 14:39:57', NULL, NULL, NULL),
(278, 0, 271, 0, 'admin/eselon', 'Eselon', 'assignment_returned', '2017-08-21 14:41:34', NULL, NULL, NULL),
(280, 0, 271, 0, 'admin/unit_kerja', 'Unit Kerja', 'group_work', '2017-09-01 05:38:40', NULL, NULL, NULL),
(281, 0, 271, 0, 'admin/users_eselon', 'Users Eselon', 'assignment_ind', '2017-09-02 17:48:35', NULL, NULL, NULL),
(282, 0, 271, 0, 'admin/rapat', 'Internal', 'assignment', '2017-09-03 18:04:51', NULL, NULL, NULL),
(284, 0, 271, 0, 'admin/booking_internal', 'Booking Internal', 'book', '2017-09-03 19:08:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `kd_role` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`kd_role`, `id_jabatan`, `id_menu`) VALUES
(4116, 11, 268),
(4117, 11, 269),
(4118, 11, 270),
(4119, 11, 271),
(4120, 11, 272),
(4121, 11, 273),
(4122, 11, 274),
(4123, 11, 277),
(4124, 11, 278),
(4125, 11, 280),
(4126, 11, 281),
(4127, 11, 282),
(4128, 11, 284),
(4129, 11, 275);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `name_ruangan` varchar(50) DEFAULT NULL,
  `max_ruangan` int(10) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `editor` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `name_ruangan`, `max_ruangan`, `creator`, `created`, `editor`, `edited`) VALUES
(1, 'r.10', 45, '1', '2017-08-20 07:25:52', NULL, NULL),
(2, 'r.11', 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `id_rapat` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_rapat`, `id_user`) VALUES
(1, 35, 7),
(2, 35, 8),
(3, 36, 7),
(4, 37, 8),
(6, 39, 7),
(7, 39, 8);

-- --------------------------------------------------------

--
-- Table structure for table `t_rapat`
--

CREATE TABLE `t_rapat` (
  `id_rapat` int(11) NOT NULL,
  `start_tgl_rapat` datetime DEFAULT NULL,
  `end_tgl_rapat` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_ruangan` int(11) DEFAULT NULL,
  `agenda_rapat` varchar(200) DEFAULT NULL,
  `pj_rapat` varchar(50) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `editor` varchar(50) DEFAULT NULL,
  `edited` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status_ruangan_rapat` enum('external','internal') DEFAULT NULL,
  `tempat_rapat` varchar(100) DEFAULT NULL,
  `infant_rapat` varchar(255) DEFAULT NULL,
  `status_active_rapat` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_rapat`
--

INSERT INTO `t_rapat` (`id_rapat`, `start_tgl_rapat`, `end_tgl_rapat`, `id_ruangan`, `agenda_rapat`, `pj_rapat`, `creator`, `created`, `editor`, `edited`, `status_ruangan_rapat`, `tempat_rapat`, `infant_rapat`, `status_active_rapat`) VALUES
(31, '2017-08-22 02:02:00', '2017-09-04 00:25:04', 2, 'TEST KAPUS', NULL, NULL, '2017-09-04 00:25:04', NULL, '2017-09-04 00:25:04', 'internal', NULL, 'asdasd', ''),
(33, '2017-09-03 12:00:00', '2017-09-04 00:25:37', 2, '555555', 'irma', NULL, '2017-09-04 00:25:37', NULL, '2017-09-04 00:25:37', 'internal', NULL, 'asdasd', '1'),
(34, '2017-09-04 12:00:00', '2017-09-04 12:19:00', 2, 'adasdasd', 'asd', NULL, NULL, NULL, NULL, 'internal', NULL, 'asdsa', '1'),
(35, '2017-09-04 12:00:00', '2017-09-04 12:19:00', 1, 'Rpat', NULL, NULL, NULL, NULL, NULL, 'internal', NULL, 'asdasd', '1'),
(36, '2017-09-04 12:00:00', '2017-09-04 01:00:00', 1, 'asdasd', NULL, NULL, NULL, NULL, NULL, 'external', 'asdasd', 'asdasdasd', '1'),
(37, '2017-09-04 12:00:00', '2017-09-04 12:19:00', 1, 'asdas', NULL, NULL, NULL, NULL, NULL, 'external', 'sadas', 'asdasdasd', '1'),
(39, '2017-09-04 12:00:00', '2017-09-04 12:33:00', 1, 'RAPAT', NULL, NULL, NULL, NULL, NULL, 'internal', NULL, 'asdasd', '1'),
(40, '2017-09-04 12:00:00', '2017-09-04 12:18:00', 1, 'money', 'KOMAR', NULL, NULL, NULL, NULL, 'internal', NULL, 'asd', '1'),
(41, '2017-09-04 12:00:00', '2017-09-04 01:22:51', 2, 'asdasd', 'asdasdas', NULL, '2017-09-04 01:22:51', NULL, '2017-09-04 01:22:51', 'internal', NULL, 'asdasd', '1'),
(42, '2017-09-04 12:00:00', '2017-09-04 12:18:00', 1, 'asdasd', 'asdasdasd', NULL, NULL, NULL, NULL, 'internal', NULL, 'asdasd', '1'),
(43, '2017-09-04 12:00:00', '2017-09-04 12:19:00', 2, 'asdasd', 'asdasdasd', NULL, NULL, NULL, NULL, 'internal', NULL, 'asdasd', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL COMMENT 'jabatan ',
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `name_pic` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `id_jabatan`, `password`, `remember_token`, `email`, `id_unit_kerja`, `name_pic`) VALUES
(1, 'admin', 11, 'e69dc2c09e8da6259422d987ccbe95b5', 'AZAlbImX8AUElHBlAcFvPaXiz9PMChIDKaZUmYtW', 'adminPunyaEmails@yahoo.com', NULL, NULL),
(6, 'akbar', 13, 'e69dc2c09e8da6259422d987ccbe95b5', 'LbbRcaq9bfnOBkRVD2mUT4v5eyXHa0MUTOZRJw56', 'akbaragustin55@yahoo.com', NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, 2, 'akbar'),
(8, NULL, NULL, NULL, NULL, NULL, 3, 'KUDA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invite_jabatan`
--
ALTER TABLE `invite_jabatan`
  ADD PRIMARY KEY (`id_invite_jabatan`);

--
-- Indexes for table `invite_name`
--
ALTER TABLE `invite_name`
  ADD PRIMARY KEY (`id_invite_name`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `master_unit_kerja`
--
ALTER TABLE `master_unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`kd_role`),
  ADD KEY `id_group` (`id_jabatan`),
  ADD KEY `user_grp` (`id_jabatan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_menu_2` (`id_menu`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_rapat` (`id_rapat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_rapat`
--
ALTER TABLE `t_rapat`
  ADD PRIMARY KEY (`id_rapat`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invite_jabatan`
--
ALTER TABLE `invite_jabatan`
  MODIFY `id_invite_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `invite_name`
--
ALTER TABLE `invite_name`
  MODIFY `id_invite_name` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `master_unit_kerja`
--
ALTER TABLE `master_unit_kerja`
  MODIFY `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;
--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4130;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `t_rapat`
--
ALTER TABLE `t_rapat`
  MODIFY `id_rapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `id_rapat` FOREIGN KEY (`id_rapat`) REFERENCES `t_rapat` (`id_rapat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_rapat`
--
ALTER TABLE `t_rapat`
  ADD CONSTRAINT `id_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `id_unit_kerja` FOREIGN KEY (`id_unit_kerja`) REFERENCES `master_unit_kerja` (`id_unit_kerja`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
