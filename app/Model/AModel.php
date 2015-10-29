<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use ReflectionClass;
use ReflectionProperty;
use Model\Dal\DbLibrary\DataAccess;

/**
 * Description of Model
 *
 * @author laurent
 */
abstract class AModel {
    const __BY_VALUE_TO_TEMPLATE__='__BY_VALUE_TO_TEMPLATE__';//pass property of model by value to template to be evaluated in template -- see generator in template engine
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
     * Set properties values of model
     * @param list keys of member name and value : property_name => value OR array(id=>array(property_name => array(main_value, arg1, arg2, ...),...)
     * @return boolean true if all members are matched 
     */
    public function setClassVarsValues($keysVarsValues){
        foreach ($keysVarsValues as $var => $value) {
            if(is_array($value)){//if $value is an array 2 cases :
            //1)$var is the property name associated with arguments of the setting method (main value and arguments)
            //2)$var is a key and not an property name. Then First key of $value MUST be a valid property name.
            //3)$value is an enumeration of properties => args   
                if($this->isPropertyModel($var)){//case 1
                    call_user_func_array(array($this, 'set'.$var),$value);
                }else{//case 2 & 3
                    foreach ($value as $key => $valProperty) {//loop
                        if($this->isPropertyModel($key)){ //2
                            if(!is_array($valProperty)){ //single value
                                call_user_func_array(array($this, 'set'.$key),array($valProperty));
                            }else{// list of arguments : array(main_value, arg1, arg2, ...)
                                call_user_func_array(array($this, 'set'.$key),$valProperty); 
                            }
                        }else{// case 3 get property and args from key
                            $k = array_keys($valProperty);
                            $prop = $k[0];
                            call_user_func_array(array($this, 'set'.$prop),$valProperty[$prop]); 
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
     * Retrieve properties values of model with getter
     * @return set of member's name => value
     */
    public function getClassVarsValues(){
        $reflection = new ReflectionClass($this);
        $varsValues = array();
        $vars = $this->getClassVars();
        foreach ($vars as $var) {
            if($reflection->hasMethod('get'.$var)){
                $val = $this->{'get'.$var}();
                $varsValues[$var] = $val;
            }
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
     * get all ref_code=>ref_libelle for a given ref_type
     * @param type $typeRef : key to access all references for this 
     * @return array ref_code=>ref_libelle
     */
    protected function getReferenceDb($typeRef){
        $coll = new DataAccess('Reference');
        $all=$coll->GetAllByColumnValue('ref_type', $typeRef);
        $l=array();
        foreach ($all as $ref) {
            $l[$ref->ref_code]= $ref->ref_libelle;
        }
        return $l;
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
