-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_operation`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_operation`;
CREATE TABLE IF NOT EXISTS `auth_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_role`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_role`;
CREATE TABLE IF NOT EXISTS `auth_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `operation_list` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `banner`
-- -------------------------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '50',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `blog_catalog`
-- -------------------------------------------
DROP TABLE IF EXISTS `blog_catalog`;
CREATE TABLE IF NOT EXISTS `blog_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `is_nav` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '50',
  `page_size` int(11) NOT NULL DEFAULT '10',
  `template` varchar(255) NOT NULL DEFAULT 'post',
  `redirect_url` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `is_nav` (`is_nav`),
  KEY `sort_order` (`sort_order`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `blog_comment`
-- -------------------------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `blog_post`
-- -------------------------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `brief` text,
  `content` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catalog_id` (`catalog_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `FK_post_user` (`user_id`),
  CONSTRAINT `FK_post_catalog` FOREIGN KEY (`catalog_id`) REFERENCES `blog_catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `blog_tag`
-- -------------------------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE IF NOT EXISTS `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `frequency` (`frequency`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `htmlblock`
-- -------------------------------------------
DROP TABLE IF EXISTS `htmlblock`;
CREATE TABLE IF NOT EXISTS `htmlblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `product`
-- -------------------------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `sku` varchar(64) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `weight` decimal(10,3) DEFAULT '0.000',
  `price` decimal(10,2) DEFAULT '0.00',
  `brief` text,
  `introduction` text,
  `content` text,
  `thumb` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `brand` varchar(128) DEFAULT '',
  `sales` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `setting`
-- -------------------------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `store_range` varchar(255) DEFAULT NULL,
  `store_dir` varchar(255) DEFAULT NULL,
  `value` text,
  `sort_order` int(11) NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `code` (`code`),
  KEY `sort_order` (`sort_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `textblock`
-- -------------------------------------------
DROP TABLE IF EXISTS `textblock`;
CREATE TABLE IF NOT EXISTS `textblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_role` int(11) DEFAULT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('admin','1','1463583769');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('user','2','1463579203');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('user','3','1464361641');



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('admin','1','Administrator','','','1458761125','1458761125');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('guest','1','Guest','','','1458761125','1458761125');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('user','1','User','','','1458761125','1458761125');



-- -------------------------------------------
-- TABLE DATA auth_operation
-- -------------------------------------------
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('111','0','basic');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('113','0','user');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('114','0','role');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('115','0','order');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('116','0','product');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('118','0','blog');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('119','0','setting');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11101','111','backendLogin');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11302','113','viewUser');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11303','113','createUser');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11304','113','updateUser');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11305','113','deleteUser');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11402','114','viewRole');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11403','114','createRole');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11404','114','updateRole');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11405','114','deleteRole');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11501','115','viewOrder');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11502','115','createOrder');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11503','115','updateOrder');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11504','115','deleteOrder');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11601','116','viewProduct');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11602','116','createProduct');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11603','116','updateProduct');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11604','116','deleteProduct');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11801','118','viewBlog');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11802','118','createBlog');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11803','118','updateBlog');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11804','118','deleteBlog');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11901','119','viewSetting');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11902','119','createSetting');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11903','119','updateSetting');
INSERT INTO `auth_operation` (`id`,`parent_id`,`name`) VALUES
('11904','119','deleteSetting');



-- -------------------------------------------
-- TABLE DATA auth_role
-- -------------------------------------------
INSERT INTO `auth_role` (`id`,`name`,`description`,`operation_list`) VALUES
('1','admin','admin','all');
INSERT INTO `auth_role` (`id`,`name`,`description`,`operation_list`) VALUES
('3','user','User','backendLogin;viewRole;createRole;updateRole;deleteRole;viewOrder;createOrder;updateOrder;deleteOrder;viewProduct;createProduct;updateProduct;deleteProduct;viewBlog;createBlog;updateBlog;deleteBlog');
INSERT INTO `auth_role` (`id`,`name`,`description`,`operation_list`) VALUES
('4','guest','Guest','backendLogin');



-- -------------------------------------------
-- TABLE DATA banner
-- -------------------------------------------
INSERT INTO `banner` (`id`,`name`,`image`,`keywords`,`description`,`url`,`sort_order`,`status`,`created_at`,`updated_at`,`groupid`) VALUES
('1','banner1','uploads/201606020547551592.jpg','Training Day','Enjoy badminton !','','50','1','1464886075','1465249062','1');
INSERT INTO `banner` (`id`,`name`,`image`,`keywords`,`description`,`url`,`sort_order`,`status`,`created_at`,`updated_at`,`groupid`) VALUES
('2','banner2','uploads/201606020548362554.jpg','Beautiful flying ','Keep Playing!','','50','1','1464886116','1465249136','1');



-- -------------------------------------------
-- TABLE DATA blog_catalog
-- -------------------------------------------
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('12','11','grandson','grandson','','1','50','10','post','','1','1463676373','1463676373','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('13','0','Home','home','','1','50','10','Static','/','1','1464017683','1464129930','','','<p>This is home,yes!</p>
');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('14','0','About','about','uploads/201605250202426891.jpg','1','50','10','Single','','1','1464017743','1464877554','about xu huaiwen club, huaiwen xu,','Xu Huaiwen is one of the most successful female badminton players in the world\'s biggest events','<p><img alt=\"\" src=\"/uploads/201605251133498899.jpg\" style=\"float:left; height:162px; margin-left:10px; margin-right:10px; width:240px\" />Xu Huaiwen is one of the most successful female badminton players in the world&#39;s&nbsp;biggest&nbsp;events. Xu&rsquo;s best ranking in the world was the number one published by the Badminton World Federation (BWF) on June 22, 2006. For most of the time, Xu&rsquo;s ranking has ranged from number three to number eight.</p>

<p>&nbsp;Born in the badminton-rich country China, Xu started her professional career at the age of eight. She has been on the China National Team for two and half years. Her earlier achievement in China included winning three times bronze medal at China National Championships, and one bronze medal at the Seventh National Sports Games in 1998.</p>

<p>Xu started to play for Germany in 2000 and she began her consistent performance in the open tournaments in Europe and on the international badminton circuit since then. Xu competed in the Olympic Games twice (2004 Athens, and 2008 Beijing). At the 2008 Beijing Olympics, Xu won the fifth place by losing to the world&#39;s number one ranked player Xie Xingfang in a close quarterfinal match. Xu has been a women&#39;s singles bronze medalist twice at the BWF World Championships (2005 Anaheim, USA; and 2006 Madrid, Spain) and has won the last two European Championships (2006 Holland and 2008 Denmark) over Mia Audina and Tine Rasmussen respectively in the finals. Among Xu&#39;s more than twenty national and international singles titles are the super series opens: Scottish (2003), Polish (2003), Dutch (2005), and Swiss (2006) Opens, the Copenhagen Masters (2007), and the last five (2004&ndash;2008) German National Championships. Xu was the major player for the Team Germany at the world championships team event Uber Cup, and she helped the team win Bronze Medals twice.</p>

<p>Besides her competition, Xu coaches badminton players at all levels. She taught children and adults groups between the age of 8 to 26 at two badminton clubs in Germany: VFB Badminton Club (2000-2003) and Bischmisheim Badminton Club (2003-2009). In 2007, Xu acquired a coach license at Level A, the highest level in Germany, which qualifies her to train the top professional players.</p>

<p>Xu&rsquo;s accomplishments lead her to win many honors. In 2006, Xu was named as the best female athlete by the State Saarland of Germany. She received telegraphs from the Chancellors of Germany, Gerhard Schroeder in 2005 and Angela Merkel in 2006, recognizing her success and dedication to the sports. Finally, she was rewarded with Silbernes Lorberrblatt, the highest sports reward of Germany, in 2008.&nbsp;</p>

<p>When Xu was eliminated by China National Team&rsquo;s coaches to become the top player in the world because they thought that she was too short to play professional world badminton, Xu determined that she would prove herself one day through her commitment and hard-work. When people asked her why she didn&rsquo;t quit since Chinese elite coaches already said that she was not suitable for professional games, she always smiled and said:&ldquo;Badminton is part of my life and career. I want to compete, win and prove myself. Other people can give me up, but I cannot give myself up.&rdquo; So she kept her words and she made it. Indeed, she achieved her success in a condition that most other people thought she should quit.</p>

<p>&nbsp;Xu speaks fluent Chinese, German and English.</p>
');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('15','0','Services','services','uploads/201605250209167732.png','1','50','10','Single','','0','1464017786','1464865742','','','<p>this is the service we provide...</p>
');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('16','0','Coaching','coaching','','1','50','10','Product','','1','1464017824','1464971749','','','<p>are you looking for coaching......</p>

<p>&nbsp;</p>

<p>are you looking for coaching......</p>

<p>are you looking for coaching......</p>

<p>are you looking for coaching......</p>

<p>are you looking for coaching......</p>

<p>&nbsp;</p>
');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('17','0','Blog','blog','','1','50','10','List','','1','1464017850','1464101635','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('18','0','Videos','video','','1','50','10','List','','0','1464017878','1464816576','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('19','0','Contact','contact','uploads/201606020457065479.jpg','1','50','10','Static','','1','1464017942','1464883026','','','');



-- -------------------------------------------
-- TABLE DATA blog_post
-- -------------------------------------------
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('1','17','Xu Huaiwen\' s profile 徐怀雯职业档案','Participated 2 times Olympic Games Athens 2004, Beijing 2008 won 5th at Beijing Olympic Games 2008. won 2 times Bronze Medal at World Championships ,2005(Anaheim,USA), 2006 (Madrid, Spain). won 2 times European Champions 2006( Holland), 2008 (Denmark). 
','<p>Xu Huaiwen 徐怀雯<br />
Bronzemedaillengewinnerin bei der WM 2005 und der WM 2006...<br />
...Deutsche Meisterin 2004 2005 2006 2007 2008<br />
(sprich: &quot;ch&uuml; uh-ei wenn&quot; / Xu ist der Familienname)<br />
Wohnort: Saarbr&uuml;cken.Geburtstag:<br />
2. August 1975 in Guiyang (Provinz Guizhou / China)<br />
Gr&ouml;&szlig;e: 1,60 m / Rechtsh&auml;nderin.Verheiratet mit Bin Yang.<br />
Beruf: Profi-Badmintonspielerin.<br />
Ausstatter: Yonex (seit 1.9.2007).<br />
Verein: 1. BC Bischmisheim (vorher: VfB Friedrichshafen von 2000).<br />
Im September 2000 nach Deutschland gekommen, seit November 2003 deutsche Staatsb&uuml;rgerin. DBV-Kader: Mitglied im A-Kader.Erstes L&auml;nderspiel: 10.2.2004 im Uber Cup gegen Griechenland (5:0) in Presov (SVK). 46 bis 31.12.07.<br />
Beste Weltranglistenplatzierung: DE Platz 1 am 22.6.06...Gr&ouml;&szlig;te Erfolge (alle Dameneinzel)Dreimal Dritte bei den Chinesischen Meisterschaften 1994 bis 96.Dritter Platz bei den VIII Chinesischen Sport Games 1997.F&uuml;nfmal Deutsche Meisterin 2004 bis 2008.Bronzemedaillen WM 2005 in Anaheim und 2006 in Madrid.Europameisterin 2006.2003: Siegerin bei Polish International, Finnish International, Austrian International, Cuba International, Spanish International, Scottish International, Bitburger Open Saarbr&uuml;cken.2004: HF Korea Open 5*, Olympiateilnehmerin in Athen (1/32), HF Dutch Open 2*, Finalistin German Open 2*, Siegerin Bitburger Open;2005: Finalistin Swiss Open 3*, Finalistin Thailand Open 3*, WM-Bronze, Siegerin Belgian International, Thessaloniki Open, Bitburger Open, Dutch Open 2*, Finalistin Denmark Open 5*.2006: Siegerin Swiss Open 4*, Europameisterin, Siegerin Bitburger Open 2*.2007: Finalistin German Open GP, Finalistin Russian Open GGP, 2x HF SS SUI SIN.</p>

<p>职业简介<br />
徐怀雯 xu,huaiwen<br />
出生地; 中国贵阳<br />
出生日期:1975.8.2<br />
原效力于;四川省羽毛球队,中国国家队.<br />
国内最好成绩:97年全运会第3名.<br />
体育品牌签约;Yonex 使用Yonex, arc saber 球拍.右手.<br />
教练资格证书: 德国A级教练执照.<br />
语言:流利英语,德语，中文母语.<br />
2000年, 签约德国甲级俱乐部VFB friedrichshafen.<br />
2003年 加入德国国籍.<br />
2004，2008年两次代表德国参加2004雅典奥运会.2008北京奥运会第5名。<br />
世界WBF排名:连续192周top8,(99周top3),历史最高世界排名:1(2006.6.22)<br />
主要成绩:2次世界季军(2005.8美国,2006马德里).<br />
2次欧洲冠军(2006荷兰,2008.4.20丹麦)<br />
连续5年5次德国冠军.<br />
德国甲级BC冠军俱乐部选手,8年联赛仅失一场的历史性纪录.<br />
德国国家队主力队员,助德国国家队获得2004 ，2008 UBER 尤伯杯两次历史性的铜牌.<br />
2006瑞典公开赛冠军....2007丹麦精英赛冠军.等20余个公开赛冠军.<br />
主要荣誉:<br />
被评为2006年度德国萨尔州Saarland, 年度最佳女子运动员(历史上第一位华人当选)<br />
22.8.2005 德国联邦总理 格哈德.施罗德 Gerhard Schroeder电贺.<br />
12,5.2006 德国联邦总理 安吉娜.默克尔 Angela merkel 亲笔贺信.<br />
28,5.2008德国体育最高荣誉奖&ldquo;银月桂叶奖&rdquo;</p>

<p>&nbsp;</p>

<p>以上信息由德国官网www.badminton.de 提供</p>

<p>Profile<br />
Name: xu huaiwen<br />
Gender: Female<br />
Date of Birth: 2 Aug 1975<br />
Height: 1.60 m<br />
Profession:<br />
Hobbies:<br />
Olympic Event: Badminton Olympic Qualification: 2004Athens 2008 beijing.<br />
Place of Birth: china<br />
Weight: 58 kg<br />
Started Competing:<br />
General Interests Hobbies: music ，travel<br />
Language Spoken: English and Deutch.<br />
Club:VFB (2000-2003) BC Badminton club(2004-2007)<br />
Personal bests:</p>

<p>比赛数据统计<br />
冠军：20 次<br />
亚军：9 次<br />
半决赛：11次<br />
其它成绩：54 次<br />
参赛次数：94 次<br />
总积分：59517<br />
统计时间：2008年4月 -----2002年10月<br />
2008/4/16 欧洲锦标赛(丹麦) 冠军<br />
2008/3/16瑞士超级联赛 半决赛<br />
2008/3/9 全英超级联赛 半决赛<br />
2008/1/27 韩国超级联赛 1/8<br />
2008/1/20马来西亚超级联赛1/32<br />
2007/12 /29 丹麦精英赛冠军<br />
2007/12/9 俄罗斯公开赛 亚军<br />
2007年11月中国羽毛球超级赛1/32<br />
2007年11月法国羽毛球超级赛复赛<br />
2007年10月丹麦羽毛球超级赛复赛<br />
2007年10月bitburger saarloxlux open复赛<br />
2007年9月日本羽毛球超级赛1/32<br />
2007年8月世界羽毛球锦标赛复赛<br />
2007年7月中国羽毛球大师赛复赛<br />
2007年7月泰国羽毛球公开赛 复赛<br />
2007年6月苏迪曼杯羽毛球混合团体赛<br />
2007年5月印尼羽毛球超级赛复赛<br />
2007年5月新加坡羽毛球超级赛半决赛<br />
2007年3月瑞士羽毛球超级赛半决赛<br />
2007年3月全英羽毛球超级赛复赛<br />
2007年3月德国羽毛球公开赛亚军<br />
2007年1月韩国羽毛球超级赛复赛<br />
2007年1月马来西亚羽毛球超级赛复赛<br />
2006年11月丹麦羽毛球公开赛复赛<br />
2006年10月bitburger luxembourg open冠军<br />
2006年9月世界杯羽毛球赛 季军<br />
2006年9月香港羽毛球公开赛1/16<br />
2006年8月韩国羽毛球公开赛半决赛<br />
2006年6月中国台北羽毛球公开赛半决赛<br />
2006年6月印尼羽毛球公开赛复赛<br />
2006年5月bingo bonanza philipines open复赛<br />
2006年5月汤尤杯<br />
2006年4月欧洲羽毛球锦标赛 冠军<br />
2006年4月european mixed team champioships<br />
2006年3月中国羽毛球大师赛复赛<br />
2006年2月汤尤杯(european mens &amp; womens team championships)<br />
2006年1月全英羽毛球公开赛复赛<br />
2006年1月德国羽毛球公开赛1/16<br />
2006年1月瑞士羽毛球公开赛冠军<br />
2005年11月中国羽毛球公开赛1/16<br />
2005年11月香港羽毛球锦标赛复赛<br />
2005年10月丹麦羽毛球公开赛亚军<br />
2005年10月荷兰羽毛球公开赛冠军<br />
2005年10月bitburger国际羽毛球公开赛冠军<br />
2005年10月helexpo thessaloniki world grand prix冠军<br />
2005年9月比利时国际羽毛球赛冠军<br />
2005年8月世界杯羽毛球赛 季军<br />
2005年7月马来西亚羽毛球公开赛复赛<br />
2005年7月新加坡羽毛球公开赛1/32<br />
2005年5月苏迪曼杯羽毛球混合团体赛<br />
2005年4月日本羽毛球公开赛1/16<br />
2005年4月泰国羽毛球公开赛亚军<br />
2005年3月瑞士羽毛球公开赛亚军<br />
2005年3月全英羽毛球公开赛复赛<br />
2005年3月德国羽毛球公开赛复赛<br />
2004年12月bitburger国际羽毛球公开赛冠军<br />
2004年11月新加坡羽毛球公开赛1/16<br />
2004年11月中国羽毛球公开赛1/32<br />
2004年10月德国羽毛球公开赛亚军<br />
2004年10月丹麦羽毛球公开赛1/16<br />
2004年10月荷兰羽毛球公开赛半决赛<br />
2004年8月奥运会1/32<br />
2004年7月马来西亚公开赛1/16<br />
2004年5月尤伯杯<br />
2004年4月欧洲羽毛球锦标赛复赛<br />
2004年4月欧洲羽毛球锦标赛(组)<br />
2004年4月日本羽毛球公开赛1/16<br />
2004年4月韩国羽毛球公开赛半决赛<br />
2004年3月法国国际羽毛球公开赛1/32<br />
2004年3月全英羽毛球公开赛1/64<br />
2004年3月瑞士羽毛球公开赛1/32<br />
2004年2月尤伯杯(stage-europe)<br />
2004年1月瑞典国际羽毛球赛亚军<br />
2003年12月bitburger国际羽毛球公开赛冠军<br />
2003年11月苏格兰国际羽毛球赛冠军<br />
2003年11月中国羽毛球公开赛1/32<br />
2003年11月中国台北羽毛球公开赛1/16<br />
2003年11月香港羽毛球公开赛1/16<br />
2003年9月荷兰羽毛球公开赛复赛<br />
2003年8月印尼羽毛球公开赛1/64<br />
2003年8月新加坡羽毛球公开赛1/16<br />
2003年6月西班牙国际羽毛球公开赛冠军<br />
2003年5月cuba giraldilla international冠军<br />
2003年4月奥地利国际羽毛球赛冠军<br />
2003年4月芬兰国际羽毛球赛冠军<br />
2003年3月波兰国际羽毛球公开赛冠军<br />
2003年2月瑞士羽毛球公开赛1/16<br />
2003年2月全英羽毛球公开赛1/32<br />
2002年12月BMW open int results亚军<br />
2002年11月德国羽毛球公开赛1/16<br />
2002年10月荷兰羽毛球公开赛复赛</p>

<p>4/20/2008<br />
European Championships 2008 GP Gold Winner<br />
4/20/2008<br />
European Team Championships 2008<br />
3/16/2008<br />
Wilson Swiss Open Super Series 2008 S.Series Semi-Finalist<br />
3/9/2008YONEX All England Super Series 2008 S.Series Semi-Finalist<br />
2/17/2008 European Mens &amp; Womens Team Championships 2008<br />
1/27/2008 YONEX Korea Super Series 2008 S.Series Quarter-Finalist<br />
1/20/2008 Proton Malaysia Open Super Series 2008 S.Series 1\\32<br />
12/9/2007 RUSSIAN OPEN 2007 GP Gold Runner-Up<br />
11/25/2007 CHINA OPEN SUPER SERIES S.Series 1\\32<br />
11/4/2007 FRENCH SUPER SERIES 2007 S.Series Quarter-Finalist<br />
10/28/2007 DENMARK SUPER SERIES S.Series Quarter-Finalist<br />
10/7/2007<br />
BITBURGER SAARLOXLUX OPEN 2007GP Quarter-Finalist<br />
9/16/2007 YONEX OPEN JAPAN SUPER SERIES S.Series 1\\32<br />
8/19/2007 16th WORLD CHAMPIONSHIPS 2007 BWF Events Quarter-Finalist<br />
7/15/2007 CHINA SUPER SERIES (1)S.Series Quarter-Finalist<br />
7/8/2007SCG THAILAND OPEN GRAND PRIX GOLD 2007GP Gold Quarter-Finalist<br />
6/17/2007SUDIRMAN CUP MIXED TEAM CHAMPIONSHIP 2007<br />
5/13/2007DJARUM INDONESIA SUPER SERIES S.Series Quarter-Finalist<br />
5/6/2007AVIVA OPEN SINGAPORE SUPER SERIES 2007S.Series Semi-Finalist<br />
3/18/2007WILSON SWISS OPEN SUPER SERIESS.Series Semi-Finalist<br />
3/11/2007YONEX ALL ENGLAND SUPER SERIESS.Series Quarter-Finalist<br />
3/4/2007YONEX GERMAN OPEN 2007GP Runner-Up<br />
1/28/2007 YONEX KOREA OPEN SUPER SERIES S.Series Quarter-Finalist<br />
1/21/2007PROTON MALAYSIA SUPER SERIESS.Series Quarter-Finalist<br />
11/5/2006 DENMARK OPEN 2006 Quarter-Finalist<br />
10/29/2006BITBURGER LUXEMBOURG OPEN 2006 2* Winner<br />
9/24/2006WORLD CHAMPIONSHIPS 20067*Semi-Finalist<br />
9/2/2006 YONEX SUNRISE HONG KONG OPEN 20066*1\\16<br />
8/27/2006 YONEX KOREA OPEN 2006 6* Semi-Finalist<br />
6/25/2006 CHINESE TAIPEI OPEN 2006 5* Semi-Finalist<br />
6/4/2006 DJARUM INDONESIA OPEN 2006 6*Quarter-Finalist<br />
5/28/2006 Bingo Bonanza Philipines Open 2006 4*Quarter-Finalist<br />
5/7/2006 THOMAS AND UBER CUP FINALS 2006<br />
4/16/2006European Championships 2006 4* Winner<br />
4/11/2006 European Mixed Team Champioships<br />
3/12/2006 CHINA MASTERS 2006<br />
6* Quarter-Finalist<br />
2/19/2006THOMAS &amp; UBER CONTINENTAL STAGE EUROPE(EUROPEAN MENS &amp; WOMENS TEAM CHAMPIONSHIPS) 2006<br />
1/22/2006YONEX ALL ENGLAND OPEN 2006 4*Quarter-Finalist<br />
1/15/2006YONEX GERMAN OPEN 20063* 1\\16<br />
1/8/2006 WILSON BADMINTON SWISS OPEN 2006 4* Winner<br />
11/13/2005 PICC CHINA OPEN 2005 6* 1\\16<br />
11/6/2005 Yonex Sunrise Hong Kong Badminon Championship 20056* Quarter-Finalist<br />
10/23/2005 DENMARK OPEN 2005 5* Runner-Up<br />
10/16/2005 DUTCH OPEN 2005 2* Winner<br />
10/9/2005 BITBURGER OPEN International 2005 1* Winner<br />
10/2/2005 HELEXPO THESSALONIKI WORLD GRAND PRIX 2005 2* Winner<br />
9/11/2005 Belgian International 2005 A Winner<br />
8/21/2005 XIV WORLD CHAMPIONSHIPS 2005 7* Semi-Finalist<br />
7/10/2005<br />
PROTON MALAYSIA OPEN 2005 4*Quarter-Finalist<br />
7/3/2005 SINGAPORE OPEN 2005 5* 1\\32<br />
5/15/2005SUDIRMAN CUP FINAL 2005<br />
4/10/2005 YONEX OPEN JAPAN 2005 5* 1\\16<br />
4/3/2005 SIAM CEMENT THAILAND OPEN 2005 3*Runner-Up<br />
3/20/2005 SWISS OPEN 2005 3* Runner-Up<br />
3/13/2005 YONEX ALL ENGLAND OPEN 2005 4*Quarter-Finalist<br />
3/5/2005 YONEX GERMAN OPEN 2005 3* Quarter-Finalist<br />
12/5/2004 BITBURGER OPEN International 2004 A Winner<br />
11/21/2004 AVIVA OPEN SINGAPORE 2004 5* 1\\16<br />
11/14/2004 CHINA OPEN 2004 6* 1\\32<br />
10/17/2004 GERMAN OPEN 2004 2*Runner-Up<br />
10/10/2004 DENMARK OPEN 2004 5* 1\\16<br />
10/3/2004 YONEX DUTCH OPEN 20042* Semi-Finalist<br />
8/21/2004 OLYMPIC GAMES 2004 7* 1\\32<br />
7/4/2004 Proton-Eon MALAYSIA OPEN 2004 4* 1\\16<br />
5/16/2004UBER CUP FINALS 2004<br />
4/24/2004European Championships 2004 4*Quarter-Finalist<br />
4/19/2004 European Team Championships 2004<br />
4/11/2004 YONEX OPEN JAPAN 2004 5* 1\\16<br />
4/4/2004 NOONNOPPI KOREA OPEN 2004 5* Semi-Finalist<br />
3/21/2004 FRENCH OPEN International 2004 A 1\\32<br />
3/14/2004 YONEX ALL ENGLAND OPEN 2004 4* 1\\64<br />
3/7/2004 SWISS OPEN 2004 3* 1\\32<br />
2/15/2004 UBER CUP CONTINENTAL STAGE-EUROPE<br />
1/18/2004 Swedish International 2004 A Runner-Up<br />
12/7/2003 BITBURGER OPEN International 2003 1* Winner<br />
11/23/2003 Scottish International 2003 A Winner<br />
11/16/2003 CHINA OPEN 2003 6* 1\\32<br />
11/9/2003 CHINESE TAIPEI OPEN 20034* 1\\16<br />
11/2/2003 HONG KONG OPEN 2003 6* 1\\16<br />
9/21/2003YONEX DUTCH OPEN 2003 2*Quarter-Finalist<br />
8/31/2003SANYO INDONESIA OPEN 2003 5* 1\\64<br />
8/24/2003YONEX-SUNRISE SINGAPORE OPEN 2003 5* 1\\16<br />
6/1/2003 Spanish Open Int 2003 A Winner<br />
5/4/2003 Cuba Giraldilla International 2003 A Winner<br />
4/27/2003 Austrian International 2003 A Winner<br />
4/6/2003 Finnish International 2003 A Winner<br />
3/9/2003 Nokia Polish Int Open 2003A Winner<br />
2/23/2003Swiss Open 2003 3*1\\16<br />
2/16/2003Yonex All England Open 2003 4* 1\\32<br />
12/8/2002BMW Open Int 2002 Results1*Runner-Up<br />
11/10/2002 Yonex German Open 2002 2* 1\\16<br />
10/27/2002Rutac Holland Open 2002 2* Quarter-Finalist</p>
','Xu Huaiwen,badminton','xu_huaiwen','uploads/201606061112242820.jpg','10','1','1','1208473200','1465251144','xuhuaiwen, badminton, badminton uk,couching uk','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('2','17','Sportstudioseite des ZDF 徐怀雯参加德国电视2台体育直播节目','Xu Huaiwen was a guest last night on the most famous sport TV show in Germany. And the shuttler was quite comfortable on TV - quite relaxed, as she is on court.Sven Heise, Badzine Correspondent in Germany.','<p><img alt=\"\" src=\"/uploads/broadcast.jpg\" style=\"float:left; height:167px; margin:10px; width:240px\" />Xu Huaiwen was a guest last night on the most famous sport TV show in Germany. And the shuttler was quite comfortable on TV - quite relaxed, as she is on court.</p>

<p>Sven Heise, Badzine Correspondent in Germany.<br />
(archives)Just a few minutes before midnight, Xu Huaiwen entered the TV studio through the dense fog produced by a fog machine. Germany&#39;s best female player was a guest on the famous &quot;aktuelle sportstudio&quot;. In the late night talk with host Wolf-Dieter Poschmann and Kathrin Boron, the winner of four rowing gold medals from 1992 to 2004, Huaiwen answered quick-wittedly in perfect German.</p>

<p>Dressed in a smart black suit and with long black hair, the European champion showed her great sense of humour. Asked for the difference between her birth town Guiyang with 10 million habitants and her new home Saarbr&uuml;cken, she told Poschmann &quot;I have more quiet now.&quot; She also astonishing the TV presenter by saying that she is not a frequent guest in Chinese restaurants. For the Olympic Games, Huaiwen is optimistic: &quot;There are three Chinese players participating but playing in their home country puts a lot of pressure on them and two of them have never played at the Olympics before.&quot; As Wolf-Dieter Poschmann finally gave fortune cookies to the two ladies, Huaiwen was very surprised: &quot;I&#39;ve never seen such cookies in China.&quot; At the end of the show, the world class athletes tried their luck on the shoot-out challenge against the candidate from the audience. With the football, Huaiwen was not as successful as with the shuttle. But in her third try, she hit at least the wall and all in all, she was lucky to have made a grand entrance in Germany&#39;s most famous sports show. &quot;It was a great experience and I had a lot of fun during this show,&quot; said Xu to Badzine. &quot;At the beginning, I was a little nervous as I was afraid that they might critizise China, with lots of political questions, but once I got onstage, I talked with people and forgot about the nervousness,&quot; she said.</p>
','Xu Huaiwen,badminton','xuhuaiwen','uploads/201606061110159514.jpg','52','1','1','1224284400','1465251015','xuhuaiwen,badminton broadcast,badminto germany','xuhuaiwen,badminton broadcast,badminto germany');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('7','17',' Deutch Welle 德国之声报道 China Kleinste,Deutschlands Groesste ','Badmintonspielerin Xu Huaiwen besiegt Behörden, Neider, Frust - und träumt von einer Olympiamedaille','<p>12. Mai 2004, 00:00 Uhr<br />
Von Christian Putsch<br />
Chinas Kleinste, Deutschlands Gr&ouml;&szlig;te<br />
Badmintonspielerin Xu Huaiwen besiegt Beh&ouml;rden, Neider, Frust - und tr&auml;umt von einer Olympiamedaille<br />
Als die Nummer eins der Deutschen ihr Spiel verloren hatte, nahm das Ungl&uuml;ck seinen Lauf. Auch Juliane Schenk und Nicole Grether unterlagen in ihren Einzeln, so dass das Achtelfinale des Uber-Cups gestern in Jakarta zu einer ziemlich klaren und entt&auml;uschenden Angelegenheit wurde: 0:3 hie&szlig; es gegen Indonesien. Wenn es um internationale Meriten geht, h&auml;ngt eben viel an der besten deutschen Badmintonspielerin Xu Huaiwen.<br />
Vorw&uuml;rfe kann der 29-J&auml;hrigen kaum jemand machen, denn mit ihrem rasanten Aufstieg in die Weltspitze hat sie erst daf&uuml;r gesorgt, dass Experten das Team beim Uber-Cup - der Mannschafts-WM - sogar zu den Medaillen-Kandidaten gerechnet hatten. In der Weltrangliste ist Xu bis auf Rang zw&ouml;lf geklettert, mit ihr erst ist Deutschland in Europa zweitbeste Nation geworden (hinter D&auml;nemark). War das Abschneiden in Jakarta auch schwach, so kann Xu doch immer eines anf&uuml;hren. Badminton sei f&uuml;r sie wieder &quot;mehr als nur ein Beruf&quot;, sagt sie.<br />
Als deutsche Hoffnungstr&auml;gerin f&auml;hrt sie nun zu den Olympischen Spielen in Athen - nachdem es vor f&uuml;nf Jahren so aussah, als w&uuml;rde sie niemals ihren Weg gehen, als w&uuml;rde sie niemals einl&ouml;sen, was so viel versprechend begonnen hatte.<br />
Schon mit 13 Jahren entschied sich die Jahrgangsbeste der 84-Millionen-Provinz Sichuan, ihr Leben dem Badminton zu widmen, trainierte sechs Stunden t&auml;glich, ging nach Peking, k&auml;mpfte sich ins Nationalteam - doch dann wuchs sie nicht mehr, bei 160 Zentimetern war Schluss. &quot;Das war mein Verh&auml;ngnis, zu internationalen Turnieren schickt China nur gro&szlig;e Spielerinnen.&quot; Xu drohte f&uuml;r immer in den Trainingscamps zu versauern. &quot;Ich hatte jeden Spa&szlig; am Sport verloren.&quot; Bis ein Mittwoch ihr Leben &auml;nderte.<br />
Nach sieben Stunden Training war sie am Abend ins Kino gegangen, rackerte am n&auml;chsten Tag wieder sieben Stunden - und bekam anschlie&szlig;end noch Straftraining aufgebrummt, weil es verboten ist, das Gel&auml;nde an einem Wochentag zu verlassen. Das war zu viel, sie wollte weg.<br />
&quot;Ich habe gesagt, ich h&auml;tte chronische R&uuml;ckenschmerzen&quot;, erz&auml;hlt sie. Die Sportfunktion&auml;re glaubten ihr, und so bewarb sie sich per E-Mail bei deutschen Klubs. Der VfB Friedrichshafen wollte sie verpflichten, doch die Beh&ouml;rden in China stellten sich quer. Wieder musste Xu schwindeln, wies auf ihr mit 25 Jahren schon fortgeschrittenes Alter hin. Im Sommer 2000 endlich durfte sie nach Friedrichshafen wechseln, 2003 ging sie zum BC Bischmisheim und an den St&uuml;tzpunkt Saarbr&uuml;cken. In vier Jahren verlor Xu nur ein Bundesligaeinzel und entschied sich, die deutsche Staatsb&uuml;rgerschaft anzunehmen. Im November 2003 bekam sie schlie&szlig;lich den Pass.<br />
Ein Traum f&uuml;r sie, ein Schreck f&uuml;r die nationale Konkurrenz. Bei den deutschen Meisterschaften im Februar gab es laut Verbandspr&auml;sident Dieter Kespohl &quot;F&auml;lle von Mobbing gegen Xu&quot;. Die Frauen f&uuml;rchteten um Olympiastartpl&auml;tze, doch letztlich schafften ohnehin nur Xu und Juliane Schenk (21) den Sprung unter die besten 19 der Weltrangliste und l&ouml;sten damit das Olympiaticket.<br />
Belastet hat Xu das Gerede um ihre Person ohnehin wenig, ihre Leistung explodierte geradezu. Im Februar schlug sie in der Vorrunde des Uber-Cups die Weltranglistenvierte Mia Audina (Niederlande), bei den Korea Open schaltete sie auf dem Weg ins Halbfinale sensationell die damalige Weltranglistenzweite Mi Zhou (China) aus.<br />
Doch gerade jetzt, wo alles perfekt zu laufen scheint, tritt der chinesische Verband erneut auf den Plan und pr&uuml;ft, ob Xu tats&auml;chlich schon f&uuml;r Deutschland startberechtigt ist. &quot;Wenn die eine Chance sehen, werden sie Protest einlegen&quot;, f&uuml;rchtet Kespohl, der in Jakarta mit chinesischen Funktion&auml;ren verhandeln will. Xu selbst sieht das gelassen. &quot;Ich mache mir keine Sorgen&quot;, sagt sie. Sie hat schlie&szlig;lich schon ganz andere H&uuml;rden genommen.</p>

<p>体育 2004.05.12<br />
羽坛女将徐怀雯：在中国太矮小，在德国太高大</p>

<p>Gro&szlig;ansicht des Bildes mit der Bildunterschrift:&nbsp;</p>

<p>正在印尼首都雅加达举行的第二十三届羽毛球汤尤杯比赛上，德国女队0:3负于印尼没有进入八强，但对於德国女队来说，这已经是很不错的成绩了。德国女子羽毛球最近能在世界级大赛上有不俗表现，全靠来自中国四川的选手徐怀雯。<br />
德国女队在本届尤伯杯上被有些专家列在有实力夺得奖牌的队伍之列，而徐怀雯就是为德国队独挑大梁的希望之星。在中国时默默无闻的徐怀雯经过德国四年修炼，已经攀升到世界排名第13位，并靠她的实力，将德国女队提升到欧洲第二。<br />
今 年29岁的徐怀雯出生在贵州，成长在四川，13岁时走上职业羽毛球选手的道路，后到北京进入中国羽毛球集训队，20岁时成为中国女子羽坛的一流选手。但 是，徐怀雯的个头长到1米60时就不再长了，这对一名职业选手来说是致命的。因为中国有足够的实力和身高都在她之上的选手，徐怀雯从来没有获得代表中国参 加世界大赛的机会。<br />
看不到入选国家队的希望，在国家集训队的日子对徐怀雯来说变得越来越痛苦。一个星期三晚上，徐怀雯离集训营地去看了场电影，为 此第二天受到加练的处罚，因为国家集训队规定队员在工作日不允许擅自离开营地。这件事让徐怀雯萌生了离开国家集训队的念头。徐怀雯以长年背痛为理由向领导 提出离开集训队的请求，领导批准了她的申请。<br />
离开国家集训队后，徐怀雯通过电子邮件向一些德国的羽毛球俱乐部询问到德国打球的可能，最后得到弗里 德里希港羽毛球俱乐部的加盟邀请。办理出国手续时，可能是担心&ldquo;海外兵团&rdquo;效应，有关方面并不是很情愿放人，徐怀雯表白说，自己已经25岁了，作为一名职 业选手已经过了黄金年龄。<br />
2000年夏天，徐怀雯终於如愿以偿，来到了博登湖畔的弗里德里希港，开始了在德国参加甲级联赛的生涯。2003年初， 弗里德里希港羽毛球俱乐部因为财政困难倒闭，徐怀雯转会到萨尔州的毕施米希海姆俱乐部。在四年德国羽毛球甲级联赛中，身材矮小的徐怀雯却仿佛鹤立鸡群，只 输掉过一场单打比赛。加盟毕施米希海姆后，徐怀雯经常与德国最优秀的男子羽毛球选手训练，实力提高很快。<br />
2003年11月，徐怀雯加入德国籍，成 为德国女子羽毛球国家队的一员，这也是德国羽毛球协会和毕施米希海姆俱乐部的愿望。对於徐怀雯来说，加盟德国队意味着她有机会参加奥运会，而参加奥运会是 每一位运动员的梦想。但是，徐怀雯加盟德国国家队也意味着别的国家队队员的地位受到威胁。在今年2月的德国锦标赛上，德国羽协主席克施泊尔承认徐怀雯在国 家队受到个别队友的刁难。其实，徐怀雯加盟德国国家队并没有夺走他人参加雅典奥运会的机会，因为德国女子羽毛球国家队里只有她和申克排名世界前19名，其 他人反正也没有参加奥运会的资格。<br />
今年以来，徐怀雯的成绩大有回升之势，在2月份时将现世界排名第四、现代表荷兰队的原印尼羽坛天才少女张海丽崭下马，在韩国羽毛球公开赛上又战胜过世界排名第二的中国选手周蜜。<br />
根据&ldquo;柏林邮报&rdquo;的报道，徐怀雯代表德国队的表现引起了中国羽坛的注意，中国羽协正在考虑是否向世界羽协提出徐怀雯是否有资格代表德国队参加比赛的质疑。德国羽协主席克施泊尔在雅加达尤伯杯上表示愿意就此事与中国方面协商，徐怀雯本人则表示她对此事并不感到担忧。</p>

<p>&nbsp;</p>

<div>&nbsp;</div>

<p><a href=\"http://http//sport.ard.de/sp/olympia/news200803/21/badminton_xu.jsp\">http://http//sport.ard.de/sp/olympia/news200803/21/badminton_xu.jsp</a></p>

<div>&ldquo;德国之声&rdquo;：<a href=\"http://www.dw-world.de/chinese\">www.dw-world.de/chinese</a></div>

<div>&nbsp;</div>

<div>德国电视2台ZDF:</div>

<div>Internetseite von ZDFsport sieht Xu &quot;Auf dem Weg nach Peking&quot;(29.4.08) Auf der Internetseite des Zweiten Deutschen Fernsehens erschien im Rahmen der Reihe &quot;Auf dem Weg nach Peking&quot; am 22. April ein Beitrag &uuml;ber Xu Huaiwen unter dem Titel &quot;In China noch eine Rechnung offen - Bei Olympia will Xu &uuml;ber sich hinauswachsen&quot;. Autor ist Bernd-Volker Brahms. <a class=\"linkExt\" href=\"http://olympia.zdf.de/ZDFsport/inhalt/10/0,5676,7227242,00.html\" rel=\"rel=\'nofollow\'\" target=\"_blank\">Hier ist er abzurufen</a>.<br />
Rheinische Post berichtete &uuml;ber Olympiakandidatin Xu(5.3.08) Die in D&uuml;sseldorf erscheinende Rheinische Post berichtete am 4. M&auml;rz in ihrem Hauptsportteil in der Reihe &quot;Blickpunkt Olympia&quot; in einem gro&szlig;en Beitrag &uuml;ber Xu Huaiwen und ihre Beziehung zu China. Hier kann der Beitrag <a class=\"linkInt\" href=\"http://www.badminton.de/fileadmin/Dateibereich/Foto-Archiv/Druckwerke/Zeitungsartikel/08-Xu-RheiPost4-3.pdf\" rel=\"rel=\'nofollow\'\" target=\"_blank\">&quot;Die R&uuml;ckkehr der Versto&szlig;enen&quot;</a> als pdf-Datei heruntergeladen werden. Autorin ist Stefanie Sandmeier.</div>

<div><a href=\"http://olympia.zdf.de/ZDFsport/inhalt/10/0,5676,7227242,00.html\" rel=\"rel=\'nofollow\'\" target=\"_blank\">http://olympia.zdf.de/ZDFsport/inhalt/10/0,5676,7227242,00.html</a></div>
','xuhuaiwen',' Deutch Welle 德国之声报道 China Kleinste,Deutschlands Groesste ','uploads/201606080542434556.jpg','3','1','1','1208473200','1465404707',' Deutch Welle 德国之声报道 China Kleinste,Deutschlands Groesste ',' Deutch Welle 德国之声报道 China Kleinste,Deutschlands Groesste ');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('8','17',' 奥运村的金牌名星们，美国体操明星Shawn Johnson是我最喜欢的运动员之一 ',' 奥运村的金牌名星们和我的一些合影，难以忘记的时刻.....','<p><img alt=\"\" src=\"/uploads/IMG_0114.JPG\" style=\"height:300px; width:400px\" /></p>

<p><img alt=\"\" src=\"/uploads/IMG_0007.JPG\" style=\"height:400px; width:300px\" /></p>

<p><img alt=\"\" src=\"/uploads/IMG_0035.JPG\" style=\"height:300px; width:400px\" /></p>

<p><img alt=\"\" src=\"/uploads/IMG_0075.JPG\" style=\"height:300px; width:400px\" /></p>

<p><img alt=\"\" src=\"/uploads/xu_em_YN__0055.jpg\" style=\"height:360px; width:259px\" /></p>

<p><img alt=\"\" src=\"/uploads/IMG_0111.JPG\" style=\"height:300px; width:400px\" /></p>
','2008年奥运会','2008年奥运会','uploads/IMG_0114.JPG','0','1','1','1221692400','1465405429','2008年奥运会','2008年奥运会');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('9','17',' 德国之声报道:东边不亮西边亮---专访徐怀雯 ','昔日中国国家队的无名陪练在国外得以一展才华，为德国羽毛球队赢得了历史上的首枚世锦赛奖牌，在尤伯杯赛中使德国队首次闯入四强行列，并摘取了欧锦赛女单冠军，以致收到德国总理的电报表彰，','<p>文化社会 2008.03.17<br />
东边不亮西边亮--专访徐怀雯</p>

<p>Gro&szlig;ansicht des Bildes mit der Bildunterschrift: 德羽毛球名将徐怀雯</p>

<p>昔日中国国家队的无名陪练在国外得以一展才华，为德国羽毛球队赢得了历史上的首枚世锦赛奖牌，在尤伯杯赛中使德国队首次闯入四强行列，并摘取了欧锦赛女单冠军，以致收到德国总理的电报表彰，今夏还将代表德国队挑战参加奥运的昔日队友：国内的丑小鸭，国外美天鹅，四川妹－徐怀雯只是其中的一位。<br />
距北京奥运还有数月时间，参赛运动员们纷纷进入备战阶段。对羽毛球强国之一－中国来说，&ldquo;海外兵团冲击国羽&rdquo;的格局业已形成。比如曾代表德国羽毛球队参加雅典奥运会的德国名将徐怀雯就被视为北京奥运女单夺冠的隐患之一，也因此成为 不少人关注的焦点。正忙于奥运前积分赛的徐怀雯为此接受了本台中文网记者的专访：</p>

<p>备战北京奥运Bildunterschrift:</p>

<p>德国之声：徐怀雯，你好！距北京奥运还有不足5个月的时间，你被视为中国队夺冠的拦路虎之一，请问，你本人对北京奥运有何具体的期待？</p>

<p>徐怀雯：我当然希望能拿到一个奖牌，如果能拿一个铜牌就很开心了。</p>

<p>德国之声：你离开中国已有8、9年的时间，隔岸观火赋予你客观的眼光。你如何看待这支曾培养过你的队伍？也就是说，你认为，中国羽毛球队在本届奥运会上会有怎样的表现呢？</p>

<p>徐怀雯：我觉得，中国队的压力想必是很大的。无论男单、女单还是女双都压力不小。应该说，中国队具备应有的实力，但关键是心态问题，他们应该保持一种平常心态。本届奥运在北京召开，全国上下，包括记者在内都对中国队抱有很大的希望。我认为，在全英比赛中，他们的表现有些失常。我有时也会跟中国队员一起交谈，他们都觉得上上下下压力挺大，有时很难发挥。</p>

<p>德国之声：你刚才说，中国队员在场上的表现有些失常，你具体指的是什么？</p>

<p>徐怀雯：他们有些急于求成，害怕输球。昨天看了卢兰打拉斯姆森的比赛，觉得她心理上还是有些畏惧的。</p>

<p>德国之声：中国媒体报道说，海外军团不断发展壮大，包括你在内的所谓的海外军团已被视为中国女单夺冠的拦路虎。你如何看待这样的评价呢？</p>

<p>徐怀雯：我本人没有任何压力。出国是我的一大优势，尽管在训练方面，我们无法跟中国队相比：比如我没有训练对手，另外三十多岁的我不可能象国内队员那样进行系统训练。但我的最大优势是，我脑子很清醒，没有很大的压力。虽然我很想在奥运期间拿奖牌，但我更注重享受参赛过程。如果我不出国，我是不会有参加奥运会的机会的。所以我的心态放得很开。我把拿奖牌作为自己的奋斗目标，但不是非它不可。</p>

<p>Bildunterschrift: 体育无国界</p>

<p>德国之声：你刚才说如果不出国的话，就没有参加奥运会的机会。你如何看待中国国家队人才外流的现象？</p>

<p>徐怀雯：中国的竞争实在是太激烈了。决定一位运动员能否参加国际比赛的因素是方方面面的，实力只是其中的因素之一。在国内打球时，我的身高不能满足教练的要求，被认为没有发展前途，也不受重视，只能当陪练。但我觉得，自己不能放弃自己，绝不能打了十几年的球，一无所得，最起码要证明一下自己。于是我联系出国，那时我根本没有想到要代表其它国家参加国际大赛。</p>

<p>德国之声：但这一步对你日后的发展来说的确是关键性的一步。你的羽毛球事业在德国有了很大的发展，比如在2005年的世锦赛上，你就使德国获得有史以来的首枚奖牌。今年夏天，你还将代表德国队参加北京奥运。但有些中国球迷对此表示不能理解，提出了&ldquo;海外兵团&rdquo;到底还是不是中国人的问题。你能理解中国球迷们的这些想法吗？</p>

<p>徐怀雯：我觉得他们的想法有些偏激。因为我本人认为，体育是没有国界的。另外我认为，当时在国内，我的竞技状态不错，表现得也不错，但却被冷在了一边，得不到任何机会。难道我应该就此放弃自己，改行做其它的事情吗？我当然不会这么做，我不甘心。</p>

<p>德国之声：但以外国国籍的身份回国参赛，面对昔日的队友会是一种怎样的心情呢？</p>

<p>徐怀雯：看到以前的队友，我觉得挺亲切的。在场上比赛时，我当然会尽量赢球，但想的不是要打败中国。职业运动员参加比赛就应该非常职业，无论我们平时是否是好朋友，比赛时，该赢就得赢，我会竭尽全力的。</p>

<p>德中两国训练体制比较Bildunterschrift:</p>

<p>德国之声：你对德中两个队都很了解，你如何看待两国球队在训练体质上的不同？</p>

<p>徐怀雯：如果两边能综合一下，就再好不过了。我认为，两边都有利有弊。中国队的训练非常系统，而且从小开始，我从10岁起就开始打球了，从13岁开始了自己的职业生涯，这在德国是不可想象的。德国人要在接受培训，或是高级文理中学毕业后才参加系统训练。所以中国运动员的训练要比德国系统得多，所以我的技能底子也比他们牢得多。不好的地方是，中国队员因为集中训练，与外界没有太多的接触，也没有机会去学校读书。我认为这种做法对运动员的未来发展，对球的认识都不利。相反，德国运动员很独立，对他们来说，开始时，打球不过是一种爱好而已，正因为这样，所以德国运动员打球时会更有激情，更有想象力。以前在中国时 ，我就觉得打球已多少有些机械化，由于反复练习，球会自动打到某一点上，已形成一种惯性。欧洲运动员则不象我们，反而球路会更加多变，会更有想象力。</p>

<p>德国之声：我们刚才谈到了两国训练体制上的不同，作为运动员，在总体感受上又有什么不同呢？</p>

<p>徐怀雯：德国人从小接受的教育是学会自己安排一切。我在中国时则不知道自己的未来究竟会是怎样的，尽管打球打得很努力，但我对未来没有任何设想。虽然我自己认为是有能力的，但却没有施展能力的空间和机会。</p>

<p>德国之声：你刚才提到了身高影响发展的因素，难道对德国职业运动员来说，身高不是影响事业发展的因素吗？</p>

<p>徐怀雯：不是。当然个子矮对运动员来说会有些吃亏，但这个缺陷是可以通过后天的努力来弥补的。中国队则往往倾向高个子运动员。看看现在出国比赛的运动员，他们的个子都在1米74、75以上。欧洲人经常对我说，中国运动员都很高嘛。我说，他们都不是典型的中国姑娘。</p>

<p>德国之声：除了身高因素以外，你觉得德国队对运动员的要求是更灵活，还是更死板？</p>

<p>徐怀雯：总的来说，德国人相对来说要死板一些。德国队的训练计划安排到每一天，而且每天的训练内容是一模一样的。比如这两个月的训练计划一成不变。我觉得这样的安排会有些死板。因为有时，我们比赛较多，平常的训练计划却依旧不变，我觉得不是很实际。</p>

<p>Bildunterschrift: Gro&szlig;ansicht des Bildes mit der Bildunterschrift: 望北京奥运办得更好</p>

<p>德国之声：你曾于2004年以德国运动员的身份参加了雅典奥运会，打得不出色，因此当时不太被很多人看好，以后才有了更好的发挥。雅典奥运会上，你为何没有理想的表现呢？</p>

<p>徐怀雯：那时，我参加奥运会预选赛开始得太晚了，所以没能拿到一个种子位置，分组也很差，第一轮就对周密，我们打了三局，让中国队也很紧张，但我输给了她。我从2003年底才代表德国队参加比赛，我的训练储备不够。出国后，可以说从2000年到2003年底，我几乎处于缺乏训练的状态。一个星期也就训练两次吧，我的体能跟不上。我个人认为，我在雅典奥运会上的表现是不错的，我对自己的表现很满意。</p>

<p>德国之声：作为曾经参加过奥运会的你来说，对北京奥运有什么好的建议吗？</p>

<p>徐怀雯：从网上漫游就能知道，中国政府确实很重视北京奥运。但在回国打比赛，参加中国公开赛时，我明显感觉到，语言是一个问题。尽管我们都有翻译，但水平不够，组织方面也不够国际化。上次去广州时，我觉得训练场地的安排不够公平。我们在主场的训练机会就没有中国队多。在训练时，中国队会把门关上，不让我们进去。这样的情况在欧洲是不会出现的。比如在德国公开赛期间，我们训练时是绝不会把门关上的</p>

<p>从长计议Bildunterschrift: Gro&szlig;ansicht des Bildes mit der Bildunterschrift:</p>

<p>德国之声：北京奥运之后，你有什么具体的计划吗？</p>

<p>徐怀雯：德国羽协希望我能给他们做教练。我所在的地方也希望我能做教练。我可以想象短期内做教练，但无法想象永久做下去。北京奥运后，我可能会一边做教练，一边读书，比如读会计或体育管理专业等。</p>

<p>德国之声：今年8月，北京将举办奥运会。不少运动员已进入备战阶段。你的每一天又是怎样渡过的呢？</p>

<p>徐怀雯：我的目的性很强，我还要参加两个比赛，瑞士公开赛和欧洲锦标赛，之后才能开始准备奥运会。在3个月的时间里，我会多看一些自己对手的录象，比如中国队队员和拉斯姆森等，从战术上对他们的打法进行分析。另外因为自己的年纪，要多进行一些体能上的训练。<br />
Deutch Welle</p>
','xuhuaiwen',' 德国之声报道:东边不亮西边亮---专访徐怀雯 ','uploads/201606080608381981.jpg','1','1','1','1205798400','1465405718','xuhuaiwen, badminton, badminton uk,couching uk',' 德国之声报道:东边不亮西边亮---专访徐怀雯 ');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('10','17',' 德国电视台2台等采访片段 视频点击 TV clips ',' 德国电视台2台等采访片段 视频点击 TV clips ','<p><object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\" height=\"266\" id=\"BLOG_video-35c3703e9062a6ca\" width=\"320\"><param name=\"movie\" value=\"//www.youtube.com/get_player\" /><param name=\"bgcolor\" value=\"#FFFFFF\" /><param name=\"allowfullscreen\" value=\"true\" /><param name=\"flashvars\" value=\"flvurl=http://redirector.googlevideo.com/videoplayback?id%3D35c3703e9062a6ca%26itag%3D5%26source%3Dblogger%26app%3Dblogger%26cmo%3Dsensitive_content%253Dyes%26ip%3D0.0.0.0%26ipbits%3D0%26expire%3D1467530723%26sparams%3Did,itag,source,ip,ipbits,expire%26signature%3D740234E6141C8FFEA81CC9AF1ED076EE9AF7811B.4F8FAF0BB25267DF94EB6745EB4C7527C47F9D91%26key%3Dck2&amp;iurl=http://video.google.com/ThumbnailServer2?app%3Dblogger%26contentid%3D35c3703e9062a6ca%26offsetms%3D5000%26itag%3Dw160%26sigh%3DwKfhZKjj1aa20_9T1JnkMGH53-E&amp;autoplay=0&amp;ps=blogger\" /><embed bgcolor=\"#FFFFFF\" height=\"266\" src=\"//www.youtube.com/get_player\" type=\"application/x-shockwave-flash\" width=\"320\"></embed></object><a href=\"rtsp://v1.cache8.googlevideo.com/ChoLENy73wIaEQnKpmKQPnDDNRMYDSANFEgDDA==/0/0/0/video.3gp\" type=\"video/3gpp\"><img alt=\"video\" class=\"BLOG_mobile_video_class\" id=\"BLOG_mobile_video-35c3703e9062a6ca\" src=\"http://video.google.com/ThumbnailServer2?app=blogger&amp;contentid=35c3703e9062a6ca&amp;offsetms=5000&amp;itag=w160&amp;sigh=wKfhZKjj1aa20_9T1JnkMGH53-E\" style=\"height:266px; width:320px\" /></a><object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\" height=\"266\" id=\"BLOG_video-67a4d983796cff1f\" width=\"320\"><param name=\"movie\" value=\"//www.youtube.com/get_player\" /><param name=\"bgcolor\" value=\"#FFFFFF\" /><param name=\"allowfullscreen\" value=\"true\" /><param name=\"flashvars\" value=\"flvurl=http://redirector.googlevideo.com/videoplayback?id%3D67a4d983796cff1f%26itag%3D5%26source%3Dblogger%26app%3Dblogger%26cmo%3Dsensitive_content%253Dyes%26ip%3D0.0.0.0%26ipbits%3D0%26expire%3D1467530723%26sparams%3Did,itag,source,ip,ipbits,expire%26signature%3D178004BB4B57B1264257AD8B79C776F73C63D88A.9D7F62B3AC0DCC34791072E176D3BB28D7BF9B4E%26key%3Dck2&amp;iurl=http://video.google.com/ThumbnailServer2?app%3Dblogger%26contentid%3D67a4d983796cff1f%26offsetms%3D5000%26itag%3Dw160%26sigh%3D_U5aAAVER9eAMFHiecOf_x9N9WA&amp;autoplay=0&amp;ps=blogger\" /><embed bgcolor=\"#FFFFFF\" height=\"266\" src=\"//www.youtube.com/get_player\" type=\"application/x-shockwave-flash\" width=\"320\"></embed></object> <a href=\"rtsp://v6.cache3.googlevideo.com/ChoLENy73wIaEQkf_2x5g9mkZxMYDSANFEgDDA==/0/0/0/video.3gp\" type=\"video/3gpp\"><img alt=\"video\" class=\"BLOG_mobile_video_class\" id=\"BLOG_mobile_video-67a4d983796cff1f\" src=\"http://video.google.com/ThumbnailServer2?app=blogger&amp;contentid=67a4d983796cff1f&amp;offsetms=5000&amp;itag=w160&amp;sigh=_U5aAAVER9eAMFHiecOf_x9N9WA\" style=\"height:266px; width:320px\" /></a></p>
','xuhuaiwen','xuhuaiwen 视频','uploads/201606080614391243.jpg','1','1','0','1224284400','1465406138','徐怀雯视频','徐怀雯视频');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('11','17',' 怀雯获得 银月桂 Silbernes Lorbeerblatt an Europameisterin Huaiwen Xu ',' 怀雯获得 银月桂 Silbernes Lorbeerblatt an Europameisterin Huaiwen Xu','<h3>怀雯获得 银月桂 Silbernes Lorbeerblatt an Europameisterin Huaiwen Xu</h3>

<div class=\"post-header\">
<div class=\"post-header-line-1\"><img alt=\"\" id=\"BLOGGER_PHOTO_ID_5283464931063268770\" src=\"http://3.bp.blogspot.com/_JNMGU8bi6UM/SVKjXJ9ChaI/AAAAAAAAAo0/BTOWMqbSIMc/s400/Bild+028.jpg\" style=\"float:left; height:271px; line-height:20.8px; margin:0px 10px 10px 0px; width:400px\" />&nbsp;<span style=\"line-height:1.6\">Silbernes Lorbeerblatt &quot;银月桂叶&quot;奖.是德国最高体育奖项,受奖运动员或队由德国联邦奥运委员会主席提名,呈德国联邦内务部长签署,根据德意志联邦共和国基本法第58条签署获 准申请.授奖仪式由联邦总统霍斯特&middot;克勒 Horst Koehler或内务部长Dr. Wolfgang Schaeuble 亲自颁发.2008年5月28日在柏林,德国历史上迎来了第一位华裔女运动员获此殊荣.</span></div>
</div>

<div class=\"post-body entry-content\" id=\"post-body-7902045565910384647\">
<div>&nbsp;
<div>
<div>
<div>
<div><br />
2007年德国男子足球队,德国手球队,德国女子足球队,克林茨曼.等获得过银月桂.<img alt=\"\" id=\"BLOGGER_PHOTO_ID_5205543169940570706\" src=\"http://2.bp.blogspot.com/_JNMGU8bi6UM/SD3N7tNEwlI/AAAAAAAAAXc/ddGdEfdseB4/s400/Bild+004.jpg\" style=\"display:block; float:right; height:267px; line-height:20.8px; margin:0px auto 10px; text-align:center; width:200px\" /><br />
<br />
The Silberne Lorbeerblatt (Silver Bay Laurel Leaf) is the highest <a class=\"mw-redirect\" href=\"http://en.wikipedia.org/wiki/Sports_awards\" id=\"a.kk4\" title=\"Sports awards\">sports award</a> in Germany. It had been endowed on <a href=\"http://en.wikipedia.org/wiki/June_23\" id=\"a.kk5\" title=\"June 23\">June 23</a>, 1950 by the <a href=\"http://en.wikipedia.org/wiki/President_of_Germany\" id=\"a.kk6\" title=\"President of Germany\">German President</a> <a href=\"http://en.wikipedia.org/wiki/Theodor_Heuss\" id=\"a.kk7\" title=\"Theodor Heuss\">Theodor Heuss</a>. It is awarded to athletes and teams if they placed several times at international championships. Furthermore, the honoree also has to have an exemplary character.<a href=\"http://en.wikipedia.org/wiki/Silbernes_Lorbeerblatt#cite_note-0\" id=\"a.kk8\" title=\"\">[1]</a> Exempt from the rule of several medal wins are medal winner at <a href=\"http://en.wikipedia.org/wiki/Olympic_Games\" id=\"a.kk9\" title=\"Olympic Games\">Olympic</a> and <a href=\"http://en.wikipedia.org/wiki/Paralympic_Games\" id=\"a.kk10\" title=\"Paralympic Games\">Paralympic</a> Games and winning an important international title like the football <a href=\"http://en.wikipedia.org/wiki/FIFA_World_Cup\" id=\"a.kk11\" title=\"FIFA World Cup\">World Cup</a>. In these cases, a single medal win (during the <a href=\"http://en.wikipedia.org/wiki/Olympic_Games\" id=\"a.kk12\" title=\"Olympic Games\">Olympic</a> and <a href=\"http://en.wikipedia.org/wiki/Paralympic_Games\" id=\"a.kk13\" title=\"Paralympic Games\">Paralympic</a> Games) or winning the gold medal can be honored with the Silberne Lorbeerblatt.</div>

<div><br />
To be honored with the Silberne Lorbeerblatt an athlete or a team has to be nominated by the president of the <a class=\"mw-redirect\" href=\"http://en.wikipedia.org/wiki/German_Olympic_Sports_Confederation\" id=\"a.kk15\" title=\"German Olympic Sports Confederation\">German Olympic Sports Confederation</a> to the <a href=\"http://en.wikipedia.org/wiki/President_of_Germany\" id=\"a.kk16\" title=\"President of Germany\">German President</a>. The request will be reviewed a) by the agency of the <a href=\"http://en.wikipedia.org/wiki/President_of_Germany\" id=\"a.kk17\" title=\"President of Germany\">German President</a> and b) the <a href=\"http://en.wikipedia.org/wiki/Federal_Ministry_of_the_Interior_%28Germany%29\" id=\"a.kk18\" title=\"Federal Ministry of the Interior (Germany)\">Federal Ministry of the Interior</a> as this agency is responsible for <a href=\"http://en.wikipedia.org/wiki/Sport\" id=\"a.kk19\" title=\"Sport\">sport</a> in <a href=\"http://en.wikipedia.org/wiki/Germany\" id=\"a.kk20\" title=\"Germany\">Germany</a>. The <a href=\"http://en.wikipedia.org/wiki/Federal_Ministry_of_the_Interior_%28Germany%29\" id=\"a.kk21\" title=\"Federal Ministry of the Interior (Germany)\">Federal Ministry of the Interior</a> signs the approved application, following article 58 of the &#39;Basic Law for the Federal Republic of Germany&#39; .</div>
&nbsp;

<div>Gro&szlig;e Anerkennung f&uuml;r die Bischmisheimer Badmintonspielerin Huaiwen Xu: Die zweimalige Europameisterin erh&auml;lt die h&ouml;chste deutsche Auszeichnung f&uuml;r sportliche Leistungen - das Silberne Lorbeerblatt. Die Aush&auml;ndigung des Ehrenzeichens erfolgt am 28. Mai in Berlin durch den Bundesminister des Inneren, Dr. Wolfgang Sch&auml;uble. Mit der Spitzensportlerin vom 1. BC Saarbr&uuml;cken-Bischmisheim werden mehr als 100 Sportler mit dem Silbernen Lorbeerblatt ausgezeichnet, darunter unter anderem die mehrfache Boxweltmeisterin Regina Halmich und der Springreiter Ludger Beerbaum. &bdquo;Die Verleihung ist eine gro&szlig;e Ehre f&uuml;r mich. Ich h&auml;tte dies vorher nicht erwartet. Die Auszeichnung wird mich in meiner Karriere sicherlich weiterbringen&ldquo;, sagt Huaiwen Xu. Die aktuelle Weltranglisten-Achte gewann unter anderem zweimal WM-Bronze, zweimal EM-Gold und sie wurde f&uuml;nfmal in Serie Deutsche Meisterin. Ferner holte die sympathische Spielerin 2006 und 2008 mit der Nationalmannschaft der Damen jeweils WM-Bronze sowie 2006 und 2008 jeweils EM-Bronze. Anfang Mai gewann das Vorbild in puncto Leistungswillen und professionellem Verhalten mit dem 1. BC Saarbr&uuml;cken-Bischmisheim zum dritten Mal in Folge die Deutsche Mannschaftsmeisterschaft. Die 32-J&auml;hrige nimmt nun in Peking an ihren zweiten Olympischen Spielen teil und bestritt bereits mehr als 50 L&auml;nderspiele f&uuml;r Deutschland. &bdquo;Diese hohe Auszeichnung hat sich die sympathische Athletin auf jeden Fall verdient&ldquo;, freut sich LSVS-Pr&auml;sident Gerd Meyer.Das Silberne Lorbeerblatt wird f&uuml;r herausragende sportliche Leistungen verliehen. Bei der Wertung der Leistungen wird ein strenger internationaler Ma&szlig;stab angelegt. Dar&uuml;ber hinaus muss der sportlichen Leistung eine vorbildliche menschliche und charakterliche Haltung entsprechen. Das Ehrenzeichen wird auf Antrag des Pr&auml;sidenten des Deutschen Olympischen Sportbundes oder des Pr&auml;sidenten des Deutschen Behindertensportverbandes verliehen. Gestiftet wurde das Silberne Lorbeerblatt 1950 vom damaligen Bundespr&auml;sidenten Theodor Heuss.Den Pr&auml;sidenten des Deutschen Badminton-Verbandes, Karl-Heinz Kerst, erf&uuml;llt die Verleihung des Silbernen Lorbeerblattes an Huaiwen Xu ebenfalls mit gro&szlig;em Stolz: &bdquo;Diese Auszeichnung an eine verdiente und tadellose Sportlerin ist indirekt auch eine Anerkennung der hervorragenden Leistungssportarbeit im Deutschen Badminton-Verband, f&uuml;r die das gesamte Team verantwortlich ist. Deshalb d&uuml;rfen sich auch alle Mannschaftskollegen sowie der gesamte Betreuerstab ganz herzlich mit Huaiwen &uuml;ber diese Ehrung freuen. Ich fahre mit viel Freude nach Berlin und erwarte dort eine stilvolle und emotionale Feierstunde, die allen Beteiligten sicherlich noch lange in Erinnerung bleiben wird&ldquo;, sagt Kerst.Vor Huaiwen Xu erhielten bislang f&uuml;nf DBV-Athleten das Silberne Lorbeerblatt: die Europameister Irmgard Gerlatzka, Dr. Wolfgang Bochow, Roland Maywald, Willy Braun sowie die mehrmalige Vize-Europameisterin Marieluise Zizmann.</div>
&nbsp;

<div>Gro&szlig;e Anerkennung f&uuml;r Badminton-Europameisterin Huaiwen Xu: Die zweimalige Goldmedaillengewinnerin im Dameneinzel bei der Individual-EM erh&auml;lt die h&ouml;chste deutsche Auszeichnung f&uuml;r sportliche Leistungen, das &bdquo;Silberne Lorbeerblatt&ldquo;. Die Aush&auml;ndigung des Ehrenzeichens erfolgt am 28.05.2008 im Rahmen einer gr&ouml;&szlig;eren Veranstaltung in Berlin, bei der mehr als 100 Sportlerinnen und Sportler ausgezeichnet werden, durch den Bundesminister des Inneren, Dr. Wolfgang Sch&auml;uble.Die aktuelle Weltranglistenachte (Stand: 22.05.2008) gewann in ihrer Paradedisziplin unter anderem zweimal WM-Bronze (2005, 2006), zweimal EM-Gold (2006, 2008) und wurde f&uuml;nfmal in Serie Deutsche Meisterin (2004-2008). Ferner holte die sympathische Spielerin 2006 und 2008 mit der Nationalmannschaft der Damen jeweils WM-Bronze sowie 2006 und 2008 jeweils EM-Bronze.Dar&uuml;ber hinaus bestritt die 32-J&auml;hrige, die in Peking an ihren zweiten Olympischen Spielen teilnimmt, bereits mehr als 50 L&auml;nderspiele f&uuml;r Deutschland.&bdquo;Die Auszeichnung ist eine gro&szlig;e Ehre f&uuml;r mich. Ich h&auml;tte dies vorher nicht erwartet. Die Auszeichnung wird mich in meiner Karriere sicherlich weiterbringen&ldquo;, sagte Huaiwen Xu, die sich durch ihre offene und freundliche Pers&ouml;nlichkeit auszeichnet und ein Vorbild unter anderem in puncto Leistungswillen und professionellem Verhalten in Training und Wettkampf ist.Den Pr&auml;sidenten des DBV, Karl-Heinz Kerst (Kleve), erf&uuml;llt die Verleihung des Silbernen Lorbeerblattes an Huaiwen Xu ebenfalls mit gro&szlig;em Stolz: &bdquo;Diese Auszeichnung an eine verdiente und tadellose Sportlerin ist indirekt auch eine Anerkennung der hervorragenden Leistungssportarbeit im Deutschen Badminton-Verband, f&uuml;r die das gesamte Team verantwortlich ist. Deshalb d&uuml;rfen sich auch alle Mannschaftskolleginnen und -kollegen sowie der gesamte Betreuerstab ganz herzlich mit Huaiwen &uuml;ber diese Ehrung freuen. Ich fahre mit viel Freude nach Berlin und erwarte dort eine stilvolle und emotionale Feierstunde, die allen Beteiligten sicherlich noch lange in Erinnerung bleiben wird&ldquo;, sagte Karl-Heinz Kerst.Vor Huaiwen Xu, die Anfang Mai zum dritten Mal in Folge mit dem 1. BC Bischmisheim die Deutsche Mannschaftsmeisterschaft gewann, erhielten bislang f&uuml;nf Spieler/innen des DBV das Silberne Lorbeerblatt: die Europameister Irmgard Gerlatzka (geb. Latz), Dr. Wolfgang Bochow, Roland Maywald und Willy Braun sowie die mehrmalige Vize-Europameisterin Marieluise Zizmann (geb. Wackerow).<br />
Das Silberne Lorbeerblatt ...wird f&uuml;r herausragende sportliche Leistungen verliehen. Bei der Wertung der Leistungen wird ein strenger internationaler Ma&szlig;stab angelegt. Dar&uuml;ber hinaus muss der sportlichen Leistung eine vorbildliche menschliche und charakterliche Haltung des bzw. der Auszuzeichnenden entsprechen. Der Bundespr&auml;sident verleiht das Ehrenzeichen auf Antrag des Pr&auml;sidenten des Deutschen Olympischen Sportbundes (DOSB) oder des Pr&auml;sidenten des Deutschen Behindertensportverbandes (DBS). Das Silberne Lorbeerblatt wurde am 23.06.1950 vom damaligen Bundespr&auml;sidenten Theodor Heuss gestiftet.</div>
&nbsp;

<div>月桂树是地中海地区的硬叶植物，叶子坚韧如皮革，也许正因为如此，它被视作坚韧品格的象征。月桂叶可 用来调味，果实有药用价值。古代的罗马大帝都戴有月桂枝做成的桂冠，后来桂冠便专门用来奖励竞技优胜者或奥林匹克运动会的优胜者，成了名誉、成功的象征。 现在英美国家还有桂冠诗人。在德国，对运动员的最高奖励，是月桂叶奖，一枚银色月桂叶徽章就是它的标志。&rdquo;</div>

<div>&nbsp;</div>
</div>
</div>

<div><strong>视频链接请点击</strong><a href=\"http://sport.ard.de/sp/layout/jsp/komponente/mediabox/index.jsp?mid=16384&amp;mkat=1&amp;seite=4\">http://sport.ard.de/sp/layout/jsp/komponente/mediabox/index.jsp?mid=16384&amp;mkat=1&amp;seite=4</a></div>
</div>
</div>
</div>

<div>&nbsp;</div>

<div>&nbsp;</div>
','xuhuaiwen','徐怀雯获奖','uploads/201606080619003304.jpg','6','1','1','1210374000','1465406545','徐怀雯获得 银月桂',' 徐怀雯获得 银月桂 ');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('12','17','与平易近人的德国总统握手','与平易近人的德国总统握手','<p><img alt=\"\" src=\"/uploads/Koehler%201.jpg\" style=\"height:325px; width:400px\" /></p>
','xuhuaiwen','与平易近人的德国总统握手','uploads/201606080658496882.jpg','0','1','1','1217631600','1217631600','与平易近人的德国总统握手','与平易近人的德国总统握手');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('13','17',' Beijing Olympic Certificate 奥运会获奖证书. 23年职业经历，光荣与梦想。 ',' Beijing Olympic Certificate 奥运会获奖证书. 23年职业经历，光荣与梦想。 ','<p><img alt=\"\" src=\"/uploads/IMG_6720.JPG\" style=\"height:267px; width:400px\" /></p>
','xuhuaiwen',' Beijing Olympic Certificate 奥运会获奖证书. 23年职业经历，光荣与梦想。 ','uploads/201606080704513727.jpg','2','1','1','1222729200','1465409091',' Beijing Olympic Certificate 奥运会获奖证书. 23年职业经历，光荣与梦想。 ',' Beijing Olympic Certificate 奥运会获奖证书. 23年职业经历，光荣与梦想。 ');



-- -------------------------------------------
-- TABLE DATA blog_tag
-- -------------------------------------------
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('1','test','3');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('2','mytest','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('8','100%','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('9','price','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('10','...','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('11','doctors','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('12','mobile','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('13','Xu Huaiwen','2');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('14','badminton','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('15','Junior Badminton Coaching Session','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('16','coaching in London','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('17','Intermediate badminton coaching','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('18','advance badminton training','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('19','xuhuaiwen','6');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('20','2008年奥运会','1');



-- -------------------------------------------
-- TABLE DATA htmlblock
-- -------------------------------------------
INSERT INTO `htmlblock` (`id`,`name`,`content`,`created_at`,`updated_at`) VALUES
('7','google-analysis','<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-78429579-1\', \'auto\');
  ga(\'send\', \'pageview\');

</script>','1464366220','1464366230');
INSERT INTO `htmlblock` (`id`,`name`,`content`,`created_at`,`updated_at`) VALUES
('8','index-joinustoday','<h3>Learn Badminton with Xu Huaiwen</h3>

<p>To build your body, skills and confidence, To healthier, better tomorrow,<br />
<span style=\"color:#FF0000\"><strong>JOIN US NOW!! JOIN US TODAY!!</strong></span></p>
','1465230416','1465248915');



-- -------------------------------------------
-- TABLE DATA migration
-- -------------------------------------------
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m000000_000000_base','1458761082');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m140608_201405_user_init','1458761125');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m140608_201406_rbac_init','1458761125');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m141208_201480_blog_init','1458775954');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m141208_201488_setting_init','1458824178');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m141208_201489_auth_init','1458860559');



-- -------------------------------------------
-- TABLE DATA product
-- -------------------------------------------
INSERT INTO `product` (`id`,`catalog_id`,`name`,`sku`,`stock`,`weight`,`price`,`brief`,`introduction`,`content`,`thumb`,`image`,`keywords`,`description`,`brand`,`sales`,`status`,`created_at`,`starttime`,`endtime`,`updated_at`) VALUES
('3','16','Junior Badminton Coaching Session ','','0','0.000','100.00','Beginner Class is an introduction to Badminton; which is offered to children who have no previous Badminton experience. ','Beginner Class is an introduction to Badminton; which is offered to children who have no previous Badminton experience. ','<p><!--?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?--><span style=\"font-family:helvetica neue; font-size:14px\">Beginner Class is an introduction to Badminton; which is offered to children who have no previous Badminton experience. The goal of the class is to develop a child&rsquo;s hand-eye coordination.</span><br />
<span style=\"font-family:helvetica neue; font-size:14px\">&nbsp;</span><br />
<strong><span style=\"font-family:helvetica neue; font-size:14px\">The lessons will cover:</span></strong></p>

<ul>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Forehand/backhand serves</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Overhead clears</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Forehand/backhand lifts</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Shadow (4 corners)</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Net shots</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Drop shots (no cuts)</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Basic rules of singles games (how to count the point, lines)</span></li>
</ul>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Time</strong></span></p>

<p>10 weeks(3, 17, 24, 31 July / 7, 14, 21, 28 Aug / 4, 11 Sep)</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Price</strong></span></p>

<p>10 session for 100 pounds</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Location</strong>&nbsp;</span></p>

<p>Richard Challoner School, Manor Drive North, New Malden, KT3 5PE</p>
','uploads/201606021153241836.jpg','uploads/201606021153241836.jpg','junior badminton coaching','junior badminton coaching by xu huaiwen','','0','1','1464864368','','','1464864884');
INSERT INTO `product` (`id`,`catalog_id`,`name`,`sku`,`stock`,`weight`,`price`,`brief`,`introduction`,`content`,`thumb`,`image`,`keywords`,`description`,`brand`,`sales`,`status`,`created_at`,`starttime`,`endtime`,`updated_at`) VALUES
('4','16','Intermediate badminton coaching ','','0','0.000','150.00','Intermediate Class is introduced to children who have some Badminton experience. Students should be able to hit clears, lifts, net drop (with correct grip)....','Intermediate Class is introduced to children who have some Badminton experience. Students should be able to hit clears, lifts, net drop (with correct grip)....','<p><!--?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?--><span style=\"font-family:helvetica neue; font-size:14px\">Intermediate Class is introduced to children who have some Badminton experience. Students should be able to hit clears, lifts, net drop (with correct grip) and move to the corners with the correct footwork. The goal of the lessons is for students to have a good understanding of the game, and to learn good sportsmanship.</span><br />
<span style=\"font-family:helvetica neue; font-size:14px\">&nbsp;</span><br />
<strong><span style=\"font-family:helvetica neue; font-size:14px\">The lessons will cover</span></strong></p>

<ul>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Drop shots</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Smash</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Shadow (full court)</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">All the net shots (spin, cross net, push, net kill)</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Double technique (drive, block, lift, etc.)</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Double rotation and rules</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Simple tactics</span></li>
</ul>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Time</strong></span></p>

<p>10 weeks(3, 17, 24, 31 July / 7, 14, 21, 28 Aug / 4, 11 Sep)</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Price</strong></span></p>

<p>10 session for 100 pounds</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Location</strong>&nbsp;</span></p>

<p>Richard Challoner School, Manor Drive North, New Malden, KT3 5PE</p>
','uploads/201606021207063915.jpg','uploads/201606021207063915.jpg','Intermediate badminton coaching ','Intermediate badminton coaching ','','0','1','1464865232','','','1464865626');
INSERT INTO `product` (`id`,`catalog_id`,`name`,`sku`,`stock`,`weight`,`price`,`brief`,`introduction`,`content`,`thumb`,`image`,`keywords`,`description`,`brand`,`sales`,`status`,`created_at`,`starttime`,`endtime`,`updated_at`) VALUES
('5','16','Advanced Badminton Coaching','','0','0.000','170.00','Advanced Class is introduced to children who have mastered all the strokes and footwork mentioned in the beginner and intermediate classes','Advanced Class is introduced to children who have mastered all the strokes and footwork mentioned in the beginner and intermediate classes','<p><!--?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?--><span style=\"font-family:helvetica neue; font-size:14px\">Advanced Class is introduced to children who have mastered all the strokes and footwork mentioned in the beginner and intermediate classes. The goal of the class is to prepare students for higher-level competitions.</span><br />
<span style=\"font-family:helvetica neue; font-size:14px\">&nbsp;</span><br />
<strong><span style=\"font-family:helvetica neue; font-size:14px\">The lessons will cover</span></strong></p>

<ul>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Backhand clear, drop</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Stick smashes</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Match analysis</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Double rotation</span></li>
	<li><span style=\"font-family:helvetica neue; font-size:14px\">Neutralization</span></li>
</ul>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Time</strong></span></p>

<p>10 weeks(3, 17, 24, 31 July / 7, 14, 21, 28 Aug / 4, 11 Sep)</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Price</strong></span></p>

<p>10 session for 100 pounds</p>

<p><span style=\"font-family:helvetica neue; font-size:14px\"><strong>Location</strong>&nbsp;</span></p>

<p>Richard Challoner School, Manor Drive North, New Malden, KT3 5PE</p>
','uploads/201606021213569091.jpg','uploads/201606021213569091.jpg','advance badminton training, badminton coaching','advance badminton training, badminton coaching','','0','1','1464865967','','','1464866036');



-- -------------------------------------------
-- TABLE DATA setting
-- -------------------------------------------
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('11','0','info','group','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('15','0','contact','group','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('21','0','basic','group','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('31','0','smtp','group','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1111','11','siteName','text','','','Xuhuawen\'s Badminton Club, leading badminton coaching in uk','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1112','11','siteTitle','text','','','Xuhuawen\'s Badminton Club','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1113','11','siteKeyword','text','','','badminton club in UK','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1120','11','slogan','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1505','15','contacter','text','','','Dr Tao','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1510','15','mobile','text','','','07460088881','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1520','15','phone','text','','','07460088888','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1530','15','email','text','','','xuhuaiwen@gmail.com','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1540','15','address','text','','','Richard Challoner School, Manor Drive North, New Malden, KT3 5PE','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1550','15','googlemap','text','','','https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9959.825266111477!2d-0.2644819!3d51.3854809!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcc4dd5b0bd2a7a7c!2sRichard+Challoner+School!5e0!3m2!1sen!2suk!4v1464879348861','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1560','15','facebook','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1570','15','twitter','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1580','15','wechat','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1590','15','qq','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1593','15','worktime','text','','','Monday - Saturday, 8am to 10pm','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('2102','21','template','text','','','sports','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('2105','21','theme','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('2111','21','timezone','select','-12,-11,-10,-9,-8,-7,-6,-5,-4,-3.5,-3,-2,-1,0,1,2,3,3.5,4,4.5,5,5.5,5.75,6,6.5,7,8,9,9.5,10,11,12','','0','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('2112','21','commentCheck','select','0,1','','1','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('3111','31','smtpHost','text','','','localhost','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('3112','31','smtpPort','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('3113','31','smtpUser','text','','','admin','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('3114','31','smtpPassword','password','','','123456','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('3115','31','smtpMail','text','','','','50');



-- -------------------------------------------
-- TABLE DATA textblock
-- -------------------------------------------
INSERT INTO `textblock` (`id`,`name`,`content`,`created_at`,`updated_at`) VALUES
('4','xuhuaiwen','Participated 2 times Olympic Games Athens 2004, Beijing 2008 won 5th at Beijing Olympic Games 2008. won 2 times Bronze Medal at World Championships ,2005(Anaheim,USA), 2006 (Madrid, Spain). won 2 times European Champions 2006( Holland), 2008 (Denmark). won 2 times Bronze Medal with Team Germany at Uber cup 2006, 2008 (World championships team event). the best ladies singles world ranking: No.1 (WBF on June.22. 2006 ).won more than 20 international tournaments.','1464779439','1464779439');
INSERT INTO `textblock` (`id`,`name`,`content`,`created_at`,`updated_at`) VALUES
('5','home-coaching-title','Summber Coaching Session from Jun To Aug','1465231002','1465231002');



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`auth_role`,`role`,`status`,`created_at`,`updated_at`) VALUES
('1','admin','yg2Rwbcem7EwNNZ-rtgxRH7ZXG5kiwCf','$2y$13$Tp8wfyMS7Sa/ZAS5o/JfqO1PylnkkoT/hvXpB6./a.QOWMArDWhRa','6h1T981bPFIzuz7m4DGtNsP86zFVhwfT_1463109847','admin@demo.com','1','admin','1','1458761124','1463583769');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`auth_role`,`role`,`status`,`created_at`,`updated_at`) VALUES
('2','qiang','urHOjtnt-npSvGXM6sLxQ6BpXEKJ_Cmv','$2y$13$SngCkDe47nvuIgydPvwjROq/TVr2z4WdtSShqhWtTfIBWT6NzVSZC','V0ef-TyZtKitlD28ynvoXglkcIUGFAUM_1460930230','info@epandaeye.com','3','user','1','1460930230','1463579203');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`auth_role`,`role`,`status`,`created_at`,`updated_at`) VALUES
('3','test','QvqojuBgiFwO3C2zz1VWEiVa3ww2Peq7','$2y$13$eVyGmmym0WCPsqCLAaNq.u995AoNCYJ0/tKZWqw2FXpeOkiyz7FJq','q3OCWVgmFJFZKlTYBixVzYoUDrCD71cm_1464361528','jone@hotmail.com','','user','1','1464361527','1464361639');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
