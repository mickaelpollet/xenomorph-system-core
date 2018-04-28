<?php
/*************************************
 * @project: 	Xenomorph - System - XClass
 * @file:		MODEL CLASS XClass
 * @author: 	Mickaël POLLET
 *************************************/

//namespace Xenomorph;

class XClass
{
/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

//	use XSystem;
	private $properties = array();


/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/


/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct() {				// Constructeur dirigé vers la méthode d'hydratation
		$this->setClassProperties();
	}

	function __call($method, $params) {
		if ($this->isProperty($method)) {
			return $this->get($method);
		} else if (preg_match("#^set([A-Z].*)$#", $method, $matches)) {
			if ($this->isProperty(lcfirst($matches[1]))) {
				$this->set(lcfirst($matches[1]), $params[0]);
			} else {
	//			throw new XException('00010005', 4, array( 0 => $method, 1 => get_class($this) ));
			}
		} else {
	//		throw new XException('00010005', 4, array( 0 => $method, 1 => get_class($this) ));
		}
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/



/***********************************************************/
/*****************     FIN HYDRATATION     *****************/
/***********************************************************/


/***************************************************/
/*****************     GETTERS     *****************/
/***************************************************/

	public function properties() {
		return $this->properties;
	}

	public function isProperty($name) {
		return isset($this->properties[$name]);
	}

	public function get($property) {
		if ($this->isProperty($property)) {
			return $this->properties[$property]["value"];
		}/* else {
			throw new XException('00010004', 4, array( 0 => $property, 1 => get_class($this) ));
		}*/
	}

/*******************************************************/
/*****************     FIN GETTERS     *****************/
/*******************************************************/

/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

	public function property($property, $type = null, $db_location = null, $with_form = 0, $restrictions = array(), $form_components = array()) {
		$this->properties[$property] = array(	"value"				=> NULL,
												"type"				=> $type,
												"db_location"		=> $db_location,
												"with_form"			=> $with_form,
												"restrictions"		=> $restrictions,
												"form_components"	=> $form_components
											);
	}

	public function set($property, $value) {

		if($this->isProperty($property)) {

			// Si le type de la propriété est connu...
			if (isset($this->properties[$property]["type"])) {

				// Forçage des types majeurs
				switch ($this->properties[$property]["type"]) {
					case 'boolean':		$value_typed = (boolean)$value;		break;
					case 'integer':		$value_typed = (int)$value;			break;
					case 'string':		$value_typed = (string)$value;		break;
					case 'array':		$value_typed = $value;				break;
					case 'datetime':	$value_typed = $value;				break;
					case 'date':		$value_typed = $value;				break;
					default:			$value_typed = $value;				break;
				}

				$current_type = gettype($value_typed);
				if ($current_type != 'object') {
					if ($current_type == $this->properties[$property]["type"] || $current_type == NULL || $current_type == 'NULL' || $this->properties[$property]["type"] == 'date' || $this->properties[$property]["type"] == 'datetime') {
						if ($current_type == 'NULL') { $current_type = NULL; }
						$this->properties[$property]["value"] = $value_typed;
					} else {
				//		throw new XException('00010006', 4, array( 0 => $this->properties[$property]["type"], 1 => $property, 2 => $value_typed, 3 => $current_type ));
					}
				} else {
					if (is_a($value, $this->properties[$property]["type"]) || $current_type == NULL || $current_type == 'NULL') {
						if ($current_type == 'NULL') { $current_type = NULL; }
						$this->properties[$property]["value"] = $value;
					} else {
					//	throw new XException('00010006', 4, array( 0 => $this->properties[$property]["type"], 1 => $property, 2 => $value, 3 => $current_type ));
					}
				}
			} else {
				$this->properties[$property]["value"] = $value;
			}
		}
	}

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/

/*******************************************************/
/*****************       FONCTION      *****************/
/*******************************************************/

/*******************************************************/
/*****************       FONCTION      *****************/
/*******************************************************/
}
?>
