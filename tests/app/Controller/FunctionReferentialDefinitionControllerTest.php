<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FunctionReferentialDefinition
 *
 * @author prog
 */
class FunctionReferentialDefinitionControllerTest extends PHPUnit_Framework_TestCase{
    /**
     *
     * @var FunctionReferentialDefinitionController
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
        $this->_sequenceState->setCurrentState('FunctionReferentialDefinition');
        $this->_object = new FunctionReferentialDefinitionController($this->_request,  $this->_sequenceState);
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
        $this->_object->setStateController(FunctionReferentialDefinitionController::TERMINATED); //stop computing
        $this->_object->run();
        $formExp = array(
            'form_descriptions' =>'_descriptions',
            'form_ph_descriptions' => ''
        );
        $formArray = $this->_object->buildCompleteFormArray();
        $this->assertEquals($formExp,$formArray);
    }


    public function testExplode(){
        $n = explode('Test',__CLASS__);
        $this->assertEquals('FunctionReferentialDefinitionController',$n[0]);
    }
    
    public function testFindParamsFromForm_GoodMemberNameOfModel(){
        $this->_request->setPostRequest(array( '_descriptions#0' => "préparez les équipements", 'ButtonSubmitAddFunction' =>  "addFunction" ));
        $exp = array('0' => array('_descriptions'=>'préparez les équipements'));
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $tst = $this->_object->findAllParamsFromForm( $this->_request->consumePostRequest(), $this->_object->getModel()->getClassVars());
        $this->assertEquals($exp,$tst);
    }
    
    public function testFindParamsFromForm_WrongMemberNameOfModel(){
        $this->_request->setPostRequest(array( 'something#0' => "préparez les équipements", 'ButtonSubmitAddFunction' =>  "addFunction" ));//wrong name
        $exp = array();
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $tst = $this->_object->findAllParamsFromForm( $this->_request->consumePostRequest(), $this->_object->getModel()->getClassVars());
        $this->assertEquals($exp,$tst);
    }
    
    public function testFindParamsFromForm_MultiParams(){
        $this->_request->setPostRequest(array(  '_descriptions#0' => "fonction 0",
                                                '_descriptions#1' => "fonction 1",
                                                '_descriptions#2' => "fonction 2",
                                                'ButtonSubmitAddFunction' =>  "addFunction" ));
        $exp = array('0'=> array('_descriptions' => 'fonction 0'),
                     '1'=> array('_descriptions' => 'fonction 1'),
                     '2'=> array('_descriptions' => 'fonction 2')
                );
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $tst = $this->_object->findAllParamsFromForm( $this->_request->consumePostRequest(), $this->_object->getModel()->getClassVars());
        $this->assertEquals($exp,$tst);
    }
    
    public function testFindParamsFromForm_MultiParamsNotBlank(){
        $this->_request->setPostRequest(array(  '_descriptions#0' => "fonction 0",
                                                '_descriptions#1' => '',
                                                '_descriptions#2' => "fonction 2",
                                                'ButtonSubmitAddFunction' =>  "addFunction" ));
       $exp = array('0'=> array('_descriptions' => 'fonction 0'),
                    '2'=> array('_descriptions' => 'fonction 2')
                );
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $tst = $this->_object->findAllParamsFromForm( $this->_request->consumePostRequest(), $this->_object->getModel()->getClassVars());
        $this->assertEquals($exp,$tst);
    }
    
    
    /**
     * 
     */
    public function testCompute_AddFunc(){
        $this->_request->setPostRequest(array(  '_descriptions#0' => "fonction 0",
                                                '_descriptions#1' => "fonction 1",
                                                '_descriptions#2' => "fonction 2",
                                                '_descriptions#3' => "fonction 3",
                                                'ButtonSubmitAddFunction' =>  "addFunction" ));
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $this->_object->getModel()->delFunctionsFromDataBase();
        $r=$this->_object->compute($this->_request->consumePostRequest());//compute datas
        $this->assertTrue($r); //controller still running
        $exp = array('fonction 0', 'fonction 1', 'fonction 2','fonction 3' ); 
        $tst = $this->_object->getModel()->get_descriptions();
        $this->assertEquals($exp,$tst);
    }
    
    /**
     * 
     */
    public function testCompute_AddFuncDuplicate(){
        $this->_request->setPostRequest(array(  '_descriptions#0' => "fonction 0",
                                                '_descriptions#1' => "fonction 1",
                                                '_descriptions#2' => "fonction 2",
                                                '_descriptions#3' => "fonction 2",
                                                'ButtonSubmitAddFunction' =>  "addFunction" ));
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $this->_object->getModel()->delFunctionsFromDataBase();
        $r=$this->_object->compute($this->_request->consumePostRequest());//compute datas
        $this->assertTrue($r); //controller still running
        $exp = array('fonction 0', 'fonction 1', 'fonction 2');
        $tst = $this->_object->getModel()->get_descriptions();
        $this->assertEquals($exp,$tst);
    }
    
    /**
     * @depends testCompute_AddFunc
     * dataProvider testCompute_AddFunc
     */
    public function testCompute_DelFunc(){
        $this->testCompute_AddFunc();
        $this->_request->setPostRequest(array(  '_descriptions#0' => "fonction 0",
                                                '_descriptions#1' => "fonction 1",
                                                '_descriptions#2' => "fonction 2",
                                                '_descriptions#3' => "fonction 3",
                                                'ButtonSubmitDelFunction' =>  '2' )); // 0 based index
        $r=$this->_object->compute($this->_request->consumePostRequest());//compute datas
        $this->assertTrue($r); //controller still running
        $exp = array('fonction 0', 'fonction 2', 'fonction 3'); 
        $tst = $this->_object->getModel()->get_descriptions();
        $this->assertEquals($exp,$tst);
    }
    
   
    
    
}
