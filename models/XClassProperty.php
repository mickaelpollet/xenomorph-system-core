<?php
/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		CLASS XUser
 * @author: 	Mickaël POLLET
 *************************************/

class XClassProperty
{
/******************************************************/
/*****************     PARAMETRES     *****************/
/******************************************************/

  private $_name          = null;
  private $_type          = null;
  private $_defaultValue  = null;
  private $_value         = null;

/**********************************************************/
/*****************     FIN PARAMETRES     *****************/
/**********************************************************/

/********************************************************/
/*****************     CONSTRUCTEUR     *****************/
/********************************************************/

	public function __construct($XClassProperty_data = array()) {				// Constructeur dirigé vers la méthode d'hydratation
    $this->hydrate($XClassProperty_data);

    if ($this->value() == null && $this->defaultValue() != null) {
      $this->setValue($this->defaultValue());
    }
	}

/************************************************************/
/*****************     FIN CONSTRUCTEUR     *****************/
/************************************************************/


/*******************************************************/
/*****************     HYDRATATION     *****************/
/*******************************************************/

  private function hydrate($object_data) {
    //if (is_array($object_data)) {
      foreach ($object_data as $object_data_key => $object_data_value) {
        if(method_exists($this, $object_data_key)) {
          if ($object_data_value == '') {
            $object_data_value = null;
          }
          $this->{'set'.ucfirst($object_data_key)}($object_data_value);
        }
      }
    //}
    /* else if (is_a($object_data, get_class($this))) {
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

  public function name() {
    return $this->_name;
  }

  public function type() {
    return $this->_type;
  }

  public function defaultValue() {
    return $this->_defaultValue;
  }

  public function value() {
    return $this->_value;
  }

/*******************************************************/
/*****************     FIN GETTERS     *****************/
/*******************************************************/

/***************************************************/
/*****************     SETTERS     *****************/
/***************************************************/

  public function setName($name) {
    $this->_name = $name;
  }

  public function setType($type) {
    $this->_type = $type;
  }

  public function setDefaultValue($defaultValue) {
    $this->_defaultValue = $defaultValue;
  }

  public function setValue($value) {
    // Rétablissement du 'null' en cas de champ vide
    if ($value ==  '') {
      $value = null;
    }

    // Suppression des espaces avant et après la valeur avant le set
    if (!is_array($value)) {          // SI ce n'est pas un tableau...
      $this->_value = trim($value);   // On applique le trim
    } else {                          // SINON...
      $this->_value = $value;         // On applique directement le tableau
    }
  }

/*******************************************************/
/*****************     FIN SETTERS     *****************/
/*******************************************************/
}
?>
