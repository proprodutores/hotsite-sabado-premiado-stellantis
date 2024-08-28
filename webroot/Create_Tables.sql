CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `sweepstakes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `spaces` int DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `awards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `sweepstake_id` int DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `balance` int DEFAULT NULL,
  `spaces` int DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sweepstake_id_idx` (`sweepstake_id`),
  CONSTRAINT `fk_sweepstake_id` FOREIGN KEY (`sweepstake_id`) REFERENCES `sweepstakes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `play` (
  `id` int NOT NULL AUTO_INCREMENT,
  `drawn_position` varchar(45) DEFAULT NULL,
  `award_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_award_play_idx` (`award_id`),
  KEY `fk_user_lay_idx` (`user_id`),
  CONSTRAINT `fk_award_play` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`),
  CONSTRAINT `fk_user_lay` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `winners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sapid` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `shift` varchar(45) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_winners_user_id_idx` (`user_id`),
  CONSTRAINT `fk_winners_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

