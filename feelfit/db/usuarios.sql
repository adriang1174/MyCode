delimiter $$

CREATE TABLE `usuarios` (
  `login` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `idPerfil` int(11) NOT NULL DEFAULT '0',
  `idlogin` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idlogin`),
  UNIQUE KEY `XPKusuarios` (`login`),
  KEY `idPerfil` (`idPerfil`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1$$

