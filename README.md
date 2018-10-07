# Xenomorph Framework - System - Core
# Xenomorph's Framework and Libraries Core
##########################################

# Versionning

v1.5.0
- Suppression des paramètres de configuration Xenomorph qui doivent être gérés sur le Framework et non 'XClass'.
- Mise du code de 'XClass' dans un 'try/catch' général.
- Suppression des 'XException' de 'XClass' pour mettre des 'Exception' à la place. Les 'XException' seront gérées dans le Framework.
- Mise en Français des commentaires et fichiers de version à des fins pratiques. Une réflexion sera faite pour les générer dynamiquement plus tard.
- Ajout du code d'exemple dans un fichier 'exemple.php' à la racine.
- Suppression du répertoire 'config'.
- Suppression des classes 'XUser', 'XLog', 'XException' ainsi que leur 'Manager'. Ces classes seront utilisées dans d'autres modules.
- Ajout de la bibliothèque 'xenomorph-system-toolbox' qui amène les outils du Framework Xenomorph.

v1.4.1
- Correction de la méthode 'Hydrate' qui ne sont pas des propriétés. Ces dernières n'étaient alors plus exécutées.

v1.4.0
- Ajout d'une méthode 'Hydrate' par défaut dans 'XClass'.

v1.3.1
- Correction des objets 'XClassProperty' où les objets ne pouvaient passer dans le 'trim'.

v1.3.0
- Ajout d'un 'trim' sur les chaînes de caractères par défaut dans 'XClass'.
- Ajout d'une classe 'XClassManager', mère des classes 'Manager'.
- Tous les 'Manager' ne sont plus instanciés désormais. Ils sont appelés par 'XClass' qui vérifie si la méthode appelée existe, si ce n'est pas le cas, elle appelle le 'Manager' adéquat. Vérifier 'XExemple' et 'XExempleManager' pour comprendre le fonctionnement.

v1.2.0
- Ajout de 'XUser' et de son 'Manager'.
- Ajout de la configuration système.

v1.1.0
- Ajout d'un exemple de nouvelle 'XClass' pour comprendre le fonctionnement.

v1.0.0
- 'Commit' initial.

# Author
Mickaël POLLET - mickaelpollet@gmail.com

# License
Xenomorph is licensed under the MIT License - see the LICENSE file for details
