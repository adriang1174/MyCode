delimiter $$

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `tipodoc` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `nrodocumento` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `domicilio` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `comparte` char(1) CHARACTER SET utf8 DEFAULT NULL,
  `cuota` int(11) NOT NULL,
  `fechaalta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

