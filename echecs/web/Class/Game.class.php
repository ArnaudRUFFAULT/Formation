<?php
class Game {
	/**
	 * Identifiant de la partie
	 * @var int
	 */
	private $id;

	/**
	 * Tableau representant le Joueur 1, la rubrique 'data' comprends une instance de classe User et la rubrique 'pieces' contient un tableau d'instances de Pieces, celle du joueur 1
	 * @var array
	 */
	private $user1 = array('data'=>null,'pieces'=>null);

	/**
	 * Tableau representant le Joueur 2, la rubrique 'data' comprends une instance de classe User et la rubrique 'pieces' contient un tableau d'instances de Pieces, celle du joueur 2
	 * @var array
	 */
	private $user2 = array('data'=>null,'pieces'=>null);

	/**
	 * Numéro du tour en cours
	 * @var int
	 */
	private $tour;

	/**
	 * L'identifiant du joueur qui doit effectuer la prochaine action
	 * @var int
	 */
	private $currentPlayer;

	/**
	 * L'identifiant du joueur qui joue en premier à chaque nouveau tour
	 * @var int
	 */
	private $firstPlayer;

	/**
	 * Permet de créer une instance de Game
	 * @param array $data contient toutes les informations pour instancier Game
	 */
	public function __construct(array $data){
		$this->id = $data['g_id'];
		$this->tour = $data['g_tour'];
		$this->firstPlayer = $data['g_firstPlayer'];
		$this->currentPlayer = $data['g_currentPlayer'];
	}

	/**
	 * A partir d'une instance de piece, on recupere dans un tableau les coordonnées des cases ou la dite pièce peut effectuer un déplacement
	 * @param  Piece  $piece Instance de Piece (Cavalier,Pion, etc...)
	 * @return array        Tableau de coordonnées
	 */
	public function getNewCases(Piece $piece){
		//On récupere toutes les cases potentielles d'une piece
		$potentialCases = $piece->getNewCases();
		//On soustrait à toutes les cases potentielles les cases déjà occupé par des pieces alliés
		for ($i=0; $i < count($potentialCases) ; $i++) { 
			for ($j=0; $j < count($this->getCurrentPlayerPieces()); $j++){ 
				if($potentialCases[$i]['X']==$this->getCurrentPlayerPieces()[$j]->getX() && $potentialCases[$i]['Y']==$this->getCurrentPlayerPieces()[$j]->getY()){
					unset($potentialCases[$i]);
					$potentialCases = array_values($potentialCases);
					$i = $i == 0 ? 0 : $i-1;
					$j = $j == 0 ? 0 : $j-1;
				}
			}
		}
		return $potentialCases;
	}

	/**
	 * Setter qui indique une classe User representant le joueur 1
	 * @param Object $user Instance de classe User
	 */
	public function setUser1(User $user){
		$this->user1['data']=$user;
	}
	/**
	 * Setter qui injecte une classe User representant le joueur 2
	 * @param Object $user Instance de classe User
	 */
	public function setUser2(User $user){
		$this->user2['data']=$user;
	}

	/**
	 * Setter qui injecte un tableau de classes Piece representant les pieces du joueur 1
	 * @param array $pieces Tableau d'instances de classe Piece
	 */
	public function setPiecesUser1(array $pieces){
		$this->user1['pieces']=$pieces;
	}

	/**
	 * Setter qui injecte un tableau de classes Piece representant les pieces du joueur 2
	 * @param array $pieces Tableau d'instances de classe Piece
	 */
	public function setPiecesUser2(array $pieces){
		$this->user2['pieces']=$pieces;
	}

	/**
	 * Getter Identifiant
	 * @return int 
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Retourne une instance de classe User representant le joueur 1
	 * @return Object 
	 */
	public function getUser1(){
		return $this->user1['data'];
	}

	/**
	 * Retourne un tableau d'instances de classe Piece appartenant au joueur 1
	 * @return array 
	 */
	public function getUser1Pieces(){
		return $this->user1['pieces'];
	}

	/**
	 * Retourne une instance de classe User representant le joueur 2
	 * @return Object 
	 */
	public function getUser2(){
		return $this->user2['data'];
	}

	/**
	 * Retourne un tableau d'instances de classe Piece appartenant au joueur 2
	 * @return array 
	 */
	public function getUser2Pieces(){
		return $this->user2['pieces'];
	}

	/**
	 * Getter numero du tour en cours
	 * @return int 
	 */
	public function getTour(){
		return $this->tour;
	}

	/**
	 * Retourne le pseudo du joueur qui doit effectuer la prochaine action
	 * @return string
	 */
	public function getCurrentPlayerPseudo(){
		if($this->currentPlayer == $this->user1['data']->getId()){
			return $this->user1['data']->getPseudo();
		}
		return $this->user2['data']->getPseudo();
	}

	/**
	 * Retourne l'instance User du joueur qui doit effectuer la prochaine action
	 * @return Object 
	 */
	public function getCurrentPlayer(){
		if($this->currentPlayer == $this->user1['data']->getId()){
			return $this->user1['data'];
		}
		return $this->user2['data'];
	}

	/**
	 * Retourne le tableau d'instance de Piece du joueur qui doit effectuer la prochaine action
	 * @return array 
	 */
	public function getCurrentPlayerPieces(){
		if($this->currentPlayer == $this->user1['data']->getId()){
			return $this->user1['pieces'];
		}
		return $this->user2['pieces'];
	}

	/**
	 * Permet de déterminer si l'instance de classe User introduit en parametre correspond au joueur qui joue en premier lors d'un nouveau tour
	 * @param  User    $user 
	 * @return boolean    
	 */
	public function isFirstPlayer(User $user){
		if($user->getId() == $this->firstPlayer){
			return true;
		}
		return false;
	}

	/**
	 * Retourne l'instance User du joueur qui joue en premier
	 * @return Object User
	 */
	public function getFirstPlayer(){
		if($this->user1['data']->getId() == $this->firstPlayer){
			return $this->user1['data'];
		}
		return $this->user2['data'];
	}

	/**
	 * Retourne l'instance User du joueur qui joue en second
	 * @return Object User
	 */
	public function getSecondPlayer(){
		if($this->user1['data']->getId() != $this->firstPlayer){
			return $this->user1['data'];
		}
		return $this->user2['data'];
	}

	/**
	 * Détermine si il faut augmenter le numéro du tour ou non
	 * @return boolean
	 */
	public function isUpTour(){
		if($this->getCurrentPlayer()==$this->getSecondPlayer()){
			return 1;
		}
		return 0;
	}

	/**
	 * Détermine le prochain User à jouer
	 * @return int Identifiant d'un User
	 */
	public function newCurrentPlayerId(){
		if($this->getCurrentPlayer()==$this->getSecondPlayer()){
			return $this->getFirstPlayer()->getId();
		}
		return $this->getSecondPlayer()->getId();
	}
}