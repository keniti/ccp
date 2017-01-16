-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 11 月 04 日 10:22
-- サーバのバージョン： 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `area_numbers`
--

CREATE TABLE `area_numbers` (
  `area_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `hokkaido` varchar(255) NOT NULL,
  `kanto` varchar(255) NOT NULL,
  `koshinetsu` varchar(255) NOT NULL,
  `toyama` varchar(255) NOT NULL,
  `fukui` varchar(255) NOT NULL,
  `tokai` varchar(255) NOT NULL,
  `kinki` varchar(255) NOT NULL,
  `shikoku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `area_numbers`
--

INSERT INTO `area_numbers` (`area_id`, `department_id`, `hokkaido`, `kanto`, `koshinetsu`, `toyama`, `fukui`, `tokai`, `kinki`, `shikoku`) VALUES
(1, 1, '0', '4', '1', '16', '2', '8', '0', '0'),
(2, 2, '0', '3', '4', '14', '2', '6', '2', '0'),
(3, 3, '0', '2', '1', '12', '4', '3', '1', '0'),
(4, 4, '0', '6', '0', '15', '1', '10', '1', '0'),
(5, 5, '0', '1', '3', '17', '6', '11', '0', '0');

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar_datas`
--

CREATE TABLE `calendar_datas` (
  `id` int(11) NOT NULL,
  `event` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `calendar_datas`
--

INSERT INTO `calendar_datas` (`id`, `event`, `year`, `month`, `day`, `detail`) VALUES
(1, '0', 2016, 2, 4, '0'),
(2, '0', 0, 0, 0, '0'),
(3, '', 2017, 2, 3, ' zjn\r\n\r\n'),
(13, 'hogehoge', 2016, 11, 27, 'hello'),
(14, 'あいうえお', 2016, 11, 17, 'うぇ'),
(15, 'helllllll', 2016, 11, 5, 'fajfoa'),
(16, 'aaa', 2016, 2, 1, 'kkkk'),
(17, '', 0, 0, 0, ''),
(18, 'hoge', 2016, 11, 4, 'hofe\r\n');

-- --------------------------------------------------------

--
-- テーブルの構造 `company_datas`
--

CREATE TABLE `company_datas` (
  `id` int(11) NOT NULL,
  `company_n` varchar(255) NOT NULL,
  `indust_type` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `url_list` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `company_datas`
--

INSERT INTO `company_datas` (`id`, `company_n`, `indust_type`, `address`, `url_list`) VALUES
(1, '安達建設株式会社', '建設業', '富山県南砺市野田425-7', 'http://www.adachi-kensetsu.jp'),
(2, '射水ケーブルネットワーク株式会社', '情報通信業', '富山県射水市中央町17-1', 'http://www.canet.jp'),
(3, '魚津市役所', '公務', '富山県魚津市釈迦堂1丁目10番地1号', 'http://www.city.uozu.toyama.jp'),
(4, 'オーアイ工業株式会社', '製造業', '富山県魚津市本江850番地', 'http://www.oaikogyo.co.jp'),
(5, '株式会社大谷工業　富山工場', '製造業', '富山県射水市戸破3456', 'http://www.otanikogyo.com'),
(6, '株式会社北日本新聞', '情報通信業', '富山県富山市安住町2-14', 'http://webun.jp'),
(7, 'NPO法人親と教員の会　こどものその', '教育・学習支援業', '富山県高岡市大町11-19', 'http://kodomono.com'),
(8, '砺波信用金庫', '金融業・保険業', '富山県砺波市福野1621-15', 'http://www.tonami-shinkin.co.jp'),
(9, 'あそあそ自然学校', '教育・学習支援業', '富山県中新川郡上市町浅生15番地', 'http://www.asoaso.jp'),
(10, '株式会社あんしんグループ', '金融業・保険業', '富山県富山市赤田982-1', 'http://www.anshingroup.jp'),
(11, '野村證券株式会社　富山市店', '金融業・保険業', '富山県富山市堤町通り1-4-3', 'http://www.nomura.co.jp'),
(12, '株式会社ハイテック', '情報通信業', '富山県富山市向新庄町6-2-7', 'http://hitechs.co.jp'),
(13, '国土交通省北陸地方整備局　利賀ダム工事事務所', '公務', '富山県砺波市太郎丸1丁目5番10号', 'http://www.hrr.mlit.go.jp/toga');

-- --------------------------------------------------------

--
-- テーブルの構造 `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(0, 'すべて'),
(1, '機械システム工学科'),
(2, '知能デザイン工学科'),
(3, '情報システム工学科'),
(4, '生物工学科'),
(5, '環境工学科');

-- --------------------------------------------------------

--
-- テーブルの構造 `intern_datas`
--

CREATE TABLE `intern_datas` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `business_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `number_of_employer` text CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `intern_datas`
--

INSERT INTO `intern_datas` (`id`, `company_name`, `business_type`, `number_of_employer`, `created`, `modified`) VALUES
(2, '富山県立大学', '学生', '2016_250,2015_250,2014_250,2013_250,2012_250', '2016-10-12 22:45:31', '2016-10-12 13:45:31'),
(3, '富山大学', '学生', '2016_1000,2015_1000,2014_1000,2013_1000,2012_1000', '2016-10-12 22:45:31', '2016-10-12 13:45:31'),
(4, '株式会社ユビ研', 'こあくま', '2016_6,2015_9,2014_0,2013_0,2012_0', '2016-10-12 22:45:32', '2016-10-12 13:45:32'),
(5, '水曜どうでせう', 'タレント', '2016_1,2015_1,2014_1,2013_1,2012_1', '2016-10-12 22:45:32', '2016-10-12 13:45:32'),
(6, '富山県立大学学園祭', '模擬店', '2016_5,2015_5,2014_5,2013_5,2012_5', '2016-10-12 22:49:13', '2016-10-12 13:49:13'),
(7, '牛越喫茶', '喫茶店のまがい物', '2016_10,2015_0,2014_0,2013_0,2012_0', '2016-10-12 22:49:13', '2016-10-12 13:49:13'),
(8, 'ソニーコンピュータエンタテインメント', 'エンジニア', '2016_45,2015_1,2014_1,2013_21,2012_5', '2016-10-12 22:49:13', '2016-10-12 13:49:13'),
(9, '富山気象台', 'お天気お姉さん（男）', '2016_5,2015_1,2014_1,2013_1,2012_0', '2016-10-12 22:49:13', '2016-10-12 13:49:13'),
(10, '乱気流', '雨', '2016_0,2015_0,2014_0,2013_0,2012_1', '2016-10-12 22:49:13', '2016-10-12 13:49:13'),
(11, '林業', 'B', '2016_2,2015_2,2014_3,2013_5,2012_4', '2016-11-03 15:30:12', '2016-11-03 06:30:12'),
(13, '製造業', 'C', '2016_0,2015_0,2014_0,2013_0,2012_0', '2016-11-03 15:47:57', '2016-11-03 06:47:57'),
(14, 'hogehoge', 'A', '2016_0,2015_0,2014_0,2013_0,2012_0', '2016-11-03 15:58:27', '2016-11-03 06:58:27'),
(15, 'hoehoe', 'E', '2016_0,2015_0,2014_0,2013_0,2012_0', '2016-11-03 15:58:27', '2016-11-03 06:58:27'),
(16, 'uwuw', 'E', '2016_0,2015_5,2014_0,2013_0,2012_0', '2016-11-03 15:58:27', '2016-11-03 06:58:27'),
(17, 'number', 'D', '2016_3,2015_0,2014_0,2013_3,2012_0', '2016-11-03 16:07:46', '2016-11-03 07:07:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `job_lists`
--

CREATE TABLE `job_lists` (
  `job_id` int(11) NOT NULL,
  `job_alpha` varchar(60) NOT NULL,
  `industy_type` varchar(255) NOT NULL,
  `in_prefec` int(11) NOT NULL,
  `out_prefec` int(11) NOT NULL,
  `machine` int(11) NOT NULL,
  `intellect` int(11) NOT NULL,
  `info` int(11) NOT NULL,
  `bio` int(11) NOT NULL,
  `environment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `job_lists`
--

INSERT INTO `job_lists` (`job_id`, `job_alpha`, `industy_type`, `in_prefec`, `out_prefec`, `machine`, `intellect`, `info`, `bio`, `environment`) VALUES
(1, 'A', '農業・林業', 0, 3, 0, 0, 0, 0, 0),
(2, 'B', '漁業', 0, 0, 1, 1, 0, 0, 9),
(3, 'C', '鉱業，採石業，砂利採取行', 0, 0, 0, 0, 0, 0, 0),
(4, 'D', '建設業', 27, 64, 1, 1, 0, 0, 9),
(5, 'E', '製造業', 81, 292, 23, 18, 8, 26, 3),
(6, 'F', '電気・ガス・熱供給・水道業', 5, 10, 0, 0, 0, 0, 0),
(7, 'G', '情報通信業', 16, 173, 0, 9, 14, 1, 1),
(8, 'H', '運輸業，郵便業', 2, 13, 1, 0, 1, 0, 0),
(9, 'I', '卸売業，小売業', 11, 61, 0, 0, 0, 1, 1),
(10, 'J', '金融業，保険業', 4, 10, 0, 0, 0, 0, 0),
(11, 'K', '不動産業，物品賃貸業', 1, 10, 0, 0, 0, 0, 0),
(12, 'L', '学術研究，専門・技術サービス', 15, 114, 0, 1, 0, 3, 4),
(13, 'M', '宿泊業，飲食サービス業', 0, 10, 1, 0, 0, 1, 0),
(14, 'N', '生活関連サービス業，娯楽業', 2, 20, 1, 0, 0, 0, 2),
(15, 'O', '教育，学習支援業', 0, 7, 0, 0, 0, 0, 0),
(16, 'P', '医療，福祉', 3, 20, 0, 0, 0, 0, 0),
(17, 'Q', '複合サービス事業', 7, 16, 0, 0, 0, 0, 1),
(18, 'R', 'サービス業(他に分類されないもの)', 9, 46, 2, 2, 0, 0, 1),
(19, 'S', '公務(他に分類されるものを除く)', 0, 0, 2, 0, 0, 1, 16),
(20, 'T', '分類不能の産業', 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_numbers`
--
ALTER TABLE `area_numbers`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `calendar_datas`
--
ALTER TABLE `calendar_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_datas`
--
ALTER TABLE `company_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `intern_datas`
--
ALTER TABLE `intern_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_lists`
--
ALTER TABLE `job_lists`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_numbers`
--
ALTER TABLE `area_numbers`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `calendar_datas`
--
ALTER TABLE `calendar_datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `company_datas`
--
ALTER TABLE `company_datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `intern_datas`
--
ALTER TABLE `intern_datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `job_lists`
--
ALTER TABLE `job_lists`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
