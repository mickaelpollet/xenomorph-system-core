<?php
/*************************************
 * @project: 	Xenomorph - Models - XExemple
 * @file:		MODEL CLASS XExemple
 * @author: 	Mickaël POLLET
 *************************************/

class XExemple extends XClass
{

  /******************************************************/
  /*****************     PROPERTIES     *****************/
  /******************************************************/

  // Default properties
  private $_property1_default   = 'world';

  // Properties declaration
  public function setClassProperties() {
		$this->property('property1');                 // Property with no typing
    $this->property('property2',  'string');      // Property with string typing
    $this->property('property3',  'integer');     // Property with integer typing
    $this->property('property4',  'array');       // Property with array typing
    $this->property('property5',  'boolean');     // Property with boolean typing
	}

  /******************************************************/
  /***************     END PROPERTIES     ***************/
  /******************************************************/

  /********************************************************/
  /*****************     CONSTRUCTOR     ******************/
  /********************************************************/
  public function __construct($class_datas = array()) {				// Constructeur dirigé vers la méthode d'hydratation

    // Parent constructor
    parent::__construct();

    // Default constructor
    if ($this->property1() == null) {
      $this->setProperty1($this->_property1_default);
    }

  }
  /********************************************************/
  /**************     END CONSTRUCTOR     *****************/
  /********************************************************/

  /***************************************************/
  /*****************     GETTERS     *****************/
  /***************************************************/
  /*******************************************************/
  /*****************     END GETTERS     *****************/
  /*******************************************************/

  /***************************************************/
  /*****************     SETTERS     *****************/
  /***************************************************/
  /*******************************************************/
  /*****************     END SETTERS     *****************/
  /*******************************************************/

}

?>
