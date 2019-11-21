-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 02:01 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passdown`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `ticket` text NOT NULL,
  `type` text NOT NULL,
  `jiraSummary` text NOT NULL,
  `nocSummary` text NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2',
  `fileId` text NOT NULL,
  `event_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `uid`, `shift`, `ticket`, `type`, `jiraSummary`, `nocSummary`, `priority`, `status`, `fileId`, `event_time`) VALUES
(1, 0, 1, 'wevwe', '', '0', '0', 0, 2, '', '2018-03-17 06:32:09'),
(2, 0, 1, 'erverv', 'ervervb', '0', '0', 1, 2, '', '2018-03-17 06:36:58'),
(3, 0, 1, 'erverv', 'ervervb', 'erberb', 'erberb', 1, 2, '', '2018-03-17 06:37:47'),
(4, 0, 1, 'vsdsvs', 'sdvsd', 'svsdv', 'svsdv', 1, 2, '', '2018-03-17 06:38:42'),
(5, 0, 1, 'erver', 'verv', 'evr', 'evr', 1, 2, '', '2018-03-17 07:38:37'),
(6, 0, 1, 'ergverv', 'ever', 'everv', 'evrev', 1, 2, '', '2018-03-17 07:39:51'),
(7, 0, 1, 'e3vbrer', 'evrve', 'vr', 'ever', 1, 2, '', '2018-03-17 07:41:38'),
(8, 0, 1, 'vgwervg', 'wefgwe', 'wefwef', 'wfewef', 1, 2, '', '2018-03-17 07:42:38'),
(9, 0, 1, '2fg23f2', 'f23f23', 'f2323f', '2f32', 1, 2, '', '2018-03-17 07:53:44'),
(10, 0, 1, 'wfewef', 'wefwef', 'wfefwe', 'wfefwe', 1, 2, '', '2018-03-17 08:01:54'),
(11, 0, 1, 'ervbevrber', 'vberbre', 'ebrebe', 'erber', 1, 2, '', '2018-03-17 08:02:52'),
(12, 0, 1, 'svsdvsd', 'weva vzxdv', 'svdsvsd', 'svsdv', 1, 2, '', '2018-03-17 08:03:56'),
(13, 0, 1, 'everv', 'ververv', 'erverver', 'verver', 1, 2, '', '2018-03-17 08:14:33'),
(14, 0, 1, 'wefwerfw', 'fewefwef', 'wefwef', 'wefwef', 1, 2, '', '2018-03-17 08:17:25'),
(15, 0, 1, 'ferfwefwe', 'fwfewfwe', 'wefwef', 'wefwef', 1, 2, '', '2018-03-17 08:18:22'),
(16, 0, 1, 'wfwefwe', 'fwefwef', 'weffwef', 'fweefwfw', 1, 2, '', '2018-03-17 08:19:24'),
(17, 0, 1, 'wefcwefw', 'wevwev', 'ewvwe', 'wvevw', 1, 2, '', '2018-03-17 08:19:54'),
(18, 0, 1, 'wefwf', 'wefwef', 'weffwef', 'wefwefwe', 1, 2, '', '2018-03-17 08:21:35'),
(19, 0, 1, 'newe', 'wewr', 'wrewer', 'werwerwr', 1, 2, '', '2018-03-17 08:22:34'),
(20, 0, 1, 'ewev', 'vwewe', 'wevwev', 'wevvw', 1, 2, '', '2018-03-17 08:25:26'),
(21, 0, 1, 'wefgwef', 'wefwef', 'weffwe', 'ewfwefew', 1, 2, '', '2018-03-17 08:26:29'),
(22, 0, 1, 'wefwef', 'wefwef', 'wefwef', 'wefwef', 1, 2, '', '2018-03-17 14:26:52'),
(23, 0, 1, 'efwef', 'wfewefwe', 'wefwef', 'wefwef', 1, 2, '', '2018-03-17 14:29:23'),
(24, 0, 1, 'wvcwev', 'wevcwev', 'wvewe', 'wvev', 1, 2, '', '2018-03-17 14:30:06'),
(25, 0, 1, 'wevwev', 'wevwe', 'wvwe', 'wcve', 1, 1, '', '2018-03-17 14:30:27'),
(26, 0, 1, 'sottiBro', 'noBro', 'why6', 'asxdas', 1, 1, '', '2018-03-17 14:48:38'),
(27, 0, 1, 'wefw', 'wefwef', 'wfewef', 'wfewef', 1, 1, '1521300197096', '2018-03-17 15:23:17'),
(28, 0, 1, 'kalobhaol', 'mrjrere', 'werfwevcsdv', 'dvsdf', 1, 1, '1521300610880headersCopy.csv', '2018-03-17 15:30:10'),
(29, 0, 2, 'ThisTicket', 'WellType', 'JirSum', 'nocSum', 4, 2, '1521475206794columnsheader.csv', '2018-03-19 16:00:06'),
(30, 0, 2, 'newTick', 'scsdvcsd', 'svdsv', 'vddsvvsd', 1, 2, '1521475773198headers.csv', '2018-03-19 16:09:33'),
(31, 0, 2, 'key/ticket', 'whatsup', 'newmessage', 'hello', 3, 2, '1521476451694columnsheader.csv', '2018-03-19 16:20:51'),
(32, 0, 1, 'wefwefgwe', 'fgwegweg', 'gwegweg', 'wgewvc', 1, 2, '1521476839364BigData.csv', '2018-03-19 16:27:19'),
(33, 0, 1, 'aebe a', 'ab ', 'dbrfb ', 'fdbf', 1, 2, '0', '2018-03-19 16:37:36'),
(34, 0, 1, 'erbeba', 'dfbafb ', 'dberbhdf', 'b fcb ', 1, 2, '0', '2018-03-19 16:37:54'),
(35, 0, 2, 'erwvbw', 'vev', 'Wv', 'wev WE ', 1, 2, '0', '2018-03-20 15:14:04'),
(36, 0, 1, 'wefvGSV', 'SVERB', 'SDABFDFB', 'DFBDFB', 1, 2, '1521621232234headers.csv', '2018-03-21 08:33:52'),
(37, 0, 1, 'reabadfb', 'dafbfadb', 'dbad', 'dfbfdb', 1, 2, '0', '2018-03-21 08:34:04'),
(38, 0, 1, 'svsdvb', 'dbfdb', 'fbdf', 'dbf', 1, 2, '0', '2018-03-21 08:35:15'),
(39, 0, 2, 'eveninad', 'sadasd', 'dasd', 'asdasd', 1, 1, '0', '2018-03-21 18:02:56'),
(40, 1, 1, 'newQuery', 'wedwe', 'dew', 'wedwed', 1, 1, '0', '2018-03-21 18:11:18'),
(41, 1, 2, 'new this is test', 'wewe', 'wew', 'wew', 1, 1, '0', '2018-03-21 18:35:03'),
(42, 1, 1, 'dfv', 'dfv', 'dfv', 'dvfd', 1, 1, '0', '2018-03-22 09:28:19'),
(43, 1, 2, 'asdasd', 'casc', 'csc', 'dscvasc', 1, 1, '0', '2018-03-22 09:28:53'),
(44, 1, 1, 'tydfjytfuyf', 'dttfyjf', 'ctyjvghv', 'uyfyfffguyf', 1, 1, '0', '2018-03-22 13:49:05'),
(45, 1, 1, 'fuykvh', 'vygvhgv', 'cghc', 'jvhb ', 1, 1, '0', '2018-03-22 13:50:00'),
(46, 1, 1, 'vyhvjhvbn', 'vhvhnv', 'bhvjh', 'ghvhgv', 1, 1, '0', '2018-03-22 13:50:14'),
(47, 1, 1, 'werw', 'werwer', 'werwer', 'werwer', 1, 1, '0', '2018-03-22 13:58:37'),
(48, 1, 1, 'cghcncgh', 'cfgcgfcgf', 'cgvmjhchg', 'cgncgcn', 1, 1, '0', '2018-03-24 13:19:38'),
(49, 1, 1, 'ThatEvents', 'YourDy', 'dasdas', 'sdasdasd', 1, 1, '0', '2018-03-26 15:15:15'),
(50, 1, 1, 'egerg', 'rgegerg', 'egre', 'ergerg', 1, 1, '0', '2018-03-26 15:17:16'),
(51, 1, 1, 'shwefilyhfwef', 'wefwefwe', 'wefwef', 'wefwefw', 1, 1, '0', '2018-03-26 15:18:24'),
(52, 1, 1, 'wefgerg', 'ergergerge', 'rgerger', 'gergergerge', 1, 1, '0', '2018-03-26 15:28:14'),
(53, 1, 2, 'dfbdfb', 'bdfbd', 'fbdfbdfb', 'dfbfdb', 1, 1, '0', '2018-03-26 15:30:29'),
(54, 1, 1, 'ergerg', 'ergerg', 'ergerg', 'ergerg', 3, 1, '0', '2018-03-26 15:32:19'),
(55, 1, 1, 'dfbdfb', 'dfbdfbd', 'bdfbdfb', 'dfbdfbdf', 1, 1, '0', '2018-03-26 15:33:22'),
(56, 1, 1, 'fbdbdfbdfb', 'fbdfbdb', 'dfbdfb', 'dfbdfb', 1, 1, '0', '2018-03-26 15:34:11'),
(57, 1, 2, 'dfbdfb', 'dfbdfb', 'fbdfb', 'fbdfb', 1, 1, '0', '2018-03-26 15:34:21'),
(58, 1, 1, 'dvbsdb', 'sbdsdb', 'sdbsdb', 'bds ', 1, 1, '0', '2018-03-26 15:35:35'),
(59, 1, 1, 'dfbdfb', 'bddfb', 'dfbdfb', 'fbdfb', 1, 1, '0', '2018-03-26 15:36:35'),
(60, 1, 1, 'fbdfb', 'bdfb', 'dfbdf', 'dfbdfb', 1, 1, '0', '2018-03-26 15:36:44'),
(61, 1, 1, 'bdfbdfb', 'fdbdfb', 'fbb', 'fbdbdfb', 1, 1, '0', '2018-03-26 15:36:54'),
(62, 1, 1, 'bdfbdf', 'dfbdfb', 'fbdbd', 'fbfdb', 1, 1, '0', '2018-03-26 15:37:03'),
(63, 1, 1, 'wefwef', 'fwefw', 'fwefwef', 'wefefwf', 1, 1, '0', '2018-03-27 07:05:31'),
(64, 1, 1, 'dgdg', 'dgdfg', 'gfdg', 'dfgdfg', 1, 1, '0', '2018-03-27 08:13:37'),
(65, 1, 1, 'ergerg', 'ergerg', 'egreg', 'ergerg', 1, 1, '0', '2018-03-27 08:14:45'),
(66, 1, 1, 'ewgwegw', 'wgeg', 'gwg', 'gwge', 1, 1, '0', '2018-03-27 08:15:15'),
(67, 1, 1, 'egeg', 'rgre', 'rgerg', 'rgerg', 1, 1, '0', '2018-03-27 08:15:23'),
(68, 1, 2, 'ewff', 'wfew', 'fwefwe', 'wefwe', 1, 1, '0', '2018-04-03 11:17:27'),
(69, 1, 2, 'erfer', 'ferfe', 'ferfe', 'ferf', 1, 2, '1523007082134graphexample.png', '2018-04-06 09:31:22'),
(70, 1, 1, 'ergerg', 'ergerg', 'greg', 'greg', 1, 1, '0', '2018-04-06 10:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `eventsbydate`
--

CREATE TABLE `eventsbydate` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `subject` text NOT NULL,
  `location` text NOT NULL,
  `startTime` text NOT NULL,
  `endTime` text NOT NULL,
  `summary` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2',
  `fileId` text NOT NULL,
  `event_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventsbydate`
--

INSERT INTO `eventsbydate` (`id`, `uid`, `subject`, `location`, `startTime`, `endTime`, `summary`, `status`, `fileId`, `event_time`) VALUES
(1, 1, 'reger', 'ergr', '2018-04-06', '2018-04-06', 'erferf', 2, '0', '2018-04-01'),
(2, 1, 'on15', '12e1r2', '2018-04-06', '2018-04-06', '32t4hg4hj4', 2, '0', '2018-04-22'),
(3, 1, 'rger', 'rgherh', '2018-04-06hrth', '2018-04-06rhr', 'hhre', 2, '0', '2018-04-05'),
(4, 1, 'erg', 'egerg', '2018-04-06', '2018-04-06', 'grge', 2, '0', '2018-04-05'),
(5, 1, 'erge', 'erge', '2018-04-06', '2018-04-06', 'regerg', 2, '0', '2018-04-05'),
(6, 1, 'This is subject', 'its location', '2018-04-06timer', '2018-04-06dtime', 'wow summary', 2, '1523011133774ColorstouseOrder.xlsx', '2018-04-05'),
(7, 1, 'This is subject', 'its subject', '2018-04-06', '2018-04-06', 'hello', 2, '0', '2018-04-08'),
(8, 1, 'this is helloworld..subject', 'no subject', '2018-04-06', '2018-04-06', 'hellomystarfhwhfweho bwioefhwe wiohefwoeh weifhweiof wsfhweio wehfweoifh fweifhwe sdffhho wefhfh awefhiof;se fwehiowehionfbn wefhofweoh wefshio;wefhio wefhio;fweh wefbuifweh efhio;fweh cfiweffho feweehiohiowe wefhio', 2, '0', '2018-04-01'),
(9, 1, 'htr', 'ert', '2018-04-06', '2018-04-06', 'rte', 2, 'datevent_1523015973044DifferentHeaders.csv', '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `role` int(1) NOT NULL DEFAULT '2',
  `status` int(1) DEFAULT '2',
  `password` text NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `status`, `password`, `join_time`) VALUES
(1, 'Admin', 'php@devsta.com', 1, 1, '12345', '2018-03-15 09:20:45'),
(2, 'Dev', 'dev', 2, 1, '12345', '2018-03-24 10:57:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventsbydate`
--
ALTER TABLE `eventsbydate`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `eventsbydate`
--
ALTER TABLE `eventsbydate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
