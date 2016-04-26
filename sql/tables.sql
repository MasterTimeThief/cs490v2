DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`
(
	`id` INT NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(7) NOT NULL UNIQUE,
    `category_id` INT DEFAULT 0,
    `title` VARCHAR(255) NOT NULL,
    `status` ENUM('open','closed')  DEFAULT 'Open',
    PRIMARY KEY(`id`)
)Engine='innoDB';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`
(
	 `id` INT NOT NULL AUTO_INCREMENT,
     `code` VARCHAR(7) NOT NULL UNIQUE,
     `title` VARCHAR(255) NOT NULL,
     PRIMARY KEY(`id`)
)Engine='InnoDB';

DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams`
(
	`id` INT NOT NULL AUTO_INCREMENT,
    `professor_id` INT NOT NULL,
    `class_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `is_available` TINYINT(1),
    PRIMARY KEY(`id`)
);

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer_1` varchar(255) DEFAULT NULL,
  `answer_2` varchar(255) DEFAULT NULL,
  `answer_3` varchar(255) DEFAULT NULL,
  `answer_4` varchar(255) DEFAULT NULL,
  `answer_5` varchar(255) DEFAULT NULL,
  `question_type` enum('true_or_false','multiple_choice','fill_in_the_blanks','short_answer') DEFAULT NULL,
  `is_true` enum('0','1') DEFAULT '0',
  `which_is_correct` enum('1','2','3','4','5') DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `exam_has_questions`;
CREATE TABLE `exam_has_questions`
(
	`id` INT NOT NULL AUTO_INCREMENT,
    `exam_id` INT NOT NULL,
    `question_id` INT NOT NULL,
    PRIMARY KEY(`id`)
)Engine='InnoDb';

select * from categories;
select * from classes;
select * from exams;
select * from questions;