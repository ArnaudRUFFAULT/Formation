<?php
class Roi extends Piece{
	/**
	 * Determines les déplacements potentielles que le Roi peut effectuer
	 * @return array Contient des coordonnées de cases de l'échiquier
	 */
	public function getNewCases(){
		$newCases = array();
		
		if($this->Y-1 > 0){
			$newCases[] = ['X'=>$this->X,'Y'=>$this->Y-1];
		}
		if($this->Y+1 < 8){
			$newCases[] = ['X'=>$this->X,'Y'=>$this->Y+1];
		}
		if($this->X-1 > 0){
			$newCases[] = ['X'=>$this->X-1,'Y'=>$this->Y];
		}
		if($this->X+1 < 8){
			$newCases[] = ['X'=>$this->X+1,'Y'=>$this->Y];
		}			
		return $newCases;
	}
}