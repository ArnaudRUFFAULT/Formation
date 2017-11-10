<?php
include('model.php');
if(empty($_POST)){
	$model = new Model;
	$results= $model->afficherHistorique();
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($results);
}
else{
	$model = new Model;
	$model->ajouterMessage($_POST['contenu'],$_POST['auteur']);
}

