CREATE TABLE IF NOT EXISTS `form_education` (
  `id` bigint(20) NOT NULL ,
  `date` DATE DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `topic` text,
<<<<<<< HEAD
  `learners` varchar(255) ,
  `readiness`text,
  `response` text  , 
  `method` text ,
=======
  `learners` text ,
  `readiness`text,
  `response` text, 
  `method` text,
  `interventions` text,
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
  `remark` text
) ENGINE=InnoDB;