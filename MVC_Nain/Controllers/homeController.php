<?php
class homeController extends coreController{
	//les attributs parameters et data sont dans la classe parente coreController
	
	/*
	 ** @params
	 ** @action Cette fonction permet l'affichage de la page d'acceuil
	 ** @return 
	  */
	public function listAllAction(){
		$Model = new homeModel();				
		$mesInfo=array();
		$mesInfo['nains']=$Model->getAllNains();
		$mesInfo['villes']=$Model->getAllVilles();
		$mesInfo['tavernes']=$Model->getAllTavernes();
		$mesInfo['groupes']=$Model->getAllGroupes();
		include('Views/Home/homeView.php');				
	}
}