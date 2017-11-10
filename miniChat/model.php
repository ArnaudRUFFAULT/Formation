<?php
include('message.class.php');
class Model{
	/*
     **object pdo || NULL Instance de connexion à la BDD
      */
	private static $pdo = NULL;

    /*
     ** @params
     ** @action Crée une instance pdo si elle n'éxiste pas, ou bien retourne la réfèrence si une connexion existe déjà
     ** @return object pdo 
      */
	public function __construct(){
		if(self::$pdo == NULL){
			self::$pdo = new PDO ('mysql:host=localhost;dbname=miniChat;charset=utf8', 'root', '');
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;		
	}

    /*
     ** @params varchar 
     ** @params array
     ** @action Permet d'établir une requete PDO à partir d'un select et d'un tableau qui contient les valeurs des placholder(ex:'t_nom'=>'Au pire acceuil')
     ** @return object PDOstatement
      */
	protected function makeStatement($sql, $params = array())
    {
        if(count($params) == 0)
        {
            $statement = self::$pdo->query($sql);
        }
        else
        {
            if(($statement = self::$pdo->prepare($sql)) !== false)
            {
                foreach ($params as $placeholder => $value)
                {
                    switch(gettype($value))
                    {
                        case "integer":
                            $type = PDO::PARAM_INT;
                            break;

                        case "boolean":
                            $type = PDO::PARAM_BOOL;
                            break;

                        case "NULL":
                            $type = PDO::PARAM_NULL;
                            break;

                        default:
                            $type = PDO::PARAM_STR;
                    }
                    if($statement->bindValue($placeholder, $value, $type) === false)
                        return false;
                }
                if(!$statement->execute())
                {
                    return false;
                }
            }
        }
        return $statement;
    }

    /**
     * @param string $sql Your SELECT query
     * @param array $params An associative array with form : 'placeholder' => $value
     * @param int $fetchStyle
     * @param mixed $fetchArg
     * @return array|bool An array containing all result lines or false if an error occurred
     * @throws PDOException (Depending on PDO Config)
     */
    protected function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    {
        $statement = $this->makeStatement($sql, $params);

        if($statement === false)
        {
            return false;
        }

        $data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
        $statement->closeCursor();

        return $data;
    }

    public function afficherHistorique(){
    	$sql = 'SELECT * FROM message ORDER BY m_date';
    	$results = $this->makeSelect($sql);
    	$mesMessages = array();
    	foreach ($results as $key => $value){
    		$mesMessages[] = new Message ($value);
    	}
    	return $mesMessages;
    }

    public function ajouterMessage($contenu,$auteur){
    	$sql = 'INSERT INTO message  (`m_auteur`, `m_date`, `m_contenu`) VALUES (:auteur, NOW(), :contenu)';
    	$params = array('auteur'=>$auteur,'contenu'=>$contenu);
    	$this->makeStatement($sql,$params);
    }
}

