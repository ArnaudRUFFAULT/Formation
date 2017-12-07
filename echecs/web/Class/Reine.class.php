<?php
class Reine extends Piece{
	/**
	 * Determines les déplacements potentielles que la Reine peut effectuer
	 * @return array Contient des coordonnées de cases de l'échiquier
	 */
	public function getNewCases(){
		$newCases = array();
		for ($x=0; $x < 8; $x++) {
			if($x != $this->X){
				$newCases[] = ['X'=>$x,'Y'=>$this->Y];
			}
		}
		for ($y=0; $y < 8; $y++) {
			if($y != $this->Y){
				$newCases[] = ['X'=>$this->X,'Y'=>$y];
			}
		}		
		return $newCases;
	}
}