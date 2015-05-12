<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View\Template;

/**
 * Description of CacheTemplateHandler
 *
 * @author laurent
 */
class CacheTemplateHandler {
    private $_cacheName;
    private $_cacheDir;
    
    public function __construct($cacheName) {
        $this->_cacheName = $cacheName;
//        \Logger::getInstance()->logDebug(__CLASS__.' -- raw cache name  : '.$this->_cacheName);
        $this->_cacheDir = __DIR__.'/Cache/';
        if(!is_dir($this->_cacheDir)){ 
            mkdir($this->_cacheDir, 0777, true);   
        }
        $this->_cacheName = $this->_cacheDir.$cacheName.'.page.tpl.php';
//        \Logger::getInstance()->logDebug(__CLASS__.' -- complete cache name  : '.$this->_cacheName);
    }
    
    public function writeCache($datas){
        //overwrite file if exist
        file_put_contents($this->_cacheName,$datas);
    }
    
    public function getCachedFile(){
        return $this->_cacheName;
    }
    
}

?>
