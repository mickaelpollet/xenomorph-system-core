<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		MANAGER de la Class XUser
 * @author: 	Mickaël POLLET
 * @databaseTables:	x_users, x_users_informations, x_users_rights, x_users_security
 *************************************/

class XUserManager
{

/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

	use XSystem;
	/*  				/!\		En cours de re-développement		/!\						*/
	/*protected $_db; // Instance de PDO.
	protected $_current_id = null;*/
	/*  				/!\		En cours de re-développement		/!\						*/

/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/


/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct() {
		/*  				/!\		En cours de re-développement		/!\						*/
		/*global $XOdbc;
		$this->setDb($XOdbc);*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

	public function setDb(PDO $db) {
		/*  				/!\		En cours de re-développement		/!\						*/
		//$this->_db = $db;
	}

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/


/************************************************************/
/*********************     FONCTIONS     ********************/
/************************************************************/

	public function add($XUser)	{

		/*  				/!\		En cours de re-développement		/!\						*/
		/*
		try {

			if ($this->get($XUser->mail())) {
				throw new XException('00080009', 4, array( 0 => $XUser->mail() ), true);
			}

			$add_user_system_request = $this->_db->prepare('INSERT INTO x_users SET mail = :mail');
			$add_user_system_request->bindValue(':mail', $XUser->mail());
			$add_user_system_request->execute();

			$XUser->set('id', $this->_db->lastInsertId());
			$this->_current_id = $XUser->id();

			$add_user_informations_request = $this->_db->prepare('INSERT INTO x_users_informations SET id_user = :id_user, fname = :fname, lname = :lname, lang = :lang');
			$add_user_informations_request->bindValue(':id_user',	$XUser->id(),			PDO::PARAM_INT);
			$add_user_informations_request->bindValue(':fname',		$XUser->fname(),		PDO::PARAM_STR);
			$add_user_informations_request->bindValue(':lname',		$XUser->lname(),		PDO::PARAM_STR);
			$add_user_informations_request->bindValue(':lang',		$XUser->lang(),			PDO::PARAM_STR);
			$add_user_informations_request->execute();

			$add_user_security_request = $this->_db->prepare('INSERT INTO x_users_security SET id_user = :id_user, password = :password, otp = :otp, certificate = :certificate');
			$add_user_security_request->bindValue(':id_user',		$XUser->id(),			PDO::PARAM_INT);
			$add_user_security_request->bindValue(':password',		$XUser->password(),		PDO::PARAM_STR);
			$add_user_security_request->bindValue(':otp',			$XUser->otp(),			PDO::PARAM_INT);
			$add_user_security_request->bindValue(':certificate',	$XUser->certificate(),	PDO::PARAM_STR);
			$add_user_security_request->execute();

			if ($XUser->rights() == null) {
				$addUserRightsManager = new XRightManager();
				$XUser->setRights($addUserRightsManager->get(1, 1));
			}

			$add_user_rights = $XUser->rights();

			$add_user_rights_request = $this->_db->prepare('INSERT INTO x_users_rights SET id_user = :id_user, id_rights = :id_rights, id_sub_rights = :id_sub_rights');
			$add_user_rights_request->bindValue(':id_user',				$XUser->id(),					PDO::PARAM_INT);
			$add_user_rights_request->bindValue(':id_rights',			$add_user_rights->id_ref(),		PDO::PARAM_INT);
			if ($add_user_rights->type() == 1) {
				$add_user_rights_request->bindValue(':id_sub_rights',	null);
			} else {
				$add_user_rights_request->bindValue(':id_sub_rights',	$add_user_rights->id(),			PDO::PARAM_INT);
			}

			$add_user_rights_request->execute();

			return $XUser;

		} catch (PDOException $pdo) {
			if ($this->_current_id != null) {
				$user = new Xuser();
				$user->set('id', $this->_current_id);
				$this->delete($user);
			}
			throw new XException('0005'.$pdo->errorInfo[1], 4, array( 0 => $pdo->errorInfo[2] ));
		}*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function update($XUser) {
/*  				/!\		En cours de re-développement		/!\						*/
/*
		try {
			$update_user_system_request = $this->_db->prepare('	UPDATE 	x_users
																SET		mail = :mail
																WHERE 	id = :id');

			$update_user_system_request->bindValue(':mail', $XUser->mail(), PDO::PARAM_STR);
			$update_user_system_request->bindValue(':id', $XUser->id(), PDO::PARAM_INT);
			$update_user_system_request->execute();

			$update_users_informations_request = $this->_db->prepare('	UPDATE 	x_users_informations
																		SET 	fname = :fname,
																				lname = :lname,
																				lang = :lang
																		WHERE 	id_user = :id_user');

			$update_users_informations_request->bindValue(':fname', $XUser->fname(), PDO::PARAM_STR);
			$update_users_informations_request->bindValue(':lname', $XUser->lname(), PDO::PARAM_STR);
			$update_users_informations_request->bindValue(':lang', $XUser->lang(), PDO::PARAM_STR);
			$update_users_informations_request->bindValue(':id_user', $XUser->id(), PDO::PARAM_INT);
			$update_users_informations_request->execute();

			$update_user_security_request = $this->_db->prepare('	UPDATE 	x_users_security
																	SET 	password = :password,
																			otp = :otp,
																			certificate = :certificate
																	WHERE 	id_user = :id_user');
			$update_user_security_request->bindValue(':password',		$XUser->password(),		PDO::PARAM_STR);
			$update_user_security_request->bindValue(':otp',			$XUser->otp(),			PDO::PARAM_INT);
			$update_user_security_request->bindValue(':certificate',	$XUser->certificate(),	PDO::PARAM_STR);
			$update_user_security_request->bindValue(':id_user', 		$XUser->id(), 			PDO::PARAM_INT);
			$update_user_security_request->execute();

			$update_user_rights = $XUser->rights();
			$update_user_rights_request = $this->_db->prepare('	UPDATE 	x_users_rights
																SET 	id_rights = :id_rights,
																		id_sub_rights = :id_sub_rights
																WHERE 	id_user = :id_user');
			$update_user_rights_request->bindValue(':id_rights',			$update_user_rights->id_ref(),	PDO::PARAM_INT);
			if ($update_user_rights->type() == 1) {
				$update_user_rights_request->bindValue(':id_sub_rights',	null);
			} else {
				$update_user_rights_request->bindValue(':id_sub_rights',	$update_user_rights->id(),		PDO::PARAM_INT);
			}
			$update_user_rights_request->bindValue(':id_user',				$XUser->id(),					PDO::PARAM_INT);
			$update_user_rights_request->execute();

			return $XUser;

		} catch (PDOException $pdo) {
			throw new XException('0005'.$pdo->errorInfo[1], 4, array( 0 => $pdo->errorInfo[2] ));
		}
	}

	public function authentify($user, $password) {

		try {

			$user_testing = self::get($user);

			if (!$user_testing || $user_testing->password() != passwordHash($password)) {
				return false;
			}

			return true;

		} catch (XException $e) {
			return false;
		}
	}

	public function login($user) {

		/*$checked_user = $this->get($user->id());

		$user_apps_string = '';
		////////////////// Ajouté par Alice //////////////////
		if (is_string($user->apps())) {
			$user_apps_string = $user->apps();
		} else {
		//////////////////////////////////////////////////////
			foreach ($user->apps() as $key => $value) {
				if ($key == 0) {
					$user_apps_string .= $value;
				} else {
					$user_apps_string .= ';'.$value;
				}
			}
		////////////////// Ajouté par Alice //////////////////
		}
		//////////////////////////////////////////////////////
		$update_user_request = $this->_db->prepare('UPDATE users
													SET apps = :apps,
														last_login = :last_login
													WHERE id = :id');

		$update_user_request->bindValue(':apps', $user_apps_string, PDO::PARAM_STR);
		$update_user_request->bindValue(':last_login', date("Y-m-d H:i:s", time()));
		$update_user_request->bindValue(':id', $user->id(), PDO::PARAM_INT);

		Supervision::log('Connexion de l\'utilisateur [ID: '.$user->id().' - ('.$user->mail().')]', 1, 3);

		if (!$update_user_request->execute()) {
			//Supervision::log('Mise à jour impossible de l\'utilisateur [ID: '.$user->id().' - ('.$user->mail().')]', 3, 2);
			//Supervision::log('['.USER_CLASS_TITLE.'] - '.USER_UPDATING_ERROR.implode(" ", $update_user_request->errorInfo()), 3, 4);
			//throw new Exception(USER_UPDATING_ERROR.implode(" ", $update_user_request->errorInfo()));
		}*/
	}

