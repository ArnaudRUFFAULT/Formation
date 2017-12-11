<?php
class CommandeModel extends CoreModel{

	public function Update(array $data){
		if($this->checkProduit($data['idProduit'])){
			echo 'le produit est encore en vente, check <br />';
			if($this->addCommande($data)){
				echo 'commande enregistree, check <br />';
				$idCommande = $this->getCommandeId($data['idClient'],$data['idProduit']);
				echo 'on recupere l\'id de la commande, check <br />';
				if($this->AddServicesDB($data,$idCommande)){
					echo 'on met a jour les tarif de la BDD, check <br />';
					return true;
				}
				echo 'les tarif ne sont pas mis a jour <br />';
				return false;
			}
			echo 'commande non enregistree<br />';
			return false;
		}
		echo 'produit deja vendu <br />';
		return false;
	}

	private function checkProduit($id){
		$sql = 'SELECT p_sold FROM produit WHERE p_id = :id';
		$params = array('id' => $id);
		$request = $this->makeSelect($sql,$params);
		$result = array();
		foreach ($request as $key => $value) {
			$result[] = $value['p_sold'];
		}
		if($result[0] == 0){
			return true;
		}
		return false;
	}

	private function addCommande(array $data){
		$sql = 'INSERT INTO commande (c_user_fk, c_produit_fk, c_prix, c_date) VALUES (:user,:produit,:prix,:dateCommande);
		UPDATE produit SET p_sold = 1 WHERE p_id=:produit';
		$params = array(
			'user'=>$data['idClient'],
			'produit'=>$data['idProduit'],
			'prix'=>$data['Total'],
			'dateCommande'=>'CURRENT_TIME()'
		);
		if($request = $this->makeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	private function AddServicesDB(array $data, $idCommande){
		if(isset($data['Livraison']) || isset($data['Installaion']) || isset($data['Papier_Cadeau']) || isset($data['Extension_de_Garantie'])){
			$sql = '';
			$params = array();
			$params['commande'] = $idCommande;
			if(isset($data['Livraison'])){
				$sql=$sql.'INSERT INTO tarif (t_commande_fk, t_service_fk, t_montant) VALUES (:commande, :livraison, :montantLivraison);';
				$params['livraison'] = 1;
				$params['montantLivraison'] = $data['Livraison'];
			}
			if(isset($data['Installation'])){
				$sql=$sql.'INSERT INTO tarif (t_commande_fk, t_service_fk, t_montant) VALUES (:commande, :installation, :montantInstallation);';
				$params['installation'] = 2;
				$params['montantInstallation'] = $data['Installation'];
			}
			if(isset($data['Papier_Cadeau'])){
				$sql=$sql.'INSERT INTO tarif (t_commande_fk, t_service_fk, t_montant, t_message) VALUES (:commande, :cadeau, :montantCadeau, :message);';
				$params['cadeau'] = 3;
				$params['montantCadeau'] = $data['Papier_Cadeau'];
				$params['message'] = $data['message'];
			}
			if(isset($data['Extension_de_Garantie'])){
				$sql=$sql.'INSERT INTO tarif (t_commande_fk, t_service_fk, t_montant, t_annees) VALUES (:commande, :garantie, :montantGarantie, :annees);';
				$params['garantie'] = 4;
				$params['montantGarantie'] = $data['Extension_de_Garantie'];
				$params['annees'] = $data['NbAnneesGarantie'];
			}
			if($request = $this->makeStatement($sql,$params)){
				return true;
			}
			return false;
		}
		return true;
	}

	private function getCommandeId($client,$produit){
		$sql = 'SELECT c_id FROM commande WHERE c_user_fk=:client AND c_produit_fk=:produit';
		$params = array('client'=>$client, 'produit'=>$produit);
		$request = $this->makeSelect($sql,$params);
		$commande = array();
		foreach ($request as $key => $value) {
			$commande[] = $value['c_id'];
		}
		return $commande[0];
	}
}