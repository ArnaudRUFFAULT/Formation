<?php
//On inclu notre fichier INI avec toutes les constantes nécessaires
include('ini.php');
//On fait appel à notre autoload
spl_autoload_register(function($className){
	$folder = CLASSES_PATH;
	$extension = CLASSES_EXTENSION;
	if (strpos($className, 'Controller') !== false) {
		$folder = CONTROLLERS_PATH;
		$extension = CONTROLLERS_EXTENSION;
	}
	else if (strpos($className, 'Model') !== false) {
		$folder = MODELS_PATH;
		$extension = MODELS_EXTENSION;
	}	
	$filename = $folder . DS . $className . $extension;
	if(file_exists($filename)){
		include($filename);
	}
});
//Notre index indique un controller et une action par defaut si le get est vide
$params = array('c'=>'home','a'=>'listAll');
//Si le get n'est pas vide, on ecrase les valeurs par defaut
$params = array_merge($params,$_GET);
//On définit le nom du controleur à appeler selon notre nomenclature
$controllerName = strtolower($params['c']).'Controller';
//On définit le nom de l'action à invoquer selon notre nomenclature
$actionName = strtolower($params['a']) . 'Action';
//On instancie le controller approprie
if(class_exists($controllerName)){
	$controller = new $controllerName();
	//On entre les information du GET et du POST dans les attributs prévus à cet effet dans la class coreController
	$controller->_setParameters($_GET);
	$controller->_setDatas($_POST);
	//On vérifie que la méthode à invoquer existe , puis si c'est le cas on l'invoque.
	if(method_exists($controller, $actionName)){
		$controller->$actionName();
	}
	else{
		$controller = new errorController();
		$controller->actionInexistanteAction();
	}
}
else{
	$controller = new errorController();
	$controller->controllerInexistantAction();
}






