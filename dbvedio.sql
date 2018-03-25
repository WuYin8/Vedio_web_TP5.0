-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-03-01 18:04:36
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbvedio`
--

-- --------------------------------------------------------

--
-- 表的结构 `vedio_auth`
--

CREATE TABLE `vedio_auth` (
  `authid` int(11) NOT NULL COMMENT '权限的id',
  `pid` int(11) DEFAULT NULL COMMENT '节点id',
  `auth_name` varchar(50) NOT NULL COMMENT '权限的名称',
  `url` varchar(50) NOT NULL COMMENT '节点说对应页面的路径',
  `type` varchar(50) NOT NULL COMMENT '权限所对应的级别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- 转存表中的数据 `vedio_auth`
--

INSERT INTO `vedio_auth` (`authid`, `pid`, `auth_name`, `url`, `type`) VALUES
(1, 0, '用户管理', '', '一级'),
(4, 1, '用户信息', '/admin/user/index', '2级'),
(7, 0, '视频管理', '', '一级'),
(8, 7, '基本信息', '/admin/res/res', '2级'),
(9, 7, '视频回收站', '/admin/res/hres', '2级'),
(10, 0, '板块管理', '', '一级'),
(11, 10, '板块展示', '/admin/sqlclass/sqlclass', '2级'),
(19, 0, '文本管理', '', '一级'),
(20, 19, '评论展示', '/admin/report/report', '2级'),
(21, 19, '评论回收站', '/admin/report/hreport', '2级'),
(22, 19, '弹幕展示', '/admin/danmu/danmu', '2级'),
(23, 0, '留言管理', '/admin/liuyan/liuyan', '一级'),
(24, 23, '留言展示', '/admin/liuyan/liuyan', '2级'),
(25, 23, '回复留言展示', '/admin/reply/reply', '2级'),
(26, 0, '管理员管理', '', '1级'),
(27, 26, '用户管理', '/admin/user/gly', '2级'),
(31, 26, '角色管理', '/admin/user/rol', '2级'),
(32, 26, '权限管理', '/admin/auth/auth', '2级'),
(33, NULL, 'ss', 'ss', 's'),
(34, NULL, '闪闪', '1级', '/admin/user/user'),
(35, NULL, 'tt', '1', 'ad'),
(36, NULL, '问问', '2', 'admin/user/dan'),
(37, 0, '支付管理', '', '一级'),
(38, 37, '支付详细信息', '/admin/pay/pay', '二级');

-- --------------------------------------------------------

--
-- 表的结构 `vedio_danmu`
--

CREATE TABLE `vedio_danmu` (
  `did` int(11) NOT NULL COMMENT '弹幕的id',
  `vid` int(11) NOT NULL COMMENT '视频的id',
  `word` varchar(500) NOT NULL COMMENT '弹幕内容',
  `color` varchar(32) NOT NULL COMMENT '弹幕颜色',
  `speed` int(11) NOT NULL COMMENT '弹幕滚动速度',
  `top` int(11) NOT NULL COMMENT '弹幕位置',
  `fontSize` int(11) NOT NULL COMMENT '弹幕字体大小',
  `action` varchar(32) NOT NULL COMMENT '弹幕类型',
  `time` int(11) NOT NULL COMMENT '弹幕在视频中出现的时间',
  `uid` int(11) NOT NULL COMMENT '发送弹幕人的id',
  `username` varchar(32) NOT NULL COMMENT '发送弹幕人的姓名',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '弹幕的创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `vedio_danmu`
--

INSERT INTO `vedio_danmu` (`did`, `vid`, `word`, `color`, `speed`, `top`, `fontSize`, `action`, `time`, `uid`, `username`, `create_time`) VALUES
(1, 11, '你好', '#ffffff', 10, 10, 16, 'marquee', 1, 76, '小花', '2018-02-19 09:48:23'),
(2, 11, '好棒啊', '#ffffff', 10, 20, 16, 'marquee', 1, 76, '小花', '2018-02-19 13:12:55'),
(3, 11, '怎么这么厉害', '#ffffff', 10, 10, 16, 'stay', 9, 76, '小花', '2018-02-19 13:13:13'),
(5, 11, '小姐姐漂亮', '#ffffff', 10, 90, 16, 'marquee', 9, 76, '小花', '2018-02-19 14:08:25'),
(6, 11, '小姐姐！！！', '#ff0080', 10, 30, 20, 'stay', 2, 76, '小花', '2018-02-19 15:57:42'),
(8, 49, '哈哈哈', '#ffffff', 10, 10, 16, 'marquee', 4, 77, '小明', '2018-02-26 08:11:24'),
(9, 117, '今天天气不错', '#00ffff', 10, 20, 25, 'marquee', 3, 77, '小明', '2018-02-28 01:46:53'),
(10, 49, '好萌啊', '#ff0000', 10, 10, 25, 'stay', 12, 77, '小明', '2018-02-28 02:51:07'),
(11, 75, 'VVXCVXVXCV', '#ffffff', 10, 10, 16, 'marquee', 15, 117, '小灰灰', '2018-02-28 06:37:26'),
(14, 38, '是是是', '#ffffff', 10, 10, 16, 'marquee', 4, 116, '闪闪2', '2018-03-01 00:50:55'),
(13, 117, '好大的太阳', '#ffffff', 10, 10, 16, 'marquee', 11, 117, '小灰灰', '2018-02-28 13:03:56'),
(15, 117, '闪闪', '#ffffff', 10, 10, 16, 'marquee', 2, 116, '闪闪2', '2018-03-01 00:53:39'),
(16, 115, '非常好', '#ffffff', 10, 10, 16, 'marquee', 2, 117, '小灰灰', '2018-03-01 05:46:28'),
(17, 119, 'ffff', '#ffffff', 10, 10, 16, 'marquee', 1, 116, '闪闪2', '2018-03-01 06:14:26'),
(18, 119, 'ffffffffffffffffffffff', '#ffffff', 10, 10, 16, 'marquee', 7, 116, '闪闪2', '2018-03-01 06:14:37'),
(19, 115, '你好', '#ffffff', 10, 10, 16, 'marquee', 5, 77, '小明', '2018-03-01 07:30:18'),
(20, 115, 'jintian', '#ff0080', 10, 30, 16, 'stay', 2, 75, 'weibo_qiutierlai', '2018-03-01 09:12:59'),
(21, 115, 'jintian', '#ff0080', 10, 30, 16, 'stay', 36, 75, 'weibo_qiutierlai', '2018-03-01 09:13:08'),
(22, 115, 'jintian', '#ff0080', 10, 30, 16, 'stay', 28, 75, 'weibo_qiutierlai', '2018-03-01 09:13:20'),
(23, 115, '你好', '#00ff00', 10, 50, 23, 'marquee', 16, 77, '小明', '2018-03-01 09:21:52');

-- --------------------------------------------------------

--
-- 表的结构 `vedio_list`
--

CREATE TABLE `vedio_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台具体大的板块列表';

--
-- 转存表中的数据 `vedio_list`
--

