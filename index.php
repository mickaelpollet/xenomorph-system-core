<?php

/*************************************
 * @project: 	Xenomorph - System - Core
 * @file:		Globals fonctions page
 * @author: 	Mickaël POLLET
 *************************************/

 // Importation de XSystem
 require_once(__DIR__ . '/config/XConfig_load.php');

?>

<html>

<head>
</head>
<body>

  <h1>XENOMORPH - System : Core</h1>

  Concerning XClasses, you have the following exemple :

  <?php

    echo "<br/>";

    // XClass instanciating
    // Method 1
    $XClassExemple = new XExemple();
    // Method 2
    $XClassExempleValues = array();
    $XClassExempleValues['property1'] = 'Mika';
    $XClassExemple2 = new XExemple(array('property1' => 'Mika'));

    // XClass property setting
    $XClassExemple->setProperty1("Mika");

    // Asking Manager method
    /*
    * The Manager Object and his method are automaticly called by XClass
    * You don't have to instanciate Manager anymore
    */
    $XClassExemple->hello();
    echo "<br/>";
    $XClassExemple2->hello();

    $test = new XClassProperty(array(
        'name' => 'test',
        'type' => 'string',
        'defaultValue' => '1',
        'value' => '2'
      )
    );
    //var_dump($test);

  ?>

</body>
