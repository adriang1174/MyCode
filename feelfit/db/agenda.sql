delimiter $$

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) DEFAULT NULL,
  `idEquipamiento` int(11) DEFAULT NULL,
  `rangodias` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `fechaespec` date DEFAULT NULL,
  `horaini` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `horafin` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `mediahora` int(11) DEFAULT NULL,
  `comparte` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `fechavigd` date NOT NULL DEFAULT '2001-01-01',
  `fechavig` date NOT NULL DEFAULT '2099-12-31',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1747 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

