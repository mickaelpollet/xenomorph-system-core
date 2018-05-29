<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		MANAGER de la Class XLog
 * @author: 	Mickaël POLLET
 * @databaseTables:	x_logs
 *************************************/

 // Importation de XSystem
 require_once(__DIR__ . '/../../config/XConfig_load.php');

class XLogManager
{
/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

	use XSystem;
  /*  				/!\		En cours de re-développement		/!\						*/
	//private $_db; // Instance de PDO.

/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/


/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct() {
		/*  				/!\		En cours de re-développement		/!\						*/
		//global $XOdbc;
		//$this->setDb($XOdbc);
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

	public function setDb($db) {

		$this->_db = $db;
	}

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/


/************************************************************/
/*********************     FONCTIONS     ********************/
/************************************************************/

	public function add(XLog $XLog)	{
		/*  				/!\		En cours de re-développement		/!\						*/
		/*if ($this->_db) {
			$add_log_request = $this->_db->prepare('	INSERT INTO x_logs
														SET ip_address = :ip_address,
															type = :type,
															criticity = :criticity,
															code = :code,
															file = :file,
															log_line = :log_line,
															parameters = :parameters');
			$add_log_request->bindValue(':ip_address',	$XLog->ip_address(),	PDO::PARAM_STR);
			$add_log_request->bindValue(':type',		$XLog->type(),			PDO::PARAM_INT);
			$add_log_request->bindValue(':criticity',	$XLog->criticity(),		PDO::PARAM_INT);
			$add_log_request->bindValue(':code',		$XLog->code(),			PDO::PARAM_STR);
			$add_log_request->bindValue(':file',		$XLog->file(),			PDO::PARAM_STR);
			$add_log_request->bindValue(':log_line',	$XLog->log_line(),		PDO::PARAM_INT);
			$add_log_request->bindValue(':parameters',	base64_encode(json_encode($XLog->parameters())),		PDO::PARAM_STR);

			$add_log_request->execute();
		}*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}


	public function delete(XLog $XLog) {
/*  				/!\		En cours de re-développement		/!\						*/
		/*$delete_log_request = $this->_db->prepare('	DELETE FROM x_logs
													WHERE id = :id');
		$delete_log_request->bindValue(':id',	$XLog->id(),	PDO::PARAM_INT);

		$delete_log_request->execute();*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function show(XLog $XLog) {
		return $this->systemMessage(XConfig('logs_types', $XLog->type()), $XLog->code(), $XLog->parameters(), $XLog->file(), $XLog->log_line());
	}

	public function get($id) {
/*  				/!\		En cours de re-développement		/!\						*/
		/*$get_log_request = $this->_db->prepare('	SELECT * FROM x_logs
													WHERE id = :id');
		$get_log_request->bindValue(':id',	$id,	PDO::PARAM_INT);
		$get_log_request->execute();

		$get_log_result = $get_log_request->fetch(PDO::FETCH_ASSOC);

		$getted_log = new XLog();
		$getted_log->set('id', $get_log_result['id']);
		$getted_log->set('date', $get_log_result['date']);
		$getted_log->set('ip_address', $get_log_result['ip_address']);
		$getted_log->set('type', $get_log_result['type']);
		$getted_log->set('criticity', $get_log_result['criticity']);
		$getted_log->set('code', $get_log_result['code']);
		$getted_log->set('file', $get_log_result['file']);
		$getted_log->set('log_line', $get_log_result['log_line']);
		$getted_log->set('parameters', json_decode(base64_decode($get_log_result['parameters'])));

		return $getted_log;*/
/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function getList($filter = array()) {
/*  				/!\		En cours de re-développement		/!\						*/
		/*if (count($filter) > 0) {

			// Initialisation du conteneur à retourner
			$logs_list = array();

			// Comptage de chaque niveau de criticité contenu dans la table
			$get_log_total_request = $this->_db->prepare('SELECT criticity, count(*) FROM x_logs GROUP BY criticity');
			$get_log_total_request->execute();
			$get_log_total = $get_log_total_request->fetchAll(PDO::FETCH_ASSOC);
			// Comptage du nombre total de logs présents dans la table
			$total_logs = 0;
			foreach ($get_log_total as $get_log_total_key => $get_log_total_value) {
				$logs_list[XConfig('logs_criticity', $get_log_total_value['criticity'])] = $get_log_total_value['count(*)'];
				$total_logs = $total_logs + $get_log_total_value['count(*)'];
			}
			$logs_list['total_logs'] = $total_logs;
			if ($filter['crit'] == null) {																								// SI il n'y a pas de filtre de criticité...

				// Récupération du premier id de la table
				$last_log_id_request = $this->_db->prepare('SELECT id FROM x_logs ORDER BY id DESC LIMIT 1');							// On récupère les logs généraux
				$last_log_id_request->execute();
				$last_log_id_result = $last_log_id_request->fetch(PDO::FETCH_ASSOC);
				$crit_filter = 'WHERE id > '.($last_log_id_result['id'] - ($filter['pagination'] * $filter['current_page'])).' ';

			} else {

				if ($filter['current_page'] != 1) {
					$limit = $filter['pagination'] * $filter['current_page'];
				} else {
					$limit = 1 + $filter['pagination'];
				}
				// Récupération du premier id de la table aavec cette criticité
				$last_log_id_request2 = $this->_db->prepare('SELECT id FROM x_logs  WHERE criticity = '.$filter['crit'].' ORDER BY id DESC LIMIT '.$limit);
				$last_log_id_request2->execute();
				$last_log_id_result2 = $last_log_id_request2->fetchAll(PDO::FETCH_ASSOC);
				$crit_filter = 'WHERE id > '.(end($last_log_id_result2)['id'] - 1).' ';
				$crit_filter .= 'AND criticity = '.$filter['crit'].' ';

			}

			$get_log_request = $this->_db->prepare('SELECT * FROM (SELECT * FROM x_logs '.$crit_filter.'ORDER BY id LIMIT '.$filter['pagination'].') AS logs ORDER BY id DESC');
		} else {
			$get_log_request = $this->_db->prepare('SELECT * FROM x_logs');
		}
		$log_parsed_list = array();

		$get_log_request->execute();
		$get_log_result = $get_log_request->fetchAll(PDO::FETCH_ASSOC);

		foreach ($get_log_result as $get_log_result_key => $get_log_result_value) {
			$current_getted_log = new XLog();
			$current_getted_log->set('id', $get_log_result_value['id']);
			$current_getted_log->set('date', $get_log_result_value['date']);
			$current_getted_log->set('ip_address', $get_log_result_value['ip_address']);
			$current_getted_log->set('type', $get_log_result_value['type']);
			$current_getted_log->set('criticity', $get_log_result_value['criticity']);
			$current_getted_log->set('code', $get_log_result_value['code']);
			$current_getted_log->set('file', $get_log_result_value['file']);
			$current_getted_log->set('log_line', $get_log_result_value['log_line']);
			$current_getted_log->set('parameters', json_decode(base64_decode($get_log_result_value['parameters'])));
			$log_parsed_list[] = $current_getted_log;
		}

		$logs_list['logs'] = $log_parsed_list;
		return $logs_list;*/
/*  				/!\		En cours de re-développement		/!\						*/
	}

	public function getArch()
	{
		/*  				/!\		En cours de re-développement		/!\						*/
	/*	$sizeTampon = 10000;

		$logsList = array();

		$get_logs_request = $this->_db->prepare('SELECT * FROM x_logs WHERE date < :limit_date LIMIT '.$sizeTampon);
		$get_logs_request->bindValue(':limit_date',	date('Y-m-d', strtotime('-1 week')).' 23:59:59', PDO::PARAM_STR);
		$get_logs_request->execute();
		$logsList = $get_logs_request->fetchAll(PDO::FETCH_ASSOC);

		foreach ($logsList as $key => $value) {
			$tmpLog = new XLog();
			$tmpLog->hydrate($value);
			$logsList[$key] = $tmpLog;
		}
		return $logsList;*/
		/*  				/!\		En cours de re-développement		/!\						*/
	}

/************************************************************/
/*****************     FIN FONCTIONS     ********************/
/************************************************************/

}

?>
