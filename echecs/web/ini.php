<?php
//Parametres de connexion à la BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'echecs');
define('DB_USER', 'root');
define('DB_PASS','');

//Constante à modifier pour l'autoload
define('DS',DIRECTORY_SEPARATOR);
define('CLASSES_PATH', '.' . DS . 'Class');
define('CLASSES_EXTENSION', '.class.php');
define('CONTROLLERS_PATH', 'Controllers');
define('CONTROLLERS_EXTENSION', '.php');
define('MODELS_PATH', 'Models');
define('MODELS_EXTENSION', '.php');
define('HANDLERS_PATH', 'Handlers');
define('HANDLERS_EXTENSION', '.php');

//Constante à modifier pour l'inscription
define('MIN_PSEUDO', 5);
define('MAX_PSEUDO', 10);