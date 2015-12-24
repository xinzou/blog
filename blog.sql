-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-12-23 16:07:16
-- 服务器版本： 5.6.27-0ubuntu1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `cate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `tags` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pic` varchar(255) COLLATE utf8_bin DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `article_status`
--

CREATE TABLE `article_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `art_id` int(11) NOT NULL,
  `view_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth`
--

CREATE TABLE `auth` (
  `auth_label` varchar(100) NOT NULL DEFAULT '' COMMENT '权限Label',
  `auth_name` varchar(100) NOT NULL,
  `auth_type` varchar(100) NOT NULL DEFAULT '' COMMENT '权限类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth`
--

INSERT INTO `auth` (`auth_label`, `auth_name`, `auth_type`) VALUES
('BQGL_ADD', '标签管理_增加', '内容管理'),
('BQGL_DELETE', '标签管理_删除', '内容管理'),
('BQGL_EDIT', '标签管理_编辑', '内容管理'),
('BQGL_INDEX', '标签管理_查看', '内容管理'),
('DHGL_ADD', '导航管理_增加', '系统设置'),
('DHGL_DELETE', '导航管理_删除', '系统设置'),
('DHGL_EDIT', '导航管理_编辑', '系统设置'),
('DHGL_INDEX', '导航管理_查看', '系统设置'),
('FLGL_ADD', '分类管理_增加', '内容管理'),
('FLGL_DELETE', '分类管理_删除', '内容管理'),
('FLGL_EDIT', '分类管理_编辑', '内容管理'),
('FLGL_INDEX', '分类管理_查看', '内容管理'),
('JBSZ_ADD', '基本设置_增加', '系统设置'),
('JBSZ_DELETE', '基本设置_删除', '系统设置'),
('JBSZ_EDIT', '基本设置_编辑', '系统设置'),
('JBSZ_INDEX', '基本设置_查看', '系统设置'),
('JSLB_ADD', '角色列表_增加', '权限中心'),
('JSLB_DELETE', '角色列表_删除', '权限中心'),
('JSLB_EDIT', '角色列表_编辑', '权限中心'),
('JSLB_INDEX', '角色列表_查看', '权限中心'),
('NRGL', '内容管理', '内容管理'),
('QXXX_ADD', '权限信息_增加', '权限中心'),
('QXXX_DELETE', '权限信息_删除', '权限中心'),
('QXXX_EDIT', '权限信息_编辑', '权限中心'),
('QXXX_INDEX', '权限信息_查看', '权限中心'),
('QXZX', '权限中心', '权限中心'),
('QXZ_ADD', '权限组_增加', '权限中心'),
('QXZ_DELETE', '权限组_删除', '权限中心'),
('QXZ_EDIT', '权限组_编辑', '权限中心'),
('QXZ_INDEX', '权限组_查看', '权限中心'),
('WZGL_ADD', '文章管理_增加', '内容管理'),
('WZGL_DELETE', '文章管理_删除', '内容管理'),
('WZGL_EDIT', '文章管理_编辑', '内容管理'),
('WZGL_INDEX', '文章管理_查看', '内容管理'),
('XTSZ', '系统设置', '系统设置'),
('YHLB_ADD', '用户列表_增加', '权限中心'),
('YHLB_DELETE', '用户列表_删除', '权限中心'),
('YHLB_EDIT', '用户列表_编辑', '权限中心'),
('YHLB_INDEX', '用户列表_查看', '权限中心'),
('YQLJ_ADD', '友情链接_增加', '系统设置'),
('YQLJ_DELETE', '友情链接_删除', '系统设置'),
('YQLJ_EDIT', '友情链接_编辑', '系统设置'),
('YQLJ_INDEX', '友情链接_查看', '系统设置');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group`
--

CREATE TABLE `auth_group` (
  `group_label` varchar(100) NOT NULL COMMENT '权限组Label',
  `group_name` varchar(100) NOT NULL COMMENT '权限组名称',
  `default_path` varchar(300) NOT NULL COMMENT '权限组默认进入controller'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group`
--

INSERT INTO `auth_group` (`group_label`, `group_name`, `default_path`) VALUES
('Admin', '系统管理员', 'Admin\\UserController@index');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_relationship`
--

CREATE TABLE `auth_group_relationship` (
  `group_label` varchar(100) NOT NULL COMMENT '权限组Label',
  `auth_label` varchar(100) NOT NULL COMMENT '权限Label'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group_relationship`
--

