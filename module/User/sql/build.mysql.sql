CREATE SCHEMA `zf2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
CREATE TABLE `zf2`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(80) NOT NULL,
  `role` VARCHAR(45) NOT NULL DEFAULT 'user',
  `date` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));

INSERT INTO `zf2`.`users` (`id`, `email`, `password`, `role`, `date`) VALUES 
(NULL, 'user1@email.com', '1234', 'admin', CURRENT_TIMESTAMP), 
(NULL, 'user2@email.com', '1234', 'user', CURRENT_TIMESTAMP), 
(NULL, 'user3@email.com', '1234', 'user', CURRENT_TIMESTAMP), 
(NULL, 'user4@email.com', '1234', 'user', CURRENT_TIMESTAMP), 
(NULL, 'user5@email.com', '1234', 'user', CURRENT_TIMESTAMP);