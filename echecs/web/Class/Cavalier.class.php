<?php
class Cavalier extends Piece{
	/**
	 * Ajoute dans un tableau les coordonnées des cases ou le cavalier peut potentiellement se placer
	 * @return [array] Tableau de coordonnées
	 */
	public function getNewCases(){
		$newCases = array();
		
		if($this->Y-3 >= 0){
			$newCases[] = ['X'=>$this->X,'Y'=>$this->Y-3];
		}
		if($this->Y+3 <= 8){
			$newCases[] = ['X'=>$this->X,'Y'=>$this->Y+3];
		}
		if($this->X-3 >= 0){
			$newCases[] = ['X'=>$this->X-3,'Y'=>$this->Y];
		}
		if($this->X+3 <= 8){
			$newCases[] = ['X'=>$this->X+3,'Y'=>$this->Y];
		}			
		return $newCases;
	}
}