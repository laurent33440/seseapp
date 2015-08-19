<?php

namespace Model\Dal\DbLibrary;

use Model\Persistant\PdoCrud;

        
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
    
    private $dbh=null;          // data base handler

    public function __construct($modelName){       
        $this->ModelName=$modelName;
        $this->ObjectType=$modelName . "Object";
        $this->QueryProvider=$modelName . "QueryProvider";
        $this->MappingProvider=$modelName . "MappingProvider";
        $this->NameSpaceObjectDb='\Model\Dal\ModelDb\\'.$this->ModelName.'\\';
        //Ouverture de connexion 
        $this->dbh = $this::GetDbAccess();
    }

    function __destruct(){
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
            $dataBaseHandler = PdoCrud::getInstance($srv,$user ,$pass );
            $dbhPdo = $dataBaseHandler->connect(\Bootstrap::$_dbName);
            //save data base parameters
//            $this->saveClassVarsValuesInSession('data_base'); // TODO : better handling needed
            //\Logger::getInstance()->logDebug( __CLASS__.' data base access');
            return $dbhPdo;
        }catch (Exception $e){
            \Logger::getInstance()->logFatal( __CLASS__.' exception');
            //var_dump($e);
            throw $e; 
        }
    }

    public function Insert($item, $autoIncrement = self::AUTO_INCREMENT){       
        //Ouverture de connexion  
        //$this->dbh = $this::GetDbAccess();
        //Préparation et exécution
        $sth = $this->dbh->prepare( call_user_func( $this->NameSpaceObjectDb.$this->QueryProvider . "::InsertQuery" ) );
        $sth->execute( call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowInsert" , $item ) );
        if($autoIncrement){
            //Récupération de l'id auto incrémenté
            $sth = $this->dbh->prepare( call_user_func( $this->NameSpaceObjectDb.$this->QueryProvider . "::SelectIDQuery") );
            $sth->execute();              
            //Assigner l'id à l'objet inséré
            call_user_func( $this->NameSpaceObjectDb.$this->MappingProvider . "::SetID", $item, $sth->fetchColumn() );
        }
    }

    public function Update($item){
        //Ouverture de connexion  
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare( call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::UpdateQuery") );
        //Exécution de la query
        return $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowUpdate", $item) );
    }
    
    /**
     * Inner Update of object thus self update of properties
     * @param type $item : object to update
     * @param array $self : keys values of properties to be updated and used in conditional update
     * @return type
     */
    public function InnerSelfUpdate($item, array $self){
        //Ouverture de connexion  
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare( call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::InnerSelfUpdateQuery") );
        //Exécution de la query
        return $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowInnerSelfUpdate", $item, $self) );
    }


    /**
     * Delete Row
     * @param type $item object table
     * @return boolean TRUE if DELETED, FALSE else if foreign key not null
     */
    public function Delete($item){
        if($this->isValidForeignKey($item)){
            return FALSE;
        }else{
            //Ouverture de connexion  
            //$this->dbh = $this::GetDbAccess();
            //Préparation de la query
            $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::DeleteQuery"));
            //Exécution de la query
            $sth->execute(call_user_func($this->NameSpaceObjectDb.$this->MappingProvider . "::MapToRowDelete",$item));
            return TRUE;
        }
    }

    public function GetAll(){
        $retval = array();
        $cpt = 0;

        //Ouverture de connexion  
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider."::SelectAllQuery") );
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
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByIDQuery" ));
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
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByIDQuery" ));
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
            //on sauve l'objet d'origine
            $this->savedObject = $objectItem;
            //on retourne l’objet
            return $objectItem;
        }
        //on retourne false si on n'a rien trouvé
        return FALSE;
    }
    
    public function GetByColumnValue($column,$val){
        //Ouverture de connexion  
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByValueQuery",$column ));
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
        //$this->dbh = $this::GetDbAccess();
        //Préparation de la query
        $sth = $this->dbh->prepare(call_user_func($this->NameSpaceObjectDb.$this->QueryProvider . "::SelectByValueQuery",$column ));
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
        }
        // empty array if not found
        return $retval; 
    }
    
    /**
     * Check if foreign key is used in object table given
     * @param type $obj
     * @return boolean
     */
    private function isValidForeignKey($obj){
        $list = $obj->foreignKeyList;
        foreach($list as $table=>$key){
            $c=new DataAccess($table);
            if($c->GetByColumnValue($key, $obj->$key) != null){
                return true;
            }
        }
        return false;
    }

}
?>