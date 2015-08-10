-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 18 日 13:14
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `newyun`
--

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_ad`
--

CREATE TABLE `phpyun_ad` (
  `id` int(20) NOT NULL auto_increment,
  `ad_name` varchar(100) NOT NULL,
  `did` varchar(100) NOT NULL default '0',
  `time_start` varchar(100) NOT NULL,
  `time_end` varchar(100) NOT NULL,
  `ad_type` varchar(10) NOT NULL,
  `word_info` text NOT NULL,
  `word_url` varchar(100) NOT NULL,
  `pic_url` varchar(100) NOT NULL,
  `pic_src` varchar(100) NOT NULL,
  `pic_width` varchar(100) NOT NULL,
  `pic_height` varchar(100) NOT NULL,
  `flash_url` varchar(100) default NULL,
  `flash_src` varchar(100) default NULL,
  `flash_width` varchar(100) default NULL,
  `flash_height` varchar(100) default NULL,
  `class_id` int(20) default NULL,
  `is_check` int(2) default '0',
  `is_open` int(1) default '0',
  `target` int(2) default NULL,
  `hits` int(11) default '0',
  `remark` varchar(255) default NULL,
  `sort` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_adclick`
--

CREATE TABLE `phpyun_adclick` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) default NULL,
  `uid` int(11) default NULL,
  `ip` varchar(20) default NULL,
  `addtime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_announcement`
--

CREATE TABLE `phpyun_admin_announcement` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `did` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_config`
--

CREATE TABLE `phpyun_admin_config` (
  `name` varchar(255) NOT NULL,
  `config` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_link`
--

