<?php
class produitModel extends CoreModel{
	public function getAllProducts(){
		$sql = 'SELECT * FROM produit WHERE p_sold = 0';
		$request = $this->makeSelect($sql);
		$products = array();
		foreach ($request as $key => $value) {
			$products[] = new Produit($value);
		}
		return $products;
	}

	public function getProduct($id){
		$sql = 'SELECT * FROM produit WHERE p_id=:id';
		$params = array('id'=>$id);
		$request = $this->makeSelect($sql, $params);
		$products = array();
		foreach ($request as $key => $value) {
			$products[] = new Produit($value);
		}
		return $products[0];
	}
}