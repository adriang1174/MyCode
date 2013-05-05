delimiter $$

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tipodoc` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `nrodocumento` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'instructor_1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

