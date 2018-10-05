<?php
/*************************************
 * @project:  Xenomorph - System - Core
 * @file:		  MODEL CLASS XClass
 * @author: 	Mickaël POLLET
 *************************************/

 // Importation de XSystem
 require_once(__DIR__ . '/../config/XConfig_load.php');

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

  // Constructeur global de la classe
	public function __construct($XClass_data = null) {
		$this->setClassProperties();
    $this->hydrate($XClass_data);
	}

  // Qualification de la méthode appelée
	function __call($method, $params) {

    // Vérification de l'existance de la méthode
		if ($this->isProperty($method)) {
      // SI la méthode existe dans les propriétés, c'est qu'il s'agit d'un getter
      // On appelle donc le getter concerné
			return $this->get($method);
		} else if (preg_match("#^set([A-Z].*)$#", $method, $matches)) {
      // SINON, on vérifie si la méthode est un setter, qualifié par le mot clé 'set' suivi d'une majuscule
			if ($this->isProperty(lcfirst($matches[1]))) {
        // SI C'est le cas, on envoi la valeur au setter
				$this->set(lcfirst($matches[1]), $params[0]);
			} else {
        // SINON on catch l'erreur
			  //throw new XException('00010005', 4, array( 0 => $method, 1 => get_class($this) ));
			}
		} else {
      // SINON, il ne s'agit ni d'un getter, ni d'un setter, on vérifie donc si il s'agit d'une méthode du Manager du modèle

      // Vérification de l'existance d'un Manager pour ce modèle
      if (class_exists(get_class($this).'Manager')) {

        $class_name = get_class($this).'Manager';               // Préparation du nom de la classe du Manager
        $current_manager_class = new $class_name($this);        // Instanciation du Manager

        if (method_exists($current_manager_class, $method)) {   // SI la méthode existe pour le Manager...
          $current_manager_class->$method($params);             // On appelle la méthode dans le manager
        }
      } else {
        //		throw new XException('00010005', 4, array( 0 => $method, 1 => get_class($this) ));
      }
		}
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/

  private function hydrate($object_data) {

    if (is_array($object_data)) {
      foreach ($object_data as $object_data_key => $object_data_value) {

        if($this->isProperty($object_data_key) || method_exists($this, 'set'.ucfirst($object_data_key))) {
          if ($object_data_value == '') {
            $object_data_value = null;
          }

          $this->{'set'.ucfirst($object_data_key)}($object_data_value);
        }
      }
    } else if (is_a($object_data, get_class($this))) {
      foreach ($this->properties() as $properties_key => $properties_value) {
        $this->{'set'.ucfirst($properties_value)}($object_data->$properties_value());
      }
    }/* else {
      throw new XException('00010003', 4, array( 0 => get_class($this) ));
    }*/
  }

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
			return $this->properties[$property]->value();
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

	public function property($name, $type = null, $db_location = null, $with_form = 0, $restrictions = array(), $form_components = array()) {

    if (is_a($name, 'XClassProperty')) {
      $this->properties[$name->name()] = $name;
    } else {
      if (is_array($name)) {
        $current_property = new XClassProperty($name);
        $this->properties[$current_property->name()] = $current_property;
      } else {

        $current_property = new XClassProperty(
                                                array(
                                                  'name'  =>  $name,
                                                  'type'  =>  $type,
                                                  'defaultValue'  =>  null,
                                                  'value'   =>  null,
                                                  'db_location' => $db_location
                                                )
                                              );

        $this->properties[$name] = $current_property;

      }
    }
	}

	public function set($property, $value) {

    // Vérification que la propriété existe bien
		if ($this->isProperty($property)) {

			// Si le type de la propriété est connu...
			/*if ($this->properties[$property]->type() != null) {

				// Forçage des types majeurs
				switch ($this->properties[$property]->type()) {
					case 'boolean':  $value_typed = (boolean)$value; break;
					case 'integer':  $value_typed = (int)$value;		 break;
					case 'string':   $value_typed = (string)$value;	 break;
					case 'array':    $value_typed = $value;				   break;
					case 'datetime': $value_typed = $value;				   break;
					case 'date':     $value_typed = $value;			     break;
					default:         $value_typed = $value;			     break;
				}

				$current_type = gettype($value_typed);

				if ($current_type != 'object') {
					if ($current_type == $this->properties[$property]->type() ||
              $current_type == NULL ||
              $this->properties[$property]->type() == 'date' ||
              $this->properties[$property]->type() == 'datetime') {
						if ($current_type == 'NULL') { $current_type = NULL; }
						$this->properties[$property]->setValue($value_typed);
					} else {
				//		throw new XException('00010006', 4, array( 0 => $this->properties[$property]["type"], 1 => $property, 2 => $value_typed, 3 => $current_type ));
					}
				} else {
					if (is_a($value, $this->properties[$property]->type()) || $current_type == NULL || $current_type == 'NULL') {
						if ($current_type == 'NULL') { $current_type = NULL; }
						//$this->properties[$property]["value"] = $value;
            $this->properties[$property]->setValue($value);
					} else {
					//	throw new XException('00010006', 4, array( 0 => $this->properties[$property]["type"], 1 => $property, 2 => $value, 3 => $current_type ));
					}
				}
			} else {*/
				//$this->properties[$property]["value"] = $value;

        $this->properties[$property]->setValue($value);
			//}
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
