-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2015 at 12:51 PM
-- Server version: 10.0.22-MariaDB-1~vivid-log
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lippokemang`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_redeem`
--

CREATE TABLE IF NOT EXISTS `detail_redeem` (
  `id_voucher` char(3) NOT NULL,
  `id_redeem` char(6) NOT NULL,
  `voucher_number` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_redeem`
--

INSERT INTO `detail_redeem` (`id_voucher`, `id_redeem`, `voucher_number`) VALUES
('V01', 'RD0001', 1),
('V01', 'RD0002', 1),
('V01', 'RD0003', 1),
('V01', 'RD0004', 1),
('V01', 'RD0005', 4);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `no_identity` varchar(25) NOT NULL,
  `id_member` char(7) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `family_name` varchar(15) NOT NULL,
  `date_birth` date NOT NULL,
  `place_birth` varchar(20) NOT NULL,
  `citizenship` varchar(15) NOT NULL,
  `gender` char(1) NOT NULL,
  `marital_status` varchar(15) NOT NULL,
  `children_number` char(2) NOT NULL,
  `religion` char(1) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone1` varchar(12) NOT NULL,
  `phone2` varchar(12) NOT NULL,
  `mobile1` varchar(12) NOT NULL,
  `mobile2` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `income` char(1) NOT NULL,
  `hobby` varchar(26) NOT NULL,
  `other_hobby` varchar(20) NOT NULL,
  `cc` char(2) NOT NULL,
  `other_cc` varchar(20) NOT NULL,
  `point` int(5) NOT NULL,
  `type_card` varchar(10) NOT NULL,
  `register_date` date NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`no_identity`, `id_member`, `first_name`, `family_name`, `date_birth`, `place_birth`, `citizenship`, `gender`, `marital_status`, `children_number`, `religion`, `address`, `phone1`, `phone2`, `mobile1`, `mobile2`, `email`, `income`, `hobby`, `other_hobby`, `cc`, `other_cc`, `point`, `type_card`, `register_date`, `username`) VALUES
