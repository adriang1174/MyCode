delimiter $$

CREATE TABLE `rep_asistenciaalumno` (
  `idAlumno` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horaini` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `asistio` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idEquipamiento` int(11) DEFAULT NULL,
  `idInstructor` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$

