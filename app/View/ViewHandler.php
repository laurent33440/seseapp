<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use Logger;

/**
 * Description of ViewHandler
 *
 * @author laurent
 */
class ViewHandler {
    const ARRAY_LIST_NAME = '$this->_arrayParamslist';
    private $_view;
    private $_modelParams;
    private $_arrayParamslist; //used by included view template
    
    public function __construct($controllerName, array $modelParams=null,  $mainViewTemplateName=null) {
        $this->_modelParams = $modelParams;
        Logger::getInstance()->logDebug(__CLASS__. ' Model params from controler :  => '.print_r($this->_modelParams, true));
        $this->_arrayParamslist = $this->extractArraysFromParams();
        //echo '</br>viewHandler from '.$controllerName.'</br>'.  var_dump($this->_arrayParamslist).'</br>';
        $this->_modelParams = $this->bindArrayNameForTemplate($this->_modelParams);//must be commented for testing purpose - SEE TESTS
        $viewBuilderName = 'View\\'.$controllerName.'Builder';
        Logger::getInstance()->logDebug(__CLASS__. ' Model params for builder : '.$viewBuilderName.' => '.print_r($this->_modelParams, true));
        $builder =  new $viewBuilderName($this->_modelParams, $mainViewTemplateName);
        $this->_view = $builder->getPage();
    }
    
    /**
     * Render view 
     * @param String $controllerName : controller name for appropriate templating builder
     * @param array $viewModel : parameters for template 
     * @return String HTML structure 
     */
    public static function render($controllerName, $viewModel, $mainViewTemplateName=null){
        $handler = new static($controllerName,$viewModel, $mainViewTemplateName);
        return $handler->renderTemplate($handler->_view->generate());
    }
    
    /**
     * Render Template
     * @return HTML structure
     */
    public function renderTemplate($template){
        ob_start();
        require $template;
        $html = ob_get_clean();
        return $html;
    }

    
    /**
     * Extract all arrays from parameters
     * @return array of array, null if no array present
     */
    public function extractArraysFromParams(){
        if($this->_modelParams){
            $all =array();
            foreach ($this->_modelParams as  $v){ 
                foreach($v as $key => $value) {                  
                    if(is_array($value)){
                        $all[] = $value;
                    }
                }
            }
            return $all;  
        }else
            return null;
    }
    
    /**
     * Build reference Array list
     * @return array
     */
    public function buildReferenceArrayList(){
        $ref=null;
        if($this->_modelParams){
            $ref =array();
            $n=0;
            foreach ($this->_modelParams as  $v){ 
                foreach($v as $key => $value) {                  
                    if(is_array($value)){
                        $ref[self::ARRAY_LIST_NAME.'['.$n++.']'] = $key;
                    }
                }
            }
        }
        return $ref; 
    }
    
    /**
     * ReplaceTree is the tree version of str_replace. It will recursively replace through an array of strings
     * @param type $search
     * @param type $replace
     * @param type $array
     * @param type $keys_too
     * @return type
     */
    public function replaceTree($search="", $replace="", $array=false, $keys_too=false){
        if (!is_array($array)) {
            // Regular replace
            return str_replace($search, $replace, $array);
        }
        $newArr = array();
        foreach ($array as $k=>$v) {
            // Replace keys as well?
            $add_key = $k;
            if ($keys_too) {
                $add_key = str_replace($search, $replace, $k);
            }
            // Recurse
            $newArr[$add_key] = $this->replaceTree($search, $replace, $v, $keys_too);
        }
        return $newArr;
    }
    
    /**
     * Bind old name params with new one
     * @param array $structure parameters structure
     * @return array $structure parameters updated
     */
    public function bindArrayNameForTemplate(array $structure){
        $refArrayList = $this->buildReferenceArrayList();
        foreach ($refArrayList as $newArrayName => $oldArrayName) {
            $structure = $this->replaceTree($oldArrayName, $newArrayName, $structure, true);//replace name
        }
        foreach ($refArrayList as $newArrayName => $oldArrayName) {
            foreach ($structure as  $section=>$contains){
                if(array_key_exists($newArrayName, $contains)){ //is array in this section?
                    $structure[$section][$oldArrayName]= $newArrayName; //bind
                } 
            }           
        }
        return $structure;
    }
    
    
    
}

?>
