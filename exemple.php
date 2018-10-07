<?php

  // Instanciation d'une classe 'XClass'
  // Méthode 1 : Un objet vide
  $XClassExemple = new XExemple();
  // Method 2 : Un objet hydraté
  $XClassExempleValues = array();
  $XClassExempleValues['property1'] = 'Mika';
  $XClassExemple2 = new XExemple(array('property1' => 'Mika'));

  // Utilisation d'un 'setter' avec une classe 'XClass'
  // On appelle la méthode générique 'setMaPropriété' pour attribuer une valeur à la propriété 'maPropriété'
  $XClassExemple->setProperty1("Mika");   // Attribue une valeur à la propriété 'property1'

  // Appelle d'une méthode de manager
  /*
  * L'instanciation du 'Manager' et l'appel de sa méthode sont automatiquement réalisés par 'XClass'
  * Il n'y a plus à instancier un objet 'Manager' désormais
  */
  $XClassExemple->hello();
  $XClassExemple2->hello();

?>
