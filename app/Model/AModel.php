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
        $allMatched = $this->isArrayInclude($keysVarsValues,$this->getClassVars());
        if($allMatched){
            foreach ($keysVarsValues as $var => $value) {
                //if $value is an array this is the property name associated with arguments of the setting method
                if(is_array($value)){
                    $k = array_keys($value);
//                    var_dump($value);
//                    var_dump($value[$k[0]]);
                    call_user_func_array(array($this, 'set'.$k[0]),$value[$k[0]]);
                }else{
                    $this->{'set'.$var}($value);
                }
            }
        }
        return $allMatched;
    }
    
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
     * Check if keys in an associative array is include in another
     * @param type $tstArray : testing array's keys
     * @param type $refArray : keys references
     * @return boolean : true, all testing array keys are in array reference
     */
    public function isArrayInclude($tstArray,$refArray) {
        $tk = array_keys($tstArray);
        foreach($tk as $k) {
            if(is_numeric($k)){
                $t = $tstArray[$k];
                $kt = array_keys($t);
                $k = $kt[0];
            }
            if(!in_array($k, $refArray)) {
                return false;
            }
        }
        return true;
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
