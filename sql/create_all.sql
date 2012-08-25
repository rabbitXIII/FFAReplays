SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `wc3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `wc3` ;

-- -----------------------------------------------------
-- Table `wc3`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`users` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `activated` TINYINT(1) NOT NULL DEFAULT '1' ,
  `banned` TINYINT(1) NOT NULL DEFAULT '0' ,
  `ban_reason` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_requested` DATETIME NULL DEFAULT NULL ,
  `new_email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_email_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `wc3`.`replays`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`replays` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`replays` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `upload_user_id` INT(11) NOT NULL ,
  `name` VARCHAR(80) NOT NULL ,
  `filepath` VARCHAR(45) NOT NULL ,
  `length` TIME NULL ,
  `player_count` INT NULL ,
  `observers` ENUM('No Observers','Observers on Defeat','Full Observers','Referees') NULL ,
  `game_type` ENUM('Ladder 1vs1/FFA','Custom game','Single player/Local game','Ladder team game (AT/RT)','unknown') NULL ,
  `version` VARCHAR(20) NULL ,
  `speed` ENUM('Slow','Normal','Fast') NULL ,
  `map` VARCHAR(45) NULL ,
  `filesize` VARCHAR(15) NULL ,
  PRIMARY KEY (`id`, `upload_user_id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `filepath_UNIQUE` (`filepath` ASC) ,
  INDEX `fk_replays_users1` (`upload_user_id` ASC) ,
  CONSTRAINT `fk_replays_users1`
    FOREIGN KEY (`upload_user_id` )
    REFERENCES `wc3`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `wc3`.`players`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`players` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`players` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wc3`.`replay_player`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`replay_player` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`replay_player` (
  `replay_id` INT(11) NOT NULL ,
  `players_id` INT(11) NOT NULL ,
  `apm` INT(11) NULL ,
  `race_played` ENUM('orc','human','undead','nightelf') NULL ,
  `actions` INT NULL ,
  `game_time` TIME NULL ,
  `color` ENUM('red','blue','teal','purple','yellow','orange','green','pink','gray','light-blue','dark-green','brown','observer') NOT NULL ,
  PRIMARY KEY (`replay_id`, `players_id`) ,
  INDEX `fk_replay_player_players1` (`players_id` ASC) ,
  CONSTRAINT `fk_replay_player_replays1`
    FOREIGN KEY (`replay_id` )
    REFERENCES `wc3`.`replays` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_replay_player_players1`
    FOREIGN KEY (`players_id` )
    REFERENCES `wc3`.`players` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `wc3`.`ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`ci_sessions` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`ci_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `wc3`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`login_attempts` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `login` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `wc3`.`user_autologin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`user_autologin` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`user_autologin` (
  `key_id` CHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `user_id` INT(11) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`key_id`, `user_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `wc3`.`user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`user_profiles` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `country` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `website` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `wc3`.`chat_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wc3`.`chat_log` ;

CREATE  TABLE IF NOT EXISTS `wc3`.`chat_log` (
  `chat_id` INT NOT NULL AUTO_INCREMENT ,
  `text` VARCHAR(500) NULL ,
  `player_id` INT NOT NULL ,
  `replay_id` INT(11) NOT NULL ,
  `time` TIME NULL ,
  `mode` ENUM('All','Allies','Observers','The game has been paused by','The game has been resumed by') NULL ,
  PRIMARY KEY (`chat_id`, `player_id`, `replay_id`) ,
  UNIQUE INDEX `chat_id_UNIQUE` (`chat_id` ASC) ,
  INDEX `fk_chat_log_players1` (`player_id` ASC) ,
  INDEX `fk_chat_log_replays1` (`replay_id` ASC) ,
  CONSTRAINT `fk_chat_log_players1`
    FOREIGN KEY (`player_id` )
    REFERENCES `wc3`.`players` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chat_log_replays1`
    FOREIGN KEY (`replay_id` )
    REFERENCES `wc3`.`replays` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
