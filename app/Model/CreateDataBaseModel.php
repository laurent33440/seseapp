<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

use exception\InternalException;

/**
 * Description of createDataBaseModel
 *
 * @author prog
 */
class CreateDataBaseModel {
    
    private $_accessDb;
    
    public function __construct(AccessDataBase $accessDb) {
        $this->_accessDb=$accessDb;
    }

    public function createDataBase(){
        Logger::getInstance()->logInfo( __CLASS__.' create '.$this->_accessDb->get_dbName());
        try{
            $db=$this->_accessDb->openDataBase();
            $db->createDataBase($this->_accessDb->get_dbName());
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
            }
            $db->closeDataBase();
        }catch (Exception $e){
            \Logger::getInstance()->logFatal( __CLASS__.' exception ');
            //var_dump($e);
            throw $e; // DataBaseException();
        }
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


