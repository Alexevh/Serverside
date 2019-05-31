CREATE TABLE `practico`.`device` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(45) NULL,
  `created` DATETIME NULL,
  `updated` DATETIME NULL,
  `staus` VARCHAR(45) NULL,
  `os` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
