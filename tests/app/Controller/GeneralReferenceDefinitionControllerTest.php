<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralReferenceDefinitionControllerTest
 *
 * @author prog
 */
class GeneralReferenceDefinitionControllerTest extends PHPUnit_Framework_TestCase{
    
    /**
     *
     * @var GeneralReferenceDefinitionController
     */
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
        $this->_sequenceState->setCurrentState('GeneralReferenceDefinition');
        $this->_object = new GeneralReferenceDefinitionController($this->_request,  $this->_sequenceState);
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
        $this->_object->setStateController(GeneralReferenceDefinitionController::TERMINATED); //stop computing
        $this->_object->run();
        $formExp = array(
            'form_trainingName' =>"_trainingName"
              ,'form_trainingDomain' =>"_trainingDomain"
              ,'form_referentialReference' =>"_referentialReference"
              ,'form_referencialName' => "_referencialName"
              ,'form_referentialSpecification' =>"_referentialSpecification"
              ,'form_trainingTime' =>"_trainingTime"
              ,'form_internshipDuration' =>"_internshipDuration"
              ,'form_ph_trainingDomain' =>''
              ,'form_ph_referentialReference' =>''
              ,'form_ph_referencialName' => ''
              ,'form_ph_referentialSpecification' =>''
              ,'form_ph_trainingTime' =>''
              ,'form_ph_internshipDuration' =>''
        );
        $formArray = $this->_object->buildCompleteFormArray();
        $this->assertEquals($formExp,$formArray);
    }
    
    /**
     * @depends testBuildCompleteFormArray
     */
    public function testGetValuesFromModelToForm(){
        $this->_object->setStateController(GeneralReferenceDefinitionController::TERMINATED); //stop computing
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
        //var_dump($tst);
        $this->assertEquals($exp, $tst);
    }
}
