-- Adminer 4.8.0 MySQL 5.7.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `r_category`;
CREATE TABLE `r_category` (
  `category_id` int(64) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(64) NOT NULL,
  `category_slug` varchar(172) NOT NULL,
  `category_display` tinyint(4) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `r_category` (`category_id`, `category_name`, `category_slug`, `category_display`) VALUES
(1,	'前菜',	'appetizer',	1),
(2,	'一品料理',	'dish',	1),
(3,	'デザート',	'dessert',	1),
(4,	'ドリンク',	'drink',	1);

SET NAMES utf8;

DROP TABLE IF EXISTS `r_customer`;
CREATE TABLE `r_customer` (
  `customer_id` int(64) NOT NULL AUTO_INCREMENT,
  `table_num` int(64) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `r_order`;
CREATE TABLE `r_order` (
  `order_id` int(64) NOT NULL AUTO_INCREMENT,
  `customer_id` int(64) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `r_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `r_customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `r_order_detail`;
CREATE TABLE `r_order_detail` (
  `order_id` int(64) NOT NULL,
  `product_id` int(64) NOT NULL,
  `count` int(64) NOT NULL,
  `status` tinyint(4) NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `r_order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `r_order` (`order_id`),
  CONSTRAINT `r_order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `r_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `r_product`;
CREATE TABLE `r_product` (
  `product_id` int(64) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(64) NOT NULL,
  `product_price` int(64) NOT NULL,
  `category_id` int(64) NOT NULL,
  `product_display` tinyint(4) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `r_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `r_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `r_product` (`product_id`, `product_name`, `product_price`, `category_id`, `product_display`) VALUES
(1,	'前菜1',	500,	1,	1),
(2,	'前菜2',	600,	1,	2),
(3,	'前菜3',	400,	1,	1),
(4,	'前菜4',	450,	1,	1),
(5,	'一品料理1',	700,	2,	1),
(6,	'一品料理2',	800,	2,	1),
(7,	'一品料理3',	800,	2,	1),
(8,	'一品料理4',	500,	2,	1),
(9,	'一品料理5',	700,	2,	1),
(10,	'デザート1',	500,	3,	1),
(11,	'デザート2',	450,	3,	1),
(12,	'デザート3',	600,	3,	1),
(13,	'デザート4',	650,	3,	1),
(14,	'ドリンク1',	300,	4,	1),
(15,	'ドリンク2',	500,	4,	1),
(16,	'ドリンク3',	500,	4,	1);

-- 2021-08-19 12:19:50
