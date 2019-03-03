CREATE TABLE IF NOT EXISTS `users` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `login` VARCHAR(60) NULL ,
 `password` VARCHAR(255) NOT NULL ,
 `email` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`),
  UNIQUE (`login`, `email`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `games` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `user_id` INT(11) NOT NULL,
 `company_name` VARCHAR(60) NOT NULL ,
 `money` INT(11) NOT NULL DEFAULT 20000,
 `turn` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE (`user_id`))
  ENGINE = InnoDB;

