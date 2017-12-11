<?php
class CommandeController extends CoreController{

	public function choixServices(){
		$commande = $this->recupCommande($this->session['user'],$this->data['idProduit']);
		$services = $this-> getPrestations();
		$this->viewServices($commande,$services);	
	}

	private function recupCommande($idClient,$idProduit){
		$client = $this->getUser($idClient);
		$produit = $this->getProduit($idProduit);
		$date = new DateTime();
		return new Commande($client, $produit, $date);
	}

	public function viewServices($commande,$services){
		include('./Views/Commande/selectServicesView.php');
	}

	private function getProduit($idProduit){
		$model = new ProduitModel();
		return $model->getProduct($idProduit);
	}

	private function getUser($idUser){
		$model = new UserModel();
		return $model->getUser($idUser);
	}

	private function getPrestations(){
		$model = new PrestationModel();
		return $model ->getPrestations();
	}

	public function calculerprix(){
		$commande = $this->recupCommande($this->session['user'],$this->data['idProduit']);
		$commande->setServices($this->data);
		include('./Views/Commande/resumeCommandeView.php');
	}

	public function validationCommande(){
		$model = new CommandeModel();
		try{
			if($model->Update($this->data)){	
				if(isset($this->data['Livraison'])){
					$model = new ProduitModel();
					$produit = $model->getProduct($this->data['idProduit']);
					if($produit != false){
						$this->preparer_livraison($produit);
					}
				}
				else{
					echo '<p>Votre commande est validée</p>';
					echo '<a href="index.php?controller=produit&action=getAllProducts">Vitrine</a>';
				}
			}
			else{
				echo 'Validation de la commande impossible, veuillez reessayer plus tard';
			}

		}
		catch(Exception $e){
			echo 'probleme lors de l\'enregistrement de la commande dans la base de donnes <br />';
		}
		
	}

	private function preparer_livraison(Produit $produit){
		echo 'Votre Commande est validée, la livraison de votre produit est en cours<br />';
		echo '<a href="index.php?controller=produit&action=getAllProducts">Vitrine</a>';
	}
}