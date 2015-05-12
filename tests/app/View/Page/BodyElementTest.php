<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BodyElementTest
 *
 * @author prog
 */
class BodyElementTest extends PHPUnit_Framework_TestCase {
     /**
     * @var BodyElement
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $structure = 'un/deux/trois/tab';
        $params = array('un'=>1, 'deux'=>'2', 'trois'=>3, 'tab' => array('el1'=>'cell1', 'el2'=>'cell2'));
//        $params  = array('un'=>1, 'deux'=>'2', 'tab' => array('el1'=>'cell1', 'el2'=>'cell2'), 'trois'=>3);
        $this->object = new BodyElement($structure, $params);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
    }
    
    public function testGenerate(){
        $exp = '1/2/3/tab';
        $this->assertEquals($exp,$this->object->generate());
    }
}
