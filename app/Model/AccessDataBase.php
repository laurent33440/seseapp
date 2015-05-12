<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Persistant\PdoCrud;
use Logger;


/**
 * Description of AccessDataBase
 *
 * @author prog
 */
class AccessDataBase extends AModel{
    
    private $_dbSrv;
    private $_dbUser;
    private $_dbPass;
    private $_dbName;
    
    public function __construct() {
        if (!\Bootstrap::DEBUG_SESE)
            $this->restoreClassVarsValuesFromSession('data_base');
        else{ //for debug/testing purpose
            $this->_dbSrv=\Bootstrap::$_dbSrv;
            $this->_dbUser=\Bootstrap::$_dbUser;
            $this->_dbPass =\Bootstrap::$_dbPass;
            $this->_dbName =\Bootstrap::$_dbName;
        }
    }
    
    public function __destruct() {
        \Logger::getInstance()->logDebug( __CLASS__.' data base closed');
    }

    /**
     * Open data base and get data base handler
     * @return data base handler
     * @throws Exception if data base access failure
     */
    public function openDataBase(){
        try{
            $this->_dataBaseHandler = new PdoCrud($this->_dbSrv, $this->_dbUser, $this->_dbPass);
            $this->_dataBaseHandler->connect(null);
            //save data base parameters
            $this->saveClassVarsValuesInSession('data_base'); // TODO : better handling needed
            \Logger::getInstance()->logDebug( __CLASS__.' data base open');
            return $this->_dataBaseHandler;
        }catch (Exception $e){
            \Logger::getInstance()->logFatal( __CLASS__.' exception');
            //var_dump($e);
            throw $e; 
        }
    }
    
    /**
     * Open data base with defined db name 
     * @return data base handler
     * @throws Exception
     */
    public function connectToDataBaseDefined(){
        try{
            $this->openDataBase();
            $this->_dataBaseHandler->connect($this->_dbName);
            return $this->_dataBaseHandler;
        }catch (Exception $e){
            \Logger::getInstance()->logFatal( __CLASS__.' exception ');
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
        $set = array(   'localhost', 
                        'utilisateur de la base de données ', 
                        'mot de passe', 
                        'nom de la base de données');
        return $set;
    }

}
