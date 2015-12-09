
USE `gift_management`;

/*Table structure for table `book_goods_mapping` */

DROP TABLE IF EXISTS `book_goods_mapping`;

CREATE TABLE `book_goods_mapping` (
  `gift_book_id` int(10) unsigned NOT NULL COMMENT '礼册id',
  `gift_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `gift_num` int(11) DEFAULT NULL COMMENT '商品数量',
  `ctime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`gift_book_id`,`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `book_goods_mapping` */

insert  into `book_goods_mapping`(`gift_book_id`,`gift_id`,`gift_num`,`ctime`) values (7,1,2,'2015-12-06 22:26:31');

/*Table structure for table `card_order` */

DROP TABLE IF EXISTS `card_order`;

CREATE TABLE `card_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) DEFAULT NULL COMMENT '销售员id，从user表获取',
  `custom_id` int(11) DEFAULT NULL COMMENT '客户id，从客户表取',
  `delever_id` int(11) DEFAULT NULL COMMENT '快递公司id',
  `expire_date` date DEFAULT NULL COMMENT '失效日期',
  `wechat_id` int(11) DEFAULT NULL COMMENT '微信模版id',
  `remark` text COMMENT '备注',
  `delivrer_num` varchar(45) DEFAULT NULL COMMENT '快递单号',
  `order_name` varchar(45) DEFAULT NULL COMMENT '册1*2，册2*3',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:待审核 2: 待发货 3: 已完成 4作废',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `card_order` */

/*Table structure for table `change_order` */

DROP TABLE IF EXISTS `change_order`;

CREATE TABLE `change_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `card_num` varchar(45) NOT NULL,
  `gift_id` int(11) DEFAULT NULL COMMENT '选择兑换的商品id',
  `customer_name` varchar(45) DEFAULT NULL COMMENT '用户名称，收件人',
  `photo` varchar(45) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '收件地址',
  `post_code` varchar(45) DEFAULT NULL COMMENT '邮编',
  `deliver_id` int(11) DEFAULT NULL COMMENT '快递公司id',
  `deliver_date` datetime DEFAULT NULL COMMENT '发货日期',
  `remark` text COMMENT '备注',
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `deliver_num` varchar(45) DEFAULT NULL COMMENT '快递单号',
  `order_source` int(11) NOT NULL COMMENT '订单来源，1: 电话，2: 官网，3:微信',
  PRIMARY KEY (`id`,`card_id`,`card_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `change_order` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '客户名称',
  `type` int(11) DEFAULT NULL COMMENT '1:代理商 2:企业大客户',
  `contact_person` varchar(45) DEFAULT NULL COMMENT '联系人',
  `phone` varchar(45) DEFAULT NULL COMMENT '手机号',
  `address` varchar(45) DEFAULT NULL COMMENT '地址',
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '1: 启用 2:停用',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '更新时间',
  `email` varchar(45) DEFAULT NULL COMMENT '邮箱',
  `postcode` varchar(45) DEFAULT NULL COMMENT '邮编',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`name`,`type`,`contact_person`,`phone`,`address`,`status`,`ctime`,`utime`,`email`,`postcode`,`remark`) values (1,'test',2,'测试01','15101421680','北京',1,'2015-12-07 14:14:18','2015-12-07 14:14:21','test@jiayuan.com','100000','test'),(2,'test2',2,'测试02','15201421680','湖南',1,'2015-12-07 15:48:03','2015-12-07 15:48:05','test2@jiayuan.com','110000','test222');

/*Table structure for table `deliver` */

DROP TABLE IF EXISTS `deliver`;

CREATE TABLE `deliver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '快递自增ID',
  `name` varchar(20) NOT NULL COMMENT '快递名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态(1:使用中,2:停用)',
  `remark` varchar(120) DEFAULT NULL COMMENT '备注',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `deliver` */

insert  into `deliver`(`id`,`name`,`status`,`remark`,`ctime`) values (1,'中通',1,NULL,NULL),(2,'申通',1,NULL,NULL),(3,'顺丰',1,NULL,NULL),(4,'京东',1,NULL,NULL);

/*Table structure for table `dim` */

DROP TABLE IF EXISTS `dim`;

CREATE TABLE `dim` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `dim_id` int(10) unsigned NOT NULL COMMENT '维度类型ID',
  `dim_type` varchar(45) NOT NULL COMMENT '维度类型，gift_type: 商品类型，deliver:快递列表 3: wechat_style',
  `dim_value` varchar(45) NOT NULL COMMENT '维度值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dim` */

