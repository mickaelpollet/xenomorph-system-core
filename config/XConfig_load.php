<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		Configuration Loadder
 * @author: 	Mickaël POLLET
 *************************************/

 /***************************************************************/
 /*							Décalration des chemins par défaut							*/
 /***************************************************************/

 define("SITE_ROOT", __DIR__ . "/../");
 define("XCONFIG_PATH", "config/");
 define("TOOLBOX_DIR", "toolbox/");

/****************************************************************/
/*							Chargement des paramètres système								*/
/****************************************************************/

if (!file_exists(SITE_ROOT.XCONFIG_PATH.'XSystem_load.php')) {
	$error_message = 'Impossible d\'accéder au script de chargement du system du framework.';
	include ('views/critical_error.vew.php');
	exit;
}
require_once(SITE_ROOT.XCONFIG_PATH.'XSystem_load.php');

/****************************************************************/
/*					Chargement de l'arbre des droits système						*/
/*  				/!\		En cours de re-développement		/!\						*/
/****************************************************************/
/*$system_rights_manager = new XRightManager();
$system_rights = $system_rights_manager->getList();

if (!$system_rights) {
	$error_message = 'Impossible d\'accéder aux droits d\'utilisateur.';
	include ('views/critical_error.vew.php');
	exit;
}

foreach ($system_rights as $system_rights_key => $system_rights_value) {
	$XSystem_rights[$system_rights_value->rights_level()] = $system_rights_value;
}*/

/****************************************************************/
/*						Chargement du moteur de chifrement								*/
/*  				/!\		En cours de re-développement		/!\						*/
/****************************************************************/
/*if (!file_exists(SITE_ROOT.LIBS_DIR.MIPICRYPT_DIR)) {
	$error_message = 'Impossible d\'accéder au dossier de cryptage Mipicrypt du framework.';
	include ('views/critical_error.vew.php');
	exit;
}
if (!file_exists(SITE_ROOT.LIBS_DIR.MIPICRYPT_DIR.'mipicrypt.php')) {
	$error_message = 'Impossible d\'accéder au script de cryptage Mipicrypt du framework.';
	include ('views/critical_error.vew.php');
	exit;
}
require_once(SITE_ROOT.LIBS_DIR.MIPICRYPT_DIR.'mipicrypt.php');*/

/****************************************************************/
/*	Chargement de la session utilisateur ainsi que des langues	*/
/*  				/!\		En cours de re-développement		/!\						*/
/****************************************************************/
/*if (!file_exists(SITE_ROOT.XCONFIG_PATH.'XSession.php')) {
	$error_message = 'Impossible d\'accéder au script de session du framework.';
	include ('views/critical_error.vew.php');
	exit;
}
require_once(SITE_ROOT.XCONFIG_PATH.'XSession.php');*/

/****************************************************************/
/*			Chargement des paramètres spécifiques				*/
/****************************************************************/
global $PostContainer;
global $GetContainer;
global $SessionContainer;
global $ServerContainer;

$PostContainer = array();
$GetContainer = array();
$SessionContainer = array();
$ServerContainer = array();

foreach ($_POST as $POST_key => $POST_value) {
	$PostContainer[$POST_key] =  $POST_value;
}
foreach ($_GET as $GET_key => $GET_value) {
	$GetContainer[$GET_key] =  $GET_value;
}
/*  				/!\		En cours de re-développement		/!\						*/
/*foreach ($_SESSION as $SESSION_key => $SESSION_value) {
	$SessionContainer[$SESSION_key] =  $SESSION_value;
}*/
foreach ($_SERVER as $SERVER_key => $SERVER_value) {
	$ServerContainer[$SERVER_key] =  $SERVER_value;
}

/********************************************************************/
/*			Chargement du fichier de configuration de l'application			*/
/*  					/!\		En cours de re-développement		/!\							*/
/********************************************************************/
/*if (!file_exists(SITE_ROOT.CONFIG_DIR.'config_load.php')) {
	$error_message = 'Impossible d\'accéder au script de configuration de l\'application.';
	include ('views/critical_error.vew.php');
	exit;
}
require_once(SITE_ROOT.CONFIG_DIR.'config_load.php');*/


/************************************************************/
/*					Chargement des fichiers de version 							*/
/*  				/!\		En cours de re-développement		/!\				*/
/************************************************************/
/*	global $XVersion;
	$XVersion = new XVersion();*/
?>
