CREATE TABLE IF NOT EXISTS `PREFIX_gsbtob` (
  `id_gsbtob` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `siret` varchar(255),
  `tva_number` varchar(255),
  `tva_type` varchar(255),
  `type` varchar(255),
  `capital` varchar(255),
  `fax` varchar(32),
  `tel` varchar(32),
  `email` varchar(255),
  `website` varchar(255),
  `status` boolean,
  `activite` varchar(255),
  `employe` varchar(255),
  `commentaire` text,
  `address` varchar(255),
  `postal_code` varchar(255),
  `ville` varchar(255),
  `pays` varchar(255),
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_gsbtob`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `PREFIX_particulier` (
  `id_particulier` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255),
  `lastname` varchar(255) NOT NULL,
  `tel` varchar(32),
  `mobile` varchar(32) NOT NULL,
  `email` varchar(255),
  `website` varchar(255),
  `address` varchar(255),
  `postal_code` varchar(255) NOT NULL,
  `ville` varchar(255),
  `pays` varchar(255),
  `commentaire` text,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id_particulier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
