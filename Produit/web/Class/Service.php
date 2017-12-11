<?php
abstract class Service{

	protected $client;
	protected $produit;
	protected $name;
	protected $tarif;

	public function __construct(Produit $produit,User $client){
		$this->produit = $produit;
		$this->client = $client;
	}

	abstract protected function calculatePriceService();

	public function getName(){
		return $this->name;
	}

	public function getTarif(){
		return $this->tarif;
	}
}