	public function delete($XUser) {
/*  				/!\		En cours de re-développement		/!\						*/
/*
		try {

			$delete_user_request = $this->_db->prepare('DELETE FROM x_users
														WHERE 		id = :id');
			$delete_user_request->bindValue(':id',		$XUser->id(),	PDO::PARAM_INT);
			$delete_user_request->execute();

			$this->log('00080006', 2, array( 0 => $XUser->id(), 1 => $XUser->mail() ), true);

			return true;

		} catch (PDOException $pdo) {
			throw new XException('0005'.$pdo->errorInfo[1], 4, array( 0 => $pdo->errorInfo[2] ));
		}
		*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function get($user) {
/*  				/!\		En cours de re-développement		/!\						*/
/*
		try {

			if (is_string($user) && checkMailAddress(mb_strtolower($user, XConfig('application', 'global_encodage')))) {
				$current_user_to_get = array ( 0 => 'mail', 1 => $user);
				$db_request_param = array('filter' => 'mail', 'filter_restriction' => PDO::PARAM_STR);
			} else {
				$user = (int)$user;
				$current_user_to_get = array ( 0 => 'id', 1 => $user);
				$db_request_param = array('filter' => 'id', 'filter_restriction' => PDO::PARAM_INT);
			}

			$get_user_system_request = $this->_db->prepare('	SELECT *
																FROM x_users_rights, x_users_security, x_users_informations, x_users
																WHERE x_users.id = (SELECT id
																					FROM x_users
																					WHERE '.$db_request_param['filter'].' = :'.$db_request_param['filter'].')
																AND x_users_security.id_user = x_users.id
																AND x_users_informations.id_user = x_users.id
																AND x_users_rights.id_user = x_users.id');
			$get_user_system_request->bindValue(':'.$db_request_param['filter'],	$user,	$db_request_param['filter_restriction']);
			$get_user_system_request->execute();

			$get_user_system_result = $get_user_system_request->fetch(PDO::FETCH_ASSOC);

			if (!$get_user_system_result) {	return false;	}

			$getUserRightsManager = new XRightManager();
			if ($get_user_system_result['id_sub_rights'] != null) {
				$getUserRights = $getUserRightsManager->get($get_user_system_result['id_sub_rights'], 2);
			} else {
				$getUserRights = $getUserRightsManager->get($get_user_system_result['id_rights'], 1);
			}

			unset($get_user_system_result['id_user']);
			unset($get_user_system_result['id_rights']);
			unset($get_user_system_result['id_sub_rights']);

			$get_user = new XUser();
			foreach ($get_user_system_result as $get_user_system_result_key => $get_user_system_result_value) {
				$get_user->set($get_user_system_result_key, $get_user_system_result_value);
			}

			$get_user->set('rights', $getUserRights);

			return $get_user;

		} catch (PDOException $pdo) {
			throw new XException('0005'.$pdo->errorInfo[1], 4, array( 0 => $pdo->errorInfo[2] ));
		}
		*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function getList() {
/*  				/!\		En cours de re-développement		/!\						*/
/*
		try {

			$users = array();

			$get_users_request = $this->_db->prepare('SELECT * FROM x_users');
			$get_users_request->execute();

			$get_users_result = $get_users_request->fetchAll(PDO::FETCH_ASSOC);

			foreach ($get_users_result as $get_users_result_key => $get_users_result_value) {
				//$current_user = new XUserManager();
				$users[$get_users_result_value['id']] = $this->get($get_users_result_value['id']);
			}

			return $users;
		} catch (PDOException $pdo) {
			throw new XException('0005'.$pdo->errorInfo[1], 4, array( 0 => $pdo->errorInfo[2] ));
		}
		*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}


/************************************************************/
/*****************     FIN FONCTIONS     ********************/
/************************************************************/

}

?>
