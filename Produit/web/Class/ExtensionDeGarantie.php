<?php
class ExtensionDeGarantie extends Service{

	private $garantie;

	public function __construct(Produit $produit, User $client, $garantie){
		parent::__construct($produit,$client);
		$this->garantie = $garantie;
		$this->name = 'Extension de Garantie';
		$this->calculatePriceService();
	}

	protected function calculatePriceService(){
		$annees = $this->garantie;
		$pourcentage = $this->produit->getOccasion() == 0 ? 0.1 : 0.2;
		$prixDeBase = $this->produit->getPrix();
		$tarif = $annees * $pourcentage * $prixDeBase;
		$this->tarif = $tarif;
	}

	public function getGarantie(){
		return $this->garantie;
	}
}