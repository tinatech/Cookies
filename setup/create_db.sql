SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `Webshop` ;
CREATE SCHEMA IF NOT EXISTS `Webshop` DEFAULT CHARACTER SET utf8 ;
USE `Webshop` ;

-- -----------------------------------------------------
-- Table `Webshop`.`zipcodes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`zipcodes` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`zipcodes` (
  `zipcode` INT NOT NULL ,
  `city` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`zipcode`) ,
  UNIQUE INDEX `zipcode_UNIQUE` (`zipcode` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`user` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`user` (
  `uID` INT NOT NULL AUTO_INCREMENT ,
  `fname` VARCHAR(45) NOT NULL ,
  `sname` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NOT NULL ,
  `zipcode` INT NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `password` CHAR(32) NOT NULL ,
  PRIMARY KEY (`uID`) ,
  INDEX `FK_zipcode` (`zipcode` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uID` ASC) ,
  CONSTRAINT `FK_zipcode`
    FOREIGN KEY (`zipcode` )
    REFERENCES `Webshop`.`zipcodes` (`zipcode` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`worker`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`worker` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`worker` (
  `aID` INT NOT NULL AUTO_INCREMENT ,
  `fname` VARCHAR(45) NOT NULL ,
  `sname` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `username` VARCHAR(10) NOT NULL ,
  `password` CHAR(32) NOT NULL ,
  `admin` BOOL NULL ,
  PRIMARY KEY (`aID`) ,
  UNIQUE INDEX `aid_UNIQUE` (`aID` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`item` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`item` (
  `itemID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `quantity` INT NULL ,
  `desc` VARCHAR(255) NULL ,
  `price` FLOAT NOT NULL ,
  `image` BLOB NULL ,
  PRIMARY KEY (`itemID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`category` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`category` (
  `catID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `desc` VARCHAR(255) NULL ,
  PRIMARY KEY (`catID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`categories` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`categories` (
  `catID` INT NULL ,
  `itemID` INT NULL ,
  INDEX `FK_ca_itemID` (`itemID` ASC) ,
  INDEX `FK_cat_catID` (`catID` ASC) ,
  CONSTRAINT `FK_ca_itemID`
    FOREIGN KEY (`itemID` )
    REFERENCES `Webshop`.`item` (`itemID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_cat_catID`
    FOREIGN KEY (`catID` )
    REFERENCES `Webshop`.`category` (`catID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`order` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`order` (
  `orderID` INT NOT NULL AUTO_INCREMENT ,
  `uid` INT NULL ,
  `status` INT(1) NULL ,
  `time` DATETIME NOT NULL ,
  PRIMARY KEY (`orderID`) ,
  INDEX `FK_order_uid` (`uid` ASC) ,
  CONSTRAINT `FK_order_uid`
    FOREIGN KEY (`uid` )
    REFERENCES `Webshop`.`user` (`uID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`orders` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`orders` (
  `uID` INT NULL ,
  `orderID` INT NULL ,
  INDEX `FK_orders_uid` (`uID` ASC) ,
  INDEX `FK_orders_orderID` (`orderID` ASC) ,
  CONSTRAINT `FK_orders_uid`
    FOREIGN KEY (`uID` )
    REFERENCES `Webshop`.`user` (`uID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_orderID`
    FOREIGN KEY (`orderID` )
    REFERENCES `Webshop`.`order` (`orderID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`orderlines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`orderlines` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`orderlines` (
  `orderLineID` INT NOT NULL AUTO_INCREMENT ,
  `itemID` INT NULL ,
  `orderID` INT NULL ,
  INDEX `FK_orderlines_Itemid` (`itemID` ASC) ,
  INDEX `FK_orderlines_orderID` (`orderID` ASC) ,
  PRIMARY KEY (`orderLineID`) ,
  CONSTRAINT `FK_orderlines_Itemid`
    FOREIGN KEY (`itemID` )
    REFERENCES `Webshop`.`item` (`itemID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_orderlines_orderID`
    FOREIGN KEY (`orderID` )
    REFERENCES `Webshop`.`order` (`orderID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`campaigns`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`campaigns` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`campaigns` (
  `categoryID` INT NOT NULL AUTO_INCREMENT ,
  `cname` VARCHAR(45) NOT NULL ,
  `from` TIMESTAMP NULL ,
  `to` TIMESTAMP NULL ,
  PRIMARY KEY (`categoryID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Webshop`.`camItems`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Webshop`.`camItems` ;

CREATE  TABLE IF NOT EXISTS `Webshop`.`camItems` (
  `itemID` INT NULL ,
  `caID` INT NULL ,
  INDEX `FK_cam_campaigns` (`caID` ASC) ,
  INDEX `FK_cam_item` (`itemID` ASC) ,
  CONSTRAINT `FK_cam_campaigns`
    FOREIGN KEY (`caID` )
    REFERENCES `Webshop`.`campaigns` (`categoryID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_cam_item`
    FOREIGN KEY (`itemID` )
    REFERENCES `Webshop`.`item` (`itemID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Add some data
-- -----------------------------------------------------

-- DEFAULT ADMIN

INSERT INTO worker (aID, fname, sname, email, username, password, admin) VALUES (
	"0" , "Default admin" , "Default admin" , "admin@localhost" , "admin" , md5('admin'), '1');









