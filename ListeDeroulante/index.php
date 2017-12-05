<?php
include('config.php');

include('controller/CoreController.php');
include('controller/AcceuilController.php');

include('model/CoreModel.php');
include('model/DepartementModel.php');
include('model/PaysModel.php');
include('model/VilleModel.php');

include('class/Ville.php');


$controller = new AcceuilController();
$controller->setParameters($_GET);
$controller->setData($_POST);
if(empty($_POST)){
	$controller->afficherAcceuil();
}
else if(!empty($_POST['idPays'])){
	$controller->requestDepartement();
}

else if(!empty($_POST['idDepartement'])){
	$controller->requestVille();
}

else if(!empty($_POST['idVille'])){
	$controller->requestCaracteristiqueVille();
}


