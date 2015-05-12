<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View\Page;

use View\Template\CacheTemplateHandler;

/**
 * Description of Page
 *
 * @author laurent
 */
class Page implements IPageElement{
    private $_pageName;
    private $_elements = array();
    private $_structDatas;
    private $_cache;
    
    public function __construct($pageName) {
        $this->_pageName = $pageName;
    }
    
    /**
     * 
     * @param type $aComponent
     */
    public function addElement(IPageElement $element){
       try{
           $this->_elements[] = $element;
       }catch(RuntimeException $re){
            echo "RuntimeException: ".$re->getMessage()."\n";
       }
    }
    
    /**
     * 
     * @return type
     */
    public function generate() {
         //iterate 
        foreach ($this->_elements as $element){
            $this->_structDatas .= $element->generate();
        }
        $this->_cache = new CacheTemplateHandler($this->_pageName);
        $this->_cache->writeCache($this->_structDatas);
        return $this->_cache->getCachedFile();
    }

    /**
     * 
     */
    public function refresh() {
        
    }

  
}

?>
