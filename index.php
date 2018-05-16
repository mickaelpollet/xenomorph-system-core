<?php

// Importation de l'autoload de COMPOSER
require __DIR__ . '/vendor/autoload.php';

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
    $XClassExemple = new XExemple();

    // Manager calling with default properties
    echo XExempleManager::hello($XClassExemple);

    echo "<br/>";

    // XClass property setting
    $XClassExemple->setProperty1("Mika");

    // Manager calling with setted properties
    echo XExempleManager::hello($XClassExemple);

  ?>

</body>
