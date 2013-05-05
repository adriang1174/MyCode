delimiter $$

CREATE TABLE `equipamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

