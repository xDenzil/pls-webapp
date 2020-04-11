CREATE TABLE `l6ccblkqef08hptd`.`potholes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `latitude` DOUBLE NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `status` VARCHAR(45) NOT NULL DEFAULT 'Normal',
  `date` DATETIME NULL,
  `street` VARCHAR(45) NULL,
  `town` VARCHAR(45) NULL,
  `parish` VARCHAR(45) NULL,
  `repaired` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

  INSERT INTO `potholes` (`longitude`, `latitude`, `detected`) VALUES
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10'),
(-77.915703, 18.468800, '2020-04-10');


USE l6ccblkqef08hptd;
SELECT * from potholes;