CREATE TABLE `phpyun_admin_link` (
  `id` int(8) NOT NULL auto_increment,
  `link_name` varchar(50) NOT NULL,
  `link_url` varchar(50) NOT NULL,
  `img_type` int(30) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `link_type` varchar(1) NOT NULL,
  `link_state` int(1) NOT NULL default '0',
  `link_sorting` int(8) NOT NULL default '0',
  `link_time` varchar(20) NOT NULL,
  `did` int(11) NOT NULL,
  `tem_type` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_log`
--

CREATE TABLE `phpyun_admin_log` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(200) default NULL,
  `content` text,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_navigation`
--

CREATE TABLE `phpyun_admin_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `keyid` int(11) default '0',
  `url` varchar(50)  default NULL,
  `menu` int(1) default NULL,
  `classname` varchar(100) default '0',
  `sort` int(5) default '0',
  `display` int(1) default NULL,
  `dids` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_template`
--

CREATE TABLE `phpyun_admin_template` (
  `id` int(20) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `tp_name` varchar(50) NOT NULL,
  `update_time` int(32) NOT NULL,
  `dir` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_user`
--

CREATE TABLE `phpyun_admin_user` (
  `uid` int(3) NOT NULL auto_increment,
  `m_id` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `did` int(11) default NULL,
  `lasttime` int(11) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_admin_user_group`
--

CREATE TABLE `phpyun_admin_user_group` (
  `id` int(3) NOT NULL auto_increment,
  `group_name` varchar(100) NOT NULL,
  `group_power` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_ad_class`
--

CREATE TABLE `phpyun_ad_class` (
  `id` int(20) NOT NULL auto_increment,
  `class_name` varchar(100) NOT NULL,
  `orders` int(20) NOT NULL,
  `href` varchar(100) NOT NULL,
  `integral_buy` varchar(100) default '0',
  `type` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_answer`
--

CREATE TABLE `phpyun_answer` (
  `id` int(11) NOT NULL auto_increment,
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment` int(11) NOT NULL default '0',
  `support` int(11) NOT NULL default '0',
  `oppose` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_answer_review`
--

CREATE TABLE `phpyun_answer_review` (
  `id` int(11) NOT NULL auto_increment,
  `aid` int(11) NOT NULL,
  `qid` int(11) default NULL,
  `uid` int(11) NOT NULL,
  `support` int(11) default '0',
  `content` text NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_atn`
--

CREATE TABLE `phpyun_atn` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `sc_uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `usertype` int(11) default NULL,
  `sc_usertype` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_attention`
--

CREATE TABLE `phpyun_attention` (
  `id` int(11) NOT NULL auto_increment,
  `ids` text NOT NULL,
  `type` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_bank`
--

CREATE TABLE `phpyun_bank` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `bank_name` varchar(200) default NULL,
  `bank_number` varchar(200) default NULL,
  `bank_address` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_banner`
--

CREATE TABLE `phpyun_banner` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `pic` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_blacklist`
--

CREATE TABLE `phpyun_blacklist` (
  `id` int(11) NOT NULL auto_increment,
  `p_uid` int(11) default NULL,
  `c_uid` int(11) default NULL,
  `inputtime` int(11) default NULL,
  `usertype` int(1) default NULL,
  `com_name` varchar(100)  default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_change`
--

CREATE TABLE `phpyun_change` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(50)  default NULL,
  `usertype` int(11) default NULL,
  `name` varchar(50)  default NULL,
  `gid` int(11) default NULL,
  `integral` int(11) default NULL,
  `ctime` int(11) default NULL,
  `num` int(11) default NULL,
  `linktel` varchar(100)  default '0',
  `linkman` varchar(200)  default '0',
  `body` varchar(255)  default '0',
  `status` int(11) default '0' ,
  `statusbody` text ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_city_class`
--

CREATE TABLE `phpyun_city_class` (
  `id` int(11) NOT NULL auto_increment,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `letter` varchar(1) NOT NULL,
  `display` int(1) NOT NULL,
  `sitetype` int(2) NOT NULL,
  `sort` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_comclass`
--

CREATE TABLE `phpyun_comclass` (
  `id` int(11) NOT NULL auto_increment,
  `keyid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `variable` varchar(50) default NULL,
  `sort` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company`
--

CREATE TABLE `phpyun_company` (
  `uid` int(11) NOT NULL,
  `name` varchar(25) default NULL,
  `hy` int(5) default NULL,
  `pr` int(5) default NULL,
  `provinceid` int(5) default NULL,
  `cityid` int(5) default NULL,
  `mun` int(3) default NULL,
  `sdate` varchar(20) default NULL,
  `money` int(11) default NULL,
  `content` text,
  `address` varchar(100) default NULL,
  `zip` varchar(10) default NULL,
  `linkman` varchar(50) default NULL,
  `linkjob` varchar(50) default NULL,
  `linkqq` varchar(20) default NULL,
  `linkphone` varchar(20) default NULL,
  `linktel` varchar(50) default NULL,
  `linkmail` varchar(150) default NULL,
  `website` varchar(100) default NULL,
  `x` varchar(100) default NULL,
  `y` varchar(100) default NULL,
  `logo` varchar(100) default NULL,
  `payd` int(8) default '0',
  `integral` int(10) default '0',
  `lastupdate` varchar(10) default NULL,
  `cloudtype` int(2) default NULL,
  `jobtime` int(11) default NULL,
  `r_status` int(2) default '0',
  `firmpic` varchar(100) default NULL,
  `rec` int(11) default '0',
  `hits` int(11) default '0',
  `ant_num` int(11) default '0',
  `pl_time` int(11) default NULL,
  `pl_status` int(11) default '1',
  `order` int(11) unsigned default '0',
  `admin_remark` varchar(255) default NULL,
  `email_dy` int(11) default '0',
  `msg_dy` int(11) default '0',
  `sync` int(11) unsigned default '0',
  `hy_dy` varchar(100) default NULL,
  `moblie_status` int(1) default '0',
  `email_status` int(1) default '0',
  `yyzz_status` int(1) default '0',
  `hottime` int(11) default '0',
  `did` int(11) default NULL,
  KEY `uid` USING BTREE (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_cert`
--

CREATE TABLE `phpyun_company_cert` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `type` varchar(200) default NULL,
  `status` int(11) default '0',
  `step` int(11) default NULL,
  `check` varchar(200) default NULL,
  `check2` varchar(200) default NULL,
  `ctime` int(11) default NULL,
  `statusbody` varchar(100) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_job`
--

CREATE TABLE `phpyun_company_job` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hy` int(5) default NULL,
  `job1` int(5) default NULL,
  `job1_son` int(5) default NULL,
  `job_post` int(5) default NULL,
  `provinceid` int(5) default NULL,
  `cityid` int(5) default NULL,
  `three_cityid` int(5) default NULL,
  `cert` varchar(50) default NULL,
  `salary` int(5) default NULL,
  `type` int(5) NOT NULL,
  `number` int(2) NOT NULL,
  `exp` int(5) NOT NULL,
  `report` int(5) NOT NULL,
  `sex` int(5) NOT NULL,
  `edu` int(5) NOT NULL,
  `marriage` int(5) NOT NULL,
  `description` text NOT NULL,
  `xuanshang` int(11) NOT NULL default '0',
  `xsdate` int(11) default NULL,
  `sdate` int(11) NOT NULL,
  `edate` int(11) NOT NULL,
  `jobhits` int(10) NOT NULL default '0',
  `lastupdate` varchar(10) NOT NULL,
  `rec` int(2) default '0',
  `cloudtype` int(2) default NULL,
  `state` int(2) default '0',
  `statusbody` varchar(200) default '0',
  `age` int(11) default NULL,
  `lang` text,
  `welfare` text,
  `com_name` varchar(50) NOT NULL default '',
  `pr` int(5) default NULL,
  `mun` int(5) default NULL,
  `com_provinceid` int(5) default NULL,
  `rating` int(5) default NULL,
  `status` int(1) NOT NULL default '0',
  `urgent` int(1) default NULL,
  `r_status` int(1) default '0',
  `end_email` int(1) default '0',
  `urgent_time` int(11) default NULL,
  `com_logo` varchar(100) default NULL,
  `autotype` int(11) default '0',
  `autotime` int(11) default '0',
  `is_link` int(1) default '1',
  `link_type` int(1) default '1',
  `source` int(1) default '1',
  `rec_time` int(11) default '0',
  `snum` int(11) default '0',
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_job_link`
--

CREATE TABLE `phpyun_company_job_link` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `jobid` int(11) default NULL,
  `link_man` varchar(100)  default NULL,
  `link_moblie` varchar(20)  default NULL,
  `email_type` int(5) default NULL,
  `is_email` int(2) default '0',
  `email` varchar(100)  default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_msg`
--

CREATE TABLE `phpyun_company_msg` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `cuid` int(11) default NULL,
  `content` text,
  `ctime` varchar(100) default NULL,
  `status` int(2) default NULL,
  `reply` text,
  `reply_time` int(11) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_news`
--

CREATE TABLE `phpyun_company_news` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default '0',
  `title` varchar(200) default '0',
  `ctime` int(11) default '0',
  `body` text,
  `status` int(2) default '0',
  `statusbody` text,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_order`
--

CREATE TABLE `phpyun_company_order` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `order_id` varchar(18) default NULL,
  `order_type` varchar(25) default NULL,
  `order_price` double(18,2) NOT NULL,
  `order_time` int(10) NOT NULL,
  `order_state` int(2) NOT NULL,
  `order_remark` text,
  `order_bank` varchar(150) NOT NULL default '0',
  `type` int(1) default NULL,
  `rating` int(10) default NULL,
  `integral` int(11) default NULL,
  `is_invoice` int(1) default '0',
  `coupon` int(11) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_pay`
--

CREATE TABLE `phpyun_company_pay` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(18) default NULL,
  `order_price` decimal(10,2) default NULL,
  `pay_time` int(11) default NULL,
  `pay_state` int(2) default NULL,
  `com_id` int(10) default NULL,
  `pay_remark` varchar(255) default NULL,
  `type` int(1) default NULL,
  `pay_type` int(4) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_product`
--

CREATE TABLE `phpyun_company_product` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default '0',
  `title` varchar(200) default '0',
  `pic` varchar(200) default '0',
  `body` text,
  `ctime` int(11) default '0',
  `status` int(2) default '0',
  `statusbody` text,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_rating`
--

CREATE TABLE `phpyun_company_rating` (
  `id` int(6) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `service_price` varchar(100) default NULL,
  `integral_buy` varchar(100) default NULL,
  `yh_price` varchar(100) default NULL,
  `yh_integral` varchar(100) default NULL,
  `time_start` int(11) default NULL,
  `time_end` int(11) default NULL,
  `resume` int(5) default NULL,
  `job_num` int(11) default NULL,
  `interview` int(11) default NULL,
  `editjob_num` int(11) default NULL,
  `breakjob_num` int(11) default NULL,
  `sort` int(10) default NULL,
  `display` int(1) default NULL,
  `explains` varchar(255) default NULL,
  `com_pic` varchar(100) default NULL,
  `com_color` varchar(100) default NULL,
  `type` int(2) default NULL,
  `lt_resume` int(11) default NULL,
  `lt_job_num` int(11) default NULL,
  `lt_editjob_num` int(11) default NULL,
  `lt_breakjob_num` int(11) default NULL,
  `category` int(2) default NULL,
  `msg_num` int(11) default '0',
  `service_time` int(11) default NULL,
  `coupon` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_show`
--

CREATE TABLE `phpyun_company_show` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200)  default NULL,
  `picurl` varchar(200)  default NULL,
  `body` varchar(200)  default NULL,
  `ctime` varchar(200)  default NULL,
  `uid` varchar(200)  default NULL,
  `sort` int(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_statis`
--

CREATE TABLE `phpyun_company_statis` (
  `uid` int(11) NOT NULL,
  `pay` double(10,2) NOT NULL default '0.00',
  `integral` varchar(10) NOT NULL default '0',
  `sq_job` int(6) unsigned NOT NULL,
  `fav_job` int(6) unsigned NOT NULL,
  `rating` int(5) unsigned default NULL,
  `rating_name` varchar(100) default NULL,
  `vip_etime` varchar(100) default '0',
  `all_pay` double(10,2) NOT NULL,
  `consum_pay` double(10,2) NOT NULL,
  `rating_type` int(11) default NULL,
  `invite_resume` int(10) default NULL,
  `comtpl` varchar(100) default '0',
  `comtpl_all` varchar(100) default NULL,
  `job_num` int(11) default '0',
  `editjob_num` int(11) default '0',
  `breakjob_num` int(11) default '0',
  `down_resume` int(10) default '0',
  `qqshow` int(11) default '0',
  `qqcomment` int(11) default '0',
  `sinashare` int(11) default '0',
  `sinashow` int(11) default '0',
  `sinacomment` int(11) default '0',
  `qqwname` varchar(100) default NULL,
  `sinawname` varchar(100) default NULL,
  `lt_job_num` int(11) default '0',
  `lt_editjob_num` int(11) default '0',
  `lt_breakjob_num` int(11) default '0',
  `lt_down_resume` int(11) default '0',
  `qqshare` int(11) default '0',
  `msg_num` int(11) default '0',
  `autotime` int(11) default '0',
  `vip_stime` int(11) default '0',
  `did` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_company_tpl`
--

CREATE TABLE `phpyun_company_tpl` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100)  default '0',
  `url` varchar(100)  default '0',
  `pic` varchar(200)  default '0',
  `type` int(10) default '1',
  `price` varchar(100)  default '0',
  `status` int(10) default NULL,
  `service_uid` varchar(225) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_coupon`
--

CREATE TABLE `phpyun_coupon` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `time` int(11) default NULL,
  `amount` int(11) default NULL,
  `scope` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_coupon_list`
--

CREATE TABLE `phpyun_coupon_list` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `number` varchar(100) default NULL,
  `ctime` int(11) default NULL,
  `status` int(1) default '1',
  `coupon_id` int(11) default NULL,
  `coupon_name` varchar(20) default NULL,
  `validity` int(11) default NULL,
  `coupon_amount` int(11) default NULL,
  `coupon_scope` int(11) default NULL,
  `xf_time` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------


--
-- 表的结构 `phpyun_cron`
--

CREATE TABLE `phpyun_cron` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `dir` varchar(200) default NULL,
  `type` int(11) default NULL,
  `week` int(11) default NULL,
  `month` int(10) default NULL,
  `hour` int(10) default NULL,
  `minute` int(10) default NULL,
  `display` int(1) default NULL,
  `ctime` int(11) default NULL,
  `nowtime` int(11) default '0',
  `nexttime` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_description`
--

CREATE TABLE `phpyun_description` (
  `id` int(11) NOT NULL auto_increment,
  `nid` int(11) default NULL,
  `name` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `keyword` varchar(255) default NULL,
  `descs` text,
  `top_tpl` int(2) default NULL,
  `top_tpl_dir` varchar(255) default NULL,
  `footer_tpl` int(2) default NULL,
  `footer_tpl_dir` varchar(255) default NULL,
  `content` mediumtext,
  `sort` int(11) default NULL,
  `is_nav` int(1) default '0',
  `ctime` int(11) default NULL,
  `is_menu` int(11) default '0',
  `is_type` int(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_desc_class`
--

CREATE TABLE `phpyun_desc_class` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `sort` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_domain`
--

CREATE TABLE `phpyun_domain` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `province` int(11) default NULL,
  `cityid` int(11) default NULL,
  `three_cityid` int(11) default NULL,
  `type` int(2) NOT NULL,
  `style` varchar(100)  NOT NULL,
  `tpl` varchar(20) default NULL,
  `hy` int(11) default NULL,
  `fz_type` int(11) NOT NULL,
  `webtitle` text,
  `webkeyword` text,
  `webmeta` text,
  `weblogo` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_down_resume`
--

CREATE TABLE `phpyun_down_resume` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `eid` int(11) default NULL,
  `comid` int(11) default NULL,
  `downtime` int(11) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_email_msg`
--

CREATE TABLE `phpyun_email_msg` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `name` varchar(100) default NULL,
  `cuid` int(11) default NULL,
  `cname` varchar(255) default '系统',
  `email` varchar(200) default NULL,
  `title` varchar(200) default NULL,
  `content` text,
  `ctime` int(11) default NULL,
  `state` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_entrust`
--

CREATE TABLE `phpyun_entrust` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `lt_uid` int(11) default NULL,
  `datetime` int(11) default NULL,
  `remind_status` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_evaluate`
--

CREATE TABLE `phpyun_evaluate` (
  `id` int(4) NOT NULL auto_increment,
  `gid` int(4) default NULL,
  `question` text,
  `option` text,
  `score` text,
  `sort` int(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_evaluate_group`
--

CREATE TABLE `phpyun_evaluate_group` (
  `id` int(4) NOT NULL auto_increment,
  `keyid` int(4) NOT NULL default '0',
  `name` varchar(32) NOT NULL,
  `sort` int(4) NOT NULL default '0',
  `description` text,
  `ctime` int(11) default NULL,
  `fromscore` text,
  `toscore` text,
  `comment` text,
  `visits` int(4) NOT NULL default '0',
  `comnum` int(11) default '0',
  `pic` varchar(64) default NULL,
  `num` int(10) default NULL,
  `recommend` tinyint(1) NOT NULL default '0',
  `score` int(11) default '0',
  `top` int(1) default '0',
  `hot` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_evaluate_leave_message`
--

CREATE TABLE `phpyun_evaluate_leave_message` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `examid` int(11) unsigned NOT NULL,
  `uid` varchar(36) NOT NULL,
  `usertype` int(1) default NULL,
  `message` varchar(255) default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_evaluate_log`
--

CREATE TABLE `phpyun_evaluate_log` (
  `id` int(4) NOT NULL auto_increment,
  `uid` int(4) default NULL,
  `nuid` varchar(36) default NULL,
  `examid` int(4) NOT NULL,
  `grade` int(4) default NULL,
  `ctime` int(11) NOT NULL,
  `usedsecond` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='测评成绩记录表' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_excel`
--

CREATE TABLE `phpyun_excel` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `count` int(11) default NULL,
  `time` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_fav_job`
--

CREATE TABLE `phpyun_fav_job` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `com_name` varchar(150) NOT NULL,
  `datetime` int(10) NOT NULL,
  `type` int(11) NOT NULL default '1',
  `job_name` varchar(150) default NULL,
  `job_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_finder`
--

CREATE TABLE `phpyun_finder` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `usertype` int(1) default NULL,
  `name` varchar(100) default NULL,
  `para` varchar(255) default NULL,
  `addtime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend`
--

CREATE TABLE `phpyun_friend` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `nid` int(11) default NULL,
  `status` int(11) default NULL,
  `uidtype` int(2) default NULL,
  `nidtype` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_foot`
--

CREATE TABLE `phpyun_friend_foot` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `fid` int(11) default NULL,
  `num` int(11) default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_im_list`
--

CREATE TABLE `phpyun_friend_im_list` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `touid` int(11) default NULL,
  `username` varchar(200) default NULL,
  `type` varchar(200) default NULL,
  `content` text,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_info`
--

CREATE TABLE `phpyun_friend_info` (
  `uid` int(11) default NULL,
  `nickname` varchar(100)  default NULL,
  `sex` int(1) default '3',
  `pic` varchar(100)  default NULL,
  `pic_big` varchar(100) default NULL,
  `description` varchar(100)  default NULL,
  `fans` int(11) default '0',
  `atnnum` int(11) default '0',
  `ask` int(11) default '0',
  `answer` int(11) default '0',
  `birthday` varchar(100)  default NULL,
  `usertype` int(2) default NULL,
  `iscert` int(2) default '0',
  `did` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_message`
--

CREATE TABLE `phpyun_friend_message` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `uid` int(11) default NULL,
  `u_name` varchar(100)  default NULL,
  `fid` int(11) default NULL,
  `f_name` varchar(100)  default NULL,
  `nid` int(11) default '0',
  `content` varchar(225)  default NULL,
  `ctime` int(11) default NULL,
  `status` int(11) default '0',
  `remind_status` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_reply`
--

CREATE TABLE `phpyun_friend_reply` (
  `id` int(11) NOT NULL auto_increment,
  `nid` int(11) default NULL,
  `fid` int(11) default NULL,
  `uid` int(11) default NULL,
  `reply` varchar(225)  default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_friend_state`
--

CREATE TABLE `phpyun_friend_state` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `content` varchar(225)  default NULL,
  `ctime` int(11) default NULL,
  `type` int(11) default '1' ,
  `msg_pic` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_hotjob`
--

CREATE TABLE `phpyun_hotjob` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(200) default NULL,
  `rating` varchar(20) default NULL,
  `hot_pic` varchar(100) default NULL,
  `service_price` int(11) default NULL,
  `time_start` int(11) default NULL,
  `time_end` int(11) default NULL,
  `sort` int(11) default '0',
  `beizhu` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_hot_key`
--

CREATE TABLE `phpyun_hot_key` (
  `id` int(20) NOT NULL auto_increment,
  `key_name` varchar(100) NOT NULL,
  `num` int(20) NOT NULL default '0',
  `type` int(2) NOT NULL,
  `size` varchar(10) default NULL,
  `check` int(1) default '0',
  `color` varchar(10) default NULL,
  `bold` int(11) default NULL,
  `tuijian` int(11) default '0',
  `wxtime` int(11) default '0',
  `wxuser` varchar(100) default NULL,
  `wxid` varchar(100) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_industry`
--

CREATE TABLE `phpyun_industry` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `sort` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_invoice_record`
--

CREATE TABLE `phpyun_invoice_record` (
  `id` int(11) NOT NULL auto_increment,
  `oid` int(11) default NULL,
  `order_id` varchar(18)  default NULL,
  `uid` int(11) default NULL,
  `title` varchar(100)  default NULL,
  `link_man` varchar(20)  default NULL,
  `link_moblie` varchar(20)  default NULL,
  `address` varchar(255)  default NULL,
  `status` int(11) default '0',
  `lasttime` int(11) default NULL,
  `addtime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_job_class`
--

CREATE TABLE `phpyun_job_class` (
  `id` int(11) NOT NULL auto_increment,
  `keyid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_look_job`
--

CREATE TABLE `phpyun_look_job` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `jobid` int(11) default NULL,
  `com_id` int(11) default NULL,
  `datetime` int(11) default NULL,
  `status` int(1) default '0',
  `com_status` int(1) default '0',
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_look_resume`
--

CREATE TABLE `phpyun_look_resume` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `com_id` int(11) default NULL,
  `resume_id` int(11) default NULL,
  `datetime` int(11) default NULL,
  `status` int(1) default '0',
  `com_status` int(1) default '0',
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;


-- --------------------------------------------------------

--
-- 表的结构 `phpyun_member`
--

CREATE TABLE `phpyun_member` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(100) default NULL,
  `moblie` varchar(20) default NULL,
  `reg_ip` varchar(20) default NULL,
  `reg_date` int(11) default NULL,
  `login_ip` varchar(20) default NULL,
  `login_date` int(11) default NULL,
  `usertype` int(1) NOT NULL default '1',
  `login_hits` int(11) default '0',
  `salt` varchar(6) default NULL,
  `address` varchar(100) default NULL,
  `name_repeat` int(2) default '0',
  `qqid` varchar(200) default NULL,
  `status` int(4) default NULL,
  `pwuid` int(11) default '0',
  `pw_repeat` int(1) default '0',
  `lock_info` varchar(200)  default NULL,
  `email_status` int(1) default NULL,
  `signature` varchar(100) default NULL,
  `sinaid` varchar(100) default NULL,
  `wxid` varchar(100) default '0',
  `wxopenid` varchar(100) default NULL,
  `unionid` varchar(100) default NULL,
  `wxname` varchar(100) default NULL,
  `wxbindtime` int(11) default '0',
  `passtext` varchar(100) default NULL,
  `source` int(1) default '1',
  `regcode` int(10) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='用户成员表（个人用户、企业用户）' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_member_log`
--

CREATE TABLE `phpyun_member_log` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `opera` int(11) default NULL,
  `type` int(11) default NULL,
  `usertype` int(11) default NULL,
  `content` text,
  `ip` varchar(20) default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='会员日志' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_member_statis`
--

CREATE TABLE `phpyun_member_statis` (
  `uid` int(11) NOT NULL,
  `integral` varchar(10) NOT NULL default '0',
  `pay` double(10,2) NOT NULL default '0.00',
  `resume_num` int(10) NOT NULL,
  `fav_jobnum` int(10) NOT NULL,
  `sq_jobnum` int(10) NOT NULL,
  `message_num` int(10) NOT NULL,
  `down_num` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_message`
--

CREATE TABLE `phpyun_message` (
  `id` int(11) NOT NULL auto_increment,
  `content` varchar(255) NOT NULL,
  `username` varchar(20) default NULL,
  `uid` int(11) default NULL,
  `status` int(1) default '0',
  `ctime` int(11) default NULL,
  `reply` varchar(200) default '',
  `reply_time` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='留言反馈' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_moblie_msg`
--

CREATE TABLE `phpyun_moblie_msg` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `name` varchar(100) default NULL,
  `cuid` int(11) default NULL,
  `cname` varchar(255) default NULL,
  `moblie` varchar(200) default NULL,
  `content` varchar(200) default NULL,
  `ctime` int(11) default NULL,
  `state` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_msg`
--

CREATE TABLE `phpyun_msg` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(100) default NULL,
  `jobid` int(11) default NULL,
  `job_uid` int(11) default NULL,
  `datetime` int(11) default NULL,
  `reply` text,
  `content` text,
  `reply_time` int(11) default NULL,
  `com_name` varchar(100) default NULL,
  `job_name` varchar(100) default NULL,
  `del_status` int(11) default '0',
  `type` int(11) default '1',
  `user_remind_status` int(1) default '1',
  `com_remind_status` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_navigation`
--

CREATE TABLE `phpyun_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `nid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) default NULL,
  `sort` int(11) default NULL,
  `display` int(1) NOT NULL,
  `eject` int(1) NOT NULL,
  `type` int(1) default '1',
  `furl` varchar(100) default NULL,
  `color` varchar(20) default NULL,
  `model` varchar(20) default NULL,
  `bold` int(1) default NULL,
  `desc` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_navigation_type`
--

CREATE TABLE `phpyun_navigation_type` (
  `id` int(11) NOT NULL auto_increment,
  `typename` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_navmap`
--

CREATE TABLE `phpyun_navmap` (
  `id` int(11) NOT NULL auto_increment,
  `nid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) default NULL,
  `sort` int(11) default NULL,
  `display` int(1) NOT NULL default '0',
  `eject` int(1) NOT NULL,
  `type` int(1) default '1',
  `furl` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='网站地图' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_news_base`
--

CREATE TABLE `phpyun_news_base` (
  `id` int(11) NOT NULL auto_increment,
  `nid` int(11) NOT NULL,
  `did` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `color` varchar(255) default NULL,
  `keyword` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `datetime` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `description` varchar(255) default NULL,
  `newsphoto` varchar(100) default NULL,
  `s_thumb` varchar(100) default NULL,
  `source` varchar(255) default NULL,
  `sort` int(11) default NULL,
  `lastupdate` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_news_content`
--

CREATE TABLE `phpyun_news_content` (
  `nbid` int(11) NOT NULL,
  `content` text NOT NULL,
  `did` int(11) default '0',
  PRIMARY KEY  (`nbid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_news_group`
--

CREATE TABLE `phpyun_news_group` (
  `id` int(11) NOT NULL auto_increment,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(11) default '0',
  `rec` int(1) default '0',
  `is_menu` int(1) default '0',
  `rec_news` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_once_job`
--

CREATE TABLE `phpyun_once_job` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `mans` varchar(100) NOT NULL,
  `require` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `hits` int(11) default '0',
  `linkman` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` int(2) NOT NULL default '0',
  `password` varchar(100) NOT NULL,
  `qq` varchar(20) default NULL,
  `email` varchar(150) default NULL,
  `edate` int(11) default NULL,
  `login_ip` varchar(20) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_outside`
--

CREATE TABLE `phpyun_outside` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `type` varchar(100) default NULL,
  `titlelen` int(10) default NULL,
  `infolen` int(10) default NULL,
  `byorder` varchar(200) default NULL,
  `num` int(11) default NULL,
  `code` text,
  `edittime` int(10) default NULL,
  `lasttime` int(11) default NULL,
  `urltype` varchar(200) default NULL,
  `timetype` varchar(200) default NULL,
  `where` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------
 
--
-- 表的结构 `phpyun_property`
--

CREATE TABLE `phpyun_property` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `value` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_question`
--

CREATE TABLE `phpyun_question` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `answer_num` int(11) NOT NULL default '0',
  `atnnum` int(11) default '0',
  `visit` int(11) NOT NULL default '0',
  `is_recom` int(1) NOT NULL default '0',
  `lastupdate` int(11) default NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_q_class`
--

CREATE TABLE `phpyun_q_class` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `pic` varchar(100) default NULL,
  `sort` int(11) NOT NULL,
  `intro` text,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_reason`
--

CREATE TABLE `phpyun_reason` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_rebates`
--

CREATE TABLE `phpyun_rebates` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `job_uid` int(11) default NULL,
  `job_id` int(11) default NULL,
  `name` varchar(10) default NULL,
  `phone` varchar(15) default NULL,
  `content` text,
  `datetime` int(11) default NULL,
  `status` int(1) default '0',
  `reply` text,
  `reply_time` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_recycle`
--

CREATE TABLE `phpyun_recycle` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `tablename` varchar(100) default NULL,
  `body` longtext,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='回收站' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_report`
--

CREATE TABLE `phpyun_report` (
  `id` int(11) NOT NULL auto_increment,
  `p_uid` int(11) default NULL,
  `c_uid` int(11) default NULL,
  `eid` int(11) default NULL,
  `usertype` int(1) default NULL,
  `inputtime` int(11) default NULL,
  `username` varchar(100)  default NULL,
  `r_name` varchar(100)  default NULL,
  `status` int(1) default '0',
  `r_reason` varchar(200)  default NULL,
  `type` int(11) default '0',
  `r_type` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume`
--

CREATE TABLE `phpyun_resume` (
  `uid` int(11) NOT NULL,
  `name` varchar(25) default NULL,
  `sex` int(2) default NULL,
  `birthday` varchar(10) default NULL,
  `marriage` int(10) default NULL,
  `height` varchar(4) default NULL,
  `nationality` varchar(20) default NULL,
  `weight` varchar(4) default NULL,
  `idcard` varchar(20) default NULL,
  `telphone` varchar(20) default NULL,
  `telhome` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `edu` int(11) default NULL,
  `homepage` varchar(50) default NULL,
  `address` varchar(80) default NULL,
  `description` varchar(150) default NULL,
  `resume_photo` varchar(100) default NULL,
  `photo` varchar(100) default NULL,
  `expect` int(11) default '0',
  `def_job` int(11) default '0',
  `exp` int(11) default NULL,
  `status` int(2) default '1',
  `idcard_pic` varchar(100) default NULL,
  `email_status` int(1) default '0',
  `moblie_status` int(1) default '0',
  `idcard_status` int(1) default '0',
  `statusbody` varchar(200) default NULL,
  `cert_time` int(11) default NULL,
  `r_status` int(1) default '0',
  `ant_num` int(11) default '0',
  `email_dy` int(1) default '0',
  `msg_dy` int(1) default '0',
  `living` varchar(100) default NULL,
  `domicile` varchar(100) default NULL,
  `basic_info` int(11) default '1',
  `hy_dy` varchar(100) default NULL,
  `info_status` int(1) default '1',
  `did` int(11) default NULL,
  KEY `uid` USING BTREE (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_cert`
--

CREATE TABLE `phpyun_resume_cert` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) default NULL,
  `edate` int(10) default NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_doc`
--

CREATE TABLE `phpyun_resume_doc` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `doc` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_edu`
--

CREATE TABLE `phpyun_resume_edu` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) default NULL,
  `edate` int(10) default NULL,
  `specialty` varchar(50) default NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_expect`
--

CREATE TABLE `phpyun_resume_expect` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(25) default NULL,
  `hy` int(5) default NULL,
  `job_classid` varchar(100) default NULL,
  `provinceid` int(5) default NULL,
  `cityid` int(5) default NULL,
  `three_cityid` int(5) default NULL,
  `salary` int(3) default NULL,
  `jobstatus` int(11) default NULL,
  `type` int(3) default NULL,
  `report` int(3) default NULL,
  `defaults` int(1) NOT NULL default '0',
  `open` int(1) default '1',
  `is_entrust` int(1) default '0',
  `full` int(3) default '0',
  `doc` int(1) default '0',
  `hits` int(6) default '0',
  `lastupdate` int(10) NOT NULL,
  `def_job` int(11) default NULL,
  `cloudtype` int(2) default NULL,
  `olduid` int(11) default NULL,
  `integrity` int(11) default NULL,
  `height_status` int(11) default '0',
  `statusbody` varchar(200) default NULL,
  `status_time` int(11) default NULL,
  `rec` int(11) default '0',
  `top` int(11) default NULL,
  `topdate` int(11) default '0',
  `rec_resume` int(11) default NULL,
  `dom_sort` varchar(255) default NULL,
  `resume_diy` text,
  `source` int(1) default '1',
  `tmpid` int(5) default NULL,
  `ctime` int(11) default NULL,
  `dnum` int(11) default '0',
  `did` int(11) default NULL,
  `uname` varchar(50) default NULL,
  `idcard_status` tinyint(1) default '0',
  `status` tinyint(1) default '1',
  `r_status` tinyint(4) default '0',
  `edu` int(11) default '0',
  `exp` int(11) default '0',
  `sex` int(11) default '0',
  `photo` varchar(100) default NULL,
  `birthday` varchar(15) default NULL,
  PRIMARY KEY  (`id`,`defaults`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_other`
--

CREATE TABLE `phpyun_resume_other` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_project`
--

CREATE TABLE `phpyun_resume_project` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) default NULL,
  `edate` int(10) default NULL,
  `sys` varchar(50) default NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_show`
--

CREATE TABLE `phpyun_resume_show` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200)  default NULL,
  `picurl` varchar(200)  default NULL,
  `ctime` varchar(200)  default NULL,
  `uid` varchar(200)  default NULL,
  `sort` int(4) default '0',
  `eid` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='简历作品' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_skill`
--

CREATE TABLE `phpyun_resume_skill` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `skill` int(5) NOT NULL,
  `ing` int(5) NOT NULL,
  `longtime` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_tiny`
--

CREATE TABLE `phpyun_resume_tiny` (
  `id` int(25) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sex` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `hits` int(11) default '0',
  `job` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `qq` varchar(25) NOT NULL,
  `production` text NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `login_ip` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_training`
--

CREATE TABLE `phpyun_resume_training` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) default NULL,
  `edate` int(10) default NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_resume_work`
--

CREATE TABLE `phpyun_resume_work` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) default NULL,
  `edate` int(10) default NULL,
  `department` varchar(50) default NULL,
  `title` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_reward`
--

CREATE TABLE `phpyun_reward` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `nid` int(11) default NULL,
  `integral` int(11) default NULL,
  `num` int(11) default '0',
  `restriction` int(11) default '0',
  `stock` int(11) default '0',
  `pic` varchar(100) default NULL,
  `sort` int(11) default NULL,
  `content` text,
  `status` int(1) default NULL,
  `sdate` int(11) default NULL,
  `rec` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_reward_class`
--

CREATE TABLE `phpyun_reward_class` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_seo`
--

CREATE TABLE `phpyun_seo` (
  `id` int(11) NOT NULL auto_increment,
  `seoname` varchar(100) default NULL,
  `seomodel` varchar(100) default NULL,
  `ident` varchar(100) default NULL,
  `title` varchar(100) default NULL,
  `keywords` varchar(255) default NULL,
  `description` text,
  `time` int(11) default NULL,
  `did` int(11) default NULL,
  `php_url` varchar(100) default NULL,
  `rewrite_url` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_special`
--

CREATE TABLE `phpyun_special` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `tpl` varchar(100) default NULL,
  `pic` varchar(255) default NULL,
  `limit` int(10) default NULL,
  `num` int(11) default '0',
  `rating` varchar(200) default NULL,
  `display` int(10) default '1',
  `com_bm` int(10) default NULL,
  `integral` int(11) default NULL,
  `etime` int(11) default NULL,
  `sort` int(11) default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='企业专题' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_special_com`
--

CREATE TABLE `phpyun_special_com` (
  `id` int(11) NOT NULL auto_increment,
  `sid` int(11) default NULL,
  `uid` int(11) default NULL,
  `integral` int(11) default NULL,
  `status` int(2) default '0',
  `time` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_subscribe`
--

CREATE TABLE `phpyun_subscribe` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100)  NULL,
  `job1` int(11) default NULL,
  `job1_son` int(11) default NULL,
  `job_post` int(11) default NULL,
  `provinceid` int(11) default NULL,
  `cityid` int(11) default NULL,
  `three_cityid` int(11) default NULL,
  `salary` int(11) default NULL,
  `type` int(11) default NULL,
  `ctime` int(11) default NULL,
  `status` int(1) default '0',
  `code` varchar(10)  NULL,
  `cycle_time` int(11) default NULL,
  `time` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_sysmsg`
--

CREATE TABLE `phpyun_sysmsg` (
  `id` int(11) NOT NULL auto_increment,
  `content` varchar(255)  NOT NULL,
  `fa_uid` int(11) NOT NULL,
  `username` varchar(20)  NOT NULL default '管理员',
  `ctime` int(11) NOT NULL,
  `remind_status` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_talent_pool`
--

CREATE TABLE `phpyun_talent_pool` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `eid` int(11) default NULL,
  `cuid` int(11) default NULL,
  `ctime` int(11) default NULL,
  `remark` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='人才库' AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_templates`
--

CREATE TABLE `phpyun_templates` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `title` varchar(255) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_toolbox_class`
--

CREATE TABLE `phpyun_toolbox_class` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `content` text,
  `pic` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_toolbox_doc`
--

CREATE TABLE `phpyun_toolbox_doc` (
  `id` int(11) NOT NULL auto_increment,
  `cid` int(11) default NULL,
  `name` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `is_show` int(1) default '0',
  `add_time` int(11) default NULL,
  `downnum` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_userclass`
--

CREATE TABLE `phpyun_userclass` (
  `id` int(11) NOT NULL auto_increment,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `variable` varchar(100) default NULL,
  `sort` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_userid_job`
--

CREATE TABLE `phpyun_userid_job` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_name` varchar(150) NOT NULL,
  `com_id` int(11) NOT NULL,
  `com_name` varchar(150) NOT NULL,
  `eid` int(10) unsigned NOT NULL,
  `datetime` int(10) NOT NULL,
  `type` int(1) NOT NULL default '1',
  `is_browse` int(1) NOT NULL default '1',
  `body` varchar(255) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_userid_msg`
--

CREATE TABLE `phpyun_userid_msg` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `fid` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `type` int(11) NOT NULL default '0',
  `datetime` int(10) NOT NULL,
  `default` int(1) default '0',
  `is_browse` int(1) default '1',
  `address` varchar(255) default NULL,
  `intertime` varchar(255) default NULL,
  `linkman` varchar(50) default NULL,
  `linktel` varchar(50) default NULL,
  `jobid` int(11) default NULL,
  `jobname` varchar(50) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_user_entrust`
--

CREATE TABLE `phpyun_user_entrust` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `username` varchar(255) default NULL,
  `eid` int(11) default NULL,
  `status` int(11) default '0',
  `price` double(10,2) default NULL,
  `comid` text,
  `add_time` int(11) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_user_entrust_record`
--

CREATE TABLE `phpyun_user_entrust_record` (
  `id` int(11) NOT NULL auto_increment,
  `eid` int(11) default NULL,
  `comid` int(11) default NULL,
  `jobid` int(11) default NULL,
  `ctime` int(11) default NULL,
  `did` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_user_resume`
--

CREATE TABLE `phpyun_user_resume` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `eid` int(10) NOT NULL,
  `expect` int(1) default '0',
  `skill` int(1) default '0',
  `work` int(1) default '0',
  `project` int(1) default '0',
  `edu` int(1) default '0',
  `training` int(1) default '0',
  `cert` int(1) default '0',
  `other` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_warning`
--

CREATE TABLE `phpyun_warning` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `type` int(1) default NULL,
  `status` int(1) default '1',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_webscan360`
--

CREATE TABLE `phpyun_webscan360` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `var` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `ext1` varchar(100) default NULL,
  `ext2` varchar(100) default NULL,
  `state` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_website`
--

CREATE TABLE `phpyun_website` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL default '0',
  `price` int(11) NOT NULL default '0',
  `smallday` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_wxlog`
--

CREATE TABLE `phpyun_wxlog` (
  `id` int(11) NOT NULL auto_increment,
  `wxid` varchar(100)  NOT NULL default '0',
  `wxname` varchar(100) default NULL,
  `wxuid` int(11) default '0',
  `wxuser` varchar(100) default NULL,
  `content` text,
  `reply` text,
  `nav` varchar(100) default NULL,
  `type` varchar(100) default NULL,
  `time` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_wxnav`
--

CREATE TABLE `phpyun_wxnav` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `keyid` int(11) default NULL,
  `key` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `type` varchar(50) NOT NULL,
  `sort` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_zhaopinhui`
--

CREATE TABLE `phpyun_zhaopinhui` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default '0',
  `pic` varchar(200) default '0',
  `starttime` varchar(100) default '0',
  `endtime` varchar(100) default '0',
  `provinceid` int(11) default '0',
  `cityid` int(11) default '0',
  `address` varchar(200) default NULL,
  `traffic` text,
  `phone` varchar(100) default '0',
  `organizers` varchar(200) default '0',
  `user` varchar(200) default NULL,
  `weburl` varchar(100) default '0',
  `body` text,
  `media` text,
  `packages` text,
  `booth` text,
  `participate` text,
  `status` int(11) default '0',
  `ctime` int(11) default '0',
  `zwpic` varchar(200) default NULL,
  `did` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_zhaopinhui_com`
--

CREATE TABLE `phpyun_zhaopinhui_com` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default '0',
  `zid` int(11) default '0',
  `jobid` varchar(255) default '0',
  `ctime` int(11) default '0',
  `status` int(11) default '0',
  `statusbody` varchar(100) default NULL,
  `inadd` varchar(100) default NULL,
  `did` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- 表的结构 `phpyun_zhaopinhui_pic`
--

CREATE TABLE `phpyun_zhaopinhui_pic` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default '0',
  `pic` varchar(200) default '0',
  `sort` int(11) default '0',
  `zid` int(11) default '0',
  `is_themb` int(5) default '0',
  `did` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1;
