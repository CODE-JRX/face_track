

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `biometric` varchar(100) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO employee VALUES("1","BOLEZA","JERIC","GONZALES","ADMIN","ICT","employees/1.jpg");
INSERT INTO employee VALUES("2","GWAPO","MARVIN","ASDA","INSTRUCTOR I","SAMPLE","employees/2.jpg");
INSERT INTO employee VALUES("3","AGUNAT","GERARDO","??????","????","????","employees/3.jpg");



CREATE TABLE `time_record` (
  `tr_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  PRIMARY KEY (`tr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

INSERT INTO time_record VALUES("37","13","jeric boleza","2024-03-22","08:26:44");
INSERT INTO time_record VALUES("38","13","jeric boleza","2024-03-22","08:45:47");
INSERT INTO time_record VALUES("39","13","jeric boleza","2024-03-22","08:46:41");
INSERT INTO time_record VALUES("40","13","jeric boleza","2024-03-22","08:47:18");
INSERT INTO time_record VALUES("41","13","jeric boleza","2024-03-22","08:48:04");
INSERT INTO time_record VALUES("42","13","jeric boleza","2024-03-22","08:55:23");
INSERT INTO time_record VALUES("43","13","jeric boleza","2024-03-22","09:01:14");
INSERT INTO time_record VALUES("44","13","jeric boleza","2024-03-22","09:05:48");
INSERT INTO time_record VALUES("45","13","jeric boleza","2024-03-22","09:07:50");
INSERT INTO time_record VALUES("46","13","jeric boleza","2024-03-22","09:54:19");
INSERT INTO time_record VALUES("47","26","RITA BOELZA","2024-03-22","10:50:45");
INSERT INTO time_record VALUES("48","13","jeric boleza","2024-03-25","06:02:01");
INSERT INTO time_record VALUES("49","13","jeric boleza","2024-03-26","08:30:54");
INSERT INTO time_record VALUES("50","13","jeric boleza","2024-03-26","08:31:41");
INSERT INTO time_record VALUES("51","13","jeric boleza","2024-03-26","08:32:21");



CREATE TABLE `time_record_v2` (
  `tr_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `in_am` varchar(10) NOT NULL,
  `out_am` varchar(10) NOT NULL,
  `in_pm` varchar(10) NOT NULL,
  `out_pm` varchar(10) NOT NULL,
  `yyyy` varchar(4) NOT NULL,
  `mm` varchar(2) NOT NULL,
  `dd` varchar(2) NOT NULL,
  PRIMARY KEY (`tr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO time_record_v2 VALUES("1","1","16:40:11","16:40:21","","","2024","3","27");
INSERT INTO time_record_v2 VALUES("2","2","08:09:56","","","","2024","4","4");



CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1=admin, 2=faculty 3=staff',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive, 1=active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("1","Admin, Admin A.","1","admin","admin","1","2024-03-25 10:42:01");
INSERT INTO users VALUES("2","j1","1","123","123","1","2024-03-25 11:06:40");

