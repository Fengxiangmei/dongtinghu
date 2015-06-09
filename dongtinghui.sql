-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 23 日 02:42
-- 服务器版本: 5.5.29
-- PHP 版本: 5.2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dongtinghui`
--

-- --------------------------------------------------------

--
-- 表的结构 `analysis`
--

CREATE TABLE IF NOT EXISTS `analysis` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `parameter1` varchar(10) NOT NULL COMMENT '第一类参数',
  `parameter2` varchar(10) NOT NULL COMMENT '第二类参数',
  `parameter3` varchar(10) NOT NULL COMMENT '第三类参数',
  `parameter4` varchar(10) NOT NULL COMMENT '第四类参数',
  `place` varchar(200) NOT NULL COMMENT '地点',
  `time` year(4) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='聚类分析表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `analysis`
--

INSERT INTO `analysis` (`id`, `parameter1`, `parameter2`, `parameter3`, `parameter4`, `place`, `time`) VALUES
(1, '1.8053', '0.1153', '0.5361', '0.5969', '樟树港', 2006),
(2, '1.7775', '0.2204', '0.3521', '0.2081', '万家嘴', 2006),
(3, '0.2176', '0.217', '0.6033', '0.2287', '坡头', 2006),
(4, '0.6431', '0.2251', '0.5121', '0.3057', '沙河口', 2006),
(5, '0.0666', '0.1063', '0.6168', '0.2979', '南嘴', 2006),
(6, '0.0857', '0.1206', '1.0026', '0.3154', '目平湖', 2006),
(7, '0.0235', '0.1059', '0.6021', '0.2453', '小河嘴', 2006),
(8, '1.3844', '0.1217', '1.3098', '0.6671', '万子湖', 2006),
(9, '0.0672', '0.139', '0.8259', '0.388', '横岭湖', 2006),
(10, '0.034', '0.1451', '0.5111', '0.3087', '虞公庙', 2006),
(11, '0.7496', '0.0994', '0.5043', '0.5014', '漉角', 2006),
(12, '2.9771', '0.1206', '0.9136', '0.8969', '东洞庭湖', 2006),
(13, '0.574', '0.0994', '0.5419', '0.5006', '岳阳楼', 2006),
(14, '0.5373', '0.0952', '0.5599', '0.5559', '洞庭湖出口', 2006);

-- --------------------------------------------------------

--
-- 表的结构 `nutrition`
--

CREATE TABLE IF NOT EXISTS `nutrition` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `time` year(4) NOT NULL COMMENT '年份',
  `chla` varchar(10) NOT NULL COMMENT '叶绿素a',
  `TP` varchar(10) NOT NULL COMMENT '总磷',
  `TN` varchar(10) NOT NULL COMMENT '总氮',
  `SD` varchar(10) NOT NULL COMMENT '透明度',
  `CODMn` varchar(10) NOT NULL COMMENT '高锰酸盐指数',
  `average` varchar(10) NOT NULL COMMENT '评价值',
  `other` varchar(10) DEFAULT NULL COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `nutrition`
--

INSERT INTO `nutrition` (`id`, `time`, `chla`, `TP`, `TN`, `SD`, `CODMn`, `average`, `other`) VALUES
(1, 1997, '36', '54', '54', '68', '27', '47', ''),
(2, 1998, '34', '55', '55', '69', '40', '49', ''),
(3, 1999, '32', '65', '58', '63', '28', '48', ''),
(4, 2000, '39', '55', '55', '65', '35', '46', ''),
(5, 2001, '29', '55', '58', '61', '35', '46', ''),
(6, 2002, '33', '53', '58', '71', '28', '47', ''),
(7, 2003, '23', '54', '57', '63', '29', '44', ''),
(8, 2004, '22', '64', '59', '62', '29', '45', ''),
(9, 2005, '25', '51', '58', '68', '30', '46', ''),
(10, 2006, '25', '60', '58', '68', '33', '47', ''),
(11, 2016, '1', '1', '1', '1', '1', '1', 'new');

-- --------------------------------------------------------

--
-- 表的结构 `parameter_k`
--

CREATE TABLE IF NOT EXISTS `parameter_k` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `place` varchar(200) NOT NULL COMMENT '地点',
  `time` year(4) NOT NULL COMMENT '年份',
  `CODMn` varchar(10) NOT NULL COMMENT '高锰酸盐指数',
  `COD` varchar(10) NOT NULL COMMENT '化学需氧量',
  `BOD5` varchar(10) NOT NULL COMMENT '五日生化需氧量',
  `NH3_N` varchar(10) NOT NULL COMMENT '氨氮',
  `P` varchar(10) NOT NULL COMMENT '总磷',
  `As` varchar(10) NOT NULL COMMENT '砷',
  `Hg` varchar(10) NOT NULL COMMENT '汞',
  `Cd` varchar(10) NOT NULL COMMENT '镉',
  `Cr` varchar(10) NOT NULL COMMENT '铬',
  `Petroleum` varchar(10) NOT NULL COMMENT '石油类',
  `Anionicsurfactant` varchar(10) NOT NULL COMMENT '阴离子表面活性剂',
  `Sulfid` varchar(10) NOT NULL COMMENT '硫化物',
  `Coliforms` varchar(10) NOT NULL COMMENT '粪大肠杆菌群',
  `average` varchar(50) DEFAULT NULL COMMENT '平均值',
  `other` varchar(100) DEFAULT NULL COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评价参数k表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `parameter_k`
--

INSERT INTO `parameter_k` (`id`, `place`, `time`, `CODMn`, `COD`, `BOD5`, `NH3_N`, `P`, `As`, `Hg`, `Cd`, `Cr`, `Petroleum`, `Anionicsurfactant`, `Sulfid`, `Coliforms`, `average`, `other`) VALUES
(1, '樟树港', 2006, '7.7', '10.7', '9.1', '12.9', '11.3', '4.3', '3.1', '2', '0.7', '3.7', '0.9', '0.2', '33.3', NULL, NULL),
(2, '万家嘴', 2006, '7.3', '10.6', '5.9', '2.7', '4.2', '1.7', '4.2', '3.7', '5.2', '5.7', '11.6', '0.2', '37.1', NULL, NULL),
(3, '坡头', 2006, '11.2', '13.4', '5.2', '6.2', '20.6', '2.6', '2.5', '1.2', '5.3', '17.3', '6.2', '2.8', '5.4', NULL, NULL),
(4, '沙河口', 2006, '13.9', '15.5', '5.5', '8.5', '5.8', '2.6', '2.3', '1', '4.7', '16.7', '5.7', '3', '14.7', NULL, NULL),
(5, '南嘴', 2006, '20.4', '20.9', '10.1', '8.2', '15.5', '2.5', '6.1', '6.6', '1.2', '3.1', '3.1', '0.3', '2', NULL, NULL),
(6, '目平湖', 2006, '12.3', '17.5', '6.2', '7.6', '36', '1.7', '8', '2.3', '0.9', '2.2', '2.2', '0.4', '1.9', NULL, NULL),
(7, '小河嘴', 2006, '13.6', '17', '8', '8.1', '28.4', '2.6', '6.5', '6.9', '1.3', '3.3', '3.3', '0.3', '0.8', NULL, NULL),
(8, '万子湖', 2006, '17', '14.7', '10.3', '7.5', '20.7', '1.1', '5.3', '1.5', '0.5', '1.3', '1.3', '0.3', '18.5', NULL, NULL),
(9, '横岭湖', 2006, '15.5', '18', '7.8', '10.3', '24.3', '1.9', '9.3', '5.4', '0.9', '2.3', '2.3', '0.5', '1.6', NULL, NULL),
(10, '虞公庙', 2006, '13.3', '22', '8.3', '11', '12.6', '2.5', '6.3', '15.2', '1.3', '3.1', '3.1', '0.3', '1.1', NULL, NULL),
(11, '漉角', 2006, '11.6', '13', '12.5', '12.8', '13.5', '4.4', '3.9', '1.7', '1', '5', '1.3', '0.2', '18.9', NULL, NULL),
(12, '东洞庭湖', 2006, '8.9', '9.6', '8.5', '13', '14.3', '2', '3.4', '1', '0.5', '2.4', '0.6', '0.2', '35.6', NULL, NULL),
(13, '岳阳楼', 2006, '12.2', '14.9', '13.1', '12.6', '14.6', '4.2', '3.7', '2.2', '1', '5.1', '1.3', '0.3', '14.7', NULL, NULL),
(14, '洞庭湖出口', 2006, '12.1', '15.5', '12.9', '14.9', '14.4', '3.8', '3.5', '1.8', '1', '5', '1.2', '0.2', '13.4', NULL, NULL),
(15, '樟树港', 2016, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'new');

-- --------------------------------------------------------

--
-- 表的结构 `parameter_p`
--

CREATE TABLE IF NOT EXISTS `parameter_p` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `place` varchar(200) NOT NULL COMMENT '地点',
  `time` year(4) NOT NULL COMMENT '年份',
  `CODMn` varchar(10) NOT NULL COMMENT '高锰酸盐指数',
  `COD` varchar(10) NOT NULL COMMENT '化学需氧量',
  `BOD5` varchar(10) NOT NULL COMMENT '五日生化需氧量',
  `NH3_N` varchar(10) NOT NULL COMMENT '氨氮',
  `P` varchar(10) NOT NULL COMMENT '总磷',
  `As` varchar(10) NOT NULL COMMENT '砷',
  `Hg` varchar(10) NOT NULL COMMENT '汞',
  `Cd` varchar(10) NOT NULL COMMENT '镉',
  `Cr` varchar(10) NOT NULL COMMENT '铬',
  `Petroleum` varchar(10) NOT NULL COMMENT '石油类',
  `Anionicsurfactant` varchar(10) NOT NULL COMMENT '阴离子表面活性剂',
  `Sulfid` varchar(10) NOT NULL COMMENT '硫化物',
  `Coliforms` varchar(10) NOT NULL COMMENT '粪大肠杆菌群',
  `average` varchar(50) DEFAULT NULL COMMENT '平均值',
  `other` varchar(100) DEFAULT NULL COMMENT '数据状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评价参数p表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `parameter_p`
--

INSERT INTO `parameter_p` (`id`, `place`, `time`, `CODMn`, `COD`, `BOD5`, `NH3_N`, `P`, `As`, `Hg`, `Cd`, `Cr`, `Petroleum`, `Anionicsurfactant`, `Sulfid`, `Coliforms`, `average`, `other`) VALUES
(1, '樟树港', 2006, '0.4174', '0.5771', '0.4935', '0.7002', '0.6138', '0.2311', '0.1667', '0.1094', '0.04', '0.2', '0.05', '0.01', '1.8053', '0.4165', NULL),
(2, '万家嘴', 2006, '0.3475', '0.507', '0.2853', '0.1309', '0.2017', '0.08', '0.2', '0.1756', '0.2494', '0.2722', '0.5556', '0.01', '1.7775', '0.3687', NULL),
(3, '坡头', 2006, '0.4481', '0.5361', '0.2081', '0.2493', '0.8258', '0.1032', '0.1', '0.0483', '0.2128', '0.6928', '0.25', '0.1118', '0.2176', '0.308', NULL),
(4, '沙河口', 2006, '0.6082', '0.6767', '0.2388', '0.3725', '0.2514', '0.1142', '0.1', '0.0428', '0.205', '0.7311', '0.25', '0.1325', '0.6431', '0.3359', NULL),
(5, '南嘴', 2006, '0.6641', '0.6807', '0.3296', '0.2661', '0.5056', '0.08', '0.2', '0.214', '0.04', '0.1', '0.1', '0.01', '0.0666', '0.2505', NULL),
(6, '目平湖', 2006, '0.5616', '0.7998', '0.285', '0.3457', '1.6464', '0.08', '0.4', '0.1043', '0.04', '0.1', '0.1', '0.02', '0.0857', '0.3514', NULL),
(7, '小河嘴', 2006, '0.4164', '0.5192', '0.2438', '0.2467', '0.8708', '0.08', '0.2', '0.2111', '0.04', '0.1', '0.1', '0.01', '0.0235', '0.2355', NULL),
(8, '万子湖', 2006, '1.2763', '1.1031', '0.7741', '0.56', '1.55', '0.08', '0.4', '0.1122', '0.04', '0.1', '0.1', '0.02', '1.3844', '0.5769', NULL),
(9, '横岭湖', 2006, '0.6642', '0.7717', '0.3348', '0.4411', '1.0417', '0.08', '0.4', '0.2333', '0.04', '0.1', '0.1', '0.02', '0.0672', '0.3303', NULL),
(10, '虞公庙', 2006, '0.4261', '0.7044', '0.2667', '0.3508', '0.4028', '0.08', '0.2', '0.4856', '0.04', '0.1', '0.1', '0.01', '0.034', '0.2462', NULL),
(11, '漉角', 2006, '0.4612', '0.5152', '0.4942', '0.5087', '0.5365', '0.1728', '0.1556', '0.0672', '0.04', '0.2', '0.05', '0.01', '0.7496', '0.3047', NULL),
(12, '东洞庭湖', 2006, '0.7419', '0.8056', '0.71', '1.0837', '1.1933', '0.1661', '0.2833', '0.085', '0.04', '0.2', '0.05', '0.02', '2.9771', '0.6428', NULL),
(13, '岳阳楼', 2006, '0.4748', '0.582', '0.5088', '0.4924', '0.5689', '0.1633', '0.1444', '0.0878', '0.04', '0.2', '0.05', '0.01', '0.574', '0.2997', NULL),
(14, '洞庭湖出口', 2006, '0.4853', '0.6183', '0.517', '0.5947', '0.576', '0.1528', '0.1417', '0.0717', '0.04', '0.2', '0.05', '0.01', '0.5373', '0.3073', NULL),
(15, '樟树港', 2016, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `standards`
--

CREATE TABLE IF NOT EXISTS `standards` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `min` int(5) NOT NULL COMMENT '最小值',
  `max` int(5) NOT NULL COMMENT '最大值',
  `level` varchar(10) NOT NULL COMMENT '营养状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='营养状态分级标准表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `standards`
--

INSERT INTO `standards` (`id`, `min`, `max`, `level`) VALUES
(1, 0, 30, '贫营养'),
(2, 30, 50, '中营养'),
(3, 50, 60, '轻度营养'),
(4, 60, 70, '中度营养'),
(5, 70, 100, '重度营养');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `regdate` varchar(50) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `regdate`) VALUES
(1, '112', '111111', '112@qq.com', ''),
(2, '111', '96e79218965eb72c92a549dd5a330112', '111@qq.com', '1429618607');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
