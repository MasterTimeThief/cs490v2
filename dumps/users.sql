DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` char(32) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `activation_key` varchar(32) DEFAULT NULL,
  `role` enum('student','professor','admin') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


INSERT INTO `users` VALUES 
	(1,'Jack','Nicholson', 'professor@njit.edu','a4569ce3eae99c5f3c8b1e0d19462014',1,NULL,'professor'),
	(2,'Walter','Diaz', 'wad3@njit.edu','cd73502828457d15655bbd7a63fb0bc8',1,NULL,'student'),
	(3,'John','Ferguson', 'student@njit.edu','a4569ce3eae99c5f3c8b1e0d19462014',1,NULL,'student');