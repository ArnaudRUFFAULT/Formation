<?php
class ProduitController extends CoreController{
	public function vitrineView(array $products = null){
		include('./Views/Produit/vitrineView.php');
	}

	public function getAllProducts(){
		$model = new ProduitModel();
		try{
			$products = $model->getAllProducts();
			$this->vitrineView($products);
		}
		catch(Exception $e){
			$this->connexionView(array('error'=>'Problème de connexion à la base de donnée, veuillez réessayer plus tard'));
		}		
	}
}