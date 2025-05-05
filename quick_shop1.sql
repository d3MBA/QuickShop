-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for quickshop
CREATE DATABASE IF NOT EXISTS `quickshop` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `quickshop`;

-- Dumping structure for table quickshop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.categories: ~5 rows (approximately)
INSERT INTO `categories` (`category_id`, `category_name`) VALUES
	(1, 'Fruit'),
	(3, 'Dairy'),
	(4, 'Bakery'),
	(5, 'Meat'),
	(7, 'Beverages');

-- Dumping structure for table quickshop.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `permission_level` int(11) DEFAULT 0,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.customers: ~8 rows (approximately)
INSERT INTO `customers` (`customerID`, `name`, `email`, `password`, `phone`, `created_at`, `permission_level`) VALUES
	(7, 'ASDAS DASD', 'asdas@adsdasd', '123123123', '123123123', '2025-03-24 13:03:03', 0),
	(8, 'Domagoj Majic', 'domagojm@tudublin.ie', '123', '085 123 9400', '2025-04-06 22:16:36', 1),
	(9, 'Domagoj masjdi', '12313@123asdasd', 'Dom123', '123123', '2025-04-07 12:43:25', 0),
	(10, 'asda sad', 'asdasd@asdads', 'D123', '1223123', '2025-04-07 14:18:30', 0),
	(11, 'asd as', 'asdsda@asdsd', 'Dom123', '123123', '2025-04-07 14:34:33', 0),
	(12, 'asdsd asdad', 'adsad@asdadsa', 'A123', '1231232', '2025-04-28 06:36:07', 0),
	(13, 'asda sdasd', 'asdA@sdas', '1ASD', '12313', '2025-04-28 12:43:17', 0),
	(14, 'domag', 'domagojm@tudublinnnn.ie', 'Asd1', '123213', '2025-04-04 17:11:06', 1);

-- Dumping structure for table quickshop.discounts
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `percentage` int(11) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.discounts: ~2 rows (approximately)
INSERT INTO `discounts` (`id`, `code`, `percentage`, `expiry_date`) VALUES
	(1, 'EASTER25', 25, '2025-04-30'),
	(2, 'SUMMER10', 10, '2025-08-31');

-- Dumping structure for table quickshop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_orders_customer` (`customer_id`),
  CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.orders: ~1 rows (approximately)
INSERT INTO `orders` (`order_id`, `customer_id`, `address`, `order_date`, `status`, `total_amount`, `delivery_date`, `delivery_time`, `payment_method`) VALUES
	(19, 8, 'asdada', '2025-04-04 21:28:06', 'Shipped', 11.88, '2025-05-16', '23:28:00', 'cash');

-- Dumping structure for table quickshop.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `price_at_purchase` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `fk_orderitems_order` (`order_id`),
  KEY `fk_orderitems_product` (`product_id`),
  CONSTRAINT `fk_orderitems_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orderitems_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.order_items: ~1 rows (approximately)
INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`, `price_at_purchase`) VALUES
	(21, 19, 26, 12, 0.99, 11.88);

-- Dumping structure for table quickshop.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_products_category` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table quickshop.products: ~15 rows (approximately)
INSERT INTO `products` (`product_id`, `category_id`, `name`, `price`, `stock`, `description`) VALUES
	(26, 1, 'Banana', 0.99, 5, 'Fresh bananas'),
	(27, 1, 'Pineapple', 2.49, 100, 'Juicy pineapples'),
	(28, 1, 'Orange', 1.50, 49, 'Sweet oranges'),
	(29, 3, 'Milk 1L', 1.20, 80, 'Whole milk 1L carton'),
	(30, 3, 'Greek Yogurt', 1.75, 40, 'Plain Greek yogurt'),
	(31, 3, 'Mozzarella', 2.50, 44, 'Fresh mozzarella cheese'),
	(32, 4, 'White Bread', 1.10, 98, 'Classic sliced bread'),
	(33, 4, 'Croissant', 1.50, 70, 'croissants'),
	(34, 4, 'Muffins', 2.00, 30, 'Chocolate chip muffins'),
	(35, 5, 'Chicken Breast', 4.50, 40, 'Boneless chicken breasts'),
	(36, 5, 'Minced Beef', 5.20, 23, 'Lean minced beef'),
	(37, 5, 'Pork Sausages', 3.80, 25, 'Pack of pork sausages'),
	(38, 7, 'Tomato', 1.30, 90, 'Fresh tomato'),
	(39, 7, 'Green Tea', 1.90, 50, 'Pack of green tea bags'),
	(40, 7, 'Orange Juice', 2.10, 60, '1L fresh orange juice');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
