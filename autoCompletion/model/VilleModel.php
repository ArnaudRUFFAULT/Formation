<?php
class VilleModel extends CoreModel{

	function getCitiesDB($piece){
		$mesVilles = array();
		$sql = 'SELECT ville_nom_reel,ville_id FROM ville WHERE ville_nom_reel LIKE "'.$piece.'%" ORDER BY ville_nom_reel ASC LIMIT 7';
		$request = $this->MakeSelect($sql);
		foreach ($request as $key => $value) {
			$mesVilles = $request;
		}
		return $mesVilles;
	}

	function getCityDB($cityName){
		var_dump(urldecode($cityName));
		$maVille= array();
		$sql = 'SELECT * FROM ville WHERE ville_nom_reel = "'. $cityName .'"';
		$request = $this->MakeSelect($sql);
		foreach ($request as $key => $value) {
			$maVille[]= new Ville ($value);
		}
		return $maVille;
	}
}