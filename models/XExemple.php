<?php
/*************************************
 * @project:  Xenomorph - System - Core
 * @file:		  MODEL CLASS XExemple
 * @author: 	Mickaël POLLET
 *************************************/

class XExemple extends XClass
{

  /******************************************************/
  /*****************     PROPERTIES     *****************/
  /******************************************************/

    // Déclaration des propriétés
    public function setClassProperties() {

      /********************************************/
      /*     Nouvelle méthode de déclaration      */
      /********************************************/
      // Modèle par défaut : Classe XClassProperty : array('name' => '', 'type' => '', 'defaultValue' => '', 'value' => '');
  		$this->property(array('name' => 'property1', 'type' => '', 'defaultValue' => 'world', 'value' => ''));  // Propriété complète
      $this->property(array('name' => 'property2', 'type' => 'string'));                                      // Propriété avec type 'string'
      $this->property(array('name' => 'property3', 'type' => 'integer'));                                     // Propriété avec type 'integer'
      $this->property(array('name' => 'property4', 'type' => 'array'));                                       // Propriété avec type 'array'
      $this->property(array('name' => 'property5', 'type' => 'boolean'));                                     // Propriété avec type 'boolean'
      $this->property(array('name' => 'property6'));                                                          // Propriété avec un simple nom

      /********************************************/
      /*  /!\           OBSOLETE             /!\  */
      /*      Ancienne méthode de déclaration     */
      /********************************************/
      // Modèle par défaut :   $name, $type, $db_location, $with_form, $restrictions = array(), $form_components = array()
      $this->property('oldProperty', 'string', '', '', array(), array());                                     // Propriété complète
      $this->property('oldProperty2');                                                                        // Propriété avec un simple nom
      $this->property('oldProperty3',  'boolean');                                                            // Propriété avec type 'boolean'

  	}

  /******************************************************/
  /***************     END PROPERTIES     ***************/
  /******************************************************/

  /********************************************************/
  /*****************     CONSTRUCTOR     ******************/
  /********************************************************/

    public function __construct($class_datas = array()) {				// Constructeur dirigé vers la méthode d'hydratation
      // Constructeur de XClass
      parent::__construct($class_datas);
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