INSERT INTO `vedio_list` (`id`, `name`, `parentid`) VALUES
(1, '用户管理', 0),
(2, '视频管理', 0),
(3, '文本管理', 0),
(4, '展示列表', 0),
(5, '留言管理', 0),
(6, '权限管理', 0),
(7, '用户列表展示', 1),
(8, '操作展示的列表', 1),
(9, '视频详情', 2),
(10, '评论管理', 3),
(11, '弹幕管理', 3),
(12, '消息管理', 3),
(13, '展示推荐的视频', 4),
(14, '展示收藏的视频', 4),
(15, '评论展示', 5),
(16, '回复评论展示', 5);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_liuyan`
--

CREATE TABLE `vedio_liuyan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '被留言人的id',
  `content` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_del` int(11) NOT NULL DEFAULT '0' COMMENT '是否加入回收站（1=删除，0=展示）',
  `name` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言展示';

--
-- 转存表中的数据 `vedio_liuyan`
--

INSERT INTO `vedio_liuyan` (`id`, `user_id`, `pid`, `content`, `create_time`, `is_del`, `name`, `photo`) VALUES
(10, 77, 77, '你好', '2018-02-04 12:13:02', 0, ' 小明', ' /images/user.png'),
(11, 77, 77, '小倔强', '2018-02-04 12:25:16', 0, ' 小明', ' /images/user.png'),
(12, 77, 77, '为什么', '2018-02-04 12:26:04', 0, ' 小明', ' /images/user.png'),
(13, 77, 77, '小脾气', '2018-02-04 12:26:47', 0, ' 小明', ' /images/user.png'),
(14, 77, 77, '只能说', '2018-02-04 12:30:03', 0, ' 小明', ' /images/user.png'),
(15, 77, 77, '转就行', '2018-02-04 12:32:30', 0, ' 小明', ' /images/user.png'),
(16, 77, 77, '再来一局', '2018-02-04 12:33:25', 0, ' 小明', ' /images/user.png'),
(18, 77, 77, '你好', '2018-02-05 13:31:46', 0, ' 小明', ' /images/user.png'),
(22, 76, 77, '这也可以？', '2018-02-06 06:52:03', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(24, 76, 77, '见证奇迹的时刻', '2018-02-06 06:55:46', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(25, 76, 77, '我甚至叹了口气', '2018-02-06 06:56:35', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(26, 76, 77, '已经习惯', '2018-02-06 06:57:09', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(28, 76, 77, '谢登峰到此一游', '2018-02-06 06:58:02', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(29, 76, 77, '谢登峰到此两游', '2018-02-06 06:58:55', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(30, 76, 76, '自家的留言板', '2018-02-06 06:59:11', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(31, 75, 76, '真好呢', '2018-02-06 11:03:04', 0, 'weibo_qiutierlai', '/images/user.png'),
(32, 76, 76, '就是方便呢', '2018-02-14 12:57:46', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(33, 76, 75, '你好啊', '2018-02-25 07:09:30', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(34, 76, 75, '常来啊', '2018-02-25 07:09:40', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(35, 75, 75, '哈哈听听', '2018-02-26 03:45:03', 0, 'weibo_qiutierlai', '/images/user.png'),
(36, 76, 76, '同步和异步的区别', '2018-02-26 08:32:40', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(37, 76, 76, '好像不用在意', '2018-02-26 08:32:54', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(38, 76, 76, '你们说呢', '2018-02-26 08:33:01', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(39, 76, 76, '现在应该可以了', '2018-02-26 08:36:54', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(40, 76, 76, '不使用异步，两个方法都能用，就是需要等待，时间间隔长一些', '2018-02-26 08:37:24', 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png'),
(41, 77, 77, '哈哈', '2018-02-28 01:45:41', 0, '小明', '/images/user.png'),
(42, 77, 76, '花花你怎么样啊', '2018-02-28 01:45:59', 0, '小明', '/images/user.png'),
(43, 75, 75, '三方用户没人权啊', '2018-02-28 03:00:29', 0, 'weibo_qiutierlai', '/images/user.png'),
(44, 117, 117, '没有人呢', '2018-02-28 06:23:04', 0, '小灰灰', '/images/user.png'),
(45, 117, 117, 'BUZHIDA ', '2018-02-28 06:40:04', 0, '小灰灰', '/images/user.png'),
(46, 117, 117, '哈哈', '2018-02-28 07:01:44', 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg'),
(47, 117, 77, '谢登峰到此三游', '2018-02-28 07:02:15', 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg'),
(48, 116, 116, '是是是', '2018-03-01 00:53:11', 0, '闪闪2', '/images/user.png');

-- --------------------------------------------------------

--
-- 表的结构 `vedio_pay`
--

CREATE TABLE `vedio_pay` (
  `id` int(11) NOT NULL COMMENT '交易id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `vid` int(11) NOT NULL COMMENT '视频id',
  `title` varchar(32) NOT NULL COMMENT '视频标题',
  `price` float NOT NULL COMMENT '价格',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '交易创建时间',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除交易（1=删除，0=保留）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `vedio_pay`
--

INSERT INTO `vedio_pay` (`id`, `uid`, `username`, `vid`, `title`, `price`, `create_time`, `is_del`) VALUES
(2, 75, 'weibo_qiutierlai', 11, '武汉潮流街拍，美女小姐姐们的穿搭很实用呀', 0.01, '2018-02-27 00:44:34', 0),
(11, 117, '小灰', 11, '武汉潮流街拍，美女小姐姐们的穿搭很实用呀', 0.01, '2018-02-28 13:41:44', 0);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_reply`
--

CREATE TABLE `vedio_reply` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reply_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo` varchar(50) NOT NULL,
  `is_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='版主回复留言';

--
-- 转存表中的数据 `vedio_reply`
--

