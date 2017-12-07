<?php
abstract class Piece{
	/**
	 * Type de la Piece(roi, reine,cavalier,pion)
	 * @var string
	 */
	protected $name;

	/**
	 * Identifiant de la piece(correspond a la cle primaire dans la BDD)
	 * @var int
	 */
	protected $id;

	/**
	 * Identifiant de la personne à qui appartient la piece (correspond a la clé étrangere p_user_fk de la BDD)
	 * @var int
	 */
	protected $user;

	/**
	 * Identifiant de la partie dans laquel la pièce est joué (correspond a la clé étrangere p_game_fk de la BDD)
	 * @var [type]
	 */
	protected $game;

	/**
	 * Correspond à la position de la pièce sur l'axe des abcisses de l'échiquier (8*8)
	 * @var int [0,8[
	 */
	protected $X;

	/**
	 * Correspond à la position de la pièce sur l'axe des ordonnées de l'échiquier(8*8)
	 * @var int [0,8[
	 */
	protected $Y;

	/**
	 * Correspond à la position sur l'axe des ordonnées de la piece lors de l'initialisation d'une partie (permet notemment de determiner dans quel direction les pions peuvent circuler)
	 * @var int 0||7
	 */
	protected $YDepart;

	/**
	 * Correspond au à l'url de l'image a afficher pour representer la piece
	 * @var [type]
	 */
	protected $gabarit;

	/**
	 * Permet d'instancier une Piece
	 * @param array  $data  Contient toutes les informations nécessaires à l'instanciation d'une Piece
	 * @param [type] $color Détermine si il faut afficher une piece noir , ou une piece blanche en fonction du joueur si il joue en premier ou non
	 */
	public function __construct(array $data,$color){
		$this->name = $data['p_type'];
		$this->id = $data['p_id'];
		$this->user = $data['p_user_fk'];
		$this->game = $data['p_game_fk'];
		$this->X = $data['p_X'];
		$this->Y = $data['p_Y'];
		$this->YDepart = $data['p_YDepart'];
		$this->setGabarit($color);
	}

	/**
	 * Getter position sur l'axe des Abcisses
	 * @return int 
	 */
	public function getX(){
		return $this->X;
	}

	/**
	 * Getter position sur l'axe des Ordonnes
	 * @return int 
	 */
	public function getY(){
		return $this->Y;
	}

	/**
	 * Getter Type de la piece
	 * @return string (cavalier, roi, reine, pion)
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Getter Identifiant
	 * @return int 
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Getter Url Image
	 * @return [string] 
	 */
	public function getGabarit(){
		return $this->gabarit;
	}

	/**
	 * Injecte l'url de l'image
	 * @param string $color 
	 */
	public function setGabarit($color){	
		$this->gabarit = './assets/img/'.$color.'/'.$this->name.'.png';
	}
}