/*
SQLyog Ultimate v11.42 (64 bit)
MySQL - 5.5.8-log : Database - phphr
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ysd` /*!40100 DEFAULT CHARACTER SET gbk */;

USE `ysd`;

/*Table structure for table `ysd_ad` */

DROP TABLE IF EXISTS `ysd_ad`;

CREATE TABLE `ysd_ad` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(100) NOT NULL,
  `did` varchar(100) NOT NULL DEFAULT '0',
  `time_start` varchar(100) NOT NULL,
  `time_end` varchar(100) NOT NULL,
  `ad_type` varchar(10) NOT NULL,
  `word_info` text NOT NULL,
  `word_url` varchar(100) NOT NULL,
  `pic_url` varchar(100) NOT NULL,
  `pic_src` varchar(100) NOT NULL,
  `pic_width` varchar(100) NOT NULL,
  `pic_height` varchar(100) NOT NULL,
  `flash_url` varchar(100) DEFAULT NULL,
  `flash_src` varchar(100) DEFAULT NULL,
  `flash_width` varchar(100) DEFAULT NULL,
  `flash_height` varchar(100) DEFAULT NULL,
  `class_id` int(20) DEFAULT NULL,
  `is_check` int(2) DEFAULT '0',
  `is_open` int(1) DEFAULT '0',
  `target` int(2) DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_ad` */

insert  into `ysd_ad`(`id`,`ad_name`,`did`,`time_start`,`time_end`,`ad_type`,`word_info`,`word_url`,`pic_url`,`pic_src`,`pic_width`,`pic_height`,`flash_url`,`flash_src`,`flash_width`,`flash_height`,`class_id`,`is_check`,`is_open`,`target`,`hits`,`remark`,`sort`) values (1,'首页幻灯一','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14428064404.JPG','http://www.phpyun.com','510','248',NULL,NULL,NULL,NULL,3,1,1,2,1,'',0),(2,'首页专题引导','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14382350059.JPG','http://www.phpyun.com','','',NULL,NULL,NULL,NULL,51,1,1,2,2,'',0),(3,'首页对联广告右','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14396433257.JPG','','','',NULL,NULL,NULL,NULL,11,1,1,2,0,'',0),(4,'首页对联广告左','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14435734889.GIF','','','',NULL,NULL,NULL,NULL,11,1,1,2,0,'',0),(5,'首页头部右侧广告','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14447101994.GIF','','','',NULL,NULL,NULL,NULL,52,1,1,2,1,'',0),(6,'会员登录页广告','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14434106119.JPG','','','',NULL,NULL,NULL,NULL,37,1,1,2,3,'',0),(7,'WAP幻灯一','0','2015-06-23','2017-06-30','pic','','','../data/upload/pimg/20150623/14412678513.PNG','','','',NULL,NULL,NULL,NULL,50,1,1,2,0,'',0);

/*Table structure for table `ysd_ad_class` */

DROP TABLE IF EXISTS `ysd_ad_class`;

CREATE TABLE `ysd_ad_class` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `orders` int(20) NOT NULL,
  `href` varchar(100) NOT NULL,
  `integral_buy` varchar(100) DEFAULT '0',
  `type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_ad_class` */

insert  into `ysd_ad_class`(`id`,`class_name`,`orders`,`href`,`integral_buy`,`type`) values (1,'首页中部图片广告 规格：宽154 高50',1,'','33',2),(3,'首页幻灯广告规格：宽510高248',2,'http://www.phpyun.com','100',1),(36,'人才列表右侧广告168*120',0,'','',2),(5,'首页收缩广告',5,'http://www.phpyun.com','55',1),(6,'首页横幅广告960X80',4,'http://www.phpyun.com','12',1),(7,'职位列表页广告',6,'http://www.phpyun.com','66',1),(8,'首页热门职位右侧广告285*51',1,'http://www.phpyun.com','1',1),(10,'网站底部浮动广告980*60',1,'http://www.phpyun.com','1',1),(11,'对联广告',1,'http://www.phpyun.com','0',1),(12,'首页最新人才右侧广告269*50',2,'http://www.phpyun.com','0',1),(13,'首页紧急招聘下横幅广告980*60',2,'http://www.phpyun.com','0',1),(14,'首页双联横幅广告497*78',11,'http://www.phpyun.com','0',1),(15,'首页紧急招聘下三联联横幅广告325*60',1,'http://www.phpyun.com','0',1),(35,'培训首页幻灯',0,'','',2),(27,'职位详情页右侧',1,'','',2),(29,'模板3中部广告1',29,'','100',1),(34,'积分商城首页幻灯',0,'http://www.phpyun.com','',2),(37,'登录页图片切换',1,'','',2),(39,'模板1_首页紧急招聘右侧图片',0,'','',2),(48,'问答首页横幅',0,'','',2),(50,'Wap站首页广告',0,'','',2),(51,'首页顶部横栏',1,'','',2),(52,'头部广告260*60',0,'','',2);

/*Table structure for table `ysd_adclick` */

DROP TABLE IF EXISTS `ysd_adclick`;

CREATE TABLE `ysd_adclick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_adclick` */

insert  into `ysd_adclick`(`id`,`aid`,`uid`,`ip`,`addtime`) values (1,1,0,'192.168.0.50',1438759725),(2,2,0,'192.168.0.77',1438839216),(3,6,0,'192.168.0.50',1438843413),(4,5,2,'192.168.0.44',1440128921),(5,6,0,'192.168.0.77',1442280382),(6,6,2,'192.168.0.44',1442487808);

/*Table structure for table `ysd_admin_announcement` */

DROP TABLE IF EXISTS `ysd_admin_announcement`;

CREATE TABLE `ysd_admin_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `did` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_announcement` */

/*Table structure for table `ysd_admin_config` */

DROP TABLE IF EXISTS `ysd_admin_config`;

CREATE TABLE `ysd_admin_config` (
  `name` varchar(255) NOT NULL,
  `config` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_config` */

insert  into `ysd_admin_config`(`name`,`config`) values ('sy_smtpemail',''),('sy_smtpuser',''),('sy_smtppass',''),('sy_smtpserverport','25'),('sy_msguser',''),('sy_msgpw',''),('sy_msgapi',''),('sy_hotkeyword',''),('sy_fkeyword',''),('sy_linksq','0'),('user_enforce_identitycert','0'),('com_enforce_emailcert','0'),('com_enforce_mobilecert','0'),('','0'),('com_enforce_setposition','0'),('lt_enforce_emailcert','0'),('lt_enforce_mobilecert','0'),('lt_enforce_licensecert','0'),('sy_apikey','php213yun'),('sy_webname','药师多'),('sy_weburl','http://www.yaoshiduo.com'),('sy_companydomain',''),('sy_webkeyword','PHP人才网站,药业人才网站'),('map_rating','15'),('sy_webmeta','PHP药业人才系统, 版权所有: QQ280913284'),('autodate','20150806'),('subscribe_time','1438840783'),('map_x','116.41363'),('map_y','39.910664'),('sy_webcopyright','Copyright C 20092014 All Rights Reserved 版权所有 QQ: 280913284'),('sy_webtongji',''),('sy_webemail','admin@admin.com'),('sy_webrecord','药师多'),('sy_webtel','400-880-5523'),('sy_freewebtel','400-880-5523'),('sy_webadd','药师多'),('sy_mapkey','{config[sy_mapkey]}'),('sy_companydir','company'),('sy_smtpserver',''),('code_width','75'),('code_height','35'),('code_strlength','4'),('code_filetype','jpg'),('code_type','3'),('code_web','注册会员,前台登陆,一句话招聘'),('sy_askdoamin',''),('sy_pxdir','train'),('sy_frienddomain',''),('sy_pxdomain',''),('paytype','1'),('alipay','1'),('tenpay','1'),('bank','1'),('style','default'),('integral_resume_top','50'),('sy_webclose','网站升级中请联系管理员！'),('sy_web_online','1'),('sy_istemplate','2'),('sy_uc_type',''),('user_number','5'),('user_sq_number','100'),('user_fav_number','100'),('user_pickb','2048'),('user_jobstatus','1'),('user_status','0'),('user_email','1'),('user_moblie','0'),('user_job','0'),('com_pickb','1024'),('com_jobstatus','0'),('com_email','1'),('com_moblie','1'),('integral_pricename','积分'),('integral_priceunit','个'),('com_integral_online','1'),('integral_resume','20'),('integral_job','100'),('integral_jobefresh','100'),('integral_jobedit','10'),('integral_interview','50'),('integral_reg','10'),('integral_proportion','20'),('integral_down_resume','50'),('sy_bannedip',''),('sy_fkeyword_all','***'),('sy_bannedip_alert','您的当前IP，该站已经禁止访问，请联系管理员处理。'),('sy_qqappid',''),('sy_qqappkey',''),('sy_qqlogin','0'),('sy_email_online','0'),('sy_email_yqms','2'),('sy_email_reg','2'),('sy_email_fkcg','2'),('sy_email_zzshtg','2'),('sy_email_sqzw','2'),('sy_msg_yqms','2'),('sy_msg_reg','2'),('sy_msg_fkcg','2'),('sy_msg_zzshtg','2'),('sy_msg_sqzw','2'),('sy_seo_rewrite','0'),('sy_msg_online','0'),('sy_email_getpass','2'),('sy_msg_getpass','2'),('com_rating','3'),('sy_logo','data/logo/20150505/14383375306.PNG'),('sy_member_logo','data/logo/20140306/13970739013.PNG'),('sy_unit_logo','data/logo/20150616/14392109489.PNG'),('map_control','1'),('map_control_type','4'),('map_control_xb','1'),('map_control_scale','1'),('sy_rz_logo','data/logo/20120723/13500058397.GIF'),('sy_email_cert','2'),('sy_msg_cert','2'),('sy_msgkey',''),('map_control_anchor','4'),('com_login_link','1'),('com_resume_link','1'),('com_fast_status','1'),('com_job_status','1'),('sy_web_site','0'),('sy_rand',''),('sy_email_zzshwtg','2'),('qqappkey',''),('qqappsecret',''),('qqopenid',''),('qqopenkey',''),('qqaccess_token',''),('sinaappkey',''),('sinaappsecret',''),('sinaopenid',''),('sinaopenkey',''),('sinaaccess_token',''),('sy_pw_type',''),('sy_qq','3367562'),('sy_indexcity',''),('sy_indexdomain',''),('sy_qqkey',''),('sy_sinakey',''),('alipaytype','3'),('com_status','1'),('user_imgwidth','80'),('user_imgheight','100'),('ismemcache','2'),('com_uppic','1024'),('issmartycache','2'),('memcachehost','127.0.0.1'),('memcacheport','11211'),('memcachetime','3600'),('smartycachetime','3600'),('com_urgent','20'),('com_message','1'),('user_report','0'),('com_report','1'),('sy_email_lock','2'),('user_idcard_status','0'),('com_cert_status','1'),('sy_email_comcert','2'),('sy_unit_icon','data/logo/20140420/14002532782.JPG'),('sy_email_usercert','2'),('sy_onedomain',''),('sy_msg_zzshwtg','2'),('sy_email_usercertq','1'),('sy_email_jobed','2'),('lt_job_status','0'),('user_wjl','1'),('com_recjob','10'),('sy_regname','admin,zhongguo'),('com_vip_type','2'),('sy_lt_logo','data/logo/20150511/14358166264.PNG'),('lt_status','0'),('lt_email','0'),('lt_moblie','0'),('integral_lt_jobefresh','20'),('integral_lt_jobedit','30'),('integral_lt_downresume','20'),('integral_lt_job','100'),('lt_rating','27'),('lt_cert_status','1'),('lt_recjob','5'),('sy_im_online','1'),('sy_im_user','shyflc'),('sy_im_type','1'),('sy_im_usertype','1,2,3,4,5'),('sy_im_comjob','2'),('sy_im_keyword','123'),('sy_im_fkeyword','***'),('sy_im_ltjob','4'),('sy_member_icon','data/logo/20141210/14204024737.JPG'),('sy_im_resume','1'),('sy_im_comname','1'),('sy_im_ltname','1'),('sy_friend_logo','data/logo/20130721/13756154999.PNG'),('integral_com_comments','1000'),('fast_status','0'),('sy_listnum','13'),('sy_email_userstatus','2'),('sy_sinalogin','0'),('sy_sinaappkey',''),('sy_sinaappid',''),('user_name','2'),('sy_usertype_1','0'),('lt_rebates_name','元'),('user_wjl_link','0'),('map_tocity','2'),('map_key','F9bfbeb26054d97898571a1df965d8af'),('sy_email_remind','2'),('sy_msg_remind','2'),('sy_msg_type','1'),('integral_msg_proportion','15'),('user_email_tx','1'),('user_msg_tx','1'),('com_email_dy','1'),('com_msg_dy','1'),('user_email_dy','1'),('user_msg_dy','0'),('sy_msg_comdy','2'),('sy_msg_userdy','2'),('sy_email_userdy','2'),('sy_email_comdy','2'),('webcachetime','0'),('webcache','2'),('sy_lt_icon','data/logo/20150605/14346751079.JPG'),('sy_friend_icon','data/logo/20150604/14400991697.PNG'),('sy_wzp_icon','data/logo/20140422/14046373798.JPG'),('wx_token',''),('wx_appid',''),('wx_appsecret',''),('user_trust_number','1'),('pay_trust_resume','200'),('user_trust_status','1'),('sy_safekey','p#getUcdlt'),('pytoken','0736687d3039'),('job_auto','50'),('user_enforce_mobilecert','1'),('sy_default_userclass','2'),('sy_default_comclass','2'),('crmpronid','1'),('user_height_resume','2'),('sy_com_invoice','1'),('com_transfer','1'),('yun_id','2'),('sy_def_email','@qq.com|@163.com|@126.com|@gmail.com|@hotmail.com|@sina.com|@sina.com.cn|@sina.cn|@sohu.com|@139.com|@yahoo.com|@aliyun.com'),('sy_tiny','2'),('sy_once','100'),('integral_zhiwei','0'),('integral_jianli','100'),('integral_xinwen','0'),('integral_product','0'),('integral_score','100'),('sy_email_notice','2'),('sy_msg_notice','2'),('user_finder','2'),('integral_job_type','2'),('integral_jobefresh_type','2'),('integral_jobedit_type','2'),('integral_down_resume_type','2'),('integral_interview_type','2'),('com_urgent_type','2'),('com_recjob_type','2'),('integral_com_comments_type','2'),('job_auto_type','2'),('sy_adclick','0'),('sy_wap_jump','1'),('integral_lt_job_type','2'),('integral_lt_jobefresh_type','2'),('integral_lt_jobedit_type','2'),('integral_lt_downresume_type','2'),('integral_reg_type','1'),('integral_login_type','1'),('integral_login','1'),('integral_userinfo_type','1'),('integral_userinfo','10'),('integral_emailcert_type','1'),('integral_emailcert','5'),('integral_mobliecert_type','1'),('integral_mobliecert','5'),('integral_avatar_type','1'),('integral_avatar','5'),('integral_question_type','1'),('integral_question','15'),('integral_answer_type','1'),('integral_answer','2'),('integral_answerpl_type','1'),('integral_answerpl','10'),('integral_friend_msg_type','1'),('integral_friend_msg','1'),('integral_friend_reply_type','1'),('integral_friend_reply','1'),('integral_invite_reg_type','1'),('integral_invite_reg','100'),('integral_map_type','1'),('integral_map','50'),('integral_banner_type','1'),('integral_banner','5'),('integral_license_cert_type','1'),('integral_license_cert','100'),('integral_ltcert_type','1'),('integral_ltcert','100'),('integral_comcert_type','1'),('integral_comcert','10'),('integral_add_resume','2'),('integral_add_resume_type','1'),('integral_identity','5'),('integral_identity_type','1'),('com_finder','3'),('sy_px_logo','data/logo/20141108/14179277635.PNG'),('wx_welcom',''),('wx_search',''),('wx_logo','14102668417.PNG'),('wx_rz','0'),('warning_addjob_type','2'),('warning_addjob','100'),('warning_downresume_type','2'),('warning_downresume','100'),('warning_addresume_type','2'),('warning_addresume','100'),('warning_recharge_type','1'),('warning_recharge','1000'),('sy_news_rewrite','1'),('sy_wx_logo','data/logo/20150613/14380796029.PNG'),('sy_wxlogin','0'),('sy_wxappkey',''),('sy_wxappid',''),('sy_header_fix','1'),('sy_wap_web','1'),('sy_friend_web','1'),('sy_ask_web','1'),('sy_lt_web','1'),('sy_px_web','1'),('sy_zhp_web','1'),('sy_wzp_web','1'),('sy_wjl_web','1'),('sy_gjx_web','1'),('sy_wapdomain',''),('sy_wap_logo','data/logo/20150525/14345913234.PNG'),('sy_msg_regcode','2'),('sy_px_icon','data/logo/20150617/14350320539.JPG'),('sy_wapdir','wap'),('sy_ltdir','lietou'),('sy_frienddir','friend'),('sy_askdir','ask'),('wx_xxtz','0'),('sy_ltdomain',''),('px_cert_status','1'),('user_resumetop','10'),('integral_resume_top_type','2'),('sy_redeem_web','2'),('reg_fast','0'),('reg_comaddress','0'),('reg_comlink','0'),('reg_passconfirm','1'),('reg_username','0'),('reg_useremail','0'),('reg_usertel','0'),('reg_comemail','0'),('reg_comtel','0'),('reg_comname','0'),('sy_px_banner','data/logo/20150617/14420961522.JPG'),('com_enforce_licensecert','0'),('subscribe_time','1434523473'),('px_status','1'),('sy_banner','data/logo/20150613/14420361529.jpg'),('sy_oncedir','once'),('sy_oncedomain',''),('sy_zphdomain',''),('sy_once_web','1'),('sy_zphdir','zph'),('sy_zph_web','1'),('subscribe_time','1434531773'),('subscribe_time','1434531024'),('sy_tiny_web','1'),('sy_train_web','1'),('sy_hr_web','2'),('sy_traindomain',''),('sy_redeemdomain',''),('sy_lietoudir','lietou'),('sy_lietoudomain',''),('sy_lietou_web','1'),('sy_redeemdir','redeem'),('sy_hrdir','hr'),('sy_hrdomain',''),('sy_tinydir','tiny'),('sy_tinydomain',''),('sy_traindir','train'),('subscribe_time','1434589739'),('sy_jobdir','job'),('sy_resumedir','resume'),('sy_articledomain',''),('sy_evaluate_web','2'),('subscribe_time','1434589572'),('sy_mapdomain',''),('subscribe_time','1434589245'),('sy_mapdir','map'),('sy_map_web','2'),('sy_evaluatedir','evaluate'),('sy_evaluatedomain',''),('sy_articledir','article'),('sy_article_web','1'),('sy_company_web','1'),('sy_resumedomain',''),('sy_resume_web','1'),('sy_jobdomain',''),('sy_wap_qcode','data/logo/20150623/14368316019.PNG'),('sy_wx_qcode','data/logo/20150623/14368616115.JPG'),('sy_job_web','1'),('subscribe_time',''),('autodate','20150805'),('subscribe_time','1438758992'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150805'),('autodate','20150806'),('subscribe_time','1438831308'),('autodate','20150806'),('subscribe_time','1438831310'),('autodate','20150806'),('subscribe_time','1438831311'),('autodate','20150806'),('subscribe_time','1438831312'),('autodate','20150806'),('subscribe_time','1438831313'),('autodate','20150806'),('subscribe_time','1438831314'),('autodate','20150806'),('subscribe_time','1438831315'),('autodate','20150806'),('subscribe_time','1438831316'),('autodate','20150806'),('subscribe_time','1438831318'),('autodate','20150806'),('subscribe_time','1438831319'),('autodate','20150806'),('subscribe_time','1438831320'),('autodate','20150806'),('subscribe_time','1438831321'),('autodate','20150806'),('subscribe_time','1438831322'),('autodate','20150806'),('subscribe_time','1438831323'),('autodate','20150806'),('subscribe_time','1438831324'),('autodate','20150806'),('subscribe_time','1438831325'),('autodate','20150806'),('subscribe_time','1438831329'),('autodate','20150806'),('subscribe_time','1438831330'),('autodate','20150806'),('subscribe_time','1438831340'),('autodate','20150806'),('subscribe_time','1438831343'),('autodate','20150806'),('subscribe_time','1438831343'),('autodate','20150806'),('subscribe_time','1438831343'),('autodate','20150806'),('subscribe_time','1438831343'),('autodate','20150806'),('subscribe_time','1438831343'),('autodate','20150806'),('subscribe_time','1438831344'),('autodate','20150806'),('subscribe_time','1438831344'),('autodate','20150806'),('subscribe_time','1438831344'),('autodate','20150806'),('subscribe_time','1438831689'),('autodate','20150806'),('subscribe_time','1438831692'),('autodate','20150806'),('subscribe_time','1438831693'),('autodate','20150806'),('subscribe_time','1438831748'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831749'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831750'),('autodate','20150806'),('subscribe_time','1438831751'),('autodate','20150806'),('subscribe_time','1438831751'),('autodate','20150806'),('subscribe_time','1438831838'),('autodate','20150806'),('subscribe_time','1438831838'),('autodate','20150806'),('subscribe_time','1438831838'),('autodate','20150806'),('subscribe_time','1438831838'),('autodate','20150806'),('subscribe_time','1438831838'),('autodate','20150806'),('subscribe_time','1438831839'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831840'),('autodate','20150806'),('subscribe_time','1438831841'),('autodate','20150806'),('subscribe_time','1438831844'),('autodate','20150806'),('subscribe_time','1438831971'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831972'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831973'),('autodate','20150806'),('subscribe_time','1438831974'),('autodate','20150806'),('subscribe_time','1438832061'),('autodate','20150806'),('subscribe_time','1438832063'),('autodate','20150806'),('subscribe_time','1438832114'),('autodate','20150806'),('subscribe_time','1438832114'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832115'),('autodate','20150806'),('subscribe_time','1438832117'),('autodate','20150806'),('subscribe_time','1438832123'),('autodate','20150806'),('subscribe_time','1438832125'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('subscribe_time','1438840783'),('autodate','20150806'),('subscribe_time','1438840787'),('autodate','20150806'),('subscribe_time','1438840788'),('autodate','20150806'),('subscribe_time','1438840788'),('autodate','20150806'),('subscribe_time','1438840799'),('autodate','20150806'),('subscribe_time','1438840807'),('autodate','20150806'),('subscribe_time','1438840811'),('autodate','20150806'),('subscribe_time','1438840821'),('autodate','20150806'),('autodate','20150806'),('subscribe_time','1438840824'),('subscribe_time','1438840824'),('autodate','20150806'),('subscribe_time','1438840824'),('autodate','20150806'),('subscribe_time','1438840825'),('autodate','20150806'),('subscribe_time','1438840825'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('autodate','20150806'),('subscribe_time','1438843794'),('autodate','20150806'),('autodate','20150806'),('subscribe_time','1438856508'),('autodate','20150806'),('autodate','20150807'),('subscribe_time','1438909184'),('autodate','20150807'),('subscribe_time','1438909186'),('autodate','20150807'),('autodate','20150807'),('autodate','20150807'),('subscribe_time','1438909522'),('autodate','20150807'),('autodate','20150807'),('subscribe_time','1438913397'),('autodate','20150807'),('autodate','20150807'),('autodate','20150821'),('subscribe_time','1440119947'),('autodate','20150821'),('subscribe_time','1440119949'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('subscribe_time','1440121239'),('autodate','20150821'),('subscribe_time','1440121239'),('autodate','20150821'),('subscribe_time','1440121240'),('autodate','20150821'),('subscribe_time','1440121240'),('autodate','20150821'),('subscribe_time','1440121244'),('autodate','20150821'),('subscribe_time','1440121244'),('autodate','20150821'),('subscribe_time','1440121245'),('autodate','20150821'),('subscribe_time','1440121246'),('autodate','20150821'),('subscribe_time','1440121247'),('autodate','20150821'),('subscribe_time','1440121293'),('autodate','20150821'),('subscribe_time','1440121293'),('autodate','20150821'),('subscribe_time','1440122093'),('autodate','20150821'),('subscribe_time','1440122093'),('autodate','20150821'),('subscribe_time','1440122097'),('autodate','20150821'),('subscribe_time','1440122098'),('autodate','20150821'),('subscribe_time','1440122170'),('autodate','20150821'),('subscribe_time','1440122562'),('autodate','20150821'),('subscribe_time','1440122562'),('autodate','20150821'),('subscribe_time','1440122562'),('autodate','20150821'),('subscribe_time','1440122562'),('autodate','20150821'),('subscribe_time','1440122565'),('autodate','20150821'),('subscribe_time','1440122565'),('autodate','20150821'),('subscribe_time','1440122790'),('autodate','20150821'),('subscribe_time','1440122790'),('autodate','20150821'),('subscribe_time','1440122792'),('autodate','20150821'),('subscribe_time','1440122792'),('autodate','20150821'),('subscribe_time','1440122793'),('autodate','20150821'),('subscribe_time','1440122793'),('autodate','20150821'),('subscribe_time','1440122813'),('autodate','20150821'),('subscribe_time','1440122842'),('autodate','20150821'),('subscribe_time','1440122842'),('autodate','20150821'),('subscribe_time','1440122842'),('autodate','20150821'),('subscribe_time','1440122843'),('autodate','20150821'),('subscribe_time','1440122844'),('autodate','20150821'),('subscribe_time','1440122844'),('autodate','20150821'),('subscribe_time','1440124861'),('autodate','20150821'),('subscribe_time','1440124863'),('autodate','20150821'),('subscribe_time','1440124945'),('autodate','20150821'),('subscribe_time','1440124946'),('autodate','20150821'),('subscribe_time','1440124982'),('autodate','20150821'),('subscribe_time','1440124982'),('autodate','20150821'),('subscribe_time','1440124985'),('autodate','20150821'),('subscribe_time','1440124986'),('autodate','20150821'),('subscribe_time','1440124987'),('autodate','20150821'),('subscribe_time','1440124993'),('autodate','20150821'),('subscribe_time','1440124993'),('autodate','20150821'),('subscribe_time','1440124995'),('autodate','20150821'),('subscribe_time','1440124995'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('subscribe_time','1440126654'),('autodate','20150821'),('subscribe_time','1440126655'),('autodate','20150821'),('autodate','20150821'),('autodate','20150821'),('autodate','20150824'),('subscribe_time','1440381047'),('autodate','20150824'),('subscribe_time','1440381047'),('autodate','20150824'),('subscribe_time','1440381049'),('autodate','20150824'),('subscribe_time','1440381049'),('autodate','20150824'),('subscribe_time','1440381050'),('autodate','20150824'),('subscribe_time','1440381053'),('autodate','20150824'),('subscribe_time','1440381053'),('autodate','20150824'),('subscribe_time','1440381054'),('autodate','20150824'),('subscribe_time','1440381055'),('autodate','20150824'),('subscribe_time','1440381071'),('autodate','20150824'),('subscribe_time','1440381071'),('autodate','20150824'),('subscribe_time','1440381080'),('autodate','20150824'),('subscribe_time','1440381080'),('autodate','20150824'),('subscribe_time','1440381083'),('autodate','20150824'),('autodate','20150824'),('subscribe_time','1440381085'),('autodate','20150824'),('subscribe_time','1440381086'),('autodate','20150824'),('subscribe_time','1440381088'),('autodate','20150824'),('subscribe_time','1440381088'),('autodate','20150824'),('subscribe_time','1440381095'),('autodate','20150824'),('subscribe_time','1440381099'),('autodate','20150824'),('subscribe_time','1440381099'),('autodate','20150824'),('subscribe_time','1440381099'),('autodate','20150824'),('subscribe_time','1440381099'),('autodate','20150824'),('subscribe_time','1440381101'),('autodate','20150824'),('subscribe_time','1440381101'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('subscribe_time','1440409643'),('autodate','20150824'),('subscribe_time','1440409644'),('autodate','20150824'),('autodate','20150824'),('autodate','20150824'),('autodate','20150825'),('subscribe_time','1440494879'),('autodate','20150825'),('subscribe_time','1440494880'),('autodate','20150825'),('autodate','20150825'),('autodate','20150828'),('subscribe_time','1440751745'),('autodate','20150828'),('autodate','20150831'),('subscribe_time','1440986092'),('autodate','20150831'),('subscribe_time','1440986093'),('autodate','20150831'),('subscribe_time','1440986113'),('autodate','20150831'),('subscribe_time','1440986114'),('autodate','20150831'),('autodate','20150831'),('autodate','20150901'),('subscribe_time','1441069546'),('autodate','20150901'),('subscribe_time','1441069546'),('autodate','20150901'),('subscribe_time','1441069553'),('autodate','20150901'),('subscribe_time','1441069554'),('autodate','20150901'),('subscribe_time','1441069580'),('autodate','20150901'),('subscribe_time','1441069580'),('autodate','20150901'),('subscribe_time','1441069604'),('autodate','20150901'),('subscribe_time','1441069605'),('autodate','20150901'),('autodate','20150901'),('subscribe_time','1441071626'),('autodate','20150901'),('autodate','20150906'),('subscribe_time','1441503383'),('autodate','20150906'),('subscribe_time','1441503384'),('autodate','20150906'),('subscribe_time','1441503390'),('autodate','20150906'),('subscribe_time','1441503390'),('autodate','20150906'),('subscribe_time','1441503402'),('autodate','20150906'),('subscribe_time','1441503403'),('autodate','20150906'),('subscribe_time','1441503415'),('autodate','20150906'),('subscribe_time','1441503416'),('autodate','20150906'),('subscribe_time','1441503420'),('autodate','20150906'),('subscribe_time','1441503420'),('autodate','20150906'),('subscribe_time','1441503424'),('autodate','20150906'),('subscribe_time','1441503425'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('subscribe_time','1441509530'),('autodate','20150906'),('subscribe_time','1441509532'),('autodate','20150906'),('autodate','20150906'),('autodate','20150906'),('autodate','20150907'),('subscribe_time','1441588284'),('autodate','20150907'),('autodate','20150907'),('subscribe_time','1441589178'),('autodate','20150907'),('subscribe_time','1441589178'),('autodate','20150907'),('subscribe_time','1441589180'),('autodate','20150907'),('subscribe_time','1441589180'),('autodate','20150907'),('subscribe_time','1441589183'),('autodate','20150907'),('subscribe_time','1441589183'),('autodate','20150907'),('subscribe_time','1441589190'),('autodate','20150907'),('subscribe_time','1441589190'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('autodate','20150907'),('subscribe_time','1441612197'),('autodate','20150907'),('subscribe_time','1441612220'),('autodate','20150907'),('autodate','20150908'),('subscribe_time','1441680878'),('autodate','20150908'),('subscribe_time','1441680879'),('autodate','20150908'),('subscribe_time','1441680881'),('autodate','20150908'),('subscribe_time','1441680881'),('autodate','20150908'),('subscribe_time','1441680884'),('autodate','20150908'),('subscribe_time','1441680885'),('autodate','20150908'),('subscribe_time','1441680890'),('autodate','20150908'),('subscribe_time','1441680891'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('subscribe_time','1441682378'),('autodate','20150908'),('autodate','20150908'),('subscribe_time','1441710839'),('autodate','20150908'),('subscribe_time','1441710840'),('autodate','20150908'),('subscribe_time','1441710845'),('autodate','20150908'),('subscribe_time','1441710846'),('autodate','20150908'),('subscribe_time','1441710846'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150908'),('autodate','20150909'),('subscribe_time','1441782775'),('autodate','20150909'),('subscribe_time','1441782775'),('autodate','20150909'),('subscribe_time','1441782779'),('autodate','20150909'),('subscribe_time','1441782780'),('autodate','20150909'),('subscribe_time','1441782782'),('autodate','20150909'),('subscribe_time','1441782782'),('autodate','20150909'),('subscribe_time','1441782803'),('autodate','20150909'),('subscribe_time','1441782804'),('autodate','20150909'),('subscribe_time','1441782804'),('autodate','20150909'),('subscribe_time','1441782818'),('autodate','20150909'),('subscribe_time','1441782818'),('autodate','20150909'),('subscribe_time','1441782818'),('autodate','20150909'),('subscribe_time','1441782823'),('autodate','20150909'),('subscribe_time','1441782824'),('autodate','20150909'),('subscribe_time','1441782831'),('autodate','20150909'),('autodate','20150910'),('subscribe_time','1441887702'),('autodate','20150910'),('subscribe_time','1441887704'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150910'),('autodate','20150911'),('subscribe_time','1441933731'),('autodate','20150911'),('subscribe_time','1441933732'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('subscribe_time','1441934371'),('autodate','20150911'),('subscribe_time','1441934372'),('autodate','20150911'),('subscribe_time','1441934378'),('autodate','20150911'),('subscribe_time','1441934379'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('autodate','20150911'),('subscribe_time','1441938155'),('autodate','20150911'),('subscribe_time','1441938155'),('autodate','20150911'),('autodate','20150911'),('autodate','20150914'),('subscribe_time','1442192637'),('autodate','20150914'),('subscribe_time','1442192637'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('subscribe_time','1442223907'),('autodate','20150914'),('subscribe_time','1442223909'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('subscribe_time','1442225729'),('autodate','20150914'),('subscribe_time','1442225729'),('autodate','20150914'),('subscribe_time','1442225760'),('autodate','20150914'),('subscribe_time','1442225761'),('autodate','20150914'),('subscribe_time','1442225761'),('autodate','20150914'),('subscribe_time','1442225769'),('autodate','20150914'),('subscribe_time','1442225769'),('autodate','20150914'),('subscribe_time','1442225781'),('autodate','20150914'),('subscribe_time','1442225781'),('autodate','20150914'),('subscribe_time','1442227491'),('autodate','20150914'),('subscribe_time','1442227491'),('autodate','20150914'),('subscribe_time','1442227513'),('autodate','20150914'),('subscribe_time','1442227513'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150914'),('autodate','20150915'),('subscribe_time','1442278122'),('autodate','20150915'),('subscribe_time','1442278124'),('autodate','20150915'),('autodate','20150915'),('autodate','20150915'),('subscribe_time','1442279511'),('autodate','20150915'),('subscribe_time','1442279512'),('autodate','20150915'),('subscribe_time','1442279539'),('autodate','20150915'),('subscribe_time','1442279539'),('autodate','20150915'),('subscribe_time','1442279540'),('autodate','20150915'),('autodate','20150915'),('autodate','20150916'),('autodate','20150916'),('subscribe_time','1442366771'),('subscribe_time','1442366771'),('autodate','20150916'),('autodate','20150916'),('autodate','20150916'),('subscribe_time','1442391457'),('autodate','20150916'),('subscribe_time','1442391458'),('autodate','20150916'),('autodate','20150916'),('autodate','20150917'),('autodate','20150917'),('subscribe_time','1442458082'),('subscribe_time','1442458082'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('subscribe_time','1442470046'),('subscribe_time','1442470046'),('autodate','20150917'),('subscribe_time','1442470049'),('autodate','20150917'),('subscribe_time','1442470071'),('autodate','20150917'),('subscribe_time','1442470073'),('autodate','20150917'),('subscribe_time','1442470073'),('autodate','20150917'),('subscribe_time','1442470085'),('autodate','20150917'),('subscribe_time','1442470086'),('autodate','20150917'),('subscribe_time','1442470087'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('subscribe_time','1442470605'),('autodate','20150917'),('subscribe_time','1442470609'),('autodate','20150917'),('subscribe_time','1442470613'),('autodate','20150917'),('subscribe_time','1442470615'),('autodate','20150917'),('subscribe_time','1442470628'),('autodate','20150917'),('subscribe_time','1442470631'),('autodate','20150917'),('subscribe_time','1442470634'),('autodate','20150917'),('subscribe_time','1442470644'),('autodate','20150917'),('subscribe_time','1442470646'),('autodate','20150917'),('subscribe_time','1442470654'),('autodate','20150917'),('subscribe_time','1442470656'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150917'),('autodate','20150918'),('subscribe_time','1442538050'),('autodate','20150918'),('subscribe_time','1442538051'),('autodate','20150918'),('subscribe_time','1442538063'),('autodate','20150918'),('subscribe_time','1442538063'),('autodate','20150918'),('subscribe_time','1442538069'),('autodate','20150918'),('subscribe_time','1442538070'),('autodate','20150918'),('subscribe_time','1442538084'),('autodate','20150918'),('subscribe_time','1442538084'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('subscribe_time','1442538426'),('subscribe_time','1442538426'),('autodate','20150918'),('subscribe_time','1442538428'),('autodate','20150918'),('subscribe_time','1442538430'),('autodate','20150918'),('subscribe_time','1442538586'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918'),('autodate','20150918');

/*Table structure for table `ysd_admin_link` */

DROP TABLE IF EXISTS `ysd_admin_link`;

CREATE TABLE `ysd_admin_link` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(50) NOT NULL,
  `link_url` varchar(50) NOT NULL,
  `img_type` int(30) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `link_type` varchar(1) NOT NULL,
  `link_state` int(1) NOT NULL DEFAULT '0',
  `link_sorting` int(8) NOT NULL DEFAULT '0',
  `link_time` varchar(20) NOT NULL,
  `did` int(11) NOT NULL,
  `tem_type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_link` */

insert  into `ysd_admin_link`(`id`,`link_name`,`link_url`,`img_type`,`pic`,`link_type`,`link_state`,`link_sorting`,`link_time`,`did`,`tem_type`) values (1,'药师多药业系统','http://www.yaoshiduo.com',0,'','1',1,9,'1330695646',0,3),(2,'药师多药业招聘系统','http://www.yaoshiduo.com',0,'','1',1,1,'1330828266',8,2),(3,'药师多系统','http://www.yaoshiduo.com',0,'','1',1,0,'1356609401',8,3),(4,'药师多招聘系统','http://www.yaoshiduo.com',1,'data/upload/link/20140523/14072507114.JPG','2',1,0,'1375926679',0,1);

/*Table structure for table `ysd_admin_log` */

DROP TABLE IF EXISTS `ysd_admin_log`;

CREATE TABLE `ysd_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `content` text,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_log` */

insert  into `ysd_admin_log`(`id`,`uid`,`username`,`content`,`ctime`) values (1,1,'admin','企业会员审核(ID:3)设置成功！',1441012170),(2,1,'admin','职位(ID:1)发布成功！',1441012221),(3,1,'admin','更新成功！',1441511492),(4,1,'admin','网站导航(ID:45)更新成功！',1441539086),(5,1,'admin','网站导航(ID:17)更新成功！',1441539120),(6,1,'admin','网站导航(ID:17)更新成功！',1441539163),(7,1,'admin','网站导航(ID:15)更新成功！',1441539175),(8,1,'admin','网站导航(ID:4)更新成功！',1441539209),(9,1,'admin','行业类别(ID:35)修改类别名称！',1441589055),(10,1,'admin','模块设置修改成功！',1441589132),(11,1,'admin','职位(ID:2)发布成功！',1441613646),(12,1,'admin','会员(ID:14)添加成功',1441887968),(13,1,'admin','职位(ID:3)发布成功！',1441888026),(14,1,'admin','行业类别(ID:35)修改类别名称！',1441938455),(15,1,'admin','问答分类(ID:45)删除成功！',1441941072),(16,1,'admin','个人会员(ID:2)修改成功',1442304253),(17,1,'admin','修改简历(ID:1)',1442304306),(18,1,'admin','个人会员(ID:2)修改成功',1442478954);

/*Table structure for table `ysd_admin_navigation` */

DROP TABLE IF EXISTS `ysd_admin_navigation`;

CREATE TABLE `ysd_admin_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `keyid` int(11) DEFAULT '0',
  `url` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_bin DEFAULT NULL,
  `menu` int(1) DEFAULT NULL,
  `classname` varchar(100) DEFAULT '0',
  `sort` int(5) DEFAULT '0',
  `display` int(1) DEFAULT NULL,
  `dids` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1339 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_navigation` */

insert  into `ysd_admin_navigation`(`id`,`name`,`keyid`,`url`,`menu`,`classname`,`sort`,`display`,`dids`) values (1,'系统',0,'',0,'system',18,0,0),(3,'个人',0,'',0,'user',16,0,1),(5,'生成',0,'',0,'generate',7,0,0),(6,'运营',0,'',0,'operations',6,0,1),(127,'工具',0,'',0,'tool',1,0,0),(8,'系统设置',1,'',0,NULL,4,0,0),(134,'公告管理',124,'index.php?m=admin_announcement',0,NULL,1,0,1),(11,'网站设置',8,'index.php?m=config',2,NULL,10,0,0),(141,'发送邮件',137,'index.php?m=email',0,NULL,0,0,1),(85,'企业会员分类',80,'index.php?m=comclass',1,NULL,2,0,0),(142,'新闻首页',49,'index.php?m=cache&c=news',1,NULL,7,0,0),(1244,'一键更新',49,'index.php?m=cache&c=all',2,'',0,0,0),(10,'企业',0,'',0,'com',17,0,1),(1240,'企业管理',10,NULL,NULL,'0',0,0,1),(35,'个人用户',3,'',0,NULL,0,0,1),(78,'类别',0,'',0,'column',8,0,0),(38,'个人用户列表',35,'index.php?m=user_member',1,'',10,0,1),(133,'新闻管理',124,'index.php?m=admin_news',2,'',11,0,1),(143,'风格管理',128,'index.php?m=admin_style',1,NULL,0,0,0),(80,'类别管理',78,'',0,NULL,0,0,0),(135,'单页面管理',124,'index.php?m=description',1,NULL,1,0,1),(136,'企业用户列表',1240,'index.php?m=com_member',1,NULL,0,1,1),(138,'广告管理',13,'index.php?m=advertise',1,'',7,0,1),(49,'页面生成',5,'',0,'',0,0,0),(50,'生成缓存',49,'index.php?m=cache&c=cache',1,NULL,4,0,0),(128,'网站工具',127,'',0,'',0,0,0),(144,'职位类别管理',80,'index.php?m=admin_job',1,NULL,3,0,0),(86,'城市管理',80,'index.php?m=admin_city',1,NULL,5,0,0),(122,'支付设置',8,'index.php?m=payconfig',1,NULL,3,0,0),(137,'运营管理',6,'',0,NULL,0,0,1),(124,'新闻管理',9,'',0,NULL,0,0,1),(126,'用户设置',8,'index.php?m=userconfig',1,NULL,0,0,0),(103,'图片上传',89,'admin_uploadpic.php',1,NULL,7,1,0),(104,'个人会员分类',80,'index.php?m=userclass',1,NULL,9,0,0),(129,'模板管理',128,'index.php?m=admin_template',1,NULL,0,0,0),(1312,'我的帐号',1306,'index.php?m=admin_user&c=myuser',2,'0',10,0,0),(139,'友情链接',137,'index.php?m=link',0,NULL,0,0,1),(145,'行业管理',80,'index.php?m=industry',1,NULL,4,1,0),(146,'导航设置',8,'index.php?m=navigation',2,'',7,0,0),(147,'数据库',128,'index.php?m=database',0,NULL,0,0,0),(148,'整合论坛',128,'index.php?m=admin_uc',1,'',4,0,0),(149,'微招聘',1240,'index.php?m=admin_once',1,'',9,0,1),(150,'简历管理',35,'index.php?m=admin_resume',2,'',9,0,1),(151,'公司管理',1240,'index.php?m=admin_company',1,'',15,0,1),(152,'职位管理',1240,'index.php?m=admin_company_job',1,'',14,0,1),(155,'充值记录',137,'index.php?m=company_order',1,NULL,0,0,1),(156,'消费记录',137,'index.php?m=company_pay',0,NULL,0,0,1),(157,'邮件设置',8,'index.php?m=emailconfig',1,NULL,6,0,0),(158,'短信设置',8,'index.php?m=msgconfig',1,NULL,6,0,0),(159,'快捷登录',128,'index.php?m=qqconfig',1,'',3,0,0),(162,'后台充值',137,'index.php?m=recharge',0,NULL,0,0,1),(163,'短信群发',137,'index.php?m=information',0,NULL,0,0,1),(164,'首页生成',49,'index.php?m=cache&c=index',2,'',10,0,0),(168,'新闻类别',49,'index.php?m=cache&c=newsclass',1,'',6,0,0),(167,'新闻详细页',49,'index.php?m=cache&c=archive',1,'',5,0,0),(169,'关键字管理',137,'index.php?m=admin_keyword',1,NULL,6,0,1),(171,'留言反馈',1216,'index.php?m=admin_message',2,'',1,0,0),(172,'短信记录',137,'index.php?m=mobliemsg',0,NULL,3,0,1),(173,'名企招聘',1240,'index.php?m=hotjob',1,NULL,0,1,1),(174,'企业认证审核',1240,'index.php?m=comcert',1,'',10,0,1),(176,'SEO设置',8,'index.php?m=seo',1,NULL,3,0,0),(177,'数据采集',128,'index.php?m=collection',0,NULL,0,0,0),(178,'分站管理',128,'index.php?m=admin_domain',1,NULL,0,0,0),(179,'企业模板',128,'index.php?m=comtpl',NULL,NULL,5,0,0),(1239,'微信客户端',128,'index.php?m=wx',NULL,'',0,0,0),(1238,'管理员日志',1306,'index.php?m=admin_log',NULL,'',0,0,0),(1267,'招聘会列表',1266,'index.php?m=zhaopinhui',0,'0',10,0,1),(1268,'添加招聘会',1266,'index.php?m=zhaopinhui&c=add',0,'0',9,0,1),(1266,'招聘会管理',2,NULL,0,'0',0,0,1),(188,'企业新闻管理',1240,'index.php?m=comnews',1,'',12,0,1),(189,'企业产品管理',1240,'index.php?m=comproduct',1,'',13,0,1),(2,'招聘会',0,'',0,'zph',12,0,1),(1269,'参会企业',1266,'index.php?m=zhaopinhui&c=com',0,'0',8,0,1),(1270,'积分设置',8,'index.php?m=integral',0,'0',0,0,0),(170,'行业类别',80,'index.php?m=admin_industry',2,NULL,4,0,0),(195,'个人认证审核',35,'index.php?m=usercert',0,NULL,6,0,1),(1197,'求职咨询',35,'index.php?m=admin_msg',0,NULL,2,0,0),(1203,'微简历',35,'index.php?m=admin_tiny',0,NULL,4,0,0),(1210,'社交',0,'',0,'social',11,0,0),(9,'新闻',0,'',0,'news',13,0,1),(1212,'问答管理',1216,'index.php?m=admin_question',1,'',0,0,0),(1213,'问答类别',80,'index.php?m=question_class',NULL,NULL,0,0,0),(1216,'社交',1210,'',0,'',0,0,0),(1217,'留言管理',1216,'index.php?m=friend_message',NULL,'',0,0,0),(1218,'动态管理',1216,'index.php?m=friend_state',NULL,'',0,0,0),(1219,'举报原因管理',80,'index.php?m=admin_reason',1,'',0,0,0),(1220,'数据调用',128,'index.php?m=datacall',1,'',0,0,0),(1223,'举报管理',137,'index.php?m=report',1,'',0,0,1),(1225,'举报管理',137,'index.php?m=report&type=0',1,'',0,1,1),(1234,'企业评论',1240,'index.php?m=com_pl',1,'0',11,0,1),(1243,'计划任务',128,'index.php?m=cron',NULL,'',5,0,0),(1260,'简历下载记录',35,'index.php?m=down',1,'0',1,0,1),(1261,'职位申请记录',1240,'index.php?m=apply',1,'0',1,0,1),(1262,'邀请面试记录',1240,'index.php?m=invite',1,'0',1,0,1),(1264,'会员日志',1216,'index.php?m=member_log',0,'0',0,0,0),(1271,'企业会员等级',1240,'index.php?m=admin_company_rating',NULL,'0',0,0,1),(1273,'邮件记录',137,'index.php?m=emailmsg',0,'0',0,0,1),(1274,'兑换奖品管理',1284,'index.php?m=reward',NULL,'0',0,0,0),(1276,'工具箱',124,'index.php?m=hr',NULL,'',6,0,1),(1277,'单页面生成',49,'index.php?m=cache&c=once',1,'0',2,0,0),(1278,'添加新闻',124,'index.php?m=admin_news&c=news',1,'',10,0,1),(1280,'简历浏览记录',35,'index.php?m=look_resume',0,'0',0,0,1),(1281,'职位浏览记录',1240,'index.php?m=look_job',0,'0',0,0,1),(12,'广告',0,'',0,'ban',9,0,1),(13,'广告管理',12,NULL,0,'0',0,0,1),(14,'商城',0,'',0,'jf',10,0,0),(1284,'商城管理',14,NULL,0,'jifen',0,0,0),(1285,'广告类别',13,'index.php?m=advertise&c=class',0,'0',0,0,1),(1286,'添加广告',13,'index.php?m=advertise&c=ad_add',1,'0',6,0,1),(1287,'新闻类别',124,'index.php?m=admin_news&c=group',1,'0',8,0,1),(1327,'测评',0,NULL,0,'evaluate',0,0,0),(1328,'测评',1327,NULL,0,'0',0,0,0),(1329,'测评试卷列表',1328,'index.php?m=admin_evaluate',0,'0',5,0,0),(1330,'添加测评试卷',1328,'index.php?m=admin_evaluate&c=examup',0,'0',4,0,0),(1331,'测评类别管理',1328,'index.php?m=admin_evaluate&c=group',0,'0',3,0,0),(1292,'兑换奖品记录',1284,'index.php?m=reward_list',1,'0',9,0,0),(1302,'工具箱类别',124,'index.php?m=hrclass',1,'0',5,0,1),(1303,'单页面类别',80,'index.php?m=desc_class',0,'0',0,0,0),(1304,'预警管理',128,'index.php?m=warning',0,'0',0,0,0),(15,'管理员',0,NULL,0,'guanliyuan',0,0,0),(1306,'后台管理员',15,NULL,0,'0',0,0,0),(1307,'管理员列表',1306,'index.php?m=admin_user',1,'0',8,0,0),(1308,'添加管理员',1306,'index.php?m=admin_user&c=add',1,'0',7,0,0),(1309,'管理员类型',1306,'index.php?m=admin_user&c=group',0,'0',3,0,0),(1310,'添加管理员类型',1306,'index.php?m=admin_user&c=addgroup',0,'0',4,0,0),(1320,'订阅管理',137,'index.php?m=subscribe',1,'0',0,0,1),(1313,'生成XML',49,'index.php?m=admin_xml',0,'0',0,0,0),(1314,'修改我的密码',1306,'index.php?m=admin_user&c=pass',2,'0',9,0,0),(1315,'系统消息',1216,'index.php?m=sysnews',0,'0',0,0,0),(1316,'网站地图',8,'index.php?m=navmap',0,'0',0,0,0),(1319,'站内信',1216,'index.php?m=friend_letter',1,'0',0,0,0),(1318,'模块设置',8,'index.php?m=model_config',1,'0',9,0,0),(1321,'页面设置',8,'index.php?m=web_config',1,'0',8,0,0),(1325,'注册设置',8,'index.php?m=regset',0,'0',0,0,0),(1337,'专题招聘',1240,'index.php?m=special',0,'0',2,0,1),(1338,'回收站',128,'index.php?m=recycle',0,'0',0,0,0);

/*Table structure for table `ysd_admin_template` */

DROP TABLE IF EXISTS `ysd_admin_template`;

CREATE TABLE `ysd_admin_template` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tp_name` varchar(50) NOT NULL,
  `update_time` int(32) NOT NULL,
  `dir` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_template` */

/*Table structure for table `ysd_admin_user` */

DROP TABLE IF EXISTS `ysd_admin_user`;

CREATE TABLE `ysd_admin_user` (
  `uid` int(3) NOT NULL AUTO_INCREMENT,
  `m_id` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `did` int(11) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_user` */

insert  into `ysd_admin_user`(`uid`,`m_id`,`username`,`password`,`name`,`did`,`lasttime`) values (1,1,'admin','21232f297a57a5a743894a0e4a801fc3','超级管理员',0,1442487806);

/*Table structure for table `ysd_admin_user_group` */

DROP TABLE IF EXISTS `ysd_admin_user_group`;

CREATE TABLE `ysd_admin_user_group` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_power` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_admin_user_group` */

insert  into `ysd_admin_user_group`(`id`,`group_name`,`group_power`) values (1,'超级管理员','a:167:{i:0;s:1:\"1\";i:1;s:1:\"8\";i:2;s:2:\"11\";i:3;s:4:\"1318\";i:4;s:4:\"1321\";i:5;s:3:\"146\";i:6;s:3:\"157\";i:7;s:3:\"158\";i:8;s:3:\"176\";i:9;s:3:\"122\";i:10;s:4:\"1221\";i:11;s:4:\"1316\";i:12;s:4:\"1325\";i:13;s:4:\"1245\";i:14;s:3:\"126\";i:15;s:4:\"1270\";i:16;s:2:\"10\";i:17;s:4:\"1240\";i:18;s:3:\"151\";i:19;s:3:\"152\";i:20;s:3:\"189\";i:21;s:3:\"188\";i:22;s:4:\"1234\";i:23;s:3:\"174\";i:24;s:3:\"149\";i:25;s:4:\"1337\";i:26;s:4:\"1261\";i:27;s:4:\"1262\";i:28;s:4:\"1281\";i:29;s:4:\"1339\";i:30;s:4:\"1271\";i:31;s:1:\"3\";i:32;s:2:\"35\";i:33;s:2:\"38\";i:34;s:3:\"150\";i:35;s:3:\"195\";i:36;s:4:\"1241\";i:37;s:4:\"1203\";i:38;s:4:\"1197\";i:39;s:4:\"1260\";i:40;s:4:\"1323\";i:41;s:4:\"1280\";i:42;s:4:\"1199\";i:43;s:4:\"1200\";i:44;s:4:\"1201\";i:45;s:4:\"1208\";i:46;s:4:\"1207\";i:47;s:4:\"1209\";i:48;s:4:\"1229\";i:49;s:4:\"1340\";i:50;s:4:\"1272\";i:51;s:4:\"1293\";i:52;s:4:\"1294\";i:53;s:4:\"1297\";i:54;s:4:\"1301\";i:55;s:4:\"1299\";i:56;s:4:\"1300\";i:57;s:4:\"1296\";i:58;s:1:\"9\";i:59;s:3:\"124\";i:60;s:3:\"133\";i:61;s:4:\"1278\";i:62;s:4:\"1287\";i:63;s:4:\"1276\";i:64;s:4:\"1302\";i:65;s:3:\"135\";i:66;s:3:\"134\";i:67;s:1:\"2\";i:68;s:4:\"1266\";i:69;s:4:\"1267\";i:70;s:4:\"1268\";i:71;s:4:\"1269\";i:72;s:4:\"1210\";i:73;s:4:\"1216\";i:74;s:3:\"171\";i:75;s:4:\"1315\";i:76;s:4:\"1319\";i:77;s:4:\"1222\";i:78;s:4:\"1264\";i:79;s:4:\"1218\";i:80;s:4:\"1217\";i:81;s:4:\"1212\";i:82;s:2:\"14\";i:83;s:4:\"1284\";i:84;s:4:\"1292\";i:85;s:4:\"1288\";i:86;s:4:\"1305\";i:87;s:4:\"1274\";i:88;s:4:\"1275\";i:89;s:4:\"1279\";i:90;s:2:\"12\";i:91;s:2:\"13\";i:92;s:3:\"138\";i:93;s:4:\"1286\";i:94;s:4:\"1285\";i:95;s:3:\"161\";i:96;s:2:\"78\";i:97;s:2:\"80\";i:98;s:3:\"104\";i:99;s:2:\"86\";i:100;s:3:\"170\";i:101;s:3:\"144\";i:102;s:2:\"85\";i:103;s:4:\"1303\";i:104;s:4:\"1295\";i:105;s:4:\"1298\";i:106;s:4:\"1219\";i:107;s:4:\"1202\";i:108;s:4:\"1204\";i:109;s:4:\"1205\";i:110;s:4:\"1213\";i:111;s:1:\"5\";i:112;s:2:\"49\";i:113;s:3:\"164\";i:114;s:3:\"142\";i:115;s:3:\"168\";i:116;s:3:\"167\";i:117;s:2:\"50\";i:118;s:4:\"1277\";i:119;s:4:\"1313\";i:120;s:4:\"1244\";i:121;s:1:\"6\";i:122;s:3:\"137\";i:123;s:3:\"169\";i:124;s:3:\"172\";i:125;s:4:\"1320\";i:126;s:4:\"1322\";i:127;s:3:\"139\";i:128;s:3:\"155\";i:129;s:3:\"156\";i:130;s:3:\"162\";i:131;s:3:\"163\";i:132;s:3:\"141\";i:133;s:4:\"1223\";i:134;s:4:\"1273\";i:135;s:4:\"1237\";i:136;s:3:\"127\";i:137;s:3:\"128\";i:138;s:3:\"179\";i:139;s:4:\"1243\";i:140;s:3:\"148\";i:141;s:3:\"159\";i:142;s:4:\"1338\";i:143;s:4:\"1304\";i:144;s:3:\"147\";i:145;s:3:\"143\";i:146;s:3:\"160\";i:147;s:3:\"177\";i:148;s:3:\"178\";i:149;s:3:\"129\";i:150;s:4:\"1239\";i:151;s:4:\"1220\";i:152;s:4:\"1246\";i:153;s:4:\"1327\";i:154;s:4:\"1328\";i:155;s:4:\"1329\";i:156;s:4:\"1330\";i:157;s:4:\"1331\";i:158;s:2:\"15\";i:159;s:4:\"1306\";i:160;s:4:\"1312\";i:161;s:4:\"1314\";i:162;s:4:\"1307\";i:163;s:4:\"1308\";i:164;s:4:\"1310\";i:165;s:4:\"1309\";i:166;s:4:\"1238\";}');

/*Table structure for table `ysd_answer` */

DROP TABLE IF EXISTS `ysd_answer`;

CREATE TABLE `ysd_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment` int(11) NOT NULL DEFAULT '0',
  `support` int(11) NOT NULL DEFAULT '0',
  `oppose` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_answer` */

/*Table structure for table `ysd_answer_review` */

DROP TABLE IF EXISTS `ysd_answer_review`;

CREATE TABLE `ysd_answer_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `qid` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `support` int(11) DEFAULT '0',
  `content` text NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_answer_review` */

/*Table structure for table `ysd_atn` */

DROP TABLE IF EXISTS `ysd_atn`;

CREATE TABLE `ysd_atn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sc_uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `usertype` int(11) DEFAULT NULL,
  `sc_usertype` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_atn` */

/*Table structure for table `ysd_attention` */

DROP TABLE IF EXISTS `ysd_attention`;

CREATE TABLE `ysd_attention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text NOT NULL,
  `type` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_attention` */

/*Table structure for table `ysd_bank` */

DROP TABLE IF EXISTS `ysd_bank`;

CREATE TABLE `ysd_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `bank_number` varchar(200) DEFAULT NULL,
  `bank_address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_bank` */

/*Table structure for table `ysd_banner` */

DROP TABLE IF EXISTS `ysd_banner`;

CREATE TABLE `ysd_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_banner` */

/*Table structure for table `ysd_blacklist` */

DROP TABLE IF EXISTS `ysd_blacklist`;

CREATE TABLE `ysd_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_uid` int(11) DEFAULT NULL,
  `c_uid` int(11) DEFAULT NULL,
  `inputtime` int(11) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  `com_name` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_blacklist` */

/*Table structure for table `ysd_change` */

DROP TABLE IF EXISTS `ysd_change`;

CREATE TABLE `ysd_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `linktel` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `linkman` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `body` varchar(255) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `statusbody` text CHARACTER SET gbk COLLATE gbk_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_change` */

/*Table structure for table `ysd_city_class` */

DROP TABLE IF EXISTS `ysd_city_class`;

CREATE TABLE `ysd_city_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `letter` varchar(1) NOT NULL,
  `display` int(1) NOT NULL,
  `sitetype` int(2) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3409 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_city_class` */

insert  into `ysd_city_class`(`id`,`keyid`,`name`,`letter`,`display`,`sitetype`,`sort`) values (2,0,'北京','B',1,0,0),(3,0,'安徽','A',1,0,6),(4,0,'福建','F',1,0,7),(5,0,'甘肃','G',1,0,15),(6,0,'广东','G',1,0,6),(7,0,'广西','G',1,0,16),(8,0,'贵州','G',1,0,17),(9,0,'海南','H',1,0,18),(10,0,'河北','H',1,0,12),(11,0,'河南','H',1,0,13),(12,0,'黑龙江','H',1,0,9),(13,0,'湖北','H',1,0,10),(14,0,'湖南','H',1,0,11),(15,0,'吉林','J',1,0,19),(16,0,'江苏','J',1,0,4),(17,0,'江西','J',1,0,20),(18,0,'辽宁','L',1,0,8),(19,0,'内蒙古','N',1,0,27),(20,0,'宁夏','N',1,0,26),(21,0,'青海','Q',1,0,25),(22,0,'山东','S',1,0,24),(23,0,'山西','S',1,0,23),(24,0,'陕西','S',1,0,22),(25,0,'上海','S',1,0,2),(26,0,'四川','S',1,0,21),(27,0,'天津','T',1,0,1),(28,0,'西藏','X',1,0,28),(29,0,'新疆','X',1,0,29),(30,0,'云南','Y',1,0,14),(31,0,'浙江','Z',1,0,6),(32,0,'重庆','Z',1,0,3),(33,0,'香港','X',1,0,30),(34,0,'澳门','A',1,0,31),(35,0,'台湾','T',1,0,32),(36,3,'安庆','A',1,0,0),(37,3,'蚌埠','B',1,0,0),(38,3,'巢湖','C',1,0,0),(39,3,'池州','C',1,0,0),(40,3,'滁州','C',1,0,0),(41,3,'阜阳','F',1,0,0),(42,3,'淮北','H',1,0,0),(43,3,'淮南','H',1,0,0),(44,3,'黄山','H',1,0,0),(45,3,'六安','L',1,0,0),(46,3,'马鞍山','M',1,0,0),(47,3,'宿州','S',1,0,0),(48,3,'铜陵','T',1,0,0),(49,3,'芜湖','W',1,0,0),(50,3,'宣城','X',1,0,0),(51,3,'亳州','Z',1,0,0),(52,2,'北京','B',1,0,0),(53,4,'福州','F',1,0,0),(54,4,'龙岩','L',1,0,0),(55,4,'南平','N',1,0,0),(56,4,'宁德','N',1,0,0),(57,4,'莆田','P',1,0,0),(58,4,'泉州','Q',1,0,0),(59,4,'三明','S',1,0,0),(60,4,'厦门','X',1,0,0),(61,4,'漳州','Z',1,0,0),(62,5,'兰州','L',1,0,0),(63,5,'白银','B',1,0,0),(64,5,'定西','D',1,0,0),(65,5,'甘南','G',1,0,0),(66,5,'嘉峪关','J',1,0,0),(67,5,'金昌','J',1,0,0),(68,5,'酒泉','J',1,0,0),(69,5,'临夏','L',1,0,0),(70,5,'陇南','L',1,0,0),(71,5,'平凉','P',1,0,0),(72,5,'庆阳','Q',1,0,0),(73,5,'天水','T',1,0,0),(74,5,'武威','W',1,0,0),(75,5,'张掖','Z',1,0,0),(76,6,'广州','G',1,0,0),(77,6,'深圳','S',1,0,0),(78,6,'潮州','C',1,0,0),(79,6,'东莞','D',1,0,0),(80,6,'佛山','F',1,0,0),(81,6,'河源','H',1,0,0),(82,6,'惠州','H',1,0,0),(83,6,'江门','J',1,0,0),(84,6,'揭阳','J',1,0,0),(85,6,'茂名','M',1,0,0),(86,6,'梅州','M',1,0,0),(87,6,'清远','Q',1,0,0),(88,6,'汕头','S',1,0,0),(89,6,'汕尾','S',1,0,0),(90,6,'韶关','S',1,0,0),(91,6,'阳江','Y',1,0,0),(92,6,'云浮','Y',1,0,0),(93,6,'湛江','Z',1,0,0),(94,6,'肇庆','Z',1,0,0),(95,6,'中山','Z',1,0,0),(96,6,'珠海','Z',1,0,0),(97,7,'南宁','N',1,0,0),(98,7,'桂林','G',1,0,0),(99,7,'百色','B',1,0,0),(100,7,'北海','B',1,0,0),(101,7,'崇左','C',1,0,0),(102,7,'防城港','F',1,0,0),(103,7,'贵港','G',1,0,0),(104,7,'河池','H',1,0,0),(105,7,'贺州','H',1,0,0),(106,7,'来宾','L',1,0,0),(107,7,'柳州','L',1,0,0),(108,7,'钦州','Q',1,0,0),(109,7,'梧州','W',1,0,0),(110,7,'玉林','Y',1,0,0),(111,8,'贵阳','G',1,0,0),(112,8,'安顺','A',1,0,0),(113,8,'毕节','B',1,0,0),(114,8,'六盘水','L',1,0,0),(115,8,'黔东南','Q',1,0,0),(116,8,'黔南','Q',1,0,0),(117,8,'黔西南','Q',1,0,0),(118,8,'铜仁','T',1,0,0),(119,8,'遵义','Z',1,0,0),(120,9,'海口','H',1,0,0),(121,9,'三亚','S',1,0,0),(122,9,'白沙','B',1,0,0),(123,9,'保亭','B',1,0,0),(124,9,'昌江','C',1,0,0),(125,9,'澄迈县','C',1,0,0),(126,9,'定安县','D',1,0,0),(127,9,'东方','D',1,0,0),(128,9,'乐东','L',1,0,0),(129,9,'临高县','L',1,0,0),(130,9,'陵水','L',1,0,0),(131,9,'琼海','Q',1,0,0),(132,9,'琼中','Q',1,0,0),(133,9,'屯昌县','T',1,0,0),(134,9,'万宁','W',1,0,0),(135,9,'文昌','W',1,0,0),(136,9,'五指山','W',1,0,0),(137,9,'儋州','Z',1,0,0),(138,10,'石家庄','S',1,0,0),(139,10,'保定','B',1,0,0),(140,10,'沧州','C',1,0,0),(141,10,'承德','C',1,0,0),(142,10,'邯郸','H',1,0,0),(143,10,'衡水','H',1,0,0),(144,10,'廊坊','L',1,0,0),(145,10,'秦皇岛','Q',1,0,0),(146,10,'唐山','T',1,0,0),(147,10,'邢台','X',1,0,0),(148,10,'张家口','Z',1,0,0),(149,11,'郑州','Z',1,0,0),(150,11,'洛阳','L',1,0,0),(151,11,'开封','K',1,0,0),(152,11,'安阳','A',1,0,0),(153,11,'鹤壁','H',1,0,0),(154,11,'济源','J',1,0,0),(155,11,'焦作','J',1,0,0),(156,11,'南阳','N',1,0,0),(157,11,'平顶山','P',1,0,0),(158,11,'三门峡','S',1,0,0),(159,11,'商丘','S',1,0,0),(160,11,'新乡','X',1,0,0),(161,11,'信阳','X',1,0,0),(162,11,'许昌','X',1,0,0),(163,11,'周口','Z',1,0,0),(164,11,'驻马店','Z',1,0,0),(165,11,'漯河','Z',1,0,0),(166,11,'濮阳','Z',1,0,0),(167,12,'哈尔滨','H',1,0,0),(168,12,'大庆','D',1,0,0),(169,12,'大兴安岭','D',1,0,0),(170,12,'鹤岗','H',1,0,0),(171,12,'黑河','H',1,0,0),(172,12,'鸡西','J',1,0,0),(173,12,'佳木斯','J',1,0,0),(174,12,'牡丹江','M',1,0,0),(175,12,'七台河','Q',1,0,0),(176,12,'齐齐哈尔','Q',1,0,0),(177,12,'双鸭山','S',1,0,0),(178,12,'绥化','S',1,0,0),(179,12,'伊春','Y',1,0,0),(180,13,'武汉','W',1,0,0),(181,13,'仙桃','X',1,0,0),(182,13,'鄂州','E',1,0,0),(183,13,'黄冈','H',1,0,0),(184,13,'黄石','H',1,0,0),(185,13,'荆门','J',1,0,0),(186,13,'荆州','J',1,0,0),(187,13,'潜江','Q',1,0,0),(188,13,'神农架林区','S',1,0,0),(189,13,'十堰','S',1,0,0),(190,13,'随州','S',1,0,0),(191,13,'天门','T',1,0,0),(192,13,'咸宁','X',1,0,0),(193,13,'襄樊','X',1,0,0),(194,13,'孝感','X',1,0,0),(195,13,'宜昌','Y',1,0,0),(196,13,'恩施','E',1,0,0),(197,14,'长沙','C',1,0,0),(198,14,'张家界','Z',1,0,0),(199,14,'常德','C',1,0,0),(200,14,'郴州','C',1,0,0),(201,14,'衡阳','H',1,0,0),(202,14,'怀化','H',1,0,0),(203,14,'娄底','L',1,0,0),(204,14,'邵阳','S',1,0,0),(205,14,'湘潭','X',1,0,0),(206,14,'湘西','X',1,0,0),(207,14,'益阳','Y',1,0,0),(208,14,'永州','Y',1,0,0),(209,14,'岳阳','Y',1,0,0),(210,14,'株洲','Z',1,0,0),(211,15,'长春','C',1,0,0),(212,15,'吉林','J',1,0,0),(213,15,'白城','B',1,0,0),(214,15,'白山','B',1,0,0),(215,15,'辽源','L',1,0,0),(216,15,'四平','S',1,0,0),(217,15,'松原','S',1,0,0),(218,15,'通化','T',1,0,0),(219,15,'延边','Y',1,0,0),(220,16,'南京','N',1,0,0),(221,16,'苏州','S',1,0,0),(222,16,'无锡','W',1,0,0),(223,16,'常州','C',1,0,0),(224,16,'淮安','H',1,0,0),(225,16,'连云港','L',1,0,0),(226,16,'南通','N',1,0,0),(227,16,'宿迁','S',1,0,0),(228,16,'泰州','T',1,0,0),(229,16,'徐州','X',1,0,0),(230,16,'盐城','Y',1,0,0),(231,16,'扬州','Y',1,0,0),(232,16,'镇江','Z',1,0,0),(233,17,'南昌','N',1,0,0),(234,17,'抚州','F',1,0,0),(235,17,'赣州','G',1,0,0),(236,17,'吉安','J',1,0,0),(237,17,'景德镇','J',1,0,0),(238,17,'九江','J',1,0,0),(239,17,'萍乡','P',1,0,0),(240,17,'上饶','S',1,0,0),(241,17,'新余','X',1,0,0),(242,17,'宜春','Y',1,0,0),(243,17,'鹰潭','Y',1,0,0),(244,18,'沈阳','S',1,0,0),(245,18,'大连','D',1,0,0),(246,18,'鞍山','A',1,0,0),(247,18,'本溪','B',1,0,0),(248,18,'朝阳','C',1,0,0),(249,18,'丹东','D',1,0,0),(250,18,'抚顺','F',1,0,0),(251,18,'阜新','F',1,0,0),(252,18,'葫芦岛','H',1,0,0),(253,18,'锦州','J',1,0,0),(254,18,'辽阳','L',1,0,0),(255,18,'盘锦','P',1,0,0),(256,18,'铁岭','T',1,0,0),(257,18,'营口','Y',1,0,0),(258,19,'呼和浩特','H',1,0,0),(259,19,'阿拉善盟','A',1,0,0),(260,19,'巴彦淖尔盟','B',1,0,0),(261,19,'包头','B',1,0,0),(262,19,'赤峰','C',1,0,0),(263,19,'鄂尔多斯','E',1,0,0),(264,19,'呼伦贝尔','H',1,0,0),(265,19,'通辽','T',1,0,0),(266,19,'乌海','W',1,0,0),(267,19,'乌兰察布市','W',1,0,0),(268,19,'锡林郭勒盟','X',1,0,0),(269,19,'兴安盟','X',1,0,0),(270,20,'银川','Y',1,0,0),(271,20,'固原','G',1,0,0),(272,20,'石嘴山','S',1,0,0),(273,20,'吴忠','W',1,0,0),(274,20,'中卫','Z',1,0,0),(275,21,'西宁','X',1,0,0),(276,21,'果洛','G',1,0,0),(277,21,'海北','H',1,0,0),(278,21,'海东','H',1,0,0),(279,21,'海南','H',1,0,0),(280,21,'海西','H',1,0,0),(281,21,'黄南','H',1,0,0),(282,21,'玉树','Y',1,0,0),(283,22,'济南','J',1,0,0),(284,22,'青岛','Q',1,0,0),(285,22,'滨州','B',1,0,0),(286,22,'德州','D',1,0,0),(287,22,'东营','D',1,0,0),(288,22,'菏泽','H',1,0,0),(289,22,'济宁','J',1,0,0),(290,22,'莱芜','L',1,0,0),(291,22,'聊城','L',1,0,0),(292,22,'临沂','L',1,0,0),(293,22,'日照','R',1,0,0),(294,22,'泰安','T',1,0,0),(295,22,'威海','W',1,0,0),(296,22,'潍坊','W',1,0,0),(297,22,'烟台','Y',1,0,0),(298,22,'枣庄','Z',1,0,0),(299,22,'淄博','Z',1,0,0),(300,23,'太原','T',1,0,0),(301,23,'长治','C',1,0,0),(302,23,'大同','D',1,0,0),(303,23,'晋城','J',1,0,0),(304,23,'晋中','J',1,0,0),(305,23,'临汾','L',1,0,0),(306,23,'吕梁','L',1,0,0),(307,23,'朔州','S',1,0,0),(308,23,'忻州','X',1,0,0),(309,23,'阳泉','Y',1,0,0),(310,23,'运城','Y',1,0,0),(311,24,'西安','X',1,0,0),(312,24,'安康','A',1,0,0),(313,24,'宝鸡','B',1,0,0),(314,24,'汉中','H',1,0,0),(315,24,'商洛','S',1,0,0),(316,24,'铜川','T',1,0,0),(317,24,'渭南','W',1,0,0),(318,24,'咸阳','X',1,0,0),(319,24,'延安','Y',1,0,0),(320,24,'榆林','Y',1,0,0),(321,25,'上海','S',1,0,0),(322,26,'成都','C',1,0,0),(323,26,'绵阳','M',1,0,0),(324,26,'阿坝','A',1,0,0),(325,26,'巴中','B',1,0,0),(326,26,'达州','D',1,0,0),(327,26,'德阳','D',1,0,0),(328,26,'甘孜','G',1,0,0),(329,26,'广安','G',1,0,0),(330,26,'广元','G',1,0,0),(331,26,'乐山','L',1,0,0),(332,26,'凉山','L',1,0,0),(333,26,'眉山','M',1,0,0),(334,26,'南充','N',1,0,0),(335,26,'内江','N',1,0,0),(336,26,'攀枝花','P',1,0,0),(337,26,'遂宁','S',1,0,0),(338,26,'雅安','Y',1,0,0),(339,26,'宜宾','Y',1,0,0),(340,26,'资阳','Z',1,0,0),(341,26,'自贡','Z',1,0,0),(342,26,'泸州','Z',1,0,0),(343,27,'天津','T',1,0,0),(344,28,'拉萨','L',1,0,0),(345,28,'阿里','A',1,0,0),(346,28,'昌都','C',1,0,0),(347,28,'林芝','L',1,0,0),(348,28,'那曲','N',1,0,0),(349,28,'日喀则','R',1,0,0),(350,28,'山南','S',1,0,0),(351,29,'乌鲁木齐','W',1,0,0),(352,29,'阿克苏','A',1,0,0),(353,29,'阿拉尔','A',1,0,0),(354,29,'巴音郭楞','B',1,0,0),(355,29,'博尔塔拉','B',1,0,0),(356,29,'昌吉','C',1,0,0),(357,29,'哈密','H',1,0,0),(358,29,'和田','H',1,0,0),(359,29,'喀什','K',1,0,0),(360,29,'克拉玛依','K',1,0,0),(361,29,'克孜勒苏','K',1,0,0),(362,29,'石河子','S',1,0,0),(363,29,'图木舒克','T',1,0,0),(364,29,'吐鲁番','T',1,0,0),(365,29,'五家渠','W',1,0,0),(366,29,'伊犁','Y',1,0,0),(367,30,'昆明','K',1,0,0),(368,30,'怒江','N',1,0,0),(369,30,'普洱','P',1,0,0),(370,30,'丽江','L',1,0,0),(371,30,'保山','B',1,0,0),(372,30,'楚雄','C',1,0,0),(373,30,'大理','D',1,0,0),(374,30,'德宏','D',1,0,0),(375,30,'迪庆','D',1,0,0),(376,30,'红河','H',1,0,0),(377,30,'临沧','L',1,0,0),(378,30,'曲靖','Q',1,0,0),(379,30,'文山','W',1,0,0),(380,30,'西双版纳','X',1,0,0),(381,30,'玉溪','Y',1,0,0),(382,30,'昭通','Z',1,0,0),(383,31,'杭州','H',1,0,0),(384,31,'湖州','H',1,0,0),(385,31,'嘉兴','J',1,0,0),(386,31,'金华','J',1,0,0),(387,31,'丽水','L',1,0,0),(388,31,'宁波','N',1,0,0),(389,31,'绍兴','S',1,0,0),(390,31,'台州','T',1,0,0),(391,31,'温州','W',1,0,0),(392,31,'舟山','Z',1,0,0),(393,31,'衢州','Z',1,0,0),(394,32,'重庆','Z',1,0,0),(395,33,'香港','X',1,0,0),(396,34,'澳门','A',1,0,0),(397,35,'台湾','T',1,0,0),(398,36,'迎江区','Y',1,0,0),(399,36,'大观区','D',1,0,0),(400,36,'宜秀区','Y',1,0,0),(401,36,'桐城市','T',1,0,0),(402,36,'怀宁县','H',1,0,0),(403,36,'枞阳县','Z',1,0,0),(404,36,'潜山县','Q',1,0,0),(405,36,'太湖县','T',1,0,0),(406,36,'宿松县','S',1,0,0),(407,36,'望江县','W',1,0,0),(408,36,'岳西县','Y',1,0,0),(409,37,'中市区','Z',1,0,0),(410,37,'东市区','D',1,0,0),(411,37,'西市区','X',1,0,0),(412,37,'郊区','J',1,0,0),(413,37,'怀远县','H',1,0,0),(414,37,'五河县','W',1,0,0),(415,37,'固镇县','G',1,0,0),(416,38,'居巢区','J',1,0,0),(417,38,'庐江县','L',1,0,0),(418,38,'无为县','W',1,0,0),(419,38,'含山县','H',1,0,0),(420,38,'和县','H',1,0,0),(421,39,'贵池区','G',1,0,0),(422,39,'东至县','D',1,0,0),(423,39,'石台县','S',1,0,0),(424,39,'青阳县','Q',1,0,0),(425,40,'琅琊区','L',1,0,0),(426,40,'南谯区','N',1,0,0),(427,40,'天长市','T',1,0,0),(428,40,'明光市','M',1,0,0),(429,40,'来安县','L',1,0,0),(430,40,'全椒县','Q',1,0,0),(431,40,'定远县','D',1,0,0),(432,40,'凤阳县','F',1,0,0),(433,41,'蚌山区','B',1,0,0),(434,41,'龙子湖区','L',1,0,0),(435,41,'禹会区','Y',1,0,0),(436,41,'淮上区','H',1,0,0),(437,41,'颍州区','Z',1,0,0),(438,41,'颍东区','Z',1,0,0),(439,41,'颍泉区','Z',1,0,0),(440,41,'界首市','J',1,0,0),(441,41,'临泉县','L',1,0,0),(442,41,'太和县','T',1,0,0),(443,41,'阜南县','F',1,0,0),(444,41,'颖上县','Y',1,0,0),(445,42,'相山区','X',1,0,0),(446,42,'杜集区','D',1,0,0),(447,42,'烈山区','L',1,0,0),(448,42,'濉溪县','Z',1,0,0),(449,43,'田家庵区','T',1,0,0),(450,43,'大通区','D',1,0,0),(451,43,'谢家集区','X',1,0,0),(452,43,'八公山区','B',1,0,0),(453,43,'潘集区','P',1,0,0),(454,43,'凤台县','F',1,0,0),(455,44,'屯溪区','T',1,0,0),(456,44,'黄山区','H',1,0,0),(457,44,'徽州区','H',1,0,0),(458,44,'歙县','Z',1,0,0),(459,44,'休宁县','X',1,0,0),(460,44,'黟县','Z',1,0,0),(461,44,'祁门县','Q',1,0,0),(462,45,'金安区','J',1,0,0),(463,45,'裕安区','Y',1,0,0),(464,45,'寿县','S',1,0,0),(465,45,'霍邱县','H',1,0,0),(466,45,'舒城县','S',1,0,0),(467,45,'金寨县','J',1,0,0),(468,45,'霍山县','H',1,0,0),(469,46,'雨山区','Y',1,0,0),(470,46,'花山区','H',1,0,0),(471,46,'金家庄区','J',1,0,0),(472,46,'当涂县','D',1,0,0),(473,47,'埇桥区','~',1,0,0),(474,47,'砀山县','Z',1,0,0),(475,47,'萧县','X',1,0,0),(476,47,'灵璧县','L',1,0,0),(477,47,'泗县','Z',1,0,0),(478,48,'铜官山区','T',1,0,0),(479,48,'狮子山区','S',1,0,0),(480,48,'郊区','J',1,0,0),(481,48,'铜陵县','T',1,0,0),(482,49,'镜湖区','J',1,0,0),(483,49,'弋江区','Z',1,0,0),(484,49,'鸠江区','Z',1,0,0),(485,49,'三山区','S',1,0,0),(486,49,'芜湖县','W',1,0,0),(487,49,'繁昌县','F',1,0,0),(488,49,'南陵县','N',1,0,0),(489,50,'宣州区','X',1,0,0),(490,50,'宁国市','N',1,0,0),(491,50,'郎溪县','L',1,0,0),(492,50,'广德县','G',1,0,0),(493,50,'泾县','Z',1,0,0),(494,50,'绩溪县','J',1,0,0),(495,50,'旌德县','Z',1,0,0),(496,51,'涡阳县','W',1,0,0),(497,51,'蒙城县','M',1,0,0),(498,51,'利辛县','L',1,0,0),(499,51,'谯城区','Z',1,0,0),(500,52,'东城区','D',1,0,0),(501,52,'西城区','X',1,0,0),(502,52,'海淀区','H',1,0,0),(503,52,'朝阳区','C',1,0,0),(504,52,'崇文区','C',1,0,0),(505,52,'宣武区','X',1,0,0),(506,52,'丰台区','F',1,0,0),(507,52,'石景山区','S',1,0,0),(508,52,'房山区','F',1,0,0),(509,52,'门头沟区','M',1,0,0),(510,52,'通州区','T',1,0,0),(511,52,'顺义区','S',1,0,0),(512,52,'昌平区','C',1,0,0),(513,52,'怀柔区','H',1,0,0),(514,52,'平谷区','P',1,0,0),(515,52,'大兴区','D',1,0,0),(516,52,'密云县','M',1,0,0),(517,52,'延庆县','Y',1,0,0),(518,53,'鼓楼区','G',1,0,0),(519,53,'台江区','T',1,0,0),(520,53,'仓山区','C',1,0,0),(521,53,'马尾区','M',1,0,0),(522,53,'晋安区','J',1,0,0),(523,53,'福清市','F',1,0,0),(524,53,'长乐市','C',1,0,0),(525,53,'闽侯县','M',1,0,0),(526,53,'连江县','L',1,0,0),(527,53,'罗源县','L',1,0,0),(528,53,'闽清县','M',1,0,0),(529,53,'永泰县','Y',1,0,0),(530,53,'平潭县','P',1,0,0),(531,54,'新罗区','X',1,0,0),(532,54,'漳平市','Z',1,0,0),(533,54,'长汀县','C',1,0,0),(534,54,'永定县','Y',1,0,0),(535,54,'上杭县','S',1,0,0),(536,54,'武平县','W',1,0,0),(537,54,'连城县','L',1,0,0),(538,55,'延平区','Y',1,0,0),(539,55,'邵武市','S',1,0,0),(540,55,'武夷山市','W',1,0,0),(541,55,'建瓯市','J',1,0,0),(542,55,'建阳市','J',1,0,0),(543,55,'顺昌县','S',1,0,0),(544,55,'浦城县','P',1,0,0),(545,55,'光泽县','G',1,0,0),(546,55,'松溪县','S',1,0,0),(547,55,'政和县','Z',1,0,0),(548,56,'蕉城区','J',1,0,0),(549,56,'福安市','F',1,0,0),(550,56,'福鼎市','F',1,0,0),(551,56,'霞浦县','X',1,0,0),(552,56,'古田县','G',1,0,0),(553,56,'屏南县','P',1,0,0),(554,56,'寿宁县','S',1,0,0),(555,56,'周宁县','Z',1,0,0),(556,56,'柘荣县','Z',1,0,0),(557,57,'城厢区','C',1,0,0),(558,57,'涵江区','H',1,0,0),(559,57,'荔城区','L',1,0,0),(560,57,'秀屿区','X',1,0,0),(561,57,'仙游县','X',1,0,0),(562,58,'鲤城区','L',1,0,0),(563,58,'丰泽区','F',1,0,0),(564,58,'洛江区','L',1,0,0),(565,58,'清濛开发区','Q',1,0,0),(566,58,'泉港区','Q',1,0,0),(567,58,'石狮市','S',1,0,0),(568,58,'晋江市','J',1,0,0),(569,58,'南安市','N',1,0,0),(570,58,'惠安县','H',1,0,0),(571,58,'安溪县','A',1,0,0),(572,58,'永春县','Y',1,0,0),(573,58,'德化县','D',1,0,0),(574,58,'金门县','J',1,0,0),(575,59,'梅列区','M',1,0,0),(576,59,'三元区','S',1,0,0),(577,59,'永安市','Y',1,0,0),(578,59,'明溪县','M',1,0,0),(579,59,'清流县','Q',1,0,0),(580,59,'宁化县','N',1,0,0),(581,59,'大田县','D',1,0,0),(582,59,'尤溪县','Y',1,0,0),(583,59,'沙县','S',1,0,0),(584,59,'将乐县','J',1,0,0),(585,59,'泰宁县','T',1,0,0),(586,59,'建宁县','J',1,0,0),(587,60,'思明区','S',1,0,0),(588,60,'海沧区','H',1,0,0),(589,60,'湖里区','H',1,0,0),(590,60,'集美区','J',1,0,0),(591,60,'同安区','T',1,0,0),(592,60,'翔安区','X',1,0,0),(593,61,'芗城区','Z',1,0,0),(594,61,'龙文区','L',1,0,0),(595,61,'龙海市','L',1,0,0),(596,61,'云霄县','Y',1,0,0),(597,61,'漳浦县','Z',1,0,0),(598,61,'诏安县','Z',1,0,0),(599,61,'长泰县','C',1,0,0),(600,61,'东山县','D',1,0,0),(601,61,'南靖县','N',1,0,0),(602,61,'平和县','P',1,0,0),(603,61,'华安县','H',1,0,0),(604,62,'皋兰县','G',1,0,0),(605,62,'城关区','C',1,0,0),(606,62,'七里河区','Q',1,0,0),(607,62,'西固区','X',1,0,0),(608,62,'安宁区','A',1,0,0),(609,62,'红古区','H',1,0,0),(610,62,'永登县','Y',1,0,0),(611,62,'榆中县','Y',1,0,0),(612,63,'白银区','B',1,0,0),(613,63,'平川区','P',1,0,0),(614,63,'会宁县','H',1,0,0),(615,63,'景泰县','J',1,0,0),(616,63,'靖远县','J',1,0,0),(617,64,'临洮县','L',1,0,0),(618,64,'陇西县','L',1,0,0),(619,64,'通渭县','T',1,0,0),(620,64,'渭源县','W',1,0,0),(621,64,'漳县','Z',1,0,0),(622,64,'岷县','Z',1,0,0),(623,64,'安定区','A',1,0,0),(624,64,'安定区','A',1,0,0),(625,65,'合作市','H',1,0,0),(626,65,'临潭县','L',1,0,0),(627,65,'卓尼县','Z',1,0,0),(628,65,'舟曲县','Z',1,0,0),(629,65,'迭部县','D',1,0,0),(630,65,'玛曲县','M',1,0,0),(631,65,'碌曲县','L',1,0,0),(632,65,'夏河县','X',1,0,0),(633,66,'嘉峪关市','J',1,0,0),(634,67,'金川区','J',1,0,0),(635,67,'永昌县','Y',1,0,0),(636,68,'肃州区','S',1,0,0),(637,68,'玉门市','Y',1,0,0),(638,68,'敦煌市','D',1,0,0),(639,68,'金塔县','J',1,0,0),(640,68,'瓜州县','G',1,0,0),(641,68,'肃北','S',1,0,0),(642,68,'阿克塞','A',1,0,0),(643,69,'临夏市','L',1,0,0),(644,69,'临夏县','L',1,0,0),(645,69,'康乐县','K',1,0,0),(646,69,'永靖县','Y',1,0,0),(647,69,'广河县','G',1,0,0),(648,69,'和政县','H',1,0,0),(649,69,'东乡族自治县','D',1,0,0),(650,69,'积石山','J',1,0,0),(651,70,'成县','C',1,0,0),(652,70,'徽县','H',1,0,0),(653,70,'康县','K',1,0,0),(654,70,'礼县','L',1,0,0),(655,70,'两当县','L',1,0,0),(656,70,'文县','W',1,0,0),(657,70,'西和县','X',1,0,0),(658,70,'宕昌县','Z',1,0,0),(659,70,'武都区','W',1,0,0),(660,71,'崇信县','C',1,0,0),(661,71,'华亭县','H',1,0,0),(662,71,'静宁县','J',1,0,0),(663,71,'灵台县','L',1,0,0),(664,71,'崆峒区','Z',1,0,0),(665,71,'庄浪县','Z',1,0,0),(666,71,'泾川县','Z',1,0,0),(667,72,'合水县','H',1,0,0),(668,72,'华池县','H',1,0,0),(669,72,'环县','H',1,0,0),(670,72,'宁县','N',1,0,0),(671,72,'庆城县','Q',1,0,0),(672,72,'西峰区','X',1,0,0),(673,72,'镇原县','Z',1,0,0),(674,72,'正宁县','Z',1,0,0),(675,73,'甘谷县','G',1,0,0),(676,73,'秦安县','Q',1,0,0),(677,73,'清水县','Q',1,0,0),(678,73,'秦州区','Q',1,0,0),(679,73,'麦积区','M',1,0,0),(680,73,'武山县','W',1,0,0),(681,73,'张家川','Z',1,0,0),(682,74,'古浪县','G',1,0,0),(683,74,'民勤县','M',1,0,0),(684,74,'天祝','T',1,0,0),(685,74,'凉州区','L',1,0,0),(686,75,'高台县','G',1,0,0),(687,75,'临泽县','L',1,0,0),(688,75,'民乐县','M',1,0,0),(689,75,'山丹县','S',1,0,0),(690,75,'肃南','S',1,0,0),(691,75,'甘州区','G',1,0,0),(692,76,'从化市','C',1,0,0),(693,76,'天河区','T',1,0,0),(694,76,'东山区','D',1,0,0),(695,76,'白云区','B',1,0,0),(696,76,'海珠区','H',1,0,0),(697,76,'荔湾区','L',1,0,0),(698,76,'越秀区','Y',1,0,0),(699,76,'黄埔区','H',1,0,0),(700,76,'番禺区','F',1,0,0),(701,76,'花都区','H',1,0,0),(702,76,'增城区','Z',1,0,0),(703,76,'从化区','C',1,0,0),(704,76,'市郊','S',1,0,0),(705,77,'福田区','F',1,0,0),(706,77,'罗湖区','L',1,0,0),(707,77,'南山区','N',1,0,0),(708,77,'宝安区','B',1,0,0),(709,77,'龙岗区','L',1,0,0),(710,77,'盐田区','Y',1,0,0),(711,78,'湘桥区','X',1,0,0),(712,78,'潮安县','C',1,0,0),(713,78,'饶平县','R',1,0,0),(714,79,'南城区','N',1,0,0),(715,79,'东城区','D',1,0,0),(716,79,'万江区','W',1,0,0),(717,79,'莞城区','Z',1,0,0),(718,79,'石龙镇','S',1,0,0),(719,79,'虎门镇','H',1,0,0),(720,79,'麻涌镇','M',1,0,0),(721,79,'道滘镇','D',1,0,0),(722,79,'石碣镇','S',1,0,0),(723,79,'沙田镇','S',1,0,0),(724,79,'望牛墩镇','W',1,0,0),(725,79,'洪梅镇','H',1,0,0),(726,79,'茶山镇','C',1,0,0),(727,79,'寮步镇','Z',1,0,0),(728,79,'大岭山镇','D',1,0,0),(729,79,'大朗镇','D',1,0,0),(730,79,'黄江镇','H',1,0,0),(731,79,'樟木头','Z',1,0,0),(732,79,'凤岗镇','F',1,0,0),(733,79,'塘厦镇','T',1,0,0),(734,79,'谢岗镇','X',1,0,0),(735,79,'厚街镇','H',1,0,0),(736,79,'清溪镇','Q',1,0,0),(737,79,'常平镇','C',1,0,0),(738,79,'桥头镇','Q',1,0,0),(739,79,'横沥镇','H',1,0,0),(740,79,'东坑镇','D',1,0,0),(741,79,'企石镇','Q',1,0,0),(742,79,'石排镇','S',1,0,0),(743,79,'长安镇','C',1,0,0),(744,79,'中堂镇','Z',1,0,0),(745,79,'高埗镇','G',1,0,0),(746,80,'禅城区','Z',1,0,0),(747,80,'南海区','N',1,0,0),(748,80,'顺德区','S',1,0,0),(749,80,'三水区','S',1,0,0),(750,80,'高明区','G',1,0,0),(751,81,'东源县','D',1,0,0),(752,81,'和平县','H',1,0,0),(753,81,'源城区','Y',1,0,0),(754,81,'连平县','L',1,0,0),(755,81,'龙川县','L',1,0,0),(756,81,'紫金县','Z',1,0,0),(757,82,'惠阳区','H',1,0,0),(758,82,'惠城区','H',1,0,0),(759,82,'大亚湾','D',1,0,0),(760,82,'博罗县','B',1,0,0),(761,82,'惠东县','H',1,0,0),(762,82,'龙门县','L',1,0,0),(763,83,'江海区','J',1,0,0),(764,83,'蓬江区','P',1,0,0),(765,83,'新会区','X',1,0,0),(766,83,'台山市','T',1,0,0),(767,83,'开平市','K',1,0,0),(768,83,'鹤山市','H',1,0,0),(769,83,'恩平市','E',1,0,0),(770,84,'榕城区','Z',1,0,0),(771,84,'普宁市','P',1,0,0),(772,84,'揭东县','J',1,0,0),(773,84,'揭西县','J',1,0,0),(774,84,'惠来县','H',1,0,0),(775,85,'茂南区','M',1,0,0),(776,85,'茂港区','M',1,0,0),(777,85,'高州市','G',1,0,0),(778,85,'化州市','H',1,0,0),(779,85,'信宜市','X',1,0,0),(780,85,'电白县','D',1,0,0),(781,86,'梅县','M',1,0,0),(782,86,'梅江区','M',1,0,0),(783,86,'兴宁市','X',1,0,0),(784,86,'大埔县','D',1,0,0),(785,86,'丰顺县','F',1,0,0),(786,86,'五华县','W',1,0,0),(787,86,'平远县','P',1,0,0),(788,86,'蕉岭县','J',1,0,0),(789,87,'清城区','Q',1,0,0),(790,87,'英德市','Y',1,0,0),(791,87,'连州市','L',1,0,0),(792,87,'佛冈县','F',1,0,0),(793,87,'阳山县','Y',1,0,0),(794,87,'清新县','Q',1,0,0),(795,87,'连山','L',1,0,0),(796,87,'连南','L',1,0,0),(797,88,'南澳县','N',1,0,0),(798,88,'潮阳区','C',1,0,0),(799,88,'澄海区','C',1,0,0),(800,88,'龙湖区','L',1,0,0),(801,88,'金平区','J',1,0,0),(802,88,'濠江区','Z',1,0,0),(803,88,'潮南区','C',1,0,0),(804,89,'城区','C',1,0,0),(805,89,'陆丰市','L',1,0,0),(806,89,'海丰县','H',1,0,0),(807,89,'陆河县','L',1,0,0),(808,90,'曲江县','Q',1,0,0),(809,90,'浈江区','Z',1,0,0),(810,90,'武江区','W',1,0,0),(811,90,'曲江区','Q',1,0,0),(812,90,'乐昌市','L',1,0,0),(813,90,'南雄市','N',1,0,0),(814,90,'始兴县','S',1,0,0),(815,90,'仁化县','R',1,0,0),(816,90,'翁源县','W',1,0,0),(817,90,'新丰县','X',1,0,0),(818,90,'乳源','R',1,0,0),(819,91,'江城区','J',1,0,0),(820,91,'阳春市','Y',1,0,0),(821,91,'阳西县','Y',1,0,0),(822,91,'阳东县','Y',1,0,0),(823,92,'云城区','Y',1,0,0),(824,92,'罗定市','L',1,0,0),(825,92,'新兴县','X',1,0,0),(826,92,'郁南县','Y',1,0,0),(827,92,'云安县','Y',1,0,0),(828,93,'赤坎区','C',1,0,0),(829,93,'霞山区','X',1,0,0),(830,93,'坡头区','P',1,0,0),(831,93,'麻章区','M',1,0,0),(832,93,'廉江市','L',1,0,0),(833,93,'雷州市','L',1,0,0),(834,93,'吴川市','W',1,0,0),(835,93,'遂溪县','S',1,0,0),(836,93,'徐闻县','X',1,0,0),(837,94,'肇庆市','Z',1,0,0),(838,94,'高要市','G',1,0,0),(839,94,'四会市','S',1,0,0),(840,94,'广宁县','G',1,0,0),(841,94,'怀集县','H',1,0,0),(842,94,'封开县','F',1,0,0),(843,94,'德庆县','D',1,0,0),(844,95,'石岐街道','S',1,0,0),(845,95,'东区街道','D',1,0,0),(846,95,'西区街道','X',1,0,0),(847,95,'环城街道','H',1,0,0),(848,95,'中山港街道','Z',1,0,0),(849,95,'五桂山街道','W',1,0,0),(850,96,'香洲区','X',1,0,0),(851,96,'斗门区','D',1,0,0),(852,96,'金湾区','J',1,0,0),(853,97,'邕宁区','Z',1,0,0),(854,97,'青秀区','Q',1,0,0),(855,97,'兴宁区','X',1,0,0),(856,97,'良庆区','L',1,0,0),(857,97,'西乡塘区','X',1,0,0),(858,97,'江南区','J',1,0,0),(859,97,'武鸣县','W',1,0,0),(860,97,'隆安县','L',1,0,0),(861,97,'马山县','M',1,0,0),(862,97,'上林县','S',1,0,0),(863,97,'宾阳县','B',1,0,0),(864,97,'横县','H',1,0,0),(865,98,'秀峰区','X',1,0,0),(866,98,'叠彩区','D',1,0,0),(867,98,'象山区','X',1,0,0),(868,98,'七星区','Q',1,0,0),(869,98,'雁山区','Y',1,0,0),(870,98,'阳朔县','Y',1,0,0),(871,98,'临桂县','L',1,0,0),(872,98,'灵川县','L',1,0,0),(873,98,'全州县','Q',1,0,0),(874,98,'平乐县','P',1,0,0),(875,98,'兴安县','X',1,0,0),(876,98,'灌阳县','G',1,0,0),(877,98,'荔浦县','L',1,0,0),(878,98,'资源县','Z',1,0,0),(879,98,'永福县','Y',1,0,0),(880,98,'龙胜','L',1,0,0),(881,98,'恭城','G',1,0,0),(882,99,'右江区','Y',1,0,0),(883,99,'凌云县','L',1,0,0),(884,99,'平果县','P',1,0,0),(885,99,'西林县','X',1,0,0),(886,99,'乐业县','L',1,0,0),(887,99,'德保县','D',1,0,0),(888,99,'田林县','T',1,0,0),(889,99,'田阳县','T',1,0,0),(890,99,'靖西县','J',1,0,0),(891,99,'田东县','T',1,0,0),(892,99,'那坡县','N',1,0,0),(893,99,'隆林','L',1,0,0),(894,100,'海城区','H',1,0,0),(895,100,'银海区','Y',1,0,0),(896,100,'铁山港区','T',1,0,0),(897,100,'合浦县','H',1,0,0),(898,101,'江州区','J',1,0,0),(899,101,'凭祥市','P',1,0,0),(900,101,'宁明县','N',1,0,0),(901,101,'扶绥县','F',1,0,0),(902,101,'龙州县','L',1,0,0),(903,101,'大新县','D',1,0,0),(904,101,'天等县','T',1,0,0),(905,102,'港口区','G',1,0,0),(906,102,'防城区','F',1,0,0),(907,102,'东兴市','D',1,0,0),(908,102,'上思县','S',1,0,0),(909,103,'港北区','G',1,0,0),(910,103,'港南区','G',1,0,0),(911,103,'覃塘区','Z',1,0,0),(912,103,'桂平市','G',1,0,0),(913,103,'平南县','P',1,0,0),(914,104,'金城江区','J',1,0,0),(915,104,'宜州市','Y',1,0,0),(916,104,'天峨县','T',1,0,0),(917,104,'凤山县','F',1,0,0),(918,104,'南丹县','N',1,0,0),(919,104,'东兰县','D',1,0,0),(920,104,'都安','D',1,0,0),(921,104,'罗城','L',1,0,0),(922,104,'巴马','B',1,0,0),(923,104,'环江','H',1,0,0),(924,104,'大化','D',1,0,0),(925,105,'八步区','B',1,0,0),(926,105,'钟山县','Z',1,0,0),(927,105,'昭平县','Z',1,0,0),(928,105,'富川','F',1,0,0),(929,106,'兴宾区','X',1,0,0),(930,106,'合山市','H',1,0,0),(931,106,'象州县','X',1,0,0),(932,106,'武宣县','W',1,0,0),(933,106,'忻城县','X',1,0,0),(934,106,'金秀','J',1,0,0),(935,107,'城中区','C',1,0,0),(936,107,'鱼峰区','Y',1,0,0),(937,107,'柳北区','L',1,0,0),(938,107,'柳南区','L',1,0,0),(939,107,'柳江县','L',1,0,0),(940,107,'柳城县','L',1,0,0),(941,107,'鹿寨县','L',1,0,0),(942,107,'融安县','R',1,0,0),(943,107,'融水','R',1,0,0),(944,107,'三江','S',1,0,0),(945,108,'钦南区','Q',1,0,0),(946,108,'钦北区','Q',1,0,0),(947,108,'灵山县','L',1,0,0),(948,108,'浦北县','P',1,0,0),(949,109,'万秀区','W',1,0,0),(950,109,'蝶山区','D',1,0,0),(951,109,'长洲区','C',1,0,0),(952,109,'岑溪市','Z',1,0,0),(953,109,'苍梧县','C',1,0,0),(954,109,'藤县','T',1,0,0),(955,109,'蒙山县','M',1,0,0),(956,110,'玉州区','Y',1,0,0),(957,110,'北流市','B',1,0,0),(958,110,'容县','R',1,0,0),(959,110,'陆川县','L',1,0,0),(960,110,'博白县','B',1,0,0),(961,110,'兴业县','X',1,0,0),(962,111,'南明区','N',1,0,0),(963,111,'云岩区','Y',1,0,0),(964,111,'花溪区','H',1,0,0),(965,111,'乌当区','W',1,0,0),(966,111,'白云区','B',1,0,0),(967,111,'小河区','X',1,0,0),(968,111,'金阳新区','J',1,0,0),(969,111,'新天园区','X',1,0,0),(970,111,'清镇市','Q',1,0,0),(971,111,'开阳县','K',1,0,0),(972,111,'修文县','X',1,0,0),(973,111,'息烽县','X',1,0,0),(974,112,'西秀区','X',1,0,0),(975,112,'关岭','G',1,0,0),(976,112,'镇宁','Z',1,0,0),(977,112,'紫云','Z',1,0,0),(978,112,'平坝县','P',1,0,0),(979,112,'普定县','P',1,0,0),(980,113,'毕节市','B',1,0,0),(981,113,'大方县','D',1,0,0),(982,113,'黔西县','Q',1,0,0),(983,113,'金沙县','J',1,0,0),(984,113,'织金县','Z',1,0,0),(985,113,'纳雍县','N',1,0,0),(986,113,'赫章县','H',1,0,0),(987,113,'威宁','W',1,0,0),(988,114,'钟山区','Z',1,0,0),(989,114,'六枝特区','L',1,0,0),(990,114,'水城县','S',1,0,0),(991,114,'盘县','P',1,0,0),(992,115,'凯里市','K',1,0,0),(993,115,'黄平县','H',1,0,0),(994,115,'施秉县','S',1,0,0),(995,115,'三穗县','S',1,0,0),(996,115,'镇远县','Z',1,0,0),(997,115,'岑巩县','Z',1,0,0),(998,115,'天柱县','T',1,0,0),(999,115,'锦屏县','J',1,0,0),(1000,115,'剑河县','J',1,0,0),(1001,115,'台江县','T',1,0,0),(1002,115,'黎平县','L',1,0,0),(1003,115,'榕江县','Z',1,0,0),(1004,115,'从江县','C',1,0,0),(1005,115,'雷山县','L',1,0,0),(1006,115,'麻江县','M',1,0,0),(1007,115,'丹寨县','D',1,0,0),(1008,116,'都匀市','D',1,0,0),(1009,116,'福泉市','F',1,0,0),(1010,116,'荔波县','L',1,0,0),(1011,116,'贵定县','G',1,0,0),(1012,116,'瓮安县','W',1,0,0),(1013,116,'独山县','D',1,0,0),(1014,116,'平塘县','P',1,0,0),(1015,116,'罗甸县','L',1,0,0),(1016,116,'长顺县','C',1,0,0),(1017,116,'龙里县','L',1,0,0),(1018,116,'惠水县','H',1,0,0),(1019,116,'三都','S',1,0,0),(1020,117,'兴义市','X',1,0,0),(1021,117,'兴仁县','X',1,0,0),(1022,117,'普安县','P',1,0,0),(1023,117,'晴隆县','Q',1,0,0),(1024,117,'贞丰县','Z',1,0,0),(1025,117,'望谟县','W',1,0,0),(1026,117,'册亨县','C',1,0,0),(1027,117,'安龙县','A',1,0,0),(1028,118,'铜仁市','T',1,0,0),(1029,118,'江口县','J',1,0,0),(1030,118,'石阡县','S',1,0,0),(1031,118,'思南县','S',1,0,0),(1032,118,'德江县','D',1,0,0),(1033,118,'玉屏','Y',1,0,0),(1034,118,'印江','Y',1,0,0),(1035,118,'沿河','Y',1,0,0),(1036,118,'松桃','S',1,0,0),(1037,118,'万山特区','W',1,0,0),(1038,119,'红花岗区','H',1,0,0),(1039,119,'务川县','W',1,0,0),(1040,119,'道真县','D',1,0,0),(1041,119,'汇川区','H',1,0,0),(1042,119,'赤水市','C',1,0,0),(1043,119,'仁怀市','R',1,0,0),(1044,119,'遵义县','Z',1,0,0),(1045,119,'桐梓县','T',1,0,0),(1046,119,'绥阳县','S',1,0,0),(1047,119,'正安县','Z',1,0,0),(1048,119,'凤冈县','F',1,0,0),(1049,119,'湄潭县','Z',1,0,0),(1050,119,'余庆县','Y',1,0,0),(1051,119,'习水县','X',1,0,0),(1052,119,'道真','D',1,0,0),(1053,119,'务川','W',1,0,0),(1054,120,'秀英区','X',1,0,0),(1055,120,'龙华区','L',1,0,0),(1056,120,'琼山区','Q',1,0,0),(1057,120,'美兰区','M',1,0,0),(1058,137,'市区','S',1,0,0),(1059,137,'洋浦开发区','Y',1,0,0),(1060,137,'那大镇','N',1,0,0),(1061,137,'王五镇','W',1,0,0),(1062,137,'雅星镇','Y',1,0,0),(1063,137,'大成镇','D',1,0,0),(1064,137,'中和镇','Z',1,0,0),(1065,137,'峨蔓镇','E',1,0,0),(1066,137,'南丰镇','N',1,0,0),(1067,137,'白马井镇','B',1,0,0),(1068,137,'兰洋镇','L',1,0,0),(1069,137,'和庆镇','H',1,0,0),(1070,137,'海头镇','H',1,0,0),(1071,137,'排浦镇','P',1,0,0),(1072,137,'东成镇','D',1,0,0),(1073,137,'光村镇','G',1,0,0),(1074,137,'木棠镇','M',1,0,0),(1075,137,'新州镇','X',1,0,0),(1076,137,'三都镇','S',1,0,0),(1077,137,'其他','Q',1,0,0),(1078,138,'长安区','C',1,0,0),(1079,138,'桥东区','Q',1,0,0),(1080,138,'桥西区','Q',1,0,0),(1081,138,'新华区','X',1,0,0),(1082,138,'裕华区','Y',1,0,0),(1083,138,'井陉矿区','J',1,0,0),(1084,138,'高新区','G',1,0,0),(1085,138,'辛集市','X',1,0,0),(1086,138,'藁城市','Z',1,0,0),(1087,138,'晋州市','J',1,0,0),(1088,138,'新乐市','X',1,0,0),(1089,138,'鹿泉市','L',1,0,0),(1090,138,'井陉县','J',1,0,0),(1091,138,'正定县','Z',1,0,0),(1092,138,'栾城县','Z',1,0,0),(1093,138,'行唐县','X',1,0,0),(1094,138,'灵寿县','L',1,0,0),(1095,138,'高邑县','G',1,0,0),(1096,138,'深泽县','S',1,0,0),(1097,138,'赞皇县','Z',1,0,0),(1098,138,'无极县','W',1,0,0),(1099,138,'平山县','P',1,0,0),(1100,138,'元氏县','Y',1,0,0),(1101,138,'赵县','Z',1,0,0),(1102,139,'新市区','X',1,0,0),(1103,139,'南市区','N',1,0,0),(1104,139,'北市区','B',1,0,0),(1105,139,'涿州市','Z',1,0,0),(1106,139,'定州市','D',1,0,0),(1107,139,'安国市','A',1,0,0),(1108,139,'高碑店市','G',1,0,0),(1109,139,'满城县','M',1,0,0),(1110,139,'清苑县','Q',1,0,0),(1111,139,'涞水县','Z',1,0,0),(1112,139,'阜平县','F',1,0,0),(1113,139,'徐水县','X',1,0,0),(1114,139,'定兴县','D',1,0,0),(1115,139,'唐县','T',1,0,0),(1116,139,'高阳县','G',1,0,0),(1117,139,'容城县','R',1,0,0),(1118,139,'涞源县','Z',1,0,0),(1119,139,'望都县','W',1,0,0),(1120,139,'安新县','A',1,0,0),(1121,139,'易县','Y',1,0,0),(1122,139,'曲阳县','Q',1,0,0),(1123,139,'蠡县','Z',1,0,0),(1124,139,'顺平县','S',1,0,0),(1125,139,'博野县','B',1,0,0),(1126,139,'雄县','X',1,0,0),(1127,140,'运河区','Y',1,0,0),(1128,140,'新华区','X',1,0,0),(1129,140,'泊头市','B',1,0,0),(1130,140,'任丘市','R',1,0,0),(1131,140,'黄骅市','H',1,0,0),(1132,140,'河间市','H',1,0,0),(1133,140,'沧县','C',1,0,0),(1134,140,'青县','Q',1,0,0),(1135,140,'东光县','D',1,0,0),(1136,140,'海兴县','H',1,0,0),(1137,140,'盐山县','Y',1,0,0),(1138,140,'肃宁县','S',1,0,0),(1139,140,'南皮县','N',1,0,0),(1140,140,'吴桥县','W',1,0,0),(1141,140,'献县','X',1,0,0),(1142,140,'孟村','M',1,0,0),(1143,141,'双桥区','S',1,0,0),(1144,141,'双滦区','S',1,0,0),(1145,141,'鹰手营子矿区','Y',1,0,0),(1146,141,'承德县','C',1,0,0),(1147,141,'兴隆县','X',1,0,0),(1148,141,'平泉县','P',1,0,0),(1149,141,'滦平县','L',1,0,0),(1150,141,'隆化县','L',1,0,0),(1151,141,'丰宁','F',1,0,0),(1152,141,'宽城','K',1,0,0),(1153,141,'围场','W',1,0,0),(1154,142,'从台区','C',1,0,0),(1155,142,'复兴区','F',1,0,0),(1156,142,'邯山区','H',1,0,0),(1157,142,'峰峰矿区','F',1,0,0),(1158,142,'武安市','W',1,0,0),(1159,142,'邯郸县','H',1,0,0),(1160,142,'临漳县','L',1,0,0),(1161,142,'成安县','C',1,0,0),(1162,142,'大名县','D',1,0,0),(1163,142,'涉县','S',1,0,0),(1164,142,'磁县','C',1,0,0),(1165,142,'肥乡县','F',1,0,0),(1166,142,'永年县','Y',1,0,0),(1167,142,'邱县','Q',1,0,0),(1168,142,'鸡泽县','J',1,0,0),(1169,142,'广平县','G',1,0,0),(1170,142,'馆陶县','G',1,0,0),(1171,142,'魏县','W',1,0,0),(1172,142,'曲周县','Q',1,0,0),(1173,143,'桃城区','T',1,0,0),(1174,143,'冀州市','J',1,0,0),(1175,143,'深州市','S',1,0,0),(1176,143,'枣强县','Z',1,0,0),(1177,143,'武邑县','W',1,0,0),(1178,143,'武强县','W',1,0,0),(1179,143,'饶阳县','R',1,0,0),(1180,143,'安平县','A',1,0,0),(1181,143,'故城县','G',1,0,0),(1182,143,'景县','J',1,0,0),(1183,143,'阜城县','F',1,0,0),(1184,144,'安次区','A',1,0,0),(1185,144,'广阳区','G',1,0,0),(1186,144,'霸州市','B',1,0,0),(1187,144,'三河市','S',1,0,0),(1188,144,'固安县','G',1,0,0),(1189,144,'永清县','Y',1,0,0),(1190,144,'香河县','X',1,0,0),(1191,144,'大城县','D',1,0,0),(1192,144,'文安县','W',1,0,0),(1193,144,'大厂','D',1,0,0),(1194,145,'海港区','H',1,0,0),(1195,145,'山海关区','S',1,0,0),(1196,145,'北戴河区','B',1,0,0),(1197,145,'昌黎县','C',1,0,0),(1198,145,'抚宁县','F',1,0,0),(1199,145,'卢龙县','L',1,0,0),(1200,145,'青龙','Q',1,0,0),(1201,146,'路北区','L',1,0,0),(1202,146,'路南区','L',1,0,0),(1203,146,'古冶区','G',1,0,0),(1204,146,'开平区','K',1,0,0),(1205,146,'丰南区','F',1,0,0),(1206,146,'丰润区','F',1,0,0),(1207,146,'遵化市','Z',1,0,0),(1208,146,'迁安市','Q',1,0,0),(1209,146,'滦县','L',1,0,0),(1210,146,'滦南县','L',1,0,0),(1211,146,'乐亭县','L',1,0,0),(1212,146,'迁西县','Q',1,0,0),(1213,146,'玉田县','Y',1,0,0),(1214,146,'唐海县','T',1,0,0),(1215,147,'桥东区','Q',1,0,0),(1216,147,'桥西区','Q',1,0,0),(1217,147,'南宫市','N',1,0,0),(1218,147,'沙河市','S',1,0,0),(1219,147,'邢台县','X',1,0,0),(1220,147,'临城县','L',1,0,0),(1221,147,'内丘县','N',1,0,0),(1222,147,'柏乡县','B',1,0,0),(1223,147,'隆尧县','L',1,0,0),(1224,147,'任县','R',1,0,0),(1225,147,'南和县','N',1,0,0),(1226,147,'宁晋县','N',1,0,0),(1227,147,'巨鹿县','J',1,0,0),(1228,147,'新河县','X',1,0,0),(1229,147,'广宗县','G',1,0,0),(1230,147,'平乡县','P',1,0,0),(1231,147,'威县','W',1,0,0),(1232,147,'清河县','Q',1,0,0),(1233,147,'临西县','L',1,0,0),(1234,148,'桥西区','Q',1,0,0),(1235,148,'桥东区','Q',1,0,0),(1236,148,'宣化区','X',1,0,0),(1237,148,'下花园区','X',1,0,0),(1238,148,'宣化县','X',1,0,0),(1239,148,'张北县','Z',1,0,0),(1240,148,'康保县','K',1,0,0),(1241,148,'沽源县','G',1,0,0),(1242,148,'尚义县','S',1,0,0),(1243,148,'蔚县','W',1,0,0),(1244,148,'阳原县','Y',1,0,0),(1245,148,'怀安县','H',1,0,0),(1246,148,'万全县','W',1,0,0),(1247,148,'怀来县','H',1,0,0),(1248,148,'涿鹿县','Z',1,0,0),(1249,148,'赤城县','C',1,0,0),(1250,148,'崇礼县','C',1,0,0),(1251,149,'金水区','J',1,0,0),(1252,149,'邙山区','Z',1,0,0),(1253,149,'二七区','E',1,0,0),(1254,149,'管城区','G',1,0,0),(1255,149,'中原区','Z',1,0,0),(1256,149,'上街区','S',1,0,0),(1257,149,'惠济区','H',1,0,0),(1258,149,'郑东新区','Z',1,0,0),(1259,149,'经济技术开发区','J',1,0,0),(1260,149,'高新开发区','G',1,0,0),(1261,149,'出口加工区','C',1,0,0),(1262,149,'巩义市','G',1,0,0),(1263,149,'荥阳市','Z',1,0,0),(1264,149,'新密市','X',1,0,0),(1265,149,'新郑市','X',1,0,0),(1266,149,'登封市','D',1,0,0),(1267,149,'中牟县','Z',1,0,0),(1268,150,'西工区','X',1,0,0),(1269,150,'老城区','L',1,0,0),(1270,150,'涧西区','J',1,0,0),(1271,150,'瀍河回族区','~',1,0,0),(1272,150,'洛龙区','L',1,0,0),(1273,150,'吉利区','J',1,0,0),(1274,150,'偃师市','Z',1,0,0),(1275,150,'孟津县','M',1,0,0),(1276,150,'新安县','X',1,0,0),(1277,150,'栾川县','Z',1,0,0),(1278,150,'嵩县','Z',1,0,0),(1279,150,'汝阳县','R',1,0,0),(1280,150,'宜阳县','Y',1,0,0),(1281,150,'洛宁县','L',1,0,0),(1282,150,'伊川县','Y',1,0,0),(1283,151,'鼓楼区','G',1,0,0),(1284,151,'龙亭区','L',1,0,0),(1285,151,'顺河回族区','S',1,0,0),(1286,151,'金明区','J',1,0,0),(1287,151,'禹王台区','Y',1,0,0),(1288,151,'杞县','Z',1,0,0),(1289,151,'通许县','T',1,0,0),(1290,151,'尉氏县','W',1,0,0),(1291,151,'开封县','K',1,0,0),(1292,151,'兰考县','L',1,0,0),(1293,152,'北关区','B',1,0,0),(1294,152,'文峰区','W',1,0,0),(1295,152,'殷都区','Y',1,0,0),(1296,152,'龙安区','L',1,0,0),(1297,152,'林州市','L',1,0,0),(1298,152,'安阳县','A',1,0,0),(1299,152,'汤阴县','T',1,0,0),(1300,152,'滑县','H',1,0,0),(1301,152,'内黄县','N',1,0,0),(1302,153,'淇滨区','Z',1,0,0),(1303,153,'山城区','S',1,0,0),(1304,153,'鹤山区','H',1,0,0),(1305,153,'浚县','J',1,0,0),(1306,153,'淇县','Z',1,0,0),(1307,154,'济源市','J',1,0,0),(1308,155,'解放区','J',1,0,0),(1309,155,'中站区','Z',1,0,0),(1310,155,'马村区','M',1,0,0),(1311,155,'山阳区','S',1,0,0),(1312,155,'沁阳市','Q',1,0,0),(1313,155,'孟州市','M',1,0,0),(1314,155,'修武县','X',1,0,0),(1315,155,'博爱县','B',1,0,0),(1316,155,'武陟县','W',1,0,0),(1317,155,'温县','W',1,0,0),(1318,156,'卧龙区','W',1,0,0),(1319,156,'宛城区','W',1,0,0),(1320,156,'邓州市','D',1,0,0),(1321,156,'南召县','N',1,0,0),(1322,156,'方城县','F',1,0,0),(1323,156,'西峡县','X',1,0,0),(1324,156,'镇平县','Z',1,0,0),(1325,156,'内乡县','N',1,0,0),(1326,156,'淅川县','Z',1,0,0),(1327,156,'社旗县','S',1,0,0),(1328,156,'唐河县','T',1,0,0),(1329,156,'新野县','X',1,0,0),(1330,156,'桐柏县','T',1,0,0),(1331,157,'新华区','X',1,0,0),(1332,157,'卫东区','W',1,0,0),(1333,157,'湛河区','Z',1,0,0),(1334,157,'石龙区','S',1,0,0),(1335,157,'舞钢市','W',1,0,0),(1336,157,'汝州市','R',1,0,0),(1337,157,'宝丰县','B',1,0,0),(1338,157,'叶县','Y',1,0,0),(1339,157,'鲁山县','L',1,0,0),(1340,157,'郏县','Z',1,0,0),(1341,158,'湖滨区','H',1,0,0),(1342,158,'义马市','Y',1,0,0),(1343,158,'灵宝市','L',1,0,0),(1344,158,'渑池县','Z',1,0,0),(1345,158,'陕县','S',1,0,0),(1346,158,'卢氏县','L',1,0,0),(1347,159,'梁园区','L',1,0,0),(1348,159,'睢阳区','Z',1,0,0),(1349,159,'永城市','Y',1,0,0),(1350,159,'民权县','M',1,0,0),(1351,159,'睢县','Z',1,0,0),(1352,159,'宁陵县','N',1,0,0),(1353,159,'虞城县','Y',1,0,0),(1354,159,'柘城县','Z',1,0,0),(1355,159,'夏邑县','X',1,0,0),(1356,160,'卫滨区','W',1,0,0),(1357,160,'红旗区','H',1,0,0),(1358,160,'凤泉区','F',1,0,0),(1359,160,'牧野区','M',1,0,0),(1360,160,'卫辉市','W',1,0,0),(1361,160,'辉县市','H',1,0,0),(1362,160,'新乡县','X',1,0,0),(1363,160,'获嘉县','H',1,0,0),(1364,160,'原阳县','Y',1,0,0),(1365,160,'延津县','Y',1,0,0),(1366,160,'封丘县','F',1,0,0),(1367,160,'长垣县','C',1,0,0),(1368,161,'浉河区','~',1,0,0),(1369,161,'平桥区','P',1,0,0),(1370,161,'罗山县','L',1,0,0),(1371,161,'光山县','G',1,0,0),(1372,161,'新县','X',1,0,0),(1373,161,'商城县','S',1,0,0),(1374,161,'固始县','G',1,0,0),(1375,161,'潢川县','Z',1,0,0),(1376,161,'淮滨县','H',1,0,0),(1377,161,'息县','X',1,0,0),(1378,162,'魏都区','W',1,0,0),(1379,162,'禹州市','Y',1,0,0),(1380,162,'长葛市','C',1,0,0),(1381,162,'许昌县','X',1,0,0),(1382,162,'鄢陵县','Z',1,0,0),(1383,162,'襄城县','X',1,0,0),(1384,163,'川汇区','C',1,0,0),(1385,163,'项城市','X',1,0,0),(1386,163,'扶沟县','F',1,0,0),(1387,163,'西华县','X',1,0,0),(1388,163,'商水县','S',1,0,0),(1389,163,'沈丘县','S',1,0,0),(1390,163,'郸城县','D',1,0,0),(1391,163,'淮阳县','H',1,0,0),(1392,163,'太康县','T',1,0,0),(1393,163,'鹿邑县','L',1,0,0),(1394,164,'驿城区','Z',1,0,0),(1395,164,'西平县','X',1,0,0),(1396,164,'上蔡县','S',1,0,0),(1397,164,'平舆县','P',1,0,0),(1398,164,'正阳县','Z',1,0,0),(1399,164,'确山县','Q',1,0,0),(1400,164,'泌阳县','M',1,0,0),(1401,164,'汝南县','R',1,0,0),(1402,164,'遂平县','S',1,0,0),(1403,164,'新蔡县','X',1,0,0),(1404,165,'郾城区','Z',1,0,0),(1405,165,'源汇区','Y',1,0,0),(1406,165,'召陵区','Z',1,0,0),(1407,165,'舞阳县','W',1,0,0),(1408,165,'临颍县','L',1,0,0),(1409,166,'华龙区','H',1,0,0),(1410,166,'清丰县','Q',1,0,0),(1411,166,'南乐县','N',1,0,0),(1412,166,'范县','F',1,0,0),(1413,166,'台前县','T',1,0,0),(1414,166,'濮阳县','Z',1,0,0),(1415,167,'道里区','D',1,0,0),(1416,167,'南岗区','N',1,0,0),(1417,167,'动力区','D',1,0,0),(1418,167,'平房区','P',1,0,0),(1419,167,'香坊区','X',1,0,0),(1420,167,'太平区','T',1,0,0),(1421,167,'道外区','D',1,0,0),(1422,167,'阿城区','A',1,0,0),(1423,167,'呼兰区','H',1,0,0),(1424,167,'松北区','S',1,0,0),(1425,167,'尚志市','S',1,0,0),(1426,167,'双城市','S',1,0,0),(1427,167,'五常市','W',1,0,0),(1428,167,'方正县','F',1,0,0),(1429,167,'宾县','B',1,0,0),(1430,167,'依兰县','Y',1,0,0),(1431,167,'巴彦县','B',1,0,0),(1432,167,'通河县','T',1,0,0),(1433,167,'木兰县','M',1,0,0),(1434,167,'延寿县','Y',1,0,0),(1435,168,'萨尔图区','S',1,0,0),(1436,168,'红岗区','H',1,0,0),(1437,168,'龙凤区','L',1,0,0),(1438,168,'让胡路区','R',1,0,0),(1439,168,'大同区','D',1,0,0),(1440,168,'肇州县','Z',1,0,0),(1441,168,'肇源县','Z',1,0,0),(1442,168,'林甸县','L',1,0,0),(1443,168,'杜尔伯特','D',1,0,0),(1444,169,'呼玛县','H',1,0,0),(1445,169,'漠河县','M',1,0,0),(1446,169,'塔河县','T',1,0,0),(1447,170,'兴山区','X',1,0,0),(1448,170,'工农区','G',1,0,0),(1449,170,'南山区','N',1,0,0),(1450,170,'兴安区','X',1,0,0),(1451,170,'向阳区','X',1,0,0),(1452,170,'东山区','D',1,0,0),(1453,170,'萝北县','L',1,0,0),(1454,170,'绥滨县','S',1,0,0),(1455,171,'爱辉区','A',1,0,0),(1456,171,'五大连池市','W',1,0,0),(1457,171,'北安市','B',1,0,0),(1458,171,'嫩江县','N',1,0,0),(1459,171,'逊克县','X',1,0,0),(1460,171,'孙吴县','S',1,0,0),(1461,172,'鸡冠区','J',1,0,0),(1462,172,'恒山区','H',1,0,0),(1463,172,'城子河区','C',1,0,0),(1464,172,'滴道区','D',1,0,0),(1465,172,'梨树区','L',1,0,0),(1466,172,'虎林市','H',1,0,0),(1467,172,'密山市','M',1,0,0),(1468,172,'鸡东县','J',1,0,0),(1469,173,'前进区','Q',1,0,0),(1470,173,'郊区','J',1,0,0),(1471,173,'向阳区','X',1,0,0),(1472,173,'东风区','D',1,0,0),(1473,173,'同江市','T',1,0,0),(1474,173,'富锦市','F',1,0,0),(1475,173,'桦南县','Z',1,0,0),(1476,173,'桦川县','Z',1,0,0),(1477,173,'汤原县','T',1,0,0),(1478,173,'抚远县','F',1,0,0),(1479,174,'爱民区','A',1,0,0),(1480,174,'东安区','D',1,0,0),(1481,174,'阳明区','Y',1,0,0),(1482,174,'西安区','X',1,0,0),(1483,174,'绥芬河市','S',1,0,0),(1484,174,'海林市','H',1,0,0),(1485,174,'宁安市','N',1,0,0),(1486,174,'穆棱市','M',1,0,0),(1487,174,'东宁县','D',1,0,0),(1488,174,'林口县','L',1,0,0),(1489,175,'桃山区','T',1,0,0),(1490,175,'新兴区','X',1,0,0),(1491,175,'茄子河区','Q',1,0,0),(1492,175,'勃利县','B',1,0,0),(1493,176,'龙沙区','L',1,0,0),(1494,176,'昂昂溪区','A',1,0,0),(1495,176,'铁峰区','T',1,0,0),(1496,176,'建华区','J',1,0,0),(1497,176,'富拉尔基区','F',1,0,0),(1498,176,'碾子山区','N',1,0,0),(1499,176,'梅里斯达斡尔区','M',1,0,0),(1500,176,'讷河市','Z',1,0,0),(1501,176,'龙江县','L',1,0,0),(1502,176,'依安县','Y',1,0,0),(1503,176,'泰来县','T',1,0,0),(1504,176,'甘南县','G',1,0,0),(1505,176,'富裕县','F',1,0,0),(1506,176,'克山县','K',1,0,0),(1507,176,'克东县','K',1,0,0),(1508,176,'拜泉县','B',1,0,0),(1509,177,'尖山区','J',1,0,0),(1510,177,'岭东区','L',1,0,0),(1511,177,'四方台区','S',1,0,0),(1512,177,'宝山区','B',1,0,0),(1513,177,'集贤县','J',1,0,0),(1514,177,'友谊县','Y',1,0,0),(1515,177,'宝清县','B',1,0,0),(1516,177,'饶河县','R',1,0,0),(1517,178,'北林区','B',1,0,0),(1518,178,'安达市','A',1,0,0),(1519,178,'肇东市','Z',1,0,0),(1520,178,'海伦市','H',1,0,0),(1521,178,'望奎县','W',1,0,0),(1522,178,'兰西县','L',1,0,0),(1523,178,'青冈县','Q',1,0,0),(1524,178,'庆安县','Q',1,0,0),(1525,178,'明水县','M',1,0,0),(1526,178,'绥棱县','S',1,0,0),(1527,179,'伊春区','Y',1,0,0),(1528,179,'带岭区','D',1,0,0),(1529,179,'南岔区','N',1,0,0),(1530,179,'金山屯区','J',1,0,0),(1531,179,'西林区','X',1,0,0),(1532,179,'美溪区','M',1,0,0),(1533,179,'乌马河区','W',1,0,0),(1534,179,'翠峦区','C',1,0,0),(1535,179,'友好区','Y',1,0,0),(1536,179,'上甘岭区','S',1,0,0),(1537,179,'五营区','W',1,0,0),(1538,179,'红星区','H',1,0,0),(1539,179,'新青区','X',1,0,0),(1540,179,'汤旺河区','T',1,0,0),(1541,179,'乌伊岭区','W',1,0,0),(1542,179,'铁力市','T',1,0,0),(1543,179,'嘉荫县','J',1,0,0),(1544,180,'江岸区','J',1,0,0),(1545,180,'武昌区','W',1,0,0),(1546,180,'江汉区','J',1,0,0),(1547,180,'硚口区','C',1,0,0),(1548,180,'汉阳区','H',1,0,0),(1549,180,'青山区','Q',1,0,0),(1550,180,'洪山区','H',1,0,0),(1551,180,'东西湖区','D',1,0,0),(1552,180,'汉南区','H',1,0,0),(1553,180,'蔡甸区','C',1,0,0),(1554,180,'江夏区','J',1,0,0),(1555,180,'黄陂区','H',1,0,0),(1556,180,'新洲区','X',1,0,0),(1557,180,'经济开发区','J',1,0,0),(1558,181,'仙桃市','X',1,0,0),(1559,182,'鄂城区','E',1,0,0),(1560,182,'华容区','H',1,0,0),(1561,182,'梁子湖区','L',1,0,0),(1562,183,'黄州区','H',1,0,0),(1563,183,'麻城市','M',1,0,0),(1564,183,'武穴市','W',1,0,0),(1565,183,'团风县','T',1,0,0),(1566,183,'红安县','H',1,0,0),(1567,183,'罗田县','L',1,0,0),(1568,183,'英山县','Y',1,0,0),(1569,183,'浠水县','Z',1,0,0),(1570,183,'蕲春县','Z',1,0,0),(1571,183,'黄梅县','H',1,0,0),(1572,184,'黄石港区','H',1,0,0),(1573,184,'西塞山区','X',1,0,0),(1574,184,'下陆区','X',1,0,0),(1575,184,'铁山区','T',1,0,0),(1576,184,'大冶市','D',1,0,0),(1577,184,'阳新县','Y',1,0,0),(1578,185,'东宝区','D',1,0,0),(1579,185,'掇刀区','D',1,0,0),(1580,185,'钟祥市','Z',1,0,0),(1581,185,'京山县','J',1,0,0),(1582,185,'沙洋县','S',1,0,0),(1583,186,'沙市区','S',1,0,0),(1584,186,'荆州区','J',1,0,0),(1585,186,'石首市','S',1,0,0),(1586,186,'洪湖市','H',1,0,0),(1587,186,'松滋市','S',1,0,0),(1588,186,'公安县','G',1,0,0),(1589,186,'监利县','J',1,0,0),(1590,186,'江陵县','J',1,0,0),(1591,187,'潜江市','Q',1,0,0),(1592,188,'神农架林区','S',1,0,0),(1593,189,'张湾区','Z',1,0,0),(1594,189,'茅箭区','M',1,0,0),(1595,189,'丹江口市','D',1,0,0),(1596,189,'郧县','Y',1,0,0),(1597,189,'郧西县','Y',1,0,0),(1598,189,'竹山县','Z',1,0,0),(1599,189,'竹溪县','Z',1,0,0),(1600,189,'房县','F',1,0,0),(1601,190,'曾都区','Z',1,0,0),(1602,190,'广水市','G',1,0,0),(1603,191,'天门市','T',1,0,0),(1604,192,'咸安区','X',1,0,0),(1605,192,'赤壁市','C',1,0,0),(1606,192,'嘉鱼县','J',1,0,0),(1607,192,'通城县','T',1,0,0),(1608,192,'崇阳县','C',1,0,0),(1609,192,'通山县','T',1,0,0),(1610,193,'襄城区','X',1,0,0),(1611,193,'樊城区','F',1,0,0),(1612,193,'襄阳区','X',1,0,0),(1613,193,'老河口市','L',1,0,0),(1614,193,'枣阳市','Z',1,0,0),(1615,193,'宜城市','Y',1,0,0),(1616,193,'南漳县','N',1,0,0),(1617,193,'谷城县','G',1,0,0),(1618,193,'保康县','B',1,0,0),(1619,194,'孝南区','X',1,0,0),(1620,194,'应城市','Y',1,0,0),(1621,194,'安陆市','A',1,0,0),(1622,194,'汉川市','H',1,0,0),(1623,194,'孝昌县','X',1,0,0),(1624,194,'大悟县','D',1,0,0),(1625,194,'云梦县','Y',1,0,0),(1626,195,'长阳','C',1,0,0),(1627,195,'五峰','W',1,0,0),(1628,195,'西陵区','X',1,0,0),(1629,195,'伍家岗区','W',1,0,0),(1630,195,'点军区','D',1,0,0),(1631,195,'猇亭区','~',1,0,0),(1632,195,'夷陵区','Y',1,0,0),(1633,195,'宜都市','Y',1,0,0),(1634,195,'当阳市','D',1,0,0),(1635,195,'枝江市','Z',1,0,0),(1636,195,'远安县','Y',1,0,0),(1637,195,'兴山县','X',1,0,0),(1638,195,'秭归县','Z',1,0,0),(1639,196,'恩施市','E',1,0,0),(1640,196,'利川市','L',1,0,0),(1641,196,'建始县','J',1,0,0),(1642,196,'巴东县','B',1,0,0),(1643,196,'宣恩县','X',1,0,0),(1644,196,'咸丰县','X',1,0,0),(1645,196,'来凤县','L',1,0,0),(1646,196,'鹤峰县','H',1,0,0),(1647,197,'岳麓区','Y',1,0,0),(1648,197,'芙蓉区','Z',1,0,0),(1649,197,'天心区','T',1,0,0),(1650,197,'开福区','K',1,0,0),(1651,197,'雨花区','Y',1,0,0),(1652,197,'开发区','K',1,0,0),(1653,197,'浏阳市','Z',1,0,0),(1654,197,'长沙县','C',1,0,0),(1655,197,'望城县','W',1,0,0),(1656,197,'宁乡县','N',1,0,0),(1657,198,'永定区','Y',1,0,0),(1658,198,'武陵源区','W',1,0,0),(1659,198,'慈利县','C',1,0,0),(1660,198,'桑植县','S',1,0,0),(1661,199,'武陵区','W',1,0,0),(1662,199,'鼎城区','D',1,0,0),(1663,199,'津市市','J',1,0,0),(1664,199,'安乡县','A',1,0,0),(1665,199,'汉寿县','H',1,0,0),(1666,199,'澧县','Z',1,0,0),(1667,199,'临澧县','L',1,0,0),(1668,199,'桃源县','T',1,0,0),(1669,199,'石门县','S',1,0,0),(1670,200,'北湖区','B',1,0,0),(1671,200,'苏仙区','S',1,0,0),(1672,200,'资兴市','Z',1,0,0),(1673,200,'桂阳县','G',1,0,0),(1674,200,'宜章县','Y',1,0,0),(1675,200,'永兴县','Y',1,0,0),(1676,200,'嘉禾县','J',1,0,0),(1677,200,'临武县','L',1,0,0),(1678,200,'汝城县','R',1,0,0),(1679,200,'桂东县','G',1,0,0),(1680,200,'安仁县','A',1,0,0),(1681,201,'雁峰区','Y',1,0,0),(1682,201,'珠晖区','Z',1,0,0),(1683,201,'石鼓区','S',1,0,0),(1684,201,'蒸湘区','Z',1,0,0),(1685,201,'南岳区','N',1,0,0),(1686,201,'耒阳市','Z',1,0,0),(1687,201,'常宁市','C',1,0,0),(1688,201,'衡阳县','H',1,0,0),(1689,201,'衡南县','H',1,0,0),(1690,201,'衡山县','H',1,0,0),(1691,201,'衡东县','H',1,0,0),(1692,201,'祁东县','Q',1,0,0),(1693,202,'鹤城区','H',1,0,0),(1694,202,'靖州','J',1,0,0),(1695,202,'麻阳','M',1,0,0),(1696,202,'通道','T',1,0,0),(1697,202,'新晃','X',1,0,0),(1698,202,'芷江','Z',1,0,0),(1699,202,'沅陵县','Z',1,0,0),(1700,202,'辰溪县','C',1,0,0),(1701,202,'溆浦县','Z',1,0,0),(1702,202,'中方县','Z',1,0,0),(1703,202,'会同县','H',1,0,0),(1704,202,'洪江市','H',1,0,0),(1705,203,'娄星区','L',1,0,0),(1706,203,'冷水江市','L',1,0,0),(1707,203,'涟源市','L',1,0,0),(1708,203,'双峰县','S',1,0,0),(1709,203,'新化县','X',1,0,0),(1710,204,'城步','C',1,0,0),(1711,204,'双清区','S',1,0,0),(1712,204,'大祥区','D',1,0,0),(1713,204,'北塔区','B',1,0,0),(1714,204,'武冈市','W',1,0,0),(1715,204,'邵东县','S',1,0,0),(1716,204,'新邵县','X',1,0,0),(1717,204,'邵阳县','S',1,0,0),(1718,204,'隆回县','L',1,0,0),(1719,204,'洞口县','D',1,0,0),(1720,204,'绥宁县','S',1,0,0),(1721,204,'新宁县','X',1,0,0),(1722,205,'岳塘区','Y',1,0,0),(1723,205,'雨湖区','Y',1,0,0),(1724,205,'湘乡市','X',1,0,0),(1725,205,'韶山市','S',1,0,0),(1726,205,'湘潭县','X',1,0,0),(1727,206,'吉首市','J',1,0,0),(1728,206,'泸溪县','Z',1,0,0),(1729,206,'凤凰县','F',1,0,0),(1730,206,'花垣县','H',1,0,0),(1731,206,'保靖县','B',1,0,0),(1732,206,'古丈县','G',1,0,0),(1733,206,'永顺县','Y',1,0,0),(1734,206,'龙山县','L',1,0,0),(1735,207,'赫山区','H',1,0,0),(1736,207,'资阳区','Z',1,0,0),(1737,207,'沅江市','Z',1,0,0),(1738,207,'南县','N',1,0,0),(1739,207,'桃江县','T',1,0,0),(1740,207,'安化县','A',1,0,0),(1741,208,'江华','J',1,0,0),(1742,208,'冷水滩区','L',1,0,0),(1743,208,'零陵区','L',1,0,0),(1744,208,'祁阳县','Q',1,0,0),(1745,208,'东安县','D',1,0,0),(1746,208,'双牌县','S',1,0,0),(1747,208,'道县','D',1,0,0),(1748,208,'江永县','J',1,0,0),(1749,208,'宁远县','N',1,0,0),(1750,208,'蓝山县','L',1,0,0),(1751,208,'新田县','X',1,0,0),(1752,209,'岳阳楼区','Y',1,0,0),(1753,209,'君山区','J',1,0,0),(1754,209,'云溪区','Y',1,0,0),(1755,209,'汨罗市','Z',1,0,0),(1756,209,'临湘市','L',1,0,0),(1757,209,'岳阳县','Y',1,0,0),(1758,209,'华容县','H',1,0,0),(1759,209,'湘阴县','X',1,0,0),(1760,209,'平江县','P',1,0,0),(1761,210,'天元区','T',1,0,0),(1762,210,'荷塘区','H',1,0,0),(1763,210,'芦淞区','L',1,0,0),(1764,210,'石峰区','S',1,0,0),(1765,210,'醴陵市','Z',1,0,0),(1766,210,'株洲县','Z',1,0,0),(1767,210,'攸县','Z',1,0,0),(1768,210,'茶陵县','C',1,0,0),(1769,210,'炎陵县','Y',1,0,0),(1770,211,'朝阳区','C',1,0,0),(1771,211,'宽城区','K',1,0,0),(1772,211,'二道区','E',1,0,0),(1773,211,'南关区','N',1,0,0),(1774,211,'绿园区','L',1,0,0),(1775,211,'双阳区','S',1,0,0),(1776,211,'净月潭开发区','J',1,0,0),(1777,211,'高新技术开发区','G',1,0,0),(1778,211,'经济技术开发区','J',1,0,0),(1779,211,'汽车产业开发区','Q',1,0,0),(1780,211,'德惠市','D',1,0,0),(1781,211,'九台市','J',1,0,0),(1782,211,'榆树市','Y',1,0,0),(1783,211,'农安县','N',1,0,0),(1784,212,'船营区','C',1,0,0),(1785,212,'昌邑区','C',1,0,0),(1786,212,'龙潭区','L',1,0,0),(1787,212,'丰满区','F',1,0,0),(1788,212,'蛟河市','Z',1,0,0),(1789,212,'桦甸市','Z',1,0,0),(1790,212,'舒兰市','S',1,0,0),(1791,212,'磐石市','P',1,0,0),(1792,212,'永吉县','Y',1,0,0),(1793,213,'洮北区','Z',1,0,0),(1794,213,'洮南市','Z',1,0,0),(1795,213,'大安市','D',1,0,0),(1796,213,'镇赉县','Z',1,0,0),(1797,213,'通榆县','T',1,0,0),(1798,214,'江源区','J',1,0,0),(1799,214,'八道江区','B',1,0,0),(1800,214,'长白','C',1,0,0),(1801,214,'临江市','L',1,0,0),(1802,214,'抚松县','F',1,0,0),(1803,214,'靖宇县','J',1,0,0),(1804,215,'龙山区','L',1,0,0),(1805,215,'西安区','X',1,0,0),(1806,215,'东丰县','D',1,0,0),(1807,215,'东辽县','D',1,0,0),(1808,216,'铁西区','T',1,0,0),(1809,216,'铁东区','T',1,0,0),(1810,216,'伊通','Y',1,0,0),(1811,216,'公主岭市','G',1,0,0),(1812,216,'双辽市','S',1,0,0),(1813,216,'梨树县','L',1,0,0),(1814,217,'前郭尔罗斯','Q',1,0,0),(1815,217,'宁江区','N',1,0,0),(1816,217,'长岭县','C',1,0,0),(1817,217,'乾安县','Q',1,0,0),(1818,217,'扶余县','F',1,0,0),(1819,218,'东昌区','D',1,0,0),(1820,218,'二道江区','E',1,0,0),(1821,218,'梅河口市','M',1,0,0),(1822,218,'集安市','J',1,0,0),(1823,218,'通化县','T',1,0,0),(1824,218,'辉南县','H',1,0,0),(1825,218,'柳河县','L',1,0,0),(1826,219,'延吉市','Y',1,0,0),(1827,219,'图们市','T',1,0,0),(1828,219,'敦化市','D',1,0,0),(1829,219,'珲春市','Z',1,0,0),(1830,219,'龙井市','L',1,0,0),(1831,219,'和龙市','H',1,0,0),(1832,219,'安图县','A',1,0,0),(1833,219,'汪清县','W',1,0,0),(1834,220,'玄武区','X',1,0,0),(1835,220,'鼓楼区','G',1,0,0),(1836,220,'白下区','B',1,0,0),(1837,220,'建邺区','J',1,0,0),(1838,220,'秦淮区','Q',1,0,0),(1839,220,'雨花台区','Y',1,0,0),(1840,220,'下关区','X',1,0,0),(1841,220,'栖霞区','Q',1,0,0),(1842,220,'浦口区','P',1,0,0),(1843,220,'江宁区','J',1,0,0),(1844,220,'六合区','L',1,0,0),(1845,220,'溧水县','Z',1,0,0),(1846,220,'高淳县','G',1,0,0),(1847,221,'沧浪区','C',1,0,0),(1848,221,'金阊区','J',1,0,0),(1849,221,'平江区','P',1,0,0),(1850,221,'虎丘区','H',1,0,0),(1851,221,'吴中区','W',1,0,0),(1852,221,'相城区','X',1,0,0),(1853,221,'园区','Y',1,0,0),(1854,221,'新区','X',1,0,0),(1855,221,'常熟市','C',1,0,0),(1856,221,'张家港市','Z',1,0,0),(1857,221,'玉山镇','Y',1,0,0),(1858,221,'巴城镇','B',1,0,0),(1859,221,'周市镇','Z',1,0,0),(1860,221,'陆家镇','L',1,0,0),(1861,221,'花桥镇','H',1,0,0),(1862,221,'淀山湖镇','D',1,0,0),(1863,221,'张浦镇','Z',1,0,0),(1864,221,'周庄镇','Z',1,0,0),(1865,221,'千灯镇','Q',1,0,0),(1866,221,'锦溪镇','J',1,0,0),(1867,221,'开发区','K',1,0,0),(1868,221,'吴江市','W',1,0,0),(1869,221,'太仓市','T',1,0,0),(1870,222,'崇安区','C',1,0,0),(1871,222,'北塘区','B',1,0,0),(1872,222,'南长区','N',1,0,0),(1873,222,'锡山区','X',1,0,0),(1874,222,'惠山区','H',1,0,0),(1875,222,'滨湖区','B',1,0,0),(1876,222,'新区','X',1,0,0),(1877,222,'江阴市','J',1,0,0),(1878,222,'宜兴市','Y',1,0,0),(1879,223,'天宁区','T',1,0,0),(1880,223,'钟楼区','Z',1,0,0),(1881,223,'戚墅堰区','Q',1,0,0),(1882,223,'郊区','J',1,0,0),(1883,223,'新北区','X',1,0,0),(1884,223,'武进区','W',1,0,0),(1885,223,'溧阳市','Z',1,0,0),(1886,223,'金坛市','J',1,0,0),(1887,224,'清河区','Q',1,0,0),(1888,224,'清浦区','Q',1,0,0),(1889,224,'楚州区','C',1,0,0),(1890,224,'淮阴区','H',1,0,0),(1891,224,'涟水县','L',1,0,0),(1892,224,'洪泽县','H',1,0,0),(1893,224,'盱眙县','Z',1,0,0),(1894,224,'金湖县','J',1,0,0),(1895,225,'新浦区','X',1,0,0),(1896,225,'连云区','L',1,0,0),(1897,225,'海州区','H',1,0,0),(1898,225,'赣榆县','G',1,0,0),(1899,225,'东海县','D',1,0,0),(1900,225,'灌云县','G',1,0,0),(1901,225,'灌南县','G',1,0,0),(1902,226,'崇川区','C',1,0,0),(1903,226,'港闸区','G',1,0,0),(1904,226,'经济开发区','J',1,0,0),(1905,226,'启东市','Q',1,0,0),(1906,226,'如皋市','R',1,0,0),(1907,226,'通州市','T',1,0,0),(1908,226,'海门市','H',1,0,0),(1909,226,'海安县','H',1,0,0),(1910,226,'如东县','R',1,0,0),(1911,227,'宿城区','S',1,0,0),(1912,227,'宿豫区','S',1,0,0),(1913,227,'宿豫县','S',1,0,0),(1914,227,'沭阳县','Z',1,0,0),(1915,227,'泗阳县','Z',1,0,0),(1916,227,'泗洪县','Z',1,0,0),(1917,228,'海陵区','H',1,0,0),(1918,228,'高港区','G',1,0,0),(1919,228,'兴化市','X',1,0,0),(1920,228,'靖江市','J',1,0,0),(1921,228,'泰兴市','T',1,0,0),(1922,228,'姜堰市','J',1,0,0),(1923,229,'云龙区','Y',1,0,0),(1924,229,'鼓楼区','G',1,0,0),(1925,229,'九里区','J',1,0,0),(1926,229,'贾汪区','J',1,0,0),(1927,229,'泉山区','Q',1,0,0),(1928,229,'新沂市','X',1,0,0),(1929,229,'邳州市','Z',1,0,0),(1930,229,'丰县','F',1,0,0),(1931,229,'沛县','P',1,0,0),(1932,229,'铜山县','T',1,0,0),(1933,229,'睢宁县','Z',1,0,0),(1934,230,'城区','C',1,0,0),(1935,230,'亭湖区','T',1,0,0),(1936,230,'盐都区','Y',1,0,0),(1937,230,'盐都县','Y',1,0,0),(1938,230,'东台市','D',1,0,0),(1939,230,'大丰市','D',1,0,0),(1940,230,'响水县','X',1,0,0),(1941,230,'滨海县','B',1,0,0),(1942,230,'阜宁县','F',1,0,0),(1943,230,'射阳县','S',1,0,0),(1944,230,'建湖县','J',1,0,0),(1945,231,'广陵区','G',1,0,0),(1946,231,'维扬区','W',1,0,0),(1947,231,'邗江区','Z',1,0,0),(1948,231,'仪征市','Y',1,0,0),(1949,231,'高邮市','G',1,0,0),(1950,231,'江都市','J',1,0,0),(1951,231,'宝应县','B',1,0,0),(1952,232,'京口区','J',1,0,0),(1953,232,'润州区','R',1,0,0),(1954,232,'丹徒区','D',1,0,0),(1955,232,'丹阳市','D',1,0,0),(1956,232,'扬中市','Y',1,0,0),(1957,232,'句容市','J',1,0,0),(1958,233,'东湖区','D',1,0,0),(1959,233,'西湖区','X',1,0,0),(1960,233,'青云谱区','Q',1,0,0),(1961,233,'湾里区','W',1,0,0),(1962,233,'青山湖区','Q',1,0,0),(1963,233,'红谷滩新区','H',1,0,0),(1964,233,'昌北区','C',1,0,0),(1965,233,'高新区','G',1,0,0),(1966,233,'南昌县','N',1,0,0),(1967,233,'新建县','X',1,0,0),(1968,233,'安义县','A',1,0,0),(1969,233,'进贤县','J',1,0,0),(1970,234,'临川区','L',1,0,0),(1971,234,'南城县','N',1,0,0),(1972,234,'黎川县','L',1,0,0),(1973,234,'南丰县','N',1,0,0),(1974,234,'崇仁县','C',1,0,0),(1975,234,'乐安县','L',1,0,0),(1976,234,'宜黄县','Y',1,0,0),(1977,234,'金溪县','J',1,0,0),(1978,234,'资溪县','Z',1,0,0),(1979,234,'东乡县','D',1,0,0),(1980,234,'广昌县','G',1,0,0),(1981,235,'章贡区','Z',1,0,0),(1982,235,'于都县','Y',1,0,0),(1983,235,'瑞金市','R',1,0,0),(1984,235,'南康市','N',1,0,0),(1985,235,'赣县','G',1,0,0),(1986,235,'信丰县','X',1,0,0),(1987,235,'大余县','D',1,0,0),(1988,235,'上犹县','S',1,0,0),(1989,235,'崇义县','C',1,0,0),(1990,235,'安远县','A',1,0,0),(1991,235,'龙南县','L',1,0,0),(1992,235,'定南县','D',1,0,0),(1993,235,'全南县','Q',1,0,0),(1994,235,'宁都县','N',1,0,0),(1995,235,'兴国县','X',1,0,0),(1996,235,'会昌县','H',1,0,0),(1997,235,'寻乌县','X',1,0,0),(1998,235,'石城县','S',1,0,0),(1999,236,'安福县','A',1,0,0),(2000,236,'吉州区','J',1,0,0),(2001,236,'青原区','Q',1,0,0),(2002,236,'井冈山市','J',1,0,0),(2003,236,'吉安县','J',1,0,0),(2004,236,'吉水县','J',1,0,0),(2005,236,'峡江县','X',1,0,0),(2006,236,'新干县','X',1,0,0),(2007,236,'永丰县','Y',1,0,0),(2008,236,'泰和县','T',1,0,0),(2009,236,'遂川县','S',1,0,0),(2010,236,'万安县','W',1,0,0),(2011,236,'永新县','Y',1,0,0),(2012,237,'珠山区','Z',1,0,0),(2013,237,'昌江区','C',1,0,0),(2014,237,'乐平市','L',1,0,0),(2015,237,'浮梁县','F',1,0,0),(2016,238,'浔阳区','Z',1,0,0),(2017,238,'庐山区','L',1,0,0),(2018,238,'瑞昌市','R',1,0,0),(2019,238,'九江县','J',1,0,0),(2020,238,'武宁县','W',1,0,0),(2021,238,'修水县','X',1,0,0),(2022,238,'永修县','Y',1,0,0),(2023,238,'德安县','D',1,0,0),(2024,238,'星子县','X',1,0,0),(2025,238,'都昌县','D',1,0,0),(2026,238,'湖口县','H',1,0,0),(2027,238,'彭泽县','P',1,0,0),(2028,239,'安源区','A',1,0,0),(2029,239,'湘东区','X',1,0,0),(2030,239,'莲花县','L',1,0,0),(2031,239,'芦溪县','L',1,0,0),(2032,239,'上栗县','S',1,0,0),(2033,240,'信州区','X',1,0,0),(2034,240,'德兴市','D',1,0,0),(2035,240,'上饶县','S',1,0,0),(2036,240,'广丰县','G',1,0,0),(2037,240,'玉山县','Y',1,0,0),(2038,240,'铅山县','Q',1,0,0),(2039,240,'横峰县','H',1,0,0),(2040,240,'弋阳县','Z',1,0,0),(2041,240,'余干县','Y',1,0,0),(2042,240,'波阳县','B',1,0,0),(2043,240,'万年县','W',1,0,0),(2044,240,'婺源县','Z',1,0,0),(2045,241,'渝水区','Y',1,0,0),(2046,241,'分宜县','F',1,0,0),(2047,242,'袁州区','Y',1,0,0),(2048,242,'丰城市','F',1,0,0),(2049,242,'樟树市','Z',1,0,0),(2050,242,'高安市','G',1,0,0),(2051,242,'奉新县','F',1,0,0),(2052,242,'万载县','W',1,0,0),(2053,242,'上高县','S',1,0,0),(2054,242,'宜丰县','Y',1,0,0),(2055,242,'靖安县','J',1,0,0),(2056,242,'铜鼓县','T',1,0,0),(2057,243,'月湖区','Y',1,0,0),(2058,243,'贵溪市','G',1,0,0),(2059,243,'余江县','Y',1,0,0),(2060,244,'沈河区','S',1,0,0),(2061,244,'皇姑区','H',1,0,0),(2062,244,'和平区','H',1,0,0),(2063,244,'大东区','D',1,0,0),(2064,244,'铁西区','T',1,0,0),(2065,244,'苏家屯区','S',1,0,0),(2066,244,'东陵区','D',1,0,0),(2067,244,'沈北新区','S',1,0,0),(2068,244,'于洪区','Y',1,0,0),(2069,244,'浑南新区','H',1,0,0),(2070,244,'新民市','X',1,0,0),(2071,244,'辽中县','L',1,0,0),(2072,244,'康平县','K',1,0,0),(2073,244,'法库县','F',1,0,0),(2074,245,'西岗区','X',1,0,0),(2075,245,'中山区','Z',1,0,0),(2076,245,'沙河口区','S',1,0,0),(2077,245,'甘井子区','G',1,0,0),(2078,245,'旅顺口区','L',1,0,0),(2079,245,'金州区','J',1,0,0),(2080,245,'开发区','K',1,0,0),(2081,245,'瓦房店市','W',1,0,0),(2082,245,'普兰店市','P',1,0,0),(2083,245,'庄河市','Z',1,0,0),(2084,245,'长海县','C',1,0,0),(2085,246,'铁东区','T',1,0,0),(2086,246,'铁西区','T',1,0,0),(2087,246,'立山区','L',1,0,0),(2088,246,'千山区','Q',1,0,0),(2089,246,'岫岩','Z',1,0,0),(2090,246,'海城市','H',1,0,0),(2091,246,'台安县','T',1,0,0),(2092,247,'本溪','B',1,0,0),(2093,247,'平山区','P',1,0,0),(2094,247,'明山区','M',1,0,0),(2095,247,'溪湖区','X',1,0,0),(2096,247,'南芬区','N',1,0,0),(2097,247,'桓仁','H',1,0,0),(2098,248,'双塔区','S',1,0,0),(2099,248,'龙城区','L',1,0,0),(2100,248,'喀喇沁左翼蒙古族自治县','K',1,0,0),(2101,248,'北票市','B',1,0,0),(2102,248,'凌源市','L',1,0,0),(2103,248,'朝阳县','C',1,0,0),(2104,248,'建平县','J',1,0,0),(2105,249,'振兴区','Z',1,0,0),(2106,249,'元宝区','Y',1,0,0),(2107,249,'振安区','Z',1,0,0),(2108,249,'宽甸','K',1,0,0),(2109,249,'东港市','D',1,0,0),(2110,249,'凤城市','F',1,0,0),(2111,250,'顺城区','S',1,0,0),(2112,250,'新抚区','X',1,0,0),(2113,250,'东洲区','D',1,0,0),(2114,250,'望花区','W',1,0,0),(2115,250,'清原','Q',1,0,0),(2116,250,'新宾','X',1,0,0),(2117,250,'抚顺县','F',1,0,0),(2118,251,'阜新','F',1,0,0),(2119,251,'海州区','H',1,0,0),(2120,251,'新邱区','X',1,0,0),(2121,251,'太平区','T',1,0,0),(2122,251,'清河门区','Q',1,0,0),(2123,251,'细河区','X',1,0,0),(2124,251,'彰武县','Z',1,0,0),(2125,252,'龙港区','L',1,0,0),(2126,252,'南票区','N',1,0,0),(2127,252,'连山区','L',1,0,0),(2128,252,'兴城市','X',1,0,0),(2129,252,'绥中县','S',1,0,0),(2130,252,'建昌县','J',1,0,0),(2131,253,'太和区','T',1,0,0),(2132,253,'古塔区','G',1,0,0),(2133,253,'凌河区','L',1,0,0),(2134,253,'凌海市','L',1,0,0),(2135,253,'北镇市','B',1,0,0),(2136,253,'黑山县','H',1,0,0),(2137,253,'义县','Y',1,0,0),(2138,254,'白塔区','B',1,0,0),(2139,254,'文圣区','W',1,0,0),(2140,254,'宏伟区','H',1,0,0),(2141,254,'太子河区','T',1,0,0),(2142,254,'弓长岭区','G',1,0,0),(2143,254,'灯塔市','D',1,0,0),(2144,254,'辽阳县','L',1,0,0),(2145,255,'双台子区','S',1,0,0),(2146,255,'兴隆台区','X',1,0,0),(2147,255,'大洼县','D',1,0,0),(2148,255,'盘山县','P',1,0,0),(2149,256,'银州区','Y',1,0,0),(2150,256,'清河区','Q',1,0,0),(2151,256,'调兵山市','D',1,0,0),(2152,256,'开原市','K',1,0,0),(2153,256,'铁岭县','T',1,0,0),(2154,256,'西丰县','X',1,0,0),(2155,256,'昌图县','C',1,0,0),(2156,257,'站前区','Z',1,0,0),(2157,257,'西市区','X',1,0,0),(2158,257,'鲅鱼圈区','Z',1,0,0),(2159,257,'老边区','L',1,0,0),(2160,257,'盖州市','G',1,0,0),(2161,257,'大石桥市','D',1,0,0),(2162,258,'回民区','H',1,0,0),(2163,258,'玉泉区','Y',1,0,0),(2164,258,'新城区','X',1,0,0),(2165,258,'赛罕区','S',1,0,0),(2166,258,'清水河县','Q',1,0,0),(2167,258,'土默特左旗','T',1,0,0),(2168,258,'托克托县','T',1,0,0),(2169,258,'和林格尔县','H',1,0,0),(2170,258,'武川县','W',1,0,0),(2171,259,'阿拉善左旗','A',1,0,0),(2172,259,'阿拉善右旗','A',1,0,0),(2173,259,'额济纳旗','E',1,0,0),(2174,260,'临河区','L',1,0,0),(2175,260,'五原县','W',1,0,0),(2176,260,'磴口县','Z',1,0,0),(2177,260,'乌拉特前旗','W',1,0,0),(2178,260,'乌拉特中旗','W',1,0,0),(2179,260,'乌拉特后旗','W',1,0,0),(2180,260,'杭锦后旗','H',1,0,0),(2181,261,'昆都仑区','K',1,0,0),(2182,261,'青山区','Q',1,0,0),(2183,261,'东河区','D',1,0,0),(2184,261,'九原区','J',1,0,0),(2185,261,'石拐区','S',1,0,0),(2186,261,'白云矿区','B',1,0,0),(2187,261,'土默特右旗','T',1,0,0),(2188,261,'固阳县','G',1,0,0),(2189,261,'达尔罕茂明安联合旗','D',1,0,0),(2190,262,'红山区','H',1,0,0),(2191,262,'元宝山区','Y',1,0,0),(2192,262,'松山区','S',1,0,0),(2193,262,'阿鲁科尔沁旗','A',1,0,0),(2194,262,'巴林左旗','B',1,0,0),(2195,262,'巴林右旗','B',1,0,0),(2196,262,'林西县','L',1,0,0),(2197,262,'克什克腾旗','K',1,0,0),(2198,262,'翁牛特旗','W',1,0,0),(2199,262,'喀喇沁旗','K',1,0,0),(2200,262,'宁城县','N',1,0,0),(2201,262,'敖汉旗','A',1,0,0),(2202,263,'东胜区','D',1,0,0),(2203,263,'达拉特旗','D',1,0,0),(2204,263,'准格尔旗','Z',1,0,0),(2205,263,'鄂托克前旗','E',1,0,0),(2206,263,'鄂托克旗','E',1,0,0),(2207,263,'杭锦旗','H',1,0,0),(2208,263,'乌审旗','W',1,0,0),(2209,263,'伊金霍洛旗','Y',1,0,0),(2210,264,'海拉尔区','H',1,0,0),(2211,264,'莫力达瓦','M',1,0,0),(2212,264,'满洲里市','M',1,0,0),(2213,264,'牙克石市','Y',1,0,0),(2214,264,'扎兰屯市','Z',1,0,0),(2215,264,'额尔古纳市','E',1,0,0),(2216,264,'根河市','G',1,0,0),(2217,264,'阿荣旗','A',1,0,0),(2218,264,'鄂伦春自治旗','E',1,0,0),(2219,264,'鄂温克族自治旗','E',1,0,0),(2220,264,'陈巴尔虎旗','C',1,0,0),(2221,264,'新巴尔虎左旗','X',1,0,0),(2222,264,'新巴尔虎右旗','X',1,0,0),(2223,265,'科尔沁区','K',1,0,0),(2224,265,'霍林郭勒市','H',1,0,0),(2225,265,'科尔沁左翼中旗','K',1,0,0),(2226,265,'科尔沁左翼后旗','K',1,0,0),(2227,265,'开鲁县','K',1,0,0),(2228,265,'库伦旗','K',1,0,0),(2229,265,'奈曼旗','N',1,0,0),(2230,265,'扎鲁特旗','Z',1,0,0),(2231,266,'海勃湾区','H',1,0,0),(2232,266,'乌达区','W',1,0,0),(2233,266,'海南区','H',1,0,0),(2234,267,'化德县','H',1,0,0),(2235,267,'集宁区','J',1,0,0),(2236,267,'丰镇市','F',1,0,0),(2237,267,'卓资县','Z',1,0,0),(2238,267,'商都县','S',1,0,0),(2239,267,'兴和县','X',1,0,0),(2240,267,'凉城县','L',1,0,0),(2241,267,'察哈尔右翼前旗','C',1,0,0),(2242,267,'察哈尔右翼中旗','C',1,0,0),(2243,267,'察哈尔右翼后旗','C',1,0,0),(2244,267,'四子王旗','S',1,0,0),(2245,268,'二连浩特市','E',1,0,0),(2246,268,'锡林浩特市','X',1,0,0),(2247,268,'阿巴嘎旗','A',1,0,0),(2248,268,'苏尼特左旗','S',1,0,0),(2249,268,'苏尼特右旗','S',1,0,0),(2250,268,'东乌珠穆沁旗','D',1,0,0),(2251,268,'西乌珠穆沁旗','X',1,0,0),(2252,268,'太仆寺旗','T',1,0,0),(2253,268,'镶黄旗','X',1,0,0),(2254,268,'正镶白旗','Z',1,0,0),(2255,268,'正蓝旗','Z',1,0,0),(2256,268,'多伦县','D',1,0,0),(2257,269,'乌兰浩特市','W',1,0,0),(2258,269,'阿尔山市','A',1,0,0),(2259,269,'科尔沁右翼前旗','K',1,0,0),(2260,269,'科尔沁右翼中旗','K',1,0,0),(2261,269,'扎赉特旗','Z',1,0,0),(2262,269,'突泉县','T',1,0,0),(2263,270,'西夏区','X',1,0,0),(2264,270,'金凤区','J',1,0,0),(2265,270,'兴庆区','X',1,0,0),(2266,270,'灵武市','L',1,0,0),(2267,270,'永宁县','Y',1,0,0),(2268,270,'贺兰县','H',1,0,0),(2269,271,'原州区','Y',1,0,0),(2270,271,'海原县','H',1,0,0),(2271,271,'西吉县','X',1,0,0),(2272,271,'隆德县','L',1,0,0),(2273,271,'泾源县','Z',1,0,0),(2274,271,'彭阳县','P',1,0,0),(2275,272,'惠农县','H',1,0,0),(2276,272,'大武口区','D',1,0,0),(2277,272,'惠农区','H',1,0,0),(2278,272,'陶乐县','T',1,0,0),(2279,272,'平罗县','P',1,0,0),(2280,273,'利通区','L',1,0,0),(2281,273,'中卫县','Z',1,0,0),(2282,273,'青铜峡市','Q',1,0,0),(2283,273,'中宁县','Z',1,0,0),(2284,273,'盐池县','Y',1,0,0),(2285,273,'同心县','T',1,0,0),(2286,274,'沙坡头区','S',1,0,0),(2287,274,'海原县','H',1,0,0),(2288,274,'中宁县','Z',1,0,0),(2289,275,'城中区','C',1,0,0),(2290,275,'城东区','C',1,0,0),(2291,275,'城西区','C',1,0,0),(2292,275,'城北区','C',1,0,0),(2293,275,'湟中县','Z',1,0,0),(2294,275,'湟源县','Z',1,0,0),(2295,275,'大通','D',1,0,0),(2296,276,'玛沁县','M',1,0,0),(2297,276,'班玛县','B',1,0,0),(2298,276,'甘德县','G',1,0,0),(2299,276,'达日县','D',1,0,0),(2300,276,'久治县','J',1,0,0),(2301,276,'玛多县','M',1,0,0),(2302,277,'海晏县','H',1,0,0),(2303,277,'祁连县','Q',1,0,0),(2304,277,'刚察县','G',1,0,0),(2305,277,'门源','M',1,0,0),(2306,278,'平安县','P',1,0,0),(2307,278,'乐都县','L',1,0,0),(2308,278,'民和','M',1,0,0),(2309,278,'互助','H',1,0,0),(2310,278,'化隆','H',1,0,0),(2311,278,'循化','X',1,0,0),(2312,279,'共和县','G',1,0,0),(2313,279,'同德县','T',1,0,0),(2314,279,'贵德县','G',1,0,0),(2315,279,'兴海县','X',1,0,0),(2316,279,'贵南县','G',1,0,0),(2317,280,'德令哈市','D',1,0,0),(2318,280,'格尔木市','G',1,0,0),(2319,280,'乌兰县','W',1,0,0),(2320,280,'都兰县','D',1,0,0),(2321,280,'天峻县','T',1,0,0),(2322,281,'同仁县','T',1,0,0),(2323,281,'尖扎县','J',1,0,0),(2324,281,'泽库县','Z',1,0,0),(2325,281,'河南蒙古族自治县','H',1,0,0),(2326,282,'玉树县','Y',1,0,0),(2327,282,'杂多县','Z',1,0,0),(2328,282,'称多县','C',1,0,0),(2329,282,'治多县','Z',1,0,0),(2330,282,'囊谦县','N',1,0,0),(2331,282,'曲麻莱县','Q',1,0,0),(2332,283,'市中区','S',1,0,0),(2333,283,'历下区','L',1,0,0),(2334,283,'天桥区','T',1,0,0),(2335,283,'槐荫区','H',1,0,0),(2336,283,'历城区','L',1,0,0),(2337,283,'长清区','C',1,0,0),(2338,283,'章丘市','Z',1,0,0),(2339,283,'平阴县','P',1,0,0),(2340,283,'济阳县','J',1,0,0),(2341,283,'商河县','S',1,0,0),(2342,284,'市南区','S',1,0,0),(2343,284,'市北区','S',1,0,0),(2344,284,'城阳区','C',1,0,0),(2345,284,'四方区','S',1,0,0),(2346,284,'李沧区','L',1,0,0),(2347,284,'黄岛区','H',1,0,0),(2348,284,'崂山区','Z',1,0,0),(2349,284,'胶州市','J',1,0,0),(2350,284,'即墨市','J',1,0,0),(2351,284,'平度市','P',1,0,0),(2352,284,'胶南市','J',1,0,0),(2353,284,'莱西市','L',1,0,0),(2354,285,'滨城区','B',1,0,0),(2355,285,'惠民县','H',1,0,0),(2356,285,'阳信县','Y',1,0,0),(2357,285,'无棣县','W',1,0,0),(2358,285,'沾化县','Z',1,0,0),(2359,285,'博兴县','B',1,0,0),(2360,285,'邹平县','Z',1,0,0),(2361,286,'德城区','D',1,0,0),(2362,286,'陵县','L',1,0,0),(2363,286,'乐陵市','L',1,0,0),(2364,286,'禹城市','Y',1,0,0),(2365,286,'宁津县','N',1,0,0),(2366,286,'庆云县','Q',1,0,0),(2367,286,'临邑县','L',1,0,0),(2368,286,'齐河县','Q',1,0,0),(2369,286,'平原县','P',1,0,0),(2370,286,'夏津县','X',1,0,0),(2371,286,'武城县','W',1,0,0),(2372,287,'东营区','D',1,0,0),(2373,287,'河口区','H',1,0,0),(2374,287,'垦利县','K',1,0,0),(2375,287,'利津县','L',1,0,0),(2376,287,'广饶县','G',1,0,0),(2377,288,'牡丹区','M',1,0,0),(2378,288,'曹县','C',1,0,0),(2379,288,'单县','D',1,0,0),(2380,288,'成武县','C',1,0,0),(2381,288,'巨野县','J',1,0,0),(2382,288,'郓城县','Z',1,0,0),(2383,288,'鄄城县','Z',1,0,0),(2384,288,'定陶县','D',1,0,0),(2385,288,'东明县','D',1,0,0),(2386,289,'市中区','S',1,0,0),(2387,289,'任城区','R',1,0,0),(2388,289,'曲阜市','Q',1,0,0),(2389,289,'兖州市','Z',1,0,0),(2390,289,'邹城市','Z',1,0,0),(2391,289,'微山县','W',1,0,0),(2392,289,'鱼台县','Y',1,0,0),(2393,289,'金乡县','J',1,0,0),(2394,289,'嘉祥县','J',1,0,0),(2395,289,'汶上县','Z',1,0,0),(2396,289,'泗水县','Z',1,0,0),(2397,289,'梁山县','L',1,0,0),(2398,290,'莱城区','L',1,0,0),(2399,290,'钢城区','G',1,0,0),(2400,291,'东昌府区','D',1,0,0),(2401,291,'临清市','L',1,0,0),(2402,291,'阳谷县','Y',1,0,0),(2403,291,'莘县','Z',1,0,0),(2404,291,'茌平县','Z',1,0,0),(2405,291,'东阿县','D',1,0,0),(2406,291,'冠县','G',1,0,0),(2407,291,'高唐县','G',1,0,0),(2408,292,'兰山区','L',1,0,0),(2409,292,'罗庄区','L',1,0,0),(2410,292,'河东区','H',1,0,0),(2411,292,'沂南县','Y',1,0,0),(2412,292,'郯城县','Z',1,0,0),(2413,292,'沂水县','Y',1,0,0),(2414,292,'苍山县','C',1,0,0),(2415,292,'费县','F',1,0,0),(2416,292,'平邑县','P',1,0,0),(2417,292,'莒南县','Z',1,0,0),(2418,292,'蒙阴县','M',1,0,0),(2419,292,'临沭县','L',1,0,0),(2420,293,'东港区','D',1,0,0),(2421,293,'岚山区','Z',1,0,0),(2422,293,'五莲县','W',1,0,0),(2423,293,'莒县','Z',1,0,0),(2424,294,'泰山区','T',1,0,0),(2425,294,'岱岳区','Z',1,0,0),(2426,294,'新泰市','X',1,0,0),(2427,294,'肥城市','F',1,0,0),(2428,294,'宁阳县','N',1,0,0),(2429,294,'东平县','D',1,0,0),(2430,295,'荣成市','R',1,0,0),(2431,295,'乳山市','R',1,0,0),(2432,295,'环翠区','H',1,0,0),(2433,295,'文登市','W',1,0,0),(2434,296,'潍城区','W',1,0,0),(2435,296,'寒亭区','H',1,0,0),(2436,296,'坊子区','F',1,0,0),(2437,296,'奎文区','K',1,0,0),(2438,296,'青州市','Q',1,0,0),(2439,296,'诸城市','Z',1,0,0),(2440,296,'寿光市','S',1,0,0),(2441,296,'安丘市','A',1,0,0),(2442,296,'高密市','G',1,0,0),(2443,296,'昌邑市','C',1,0,0),(2444,296,'临朐县','L',1,0,0),(2445,296,'昌乐县','C',1,0,0),(2446,297,'芝罘区','Z',1,0,0),(2447,297,'福山区','F',1,0,0),(2448,297,'牟平区','M',1,0,0),(2449,297,'莱山区','L',1,0,0),(2450,297,'开发区','K',1,0,0),(2451,297,'龙口市','L',1,0,0),(2452,297,'莱阳市','L',1,0,0),(2453,297,'莱州市','L',1,0,0),(2454,297,'蓬莱市','P',1,0,0),(2455,297,'招远市','Z',1,0,0),(2456,297,'栖霞市','Q',1,0,0),(2457,297,'海阳市','H',1,0,0),(2458,297,'长岛县','C',1,0,0),(2459,298,'市中区','S',1,0,0),(2460,298,'山亭区','S',1,0,0),(2461,298,'峄城区','Z',1,0,0),(2462,298,'台儿庄区','T',1,0,0),(2463,298,'薛城区','X',1,0,0),(2464,298,'滕州市','Z',1,0,0),(2465,299,'张店区','Z',1,0,0),(2466,299,'临淄区','L',1,0,0),(2467,299,'淄川区','Z',1,0,0),(2468,299,'博山区','B',1,0,0),(2469,299,'周村区','Z',1,0,0),(2470,299,'桓台县','H',1,0,0),(2471,299,'高青县','G',1,0,0),(2472,299,'沂源县','Y',1,0,0),(2473,300,'杏花岭区','X',1,0,0),(2474,300,'小店区','X',1,0,0),(2475,300,'迎泽区','Y',1,0,0),(2476,300,'尖草坪区','J',1,0,0),(2477,300,'万柏林区','W',1,0,0),(2478,300,'晋源区','J',1,0,0),(2479,300,'高新开发区','G',1,0,0),(2480,300,'民营经济开发区','M',1,0,0),(2481,300,'经济技术开发区','J',1,0,0),(2482,300,'清徐县','Q',1,0,0),(2483,300,'阳曲县','Y',1,0,0),(2484,300,'娄烦县','L',1,0,0),(2485,300,'古交市','G',1,0,0),(2486,301,'城区','C',1,0,0),(2487,301,'郊区','J',1,0,0),(2488,301,'沁县','Q',1,0,0),(2489,301,'潞城市','L',1,0,0),(2490,301,'长治县','C',1,0,0),(2491,301,'襄垣县','X',1,0,0),(2492,301,'屯留县','T',1,0,0),(2493,301,'平顺县','P',1,0,0),(2494,301,'黎城县','L',1,0,0),(2495,301,'壶关县','H',1,0,0),(2496,301,'长子县','C',1,0,0),(2497,301,'武乡县','W',1,0,0),(2498,301,'沁源县','Q',1,0,0),(2499,302,'城区','C',1,0,0),(2500,302,'矿区','K',1,0,0),(2501,302,'南郊区','N',1,0,0),(2502,302,'新荣区','X',1,0,0),(2503,302,'阳高县','Y',1,0,0),(2504,302,'天镇县','T',1,0,0),(2505,302,'广灵县','G',1,0,0),(2506,302,'灵丘县','L',1,0,0),(2507,302,'浑源县','H',1,0,0),(2508,302,'左云县','Z',1,0,0),(2509,302,'大同县','D',1,0,0),(2510,303,'城区','C',1,0,0),(2511,303,'高平市','G',1,0,0),(2512,303,'沁水县','Q',1,0,0),(2513,303,'阳城县','Y',1,0,0),(2514,303,'陵川县','L',1,0,0),(2515,303,'泽州县','Z',1,0,0),(2516,304,'榆次区','Y',1,0,0),(2517,304,'介休市','J',1,0,0),(2518,304,'榆社县','Y',1,0,0),(2519,304,'左权县','Z',1,0,0),(2520,304,'和顺县','H',1,0,0),(2521,304,'昔阳县','X',1,0,0),(2522,304,'寿阳县','S',1,0,0),(2523,304,'太谷县','T',1,0,0),(2524,304,'祁县','Q',1,0,0),(2525,304,'平遥县','P',1,0,0),(2526,304,'灵石县','L',1,0,0),(2527,305,'尧都区','Y',1,0,0),(2528,305,'侯马市','H',1,0,0),(2529,305,'霍州市','H',1,0,0),(2530,305,'曲沃县','Q',1,0,0),(2531,305,'翼城县','Y',1,0,0),(2532,305,'襄汾县','X',1,0,0),(2533,305,'洪洞县','H',1,0,0),(2534,305,'吉县','J',1,0,0),(2535,305,'安泽县','A',1,0,0),(2536,305,'浮山县','F',1,0,0),(2537,305,'古县','G',1,0,0),(2538,305,'乡宁县','X',1,0,0),(2539,305,'大宁县','D',1,0,0),(2540,305,'隰县','Z',1,0,0),(2541,305,'永和县','Y',1,0,0),(2542,305,'蒲县','P',1,0,0),(2543,305,'汾西县','F',1,0,0),(2544,306,'离石市','L',1,0,0),(2545,306,'离石区','L',1,0,0),(2546,306,'孝义市','X',1,0,0),(2547,306,'汾阳市','F',1,0,0),(2548,306,'文水县','W',1,0,0),(2549,306,'交城县','J',1,0,0),(2550,306,'兴县','X',1,0,0),(2551,306,'临县','L',1,0,0),(2552,306,'柳林县','L',1,0,0),(2553,306,'石楼县','S',1,0,0),(2554,306,'岚县','Z',1,0,0),(2555,306,'方山县','F',1,0,0),(2556,306,'中阳县','Z',1,0,0),(2557,306,'交口县','J',1,0,0),(2558,307,'朔城区','S',1,0,0),(2559,307,'平鲁区','P',1,0,0),(2560,307,'山阴县','S',1,0,0),(2561,307,'应县','Y',1,0,0),(2562,307,'右玉县','Y',1,0,0),(2563,307,'怀仁县','H',1,0,0),(2564,308,'忻府区','X',1,0,0),(2565,308,'原平市','Y',1,0,0),(2566,308,'定襄县','D',1,0,0),(2567,308,'五台县','W',1,0,0),(2568,308,'代县','D',1,0,0),(2569,308,'繁峙县','F',1,0,0),(2570,308,'宁武县','N',1,0,0),(2571,308,'静乐县','J',1,0,0),(2572,308,'神池县','S',1,0,0),(2573,308,'五寨县','W',1,0,0),(2574,308,'岢岚县','Z',1,0,0),(2575,308,'河曲县','H',1,0,0),(2576,308,'保德县','B',1,0,0),(2577,308,'偏关县','P',1,0,0),(2578,309,'城区','C',1,0,0),(2579,309,'矿区','K',1,0,0),(2580,309,'郊区','J',1,0,0),(2581,309,'平定县','P',1,0,0),(2582,309,'盂县','Y',1,0,0),(2583,310,'盐湖区','Y',1,0,0),(2584,310,'永济市','Y',1,0,0),(2585,310,'河津市','H',1,0,0),(2586,310,'临猗县','L',1,0,0),(2587,310,'万荣县','W',1,0,0),(2588,310,'闻喜县','W',1,0,0),(2589,310,'稷山县','Z',1,0,0),(2590,310,'新绛县','X',1,0,0),(2591,310,'绛县','Z',1,0,0),(2592,310,'垣曲县','Y',1,0,0),(2593,310,'夏县','X',1,0,0),(2594,310,'平陆县','P',1,0,0),(2595,310,'芮城县','Z',1,0,0),(2596,311,'莲湖区','L',1,0,0),(2597,311,'新城区','X',1,0,0),(2598,311,'碑林区','B',1,0,0),(2599,311,'雁塔区','Y',1,0,0),(2600,311,'灞桥区','Z',1,0,0),(2601,311,'未央区','W',1,0,0),(2602,311,'阎良区','Y',1,0,0),(2603,311,'临潼区','L',1,0,0),(2604,311,'长安区','C',1,0,0),(2605,311,'蓝田县','L',1,0,0),(2606,311,'周至县','Z',1,0,0),(2607,311,'户县','H',1,0,0),(2608,311,'高陵县','G',1,0,0),(2609,312,'汉滨区','H',1,0,0),(2610,312,'汉阴县','H',1,0,0),(2611,312,'石泉县','S',1,0,0),(2612,312,'宁陕县','N',1,0,0),(2613,312,'紫阳县','Z',1,0,0),(2614,312,'岚皋县','Z',1,0,0),(2615,312,'平利县','P',1,0,0),(2616,312,'镇坪县','Z',1,0,0),(2617,312,'旬阳县','X',1,0,0),(2618,312,'白河县','B',1,0,0),(2619,313,'陈仓区','C',1,0,0),(2620,313,'渭滨区','W',1,0,0),(2621,313,'金台区','J',1,0,0),(2622,313,'凤翔县','F',1,0,0),(2623,313,'岐山县','Z',1,0,0),(2624,313,'扶风县','F',1,0,0),(2625,313,'眉县','M',1,0,0),(2626,313,'陇县','L',1,0,0),(2627,313,'千阳县','Q',1,0,0),(2628,313,'麟游县','Z',1,0,0),(2629,313,'凤县','F',1,0,0),(2630,313,'太白县','T',1,0,0),(2631,314,'汉台区','H',1,0,0),(2632,314,'南郑县','N',1,0,0),(2633,314,'城固县','C',1,0,0),(2634,314,'洋县','Y',1,0,0),(2635,314,'西乡县','X',1,0,0),(2636,314,'勉县','M',1,0,0),(2637,314,'宁强县','N',1,0,0),(2638,314,'略阳县','L',1,0,0),(2639,314,'镇巴县','Z',1,0,0),(2640,314,'留坝县','L',1,0,0),(2641,314,'佛坪县','F',1,0,0),(2642,315,'商州区','S',1,0,0),(2643,315,'洛南县','L',1,0,0),(2644,315,'丹凤县','D',1,0,0),(2645,315,'商南县','S',1,0,0),(2646,315,'山阳县','S',1,0,0),(2647,315,'镇安县','Z',1,0,0),(2648,315,'柞水县','Z',1,0,0),(2649,316,'耀州区','Y',1,0,0),(2650,316,'王益区','W',1,0,0),(2651,316,'印台区','Y',1,0,0),(2652,316,'宜君县','Y',1,0,0),(2653,317,'临渭区','L',1,0,0),(2654,317,'韩城市','H',1,0,0),(2655,317,'华阴市','H',1,0,0),(2656,317,'华县','H',1,0,0),(2657,317,'潼关县','Z',1,0,0),(2658,317,'大荔县','D',1,0,0),(2659,317,'合阳县','H',1,0,0),(2660,317,'澄城县','C',1,0,0),(2661,317,'蒲城县','P',1,0,0),(2662,317,'白水县','B',1,0,0),(2663,317,'富平县','F',1,0,0),(2664,318,'秦都区','Q',1,0,0),(2665,318,'渭城区','W',1,0,0),(2666,318,'杨陵区','Y',1,0,0),(2667,318,'兴平市','X',1,0,0),(2668,318,'三原县','S',1,0,0),(2669,318,'泾阳县','Z',1,0,0),(2670,318,'乾县','Q',1,0,0),(2671,318,'礼泉县','L',1,0,0),(2672,318,'永寿县','Y',1,0,0),(2673,318,'彬县','B',1,0,0),(2674,318,'长武县','C',1,0,0),(2675,318,'旬邑县','X',1,0,0),(2676,318,'淳化县','C',1,0,0),(2677,318,'武功县','W',1,0,0),(2678,319,'吴起县','W',1,0,0),(2679,319,'宝塔区','B',1,0,0),(2680,319,'延长县','Y',1,0,0),(2681,319,'延川县','Y',1,0,0),(2682,319,'子长县','Z',1,0,0),(2683,319,'安塞县','A',1,0,0),(2684,319,'志丹县','Z',1,0,0),(2685,319,'甘泉县','G',1,0,0),(2686,319,'富县','F',1,0,0),(2687,319,'洛川县','L',1,0,0),(2688,319,'宜川县','Y',1,0,0),(2689,319,'黄龙县','H',1,0,0),(2690,319,'黄陵县','H',1,0,0),(2691,320,'榆阳区','Y',1,0,0),(2692,320,'神木县','S',1,0,0),(2693,320,'府谷县','F',1,0,0),(2694,320,'横山县','H',1,0,0),(2695,320,'靖边县','J',1,0,0),(2696,320,'定边县','D',1,0,0),(2697,320,'绥德县','S',1,0,0),(2698,320,'米脂县','M',1,0,0),(2699,320,'佳县','J',1,0,0),(2700,320,'吴堡县','W',1,0,0),(2701,320,'清涧县','Q',1,0,0),(2702,320,'子洲县','Z',1,0,0),(2703,321,'长宁区','C',1,0,0),(2704,321,'闸北区','Z',1,0,0),(2705,321,'闵行区','Z',1,0,0),(2706,321,'徐汇区','X',1,0,0),(2707,321,'浦东新区','P',1,0,0),(2708,321,'杨浦区','Y',1,0,0),(2709,321,'普陀区','P',1,0,0),(2710,321,'静安区','J',1,0,0),(2711,321,'卢湾区','L',1,0,0),(2712,321,'虹口区','H',1,0,0),(2713,321,'黄浦区','H',1,0,0),(2714,321,'南汇区','N',1,0,0),(2715,321,'松江区','S',1,0,0),(2716,321,'嘉定区','J',1,0,0),(2717,321,'宝山区','B',1,0,0),(2718,321,'青浦区','Q',1,0,0),(2719,321,'金山区','J',1,0,0),(2720,321,'奉贤区','F',1,0,0),(2721,321,'崇明县','C',1,0,0),(2722,322,'青羊区','Q',1,0,0),(2723,322,'锦江区','J',1,0,0),(2724,322,'金牛区','J',1,0,0),(2725,322,'武侯区','W',1,0,0),(2726,322,'成华区','C',1,0,0),(2727,322,'龙泉驿区','L',1,0,0),(2728,322,'青白江区','Q',1,0,0),(2729,322,'新都区','X',1,0,0),(2730,322,'温江区','W',1,0,0),(2731,322,'高新区','G',1,0,0),(2732,322,'高新西区','G',1,0,0),(2733,322,'都江堰市','D',1,0,0),(2734,322,'彭州市','P',1,0,0),(2735,322,'邛崃市','Z',1,0,0),(2736,322,'崇州市','C',1,0,0),(2737,322,'金堂县','J',1,0,0),(2738,322,'双流县','S',1,0,0),(2739,322,'郫县','Z',1,0,0),(2740,322,'大邑县','D',1,0,0),(2741,322,'蒲江县','P',1,0,0),(2742,322,'新津县','X',1,0,0),(2743,322,'都江堰市','D',1,0,0),(2744,322,'彭州市','P',1,0,0),(2745,322,'邛崃市','Z',1,0,0),(2746,322,'崇州市','C',1,0,0),(2747,322,'金堂县','J',1,0,0),(2748,322,'双流县','S',1,0,0),(2749,322,'郫县','Z',1,0,0),(2750,322,'大邑县','D',1,0,0),(2751,322,'蒲江县','P',1,0,0),(2752,322,'新津县','X',1,0,0),(2753,323,'涪城区','F',1,0,0),(2754,323,'游仙区','Y',1,0,0),(2755,323,'江油市','J',1,0,0),(2756,323,'盐亭县','Y',1,0,0),(2757,323,'三台县','S',1,0,0),(2758,323,'平武县','P',1,0,0),(2759,323,'安县','A',1,0,0),(2760,323,'梓潼县','Z',1,0,0),(2761,323,'北川县','B',1,0,0),(2762,324,'马尔康县','M',1,0,0),(2763,324,'汶川县','Z',1,0,0),(2764,324,'理县','L',1,0,0),(2765,324,'茂县','M',1,0,0),(2766,324,'松潘县','S',1,0,0),(2767,324,'九寨沟县','J',1,0,0),(2768,324,'金川县','J',1,0,0),(2769,324,'小金县','X',1,0,0),(2770,324,'黑水县','H',1,0,0),(2771,324,'壤塘县','R',1,0,0),(2772,324,'阿坝县','A',1,0,0),(2773,324,'若尔盖县','R',1,0,0),(2774,324,'红原县','H',1,0,0),(2775,325,'巴州区','B',1,0,0),(2776,325,'通江县','T',1,0,0),(2777,325,'南江县','N',1,0,0),(2778,325,'平昌县','P',1,0,0),(2779,326,'通川区','T',1,0,0),(2780,326,'万源市','W',1,0,0),(2781,326,'达县','D',1,0,0),(2782,326,'宣汉县','X',1,0,0),(2783,326,'开江县','K',1,0,0),(2784,326,'大竹县','D',1,0,0),(2785,326,'渠县','Q',1,0,0),(2786,327,'旌阳区','Z',1,0,0),(2787,327,'广汉市','G',1,0,0),(2788,327,'什邡市','S',1,0,0),(2789,327,'绵竹市','M',1,0,0),(2790,327,'罗江县','L',1,0,0),(2791,327,'中江县','Z',1,0,0),(2792,328,'康定县','K',1,0,0),(2793,328,'丹巴县','D',1,0,0),(2794,328,'泸定县','Z',1,0,0),(2795,328,'炉霍县','L',1,0,0),(2796,328,'九龙县','J',1,0,0),(2797,328,'甘孜县','G',1,0,0),(2798,328,'雅江县','Y',1,0,0),(2799,328,'新龙县','X',1,0,0),(2800,328,'道孚县','D',1,0,0),(2801,328,'白玉县','B',1,0,0),(2802,328,'理塘县','L',1,0,0),(2803,328,'德格县','D',1,0,0),(2804,328,'乡城县','X',1,0,0),(2805,328,'石渠县','S',1,0,0),(2806,328,'稻城县','D',1,0,0),(2807,328,'色达县','S',1,0,0),(2808,328,'巴塘县','B',1,0,0),(2809,328,'得荣县','D',1,0,0),(2810,329,'广安区','G',1,0,0),(2811,329,'华蓥市','H',1,0,0),(2812,329,'岳池县','Y',1,0,0),(2813,329,'武胜县','W',1,0,0),(2814,329,'邻水县','L',1,0,0),(2815,330,'利州区','L',1,0,0),(2816,330,'元坝区','Y',1,0,0),(2817,330,'朝天区','C',1,0,0),(2818,330,'旺苍县','W',1,0,0),(2819,330,'青川县','Q',1,0,0),(2820,330,'剑阁县','J',1,0,0),(2821,330,'苍溪县','C',1,0,0),(2822,331,'峨眉山市','E',1,0,0),(2823,331,'乐山市','L',1,0,0),(2824,331,'犍为县','Z',1,0,0),(2825,331,'井研县','J',1,0,0),(2826,331,'夹江县','J',1,0,0),(2827,331,'沐川县','Z',1,0,0),(2828,331,'峨边','E',1,0,0),(2829,331,'马边','M',1,0,0),(2830,332,'西昌市','X',1,0,0),(2831,332,'盐源县','Y',1,0,0),(2832,332,'德昌县','D',1,0,0),(2833,332,'会理县','H',1,0,0),(2834,332,'会东县','H',1,0,0),(2835,332,'宁南县','N',1,0,0),(2836,332,'普格县','P',1,0,0),(2837,332,'布拖县','B',1,0,0),(2838,332,'金阳县','J',1,0,0),(2839,332,'昭觉县','Z',1,0,0),(2840,332,'喜德县','X',1,0,0),(2841,332,'冕宁县','M',1,0,0),(2842,332,'越西县','Y',1,0,0),(2843,332,'甘洛县','G',1,0,0),(2844,332,'美姑县','M',1,0,0),(2845,332,'雷波县','L',1,0,0),(2846,332,'木里','M',1,0,0),(2847,333,'东坡区','D',1,0,0),(2848,333,'仁寿县','R',1,0,0),(2849,333,'彭山县','P',1,0,0),(2850,333,'洪雅县','H',1,0,0),(2851,333,'丹棱县','D',1,0,0),(2852,333,'青神县','Q',1,0,0),(2853,334,'阆中市','Z',1,0,0),(2854,334,'南部县','N',1,0,0),(2855,334,'营山县','Y',1,0,0),(2856,334,'蓬安县','P',1,0,0),(2857,334,'仪陇县','Y',1,0,0),(2858,334,'顺庆区','S',1,0,0),(2859,334,'高坪区','G',1,0,0),(2860,334,'嘉陵区','J',1,0,0),(2861,334,'西充县','X',1,0,0),(2862,335,'市中区','S',1,0,0),(2863,335,'东兴区','D',1,0,0),(2864,335,'威远县','W',1,0,0),(2865,335,'资中县','Z',1,0,0),(2866,335,'隆昌县','L',1,0,0),(2867,336,'东  区','D',1,0,0),(2868,336,'西  区','X',1,0,0),(2869,336,'仁和区','R',1,0,0),(2870,336,'米易县','M',1,0,0),(2871,336,'盐边县','Y',1,0,0),(2872,337,'船山区','C',1,0,0),(2873,337,'安居区','A',1,0,0),(2874,337,'蓬溪县','P',1,0,0),(2875,337,'射洪县','S',1,0,0),(2876,337,'大英县','D',1,0,0),(2877,338,'雨城区','Y',1,0,0),(2878,338,'名山县','M',1,0,0),(2879,338,'荥经县','Z',1,0,0),(2880,338,'汉源县','H',1,0,0),(2881,338,'石棉县','S',1,0,0),(2882,338,'天全县','T',1,0,0),(2883,338,'芦山县','L',1,0,0),(2884,338,'宝兴县','B',1,0,0),(2885,339,'翠屏区','C',1,0,0),(2886,339,'宜宾县','Y',1,0,0),(2887,339,'南溪县','N',1,0,0),(2888,339,'江安县','J',1,0,0),(2889,339,'长宁县','C',1,0,0),(2890,339,'高县','G',1,0,0),(2891,339,'珙县','Z',1,0,0),(2892,339,'筠连县','Z',1,0,0),(2893,339,'兴文县','X',1,0,0),(2894,339,'屏山县','P',1,0,0),(2895,340,'雁江区','Y',1,0,0),(2896,340,'简阳市','J',1,0,0),(2897,340,'安岳县','A',1,0,0),(2898,340,'乐至县','L',1,0,0),(2899,341,'大安区','D',1,0,0),(2900,341,'自流井区','Z',1,0,0),(2901,341,'贡井区','G',1,0,0),(2902,341,'沿滩区','Y',1,0,0),(2903,341,'荣县','R',1,0,0),(2904,341,'富顺县','F',1,0,0),(2905,342,'江阳区','J',1,0,0),(2906,342,'纳溪区','N',1,0,0),(2907,342,'龙马潭区','L',1,0,0),(2908,342,'泸县','Z',1,0,0),(2909,342,'合江县','H',1,0,0),(2910,342,'叙永县','X',1,0,0),(2911,342,'古蔺县','G',1,0,0),(2912,343,'和平区','H',1,0,0),(2913,343,'河西区','H',1,0,0),(2914,343,'南开区','N',1,0,0),(2915,343,'河北区','H',1,0,0),(2916,343,'河东区','H',1,0,0),(2917,343,'红桥区','H',1,0,0),(2918,343,'东丽区','D',1,0,0),(2919,343,'津南区','J',1,0,0),(2920,343,'西青区','X',1,0,0),(2921,343,'北辰区','B',1,0,0),(2922,343,'塘沽区','T',1,0,0),(2923,343,'汉沽区','H',1,0,0),(2924,343,'大港区','D',1,0,0),(2925,343,'武清区','W',1,0,0),(2926,343,'宝坻区','B',1,0,0),(2927,343,'经济开发区','J',1,0,0),(2928,343,'宁河县','N',1,0,0),(2929,343,'静海县','J',1,0,0),(2930,343,'蓟县','J',1,0,0),(2931,344,'城关区','C',1,0,0),(2932,344,'林周县','L',1,0,0),(2933,344,'当雄县','D',1,0,0),(2934,344,'尼木县','N',1,0,0),(2935,344,'曲水县','Q',1,0,0),(2936,344,'堆龙德庆县','D',1,0,0),(2937,344,'达孜县','D',1,0,0),(2938,344,'墨竹工卡县','M',1,0,0),(2939,345,'噶尔县','G',1,0,0),(2940,345,'普兰县','P',1,0,0),(2941,345,'札达县','Z',1,0,0),(2942,345,'日土县','R',1,0,0),(2943,345,'革吉县','G',1,0,0),(2944,345,'改则县','G',1,0,0),(2945,345,'措勤县','C',1,0,0),(2946,346,'昌都县','C',1,0,0),(2947,346,'江达县','J',1,0,0),(2948,346,'贡觉县','G',1,0,0),(2949,346,'类乌齐县','L',1,0,0),(2950,346,'丁青县','D',1,0,0),(2951,346,'察雅县','C',1,0,0),(2952,346,'八宿县','B',1,0,0),(2953,346,'左贡县','Z',1,0,0),(2954,346,'芒康县','M',1,0,0),(2955,346,'洛隆县','L',1,0,0),(2956,346,'边坝县','B',1,0,0),(2957,347,'林芝县','L',1,0,0),(2958,347,'工布江达县','G',1,0,0),(2959,347,'米林县','M',1,0,0),(2960,347,'墨脱县','M',1,0,0),(2961,347,'波密县','B',1,0,0),(2962,347,'察隅县','C',1,0,0),(2963,347,'朗县','L',1,0,0),(2964,348,'那曲县','N',1,0,0),(2965,348,'嘉黎县','J',1,0,0),(2966,348,'比如县','B',1,0,0),(2967,348,'聂荣县','N',1,0,0),(2968,348,'安多县','A',1,0,0),(2969,348,'申扎县','S',1,0,0),(2970,348,'索县','S',1,0,0),(2971,348,'班戈县','B',1,0,0),(2972,348,'巴青县','B',1,0,0),(2973,348,'尼玛县','N',1,0,0),(2974,349,'日喀则市','R',1,0,0),(2975,349,'南木林县','N',1,0,0),(2976,349,'江孜县','J',1,0,0),(2977,349,'定日县','D',1,0,0),(2978,349,'萨迦县','S',1,0,0),(2979,349,'拉孜县','L',1,0,0),(2980,349,'昂仁县','A',1,0,0),(2981,349,'谢通门县','X',1,0,0),(2982,349,'白朗县','B',1,0,0),(2983,349,'仁布县','R',1,0,0),(2984,349,'康马县','K',1,0,0),(2985,349,'定结县','D',1,0,0),(2986,349,'仲巴县','Z',1,0,0),(2987,349,'亚东县','Y',1,0,0),(2988,349,'吉隆县','J',1,0,0),(2989,349,'聂拉木县','N',1,0,0),(2990,349,'萨嘎县','S',1,0,0),(2991,349,'岗巴县','G',1,0,0),(2992,350,'乃东县','N',1,0,0),(2993,350,'扎囊县','Z',1,0,0),(2994,350,'贡嘎县','G',1,0,0),(2995,350,'桑日县','S',1,0,0),(2996,350,'琼结县','Q',1,0,0),(2997,350,'曲松县','Q',1,0,0),(2998,350,'措美县','C',1,0,0),(2999,350,'洛扎县','L',1,0,0),(3000,350,'加查县','J',1,0,0),(3001,350,'隆子县','L',1,0,0),(3002,350,'错那县','C',1,0,0),(3003,350,'浪卡子县','L',1,0,0),(3004,351,'天山区','T',1,0,0),(3005,351,'沙依巴克区','S',1,0,0),(3006,351,'新市区','X',1,0,0),(3007,351,'水磨沟区','S',1,0,0),(3008,351,'头屯河区','T',1,0,0),(3009,351,'达坂城区','D',1,0,0),(3010,351,'米东区','M',1,0,0),(3011,351,'乌鲁木齐县','W',1,0,0),(3012,352,'阿克苏市','A',1,0,0),(3013,352,'温宿县','W',1,0,0),(3014,352,'库车县','K',1,0,0),(3015,352,'沙雅县','S',1,0,0),(3016,352,'新和县','X',1,0,0),(3017,352,'拜城县','B',1,0,0),(3018,352,'乌什县','W',1,0,0),(3019,352,'阿瓦提县','A',1,0,0),(3020,352,'柯坪县','K',1,0,0),(3021,353,'阿拉尔市','A',1,0,0),(3022,354,'库尔勒市','K',1,0,0),(3023,354,'轮台县','L',1,0,0),(3024,354,'尉犁县','W',1,0,0),(3025,354,'若羌县','R',1,0,0),(3026,354,'且末县','Q',1,0,0),(3027,354,'焉耆','Y',1,0,0),(3028,354,'和静县','H',1,0,0),(3029,354,'和硕县','H',1,0,0),(3030,354,'博湖县','B',1,0,0),(3031,355,'博乐市','B',1,0,0),(3032,355,'精河县','J',1,0,0),(3033,355,'温泉县','W',1,0,0),(3034,356,'呼图壁县','H',1,0,0),(3035,356,'米泉市','M',1,0,0),(3036,356,'昌吉市','C',1,0,0),(3037,356,'阜康市','F',1,0,0),(3038,356,'玛纳斯县','M',1,0,0),(3039,356,'奇台县','Q',1,0,0),(3040,356,'吉木萨尔县','J',1,0,0),(3041,356,'木垒','M',1,0,0),(3042,357,'哈密市','H',1,0,0),(3043,357,'伊吾县','Y',1,0,0),(3044,357,'巴里坤','B',1,0,0),(3045,358,'和田市','H',1,0,0),(3046,358,'和田县','H',1,0,0),(3047,358,'墨玉县','M',1,0,0),(3048,358,'皮山县','P',1,0,0),(3049,358,'洛浦县','L',1,0,0),(3050,358,'策勒县','C',1,0,0),(3051,358,'于田县','Y',1,0,0),(3052,358,'民丰县','M',1,0,0),(3053,359,'喀什市','K',1,0,0),(3054,359,'疏附县','S',1,0,0),(3055,359,'疏勒县','S',1,0,0),(3056,359,'英吉沙县','Y',1,0,0),(3057,359,'泽普县','Z',1,0,0),(3058,359,'莎车县','S',1,0,0),(3059,359,'叶城县','Y',1,0,0),(3060,359,'麦盖提县','M',1,0,0),(3061,359,'岳普湖县','Y',1,0,0),(3062,359,'伽师县','Z',1,0,0),(3063,359,'巴楚县','B',1,0,0),(3064,359,'塔什库尔干','T',1,0,0),(3065,360,'克拉玛依市','K',1,0,0),(3066,361,'阿图什市','A',1,0,0),(3067,361,'阿克陶县','A',1,0,0),(3068,361,'阿合奇县','A',1,0,0),(3069,361,'乌恰县','W',1,0,0),(3070,362,'石河子市','S',1,0,0),(3071,363,'图木舒克市','T',1,0,0),(3072,364,'吐鲁番市','T',1,0,0),(3073,364,'鄯善县','Z',1,0,0),(3074,364,'托克逊县','T',1,0,0),(3075,365,'五家渠市','W',1,0,0),(3076,366,'阿勒泰市','A',1,0,0),(3077,366,'布克赛尔','B',1,0,0),(3078,366,'伊宁市','Y',1,0,0),(3079,366,'布尔津县','B',1,0,0),(3080,366,'奎屯市','K',1,0,0),(3081,366,'乌苏市','W',1,0,0),(3082,366,'额敏县','E',1,0,0),(3083,366,'富蕴县','F',1,0,0),(3084,366,'伊宁县','Y',1,0,0),(3085,366,'福海县','F',1,0,0),(3086,366,'霍城县','H',1,0,0),(3087,366,'沙湾县','S',1,0,0),(3088,366,'巩留县','G',1,0,0),(3089,366,'哈巴河县','H',1,0,0),(3090,366,'托里县','T',1,0,0),(3091,366,'青河县','Q',1,0,0),(3092,366,'新源县','X',1,0,0),(3093,366,'裕民县','Y',1,0,0),(3094,366,'和布克赛尔','H',1,0,0),(3095,366,'吉木乃县','J',1,0,0),(3096,366,'昭苏县','Z',1,0,0),(3097,366,'特克斯县','T',1,0,0),(3098,366,'尼勒克县','N',1,0,0),(3099,366,'察布查尔','C',1,0,0),(3100,367,'盘龙区','P',1,0,0),(3101,367,'五华区','W',1,0,0),(3102,367,'官渡区','G',1,0,0),(3103,367,'西山区','X',1,0,0),(3104,367,'东川区','D',1,0,0),(3105,367,'安宁市','A',1,0,0),(3106,367,'呈贡县','C',1,0,0),(3107,367,'晋宁县','J',1,0,0),(3108,367,'富民县','F',1,0,0),(3109,367,'宜良县','Y',1,0,0),(3110,367,'嵩明县','Z',1,0,0),(3111,367,'石林县','S',1,0,0),(3112,367,'禄劝','L',1,0,0),(3113,367,'寻甸','X',1,0,0),(3114,368,'兰坪','L',1,0,0),(3115,368,'泸水县','Z',1,0,0),(3116,368,'福贡县','F',1,0,0),(3117,368,'贡山','G',1,0,0),(3118,369,'宁洱','N',1,0,0),(3119,369,'思茅区','S',1,0,0),(3120,369,'墨江','M',1,0,0),(3121,369,'景东','J',1,0,0),(3122,369,'景谷','J',1,0,0),(3123,369,'镇沅','Z',1,0,0),(3124,369,'江城','J',1,0,0),(3125,369,'孟连','M',1,0,0),(3126,369,'澜沧','L',1,0,0),(3127,369,'西盟','X',1,0,0),(3128,370,'古城区','G',1,0,0),(3129,370,'宁蒗','N',1,0,0),(3130,370,'玉龙','Y',1,0,0),(3131,370,'永胜县','Y',1,0,0),(3132,370,'华坪县','H',1,0,0),(3133,371,'隆阳区','L',1,0,0),(3134,371,'施甸县','S',1,0,0),(3135,371,'腾冲县','T',1,0,0),(3136,371,'龙陵县','L',1,0,0),(3137,371,'昌宁县','C',1,0,0),(3138,372,'楚雄市','C',1,0,0),(3139,372,'双柏县','S',1,0,0),(3140,372,'牟定县','M',1,0,0),(3141,372,'南华县','N',1,0,0),(3142,372,'姚安县','Y',1,0,0),(3143,372,'大姚县','D',1,0,0),(3144,372,'永仁县','Y',1,0,0),(3145,372,'元谋县','Y',1,0,0),(3146,372,'武定县','W',1,0,0),(3147,372,'禄丰县','L',1,0,0),(3148,373,'大理市','D',1,0,0),(3149,373,'祥云县','X',1,0,0),(3150,373,'宾川县','B',1,0,0),(3151,373,'弥渡县','M',1,0,0),(3152,373,'永平县','Y',1,0,0),(3153,373,'云龙县','Y',1,0,0),(3154,373,'洱源县','E',1,0,0),(3155,373,'剑川县','J',1,0,0),(3156,373,'鹤庆县','H',1,0,0),(3157,373,'漾濞','Y',1,0,0),(3158,373,'南涧','N',1,0,0),(3159,373,'巍山','W',1,0,0),(3160,374,'潞西市','L',1,0,0),(3161,374,'瑞丽市','R',1,0,0),(3162,374,'梁河县','L',1,0,0),(3163,374,'盈江县','Y',1,0,0),(3164,374,'陇川县','L',1,0,0),(3165,375,'香格里拉县','X',1,0,0),(3166,375,'德钦县','D',1,0,0),(3167,375,'维西','W',1,0,0),(3168,376,'泸西县','Z',1,0,0),(3169,376,'蒙自县','M',1,0,0),(3170,376,'个旧市','G',1,0,0),(3171,376,'开远市','K',1,0,0),(3172,376,'绿春县','L',1,0,0),(3173,376,'建水县','J',1,0,0),(3174,376,'石屏县','S',1,0,0),(3175,376,'弥勒县','M',1,0,0),(3176,376,'元阳县','Y',1,0,0),(3177,376,'红河县','H',1,0,0),(3178,376,'金平','J',1,0,0),(3179,376,'河口','H',1,0,0),(3180,376,'屏边','P',1,0,0),(3181,377,'临翔区','L',1,0,0),(3182,377,'凤庆县','F',1,0,0),(3183,377,'云县','Y',1,0,0),(3184,377,'永德县','Y',1,0,0),(3185,377,'镇康县','Z',1,0,0),(3186,377,'双江','S',1,0,0),(3187,377,'耿马','G',1,0,0),(3188,377,'沧源','C',1,0,0),(3189,378,'麒麟区','Z',1,0,0),(3190,378,'宣威市','X',1,0,0),(3191,378,'马龙县','M',1,0,0),(3192,378,'陆良县','L',1,0,0),(3193,378,'师宗县','S',1,0,0),(3194,378,'罗平县','L',1,0,0),(3195,378,'富源县','F',1,0,0),(3196,378,'会泽县','H',1,0,0),(3197,378,'沾益县','Z',1,0,0),(3198,379,'文山县','W',1,0,0),(3199,379,'砚山县','Y',1,0,0),(3200,379,'西畴县','X',1,0,0),(3201,379,'麻栗坡县','M',1,0,0),(3202,379,'马关县','M',1,0,0),(3203,379,'丘北县','Q',1,0,0),(3204,379,'广南县','G',1,0,0),(3205,379,'富宁县','F',1,0,0),(3206,380,'景洪市','J',1,0,0),(3207,380,'勐海县','Z',1,0,0),(3208,380,'勐腊县','Z',1,0,0),(3209,381,'红塔区','H',1,0,0),(3210,381,'江川县','J',1,0,0),(3211,381,'澄江县','C',1,0,0),(3212,381,'通海县','T',1,0,0),(3213,381,'华宁县','H',1,0,0),(3214,381,'易门县','Y',1,0,0),(3215,381,'峨山','E',1,0,0),(3216,381,'新平','X',1,0,0),(3217,381,'元江','Y',1,0,0),(3218,382,'昭阳区','Z',1,0,0),(3219,382,'鲁甸县','L',1,0,0),(3220,382,'巧家县','Q',1,0,0),(3221,382,'盐津县','Y',1,0,0),(3222,382,'大关县','D',1,0,0),(3223,382,'永善县','Y',1,0,0),(3224,382,'绥江县','S',1,0,0),(3225,382,'镇雄县','Z',1,0,0),(3226,382,'彝良县','Y',1,0,0),(3227,382,'威信县','W',1,0,0),(3228,382,'水富县','S',1,0,0),(3229,383,'西湖区','X',1,0,0),(3230,383,'上城区','S',1,0,0),(3231,383,'下城区','X',1,0,0),(3232,383,'拱墅区','G',1,0,0),(3233,383,'滨江区','B',1,0,0),(3234,383,'江干区','J',1,0,0),(3235,383,'萧山区','X',1,0,0),(3236,383,'余杭区','Y',1,0,0),(3237,383,'市郊','S',1,0,0),(3238,383,'建德市','J',1,0,0),(3239,383,'富阳市','F',1,0,0),(3240,383,'临安市','L',1,0,0),(3241,383,'桐庐县','T',1,0,0),(3242,383,'淳安县','C',1,0,0),(3243,384,'吴兴区','W',1,0,0),(3244,384,'南浔区','N',1,0,0),(3245,384,'德清县','D',1,0,0),(3246,384,'长兴县','C',1,0,0),(3247,384,'安吉县','A',1,0,0),(3248,385,'南湖区','N',1,0,0),(3249,385,'秀洲区','X',1,0,0),(3250,385,'海宁市','H',1,0,0),(3251,385,'嘉善县','J',1,0,0),(3252,385,'平湖市','P',1,0,0),(3253,385,'桐乡市','T',1,0,0),(3254,385,'海盐县','H',1,0,0),(3255,386,'婺城区','Z',1,0,0),(3256,386,'金东区','J',1,0,0),(3257,386,'兰溪市','L',1,0,0),(3258,386,'市区','S',1,0,0),(3259,386,'佛堂镇','F',1,0,0),(3260,386,'上溪镇','S',1,0,0),(3261,386,'义亭镇','Y',1,0,0),(3262,386,'大陈镇','D',1,0,0),(3263,386,'苏溪镇','S',1,0,0),(3264,386,'赤岸镇','C',1,0,0),(3265,386,'东阳市','D',1,0,0),(3266,386,'永康市','Y',1,0,0),(3267,386,'武义县','W',1,0,0),(3268,386,'浦江县','P',1,0,0),(3269,386,'磐安县','P',1,0,0),(3270,387,'莲都区','L',1,0,0),(3271,387,'龙泉市','L',1,0,0),(3272,387,'青田县','Q',1,0,0),(3273,387,'缙云县','Z',1,0,0),(3274,387,'遂昌县','S',1,0,0),(3275,387,'松阳县','S',1,0,0),(3276,387,'云和县','Y',1,0,0),(3277,387,'庆元县','Q',1,0,0),(3278,387,'景宁','J',1,0,0),(3279,388,'海曙区','H',1,0,0),(3280,388,'江东区','J',1,0,0),(3281,388,'江北区','J',1,0,0),(3282,388,'镇海区','Z',1,0,0),(3283,388,'北仑区','B',1,0,0),(3284,388,'鄞州区','Z',1,0,0),(3285,388,'余姚市','Y',1,0,0),(3286,388,'慈溪市','C',1,0,0),(3287,388,'奉化市','F',1,0,0),(3288,388,'象山县','X',1,0,0),(3289,388,'宁海县','N',1,0,0),(3290,389,'越城区','Y',1,0,0),(3291,389,'上虞市','S',1,0,0),(3292,389,'嵊州市','Z',1,0,0),(3293,389,'绍兴县','S',1,0,0),(3294,389,'新昌县','X',1,0,0),(3295,389,'诸暨市','Z',1,0,0),(3296,390,'椒江区','J',1,0,0),(3297,390,'黄岩区','H',1,0,0),(3298,390,'路桥区','L',1,0,0),(3299,390,'温岭市','W',1,0,0),(3300,390,'临海市','L',1,0,0),(3301,390,'玉环县','Y',1,0,0),(3302,390,'三门县','S',1,0,0),(3303,390,'天台县','T',1,0,0),(3304,390,'仙居县','X',1,0,0),(3305,391,'鹿城区','L',1,0,0),(3306,391,'龙湾区','L',1,0,0),(3307,391,'瓯海区','Z',1,0,0),(3308,391,'瑞安市','R',1,0,0),(3309,391,'乐清市','L',1,0,0),(3310,391,'洞头县','D',1,0,0),(3311,391,'永嘉县','Y',1,0,0),(3312,391,'平阳县','P',1,0,0),(3313,391,'苍南县','C',1,0,0),(3314,391,'文成县','W',1,0,0),(3315,391,'泰顺县','T',1,0,0),(3316,392,'定海区','D',1,0,0),(3317,392,'普陀区','P',1,0,0),(3318,392,'岱山县','Z',1,0,0),(3319,392,'嵊泗县','Z',1,0,0),(3320,393,'衢州市','Z',1,0,0),(3321,393,'江山市','J',1,0,0),(3322,393,'常山县','C',1,0,0),(3323,393,'开化县','K',1,0,0),(3324,393,'龙游县','L',1,0,0),(3325,394,'合川区','H',1,0,0),(3326,394,'江津区','J',1,0,0),(3327,394,'南川区','N',1,0,0),(3328,394,'永川区','Y',1,0,0),(3329,394,'南岸区','N',1,0,0),(3330,394,'渝北区','Y',1,0,0),(3331,394,'万盛区','W',1,0,0),(3332,394,'大渡口区','D',1,0,0),(3333,394,'万州区','W',1,0,0),(3334,394,'北碚区','B',1,0,0),(3335,394,'沙坪坝区','S',1,0,0),(3336,394,'巴南区','B',1,0,0),(3337,394,'涪陵区','F',1,0,0),(3338,394,'江北区','J',1,0,0),(3339,394,'九龙坡区','J',1,0,0),(3340,394,'渝中区','Y',1,0,0),(3341,394,'黔江开发区','Q',1,0,0),(3342,394,'长寿区','C',1,0,0),(3343,394,'双桥区','S',1,0,0),(3344,394,'綦江县','Z',1,0,0),(3345,394,'潼南县','Z',1,0,0),(3346,394,'铜梁县','T',1,0,0),(3347,394,'大足县','D',1,0,0),(3348,394,'荣昌县','R',1,0,0),(3349,394,'璧山县','Z',1,0,0),(3350,394,'垫江县','D',1,0,0),(3351,394,'武隆县','W',1,0,0),(3352,394,'丰都县','F',1,0,0),(3353,394,'城口县','C',1,0,0),(3354,394,'梁平县','L',1,0,0),(3355,394,'开县','K',1,0,0),(3356,394,'巫溪县','W',1,0,0),(3357,394,'巫山县','W',1,0,0),(3358,394,'奉节县','F',1,0,0),(3359,394,'云阳县','Y',1,0,0),(3360,394,'忠县','Z',1,0,0),(3361,394,'石柱','S',1,0,0),(3362,394,'彭水','P',1,0,0),(3363,394,'酉阳','Y',1,0,0),(3364,394,'秀山','X',1,0,0),(3365,395,'沙田区','S',1,0,0),(3366,395,'东区','D',1,0,0),(3367,395,'观塘区','G',1,0,0),(3368,395,'黄大仙区','H',1,0,0),(3369,395,'九龙城区','J',1,0,0),(3370,395,'屯门区','T',1,0,0),(3371,395,'葵青区','K',1,0,0),(3372,395,'元朗区','Y',1,0,0),(3373,395,'深水埗区','S',1,0,0),(3374,395,'西贡区','X',1,0,0),(3375,395,'大埔区','D',1,0,0),(3376,395,'湾仔区','W',1,0,0),(3377,395,'油尖旺区','Y',1,0,0),(3378,395,'北区','B',1,0,0),(3379,395,'南区','N',1,0,0),(3380,395,'荃湾区','Z',1,0,0),(3381,395,'中西区','Z',1,0,0),(3382,395,'离岛区','L',1,0,0),(3383,396,'澳门','A',1,0,0),(3384,397,'台北','T',1,0,0),(3385,397,'高雄','G',1,0,0),(3386,397,'基隆','J',1,0,0),(3387,397,'台中','T',1,0,0),(3388,397,'台南','T',1,0,0),(3389,397,'新竹','X',1,0,0),(3390,397,'嘉义','J',1,0,0),(3391,397,'宜兰县','Y',1,0,0),(3392,397,'桃园县','T',1,0,0),(3393,397,'苗栗县','M',1,0,0),(3394,397,'彰化县','Z',1,0,0),(3395,397,'南投县','N',1,0,0),(3396,397,'云林县','Y',1,0,0),(3397,397,'屏东县','P',1,0,0),(3398,397,'台东县','T',1,0,0),(3399,397,'花莲县','H',1,0,0),(3400,397,'澎湖县','P',1,0,0),(3401,3,'合肥','H',1,0,0),(3402,3401,'庐阳区','L',1,0,0),(3403,3401,'瑶海区','Y',1,0,0),(3404,3401,'蜀山区','S',1,0,0),(3405,3401,'包河区','B',1,0,0),(3406,3401,'长丰县','C',1,0,0),(3407,3401,'肥东县','F',1,0,0),(3408,3401,'肥西县','F',1,0,0);

/*Table structure for table `ysd_comclass` */

DROP TABLE IF EXISTS `ysd_comclass`;

CREATE TABLE `ysd_comclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_comclass` */

insert  into `ysd_comclass`(`id`,`keyid`,`name`,`variable`,`sort`) values (112,39,'未婚',NULL,2),(75,0,'企业反馈类型','job_message',0),(10,0,'工作经验','job_exp',0),(12,10,'应届毕业生','',2),(13,10,'1年以上','',3),(14,10,'2年以上','',4),(15,10,'3年以上','',5),(16,10,'5年以上','',6),(17,10,'8年以上','',7),(18,10,'10年以上','',8),(19,0,'企业性质','job_pr',0),(20,19,'外资企业','',0),(21,19,'合资企业','',1),(22,19,'私营企业','',2),(23,19,'民营企业','',3),(24,19,'股份制企业','',4),(25,19,'集体企业','',4),(26,0,'企业规模','job_mun',0),(27,26,'10人以下','',0),(28,26,'10-50人','',1),(29,26,'50-200人','',2),(30,26,'200-500人','',3),(31,26,'500-1000人','',4),(32,26,'1000人以上','',5),(33,0,'招聘人数','job_number',0),(34,0,'薪水待遇','job_salary',0),(35,0,'工作性质','job_type',0),(36,0,'到岗时间','job_report',0),(37,0,'性别','job_sex',0),(38,0,'教育程度','job_edu',0),(39,0,'婚姻状况','job_marriage',0),(40,33,'若干','',0),(41,33,'1-2人','',1),(42,33,'3-4人','',2),(43,33,'5-6人','',3),(44,33,'7-8人','',4),(45,33,'9-10人','',5),(46,34,'面议','',1),(47,34,'1000以下','',2),(48,34,'1000 - 1999','',3),(49,34,'3000 - 4499','',4),(50,34,'4500 - 5999','',5),(51,34,'6000 - 7999','',6),(52,34,'8000 - 9999','',7),(53,34,'10000及以上','',9),(54,35,'不限','',0),(55,35,'全职','',1),(56,35,'兼职','',2),(57,36,'不限','',0),(58,36,'1周以内','',1),(59,36,'2周以内','',2),(60,36,'3周以内','',3),(61,36,'1个月之内','',4),(62,37,'不限','',0),(63,37,'男','',1),(64,37,'女','',2),(65,38,'不限','',0),(66,38,'高中','',1),(67,38,'中专','',2),(68,38,'大专','',3),(69,38,'本科','',4),(70,38,'硕士','',5),(71,38,'博士','',6),(72,39,'不限','',0),(73,39,'已婚','',1),(76,75,'建议','',1),(77,75,'咨询','',1),(78,75,'购买','',2),(79,19,'上市公司','',0),(80,19,'国家机关','',0),(81,19,'事业单位','',0),(82,19,'其他','',0),(83,34,'2000 - 2999','',3),(84,0,'年龄要求','job_age',NULL),(85,84,'18-25岁',NULL,2),(86,84,'35岁以下',NULL,3),(87,84,'35岁以上',NULL,4),(88,84,'不限','',1),(89,0,'福利待遇','job_welfare',NULL),(90,89,'三险一金',NULL,0),(91,89,'五险一金',NULL,0),(92,89,'包吃住',NULL,0),(93,89,'综合补贴',NULL,0),(94,89,'年终奖金',NULL,0),(95,89,'奖励计划',NULL,0),(96,89,'销售奖金',NULL,0),(97,89,'休假制度',NULL,0),(98,89,'法定节假日',NULL,0),(99,0,'语言要求','job_lang',NULL),(100,99,'普通话一级',NULL,0),(101,99,'普通话二级',NULL,0),(102,99,'普通话三级',NULL,0),(103,99,'英语',NULL,0),(104,99,'韩语',NULL,0),(105,99,'德语',NULL,0),(106,99,'法语',NULL,0),(107,99,'西班牙语',NULL,0),(108,99,'粤语',NULL,0),(109,99,'闽南语',NULL,0),(110,99,'上海话',NULL,0),(127,10,'不限',NULL,1),(128,34,'不限',NULL,1);

/*Table structure for table `ysd_company` */

DROP TABLE IF EXISTS `ysd_company`;

CREATE TABLE `ysd_company` (
  `uid` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `hy` int(5) DEFAULT NULL,
  `pr` int(5) DEFAULT NULL,
  `provinceid` int(5) DEFAULT NULL,
  `cityid` int(5) DEFAULT NULL,
  `mun` int(3) DEFAULT NULL,
  `sdate` varchar(20) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `content` text,
  `address` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `linkman` varchar(50) DEFAULT NULL,
  `linkjob` varchar(50) DEFAULT NULL,
  `linkqq` varchar(20) DEFAULT NULL,
  `linkphone` varchar(20) DEFAULT NULL,
  `linktel` varchar(50) DEFAULT NULL,
  `linkmail` varchar(150) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `payd` int(8) DEFAULT '0',
  `integral` int(10) DEFAULT '0',
  `lastupdate` varchar(10) DEFAULT NULL,
  `cloudtype` int(2) DEFAULT NULL,
  `jobtime` int(11) DEFAULT NULL,
  `r_status` int(2) DEFAULT '0',
  `firmpic` varchar(100) DEFAULT NULL,
  `rec` int(11) DEFAULT '0',
  `hits` int(11) DEFAULT '0',
  `ant_num` int(11) DEFAULT '0',
  `pl_time` int(11) DEFAULT NULL,
  `pl_status` int(11) DEFAULT '1',
  `order` int(11) unsigned DEFAULT '0',
  `admin_remark` varchar(255) DEFAULT NULL,
  `email_dy` int(11) DEFAULT '0',
  `msg_dy` int(11) DEFAULT '0',
  `sync` int(11) unsigned DEFAULT '0',
  `hy_dy` varchar(100) DEFAULT NULL,
  `moblie_status` int(1) DEFAULT '0',
  `email_status` int(1) DEFAULT '0',
  `yyzz_status` int(1) DEFAULT '0',
  `hottime` int(11) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company` */

insert  into `ysd_company`(`uid`,`name`,`hy`,`pr`,`provinceid`,`cityid`,`mun`,`sdate`,`money`,`content`,`address`,`zip`,`linkman`,`linkjob`,`linkqq`,`linkphone`,`linktel`,`linkmail`,`website`,`x`,`y`,`logo`,`payd`,`integral`,`lastupdate`,`cloudtype`,`jobtime`,`r_status`,`firmpic`,`rec`,`hits`,`ant_num`,`pl_time`,`pl_status`,`order`,`admin_remark`,`email_dy`,`msg_dy`,`sync`,`hy_dy`,`moblie_status`,`email_status`,`yyzz_status`,`hottime`,`did`) values (3,'三全',44,22,6,76,30,'',0,'球棒无可奈何花落去无可奈何花落去压顶无可奈何花落去似懂非懂无可奈何花落去大师傅<br />','要','','无可奈何花落去','','','','13589765421','sdfdsf@163.com','',NULL,NULL,NULL,0,0,'1441008352',NULL,NULL,1,NULL,0,0,0,NULL,1,0,NULL,0,0,0,NULL,0,0,0,0,NULL),(14,'神华集团',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'广东',NULL,NULL,NULL,NULL,NULL,'0207587019','1223@qq.com',NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,0,NULL,0,56,0,NULL,1,0,NULL,0,0,0,NULL,0,0,0,0,NULL);

/*Table structure for table `ysd_company_cert` */

DROP TABLE IF EXISTS `ysd_company_cert`;

CREATE TABLE `ysd_company_cert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `step` int(11) DEFAULT NULL,
  `check` varchar(200) DEFAULT NULL,
  `check2` varchar(200) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `statusbody` varchar(100) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_cert` */

/*Table structure for table `ysd_company_job` */

DROP TABLE IF EXISTS `ysd_company_job`;

CREATE TABLE `ysd_company_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hy` int(5) DEFAULT NULL,
  `job1` int(5) DEFAULT NULL,
  `job1_son` int(5) DEFAULT NULL,
  `job_post` int(5) DEFAULT NULL,
  `provinceid` int(5) DEFAULT NULL,
  `cityid` int(5) DEFAULT NULL,
  `three_cityid` int(5) DEFAULT NULL,
  `cert` varchar(50) DEFAULT NULL,
  `salary` int(5) DEFAULT NULL,
  `type` int(5) NOT NULL,
  `number` int(2) NOT NULL,
  `exp` int(5) NOT NULL,
  `report` int(5) NOT NULL,
  `sex` int(5) NOT NULL,
  `edu` int(5) NOT NULL,
  `marriage` int(5) NOT NULL,
  `description` text NOT NULL,
  `xuanshang` int(11) NOT NULL DEFAULT '0',
  `xsdate` int(11) DEFAULT NULL,
  `sdate` int(11) NOT NULL,
  `edate` int(11) NOT NULL,
  `jobhits` int(10) NOT NULL DEFAULT '0',
  `lastupdate` varchar(10) NOT NULL,
  `rec` int(2) DEFAULT '0',
  `cloudtype` int(2) DEFAULT NULL,
  `state` int(2) DEFAULT '0',
  `statusbody` varchar(200) DEFAULT '0',
  `age` int(11) DEFAULT NULL,
  `lang` text,
  `welfare` text,
  `com_name` varchar(50) NOT NULL DEFAULT '',
  `pr` int(5) DEFAULT NULL,
  `mun` int(5) DEFAULT NULL,
  `com_provinceid` int(5) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `urgent` int(1) DEFAULT NULL,
  `r_status` int(1) DEFAULT '0',
  `end_email` int(1) DEFAULT '0',
  `urgent_time` int(11) DEFAULT NULL,
  `com_logo` varchar(100) DEFAULT NULL,
  `autotype` int(11) DEFAULT '0',
  `autotime` int(11) DEFAULT '0',
  `is_link` int(1) DEFAULT '1',
  `link_type` int(1) DEFAULT '1',
  `source` int(1) DEFAULT '1',
  `rec_time` int(11) DEFAULT '0',
  `snum` int(11) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_job` */

insert  into `ysd_company_job`(`id`,`uid`,`name`,`hy`,`job1`,`job1_son`,`job_post`,`provinceid`,`cityid`,`three_cityid`,`cert`,`salary`,`type`,`number`,`exp`,`report`,`sex`,`edu`,`marriage`,`description`,`xuanshang`,`xsdate`,`sdate`,`edate`,`jobhits`,`lastupdate`,`rec`,`cloudtype`,`state`,`statusbody`,`age`,`lang`,`welfare`,`com_name`,`pr`,`mun`,`com_provinceid`,`rating`,`status`,`urgent`,`r_status`,`end_email`,`urgent_time`,`com_logo`,`autotype`,`autotime`,`is_link`,`link_type`,`source`,`rec_time`,`snum`,`did`) values (1,3,'会计',37,37,57,251,6,76,693,NULL,128,54,40,127,57,62,65,72,'eterrew4yewl\'kghjsrkl;gbjsd;lgndsgrgsertet',0,NULL,1441012221,1472918400,70,'1441012221',0,NULL,1,'0',NULL,'','','三全',NULL,NULL,NULL,NULL,0,NULL,0,0,NULL,NULL,0,0,1,1,1,0,2,NULL),(2,3,'its',35,35,50,165,2,52,501,NULL,48,55,41,127,57,62,65,72,'asdas',0,NULL,1441613646,1444060800,1,'1441613646',0,NULL,1,'0',NULL,'','92,93,91,90','三全',NULL,NULL,NULL,NULL,0,NULL,0,0,NULL,NULL,0,0,1,1,1,0,0,NULL),(3,14,'hr',35,35,50,164,6,77,705,NULL,51,55,42,127,57,62,67,72,'牛逼不需要解释',0,NULL,1441888026,1444838400,63,'1441888026',0,NULL,1,'0',NULL,'100,108','','神华集团',NULL,NULL,NULL,NULL,0,NULL,0,0,NULL,NULL,0,0,1,1,1,0,1,NULL),(4,5,'测试3',39,39,70,452,27,343,2912,NULL,128,54,40,127,57,62,65,72,'的人是否为',0,NULL,1441342690,1443888000,0,'1441342690',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(5,5,'测试5',35,39,72,482,6,76,698,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342729,1443888000,0,'1441342729',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(6,5,'测试4',35,37,59,281,6,76,694,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342763,1443888000,0,'1441342763',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(7,5,'测试6',35,44,90,708,25,321,2705,NULL,128,54,40,127,57,62,65,72,'而务实的',0,NULL,1441342808,1443888000,0,'1441342808',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(8,5,'测试7',35,39,72,484,32,394,3327,NULL,128,54,40,127,57,62,65,72,'师大附小',0,NULL,1441342851,1443888000,0,'1441342851',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(9,5,'测试8',35,41,80,617,3,38,418,NULL,128,54,40,127,57,62,65,72,'上大学',0,NULL,1441342892,1443888000,0,'1441342892',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(10,5,'测试9',35,42,84,662,18,246,2087,NULL,128,54,40,127,57,62,65,72,'请问',0,NULL,1441342943,1443888000,1,'1441342943',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(11,5,'测试10',35,37,57,248,27,343,2917,NULL,128,54,40,127,57,62,65,72,'实地调查',0,NULL,1441342977,1443888000,0,'1441342977',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(12,5,'测试11',35,42,84,664,25,321,2709,NULL,128,54,40,127,57,62,65,72,'是东方赛车',0,NULL,1441343008,1443888000,1,'1441343008',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(13,5,'ceshi',41,41,80,617,2,52,501,NULL,51,55,41,127,57,62,65,72,'kl;k',0,NULL,1440432556,1471449600,113,'1440432556',1,NULL,1,'0',NULL,'','92,93,91,90,94,95,98,96,97','312324wqeq',NULL,NULL,NULL,NULL,0,NULL,0,0,NULL,NULL,0,0,1,1,1,1441469490,0,NULL),(14,5,'测试1',35,43,86,679,6,76,692,NULL,128,54,40,127,57,62,65,72,'的说法都是',0,NULL,1441342597,1447862400,0,'1441342597',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(15,5,'测试2',35,39,70,451,6,76,696,NULL,128,54,40,127,57,62,65,72,'说的是',0,NULL,1441342636,1443888000,0,'1441342636',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(16,5,'测试3',39,39,70,452,27,343,2912,NULL,128,54,40,127,57,62,65,72,'的人是否为',0,NULL,1441342690,1443888000,0,'1441342690',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(17,5,'测试5',35,39,72,482,6,76,698,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342729,1443888000,0,'1441342729',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(18,5,'测试4',35,37,59,281,6,76,694,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342763,1443888000,0,'1441342763',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(19,5,'测试6',35,44,90,708,25,321,2705,NULL,128,54,40,127,57,62,65,72,'而务实的',0,NULL,1441342808,1443888000,0,'1441342808',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(20,5,'测试7',35,39,72,484,32,394,3327,NULL,128,54,40,127,57,62,65,72,'师大附小',0,NULL,1441342851,1443888000,0,'1441342851',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(21,5,'测试8',35,41,80,617,3,38,418,NULL,128,54,40,127,57,62,65,72,'上大学',0,NULL,1441342892,1443888000,0,'1441342892',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(22,5,'测试9',35,42,84,662,18,246,2087,NULL,128,54,40,127,57,62,65,72,'请问',0,NULL,1441342943,1443888000,0,'1441342943',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(23,5,'测试10',35,37,57,248,27,343,2917,NULL,128,54,40,127,57,62,65,72,'实地调查',0,NULL,1441342977,1443888000,0,'1441342977',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(24,5,'测试11',35,42,84,664,25,321,2709,NULL,128,54,40,127,57,62,65,72,'是东方赛车',0,NULL,1441343008,1443888000,4,'1441343008',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL);

/*Table structure for table `ysd_company_job_link` */

DROP TABLE IF EXISTS `ysd_company_job_link`;

CREATE TABLE `ysd_company_job_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `jobid` int(11) DEFAULT NULL,
  `link_man` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  `link_moblie` varchar(20) CHARACTER SET gb2312 DEFAULT NULL,
  `email_type` int(5) DEFAULT NULL,
  `is_email` int(2) DEFAULT '0',
  `email` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_job_link` */

/*Table structure for table `ysd_company_msg` */

DROP TABLE IF EXISTS `ysd_company_msg`;

CREATE TABLE `ysd_company_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `cuid` int(11) DEFAULT NULL,
  `content` text,
  `ctime` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `reply` text,
  `reply_time` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_msg` */

/*Table structure for table `ysd_company_news` */

DROP TABLE IF EXISTS `ysd_company_news`;

CREATE TABLE `ysd_company_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `title` varchar(200) DEFAULT '0',
  `ctime` int(11) DEFAULT '0',
  `body` text,
  `status` int(2) DEFAULT '0',
  `statusbody` text,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_news` */

/*Table structure for table `ysd_company_order` */

DROP TABLE IF EXISTS `ysd_company_order`;

CREATE TABLE `ysd_company_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `order_id` varchar(18) DEFAULT NULL,
  `order_type` varchar(25) DEFAULT NULL,
  `order_price` double(18,2) NOT NULL,
  `order_time` int(10) NOT NULL,
  `order_state` int(2) NOT NULL,
  `order_remark` text,
  `order_bank` varchar(150) NOT NULL DEFAULT '0',
  `type` int(1) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `is_invoice` int(1) DEFAULT '0',
  `coupon` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_order` */

/*Table structure for table `ysd_company_pay` */

DROP TABLE IF EXISTS `ysd_company_pay`;

CREATE TABLE `ysd_company_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(18) DEFAULT NULL,
  `order_price` decimal(10,2) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `pay_state` int(2) DEFAULT NULL,
  `com_id` int(10) DEFAULT NULL,
  `pay_remark` varchar(255) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `pay_type` int(4) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_pay` */

insert  into `ysd_company_pay`(`id`,`order_id`,`order_price`,`pay_time`,`pay_state`,`com_id`,`pay_remark`,`type`,`pay_type`,`did`) values (1,'143876554022008','10.00',1438765540,2,1,'注册赠送',1,23,NULL),(2,'143876557643665','10.00',1438765576,2,2,'注册赠送',1,23,NULL),(3,'143884082442851','10.00',1438840824,2,3,'注锟斤拷锟斤拷锟斤拷',1,23,NULL),(4,'143884342788780','1.00',1438843427,2,1,'会员登录',1,0,0),(5,'143884437913803','1.00',1438844379,2,3,'会员登录',1,0,0),(6,'143885690956648','1.00',1438856909,2,2,'会员登录',1,0,0),(7,'143885699831555','2.00',1438856998,2,2,'发布简历',1,0,0),(8,'143885843335314','5.00',1438858433,2,2,'上传头像',1,0,0),(9,'143890948483530','1.00',1438909484,2,2,'会员登录',1,0,0),(10,'144012667432984','1.00',1440126674,2,2,'会员登录',1,0,0),(11,'144040966739605','1.00',1440409667,2,2,'会员登录',1,0,0),(12,'144100820612217','1.00',1441008206,2,3,'会员登录',1,0,0),(13,'144100835233617','10.00',1441008352,2,3,'首次填写基本资料',1,25,0),(14,'144150352669828','1.00',1441503526,2,3,'会员登录',1,0,0),(15,'144150955368320','1.00',1441509553,2,2,'会员登录',1,0,0),(16,'144160624532293','1.00',1441606245,2,3,'会员登录',1,0,0),(17,'144161006435911','1.00',1441610064,2,2,'会员登录',1,0,0),(18,'144171139917823','1.00',1441711399,2,2,'会员登录',1,0,0),(19,'144178281887285','1.00',1441782818,2,3,'会员登录',1,0,0),(20,'144188787022195','1.00',1441887870,2,2,'会员登录',1,0,0),(21,'144193395015195','1.00',1441933950,2,3,'会员登录',1,0,0),(22,'144194164424917','1.00',1441941644,2,2,'会员登录',1,0,0),(23,'144220127127129','1.00',1442201271,2,2,'会员登录',1,0,0),(24,'144220892077253','1.00',1442208920,2,3,'会员登录',1,0,0),(25,'144230368348850','1.00',1442303683,2,2,'会员登录',1,0,0),(26,'144236732096140','1.00',1442367320,2,3,'会员登录',1,0,0),(27,'144239420218648','1.00',1442394202,2,2,'会员登录',1,0,0),(28,'144247008551167','1.00',1442470085,2,2,'会员登录',1,0,0),(29,'144247070071554','1.00',1442470700,2,3,'会员登录',1,0,0);

/*Table structure for table `ysd_company_product` */

DROP TABLE IF EXISTS `ysd_company_product`;

CREATE TABLE `ysd_company_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `title` varchar(200) DEFAULT '0',
  `pic` varchar(200) DEFAULT '0',
  `body` text,
  `ctime` int(11) DEFAULT '0',
  `status` int(2) DEFAULT '0',
  `statusbody` text,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_product` */

/*Table structure for table `ysd_company_rating` */

DROP TABLE IF EXISTS `ysd_company_rating`;

CREATE TABLE `ysd_company_rating` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `service_price` varchar(100) DEFAULT NULL,
  `integral_buy` varchar(100) DEFAULT NULL,
  `yh_price` varchar(100) DEFAULT NULL,
  `yh_integral` varchar(100) DEFAULT NULL,
  `time_start` int(11) DEFAULT NULL,
  `time_end` int(11) DEFAULT NULL,
  `resume` int(5) DEFAULT NULL,
  `job_num` int(11) DEFAULT NULL,
  `interview` int(11) DEFAULT NULL,
  `editjob_num` int(11) DEFAULT NULL,
  `breakjob_num` int(11) DEFAULT NULL,
  `sort` int(10) DEFAULT NULL,
  `display` int(1) DEFAULT NULL,
  `explains` varchar(255) DEFAULT NULL,
  `com_pic` varchar(100) DEFAULT NULL,
  `com_color` varchar(100) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `lt_resume` int(11) DEFAULT NULL,
  `lt_job_num` int(11) DEFAULT NULL,
  `lt_editjob_num` int(11) DEFAULT NULL,
  `lt_breakjob_num` int(11) DEFAULT NULL,
  `category` int(2) DEFAULT NULL,
  `msg_num` int(11) DEFAULT '0',
  `service_time` int(11) DEFAULT NULL,
  `coupon` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_rating` */

insert  into `ysd_company_rating`(`id`,`name`,`service_price`,`integral_buy`,`yh_price`,`yh_integral`,`time_start`,`time_end`,`resume`,`job_num`,`interview`,`editjob_num`,`breakjob_num`,`sort`,`display`,`explains`,`com_pic`,`com_color`,`type`,`lt_resume`,`lt_job_num`,`lt_editjob_num`,`lt_breakjob_num`,`category`,`msg_num`,`service_time`,`coupon`) values (3,'免费会员','0','0','0','0',NULL,NULL,5,3,10,1,2,0,1,'终生免费会员','','#666666',1,2,1,4,5,1,0,0,0),(4,'铜牌会员','10','95',NULL,'0',NULL,NULL,50,50,50,10,10,1,1,'铜牌会员','','FF2B1C',1,6,6,6,6,1,0,30,2),(5,'银牌会员','20','250','10','0',1422547200,1423324800,180,600,80,6,10,2,1,'银牌会员','','FFBC21',1,5,5,15,50,1,0,30,3),(6,'金牌会员','300','900','','0',0,0,800,888,800,100,100,3,1,'金牌会员','','FF1C14',1,66,6,6,6,1,0,30,0);

/*Table structure for table `ysd_company_show` */

DROP TABLE IF EXISTS `ysd_company_show`;

CREATE TABLE `ysd_company_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `picurl` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `body` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `ctime` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `uid` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `sort` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_show` */

/*Table structure for table `ysd_company_statis` */

DROP TABLE IF EXISTS `ysd_company_statis`;

CREATE TABLE `ysd_company_statis` (
  `uid` int(11) NOT NULL,
  `pay` double(10,2) NOT NULL DEFAULT '0.00',
  `integral` varchar(10) NOT NULL DEFAULT '0',
  `sq_job` int(6) unsigned NOT NULL,
  `fav_job` int(6) unsigned NOT NULL,
  `rating` int(5) unsigned DEFAULT NULL,
  `rating_name` varchar(100) DEFAULT NULL,
  `vip_etime` varchar(100) DEFAULT '0',
  `all_pay` double(10,2) NOT NULL,
  `consum_pay` double(10,2) NOT NULL,
  `rating_type` int(11) DEFAULT NULL,
  `invite_resume` int(10) DEFAULT NULL,
  `comtpl` varchar(100) DEFAULT '0',
  `comtpl_all` varchar(100) DEFAULT NULL,
  `job_num` int(11) DEFAULT '0',
  `editjob_num` int(11) DEFAULT '0',
  `breakjob_num` int(11) DEFAULT '0',
  `down_resume` int(10) DEFAULT '0',
  `qqshow` int(11) DEFAULT '0',
  `qqcomment` int(11) DEFAULT '0',
  `sinashare` int(11) DEFAULT '0',
  `sinashow` int(11) DEFAULT '0',
  `sinacomment` int(11) DEFAULT '0',
  `qqwname` varchar(100) DEFAULT NULL,
  `sinawname` varchar(100) DEFAULT NULL,
  `lt_job_num` int(11) DEFAULT '0',
  `lt_editjob_num` int(11) DEFAULT '0',
  `lt_breakjob_num` int(11) DEFAULT '0',
  `lt_down_resume` int(11) DEFAULT '0',
  `qqshare` int(11) DEFAULT '0',
  `msg_num` int(11) DEFAULT '0',
  `autotime` int(11) DEFAULT '0',
  `vip_stime` int(11) DEFAULT '0',
  `did` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_statis` */

insert  into `ysd_company_statis`(`uid`,`pay`,`integral`,`sq_job`,`fav_job`,`rating`,`rating_name`,`vip_etime`,`all_pay`,`consum_pay`,`rating_type`,`invite_resume`,`comtpl`,`comtpl_all`,`job_num`,`editjob_num`,`breakjob_num`,`down_resume`,`qqshow`,`qqcomment`,`sinashare`,`sinashow`,`sinacomment`,`qqwname`,`sinawname`,`lt_job_num`,`lt_editjob_num`,`lt_breakjob_num`,`lt_down_resume`,`qqshare`,`msg_num`,`autotime`,`vip_stime`,`did`) values (3,0.00,'29',2,0,3,'免费会员','0',0.00,0.00,1,10,'0',NULL,0,1,2,5,0,0,0,0,0,NULL,NULL,0,0,0,0,0,0,0,0,NULL),(14,0.00,'10',1,0,3,'免费会员','0',0.00,0.00,1,10,'0',NULL,3,1,2,5,0,0,0,0,0,NULL,NULL,0,0,0,0,0,0,0,0,NULL);

/*Table structure for table `ysd_company_tpl` */

DROP TABLE IF EXISTS `ysd_company_tpl`;

CREATE TABLE `ysd_company_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `url` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `pic` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `type` int(10) DEFAULT '1',
  `price` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT '0',
  `status` int(10) DEFAULT NULL,
  `service_uid` varchar(225) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_company_tpl` */

insert  into `ysd_company_tpl`(`id`,`name`,`url`,`pic`,`type`,`price`,`status`,`service_uid`) values (4,'默认模板','default','data/upload/company/20150606/make_S_14434103463.JPG',0,'0',1,'0'),(6,'扁平模板','blue','data/upload/company/20141218/make_S_14285802996.PNG',1,'5',1,'0'),(7,'时尚大气模板','green','data/upload/company/20150606/make_S_14386895355.JPG',1,'20',1,'0'),(10,'企业模板','white','data/upload/company/20150606/make_S_14354641321.JPG',1,'11',1,'0');

/*Table structure for table `ysd_coupon` */

DROP TABLE IF EXISTS `ysd_coupon`;

CREATE TABLE `ysd_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `scope` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_coupon` */

/*Table structure for table `ysd_coupon_list` */

DROP TABLE IF EXISTS `ysd_coupon_list`;

CREATE TABLE `ysd_coupon_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_name` varchar(20) DEFAULT NULL,
  `validity` int(11) DEFAULT NULL,
  `coupon_amount` int(11) DEFAULT NULL,
  `coupon_scope` int(11) DEFAULT NULL,
  `xf_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_coupon_list` */

/*Table structure for table `ysd_cron` */

DROP TABLE IF EXISTS `ysd_cron`;

CREATE TABLE `ysd_cron` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `dir` varchar(200) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `month` int(10) DEFAULT NULL,
  `hour` int(10) DEFAULT NULL,
  `minute` int(10) DEFAULT NULL,
  `display` int(1) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `nowtime` int(11) DEFAULT '0',
  `nexttime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_cron` */

/*Table structure for table `ysd_desc_class` */

DROP TABLE IF EXISTS `ysd_desc_class`;

CREATE TABLE `ysd_desc_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_desc_class` */

insert  into `ysd_desc_class`(`id`,`name`,`sort`) values (1,'关于我们',1),(2,'支付信息',2),(3,'网站特色',3),(4,'咨询反馈',4),(5,'特色服务',5);

/*Table structure for table `ysd_description` */

DROP TABLE IF EXISTS `ysd_description`;

CREATE TABLE `ysd_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `descs` text,
  `top_tpl` int(2) DEFAULT NULL,
  `top_tpl_dir` varchar(255) DEFAULT NULL,
  `footer_tpl` int(2) DEFAULT NULL,
  `footer_tpl_dir` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `sort` int(11) DEFAULT NULL,
  `is_nav` int(1) DEFAULT '0',
  `ctime` int(11) DEFAULT NULL,
  `is_menu` int(11) DEFAULT '0',
  `is_type` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_description` */

insert  into `ysd_description`(`id`,`nid`,`name`,`url`,`title`,`keyword`,`descs`,`top_tpl`,`top_tpl_dir`,`footer_tpl`,`footer_tpl_dir`,`content`,`sort`,`is_nav`,`ctime`,`is_menu`,`is_type`) values (5,1,'注册协议','about/service.html','注册协议','药师多人才系统,招聘,求职,注册协议','注册协议',1,'',1,'','<p align=\"left\">\r\n	药师多人才（yaoshiduo.com）用户协议<br />\r\n<br />\r\n一、版权：<br />\r\n<br />\r\n此网址的内容和图表受到中国版权法及国际条约的保护。phpyun.com 拥有一切权利，未经其同意，不允许复制。以任何目的重新使用&nbsp;phpyun.com 网上的内容和图表也受到严格的禁止。在内容和图表不作任何修改，在保留内容未做修改，以及得到 phprencai.com 的许可的情况下，phpyun.com 的网上材料可作为网外信息方面和非商业方面的用途。申请使用 phprencai.com 内容的许可是按逐个批准的原则进行的。phpyun.com 欢迎提出申请。请把请求直接提交给400-087- -6680。不要复制或采用 phprencai.com 所创造的用以制成网页的HTML。HTML也属于 phpyun.com的版权。phpyun.com 网址上的“观看”和“感觉”也属于 phpyun.com 的商标，其中包括颜 色的组合、按钮的形状、设计和所有其他的图表。\r\n</p>\r\n<p align=\"left\">\r\n	<br />\r\n</p>\r\n<p align=\"left\">\r\n	<br />\r\n</p>\r\n<p align=\"left\">\r\n	<br />\r\n</p>\r\n<p align=\"left\">\r\n	<br />\r\n</p>',2,1,1433245839,0,1),(9,1,'法律声明','about/phpyun.html','药师多法律声明','人才招聘，人才系统','',1,'',1,'','本授权协议适用且仅适用于PHPYUN.3.0 版本，鑫潮信息技术有限公司拥有对本授权协议的最终解释权。\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	I. 协议许可的权利\r\n</p>\r\n<p>\r\n	1. 您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事网络威客交易；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将PHPYUN 人才系统仅用于产品演示、展示及发布，而并不是用来买卖及盈利的运营活动的)\r\n</p>\r\n<p>\r\n	2. 您可以在协议规定的约束和限制范围内修改 药师多医药人才网 源代码(如果被提供的话)或界面风格以适应您的网站要求。\r\n</p>\r\n<p>\r\n	3. 您拥有使用本软件构建的人才系统中全部招聘信息，求职，用户信息及相关信息的所有权，并独立承担与其内容的相关法律义务。\r\n</p>\r\n<p>\r\n	4. 获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自授权时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	II. 协议规定的约束和限制\r\n</p>\r\n<p>\r\n	1. 未获商业授权之前，不得将本软件用于商业用途(包括但不限于企业法人经营的企业网站、经营性网站、以盈利为目或实现盈利的网站)。\r\n</p>\r\n<p>\r\n	2. 不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。\r\n</p>\r\n<p>\r\n	3. 无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用PHPYUN 人才系统 的整体或任何部分，未经书面许可，网站标题的Powered by PHPYun.都必须保留，而不能清除或修改。\r\n</p>\r\n<p>\r\n	4. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	III. 有限担保和免责声明\r\n</p>\r\n<p>\r\n	1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。\r\n</p>\r\n<p>\r\n	2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。\r\n</p>\r\n<p>\r\n	3. 宿迁鑫潮信息技术有限公司不对使用本软件构建的人才系统中的文章或任务信息承担责任，但在不侵犯用户隐私信息的前提下，保留以任何方式获取用户及商品信息的权利。\r\n</p>\r\n<p>\r\n	有关 药师多人才网! 最终用户授权协议、商业授权与技术服务的详细内容，均由PHPYUN 官方网站独家提供。 宿迁鑫潮信息技术有限公司拥有在不事先通知的情况下，修改授权协议和服务价目表的权力，修改后的协议或价目表对自改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始安装 PHPYUN2.5，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。\r\n</p>',4,1,1415763035,0,1),(21,1,'关于我们','about/index.html','关于我们','关于我们','关于我们888',1,'',1,'','关于我们888',1,1,1433244982,0,1),(22,4,'客服中心','about/kf.html','客服中心','客服中心','客服中心',1,'',1,'','客服中心888',4,1,1415763116,1,1),(23,2,'收费标准','about/charge.html','收费标准','收费标准','收费标准8',1,'',1,'','收费标准',6,1,1415763084,1,1),(24,4,'广告投放','about/gg.html','广告投放','广告投放','广告投放',1,'',1,'','广告投放',6,1,1415763074,1,1),(27,5,'竟价职位','about/jinjia.html','竟价职位','竟价职位','竟价职位',1,'',1,'','竟价职位',5,1,1416318344,0,1),(28,2,'银行帐户','about/yh.html','银行帐户','银行帐户','银行帐户',1,'',1,'','银行帐户',2,1,1416318522,0,1),(29,3,'积分兑换','index.php?m=redeem','','','',1,'',1,'','',23,1,1418223464,0,0),(31,3,'订阅服务','index.php?m=subscribe','','','',1,'',1,'','',46,1,1418216835,0,0),(32,1,'服务流程','about/process.html','服务流程','服务流程','服务流程',1,'',1,'','服务流程',18,0,1433142181,0,1),(33,4,'新手指引','about/newuser.html','新手指引','新手指引','新手指引',1,'',1,'','新手指引',38,1,1417685773,0,1),(34,5,'职场指南','about/new.html','职场指南','','职场指南',1,'',1,'','职场指南',38,1,1417685815,0,1),(35,5,'地图搜索','about/map.html','地图搜索','地图搜索','地图搜索',1,'',1,'','地图搜索',36,1,1417685863,0,1),(36,2,'经营资源','about/indexzy.html','经营资源','经营资源','经营资源',1,'',1,'','经营资源',28,1,1417685914,0,1),(37,2,'品牌推广','about/pinpai.html','品牌推广','品牌推广','品牌推广',1,'',1,'','品牌推广',5,1,1417685956,0,1),(38,4,'常见问题','about/ask.html','常见问题','常见问题','常见问题',1,'',1,'','常见问题',14,0,1423799298,0,1);

/*Table structure for table `ysd_domain` */

DROP TABLE IF EXISTS `ysd_domain`;

CREATE TABLE `ysd_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `province` int(11) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `three_cityid` int(11) DEFAULT NULL,
  `type` int(2) NOT NULL,
  `style` varchar(100) CHARACTER SET gbk COLLATE gbk_bin NOT NULL,
  `tpl` varchar(20) DEFAULT NULL,
  `hy` int(11) DEFAULT NULL,
  `fz_type` int(11) NOT NULL,
  `webtitle` text,
  `webkeyword` text,
  `webmeta` text,
  `weblogo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_domain` */

/*Table structure for table `ysd_down_resume` */

DROP TABLE IF EXISTS `ysd_down_resume`;

CREATE TABLE `ysd_down_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `comid` int(11) DEFAULT NULL,
  `downtime` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_down_resume` */

/*Table structure for table `ysd_email_msg` */

DROP TABLE IF EXISTS `ysd_email_msg`;

CREATE TABLE `ysd_email_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cuid` int(11) DEFAULT NULL,
  `cname` varchar(255) DEFAULT '系统',
  `email` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  `ctime` int(11) DEFAULT NULL,
  `state` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_email_msg` */

/*Table structure for table `ysd_entrust` */

DROP TABLE IF EXISTS `ysd_entrust`;

CREATE TABLE `ysd_entrust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `lt_uid` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `remind_status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_entrust` */

/*Table structure for table `ysd_evaluate` */

DROP TABLE IF EXISTS `ysd_evaluate`;

CREATE TABLE `ysd_evaluate` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `gid` int(4) DEFAULT NULL,
  `question` text,
  `option` text,
  `score` text,
  `sort` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_evaluate` */

/*Table structure for table `ysd_evaluate_group` */

DROP TABLE IF EXISTS `ysd_evaluate_group`;

CREATE TABLE `ysd_evaluate_group` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `keyid` int(4) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `sort` int(4) NOT NULL DEFAULT '0',
  `description` text,
  `ctime` int(11) DEFAULT NULL,
  `fromscore` text,
  `toscore` text,
  `comment` text,
  `visits` int(4) NOT NULL DEFAULT '0',
  `comnum` int(11) DEFAULT '0',
  `pic` varchar(64) DEFAULT NULL,
  `num` int(10) DEFAULT NULL,
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `score` int(11) DEFAULT '0',
  `top` int(1) DEFAULT '0',
  `hot` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_evaluate_group` */

/*Table structure for table `ysd_evaluate_leave_message` */

DROP TABLE IF EXISTS `ysd_evaluate_leave_message`;

CREATE TABLE `ysd_evaluate_leave_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `examid` int(4) unsigned NOT NULL,
  `uid` varchar(36) NOT NULL,
  `usertype` int(1) DEFAULT NULL,
  `message` varchar(512) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_evaluate_leave_message` */

/*Table structure for table `ysd_evaluate_log` */

DROP TABLE IF EXISTS `ysd_evaluate_log`;

CREATE TABLE `ysd_evaluate_log` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `uid` int(4) DEFAULT NULL,
  `nuid` varchar(36) DEFAULT NULL,
  `examid` int(4) NOT NULL,
  `grade` int(4) DEFAULT NULL,
  `ctime` int(11) NOT NULL,
  `usedsecond` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='测评成绩记录表';

/*Data for the table `ysd_evaluate_log` */

/*Table structure for table `ysd_excel` */

DROP TABLE IF EXISTS `ysd_excel`;

CREATE TABLE `ysd_excel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_excel` */

/*Table structure for table `ysd_fav_job` */

DROP TABLE IF EXISTS `ysd_fav_job`;

CREATE TABLE `ysd_fav_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `com_name` varchar(150) NOT NULL,
  `datetime` int(10) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `job_name` varchar(150) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_fav_job` */

insert  into `ysd_fav_job`(`id`,`uid`,`com_id`,`com_name`,`datetime`,`type`,`job_name`,`job_id`) values (1,2,3,'三全',1442543958,1,'会计',1);

/*Table structure for table `ysd_finder` */

DROP TABLE IF EXISTS `ysd_finder`;

CREATE TABLE `ysd_finder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `para` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_finder` */

/*Table structure for table `ysd_friend` */

DROP TABLE IF EXISTS `ysd_friend`;

CREATE TABLE `ysd_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `nid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `uidtype` int(2) DEFAULT NULL,
  `nidtype` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend` */

/*Table structure for table `ysd_friend_foot` */

DROP TABLE IF EXISTS `ysd_friend_foot`;

CREATE TABLE `ysd_friend_foot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_foot` */

insert  into `ysd_friend_foot`(`id`,`uid`,`fid`,`num`,`ctime`) values (1,1,2,2,1442564210);

/*Table structure for table `ysd_friend_im_list` */

DROP TABLE IF EXISTS `ysd_friend_im_list`;

CREATE TABLE `ysd_friend_im_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `touid` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `content` text,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_im_list` */

/*Table structure for table `ysd_friend_info` */

DROP TABLE IF EXISTS `ysd_friend_info`;

CREATE TABLE `ysd_friend_info` (
  `uid` int(11) DEFAULT NULL,
  `nickname` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `sex` int(1) DEFAULT '3',
  `pic` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `pic_big` varchar(100) DEFAULT NULL,
  `description` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `fans` int(11) DEFAULT '0',
  `atnnum` int(11) DEFAULT '0',
  `ask` int(11) DEFAULT '0',
  `answer` int(11) DEFAULT '0',
  `birthday` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `usertype` int(2) DEFAULT NULL,
  `iscert` int(2) DEFAULT '0',
  `did` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_info` */

insert  into `ysd_friend_info`(`uid`,`nickname`,`sex`,`pic`,`pic_big`,`description`,`fans`,`atnnum`,`ask`,`answer`,`birthday`,`usertype`,`iscert`,`did`) values (1,'tao',3,NULL,NULL,NULL,0,0,0,0,NULL,1,0,NULL),(2,'test',3,NULL,NULL,NULL,0,0,0,0,NULL,1,0,NULL),(3,'company',3,NULL,NULL,NULL,0,0,0,0,NULL,2,0,NULL),(14,'神华集团',3,NULL,NULL,NULL,0,0,0,0,NULL,2,0,NULL);

/*Table structure for table `ysd_friend_message` */

DROP TABLE IF EXISTS `ysd_friend_message`;

CREATE TABLE `ysd_friend_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `u_name` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `f_name` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `nid` int(11) DEFAULT '0',
  `content` varchar(225) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `remind_status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_message` */

/*Table structure for table `ysd_friend_reply` */

DROP TABLE IF EXISTS `ysd_friend_reply`;

CREATE TABLE `ysd_friend_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `reply` varchar(225) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_reply` */

/*Table structure for table `ysd_friend_state` */

DROP TABLE IF EXISTS `ysd_friend_state`;

CREATE TABLE `ysd_friend_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `content` varchar(225) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `msg_pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_friend_state` */

insert  into `ysd_friend_state`(`id`,`uid`,`content`,`ctime`,`type`,`msg_pic`) values (1,2,'发布了 <a href=\"http://www.yaoshiduo.com/resume/index.php?c=show&id=1\" target=\"_blank\">新简历</a>。',1438856998,2,NULL),(2,2,'123123',1440129131,1,NULL);

/*Table structure for table `ysd_hot_key` */

DROP TABLE IF EXISTS `ysd_hot_key`;

CREATE TABLE `ysd_hot_key` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(100) NOT NULL,
  `num` int(20) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `check` int(1) DEFAULT '0',
  `color` varchar(10) DEFAULT NULL,
  `bold` int(11) DEFAULT NULL,
  `tuijian` int(11) DEFAULT '0',
  `wxtime` int(11) DEFAULT '0',
  `wxuser` varchar(100) DEFAULT NULL,
  `wxid` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_hot_key` */

insert  into `ysd_hot_key`(`id`,`key_name`,`num`,`type`,`size`,`check`,`color`,`bold`,`tuijian`,`wxtime`,`wxuser`,`wxid`) values (1,'123',1,3,NULL,0,NULL,NULL,0,0,NULL,'0'),(2,'会计',1,3,NULL,0,NULL,NULL,0,0,NULL,'0'),(3,'三全',12,4,NULL,0,NULL,NULL,0,0,NULL,'0');

/*Table structure for table `ysd_hotjob` */

DROP TABLE IF EXISTS `ysd_hotjob`;

CREATE TABLE `ysd_hotjob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `rating` varchar(20) DEFAULT NULL,
  `hot_pic` varchar(100) DEFAULT NULL,
  `service_price` int(11) DEFAULT NULL,
  `time_start` int(11) DEFAULT NULL,
  `time_end` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `beizhu` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_hotjob` */

/*Table structure for table `ysd_industry` */

DROP TABLE IF EXISTS `ysd_industry`;

CREATE TABLE `ysd_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=840 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_industry` */

insert  into `ysd_industry`(`id`,`name`,`sort`) values (35,'计算机/互联网',6),(36,'销售/客服/技术支持',0),(37,'会计/金融/银行/保险',0),(38,'生产/营运/采购/物流',0),(39,'生物/制药/医疗/护理',0),(40,'广告/市场/媒体/艺术',0),(41,'建筑/房地产',0),(42,'人事/行政/高级管理',0),(43,'咨询/法律/教育/科研',0),(44,'服务业',0),(45,'公务员/翻译/其他',1),(836,'化工/能源',1),(835,'贸易/百货',2),(837,'机械/设备/技工',2),(839,'通信/电子',0);

/*Table structure for table `ysd_invoice_record` */

DROP TABLE IF EXISTS `ysd_invoice_record`;

CREATE TABLE `ysd_invoice_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL,
  `order_id` varchar(18) CHARACTER SET gb2312 DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  `link_man` varchar(20) CHARACTER SET gb2312 DEFAULT NULL,
  `link_moblie` varchar(20) CHARACTER SET gb2312 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET gb2312 DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `lasttime` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_invoice_record` */

/*Table structure for table `ysd_job_class` */

DROP TABLE IF EXISTS `ysd_job_class`;

CREATE TABLE `ysd_job_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=953 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_job_class` */

insert  into `ysd_job_class`(`id`,`keyid`,`name`,`sort`,`content`) values (35,0,'计算机/互联网',16,NULL),(36,0,'销售/客服/技术支持',4,NULL),(37,0,'会计/金融/银行/保险',14,NULL),(38,0,'生产/营运/采购/物流',4,NULL),(39,0,'生物/制药/医疗/护理',5,NULL),(40,0,'广告/市场/媒体/艺术',6,NULL),(41,0,'建筑/房地产',7,NULL),(42,0,'人事/行政/高级管理',8,NULL),(43,0,'咨询/法律/教育/科研',14,NULL),(44,0,'服务业',15,NULL),(45,0,'公务员/翻译/其他',1,NULL),(46,35,'计算机硬件',1,NULL),(47,35,'计算机软件',2,NULL),(48,35,'互联网/网游',3,NULL),(49,35,'IT-管理',4,NULL),(50,35,'IT-品管、技术支持及其它',5,NULL),(51,839,'通信技术开发及应用',6,NULL),(52,839,'电子/电器/半导体/仪器仪表',7,NULL),(53,36,'销售管理',4,NULL),(54,36,'销售人员',3,NULL),(55,36,'销售行政及商务',2,NULL),(56,44,'客服及技术支持 ',7,NULL),(57,37,'财务/审计/税务',1,NULL),(58,37,'金融/证券/期货/投资',2,NULL),(59,37,'银行',3,NULL),(60,37,'保险 ',4,NULL),(61,38,'生产/营运',9,NULL),(62,38,'质量/安全管理',8,NULL),(63,38,'工程/机械/能源',7,NULL),(64,38,'汽车',6,NULL),(65,38,'技工',5,NULL),(66,38,'服装/纺织/皮革',4,NULL),(67,38,'采购',3,NULL),(68,38,'贸易',2,NULL),(69,38,'物流/仓储 ',1,NULL),(70,39,'生物/制药/医疗器械',3,NULL),(71,836,'化工/环保',2,NULL),(72,39,'医院/医疗/护理 ',1,NULL),(73,40,'广告',6,NULL),(74,40,'公关/媒介',5,NULL),(75,40,'市场/营销',4,NULL),(76,40,'影视/媒体',3,NULL),(77,40,'写作/出版/印刷',2,NULL),(78,40,'艺术/设计',1,NULL),(79,41,'建筑装潢/市政建设',1,NULL),(80,41,'房地产',2,NULL),(81,41,'物业管理 ',3,NULL),(82,42,'人力资源',3,NULL),(83,42,'高级管理',2,NULL),(84,42,'行政/后勤',1,NULL),(85,43,'咨询/顾问',1,NULL),(86,43,'律师/法务/合规',2,NULL),(87,43,'教师',3,NULL),(88,43,'培训',4,NULL),(89,43,'科研人员',5,NULL),(90,44,'餐饮/娱乐',6,NULL),(91,44,'酒店/旅游',5,NULL),(92,44,'美容/健身/体育',4,NULL),(93,44,'百货/连锁/零售服务',3,NULL),(94,44,'交通运输服务',2,NULL),(95,44,'保安/家政/其他服务',1,NULL),(96,45,'公务员',8,NULL),(97,45,'翻译',7,NULL),(98,45,'在校学生',6,NULL),(99,45,'储备干部/培训生/实习生',5,NULL),(100,45,'兼职',4,NULL),(101,45,'其他',3,NULL),(102,45,'环保',2,NULL),(103,45,'农/林/牧/渔 ',1,NULL),(104,46,'高级硬件工程师',3,NULL),(105,46,'硬件工程师',2,NULL),(106,46,'其他',1,NULL),(121,48,'互联网软件开发工程师',14,NULL),(122,48,'语音/视频开发工程师',15,NULL),(108,47,'高级软件工程师',12,NULL),(109,47,'软件工程师',11,NULL),(14,47,'软件UI设计师/工程师',10,NULL),(111,47,'仿真应用工程师',9,NULL),(112,47,'ERP实施顾问',8,NULL),(113,47,'ERP技术开发',7,NULL),(114,47,'需求工程师',1,NULL),(115,47,'系统集成工程师',2,NULL),(116,47,'系统分析员',3,NULL),(117,47,'系统工程师',4,NULL),(118,47,'系统架构设计师',13,NULL),(119,47,'数据库工程师/管理员',5,NULL),(120,47,'计算机辅',6,NULL),(123,48,'多媒体/游戏开发工程师',16,NULL),(124,48,'网站营运经理/主管',17,NULL),(125,48,'网站营运专员',18,NULL),(126,48,'网络工程师',19,NULL),(127,48,'UI设计师/顾问',20,'<p>\r\n	1.负责网站项目的整体版式、风格设计。\r\n</p>\r\n<p>\r\n	2.进行对外合作的广告及专题设计。\r\n</p>\r\n<p>\r\n	3.以用户为中心的设计理念，对页面进行优化，改善网站用户体验。\r\n</p>'),(128,48,'网站架构设计师',21,NULL),(129,48,'网站维护工程师',22,NULL),(130,48,'系统管理员/网络管理员',23,NULL),(131,48,'网站策划',24,NULL),(132,48,'网站编辑',13,NULL),(133,48,'网页设计/制作/美工',12,'<p>\r\n	1、完成信息内容的策划和日常更新与维护；\r\n</p>\r\n<p>\r\n	2、配合公司组织策划网站推广活动，并参与执行；\r\n</p>\r\n<p>\r\n	3、负责网站页面的整体美工创意、设计和页面的实现；\r\n</p>\r\n<p>\r\n	4、配合网站策划及开发人员进行相应的专题页面制作；\r\n</p>\r\n<p>\r\n	5、负责公司平面宣传品的设计；\r\n</p>\r\n<p>\r\n	6、负责公司广告、图片、动画、海报、logo及网页的设计制作上传；\r\n</p>'),(134,48,'脚本开发工程师',4,NULL),(135,48,'游戏策划师',3,NULL),(136,48,'游戏界面设计师',2,NULL),(137,48,'Flash设计/开发',1,NULL),(138,48,'特效设计师',5,NULL),(139,48,'视觉设计师',6,NULL),(140,48,'音效设计师',7,NULL),(141,48,'SEO搜索引擎优化',8,NULL),(142,48,'网络信息安全工程师',9,NULL),(143,48,'智能大厦/综合布线',10,NULL),(144,48,'其他',11,NULL),(145,49,'首席技术执行官CTO/首席信息官CIO',1,NULL),(146,49,'技术总监/经理',2,NULL),(147,49,'信息技术经理/主管',3,NULL),(148,49,'信息技术专员',4,NULL),(149,49,'项目总监',5,NULL),(150,49,'项目经理',6,NULL),(151,49,'项目主管',7,NULL),(152,49,'项目执行/协调人员',8,NULL),(153,49,'其他',9,NULL),(154,50,'技术支持/维护经理',10,NULL),(155,50,'技术支持/维护工程师',11,NULL),(156,50,'Helpdesk 技术支持',12,NULL),(157,50,'计量工程师',13,NULL),(158,50,'标准化工程师',14,NULL),(159,50,'品质经理',15,NULL),(160,50,'系统测试',16,NULL),(161,50,'软件测试',17,NULL),(162,50,'硬件测试',18,NULL),(163,50,'测试员',19,NULL),(164,50,'文档工程师',20,NULL),(165,50,'技术文员/助理',21,NULL),(166,50,'其他',22,NULL),(167,51,'通信技术工程师',1,NULL),(168,51,'有线传输工程师',2,NULL),(169,51,'无线通信工程师',3,NULL),(170,51,'电信交换工程师',4,NULL),(171,51,'数据通信工程师',5,NULL),(172,51,'移动通信工程师',6,NULL),(173,51,'电信网络工程师',7,NULL),(174,51,'通信电源工程师',8,NULL),(175,51,'增值产品开发工程师',9,NULL),(176,51,'手机软件开发工程师',10,NULL),(177,51,'手机应用开发工程师',11,NULL),(178,51,'其他',12,NULL),(179,52,'IC验证工程师',1,NULL),(180,52,'电气工程师/技术员',2,NULL),(181,52,'电路工程师/技术员(模拟/数字)',3,NULL),(182,52,'电声/音响工程师/技术员',4,NULL),(183,52,'激光/光电子技术',5,NULL),(184,52,'半导体技术',6,NULL),(185,52,'自动控制工程师/技术员',7,NULL),(186,52,'电子软件开发(ARM/MCU...)',8,NULL),(187,52,'嵌入式软件开发(Linux/单片机/DLC/DSP…)',9,NULL),(188,52,'嵌入式硬件开发(主板机…)',10,NULL),(189,52,'电池/电源开发',11,NULL),(190,52,'FAE 现场应用工程师',12,NULL),(191,52,'工艺工程师',13,NULL),(192,52,'家用电器/数码产品研发',14,NULL),(193,52,'仪器/仪表/计量分析师',15,NULL),(194,52,'测试工程师',16,NULL),(195,52,'版图设计工程师',17,NULL),(196,53,'集成电路IC设计/应用工程师',1,NULL),(197,53,'IC验证工程师',2,NULL),(198,53,'电子工程师/技术员',3,NULL),(199,53,'电子技术研发工程师',4,NULL),(200,53,'射频工程师',5,NULL),(201,53,'电子/电器维修工程师/技师',6,NULL),(202,53,'变压器与磁电工程师',7,NULL),(203,53,'版图设计工销售总监',8,NULL),(204,53,'销售经理',9,NULL),(205,53,'销售主管',10,NULL),(206,53,'业务拓展主管/经理',11,NULL),(207,53,'渠道/分销总监',12,NULL),(208,53,'渠道/分销经理',13,NULL),(209,53,'渠道/分销主管',14,NULL),(210,53,'大客户经理',15,NULL),(211,53,'客户经理/主管',16,NULL),(212,53,'区域销售总监',17,NULL),(213,53,'区域销售经理',18,NULL),(214,53,'团购经理/主管',19,NULL),(215,53,'其他',20,NULL),(216,54,'销售代表',1,NULL),(217,54,'渠道/分销专员',2,NULL),(218,54,'客户代表',3,NULL),(219,54,'销售工程师',4,NULL),(220,54,'电话销售',5,NULL),(221,54,'团购业务员',6,NULL),(222,54,'经销商',7,NULL),(223,54,'其他',8,NULL),(224,55,'销售行政经理/主管',1,NULL),(225,55,'销售行政专员/助理',2,NULL),(226,55,'业务分析经理/主管',3,NULL),(227,55,'业务分析专员/助理',4,NULL),(228,55,'商务经理',5,NULL),(229,55,'商务主管/专员',6,NULL),(230,55,'商务助理',7,NULL),(232,55,'其他',0,NULL),(233,56,'客服总监(非技术)',0,NULL),(234,56,'客服经理(非技术)',0,NULL),(235,56,'客服主管(非技术)',0,NULL),(236,56,'客服专员/助理(非技术)',0,NULL),(237,56,'客户关系经理/主管',0,NULL),(238,56,'投诉专员',0,NULL),(239,56,'售前/售后技术支持经理',6,NULL),(240,56,'售前/售后技术支持主管',5,NULL),(241,56,'售前/售后技术支持工程师',4,NULL),(242,56,'咨询热线/呼叫中心服务人员',3,NULL),(243,56,'VIP专员',2,NULL),(244,56,'其他',1,NULL),(245,57,'首席财务官 CFO',0,NULL),(246,57,'财务总监',0,NULL),(247,57,'财务经理',0,NULL),(248,57,'财务顾问',0,NULL),(249,57,'财务主管/总帐主管',0,NULL),(250,57,'会计经理/会计主管',0,NULL),(251,57,'会计',0,NULL),(252,57,'出纳员',0,NULL),(253,57,'财务/会计助理',0,NULL),(254,57,'会计文员',0,NULL),(255,57,'固定资产会计',0,NULL),(256,57,'财务分析经理/主管',0,NULL),(257,57,'财务分析员',0,NULL),(258,57,'成本经理/成本主管',0,NULL),(259,57,'成本管理员',0,NULL),(260,57,'资金经理/主管',0,NULL),(261,57,'资金专员',0,NULL),(262,57,'审计经理/主管',0,NULL),(263,57,'审计专员/助理',0,NULL),(264,57,'税务经理/税务主管',0,NULL),(265,57,'税务专员/助理',0,NULL),(266,57,'统计员',0,NULL),(267,57,'其他',0,NULL),(268,58,'证券/期货/外汇经纪人',0,NULL),(269,58,'证券分析师',0,NULL),(270,58,'股票/期货操盘手',0,NULL),(271,58,'金融/经济研究员',0,NULL),(272,58,'投资/基金项目经理',0,NULL),(273,58,'投资/理财顾问',0,NULL),(274,58,'投资银行业务',0,NULL),(275,58,'融资经理/融资主管',0,NULL),(276,58,'融资专员',0,NULL),(277,58,'拍卖师',0,NULL),(278,58,'其他',0,NULL),(279,59,'行长/副行长',0,NULL),(280,59,'个人业务部门经理/主管',0,NULL),(281,59,'个人业务客户经理',0,NULL),(282,59,'公司业务部门经理/主管',0,NULL),(283,59,'公司业务客户经理',0,NULL),(284,59,'综合业务经理/主管',0,NULL),(285,59,'综合业务专员',0,NULL),(286,59,'资产评估/分析',0,NULL),(287,59,'风险控制',0,NULL),(288,59,'信贷管理',0,NULL),(289,59,'信审核查',0,NULL),(290,59,'进出口/信用证结算',0,NULL),(291,59,'外汇交易',0,NULL),(292,59,'清算人员',0,NULL),(293,59,'高级客户经理/客户经理',0,NULL),(294,59,'客户主管/专员',0,NULL),(295,59,'营业部大堂经理',0,NULL),(296,59,'银行柜员',0,NULL),(297,59,'银行卡、电子银行业务推广',0,NULL),(298,59,'其他',0,NULL),(299,60,'保险精算师',0,NULL),(300,60,'保险产品开发/项目策划',0,NULL),(301,60,'保险业务经理/主管',0,NULL),(302,60,'保险代理/经纪人/客户经理',0,NULL),(303,60,'理财顾问/财务规划师',0,NULL),(304,60,'储备经理人',0,NULL),(305,60,'保险核保',0,NULL),(306,60,'保险理赔',0,NULL),(307,60,'保险客户服务/续期管理',0,NULL),(308,60,'保险培训师',0,NULL),(309,60,'保险内勤',0,NULL),(310,60,'契约管理',0,NULL),(311,60,'其他',0,NULL),(312,61,'工厂经理/厂长',0,NULL),(313,61,'总工程师/副总工程师',0,NULL),(314,61,'项目总监',0,NULL),(315,61,'项目经理/主管项目工程师',0,NULL),(316,61,'营运经理',0,NULL),(317,61,'营运主管',0,NULL),(318,61,'生产总监',0,NULL),(319,61,'生产经理/车间主任',0,NULL),(320,61,'生产计划/物料管理(PMC)',0,NULL),(321,61,'生产主管/督导/领班/组长',0,NULL),(322,61,'生产文员',0,NULL),(323,61,'化验员',0,NULL),(324,61,'其他',0,NULL),(325,62,'质量管理/测试经理(QA/QC经理)',0,NULL),(326,62,'质量管理/测试主管(QA/QC主管)',0,NULL),(327,62,'质量管理/测试工程师(QA/QC工程师)',0,NULL),(328,62,'质量检验员/测试员',0,NULL),(329,62,'可靠度工程师',0,NULL),(330,62,'故障分析工程师',0,NULL),(331,62,'认证工程师/审核员',0,NULL),(332,62,'体系工程师/审核员',0,NULL),(333,62,'环境/健康/安全经理/主管（EHS）',0,NULL),(334,62,'环境/健康/安全工程师（EHS）',0,NULL),(335,62,'供应商管理',0,NULL),(336,62,'采购材料、设备质量管理',0,NULL),(337,62,'其他',0,NULL),(338,63,'电工程师',0,NULL),(339,63,'维修经理/主管',0,NULL),(340,63,'维修工程师',0,NULL),(341,63,'装配工程师/技师',0,NULL),(342,63,'铸造/锻造工程师/技师',0,NULL),(343,63,'注塑工程师/技师',0,NULL),(344,63,'焊接工程师/技师',0,NULL),(345,63,'夹具工程师/技师',0,NULL),(346,63,'CNC工程师',0,NULL),(347,63,'冲压工程师/技师',0,NULL),(348,63,'锅炉工程师/技师',0,NULL),(349,63,'电力工程师/技术员',0,NULL),(350,63,'光源与照明工程',0,NULL),(351,63,'汽车/摩托车工程师',0,NULL),(352,63,'船舶工程师',0,NULL),(353,63,'轨道交通工程师/技术员',0,NULL),(354,63,'飞机维修机械师',0,NULL),(355,63,'飞行器设计与制造',0,NULL),(356,63,'水利/水电工程师',0,NULL),(357,63,'石油天然气技术人员',0,NULL),(358,63,'矿产勘探/地质勘测工程师',0,NULL),(359,63,'其他',0,NULL),(360,64,'技术研发经理/主管',0,NULL),(361,64,'技术研发工程师',0,NULL),(362,64,'产品工艺/制程工程师',0,NULL),(363,64,'产品规划工程师',0,NULL),(364,64,'实验室负责人/工程师',0,NULL),(365,64,'工程/设备经理',0,NULL),(366,64,'工程/设备主管',0,NULL),(367,64,'工程/设备工程师',0,NULL),(368,64,'工程/机械绘图员',0,NULL),(369,64,'工业工程师',0,NULL),(370,64,'材料工程师',0,NULL),(371,64,'机械工程师',0,NULL),(372,64,'结构工程师',0,NULL),(373,64,'模具工程师',0,NULL),(374,64,'机汽车机构工程师',0,NULL),(375,64,'汽车设计工程师',0,NULL),(376,64,'汽车电子工程师',0,NULL),(377,64,'汽车质量管理',0,NULL),(378,64,'汽车安全性能工程师',0,NULL),(379,64,'汽车装配工艺工程师',0,NULL),(380,64,'汽车修理人员',0,NULL),(381,64,'4S店经理/维修站经理',0,NULL),(382,64,'汽车销售/经纪人',0,NULL),(383,64,'二手车评估师',0,NULL),(384,64,'其他',0,NULL),(385,65,'技工',0,NULL),(386,65,'钳工/机修工/钣金工',0,NULL),(387,65,'电焊工/铆焊工',0,NULL),(388,65,'车工/磨工/铣工/冲压工/锣工',0,NULL),(389,65,'切割技工',0,NULL),(390,65,'模具工',0,NULL),(391,65,'电工',0,NULL),(392,65,'叉车工',0,NULL),(393,65,'空调工/电梯工/锅炉工',0,NULL),(394,65,'水工/木工/漆工',0,NULL),(395,65,'普工/操作工',0,NULL),(396,65,'裁缝印纺熨烫',0,NULL),(397,65,'汽车修理工',0,NULL),(398,65,'其他',0,NULL),(399,66,'服装/纺织设计总监',0,NULL),(400,66,'服装/纺织设计',0,NULL),(401,66,'面料辅料开发',0,NULL),(402,66,'面料辅料采购',0,NULL),(403,66,'服装/纺织/皮革跟单',0,NULL),(404,66,'质量管理/验货员(QA/QC)',0,NULL),(405,66,'板房/楦头/底格出格师',0,NULL),(406,66,'打样/制版',0,NULL),(407,66,'电脑放码员',0,NULL),(408,66,'纸样师/车板工',0,NULL),(409,66,'裁床',0,NULL),(410,66,'其他',0,NULL),(411,67,'采购总监',0,NULL),(412,67,'采购经理',0,NULL),(413,67,'采购主管',0,NULL),(414,67,'采购员',0,NULL),(415,67,'采购助理',0,NULL),(416,67,'买手',0,NULL),(417,67,'供应商开发',0,NULL),(418,67,'其他',0,NULL),(419,68,'贸易/进出口经理/主管',0,NULL),(420,68,'贸易/进出口专员/助理',0,NULL),(421,68,'国内贸易人员',0,NULL),(422,68,'业务跟单经理',0,NULL),(423,68,'高级业务跟单',0,NULL),(424,68,'业务跟单',0,NULL),(425,68,'助理业务跟单',0,NULL),(426,68,'其他',0,NULL),(427,69,'物流总监',0,NULL),(428,69,'物流经理',0,NULL),(429,69,'物流主管',0,NULL),(430,69,'物流专员/助理',0,NULL),(431,69,'供应链总监',0,NULL),(432,69,'供应链经理',0,NULL),(433,69,'供应链主管/专员',0,NULL),(434,69,'物料经理',0,NULL),(435,69,'物料主管/专员',0,NULL),(436,69,'仓库经理/主管',0,NULL),(437,69,'仓库管理员',0,NULL),(438,69,'运输经理/主管',0,NULL),(439,69,'项目经理/主管',0,NULL),(440,69,'货运代理',0,NULL),(441,69,'集装箱业务',0,NULL),(442,69,'海关事务管理',0,NULL),(443,69,'报关员',0,NULL),(444,69,'单证员',0,NULL),(445,69,'船务/空运陆运操作',0,NULL),(446,69,'快递员',0,NULL),(447,69,'调度员',0,NULL),(448,69,'理货员',0,NULL),(449,69,'其他',0,NULL),(450,70,'生物工程/生物制药',0,NULL),(451,70,'化学分析测试员',0,NULL),(452,70,'医药技术研发管理人员',0,NULL),(453,70,'医药技术研发人员',0,NULL),(454,70,'临床研究员',0,NULL),(455,70,'临床协调员',0,NULL),(456,70,'临床数据分析员',0,NULL),(457,70,'药品注册',0,NULL),(458,70,'药品生产/质量管理',0,NULL),(459,70,'药品市场推广经理',0,NULL),(460,70,'药品市场推广主管/专员',0,NULL),(461,70,'医药招商',0,NULL),(462,70,'政府事务管理',0,NULL),(463,70,'招投标管理',0,NULL),(464,70,'医药销售经理/主管',0,NULL),(465,70,'医药销售代表',0,NULL),(466,70,'医疗设备注册',0,NULL),(467,70,'医疗设备生产/质量管理',0,NULL),(468,70,'医疗器械市场推广',0,NULL),(469,70,'医疗器械销售',0,NULL),(470,70,'医疗器械维修人员',0,NULL),(471,70,'其他',0,NULL),(472,71,'化工技术应用/化工工程师',0,NULL),(473,71,'化工实验室研究员/技术员',0,NULL),(474,71,'涂料研发工程师',0,NULL),(475,71,'配色技术员',0,NULL),(476,71,'塑料工程师',0,NULL),(477,71,'化妆品研发',0,NULL),(478,71,'食品/饮料研发',0,NULL),(479,71,'造纸研发',0,NULL),(480,71,'其他',0,NULL),(481,72,'医院管理人员',0,NULL),(482,72,'内科医生',0,NULL),(483,72,'外科医生',0,NULL),(484,72,'专科医生',0,NULL),(485,72,'牙科医生',0,NULL),(486,72,'麻醉医生',0,NULL),(487,72,'美容整形师',0,NULL),(488,72,'理疗师',0,NULL),(489,72,'中医科医生',0,NULL),(490,72,'针灸、推拿',0,NULL),(491,72,'儿科医生',0,NULL),(492,72,'心理医生',0,NULL),(493,72,'营养师',0,NULL),(494,72,'药库主任/药剂师',0,NULL),(495,72,'医药学检验',0,NULL),(496,72,'公共卫生/疾病控制',0,NULL),(497,72,'护理主任/护士长',0,NULL),(498,72,'护士/护理人员',0,NULL),(499,72,'兽医',0,NULL),(500,72,'验光师',0,NULL),(501,72,'其他',0,NULL),(502,73,'广告客户总监/副总监',0,NULL),(503,73,'广告客户经理',0,NULL),(504,73,'广告客户主管/专员',0,NULL),(505,73,'广告创意/设计经理',0,NULL),(506,73,'广告创意总监',0,NULL),(507,73,'广告创意/设计主管/专员',0,NULL),(508,73,'美术指导',0,NULL),(509,73,'文案/策划',0,NULL),(510,73,'企业/业务发展经理',0,NULL),(511,73,'企业策划人员',0,NULL),(512,73,'其他',0,NULL),(513,74,'公关经理',0,NULL),(514,74,'公关主管',0,NULL),(515,74,'公关专员',0,NULL),(516,74,'会务/会展经理',0,NULL),(517,74,'会务/会展主管',0,NULL),(518,74,'会务/会展专员',0,NULL),(519,74,'媒介经理',0,NULL),(520,74,'媒介主管',0,NULL),(521,74,'媒介专员',0,NULL),(522,74,'公关/媒介助理',0,NULL),(523,74,'媒介销售',0,NULL),(524,74,'活动策划',0,NULL),(525,74,'其他',0,NULL),(526,75,'市场/营销/拓展总监',0,NULL),(527,75,'市场/营销/拓展经理',0,NULL),(528,75,'市场/营销/拓展主管',0,NULL),(529,75,'市场/营销/拓展专员',0,NULL),(530,75,'市场助理',0,NULL),(531,75,'市场分析/调研人员',0,NULL),(532,75,'产品/品牌经理',0,NULL),(533,75,'产品/品牌主管',0,NULL),(534,75,'产品/品牌专员',0,NULL),(535,75,'市场通路经理/主管',0,NULL),(536,75,'市场通路专员',0,NULL),(537,75,'市场企划经理/主管',0,NULL),(538,75,'市场企划专员',0,NULL),(539,75,'促销经理',0,NULL),(540,75,'促销主管/督导',0,NULL),(541,75,'促销员/导购',0,NULL),(542,75,'选址拓展/新店开发',0,NULL),(543,75,'其他',0,NULL),(544,76,'影视策划/制作人员',0,NULL),(545,76,'导演/编导',0,NULL),(546,76,'艺术/设计总监',0,NULL),(547,76,'经纪人/星探',0,NULL),(548,76,'演员/模特/主持人',0,NULL),(549,76,'摄影师/摄像师',0,NULL),(550,76,'后期制作',0,NULL),(551,76,'音效师',0,NULL),(552,76,'配音员',0,NULL),(553,76,'放映经理/主管',0,NULL),(554,76,'放映员',0,NULL),(555,76,'化妆师/造型师',0,NULL),(556,76,'其他',0,NULL),(557,77,'总编/副总编',0,NULL),(558,77,'编辑',0,NULL),(559,77,'作家/撰稿人',0,NULL),(560,77,'记者',0,NULL),(561,77,'电话采编',0,NULL),(562,77,'美术编辑',0,NULL),(563,77,'排版设计',0,NULL),(564,77,'校对/录入',0,NULL),(565,77,'出版/发行',0,NULL),(566,77,'电分操作员',0,NULL),(567,77,'印刷排版/制版',0,NULL),(568,77,'数码直印/菲林输出',0,NULL),(569,77,'打稿机操作员',0,NULL),(570,77,'调墨技师',0,NULL),(571,77,'印刷机械机长',0,NULL),(572,77,'晒版/拼版/装订/烫金技工',0,NULL),(573,77,'其他',0,NULL),(574,78,'平面设计总监',0,NULL),(575,78,'平面设计经理/主管',0,NULL),(576,78,'平面设计师',0,NULL),(577,78,'绘画',0,NULL),(578,78,'动画/3D设计',0,NULL),(579,78,'原画师',0,NULL),(580,78,'展览/展示/店面设计',0,NULL),(581,78,'多媒体设计',0,NULL),(582,78,'包装设计',0,NULL),(583,78,'工业/产品设计',0,NULL),(584,78,'工艺品/珠宝设计鉴定',0,NULL),(585,78,'家具/家居用品设计',0,NULL),(586,78,'玩具设计',0,NULL),(587,78,'其他',0,NULL),(588,79,'高级建筑工程师/总工',0,NULL),(589,79,'建筑工程师',0,NULL),(590,79,'建筑设计师',0,NULL),(591,79,'市政工程师',0,NULL),(592,79,'结构/土木/土建工程师',0,NULL),(593,79,'公路/桥梁/港口/隧道工程',0,NULL),(594,79,'岩土工程',0,NULL),(595,79,'楼宇自动化',0,NULL),(596,79,'建筑机电工程师',0,NULL),(597,79,'安防工程师',0,NULL),(598,79,'给排水/暖通工程',0,NULL),(599,79,'幕墙工程师',0,NULL),(600,79,'规划与设计',0,NULL),(601,79,'室内外装潢设计',0,NULL),(602,79,'园艺/园林/景观设计',0,NULL),(603,79,'测绘/测量',0,NULL),(604,79,'建筑制图',0,NULL),(605,79,'开发报建',0,NULL),(606,79,'工程造价师/预结算经理',0,NULL),(607,79,'预结算员',0,NULL),(608,79,'建筑工程管理/项目经理',0,NULL),(609,79,'建筑工程验收',0,NULL),(610,79,'工程监理',0,NULL),(611,79,'合同管理',0,NULL),(612,79,'安全员',0,NULL),(613,79,'资料员',0,NULL),(614,79,'施工员',0,NULL),(615,79,'其他',0,NULL),(616,80,'房地产项目/开发/策划经理',0,NULL),(617,80,'房地产项目/开发/策划主管/专员',0,NULL),(618,80,'房产项目配套工程师',0,NULL),(619,80,'房地产项目招投标',0,NULL),(620,80,'房地产评估',0,NULL),(621,80,'房地产中介/交易',0,NULL),(622,80,'房地产销售经理/主管',0,NULL),(623,80,'房地产销售人员',0,NULL),(624,80,'其他',0,NULL),(625,81,'高级物业顾问/物业顾问',0,NULL),(626,81,'物业管理经理/主管',0,NULL),(627,81,'物业管理专员/助理',0,NULL),(628,81,'物业招商/租赁/租售',0,NULL),(629,81,'物业设施管理人员',0,NULL),(630,81,'物业机电工程师',0,NULL),(631,81,'物业维修人员',0,NULL),(632,81,'其他',0,NULL),(633,82,'人事总监',0,NULL),(634,82,'人事经理',0,NULL),(635,82,'人事主管',0,NULL),(636,82,'人事专员',0,NULL),(637,82,'人事助理',0,NULL),(638,82,'招聘经理/主管',0,NULL),(639,82,'招聘专员/助理',0,NULL),(640,82,'薪资福利经理/主管',0,NULL),(641,82,'薪资福利专员/助理',0,NULL),(642,82,'绩效考核经理/主管',0,NULL),(643,82,'绩效考核专员/助理',0,NULL),(644,82,'培训经理/主管',0,NULL),(645,82,'培训专员/助理/培训师',0,NULL),(646,82,'企业文化/员工关系/工会管理',0,NULL),(647,82,'人力资源信息系统专员',0,NULL),(648,82,'其他',0,NULL),(649,83,'首席执行官CEO/总裁/总经理',0,NULL),(650,83,'首席运营官COO',0,NULL),(651,83,'副总经理/副总裁',0,NULL),(652,83,'合伙人',0,NULL),(653,83,'总监/部门经理',0,NULL),(654,83,'策略发展总监',0,NULL),(655,83,'办事处首席代表',0,NULL),(656,83,'办事处/分公司/分支机构经理',0,NULL),(657,83,'总裁助理/总经理助理',0,NULL),(658,83,'其他',0,NULL),(659,84,'行政总监',0,NULL),(660,84,'行政经理/主管/办公室主任',0,NULL),(661,84,'行政专员/助理',0,NULL),(662,84,'经理助理/秘书',0,NULL),(663,84,'前台接待/总机/接待生',0,NULL),(664,84,'后勤',0,NULL),(665,84,'图书管理员/资料管理员',0,NULL),(666,84,'电脑操作员/打字员',0,NULL),(667,84,'其他',0,NULL),(668,85,'专业顾问',0,NULL),(669,85,'咨询总监',0,NULL),(670,85,'咨询经理',0,NULL),(671,85,'专业培训师',0,NULL),(672,85,'咨询员',0,NULL),(673,85,'调研员',0,NULL),(674,85,'猎头/人才中介',0,NULL),(675,85,'情报信息分析人员',0,NULL),(676,85,'其他',0,NULL),(677,86,'律师/法律顾问',0,NULL),(678,86,'律师助理',0,NULL),(679,86,'法务经理',0,NULL),(680,86,'法务主管/专员',0,NULL),(681,86,'法务助理',0,NULL),(682,86,'合规经理',0,NULL),(683,86,'合规主管/专员',0,NULL),(684,86,'知识产权/专利顾问/专员',0,NULL),(685,86,'其他',0,NULL),(686,87,'校长',0,NULL),(687,87,'大学教授',0,NULL),(688,87,'讲师/助教',0,NULL),(689,87,'中学教师',0,NULL),(690,87,'小学教师',0,NULL),(691,87,'幼教',0,NULL),(692,87,'院校教务管理人员',0,NULL),(693,87,'兼职教师',0,NULL),(694,87,'家教',0,NULL),(695,87,'职业技术教师',0,NULL),(696,87,'其他',0,NULL),(697,88,'培训督导',0,NULL),(698,88,'培训讲师',0,NULL),(699,88,'培训策划',0,NULL),(700,88,'培训产品开发',0,NULL),(701,88,'培训/课程顾问',0,NULL),(702,88,'培训助理',0,NULL),(703,88,'其他',0,NULL),(704,89,'科研管理人员',0,NULL),(705,89,'科研人员',0,NULL),(707,90,'餐饮/娱乐管理',0,NULL),(708,90,'餐饮/娱乐领班/部长',0,NULL),(709,90,'餐饮/娱乐服务员',0,NULL),(710,90,'传菜主管/传菜员',0,NULL),(711,90,'礼仪/迎宾',0,NULL),(712,90,'司仪',0,NULL),(713,90,'行政主厨/厨师长',0,NULL),(714,90,'厨师/面点师',0,NULL),(715,90,'调酒师/吧台员',0,NULL),(716,90,'茶艺师',0,NULL),(717,90,'其他',0,NULL),(718,91,'酒店/宾馆经理',0,NULL),(719,91,'酒店/宾馆营销',0,NULL),(720,91,'宴会管理',0,NULL),(721,91,'大堂经理',0,NULL),(722,91,'宾客服务经理',0,NULL),(723,91,'楼面经理',0,NULL),(724,91,'前厅接待',0,NULL),(725,91,'预定部主管',0,NULL),(726,91,'预定员',0,NULL),(727,91,'客房服务员/楼面服务员',0,NULL),(728,91,'机场代表',0,NULL),(729,91,'行李员',0,''),(730,91,'管家部经理/主管',0,NULL),(731,91,'清洁服务人员',0,NULL),(732,91,'健身房服务',0,NULL),(733,91,'旅游产品销售',0,NULL),(734,91,'导游/旅行顾问',0,NULL),(735,91,'行程管理/操作',0,NULL),(736,91,'票务/订房服务',0,NULL),(737,91,'签证专员',0,NULL),(738,91,'其他',0,NULL),(739,92,'美容顾问/化妆',0,NULL),(740,92,'彩妆培训师',0,NULL),(741,92,'专柜彩妆顾问(BA)',0,NULL),(742,92,'美容助理/见席美容师',0,NULL),(743,92,'瘦身顾问',0,NULL),(744,92,'发型师',0,NULL),(745,92,'发型助理/学徒',0,NULL),(746,92,'美甲师',0,NULL),(747,92,'按摩/足疗',0,NULL),(748,92,'健身顾问/教练',0,NULL),(749,92,'体育运动教练',0,NULL),(750,92,'救生员',0,NULL),(751,92,'瑜伽/舞蹈老师',0,NULL),(752,92,'宠物护理/美容',0,NULL),(753,92,'其他',0,NULL),(754,93,'店长/卖场经理/楼面管理',0,NULL),(755,93,'品类经理',0,NULL),(756,93,'店员/营业员',0,NULL),(757,93,'安防主管',0,NULL),(758,93,'防损员/内保',0,NULL),(759,93,'收银主管/收银员',0,NULL),(760,93,'理货员/陈列员/收货员',0,NULL),(761,93,'导购员',0,NULL),(762,93,'西点师/面包糕点加工',0,NULL),(763,93,'生鲜食品加工/处理',0,NULL),(764,93,'熟食加工',0,NULL),(765,93,'兼职店员',0,NULL),(766,93,'其他',0,NULL),(767,94,'飞机机长/副机长',0,NULL),(768,94,'空乘人员',0,NULL),(769,94,'地勤人员',0,NULL),(770,94,'列车/地铁车长',0,NULL),(771,94,'列车/地铁司机',0,NULL),(772,94,'船长/副船长',0,NULL),(773,94,'船员',0,NULL),(774,94,'乘务员',0,NULL),(775,94,'司机',0,NULL),(776,94,'其他',0,NULL),(777,95,'保安经理',0,NULL),(778,95,'保安人员',0,NULL),(779,95,'保镖',0,NULL),(780,95,'寻呼员/话务员',0,NULL),(781,95,'搬运工',0,NULL),(782,95,'清洁工',0,''),(783,95,'家政服务/保姆',0,NULL),(784,95,'其他',0,NULL),(785,96,'公务员',0,NULL),(786,97,'英语翻译',0,NULL),(787,97,'日语翻译',0,NULL),(788,97,'德语翻译',0,NULL),(789,97,'法语翻译',0,NULL),(790,97,'俄语翻译',0,NULL),(791,97,'意大利语翻译',0,NULL),(792,97,'西班牙语翻译',0,NULL),(793,97,'葡萄牙语翻译',0,NULL),(794,97,'阿拉伯语翻译',0,NULL),(795,97,'韩语/朝鲜语翻译',0,NULL),(796,97,'泰语翻译',0,NULL),(797,97,'中国方言翻译',0,NULL),(798,97,'其他语种翻译',0,NULL),(821,98,'研究生',0,NULL),(800,99,'储备干部',0,NULL),(801,99,'培训生',0,NULL),(802,99,'实习生',0,NULL),(803,100,'兼职',0,NULL),(804,101,'驯兽师/助理驯兽师',0,NULL),(805,101,'志愿者',0,NULL),(806,101,'其他 ',0,NULL),(807,102,'环保工程师',0,NULL),(808,102,'环境影响评价工程师',0,NULL),(809,102,'环保检测',0,NULL),(810,102,'水质检测员',0,NULL),(811,102,'污水处理工程师',0,NULL),(812,102,'固废工程师',0,NULL),(813,102,'其它',0,NULL),(814,103,'养殖部主管',0,''),(815,103,'场长(农/林/牧/渔业)',0,''),(816,103,'农艺师',0,NULL),(817,103,'畜牧师',0,NULL),(818,103,'饲养员',0,NULL),(819,103,'动物营养/饲料研发',0,NULL),(820,103,'其他',0,NULL),(822,98,'大学/大专应届毕业生',0,NULL),(823,98,'中专/职校生',0,NULL),(824,98,'其他',0,NULL),(826,52,'集成电路IC设计/应用工程师',0,NULL),(827,52,'电子技术研发工程师',0,NULL),(828,52,'射频工程师',0,NULL),(829,52,'电子/电器维修工程师/技师',0,NULL),(830,52,'变压器与磁电工程师',0,NULL),(831,52,'其他',0,NULL),(836,0,'化工/能源',3,NULL),(835,0,'贸易/百货',1,NULL),(850,847,'电路工程师',0,NULL),(837,0,'机械/设备/技工',2,NULL),(839,0,'通信/电子',2,NULL),(847,836,'电气/能源/动力/矿产',0,NULL),(848,847,'核力/火力工程师',0,NULL),(849,847,'空调/热能工程师',0,NULL),(844,835,'服装/纺织/皮革',0,NULL),(845,835,'百货/连锁/零售',0,NULL),(851,847,'电力工程师',0,NULL),(852,847,'电气维修技术员',0,NULL),(853,847,'制冷/暖通工程师',0,NULL),(854,847,'强电维修技工',0,NULL),(856,847,'变压/变频/磁电',0,NULL),(857,847,'矿产勘探/地质勘测工程师',0,NULL),(858,847,'煤矿/煤炭/煤化',0,NULL),(859,847,'电气工程师',0,NULL),(860,847,'光源与照明工程',0,NULL),(861,847,'水利/水电工程师',0,NULL),(862,847,'风电工程师',0,NULL),(863,847,'光伏系统工程师',0,NULL),(864,847,'燃气轮机工程师',0,NULL),(865,71,'环保工程师',0,NULL),(866,71,'污水处理工程师',0,NULL),(867,71,'环境影响评价工程师',0,NULL),(868,71,'环保检测',0,NULL),(869,71,'水质检测员',0,NULL),(870,71,'固废工程师',0,NULL),(871,835,'贸易',0,NULL),(872,871,'外贸/进出口经理/主管',0,NULL),(873,871,'外贸/进出口专员/助理',0,NULL),(874,871,'外贸/进出口专员/助理',0,NULL),(875,871,'国内贸易经理/主管',0,NULL),(876,871,'国内贸易专员/助理',0,NULL),(877,871,'业务跟单经理/主管',0,NULL),(878,871,'业务跟单专员/助理',0,NULL),(879,871,'单证员',0,NULL),(880,871,'报关/报检员',0,NULL),(881,844,'服装/纺织设计总监',0,NULL),(882,844,'服装/纺织设计',0,NULL),(883,844,'服装/纺织/皮革工艺师',0,NULL),(884,844,'面料辅料开发/采购',0,NULL),(885,844,'服装/纺织/皮革跟单',0,NULL),(886,844,'质量管理/验货员(QA/QC)',0,NULL),(887,844,'板房/楦头/底格出格师',0,NULL),(888,844,'打样/制版',0,NULL),(889,844,'电脑放码员',4,NULL),(890,844,'纸样师/车板工4',4,NULL),(891,844,'裁床',0,NULL),(892,845,'店长/卖场经理/楼面管理',0,NULL),(893,845,'品类经理',0,NULL),(894,845,'店员/营业员',0,NULL),(895,845,'防损员/内保',0,NULL),(896,845,'收银主管/收银员',0,NULL),(897,845,'理货员/陈列员/收货员',0,NULL),(898,845,'导购员',0,NULL),(899,845,'西点师/面包糕点加工',0,NULL),(900,845,'生鲜食品加工/处理',0,NULL),(901,845,'熟食加工',0,NULL),(902,845,'兼职店员',0,NULL),(903,845,'店长助理',0,NULL),(904,845,'防损经理/主管',0,NULL),(905,845,'安防主管',0,NULL),(906,837,'机械/设备',0,NULL),(907,837,'技工',0,NULL),(908,906,'模具工程师',0,NULL),(909,906,'机械工程师',0,NULL),(910,906,'机电工程师',0,NULL),(911,906,'铸造/锻造',0,NULL),(912,906,'冲压工程师/技师',0,NULL),(913,906,'注塑工程师/技师',0,NULL),(914,906,'CNC工程师',0,NULL),(915,906,'轨道交通工程师/技术员',0,NULL),(916,906,'锅炉工程师/技师',0,NULL),(917,906,'船舶工程师',0,NULL),(918,906,'飞行器设计与制造',0,NULL),(919,906,'夹具',0,NULL),(920,906,'工程/机械绘图员',0,NULL),(921,906,'结构工程师',0,NULL),(922,906,'设备工程师',0,NULL),(923,906,'焊接',0,NULL),(924,906,'机械/设备维修',0,NULL),(925,906,'机床/车床',0,NULL),(926,906,'技术研发经理/主管 ',0,NULL),(927,906,'技术研发工程师',0,NULL),(928,906,'产品工艺/制程工程师',0,NULL),(929,906,'产品规划工程师 ',0,NULL),(930,906,'实验室负责人/工程师',0,NULL),(931,906,'工程/设备经理/主管',0,NULL),(932,906,'工业工程师',0,NULL),(933,906,'材料工程师',0,NULL),(934,906,'维修经理/主管',0,NULL),(935,906,'维修工程师',0,NULL),(936,906,'装配工程师/技师',0,NULL),(937,907,'普工',0,NULL),(938,907,'钣金工/机修工/冲压工',0,NULL),(939,907,'电焊工/铆焊工/钳工',0,NULL),(940,907,'车工/磨工/铣工锣工',0,NULL),(941,907,'切割技工',0,NULL),(942,907,'模具工',0,NULL),(943,907,'铲车/叉车工',0,NULL),(944,907,'空调工/电梯工/锅炉工',0,NULL),(945,907,'电工/水工/木工/油漆工',0,NULL),(946,907,'片皮工/铲皮工',0,NULL),(947,907,'裁缝印纺熨烫',0,NULL),(948,907,'万能工',0,NULL),(949,907,'油边工/台面工',0,NULL),(950,907,'技工',0,NULL),(951,907,'汽车修理工',0,NULL),(952,907,'操作工',3,NULL);

/*Table structure for table `ysd_look_job` */

DROP TABLE IF EXISTS `ysd_look_job`;

CREATE TABLE `ysd_look_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `jobid` int(11) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `com_status` int(1) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_look_job` */

insert  into `ysd_look_job`(`id`,`uid`,`jobid`,`com_id`,`datetime`,`status`,`com_status`,`did`) values (1,2,1,3,1442563585,0,0,NULL),(2,2,24,5,1442201947,0,0,NULL),(3,2,3,14,1442470024,0,0,NULL),(4,2,2,3,1442563515,0,0,NULL);

/*Table structure for table `ysd_look_resume` */

DROP TABLE IF EXISTS `ysd_look_resume`;

CREATE TABLE `ysd_look_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL,
  `resume_id` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `com_status` int(1) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_look_resume` */

/*Table structure for table `ysd_member` */

DROP TABLE IF EXISTS `ysd_member`;

CREATE TABLE `ysd_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `moblie` varchar(20) DEFAULT NULL,
  `reg_ip` varchar(20) DEFAULT NULL,
  `reg_date` int(11) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_date` int(11) DEFAULT NULL,
  `usertype` int(1) NOT NULL DEFAULT '1',
  `login_hits` int(11) DEFAULT '0',
  `salt` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `name_repeat` int(2) DEFAULT '0',
  `qqid` varchar(200) DEFAULT NULL,
  `status` int(4) DEFAULT NULL,
  `pwuid` int(11) DEFAULT '0',
  `pw_repeat` int(1) DEFAULT '0',
  `lock_info` varchar(200) CHARACTER SET gb2312 DEFAULT NULL,
  `email_status` int(1) DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `sinaid` varchar(100) DEFAULT NULL,
  `wxid` varchar(100) DEFAULT '0',
  `wxopenid` varchar(100) DEFAULT NULL,
  `unionid` varchar(100) DEFAULT NULL,
  `wxname` varchar(100) DEFAULT NULL,
  `wxbindtime` int(11) DEFAULT '0',
  `passtext` varchar(100) DEFAULT NULL,
  `source` int(1) DEFAULT '1',
  `regcode` int(10) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `reg_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk COMMENT='用户成员表（个人用户、企业用户）';

/*Data for the table `ysd_member` */

insert  into `ysd_member`(`uid`,`username`,`password`,`email`,`moblie`,`reg_ip`,`reg_date`,`login_ip`,`login_date`,`usertype`,`login_hits`,`salt`,`address`,`name_repeat`,`qqid`,`status`,`pwuid`,`pw_repeat`,`lock_info`,`email_status`,`signature`,`sinaid`,`wxid`,`wxopenid`,`unionid`,`wxname`,`wxbindtime`,`passtext`,`source`,`regcode`,`did`,`reg_time`) values (1,'tao','dae2901d5b03326496ff3527b490e174','','','192.168.0.50',1438765540,'192.168.0.50',1438844210,1,0,'4405ca',NULL,0,'',1,0,0,NULL,NULL,NULL,'','',NULL,NULL,NULL,0,NULL,1,0,NULL,NULL),(2,'test','db6a845b0aad3a00b3c997f6f0b7c585','test@qq.com','13800138000','192.168.0.50',1438765576,'192.168.0.44',1442487787,1,0,'8a72ad','详细地址',0,'',1,0,0,NULL,NULL,NULL,'','',NULL,NULL,NULL,0,NULL,1,0,NULL,NULL),(3,'company','7e4f198d42d048b643cebd4015232fa0','sdfdsf@163.com','13589765421','192.168.0.50',1438840824,'192.168.0.159',1442486802,2,0,'8a127b',NULL,0,'',1,0,0,'',NULL,NULL,'','',NULL,NULL,NULL,0,NULL,1,0,NULL,NULL),(5,'13568971234','1819bb95d0ad8f0567880650ec0aa3b8',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'28c52f',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440122562),(6,'13789654321','ee20047e2fb395dad2f7f896f703dec7',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'ad26cd',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440122842),(7,'13898764521','45be64a77523d043f534d795fa3b7123',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'7e2ffd',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440123319),(8,'wwwwewrr@qq.com','44d13b9d9ec6e36e0a7ebd7621ae5afa',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'36447d',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440125011),(9,'wwww@qq.com','805f428666b4d810f0d08eae12a25bfb',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'70213f',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440136967),(10,'werwre@qq.com','f3c3185548d60730859d1256d9f021ee',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'409d3f',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440139364),(11,'ad@qq.com','1a2e938b0ffb5d9912a0e98e2aad963b',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'bb15df',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440381099),(12,'wwwwwww@qq.com','c3ea0f86a0ce9e54a64741471a02bf02',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'91f971',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440411673),(13,'wwwwwwwww@qq.com','5c130bfa453bbeb56ad1d8c31e601bc1',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'dde1d0',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1440413213),(14,'神华','3d17f8ce8ae579f6aa9d9e23271f46d3','1223@qq.com','0207587019','192.168.0.159',1441887968,NULL,NULL,2,0,'00db59','广东',0,NULL,1,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,NULL),(15,'111111111@qq.com','c9641b4502c4ef9c467b5dacab14f098',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'51fb8e',NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,0,NULL,1,NULL,NULL,1442538165);

/*Table structure for table `ysd_member_log` */

DROP TABLE IF EXISTS `ysd_member_log`;

CREATE TABLE `ysd_member_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `opera` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL,
  `content` text,
  `ip` varchar(20) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=gbk COMMENT='会员日志';

/*Data for the table `ysd_member_log` */

insert  into `ysd_member_log`(`id`,`uid`,`opera`,`type`,`usertype`,`content`,`ip`,`ctime`) values (1,2,2,1,1,'创建一份简历','192.168.0.44',1438856998),(2,2,7,0,1,'修改基本信息','192.168.0.44',1438858369),(3,2,0,0,1,'上传头像','192.168.0.44',1438858433),(4,2,0,0,1,'发表朋友圈说说','192.168.0.44',1440129131),(5,3,7,0,2,'修改企业信息','192.168.0.50',1441008352),(6,2,6,0,1,'我申请了职位：hr','192.168.0.44',1442458649),(7,2,5,0,1,'收藏了职位：会计','192.168.0.44',1442543959),(8,2,6,0,1,'我申请了职位：会计','192.168.0.44',1442544894),(9,2,6,0,1,'我申请了职位：会计','192.168.0.44',1442562263);

/*Table structure for table `ysd_member_statis` */

DROP TABLE IF EXISTS `ysd_member_statis`;

CREATE TABLE `ysd_member_statis` (
  `uid` int(11) NOT NULL,
  `integral` varchar(10) NOT NULL DEFAULT '0',
  `pay` double(10,2) NOT NULL DEFAULT '0.00',
  `resume_num` int(10) NOT NULL,
  `fav_jobnum` int(10) NOT NULL,
  `sq_jobnum` int(10) NOT NULL,
  `message_num` int(10) NOT NULL,
  `down_num` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_member_statis` */

insert  into `ysd_member_statis`(`uid`,`integral`,`pay`,`resume_num`,`fav_jobnum`,`sq_jobnum`,`message_num`,`down_num`) values (1,'11',0.00,0,0,0,0,0),(2,'30',0.00,1,1,3,0,0);

/*Table structure for table `ysd_message` */

DROP TABLE IF EXISTS `ysd_message`;

CREATE TABLE `ysd_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `ctime` int(11) DEFAULT NULL,
  `reply` varchar(200) DEFAULT '',
  `reply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='留言反馈';

/*Data for the table `ysd_message` */

/*Table structure for table `ysd_moblie_msg` */

DROP TABLE IF EXISTS `ysd_moblie_msg`;

CREATE TABLE `ysd_moblie_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cuid` int(11) DEFAULT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `moblie` varchar(200) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_moblie_msg` */

/*Table structure for table `ysd_msg` */

DROP TABLE IF EXISTS `ysd_msg`;

CREATE TABLE `ysd_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `jobid` int(11) DEFAULT NULL,
  `job_uid` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `reply` text,
  `content` text,
  `reply_time` int(11) DEFAULT NULL,
  `com_name` varchar(100) DEFAULT NULL,
  `job_name` varchar(100) DEFAULT NULL,
  `del_status` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '1',
  `user_remind_status` int(1) DEFAULT '1',
  `com_remind_status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_msg` */

/*Table structure for table `ysd_navigation` */

DROP TABLE IF EXISTS `ysd_navigation`;

CREATE TABLE `ysd_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `display` int(1) NOT NULL,
  `eject` int(1) NOT NULL,
  `type` int(1) DEFAULT '1',
  `furl` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `bold` int(1) DEFAULT NULL,
  `desc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_navigation` */

insert  into `ysd_navigation`(`id`,`nid`,`name`,`url`,`sort`,`display`,`eject`,`type`,`furl`,`color`,`model`,`bold`,`desc`) values (1,1,'首页','index.php',1,1,0,1,'','','',1,NULL),(2,1,'找工作','job/',2,1,0,1,'','','',1,NULL),(3,1,'找人才','resume/',3,1,0,1,'','','',0,NULL),(4,1,'职场资讯','article/',7,0,0,1,'article/','','',0,NULL),(5,1,'微招聘','once/',6,1,0,1,'','','',0,NULL),(6,2,'注册协议','/about/service.html',98,1,1,1,NULL,NULL,NULL,NULL,NULL),(7,2,'关于我们','/about/about.html',54,1,1,1,NULL,NULL,NULL,NULL,NULL),(8,3,'关于我们','/about/about.html',99,1,0,1,NULL,NULL,NULL,NULL,NULL),(9,3,'首页','index.php',55,1,0,1,NULL,NULL,NULL,NULL,NULL),(17,1,'地图','map/',10,0,1,1,'','','',0,NULL),(11,1,'找企业','company/',4,1,0,1,'','','',0,NULL),(19,4,'首页','/lietou/',11,1,0,1,'','','',0,NULL),(15,1,'招聘会','zph/',9,0,0,1,'','','',0,NULL),(45,1,'测评','evaluate/',11,0,0,1,'','','',0,NULL),(33,5,'首页','index.php',1,0,1,1,'index.html','','',0,NULL),(23,4,'职场问答','ask/',15,1,0,1,'',NULL,NULL,NULL,NULL),(24,4,'人才网首页','/index.php',16,1,0,1,'',NULL,NULL,NULL,NULL),(32,5,'职场问答','ask/',4,1,1,1,'','','',0,NULL),(26,1,'微简历','tiny/',6,1,0,1,'','','',0,NULL),(34,2,'法律声明','/about/phpyun.html',3,1,0,1,NULL,NULL,NULL,NULL,NULL),(49,11,'触屏版','index.php?c=wap',1,1,1,1,'c_wap.html','','',0,NULL),(51,11,'微信','index.php?c=weixin',3,1,1,1,'c_weixin.html','','',0,NULL);

/*Table structure for table `ysd_navigation_type` */

DROP TABLE IF EXISTS `ysd_navigation_type`;

CREATE TABLE `ysd_navigation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_navigation_type` */

insert  into `ysd_navigation_type`(`id`,`typename`) values (1,'头部导航'),(2,'底部导航'),(3,'企业底部导航'),(5,'问答模块导航'),(11,'底部客户端导航');

/*Table structure for table `ysd_navmap` */

DROP TABLE IF EXISTS `ysd_navmap`;

CREATE TABLE `ysd_navmap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `eject` int(1) NOT NULL,
  `type` int(1) DEFAULT '1',
  `furl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk COMMENT='网站地图';

/*Data for the table `ysd_navmap` */

insert  into `ysd_navmap`(`id`,`nid`,`name`,`url`,`sort`,`display`,`eject`,`type`,`furl`) values (1,0,'找工作','job/',99,1,0,1,'m_job.html'),(2,0,'找人才','resume/',98,1,0,1,'m_resume.html'),(3,0,'资讯','article/',97,1,0,1,'m_article.html '),(4,1,'地图招聘','map/',91,1,0,1,'m_map.html'),(5,1,'微招聘','once/',92,1,0,1,'m_once.html'),(6,1,'找企业','company/',93,1,0,1,'m_company.html'),(7,2,'微简历','tiny/',81,1,0,1,'m_tiny.html'),(8,2,'工具箱','hr/',82,1,0,1,'m_hr.html'),(9,3,'问答','/ask',71,1,0,1,''),(10,0,'本站特色','/',9,1,1,2,''),(12,10,'积分兑换','redeem/',11,1,0,1,'m_redeem.html');

/*Table structure for table `ysd_news_base` */

DROP TABLE IF EXISTS `ysd_news_base`;

CREATE TABLE `ysd_news_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `did` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `keyword` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `datetime` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `newsphoto` varchar(100) DEFAULT NULL,
  `s_thumb` varchar(100) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `lastupdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_news_base` */

/*Table structure for table `ysd_news_content` */

DROP TABLE IF EXISTS `ysd_news_content`;

CREATE TABLE `ysd_news_content` (
  `nbid` int(11) NOT NULL,
  `content` text NOT NULL,
  `did` int(11) DEFAULT '0',
  PRIMARY KEY (`nbid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_news_content` */

/*Table structure for table `ysd_news_group` */

DROP TABLE IF EXISTS `ysd_news_group`;

CREATE TABLE `ysd_news_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `rec` int(1) DEFAULT '0',
  `is_menu` int(1) DEFAULT '0',
  `rec_news` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_news_group` */

insert  into `ysd_news_group`(`id`,`keyid`,`name`,`sort`,`rec`,`is_menu`,`rec_news`) values (1,0,'职业指导',20,1,0,1),(2,0,'案例解析',0,0,0,1),(3,0,'管理百科',10,1,0,1),(4,0,'高端访谈',0,0,0,0),(5,0,'劳动法规',0,0,0,0),(6,0,'简历指导',0,0,0,1),(7,0,'现场招聘会',1,0,0,0),(8,0,'求职新闻',3,0,0,0),(9,0,'面试秘籍',3,1,0,0),(10,0,'薪酬行情',2,0,0,0),(17,0,'娱乐节目',0,0,0,1),(36,0,'心理治愈',0,0,1,1),(33,0,'焦点访谈',0,0,0,0);

/*Table structure for table `ysd_once_job` */

DROP TABLE IF EXISTS `ysd_once_job`;

CREATE TABLE `ysd_once_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `mans` varchar(100) NOT NULL,
  `require` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `hits` int(11) DEFAULT '0',
  `linkman` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `edate` int(11) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_once_job` */

/*Table structure for table `ysd_outside` */

DROP TABLE IF EXISTS `ysd_outside`;

CREATE TABLE `ysd_outside` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `titlelen` int(10) DEFAULT NULL,
  `infolen` int(10) DEFAULT NULL,
  `byorder` varchar(200) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `code` text,
  `edittime` int(10) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  `urltype` varchar(200) DEFAULT NULL,
  `timetype` varchar(200) DEFAULT NULL,
  `where` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_outside` */

/*Table structure for table `ysd_prepaid_card` */

DROP TABLE IF EXISTS `ysd_prepaid_card`;

CREATE TABLE `ysd_prepaid_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL,
  `password` varchar(20) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `quota` double(10,2) DEFAULT '0.00',
  `username` varchar(100) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `stime` int(11) DEFAULT NULL,
  `etime` int(11) DEFAULT NULL,
  `utime` int(11) DEFAULT NULL,
  `atime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `卡号索引` (`card`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_prepaid_card` */

/*Table structure for table `ysd_property` */

DROP TABLE IF EXISTS `ysd_property`;

CREATE TABLE `ysd_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_property` */

insert  into `ysd_property`(`id`,`name`,`value`) values (29,'首页推荐','indextj'),(16,'头条','t'),(28,'推荐','tj');

/*Table structure for table `ysd_q_class` */

DROP TABLE IF EXISTS `ysd_q_class`;

CREATE TABLE `ysd_q_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `intro` text,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_q_class` */

insert  into `ysd_q_class`(`id`,`name`,`pid`,`pic`,`sort`,`intro`,`add_time`) values (30,'体育',0,'data/upload/question_class/20150624/14449375651.JPG',0,'',1374638563),(31,'篮球',30,'data/upload/question_class/20130808/13834858827.JPG',0,'篮球是一个由两队参与的球类运动，每队出场5名队员。目的是将球进入对方球篮得分，并阻止对方获得球或得分。可将球向任何方向传、投、拍、滚或运，但要受\r\n规则的限制。篮球比赛的形式多种多样，也有最流行的街头三人篮球赛，是三对三的比赛，更讲究个人技术。当今世界篮球水平最高的联赛是美国的国家篮球协会\r\n（NBA）。',1374638676),(32,'互联网',0,'data/upload/question_class/20150624/14384156205.JPG',0,'<b>互联网</b>（英语：<b>Internet</b>）（首字母小写的internet代表网络而不是互联网），又称<b>网际网路</b>或音译<b>因特网</b>、<b>英特网</b>，是网络与网络之间所串连成的庞大网络，网络以一组通用的协定相连，形成逻辑上的单一巨大国际网络。',1374652186),(33,'物理学',0,'data/upload/question_class/20150624/14361506833.JPG',0,'物理学（英语：Physics）是一种自然科学，主要研究的是时空中的物质及其运动，包括能量和作用力等所有相关概念。更广义地说，物理学探索分析大自然\r\n所发生的现象，目的是要了解其规则。物理学是最古老的学术之一，在过去两千年里，曾经归属于自然哲学。直到十七世纪科学革命之后，物理学才单独成为一门自\r\n然科学。<br />\r\n____<br />\r\n以上内容引自维基百科（物理学），有少许删减。',1374652195),(34,'宇宙学',33,'',22,'越过社会，偷看宇宙',1374652302),(35,'微信',32,'data/upload/question_class/20130808/13853427866.JPG',0,'全球领先的移动即时通讯工具，截止 2013年 1 月注册用户数超过 3亿。',1374652316),(36,'新浪微博',32,'data/upload/question_class/20130808/13816011729.JPG',1,'新浪微博是一个由新浪网推出的提供微型博客服务网站，是一个提供自由发布言论、图片、视频的第三方平台。',1374652327),(37,'移动互联网',32,'data/upload/question_class/20130808/13808971357.JPG',0,'移动互联网，就是将移动通信和互联网二者结合起来，成为一体。在最近几年里，移动通信和互联网成为当今世界发展最快、市场潜力最大、前景最诱人的两大业务，它们的增长速度都是任何预测家未曾预料到的，所以移动互联网可以预见将会创造怎样的经济神话。',1374652340),(38,'羽毛球',30,'data/upload/question_class/20130808/13789559602.JPG',0,'羽毛球是一项隔着球网，使用长柄网状球拍击打平口端扎有一圈羽毛的半球状软木的室内运动。自1992年起，羽毛球成为奥运会的正式比赛项目。',1374652366),(39,'天体物理学',33,'data/upload/question_class/20130808/13769078738.JPG',0,'<b>天体物理学</b>是研究宇宙的物理学，这包括星体的物理性质（光度，密度，温度，化学成分等等）和星体与星体彼此之间的相互作用。应用物理理论与方法，天体物理学探讨恒星结构、恒星演化、太阳系的起源和许多跟宇宙学相关的问题。',1374652389),(40,'量子物理',33,'data/upload/question_class/20130808/13807214153.JPG',0,'<b>量子力学</b>是描写微观物质的一个物理学理论，与相对论一起被认为是现代物理学的两大基本支柱，许多物理学理论和科学如原子物理学、固体物理学、核物理学和粒子物理学以及其它相关的学科都是以量子力学为基础。',1374652399),(42,'电影',0,'data/upload/question_class/20150624/14358010097.JPG',0,'电影是一种表演艺术，视觉艺术及听觉艺术，利用胶卷、录像带或数位媒体将影像和声音捕捉。',1374733040),(43,'美国电影',42,'data/upload/question_class/20130808/13834787833.JPG',0,'19世纪末20世纪初，美国的城市工业经济和中下层居民数量迅速增长，美国电影成为适应城市平民需要的一种大众娱乐。',1374733117),(44,'科幻电影',42,'data/upload/question_class/20130808/13814439425.JPG',0,'科幻片是电影类型的一种，其特色的情节包含了科学奇想。 乔治·梅里爱的《月球之旅》是电影史上最早的一部科幻片。',1374733167),(49,'电子商务',32,'data/upload/question_class/20130808/13810276938.JPG',0,'电子商务（Electronic Commerce）的定义：电子商务是利用计算机技术、网络技术和远程通信技术等，实现电子化、数字化和网络化的整个商务过程。',1374733489),(50,'巴塞罗那（FC Barcelona）',30,'data/upload/question_class/20130807/13857552261.JPG',0,'巴塞罗那足球俱乐部，简称巴萨，成立于1899年11月29日，是位于西班牙巴塞罗那市的大球会，西甲传统豪门之一，也是现今欧洲乃至世界足坛最成功的俱乐部之一。',1375864816),(51,'洛杉矶湖人（Los Angeles Lakers）',30,'data/upload/question_class/20130807/13816861607.JPG',0,'湖人队于1948年加盟NBA，原来属于明尼阿波利斯，于1960年搬迁到了洛杉矶。洛杉矶湖人队是NBA历史上为数不多的常青树之一，该队的夺冠次数仅次于凯尔特人队，共获得16次总冠军。',1375864850),(52,'世界杯',30,'data/upload/question_class/20130807/13802840119.JPG',0,'世界杯（World Cup,FIFA World Cup），国际足联世界杯，世界足球锦标赛是世界上最高荣誉、最高规格、最高水平的足球比赛，与奥运会并称为全球体育两大顶级赛事。',1375864891),(53,'逛街',0,'data/upload/question_class/20150522/14391852907.PNG',34,'地方地方地方',1385621221),(54,'网购',53,NULL,1,'电饭锅',1388382934),(68,'社会民生',0,'data/upload/question_class/20150624/14434658516.JPG',0,'<span style=\"color:#333333;font-family:arial, 宋体, sans-serif;font-size:14px;line-height:24px;background-color:#FFFFFF;\">民生问题的界定 对于“民生”有一个比较准确、合理、恰当的界定，是一件十分重要的事情，因为这直接影响着具体民生政策的制定和实施。如果对民生的界定过于模糊或者过于宽泛的话，那么，基于这种界定的民生政策也不可避免地会出现过于庞杂、模糊不清的状况。相反，如果对于民生的界定过于狭窄的话，那么，建立在这一基础之上的民生政策也不免会出现不到位、不全面的情形。</span>',1434452922);

/*Table structure for table `ysd_question` */

DROP TABLE IF EXISTS `ysd_question`;

CREATE TABLE `ysd_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `answer_num` int(11) NOT NULL DEFAULT '0',
  `atnnum` int(11) DEFAULT '0',
  `visit` int(11) NOT NULL DEFAULT '0',
  `is_recom` int(1) NOT NULL DEFAULT '0',
  `lastupdate` int(11) DEFAULT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_question` */

/*Table structure for table `ysd_reason` */

DROP TABLE IF EXISTS `ysd_reason`;

CREATE TABLE `ysd_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_reason` */

insert  into `ysd_reason`(`id`,`name`) values (1,'非建设性提问'),(2,'不友善言论、垃圾内容与不适宜讨论的内容'),(3,'不构成提问或问题表意不明确'),(4,'问题已失效或过期'),(5,'广告等垃圾信息'),(6,'违法违规内容'),(7,'不宜公开讨论的政治内容');

/*Table structure for table `ysd_rebates` */

DROP TABLE IF EXISTS `ysd_rebates`;

CREATE TABLE `ysd_rebates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `job_uid` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `content` text,
  `datetime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `reply` text,
  `reply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_rebates` */

/*Table structure for table `ysd_recycle` */

DROP TABLE IF EXISTS `ysd_recycle`;

CREATE TABLE `ysd_recycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `tablename` varchar(100) DEFAULT NULL,
  `body` longtext,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk COMMENT='回收站';

/*Data for the table `ysd_recycle` */

insert  into `ysd_recycle`(`id`,`username`,`tablename`,`body`,`ctime`) values (1,'admin','q_class','a:7:{s:2:\"id\";s:2:\"45\";s:4:\"name\";s:7:\"iOS应用\";s:3:\"pid\";s:1:\"0\";s:3:\"pic\";s:51:\"data/upload/question_class/20150624/14437796925.JPG\";s:4:\"sort\";s:1:\"0\";s:5:\"intro\";s:30:\"iPhone, iPod Touch, iPad apps.\";s:8:\"add_time\";s:10:\"1374733246\";}',1441941072),(2,'admin','question','N;',1441941072),(3,'admin','answer','N;',1441941072),(4,'admin','answer_review','N;',1441941072);

/*Table structure for table `ysd_report` */

DROP TABLE IF EXISTS `ysd_report`;

CREATE TABLE `ysd_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_uid` int(11) DEFAULT NULL,
  `c_uid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  `inputtime` int(11) DEFAULT NULL,
  `username` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  `r_name` varchar(100) CHARACTER SET gb2312 DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `r_reason` varchar(200) CHARACTER SET gb2312 DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `r_type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_report` */

/*Table structure for table `ysd_resume` */

DROP TABLE IF EXISTS `ysd_resume`;

CREATE TABLE `ysd_resume` (
  `uid` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `marriage` int(10) DEFAULT NULL,
  `height` varchar(4) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `weight` varchar(4) DEFAULT NULL,
  `idcard` varchar(20) DEFAULT NULL,
  `telphone` varchar(20) DEFAULT NULL,
  `telhome` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `edu` int(11) DEFAULT NULL,
  `homepage` varchar(50) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `resume_photo` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `expect` int(11) DEFAULT '0',
  `def_job` int(11) DEFAULT '0',
  `exp` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `idcard_pic` varchar(100) DEFAULT NULL,
  `email_status` int(1) DEFAULT '0',
  `moblie_status` int(1) DEFAULT '0',
  `idcard_status` int(1) DEFAULT '0',
  `statusbody` varchar(200) DEFAULT NULL,
  `cert_time` int(11) DEFAULT NULL,
  `r_status` int(1) DEFAULT '0',
  `ant_num` int(11) DEFAULT '0',
  `email_dy` int(1) DEFAULT '0',
  `msg_dy` int(1) DEFAULT '0',
  `living` varchar(100) DEFAULT NULL,
  `domicile` varchar(100) DEFAULT NULL,
  `basic_info` int(11) DEFAULT '1',
  `hy_dy` varchar(100) DEFAULT NULL,
  `info_status` int(1) DEFAULT '1',
  `did` int(11) DEFAULT NULL,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume` */

insert  into `ysd_resume`(`uid`,`name`,`sex`,`birthday`,`marriage`,`height`,`nationality`,`weight`,`idcard`,`telphone`,`telhome`,`email`,`edu`,`homepage`,`address`,`description`,`resume_photo`,`photo`,`expect`,`def_job`,`exp`,`status`,`idcard_pic`,`email_status`,`moblie_status`,`idcard_status`,`statusbody`,`cert_time`,`r_status`,`ant_num`,`email_dy`,`msg_dy`,`living`,`domicile`,`basic_info`,`hy_dy`,`info_status`,`did`) values (1,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,1,NULL,0,0,0,NULL,NULL,0,0,0,0,NULL,NULL,1,NULL,1,NULL),(2,'吴广德',6,'1988-08-08',8,'200','这里是民族','65','440883198708080880','13800138000','123123123','test@qq.com',15,'个人主页/博客','详细地址','我非常非常的帅, 搞到全世界都嫉妒我, 我觉得我帅也是天生的, 他们嫉妒我是不应该的','./data/upload/user/20150806/1438858433650_1.JPG','./data/upload/user/20150806/1438858433342_2.JPG',0,1,19,1,NULL,0,0,0,NULL,NULL,1,0,0,0,'这里是现居住地点','户籍所在地',1,NULL,1,NULL);

/*Table structure for table `ysd_resume_cert` */

DROP TABLE IF EXISTS `ysd_resume_cert`;

CREATE TABLE `ysd_resume_cert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) DEFAULT NULL,
  `edate` int(10) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_cert` */

insert  into `ysd_resume_cert`(`id`,`uid`,`eid`,`name`,`sdate`,`edate`,`title`,`content`) values (1,2,1,'IT证书',1438617600,NULL,'IBM','没有技术含量\n没有人够我帅'),(2,2,1,'EN证书',1440000000,NULL,'IELTS','我帅\n我型,我自豪');

/*Table structure for table `ysd_resume_doc` */

DROP TABLE IF EXISTS `ysd_resume_doc`;

CREATE TABLE `ysd_resume_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `doc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_doc` */

/*Table structure for table `ysd_resume_edu` */

DROP TABLE IF EXISTS `ysd_resume_edu`;

CREATE TABLE `ysd_resume_edu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) DEFAULT NULL,
  `edate` int(10) DEFAULT NULL,
  `specialty` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_edu` */

insert  into `ysd_resume_edu`(`id`,`uid`,`eid`,`name`,`sdate`,`edate`,`specialty`,`title`,`content`) values (1,2,1,'学校名称非洲大学',1438531200,1440604800,'计算机','学生','没什么专业可言'),(2,2,1,'昨天大学',1438704000,1440777600,'计算鸡','老师','非常专业');

/*Table structure for table `ysd_resume_expect` */

DROP TABLE IF EXISTS `ysd_resume_expect`;

CREATE TABLE `ysd_resume_expect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `hy` int(5) DEFAULT NULL,
  `job_classid` varchar(100) DEFAULT NULL,
  `provinceid` int(5) DEFAULT NULL,
  `cityid` int(5) DEFAULT NULL,
  `three_cityid` int(5) DEFAULT NULL,
  `salary` int(3) DEFAULT NULL,
  `jobstatus` int(11) DEFAULT NULL,
  `type` int(3) DEFAULT NULL,
  `report` int(3) DEFAULT NULL,
  `defaults` int(1) NOT NULL DEFAULT '0',
  `open` int(1) DEFAULT '1',
  `is_entrust` int(1) DEFAULT '0',
  `full` int(3) DEFAULT '0',
  `doc` int(1) DEFAULT '0',
  `hits` int(6) DEFAULT '0',
  `lastupdate` int(10) NOT NULL,
  `def_job` int(11) DEFAULT NULL,
  `cloudtype` int(2) DEFAULT NULL,
  `olduid` int(11) DEFAULT NULL,
  `integrity` int(11) DEFAULT NULL,
  `height_status` int(11) DEFAULT '0',
  `statusbody` varchar(200) DEFAULT NULL,
  `status_time` int(11) DEFAULT NULL,
  `rec` int(11) DEFAULT '0',
  `top` int(11) DEFAULT NULL,
  `topdate` int(11) DEFAULT '0',
  `rec_resume` int(11) DEFAULT NULL,
  `dom_sort` varchar(255) DEFAULT NULL,
  `resume_diy` text,
  `source` int(1) DEFAULT '1',
  `tmpid` int(5) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `dnum` int(11) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `idcard_status` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `r_status` tinyint(4) DEFAULT '0',
  `edu` int(11) DEFAULT '0',
  `exp` int(11) DEFAULT '0',
  `sex` int(11) DEFAULT '0',
  `photo` varchar(100) DEFAULT NULL,
  `birthday` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`,`defaults`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_expect` */

insert  into `ysd_resume_expect`(`id`,`uid`,`name`,`hy`,`job_classid`,`provinceid`,`cityid`,`three_cityid`,`salary`,`jobstatus`,`type`,`report`,`defaults`,`open`,`is_entrust`,`full`,`doc`,`hits`,`lastupdate`,`def_job`,`cloudtype`,`olduid`,`integrity`,`height_status`,`statusbody`,`status_time`,`rec`,`top`,`topdate`,`rec_resume`,`dom_sort`,`resume_diy`,`source`,`tmpid`,`ctime`,`dnum`,`did`,`uname`,`idcard_status`,`status`,`r_status`,`edu`,`exp`,`sex`,`photo`,`birthday`) values (1,2,'这里是简历名称',39,'450',6,76,693,38,115,58,46,1,1,0,0,0,51,1442304306,NULL,NULL,NULL,100,0,NULL,NULL,0,NULL,0,NULL,'m0,m1,m2,m4,m5,m6,undefined',NULL,1,NULL,1438856998,0,NULL,'吴广德',0,1,0,9,112,6,'./data/upload/user/20150806/1438858433342_2.JPG','1988-08-08');

/*Table structure for table `ysd_resume_other` */

DROP TABLE IF EXISTS `ysd_resume_other`;

CREATE TABLE `ysd_resume_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_other` */

insert  into `ysd_resume_other`(`id`,`uid`,`eid`,`title`,`content`) values (1,2,1,'我很丑','可是我很温柔');

/*Table structure for table `ysd_resume_project` */

DROP TABLE IF EXISTS `ysd_resume_project`;

CREATE TABLE `ysd_resume_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) DEFAULT NULL,
  `edate` int(10) DEFAULT NULL,
  `sys` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_project` */

insert  into `ysd_resume_project`(`id`,`uid`,`eid`,`name`,`sdate`,`edate`,`sys`,`title`,`content`) values (1,2,1,'母鸡生蛋',1437926400,1440777600,'环境不好','职位打杂','没有内容没有内容没有内容没有内容没有内容没有内容没有内容没有内容没有内容没有内容没有内容没有内容'),(2,2,1,'不鸟你',1430841600,1441468800,'你老板','你妹','项目内容填写的');

/*Table structure for table `ysd_resume_show` */

DROP TABLE IF EXISTS `ysd_resume_show`;

CREATE TABLE `ysd_resume_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `picurl` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `ctime` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `uid` varchar(200) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `sort` int(4) DEFAULT '0',
  `eid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='简历作品';

/*Data for the table `ysd_resume_show` */

/*Table structure for table `ysd_resume_skill` */

DROP TABLE IF EXISTS `ysd_resume_skill`;

CREATE TABLE `ysd_resume_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `skill` int(5) NOT NULL,
  `ing` int(5) NOT NULL,
  `longtime` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_skill` */

insert  into `ysd_resume_skill`(`id`,`uid`,`eid`,`name`,`skill`,`ing`,`longtime`) values (1,2,1,'英语',26,43,100),(2,2,1,'C语言',27,43,3);

/*Table structure for table `ysd_resume_tiny` */

DROP TABLE IF EXISTS `ysd_resume_tiny`;

CREATE TABLE `ysd_resume_tiny` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sex` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `hits` int(11) DEFAULT '0',
  `job` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `qq` varchar(25) NOT NULL,
  `production` text NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_tiny` */

/*Table structure for table `ysd_resume_training` */

DROP TABLE IF EXISTS `ysd_resume_training`;

CREATE TABLE `ysd_resume_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) DEFAULT NULL,
  `edate` int(10) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_training` */

insert  into `ysd_resume_training`(`id`,`uid`,`eid`,`name`,`sdate`,`edate`,`title`,`content`) values (1,2,1,'培瞓中心',1428940800,1441036800,'训方向','训方向'),(2,2,1,'陪瞓心心',229190400,1440086400,'培训方向','培训描述培训描述培训描述培训描述培训描述培训描述培训描述培训描述培训描述培训描述培训描述培训描述');

/*Table structure for table `ysd_resume_work` */

DROP TABLE IF EXISTS `ysd_resume_work`;

CREATE TABLE `ysd_resume_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sdate` int(10) DEFAULT NULL,
  `edate` int(10) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_resume_work` */

insert  into `ysd_resume_work`(`id`,`uid`,`eid`,`name`,`sdate`,`edate`,`department`,`title`,`content`) values (1,2,1,'单位名称',1438272000,1439481600,'所在部门','这里是担任职位','1.你老板你老板\n2.你老板你老板\n3.你老板你老板'),(2,2,1,'167167',1435852800,1438099200,'所在部门','担任职位','1. 工作内容\n2. 工作内容\n3. 工作内容');

/*Table structure for table `ysd_reward` */

DROP TABLE IF EXISTS `ysd_reward`;

CREATE TABLE `ysd_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `nid` int(11) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `restriction` int(11) DEFAULT '0',
  `stock` int(11) DEFAULT '0',
  `pic` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `content` text,
  `status` int(1) DEFAULT NULL,
  `sdate` int(11) DEFAULT NULL,
  `rec` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_reward` */

/*Table structure for table `ysd_reward_class` */

DROP TABLE IF EXISTS `ysd_reward_class`;

CREATE TABLE `ysd_reward_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_reward_class` */

/*Table structure for table `ysd_seo` */

DROP TABLE IF EXISTS `ysd_seo`;

CREATE TABLE `ysd_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seoname` varchar(100) DEFAULT NULL,
  `seomodel` varchar(100) DEFAULT NULL,
  `ident` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `time` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `php_url` varchar(100) DEFAULT NULL,
  `rewrite_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_seo` */

insert  into `ysd_seo`(`id`,`seoname`,`seomodel`,`ident`,`title`,`keywords`,`description`,`time`,`did`,`php_url`,`rewrite_url`) values (1,'总首页','index','index','{webname}_最新招聘信息_找工作','{webname}，招聘，招聘网，找工作','{webname}（{weburl}）大品牌的招聘网站，找工作的理想选择，规模大信息真实的专业招聘网站，查询人才网最新招聘信息，找工作，上{webname}!',1434541914,0,'',''),(106,'触屏版','other','wap','触屏版','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','hr135人才网为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418607884,0,'',''),(2,'找工作频道页','job','com','{webname}最新招聘信息|招聘 - {webname}','{webname},招聘,招聘最新信息','{webname}- {webname}招聘频道，为求职者提供最新最全的招聘信息。招聘，找工作，就上{webname}',1433561891,0,'',''),(5,'找人才频道页','resume','user','【求职|找工作|求职信息网】-{webname}','求职,找工作,求职信息网,人才求职','{webname}求职频道是免费的求职信息人才求职信息发布平台。每天有数十万求职者发布销售、客服、餐饮、房地产、美容美发等数百种行业求职信息。找工作首选{webname}求职频道。',1433561928,0,'',''),(6,'新闻首页','news','news','职场资讯_{webname}','职场资讯,职场新闻,职场动态','{webname}为您提供最新鲜的职场资讯、最实用的职场技巧、最前沿的职场动态、最强大的职场攻略。',1433569334,0,'',''),(115,'测评试卷页','evaluate','exampaper','{exampaper}-{webname}','{webkeyword}','{webdesc}',1433906904,0,'',''),(7,'新闻列表','news','newslist','{news_class} - 职场资讯- {webname}','{news_class} ','{webname}为您带来最新的{news_class}的职场资讯。',1433571007,0,'/index.php?m=news&c=list','/articlelist/list-{nid}-{page}.html'),(114,'参会企业','zph','zph_com','{zph_title}参会企业','参会企业','{zph_desc}',1433571891,0,'',''),(8,'微招聘','once','once','微招聘-{webname}','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1433382596,0,'',''),(9,'高级搜索','job','search','高级搜索','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','hr135人才网为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1332841128,NULL,NULL,NULL),(11,'忘记密码','other','forgetpw','{webname}-忘记密码','忘记密码,找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418730967,0,'',''),(12,'申请友情链接','other','friend','友情链接_人才网','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webdesc}',1418735396,0,'',''),(13,'登录','other','login','{webname}-登录','登录,找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418730865,0,'',''),(14,'QQ登录','other','qqlogin','QQ登录','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','不好不坏',1332841075,NULL,NULL,NULL),(15,'注册','other','register','{webname}-注册','注册,找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418730900,0,'',''),(16,'简历内容页','resume','resume','{resume_username}-【{resume_username}的简历】','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418732220,0,'',''),(17,'招聘会首页','zph','zph','招聘会_人才市场_ {webname}','招聘会,人才市场, 最新近期人才招聘会,{webname}','{webname}人才市场，获悉最新招聘会信息请上{webname}人才市场，{webname}人才市场的理想选择。',1433571501,0,'',''),(18,'微招聘','once','once_show','{once_job} - {webname}','{once_name},{once_job}','{once_desc}',1434538627,0,'',''),(19,'企业黄页','com','firm','找企业_企业信息_企业招聘-{webname}','知名公司,企业招聘,企业招聘信息,{webname}','{webname}为您提供最全的的企业招聘信息汇集全国上百万家企业招聘信息，为中高端人才提供优质的工作机会，选企业，找工作就上{webname}',1433502763,0,'',''),(20,'职位页面','job','comapply','招聘{job_name}_{company_name}招聘{job_name}-{webname}','招聘{job_name}招聘信息,{company_name}招聘{job_name},{webname}','{company_name}招聘{job_name}{job_name}招聘信息简介内容包括：工资待遇职位描述工作地点岗位职责，工作内容等{job_name}信息',1434554616,0,'/job/?c=comapply','/job/{id}.html'),(22,'新闻内容页','news','news_article','{news_title} - {webname}','{news_keyword}，{news_class} ','{news_desc}',1434591727,0,'/article/index.php?c=show','/article/{id}.html'),(23,'公告内容页','gg','announcement','{gg_title}-{webname}','{webkeyword}','{gg_desc}',1434191416,0,'',''),(24,'分享简历','resume','resume_share','分享简历--{resume_username}','分享简历','分享简历',1358582606,0,NULL,NULL),(25,'地图招聘','other','map','地图招聘 - {webname}','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','地图招聘-{webdesc}',1418735445,0,'',''),(32,'微简历','tiny','tiny','微简历-{webname}','微简历-{webname}','微简历-{webdesc}',1418804000,0,'',''),(33,'问答首页','ask','ask_index','问答首页-{webname}','{webkeyword}','{webdesc}',1374717488,0,NULL,NULL),(34,'问答搜索页','ask','ask_search','问答搜索页-{webname}','{webkeyword}','{webdesc}',1374717569,0,NULL,NULL),(35,'问答话题页','ask','ask_topic','问答话题页-{webname}','{webkeyword}','{webdesc}',1374717643,0,NULL,NULL),(36,'问答一周热点','ask','ask_hot_week','一周热点-{webname}','{webkeyword}','{webdesc}',1374717730,0,NULL,NULL),(37,'个人主页','ask','message','{nickname}的问答主页-{webname}','{webkeyword}','{webdesc}',1433908036,0,'',''),(38,'个人提问列表','ask','myquestio','{nickname}的提问-{webname}','{webkeyword}','{webdesc}',1433908211,0,'',''),(39,'回答列表','ask','myanswer','{nickname}的回答-{webname}','{webkeyword}','{webdesc}',1433908254,0,'',''),(40,'我要提问','ask','ask_add_question','我要提问-{webname}','{webkeyword}','{webdesc}',1374718098,0,NULL,NULL),(42,'添加微简历','tiny','tinyadd','发布微简历-{webname}','{webkeyword}','{webdesc}',1374746423,0,NULL,NULL),(43,'朋友网首页',NULL,'fri_index','{webname}-朋友圈首页-交友-朋友','{webname}-朋友圈首页-交友-朋友','{webname}-朋友圈首页-交友-朋友',1418736468,0,'',''),(44,'朋友圈个人主页',NULL,'fri_profile','{webname}-朋友圈-个人主页-交友-朋友','{webname}-朋友圈-个人主页-交友-朋友','{webname}-朋友圈-个人主页-交友-朋友',1418736499,0,'',''),(45,'我的好友',NULL,'fri_myfriend','{webname}-我的好友-交友-朋友','{webname}-我的好友-交友-朋友','{webname}-我的好友-交友-朋友',1418736417,0,'',''),(46,'添加好友',NULL,'fri_addfriend','{webname}-添加好友-交友-朋友','{webname}-添加好友-交友-朋友','{webname}-添加好友-交友-朋友',1418736283,0,'',''),(47,'好友申请',NULL,'fri_applyfriend','{webname}-好友申请-交友-朋友','{webname}-好友申请-交友-朋友','{webname}-好友申请-交友-朋友',1418736315,0,'',''),(48,'我的留言板',NULL,'fri_messagelist','{webname}-留言板-留言-交友-朋友','{webname}-留言板-留言-交友-朋友','{webname}-留言板-留言-交友-朋友',1418736379,0,'',''),(49,'修改资料',NULL,'fri_info','{webname}-修改资料-交友-朋友','{webname}-修改资料-交友-朋友','{webname}-修改资料-交友-朋友',1418736345,0,'',''),(50,'修改头像',NULL,'fri_photo','修改头像-朋友圈-朋友-交友-{webname}','修改头像-朋友圈-朋友-交友','修改头像-朋友圈-朋友-交友',1418735734,0,'',''),(51,'关注的问题','ask','attenquestion','{nickname}关注的问题-{webname}','{webkeyword}','{webdesc}',1433908368,0,'',''),(53,'职位推荐','job','recommend','{webname}职位推荐','{webname}职位推荐','{webname}职位推荐',1376310278,0,NULL,NULL),(54,'排行榜','other','top','排行榜 - {webname}','{webkeyword}','{webdesc}',1377312541,0,NULL,NULL),(55,'电脑访问wap','other','moblie','wap - {webname}','{webkeyword}','{webdesc}',1377312613,0,NULL,NULL),(56,'微简历-内容页','tiny','tiny_cont','{tiny_username} -{tiny_job},微简历','{tiny_job},微简历','{tiny_desc}微简历',1418803949,0,'',''),(61,'公司首页','com','company_index','{company_name}-公司首页-{webname}','{company_name},公司首页,{webname}','{company_name_desc}',1433502841,0,'',''),(62,'公司招聘职位','com','company_post','{company_name}-招聘职位-{webname}','{company_name}-招聘职位-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1430709775,0,'/index.php?tp=post','/{id}.html'),(63,'企业形象','com','company_show','{company_name}-企业形象-{webname}','{company_name}-企业形象-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1383274202,0,NULL,NULL),(64,'企业产品展示','com','company_product','{company_name}-产品展示-{webname}','{company_name}-产品展示-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1383275001,0,NULL,NULL),(65,'公司简介','com','company_intro','{company_name}-公司简介-{webname}','{company_name}-公司简介-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1383275058,0,NULL,NULL),(66,'公司新闻','com','company_news','{company_name}-公司新闻-{webname}','{company_name}-公司新闻-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1430709813,0,'/index.php?tp=news','/{id}.html'),(67,'地理位置','com','company_position','{company_name}-地理位置-{webname}','{company_name}-地理位置-{webname}','{webname}为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1417248916,0,NULL,NULL),(68,'联系我们','com','company_connection','{company_name}-联系我们-{webname}','{company_name}-联系我们-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1383275186,0,NULL,NULL),(69,'企业产品内容页','com','company_productshow','{company_name}-{company_product}-{webname}','{company_name}-{company_product}-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1383276043,0,NULL,NULL),(70,'企业新闻内容页','com','company_newsshow','{company_name}-{company_news}-{webname}','{company_name}-{company_news}-{webname}','为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作',1399293165,0,NULL,NULL),(72,'找工作列表页','job','com_search','{seacrh_class}最新招聘信息|招聘 - {webname}','{webname},招聘,招聘最新信息-{seacrh_class} ','{webname}- {webname}招聘频道，为求职者提供最新最全的招聘信息。招聘，找工作，就上{webname}',1433561870,0,'',''),(73,'找人才列表页','resume','user_search','{seacrh_class}人才列表-{webname}-人才列表','{seacrh_class},人才列表','{webname}个人简历库为您提供海量优秀的个人简历您可以搜索销售、客服、文员等数百种职位人才的个人简历.搜简历找人才就来{webname}个人简历库。',1434192892,0,'',''),(78,'招聘会详情页','zph','zph_show','{zph_title}-招聘会-{webname} ','找人才,六千工作岗位,求职者可登录{webname}查看职位','{zph_desc}找人才六千工作岗位求职者可登录{webname}查看职位',1418730320,0,'',''),(80,'激活邮箱','other','activate','激活邮箱 - {webname}','激活邮箱','激活邮箱',1414053810,0,NULL,NULL),(82,'企业评论','com','company_msg','{company_name}-企业评论-{webname}','{webkeyword}','{webdesc}',1433858281,0,'',''),(83,'积分兑换','other','redeem','积分兑换-{webname}','{webkeyword}','{webdesc}',1413892396,0,NULL,NULL),(85,'邮件订阅','other','subscribe','{webname}-邮件订阅','{webname}-邮件订阅','{webname}-邮件订阅',1418269274,0,'',''),(86,'邀请注册','other','invitereg','{webname}邀请注册','{webkeyword}邀请注册','{webdesc}邀请注册',1418734191,0,'',''),(87,'激活邮件','other','sendcert','{webname}激活邮件','{webkeyword}激活邮件','{webdesc}激活邮件',1418734168,0,'/index.php?m=sendcert','/sendcert.html'),(92,'培训课程','train','subject','{webname}-培训课程-开课,课程','{webkeyword}-培训课程-开课,课程','{webname}-面向全国企业用户，为各大企业提供管理培训课程，企业培训公开课及企业计划书，为企业进一步提高工作质量和创造客户满意度的管理培训课程。',1418737057,0,'',''),(88,'工具箱','hr','hrindex','{webname}工具箱','{webkeyword}工具箱','{webdesc}工具箱',1418734140,0,'',''),(89,'工具箱列表','hr','hrlist','{hr_class}-{webname}','{hr_class}-{webname}','{hr_class}-{hr_desc}',1418734251,0,'',''),(107,'微信','other','weixin','微信','找工作,人才,工作,求职,招聘,简历,跳槽,高薪,面试,应聘,兼职','hr135人才网为个人提供最全最新最准确的企业职位招聘信息，为企业提供全方位的人力资源服务，帮助个人求职者快速的找到工作。',1418608367,0,'',''),(110,'如何获得积分','other','integral','{webname}-如何获得积分','{webkeyword}-如何获得积分','{webdesc}-如何获得积分',1418709520,0,'',''),(111,'专题招聘',NULL,'spe_index','专题招聘-{webname}','{webkeyword}','{webdesc}',1433232040,0,'',''),(112,'专题招聘列表',NULL,'spe_show','专题招聘列表-{webname}','{webkeyword}','{webdesc}',1433232250,0,'',''),(113,'公告列表页','gg','announcement_index','系统公告','系统公告','系统公告',1433250659,0,'',''),(116,'测评主页','evaluate','evaluate','测评主页-{webname}','{webkeyword}','{webdesc}',1433906804,0,'',''),(117,'测评得分页面','evaluate','gradeshow','测评得分-{exampaper}-{webname}','{webkeyword}','{webdesc}',1433907501,0,'',''),(118,'推荐测评','evaluate','invite','邀请好友测评-{webname}','{webkeyword}','{webdesc}',1433907537,0,'',''),(119,'更多测评','evaluate','morelist','更多测评-{webname}','{webkeyword}','{webdesc}',1433907752,0,'',''),(120,'关注达人','ask','myatn','{nickname}关注的达人-{webname}','{webkeyword}','{webdesc}',1433908506,0,'',''),(121,'粉丝列表','index','myfans','{nickname}的粉丝-{webname}','{webkeyword}','{webdesc}',1433908562,0,'','');

/*Table structure for table `ysd_special` */

DROP TABLE IF EXISTS `ysd_special`;

CREATE TABLE `ysd_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `tpl` varchar(100) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `limit` int(10) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `rating` varchar(200) DEFAULT NULL,
  `display` int(10) DEFAULT '1',
  `com_bm` int(10) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `etime` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='企业专题';

/*Data for the table `ysd_special` */

/*Table structure for table `ysd_special_com` */

DROP TABLE IF EXISTS `ysd_special_com`;

CREATE TABLE `ysd_special_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_special_com` */

/*Table structure for table `ysd_subscribe` */

DROP TABLE IF EXISTS `ysd_subscribe`;

CREATE TABLE `ysd_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `job1` int(11) DEFAULT NULL,
  `job1_son` int(11) DEFAULT NULL,
  `job_post` int(11) DEFAULT NULL,
  `provinceid` int(11) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `three_cityid` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `cycle_time` int(11) DEFAULT NULL,
  `time` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_subscribe` */

/*Table structure for table `ysd_sysmsg` */

DROP TABLE IF EXISTS `ysd_sysmsg`;

CREATE TABLE `ysd_sysmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET gbk COLLATE gbk_bin NOT NULL,
  `fa_uid` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '管理员',
  `ctime` int(11) NOT NULL,
  `remind_status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_sysmsg` */

/*Table structure for table `ysd_talent_pool` */

DROP TABLE IF EXISTS `ysd_talent_pool`;

CREATE TABLE `ysd_talent_pool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `cuid` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='人才库';

/*Data for the table `ysd_talent_pool` */

/*Table structure for table `ysd_templates` */

DROP TABLE IF EXISTS `ysd_templates`;

CREATE TABLE `ysd_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_templates` */

insert  into `ysd_templates`(`id`,`name`,`title`,`content`) values (1,'emailreg','{webname}注册会员!','{webname}{weburl}'),(2,'emailfkcg','付款提醒-{webname}','您已成功为订单：{order_id}付款，支付金额：{price}元。如有疑问，请拨打{webtel}联系网站。'),(3,'emailyqms','{webname}-邀请面试','{webname}-{company} 邀请你您面试！详情请登录{weburl}&lt;br /&gt;'),(4,'msgyqms','','你好！{company}邀请您面试，职位：{jobname}！'),(5,'emailzzshtg','{webname}{weburl}','&lt;p&gt;\r\n	欢迎您使用{webname}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	网址：{weburl}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	电话：{webtel}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	您发布的职位 {jobname} 通过了审核。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	时间：{date}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;'),(6,'msgreg','','{webname}注册通知：{weburl}用户名：{username}密码：{password}。'),(7,'msgzzshtg','','{webname}{webtel}{date}'),(8,'emailgetpass','{webname}找回密码!','&lt;p&gt;\r\n	您的帐号{username} 验证码：{sendcode}\r\n&lt;/p&gt;'),(9,'msggetpass','','{webname}：您的验证码为：{sendcode}'),(10,'emailsqzw','{webname}职位申请：{jobname}','&lt;p&gt;\r\n	您好，您发布的职位：{jobname} 有人投递了简历，请尽快登录 {weburl} 查看 ！这是来自{webname} 的职位申请通知！\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	时间：{date}\r\n&lt;/p&gt;'),(11,'msgsqzw','','您好，有用户在{webname}上成功申请了您发布的职位：{jobname}，详细请登录：{weburl}'),(19,'email_userstatus','{webname}-会员审核','&lt;p&gt;\r\n	{webname}-{status_info}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	{date}\r\n&lt;/p&gt;'),(12,'msgfkcg','','您已成功为订单：{order_id}付款，支付金额：{price}元。如有疑问，请拨打{webtel}联系网站。'),(13,'emailcert','{webname}邮箱认证','&lt;p&gt;\r\n	{webname}{weburl}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	联系我们：{webtel}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	激活地址：{url}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	时间：{date}\r\n&lt;/p&gt;'),(14,'msgcert','','{webname}{code}'),(15,'emaillock','会员账号锁定说明','{lock_info}'),(16,'emailcomcert','企业营业执照审核邮件回复--{webname}','&lt;p&gt;\r\n	{comname}：\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;{certinfo}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	{webname} {weburl} {webtel}\r\n&lt;/p&gt;'),(17,'emailusercert','个人身份认证审核邮件回复--{webname}','&lt;p&gt;\r\n	{username} ：\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;{certinfo}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	{webname} {weburl} {webtel}\r\n&lt;/p&gt;'),(18,'emailjobed','{com_name}','&lt;p&gt;\r\n	您好，贵公司【{com_name}】发布的职位【{job_name}】已过期。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	---{webname}{weburl}{webtel}\r\n&lt;/p&gt;'),(20,'emailuserstatus','{webname}-会员审核','&lt;p&gt;\r\n	{webname}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	{status_info}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	{date}\r\n&lt;/p&gt;'),(21,'emailzzshwtg','{webname}--职位审核未通过','&lt;p&gt;\r\n	您在{webname}上发布了 {jobname} 没有通过审核，有什么问题，您可以通过{webtel}联系我们。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	审核原因：{status_info}\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	时间：{date}\r\n&lt;/p&gt;'),(22,'emailremind','邮件提醒-{webname}','您已经很长时间没有来 {webname} 。&lt;br /&gt;'),(23,'msgremind','','您好，你已经很长时间没有来{webname}'),(24,'msgcomdy','','{webname} 发布了新的人才 {resumename}，网址：{weburl}，网站电话：{webtel}'),(25,'msguserdy','','{webname} 发布了新的职位 {jobname}，网址：{weburl}，网站电话：{webtel}'),(26,'emailuserdy','{webname}-邮件订阅','{webname},有人发布了{jobname}，详情请登录{weburl} 。网站电话：{webtel}<br />'),(27,'emailcomdy','{webname}-邮件订阅','{webname}有人发布了 &lt;span&gt;{resumename}&lt;/span&gt;，详情请登录{weburl} 。网站电话：{webtel}'),(28,'emailnotice','职位推送','&lt;span&gt;{webname}&lt;/span&gt; 职位：&lt;span&gt;{jobname}&lt;/span&gt;&lt;br /&gt;'),(29,'msgnotice','','{webname} 职位名称：{jobname}'),(30,'msgregcode','','{webname}欢迎您！您的注册验证码为：{code}');

/*Table structure for table `ysd_toolbox_class` */

DROP TABLE IF EXISTS `ysd_toolbox_class`;

CREATE TABLE `ysd_toolbox_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` text,
  `pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_toolbox_class` */

insert  into `ysd_toolbox_class`(`id`,`name`,`content`,`pic`) values (7,'招聘/面试','包含各种人事招聘和人才面试专用表格文档，招聘专员可根据需求自行下载hr资料，实现人企互聘第一步。','data/upload/hrclass/20141114/14160140867.PNG'),(8,'薪酬制度','hr可以适时参考工具箱内的资料表单，制定合理人性的薪酬制度，在众多招聘企业中一招制胜。','data/upload/hrclass/20141211/14206742821.PNG'),(10,' 人事档案 ',' 以表单和文字形式记录企业和员工的主要经历、政治面貌、素质文化等内容，作为企业文化的内在凭证。','data/upload/hrclass/20141114/14184851391.PNG'),(11,'加班/考勤','工具箱内提供各种形式的考勤表格供hr参考，以维护企业正常的工作秩序，严肃企业纪律。 ','data/upload/hrclass/20141114/14223214394.PNG'),(12,'员工管理','包含工作内容、员工纪律等一系列直接涉及员工福利和工作性质的资料。帮助hr快速专业的落实人才工作。','data/upload/hrclass/20141114/14227189698.PNG'),(13,'合同/试用','hr下载合适的合同范本作为跟人才之间的契约协议签订，成功实现企业和人才之间的双向选择。  ','data/upload/hrclass/20141114/14180306464.PNG'),(14,' 出差','针对公司出差问题，提供相关的出差规定、出差情况记录表等，准确掌握员工工作动态，明晰公司财务清单。','data/upload/hrclass/20141114/14177901288.PNG'),(15,' 员工培训','提供各类员工培训参考，包含出国培训、新进职员培训等，为企业提供多样的培训意见，提高员工素质能力。 ','data/upload/hrclass/20141114/14176882761.PNG'),(16,'效绩考核','多种绩效考核办法标准，为企业提供全面的参考，正面引导员工的工作行为和工作业绩，实现企业战略目标。','data/upload/hrclass/20141114/14167299477.PNG'),(17,'移交/辞退','工具箱内提供各种辞职申请范本，企业可以进行参考，制定合理的离职流程。','data/upload/hrclass/20141114/14171978886.PNG'),(18,'其他','企业hr工作中其他事项的参考标准，可以自定义选择添加。','data/upload/hrclass/20141114/14185027369.PNG');

/*Table structure for table `ysd_toolbox_doc` */

DROP TABLE IF EXISTS `ysd_toolbox_doc`;

CREATE TABLE `ysd_toolbox_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `is_show` int(1) DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  `downnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_toolbox_doc` */

/*Table structure for table `ysd_user_entrust` */

DROP TABLE IF EXISTS `ysd_user_entrust`;

CREATE TABLE `ysd_user_entrust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `price` double(10,2) DEFAULT NULL,
  `comid` text,
  `add_time` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_user_entrust` */

/*Table structure for table `ysd_user_entrust_record` */

DROP TABLE IF EXISTS `ysd_user_entrust_record`;

CREATE TABLE `ysd_user_entrust_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) DEFAULT NULL,
  `comid` int(11) DEFAULT NULL,
  `jobid` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_user_entrust_record` */

/*Table structure for table `ysd_user_resume` */

DROP TABLE IF EXISTS `ysd_user_resume`;

CREATE TABLE `ysd_user_resume` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `eid` int(10) NOT NULL,
  `expect` int(1) DEFAULT '0',
  `skill` int(1) DEFAULT '0',
  `work` int(1) DEFAULT '0',
  `project` int(1) DEFAULT '0',
  `edu` int(1) DEFAULT '0',
  `training` int(1) DEFAULT '0',
  `cert` int(1) DEFAULT '0',
  `other` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_user_resume` */

insert  into `ysd_user_resume`(`id`,`uid`,`eid`,`expect`,`skill`,`work`,`project`,`edu`,`training`,`cert`,`other`) values (1,2,1,1,2,2,2,2,2,2,1);

/*Table structure for table `ysd_userclass` */

DROP TABLE IF EXISTS `ysd_userclass`;

CREATE TABLE `ysd_userclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `variable` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_userclass` */

insert  into `ysd_userclass`(`id`,`keyid`,`name`,`variable`,`sort`) values (1,0,'性别','user_sex',0),(2,0,'婚姻状况','user_marriage',0),(3,0,'教育程度','user_edu',0),(4,0,'工作经验','user_word',0),(6,1,'男','',1),(7,1,'女','',3),(8,2,'已婚','',0),(9,3,'高中以下','',0),(25,0,'技能','user_skill',0),(11,2,'未婚','',2),(12,3,'高中','',1),(13,3,'中专','',3),(14,3,'大专','',4),(15,3,'本科','',5),(16,3,'硕士','',6),(17,3,'博士','',7),(18,4,'应届毕业生','',1),(19,4,'1年以上','',2),(20,4,'2年以上','',3),(21,4,'3年以上','',4),(22,4,'5年以上','',6),(23,4,'8年以上','',7),(24,4,'10年以上','',8),(26,25,'外语','',1),(27,25,'计算机','',2),(28,25,'其他','',3),(29,0,'期待薪资','user_salary',0),(30,29,'面议','',1),(31,29,'1000以下','',2),(32,29,'1000 - 1999','',3),(33,29,'2000 - 2999','',4),(34,29,'3000 - 4499','',5),(35,29,'4500 - 5999','',6),(36,29,'6000 - 7999','',7),(37,29,'8000 - 9999','',8),(38,29,'10000及以上','',9),(39,0,'技能程度','user_ing',0),(40,39,'一般','',1),(41,39,'良好','',2),(42,39,'熟练','',3),(43,39,'精通','',4),(44,0,'到岗时间','user_report',0),(45,44,'随时到岗','',1),(46,44,'1周以内','',2),(47,44,'3周以内','',3),(48,44,'1个月之内','',4),(50,44,'3个月之内','',5),(51,44,'不确定','',6),(52,0,'个人反馈类型','user_message',0),(53,52,'咨询','',1),(54,52,'建议','',2),(55,52,'意见','',3),(56,0,'工作性质','user_type',0),(57,56,'不限','',0),(58,56,'全职','',1),(59,56,'兼职','',2),(100,4,'4年以上',NULL,5),(101,4,'6年以上',NULL,7),(112,4,'无经验',NULL,0),(113,0,'求职状态','user_jobstatus',0),(114,113,'已离职，寻求新工作',NULL,1),(115,113,'在职，考虑更好职位',NULL,2),(116,113,'其他',NULL,3);

/*Table structure for table `ysd_userid_job` */

DROP TABLE IF EXISTS `ysd_userid_job`;

CREATE TABLE `ysd_userid_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_name` varchar(150) NOT NULL,
  `com_id` int(11) NOT NULL,
  `com_name` varchar(150) NOT NULL,
  `eid` int(10) unsigned NOT NULL,
  `datetime` int(10) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `is_browse` int(1) NOT NULL DEFAULT '1',
  `body` varchar(255) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_userid_job` */

insert  into `ysd_userid_job`(`id`,`uid`,`job_id`,`job_name`,`com_id`,`com_name`,`eid`,`datetime`,`type`,`is_browse`,`body`,`did`) values (3,2,1,'会计',3,'三全',1,1442562263,1,1,NULL,NULL);

/*Table structure for table `ysd_userid_msg` */

DROP TABLE IF EXISTS `ysd_userid_msg`;

CREATE TABLE `ysd_userid_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `fid` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `datetime` int(10) NOT NULL,
  `default` int(1) DEFAULT '0',
  `is_browse` int(1) DEFAULT '1',
  `address` varchar(255) DEFAULT NULL,
  `intertime` varchar(255) DEFAULT NULL,
  `linkman` varchar(50) DEFAULT NULL,
  `linktel` varchar(50) DEFAULT NULL,
  `jobid` int(11) DEFAULT NULL,
  `jobname` varchar(50) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_userid_msg` */

/*Table structure for table `ysd_warning` */

DROP TABLE IF EXISTS `ysd_warning`;

CREATE TABLE `ysd_warning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `ctime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_warning` */

/*Table structure for table `ysd_webscan360` */

DROP TABLE IF EXISTS `ysd_webscan360`;

CREATE TABLE `ysd_webscan360` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `var` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `ext1` varchar(100) DEFAULT NULL,
  `ext2` varchar(100) DEFAULT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ysd_webscan360` */

/*Table structure for table `ysd_website` */

DROP TABLE IF EXISTS `ysd_website`;

CREATE TABLE `ysd_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `smallday` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_website` */

/*Table structure for table `ysd_wxlog` */

DROP TABLE IF EXISTS `ysd_wxlog`;

CREATE TABLE `ysd_wxlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wxid` varchar(100) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '0',
  `wxname` varchar(100) DEFAULT NULL,
  `wxuid` int(11) DEFAULT '0',
  `wxuser` varchar(100) DEFAULT NULL,
  `content` text,
  `reply` text,
  `nav` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_wxlog` */

/*Table structure for table `ysd_wxnav` */

DROP TABLE IF EXISTS `ysd_wxnav`;

CREATE TABLE `ysd_wxnav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `keyid` int(11) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk;

/*Data for the table `ysd_wxnav` */

insert  into `ysd_wxnav`(`id`,`name`,`keyid`,`key`,`url`,`type`,`sort`) values (1,'我的菜单',0,NULL,NULL,'click',1),(2,'找工作',0,NULL,NULL,'click',2),(3,'更多功能',0,NULL,NULL,'click',3),(4,'我的帐号',1,'我的帐号','','click',4),(5,'我的消息',1,'我的消息','','click',5),(6,'面试邀请',1,'面试邀请','','click',6),(7,'简历查看',1,'简历查看','','click',7),(8,'刷新简历',1,'刷新简历','','click',8),(9,'职位搜索',2,'职位搜索',NULL,'click',9),(10,'推荐职位',2,'推荐职位',NULL,'click',10),(11,'周边职位',2,'周边职位',NULL,'click',11),(12,'微招聘',3,'','http://www.hr135.com/wap/index.php?c=once','view',12),(13,'微简历',3,'','http://www.hr135.com/wap/index.php?c=tiny','view',13),(14,'职场资讯',3,'','http://www.hr135.com/wap/index.php?c=news','view',14);

/*Table structure for table `ysd_zhaopinhui` */

DROP TABLE IF EXISTS `ysd_zhaopinhui`;

CREATE TABLE `ysd_zhaopinhui` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT '0',
  `pic` varchar(200) DEFAULT '0',
  `starttime` varchar(100) DEFAULT '0',
  `endtime` varchar(100) DEFAULT '0',
  `provinceid` int(11) DEFAULT '0',
  `cityid` int(11) DEFAULT '0',
  `address` varchar(200) DEFAULT NULL,
  `traffic` text,
  `phone` varchar(100) DEFAULT '0',
  `organizers` varchar(200) DEFAULT '0',
  `user` varchar(200) DEFAULT NULL,
  `weburl` varchar(100) DEFAULT '0',
  `body` text,
  `media` text,
  `packages` text,
  `booth` text,
  `participate` text,
  `status` int(11) DEFAULT '0',
  `ctime` int(11) DEFAULT '0',
  `zwpic` varchar(200) DEFAULT NULL,
  `did` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_zhaopinhui` */

/*Table structure for table `ysd_zhaopinhui_com` */

DROP TABLE IF EXISTS `ysd_zhaopinhui_com`;

CREATE TABLE `ysd_zhaopinhui_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `zid` int(11) DEFAULT '0',
  `jobid` varchar(255) DEFAULT '0',
  `ctime` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `statusbody` varchar(100) DEFAULT NULL,
  `inadd` varchar(100) DEFAULT NULL,
  `did` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_zhaopinhui_com` */

/*Table structure for table `ysd_zhaopinhui_pic` */

DROP TABLE IF EXISTS `ysd_zhaopinhui_pic`;

CREATE TABLE `ysd_zhaopinhui_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT '0',
  `pic` varchar(200) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `zid` int(11) DEFAULT '0',
  `is_themb` int(5) DEFAULT '0',
  `did` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `ysd_zhaopinhui_pic` */

/*Table structure for table `phpyun_company_job` */

DROP TABLE IF EXISTS `phpyun_company_job`;

CREATE TABLE `phpyun_company_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hy` int(5) DEFAULT NULL,
  `job1` int(5) DEFAULT NULL,
  `job1_son` int(5) DEFAULT NULL,
  `job_post` int(5) DEFAULT NULL,
  `provinceid` int(5) DEFAULT NULL,
  `cityid` int(5) DEFAULT NULL,
  `three_cityid` int(5) DEFAULT NULL,
  `cert` varchar(50) DEFAULT NULL,
  `salary` int(5) DEFAULT NULL,
  `type` int(5) NOT NULL,
  `number` int(2) NOT NULL,
  `exp` int(5) NOT NULL,
  `report` int(5) NOT NULL,
  `sex` int(5) NOT NULL,
  `edu` int(5) NOT NULL,
  `marriage` int(5) NOT NULL,
  `description` text NOT NULL,
  `xuanshang` int(11) NOT NULL DEFAULT '0',
  `xsdate` int(11) DEFAULT NULL,
  `sdate` int(11) NOT NULL,
  `edate` int(11) NOT NULL,
  `jobhits` int(10) NOT NULL DEFAULT '0',
  `lastupdate` varchar(10) NOT NULL,
  `rec` int(2) DEFAULT '0',
  `cloudtype` int(2) DEFAULT NULL,
  `state` int(2) DEFAULT '0',
  `statusbody` varchar(200) DEFAULT '0',
  `age` int(11) DEFAULT NULL,
  `lang` text,
  `welfare` text,
  `com_name` varchar(50) NOT NULL DEFAULT '',
  `pr` int(5) DEFAULT NULL,
  `mun` int(5) DEFAULT NULL,
  `com_provinceid` int(5) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `urgent` int(1) DEFAULT NULL,
  `r_status` int(1) DEFAULT '0',
  `end_email` int(1) DEFAULT '0',
  `urgent_time` int(11) DEFAULT NULL,
  `com_logo` varchar(100) DEFAULT NULL,
  `autotype` int(11) DEFAULT '0',
  `autotime` int(11) DEFAULT '0',
  `is_link` int(1) DEFAULT '1',
  `link_type` int(1) DEFAULT '1',
  `source` int(1) DEFAULT '1',
  `rec_time` int(11) DEFAULT '0',
  `snum` int(11) DEFAULT '0',
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

/*Data for the table `phpyun_company_job` */

insert  into `phpyun_company_job`(`id`,`uid`,`name`,`hy`,`job1`,`job1_son`,`job_post`,`provinceid`,`cityid`,`three_cityid`,`cert`,`salary`,`type`,`number`,`exp`,`report`,`sex`,`edu`,`marriage`,`description`,`xuanshang`,`xsdate`,`sdate`,`edate`,`jobhits`,`lastupdate`,`rec`,`cloudtype`,`state`,`statusbody`,`age`,`lang`,`welfare`,`com_name`,`pr`,`mun`,`com_provinceid`,`rating`,`status`,`urgent`,`r_status`,`end_email`,`urgent_time`,`com_logo`,`autotype`,`autotime`,`is_link`,`link_type`,`source`,`rec_time`,`snum`,`did`) values (1,5,'ceshi',41,41,80,617,2,52,501,NULL,51,55,41,127,57,62,65,72,'kl;k',0,NULL,1440432556,1471449600,113,'1440432556',1,NULL,1,'0',NULL,'','92,93,91,90,94,95,98,96,97','312324wqeq',NULL,NULL,NULL,NULL,0,NULL,0,0,NULL,NULL,0,0,1,1,1,1441469490,0,NULL),(2,5,'测试1',35,43,86,679,6,76,692,NULL,128,54,40,127,57,62,65,72,'的说法都是',0,NULL,1441342597,1447862400,0,'1441342597',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(3,5,'测试2',35,39,70,451,6,76,696,NULL,128,54,40,127,57,62,65,72,'说的是',0,NULL,1441342636,1443888000,0,'1441342636',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(4,5,'测试3',39,39,70,452,27,343,2912,NULL,128,54,40,127,57,62,65,72,'的人是否为',0,NULL,1441342690,1443888000,0,'1441342690',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(5,5,'测试5',35,39,72,482,6,76,698,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342729,1443888000,0,'1441342729',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(6,5,'测试4',35,37,59,281,6,76,694,NULL,128,54,40,127,57,62,65,72,'士大夫',0,NULL,1441342763,1443888000,0,'1441342763',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(7,5,'测试6',35,44,90,708,25,321,2705,NULL,128,54,40,127,57,62,65,72,'而务实的',0,NULL,1441342808,1443888000,0,'1441342808',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(8,5,'测试7',35,39,72,484,32,394,3327,NULL,128,54,40,127,57,62,65,72,'师大附小',0,NULL,1441342851,1443888000,0,'1441342851',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(9,5,'测试8',35,41,80,617,3,38,418,NULL,128,54,40,127,57,62,65,72,'上大学',0,NULL,1441342892,1443888000,0,'1441342892',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(10,5,'测试9',35,42,84,662,18,246,2087,NULL,128,54,40,127,57,62,65,72,'请问',0,NULL,1441342943,1443888000,0,'1441342943',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(11,5,'测试10',35,37,57,248,27,343,2917,NULL,128,54,40,127,57,62,65,72,'实地调查',0,NULL,1441342977,1443888000,0,'1441342977',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL),(12,5,'测试11',35,42,84,664,25,321,2709,NULL,128,54,40,127,57,62,65,72,'是东方赛车',0,NULL,1441343008,1443888000,1,'1441343008',0,NULL,1,'0',88,'','','312324wqeq',20,28,6,4,0,NULL,0,0,NULL,'',0,0,1,1,1,0,0,NULL);

/*Table structure for table `phpyun_member` */

DROP TABLE IF EXISTS `phpyun_member`;

CREATE TABLE `phpyun_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `moblie` varchar(20) DEFAULT NULL,
  `reg_ip` varchar(20) DEFAULT NULL,
  `reg_date` int(11) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_date` int(11) DEFAULT NULL,
  `usertype` int(1) NOT NULL DEFAULT '1',
  `login_hits` int(11) DEFAULT '0',
  `salt` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `name_repeat` int(2) DEFAULT '0',
  `qqid` varchar(200) DEFAULT NULL,
  `status` int(4) DEFAULT NULL,
  `pwuid` int(11) DEFAULT '0',
  `pw_repeat` int(1) DEFAULT '0',
  `lock_info` varchar(200) CHARACTER SET gb2312 DEFAULT NULL,
  `email_status` int(1) DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `sinaid` varchar(100) DEFAULT NULL,
  `wxid` varchar(100) DEFAULT '0',
  `wxopenid` varchar(100) DEFAULT NULL,
  `unionid` varchar(100) DEFAULT NULL,
  `wxname` varchar(100) DEFAULT NULL,
  `wxbindtime` int(11) DEFAULT '0',
  `passtext` varchar(100) DEFAULT NULL,
  `source` int(1) DEFAULT '1',
  `regcode` int(10) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk COMMENT='用户成员表（个人用户、企业用户）';

/*Data for the table `phpyun_member` */

insert  into `phpyun_member`(`uid`,`username`,`password`,`email`,`moblie`,`reg_ip`,`reg_date`,`login_ip`,`login_date`,`usertype`,`login_hits`,`salt`,`address`,`name_repeat`,`qqid`,`status`,`pwuid`,`pw_repeat`,`lock_info`,`email_status`,`signature`,`sinaid`,`wxid`,`wxopenid`,`unionid`,`wxname`,`wxbindtime`,`passtext`,`source`,`regcode`,`did`) values (1,'hello','fabb18d12a7758d492595ff17d5fbc46','123@qq.com','15915878173','127.0.0.1',1438761488,NULL,1438761488,1,0,'05ac47',NULL,0,'',1,0,0,NULL,NULL,NULL,'','',NULL,NULL,NULL,0,NULL,1,0,NULL),(2,'new','1e94086c565e6047ef598d02c58e2e54','','','127.0.0.1',1439095346,NULL,1439095346,1,0,'2784b7',NULL,0,'',1,0,0,NULL,NULL,NULL,'','',NULL,NULL,NULL,0,NULL,1,0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
