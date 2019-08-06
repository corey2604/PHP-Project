USE `b00652935`;

CREATE TABLE `ProjectUsers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(20) NOT NULL UNIQUE,
 `password` varchar(255) NOT NULL,
 `reg_date` datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
