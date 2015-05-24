<?php

namespace Model\Dal\DbLibrary;

use Model\Persistant\PdoCrud;
use Bootstrap;

        
/**
 * Description of Model
 *
 * @author laurent
 */
        
class DataAccess{
    const AUTO_INCREMENT=true; 
    const NOT_AUTO_INCREMENT=false; //for composite keys 

    private $ObjectType;        //la classe objet
    private $QueryProvider;	//la classe QueryProvider
    private $MappingProvider;	//la classe MappingProvider
    private $ModelName;		//le nom du modèle
    private $NameSpaceObjectDb; //l'espace de nom de la classe objet

    public function __construct($modelName){       
        $this->ModelName=$modelName;
        $this->ObjectType=$modelName . "Object";
        $this->QueryProvider=$modelName . "QueryProvider";
        $this->MappingProvider=$modelName . "MappingProvider";
        $this->NameSpaceObjectDb='\Model\Dal\ModelDb\\'.$this->ModelName.'\\';
    }

    function __destruct(){
        \Logger::getInstance()->logDebug( __CLASS__.' data base closed');
    }

    /**
     * Open data base and get data base handler
     * @return data base handler
     * @throws Exception if data base access failure
     */
    public static function GetDbAccess(){ 
        try{
            $srv= \Bootstrap::$_dbSrv;
            $user = \Bootstrap::$_dbUser;
            $pass= \Bootstrap::$_dbPass;
            $dataBaseHandler = new PdoCrud($srv,$user ,$pass );
            $dbhPdo = $dataBaseHandler->connect(\Bootstrap::$_dbName);
            //save data base parameters
//            $this->saveClassVarsValuesInSession('data_base'); // TODO : better handling needed
            \Logger::getInstance()->logDebug( __CLASS__.' data base open');
            return $dbhPdo;
        }catch (Exception $e){
            \Logger::getInstance()->logFatal( __CLASS__.' exception');
            //var_dump($e);
            throw $e; 
        }
    }

    public function Insert($item, $autoIncrement = self::AUTO_INCREMENT){       
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation et exécution
        $sth = $dbh->prepare( call_user_func( $this->NameSpaceObjectDb.$this->QueryProvider . "::InsertQuery" ) );
        $sth->execute( call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowInsert" , $item ) );
        if($autoIncrement){
            //Récupération de l'id auto incrémenté
            $sth = $dbh->prepare( call_user_func( $this->NameSpaceObjectDb.$this->QueryProvider . "::SelectIDQuery") );
            $sth->execute();              
            //Assigner l'id à l'objet inséré
            call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::SetID", $item, $sth->fetchColumn() );
        }
    }

    public function Update($item){
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare( call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::UpdateQuery") );
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowUpdate", $item) );
    }

    public function Delete($item){
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::DeleteQuery"));
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowDelete",$item));
    }

    public function GetAll(){
        $retval = array();
        $cpt = 0;

        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider."::SelectAllQuery") );
        //Exécution de la query
        $sth->execute();
        //Récupération des lignes
        $result = $sth->fetchAll();
        foreach($result as $row){ 
            //Ajout à la collection après le mapping
            $obj = $this->NameSpaceObjectDb.$this->ObjectType;
            $objectItem = new $obj;
            call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapFromRow",$row,$objectItem);		
            $retval[$cpt++]=$objectItem;
        }
        return $retval;
    }

    public function GetByID($id){
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByIDQuery" ));
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapToRowGetByID", $id ));
        //On récupère le résultat
        $result = $sth->fetchAll();
        //S’il ya quelque chose
        if (isset($result[0])){
            //Création de l’objet et mapping
            $obj = $this->NameSpaceObjectDb.$this->ObjectType;
            $objectItem = new $obj;
            call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::MapFromRow", $result[0], $objectItem );
            //on retourne l’objet
            return $objectItem;
        }
        //on retourne false si on n'a rien trouvé
        return FALSE;
    }
    
    public function GetByCompositeKeys(array $keys){
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByIDQuery" ));
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapToRowGetByCompositeKeys", $keys ));
        //On récupère le résultat
        $result = $sth->fetchAll();
        //S’il ya quelque chose
        if (isset($result[0])){
            //Création de l’objet et mapping
            $obj = $this->NameSpaceObjectDb.$this->ObjectType;
            $objectItem = new $obj;
            call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::MapFromRow", $result[0], $objectItem );
            //on retourne l’objet
            return $objectItem;
        }
        //on retourne false si on n'a rien trouvé
        return FALSE;
    }
    
    public function GetByColumnValue($column,$val){
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByValueQuery",$column ));
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapToRowGetByValue",$column, $val ));
        //On récupère le résultat
        $result = $sth->fetchAll();
        //S’il ya quelque chose
        if (isset($result[0])){
            //Création de l’objet et mapping
            $obj = $this->NameSpaceObjectDb.$this->ObjectType;
            $objectItem = new $obj;
            call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::MapFromRow", $result[0], $objectItem );
            //on retourne l’objet
            return $objectItem;
        }
        //on retourne false si on n'a rien trouvé
        return FALSE;
    }
    
    public function GetAllByColumnValue($column,$val){
        $retval = array();
        $cpt = 0;
        //Ouverture de connexion  
        $dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByValueQuery",$column ));
        //Exécution de la query
        $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapToRowGetByValue",$column, $val ));
        //On récupère le résultat
        $result = $sth->fetchAll();
        //S’il ya quelque chose
        if (isset($result[0])){
            foreach ($result as $row) {
                //Ajout à la collection après le mapping
                $obj = $this->NameSpaceObjectDb.$this->ObjectType;
                $objectItem = new $obj;
                call_user_func($this->NameSpaceObjectDb.$this->MappingProvider."::MapFromRow",$row,$objectItem);		
                $retval[$cpt++]=$objectItem;
            }
        return $retval;
        }
        //on retourne false si on n'a rien trouvé
        return FALSE;
    }

}
?>