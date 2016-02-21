/*
Navicat MySQL Data Transfer
Source Host     : localhost:3306
Source Database : codechargecalendar
Target Host     : localhost:3306
Target Database : codechargecalendar
Date: 2011-03-12 17:40:14
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for log_changes
-- ----------------------------
DROP TABLE IF EXISTS `log_changes`;
CREATE TABLE `log_changes` (
  `change_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `module` varchar(20) DEFAULT NULL,
  `screen` varchar(50) DEFAULT NULL,
  `db_table` varchar(50) DEFAULT NULL,
  `primary_key` varchar(50) DEFAULT NULL,
  `db_field` varchar(50) DEFAULT NULL,
  `original_value` varchar(255) DEFAULT NULL,
  `new_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`change_datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_changes
-- ----------------------------

-- ----------------------------
-- Table structure for log_users
-- ----------------------------
DROP TABLE IF EXISTS `log_users`;
CREATE TABLE `log_users` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_session_id` varchar(50) NOT NULL,
  `log_site` varchar(100) NOT NULL,
  `log_user_id` int(11) DEFAULT '0',
  `log_login_id` varchar(75) NOT NULL,
  `log_timestamp` datetime NOT NULL,
  `log_ip` char(15) DEFAULT NULL,
  `log_last_active` datetime NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_id` (`log_id`),
  KEY `log_user_id` (`log_user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_users
-- ----------------------------
INSERT INTO `log_users` VALUES ('1', '9822ljkqh7bnikfcqm90el7577', 'CodeChargeCalendar', '1', 'admin', '2011-02-10 09:23:44', '127.0.0.1', '2011-02-10 09:23:44');

-- ----------------------------
-- Table structure for lu_calendars_times
-- ----------------------------
DROP TABLE IF EXISTS `lu_calendars_times`;
CREATE TABLE `lu_calendars_times` (
  `id` time NOT NULL DEFAULT '00:00:00',
  `time` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `HHiiSS` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of lu_calendars_times
-- ----------------------------
INSERT INTO `lu_calendars_times` VALUES ('00:00:00', '12:00 AM', '000000'), ('01:00:00', '1:00 AM', '010000'), ('02:00:00', '2:00 AM', '020000'), ('03:00:00', '3:00 AM', '030000'), ('04:00:00', '4:00 AM', '040000'), ('05:00:00', '5:00 AM', '050000'), ('06:00:00', '6:00 AM', '060000'), ('07:00:00', '7:00 AM', '070000'), ('08:00:00', '8:00 AM', '080000'), ('09:00:00', '9:00 AM', '090000'), ('10:00:00', '10:00 AM', '100000'), ('11:00:00', '11:00 AM', '110000'), ('12:00:00', '12:00 PM', '120000'), ('13:00:00', '1:00 PM', '130000'), ('14:00:00', '2:00 PM', '140000'), ('15:00:00', '3:00 PM', '150000'), ('16:00:00', '4:00 PM', '160000'), ('17:00:00', '5:00 PM', '170000'), ('18:00:00', '6:00 PM', '180000'), ('19:00:00', '7:00 PM', '190000'), ('20:00:00', '8:00 PM', '200000'), ('21:00:00', '9:00 PM', '210000'), ('22:00:00', '10:00 PM', '220000'), ('23:00:00', '11:00 PM', '230000'), ('00:15:00', '12:15 AM', '001500'), ('00:30:00', '12:30 AM', '003000'), ('00:45:00', '12:45 AM', '004500'), ('01:15:00', '1:15 AM', '011500'), ('01:30:00', '1:30 AM', '013000'), ('01:45:00', '1:45 AM', '014500'), ('02:15:00', '2:15 AM', '021500'), ('02:30:00', '2:30 AM', '023000'), ('02:45:00', '2:45 AM', '024500'), ('03:15:00', '3:15 AM', '031500'), ('03:30:00', '3:30 AM', '033000'), ('03:45:00', '3:45 AM', '034500'), ('04:15:00', '4:15 AM', '041500'), ('04:30:00', '4:30 AM', '043000'), ('04:45:00', '4:45 AM', '044500'), ('05:15:00', '5:15 AM', '051500'), ('05:30:00', '5:30 AM', '053000'), ('05:45:00', '5:45 AM', '054500'), ('06:15:00', '6:15 AM', '061500'), ('06:30:00', '6:30 AM', '063000'), ('06:45:00', '6:45 AM', '064500'), ('07:15:00', '7:15 AM', '071500'), ('07:30:00', '7:30 AM', '073000'), ('07:45:00', '7:45 AM', '074500'), ('08:15:00', '8:15 AM', '081500'), ('08:30:00', '8:30 AM', '083000'), ('08:45:00', '8:45 AM', '084500'), ('09:15:00', '9:15 AM', '091500'), ('09:30:00', '9:30 AM', '093000'), ('09:45:00', '9:45 AM', '094500'), ('10:15:00', '10:15 AM', '101500'), ('10:30:00', '10:30 AM', '103000'), ('10:45:00', '10:45 AM', '104500'), ('11:15:00', '11:15 AM', '111500'), ('11:30:00', '11:30 AM', '113000'), ('11:45:00', '11:45 AM', '114500'), ('12:15:00', '12:15 PM', '121500'), ('12:30:00', '12:30 PM', '123000'), ('12:45:00', '12:45 PM', '124500'), ('13:15:00', '1:15 PM', '131500'), ('13:30:00', '1:30 PM', '133000'), ('13:45:00', '1:45 PM', '134500'), ('14:15:00', '2:15 PM', '141500'), ('14:30:00', '2:30 PM', '143000'), ('14:45:00', '2:45 PM', '144500'), ('15:15:00', '3:15 PM', '151500'), ('15:30:00', '3:30 PM', '153000'), ('15:45:00', '3:45 PM', '154500'), ('16:15:00', '4:15 PM', '161500'), ('16:30:00', '4:30 PM', '163000'), ('16:45:00', '4:45 PM', '164500'), ('17:15:00', '5:15 PM', '171500'), ('17:30:00', '5:30 PM', '173000'), ('17:45:00', '5:45 PM', '174500'), ('18:15:00', '6:15 PM', '181500'), ('18:30:00', '6:30 PM', '183000'), ('18:45:00', '6:45 PM', '184500'), ('19:15:00', '7:15 PM', '191500'), ('19:30:00', '7:30 PM', '193000'), ('19:45:00', '7:45 PM', '194500'), ('20:15:00', '8:15 PM', '201500'), ('20:30:00', '8:30 PM', '203000'), ('20:45:00', '8:45 PM', '204500'), ('21:15:00', '9:15 PM', '211500'), ('21:30:00', '9:30 PM', '213000'), ('21:45:00', '9:45 PM', '214500'), ('22:15:00', '10:15 PM', '221500'), ('22:30:00', '10:30 PM', '223000'), ('22:45:00', '10:45 PM', '224500'), ('23:15:00', '11:15 PM', '231500'), ('23:30:00', '11:30 PM', '233000'), ('23:45:00', '11:45 PM', '234500');

-- ----------------------------
-- Table structure for lu_countries
-- ----------------------------
DROP TABLE IF EXISTS `lu_countries`;
CREATE TABLE `lu_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` char(40) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_countries
-- ----------------------------
INSERT INTO `lu_countries` VALUES ('1', 'United States'), ('2', 'Canada'), ('3', 'Afghanistan'), ('4', 'Albania'), ('5', 'Algeria'), ('6', 'American Samoa'), ('7', 'Andorra'), ('8', 'Angola'), ('9', 'Anguilla'), ('10', 'Antarctica'), ('11', 'Antigua and Barbuda'), ('12', 'Argentina'), ('13', 'Armenia'), ('14', 'Aruba'), ('15', 'Australia'), ('16', 'Austria'), ('17', 'Azerbaijan'), ('18', 'Bahamas'), ('19', 'Bahrain'), ('20', 'Bangladesh'), ('21', 'Barbados'), ('22', 'Belarus'), ('23', 'Belgium'), ('24', 'Belize'), ('25', 'Benin'), ('26', 'Bermuda'), ('27', 'Bhutan'), ('28', 'Bolivia'), ('29', 'Bosnia and Herzegovina'), ('30', 'Botswana'), ('31', 'Bouvet Island'), ('32', 'Brazil'), ('33', 'British Indian Ocean Territory'), ('34', 'British Virgin Islands'), ('35', 'Brunei'), ('36', 'Bulgaria'), ('37', 'Burkina Faso'), ('38', 'Burundi'), ('39', 'Cambodia'), ('40', 'Cameroon'), ('41', 'Cape Verde'), ('42', 'Cayman Islands'), ('43', 'Central African Republic'), ('44', 'Chad'), ('45', 'Chile'), ('46', 'China'), ('47', 'Christmas Island'), ('48', 'Cocos Islands'), ('49', 'Colombia'), ('50', 'Comoros'), ('51', 'Congo'), ('52', 'Cook Islands'), ('53', 'Costa Rica'), ('54', 'Croatia'), ('55', 'Cuba'), ('56', 'Cyprus'), ('57', 'Czech Republic'), ('58', 'Denmark'), ('59', 'Djibouti'), ('60', 'Dominica'), ('61', 'Dominican Republic'), ('62', 'East Timor'), ('63', 'Ecuador'), ('64', 'Egypt'), ('65', 'El Salvador'), ('66', 'Equatorial Guinea'), ('67', 'Eritrea'), ('68', 'Estonia'), ('69', 'Ethiopia'), ('70', 'Falkland Islands'), ('71', 'Faroe Islands'), ('72', 'Fiji'), ('73', 'Finland'), ('74', 'France'), ('75', 'French Guiana'), ('76', 'French Polynesia'), ('77', 'French Southern Territories'), ('78', 'Gabon'), ('79', 'Gambia'), ('80', 'Georgia'), ('81', 'Germany'), ('82', 'Ghana'), ('83', 'Gibraltar'), ('84', 'Greece'), ('85', 'Greenland'), ('86', 'Grenada'), ('87', 'Guadeloupe'), ('88', 'Guam'), ('89', 'Guatemala'), ('90', 'Guinea'), ('91', 'Guinea-Bissau'), ('92', 'Guyana'), ('93', 'Haiti'), ('94', 'Heard and McDonald Islands'), ('95', 'Honduras'), ('96', 'Hong Kong'), ('97', 'Hungary'), ('98', 'Iceland'), ('99', 'India'), ('100', 'Indonesia'), ('101', 'Iran');
INSERT INTO `lu_countries` VALUES ('102', 'Iraq'), ('103', 'Ireland'), ('104', 'Israel'), ('105', 'Italy'), ('106', 'Ivory Coast'), ('107', 'Jamaica'), ('108', 'Japan'), ('109', 'Jordan'), ('110', 'Kazakhstan'), ('111', 'Kenya'), ('112', 'Kiribati'), ('113', 'North Korea'), ('114', 'South Korea'), ('115', 'Kuwait'), ('116', 'Kyrgyzstan'), ('117', 'Laos'), ('118', 'Latvia'), ('119', 'Lebanon'), ('120', 'Lesotho'), ('121', 'Liberia'), ('122', 'Libya'), ('123', 'Liechtenstein'), ('124', 'Lithuania'), ('125', 'Luxembourg'), ('126', 'Macau'), ('127', 'Macedonia'), ('128', 'Madagascar'), ('129', 'Malawi'), ('130', 'Malaysia'), ('131', 'Maldives'), ('132', 'Mali'), ('133', 'Malta'), ('134', 'Marshall Islands'), ('135', 'Martinique'), ('136', 'Mauritania'), ('137', 'Mauritius'), ('138', 'Mayotte'), ('139', 'Mexico'), ('140', 'Micronesia'), ('141', 'Moldova'), ('142', 'Monaco'), ('143', 'Mongolia'), ('144', 'Montserrat'), ('145', 'Morocco'), ('146', 'Mozambique'), ('147', 'Myanmar'), ('148', 'Namibia'), ('149', 'Nauru'), ('150', 'Nepal'), ('151', 'Netherlands'), ('152', 'Netherlands Antilles'), ('153', 'New Caledonia'), ('154', 'New Zealand'), ('155', 'Nicaragua'), ('156', 'Niger'), ('157', 'Nigeria'), ('158', 'Niue'), ('159', 'Norfolk Island'), ('160', 'Northern Mariana Islands'), ('161', 'Norway'), ('162', 'Oman'), ('163', 'Pakistan'), ('164', 'Palau'), ('165', 'Panama'), ('166', 'Papua New Guinea'), ('167', 'Paraguay'), ('168', 'Peru'), ('169', 'Philippines'), ('170', 'Pitcairn Island'), ('171', 'Poland'), ('172', 'Portugal'), ('173', 'Puerto Rico'), ('174', 'Qatar'), ('175', 'Reunion'), ('176', 'Romania'), ('177', 'Russia'), ('178', 'Rwanda'), ('179', 'S. Georgia and S. Sandwich Isls.'), ('180', 'Saint Kitts & Nevis'), ('181', 'Saint Lucia'), ('182', 'Saint Vincent and The Grenadines'), ('183', 'Samoa'), ('184', 'San Marino'), ('185', 'Sao Tome and Principe'), ('186', 'Saudi Arabia'), ('187', 'Senegal'), ('188', 'Seychelles'), ('189', 'Sierra Leone'), ('190', 'Singapore'), ('191', 'Slovakia'), ('192', 'Slovenia'), ('193', 'Somalia'), ('194', 'South Africa'), ('195', 'Spain'), ('196', 'Sri Lanka'), ('197', 'St. Helena'), ('198', 'St. Pierre and Miquelon'), ('199', 'Sudan'), ('200', 'Suriname');
INSERT INTO `lu_countries` VALUES ('201', 'Svalbard and Jan Mayen Islands'), ('202', 'Swaziland'), ('203', 'Sweden'), ('204', 'Switzerland'), ('205', 'Syria'), ('206', 'Taiwan'), ('207', 'Tajikistan'), ('208', 'Tanzania'), ('209', 'Thailand'), ('210', 'Togo'), ('211', 'Tokelau'), ('212', 'Tonga'), ('213', 'Trinidad and Tobago'), ('214', 'Tunisia'), ('215', 'Turkey'), ('216', 'Turkmenistan'), ('217', 'Turks and Caicos Islands'), ('218', 'Tuvalu'), ('219', 'U.S. Minor Outlying Islands'), ('220', 'Uganda'), ('221', 'Ukraine'), ('222', 'United Arab Emirates'), ('223', 'United Kingdom'), ('224', 'Uruguay'), ('225', 'Uzbekistan'), ('226', 'Vanuatu'), ('227', 'Vatican City'), ('228', 'Venezuela'), ('229', 'Vietnam'), ('230', 'Virgin Islands'), ('231', 'Wallis and Futuna Islands'), ('232', 'Western Sahara'), ('233', 'Yemen'), ('234', 'Serbia and Montenegro'), ('235', 'Zaire'), ('236', 'Zambia'), ('237', 'Zimbabwe');

-- ----------------------------
-- Table structure for lu_locales
-- ----------------------------
DROP TABLE IF EXISTS `lu_locales`;
CREATE TABLE `lu_locales` (
  `locale` varchar(2) NOT NULL,
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_locales
-- ----------------------------
INSERT INTO `lu_locales` VALUES ('en', 'English'), ('es', 'Spanish');

-- ----------------------------
-- Table structure for lu_prefix
-- ----------------------------
DROP TABLE IF EXISTS `lu_prefix`;
CREATE TABLE `lu_prefix` (
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_prefix
-- ----------------------------
INSERT INTO `lu_prefix` VALUES ('Capt.'), ('Dr.'), ('Miss'), ('Mr.'), ('Mrs.'), ('Ms.'), ('Prof.'), ('Rev.');

-- ----------------------------
-- Table structure for lu_states
-- ----------------------------
DROP TABLE IF EXISTS `lu_states`;
CREATE TABLE `lu_states` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` char(25) DEFAULT NULL,
  `abbrv` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_states
-- ----------------------------
INSERT INTO `lu_states` VALUES ('1', 'Alaska', 'AK'), ('2', 'Alabama', 'AL'), ('3', 'Arkansas', 'AR'), ('4', 'American Samoa', null), ('5', 'Arizona', 'AZ'), ('6', 'California', 'CA'), ('7', 'Colorado', 'CO'), ('8', 'Connecticut', 'CT'), ('9', 'District of Columbia', 'DC'), ('10', 'Delaware', 'DE'), ('11', 'Florida', 'FL'), ('12', 'Georgia', 'GA'), ('13', 'Guam', null), ('14', 'Hawaii', 'HI'), ('15', 'Iowa', 'IA'), ('16', 'Idaho', 'ID'), ('17', 'Illinois', 'IL'), ('18', 'Indiana', 'IN'), ('19', 'Kansas', 'KS'), ('20', 'Kentucky', 'KY'), ('21', 'Louisiana', 'LA'), ('22', 'Massachusetts', 'MA'), ('23', 'Maryland', 'MD'), ('24', 'Maine', 'ME'), ('25', 'Michigan', 'MI'), ('26', 'Minnesota', 'MN'), ('27', 'Missouri', 'MO'), ('28', 'Northern Mariana Islands', null), ('29', 'Mississippi', 'MS'), ('30', 'Montana', 'MT'), ('31', 'North Carolina', 'NC'), ('32', 'North Dakota', 'ND'), ('33', 'Nebraska', 'NE'), ('34', 'New Hampshire', 'NH'), ('35', 'New Jersey', 'NJ'), ('36', 'New Mexico', 'NM'), ('37', 'Nevada', 'NV'), ('38', 'New York', 'NY'), ('39', 'Ohio', 'OH'), ('40', 'Oklahoma', 'OK'), ('41', 'Oregon', 'OR'), ('42', 'Pennsylvania', 'PA'), ('43', 'Puerto Rico', 'PR'), ('44', 'Rhode Island', 'RI'), ('45', 'South Carolina', 'SC'), ('46', 'South Dakota', 'SD'), ('47', 'Tennessee', 'TN'), ('48', 'Texas', 'TX'), ('49', 'Utah', 'UT'), ('50', 'Virginia', 'VA'), ('51', 'Virgin Island', 'VI'), ('52', 'Vermont', 'VT'), ('53', 'Washington', 'WA'), ('54', 'Wisconsin', 'WI'), ('55', 'West Virginia', 'WV'), ('56', 'Wyoming', 'WY');

-- ----------------------------
-- Table structure for lu_suffix
-- ----------------------------
DROP TABLE IF EXISTS `lu_suffix`;
CREATE TABLE `lu_suffix` (
  `suffix` varchar(10) NOT NULL,
  PRIMARY KEY (`suffix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_suffix
-- ----------------------------
INSERT INTO `lu_suffix` VALUES ('CPA'), ('Esq.'), ('II'), ('III'), ('IV'), ('Jr.'), ('P.E.'), ('Ph.D.'), ('Sr.'), ('V');

-- ----------------------------
-- Table structure for lu_yes_no
-- ----------------------------
DROP TABLE IF EXISTS `lu_yes_no`;
CREATE TABLE `lu_yes_no` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `yes_no` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lu_yes_no
-- ----------------------------
INSERT INTO `lu_yes_no` VALUES ('0', 'No'), ('1', 'Yes');

-- ----------------------------
-- Table structure for tbl_cache
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cache`;
CREATE TABLE `tbl_cache` (
  `cache_key` char(65) NOT NULL,
  `cache_expiration` int(11) DEFAULT NULL,
  `cache_data` text,
  PRIMARY KEY (`cache_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tbl_calendars
-- ----------------------------
DROP TABLE IF EXISTS `tbl_calendars`;
CREATE TABLE `tbl_calendars` (
  `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_name` varchar(50) NOT NULL,
  `calendar_type` varchar(20) NOT NULL,
  `calendar_view` varchar(10) NOT NULL,
  `calendar_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`calendar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_calendars
-- ----------------------------
INSERT INTO `tbl_calendars` VALUES ('1', 'Public Calendar', 'Events', 'Public', '1'), ('2', 'Calendar 2', 'Events', 'Private', '0'), ('3', 'Calendar 3', 'Events', 'Public', '0'), ('4', 'Calendar 4', 'Reservations', 'Private', '0');

-- ----------------------------
-- Table structure for tbl_calendars_items
-- ----------------------------
DROP TABLE IF EXISTS `tbl_calendars_items`;
CREATE TABLE `tbl_calendars_items` (
  `calendar_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) DEFAULT NULL,
  `calendar_item_start` datetime DEFAULT NULL,
  `calendar_item_end` datetime DEFAULT NULL,
  `calendar_item_recurrence` int(11) DEFAULT NULL,
  `calendar_item_title` varchar(100) DEFAULT NULL,
  `calendar_item_description` text,
  `calendar_item_location` varchar(100) DEFAULT NULL,
  `calendar_item_address1` varchar(100) DEFAULT NULL,
  `calendar_item_address2` varchar(100) DEFAULT NULL,
  `calendar_item_city` varchar(50) DEFAULT NULL,
  `calendar_item_state` char(2) DEFAULT NULL,
  `calendar_item_postal_code` varchar(10) DEFAULT NULL,
  `calendar_item_county` char(3) DEFAULT NULL,
  `calendar_item_country` char(2) DEFAULT NULL,
  `calendar_item_latitude` float(11,5) DEFAULT NULL,
  `calendar_item_longitude` float(11,5) DEFAULT NULL,
  `calendar_item_entered_by` int(11) DEFAULT NULL,
  `calendar_item_entered_date` datetime DEFAULT NULL,
  `calendar_item_updated_by` int(11) DEFAULT NULL,
  `calendar_item_updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`calendar_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_calendars_items
-- ----------------------------
INSERT INTO `tbl_calendars_items` VALUES ('1', '1', '2011-01-01 00:00:00', '2011-01-01 00:00:00', null, 'Sunday morning event', 'This is just a test event.  Looks nice huh?', null, null, null, null, null, null, null, null, null, null, '1', '2011-01-24 00:00:00', null, null), ('2', '1', '2011-01-28 14:30:00', '2011-01-28 15:00:00', null, 'Friday New Event', 'See this Event?', null, null, null, null, null, null, null, null, null, null, '1', '2011-01-24 22:50:56', null, null), ('3', '1', '2011-01-27 08:00:00', '2011-01-27 09:30:00', null, 'Early morning event', 'This is a Thu event', null, null, null, null, null, null, null, null, null, null, '1', '2011-01-24 00:00:00', null, null), ('4', '1', '2011-01-26 13:30:00', '2011-01-26 15:00:00', null, 'Another Wed event', 'Nudder wed event', null, null, null, null, null, null, null, null, null, null, '1', '2011-01-24 00:00:00', null, null), ('5', '1', '2011-01-27 09:00:00', '2011-01-27 11:00:00', null, 'New Title Here', 'See me?', null, null, null, null, null, null, null, null, null, null, '1', '2011-01-24 00:00:00', null, null), ('6', '1', '2011-02-03 00:00:00', '2011-02-03 00:00:00', null, 'Test February Event', 'This is a test event for the Public Calendar.', null, null, null, null, null, null, null, null, null, null, null, null, null, null), ('7', '1', '2011-01-27 04:30:00', '2011-01-27 17:00:00', null, 'Third item', 'This is a test for the third item in a calendar day.', null, null, null, null, null, null, null, null, null, null, null, null, null, null), ('8', '1', '2011-01-27 06:30:00', '2011-01-27 06:30:00', null, 'Get Up!', 'Get outta bed.', null, null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for tbl_calendars_private_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_calendars_private_users`;
CREATE TABLE `tbl_calendars_private_users` (
  `calendar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`calendar_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_calendars_private_users
-- ----------------------------
INSERT INTO `tbl_calendars_private_users` VALUES ('2', '1');

-- ----------------------------
-- Table structure for tbl_config
-- ----------------------------
DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE `tbl_config` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(253) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `inactive_message` varchar(255) DEFAULT NULL,
  `default_style` varchar(20) DEFAULT NULL,
  `default_locale` varchar(20) DEFAULT NULL,
  `site_title` varchar(50) DEFAULT NULL,
  `site_subtitle` varchar(100) DEFAULT NULL,
  `default_calendar_view` varchar(10) DEFAULT NULL,
  `mailer` varchar(20) DEFAULT NULL,
  `mail_type` varchar(5) DEFAULT NULL,
  `mail_host` varchar(50) DEFAULT NULL,
  `mail_port` int(11) DEFAULT NULL,
  `secure_mail_type` varchar(5) DEFAULT NULL,
  `secure_mail_host` varchar(50) DEFAULT NULL,
  `secure_mail_port` int(11) DEFAULT NULL,
  `mail_user` varchar(50) DEFAULT NULL,
  `mail_password` varchar(32) DEFAULT NULL,
  `mail_from_account` varchar(50) DEFAULT NULL,
  `mail_from_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_config
-- ----------------------------
INSERT INTO `tbl_config` VALUES ('1', 'codecharge-calendar-master', '1', '<span style=\'color:RED; font-weight:bold;\'>Maintenance is being performed. Please try again later.</span>', 'GreenApple', 'en', 'CodeCharge Calendar', null, 'Month', null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for tbl_groups
-- ----------------------------
DROP TABLE IF EXISTS `tbl_groups`;
CREATE TABLE `tbl_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_groups
-- ----------------------------
INSERT INTO `tbl_groups` VALUES ('1', 'SuperUser'), ('2', 'Administrators'), ('3', 'Editors');

-- ----------------------------
-- Table structure for `tbl_sites_modules`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sites_modules`;
CREATE TABLE `tbl_sites_modules` (
  `site_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`site_id`,`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sites_modules
-- ----------------------------
INSERT INTO `tbl_sites_modules` VALUES ('1', '1');

-- ----------------------------
-- Table structure for tbl_styles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_styles`;
CREATE TABLE `tbl_styles` (
  `style_name` varchar(20) NOT NULL,
  `site_id` int(11) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
  `menu_before_header` tinyint(1) DEFAULT NULL,
  `menu_after_header` tinyint(1) DEFAULT NULL,
  `show_header` tinyint(1) DEFAULT NULL,
  `left_column` tinyint(1) DEFAULT NULL,
  `right_column` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`style_name`,`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_styles
-- ----------------------------
INSERT INTO `tbl_styles` VALUES ('Apricot', '1', null, '0', '1', '1', '1', '0'), ('Basic', '1', null, '0', '1', '1', '1', '0'), ('Compact', '1', null, '0', '1', '1', '1', '0'), ('GreenApple', '1', null, '0', '1', '1', '1', '0'), ('SandBeach', '1', null, '0', '1', '1', '1', '0'), ('Simple', '1', null, '0', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_active` tinyint(1) DEFAULT NULL,
  `user_login` varchar(75) DEFAULT NULL,
  `user_password` varchar(32) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `company` varchar(75) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `phone_home` varchar(50) DEFAULT NULL,
  `phone_work` varchar(50) DEFAULT NULL,
  `phone_day` varchar(20) DEFAULT NULL,
  `phone_cell` varchar(50) DEFAULT NULL,
  `phone_evening` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `notes` text,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `ip_add` varchar(50) DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `ip_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', '1', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '1', null, 'Systems', 'Administrator', null, 'ABC Company, Inc.', 'Systems Administrator', null, '999-999-9999', null, null, null, null, null, null, '1', '11', 'Jacksonville', 'Duval', '32222', '123 Any Street', null, null, null, '2010-03-04 00:00:00', '1.2.3.4', '2010-12-03 13:41:15', '127.0.0.1');

-- ----------------------------
-- Table structure for tbl_users_groups
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users_groups`;
CREATE TABLE `tbl_users_groups` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  UNIQUE KEY `PrimaryIndex` (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users_groups
-- ----------------------------
INSERT INTO `tbl_users_groups` VALUES ('1', '1');

-- ----------------------------
-- Table structure for tbl_users_preferences
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users_preferences`;
CREATE TABLE `tbl_users_preferences` (
  `user_id` int(11) NOT NULL,
  `notify_ddi_promotions` tinyint(1) DEFAULT NULL,
  `notify_ccs_promotions` tinyint(1) DEFAULT NULL,
  `notify_support_updates` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users_preferences
-- ----------------------------
INSERT INTO `tbl_users_preferences` VALUES ('1', '1', '1', '1');
