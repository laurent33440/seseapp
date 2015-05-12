<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchoolDefinitionControllerTest
 *
 * @author prog
 */
class SchoolDefinitionControllerTest extends PHPUnit_Framework_TestCase{
    
    protected $_object;
    protected $_sequenceState;
    protected $_request;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->_request = new RequestHandler();
        $this->_sequenceState= new SequenceState(true);
        $this->_sequenceState->setCurrentState('SchoolDefinition');
        $this->_object = new SchoolDefinitionController($this->_request,  $this->_sequenceState);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        //$this->_sequenceState->flushHistorySession();
    }
    
    /**
     * 
     */
    public function testBuildCompleteFormArray(){
        $this->_object->setStateController(SchoolDefinitionController::TERMINATED); //stop computing
        $this->_object->run();
        $formExp = array(
            'form_schoolName' =>"_schoolName"
              ,'form_schoolSiret' =>"_schoolSiret"
              ,'form_schoolAddress1' =>"_schoolAddress1"
              ,'form_schoolAddress2' => "_schoolAddress2"
              ,'form_schoolCity' =>"_schoolCity"
              ,'form_schoolZipCode' =>"_schoolZipCode"
              ,'form_schoolPhone' =>"_schoolPhone"
              ,'form_schoolUrl' => "_schoolUrl"
              ,'form_schoolEmail' =>"_schoolEmail"
              ,'form_ph_schoolName' => ''
              ,'form_ph_schoolSiret' => ''
              ,'form_ph_schoolAddress1' => ''
              ,'form_ph_schoolAddress2' => ''
              ,'form_ph_schoolCity' => ''
              ,'form_ph_schoolZipCode' => ''
              ,'form_ph_schoolPhone' => ''
              ,'form_ph_schoolUrl' => ''
              ,'form_ph_schoolEmail' =>''
        );
        $formArray = $this->_object->buildCompleteFormArray();
        $this->assertEquals($formExp,$formArray);
    }
    
    /**
     * @depends testBuildCompleteFormArray
     */
    public function testGetValuesFromModelToForm(){
        $this->_object->setStateController(SchoolDefinitionController::TERMINATED); //stop computing
        $this->_object->run();
        $tst = $this->_object->getValuesFromModelToForm();
        $exp =array(
            'form_val_schoolName' =>
              NULL
              ,'form_val_schoolSiret' =>
              NULL
              ,'form_val_schoolAddress1' =>
              NULL
              ,'form_val_schoolAddress2' =>
              NULL
              ,'form_val_schoolCity' =>
              NULL
              ,'form_val_schoolZipCode' =>
              NULL
              ,'form_val_schoolPhone' =>
              NULL
              ,'form_val_schoolUrl' =>
              NULL
              ,'form_val_schoolEmail' =>
              NULL
        );
        var_dump($tst);
        $this->assertEquals($exp, $tst);
    }
    
    

}
