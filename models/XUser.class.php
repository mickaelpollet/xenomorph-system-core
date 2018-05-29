<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		CLASS XUser
 * @author: 	Mickaël POLLET
 *************************************/

class XUser extends XClass
{
/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

	use XSystem;

	public function setClassProperties() {
		$this->mainDatabaseTable('x_users');
		$this->mainDatabaseTableRef('id_user');
		$this->property('id',			'integer',	'x_users',				0, array (	'min' => '1'));
		$this->property('mail',			'string',	'x_users',				1, array (	'data_type' => 'mail' ));
		$this->property('password',		'string',	'x_users_security',		1);
		$this->property('otp',			'integer',	'x_users_security',		1);
		$this->property('certificate',	'string',	'x_users_security',		1);
		$this->property('fname',		'string',	'x_users_informations',	1);
		$this->property('lname',		'string',	'x_users_informations',	1);
		$this->property('lang',			'string',	'x_users_informations',	1);
		$this->property('rights',		'XRight',	'x_users_rights',		1);
		$this->property('creationDate',	'datetime',	'x_users');
	}

/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/

/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct($user_datas = array()) {				// Constructeur dirigé vers la méthode d'hydratation
		parent::__construct();
		if (is_array($user_datas) || is_a($user_datas, get_class($this))) {
			/*  				/!\		En cours de re-développement		/!\						*/
			//$this->set('lang', XConfig('application', 'default_lang'));
			/*  				/!\		En cours de re-développement		/!\						*/
			$this->hydrate($user_datas);
		} else {
			throw new XException('00010002', 4, array( 0 => get_class($this) ));
		}
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/

	private function hydrate($user_datas) {
		if (is_array($user_datas)) {
			foreach ($user_datas as $user_datas_key => $user_datas_value) {
				$this->{'set'.ucfirst($user_datas_key)}($user_datas_value);
			}
		} else if (is_a($user_datas, get_class($this))) {
			foreach ($this->properties() as $properties_key => $properties_value) {
				$this->{'set'.ucfirst($properties_value)}($user_datas->$properties_value());
			}
		} else {
			throw new XException('00010003', 4, array( 0 => get_class($this) ));
		}
	}

/***********************************************************/
/*****************     FIN HYDRATATION     *****************/
/***********************************************************/


/***************************************************/
/*****************     GETTERS     *****************/
/***************************************************/
/*******************************************************/
/*****************     FIN GETTERS     *****************/
/*******************************************************/

/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

	// Setter chargé d'affecter l'adresse mail de l'utilisateur
	public function setMail($mail) {
		if (checkMailAddress($mail)) {
			$this->set('mail', mb_strtolower($mail, XConfig('application', 'global_encodage')));
		} else {
			throw new XException('00080001', 4, array( 0 => $mail));
		}
	}

	// Setter chargé d'affecter le prénom de l'utilisateur
	public function setFname($fname) {
		$min_fname = mb_strtolower($fname, XConfig('application', 'global_encodage'));		// Mise en minuscule de tout le prénom pour le retravailler
		$fname = str_replace(' ', '-', $fname);													// Remplacement des espaces par des tirets
		$fname_exploded = explode('-', $fname);													// Recherche des particules
		$final_fname = '';																		// Initialisation de la variable finale du prénom
		foreach ($fname_exploded as $fname_exploded_key => $fname_exploded_value) {				// Mise en majuscule de chaque première lettre de chaque particule
			if ($fname_exploded_key != 0 && $fname_exploded[$fname_exploded_key-1] != '') {
				$final_fname .= '-'.ucfirst($fname_exploded_value);								// Ajout du tiret si besoin
			} else {
				$final_fname .= ucfirst($fname_exploded_value);
			}
		}
		$this->set('fname', $final_fname);
	}

	// Setter chargé d'affecter le nom de l'utilisateur
	public function setLname($lname) {
		$min_lname = mb_strtoupper($lname, XConfig('application', 'global_encodage'));
		$lname_exploded = explode('-', $min_lname);												// Recherche des particules
		$final_lname = '';																		// Initialisation de la variable finale du nom
		foreach ($lname_exploded as $lname_exploded_key => $lname_exploded_value) {				// Mise en majuscule de chaque particule
			if ($lname_exploded_key != 0 && $lname_exploded[$lname_exploded_key-1] != '') {
				$final_lname .= '-'.mb_strtoupper($lname_exploded_value, XConfig('application', 'global_encodage'));				// Ajout du tiret si besoin
			} else {
				$final_lname .= mb_strtoupper($lname_exploded_value, XConfig('application', 'global_encodage'));
			}
		}
		$this->set('lname', $final_lname);
	}

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/
}
?>
