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

CREATE TABLE IF NOT EXISTS `workers` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `user_id` INT(11) NOT NULL,
 `name` VARCHAR(60) NOT NULL ,
 `level` VARCHAR(60) NOT NULL ,
 `job` VARCHAR(60) NOT NULL ,
 `sex` VARCHAR(60) NOT NULL ,
 `salary` INT(11) NOT NULL ,
 `power` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `offices` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `user_id` INT(11) NOT NULL,
 `name` VARCHAR(60) NOT NULL ,
 `capacity` INT(6) NOT NULL ,
 `comfort` INT(3) NOT NULL ,
 `rent` INT(11) NOT NULL ,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `projects` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `user_id` INT(11) NOT NULL,
 `title` VARCHAR(60) NOT NULL ,
 `size` INT(3) NOT NULL ,
 `duration` INT(3) NOT NULL ,
 `award` INT(6) NOT NULL ,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `worker_project` (
 `user_id` INT(11) NOT NULL,
 `worker_id` INT(11) NOT NULL,
 `project_id` INT(11) NOT NULL)
  ENGINE = InnoDB;