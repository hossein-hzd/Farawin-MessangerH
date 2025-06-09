-- SQL script to create the missing "massage" table in the database "hosseindb"

CREATE TABLE IF NOT EXISTS `massage` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `SendID` INT NOT NULL,
  `GetID` INT NOT NULL,
  `Text` TEXT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `idx_sendid` (`SendID`),
  INDEX `idx_getid` (`GetID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
