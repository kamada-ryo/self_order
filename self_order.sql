-- Adminer 4.8.0 MySQL 5.7.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `table_num` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order` (`order_id`, `table_num`, `status`, `time`) VALUES
(1,	6,	0,	'2021-08-06 12:51:29');

DROP TABLE IF EXISTS `ryouri`;
CREATE TABLE `ryouri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ryouri` (`id`, `name`, `price`, `category`) VALUES
(1,	'料理1',	500,	'Appetizer'),
(2,	'料理2',	700,	'Appetizer'),
(3,	'料理3',	300,	'Appetizer'),
(4,	'料理4',	600,	'Appetizer'),
(5,	'料理5',	450,	'Appetizer'),
(6,	'料理6',	800,	'Dish'),
(7,	'料理7',	900,	'Dish'),
(8,	'料理8',	1200,	'Dish'),
(9,	'料理9',	1400,	'Dish'),
(10,	'料理10',	300,	'Dessert'),
(11,	'料理11',	450,	'Dessert'),
(12,	'料理12',	500,	'Dessert'),
(13,	'料理13',	750,	'Dessert'),
(14,	'ドリンク1',	300,	'Drink'),
(15,	'ドリンク2',	500,	'Drink'),
(16,	'ドリンク3',	450,	'Drink');


DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `ryouri` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order_detail` (`order_id`, `product_id`, `count`) VALUES
(1,	1,	1),
(1,	14,	1),
(1,	7,	1),
(1,	11,	1);


-- 2021-08-06 13:54:14
