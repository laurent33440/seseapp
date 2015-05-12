<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchoolDefinitionModelTest
 *
 * @author prog
 */
class SchoolDefinitionModelTest extends PHPUnit_Framework_TestCase{
     /**
     * @var SchoolDefinitionModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new SchoolDefinitionModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testGetClassVarsValues(){
        $tst = $this->object->getClassVarsValues();
        var_dump($tst);
        $exp =array(
            '_schoolName' =>
              NULL
              ,'_schoolSiret' =>
              NULL
              ,'_schoolAddress1' =>
              NULL
              ,'_schoolAddress2' =>
              NULL
              ,'_schoolCity' =>
              NULL
              ,'_schoolZipCode' =>
              NULL
              ,'_schoolPhone' =>
              NULL
              ,'_schoolUrl' =>
              NULL
              ,'_schoolEmail' =>
              NULL
        );
        $this->assertEquals($exp, $tst);
        
    }
    
    public function testCreateSchool(){
        $this->object->set_schoolName('lycee lppdg');
        $this->object->createSchool();
    }
    
    /**
     * @depends testCreateSchool
     */
    public function testGetSchoolFromDataBase(){
        $this->object->getSchoolFromDataBase();
        $this->assertEquals('lycee lppdg', $this->object->get_schoolName());
    }
}
