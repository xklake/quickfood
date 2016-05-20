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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

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
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- TABLE DATA blog_catalog
-- -------------------------------------------
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('1','0','Introduction','Introduction','','1','50','20','post','','1','1458833093','1462890865','home','home description','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('2','0','Contacts','contact','','1','900','20','post','','1','1458833121','1458833321','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('3','0','Acupuncture','acupuncture','','1','58','20','post','','1','1458833185','1462936256','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('4','0','Service & Price','services','','1','90','20','post','','1','1458833222','1462952190','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('6','0','Tuina Massage','TuinaMassage ','','1','60','10','post','','1','1462936737','1462936737','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('7','0','Herbal Therapy','HerbalTherapy','','1','65','10','post','','1','1462936986','1462936986','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('8','0','Guarantee Policy','Guarantee_Policy','','1','200','10','post','','1','1462951905','1462951905','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('9','0','Other Therapies','Other_therapies','','1','70','10','post','','1','1462952664','1462952664','','','');
INSERT INTO `blog_catalog` (`id`,`parent_id`,`title`,`surname`,`banner`,`is_nav`,`sort_order`,`page_size`,`template`,`redirect_url`,`status`,`created_at`,`updated_at`,`keywords`,`description`,`content`) VALUES
('10','0','Doctors','doctors','','1','100','10','post','','1','1462953268','1462953268','','','');



-- -------------------------------------------
-- TABLE DATA blog_comment
-- -------------------------------------------
INSERT INTO `blog_comment` (`id`,`post_id`,`content`,`author`,`email`,`url`,`status`,`created_at`,`updated_at`) VALUES
('1','1','hahaaha','Qiang','joneleesz@hotmail.com','this is a','1','1458836460','1460993737');
INSERT INTO `blog_comment` (`id`,`post_id`,`content`,`author`,`email`,`url`,`status`,`created_at`,`updated_at`) VALUES
('2','1','this is a rubbish','Qiang','joneleesz@hotmail.com','http://www.sohu.com','1','1460743828','1460993730');



-- -------------------------------------------
-- TABLE DATA blog_post
-- -------------------------------------------
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('1','3','Acupuncture','Acupuncture','<p><strong>Acupuncture</strong> is based on the concept that the body&rsquo;s vital energy travels in a clearly defined path, which TCM calls meridians or channels. By using sterilized, single-use, disposable needles at meridian points that correspond to various organs and systems in the body, the body&rsquo;s energy can be encouraged back into balance and stimulated to heal itself. At our clinic you will be in expert hands.</p>

<p>&nbsp;</p>

<p>Acupuncture can used for a wide range of symptoms or conditions. These include anxiety states, arthritis, asthma, back pain, circulatory problems, depression, facial paralysis, fibrositis, high blood pressure, indeterminate aches and pains, infertility menstrual problems, migraines, rheumatism, sciatica, skin conditions or ulcers. &nbsp;</p>

<p>&nbsp;</p>

<p><strong>The World Health Organization</strong><br />
The World Health Organization recognizes acupuncture&rsquo;s effectiveness for over 40 common disorders, including:</p>

<p>1.&nbsp;Ear, Nose and Throat disorders such as toothaches, earaches, sinusitus and laryngitis.</p>

<p>2.&nbsp;Respiratory disorders such as colds and flu, bronchitis, asthma and allergies.</p>

<p>3.&nbsp;Gastrointestinal disorders such as food allergies, nausea, indigestion and diarrhea.</p>

<p>4.&nbsp;Circulatory disorders such as hypertension, high cholesterol and arteriosclerosis.</p>

<p>5.&nbsp;Psychoemotional disorders such as depression, anxiety, insomnia, headaches, migraines and tinnitus.</p>

<p>6.&nbsp;Gynecological disorders such as menstrual irregularity, endometriosis and PMS.</p>

<p>&nbsp;</p>

<p><strong>How does acupuncture work?</strong><br />
Modern Western medicine cannot yet explain how acupuncture works. Traditional Asian acupuncture is based on ancient Chinese theories of flow of qi (a fine, essential substance which nourishes and constructs the body) through distinct channels that cover the body somewhat like the nerves and blood vessels. According to this theory, acupuncture adjusts the flow of qi in the body, leading it to areas where it is insufficient and draining it from areas where it is stuck or super-abundant. Some Western theorists believe that it works on the nervous system which stimulates chemical reactions within the immune system. Whatever way you want to look at it, it works!</p>

<p>&nbsp;</p>

<p><strong>Is acupuncture safe?</strong><br />
When performed by competent trained professionals at Herbs Plus, acupuncture is completely safe. Please note that we always use individually packaged, sterile, disposable needles.</p>

<p>&nbsp;</p>

<p><strong>Does it hurt?</strong><br />
Acupuncture needles are typically not much thicker than a human hair, and their insertion is practically painless. Some people might experience a temporary feeling of heaviness, pressure, tingling or numbness. Most people find acupuncture relaxing and many fall asleep during the treatment.</p>
','Acupuncture, Acupuncture London','Acupuncture','','42','1','1','1458836416','1463490368','keywords testing','descriptions testing');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('2','6','Tuina Massage (Deep Tissue Medical Massage)','Tuina Massage (Deep Tissue Medical Massage)
','<p><strong>Tuina Massage (Deep Tissue Medical Massage)</strong></p>

<p>&nbsp;</p>

<p>Tuina translates loosely into &quot;push-grasp&quot;. Physically, it is the pressing and kneading with palms, fingertips, knuckles to help the body to remove blockages along the meridians of the body and stimulates the flow of qi and blood to promote healing, similar to principles of acupuncture and acupressure. Tuina&#39;s massage-like techniques range from light stroking to deep-tissue work which would be considered too vigorous or too painful for a recreational or relaxing massage.</p>

<p>&nbsp;</p>

<p>It helps to relax tired and tense muscles, lower blood pressure, reduce back pain and treat most skeletal problems as well as stimulating the blood and lymphatic circulation.</p>

<p>&nbsp;</p>

<p>Tuina massage is also used for beauty therapy in conjunction with a herbal facial treatment.</p>
','Tuina Massage (Deep Tissue Medical Massage)','TuinaMassage','','0','1','1','1462936830','1462936830','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('3','7','Herbal Therapy','Herbal Therapy','<p>In Traditional Chinese Medicine, acupuncture and herbs go hand in hand, working together to balance energies in the body. The herbs are very high quality and expertly formulated to the specific needs of the patient based on ancient recipes.</p>

<p>&nbsp;</p>

<p>Herbal formulas are not simply prescribed based on the patient&#39;s chief complaint &ndash; remember the doctor forms a holistic view of the body condition. Therefore, patients with similar problems could be given different formulas and patients with different problems (as understood by western medicine) could be given similar.</p>

<p>&nbsp;</p>

<p><strong>Chinese Patent Medicines</strong><br />
Many of the classic formulas are so widely used that they are manufactured in readily available patent forms as pills and capsules, or sometimes creams or tinctures for external use. While patent medicines are convenient and often remarkably effective, they should not be seen as replacement for raw herbs prescribed in a customized. Always consult our practitioners by person or by telephone before you choose any of our patent Chinese herbal products.</p>
','herbal therapy','herbaltherapy','','0','1','1','1462937078','1462951134','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('4','1','Introduction','Introduction','
<p><strong>Petrel Nature Health&nbsp;</strong>use Traditional Chinese Medicine (TCM) and acupuncture, a holistic healthcare system used successfully in China for over 4,000 years and now flourishing throughout the world. who has appeared on both TV and radio incountry.Our&nbsp;consultants&nbsp;have been trained in China to a very high level.</p>



<p>&nbsp;</p>



<p>The aim of TCM is to restore the natural balance and harmony of the individual by treating the whole of the person and not just the isolated symptoms. At&nbsp;Petrel Nature Health&nbsp;we begin with a free initial consultation to assess your health status, medical history and suitable diagnosis.</p>



<p>&nbsp;</p>



<p>Treatment traditionally consists of tea made with combinations of herbs which are taken daily together with regular&nbsp;acupuncture. We also stock many patented Chinese herbal medicines&nbsp;in the form of pills and creams.</p>



<p>&nbsp;</p>



<p>Tuina Massage&nbsp;also compliments herbal therapy, a specialist massage technique that improves the immune system amongst other benefits. This technique is also used as part of our popular&nbsp;facial and beauty therapy.</p>



<p>&nbsp;</p>



<p>Whatever your medical problem, you might be pleasantly surprised at the results which can be achieved with Chinese medicine and&nbsp;acupuncture.</p>



<p>&nbsp;</p>



<p><strong>For a free initial consultation please contact us to book an appointment today.&nbsp;</strong></p>

 

','petrel natural health','introduction','','0','1','1','1462951358','1462951800','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('5','8','Guarantee Policy','Guarantee Policy','<p>Unlike other competitors, we proudly guarantee that we provide the&nbsp;<strong>best</strong>&nbsp;quality and standard of traditional therapies, the&nbsp;<strong>best&nbsp;</strong>price for benefit, and the&nbsp;<strong>best</strong>&nbsp;risk-free refund policy.</p>

<p>&nbsp;</p>

<p>Like many existing clients who have benefited from the treatments, you will be very pleased with the effects should you give us sufficient time: the traditional therapies are not magic and need time to show their fantastic value.</p>

<p>&nbsp;</p>

<p>In addition, there is no risk in committing to the treatments, because we will happily give you an exchange or refund if you change your mind in&nbsp;7&nbsp;days from initial transaction.</p>

<p>&nbsp;</p>

<p>If you wish to quit a course of treatments, you are entitled for an exchange to other treatments or refund for the remaining credit. In the case of refund, the treatments already undertaken will be deducted<strong>&nbsp;at the full standard price, plus 15% management charge for premature termination of the treatment course.</strong></p>

<p>&nbsp;</p>

<p><strong>Exceptions:</strong></p>

<p>&nbsp;</p>

<p>1 Once provided, &nbsp;treatments such as acupuncture, massage, reflexology and ear candling are non-exchangeable and non-refundable.&nbsp;</p>

<p>&nbsp;</p>

<p>2 Herbal formulas (e.g. pills) can be exchanged or refunded as long as they are unopened and in the original package and in a sellable conditions. However, herbal remedies in forms of raw herbs and herbal powder are irreversible, thus non-exchangeable and non-refundable once prepared.</p>

<p>&nbsp;</p>

<p><strong>As a refund request may be due to dissatisfaction to our service, the procedure is designed to assist us to identify the problem and improve our service.</strong></p>
','100%','Guarantee_Policy','','0','1','1','1462952034','1462952034','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('6','4','Service & Price','Service & Price','<div class=\"ecxsaying\" style=\"line-height: 22.4px; color: rgb(12, 129, 0); padding: 5px 5px 20px; font-family: Constantia, \'Lucida Bright\', Lucidabright, \'Lucida Serif\', Lucida, \'DejaVu Serif\', \'Bitstream Vera Serif\', \'Liberation Serif\', Georgia, serif; font-size: 16px;\">
<blockquote>
<h5>&ldquo;We work hard on healing but the prevention is always better than cure&rdquo;</h5>

<h5><span style=\"font-size:0.8125rem\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&ndash;Contemporary Chinese Therapy</span></h5>
</blockquote>

<div>
<h5>&nbsp;</h5>

<h5><span style=\"color:#000000\"><strong>Acupuncture&nbsp;</strong>&nbsp;- &pound;35 per session / 40mins (including 5mins free massage )<br />
Buy 5 sessions get 1 free. Buy 10 sessions get 3 free</span></h5>

<h5><span style=\"color:#000000\"><strong>Moxibustion</strong>&nbsp;- (helps infertility, malposition, pain release etc.)<br />
&pound;30 per session/ 30mins&nbsp;</span></h5>

<h5><span style=\"color:#000000\"><strong>Acupuncture &amp; Medical Massage</strong>&nbsp;- &pound;60 per session (including 30mins acupuncture and 30mins massage )<br />
Buy 5 sessions get 1 free</span></h5>

<h5><span style=\"color:#000000\"><strong>Tuina massage&nbsp;</strong>- Deep Tissue Massage<br />
&pound;55 / 60 mins (Full body ) | &pound;30 / 30mins (Shoulder, neck and back)</span></h5>

<h5><span style=\"color:#000000\"><strong>Reflexology</strong>&nbsp;- Foot massage<br />
&pound;30 for 30 mins | &pound;50 for 60 mins</span></h5>

<h5><span style=\"color:#000000\"><strong>Relaxation General Massage</strong>&nbsp;-&nbsp;<br />
&pound;30 for 30 mins | &pound;50 for 60 mins</span></h5>

<h5><span style=\"color:#000000\"><strong>Fire Cupping</strong>&nbsp;- &pound;20 per session / 25mins&nbsp;</span></h5>

<h5><span style=\"color:#000000\"><strong>Ear Points</strong>&nbsp;- (helps stop smoking and releases stress)<br />
&pound;15 per session (both ear)</span></h5>

<h5><span style=\"color:#000000\"><strong>Ear Candling</strong>&nbsp;-&nbsp;<br />
&pound;25 per session &nbsp;( for both ear with ear clean done by practitioner. including 2 wax candles )</span></h5>

<h5><span style=\"color:#000000\"><strong>Chinese Herbal Medicine (Teas or Powder)</strong>&nbsp;- from &pound;6 per day.</span></h5>
</div>
</div>
','price','service_price','','0','1','1','1462952521','1462952521','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('7','9','Other Therapies','Other Therapies','<p><strong>Cupping</strong><br />
<span style=\"color:rgb(63, 63, 63); font-family:verdana,arial,helvetica,sans-serif; font-size:11px\">a technique in which the air in a jar is heated to create a vacuum and placed over the skin surface. It is used to treat conditions such as muscular pain and spasms, particularly on the back and shoulders.&nbsp;</span></p>

<p><img alt=\"\" src=\"https://dub116.mail.live.com/Handlers/ImageProxy.mvc?bicild=&amp;canary=7IAq%2by%2b%2flX%2bvwd5ojpspo4AEAZrVYak1xsAoKjh3wYo%3d0&amp;url=http%3a%2f%2fwww.herbsplus.co.uk%2fpics%2fmoxibustionsmall.jpg\" style=\"float:left; height:125px; line-height:15.62px; width:128px\" /><strong>Moxibustion</strong><br />
A technique which is nearly always incorporated into an acupuncture session involving burning herbs. It is very effective for acute and chronic pain, digestive upsets, period problems and infertility.<br />
&nbsp;</p>

<p><img alt=\"\" src=\"https://dub116.mail.live.com/Handlers/ImageProxy.mvc?bicild=&amp;canary=7IAq%2by%2b%2flX%2bvwd5ojpspo4AEAZrVYak1xsAoKjh3wYo%3d0&amp;url=http%3a%2f%2fwww.herbsplus.co.uk%2fpics%2freflexology.jpg\" style=\"float:left; height:125px; line-height:15.62px; width:128px\" /><strong>Reflexology</strong><br />
Chinese reflexology is a therapy based on holistic Chinese medical theory, which aims to restore balance between mind, body and emotions. Treatment involves specialist foot massage which can benefit many common ailments such as migraine, insomnia, digestive disorders, stress related conditions etc.</p>

<p><strong>E<img alt=\"\" src=\"https://dub116.mail.live.com/Handlers/ImageProxy.mvc?bicild=&amp;canary=7IAq%2by%2b%2flX%2bvwd5ojpspo4AEAZrVYak1xsAoKjh3wYo%3d0&amp;url=http%3a%2f%2fwww.herbsplus.co.uk%2fpics%2fearcandling.jpg\" style=\"float:left; height:125px; line-height:18.46px; width:128px\" />ar Candling</strong><br />
A natural, non-intrusive procedure that may help alleviate the painful effects of chronic headaches or sinus conditions, ear infections, allergies or vertigo, as well as minor hearing loss due to excessive wax.</p>

<p><br />
<strong>Allergy and Food Intolerance Testing</strong><br />
Test for over 100 food, drink and environmental substances. You will leave knowing exactly what you are sensitive to and how to avoid these in order to lead a more comfortable life. Your test will produce quick results and also includes a free vitamin and mineral deficiency check.</p>
','...','Other_therapies','','0','1','1','1462952756','1462952756','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('8','10','Doctors','Doctor','<p>Dr Tao Peng is an expert practitioner in Traditional Chinese Medicine (TCM) with over 20 years experience of treating people. He was trained from a young age by her Grandfather in Taiji (Internal Energy Work and Qi Gong (Internal Health, such as &#39;taiji yangsheng gong&#39;) and began learning Acupuncture and Chinese Herbal Medicine. He then went on to study at a leading Acupuncture and Traditional Chinese Medicine university in China. Since then he has followed several Masters to learn their special techniques in different fields. He is able to use his knowledge and skill to help with Depression, Infertility, Migraine, Insomnia, Pain Release, Shoulder Back Pain, Frozen Shoulder, Increasing Internal Energy, Improving Blood Circulation and Cancer, plus much more...</p>

<p>&nbsp;</p>

<div class=\"ecxsaying\" style=\"line-height: 22.4px; color: rgb(12, 129, 0); padding: 5px 5px 20px; font-family: Constantia, \'Lucida Bright\', Lucidabright, \'Lucida Serif\', Lucida, \'DejaVu Serif\', \'Bitstream Vera Serif\', \'Liberation Serif\', Georgia, serif; font-size: 16px;\">
<blockquote>
<h5>&ldquo;A good doctor must have a Mother&#39;s heart.&rdquo; &nbsp; &nbsp;<span style=\"font-size:0.8125rem\">&ndash;Ancient Chinese Proverb</span></h5>
</blockquote>

<div>&nbsp;</div>

<div>
<h4><span style=\"color:#000000\">We are full members of the following professional bodies:</span></h4>

<h5><span style=\"font-family:arial,helvetica,sans-serif\"><span style=\"color:#000000\"><strong>British Acupuncture Council</strong>&nbsp;- Full Member<br />
<strong>The Association of Traditional Chinese Medicine</strong>&nbsp;- Full Member<br />
<strong>The Royal Society of Medicine</strong>&nbsp;- Senior Member<br />
<strong>World Federation of Chinese Medicine Societies</strong>&nbsp;(WFCMS) - TCM Specialist<br />
<strong>Committee of TCM Clinic of WFCMS&nbsp;</strong>- Executive Council Member<br />
<strong>Tumor Chinese Medicine External Therapy of WFCMS</strong>&nbsp;- Executive Council Member</span></span><img src=\"https://dub116.mail.live.com/Handlers/ImageProxy.mvc?bicild=&amp;canary=7IAq%2by%2b%2flX%2bvwd5ojpspo4AEAZrVYak1xsAoKjh3wYo%3d0&amp;url=http%3a%2f%2fwww.contemporarychinesetherapy.com%2fimg%2finpage%2flogo_ALL.png\" style=\"border:0px; color:rgb(0, 77, 0); font-family:constantia,lucida bright,lucidabright,lucida serif,lucida,dejavu serif,bitstream vera serif,liberation serif,georgia,serif; font-size:16px; line-height:22.72px; vertical-align:middle; width:312px\" /></h5>
</div>
</div>
','doctors','doctors','','0','1','1','1462953583','1462956353','','');
INSERT INTO `blog_post` (`id`,`catalog_id`,`title`,`brief`,`content`,`tags`,`surname`,`banner`,`click`,`user_id`,`status`,`created_at`,`updated_at`,`keywords`,`description`) VALUES
('9','2','contacts','contacts','<p>Mobile:</p>

<p>&nbsp;</p>
','mobile','mobile','','0','1','1','1462953896','1463485275','keywords testing','descriptions testing');



-- -------------------------------------------
-- TABLE DATA blog_tag
-- -------------------------------------------
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('1','test','2');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('2','mytest','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('3','Acupuncture','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('4','Acupuncture London','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('5','Tuina Massage (Deep Tissue Medical Massage)','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('6','herbal therapy','1');
INSERT INTO `blog_tag` (`id`,`name`,`frequency`) VALUES
('7','petrel natural health','1');
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
('1111','11','siteName','text','','','Petrel Natural Health','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1112','11','siteTitle','text','','','Welcome To Panda Blog - Powered by epandaey','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1113','11','siteKeyword','text','','','website design, uk website design,','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1120','11','slogan','text','','','We guarantee that will provide you with certified,high quality, experienced care and service like in your own home.  ','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1505','15','contacter','text','','','Dr Tao','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1510','15','mobile','text','','','07460088881','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1520','15','phone','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1530','15','email','text','','','pengtao1688@hotmail.com','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1540','15','address','text','','','','50');
INSERT INTO `setting` (`id`,`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES
('1550','15','googlemap','text','','','','50');
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
('2102','21','template','text','','','health','50');
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
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`auth_role`,`role`,`status`,`created_at`,`updated_at`) VALUES
('1','admin','yg2Rwbcem7EwNNZ-rtgxRH7ZXG5kiwCf','$2y$13$Tp8wfyMS7Sa/ZAS5o/JfqO1PylnkkoT/hvXpB6./a.QOWMArDWhRa','6h1T981bPFIzuz7m4DGtNsP86zFVhwfT_1463109847','admin@demo.com','1','admin','1','1458761124','1463583769');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`auth_role`,`role`,`status`,`created_at`,`updated_at`) VALUES
('2','qiang','urHOjtnt-npSvGXM6sLxQ6BpXEKJ_Cmv','$2y$13$SngCkDe47nvuIgydPvwjROq/TVr2z4WdtSShqhWtTfIBWT6NzVSZC','V0ef-TyZtKitlD28ynvoXglkcIUGFAUM_1460930230','info@epandaeye.com','3','user','1','1460930230','1463579203');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
