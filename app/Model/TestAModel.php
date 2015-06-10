<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model;

/**
 * Description of TestAModel
 * TEST ABSTRACT AMODEL CLASS
 * @author laurent
 */
class TestAModel extends AModel{
    private $_var1;
    private $_list1 = array();
    
    protected $arg1;
    
    public function set_var1($var1, $arg=null) {
        $this->_var1 = $var1;
        $this->arg1 = $arg;
    }

    public function set_list1($elt, $id=null) {
        if($id!=null){
            $this->_list1[$id] = $elt;
        }else{
            $this->_list1[] = $elt;
        }
    }
    
    public function get_var1() {
        return $this->_var1;
    }

    public function get_list1() {
        return $this->_list1;
    }
    
    public function getArg1() {
        return $this->arg1;
    }






    
    
    
}
