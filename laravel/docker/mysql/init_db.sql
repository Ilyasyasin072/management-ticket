DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `email` varchar (50),
                          `deb` varchar(30),
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