('1234567890', '1112501', 'john', 'travolta', '1995-03-01', 'swiss', 'wna', '0', 'single', '7', '1', 'kemanggisan village', '', '', '0219999999', '', 'john@yahoo.com', '3', '10', '', '10', '', 684, 'Regular', '2014-08-05', 'admin'),
('12345678', '1112509', 'Jon', 'Kalalo', '1995-08-01', 'jakrata', 'WNI', '0', '', '', '0', '', '', '', '0856945505', '', '', '', '', '', '', '', 200, 'Regular', '2014-08-11', 'admin'),
('3174035801480002', '1201441', 'TENRIABENG ', 'M.MOEIN', '0000-00-00', '', '', '', '', '', '0', '', '', '', '8551018148', '', 'HIROKOMM@BIZ.NET.ID', '', '', '', '', '', 1003, 'Regular', '0000-00-00', ''),
('2D41JE0085', '1201442', 'SJARIF ', 'ATCHARA CHARUBH', '0000-00-00', '', '', '', '', '', '4', '', '', '', '818875219', '', 'ARCHIES_60@YAHOO.COM', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('0954026402470050', '1201443', 'ANDOLINA ', 'ADLY', '0000-00-00', '', '', '', '', '', '0', '', '', '', '8161641911', '', '', '', '', '', '', '', 300, 'Regular', '0000-00-00', ''),
('3171046404520002', '1201444', 'LAURENSIA ', 'YENNY LOA', '2019-10-08', '', '', '', '', '', '1', '', '', '', '818720769', '', '', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174035509610001', '1201445', 'ROOSLYNDIANI', '', '0000-00-00', '', '', '', '', '', '0', '', '', '', '811849648', '', 'rooslyn@gmail.com', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('317064811550001', '1201446', 'PURWATI ', 'RATIH', '0000-00-00', '', '', '', '', '', '0', '', '', '', '811897314', '', 'P_RATIH@YAHOO.COM', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174036702720006', '1201447', 'IDHA', ' SOEKILA', '0000-00-00', '', '', '', '', '', '0', '', '', '', '8164857174', '', 'idhasoekila@yahoo.com', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3276025904720012', '1201448', 'SUWARNI ', 'SUWANTO', '0000-00-00', '', '', '', '', '', '1', '', '', '', '8128416395', '', 'NINI.SUWANTO@GMAIL.COM', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174032804720004', '1201449', 'ARIF ', 'NURSANTO', '0000-00-00', '', '', '', '', '', '0', '', '', '', '81318090700', '', '', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3175042307590007', '1201450', 'HASYIM ', 'ABDULLAH', '0000-00-00', '', '', '', '', '', '0', '', '', '', '817708751', '', 'HASYIM59@GMAIL.COM', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174075005880002', '1201451', 'ANGGIT ', 'RAMADHANISWORO', '0000-00-00', '', '', '', '', '', '0', '', '', '', '81310051988', '', 'ANGGIT.BINUS@GMAIL.COM', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174044802760002', '1201452', 'SAPARINAH', '', '0000-00-00', '', '', '', '', '', '0', '', '', '', '8164823284', '', '', '', '', '', '', '', 500, 'Regular', '0000-00-00', ''),
('3174044802860002', '1201453', 'DEWI ', 'KUSUMAWATI', '2014-08-13', '', '', '', '', '', '0', '', '', '', '81239556642', '', '', '', '', '', '', '', 500, 'Regular', '2014-08-11', ''),
('3276092305600001', '1201454', 'IVAN ', 'SOFWAN', '2022-05-09', '', '', '', '', '', '0', '', '', '', '816734373', '', '', '', '', '', '', '', 720, 'Regular', '0000-00-00', ''),
('12121212', '2112502', 'richard', 'panhar', '1995-08-01', 'jakarta', 'wni', '0', 'single', '0', '2', 'sesame street', '', '', '08798876786', '', 'a@yahoo.com', '4', '6;8', '', '0', '', 101, 'Diamond', '2014-08-05', 'admin'),
('1112509', '2112590', 'Budi', 'Susanto', '1997-08-21', 'Jakarta', 'WNI', '0', '', '', '0', '', '', '', '4353646', '', '', '', '', '', '', '', 0, 'Diamond', '2014-08-10', 'admin'),
('3674052304640001', '2201051', 'RICKY ', 'HERWAN', '0000-00-00', '', '', '', '', '', '0', '', '', '', '816866460', '', 'RIMAN234@GMAIL.COM', '', '', '', '', '', 500, 'Diamond', '0000-00-00', ''),
('3174042811530004', '2201052', '  DHANI ', 'ANDRIAWAN', '0000-00-00', '', '', '', '', '', '1', '', '', '', '8568188188', '', '000000@000.com', '', '', '', '', '', 500, 'Diamond', '0000-00-00', ''),
('31740460040580006', '2201053', 'MM ASTRID', ' TANESHA', '0000-00-00', '', '', '', '', '', '1', '', '', '', '87878833100', '', '000000@000.com', '', '', '', '', '', 100, 'Diamond', '0000-00-00', ''),
('22500211', '2201054', 'vishal', '', '0000-00-00', '', '', '', '', '', '0', '', '', '', '815119401890', '', '000000@000.com', '', '', '', '', '', 900, 'Diamond', '0000-00-00', ''),
('3174060601520001', '2201055', 'SETIAWAN ', 'SURJAWIDJAJA', '0000-00-00', '', '', '', '', '', '1', '', '', '', '816278019', '', '000000@000.com', '', '', '', '', '', 500, 'Diamond', '0000-00-00', ''),
('3174044210800009', '2201455', 'RENY ', 'OKTAVIA', '2014-08-11', 'bandung', 'WNI', '0', '', '', '0', '', '', '', '8129020924', '', 'RENY_O@YAHOO.COM', '', '', '', '', '', 500, 'Diamond', '0000-00-00', ''),
('1112578', '2222222', 'Edo', 'Edi', '2014-08-11', 'Yogya', 'WNI', '0', '', '', '0', '', '', '', '353454', '', '', '', '', '', '', '', 0, 'Diamond', '2014-08-10', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
  `id_receipt` varchar(15) NOT NULL,
  `receipt_date` date NOT NULL,
  `total_purchase` decimal(8,0) NOT NULL,
  `nominal_point` int(3) NOT NULL,
  `id_member` char(7) NOT NULL,
  `id_rule` char(3) NOT NULL,
  `id_tenant` char(4) NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id_receipt`, `receipt_date`, `total_purchase`, `nominal_point`, `id_member`, `id_rule`, `id_tenant`, `username`) VALUES
('1111111', '2015-12-03', 150000, 3, '1201441', 'R01', 'T004', 'op'),
('546546546', '2014-08-07', 99999999, 1, '1', '1', '1', '1'),
('6600', '2013-08-07', 6000000, 120, '1201454', 'R01', 'T003', 'admin'),
('78888', '2014-08-10', 10000000, 200, '1112501', 'R03', 'T002', 'admin'),
('9898998', '2014-08-11', 99999999, 1, '1', '1', '1', '1'),
('999', '2014-08-07', 5000000, 100, '1201454', 'R03', 'T002', 'admin'),
('B00001', '2014-08-05', 7088888, 141, '2112502', 'R01', 'T001', 'admin'),
('BR001', '2014-08-11', 10000000, 200, '1112509', 'R04', 'T004', 'admin'),
('D89000', '2014-08-01', 8000000, 320, '1112501', 'R02', 'T002', 'admin'),
('DEB0001', '2014-08-01', 3400000, 68, '1112501', 'R03', 'T002', 'admin'),
('DEB0002', '2014-08-01', 6700000, 134, '1112501', 'R03', 'T003', 'admin'),
('H00001', '2014-08-05', 8000000, 160, '2112502', 'R01', 'T001', 'admin'),
('L0001', '2014-08-12', 156000, 3, '1112501', 'R01', 'T001', 'admin'),
('L001', '2014-08-04', 150000, 3, '1112501', 'R01', 'T001', 'admin'),
('L003', '2014-08-05', 10000000, 200, '1112502', 'R01', 'T001', 'admin'),
('L004', '2014-08-05', 10000000, 200, '1112502', 'R01', 'T001', 'admin'),
('SAM0005', '2014-08-01', 7800000, 156, '1112501', 'R01', 'T003', 'admin'),
('SAMS0009', '2014-08-11', 5000000, 100, '2201054', 'R03', 'T002', 'admin'),
('XXi', '2014-08-11', 10000000, 400, '1112501', 'R02', 'T005', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE IF NOT EXISTS `redeem` (
  `id_redeem` char(6) NOT NULL,
  `redeem_date` date NOT NULL,
  `redeem_point` int(5) NOT NULL,
  `id_member` char(7) NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id_redeem`, `redeem_date`, `redeem_point`, `id_member`, `username`) VALUES
('RD0001', '2014-08-05', 300, '1112502', 'admin'),
('RD0002', '2014-08-05', 300, '2112502', 'admin'),
('RD0003', '2014-08-06', 300, '1112501', 'admin'),
('RD0004', '2014-08-06', 300, '1112501', 'admin'),
('RD0005', '2014-08-07', 1200, '2201054', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id_rule` char(3) NOT NULL,
  `rule_name` varchar(20) NOT NULL,
  `point` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `rule_name`, `point`) VALUES
('R01', 'Debit BCA', 1),
('R02', 'Credit BCA', 2),
('R03', 'Debit Mandiri', 1),
('R04', 'Debit Niaga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE IF NOT EXISTS `tenant` (
  `id_tenant` char(4) NOT NULL,
  `tenant_name` varchar(25) NOT NULL,
  `location` varchar(30) NOT NULL,
  `pic` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id_tenant`, `tenant_name`, `location`, `pic`, `phone`) VALUES
('T001', 'lotteria', 'Floor 3', 'mr. lott', '089988776655'),
('T002', 'Debenhams', 'UG', 'Rick', '09977878788'),
('T003', 'Samsung', 'Floor 2', 'Kim Yong', '08748273847'),
('T004', 'Merchant', 'LT 6', 'MR WU', '998778787878'),
('T005', 'XXI', 'floor 3', 'andri', '0812944955');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade_membership`
--

CREATE TABLE IF NOT EXISTS `upgrade_membership` (
  `old_idmember` varchar(7) NOT NULL,
  `new_idmember` varchar(7) NOT NULL,
  `username` varchar(10) NOT NULL,
  `upgrade_date` date NOT NULL,
  `old_point` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade_membership`
--

INSERT INTO `upgrade_membership` (`old_idmember`, `new_idmember`, `username`, `upgrade_date`, `old_point`) VALUES
('1112502', '2112502', 'admin', '2014-08-05', 100),
('1112509', '2112590', 'admin', '2014-08-10', 600),
('1112578', '2222222', 'admin', '2014-08-10', 0),
('1201455', '2201455', 'admin', '2014-08-10', 500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(10) NOT NULL,
  `name` varchar(35) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` char(1) NOT NULL,
  `last_login` date NOT NULL,
  `active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `password`, `level`, `last_login`, `active`) VALUES
('admin', 'Renaldo Briant ', 'd8578edf8458ce06fbc5bb76a58c5ca4', '1', '2014-08-11', '1'),
('op', 'Anniza', '21232f297a57a5a743894a0e4a801fc3', '2', '2014-08-05', '1');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `id_voucher` char(3) NOT NULL,
  `voucher_name` varchar(35) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(8) NOT NULL,
  `point_required` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `voucher_name`, `start_date`, `end_date`, `image`, `point_required`) VALUES
('V01', 'vocher belanja 50.000', '2014-08-01', '2014-08-31', '', 300),
('V02', 'Voucher XX1', '2014-08-01', '2014-08-02', '', 300),
('V03', 'Voucher Belanja 20000', '2014-08-01', '2014-08-31', '', 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_redeem`
--
ALTER TABLE `detail_redeem`
  ADD PRIMARY KEY (`id_voucher`,`id_redeem`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id_receipt`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id_redeem`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id_tenant`);

--
-- Indexes for table `upgrade_membership`
--
ALTER TABLE `upgrade_membership`
  ADD PRIMARY KEY (`old_idmember`,`new_idmember`,`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
