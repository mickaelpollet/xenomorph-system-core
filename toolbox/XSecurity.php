<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		Security functions page
 * @author: 	Mickaël POLLET
 *************************************/

// Echappe tous les caractères interdits
function securiseDatas($datas) {
	$datas = htmlspecialchars(strip_tags($datas));
	return $datas;
}

// Affiche des étoiles à la place d'une chaîne de caractères
function stringToStars($string) {
	$string = (string)$string;

	if (empty($string)) {
		return '<span class=\'small\'><i>('.userLang('general', 'no_password').')</i></span>';
	} else {
		$response = '';
		for ($i=0; $i < strlen($string); $i++) {
			$response .= '*';
		}
		return $response;
	}
}

// Vérification de la validité de l'adresse mail
function checkMailAddress($address) {
	$Syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	if(preg_match($Syntaxe, $address))
	{
		return true;
	} else {
		return false;
	}
}

// Vérification de la validité du format date (aaaa-mm-dd hh:mm:ss)
function checkDateFormat($date) {
	$syntaxe='#^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) ([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$#';
	if(preg_match($syntaxe,$date)) {
		return true;
	} else {
		return false;
	}
}

// Récupération de l'adresse ip utilisée
function userIp()	{
	if (isset($_SERVER) && isset($_SERVER["REMOTE_ADDR"])) {
		if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv( 'HTTP_X_FORWARDED_FOR' )) {
			$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif (getenv('HTTP_CLIENT_IP')) {
			$realip = getenv( 'HTTP_CLIENT_IP' );
		} else {
			$realip = getenv( 'REMOTE_ADDR' );
		}
	}

	return $realip;
}








































/*****************     FONCTIONS NON DISPONIBLES ENCORE     *****************/
/*function userAccesses($accesses) {
	$user_accesses = true;

	if (count($accesses) == 0) {
		$user_accesses = false;
	}
	$user_rights_level = $_SESSION['session_user']->properties()['rights']['value']->rights_level();
	foreach ($accesses as $accesses_key => $accesses_value) {
		switch ($accesses_key) {
			case 'min': if ($user_rights_level < $accesses_value) { $user_accesses = false; } break;
			case 'equal': if ($user_rights_level != $accesses_value) { $user_accesses = false; } break;
			case 'nequal': if ($user_rights_level == $accesses_value) { $user_accesses = false; } break;
			case 'max': if ($user_rights_level > $accesses_value) { $user_accesses = false; } break;
		}
	}
	return $user_accesses;
}

function passwordCheck($password) {
	$password_score = 0;

	if (preg_match("#[a-z]#", $password)) {	$password_score++;	}
	if (preg_match("#[A-Z]#", $password)) {	$password_score++;	}
	if (preg_match("#[\d]#", $password)) {	$password_score++;	}
	if (preg_match("#[-!§$%&\\\/()=?+*~\#'_:.,;@]#", $password)) {	$password_score++;	}

	if (strlen($password) < globalConfig('security', 'password_digit_min') || $password_score < globalConfig('security', 'security_level_min')) {
		return false;
	}

	return true;
}

function passwordHash($password) {
	return hash('sha512', md5($password.globalConfig('security', 'password_salt')));
}*/
/*****************     FONCTIONS NON DISPONIBLES ENCORE     *****************/
?>
