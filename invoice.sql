-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-11-14 09:39:22
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `invoice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `lotteryaward`
--

CREATE TABLE `lotteryaward` (
  `id` int(10) NOT NULL,
  `perviod` int(10) NOT NULL,
  `prize` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `lotteryaward`
--

INSERT INTO `lotteryaward` (`id`, `perviod`, `prize`, `number`) VALUES
(116, 999, '特別獎', '123456789'),
(117, 999, '特獎', ''),
(118, 999, '頭獎1', '564556789'),
(119, 999, '頭獎2', ''),
(120, 999, '頭獎3', '');

-- --------------------------------------------------------

--
-- 資料表結構 `標籤集`
--

CREATE TABLE `標籤集` (
  `id` int(10) NOT NULL,
  `targetName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `標籤集`
--

INSERT INTO `標籤集` (`id`, `targetName`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, '');

-- --------------------------------------------------------

--
-- 資料表結構 `記帳表`
--

CREATE TABLE `記帳表` (
  `id` int(10) NOT NULL,
  `V_number` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periods` int(6) NOT NULL,
  `date` date NOT NULL,
  `money` int(10) NOT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `記帳表`
--

INSERT INTO `記帳表` (`id`, `V_number`, `periods`, `date`, `money`, `target`, `other`) VALUES
(39, ' 12345678aa', 0, '0000-00-00', 0, '', ''),
(40, ' 666aa', 0, '0000-00-00', 0, '', ''),
(41, ' 999999aaa', 0, '0000-00-00', 0, '', ''),
(42, '', 0, '0000-00-00', 0, '', ''),
(43, ' 123456789', 999, '0000-00-00', 0, '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `lotteryaward`
--
ALTER TABLE `lotteryaward`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `標籤集`
--
ALTER TABLE `標籤集`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `記帳表`
--
ALTER TABLE `記帳表`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lotteryaward`
--
ALTER TABLE `lotteryaward`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `標籤集`
--
ALTER TABLE `標籤集`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `記帳表`
--
ALTER TABLE `記帳表`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
