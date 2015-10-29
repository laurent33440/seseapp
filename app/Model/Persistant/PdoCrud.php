<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Persistant;

use PDO;
use Exception\DataBaseException;

/**
 * Description of PdoCrud
 *
 * @author laurent
 */
class PdoCrud {
    
    //singleton
    private static $_instance=null;

    const MODE_FETCH_ALL = 1;
    const MODE_FETCH_SIMPLE = 2;

    private $pdo_dbSrv;
    private $pdo_dbUser;
    private $pdo_dbPass;
    //
    private $pdo_dbName = null;
    //
    private $dbpdo = null;
    private $isPdoReady = false;

    /**
     * Initiate PDO parameters
     * @param type $dbSrv 
     * @param type $dbUser
     * @param type $dbPass
     */
    final private function __construct($dbSrv, $dbUser, $dbPass) {
        $this->pdo_dbSrv = $dbSrv;
        $this->pdo_dbUser = $dbUser;
        $this->pdo_dbPass = $dbPass;
        \Logger::getInstance()->logDebug( __CLASS__.' DATA BASE OPEN');
    }
    
    final public static function getInstance ($dbSrv, $dbUser, $dbPass) {
            if (!(self::$_instance instanceof self)){
                self::$_instance = new self($dbSrv, $dbUser, $dbPass);
            }
            return self::$_instance;
    }

    /**
     * Connect to data base
     * @param string $dbName optional argument : data base name
     * @throws DataBaseException
     */
    public function connect($dbName=null) {
        if ($this->pdo_dbSrv == 'localhost') {
            if (PHP_VERSION_ID == 50306) {
                $this->pdo_dbSrv = '127.0.0.1';  //On PHP ver 5.3.6 BUG (https://bugs.php.net/bug.php?id=50829) : PDO and MySQL doesn't connect with 'localhost' 
            }
        }
        if ($dbName) {
            $this->pdo_dbName = $dbName;
            $dsn = "mysql:host=$this->pdo_dbSrv;dbname=$this->pdo_dbName";
        } else {
            $dsn = "mysql:host=$this->pdo_dbSrv";
        }
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try {
            $this->dbpdo = new PDO($dsn, $this->pdo_dbUser, $this->pdo_dbPass, $arrExtraParam);
            $this->dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isPdoReady = true;
            return $this->dbpdo;
        } catch (\PDOException $e) { // WARNING : pdo exception can not be thrown !!!
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            throw new DataBaseException($msg);
        }
    }

    public function closeDataBase() {
//        if(!empty($this->dbQuery)){
//	    $this->dbpdo->query($this->dbQuery);
//	}
//	if(!empty($this->dbpdo)){
//	    //$this->dbpdo->commit(); TODO Exception rising 'no transaction to commit'
//	}
        $this->dbpdo = null;
        \Logger::getInstance()->logDebug( __CLASS__.' DATA BASE CLOSED');
    }

    public function __destruct() {
        $this->closeDataBase();
    }

    private function isDbReady() {
        return $this->isPdoReady;
    }

    /**
     * Create and use data base
     * @param type $baseName
     * @return boolean : false if db not ready
     */
    public function createDataBase($baseName) {
        if ($this->isDbReady()) {
            try {
                $this->pdo_dbName = $baseName;
                $this->dbpdo->beginTransaction();
                $base = "CREATE DATABASE `$this->pdo_dbName`;
                    GRANT ALL ON `$this->pdo_dbName`.* TO '$this->pdo_dbUser'@'localhost';
                    FLUSH PRIVILEGES;
                    USE `$this->pdo_dbName`;";
                $this->dbpdo->exec($base);
                $this->dbpdo->commit();
                return true;
            } catch (\PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                throw new DataBaseException($msg);
            }
        } else {
            return false;
        }
    }

    /**
     * Build model of data base
     * @param string $actions : sql commands
     * @return boolean : false if db not ready
     */
    public function createDataBaseModel($actions) {
        if ($this->isDbReady() && $this->pdo_dbName) {
            try {
                $this->dbpdo->beginTransaction();
                //echo ' REQUETTES : </br>'.$actions.'</br>';
                $this->dbpdo->exec($actions);
                $this->dbpdo->commit();
                return true;
            } catch (\PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() . '</br>'; //.' REQUETTES : </br>'.var_dump($actions);
                throw new DataBaseException($msg);
            }
        } else {
            return false;
        }
    }

