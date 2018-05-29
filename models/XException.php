<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:   CLASS XEception
 * @author:   Mickaël POLLET
 *************************************/

 // Importation de XSystem
 require_once(__DIR__ . '/../config/XConfig_load.php');

class XException extends Exception
{

/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

	use XSystem;
	private $_type; // Message de l'exception.
	private $_criticity; // Message de l'exception.
	private $_file; // Message de l'exception.
	private $_line; // Message de l'exception.

/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/


/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct($code, $criticity = 1, array $parameters = array(), $display = 0, $file = null, $line = null) {

		$this->setType((int)substr(sprintf('%08d', $code), 0, 4));
		$this->setCriticity($criticity);
		$this->setFile($file);
		$this->setLine($line);

		// Préparation de l'erreur
		$error = new XLog();
		$error->set('ip_address', userIp());
		$error->set('type', $this->_type);
		$error->set('criticity', $this->_criticity);
		$error->set('code', sprintf('%08d', $code));

		if ($display == 0) {
			$error->set('file', $this->file());
			$error->set('log_line', $this->line());
		} else {
			$error->set('file', NULL);
			$error->set('log_line', NULL);
		}

		$error->set('parameters', $parameters);

		// Mise en table de l'erreur
		$errorManager = new XLogManager();
		$errorManager->add($error);

		// Récupération du message d'erreur
		switch ($criticity) {
			case 1:		syslog(LOG_INFO,	utf8_decode(strip_tags($errorManager->show($error))));	break;
			case 2:		syslog(LOG_INFO,	utf8_decode(strip_tags($errorManager->show($error))));	break;
			case 3:		syslog(LOG_WARNING,	utf8_decode(strip_tags($errorManager->show($error))));	break;
			case 4:		syslog(LOG_ERR,		utf8_decode(strip_tags($errorManager->show($error))));	break;
			case 5:		syslog(LOG_ERR,		utf8_decode(strip_tags($errorManager->show($error))));	break;
			default:	syslog(LOG_INFO,	utf8_decode(strip_tags($errorManager->show($error))));	break;
		}

		parent::__construct($errorManager->show($error), sprintf('%08d', $code));
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/

/***************************************************/
/*****************     GETTERS     *****************/
/***************************************************/

	public function __toString()	{	return $this->message;		}
	public function getType()		{	return $this->_type;		}
	public function getCriticity()	{	return $this->_criticity;	}
	public function file()			{	if ($this->_file != null) {	return $this->_file; } else { return $this->getFile(); } }
	public function line()			{	if ($this->_line != null) {	return $this->_line; } else { return $this->getLine(); } }

/*******************************************************/
/*****************     FIN GETTERS     *****************/
/*******************************************************/


/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

	// Setter chargé d'affecter le type de l'exception
	private function setType($type) {
		$this->_type = $type;
	}

	// Setter chargé d'affecter la criticité de l'exception
	private function setCriticity($criticity) {
		$this->_criticity = $criticity;
	}

	// Setter chargé d'affecter la criticité de l'exception
	private function setFile($file) {
		$this->_file = $file;
	}

	// Setter chargé d'affecter la criticité de l'exception
	private function setLine($line) {
		$this->_line = $line;
	}

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/

/*******************************************************/
/*****************      FONCTIONS       ****************/
/*******************************************************/
/*******************************************************/
/*****************      FONCTIONS       ****************/
/*******************************************************/

}
?>
