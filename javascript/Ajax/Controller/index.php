<?php

include('ajaxController.php');
$controller = new ajaxController();

if(!empty($_GET) AND  isset($_GET['action'])){
	$action = $_GET['action'];
	$controller->$action();
}
else{
	$controller->acceuil();
}

?>

