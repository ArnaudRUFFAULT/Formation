<?php
include('config.php');

include('controller/CoreController.php');
include('controller/AcceuilController.php');

include('model/CoreModel.php');
include('model/VilleModel.php');

include('class/Ville.php');


$controller = new AcceuilController();
$controller->setParameters($_GET);
$controller->setData($_POST);

if(!empty($_GET['piece'])){
	$controller->getCities();
}
elseif(!empty($_GET['request'])){
	$controller->getficheVille();
}
else{
	$controller->afficherAcceuil();
}





