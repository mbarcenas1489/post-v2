CREATE DATABASE IF NOT EXISTS `pos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pos`;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email_verified_at` timestamp NULL DEFAULT NULL,
	`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`document_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`document_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`category_id` bigint unsigned DEFAULT NULL,
	`supplier_id` bigint unsigned DEFAULT NULL,
	`barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`description` text COLLATE utf8mb4_unicode_ci,
	`cost_price` decimal(12,2) NOT NULL DEFAULT '0.00',
	`sale_price` decimal(12,2) NOT NULL DEFAULT '0.00',
	`stock` int NOT NULL DEFAULT '0',
	`min_stock` int NOT NULL DEFAULT '0',
	`status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `products_sku_unique` (`sku`),
	KEY `products_category_id_index` (`category_id`),
	KEY `products_supplier_id_index` (`supplier_id`),
	CONSTRAINT `products_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
	CONSTRAINT `products_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`date` datetime NOT NULL,
	`customer_id` bigint unsigned DEFAULT NULL,
	`subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
	`tax` decimal(12,2) NOT NULL DEFAULT '0.00',
	`discount` decimal(12,2) NOT NULL DEFAULT '0.00',
	`total` decimal(12,2) NOT NULL DEFAULT '0.00',
	`status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
	KEY `sales_customer_id_index` (`customer_id`),
	CONSTRAINT `sales_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE `sale_items` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`sale_id` bigint unsigned NOT NULL,
	`product_id` bigint unsigned NOT NULL,
	`quantity` int NOT NULL,
	`unit_price` decimal(12,2) NOT NULL,
	`discount` decimal(12,2) NOT NULL DEFAULT '0.00',
	`total` decimal(12,2) NOT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `sale_items_sale_id_index` (`sale_id`),
	KEY `sale_items_product_id_index` (`product_id`),
	CONSTRAINT `sale_items_sale_id_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
	CONSTRAINT `sale_items_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`sale_id` bigint unsigned NOT NULL,
	`method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`amount` decimal(12,2) NOT NULL,
	`reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `payments_sale_id_index` (`sale_id`),
	CONSTRAINT `payments_sale_id_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `stock_movements`;
CREATE TABLE `stock_movements` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`product_id` bigint unsigned NOT NULL,
	`quantity_change` int NOT NULL,
	`type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`note` text COLLATE utf8mb4_unicode_ci,
	`created_at` timestamp NULL DEFAULT NULL,
	`updated_at` timestamp NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `stock_movements_product_id_index` (`product_id`),
	CONSTRAINT `stock_movements_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
	`key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`expiration` int NOT NULL,
	PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
	`id` bigint unsigned NOT NULL AUTO_INCREMENT,
	`queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`attempts` tinyint unsigned NOT NULL,
	`reserved_at` int unsigned DEFAULT NULL,
	`available_at` int unsigned NOT NULL,
	`created_at` int unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
	`id` int unsigned NOT NULL AUTO_INCREMENT,
	`migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`batch` int NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Minimal seed data
INSERT INTO `categories` (`id`,`name`,`slug`,`description`) VALUES
	(1,'Bebidas','bebidas',NULL),
	(2,'Snacks','snacks',NULL),
	(3,'Limpieza','limpieza',NULL);

INSERT INTO `suppliers` (`id`,`name`,`email`,`phone`) VALUES
	(1,'Proveedor Central','central@example.com','555-1000'),
	(2,'Distribuciones XYZ','xyz@example.com','555-2000');

INSERT INTO `customers` (`id`,`name`,`email`) VALUES
	(1,'Consumidor Final',NULL),
	(2,'Empresa ABC','ventas@empresa-abc.com');

INSERT INTO `products` (`id`,`name`,`sku`,`category_id`,`supplier_id`,`sale_price`,`cost_price`,`stock`,`min_stock`,`status`) VALUES
	(1,'Agua Mineral 500ml','AG-500',1,1,0.80,0.40,100,10,'active'),
	(2,'Gaseosa Cola 1L','COLA-1L',1,1,1.20,0.70,60,8,'active');
