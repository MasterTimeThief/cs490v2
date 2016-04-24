TRUNCATE `categories`;
INSERT INTO `categories`(`code`,`title`)
 VALUES
	('CS','Computer Science'),
    ('IT','Information Technology'),
    ('CIS','Civil Engineering'),
    ('CHEM','Chemistry'),
    ('ECON','Economics'),
    ('ENG','English'),
    ('HIST','History'),
    ('FIN','Finance');


## Data
TRUNCATE `classes`;
INSERT INTO `classes`(`code`,`category_id`,`title`)
 VALUES
	('CS100',1,'ROADMAP TO COMPUTING'),
    ('CS101',1,'COMP PROG & PROB SOLVING'),
    ('CS103',1,'COMPUT SCI-BUSINESS PROB'),
    ('CS104',1,'COMPUT PROG & GRAPH PROB'),
    ('CS106',1,'ROADMAP TO COMPUTING ENGINEERS'),
    ('CS107',1,'COMPUTING AS A CAREER'),
    ('CS241',1,'FOUNDATIONS OF COMP SCIENCE I'),
    ('CS280',1,'PROGRAMMING LANG CONCEPTS'),
    ('CS288',1,'INTENSIVE PROGRAMMING IN LINUX'),
    ('CS341',1,'FOUND OF COMPUTER SCIENCE II'),
    ('CS345',1,'WEB SEARCH'),
    ('CS435',1,'ADV DATA STRUCT-ALG DES'),
    ('CS490',1,'DESIGN IN SOFTWARE ENGR');

TRUNCATE `exams`;
INSERT INTO `exams`(`professor_id`,`class_id`,`title`,`is_available`)
	VALUES
			('1','1','First Exam','0'),
            ('1','1','Second Exam','0'),
            ('1','2','First Exam','0'),
            ('1','2','Second Exam','0'),
            ('1','3','First Exam','0'),
            ('1','3','Second Exam','0');
            

INSERT INTO `questions` VALUES 
	(1,1,'Is php an object oriented language?',NULL,NULL,NULL,NULL,NULL,'true_or_false','1',NULL,NULL),
    (2,1,'when was php created?','1994','1927','6758','67678','7867','multiple_choice','0','1',NULL),
    (3,1,'create a funciton that returns summation of two numbers?','function add($a,$b){\nreturn $a+b}',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),
    (4,1,'Linux Torvals created ___','Linux',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),
    (14,1,'This question is for a TEST EXAM',NULL,NULL,NULL,NULL,NULL,'true_or_false','1',NULL,NULL),
    (16,1,'For years, the preferred model for software development was the _______ method.','waterfall',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),
    (17,1,'How would you make a C program that prints out 5 items in testArray?','for (i = 0; i < 5; i++)\n{\n    printf(testArray[i]);\n}',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),
    (18,1,'What symbol would you use to denote a pointer?','^','$','*','&','@','multiple_choice','0','3',NULL),
    (20,1,'The MyISAM database engine supports transactions.',NULL,NULL,NULL,NULL,NULL,'true_or_false','0',NULL,NULL),
    (21,1,'This class uses _____ to learn about programming.','Python',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),
    (22,1,'C was invented in the year ____','1970',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),
    (23,1,'Create a simple Hello World function','echo \"Hello World!\"',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),
    (24,1,'What is an example of a high level language?','1','2','3','4','5','multiple_choice','0','4',NULL),
    (25,1,'NJIT teaches a course in PHP',NULL,NULL,NULL,NULL,NULL,'true_or_false','0',NULL,NULL);