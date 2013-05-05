delimiter $$

CREATE TABLE `disponibilidadinstructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idInstructor` int(11) DEFAULT NULL,
  `idEquipamiento` int(11) DEFAULT NULL,
  `rangodias` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `fechaespec` date DEFAULT NULL,
  `horaini` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horafin` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

