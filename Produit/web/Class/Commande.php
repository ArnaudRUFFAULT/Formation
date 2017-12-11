<?php
class Commande {
	private $id = null;
	private $client;
	private $produit;
	private $prix;
	private $date;
	private $services = array();

	public function __construct($client, $produit, $date){
		$this->client = $client;
		$this->produit = $produit;
		$this->date = $date;
	}

	public function getProduit(){
		return $this->produit;
	}

	public function getClient(){
		return $this->client;
	}

	public function getPrix(){
		return $this->prix;
	}

	private function setTotal(){
		$cumul = $this->produit->getPrix();
		foreach ($this->services as $key => $value) {
			$cumul += $value->getTarif();
		}
		$this->prix = $cumul;
	}

	public function setServices(array $services){
		foreach ($services as $key => $value) {
			if( $value == 'ExtensionDeGarantie' || $value == 'Installation' || $value == 'Livraison' || $value == 'PapierCadeau'){
				//echo 'new '.$value.'()';
				$this->services[]=new $value($this->produit,$this->client);
			}
			if($key == 'garantie' && $value != 0){
				$this->services[]=new ExtensionDeGarantie($this->produit,$this->client,$value);
			}
		}
		$this->setTotal();
	}

	public function getServices(){
		return $this->services;
	}

}