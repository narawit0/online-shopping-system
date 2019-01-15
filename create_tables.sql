
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `phone` char(10) COLLATE utf8_unicode_ci NOT NULL,
 `address` text COLLATE utf8_unicode_ci NOT NULL,
 `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


CREATE TABLE `sellers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `bank_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `product_images` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `size` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `products` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `seller_id` int(11) NOT NULL,
 `pro_img_id` int(11) NOT NULL,
 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `price` decimal(10,0) NOT NULL,
 `quanity` int(11) NOT NULL,
 `description` text COLLATE utf8_unicode_ci NOT NULL,
 `cat_id` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `payments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `cust_id` int(11) NOT NULL,
 `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `amount` int(11) NOT NULL,
 `date_transfer` datetime NOT NULL,
 `confirm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `order_details` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `pro_id` int(11) NOT NULL,
 `quanity` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `orders` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `date` datetime NOT NULL,
 `paid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `delivery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `categories` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

CREATE TABLE `cart` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `pro_id` int(11) NOT NULL,
 `quanity` int(11) NOT NULL,
 `date_shop` datetime NOT NULL,
 `user_id` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci




