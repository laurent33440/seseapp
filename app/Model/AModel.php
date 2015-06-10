<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use ReflectionClass;
use ReflectionProperty;

/**
 * Description of Model
 *
 * @author laurent
 */
abstract class AModel {
    const ERR_DUPLICATE='!!valeur dupliquée!!';

    /**
     * Retrieve private members of child model
     * @return list of members 's child model
     */
    public function getClassVars(){
        $reflection = new ReflectionClass($this);
        //$vars = array_keys($reflection->getdefaultProperties());// All kind of properties  : static, public, private, protected
        $props = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);
        $vars=array();
        foreach ($props as $prop) {
            $vars[]=$prop->getName();
        }
        $reflection = new ReflectionClass(__CLASS__);
        //$parentVars = array_keys($reflection->getdefaultProperties());// All kind of properties  : static, public, private, protected
        $props = array_keys($reflection->getProperties(ReflectionProperty::IS_PRIVATE));
        $parentVars = array();
        foreach ($props as $prop) {
            $parentVars[]=$prop->getName();
        }
        $childVars = array();
        foreach ($vars as $key) {
            if (!in_array($key, $parentVars)) {
                $childVars[] = $key;
            }
        }
        return $childVars;
    }
    
    /**
     * Set members values of model
     * @param list keys of member name and value : property_name => value OR array(id=>array(property_name => array(main_value, arg1, arg2, ...),...)
     * @return boolean true if all members are matched 
     */
    public function setClassVarsValues($keysVarsValues){
        foreach ($keysVarsValues as $var => $value) {
            if(is_array($value)){//if $value is an array 2 cases :
            //1)$var is the property name associated with arguments of the setting method (main value and arguments)
            //2)$var is a key and not an property name. Then First key of $value MUST be a valid property name.
                if($this->isPropertyModel($var)){//case 1
                    call_user_func_array(array($this, 'set'.$var),$value);
                }else{//case 2 
                    foreach ($value as $key => $valProperty) {//loop
                        if($this->isPropertyModel($key)){
                            if(!is_array($valProperty)){ //single value
                                call_user_func_array(array($this, 'set'.$key),array($valProperty));
                            }else{// list of arguments : array(main_value, arg1, arg2, ...)
                                call_user_func_array(array($this, 'set'.$key),$valProperty); 
                            }
                        }else{//something wrong ...
                            return false;
                        }
                    }
                }
            }else{
                if($this->isPropertyModel($var)){
                    $this->{'set'.$var}($value);
                }else{
                    return false;
                }
            }
        }
        return true;
    }
    
    /**
     * Set members values of model
     * @param list keys of member name and value : property_name => value OR array(id=>array(property_name => array(main_value, arg1, arg2, ...),...)
     * @return boolean true if all members are matched 
     */
//    public function setClassVarsValues_old($keysVarsValues){
//        $allMatched = $this->isArrayInclude($keysVarsValues,$this->getClassVars());
//        if($allMatched){
//            var_dump($keysVarsValues);
//            foreach ($keysVarsValues as $var => $value) {
//                //if $value is an array this is the property name associated with arguments of the setting method
//                if(is_array($value)){
//                    $k = array_keys($value);
////                    var_dump($value);
////                    var_dump($value[$k[0]]);
//                    call_user_func_array(array($this, 'set'.$k[0]),$value[$k[0]]);
//                }else{
//                    $this->{'set'.$var}($value);
//                }
//            }
//        }
//        return $allMatched;
//    }
    
    
    /**
     * Retrieve members values of model
     * @return set of member's name => value
     */
    public function getClassVarsValues(){
        $varsValues = array();
        $vars = $this->getClassVars();
        foreach ($vars as $var) {
            $val = $this->{'get'.$var}();
            $varsValues[$var] = $val;
        }
        return $varsValues;
    }
    
    /**
     * 
     * @param type $var
     */
    public function isPropertyModel($var){
        return (in_array($var, $this->getClassVars(),true));//strict checking (type)
    }


    
    
    /**
     * Save all members in SESSION
     * @param type $masterKey label for SESSION
     */
    public function saveClassVarsValuesInSession($masterKey){
        $model = $this->getClassVarsValues();
        foreach ($model as $member => $value) {
            \SeseSession::getInstance()->set($masterKey.'/'.$member, $value);
        }
    }

    /**
     * Restore value's member from SESSION
     * @param Key in SESSION
     * @return true if restored, false else 
     */
    public function restoreClassVarsValuesFromSession($masterKey){
        if(\SeseSession::getInstance()->has($masterKey)){
            $vars = $this->getClassVars();
            $model = array();
            foreach($vars as $var){
                $model[$var] = \SeseSession::getInstance()->get($masterKey.'/'.$var);
            }
            $this->setClassVarsValues($model);
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Default definition place Holder for model
     * @return array 
     */
    public function getClassVarsPlaceHolder(){
        return array_fill(0, count($this->getClassVars()), '');
    }
    
    /**
     * Debug function : get all members model
     */
    public function getMembersModel(){
        $reflection = new \ReflectionClass($this);
        $members = array_keys($reflection->getdefaultProperties());
        $vars=array();
        foreach ($members as $member) {
            $elt = $reflection->getProperty($member);
            $elt->setAccessible(true);
            $vars[$member] = $elt->getValue($this);
        }
        return $vars;
    }
}

?>
