<?php
class Pion extends Piece{
	/**
	 * Determines les déplacements potentielles que le Pion peut effectuer
	 * @return array Contient des coordonnées de cases de l'échiquier
	 */
	public function getNewCases(){
		$newCases = array();
		if($this->YDepart == 7){
			if($this->Y-1 > 0){
				$newCases[] = ['X'=>$this->X,'Y'=>$this->Y-1];
			}
		}
		else if($this->YDepart == 0){
			if($this->Y+1 < 7){
				$newCases[] = ['X'=>$this->X,'Y'=>$this->Y+1];
			}
		}
		return $newCases;
	}
}