/*Table structure for table `gift` */

DROP TABLE IF EXISTS `gift`;

CREATE TABLE `gift` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `name` varchar(40) NOT NULL COMMENT '商品名称',
  `groupid` varchar(320) NOT NULL COMMENT '仅针对组合商品，33*2,34*4. 单品次字段为''''',
  `type` int(11) DEFAULT NULL COMMENT 'dim表id',
  `classify_id` int(11) DEFAULT NULL COMMENT '商品分类id',
  `brand_id` int(11) DEFAULT NULL COMMENT '商品品牌id',
  `supply_id` int(11) DEFAULT NULL COMMENT '商品供应商id',
  `sale_price` decimal(15,2) DEFAULT NULL COMMENT '销售价格',
  `buy_price` decimal(15,2) DEFAULT NULL COMMENT '采购价格',
  `store_num` int(11) DEFAULT NULL COMMENT '库存',
  `munit` varchar(45) DEFAULT NULL COMMENT '商品计量单位',
  `deliver_id` int(11) DEFAULT NULL COMMENT '快递id',
  `desciption` text COMMENT '商品描述',
  `pic_ids` varchar(255) DEFAULT NULL COMMENT '宣传图片id，用逗号的拼接列表',
  `remark` text COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1: 上架， 2 下架',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '更新时间',
  `sold_num` int(11) NOT NULL DEFAULT '0' COMMENT '售出数量，初始为0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `gift` */

insert  into `gift`(`id`,`name`,`groupid`,`type`,`classify_id`,`brand_id`,`supply_id`,`sale_price`,`buy_price`,`store_num`,`munit`,`deliver_id`,`desciption`,`pic_ids`,`remark`,`status`,`ctime`,`utime`,`sold_num`) values (1,'test','',1,1,1,1,'12.00','2.00',10,'个',1,'搜索','poster.jpg,','test',1,'2015-11-28 20:50:36','2015-12-06 23:00:44',0),(2,'test','1,',2,1,1,1,'12.00','2.00',12,'个',1,'test','vimeo (1).png,','test',1,'2015-11-28 20:52:13','2015-12-06 23:00:44',0),(3,'qwe','1*2,',2,1,2,NULL,'10.00','6.00',0,'个',1,'test11','test2.jpg,','',1,'2015-11-30 23:53:14','2015-12-06 15:50:35',0),(4,'qwe','1*2',2,1,5,NULL,'12.00','6.00',0,'个',1,'sss','test2.jpg,','',1,'2015-11-30 23:55:45','2015-12-06 15:50:35',0),(5,'tccest','',1,1,2,1,'10.00','8.00',10,'元',1,'test','test2.jpg,','test',1,'2015-12-06 20:17:41','2015-12-06 20:17:41',0),(6,'特殊','1*2',2,NULL,NULL,NULL,'10.00','3.00',0,'个',1,'搜索','37,38,39,','cc',1,'2015-12-06 20:22:06','2015-12-06 21:11:02',0);

/*Table structure for table `gift_book` */

DROP TABLE IF EXISTS `gift_book`;

CREATE TABLE `gift_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '礼册名称',
  `theme_id` int(11) DEFAULT NULL COMMENT '礼册主题id',
  `set_id` int(11) DEFAULT NULL COMMENT '礼册系列id',
  `wechat_id` int(11) DEFAULT NULL COMMENT '微信模版id',
  `type_id` int(11) DEFAULT NULL COMMENT '礼册类型id 1: 普通 2: 年卡 3: 半年卡 4:季卡',
  `sale_price` float DEFAULT NULL COMMENT '销售价格',
  `group_ids` varchar(255) DEFAULT NULL COMMENT '33*3,34*2',
  `describe` text COMMENT '礼册描述',
  `pic_id` int(11) DEFAULT NULL COMMENT '上传后，需要保存到 media表',
  `remark` text COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: 启用 2: 停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `gift_book` */

insert  into `gift_book`(`id`,`name`,`theme_id`,`set_id`,`wechat_id`,`type_id`,`sale_price`,`group_ids`,`describe`,`pic_id`,`remark`,`status`) values (1,'热热',2,2,1,1,400,'1*23,3*32,','ess',1,'dsf',2),(2,'sscc',2,2,2,3,300,'1*1,',NULL,2,'cccdd',2),(3,'tes',1,1,NULL,1,12,'1*2',NULL,NULL,'ccc',2),(4,'testc',1,1,NULL,1,12,'2*2',NULL,NULL,'ccssddd',2),(5,'热热s',1,2,NULL,1,400,'1*2',NULL,NULL,'dsf',2),(6,'tswd',1,1,NULL,1,10,'1*2','cccc',0,'sdc',2),(7,'ccc',1,1,NULL,1,10,'1*2','sssdd',49,'cccsss',2);

/*Table structure for table `gift_brand` */

DROP TABLE IF EXISTS `gift_brand`;

CREATE TABLE `gift_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '品牌名称',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:使用 2:停用',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `gift_brand` */

insert  into `gift_brand`(`id`,`name`,`status`,`remark`) values (1,'小鸟依人',2,'testa'),(2,'阿三时尚',1,'tests'),(3,'圣诞狂欢',1,'test'),(4,'测试',1,'test');

/*Table structure for table `gift_card` */

DROP TABLE IF EXISTS `gift_card`;

CREATE TABLE `gift_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_code` int(11) DEFAULT NULL COMMENT '礼品卡号码',
  `passwod` int(11) DEFAULT NULL COMMENT '密码',
  `ctime` varchar(45) DEFAULT NULL COMMENT '生成时间',
  `status` int(11) NOT NULL DEFAULT '3' COMMENT '状态 1: 未激活 2: 已激活 3:已使用 4: 已过期 5: 已退卡 6: 冻结',
  `book_id` int(11) NOT NULL COMMENT '礼册id',
  `discount` decimal(15,2) DEFAULT NULL COMMENT '折扣 0-10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gift_card` */

/*Table structure for table `gift_classify` */

DROP TABLE IF EXISTS `gift_classify`;

CREATE TABLE `gift_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '分类名称',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:使用 2:停用',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `gift_classify` */

insert  into `gift_classify`(`id`,`name`,`status`,`remark`) values (1,'生日',1,'test'),(2,'结婚',1,'wer'),(3,'朋友送礼',1,NULL);

/*Table structure for table `gift_supply` */

DROP TABLE IF EXISTS `gift_supply`;

CREATE TABLE `gift_supply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '品牌名称',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:使用 2:停用',
  `remark` text COMMENT '备注',
  `contact_person` varchar(45) DEFAULT NULL COMMENT '联系人',
  `phone` varchar(45) DEFAULT NULL COMMENT '手机号',
  `qq` varchar(45) DEFAULT NULL COMMENT 'qq号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `gift_supply` */

insert  into `gift_supply`(`id`,`name`,`status`,`remark`,`contact_person`,`phone`,`qq`) values (1,'电信',1,'sss','pbchen','1234567876','123245643'),(2,'网通',2,'hgfds',NULL,NULL,NULL),(3,'国美',1,NULL,NULL,NULL,NULL),(4,'苏宁',2,NULL,NULL,NULL,NULL),(5,'test',1,'qwwz','pbchen','123456543','123654');

/*Table structure for table `map_order_card` */

DROP TABLE IF EXISTS `map_order_card`;

CREATE TABLE `map_order_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `card_id` int(11) NOT NULL COMMENT '礼品卡id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `map_order_card` */

/*Table structure for table `media` */

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL COMMENT '存储路径,包括商品图片，多媒体管理里面的图片／视频／音频',
  `name` varchar(45) DEFAULT NULL COMMENT '名称',
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '1:停用 2启用',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `media` */

insert  into `media`(`id`,`path`,`name`,`status`,`ctime`,`utime`) values (1,'img/20151206/fdb601/','test2.jpg',1,'2015-12-06 19:22:38','2015-12-06 19:22:38'),(2,'img/20151206/37d823/','test2.jpg',1,'2015-12-06 19:24:28','2015-12-06 19:24:28'),(3,'img/20151206/a93498/','test2.jpg',1,'2015-12-06 19:25:43','2015-12-06 19:25:43'),(4,'img/20151206/74a70f/','test2.jpg',1,'2015-12-06 19:36:24','2015-12-06 19:36:24'),(5,'img/20151206/fc61a7/','test2.jpg',1,'2015-12-06 19:36:58','2015-12-06 19:36:58'),(6,'img/20151206/43df73/','test2.jpg',1,'2015-12-06 19:44:04','2015-12-06 19:44:04'),(7,'img/20151206/73cfea/','test2.jpg',1,'2015-12-06 19:45:41','2015-12-06 19:45:41'),(8,'img/20151206/838590/','test2.jpg',1,'2015-12-06 19:45:57','2015-12-06 19:45:57'),(9,'img/20151206/b41ec9/','test2.jpg',1,'2015-12-06 19:46:39','2015-12-06 19:46:39'),(10,'img/20151206/a245a0/','test2.jpg',1,'2015-12-06 19:47:42','2015-12-06 19:47:42'),(11,'img/20151206/d559e2/','test2.jpg',1,'2015-12-06 19:49:01','2015-12-06 19:49:01'),(12,'img/20151206/d23769/','test2.jpg',1,'2015-12-06 19:51:12','2015-12-06 19:51:12'),(13,'img/20151206/72c886/','test2.jpg',1,'2015-12-06 19:54:47','2015-12-06 19:54:47'),(14,'img/20151206/bf7543/','test2.jpg',1,'2015-12-06 19:55:21','2015-12-06 19:55:21'),(15,'img/20151206/6fde16/','test2.jpg',1,'2015-12-06 19:57:02','2015-12-06 19:57:02'),(16,'img/20151206/743762/','test2.jpg',1,'2015-12-06 19:58:38','2015-12-06 19:58:38'),(17,'img/20151206/a70990/','test2.jpg',1,'2015-12-06 20:02:25','2015-12-06 20:02:25'),(18,'img/20151206/6bfcb0/','test2.jpg',1,'2015-12-06 20:04:05','2015-12-06 20:04:05'),(19,'img/20151206/344cc1/','test2.jpg',1,'2015-12-06 20:04:11','2015-12-06 20:04:11'),(20,'img/20151206/59d6c9/','test2.jpg',1,'2015-12-06 20:04:13','2015-12-06 20:04:13'),(21,'img/20151206/cf8ee4/','test2.jpg',1,'2015-12-06 20:04:16','2015-12-06 20:04:16'),(22,'img/20151206/93e7f6/','test2.jpg',1,'2015-12-06 20:04:21','2015-12-06 20:04:21'),(23,'img/20151206/3cda14/','test2.jpg',1,'2015-12-06 20:04:24','2015-12-06 20:04:24'),(24,'img/20151206/5fdb9e/','test2.jpg',1,'2015-12-06 20:11:24','2015-12-06 20:11:24'),(25,'img/20151206/c5fd3b/','test2.jpg',1,'2015-12-06 20:11:32','2015-12-06 20:11:32'),(26,'img/20151206/c4fab3/','test2.jpg',1,'2015-12-06 20:11:37','2015-12-06 20:11:37'),(27,'img/20151206/ec2f80/','test2.jpg',1,'2015-12-06 20:17:23','2015-12-06 20:17:23'),(28,'img/20151206/97ce29/','test2.jpg',1,'2015-12-06 20:20:30','2015-12-06 20:20:30'),(29,'img/20151206/be731b/','test2.jpg',1,'2015-12-06 20:21:58','2015-12-06 20:21:58'),(30,'img/20151206/f5aa1d/','test2.jpg',1,'2015-12-06 20:22:01','2015-12-06 20:22:01'),(31,'img/20151206/1a63f0/','test2.jpg',1,'2015-12-06 20:53:08','2015-12-06 20:53:08'),(32,'img/20151206/cf0bbf/','test2.jpg',1,'2015-12-06 20:53:10','2015-12-06 20:53:10'),(33,'img/20151206/c29e9d/','test2.jpg',1,'2015-12-06 20:53:14','2015-12-06 20:53:14'),(34,'img/20151206/ccd329/','test2.jpg',1,'2015-12-06 20:53:16','2015-12-06 20:53:16'),(35,'img/20151206/264468/','test2.jpg',1,'2015-12-06 20:53:19','2015-12-06 20:53:19'),(36,'img/20151206/4ced60/','test2.jpg',1,'2015-12-06 21:07:55','2015-12-06 21:07:55'),(37,'img/20151206/b42f88/','test2.jpg',1,'2015-12-06 21:08:13','2015-12-06 21:08:13'),(38,'img/20151206/1a7270/','test2.jpg',1,'2015-12-06 21:08:16','2015-12-06 21:08:16'),(39,'img/20151206/bb9605/','test2.jpg',1,'2015-12-06 21:10:59','2015-12-06 21:10:59'),(40,'img/20151206/1357e3/','test2.jpg',1,'2015-12-06 21:35:53','2015-12-06 21:35:53'),(41,'img/20151206/3f0529/','test2.jpg',1,'2015-12-06 21:36:02','2015-12-06 21:36:02'),(42,'img/20151206/f01d1a/','test2.jpg',1,'2015-12-06 21:36:51','2015-12-06 21:36:51'),(43,'img/20151206/064ed4/','test2.jpg',1,'2015-12-06 21:36:55','2015-12-06 21:36:55'),(44,'img/20151206/d5bf55/','test2.jpg',1,'2015-12-06 21:45:14','2015-12-06 21:45:14'),(45,'img/20151206/a67e5d/','test2.jpg',1,'2015-12-06 21:45:34','2015-12-06 21:45:34'),(46,'img/20151206/65a37a/','test2.jpg',1,'2015-12-06 21:45:37','2015-12-06 21:45:37'),(47,'img/20151206/2f18da/','test2.jpg',1,'2015-12-06 21:45:39','2015-12-06 21:45:39'),(48,'img/20151206/6ea7bf/','test2.jpg',1,'2015-12-06 21:45:42','2015-12-06 21:45:42'),(49,'img/20151206/717026/','test2.jpg',1,'2015-12-06 21:47:34','2015-12-06 21:47:34'),(50,'img/20151206/456c4f/','test2.jpg',1,'2015-12-06 23:29:46','2015-12-06 23:29:46');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(45) NOT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`id`,`name`) values (1,'普通用户'),(2,'管理员'),(3,'超级管理员');

/*Table structure for table `set` */

DROP TABLE IF EXISTS `set`;

CREATE TABLE `set` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系列ID',
  `name` varchar(45) NOT NULL COMMENT '系列名',
  `remark` text COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: 启用 2: 停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `set` */

insert  into `set`(`id`,`name`,`remark`,`status`) values (1,'春晚','测试',1),(2,'秋意浓','cc',1),(3,'123','测测',1);

/*Table structure for table `theme` */

DROP TABLE IF EXISTS `theme`;

CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '主题名',
  `remark` text COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: 启用 2: 停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `theme` */

insert  into `theme`(`id`,`name`,`remark`,`status`) values (1,'天花乱坠','双方都',1),(2,'小林别克1','菜市场11111',1),(3,'通天塔','1233饿肚肚',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(45) NOT NULL COMMENT '账号4-15数字字母任意组合',
  `nick_name` varchar(42) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL COMMENT '密码',
  `email` varchar(45) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(45) DEFAULT NULL COMMENT '手机号',
  `role` int(11) DEFAULT NULL COMMENT '角色身份id',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`user_name`,`nick_name`,`password`,`email`,`phone`,`role`,`create_time`) values (1,'pbchen','小城别顾','e10adc3949ba59abbe56e057f20f883e','294306275@qq.com','15201421880',1,'2015-11-24 13:14:05');

/*Table structure for table `website` */

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '网站名称',
  `type` int(11) DEFAULT NULL COMMENT '1:兑换网站 2:礼册商城',
  `domain` varchar(45) DEFAULT NULL COMMENT '绑定域名',
  `hotline` varchar(45) DEFAULT NULL COMMENT '客服热线',
  `qq` varchar(45) DEFAULT NULL COMMENT 'qq号码',
  `expire_time` date DEFAULT NULL COMMENT '有效期',
  `pic_id` int(11) DEFAULT NULL COMMENT 'log id，来自呀media表',
  `describe` text COMMENT '描述',
  `remark` varchar(45) DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: 启用 2:停用',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `website` */

/*Table structure for table `wechat` */

DROP TABLE IF EXISTS `wechat`;

CREATE TABLE `wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '模版名称',
  `style` int(11) DEFAULT NULL COMMENT '样式，从dim 取wechat_style',
  `pic_id` int(11) DEFAULT NULL COMMENT '图片id',
  `autio_id` varchar(45) DEFAULT NULL COMMENT '音频id',
  `vedio_id` varchar(45) DEFAULT NULL COMMENT '视频id',
  `copywriter` text COMMENT '文案',
  `url` varchar(255) DEFAULT NULL COMMENT '网址',
  `expire_time` date DEFAULT NULL COMMENT '有效期',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: 启用 2:停用',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `wechat` */

insert  into `wechat`(`id`,`name`,`style`,`pic_id`,`autio_id`,`vedio_id`,`copywriter`,`url`,`expire_time`,`status`,`remark`) values (1,'小城别顾',1,1,'1','1','哈哈哈，故乡好！','http://dc.pbchen.com/giftcard_manage/add_giftcard','2015-12-07',1,'袜子'),(2,'生活与城市',2,1,'2','2','生活好难\r\n','http://dc.pbchen.com/giftcard_manage/add_giftcard','2015-12-07',1,'鞋子');