INSERT INTO `vedio_reply` (`id`, `userid`, `title`, `content`, `name`, `reply_time`, `photo`, `is_login`) VALUES
(1, 2, '主题', '住酒店扩多扩木错女扩木扩扩扩扩扩扩军扩女', '刘星', '2018-02-01 09:42:17', '', 1),
(2, 2, '主题1', '住酒店扩多扩木错女扩木扩扩扩扩扩扩军扩女或承诺承诺就是大家的', '刘姐姐', '2018-02-01 09:42:46', '', 0),
(7, 1, '主题7', 'dhjshjd还记得就好', 'json', '2018-02-01 09:45:13', '', 0),
(8, 7, '主题8', '焦点科技', 'json', '2018-02-01 09:45:51', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_report`
--

CREATE TABLE `vedio_report` (
  `id` int(11) NOT NULL,
  `vedio_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `content` varchar(1400) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_del` int(11) NOT NULL DEFAULT '0' COMMENT '是否加入回收站（1=删除，0=展示）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文本管理/评论展示';

--
-- 转存表中的数据 `vedio_report`
--

INSERT INTO `vedio_report` (`id`, `vedio_id`, `userid`, `pid`, `username`, `photo`, `content`, `create_time`, `is_del`) VALUES
(3, 11, 77, 0, '小明', '/images/user.png', '老师肯定会计', '2018-02-01 13:45:16', 1),
(4, 11, 75, 3, 'weibo_qiutierlai', '/images/user.png', '肥嘟嘟老师肯定', '2018-02-01 13:45:40', 0),
(5, 11, 76, 3, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '肥嘟嘟老师', '2018-02-01 13:46:12', 0),
(6, 11, 74, 3, 'qq_马猴烧酒子威君', '/images/user.png', '开始啦师肯定会', '2018-02-01 13:47:02', 0),
(7, 11, 77, 0, '小明', '/images/user.png', '开始啦师新科技定', '2018-02-01 13:47:31', 0),
(8, 11, 77, 0, '小明', '/images/user.png', '开始新科技定会', '2018-02-01 13:48:12', 0),
(10, 11, 75, 7, 'weibo_qiutierlai', '/images/user.png', '安静的', '2018-02-01 13:49:48', 0),
(11, 11, 76, 0, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '小姐姐好漂亮', '2018-02-05 13:23:08', 0),
(12, 11, 76, 11, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '小姐姐好会打扮哪', '2018-02-05 13:23:59', 0),
(13, 11, 76, 11, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '小姐姐好会打扮哪', '2018-02-05 13:24:14', 0),
(14, 11, 76, 11, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '学习到了', '2018-02-05 13:25:05', 0),
(15, 11, 76, 11, '小花', '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '希望我也要变得美美的', '2018-02-05 13:25:44', 0),
(16, 11, 77, 0, '小明', '/images/user.png', '你好的呀', '2018-02-06 00:31:10', 0),
(17, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '小姐姐就是我的目标！！', '2018-02-06 03:39:36', 0),
(24, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '吔屎啦梁非凡', '2018-02-06 03:56:18', 0),
(25, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '要不换个格式吧', '2018-02-06 03:57:17', 0),
(26, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '眼泪掉下来', '2018-02-06 03:57:49', 0),
(27, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '为什么呢', '2018-02-06 03:58:29', 0),
(28, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '真的是', '2018-02-06 03:59:13', 0),
(29, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '我全都要', '2018-02-06 03:59:37', 0),
(30, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '要吃饭了', '2018-02-06 04:01:04', 0),
(31, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '什么', '2018-02-06 04:30:18', 0),
(43, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '小酒窝长睫毛', '2018-02-06 04:48:36', 0),
(44, 11, 76, 29, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '超尴尬的', '2018-02-06 04:50:04', 0),
(45, 11, 76, 28, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '你懂吗', '2018-02-06 04:50:16', 0),
(46, 11, 76, 30, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '这次总可以了吧', '2018-02-06 04:54:28', 0),
(47, 11, 76, 28, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '真是让人伤心', '2018-02-06 04:54:52', 0),
(48, 11, 76, 29, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '难道不能再加了吗', '2018-02-06 04:55:07', 0),
(49, 11, 76, 30, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '中间不能加其他东西', '2018-02-06 04:55:58', 0),
(50, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '哈哈哈', '2018-02-06 04:58:33', 0),
(51, 11, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '休斯顿，点火', '2018-02-06 05:01:14', 0),
(52, 11, 76, 51, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '休斯顿，二次点火', '2018-02-06 05:01:37', 0),
(53, 11, 76, 51, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '这次终于可以睡个好觉了', '2018-02-06 05:01:52', 0),
(54, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '再也不用担心什么了', '2018-02-06 05:01:59', 0),
(55, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '哈哈哈哈', '2018-02-06 05:02:05', 0),
(56, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '留言也按照这个做吧', '2018-02-06 05:02:13', 0),
(57, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '有点延迟？', '2018-02-06 05:02:34', 0),
(58, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '怎么回事', '2018-02-06 05:02:46', 0),
(59, 11, 76, 50, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '又好了？', '2018-02-06 05:02:54', 0),
(60, 10, 77, 0, '小明', '/images/user.png', '不知细叶谁裁出', '2018-02-06 07:07:44', 0),
(61, 10, 77, 0, '小明', '/images/user.png', '二月春风似剪刀', '2018-02-06 07:07:54', 0),
(62, 10, 77, 0, '小明', '/images/user.png', '第三次', '2018-02-06 07:08:06', 0),
(63, 9, 77, 0, '小明', '/images/user.png', '第一次这么特殊的吗', '2018-02-06 07:08:22', 0),
(64, 11, 75, 30, 'weibo_qiutierlai', '/images/user.png', '火箭发射', '2018-02-06 09:41:01', 0),
(65, 11, 75, 30, 'weibo_qiutierlai', '/images/user.png', '我在哪里', '2018-02-06 09:43:42', 0),
(66, 11, 75, 30, 'weibo_qiutierlai', '/images/user.png', '找到了家的感觉', '2018-02-06 09:45:16', 0),
(67, 11, 75, 24, 'weibo_qiutierlai', '/images/user.png', '你好啊，我叫赛利亚', '2018-02-06 09:46:39', 0),
(68, 11, 75, 51, 'weibo_qiutierlai', '/images/user.png', '相信自己', '2018-02-06 09:57:57', 0),
(69, 11, 75, 51, 'weibo_qiutierlai', '/images/user.png', '是', '2018-02-06 10:00:17', 0),
(70, 11, 75, 51, 'weibo_qiutierlai', '/images/user.png', '为什么呢', '2018-02-06 10:01:10', 0),
(71, 11, 75, 29, 'weibo_qiutierlai', '/images/user.png', '他们来了', '2018-02-06 10:02:52', 0),
(72, 11, 75, 43, 'weibo_qiutierlai', '/images/user.png', '谁把你的长发盘起', '2018-02-06 10:04:38', 0),
(73, 11, 75, 0, 'weibo_qiutierlai', '/images/user.png', '谁看了我给你写的信', '2018-02-06 10:05:43', 0),
(74, 11, 75, 0, 'weibo_qiutierlai', '/images/user.png', '谁把它丢在风里', '2018-02-06 10:06:19', 0),
(75, 11, 75, 74, 'weibo_qiutierlai', '/images/user.png', '我也会给她看相片', '2018-02-06 10:07:20', 0),
(76, 11, 75, 0, 'weibo_qiutierlai', '/images/user.png', '给她讲同桌的你', '2018-02-06 10:07:33', 0),
(77, 11, 75, 0, 'weibo_qiutierlai', '/images/user.png', '从前的日子都远去', '2018-02-06 10:07:47', 0),
(78, 9, 75, 0, 'weibo_qiutierlai', '/images/user.png', '小狗挺可爱', '2018-02-06 11:00:17', 0),
(79, 9, 75, 63, 'weibo_qiutierlai', '/images/user.png', '对啊，超可爱的', '2018-02-06 11:00:29', 0),
(80, 9, 77, 0, '小明', '/images/user.png', '厉害了我的狗', '2018-02-07 07:19:00', 0),
(81, 9, 77, 0, '小明', '/images/user.png', '这么萌的', '2018-02-07 07:19:14', 0),
(82, 9, 77, 0, '小明', '/images/user.png', '你猜猜', '2018-02-07 07:19:27', 0),
(83, 9, 77, 0, '小明', '/images/user.png', '第二次', '2018-02-07 07:19:32', 0),
(84, 9, 77, 83, '小明', '/images/user.png', '哈哈哈有点意思', '2018-02-07 07:19:54', 0),
(85, 9, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '小花花', '2018-02-07 07:29:44', 0),
(86, 9, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '第二次', '2018-02-07 07:29:50', 0),
(87, 9, 76, 86, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '有延迟，不知道为什么', '2018-02-07 07:32:28', 0),
(88, 114, 77, 0, '小明', '/images/user.png', '你好啊', '2018-02-14 15:59:56', 0),
(89, 114, 77, 0, '小明', '/images/user.png', '我叫小明', '2018-02-14 16:00:01', 0),
(90, 117, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '打击乐队好帅气', '2018-02-25 07:10:47', 0),
(91, 117, 76, 0, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '怎么能这么厉害', '2018-02-25 07:10:56', 0),
(92, 117, 76, 91, '小花', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '就是就是', '2018-02-25 07:11:10', 0),
(93, 64, 76, 0, '闪闪2', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '刚好', '2018-02-26 03:28:04', 0),
(94, 49, 77, 0, '小明', '/images/user.png', '长得和小猫好像啊', '2018-02-26 08:12:03', 0),
(95, 49, 77, 0, '小明', '/images/user.png', '我也这么觉得\n', '2018-02-26 08:12:12', 0),
(96, 49, 77, 0, '小明', '/images/user.png', '你看看是不是', '2018-02-26 08:12:30', 0),
(97, 49, 75, 0, 'weibo_qiutierlai', '/images/user.png', '柴柴柴柴柴柴小柴犬', '2018-02-26 08:17:19', 0),
(98, 49, 75, 0, 'weibo_qiutierlai', '/images/user.png', '小柴就是可爱', '2018-02-26 08:17:30', 0),
(99, 49, 75, 0, 'weibo_qiutierlai', '/images/user.png', '为什么', '2018-02-26 08:25:25', 0),
(100, 49, 75, 0, 'weibo_qiutierlai', '/images/user.png', '小柴柴，可爱爱', '2018-02-26 08:25:36', 0),
(101, 49, 75, 0, 'weibo_qiutierlai', '/images/user.png', '好想养一只', '2018-02-26 08:26:06', 0),
(102, 117, 77, 0, '小明', '/images/user.png', '好棒的', '2018-02-28 01:46:13', 0),
(103, 117, 77, 91, '小明', '/images/user.png', '对吧我也这么觉得', '2018-02-28 01:46:24', 0),
(106, 75, 117, 0, '小灰灰', '/images/user.png', 'DSA ', '2018-02-28 06:37:13', 0),
(107, 60, 117, 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg', '好看，期待', '2018-02-28 07:19:38', 0),
(108, 117, 117, 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg', '好好听', '2018-02-28 13:04:29', 0),
(109, 117, 117, 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg', '真是开心', '2018-02-28 13:04:47', 0),
(110, 117, 117, 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg', '天天打豆豆', '2018-02-28 13:05:04', 0),
(111, 117, 117, 0, '小灰灰', '/uploads/20180228/0148394ded8747bd3057abf4f7a453d4.jpg', '吃饭睡觉', '2018-02-28 13:05:21', 0),
(122, 38, 116, 0, '闪闪2', '/images/user.png', '闪闪', '2018-03-01 00:51:06', 0),
(123, 38, 116, 0, '闪闪2', '/images/user.png', 'sssss', '2018-03-01 00:51:11', 0),
(124, 117, 116, 0, '闪闪2', '/images/user.png', '得到', '2018-03-01 00:53:53', 0),
(125, 117, 116, 102, '闪闪2', '/images/user.png', '呃呃呃', '2018-03-01 00:54:14', 0),
(126, 115, 117, 0, '小灰灰', '/uploads/20180228/faa21493b5df8f9c63e7c43ec20da570.jpg', '非常好', '2018-03-01 05:46:44', 0),
(127, 115, 117, 0, '小灰灰', '/uploads/20180228/faa21493b5df8f9c63e7c43ec20da570.jpg', '很不错', '2018-03-01 05:46:49', 0),
(128, 115, 117, 127, '小灰灰', '/uploads/20180228/faa21493b5df8f9c63e7c43ec20da570.jpg', '可以', '2018-03-01 05:46:57', 0),
(129, 119, 116, 0, '闪闪2', '/images/user.png', 'ff', '2018-03-01 06:14:44', 0),
(130, 115, 75, 0, 'weibo_qiutierlai', '/images/user.png', 'jintian', '2018-03-01 09:13:50', 0);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_res`
--

CREATE TABLE `vedio_res` (
  `id` int(11) NOT NULL COMMENT '视频的id索引',
  `title` varchar(32) NOT NULL COMMENT '视频的标题',
  `src` varchar(100) NOT NULL COMMENT '视频的外链路径，不含域名',
  `pic` varchar(100) NOT NULL COMMENT '封面的外链路径，不含域名',
  `time_long` varchar(32) NOT NULL COMMENT '视频的时长',
  `label` varchar(100) DEFAULT NULL COMMENT '视频的标签',
  `content` varchar(1000) DEFAULT NULL COMMENT '视频的简介',
  `sid` int(11) NOT NULL COMMENT '所属小版块的id',
  `up_name` varchar(32) NOT NULL COMMENT '上传人的姓名',
  `up_id` int(11) NOT NULL,
  `up_photo` varchar(100) NOT NULL COMMENT '上传人的头像',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `report_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `click_num` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `like_num` int(11) NOT NULL DEFAULT '0' COMMENT '点赞量',
  `is_pass` tinyint(4) NOT NULL DEFAULT '1' COMMENT '审核状态（1=展示，0=封禁回收）',
  `is_pay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否付费（1=需要付费，0=不需要付费）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `vedio_res`
--

INSERT INTO `vedio_res` (`id`, `title`, `src`, `pic`, `time_long`, `label`, `content`, `sid`, `up_name`, `up_id`, `up_photo`, `create_time`, `report_num`, `click_num`, `like_num`, `is_pass`, `is_pay`) VALUES
(8, '马卡龙的崛起-拍了8天，有点昏', 'Fpe6PFstcBGS9Riy-hayoYVn65Sx', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fpe6PFstcBGS9Riy-hayoYVn65Sx', '0:0:9', NULL, NULL, 12, '小花', 76, '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '2018-02-05 06:12:08', 0, 10, 1, 1, 1),
(9, '狗狗竟跟着音乐社会摇！萌翻了', 'Fjs5A8JrPdTE9EDOJXniYMi0UEYA', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fjs5A8JrPdTE9EDOJXniYMi0UEYA', '0:0:9', '狗+++萌宠+++音乐+++', '可爱的小狗狗跟着音乐摇摆', 13, '小花', 76, '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '2018-02-05 06:13:04', 11, 44, 0, 1, 0),
(10, '航班解禁手机，方便与安静如何兼得？', 'lmMBsDvRNZLpVLXnzX0T8yQUxsh1', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lmMBsDvRNZLpVLXnzX0T8yQUxsh1', '0:0:47', '飞机+++手机+++航班+++解禁+++', '终于可以在飞机上玩手机了，然而，事情真的这么简单吗', 6, '小花', 76, '/uploads/20180204\\cd3ae108261168122480c35dd34759d4.png', '2018-02-05 06:15:00', 3, 26, 0, 1, 0),
(11, '武汉潮流街拍，美女小姐姐们的穿搭很实用呀', 'FkLbb6gQeFhUyN4sPKaQBygrGiuK', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FkLbb6gQeFhUyN4sPKaQBygrGiuK', '0:0:49', '街拍+++潮流+++小姐姐+++穿搭+++', '如何才能美美的上街呢，来看看这些小姐姐是如何穿搭的吧', 10, '小花', 76, '/images/user.png', '2018-02-05 06:17:31', 53, 722, 5, 1, 1),
(12, '冬日养生局', 'FhLAV2FePiSzroR8PIJ8BRK-4S-U', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhLAV2FePiSzroR8PIJ8BRK-4S-U', '0:0:29', '养生+++生活+++', NULL, 72, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:30:59', 0, 2, 0, 0, 0),
(13, '冬日养生局', 'FhLAV2FePiSzroR8PIJ8BRK-4S-U', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhLAV2FePiSzroR8PIJ8BRK-4S-U', '0:0:29', '养生+++冬天+++', NULL, 72, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:34:51', 0, 4, 0, 1, 0),
(14, '《氪星》2018年最新超人美剧预告片', 'FtRXKDNzKqbwBtlNhwHi2W6URo2h', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FtRXKDNzKqbwBtlNhwHi2W6URo2h', '0:0:35', '氪星+++超人+++美剧+++预告片+++2018+++', NULL, 76, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:35:42', 0, 8, 0, 1, 0),
(15, '【Barbara Palvin】Bts ', 'FnHmtbaeEeWBzT7xyBF-qM8FBe2D', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnHmtbaeEeWBzT7xyBF-qM8FBe2D', '0:1:10', NULL, NULL, 7, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:36:13', 0, 2, 0, 1, 0),
(16, '今天吃什么——番茄鸡蛋面', 'lhl6fe2lwTbMsVRLheP_KzntgTUV', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lhl6fe2lwTbMsVRLheP_KzntgTUV', '0:1:17', '番茄鸡蛋面+++美食+++日常+++', NULL, 12, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:37:39', 0, 0, 0, 0, 0),
(17, 'TROYE SIVAN 你戳闲聊', 'locqorx4tpajLRit5v4R7B0ter00', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/locqorx4tpajLRit5v4R7B0ter00', '0:0:56', NULL, NULL, 75, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:38:36', 0, 4, 0, 1, 0),
(19, '《烟花》终于定档啦！12.01“私奔”', 'ljEwh0zXkR05yZ_m_qs7fbq2ziEB', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ljEwh0zXkR05yZ_m_qs7fbq2ziEB', '0:1:37', '烟花+++预告片+++', NULL, 76, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 15:59:55', 0, 4, 0, 1, 0),
(20, '单身狗就应该好好吃饭', 'Fqco6RsoCAkj9otaRpEVECIwUPoW', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fqco6RsoCAkj9otaRpEVECIwUPoW', '0:1:0', '单身狗+++搞笑+++', '又一次对单身狗的暴击，单身狗们到底做错了什么', 74, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:00:38', 0, 2, 0, 0, 0),
(21, '我很丑可是我很温柔', 'lumnvziSW2h0VeGd604zKVt6YrLA', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lumnvziSW2h0VeGd604zKVt6YrLA', '0:1:35', '华晨宇+++改编+++', '【华晨宇】赵传看花花改编《我很丑可是我很温柔》：最喜欢这个版本！', 74, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:01:47', 0, 0, 0, 1, 0),
(22, '许魏洲-把野心留在路上', 'Fom36zk2SlETTwqzgl3gJUJ9Wzr4', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fom36zk2SlETTwqzgl3gJUJ9Wzr4', '0:0:55', '许魏洲+++', '【时尚】许魏洲 so Figaro 把野心留在路上', 7, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:02:29', 0, 4, 0, 1, 0),
(23, '在宿舍电烤串', 'FhSzw8gZV94vLBhRYuxTzmqxdVDA', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhSzw8gZV94vLBhRYuxTzmqxdVDA', '0:0:21', '烤串+++宿舍+++好吃+++', '【宿舍美食】在宿舍电烤串，吃好吃的姿势要骚', 12, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:03:01', 0, 4, 0, 1, 0),
(24, '国货种草正经的开箱视频', 'lqEXkv_L9yir5kY3I_HnbqlkUAqW', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lqEXkv_L9yir5kY3I_HnbqlkUAqW', '0:1:13', '化妆品+++', '39块钱买不了吃亏，买不了上当，国货种草正经的开箱视频', 8, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:03:45', 0, 10, 0, 1, 0),
(25, '2017年我做过的料理', 'FrMotGQPpy6cNxO4Ca3YT4RW4tMG', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FrMotGQPpy6cNxO4Ca3YT4RW4tMG', '0:0:34', '美食+++料理+++2017+++', NULL, 12, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:04:20', 0, 0, 0, 1, 0),
(26, '战斗民族零下25度浇冰水表示完全不虚', 'lvgS4-EiFLkUO9nnPfb5JJJAb5jP', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lvgS4-EiFLkUO9nnPfb5JJJAb5jP', '0:1:29', '玩雪+++', '中天新闻　玩雪花招千百种　战斗民族零下25度浇冰水表示完全不虚', 71, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:05:19', 0, 4, 0, 1, 0),
(27, 'adidas创造者代表大会', 'lgMTJPdDg1LP42cSSMRjHVHYQN8h', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lgMTJPdDg1LP42cSSMRjHVHYQN8h', '0:1:0', 'adidas+++', 'adidas Sport17 创造者代表大会', 7, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:06:11', 0, 0, 0, 1, 0),
(28, '橘猫不愿意起床', 'FmHt7MxpkZZsLLjeF915jpVpk88K', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FmHt7MxpkZZsLLjeF915jpVpk88K', '0:0:15', '橘猫+++起床+++', '被叫醒，但是不愿起床的你   橘橘', 13, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:06:54', 0, 4, 0, 1, 0),
(29, '彩虹六号：围攻Outbreak预告片', 'lvbA1OfK0QanGFACr3g112LjdNCc', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lvbA1OfK0QanGFACr3g112LjdNCc', '0:1:38', '彩虹六号+++围攻+++预告片+++', '彩虹六号：围攻 官方Outbreak预告片 太空舱', 76, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:08:09', 0, 12, 0, 1, 0),
(30, '柴碧云优雅中见叛逆', 'ljq2fIaIv7O0BNBMB9QD-RoO-ToI', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ljq2fIaIv7O0BNBMB9QD-RoO-ToI', '0:1:16', NULL, '从《夏至未至》到《悲伤逆流成河》，柴碧云优雅中见叛逆', 7, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:08:52', 0, 0, 0, 1, 0),
(32, '三人行_结伴去嗦粉', 'lu9lzLTMdX8FWZjv7sgI4DgZikOX', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lu9lzLTMdX8FWZjv7sgI4DgZikOX', '0:1:0', '螺蛳粉+++', '第一次吃螺狮粉_三人行_结伴去嗦粉', 12, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:10:08', 0, 8, 0, 1, 0),
(33, '盯！是道德的沦丧还是猫性的缺失', 'FpfqbeYOz0tbg3DvCQn4dY1FIC2O', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FpfqbeYOz0tbg3DvCQn4dY1FIC2O', '0:0:34', '撸猫+++日常+++有趣+++', '盯！是道德的沦丧还是猫性的缺失。。。。', 13, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:10:47', 0, 8, 0, 1, 0),
(34, '撩妹得这样！', 'FjRur1BOU1eNczTPbDgTy1g1pt5K', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FjRur1BOU1eNczTPbDgTy1g1pt5K', '0:1:2', '撩妹+++单身+++教程+++', '撩妹得这样！要不然会处处碰壁哦！', 72, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:11:43', 0, 2, 0, 1, 0),
(35, '《毒液》2018首支预告片', 'FurRpQ7ZK-sP_RMdNzV-0gJ1_xSf', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FurRpQ7ZK-sP_RMdNzV-0gJ1_xSf', '0:1:11', '毒液+++电影+++预告片+++2018+++', '漫威系列电影《毒液》2018首支预告片', 76, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:13:01', 0, 6, 0, 1, 0),
(36, '猫猫换牙了', 'FhnxWXqNPSH_FkywUtuX7-SDa8QM', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhnxWXqNPSH_FkywUtuX7-SDa8QM', '0:0:27', '猫猫+++换牙+++', '猫猫换牙了，看到手就忍不住一遍啃一遍舔', 13, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:13:41', 0, 8, 0, 1, 0),
(37, '面具男梦幻单杠舞步', 'FnhaucGVe-CGPbNKU_KBlg8pjObL', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnhaucGVe-CGPbNKU_KBlg8pjObL', '0:0:38', NULL, '面具男梦幻单杠舞步，年轻人就该这么有活力', 9, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:14:18', 0, 2, 0, 1, 0),
(38, '男人内心戏十足的护肤保养体验！', 'lmuNuRDumf4T7TGpHWXaOjLP9sFT', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lmuNuRDumf4T7TGpHWXaOjLP9sFT', '0:1:33', '男士+++护肤+++保养+++', '男士也要注意保养，尤其是皮肤养护哦', 8, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:15:59', 2, 11, 0, 1, 0),
(39, '怕孙子输液冷爷爷口暖输液管', 'lochohRfAuOKGCPHt4JlpXVCybMG', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lochohRfAuOKGCPHt4JlpXVCybMG', '0:1:12', '输液+++医护+++', '怕孙子输液冷爷爷口暖输液管，医护人员不提倡或影响药效', 6, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:16:39', 0, 2, 0, 1, 0),
(40, '碰到你不是心仪女生喜欢的人的时候……', 'FvkJiUjYeeKbEMbbrsKMIXOgMwAH', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FvkJiUjYeeKbEMbbrsKMIXOgMwAH', '0:0:54', '追女生+++', '碰到你不是心仪女生喜欢的人的时候，如果让她喜欢上你！', 72, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:17:59', 0, 0, 0, 1, 0),
(41, '皮卡皮丘吃汉堡', 'Fr68LctwhGfYwgWBcCCmvw13yQVb', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fr68LctwhGfYwgWBcCCmvw13yQVb', '0:0:14', NULL, NULL, 11, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:18:23', 0, 0, 0, 1, 0),
(43, '狗年新春系列棒球夹克', 'lm3Ig_YdKyA_cXypRcsru-vDju4N', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lm3Ig_YdKyA_cXypRcsru-vDju4N', '0:1:21', '明星+++狗年+++新春+++', '宋威龙、王俊凯、刘昊然都穿过的狗年新春系列棒球夹克，到底好在哪', 7, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:20:09', 0, 2, 0, 1, 0),
(44, '妖猫传日版预告片', 'lrUJ56hmquhZVkWJbBjDeht-PaNa', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lrUJ56hmquhZVkWJbBjDeht-PaNa', '0:1:32', '妖猫传+++日版+++预告片+++', NULL, 76, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:20:40', 0, 14, 1, 1, 0),
(45, '英国首相访华，伦敦年轻人这样看', 'lu7Ly94tjayRriJv7DBpYJQLbjOb', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lu7Ly94tjayRriJv7DBpYJQLbjOb', '0:1:30', NULL, '英国首相特雷莎·梅访华 伦敦年轻人这样看', 71, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-06 16:21:20', 0, 2, 0, 1, 0),
(49, '主人假装放了狗粮，结果小柴……', 'Fj7O9_7Se5HOjDw5v5_qg06WGa4w', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fj7O9_7Se5HOjDw5v5_qg06WGa4w', '0:0:49', '柴犬+++狗粮+++', '主人假装放了狗粮，结果小柴真的认真吃起来……', 13, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-07 03:35:02', 8, 182, 8, 1, 1),
(50, '时政要闻 市委副书记代市长蔡奇开展调研', 'FgpfvFoPNEfiY_QgA7SPeId2_GDt', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FgpfvFoPNEfiY_QgA7SPeId2_GDt', '0:1:35', '时政要闻+++北京+++市委副书记+++', '[北京您早]时政要闻 市委副书记代市长蔡奇开展调研', 70, '小明', 77, '/images/user.png', '2018-02-07 15:15:26', 0, 0, 0, 1, 0),
(51, '《爱情碟中谍》预告片', 'Fqal-o78-CkUlfNtpcoTmFVKOGMo', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fqal-o78-CkUlfNtpcoTmFVKOGMo', '0:0:58', '爱情碟中谍+++预告片+++', '《爱情碟中谍》预告片', 76, '小明', 77, '/images/user.png', '2018-02-07 15:16:02', 0, 0, 0, 1, 0),
(52, '《房客》 (2018)超清预告片', 'lrb5_kwbb9eIV-cbhCtdqqP77kGm', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lrb5_kwbb9eIV-cbhCtdqqP77kGm', '0:1:33', NULL, '《房客》The Lodgers (2018)超清预告片[高清版', 76, '小明', 77, '/images/user.png', '2018-02-07 15:16:48', 0, 0, 0, 1, 0),
(53, '杨澜访谈各国领袖各界精英 呈现一场思想的', 'FuoGSrkne8QJ2Qhsy9noSfhIB8RF', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FuoGSrkne8QJ2Qhsy9noSfhIB8RF', '0:1:0', '杨澜+++访谈+++G20+++', '《风云际会-G20杨澜访谈录片花》杨澜访谈各国领袖各界精英 呈现一场思想的盛宴', 75, '小明', 77, '/images/user.png', '2018-02-07 15:18:14', 0, 0, 0, 1, 0),
(54, '《隔壁的女孩》超清预告片', 'lql_vvP7rexF0W7Z_o8XNcHUR9SI', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lql_vvP7rexF0W7Z_o8XNcHUR9SI', '0:1:18', NULL, '《隔壁的女孩》超清预告片', 76, '小明', 77, '/images/user.png', '2018-02-07 15:18:52', 0, 0, 0, 1, 0),
(55, '《闺蜜2》2018超清预告片抢先看', 'lkfpLADccswdlhpR0w08zJbnDEE0', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lkfpLADccswdlhpR0w08zJbnDEE0', '0:1:8', '闺蜜2+++电影+++预告+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:19:41', 0, 0, 0, 1, 0),
(56, '《两个女人》预告片  正妻迷上小三', 'FlpXTM2hNiGjdjf-hU6JPcFrHXa8', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FlpXTM2hNiGjdjf-hU6JPcFrHXa8', '0:1:37', '两个女人+++预告片+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:20:15', 0, 10, 0, 1, 0),
(57, '《美食奇缘》片花-美食与爱情完美邂逅', 'FiFM5fNP-p3uR2AYW4goqAHaeT95', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FiFM5fNP-p3uR2AYW4goqAHaeT95', '0:1:33', '美食奇缘+++片花+++', '《美食奇缘》片花-美食与爱情完美邂逅', 74, '小明', 77, '/images/user.png', '2018-02-07 15:24:31', 0, 0, 0, 1, 0),
(58, '《蚯蚓》2017超清预告片抢先看', 'lr2tvnDp8axaSfGTDJQ6dALPccBn', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lr2tvnDp8axaSfGTDJQ6dALPccBn', '0:1:14', NULL, NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:25:00', 0, 0, 0, 1, 0),
(59, '《曲率》Curvature (2018)', 'llKfy118sgG2vG-WTzClYSeT3Uai', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/llKfy118sgG2vG-WTzClYSeT3Uai', '0:1:39', '曲率+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:25:45', 0, 0, 0, 1, 0),
(60, '《杀无赦》2018超清预告片抢先看', 'ltQSXI2rBsBmAju1TgXKteRjfxcU', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ltQSXI2rBsBmAju1TgXKteRjfxcU', '0:1:27', '杀无赦+++预告+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:26:28', 0, 2, 0, 1, 0),
(61, '《塔利》Tully (2018)超清预告', 'ltnHNca0vxvkiS7BTxMjNIfTj_Nu', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ltnHNca0vxvkiS7BTxMjNIfTj_Nu', '0:1:37', NULL, '《塔利》Tully (2018)超清预告片', 76, '小明', 77, '/images/user.png', '2018-02-07 15:27:14', 0, 14, 0, 1, 0),
(62, '《偷窥438》选择版预告片', 'FknCkJND9xSFKm9DX5XNUN_kRE2O', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FknCkJND9xSFKm9DX5XNUN_kRE2O', '0:0:45', NULL, NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:28:10', 0, 0, 0, 1, 0),
(63, '《兄弟的女人》超清先行预告片', 'loWCxyAtlzQ0oOAQXQTjoGKCURwm', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/loWCxyAtlzQ0oOAQXQTjoGKCURwm', '0:1:8', '兄弟的女人+++预告片+++', '《兄弟的女人》超清先行预告片', 76, '小明', 77, '/images/user.png', '2018-02-07 15:28:47', 0, 6, 0, 1, 0),
(64, 'All The Things 一切_所有', 'FnRHk7bInycaUN2Os6KOS1QkLVIY', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnRHk7bInycaUN2Os6KOS1QkLVIY', '0:1:34', '短片+++创意+++时尚+++', '时尚创意短片 All The Things 一切_所有的事', 74, '小明', 77, '/images/user.png', '2018-02-07 15:29:41', 1, 8, 0, 1, 0),
(65, '实用美妆技巧 睫毛膏的画法', 'FiCR9ywTGmmrMsingFeLLXBkMbDe', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FiCR9ywTGmmrMsingFeLLXBkMbDe', '0:1:9', NULL, '【大幕七十二变】实用美妆技巧 睫毛膏的画法', 8, '小明', 77, '/images/user.png', '2018-02-07 15:30:14', 0, 2, 0, 1, 0),
(66, 'Buck工作室超炫酷短片', 'Frg13f-5pqY7N34-UoxnMW46vHMX', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Frg13f-5pqY7N34-UoxnMW46vHMX', '0:1:51', '短片+++动画+++酷炫+++', '【动画短片】Buck工作室超炫酷短片', 74, '小明', 77, '/images/user.png', '2018-02-07 15:30:57', 0, 2, 0, 1, 0),
(67, '【动画短片】黑与白，光与影', 'FlxjckGwYTOyFNMDGMTsc4D1h_kx', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FlxjckGwYTOyFNMDGMTsc4D1h_kx', '0:1:15', NULL, NULL, 74, '小明', 77, '/images/user.png', '2018-02-07 15:31:43', 0, 0, 0, 1, 0),
(68, '【动画短片】危险靠近', 'lvue4EESKNcAQ2xvzbBZjYuIYKXH', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lvue4EESKNcAQ2xvzbBZjYuIYKXH', '0:1:15', '动画片+++', NULL, 74, '小明', 77, '/images/user.png', '2018-02-07 15:32:14', 0, 0, 0, 1, 0),
(69, '【快乐氰化物短片】过敏', 'FqB5TNUvRrNUxx4o_yL52PCXNjW9', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FqB5TNUvRrNUxx4o_yL52PCXNjW9', '0:1:30', '氰化物+++', '【快乐氰化物短片】过敏.', 74, '小明', 77, '/images/user.png', '2018-02-07 15:32:44', 0, 2, 0, 1, 0),
(70, '装嫩减龄妆，30岁重回20岁', 'lqjz7oASqdE9g_s3D6GxjLGMUU3T', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lqjz7oASqdE9g_s3D6GxjLGMUU3T', '0:2:3', '美妆+++装嫩+++减龄+++', '【快美妆】装嫩减龄妆，30岁重回20岁', 8, '小明', 77, '/images/user.png', '2018-02-07 15:33:30', 0, 2, 0, 1, 0),
(71, '鼻子直挺的妙招，高光的X种替代方法', 'lsCsM2b-ekVqrefmSXGJQcawjFO0', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lsCsM2b-ekVqrefmSXGJQcawjFO0', '0:1:48', '美妆师贝拉+++鼻子+++高光+++', '【美妆师贝拉】鼻子直挺的妙招，高光的X种替代方法', 8, '小明', 77, '/images/user.png', '2018-02-07 15:38:39', 0, 0, 0, 1, 0),
(72, '闪电变V脸！修容的x种替代方法', 'lrjUuIHnB0tJ7OQrgEsPzSknIuCt', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lrjUuIHnB0tJ7OQrgEsPzSknIuCt', '0:1:43', '美妆师贝拉+++V脸+++修容+++', '闪电变V脸！修容的x种替代方法', 8, '小明', 77, '/images/user.png', '2018-02-07 15:41:12', 0, 6, 1, 1, 0),
(73, '泰国彩妆品牌推荐来咯~', 'lr1mB93vjWwK7lwNOtMzU0e6Vow7', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lr1mB93vjWwK7lwNOtMzU0e6Vow7', '0:1:43', '美妆师贝拉+++彩妆+++品牌+++泰国+++推荐+++', '【美妆师贝拉】泰国彩妆品牌推荐来咯~', 8, '小明', 77, '/images/user.png', '2018-02-07 15:42:08', 0, 0, 0, 1, 0),
(74, '字母腮红画法、简单方法画美美腮红', 'lndkcZNsQ2ggsMSuvIXLmy8P661Q', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lndkcZNsQ2ggsMSuvIXLmy8P661Q', '0:1:33', '美妆师贝拉+++腮红+++', '【美妆师贝拉】字母腮红画法、简单方法画美美腮红', 8, '小明', 77, '/images/user.png', '2018-02-07 15:42:58', 0, 0, 0, 1, 0),
(75, '【萌宠】每日一狗', 'Ft8wAmHrg5my0lO34a6wU9uaiPiZ', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Ft8wAmHrg5my0lO34a6wU9uaiPiZ', '0:0:48', '萌宠+++狗+++', NULL, 13, '小明', 77, '/images/user.png', '2018-02-07 15:44:03', 0, 2, 0, 1, 0),
(76, '张碧晨杨宗纬合唱凉凉的真正原因曝光', 'lotmmeJixtt7Tug96qImrrsMpr0L', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lotmmeJixtt7Tug96qImrrsMpr0L', '0:1:54', '访谈+++女老诗+++', '【女老诗访谈】张碧晨杨宗纬合唱凉凉的真正原因曝光', 75, '小明', 77, '/images/user.png', '2018-02-07 15:44:59', 0, 0, 0, 1, 0),
(77, '『橘子冰的日常』－ 霸占床位时间', 'lrwzf3ANwBIrAis4zY58h5YXwPe-', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lrwzf3ANwBIrAis4zY58h5YXwPe-', '0:1:35', '橘猫+++', NULL, 11, '小明', 77, '/images/user.png', '2018-02-07 15:45:42', 0, 0, 0, 1, 0),
(78, '绘聚2016德国韦多俪亚星光璀璨颁奖盛典', 'lr7Nf0C5hL_F_vz-JW9WZbzxOQOI', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lr7Nf0C5hL_F_vz-JW9WZbzxOQOI', '0:1:54', '时尚+++资讯+++', NULL, 7, '小明', 77, '/images/user.png', '2018-02-07 15:46:49', 0, 0, 0, 1, 0),
(79, '人民生活丰富多彩 嗨翻天', 'Frw0gRSfRkBdJ3JQkZ41XO7gzkJa', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Frw0gRSfRkBdJ3JQkZ41XO7gzkJa', '0:1:3', '榆次+++', NULL, 6, '小明', 77, '/images/user.png', '2018-02-07 15:47:33', 0, 0, 0, 1, 0),
(80, '埃及：临时政府内阁宣布辞职', 'FkwxtpcZ4KyAe8QKnPXa-kS2mdDX', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FkwxtpcZ4KyAe8QKnPXa-kS2mdDX', '0:0:51', NULL, NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 15:48:04', 0, 0, 0, 1, 0),
(81, '埃及：临时政府新内阁宣誓就职', 'FplPVYxAZ5KC1Ew8MvK67ldRo1nz', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FplPVYxAZ5KC1Ew8MvK67ldRo1nz', '0:0:51', NULL, NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 15:48:37', 0, 0, 0, 1, 0),
(82, '巴西：临时政府宣布首批经济措施', 'FhzqAKvhSHDFgMavrq7Qch_sOEuC', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhzqAKvhSHDFgMavrq7Qch_sOEuC', '0:0:57', NULL, NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 15:49:14', 0, 0, 0, 1, 0),
(83, '北京：部分民生涉外公证缩短出证时间', 'Fps94HrkTXbM0xnvAjIxXWdPwwZS', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fps94HrkTXbM0xnvAjIxXWdPwwZS', '0:0:16', '涉外公证+++', NULL, 6, '小明', 77, '/images/user.png', '2018-02-07 15:49:49', 0, 0, 0, 1, 0),
(84, '北京“两会”时政要闻', 'FnAc7AuCNo3lxseVJZcZmH4U9VVB', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnAc7AuCNo3lxseVJZcZmH4U9VVB', '0:1:4', '两会+++要闻+++', '北京“两会”时政要闻', 70, '小明', 77, '/images/user.png', '2018-02-07 15:50:21', 0, 0, 0, 1, 0),
(85, '肠胃不好日常该吃些什么', 'FvG4fl4aTMnixWjgclEXJAunKYpE', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FvG4fl4aTMnixWjgclEXJAunKYpE', '0:0:56', '肠胃调理+++', NULL, 72, '小明', 77, '/images/user.png', '2018-02-07 15:50:54', 0, 0, 0, 1, 0),
(86, '唱说天下：那些“戏精”萌宠们', 'ltr4HwCbtOdKY6jeMMg1TKKeyfY-', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ltr4HwCbtOdKY6jeMMg1TKKeyfY-', '0:1:28', '戏精+++', NULL, 13, '小明', 77, '/images/user.png', '2018-02-07 15:51:41', 0, 0, 0, 1, 0),
(87, '地铁上的奇葩日常', 'FiXPMtUl8PI1pifKJC-525FjJi53', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FiXPMtUl8PI1pifKJC-525FjJi53', '0:1:39', '办公室小野+++', '-地铁上的奇葩日常', 11, '小明', 77, '/images/user.png', '2018-02-07 15:52:23', 0, 0, 0, 1, 0),
(88, '《秘密爱》预告片', 'ljJnHif_pjTMl0RHQCAzmsIkroQs', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ljJnHif_pjTMl0RHQCAzmsIkroQs', '0:1:46', '秘密爱+++预告+++电影+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:53:42', 0, 0, 0, 1, 0),
(89, '非洲小僵尸五种方言教你怎么被采访？', 'FngXjqN9UIXU7jRUakWEpZZ67o-D', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FngXjqN9UIXU7jRUakWEpZZ67o-D', '0:0:51', '僵小鱼+++日常+++', '非洲小僵尸五种方言教你怎么被采访？ 僵小鱼日常', 11, '小明', 77, '/images/user.png', '2018-02-07 15:54:20', 0, 0, 0, 1, 0),
(90, '股民的日常_接盘虾的悲剧人生', 'Fky8FyT0i2pSDo1alCncRhs3kZ0G', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fky8FyT0i2pSDo1alCncRhs3kZ0G', '0:0:25', '股民+++接盘+++悲剧+++', NULL, 11, '小明', 77, '/images/user.png', '2018-02-07 15:54:58', 0, 0, 0, 1, 0),
(91, '《迁化》 (2018)超清预告片', 'lq9neHCjDjrlgKASIW4SzifZrahJ', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lq9neHCjDjrlgKASIW4SzifZrahJ', '0:1:33', '迁化+++韩国+++电影+++预告+++', '韩国电影《迁化》 (2018)超清预告片', 76, '小明', 77, '/images/user.png', '2018-02-07 15:55:53', 0, 2, 0, 1, 0),
(92, '进藏(预告片)', 'Fj0h6-emsbO_1zADOo1QaFu0r_2L', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fj0h6-emsbO_1zADOo1QaFu0r_2L', '0:1:1', '进藏+++', NULL, 76, '小明', 77, '/images/user.png', '2018-02-07 15:56:34', 0, 0, 0, 1, 0),
(93, '萌宠冰上耍 爪下真打滑', 'Ft75FK9fF30G6YFohdjmXDUW4jMH', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Ft75FK9fF30G6YFohdjmXDUW4jMH', '0:1:2', '萌宠+++玩耍+++打滑+++', '萌宠冰上耍 爪下真打滑', 13, '小明', 77, '/images/user.png', '2018-02-07 15:57:17', 0, 0, 0, 1, 0),
(94, '萌宠画风突变！论BGM的重要性', 'FtthnMv7IGzUSWEXdJgMxKVjB9M_', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FtthnMv7IGzUSWEXdJgMxKVjB9M_', '0:0:58', NULL, NULL, 13, '小明', 77, '/images/user.png', '2018-02-07 15:57:47', 0, 0, 0, 1, 0),
(95, '男子发狂 砍伤两民警', 'ls-KQezA2aIeR7IK9sYP6DfgML1g', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/ls-KQezA2aIeR7IK9sYP6DfgML1g', '0:2:37', NULL, '-民生一拨通 北京：男子发狂 砍伤两民警', 6, '小明', 77, '/images/user.png', '2018-02-07 15:58:22', 0, 0, 0, 1, 0),
(96, '6个风靡日本的美妆诀窍', 'loDUJpHBMGWmpDFpqmLQDolIIi-a', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/loDUJpHBMGWmpDFpqmLQDolIIi-a', '0:2:20', '美妆+++抹茶美妆+++', '抹茶美妆：6个风靡日本的美妆诀窍', 8, '小明', 77, '/images/user.png', '2018-02-07 15:59:07', 0, 0, 0, 1, 0),
(97, '眼影是怎样炼成的', 'FhC0HTWlTOVFMtnsxaKl6OVkdkoy', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FhC0HTWlTOVFMtnsxaKl6OVkdkoy', '0:1:23', '抹茶美妆+++眼影+++', '抹茶美妆：眼影是怎样炼成的', 8, '小明', 77, '/images/user.png', '2018-02-07 15:59:58', 0, 0, 0, 1, 0),
(98, '一分钟美妆 快速日常出门妆', 'FpczeVbx1g6ETPhqeLAiND4krK5O', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FpczeVbx1g6ETPhqeLAiND4krK5O', '0:1:53', '出门妆+++', '抹茶美妆：一分钟美妆 快速日常出门妆', 8, '小明', 77, '/images/user.png', '2018-02-07 16:00:36', 0, 0, 0, 1, 0),
(99, '二狗对话歌手李健', 'Fgp-SCDgsg-oyjOcSq4R8FZ7z3D3', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fgp-SCDgsg-oyjOcSq4R8FZ7z3D3', '0:1:47', '访谈+++女老诗+++', '女老诗访谈：二狗对话歌手李健 行走的弹幕原来是这样炼成的', 75, '小明', 77, '/images/user.png', '2018-02-07 16:01:19', 0, 0, 0, 1, 0),
(100, '歌手梁博霸气回应像小岳岳', 'FoGQTy3NkgxU6xdL3re9k4Yu7svK', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FoGQTy3NkgxU6xdL3re9k4Yu7svK', '0:1:28', '访谈+++女老诗+++', '女老诗访谈：歌手梁博霸气回应像小岳岳', 75, '小明', 77, '/images/user.png', '2018-02-07 16:01:57', 0, 0, 0, 1, 0),
(101, '三生三生十里桃花夜华君被玩坏 素素像姚晨', 'Ft3u2dQQ_DPhmK_cYvOsrBxvVLyf', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Ft3u2dQQ_DPhmK_cYvOsrBxvVLyf', '0:1:34', '访谈+++女老诗+++三生三世+++夜华+++素素+++', '女老诗访谈：三生三生十里桃花夜华君被玩坏 素素像姚晨', 75, '小明', 77, '/images/user.png', '2018-02-07 16:02:43', 0, 0, 0, 1, 0),
(102, '波波头短发 MG安森作品', 'Fu3UCJx3pdpNsMyGausa8ihW0mHC', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fu3UCJx3pdpNsMyGausa8ihW0mHC', '0:0:56', NULL, '时尚资讯 波波头短发 MG安森作品 MG复活稻草', 7, '小明', 77, '/images/user.png', '2018-02-07 16:03:12', 0, 0, 0, 1, 0),
(103, '【鹿晗生日季】26岁，想对你们说的话', 'lhThlhyGTN34zPqLczY5ywvIiJjD', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lhThlhyGTN34zPqLczY5ywvIiJjD', '0:1:51', '鹿晗+++生日+++26岁+++', NULL, 7, '小明', 77, '/images/user.png', '2018-02-07 16:04:07', 0, 0, 0, 1, 0),
(104, 'Dior迪奥咖啡厅：甜点制作', 'FnQZIv8fFr8chqFelKQpZoeNwoZK', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnQZIv8fFr8chqFelKQpZoeNwoZK', '0:0:50', '美食+++时尚+++', NULL, 12, '小明', 77, '/images/user.png', '2018-02-07 16:04:41', 0, 0, 0, 1, 0),
(105, '减肥的大敌，盘点12种高糖食物_涨姿势', 'loyZEEVSzFLUCwsg8z1gTWA7Fw8Y', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/loyZEEVSzFLUCwsg8z1gTWA7Fw8Y', '0:2:2', '美食+++时尚+++减肥+++盘点+++', '时尚资讯：减肥的大敌，盘点12种高糖食物_涨姿势', 12, '小明', 77, '/images/user.png', '2018-02-07 16:05:43', 0, 0, 0, 1, 0),
(106, '哪家咖啡店的冰咖啡最坑爹', 'FqzyWneAv4aC2IQvFZYCOmncKrCp', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FqzyWneAv4aC2IQvFZYCOmncKrCp', '0:0:58', '咖啡+++冰咖啡+++坑爹+++', NULL, 12, '小明', 77, '/images/user.png', '2018-02-07 16:06:22', 0, 0, 0, 1, 0),
(107, '原来彩虹糖叫这个名字是有原因的', 'Fls6QZzRNFx4twfY2Xf4MISD-ZzW', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fls6QZzRNFx4twfY2Xf4MISD-ZzW', '0:0:32', '彩虹糖+++涨姿势+++', '原来彩虹糖叫这个名字是有原因的！感觉这么多年彩虹糖白吃了。。。感觉买一包试起来_涨姿势', 12, '小明', 77, '/images/user.png', '2018-02-07 16:07:04', 0, 0, 0, 1, 0),
(108, '中俄蒙国际选美大赛落幕', 'Fi0KInLSa3rBzNTB72flEkISffqk', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fi0KInLSa3rBzNTB72flEkISffqk', '0:0:45', NULL, '-时尚资讯：中俄蒙国际选美大赛落幕', 7, '小明', 77, '/images/user.png', '2018-02-07 16:08:03', 0, 0, 0, 1, 0),
(109, '吴亦凡赵丽颖吴磊雨衣风来袭', 'FpHQo7ytGz-emPbB1QXIzyX9xT0R', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FpHQo7ytGz-emPbB1QXIzyX9xT0R', '0:1:14', '吴亦凡+++赵丽颖+++吴磊+++', '-时尚资讯真会玩 吴亦凡赵丽颖吴磊雨衣风来袭', 7, '小明', 77, '/images/user.png', '2018-02-07 16:08:44', 0, 0, 0, 1, 0),
(110, '希腊组建临时政府 准备六月选举', 'FiDa3VwPIij0qGfz2-Wvpet_gfMW', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FiDa3VwPIij0qGfz2-Wvpet_gfMW', '0:0:50', NULL, NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 16:09:21', 0, 0, 0, 1, 0),
(111, '探访重庆大韩民国临时政府旧址', 'lpKpadxioLRE-rS6-PL-Lf0xqCCf', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lpKpadxioLRE-rS6-PL-Lf0xqCCf', '0:1:40', '大韩民国+++临时政府+++旧址+++', NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 16:10:13', 0, 0, 0, 1, 0),
(112, '天啦噜！36D萝莉大战呆萌小僵尸', 'FnCfJpNWWYwATTPcxmtqDOLuNxUO', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FnCfJpNWWYwATTPcxmtqDOLuNxUO', '0:1:19', '僵小鱼+++日常+++', NULL, 11, '小明', 77, '/images/user.png', '2018-02-07 16:10:50', 0, 2, 0, 1, 0),
(113, '突尼斯政府承诺改善民生', 'Ftu3yPnHUCHIvdbdMAejeOMQzRmo', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Ftu3yPnHUCHIvdbdMAejeOMQzRmo', '0:0:37', NULL, NULL, 70, '小明', 77, '/images/user.png', '2018-02-07 16:11:16', 0, 2, 0, 1, 0),
(114, '鸡翅中卤蛋', 'FlanHKNRhn-bR1zqUxtW5AX5-637', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FlanHKNRhn-bR1zqUxtW5AX5-637', '0:1:3', '味库美食+++', '味库美食 _ 鸡翅中卤蛋', 12, '小明', 77, '/images/user.png', '2018-02-07 16:11:53', 2, 8, 0, 1, 0),
(115, '味库美食 _ 玫瑰凉粉', 'Fv-wqE0bn8WO71mu3o9cHE36VO4w', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fv-wqE0bn8WO71mu3o9cHE36VO4w', '0:1:6', '味库美食+++', NULL, 12, '小明', 77, '/images/user.png', '2018-02-07 16:12:40', 4, 111, 1, 1, 0),
(116, '味库美食 _ 泡椒鸡胗', 'Fqi11QM0kTo7RIOkRCR6L8rD7sWN', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/Fqi11QM0kTo7RIOkRCR6L8rD7sWN', '0:1:24', '味库美食+++', NULL, 12, '小明', 77, '/images/user.png', '2018-02-07 16:14:23', 0, 16, 0, 1, 0),
(117, '打击乐队上了浦东的新闻', 'FoAZwhZvp58yFbb0azC_LHVRuxUG', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/FoAZwhZvp58yFbb0azC_LHVRuxUG', '0:1:0', '打击乐队+++浦东+++', NULL, 6, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-25 06:44:01', 11, 62, 1, 1, 0),
(119, '三十年前印度和中国平起平坐，如今……', 'lhO1zPZGb_O6DNxTbTiGn5l05U1O', 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/lhO1zPZGb_O6DNxTbTiGn5l05U1O', '0:1:27', NULL, NULL, 70, '小花', 76, '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', '2018-02-25 07:02:27', 1, 21, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_rol`
--

CREATE TABLE `vedio_rol` (
  `rid_name` varchar(50) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';

--
-- 转存表中的数据 `vedio_rol`
--

INSERT INTO `vedio_rol` (`rid_name`, `rid`) VALUES
('普通用户', 0),
('第3方登陆人', 1),
('超级管理员', 2),
('普通管理员', 3),
('白金', 7),
('黄金', 8);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_rol_auth`
--

CREATE TABLE `vedio_rol_auth` (
  `id` int(11) NOT NULL,
  `authid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限与角色的关系表';

--
-- 转存表中的数据 `vedio_rol_auth`
--

INSERT INTO `vedio_rol_auth` (`id`, `authid`, `rid`) VALUES
(1, 30, 1),
(2, 32, 1),
(3, 24, 1),
(4, 20, 1),
(48, 6, 4),
(49, 8, 4),
(71, 1, 7),
(72, 2, 7),
(73, 4, 7),
(74, 5, 7),
(75, 6, 7),
(76, 7, 7),
(77, 8, 7),
(78, 9, 7),
(92, 1, 8),
(93, 2, 8),
(94, 4, 8),
(95, 5, 8),
(96, 6, 8),
(97, 7, 8),
(98, 8, 8),
(287, 1, 3),
(288, 4, 3),
(289, 7, 3),
(290, 8, 3),
(291, 9, 3),
(292, 10, 3),
(293, 11, 3),
(305, 1, 2),
(306, 4, 2),
(307, 7, 2),
(308, 8, 2),
(309, 9, 2),
(310, 10, 2),
(311, 11, 2),
(312, 19, 2),
(313, 20, 2),
(314, 21, 2),
(315, 22, 2),
(316, 23, 2),
(317, 24, 2),
(318, 25, 2),
(319, 26, 2),
(320, 27, 2),
(321, 31, 2),
(322, 32, 2),
(323, 33, 2),
(324, 34, 2),
(325, 35, 2),
(326, 36, 2),
(327, 37, 2),
(328, 38, 2);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_sqlclass`
--

CREATE TABLE `vedio_sqlclass` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '类别的名字',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id，为0是第一级',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `vedio_sqlclass`
--

INSERT INTO `vedio_sqlclass` (`id`, `name`, `pid`, `status`) VALUES
(1, '新闻频道', 0, 1),
(2, '时尚频道', 0, 1),
(3, '生活频道', 0, 1),
(6, '民生', 1, 1),
(7, '资讯', 2, 1),
(8, '美妆', 2, 1),
(9, '健身', 2, 0),
(10, '服饰', 2, 0),
(11, '日常 ', 3, 1),
(12, '美食 ', 3, 1),
(13, '萌宠', 3, 1),
(70, '时政', 1, 1),
(71, '国际', 1, 0),
(72, '文体', 3, 1),
(73, '影视频道', 0, 1),
(74, '短片', 73, 1),
(75, '访谈', 73, 1),
(76, '预告', 73, 1),
(80, '小酒馆', 79, 1);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_user`
--

CREATE TABLE `vedio_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(100) NOT NULL DEFAULT '/images/user.png',
  `grade` tinyint(4) NOT NULL DEFAULT '1',
  `phone` bigint(11) NOT NULL,
  `is_send` int(11) NOT NULL DEFAULT '0' COMMENT '是否发送视频',
  `is_login` int(11) NOT NULL DEFAULT '0',
  `is_speak` int(11) NOT NULL DEFAULT '0',
  `is_defirend` int(11) NOT NULL DEFAULT '0' COMMENT '是拉否黑'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户信息表';

--
-- 转存表中的数据 `vedio_user`
--

INSERT INTO `vedio_user` (`id`, `username`, `password`, `email`, `create_time`, `photo`, `grade`, `phone`, `is_send`, `is_login`, `is_speak`, `is_defirend`) VALUES
(1, '露露1', '123123', '123@qq.com', '2018-02-01 12:32:42', '/images/user.png', 1, 12345678901, 0, 0, 0, 1),
(3, '星星33', '123456', '123@qq.com', '2018-02-01 09:26:52', '/images/user.png', 1, 0, 0, 0, 0, 0),
(74, 'qq_马猴烧酒子威君', 'san', '3', '2018-02-02 14:51:45', '/images/user.png', 0, 3, 1, 0, 0, 1),
(75, 'weibo_qiutierlai', 'san', '3', '2018-02-04 14:19:35', '/images/user.png', 0, 3, 1, 0, 0, 1),
(76, '小花', '892ef6858bbbdaHVuahuaha1feb79694e1b1b32043HVhauhau', '547137968@qq.com', '2018-02-03 06:27:45', '/uploads/20180205/eaa94ce22ebd4575c384dbc646457075.png', 3, 17641266884, 0, 0, 0, 0),
(77, '小明', '1298842442dadeGliaomihb36e0acceacc644eb80d21pbmc=imoai', 'xiaoming@xx.com', '2018-02-03 06:27:45', '/uploads/20180228/6ecc646aa89c3f65d53e6fadea63d743.jpg', 1, 18379793818, 0, 0, 0, 0),
(86, '好好好', '123111', '123@qq.com', '2018-02-04 14:19:35', '/images/user.png', 2, 1843865866, 0, 0, 0, 0),
(107, '露露1', '123123', '123@qq.com', '2018-02-06 07:41:09', '/images/user.png', 1, 12345678901, 0, 0, 0, 0),
(108, '露露1', '123123', '123@qq.com', '2018-02-06 07:51:45', '/images/user.png', 2, 123456789011, 0, 0, 0, 1),
(112, '闪闪', '123456', '123@qq.com', '2018-02-06 08:18:46', '/images/user.png', 3, 123456, 0, 0, 0, 0),
(113, '冰冰', '123456', '123@qq.com', '2018-02-06 08:22:35', '/images/user.png', 3, 1345678, 0, 0, 0, 0),
(116, '闪闪2', '6c602733f386cc2hhanshhb9115b342ac71103c75fnNoYW4yhsnah', '1233', '2018-02-06 09:41:45', '/images/user.png', 2, 18556789, 0, 0, 0, 0),
(117, '小灰灰', '23474e84cd5fceGliaohuhbbc1ef3b70fd4dcd1aa92h1aWh1aQ==uhoai', '574137968@qq.com', '2018-02-28 03:17:47', '/uploads/20180228/faa21493b5df8f9c63e7c43ec20da570.jpg', 1, 13241266864, 0, 0, 0, 0),
(119, 'qq_非仙', 'san', '3', '2018-02-28 13:42:18', '/images/user.png', 0, 3, 1, 0, 0, 1),
(121, '小小', 'adcaec3805aa9MTI23456zN12c0d0b14a81bedb6ffDU265432', '12345@qq.com', '2018-03-01 00:44:50', '/images/user.png', 1, 18438628586, 0, 0, 0, 0),
(122, 'renren_武子威', 'san', '3', '2018-03-01 02:36:50', '/images/user.png', 0, 3, 1, 0, 0, 1),
(124, '闪闪', '123456', '123@qq.com', '2018-03-01 09:18:32', '/images/user.png', 7, 18438628586, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_user_rol`
--

CREATE TABLE `vedio_user_rol` (
  `zid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `vedio_user_rol`
--

INSERT INTO `vedio_user_rol` (`zid`, `id`, `rid`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 2),
(6, 6, 1),
(7, 76, 3),
(8, 8, 2),
(9, 105, 3),
(10, 106, 3),
(11, 107, 2),
(12, 108, 2),
(13, 109, 1),
(14, 110, 1),
(15, 111, 1),
(16, 112, 3),
(17, 113, 3),
(18, 114, 3),
(19, 115, 3),
(20, 116, 2),
(21, 117, 3),
(22, 118, 2),
(23, 120, 7),
(24, 123, 8),
(25, 124, 7);

-- --------------------------------------------------------

--
-- 表的结构 `vedio_xiaoxi`
--

CREATE TABLE `vedio_xiaoxi` (
  `id` int(11) NOT NULL COMMENT '接受消息人的id',
  `userid` int(11) NOT NULL COMMENT '发消息人的id',
  `xid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文本管理 消息';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vedio_auth`
--
ALTER TABLE `vedio_auth`
  ADD PRIMARY KEY (`authid`);

--
-- Indexes for table `vedio_danmu`
--
ALTER TABLE `vedio_danmu`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `vedio_list`
--
ALTER TABLE `vedio_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_liuyan`
--
ALTER TABLE `vedio_liuyan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_pay`
--
ALTER TABLE `vedio_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_reply`
--
ALTER TABLE `vedio_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_report`
--
ALTER TABLE `vedio_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_res`
--
ALTER TABLE `vedio_res`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_rol`
--
ALTER TABLE `vedio_rol`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `vedio_rol_auth`
--
ALTER TABLE `vedio_rol_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_sqlclass`
--
ALTER TABLE `vedio_sqlclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_user`
--
ALTER TABLE `vedio_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vedio_user_rol`
--
ALTER TABLE `vedio_user_rol`
  ADD PRIMARY KEY (`zid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `vedio_auth`
--
ALTER TABLE `vedio_auth`
  MODIFY `authid` int(11) NOT NULL AUTO_INCREMENT COMMENT '权限的id', AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `vedio_danmu`
--
ALTER TABLE `vedio_danmu`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT COMMENT '弹幕的id', AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `vedio_list`
--
ALTER TABLE `vedio_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `vedio_liuyan`
--
ALTER TABLE `vedio_liuyan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- 使用表AUTO_INCREMENT `vedio_pay`
--
ALTER TABLE `vedio_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '交易id', AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `vedio_reply`
--
ALTER TABLE `vedio_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `vedio_report`
--
ALTER TABLE `vedio_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- 使用表AUTO_INCREMENT `vedio_res`
--
ALTER TABLE `vedio_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '视频的id索引', AUTO_INCREMENT=124;
--
-- 使用表AUTO_INCREMENT `vedio_rol`
--
ALTER TABLE `vedio_rol`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `vedio_rol_auth`
--
ALTER TABLE `vedio_rol_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;
--
-- 使用表AUTO_INCREMENT `vedio_sqlclass`
--
ALTER TABLE `vedio_sqlclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- 使用表AUTO_INCREMENT `vedio_user`
--
ALTER TABLE `vedio_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- 使用表AUTO_INCREMENT `vedio_user_rol`
--
ALTER TABLE `vedio_user_rol`
  MODIFY `zid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
