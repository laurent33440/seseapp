<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * FIXME : old class used to setup data base 
 * Description of createDataBaseModel
 *
 * @author prog
 */
class CreateDataBaseModel extends AModel{
    private $_dbSrv;
    private $_dbUser;
    private $_dbPass;
    private $_dbName;
    
    public function __construct() {
        $this->restoreClassVarsValuesFromSession('data_base');
    }

    public function createDataBase(){
        echo 'create '.$this->_dbName.'</br>';
        try{
            $db = new PdoCrud($this->_dbSrv, $this->_dbUser, $this->_dbPass);
            $db->connect(null);
            $db->createDataBase($this->_dbName);
            $modelFile = __dir__.'/'.Kernel::DATA_BASE_FILE;
            $model = $this->gzfileGetContents($modelFile);
            if($model){
                if(!$db->createDataBaseModel($model)){
                    $msg = 'Model : '.__CLASS__.' Data base not ready !  : '.$modelFile;
                    throw new InternalException($msg);
                }
            }else{
                $msg = 'Model : '.__CLASS__.' Model file of database not found !  : '.$modelFile;
                throw new InternalException($msg);
                //echo 'create - file not found </br>';
            }
            //save data base parameters
            $this->saveClassVarsValuesInSession('data_base');
//            $_SESSION['data_base'] = array();
//            $_SESSION['data_base']['server'] = $this->_dbSrv;
//            $_SESSION['data_base']['user'] = $this->_dbUser;
//            $_SESSION['data_base']['password'] = $this->_dbPass;
//            $_SESSION['data_base']['name'] = $this->_dbName;
            $db->closeDataBase();
        }catch (Exception $e){
            //throw new ModalException('Erreur de création de modèle de données ',$msg);
            echo 'model exception </br>';
            //var_dump($e);
            throw $e; // DataBaseException();
        }
    }
    
    public function set_dbSrv($_dbSrv) {
        $this->_dbSrv = $_dbSrv;
    }

    public function set_dbUser($_dbUser) {
        $this->_dbUser = $_dbUser;
    }

    public function set_dbPass($_dbPass) {
        $this->_dbPass = $_dbPass;
    }

    public function set_dbName($_dbName) {
        $this->_dbName = $_dbName;
    }
    
    public function get_dbSrv() {
        return $this->_dbSrv;
    }

    public function get_dbUser() {
        return $this->_dbUser;
    }

    public function get_dbPass() {
        return $this->_dbPass;
    }

    public function get_dbName() {
        return $this->_dbName;
    }
    
    public function getClassVarsPlaceHolder(){
        $set = array('localhost', 'utilisateur de la base de données ', 'mot de passe', 'nom de la base de données');
        return $set;
    }

    
    /**
     * Extract gzipped datas from file and clean it
     * @param string $filename gzipped file
     * @param boolean $use_include_path variable to add search paths
     * @return mixed. Datas as un single string if file exist, false else
     */
    private function gzfileGetContents($filename, $use_include_path = 0){
        if( !@file_exists($filename) ){
            return false;    
        }
       $datas = gzfile($filename, $use_include_path);
       // drop 4 elements at begining of array this is file name and comments
       array_shift($datas);
       array_shift($datas);    // FIXME : variables lenght comments not handled
       array_shift($datas);
       array_shift($datas);
       //Read and imploding the array to produce a one line string
       $datas = implode($datas);
       //clean new line from string
       $datas = $this->deleteEol( $datas);
       return $datas;
    }
    
    private function deleteEol($string){
        return str_replace(array("\r\n", "\r", "\n", PHP_EOL, chr(10), chr(13), chr(10).chr(13)), "", $string);
    } 

}


