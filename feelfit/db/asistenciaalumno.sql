delimiter $$

CREATE TABLE `asistenciaalumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horaini` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asistio` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idEquipamiento` int(11) DEFAULT NULL,
  `idInstructor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4512 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

