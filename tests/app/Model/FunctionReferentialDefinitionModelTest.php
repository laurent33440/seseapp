<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Model\FunctionReferentialDefinitionModel;

/**
 * Description of FunctionReferentialDefinitionModelTest
 *
 * @author prog
 */
class FunctionReferentialDefinitionModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var FunctionReferentialDefinitionModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new FunctionReferentialDefinitionModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testgetAll(){
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        foreach ($list as $id=>$val){
            $this->assertGreaterThanOrEqual(0, $id);//id func
            $this->assertStringMatchesFormat('%s', $val);//func
        }
    }

    /**
     * @depends testgetAll
     */
    public function testappend(){
        $this->object->getAll();
        $this->object->set_descriptionList('new function');
        $this->object->append();
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        $this->assertGreaterThanOrEqual(0, end(array_keys($list)));//id func
        $this->assertEquals('new function', end($list));
    }
    
    /**
     * @depends testappend
     */
    public function testupdate(){
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        $id = end(array_keys($list));
        $this->object->update('_descriptionList', 'new function updated', $id);
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        $this->assertGreaterThanOrEqual(0, end(array_keys($list)));//id func
        $this->assertEquals('new function updated', end($list));
    }
    
    /**
     * @depends testappend
     */
    public function testdeleteFromId(){
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        $id = end(array_keys($list));
        $val = end($list);
        $this->object->deleteFromId($id);
        $this->object->getAll();
        $list = $this->object->get_descriptionList();
        $this->assertNotEquals($id, end(array_keys($list)));
        $this->assertNotEquals($val, end($list));
    }
    

}