    /**
     * Insert datas into table
     * @param type $datas : array of key, value
     * @param type $table
     * @return int : last id of insertion
     */
//    public function dbQI($datas, $table) {
//        try {
//            $d = "INSERT INTO " . $table . " (";
//            foreach ($datas as $k => $v) {
//                $d .= $k . ',';
//            }
//            $d = substr($d, 0, -1);
//            $d .= ") VALUES (";
//            foreach ($datas as $k => $v) {
//                $d .= '\'' . $v . '\',';
//            }
//            $d = substr($d, 0, -1);
//            $d .= ")";
//            $this->dbpdo->query($d);
//            $id = $this->dbpdo->lastInsertId();
//            return $id;
//        } catch (\PDOException $e) {
//            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() .' backtrace : '.$e->getTraceAsString().'</br>'; //.' REQUETTES : </br>'.var_dump($actions);
//            \Logger::getInstance()->logFatal(__CLASS__ . $msg);
//            throw new DataBaseException($msg);
//        }
//    }
//
//    /**
//     * Update data base
//     * @param string $table : table name
//     * @param array $datas : keys values updates
//     * @param string $filter : expression that validates update
//     * @param string $other : other options
//     * @return int : number of row updated
//     */
//    public function dbQU($table, $datas, $filter, $other = ' LIMIT 1 ') {
//        try{
//            $d = "UPDATE " . $table . " SET ";
//            foreach ($datas as $k => $v) {
//                $d .= $k . " = '" . $v . "', ";
//            }
//            $d = substr($d, 0, -2);
//            $d .= " WHERE " . $filter . " $other ;";
//        return $this->dbpdo->exec($d);
//        } catch (\PDOException $e) {
//            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() .' backtrace : '.$e->getTraceAsString(). '</br>'; //.' REQUETTES : </br>'.var_dump($actions);
//            \Logger::getInstance()->logFatal(__CLASS__ . $msg);
//            throw new DataBaseException($msg);
//        }
//    }
//
//    /**
//     * Select datas from one table. Fetch all rows.
//     * @param string $table
//     * @param array $fields : column names
//     * @param string $filter : conditionnal selection
//     * @param int mode fetch : all or simple
//     * @return array of arrays (column's name => value)
//     */
//    public function dbQS($table, $fields = array('*'), $filter = 'true', $modeFetch = self::MODE_FETCH_ALL) {
//        try{
//            $d = "SELECT ";
//            foreach ($fields as $field) {
//                $d .= $field . ',';
//            }
//            $d = substr($d, 0, -1);
//            $d .= ' FROM ' . $table . ' WHERE ' . $filter;
//            $stmt = $this->dbpdo->query($d);
//            if ($modeFetch === self::MODE_FETCH_ALL) {
//                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                return $result;
//            } else
//                $stmt->setFetchMode(PDO::FETCH_ASSOC);
//            return $stmt;
//        } catch (\PDOException $e) {
//            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() .' backtrace : '.$e->getTraceAsString(). '</br>'; //.' REQUETTES : </br>'.var_dump($actions);
//            \Logger::getInstance()->logFatal(__CLASS__ . $msg);
//            throw new DataBaseException($msg);
//        }
//    }
//
//    /**
//     * Delete row(s) from given table 
//     * @param string $table
//     * @param string $filter : conditionnal delete
//     * @return int : number of row(s) deleted
//     */
//    public function dbQD($table, $filter = 'true') {
//        try{
//            $d = "DELETE FROM " . $table . " WHERE " . $filter;
//            return $this->dbpdo->exec($d);
//        } catch (\PDOException $e) {
//            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() .' backtrace : '.$e->getTraceAsString(). '</br>'; //.' REQUETTES : </br>'.var_dump($actions);
//            \Logger::getInstance()->logFatal(__CLASS__ . $msg);
//            throw new DataBaseException($msg);
//        }
//    }

    //////////////////////////////////////////////////////////////////////////
    /**
     *  permet de réinitialiser à 1 l'id d'une table qui est en AUTO INCREMENT
     *  !!!!  ATTENTION : détruit les foreign keys associés !!!!! 
     * 
     *  SET  @num := 0;
      UPDATE your_table SET id = @num := (@num+1);
      ALTER TABLE your_table AUTO_INCREMENT =1;
     * 
     */
}

?>