INSERT INTO `auth_group_relationship` (`group_label`, `auth_label`) VALUES
('Admin', 'BQGL_ADD'),
('Admin', 'BQGL_DELETE'),
('Admin', 'BQGL_EDIT'),
('Admin', 'BQGL_INDEX'),
('Admin', 'DHGL_ADD'),
('Admin', 'DHGL_DELETE'),
('Admin', 'DHGL_EDIT'),
('Admin', 'DHGL_INDEX'),
('Admin', 'FLGL_ADD'),
('Admin', 'FLGL_DELETE'),
('Admin', 'FLGL_EDIT'),
('Admin', 'FLGL_INDEX'),
('Admin', 'JBSZ_ADD'),
('Admin', 'JBSZ_DELETE'),
('Admin', 'JBSZ_EDIT'),
('Admin', 'JBSZ_INDEX'),
('Admin', 'JSLB_ADD'),
('Admin', 'JSLB_DELETE'),
('Admin', 'JSLB_EDIT'),
('Admin', 'JSLB_INDEX'),
('Admin', 'NRGL'),
('Admin', 'QXXX_ADD'),
('Admin', 'QXXX_DELETE'),
('Admin', 'QXXX_EDIT'),
('Admin', 'QXXX_INDEX'),
('Admin', 'QXZX'),
('Admin', 'QXZ_ADD'),
('Admin', 'QXZ_DELETE'),
('Admin', 'QXZ_EDIT'),
('Admin', 'QXZ_INDEX'),
('Admin', 'WZGL_ADD'),
('Admin', 'WZGL_DELETE'),
('Admin', 'WZGL_EDIT'),
('Admin', 'WZGL_INDEX'),
('Admin', 'XTSZ'),
('Admin', 'YHLB_ADD'),
('Admin', 'YHLB_DELETE'),
('Admin', 'YHLB_EDIT'),
('Admin', 'YHLB_INDEX'),
('Admin', 'YQLJ_ADD'),
('Admin', 'YQLJ_DELETE'),
('Admin', 'YQLJ_EDIT'),
('Admin', 'YQLJ_INDEX');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `cate_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `as_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `seo_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `seo_key` varchar(255) COLLATE utf8_bin NOT NULL,
  `seo_desc` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `navigation`
--

CREATE TABLE `navigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `sequence` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `parent_id` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE `role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '角色名称',
  `parent_role_id` int(11) NOT NULL COMMENT '上级角色ID',
  `auth_group` varchar(500) NOT NULL COMMENT '权限组'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `parent_role_id`, `auth_group`) VALUES
(3, '管理员', 0, 'Admin');

-- --------------------------------------------------------

--
-- 表的结构 `systems`
--

CREATE TABLE `systems` (
  `id` int(10) UNSIGNED NOT NULL,
  `cate` int(11) NOT NULL DEFAULT '0',
  `system_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `system_value` varchar(255) COLLATE utf8_bin NOT NULL,
  `system_key` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `systems`
--

INSERT INTO `systems` (`id`, `cate`, `system_name`, `system_value`, `system_key`) VALUES
(3, 0, '巨幕标题', 'Simon Blog', 'jum_title'),
(4, 0, '巨幕内容', '不要放过让自己成长的机会，坚持！', 'jum_content'),
(5, 0, '网站标题', 'Simon的博客', 'title');

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL COMMENT '员工账号',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `salt` varchar(45) NOT NULL COMMENT '盐',
  `truename` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '移动电话',
  `landline` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '固定电话',
  `ext` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '分机号',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `remember_token` varchar(50) NOT NULL,
  `status` enum('normal','locked') NOT NULL DEFAULT 'normal',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `googleauthenticatorsecret` varchar(100) NOT NULL COMMENT 'GoogleAuthenticator',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `salt`, `truename`, `email`, `mobile`, `landline`, `ext`, `role_id`, `remember_token`, `status`, `updated_at`, `googleauthenticatorsecret`, `created_at`) VALUES
(34, 'systemuser', '$2y$10$78RPr6KOQ3boWiFflRIMaulV5gco26kLuff8p9fB9D7kXbGrvKPRW', 'k205G', 'simon', '1052214395@qq.com', '18728601392', '', '', 3, 'KTS9LgswTYh4nFkUFLXMxFLiVAnprP51CHstjq5r6Xu9wXgL9U', 'normal', '2015-12-23 07:41:37', '', '2015-12-04 01:03:38'),
(35, 'simon', '$2y$10$LK.ZSqNqGl9YvkfOXXCdWeI0pXNUc79j2FCV4vrwXUE6fFLLybwSq', 'GqJHp', '邹鑫', '1052214395@qq.com', '18728601392', '', '', 3, 'Eg7Td2l5q9EWyKGkiMiFrSIxfNjAFaMYA9kzj6A6v7j6NvUVb6', 'normal', '2015-12-23 08:05:36', '', '2015-12-23 07:43:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_title_unique` (`title`);

--
-- Indexes for table `article_status`
--
ALTER TABLE `article_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_label`),
  ADD UNIQUE KEY `auth_label` (`auth_label`);

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`group_label`),
  ADD UNIQUE KEY `group_label_unique` (`group_label`);

--
-- Indexes for table `auth_group_relationship`
--
ALTER TABLE `auth_group_relationship`
  ADD UNIQUE KEY `authgroupLabelauthLabelUq` (`group_label`,`auth_label`),
  ADD KEY `authgroupLabelIndex` (`group_label`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_as_name_unique` (`as_name`),
  ADD UNIQUE KEY `category_cate_name_unique` (`cate_name`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_id_UNIQUE` (`role_id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `systems_system_name_unique` (`system_name`),
  ADD UNIQUE KEY `systems_system_key_uindex` (`system_key`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `article_status`
--
ALTER TABLE `article_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
