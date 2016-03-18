-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 03 月 11 日 15:26
-- 服务器版本: 5.5.20
-- PHP 版本: 5.4.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yhcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `yh_access`
--

CREATE TABLE IF NOT EXISTS `yh_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yh_access`
--

INSERT INTO `yh_access` (`role_id`, `node_id`, `level`, `module`) VALUES
(1, 67, 3, NULL),
(1, 66, 3, NULL),
(1, 65, 3, NULL),
(1, 64, 3, NULL),
(1, 63, 2, NULL),
(1, 54, 3, NULL),
(1, 53, 3, NULL),
(1, 52, 3, NULL),
(1, 51, 2, NULL),
(1, 50, 3, NULL),
(1, 49, 3, NULL),
(1, 48, 3, NULL),
(1, 47, 3, NULL),
(1, 46, 2, NULL),
(1, 45, 3, NULL),
(1, 44, 3, NULL),
(1, 43, 3, NULL),
(1, 42, 3, NULL),
(1, 41, 2, NULL),
(1, 40, 3, NULL),
(1, 39, 3, NULL),
(1, 38, 3, NULL),
(1, 37, 3, NULL),
(1, 36, 2, NULL),
(1, 35, 3, NULL),
(1, 34, 3, NULL),
(1, 33, 3, NULL),
(1, 32, 3, NULL),
(1, 31, 2, NULL),
(1, 30, 3, NULL),
(1, 29, 3, NULL),
(1, 28, 3, NULL),
(1, 27, 3, NULL),
(1, 26, 3, NULL),
(1, 25, 2, NULL),
(1, 24, 3, NULL),
(1, 23, 3, NULL),
(1, 22, 3, NULL),
(1, 21, 3, NULL),
(1, 20, 3, NULL),
(1, 19, 2, NULL),
(1, 55, 3, NULL),
(1, 18, 3, NULL),
(1, 17, 2, NULL),
(1, 12, 3, NULL),
(1, 11, 3, NULL),
(1, 10, 3, NULL),
(1, 9, 3, NULL),
(1, 8, 3, NULL),
(1, 6, 3, NULL),
(1, 5, 3, NULL),
(1, 4, 3, NULL),
(1, 3, 3, NULL),
(1, 2, 2, NULL),
(1, 1, 1, NULL),
(1, 68, 2, NULL),
(1, 69, 3, NULL),
(1, 70, 3, NULL),
(1, 71, 3, NULL),
(1, 72, 3, NULL),
(1, 73, 2, NULL),
(1, 74, 3, NULL),
(1, 75, 3, NULL),
(1, 76, 3, NULL),
(1, 77, 3, NULL),
(1, 78, 3, NULL),
(1, 87, 2, NULL),
(1, 88, 3, NULL),
(1, 89, 3, NULL),
(1, 90, 3, NULL),
(1, 91, 3, NULL),
(1, 92, 2, NULL),
(1, 93, 3, NULL),
(1, 94, 3, NULL),
(1, 95, 3, NULL),
(1, 96, 3, NULL),
(1, 97, 3, NULL),
(1, 98, 3, NULL),
(1, 99, 3, NULL),
(1, 101, 2, NULL),
(1, 102, 3, NULL),
(1, 103, 3, NULL),
(1, 104, 3, NULL),
(1, 105, 3, NULL),
(1, 106, 3, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `yh_active`
--

CREATE TABLE IF NOT EXISTS `yh_active` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `code` varchar(11) NOT NULL DEFAULT '' COMMENT '激活码',
  `expire` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `updatetime` int(10) unsigned NOT NULL COMMENT '激活时间',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `yh_active`
--

INSERT INTO `yh_active` (`id`, `userid`, `type`, `code`, `expire`, `email`, `updatetime`) VALUES
(1, 1, 0, 'g825yjkvdiv', 1396581345, '', 0),
(2, 2, 0, 'LVmgULyYwY1', 1396774480, '', 0),
(3, 3, 0, 'IRYMUWRBQCl', 1396785968, '', 0),
(4, 4, 0, 'MSn57HkAlFC', 1396785996, '', 0),
(5, 5, 0, '4xnbCVyb7Kk', 1396786026, '', 0),
(6, 6, 0, 'gnqH6XUTKxN', 1396798207, '', 0),
(7, 7, 0, 'e5lFsJf9ZfR', 1396837850, '', 0),
(8, 8, 0, 'c6Hz9112rG8', 1396873874, '', 0),
(9, 9, 0, 'kZBGCzYLQm7', 1396877181, '', 0),
(10, 10, 0, 'bRNBEiQFTAR', 1396877239, '', 0),
(11, 11, 0, 'W71rNbLKvmK', 1396877334, '', 0),
(12, 12, 0, 'ntR32UUKaex', 1396881747, '', 0),
(13, 13, 0, '97RHhvgMkGr', 1396933149, '', 0),
(14, 14, 0, 'DJfx4cH6byK', 1396948838, '', 0),
(15, 15, 0, 'EU6S3ncpgn8', 1397000922, '', 0),
(16, 16, 0, 'TM7knKVvENA', 1397013893, '', 0),
(17, 17, 0, 'yAI2VGgpG76', 1397022112, '', 0),
(18, 18, 0, 'kdWnXjdJqVV', 1397046600, '', 0),
(19, 19, 0, '35tvqdWu7wq', 1397107936, '', 0),
(20, 20, 0, 'v2ic9sVkfk4', 1397109908, '', 0),
(21, 21, 0, 'UzXpZqIvuDA', 1397110928, '', 0),
(22, 22, 0, 'ECLdsgwrtL8', 1397145623, '', 0),
(23, 23, 0, 'QndkRdyL8lR', 1397217442, '', 0),
(24, 24, 0, 'PV2gh5RUlSg', 1397217530, '', 0),
(25, 25, 0, 'pJu3bLMDcwj', 1397224449, '', 0),
(26, 26, 0, 'ifl5XXL5IfD', 1397264138, '', 0),
(27, 27, 0, '7xEVPd4WSUx', 1397273855, '', 0),
(28, 28, 0, 'uXhBGNggHyN', 1397273936, '', 0),
(29, 29, 0, '3HIenxNyDtw', 1397275269, '', 0),
(30, 30, 0, '3nixfz8CFH7', 1397281981, '', 0),
(31, 31, 0, 'FlfvKHdbMsx', 1397289992, '', 0),
(32, 32, 0, 'h5Yf7AtMhU4', 1397291781, '', 0),
(33, 33, 0, 'XAcpMQBEWGM', 1397368941, '', 0),
(34, 34, 0, 'w99Vi6eplsD', 1397398496, '', 0),
(35, 35, 0, '9nEix7ndzqN', 1397462976, '', 0),
(36, 36, 0, '3jwYNV2HfzP', 1397483361, '', 0),
(37, 37, 0, '6mGpyTVy1sJ', 1397619963, '', 0),
(38, 38, 0, 'nrMtPtQqCvj', 1397625413, '', 0),
(39, 39, 0, 'jvnCijL1TyZ', 1397629591, '', 0),
(40, 40, 0, '8bv83y5W7Pm', 1397629772, '', 0),
(41, 41, 0, 'p6rlZJXLs9Y', 1397631012, '', 0),
(42, 42, 0, 'DbjcpqBYuRF', 1397654189, '', 0),
(43, 43, 0, 'ZZaLCrcm9jt', 1397703769, '', 0),
(44, 44, 0, 'd4jjyVphqYR', 1397746598, '', 0),
(45, 45, 0, 'BGHjMMgk2XV', 1397747820, '', 0),
(46, 46, 0, 'BWuQuGCH3iU', 1397897302, '', 0),
(47, 47, 0, 'wQiPtIlwmSY', 1397907408, '', 0),
(48, 48, 0, 'Qzg37WUMT4C', 1397935495, '', 0),
(49, 49, 0, 'xxlAumfjmD7', 1397965044, '', 0),
(50, 50, 0, '6K1yUAlbS7u', 1397984414, '', 0),
(51, 51, 0, 'dU8DLpuets1', 1398064406, '', 0),
(52, 52, 0, '1Ag5LvZd3NX', 1398160315, '', 0),
(53, 53, 0, 'wbySF4Kyc3c', 1398218821, '', 0),
(54, 54, 0, 'mLGjqAkT62M', 1398222982, '', 0),
(55, 55, 0, 'LpcKI4wQUBm', 1398311246, '', 0),
(56, 56, 0, '8vV6kPhwSfI', 1398337390, '', 0),
(57, 57, 0, 'jFgdXIWeux4', 1398339493, '', 0),
(58, 1, 0, 'giKh4uDcd2c', 1401508798, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_admin`
--

CREATE TABLE IF NOT EXISTS `yh_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `encrypt` varchar(6) NOT NULL DEFAULT '',
  `realname` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `usertype` tinyint(4) NOT NULL DEFAULT '0',
  `logintime` int(10) unsigned NOT NULL COMMENT '登录时间',
  `loginip` varchar(30) NOT NULL COMMENT '登录IP',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '锁定状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `yh_admin`
--

INSERT INTO `yh_admin` (`id`, `username`, `password`, `encrypt`, `realname`, `email`, `usertype`, `logintime`, `loginip`, `islock`) VALUES
(1, 'admin', '9d553a4d24b10c9b9f072e868e8311a9', 'ML7QxP', '', '', 9, 1457664322, '0.0.0.0', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_announce`
--

CREATE TABLE IF NOT EXISTS `yh_announce` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_area`
--

CREATE TABLE IF NOT EXISTS `yh_area` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `sname` varchar(10) NOT NULL DEFAULT '' COMMENT '简称',
  `ename` varchar(50) NOT NULL DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `is_top` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yh_area`
--

INSERT INTO `yh_area` (`id`, `name`, `sname`, `ename`, `pid`, `sort`, `is_top`) VALUES
(1, '北京市', '北京', 'beijing', 0, 0, 0),
(2, '上海市', '上海', 'shanghai', 0, 0, 1),
(3, '天津市', '天津', 'tianjing', 0, 0, 0),
(4, '重庆市', '重庆', 'chongqing', 0, 0, 0),
(5, '广东省', '广东', 'guangdong', 0, 0, 0),
(6, '福建省', '福建', 'fujian', 0, 0, 0),
(7, '浙江省', '浙江', 'zhejiang', 0, 0, 0),
(8, '江苏省', '江苏', 'jiangsu', 0, 0, 0),
(9, '山东省', '山东', 'shandong', 0, 0, 0),
(10, '辽宁省', '辽宁', 'liaoning', 0, 0, 0),
(11, '江西省', '江西', 'jiangxi', 0, 0, 0),
(12, '四川省', '四川', 'sichuan', 0, 0, 0),
(13, '陕西省', '陕西', 'shanxi', 0, 0, 0),
(14, '湖北省', '湖北', 'hubei', 0, 0, 0),
(15, '河南省', '河南', 'henan', 0, 0, 0),
(16, '河北省', '河北', 'hebei', 0, 0, 0),
(17, '山西省', '山西', 'shanxi', 0, 0, 0),
(18, '内蒙古', '内蒙古', 'neimengug', 0, 0, 0),
(19, '吉林省', '吉林', 'jiling', 0, 0, 0),
(20, '黑龙江', '黑龙江', 'heilongjiang', 0, 0, 0),
(21, '安徽省', '安徽', 'anhui', 0, 0, 0),
(22, '湖南省', '湖南', 'hunan', 0, 0, 0),
(23, '广西', '广西', 'guangxi', 0, 0, 0),
(24, '海南省', '海南', 'hainan', 0, 0, 0),
(25, '云南省', '云南', 'yunnan', 0, 0, 0),
(26, '贵州省', '贵州', 'guizhou', 0, 0, 0),
(27, '西藏', '西藏', 'xicang', 0, 0, 0),
(28, '甘肃省', '甘肃', 'gansu', 0, 0, 0),
(29, '宁夏区', '宁夏区', 'ningxiaqu', 0, 0, 0),
(30, '青海省', '青海', 'qinghai', 0, 0, 0),
(31, '新疆', '新疆', 'xinjiang', 0, 0, 0),
(32, '香港', '香港', 'xianggang', 0, 0, 0),
(33, '澳门', '澳门', 'aomen', 0, 0, 0),
(34, '台湾省', '台湾', 'taiwan', 0, 0, 0),
(415, '永川市', '永川', 'yongchuan', 4, 0, 0),
(416, '合川市', '合川', 'hechuan', 4, 0, 0),
(417, '江津市', '江津', 'jiangjin', 4, 0, 0),
(418, '南川市', '南川', 'nanchuan', 4, 0, 0),
(501, '广州市', '广州', 'guangzhou', 5, 0, 0),
(502, '深圳市', '深圳', 'shenzhen', 5, 0, 0),
(503, '珠海市', '珠海', 'zhuhai', 5, 0, 0),
(504, '汕头市', '汕头', 'shantou', 5, 0, 0),
(505, '韶关市', '韶关', 'shaoguan', 5, 0, 0),
(506, '河源市', '河源', 'heyuan', 5, 0, 0),
(507, '梅州市', '梅州', 'meizhou', 5, 0, 0),
(508, '惠州市', '惠州', 'huizhou', 5, 0, 0),
(509, '汕尾市', '汕尾', 'shanwei', 5, 0, 0),
(510, '东莞市', '东莞', 'dongguan', 5, 0, 0),
(511, '中山市', '中山', 'zhongshan', 5, 0, 0),
(512, '江门市', '江门', 'jiangmen', 5, 0, 0),
(513, '佛山市', '佛山', 'foshan', 5, 0, 0),
(514, '阳江市', '阳江', 'yangjiang', 5, 0, 0),
(515, '湛江市', '湛江', 'zhanjiang', 5, 0, 0),
(516, '茂名市', '茂名', 'maoming', 5, 0, 0),
(517, '肇庆市', '肇庆', 'zhaoqing', 5, 0, 0),
(518, '清远市', '清远', 'qingyuan', 5, 0, 0),
(519, '潮州市', '潮州', 'chaozhou', 5, 0, 0),
(520, '揭阳市', '揭阳', 'jieyang', 5, 0, 0),
(521, '云浮市', '云浮', 'yunfu', 5, 0, 0),
(601, '福州市', '福州', 'fuzhou', 6, 0, 0),
(602, '厦门市', '厦门', 'xiamen', 6, 0, 0),
(603, '三明市', '三明', 'sanming', 6, 0, 0),
(604, '莆田市', '莆田', 'putian', 6, 0, 0),
(605, '泉州市', '泉州', 'quanzhou', 6, 0, 0),
(606, '漳州市', '漳州', 'zhangzhou', 6, 0, 0),
(607, '南平市', '南平', 'nanping', 6, 0, 0),
(608, '龙岩市', '龙岩', 'longyan', 6, 0, 0),
(609, '宁德市', '宁德', 'ningde', 6, 0, 0),
(701, '杭州市', '杭州', 'hangzhou', 7, 0, 0),
(702, '宁波市', '宁波', 'ningbo', 7, 0, 0),
(703, '温州市', '温州', 'wenzhou', 7, 0, 0),
(704, '嘉兴市', '嘉兴', 'jiaxing', 7, 0, 0),
(705, '湖州市', '湖州', 'huzhou', 7, 0, 0),
(706, '绍兴市', '绍兴', 'shaoxing', 7, 0, 0),
(707, '金华市', '金华', 'jinhua', 7, 0, 0),
(708, '衢州市', '衢州', 'quzhou', 7, 0, 0),
(709, '舟山市', '舟山', 'zhoushan', 7, 0, 0),
(710, '台州市', '台州', 'taizhou', 7, 0, 0),
(711, '丽水市', '丽水', 'lishui', 7, 0, 0),
(801, '南京市', '南京', 'nanjing', 8, 0, 1),
(802, '徐州市', '徐州', 'xuzhou', 8, 0, 0),
(803, '连云港市', '连云港', 'lianyungang', 8, 0, 0),
(804, '淮安市', '淮安', 'huaian', 8, 0, 0),
(805, '宿迁市', '宿迁', 'suqian', 8, 0, 0),
(806, '盐城市', '盐城', 'yancheng', 8, 0, 0),
(807, '扬州市', '扬州', 'yangzhou', 8, 0, 0),
(808, '泰州市', '泰州', 'taizhou', 8, 0, 0),
(809, '南通市', '南通', 'nantong', 8, 0, 0),
(810, '镇江市', '镇江', 'zhenjiang', 8, 0, 1),
(811, '常州市', '常州', 'changzhou', 8, 0, 1),
(812, '无锡市', '无锡', 'wuxishi', 8, 0, 1),
(813, '苏州市', '苏州', 'suzhoushi', 8, 0, 0),
(901, '济南市', '济南', 'jinan', 9, 0, 0),
(902, '青岛市', '青岛', 'qingdao', 9, 0, 0),
(903, '淄博市', '淄博', 'zibo', 9, 0, 0),
(904, '枣庄市', '枣庄', 'zaozhuang', 9, 0, 0),
(905, '东营市', '东营', 'dongying', 9, 0, 0),
(906, '潍坊市', '潍坊', 'weifang', 9, 0, 0),
(907, '烟台市', '烟台', 'yantai', 9, 0, 0),
(908, '威海市', '威海', 'weihai', 9, 0, 0),
(909, '济宁市', '济宁', 'jining', 9, 0, 0),
(910, '泰安市', '泰安', 'taian', 9, 0, 0),
(911, '日照市', '日照', 'rizhao', 9, 0, 0),
(912, '莱芜市', '莱芜', 'laiwu', 9, 0, 0),
(913, '德州市', '德州', 'dezhou', 9, 0, 0),
(914, '临沂市', '临沂', 'linyi', 9, 0, 0),
(915, '聊城市', '聊城', 'liaocheng', 9, 0, 0),
(916, '滨州市', '滨州', 'binzhou', 9, 0, 0),
(917, '菏泽市', '菏泽', 'heze', 9, 0, 0),
(1001, '沈阳市', '沈阳', 'shenyang', 10, 0, 0),
(1002, '大连市', '大连', 'dalian', 10, 0, 0),
(1003, '鞍山市', '鞍山', 'anshan', 10, 0, 0),
(1004, '抚顺市', '抚顺', 'fushun', 10, 0, 0),
(1005, '本溪市', '本溪', 'benxi', 10, 0, 0),
(1006, '丹东市', '丹东', 'dandong', 10, 0, 0),
(1007, '锦州市', '锦州', 'jinzhou', 10, 0, 0),
(1008, '葫芦岛市', '葫芦岛', 'huludao', 10, 0, 0),
(1009, '营口市', '营口', 'yingkou', 10, 0, 0),
(1010, '盘锦市', '盘锦', 'panjin', 10, 0, 0),
(1011, '阜新市', '阜新', 'fuxin', 10, 0, 0),
(1012, '辽阳市', '辽阳', 'liaoyang', 10, 0, 0),
(1013, '铁岭市', '铁岭', 'tieling', 10, 0, 0),
(1014, '朝阳市', '朝阳', 'chaoyang', 10, 0, 0),
(1101, '南昌市', '南昌', 'nanchang', 11, 0, 0),
(1102, '景德镇市', '景德镇', 'jingdezhen', 11, 0, 0),
(1103, '萍乡市', '萍乡', 'pingxiang', 11, 0, 0),
(1104, '新余市', '新余', 'xinyu', 11, 0, 0),
(1105, '九江市', '九江', 'jiujiang', 11, 0, 0),
(1106, '鹰潭市', '鹰潭', 'yingtan', 11, 0, 0),
(1107, '赣州市', '赣州', 'ganzhou', 11, 0, 0),
(1108, '吉安市', '吉安', 'jian', 11, 0, 0),
(1109, '宜春市', '宜春', 'yichun', 11, 0, 0),
(1110, '抚州市', '抚州', 'fuzhou', 11, 0, 0),
(1111, '上饶市', '上饶', 'shangrao', 11, 0, 0),
(1201, '成都市', '成都', 'chengdu', 12, 0, 0),
(1202, '自贡市', '自贡', 'zigong', 12, 0, 0),
(1203, '攀枝花市', '攀枝花', 'panzhihua', 12, 0, 0),
(1204, '泸州市', '泸州', 'luzhou', 12, 0, 0),
(1205, '德阳市', '德阳', 'deyang', 12, 0, 0),
(1206, '绵阳市', '绵阳', 'mianyang', 12, 0, 0),
(1207, '广元市', '广元', 'guangyuan', 12, 0, 0),
(1208, '遂宁市', '遂宁', 'suining', 12, 0, 0),
(1209, '内江市', '内江', 'najiang', 12, 0, 0),
(1210, '乐山市', '乐山', 'leshan', 12, 0, 0),
(1211, '南充市', '南充', 'nanchong', 12, 0, 0),
(1212, '宜宾市', '宜宾', 'yibin', 12, 0, 0),
(1213, '广安市', '广安', 'guangan', 12, 0, 0),
(1214, '达州市', '达州', 'dazhou', 12, 0, 0),
(1215, '巴中市', '巴中', 'bazhong', 12, 0, 0),
(1216, '雅安市', '雅安', 'yaan', 12, 0, 0),
(1217, '眉山市', '眉山', 'meishan', 12, 0, 0),
(1218, '资阳市', '资阳', 'ziyang', 12, 0, 0),
(1219, '阿坝州', '阿坝', 'aba', 12, 0, 0),
(1220, '甘孜州', '甘孜', 'ganzi', 12, 0, 0),
(1221, '凉山州', '凉山', 'liangshan', 12, 0, 0),
(3114, '西安市', '西安', 'xian', 13, 0, 0),
(1302, '铜川市', '铜川', 'tongchuan', 13, 0, 0),
(1303, '宝鸡市', '宝鸡', 'baoji', 13, 0, 0),
(1304, '咸阳市', '咸阳', 'xianyang', 13, 0, 0),
(1305, '渭南市', '渭南', 'weinan', 13, 0, 0),
(1306, '延安市', '延安', 'yanan', 13, 0, 0),
(1307, '汉中市', '汉中', 'hanzhong', 13, 0, 0),
(1308, '榆林市', '榆林', 'yulin', 13, 0, 0),
(1309, '安康市', '安康', 'ankang', 13, 0, 0),
(1310, '商洛地区', '商洛地区', 'shangluodiqu', 13, 0, 0),
(1401, '武汉市', '武汉', 'wuhan', 14, 0, 0),
(1402, '黄石市', '黄石', 'huangshi', 14, 0, 0),
(1403, '襄樊市', '襄樊', 'xiangfan', 14, 0, 0),
(1404, '十堰市', '十堰', 'shiyan', 14, 0, 0),
(1405, '荆州市', '荆州', 'jingzhou', 14, 0, 0),
(1406, '宜昌市', '宜昌', 'yichang', 14, 0, 0),
(1407, '荆门市', '荆门', 'jingmen', 14, 0, 0),
(1408, '鄂州市', '鄂州', 'ezhou', 14, 0, 0),
(1409, '孝感市', '孝感', 'xiaogan', 14, 0, 0),
(1410, '黄冈市', '黄冈', 'huanggang', 14, 0, 0),
(1411, '咸宁市', '咸宁', 'xianning', 14, 0, 0),
(1412, '随州市', '随州', 'suizhou', 14, 0, 0),
(1413, '仙桃市', '仙桃', 'xiantao', 14, 0, 0),
(1414, '天门市', '天门', 'tianmen', 14, 0, 0),
(1415, '潜江市', '潜江', 'qianjiang', 14, 0, 0),
(1416, '神农架', '神农架', 'shennongjia', 14, 0, 0),
(1417, '恩施州', '恩施', 'enshi', 14, 0, 0),
(1501, '郑州市', '郑州', 'zhengzhou', 15, 0, 0),
(1502, '开封市', '开封', 'kaifeng', 15, 0, 0),
(1503, '洛阳市', '洛阳', 'luoyang', 15, 0, 0),
(1504, '平顶山市', '平顶山', 'pingdingshan', 15, 0, 0),
(1505, '焦作市', '焦作', 'jiaozuo', 15, 0, 0),
(1506, '鹤壁市', '鹤壁', 'hebi', 15, 0, 0),
(1507, '新乡市', '新乡', 'xinxiang', 15, 0, 0),
(1508, '安阳市', '安阳', 'anyang', 15, 0, 0),
(1509, '濮阳市', '濮阳', 'puyang', 15, 0, 0),
(1510, '许昌市', '许昌', 'xuchang', 15, 0, 0),
(1511, '漯河市', '漯河', 'leihe', 15, 0, 0),
(1512, '三门峡市', '三门峡', 'sanmenxia', 15, 0, 0),
(1513, '南阳市', '南阳', 'nanyang', 15, 0, 0),
(1514, '商丘市', '商丘', 'shangqiu', 15, 0, 0),
(1515, '信阳市', '信阳', 'xinyang', 15, 0, 0),
(1516, '周口市', '周口', 'zhoukou', 15, 0, 0),
(1517, '驻马店市', '驻马店', 'zhumadian', 15, 0, 0),
(1518, '济源市', '济源', 'jiyuan', 15, 0, 0),
(1601, '石家庄市', '石家庄', 'shijiazhuang', 16, 0, 0),
(1602, '唐山市', '唐山', 'tangshan', 16, 0, 0),
(1603, '秦皇岛市', '秦皇岛', 'qinhuangdao', 16, 0, 0),
(1604, '邯郸市', '邯郸', 'handan', 16, 0, 0),
(1605, '邢台市', '邢台', 'xingtai', 16, 0, 0),
(1606, '保定市', '保定', 'baoding', 16, 0, 0),
(1607, '张家口市', '张家口', 'zhangjiakou', 16, 0, 0),
(1608, '承德市', '承德', 'chengde', 16, 0, 0),
(1609, '沧州市', '沧州', 'cangzhou', 16, 0, 0),
(1610, '廊坊市', '廊坊', 'langfang', 16, 0, 0),
(1611, '衡水市', '衡水', 'hengshui', 16, 0, 0),
(1701, '太原市', '太原', 'taiyuan', 17, 0, 0),
(1702, '大同市', '大同', 'datong', 17, 0, 0),
(1703, '阳泉市', '阳泉', 'yangquan', 17, 0, 0),
(1704, '长治市', '长治', 'changzhi', 17, 0, 0),
(1705, '晋城市', '晋城', 'jincheng', 17, 0, 0),
(1706, '朔州市', '朔州', 'shuozhou', 17, 0, 0),
(1707, '晋中市', '晋中', 'jinzhong', 17, 0, 0),
(1708, '忻州市', '忻州', 'xinzhou', 17, 0, 0),
(1709, '临汾市', '临汾', 'linfen', 17, 0, 0),
(1710, '运城市', '运城', 'yuncheng', 17, 0, 0),
(1711, '吕梁地区', '吕梁地区', 'lvliangdiqu', 17, 0, 0),
(1801, '呼和浩特', '呼和浩特', 'huhehaote', 18, 0, 0),
(1802, '包头市', '包头', 'baotou', 18, 0, 0),
(1803, '乌海市', '乌海', 'wuhai', 18, 0, 0),
(1804, '赤峰市', '赤峰', 'chifeng', 18, 0, 0),
(1805, '通辽市', '通辽', 'tongliao', 18, 0, 0),
(1806, '鄂尔多斯', '鄂尔多斯', 'eerduosi', 18, 0, 0),
(1807, '乌兰察布', '乌兰察布', 'wulanchabu', 18, 0, 0),
(1808, '锡林郭勒', '锡林郭勒', 'xilinguole', 18, 0, 0),
(1809, '呼伦贝尔', '呼伦贝尔', 'hulunbeier', 18, 0, 0),
(1810, '巴彦淖尔', '巴彦淖尔', 'bayanneer', 18, 0, 0),
(1811, '阿拉善盟', '阿拉善盟', 'alashanmeng', 18, 0, 0),
(1812, '兴安盟', '兴安盟', 'xinganmeng', 18, 0, 0),
(1901, '长春市', '长春', 'changchun', 19, 0, 0),
(1902, '吉林市', '吉林', 'jilin', 19, 0, 0),
(1903, '四平市', '四平', 'siping', 19, 0, 0),
(1904, '辽源市', '辽源', 'liaoyuan', 19, 0, 0),
(1905, '通化市', '通化', 'tonghua', 19, 0, 0),
(1906, '白山市', '白山', 'baishan', 19, 0, 0),
(1907, '松原市', '松原', 'songyuan', 19, 0, 0),
(1908, '白城市', '白城', 'baicheng', 19, 0, 0),
(1909, '延边州', '延边', 'yanbian', 19, 0, 0),
(2001, '哈尔滨市', '哈尔滨', 'haerbin', 20, 0, 0),
(2002, '齐齐哈尔', '齐齐哈尔', 'qiqihaer', 20, 0, 0),
(2003, '鹤岗市', '鹤岗', 'hegang', 20, 0, 0),
(2004, '双鸭山市', '双鸭山', 'shuangyashan', 20, 0, 0),
(2005, '鸡西市', '鸡西', 'jixi', 20, 0, 0),
(2006, '大庆市', '大庆', 'daqing', 20, 0, 0),
(2007, '伊春市', '伊春', 'yichun', 20, 0, 0),
(2008, '牡丹江市', '牡丹江', 'mudanjiang', 20, 0, 0),
(2009, '佳木斯市', '佳木斯', 'jiamusi', 20, 0, 0),
(2010, '七台河市', '七台河', 'qitaihe', 20, 0, 0),
(2011, '黑河市', '黑河', 'heihe', 20, 0, 0),
(2012, '绥化市', '绥化', 'suihua', 20, 0, 0),
(2013, '大兴安岭', '大兴安岭', 'daxinganling', 20, 0, 0),
(2101, '合肥市', '合肥', 'hefei', 21, 0, 0),
(2102, '芜湖市', '芜湖', 'wuhu', 21, 0, 0),
(2103, '蚌埠市', '蚌埠', 'bangbu', 21, 0, 0),
(2104, '淮南市', '淮南', 'huainan', 21, 0, 0),
(2105, '马鞍山市', '马鞍山', 'maanshan', 21, 0, 0),
(2106, '淮北市', '淮北', 'huaibei', 21, 0, 0),
(2107, '铜陵市', '铜陵', 'tongling', 21, 0, 0),
(2108, '安庆市', '安庆', 'anqing', 21, 0, 0),
(2109, '黄山市', '黄山', 'huangshan', 21, 0, 0),
(2110, '滁州市', '滁州', 'chuzhou', 21, 0, 0),
(2111, '阜阳市', '阜阳', 'fuyang', 21, 0, 0),
(2112, '宿州市', '宿州', 'suzhou', 21, 0, 0),
(2113, '巢湖市', '巢湖', 'chaohu', 21, 0, 0),
(2114, '六安市', '六安', 'liuan', 21, 0, 0),
(2115, '亳州市', '亳州', 'bozhou', 21, 0, 0),
(2116, '宣城市', '宣城', 'xuancheng', 21, 0, 0),
(2117, '池州市', '池州', 'chizhou', 21, 0, 0),
(2201, '长沙市', '长沙', 'changsha', 22, 0, 0),
(2202, '株州市', '株州', 'zhuzhou', 22, 0, 0),
(2203, '湘潭市', '湘潭', 'xiangtan', 22, 0, 0),
(2204, '衡阳市', '衡阳', 'hengyang', 22, 0, 0),
(2205, '邵阳市', '邵阳', 'shaoyang', 22, 0, 0),
(2206, '岳阳市', '岳阳', 'yueyang', 22, 0, 0),
(2207, '常德市', '常德', 'changde', 22, 0, 0),
(2208, '张家界市', '张家界', 'zhangjiajie', 22, 0, 0),
(2209, '益阳市', '益阳', 'yiyang', 22, 0, 0),
(2210, '郴州市', '郴州', 'chenzhou', 22, 0, 0),
(2211, '永州市', '永州', 'yongzhou', 22, 0, 0),
(2212, '怀化市', '怀化', 'huaihua', 22, 0, 0),
(2213, '娄底市', '娄底', 'loudi', 22, 0, 0),
(2214, '湘西州', '湘西', 'xiangxi', 22, 0, 0),
(2301, '南宁市', '南宁', 'nanning', 23, 0, 0),
(2302, '柳州市', '柳州', 'liuzhou', 23, 0, 0),
(2303, '桂林市', '桂林', 'guilin', 23, 0, 0),
(2304, '梧州市', '梧州', 'wuzhou', 23, 0, 0),
(2305, '北海市', '北海', 'beihai', 23, 0, 0),
(2306, '防城港市', '防城港', 'fangchenggang', 23, 0, 0),
(2307, '钦州市', '钦州', 'qinzhou', 23, 0, 0),
(2308, '贵港市', '贵港', 'guigang', 23, 0, 0),
(2309, '玉林市', '玉林', 'yulin', 23, 0, 0),
(2310, '南宁地区', '南宁地区', 'nanningdiqu', 23, 0, 0),
(2311, '柳州地区', '柳地区', 'liudiqu', 23, 0, 0),
(2312, '贺州地区', '贺地区', 'hediqu', 23, 0, 0),
(2313, '百色地区', '百色地区', 'baisediqu', 23, 0, 0),
(2314, '河池地区', '河池地区', 'hechidiqu', 23, 0, 0),
(2401, '海口市', '海口', 'haikou', 24, 0, 0),
(2402, '三亚市', '三亚', 'sanya', 24, 0, 0),
(2403, '五指山市', '五指山', 'wuzhishan', 24, 0, 0),
(2404, '琼海市', '琼海', 'qionghai', 24, 0, 0),
(2405, '儋州市', '儋州', 'danzhou', 24, 0, 0),
(2406, '琼山市', '琼山', 'qiongshan', 24, 0, 0),
(2407, '文昌市', '文昌', 'wenchang', 24, 0, 0),
(2408, '万宁市', '万宁', 'wanning', 24, 0, 0),
(2409, '东方市', '东方', 'dongfang', 24, 0, 0),
(2501, '昆明市', '昆明', 'kunming', 25, 0, 0),
(2502, '曲靖市', '曲靖', 'qujing', 25, 0, 0),
(2503, '玉溪市', '玉溪', 'yuxi', 25, 0, 0),
(2504, '保山市', '保山', 'baoshan', 25, 0, 0),
(2505, '昭通市', '昭通', 'zhaotong', 25, 0, 0),
(2506, ' 普洱市', ' 普洱', 'puer', 25, 0, 0),
(2507, '临沧市', '临沧', 'lincang', 25, 0, 0),
(2508, '丽江市', '丽江', 'lijiang', 25, 0, 0),
(2509, '文山州', '文山', 'wenshan', 25, 0, 0),
(2510, '红河州', '红河', 'honghe', 25, 0, 0),
(2511, '西双版纳', '西双版纳', 'xishuangbanna', 25, 0, 0),
(2512, '楚雄州', '楚雄', 'chuxiong', 25, 0, 0),
(2513, '大理州', '大理', 'dali', 25, 0, 0),
(2514, '德宏州', '德宏', 'dehong', 25, 0, 0),
(2515, '怒江州', '怒江', 'nujiang', 25, 0, 0),
(2516, '迪庆州', '迪庆', 'diqing', 25, 0, 0),
(2601, '贵阳市', '贵阳', 'guiyang', 26, 0, 0),
(2602, '六盘水市', '六盘水', 'liupanshui', 26, 0, 0),
(2603, '遵义市', '遵义', 'zunyi', 26, 0, 0),
(2604, '安顺市', '安顺', 'anshun', 26, 0, 0),
(2605, '铜仁地区', '铜仁地区', 'tongrendiqu', 26, 0, 0),
(2606, '毕节地区', '毕节地区', 'bijiediqu', 26, 0, 0),
(2607, '黔西南州', '黔西南', 'qianxinan', 26, 0, 0),
(2608, '黔东南州', '黔东南', 'qiandongnan', 26, 0, 0),
(2609, '黔南州', '黔南', 'qiannan', 26, 0, 0),
(2701, '拉萨市', '拉萨', 'lasa', 27, 0, 0),
(2702, '那曲地区', '那曲地区', 'naqudiqu', 27, 0, 0),
(2703, '昌都地区', '昌都地区', 'changdudiqu', 27, 0, 0),
(2704, '山南地区', '山南地区', 'shannandiqu', 27, 0, 0),
(2705, '日喀则', '日喀则', 'rikaze', 27, 0, 0),
(2706, '阿里地区', '阿里地区', 'alidiqu', 27, 0, 0),
(2707, '林芝地区', '林芝地区', 'linzhidiqu', 27, 0, 0),
(2801, '兰州市', '兰州', 'lanzhou', 28, 0, 0),
(2802, '金昌市', '金昌', 'jinchang', 28, 0, 0),
(2803, '白银市', '白银', 'baiyin', 28, 0, 0),
(2804, '天水市', '天水', 'tianshui', 28, 0, 0),
(2805, '嘉峪关市', '嘉峪关', 'jiayuguan', 28, 0, 0),
(2806, '武威市', '武威', 'wuwei', 28, 0, 0),
(2807, '定西地区', '定西地区', 'dingxidiqu', 28, 0, 0),
(2808, '平凉地区', '平凉地区', 'pingliangdiqu', 28, 0, 0),
(2809, '庆阳地区', '庆阳地区', 'qingyangdiqu', 28, 0, 0),
(2810, '陇南地区', '陇南地区', 'longnandiqu', 28, 0, 0),
(2811, '张掖地区', '张掖地区', 'zhangyediqu', 28, 0, 0),
(2812, '酒泉地区', '酒泉地区', 'jiuquandiqu', 28, 0, 0),
(2813, '甘南州', '甘南', 'gannan', 28, 0, 0),
(2814, '临夏州', '临夏', 'linxia', 28, 0, 0),
(2901, '银川市', '银川', 'yinchuan', 29, 0, 0),
(2902, '石嘴山市', '石嘴山', 'shizuishan', 29, 0, 0),
(2903, '吴忠市', '吴忠', 'wuzhong', 29, 0, 0),
(2904, '固原市', '固原', 'guyuan', 29, 0, 0),
(3001, '西宁市', '西宁', 'xining', 30, 0, 0),
(3002, '海东地区', '海东地区', 'haidongdiqu', 30, 0, 0),
(3003, '海北州', '海北', 'haibei', 30, 0, 0),
(3004, '黄南州', '黄南', 'huangnan', 30, 0, 0),
(3005, '海南州', '海南', 'hainan', 30, 0, 0),
(3006, '果洛州', '果洛', 'guoluo', 30, 0, 0),
(3007, '玉树州', '玉树', 'yushu', 30, 0, 0),
(3008, '海西州', '海西', 'haixi', 30, 0, 0),
(3101, '乌鲁木齐', '乌鲁木齐', 'wulumuqi', 31, 0, 0),
(3102, '克拉玛依', '克拉玛依', 'kelamayi', 31, 0, 0),
(3103, '石河子市', '石河子', 'shihezi', 31, 0, 0),
(3104, '吐鲁番', '吐鲁番', 'tulufan', 31, 0, 0),
(3105, '哈密地区', '哈密地区', 'hamidiqu', 31, 0, 0),
(3106, '和田地区', '和田地区', 'hetiandiqu', 31, 0, 0),
(3107, '阿克苏', '阿克苏', 'akesu', 31, 0, 0),
(3108, '喀什地区', '喀什地区', 'kashidiqu', 31, 0, 0),
(3109, '克孜勒苏', '克孜勒苏', 'kezilesu', 31, 0, 0),
(3110, '巴音郭楞', '巴音郭楞', 'bayinguoleng', 31, 0, 0),
(3111, '昌吉州', '昌吉', 'changji', 31, 0, 0),
(3112, '博尔塔拉', '博尔塔拉', 'boertala', 31, 0, 0),
(3113, '伊犁州', '伊犁', 'yili', 31, 0, 0),
(3201, '香港岛', '香港岛', 'xianggangdao', 32, 0, 0),
(3202, '九龙', '九龙', 'jiulong', 32, 0, 0),
(3203, '新界', '新界', 'xinjie', 32, 0, 0),
(3301, '澳门半岛', '澳门半岛', 'aomenbandao', 33, 0, 0),
(3302, '离岛', '离岛', 'lidao', 33, 0, 0),
(3401, '台北市', '台北', 'taibei', 34, 0, 0),
(3402, '高雄市', '高雄', 'gaoxiong', 34, 0, 0),
(3403, '台南市', '台南', 'tainan', 34, 0, 0),
(3404, '台中市', '台中', 'taizhong', 34, 0, 0),
(3407, '基隆市', '基隆', 'jilong', 34, 0, 0),
(3408, '新竹市', '新竹', 'xinzhu', 34, 0, 0),
(3409, '嘉义市', '嘉义', 'jiayi', 34, 0, 0),
(3410, '新北市', '新北', 'xinbei', 34, 0, 0),
(6019, '丹阳市', '丹阳', 'danyang', 810, 1, 0),
(6020, '扬中市', '扬中', 'yangzhong', 810, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_article`
--

CREATE TABLE IF NOT EXISTS `yh_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '标题',
  `etitle` varchar(200) DEFAULT NULL,
  `shorttitle` varchar(30) NOT NULL DEFAULT '' COMMENT '副标题',
  `color` char(10) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `copyfrom` varchar(30) NOT NULL DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `source` varchar(30) DEFAULT NULL,
  `keywords` varchar(1000) DEFAULT '' COMMENT '关键字',
  `tag` varchar(250) DEFAULT NULL,
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `sort` smallint(6) DEFAULT NULL,
  `commentflag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许评论',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性',
  `jumpurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'admin',
  `publish` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `yh_article`
--

INSERT INTO `yh_article` (`id`, `title`, `etitle`, `shorttitle`, `color`, `copyfrom`, `author`, `source`, `keywords`, `tag`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `sort`, `commentflag`, `flag`, `jumpurl`, `status`, `userid`, `aid`, `publish`) VALUES
(1, '为什么要建立企业型营销型手机网站', '', '', '', '', 'admin', '本站', '', '', '', '<p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><strong style="padding: 0px; margin: 0px;">第一个，营销型手机网站的建议有利于提高手机用户体验度</strong></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　智能手机越来越普遍，使用也方便，慢慢地就代替了电脑。不知道大家有没有发现，你的PC网站在手机上打开的时候，页面非常的大，手机那么小的屏幕浏览起来非常的不方便，用户体验极差。用户看到这样的企业网站，我相信都会感觉这个企业没有实力，一个手机网站都没有。</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　PC网站，就是指电脑，平板上用的网站。但是，PC网站对于手机上浏览就不行了。所以，我们有必要做一个针对手机用户的手机企业网站。手机网站是针对手机而做的网站，排版，大小，体验都是为了手机用户而设计的，浏览起来也非常的方便，舒服。</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　<strong style="padding: 0px; margin: 0px;">第二个、营销型手机网站建设可以降低企业运作成本，提高企业运营活力</strong></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　提供即时商业讯息、商品目录、广告行销内容。资料放手机网站上，不仅立即“问世”，开始发挥效用，更可随时更新、更正，省时省事，节省大笔的人力及印刷经费。广告行销成本低，回收利率高。同其他广告媒体相比手机网站的成本极低。降低公司“售前询问”及“售后服务”的营运成本。能把广告行销与订购连成一体，促进购买意愿。不与现有其他传统商业媒体冲突或重复，减少浪费。</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　随着手机的普及、手机网站建设技术的成熟，结合无线网络的优势，我们也应该把手机网站纳入企业的信息化建设中来。</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　<strong style="padding: 0px; margin: 0px;">第三个，手机搜索企业网站可以跳转到手机网站</strong></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　许多企业网站都是做了好多年了，一些关键词排名都还是非常不错的。虽然手机网站制作的是另一个网站和PC站不是一体的。但是，只要你再同一个网站公司建设的企业网站和手机网站，那网站公司就可以帮助你把手机搜索PC网站自动跳转到手机网站上。</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; border: 0px; font-family: &#39;Lucida Grande&#39;, &#39;Lucida Sans Unicode&#39;, Helvetica, Arial, Verdana, sans-serif; line-height: 24px; text-indent: 24px; color: rgb(51, 51, 51); font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);">　　有了这个功能，大家的PC网站还是给PC上的用户浏览，手机网站我们就是专门给使用手机的用户看的。PC网站和手机网站都有了，不管用户是用电脑还是玩手机，哪都可以轻松的找到们的网站，而且浏览还非常的方便，何乐而不为呢?</p><p><br/></p>', '第一个，营销型手机网站的建议有利于提高手机用户体验度　　智能手机越来越普遍，使用也方便，慢慢地就代替了电脑。不知道大家有没有发现，你的PC网站在手机上打开的时候，页面非常的大，手机那么小的屏幕浏览起来非常的不方便，用户体验极差。用户看到这样', 1440144164, 1440144164, 194, 3, 0, 0, 0, '', 0, 0, 1, NULL),
(2, '如何解决企业网络营销推广的八大瓶颈难题?', '', '', '', '', 'admin', '本站', '', '', '', '<p>企业网络营销推广八大瓶颈难题一：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">网站在百度等搜索引擎找不到，前面都是竞争对手的网站?</span></strong></p><p>&nbsp;</p><p>　　网络营销的核心武器是营销型网站，而营销的主战场是搜索引擎，要想具备超强的营销战斗力，网站必须要被搜索引擎收录，同时网站的主关键词要能够排在百度的首页，让更多的精准目标客户找到我们。那么，针对企业网站在搜索引擎中的表现，企业的负责人是否想过以下几点：</p><p>&nbsp;</p><p>　　1.你对网站做过什么?更新内容?增加外链?如果都没有，你的权重从哪里来?排名的能力从哪里获得?</p><p>&nbsp;</p><p>　　2.你的竞争对手在做什么?为什么人家的能排上去?知彼知己才能百战不殆，同时分析竞争对手有助于总结好的推广方法和手段。</p><p>&nbsp;</p><p>　　3.超越竞争对手的唯一方式，比竞争对手多做一点，做好一点，多坚持一会儿。网络营销是个细致活、长久活，没有这一点心态也做不过你的竞争对手。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题二：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">网站的排名忽上忽下不稳定，每天的流量也不稳定</span></strong></p><p>&nbsp;</p><p>　　关键词的排名问题是一个非常棘手的问题，很多企业网站的关键词排名不稳定，这样网站的流量、曝光率都会不稳定，网站的转化率也会随之降低。想要让网站的关键词排名稳定，不仅仅需要有好的推广方法，还有有一个稳定而又专业的团队进行实操。</p><p>&nbsp;</p><p>　　企业老板也许并没有过多的关心过关键词排名的问题，但是核心关键词的排名确实是SEO中十分重要的部分，甚至可以毫不夸张的说，企业的核心关键词是企业进行网络营销的最具性价比也是最有效果的手段。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题三：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">搜索一个关键词，排在前面的信息都是竞争对手发布的信息</span></strong></p><p>&nbsp;</p><p>　　企业在网络上的信息量是十分重要的一个指标，如果你在一段时间内没有发布信息到互联网上，那么你的竞争对手排名在你之前是十分正常的，互联网是个信息聚集地，没有大量的信息作为支撑是没有办法获得好的排名的。</p><p>&nbsp;</p><p>　　如果你发布的信息量足够但是关键词搜索一个词仍然找不到企业的信息，那可能是信息的质量或者发布的平台不好导致，企业老板需要考虑给推广部门换人了。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题四：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">线下实力不强，想要借助网络的力量打造品牌?</span></strong></p><p>&nbsp;</p><p>　　如今消费者对品牌的理解已经发生的改变，他们认为一个企业是不是有实力，是不是品牌，只要在搜索引擎中一搜就能够知道，如果你的产品线下不是品牌，但是在网上到处都恩能够看到你的信息，那你产品部是品牌也是品牌了!所有，你应该行动起来，通过专业的团队帮你创建网络品牌，搭建信息门槛，垄断你的行业，做品牌从网络开始!</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题五：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">用了很久的“智能群发”软件来做推广效果平平</span></strong></p><p>&nbsp;</p><p>　　所谓的“智能”完全是一个幌子，很多软件只是推广的一种工具，要把推广的希望全部寄托在一个工具上面是不妥的，群发软件所能达到的平台，要么平台无人看管，要么验证机制不够严格，这样的平台要么没排名，要么有今天，就没明天，我们要的是一种能够持续性创造价值的平台。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题六：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">百度竞价要不要做，做了是不是在烧钱，如何做才好?</span></strong></p><p>&nbsp;</p><p>　　做广告、做营销难道就不需要投入吗?是的，需要，竞价就是企业做营销的一种投资，做得好，效果显著，投资回报率高;做的不好，算是一种烧钱行为，也不能说是完全没有用作用的，当然做的不好的原因在哪里，竞价操作员的水平不行?还是投入的资金有限?这都是企业老板应该思考的问题。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题七：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">企业自己组建团队还是进行托管?</span></strong></p><p>&nbsp;</p><p>　　如今中小型企业的网络推广面对的另外一个难题就是招人的问题，很多企业有这样的烦恼：招不到有实力的推广人员，或者那些有实力的人要的薪资很高，完全超过了企业能够承受的底线。如何办才好呢?小编要说的是如果企业有推广人脉方面的资源，那么招人的成本和推广的成本也会低很多，效果也会有保证。如果没有，想要招到一个厉害的推广，就得用高薪拴住他;找一家有实力的托管公司如果价格不贵，就颇具性价比了，不用担心没有效果，因为托管公司给出的承诺是没有效果或全额退款，比较省心。</p><p>&nbsp;</p><p>　　企业网络营销推广八大瓶颈难题八：<strong style="padding: 0px; margin: 0px;"><span style="margin: 0px; padding: 0px; border: 0px; color: rgb(255, 153, 0);">如何找到一家有实力有信用的网络托管公司?</span></strong></p><p>&nbsp;</p><p>　　想要做好网络营销推广工作，一定是需要一个系统解决方案的，而这个系统方案的搭建到实施是需要一个强大的团队做支撑的。公司的实力体现在推广团队的技能实力，业界口碑、营销案例、服务质量，把客户的利益放在第一位的公司才是值得信奈的公司。</p><p>&nbsp;</p><p>　　远航网络是一家专业的网络托管服务公司，我们的目标是帮助有理想的企业成为网络上的标杆和行业霸主。有询盘、有成交、能赚钱才是网络营销的最终结果，远航网络坚持着这样的想法和立场。</p><p><br/></p>', '企业网络营销推广八大瓶颈难题一：网站在百度等搜索引擎找不到，前面都是竞争对手的网站?&nbsp;　　网络营销的核心武器是营销型网站，而营销的主战场是搜索引擎，要想具备超强的营销战斗力，网站必须要被搜索引擎收录，同时网站的主关键词要能够排在百', 1440144531, 1440144531, 191, 3, 0, 0, 0, '', 0, 0, 1, NULL),
(3, 'Twitter破发 社交迭代迅速引盈利隐忧', '', '', '', '', 'admin', '网易科技频道', '', '社交,网络营销', '', '<p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">据国外媒体报道，Twitter公司的股价最终没能躲过破发命运，周四尾盘跌破了26美元的日发行价。股价距高点跌去近三分之二。中国Twitter-新浪微博则早已跌破发行价，一直在发行价下徘徊，周四又大跌5.83%。Twitter和微博为何让投资者失去了兴趣？华尔街分析认为，社交网络更新迭代过快，两家公司还未盈利，就被新的社交软件抢去了风头。让投资者觉得本来潜力无限的两家公司，变得前途暗淡。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">Twitter的抛售潮发生于三个星期前，Twitter联合创始人兼临时首席执行官杰克·多尔西（Jack Dorsey）警告，需要一段时间才能扭转Twitter用户增长放缓的局面。虽然他的坦诚获得了分析师的赞赏，但是投资者似乎并不领情，Twitter的表现被认为“不能接受”。由3.16亿用户组成共享140个字符的信息平台未来是否能够成为一个主流社交媒体，突然变成了一个未知数。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">Twitter在2013年11月IPO时，被认为是高成长股，有望成为下一个Facebook。然而，公司的用户增长并没有达到预期。Snapchat、Instagram以及Whatsapp等应用的崛起，让Twitter有了一种还未壮年，就以日薄西山的感觉。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">Twitter的周四的交易中下跌5.8％，收于26美元的发行价，盘中一度低至25.92美元，今年为止股价已经下跌了28％。Twitter的惨淡表现，也影响了表兄弟新微博的表现，今年以来其股价几乎一直徘徊在17美元的发行价以下。周四的交易中大跌5.83%至12.61美元。微博一样有着类似Twitter的隐忧，虽然微博成功成为中国最成功的撕逼平台，并靠着撕逼营销，成功捧红了国民老公和国民岳父的对手方舟子等人，但是僵尸粉的增多，用户增长的放缓，以及微信的强势崛起，都为微博未来的发展蒙上了一层阴影。再加上中国Facebook人人网，已经走上了用户流失之路，微博会否一样结局，任何人也无法给出准确答案。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">还未真正盈利，就已经退出历史舞台的互联网公司并不是没有。历史上2002年的互联网泡沫就有大批的互联网公司一夜之间倒闭。比如说当年用户增长迅速的宠物网站Pets.com就在上市268天后，破产退市。大量找寻不到商业模式的互联网公司成为互联网泡沫的牺牲品。如今美联储加息在即，美股走势凶险，投资者惧怕当年的一幕重演，更怕自己手中的股票就是当年的裸泳者。</span></p><p><br/></p>', '据国外媒体报道，Twitter公司的股价最终没能躲过破发命运，周四尾盘跌破了26美元的日发行价。股价距高点跌去近三分之二。中国Twitter-新浪微博则早已跌破发行价，一直在发行价下徘徊，周四又大跌5.83%。Twitter和微博为何让投资', 1440151260, 1440493615, 163, 4, 0, 0, 0, '', 0, 0, 1, 0),
(4, 'CSS3 实现iOS7毛玻璃模糊效果 (iOS7 live blur)', '', '', '', '', '', '', '', '', '', '<p><strong>-webkit-filter</strong></p><p><strong><br/></strong></p><p><strong><br/></strong></p><p>该属性是我们这次实现该功能的主要属性</p><p><br/></p><p>目前该属性还属于草案阶段，只有chrome 18+、Safari 浏览器支持，不过相信随着时间的推移，很快会被大规模应用的。</p><p><br/></p><p>具体的filter用法我会另外写一篇文章和大家分享的，这里主要介绍它的 blur()、brightness()、contrast() 3个属性。</p><p><br/></p><p><br/></p><p><strong>blur()</strong></p><p><strong><br/></strong></p><p><strong><br/></strong></p><blockquote style="padding: 5px 20px; border-left-width: 2px; border-left-style: solid; border-left-color: rgb(222, 94, 96); margin: 0px 0px 20px; color: rgb(127, 130, 137); font-family: &#39;Microsoft Yahei&#39;, &#39;Hiragino Sans GB&#39;, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: medium; white-space: normal;"><p style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 25px;">用来设置相应的dom的模糊程度，用法很简单</p></blockquote><pre style="overflow: auto; font-family: monospace, monospace; font-size: medium; padding: 15px; color: rgb(255, 255, 255); background-color: rgb(29, 31, 33);">filter:&nbsp;blur(5px)</pre><h4 id="brightness-" style="font-size: 18px; color: rgb(255, 255, 255); font-family: &#39;Microsoft Yahei&#39;, &#39;Hiragino Sans GB&#39;, &#39;WenQuanYi Micro Hei&#39;, sans-serif; white-space: normal;">brightness()</h4><blockquote style="padding: 5px 20px; border-left-width: 2px; border-left-style: solid; border-left-color: rgb(222, 94, 96); margin: 0px 0px 20px; color: rgb(127, 130, 137); font-family: &#39;Microsoft Yahei&#39;, &#39;Hiragino Sans GB&#39;, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: medium; white-space: normal;"><p style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 25px;">用来设置相应dom的明度，对应的值越大越亮</p></blockquote><pre style="overflow: auto; font-family: monospace, monospace; font-size: medium; padding: 15px; color: rgb(255, 255, 255); background-color: rgb(29, 31, 33);">filter:&nbsp;brightness(0.5)</pre><h4 id="contrast-" style="font-size: 18px; color: rgb(255, 255, 255); font-family: &#39;Microsoft Yahei&#39;, &#39;Hiragino Sans GB&#39;, &#39;WenQuanYi Micro Hei&#39;, sans-serif; white-space: normal;">contrast()</h4><blockquote style="padding: 5px 20px; border-left-width: 2px; border-left-style: solid; border-left-color: rgb(222, 94, 96); margin: 0px 0px 20px; color: rgb(127, 130, 137); font-family: &#39;Microsoft Yahei&#39;, &#39;Hiragino Sans GB&#39;, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: medium; white-space: normal;"><p style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 25px;">对比度值越大越强烈</p></blockquote><pre style="overflow: auto; font-family: monospace, monospace; font-size: medium; padding: 15px; color: rgb(255, 255, 255); background-color: rgb(29, 31, 33);">filter:&nbsp;contrast(200%)</pre><p><br/></p>', '-webkit-filter该属性是我们这次实现该功能的主要属性目前该属性还属于草案阶段，只有chrome 18+、Safari 浏览器支持，不过相信随着时间的推移，很快会被大规模应用的。具体的filter用法我会另外写一篇文章和大家分享的', 1440151380, 1440151470, 200, 6, 0, 0, 0, '', 0, 0, 1, 0),
(5, '国庆值班安排,祝所有客户节日快乐!', '', '', '', '', '', '', '', '', '', '<p>　　根据北京市有关“十一”节放假通知，我公司“十一”节放假时间为10月1日至7日，10月8日正常上班。</p><p><br/></p><p>　　具体方式为：5月1日—7日放假，共7天。其中，1日、2日、3日为法定假日，将4月28日、29日两个公休日调至5月4日、7日；5月5日、6日照常公休。</p><p><br/></p><p>　　恭祝节日快乐！</p><p><br/></p>', '　　根据北京市有关“十一”节放假通知，我公司“十一”节放假时间为10月1日至7日，10月8日正常上班。　　具体方式为：5月1日—7日放假，共7天。其中，1日、2日、3日为法定假日，将4月28日、29日两个公休日调至5月4日、7日；5月5日、', 1440399664, 1440399664, 185, 3, 0, 0, 0, '', 0, 0, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `yh_attachment`
--

CREATE TABLE IF NOT EXISTS `yh_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '原文件名',
  `filepath` varchar(200) NOT NULL DEFAULT '',
  `filetype` smallint(6) NOT NULL DEFAULT '1',
  `filesize` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `haslitpic` tinyint(1) NOT NULL DEFAULT '1',
  `uploadtime` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `yh_attachment`
--

INSERT INTO `yh_attachment` (`id`, `title`, `filepath`, `filetype`, `filesize`, `haslitpic`, `uploadtime`, `aid`, `userid`) VALUES
(1, 'about.png', '/demo/uploads/img/20150821/55d67f3aa7e36.png', 1, 645971, 1, 1440120634, 1, 0),
(2, 'POPCG553071_A Peace Treaty.jpg', '/demo/uploads/img/20150821/55d6df118e851.jpg', 1, 19879, 1, 1440145169, 1, 0),
(3, '55262e65Na7a564af.jpg', '/demo/uploads/img/20150821/55d6df5fbd406.jpg', 1, 28899, 1, 1440145247, 1, 0),
(4, '555069c8N8531aae5.jpg', '/demo/uploads/img/20150821/55d6e07c710ba.jpg', 1, 43532, 1, 1440145532, 1, 0),
(5, 'thumb.php.jpg', '/demo/uploads/img/20150821/55d6e3b1b6e71.jpg', 1, 83339, 1, 1440146353, 1, 0),
(6, 'thumb.php.jpg', '/demo/uploads/img/20150821/55d6e3f6e5953.jpg', 1, 62995, 1, 1440146422, 1, 0),
(7, '46B58PICbq8.jpg', '/demo/uploads/img/20150821/55d6e482784d3.jpg', 1, 16198, 1, 1440146562, 1, 0),
(8, 'bootstrap-slide-01.jpg', '/demo/uploads/img/20150821/55d6e4fca624b.jpg', 1, 125346, 1, 1440146684, 1, 0),
(9, 'bootstrap-slide-02.jpg', '/demo/uploads/img/20150821/55d6e4fd5f21e.jpg', 1, 81284, 1, 1440146685, 1, 0),
(10, 'bootstrap-slide-03.jpg', '/demo/uploads/img/20150821/55d6e4fdf220e.jpg', 1, 49063, 1, 1440146686, 1, 0),
(11, 'bootstrap-slide-01.jpg', '/demo/uploads/img/20150821/55d6efdef3f43.jpg', 1, 125346, 1, 1440149471, 1, 0),
(12, 'bootstrap-slide-02.jpg', '/demo/uploads/img/20150821/55d6efea9a2bc.jpg', 1, 81284, 1, 1440149483, 1, 0),
(13, 'bootstrap-slide-03.jpg', '/demo/uploads/img/20150821/55d6eff53a555.jpg', 1, 49063, 1, 1440149493, 1, 0),
(14, '55d6e482784d3.jpg', '/demo/uploads/img/20150821/55d6f1c318630.jpg', 1, 16198, 1, 1440149955, 1, 0),
(15, '55d6e3f6e5953.jpg', '/demo/uploads/img/20150821/55d6f1d05287c.jpg', 1, 62995, 1, 1440149968, 1, 0),
(16, '55d6e3b1b6e71.jpg', '/demo/uploads/img/20150821/55d6f1dd4a88f.jpg', 1, 83339, 1, 1440149981, 1, 0),
(17, '55d6e07c710ba.jpg', '/demo/uploads/img/20150821/55d6f1ec6c852.jpg', 1, 43532, 1, 1440149996, 1, 0),
(18, '55d6df5fbd406.jpg', '/demo/uploads/img/20150821/55d6f200a5abd.jpg', 1, 28899, 1, 1440150016, 1, 0),
(19, '55d6df118e851.jpg', '/demo/uploads/img/20150821/55d6f20bc4731.jpg', 1, 19879, 1, 1440150027, 1, 0),
(20, '爱马仕.jpg', '/demo/uploads/img/20150824/55dac3ac808f9.jpg', 1, 10727, 1, 1440400300, 1, 0),
(21, '宝格丽.jpg', '/demo/uploads/img/20150824/55dac3ad024d0.jpg', 1, 12145, 1, 1440400301, 1, 0),
(22, '宝格丽B.ZERO1系列女士.jpg', '/demo/uploads/img/20150824/55dac3ad4e41b.jpg', 1, 4209, 1, 1440400301, 1, 0),
(23, '宝格丽B.ZERO1系列女士18K白金.jpg', '/demo/uploads/img/20150824/55dac3ada27ec.jpg', 1, 11276, 1, 1440400301, 1, 0),
(24, '宝格丽DIVA系列.JPG', '/demo/uploads/img/20150824/55dac3ae0186f.JPG', 0, 11002, 1, 1440400302, 1, 0),
(25, '宝格丽PARENTES.jpg', '/demo/uploads/img/20150824/55dac3ae6549f.jpg', 1, 16105, 1, 1440400302, 1, 0),
(26, '宝格丽白色陶瓷18K.jpg', '/demo/uploads/img/20150824/55dac3aed0355.jpg', 1, 28269, 1, 1440400302, 1, 0),
(27, '梵克雅宝18K黄金.jpg', '/demo/uploads/img/20150824/55dac3af8a0fe.jpg', 1, 6627, 1, 1440400303, 1, 0),
(28, '卡地亚18K白金.jpg', '/demo/uploads/img/20150824/55dac3b0024a8.jpg', 1, 10201, 1, 1440400304, 1, 0),
(29, '卡地亚18K玫瑰.jpg', '/demo/uploads/img/20150824/55dac3b07b700.jpg', 1, 12121, 1, 1440400304, 1, 0),
(30, '卡地亚18K玫瑰金.jpg', '/demo/uploads/img/20150824/55dac3b0ea687.jpg', 1, 12000, 1, 1440400305, 1, 0),
(31, 'banner.jpg', '/demo/uploads/img/20150824/55dad56761869.jpg', 1, 31451, 1, 1440404839, 1, 0),
(32, '11.jpg', '/demo/uploads/img/20150911/55f243453e337.jpg', 1, 3186, 1, 1441940293, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_attachmentindex`
--

CREATE TABLE IF NOT EXISTS `yh_attachmentindex` (
  `attid` int(10) unsigned NOT NULL DEFAULT '0',
  `arcid` int(10) unsigned NOT NULL DEFAULT '0',
  `modelid` int(10) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(20) NOT NULL DEFAULT '',
  KEY `attid` (`attid`),
  KEY `arcid` (`arcid`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yh_attachmentindex`
--

INSERT INTO `yh_attachmentindex` (`attid`, `arcid`, `modelid`, `desc`) VALUES
(19, 1, 3, ''),
(18, 2, 3, ''),
(17, 3, 3, ''),
(16, 4, 3, ''),
(15, 5, 3, ''),
(14, 6, 3, ''),
(11, 3, 4, ''),
(12, 2, 4, ''),
(13, 1, 4, ''),
(30, 17, 3, ''),
(27, 14, 3, ''),
(20, 7, 3, '');

-- --------------------------------------------------------

--
-- 表的结构 `yh_banner`
--

CREATE TABLE IF NOT EXISTS `yh_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '说明',
  `url` varchar(255) DEFAULT NULL COMMENT '内容',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `yh_banner`
--

INSERT INTO `yh_banner` (`id`, `name`, `litpic`, `url`, `sort`) VALUES
(5, '幻灯片1', '/demo/uploads/img/20141214/548d442546aa2.jpg', '#', 1),
(6, '幻灯片2', '/demo/uploads/img/20141214/548d442f007ed.jpg', '#', 2),
(7, '幻灯片3', '/demo/uploads/img/20141214/548d4437d8039.jpg', '#', 3),
(8, '幻灯片4', '/demo/uploads/img/20141214/548d4441578f8.jpg', '#', 4);

-- --------------------------------------------------------

--
-- 表的结构 `yh_banner_wap`
--

CREATE TABLE IF NOT EXISTS `yh_banner_wap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '说明',
  `url` varchar(255) DEFAULT NULL COMMENT '内容',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `yh_banner_wap`
--

INSERT INTO `yh_banner_wap` (`id`, `name`, `litpic`, `url`, `sort`) VALUES
(9, 'banner1', '/demo/uploads/img/20150824/55dad56761869.jpg', ' ', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yh_block`
--

CREATE TABLE IF NOT EXISTS `yh_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '说明',
  `content` text COMMENT '内容',
  `blocktype` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `yh_block`
--

INSERT INTO `yh_block` (`id`, `name`, `remark`, `content`, `blocktype`) VALUES
(2, 'index_lxfs', '首页联系方式', '请在后台-内容管理-自由块管理修改此段文字<br/>\r\n联系人：某某<br/>\r\n手机：13658888888<br/>\r\n固话：0511-85967770<br/>\r\n传真：0511-86120068<br/>\r\n地址：镇江市万达广场写字楼A座24层<br/>\r\n邮箱：admin@yhcompany.cn<br/>', 1),
(3, 'contact_pic', '首页联系我们', '/demo/uploads/img/20141124/547294df367a1.jpg', 2),
(4, 'show_banner', '内页banner', '/demo/uploads/img/20141124/54729ef755980.jpg', 2);

-- --------------------------------------------------------

--
-- 表的结构 `yh_category`
--

CREATE TABLE IF NOT EXISTS `yh_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '栏目分类名称',
  `ename` varchar(200) NOT NULL DEFAULT '' COMMENT '别名',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类',
  `modelid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属模型',
  `litpic` varchar(100) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类别',
  `seotitle` varchar(1000) NOT NULL DEFAULT '',
  `keywords` varchar(1000) DEFAULT '' COMMENT '关键字',
  `description` varchar(1000) DEFAULT '' COMMENT '关键字',
  `template_category` varchar(60) NOT NULL DEFAULT '',
  `template_list` varchar(60) NOT NULL DEFAULT '',
  `template_show` varchar(60) NOT NULL DEFAULT '',
  `content` text COMMENT '内容',
  `other` tinyint(1) DEFAULT '2',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示',
  `sort` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目分类表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `yh_category`
--

INSERT INTO `yh_category` (`id`, `name`, `ename`, `pid`, `modelid`, `litpic`, `type`, `seotitle`, `keywords`, `description`, `template_category`, `template_list`, `template_show`, `content`, `other`, `status`, `sort`) VALUES
(1, '关于我们', 'guanyuwomen', 0, 2, '/demo/uploads/img/20150821/55d67f3aa7e36.png', 0, '', '', '镇江市远航网络科技有限公司是一家专业从事企业网站设计和互联网软件开发的高科技企业。远航网络致力于：域名注册、虚拟主机、主机托管、主机租用、企业邮局、企业网站策划、网站建设、flash制作、网站推广1', '', 'List_page.html', 'Show_article.html', '<p>　　镇江市远航网络科技有限公司是一家专业从事企业网站设计和互联网软件开发的高科技企业。</p><p>　　远航网络致力于：域名注册、虚拟主机、主机托管、主机租用、企业邮局、企业网站策划、网站建设、flash制作、网站推广、电子商务网站开发。全方位提供一站式企业网络服务，提供最专业、最优质的网络解决方案，为企业开发和量身订制各类企业管理软件等。</p><p>　　近年来，远航网络凭借独特的运作模式，迅速得到了各级政府部门、行政事业单位及广大企业用户的认可。远航人将再接再厉，再创辉煌。&nbsp;</p>', 2, 1, 1),
(2, '新闻中心', 'news', 0, 1, '', 0, '', '', '新闻封面页', '', 'List_article_index.html', 'Show_article.html', NULL, 2, 1, 1),
(3, '公司新闻', 'company', 2, 1, '', 0, '', '', '新闻列表', '', 'List_article.html', 'Show_article.html', NULL, 2, 1, 1),
(4, '行业资讯', 'industry', 2, 1, '', 0, '', '', '新闻列表', '', 'List_article.html', 'Show_article.html', NULL, 2, 1, 2),
(5, '公共通知', 'notice', 2, 1, '', 0, '', '', '新闻列表', '', 'List_article.html', 'Show_article.html', NULL, 2, 1, 3),
(6, '技术资料', 'technical', 2, 1, '', 0, '', '', '新闻列表', '', 'List_article.html', 'Show_article.html', NULL, 2, 1, 1),
(7, '产品中心', 'products', 0, 3, '', 0, '[dq]混合器,[dq]过滤器-产品中心-远航CMS官方演示地址', '[dq]混合器,[dq]过滤器-产品中心-远航CMS官方演示地址', '产品封面页', '', 'List_product_index.html', 'Show_product.html', NULL, 1, 1, 1),
(8, '饰品珠宝', 'shipinzhubao', 7, 3, '', 0, '[dq]饰品珠宝厂,[dq]饰品珠宝价格,[dq]饰品珠宝专卖,[dq]饰品珠宝规格,[dq]饰品珠宝中心,[dq]饰品珠宝公司,[dq]饰品珠宝订购,[dq]饰品珠宝十大品牌,[dq]饰品珠宝哪家好,[dq]饰品珠宝维修,[dq]饰品珠宝检测-远航CMS官方演示地址', '[dq]饰品珠宝厂,[dq]饰品珠宝价格,[dq]饰品珠宝专卖,[dq]饰品珠宝规格,[dq]饰品珠宝中心,[dq]饰品珠宝公司,[dq]饰品珠宝订购,[dq]饰品珠宝十大品牌,[dq]饰品珠宝哪家好,[dq]饰品珠宝维修,[dq]饰品珠宝检测-远航CMS官方演示地址', '产品列表', '', 'List_product.html', 'Show_product.html', NULL, 2, 1, 1),
(9, '数码彩电', 'shumacaidian', 7, 3, '', 0, '[dq]数码彩电厂,[dq]数码彩电价格,[dq]数码彩电专卖,[dq]数码彩电规格,[dq]数码彩电中心,[dq]数码彩电公司,[dq]数码彩电订购,[dq]数码彩电十大品牌,[dq]数码彩电哪家好,[dq]数码彩电维修,[dq]数码彩电检测-远航CMS官方演示地址', '[dq]数码彩电厂,[dq]数码彩电价格,[dq]数码彩电专卖,[dq]数码彩电规格,[dq]数码彩电中心,[dq]数码彩电公司,[dq]数码彩电订购,[dq]数码彩电十大品牌,[dq]数码彩电哪家好,[dq]数码彩电维修,[dq]数码彩电检测-远航CMS官方演示地址', '产品列表页', '', 'List_product.html', 'Show_product.html', NULL, 2, 1, 2),
(10, '家居建材', 'jiajijiancai', 7, 3, '', 0, '[dq]家居建材厂,[dq]家居建材价格,[dq]家居建材专卖,[dq]家居建材规格,[dq]家居建材中心,[dq]家居建材公司,[dq]家居建材订购,[dq]家居建材十大品牌,[dq]家居建材哪家好,[dq]家居建材维修,[dq]家居建材检测-远航CMS官方演示地址', '[dq]家居建材厂,[dq]家居建材价格,[dq]家居建材专卖,[dq]家居建材规格,[dq]家居建材中心,[dq]家居建材公司,[dq]家居建材订购,[dq]家居建材十大品牌,[dq]家居建材哪家好,[dq]家居建材维修,[dq]家居建材检测-远航CMS官方演示地址', '产品列表页', '', 'List_product.html', 'Show_product.html', NULL, 2, 1, 1),
(11, '交通工具', 'jiaotonggongju', 7, 3, '', 0, '[dq]交通工具厂,[dq]交通工具价格,[dq]交通工具专卖,[dq]交通工具规格,[dq]交通工具中心,[dq]交通工具公司,[dq]交通工具订购,[dq]交通工具十大品牌,[dq]交通工具哪家好,[dq]交通工具维修,[dq]交通工具检测-远航CMS官方演示地址', '[dq]交通工具厂,[dq]交通工具价格,[dq]交通工具专卖,[dq]交通工具规格,[dq]交通工具中心,[dq]交通工具公司,[dq]交通工具订购,[dq]交通工具十大品牌,[dq]交通工具哪家好,[dq]交通工具维修,[dq]交通工具检测-远航CMS官方演示地址', '', '', 'List_product.html', 'Show_product.html', NULL, 2, 1, 1),
(12, '成功案例', 'case', 0, 4, '', 0, '', '', '成功案例列表', '', 'List_picture.html', 'Show_picture.html', NULL, 2, 1, 1),
(13, '服务与支持', 'service', 0, 2, '', 0, '', '', '品牌顾问国内最优秀的互联网解决方案的应用服务提供商之一，拥有丰富的互联网品牌顾问资源与服务经验。品牌顾问通过品牌分析、对比以及原有品牌资源规范的导入，保证了我们为您提供的网络数字化产品符合您的整体品牌形象与品牌战略。信息构架与产品设计顾问我', '', 'List_page.html', 'Show_page.html', '<p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><strong>品牌顾问</strong></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">国内最优秀的互联网解决方案的应用服务提供商之一，拥有丰富的互联网品牌顾问资源与服务经验。品牌顾问通过品牌分析、对比以及原有品牌资源规范的导入，保证了我们为您提供的网络数字化产品符合您的整体品牌形象与品牌战略。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><strong>信息构架与产品设计顾问</strong></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">我们的信息架构师是整个网站设计、开发项目的核心，拥有丰富的技术、视觉、品牌知识和经验。从技术实施的层面对整个系统与项目进行规划和要求，配合客户经理与您沟通需求并整理、设计成框架性产品从而指导整个项目的开发实施。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><strong>视觉设计</strong></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">在IA与交互设计师共同完成了一个网站的骨骼后，界面视觉设计师将用自己的专业与创造力赋予网站血肉与灵魂，他们为您完成最终视觉的表现与创意，让网站具有非凡的视觉感受，并在VI与策略的指导下最终让整个网站创造地延续您的品牌。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><strong>技术开发工程师</strong></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">他们是真正的幕后英雄，像武侠小说里的大侠，悄无声息地使用高超技艺为您实现了数据库设计、程序与功能开发，为您最终提供一套优秀的管理程序来让您轻松简易地对网站实现信息管理并让新生的网站在您的服务器上健壮地奔跑。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><strong>客户服务团队</strong></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">我们的客服推行24小时&quot;快速响应、立即行动&quot;的服务机制；亦有为部分客户的特殊需求提供&quot;通道&quot;服务的机制；我们拥有先进的客户关系管理系统，为客户提供&quot;标准化流程化服务&quot;； 不但有健全的客户关系维护体制；健全的客户培训体系； 还有&quot;一条龙式&quot;的客户满意度跟踪体系，只要是我们的客户，不论大小，我们永远提供最优质的服务。</span></p><p><br/></p>', 2, 1, 1),
(14, '诚聘英才', 'talented', 0, 2, '', 0, '', '', '人事专员/助理岗位职责：1、协助上级建立健全公司招聘、培训、工资、保险、福利、绩效考核等人力资源制度建设；2、建立、维护人事档案，办理和更新劳动合同；3、执行人力资源管理各项实务的操作流程和各类规章制度的实施，配合其他业务部门工作；4、收集', '', 'List_page.html', 'Show_page.html', '<p><span style="color: rgb(40, 40, 40); font-family: 微软雅黑; font-size: 14px; background-color: rgb(255, 255, 255);"></span></p><p><strong><span style="font-size: 14px;">人事专员/助理</span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><strong><span style="font-size: 14px;">岗位职责：</span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><span style="font-size: 14px;">1、协助上级建立健全公司招聘、培训、工资、保险、福利、绩效考核等人力资源制度建设；</span><span style="font-size: 14px;">2、建立、维护人事档案，办理和更新劳动合同；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">3、执行人力资源管理各项实务的操作流程和各类规章制度的实施，配合其他业务部门工作；</span><span style="font-size: 14px;">4、收集相关的劳动用工等人事政策及法规；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">5、执行招聘工作流程，协调、办理员工招聘、入职、离职、调任、升职等手续；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">6、协同开展新员工入职培训，业务培训，执行培训计划，联系组织外部培训以及培训效果的跟踪、反馈；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">7、负责员工工资结算和年度工资总额申报，办理相应的社会保险等；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">8、帮助建立员工关系，协调员工与管理层的关系，组织员工的活动。</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;"><br/></span></p><p><strong><span style="font-size: 14px;">任职资格</span></strong><span style="font-size: 14px;">：</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">1、人力资源或相关专业大专以上学历；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">2、两年以上人力资源工作经验；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">3、熟悉人力资源管理各项实务的操作流程，熟悉国家各项劳动人事法规政策，并能实际操作运用</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">4、具有良好的职业道德，踏实稳重，工作细心，责任心强，有较强的沟通、协调能力，有团队协作精神；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">5、熟练使用相关办公软件，具备基本的网络知识。</span></p><p><br/></p><p><br/></p><p><br/></p><p><strong><span style="font-size: 14px;">web前端开发工程师</span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><strong><span style="font-size: 14px;">工作描述：</span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><span style="font-size: 14px;">1、参与系统前端开发工作，协调界面设计师和开发人员的工作；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">2、参与网站的整体架构设计，并能制定相关的前端开发流程和规范。</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">3、web前端编码，代码要规范。</span></p><p><br/></p><p><br/></p><p><strong><span style="font-size: 14px;">需求描述：</span></strong></p><p><strong><span style="font-size: 14px;"><br/></span></strong></p><p><span style="font-size: 14px;">1、大专以上学历，三年以上同岗位工作经验；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">2、熟练使用jquery框架，了解基本的前端优化；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">3、JavaScript/Ajax/DOM/。熟悉Javascript，能独立完成Javascript代码的编写和优化工作，能熟练使用JQuery等AJAX框架；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">4、精通 CSS+DIV，及各浏览器兼容问题；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">5、良好的沟通能力与合作意识。；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">6、有独立面对与解决问题的能力；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">7. 了解PHP等程序开发语言，能配合开发人员进行页面联调整合；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">8. 良好的项目意识和沟通表达能力，工作积极主动，能承受一定的工作压力；</span></p><p><span style="font-size: 14px;"><br/></span></p><p><span style="font-size: 14px;">9. 较强的学习和领悟能力，思维活跃，接受新事物能力强。</span></p>', 2, 1, 1),
(15, '联系我们', 'contact', 0, 2, '', 0, '', '', '现在就与镇江市远航网络科技有限公司取得联系如果您正在寻找网站建设专家帮助您在互联网推广品牌事业，欢迎您与远航网络建立沟通，镇江市远航网络科技有限公司是镇江知名网络公司，六年来专注于网页设计、网站建设、网站推广，请通过以下方式与我们联系。我们', '', 'List_page.html', 'Show_page.html', '<p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 16px;">现在就与镇江市远航网络科技有限公司取得联系</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">如果您正在寻找网站建设专家帮助您在互联网推广品牌事业，欢迎您与远航网络建立沟通，镇江市远航网络科技有限公司是镇江知名网络公司，六年来专注于网页设计、网站建设、网站推广，请通过以下方式与我们联系。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><strong><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">我们的联系方式:</span></strong></p><p><strong><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></strong></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">400-0568-687 (网站建设全国免费咨询电话)</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">传真号码：+86-0511-86120068</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">技术支持：（0）13656138807&nbsp;</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">电子邮箱：admin@yhcompany.cn</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;"><br/></span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">网站地址：http://www.yhcompany.cn</span></p>', 2, 1, 1),
(16, '在线留言', '@guestbook/index', 0, 0, '', 1, '', '', '', '', 'List_article.html', 'Show_article.html', NULL, 2, 1, 1),
(21, '测试', 'ceshi', 0, 3, '', 0, '[dq]测试厂,[dq]测试价格,[dq]测试专卖,[dq]测试规格,[dq]测试中心,[dq]测试公司,[dq]测试订购,[dq]测试十大品牌,[dq]测试哪家好,[dq]测试维修,[dq]测试检测-远航CMS官方演示地址', '[dq]测试厂,[dq]测试价格,[dq]测试专卖,[dq]测试规格,[dq]测试中心,[dq]测试公司,[dq]测试订购,[dq]测试十大品牌,[dq]测试哪家好,[dq]测试维修,[dq]测试检测-远航CMS官方演示地址', '', '', 'List_product.html', 'Show_product.html', NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yh_comment`
--

CREATE TABLE IF NOT EXISTS `yh_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postid` int(10) unsigned NOT NULL DEFAULT '0',
  `modelid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `agent` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `postid` (`postid`),
  KEY `modelid` (`modelid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_copyfrom`
--

CREATE TABLE IF NOT EXISTS `yh_copyfrom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `siteurl` varchar(200) NOT NULL DEFAULT '',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_guestbook`
--

CREATE TABLE IF NOT EXISTS `yh_guestbook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `homepage` varchar(50) NOT NULL DEFAULT '',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  `replytime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `content` text,
  `reply` text,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_itemgroup`
--

CREATE TABLE IF NOT EXISTS `yh_itemgroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `remark` varchar(20) DEFAULT '',
  `status` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `yh_itemgroup`
--

INSERT INTO `yh_itemgroup` (`id`, `name`, `remark`, `status`) VALUES
(1, 'flagtype', '文档属性', 0),
(2, 'blocktype', '自由块类别', 0),
(3, 'softtype', '软件类型', 0),
(4, 'softlanguage', '软件语言', 0),
(5, 'star', '星座', 0),
(6, 'animal', '生肖', 0),
(7, 'education', '教育程度', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_iteminfo`
--

CREATE TABLE IF NOT EXISTS `yh_iteminfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `group` varchar(20) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `yh_iteminfo`
--

INSERT INTO `yh_iteminfo` (`id`, `name`, `group`, `value`, `pid`, `sort`) VALUES
(3, '推荐', 'flagtype', 4, 0, 0),
(8, '文字', 'blocktype', 1, 0, 1),
(9, '图片', 'blocktype', 2, 0, 2),
(10, '丰富', 'blocktype', 3, 0, 3),
(11, '国产', 'softtype', 1, 0, 0),
(12, '中文版', 'softlanguage', 1, 0, 0),
(13, '英文版', 'softlanguage', 2, 0, 0),
(14, '多语言版', 'softlanguage', 3, 0, 0),
(15, '白羊座', 'star', 1, 0, 0),
(16, '金牛座', 'star', 2, 0, 0),
(17, '双子座', 'star', 3, 0, 0),
(18, '巨蟹座', 'star', 4, 0, 0),
(19, '狮子座', 'star', 5, 0, 0),
(20, '处女座', 'star', 6, 0, 0),
(21, '天枰座', 'star', 7, 0, 0),
(22, '天蝎座', 'star', 8, 0, 0),
(23, '射手座', 'star', 9, 0, 0),
(24, '摩羯座', 'star', 10, 0, 0),
(25, '水瓶座', 'star', 11, 0, 0),
(26, '双鱼座', 'star', 12, 0, 0),
(27, '鼠', 'animal', 1, 0, 0),
(28, '牛', 'animal', 2, 0, 0),
(29, '虎', 'animal', 3, 0, 0),
(30, '兔', 'animal', 4, 0, 0),
(31, '龙', 'animal', 5, 0, 0),
(32, '蛇', 'animal', 6, 0, 0),
(33, '马', 'animal', 7, 0, 0),
(34, '羊', 'animal', 8, 0, 0),
(35, '猴', 'animal', 9, 0, 0),
(36, '鸡', 'animal', 10, 0, 0),
(37, '狗', 'animal', 11, 0, 0),
(38, '猪', 'animal', 12, 0, 0),
(39, '小学', 'education', 1, 0, 0),
(40, '初中', 'education', 2, 0, 0),
(41, '高中/中专', 'education', 3, 0, 0),
(42, '大学专科', 'education', 4, 0, 0),
(43, '大学本科', 'education', 5, 0, 0),
(44, '硕士', 'education', 6, 0, 0),
(45, '博士以上', 'education', 7, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_link`
--

CREATE TABLE IF NOT EXISTS `yh_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `ischeck` tinyint(1) NOT NULL DEFAULT '1' COMMENT '首页|内页',
  `posttime` int(10) unsigned NOT NULL,
  `sort` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `yh_link`
--

INSERT INTO `yh_link` (`id`, `name`, `url`, `logo`, `description`, `ischeck`, `posttime`, `sort`) VALUES
(5, '百度', 'http://www.baidu.com', '', '', 0, 1430979942, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yh_log`
--

CREATE TABLE IF NOT EXISTS `yh_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `log_time` int(11) DEFAULT NULL,
  `log_ip` varchar(20) DEFAULT NULL,
  `log_type` varchar(20) DEFAULT NULL,
  `log_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_member`
--

CREATE TABLE IF NOT EXISTS `yh_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `encrypt` varchar(6) NOT NULL DEFAULT '',
  `nickname` varchar(20) DEFAULT '',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `face` varchar(60) NOT NULL DEFAULT '' COMMENT '头像',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  `logintime` int(10) unsigned DEFAULT '0',
  `loginip` varchar(20) DEFAULT '',
  `loginnum` mediumint(8) unsigned DEFAULT '0',
  `groupid` smallint(6) unsigned DEFAULT '0',
  `message` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `islock` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `yh_member`
--

INSERT INTO `yh_member` (`id`, `email`, `password`, `encrypt`, `nickname`, `amount`, `score`, `face`, `regtime`, `logintime`, `loginip`, `loginnum`, `groupid`, `message`, `status`, `islock`) VALUES
(1, 'gjm1018@qq.com', '4e094ea06fc2d44eacf240b2555a6b1d', 'dnRge2', '湘子', '0.00', 0, '', 1401335998, 1401336007, '127.0.0.1', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_memberdetail`
--

CREATE TABLE IF NOT EXISTS `yh_memberdetail` (
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `realname` varchar(30) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '1980-01-01',
  `province` int(10) unsigned NOT NULL DEFAULT '0',
  `area` int(10) unsigned NOT NULL DEFAULT '0',
  `address` varchar(50) NOT NULL DEFAULT '',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `tel` varchar(15) NOT NULL DEFAULT '',
  `mobile` varchar(15) NOT NULL DEFAULT '',
  `animal` int(10) unsigned NOT NULL DEFAULT '0',
  `star` int(10) unsigned NOT NULL DEFAULT '0',
  `blood` int(10) unsigned NOT NULL DEFAULT '0',
  `marital` int(10) unsigned NOT NULL DEFAULT '0',
  `education` int(10) unsigned NOT NULL DEFAULT '0',
  `vocation` int(10) unsigned NOT NULL DEFAULT '0',
  `income` int(10) unsigned NOT NULL DEFAULT '0',
  `maxim` varchar(100) NOT NULL DEFAULT '',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yh_membergroup`
--

CREATE TABLE IF NOT EXISTS `yh_membergroup` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `sort` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yh_membergroup`
--

INSERT INTO `yh_membergroup` (`id`, `name`, `description`, `status`, `sort`) VALUES
(1, '初级会员', '', 0, 0),
(2, '中级会员', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yh_model`
--

CREATE TABLE IF NOT EXISTS `yh_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `tablename` varchar(30) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `template_category` varchar(60) NOT NULL DEFAULT '',
  `template_list` varchar(60) NOT NULL DEFAULT '',
  `template_show` varchar(60) NOT NULL DEFAULT '',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `yh_model`
--

INSERT INTO `yh_model` (`id`, `name`, `description`, `tablename`, `status`, `template_category`, `template_list`, `template_show`, `sort`) VALUES
(1, '文章模型', '', 'article', 1, '', 'List_article.html', 'Show_article.html', 1),
(2, '单页模型', '', 'page', 1, '', 'List_page.html', 'Show_page.html', 2),
(3, '产品模型', '', 'product', 1, '', 'List_product.html', 'Show_product.html', 3),
(4, '图片模型', '', 'picture', 1, '', 'List_picture.html', 'Show_picture.html', 4);

-- --------------------------------------------------------

--
-- 表的结构 `yh_nav`
--

CREATE TABLE IF NOT EXISTS `yh_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(10) DEFAULT '0',
  `navtype` smallint(5) NOT NULL DEFAULT '0' COMMENT '说明',
  `url` varchar(255) DEFAULT NULL COMMENT '内容',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `yh_nav`
--

INSERT INTO `yh_nav` (`id`, `name`, `pid`, `navtype`, `url`, `sort`) VALUES
(1, '首页', 0, 1, '/', 1),
(2, '关于我们', 0, 1, '@1', 2),
(3, '新闻中心', 0, 1, '@2', 3),
(4, '产品中心', 0, 1, '@7', 4),
(5, '成功案例', 0, 1, '@12', 5),
(6, '服务与支持', 0, 1, '@13', 6),
(7, '诚聘英才', 0, 1, '@14', 7),
(8, '联系我们', 0, 1, '@15', 8),
(9, '在线留言', 0, 1, '@16', 9);

-- --------------------------------------------------------

--
-- 表的结构 `yh_nav_wap`
--

CREATE TABLE IF NOT EXISTS `yh_nav_wap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `navtype` smallint(5) NOT NULL DEFAULT '0' COMMENT '说明',
  `url` varchar(255) DEFAULT NULL COMMENT '内容',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `icocolor` varchar(7) DEFAULT NULL,
  `fontcolor` varchar(7) DEFAULT NULL,
  `ico` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- 转存表中的数据 `yh_nav_wap`
--

INSERT INTO `yh_nav_wap` (`id`, `name`, `navtype`, `url`, `sort`, `icocolor`, `fontcolor`, `ico`) VALUES
(23, '产品展示', 5, '@13', 3, '#FFFFFF', '#FFFFFF', 'fa-comments'),
(51, '关于我们', 5, '@1', 2, '#FFFFFF', '#FFFFFF', 'fa-user'),
(52, '留言板', 5, '@16', 8, '#FFFFFF', '#FFFFFF', 'fa-file-o'),
(22, '首页', 4, '/', 1, '#FFFFFF', '#FFFFFF', 'fa-home'),
(49, '新闻资讯', 5, '@2', 5, '#FFFFFF', '#FFFFFF', 'fa-file-o'),
(50, '案例展示', 5, '@12', 4, '#FFFFFF', '#FFFFFF', 'fa-file-picture-o'),
(53, '一键拨号', 1, '13656138807', 7, '#FFFFFF', '#FFFFFF', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `yh_node`
--

CREATE TABLE IF NOT EXISTS `yh_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- 转存表中的数据 `yh_node`
--

INSERT INTO `yh_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'Manage', '后台应用', 1, NULL, 1, 0, 1),
(2, 'Rbac', '用户权限管理', 1, NULL, 1, 1, 2),
(3, 'index', '用户列表', 1, NULL, 1, 2, 3),
(4, 'addUser', '添加用户', 1, NULL, 2, 2, 3),
(5, 'editUser', '编辑用户', 1, NULL, 3, 2, 3),
(6, 'delUser', '删除用户', 1, NULL, 4, 2, 3),
(7, 'Index', '前台应用', 1, NULL, 2, 0, 1),
(8, 'role', '用户组列表', 1, NULL, 5, 2, 3),
(9, 'addRole', '添加用户组', 1, NULL, 6, 2, 3),
(10, 'editRole', '编辑用户组', 1, NULL, 7, 2, 3),
(11, 'delRole', '删除用户组', 1, NULL, 8, 2, 3),
(12, 'access', '权限管理', 1, NULL, 9, 2, 3),
(13, 'node', '节点列表', 0, NULL, 10, 2, 3),
(14, 'addNode', '添加节点', 0, NULL, 11, 2, 3),
(15, 'editNode', '编辑节点', 0, NULL, 12, 2, 3),
(16, 'delNode', '删除节点', 0, NULL, 13, 2, 3),
(17, 'System', '系统设置', 1, NULL, 2, 1, 2),
(18, 'site', '网站设置', 1, NULL, 1, 17, 3),
(19, 'Model', '模型管理', 1, NULL, 3, 1, 2),
(20, 'index', '模型列表', 1, NULL, 1, 19, 3),
(21, 'add', '添加模型', 1, NULL, 2, 19, 3),
(22, 'edit', '模型修改', 1, NULL, 3, 19, 3),
(23, 'del', '删除模型', 1, NULL, 4, 19, 3),
(24, 'sort', '更新排序', 1, NULL, 5, 19, 3),
(25, 'Category', '栏目管理', 1, NULL, 4, 1, 2),
(26, 'index', '栏目列表', 1, NULL, 1, 25, 3),
(27, 'add', '添加栏目', 1, NULL, 2, 25, 3),
(28, 'edit', '修改栏目', 1, NULL, 3, 25, 3),
(29, 'del', '删除栏目', 1, NULL, 4, 25, 3),
(30, 'sort', '更新栏目排序', 1, NULL, 5, 25, 3),
(31, 'Member', '会员管理', 1, NULL, 5, 1, 2),
(32, 'index', '会员列表', 1, NULL, 1, 31, 3),
(33, 'add', '添加会员', 1, NULL, 2, 31, 3),
(34, 'edit', '编辑会员', 1, NULL, 3, 31, 3),
(35, 'del', '删除会员', 1, NULL, 4, 31, 3),
(36, 'Membergroup', '会员组管理', 1, NULL, 6, 1, 2),
(37, 'index', '会员组列表', 1, NULL, 1, 36, 3),
(38, 'add', '添加会员组', 1, NULL, 2, 36, 3),
(39, 'edit', '编辑会员组', 1, NULL, 3, 36, 3),
(40, 'del', '删除会员组', 1, NULL, 4, 36, 3),
(41, 'Announce', '公告管理', 1, NULL, 7, 1, 2),
(42, 'index', '公告列表', 1, NULL, 1, 41, 3),
(43, 'add', '添加公告', 1, NULL, 2, 41, 3),
(44, 'edit', '编辑公告', 1, NULL, 3, 41, 3),
(45, 'del', '删除公告', 1, NULL, 4, 41, 3),
(46, 'Link', '友情链接', 1, NULL, 8, 1, 2),
(47, 'index', '友情列表', 1, NULL, 1, 46, 3),
(48, 'add', '添加友情', 1, NULL, 2, 46, 3),
(49, 'edit', '编辑友情', 1, NULL, 3, 46, 3),
(50, 'del', '删除友情', 1, NULL, 4, 46, 3),
(51, 'Guestbook', '留言本管理', 1, NULL, 9, 1, 2),
(52, 'index', '留言本列表', 1, NULL, 1, 51, 3),
(53, 'reply', '回复留言', 1, NULL, 2, 51, 3),
(54, 'del', '删除留言', 1, NULL, 3, 51, 3),
(55, 'clearCache', '清除缓存', 1, NULL, 2, 17, 3),
(56, 'Personal', '我的账户', 1, NULL, 10, 1, 2),
(57, 'index', '修改资料', 1, NULL, 1, 56, 3),
(58, 'pwd', '修改密码', 1, NULL, 2, 56, 3),
(59, 'Comment', '评论管理', 1, NULL, 10, 1, 2),
(60, 'index', '评论列表', 1, NULL, 1, 59, 3),
(61, 'edit', '编辑评论', 1, NULL, 2, 59, 3),
(62, 'del', '删除评论', 1, NULL, 3, 59, 3),
(63, 'Area', '区域管理', 1, NULL, 12, 1, 2),
(64, 'index', '区域列表', 1, NULL, 1, 63, 3),
(65, 'add', '添加区域', 1, NULL, 2, 63, 3),
(66, 'edit', '编辑区域', 1, NULL, 3, 63, 3),
(67, 'del', '删除区域', 1, NULL, 4, 63, 3),
(68, 'Itemgroup', '联动组管理', 1, NULL, 13, 1, 2),
(69, 'index', '联动组列表', 1, NULL, 1, 68, 3),
(70, 'add', '添加联动组', 1, NULL, 2, 68, 3),
(71, 'edit', '编辑联动组', 1, NULL, 3, 68, 3),
(72, 'del', '删除联动组', 1, NULL, 4, 68, 3),
(73, 'Iteminfo', '联动管理', 1, NULL, 14, 1, 2),
(74, 'index', '联动列表', 1, NULL, 1, 73, 3),
(75, 'add', '添加联动', 1, NULL, 2, 73, 3),
(76, 'edit', '编辑联动', 1, NULL, 3, 73, 3),
(77, 'del', '删除联动', 1, NULL, 4, 73, 3),
(78, 'sort', '更新排序', 1, NULL, 5, 73, 3),
(79, 'Special', '专题管理', 1, NULL, 15, 1, 2),
(80, 'index', '专题列表', 1, NULL, 1, 79, 3),
(81, 'add', '添加专题', 1, NULL, 2, 79, 3),
(82, 'edit', '编辑专题', 1, NULL, 3, 79, 3),
(83, 'del', '删除专题', 1, NULL, 4, 79, 3),
(84, 'trach', '回收站', 1, NULL, 5, 79, 3),
(85, 'restore', '还原专题', 1, NULL, 6, 79, 3),
(86, 'clear', '彻底删除', 1, NULL, 7, 79, 3),
(87, 'Block', '自由块管理', 1, NULL, 16, 1, 2),
(88, 'index', '自由块列表', 1, NULL, 1, 87, 3),
(89, 'add', '添加自由块', 1, NULL, 2, 87, 3),
(90, 'edit', '编辑自由块', 1, NULL, 3, 87, 3),
(91, 'del', '删除自由块', 1, NULL, 4, 87, 3),
(92, 'Database', '数据库管理', 1, NULL, 17, 1, 2),
(93, 'index', '数据表列表', 1, NULL, 1, 92, 3),
(94, 'backup', '数据库备份', 1, NULL, 2, 92, 3),
(95, 'optimize', '数据表优化', 1, NULL, 3, 92, 3),
(96, 'repair', '数据表修复', 1, NULL, 4, 92, 3),
(97, 'restore', '还原管理', 1, NULL, 5, 92, 3),
(98, 'restoreData', '数据恢复', 1, NULL, 6, 92, 3),
(99, 'delSqlFiles', '删除文件', 1, NULL, 7, 92, 3),
(100, 'url', '伪静态缓存设置', 1, NULL, 3, 17, 3),
(101, 'ClearHtml', '静态缓存管理', 1, NULL, 18, 1, 2),
(102, 'all', '一键更新全站', 1, NULL, 1, 101, 3),
(103, 'home', '更新首页', 1, NULL, 2, 101, 3),
(104, 'lists', '更新栏目', 1, NULL, 3, 101, 3),
(105, 'shows', '更新文档', 1, NULL, 4, 101, 3),
(106, 'special', '更新专题', 1, NULL, 5, 101, 3);

-- --------------------------------------------------------

--
-- 表的结构 `yh_order`
--

CREATE TABLE IF NOT EXISTS `yh_order` (
  `orderid` varchar(80) NOT NULL,
  `memberid` int(10) unsigned NOT NULL,
  `paytype` tinyint(2) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `expressprice` float(13,2) NOT NULL DEFAULT '0.00' COMMENT '邮费/运费',
  `price` float(13,2) NOT NULL DEFAULT '0.00' COMMENT '产品总价格',
  `priceCount` float(13,2) NOT NULL COMMENT '总价格',
  `consignee` varchar(30) DEFAULT NULL COMMENT '收件人',
  `address` varchar(255) NOT NULL DEFAULT '',
  `zip` int(10) NOT NULL DEFAULT '0',
  `tel` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `stime` int(10) NOT NULL DEFAULT '0',
  KEY `stime` (`stime`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yh_orderdetail`
--

CREATE TABLE IF NOT EXISTS `yh_orderdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(50) DEFAULT NULL COMMENT '订单ID',
  `productid` int(11) DEFAULT NULL,
  `memberid` int(10) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `price` float(13,2) NOT NULL DEFAULT '0.00',
  `num` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_ordering`
--

CREATE TABLE IF NOT EXISTS `yh_ordering` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `adds` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `time` int(10) DEFAULT NULL,
  `is_email` int(1) DEFAULT '0',
  `is_look` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_picture`
--

CREATE TABLE IF NOT EXISTS `yh_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `color` char(10) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `keywords` varchar(1000) DEFAULT '' COMMENT '关键字',
  `tag` varchar(250) DEFAULT NULL,
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '摘要描述',
  `copyfrom` varchar(100) NOT NULL DEFAULT '' COMMENT '来源',
  `template` varchar(30) NOT NULL DEFAULT '' COMMENT '模板',
  `pictureurls` text COMMENT '图片地址',
  `content` text COMMENT '内容',
  `publishtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `sort` int(6) DEFAULT NULL,
  `commentflag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许评论',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性',
  `jumpurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'admin',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `yh_picture`
--

INSERT INTO `yh_picture` (`id`, `title`, `color`, `keywords`, `tag`, `litpic`, `description`, `copyfrom`, `template`, `pictureurls`, `content`, `publishtime`, `updatetime`, `click`, `cid`, `sort`, `commentflag`, `flag`, `jumpurl`, `status`, `userid`, `aid`) VALUES
(1, '成功案例', '', '', '', '/demo/uploads/img/20150821/55d6eff53a555.jpg', '成功案例', '', '', '/demo/uploads/img/20150821/55d6eff53a555.jpg$$$$$$', '<p>成功案例</p>', 1440146697, 1440149495, 105, 12, 0, 0, 0, '', 0, 0, 1),
(2, '成功案例', '', '', '', '/demo/uploads/img/20150821/55d6efea9a2bc.jpg', '成功案例', '', '', '/demo/uploads/img/20150821/55d6efea9a2bc.jpg$$$$$$', '<p>成功案例</p>', 1440146697, 1448619135, 51, 12, 0, 0, 0, '', 0, 0, 1),
(3, '成功案例', '', '', '', '/demo/uploads/img/20150821/55d6efdef3f43.jpg', '成功案例', '', '', '/demo/uploads/img/20150821/55d6efdef3f43.jpg$$$$$$', '<p>成功案例</p>', 1440146697, 1446254801, 116, 12, 0, 0, 5, '', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yh_product`
--

CREATE TABLE IF NOT EXISTS `yh_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `etitle` varchar(200) DEFAULT NULL,
  `color` char(10) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `keywords` varchar(1000) DEFAULT '' COMMENT '关键字',
  `tag` varchar(250) DEFAULT NULL,
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `pictureurls` text COMMENT '图片地址',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '摘要描述',
  `price` float NOT NULL DEFAULT '0',
  `sort` smallint(6) DEFAULT NULL,
  `trueprice` float NOT NULL DEFAULT '0',
  `brand` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌',
  `units` varchar(50) NOT NULL DEFAULT '' COMMENT '单位',
  `specification` varchar(50) NOT NULL DEFAULT '' COMMENT '规格',
  `publishtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许评论',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性',
  `jumpurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'admin',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `yh_product`
--

INSERT INTO `yh_product` (`id`, `title`, `etitle`, `color`, `keywords`, `tag`, `litpic`, `pictureurls`, `content`, `description`, `price`, `sort`, `trueprice`, `brand`, `units`, `specification`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `jumpurl`, `status`, `userid`, `aid`) VALUES
(1, '颈饰项链', '', '', '', '', '/demo/uploads/img/20150821/55d6f20bc4731.jpg', '/demo/uploads/img/20150821/55d6f20bc4731.jpg$$$$$$', '<h5 style="margin: 0px; padding: 0px 0px 10px; font-size: 14px; color: rgb(209, 32, 39); font-stretch: normal; line-height: 30px; font-family: tahoma; text-align: left; white-space: normal; background-color: rgb(255, 255, 255);">饰设计网是专业为首饰企业、首饰贸易公司、首饰设计师提供最前端的首饰款式方面的流行资讯!</h5><p><br/></p>', '饰设计网是专业为首饰企业、首饰贸易公司、首饰设计师提供最前端的首饰款式方面的流行资讯!', 0, 0, 0, '', '', '', 1440145192, 1440150029, 1649, 8, 0, 1, '', 0, 0, 1),
(2, '钻石耳钉', '', '', '', '', '/demo/uploads/img/20150821/55d6f200a5abd.jpg', '/demo/uploads/img/20150821/55d6f200a5abd.jpg$$$$$$', '<p><span style="margin: 0px; padding: 0px; font-size: small; color: rgb(51, 51, 0);"><span style="line-height: 0px;">﻿</span>钻石大小</span>18K白金总重<span style="margin: 0px; padding: 0px; font-size: small; color: rgb(51, 51, 0);">PT950铂金总重</span><span style="margin: 0px; padding: 0px; font-size: small; color: rgb(255, 0, 0);"><strong style="margin: 0px; padding: 0px;">证书</strong></span><span style="margin: 0px; padding: 0px; color: rgb(51, 51, 0);"><span style="margin: 0px; padding: 0px; font-size: small;">现货直发参数</span></span>特价30分一对<span style="margin: 0px; padding: 0px; font-size: small;">约0.6克</span><span style="margin: 0px; padding: 0px; font-size: small;">约0.8克</span><span style="margin: 0px; padding: 0px; font-size: small; color: rgb(255, 0, 0);"><strong style="margin: 0px; padding: 0px;">NGTC国检</strong></span></p><p>34分一对<span style="margin: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-size: small;">约0.6克</span></span><span style="margin: 0px; padding: 0px; font-size: small;">约0.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-size: small;"><strong style="margin: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; color: rgb(255, 0, 0);">18K白金34分一对IJ色<span style="margin: 0px; padding: 0px;">现货直发</span></span></strong></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px;"><br/></p><p>特价36分一对<span style="margin: 0px; padding: 0px; font-size: small;">约0.6克</span><span style="margin: 0px; padding: 0px; font-size: small;">约0.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong><span style="margin: 0px; padding: 0px; font-size: small;"><strong style="margin: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; color: rgb(255, 0, 0);">PT950铂金38分一对IJ色<span style="margin: 0px; padding: 0px;">特价现货</span></span></strong></span>40分一对<span style="margin: 0px; padding: 0px; color: rgb(51, 51, 0);"><span style="margin: 0px; padding: 0px; font-size: small;">约1克</span></span><span style="margin: 0px; padding: 0px; font-size: small;">约1.4克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-size: small; white-space: pre-line;">&nbsp;</span></p><p>50分一对<span style="margin: 0px; padding: 0px; font-size: small;">约1克</span><span style="margin: 0px; padding: 0px; font-size: small;">约1.4克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-size: small; color: rgb(255, 0, 0);"><strong style="margin: 0px; padding: 0px;">PT950铂金46分一对FG色为现货，价格3999元一对</strong></span></p><p>60分一对<span style="margin: 0px; padding: 0px; font-size: small;">约1克</span><span style="margin: 0px; padding: 0px; font-size: small;">约1.4克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;70分一对<span style="margin: 0px; padding: 0px; font-size: small;">约1克</span><span style="margin: 0px; padding: 0px; font-size: small;">约1.4克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;80分一对<span style="margin: 0px; padding: 0px; font-size: small;">约1克</span><span style="margin: 0px; padding: 0px; font-size: small;">约1.4克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;100分一对<span style="margin: 0px; padding: 0px; font-size: small;">约2克</span><span style="margin: 0px; padding: 0px; font-size: small;">约2.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;110分一对<span style="margin: 0px; padding: 0px; font-size: small;">约2克</span><span style="margin: 0px; padding: 0px; font-size: small;">约2.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;140分一对<span style="margin: 0px; padding: 0px; font-size: small;">约2克</span><span style="margin: 0px; padding: 0px; font-size: small;">约2.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;160分一对<span style="margin: 0px; padding: 0px; font-size: small;">约2克</span><span style="margin: 0px; padding: 0px; font-size: small;">约2.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;200分一对<span style="margin: 0px; padding: 0px; font-size: small;">约2克</span><span style="margin: 0px; padding: 0px; font-size: small;">约2.8克</span><strong style="margin: 0px; padding: 0px;">NGTC国检</strong>&nbsp;</p><p><br/></p>', '﻿钻石大小18K白金总重PT950铂金总重证书现货直发参数特价30分一对约0.6克约0.8克NGTC国检34分一对约0.6克约0.8克NGTC国检18K白金34分一对IJ色现货直发特价36分一对约0.6克约0.8克NGTC国检PT950铂金', 0, 0, 0, '', '', '', 1440145296, 1440150018, 2920, 8, 0, 0, '', 0, 0, 1),
(3, '尚满（Somemy）卧室家具', '', '', '', '', '/demo/uploads/img/20150821/55d6f1ec6c852.jpg', '/demo/uploads/img/20150821/55d6f1ec6c852.jpg$$$$$$', '<ul id="parameter2" class="p-parameter-list list-paddingleft-2" style="list-style-type: none;"><li><p>商品名称：尚满（Somemy）卧室家具 双人床 气压储物高箱床 气动床体 1500*2000mm</p></li><li><p>商品编号：1492728589</p></li><li><p>店铺：&nbsp;<a href="http://jiajujiu.jd.com/" target="_blank" style="margin: 0px; padding: 0px; color: rgb(0, 90, 160); text-decoration: none;">家居就建材家居旗舰店</a></p></li><li><p>上架时间：2015-03-25 09:05:29</p></li><li><p>商品毛重：100.0kg</p></li><li><p>材质：木质</p></li><li><p>家装风格：中式现代</p></li><li><p>床结构：排骨架</p></li><li><p>类别：实木床</p></li><li><p>床尺寸：1500mm*2000mm</p></li></ul><p><br/></p>', '商品名称：尚满（Somemy）卧室家具 双人床 气压储物高箱床 气动床体 1500*2000mm商品编号：1492728589店铺： 家居就建材家居旗舰店上架时间：2015-03-25 09:05:29商品毛重：100.0kg材质', 0, 0, 0, '', '', '', 1440145604, 1440149998, 4761, 10, 0, 1, '', 0, 0, 1),
(4, '真皮沙发', '', '', '', '', '/demo/uploads/img/20150821/55d6f1dd4a88f.jpg', '/demo/uploads/img/20150821/55d6f1dd4a88f.jpg$$$$$$', '<p>&nbsp;</p>', ' ', 0, 0, 0, '', '', '', 1440146362, 1440149983, 4663, 10, 0, 1, '', 0, 0, 1),
(5, 'iPad1', '', '', '', '', '/demo/uploads/img/20150821/55d6f1d05287c.jpg', '/demo/uploads/img/20150821/55d6f1d05287c.jpg$$$$$$', '<p>iPad 让你随心所欲。它是你的网络浏览器、你的收件箱、你最喜爱的小说，更是你实现足不出户，即可与远方好友面对面交谈的方式。它让你常做和不常做的事变得更智能、更直观，而且乐趣无穷。</p>', 'iPad 让你随心所欲。它是你的网络浏览器、你的收件箱、你最喜爱的小说，更是你实现足不出户，即可与远方好友面对面交谈的方式。它让你常做和不常做的事变得更智能、更直观，而且乐趣无穷。', 0, 0, 0, '', '', '', 1440146424, 1450941366, 4745, 9, 0, 1, '', 0, 0, 1),
(6, '自行车', '', '', '', '', '/demo/uploads/img/20150821/55d6f1c318630.jpg', '/demo/uploads/img/20150821/55d6f1c318630.jpg$$$$$$', '<p>自行车是世界上最方便的交通工具</p>', '自行车是世界上最方便的交通工具', 0, 0, 0, '', '', '', 1440146577, 1440149957, 4545, 11, 0, 0, '', 0, 0, 1),
(7, '爱马仕1', '', '', '', '', '/demo/uploads/img/20150824/55dac3ac808f9.jpg', '/demo/uploads/img/20150824/55dac3ac808f9.jpg$$$$$$', '<p>爱马仕</p>', '爱马仕', 0, 0, 0, '', '', '', 1440400308, 1450941686, 4059, 8, 0, 1, '', 0, 0, 1),
(8, '宝格丽', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3ad024d0.jpg', '/demo/uploads/img/20150824/55dac3ad024d0.jpg$$$$$$', '宝格丽', '宝格丽', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4001, 8, 1, 4, '', 0, 0, 1),
(9, '宝格丽B.ZERO1系列女士', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3ad4e41b.jpg', '/demo/uploads/img/20150824/55dac3ad4e41b.jpg$$$$$$', '宝格丽B.ZERO1系列女士', '宝格丽B.ZERO1系列女士', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4071, 8, 1, 1, '', 0, 0, 1),
(10, '宝格丽B.ZERO1系列女士18K白金', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3ada27ec.jpg', '/demo/uploads/img/20150824/55dac3ada27ec.jpg$$$$$$', '宝格丽B.ZERO1系列女士18K白金', '宝格丽B.ZERO1系列女士18K白金', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4028, 8, 1, 1, '', 0, 0, 1),
(11, '宝格丽DIVA系列', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3ae0186f.JPG', '/demo/uploads/img/20150824/55dac3ae0186f.JPG$$$$$$', '宝格丽DIVA系列', '宝格丽DIVA系列', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4002, 8, 1, 1, '', 0, 0, 1),
(12, '宝格丽PARENTES', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3ae6549f.jpg', '/demo/uploads/img/20150824/55dac3ae6549f.jpg$$$$$$', '宝格丽PARENTES', '宝格丽PARENTES', 0, 0, 0, '', '', '', 1440400308, 1440400308, 3857, 8, 1, 1, '', 0, 0, 1),
(13, '宝格丽白色陶瓷18K', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3aed0355.jpg', '/demo/uploads/img/20150824/55dac3aed0355.jpg$$$$$$', '宝格丽白色陶瓷18K', '宝格丽白色陶瓷18K', 0, 0, 0, '', '', '', 1440400308, 1440400308, 3950, 8, 1, 4, '', 0, 0, 1),
(14, '梵克雅宝18K黄金', '', '', '', '', '/demo/uploads/img/20150824/55dac3af8a0fe.jpg', '/demo/uploads/img/20150824/55dac3af8a0fe.jpg$$$$$$', '<p>梵克雅宝18K黄金</p>', '梵克雅宝18K黄金', 0, 0, 0, '', '', '', 1440400308, 1450941405, 4291, 8, 0, 1, '', 0, 0, 1),
(15, '卡地亚18K白金', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3b0024a8.jpg', '/demo/uploads/img/20150824/55dac3b0024a8.jpg$$$$$$', '卡地亚18K白金', '卡地亚18K白金', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4261, 8, 1, 0, '', 0, 0, 1),
(16, '卡地亚18K玫瑰', NULL, '', '', NULL, '/demo/uploads/img/20150824/55dac3b07b700.jpg', '/demo/uploads/img/20150824/55dac3b07b700.jpg$$$$$$', '卡地亚18K玫瑰', '卡地亚18K玫瑰', 0, 0, 0, '', '', '', 1440400308, 1440400308, 4450, 8, 1, 4, '', 0, 0, 1),
(17, '卡地亚18K玫瑰金', '', '', '', '卡地亚', '/demo/uploads/img/20150824/55dac3b0ea687.jpg', '/demo/uploads/img/20150824/55dac3b0ea687.jpg$$$$$$', '<p>卡地亚18K玫瑰金</p>', '卡地亚18K玫瑰金', 0, 0, 0, '', '', '', 1440400308, 1446254735, 4508, 8, 0, 0, '', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yh_role`
--

CREATE TABLE IF NOT EXISTS `yh_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `yh_role`
--

INSERT INTO `yh_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(1, '管理员', 0, 1, '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `yh_role_user`
--

CREATE TABLE IF NOT EXISTS `yh_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yh_role_user`
--

INSERT INTO `yh_role_user` (`role_id`, `user_id`) VALUES
(0, '1');

-- --------------------------------------------------------

--
-- 表的结构 `yh_sitelink`
--

CREATE TABLE IF NOT EXISTS `yh_sitelink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `num` varchar(100) DEFAULT NULL,
  `otype` varchar(10) NOT NULL,
  `isok` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_special`
--

CREATE TABLE IF NOT EXISTS `yh_special` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `shorttitle` varchar(30) NOT NULL DEFAULT '' COMMENT '副标题',
  `color` char(10) NOT NULL DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `keywords` varchar(50) DEFAULT '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` varchar(255) NOT NULL DEFAULT '',
  `content` text COMMENT '内容',
  `publishtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许评论',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性',
  `jumpurl` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1回收站',
  `filename` varchar(60) DEFAULT '',
  `template` varchar(60) NOT NULL DEFAULT '',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'admin',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `yh_wxmenu`
--

CREATE TABLE IF NOT EXISTS `yh_wxmenu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(10) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL COMMENT '内容',
  `sort` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `yh_wxmenu`
--

INSERT INTO `yh_wxmenu` (`id`, `name`, `pid`, `url`, `sort`) VALUES
(33, '菜单1', 0, 'http://www.baidu.com', 1),
(34, '菜单2', 0, 'http://www.baidu.com', 2),
(35, '菜单3', 0, 'http://www.baidu.com', 3),
(36, '菜单11', 33, 'http://www.baidu.com', 1),
(37, '菜单21', 34, 'http://www.baidu.com', 1),
(38, '菜单31', 35, 'http://www.baidu.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
