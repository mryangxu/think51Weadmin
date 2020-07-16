/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : manage

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-07-16 15:57:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_business_card
-- ----------------------------
DROP TABLE IF EXISTS `m_business_card`;
CREATE TABLE `m_business_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corporate_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '公司名称',
  `company_industry_id` int(11) NOT NULL COMMENT '公司行业id',
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '职位',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图',
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '背景图',
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详情',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  `visit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='名片';

-- ----------------------------
-- Records of m_business_card
-- ----------------------------
INSERT INTO `m_business_card` VALUES ('1', '亚索', '2147483647', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 16:01:24', '2020-07-13 16:01:24', null, '2');
INSERT INTO `m_business_card` VALUES ('2', '亚索', '2147483647', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:08:55', '2020-07-13 17:08:55', null, '0');
INSERT INTO `m_business_card` VALUES ('3', '亚索', '2147483647', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:09:02', '2020-07-13 17:09:02', null, '0');
INSERT INTO `m_business_card` VALUES ('4', '亚索', '2147483647', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:09:02', '2020-07-13 17:09:02', null, '0');
INSERT INTO `m_business_card` VALUES ('5', '亚索', '2147483647', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:09:03', '2020-07-13 17:09:03', null, '0');
INSERT INTO `m_business_card` VALUES ('6', '亚索', '13368396227', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:09:32', '2020-07-13 17:09:32', null, '0');
INSERT INTO `m_business_card` VALUES ('7', '亚索', '13368396227', '腾讯', '1', 'ceo', '清华毕业生,ceo，大众', '123123', '1232123', '发生发士大夫撒旦范德萨发撒打发打赏', '2020-07-13 17:11:40', '2020-07-13 17:11:40', null, '0');

-- ----------------------------
-- Table structure for m_industry
-- ----------------------------
DROP TABLE IF EXISTS `m_industry`;
CREATE TABLE `m_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='行业';

-- ----------------------------
-- Records of m_industry
-- ----------------------------
INSERT INTO `m_industry` VALUES ('1', '通讯', '2020-07-13 16:33:45', '2020-07-13 16:33:45', '2020-07-13 16:34:03');
INSERT INTO `m_industry` VALUES ('2', '服务', '2020-07-13 16:33:53', '2020-07-13 16:33:53', null);
INSERT INTO `m_industry` VALUES ('3', '服装', '2020-07-13 16:33:59', '2020-07-13 16:33:59', null);
INSERT INTO `m_industry` VALUES ('4', '通讯', '2020-07-13 17:13:07', '2020-07-13 17:13:07', null);
INSERT INTO `m_industry` VALUES ('5', '旅游/出行', '2020-07-15 09:30:33', '2020-07-15 09:30:33', '2020-07-15 09:51:05');

-- ----------------------------
-- Table structure for m_manage_user
-- ----------------------------
DROP TABLE IF EXISTS `m_manage_user`;
CREATE TABLE `m_manage_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `delete_at` datetime DEFAULT NULL,
  `prev_login_at` datetime DEFAULT NULL,
  `prev_login_ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员';

-- ----------------------------
-- Records of m_manage_user
-- ----------------------------
INSERT INTO `m_manage_user` VALUES ('1', 'admin', 'admin', '1', 'cdf6/jZHo3AqolH9yEudIkhPXz7LjnozaWRwWz82', '2020-07-13 15:49:31', '2020-07-14 18:01:58', null, '2020-07-15 15:45:45', '127.0.0.1');
INSERT INTO `m_manage_user` VALUES ('2', 'edit', '德玛西亚', '2', '7a0cijowVVIDPbcj79RZjsGOMEtjokMQGka5dK+8PAgmcw', '2020-07-13 17:39:05', '2020-07-15 14:51:19', null, '2020-07-15 15:44:16', '127.0.0.1');
INSERT INTO `m_manage_user` VALUES ('3', '1', '1', '4', '2d300rsXkfvLZVi/dBLeFY8dNL3urBcTp/OR13iXdYxzRg', '2020-07-14 17:50:05', '2020-07-15 14:53:56', null, '2020-07-15 14:54:05', '127.0.0.1');
INSERT INTO `m_manage_user` VALUES ('4', '1234', '243', '2', '2902osHisYcPxVLYQg9b5JFoK9cEpfLxyArtF8F6qSeukQ', '2020-07-14 18:07:14', '2020-07-14 18:07:26', '2020-07-15 09:52:02', null, null);

-- ----------------------------
-- Table structure for m_message
-- ----------------------------
DROP TABLE IF EXISTS `m_message`;
CREATE TABLE `m_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  `business_card_id` int(11) NOT NULL COMMENT '名片id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='留言';

-- ----------------------------
-- Records of m_message
-- ----------------------------
INSERT INTO `m_message` VALUES ('1', '哈哈哈哈 ，真好看', '2020-07-13 18:18:11', null, '1');
INSERT INTO `m_message` VALUES ('2', '哈哈哈哈 ，真好看', '2020-07-13 18:18:13', null, '1');
INSERT INTO `m_message` VALUES ('3', '哈哈哈哈 ，真好看', '2020-07-13 18:18:14', null, '1');
INSERT INTO `m_message` VALUES ('4', '哈哈哈哈 ，真好看', '2020-07-13 18:18:14', null, '1');
INSERT INTO `m_message` VALUES ('5', '哈哈哈哈 ，真好看', '2020-07-13 18:18:15', null, '1');
INSERT INTO `m_message` VALUES ('6', '哈哈哈哈 ，真好看', '2020-07-13 18:18:15', null, '1');
INSERT INTO `m_message` VALUES ('7', '哈哈哈哈 ，真好看', '2020-07-13 18:18:16', null, '1');
INSERT INTO `m_message` VALUES ('8', '哈哈哈哈 ，真好看', '2020-07-13 18:18:16', null, '1');

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '层级',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色';

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES ('1', '超级管理员', '0', '0', '2020-07-13 15:29:39', '2020-07-15 14:51:08', null);
INSERT INTO `m_role` VALUES ('2', '小小编', '0', '0', '2020-07-13 15:29:54', '2020-07-15 14:47:38', null);
INSERT INTO `m_role` VALUES ('3', '小小编111', '0', '0', '2020-07-13 15:40:45', '2020-07-13 15:40:45', '2020-07-15 09:51:55');
INSERT INTO `m_role` VALUES ('4', '测试人员', '1', '1', '2020-07-15 11:49:42', '2020-07-15 14:53:30', null);
INSERT INTO `m_role` VALUES ('5', '123', '1', '1', '2020-07-15 11:50:06', '2020-07-15 11:50:06', '2020-07-15 14:53:08');
INSERT INTO `m_role` VALUES ('6', '1234', '1', '1', '2020-07-15 11:50:26', '2020-07-15 11:50:26', '2020-07-15 14:53:08');

-- ----------------------------
-- Table structure for m_role_rule
-- ----------------------------
DROP TABLE IF EXISTS `m_role_rule`;
CREATE TABLE `m_role_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色规则关联';

-- ----------------------------
-- Records of m_role_rule
-- ----------------------------
INSERT INTO `m_role_rule` VALUES ('5', '3', '1');
INSERT INTO `m_role_rule` VALUES ('6', '3', '2');
INSERT INTO `m_role_rule` VALUES ('16', '5', '1');
INSERT INTO `m_role_rule` VALUES ('17', '5', '2');
INSERT INTO `m_role_rule` VALUES ('18', '5', '3');
INSERT INTO `m_role_rule` VALUES ('19', '5', '4');
INSERT INTO `m_role_rule` VALUES ('20', '5', '5');
INSERT INTO `m_role_rule` VALUES ('21', '5', '6');
INSERT INTO `m_role_rule` VALUES ('22', '5', '7');
INSERT INTO `m_role_rule` VALUES ('23', '5', '8');
INSERT INTO `m_role_rule` VALUES ('24', '5', '9');
INSERT INTO `m_role_rule` VALUES ('25', '5', '10');
INSERT INTO `m_role_rule` VALUES ('26', '5', '11');
INSERT INTO `m_role_rule` VALUES ('27', '5', '12');
INSERT INTO `m_role_rule` VALUES ('28', '5', '13');
INSERT INTO `m_role_rule` VALUES ('29', '6', '1');
INSERT INTO `m_role_rule` VALUES ('30', '6', '2');
INSERT INTO `m_role_rule` VALUES ('31', '6', '3');
INSERT INTO `m_role_rule` VALUES ('32', '6', '4');
INSERT INTO `m_role_rule` VALUES ('33', '6', '5');
INSERT INTO `m_role_rule` VALUES ('34', '6', '6');
INSERT INTO `m_role_rule` VALUES ('35', '6', '7');
INSERT INTO `m_role_rule` VALUES ('36', '6', '8');
INSERT INTO `m_role_rule` VALUES ('37', '6', '9');
INSERT INTO `m_role_rule` VALUES ('38', '6', '10');
INSERT INTO `m_role_rule` VALUES ('39', '6', '11');
INSERT INTO `m_role_rule` VALUES ('40', '6', '12');
INSERT INTO `m_role_rule` VALUES ('41', '6', '13');
INSERT INTO `m_role_rule` VALUES ('156', '2', '14');
INSERT INTO `m_role_rule` VALUES ('157', '2', '15');
INSERT INTO `m_role_rule` VALUES ('158', '2', '16');
INSERT INTO `m_role_rule` VALUES ('159', '2', '17');
INSERT INTO `m_role_rule` VALUES ('160', '2', '18');
INSERT INTO `m_role_rule` VALUES ('161', '2', '19');
INSERT INTO `m_role_rule` VALUES ('162', '2', '20');
INSERT INTO `m_role_rule` VALUES ('163', '2', '21');
INSERT INTO `m_role_rule` VALUES ('164', '2', '22');
INSERT INTO `m_role_rule` VALUES ('165', '2', '23');
INSERT INTO `m_role_rule` VALUES ('166', '1', '1');
INSERT INTO `m_role_rule` VALUES ('167', '1', '2');
INSERT INTO `m_role_rule` VALUES ('168', '1', '3');
INSERT INTO `m_role_rule` VALUES ('169', '1', '4');
INSERT INTO `m_role_rule` VALUES ('170', '1', '5');
INSERT INTO `m_role_rule` VALUES ('171', '1', '6');
INSERT INTO `m_role_rule` VALUES ('172', '1', '7');
INSERT INTO `m_role_rule` VALUES ('173', '1', '8');
INSERT INTO `m_role_rule` VALUES ('174', '1', '9');
INSERT INTO `m_role_rule` VALUES ('175', '1', '10');
INSERT INTO `m_role_rule` VALUES ('176', '1', '11');
INSERT INTO `m_role_rule` VALUES ('177', '1', '12');
INSERT INTO `m_role_rule` VALUES ('178', '1', '13');
INSERT INTO `m_role_rule` VALUES ('179', '1', '14');
INSERT INTO `m_role_rule` VALUES ('180', '1', '15');
INSERT INTO `m_role_rule` VALUES ('181', '1', '16');
INSERT INTO `m_role_rule` VALUES ('182', '1', '17');
INSERT INTO `m_role_rule` VALUES ('183', '1', '18');
INSERT INTO `m_role_rule` VALUES ('184', '1', '19');
INSERT INTO `m_role_rule` VALUES ('185', '1', '20');
INSERT INTO `m_role_rule` VALUES ('186', '1', '21');
INSERT INTO `m_role_rule` VALUES ('187', '1', '22');
INSERT INTO `m_role_rule` VALUES ('188', '1', '23');
INSERT INTO `m_role_rule` VALUES ('189', '1', '24');
INSERT INTO `m_role_rule` VALUES ('190', '4', '1');
INSERT INTO `m_role_rule` VALUES ('191', '4', '6');
INSERT INTO `m_role_rule` VALUES ('192', '4', '7');
INSERT INTO `m_role_rule` VALUES ('193', '4', '8');
INSERT INTO `m_role_rule` VALUES ('194', '4', '9');
INSERT INTO `m_role_rule` VALUES ('195', '4', '19');
INSERT INTO `m_role_rule` VALUES ('196', '4', '20');
INSERT INTO `m_role_rule` VALUES ('197', '4', '21');
INSERT INTO `m_role_rule` VALUES ('198', '4', '22');
INSERT INTO `m_role_rule` VALUES ('199', '4', '23');
INSERT INTO `m_role_rule` VALUES ('200', '4', '24');

-- ----------------------------
-- Table structure for m_rule
-- ----------------------------
DROP TABLE IF EXISTS `m_rule`;
CREATE TABLE `m_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单名',
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图标',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '层级',
  `rule` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则',
  `sort` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menu' COMMENT '类型',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='规则';

-- ----------------------------
-- Records of m_rule
-- ----------------------------
INSERT INTO `m_rule` VALUES ('1', '权限管理', '&#xe70b;', '0', '0', 'index/rule', '1', 'menu', '2020-07-13 14:42:21', '2020-07-14 16:49:35', null);
INSERT INTO `m_rule` VALUES ('2', '规则管理', '&#xe70b;', '1', '1', 'index/rule', '1', 'menu', '2020-07-13 14:43:40', '2020-07-13 14:43:40', null);
INSERT INTO `m_rule` VALUES ('3', '查看', '&#xe70b;', '2', '2', 'rule/lists', '1', 'file', '2020-07-13 14:44:15', '2020-07-13 14:44:15', null);
INSERT INTO `m_rule` VALUES ('4', '编辑', '&#xe70b;', '2', '2', 'rule/edit', '1', 'file', '2020-07-13 14:44:37', '2020-07-13 14:44:37', null);
INSERT INTO `m_rule` VALUES ('5', '删除', '&#xe70b;', '2', '2', 'rule/del', '1', 'file', '2020-07-13 14:44:51', '2020-07-13 14:44:51', null);
INSERT INTO `m_rule` VALUES ('6', '管理员管理', '&#xe70b;', '1', '1', 'index/manage_user', '1', 'menu', '2020-07-13 14:46:34', '2020-07-13 14:46:34', null);
INSERT INTO `m_rule` VALUES ('7', '查看', '&#xe70b;', '6', '2', 'auth/manage/lists', '1', 'file', '2020-07-13 14:47:40', '2020-07-13 14:47:40', null);
INSERT INTO `m_rule` VALUES ('8', '编辑', '&#xe70b;', '6', '2', 'auth/manage/edit', '1', 'file', '2020-07-13 14:47:55', '2020-07-13 14:47:55', null);
INSERT INTO `m_rule` VALUES ('9', '删除', '&#xe70b;', '6', '2', 'auth/manage/del', '1', 'file', '2020-07-13 14:48:05', '2020-07-13 14:48:05', null);
INSERT INTO `m_rule` VALUES ('10', '角色组管理', '&#xe70b;', '1', '1', 'index/role', '1', 'menu', '2020-07-13 14:50:53', '2020-07-13 14:50:53', null);
INSERT INTO `m_rule` VALUES ('11', '查看', '&#xe70b;', '10', '2', 'auth/role/lists', '1', 'file', '2020-07-13 14:51:32', '2020-07-13 14:51:32', null);
INSERT INTO `m_rule` VALUES ('12', '编辑', '&#xe70b;', '10', '2', 'auth/role/edit', '1', 'file', '2020-07-13 14:51:51', '2020-07-13 14:51:51', null);
INSERT INTO `m_rule` VALUES ('13', '删除', '&#xe70b;', '10', '2', 'auth/role/del', '1', 'file', '2020-07-13 14:51:57', '2020-07-13 14:51:57', null);
INSERT INTO `m_rule` VALUES ('14', '名片管理', '&#xe70b;', '0', '0', 'index/business_card', '1', 'menu', '2020-07-13 14:53:37', '2020-07-13 14:53:37', null);
INSERT INTO `m_rule` VALUES ('15', '名片列表', '&#xe70b;', '14', '1', 'index/business_card', '1', 'menu', '2020-07-13 14:54:38', '2020-07-14 20:41:29', null);
INSERT INTO `m_rule` VALUES ('16', '默认背景', '&#xe70b;', '14', '1', 'index/defaults', '1', 'menu', '2020-07-13 14:55:15', '2020-07-14 20:41:41', null);
INSERT INTO `m_rule` VALUES ('17', '行业管理', '&#xe70b;', '0', '0', 'index/industry', '1', 'menu', '2020-07-13 14:55:57', '2020-07-14 20:42:09', null);
INSERT INTO `m_rule` VALUES ('18', '行业列表', '&#xe70b;', '17', '1', 'index/industry', '1', 'menu', '2020-07-13 14:56:34', '2020-07-14 20:42:23', null);
INSERT INTO `m_rule` VALUES ('19', '商会管理', '&#xe70b;', '0', '0', 'index/introduce', '1', 'menu', '2020-07-13 14:58:07', '2020-07-13 14:58:07', null);
INSERT INTO `m_rule` VALUES ('20', '商会介绍', 'a', '19', '1', 'index/introduce', '1', 'menu', '2020-07-14 20:43:27', '2020-07-14 20:43:27', null);
INSERT INTO `m_rule` VALUES ('21', '个人设置', '&#xe70b;', '0', '0', 'index/update_pass', '1', 'menu', '2020-07-13 14:58:55', '2020-07-13 14:58:55', null);
INSERT INTO `m_rule` VALUES ('22', '修改密码', '&#xe70b;', '21', '1', 'index/update_pass', '1', 'menu', '2020-07-13 14:59:14', '2020-07-13 14:59:14', null);
INSERT INTO `m_rule` VALUES ('23', '查看', '&#xe70b;', '22', '2', 'seting/seting/info', '1', 'file', '2020-07-13 15:00:01', '2020-07-13 15:00:01', null);
INSERT INTO `m_rule` VALUES ('24', '修改', '&#xe70b;', '22', '2', 'seting/seting/update', '1', 'file', '2020-07-13 15:00:11', '2020-07-13 15:00:11', null);

-- ----------------------------
-- Table structure for m_system_conf
-- ----------------------------
DROP TABLE IF EXISTS `m_system_conf`;
CREATE TABLE `m_system_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default_background_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '默认背景',
  `introduce` text COLLATE utf8mb4_unicode_ci COMMENT '商会介绍',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置\r\n';

-- ----------------------------
-- Records of m_system_conf
-- ----------------------------
INSERT INTO `m_system_conf` VALUES ('1', '/uploads/img/20200713/29d0f365dbcf3e29df966107369e4b5b.jpg', '<p style=\"white-space: normal; text-indent: 32px; padding: 0px; line-height: 24px; background: rgb(255, 255, 255);\"><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 14px; letter-spacing: 0px;\">重庆市江北区工商联（总商会）青年委员会于2016年5月正式成立，通过四年来的发展壮大，现拥有一百余家会员企业，是以全区工商界青年企业家、非公企业出资人子女、规模以上非公有制企业青年高层管理者及海归精英等为主体自愿组成的联合性、非营利性组织，是我区非公有制经济代表人士后备队伍,是区工商联（总商会）的专委会组织。会员中从事第一、二产业占比27%，第三产业占比73%以上，会员企业总年产值逾百亿。</span><br/></p><p style=\"white-space: normal; text-indent: 32px; padding: 0px; line-height: 24px; background: rgb(255, 255, 255);\"><span style=\"letter-spacing: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; padding: 0px; line-height: 24px; background: rgb(255, 255, 255);\"><span style=\"letter-spacing: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;江北区青委会以＂创新、互助，共聚、共享＂为共同愿景；以服务青年企业家，打造江北区青年精英聚合地为宗旨；以倡导发扬＂善其身、勤治业、济天下＂的青年企业家精神为核心价值观；引导会员健康成长，促进会员企业健康发展，结合会员实际，开展了丰富多彩的各类主题活动，全体青年企业家通力协作，发挥自身优势，实现了青委会的从无到有，从小到大。</span></p><p style=\"white-space: normal; padding: 0px; line-height: 24px; background: rgb(255, 255, 255);\"><span style=\"letter-spacing: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 14px;\"><br/></span></p><p style=\"white-space: normal; padding: 0px; line-height: 24px; background: rgb(255, 255, 255);\"><span style=\"letter-spacing: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;本会同时也是提供加强联系、增进了解、团结互助、共同发展的平台。了解青年会员的需求、解决青年会员的困难，聘请名誉顾问、创业导师、名誉会长等，为会员搭建教育成长平台，为青年会员在各领域取得长足发展发挥积极促进作用。</span></p><p style=\"white-space: normal;\"><span style=\"color: rgb(40, 40, 40); font-family: &quot;Microsoft YaHei&quot;, Arial, Helvetica, sans-serif; text-indent: 36px; background-color: rgb(255, 255, 255); font-size: 10px;\"><br/></span></p><p style=\"white-space: normal; text-align: center;\"><br/></p><p style=\"white-space: normal; text-align: center;\"><span style=\"color: rgb(40, 40, 40); font-family: &quot;Microsoft YaHei&quot;, Arial, Helvetica, sans-serif; text-indent: 36px; background-color: rgb(255, 255, 255); font-size: 10px;\"><img src=\"/ueditor/php/upload/image/20200715/1594778741.jpg\" title=\"1591684314111826.jpg\" alt=\"青委会Logo源文件.jpg\" width=\"292\" height=\"291\"/></span></p><p><span style=\"color: rgb(40, 40, 40); font-family: &quot;Microsoft YaHei&quot;, Arial, Helvetica, sans-serif; text-indent: 36px; background-color: rgb(255, 255, 255); font-size: 10px;\"><br/></span></p><p><br/></p>');
