

SET FOREIGN_KEY_CHECKS=0;


-- ----------------------------
-- Table structure for we_ip
-- ----------------------------
DROP TABLE IF EXISTS `we_ip`;
CREATE TABLE `we_ip` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `iip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `iuser` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
DROP TABLE IF EXISTS `we_user`;
CREATE TABLE `we_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for we_account
-- ----------------------------
DROP TABLE IF EXISTS `we_account`;
CREATE TABLE `we_account` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `aname` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `atoken` varchar(50) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  `aurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `FK_Relationship_4` (`u_id`),
  KEY `FK_Relationship_5` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_account
-- ----------------------------

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `we_session`;
CREATE TABLE `we_session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of session
-- ----------------------------

-- ----------------------------
-- Table structure for we_words
-- ----------------------------
DROP TABLE IF EXISTS `we_words`;
CREATE TABLE `we_words` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `w_name` varchar(50) DEFAULT NULL,
  `w_keywords` varchar(50) DEFAULT NULL,
  `w_content` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_words
-- ----------------------------

-- ----------------------------
-- Table structure for we_pictures
-- ----------------------------
DROP TABLE IF EXISTS `we_pictures`;
CREATE TABLE `we_pictures` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(50) DEFAULT NULL,
  `p_keywords` varchar(50) DEFAULT NULL,
  `p_content` varchar(50) DEFAULT NULL,
  `p_url` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `aid` int(11) DEFAULT NULL,
  `mediaid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_pictures
-- ----------------------------

-- ----------------------------
-- Table structure for we_voices
-- ----------------------------
DROP TABLE IF EXISTS `we_voices`;
CREATE TABLE `we_voices` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `v_name` varchar(50) DEFAULT NULL,
  `v_keywords` varchar(50) DEFAULT NULL,
  `v_content` varchar(50) DEFAULT NULL,
  `v_url` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `aid` int(11) DEFAULT NULL,
  `mediaid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_voices
-- ----------------------------