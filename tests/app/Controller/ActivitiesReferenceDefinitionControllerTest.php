<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use controller\AControllerState;
use controller\ActivitiesReferenceDefinitionController;
//use \RequestHandler;
use Symfony\Component\HttpFoundation\Request;
use SequenceState;
use model\ActivitiesReferenceDefinitionModel;
use model\FunctionReferentialDefinitionModel;
use Logger;

/**
 * Description of ActivitiesReferenceDefinitionTest
 *
 * @author laurent
 */
class ActivitiesReferenceDefinitionControllerTest extends PHPUnit_Framework_TestCase{
    /**
     *
     * @var ActivitiesReferenceDefinitionController
     */
    protected $_object;
    /**
     *
     * @var SequenceState 
     */
    protected $_sequenceState;
    /**
     *
     * @var Request 
     */
    protected $_request;
    /**
     *
     * @var Logger
     */
    protected $_log;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->_request = Request::createFromGlobals();
        $this->_sequenceState= new SequenceState(true);//no session
        $this->_sequenceState->setCurrentState('ActivitiesReferenceDefinition');
        $this->_object = new ActivitiesReferenceDefinitionController($this->_request,  $this->_sequenceState);
        $this->fonctionsListProvider();
        $this->_log = Logger::getInstance();
        $this->_log->setLogFile("testLog.txt", false);
        $this->_log->setPriority(Logger::DEBUG);
        $this->_log->logInfo("\n======== TESTS Log Start ".__CLASS__." ========\n---------------------------------");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        //$this->_sequenceState->flushHistorySession();
    }
    
    //some fixture
    public function fonctionsListProvider(){
        $vals= array('Fonction 1','Fonction 2','Fonction 3', 'Fonction 4', 'Fonction 5');
        $functionsModel = new FunctionReferentialDefinitionModel();
        $functionsModel->delFunctionsFromDataBase();
        foreach ($vals as $val){
            $functionsModel->set_descriptions($val);
        }
        $functionsModel->addFunctionToDataBase();
    }
    
    //helper function
    public function eraseActivitiesFromDb($activitiesModel=null){
        if(!$activitiesModel)
            $activitiesModel = new ActivitiesReferenceDefinitionModel();
        $activitiesModel = $this->_object->getModel();
        $activitiesModel->delActivitiesFromDataBase(); //avoid foreign keys problem
    }

    //helper function
    public function addActivitiesToDb($number=1, $activitiesModel=null){
        if(!$activitiesModel)
            $activitiesModel = new ActivitiesReferenceDefinitionModel();
        for ($n=1; $n<=$number ; $n++){
            $activitiesModel->set_activitiesReferencesList("A1-$n" );
            $activitiesModel->set_functionsList(array('Fonction 3', 'Fonction 1','Fonction 2','Fonction 4','Fonction 5'));
            $activitiesModel->set_activitiesDescriptionsList("Mon activit&eacute; $n");
            $activitiesModel->addActivityToDataBase();
        }
    }

    public function testPregMatch(){
        $tst='someVar#12';
        $matches = array();
        preg_match('/(?P<param>\w+)#(?P<id>\d+)/', $tst, $matches);
        $this->assertEquals('someVar', $matches['param']);
        $this->assertEquals('12', $matches['id']);
        $vars = array('myVar1', 'myVar2');
        $tst=$vars[0].'#13';
        $matches = array();
        $regExp = '/(?P<param>\\'.$vars[0].')#(?P<id>\d+)/'; //double backslash needed to inhibate one else quote is escaped 
        preg_match($regExp, $tst, $matches);
        $this->assertEquals('myVar1', $matches['param']);
        $this->assertEquals('13', $matches['id']);
    }

    public function testFindAllParamsFromForm_SingleActivity(){
        $parameters = array(  '_activitiesReferencesList#1' => "A1-1",
                                                '_functionsList#1' => "Fonction 3",
                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
                                                'ButtonSubmitAddFunction' =>  '' );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $exp = array('1'=>array( '_activitiesReferencesList'=>'A1-1',
                            '_functionsList' => "Fonction 3",
                            '_activitiesDescriptionsList' => "Mon activit&eacute; 1"
                    )
                );
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $varsModel = $this->_object->getModel()->getClassVars();
        $tst = $this->_object->findAllParamsFromForm($this->_request->request->all(), $varsModel);
        $this->assertNotNull($tst);
//        var_dump($tst);
        $this->assertEquals($exp,$tst);
    }
    
    public function testFindAllParamsFromForm_MultipleActivities(){
        $parameters = array(  '_activitiesReferencesList#1' => "A1-1",
                                                '_functionsList#1' => "Fonction 3",
                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
                                                '_activitiesReferencesList#2' => "A2-2",
                                                '_functionsList#2' => "Fonction 4",
                                                '_activitiesDescriptionsList#2' => "Mon activit&eacute; 2",
                                                '_activitiesReferencesList#3' => "A3-3",
                                                '_functionsList#3' => "Fonction 5",
                                                '_activitiesDescriptionsList#3' => "Mon activit&eacute; 3",
                                                'ButtonSubmitAddActivity' =>  '' 
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $exp = array('1'=>array( '_activitiesReferencesList'=>'A1-1',
                            '_functionsList' => "Fonction 3",
                            '_activitiesDescriptionsList' => "Mon activit&eacute; 1"
                            ),
                     '2'=> array('_activitiesReferencesList' => "A2-2",
                            '_functionsList' => "Fonction 4",
                            '_activitiesDescriptionsList' => "Mon activit&eacute; 2"
                            ),
                     '3'=> array('_activitiesReferencesList' => "A3-3",
                            '_functionsList' => "Fonction 5",
                            '_activitiesDescriptionsList' => "Mon activit&eacute; 3"
                            )
                );
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $varsModel = $this->_object->getModel()->getClassVars();
        $tst = $this->_object->findAllParamsFromForm($this->_request->request->all(), $varsModel);
        $this->assertNotNull($tst);
//        var_dump($tst);
        $this->assertEquals($exp,$tst);
    }
    
    /**
     * 
     */
    public function testFindAllParamsFromForm_NoParams(){
        $parameters = array(  'something' => "A1-1",
                                                'aData' => "Fonction 3",
                                                'aData#99' => "Fonction 3"
            );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $exp =array();
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $varsModel = $this->_object->getModel()->getClassVars();
        $tst = $this->_object->findAllParamsFromForm($this->_request->request->all(), $varsModel);
        $this->assertNotNull($tst);
        $this->assertEquals($exp,$tst);
    }
    
    /**
     * 
     */
    public function testBuildModelView_blank(){
        $exp = array(
            'header' => Array(
                'VERSION' => '010614',
                'CURRENT_STEP_NUMBER' => 6,
                'STEP_NUMBER' => 11,
                'BACK_BUTTON' => 'true',
                'FORWARD_BUTTON' => 'true',
                'PREVIOUS_URI' => '/sese/index.php/previous',
                'NEXT_URI' => '/sese/index.php/next',
            ),
            'body' => Array(
                'form_activitiesReferencesList' => '_activitiesReferencesList',
                'form_functionsList' => '_functionsList',
                'form_activitiesDescriptionsList' => '_activitiesDescriptionsList',
                'form_ph_activitiesReferencesList' => '',
                'form_ph_functionsList' => '',
                'form_ph_activitiesDescriptionsList' => '',
                'form_val_activitiesReferencesList' => Array
                    (
                        1 => ''
                    ),

                'form_val_functionsList' => Array
                    (
                        1 => Array
                            (
                                0 => 'Fonction 1',
                                1 => 'Fonction 2',
                                2 => 'Fonction 3',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            )

                    ),

                'form_val_activitiesDescriptionsList' => Array
                    (
                        1 => ''
                    ),

                'INDEX' => '/sese/index.php',
                'BUTTON_ADD_NAME' => 'ButtonSubmitAddActivity',
                'BUTTON_DEL_NAME' => 'ButtonSubmitDelActivity'
            ),
            'footer' => Array(
                'INDEX' => '/sese/index.php',
                'URI_COMPANY' => 'www.avalone-fr.com',
                'SHOW_MODAL' => 'false'
            )
        );
        $this->_object->setStateController(AControllerState::IDLE); //first time running controller
        $this->_object->run();//build view model
        $this->assertEquals($exp,$this->_object->getModelView());
    }
    
    /**
     * 
     */
    public function testCompute_AddOneActivity(){
        $parameters = array(  '_activitiesReferencesList#1' => "A1-1",
                                                '_functionsList#1' => 'Fonction 3',
                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
                                                'ButtonSubmitAddActivity' =>  '1' 
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $this->_object->setStateController(AControllerState::TERMINATED);
        $this->_object->run();//instanciate model
        $this->_object->getModel()->delActivitiesFromDataBase();
        $this->_object->setStateController(AControllerState::RUNNING);
        $r=$this->_object->compute($this->_request->request->all());//compute datas
        $this->assertTrue($r); //controller still running
        $exp = array('A1-1' ); 
        $tst = $this->_object->getModel()->get_activitiesReferencesList();
        $this->assertEquals($exp,$tst);
        $exp = array(array('Fonction 3', 'Fonction 1','Fonction 2','Fonction 4', 'Fonction 5'));
        $tst = $this->_object->getModel()->get_functionsList();
        $this->assertEquals($exp,$tst);
        $exp = array('Mon activit&eacute; 1');
        $tst = $this->_object->getModel()->get_activitiesDescriptionsList();
        $this->assertEquals($exp,$tst);
        $exp = array(
            'header' => Array(
                'VERSION' => '010614',
                'CURRENT_STEP_NUMBER' => 6,
                'STEP_NUMBER' => 11,
                'BACK_BUTTON' => 'true',
                'FORWARD_BUTTON' => 'true',
                'PREVIOUS_URI' => '/sese/index.php/previous',
                'NEXT_URI' => '/sese/index.php/next',
            ),
            'body' => Array(
                'form_activitiesReferencesList' => '_activitiesReferencesList',
                'form_functionsList' => '_functionsList',
                'form_activitiesDescriptionsList' => '_activitiesDescriptionsList',
                'form_ph_activitiesReferencesList' => '',
                'form_ph_functionsList' => '',
                'form_ph_activitiesDescriptionsList' => '',
                'form_val_activitiesReferencesList' => Array
                    (
                        1 => 'A1-1',
                        2 => ''
                    ),

                'form_val_functionsList' => Array
                    (
                        1 => Array
                            (
                                0 => 'Fonction 3',
                                1 => 'Fonction 1',
                                2 => 'Fonction 2',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            ),
                        2 => Array
                            (
                                0 => 'Fonction 1',
                                1 => 'Fonction 2',
                                2 => 'Fonction 3',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            )

                    ),

                'form_val_activitiesDescriptionsList' => Array
                    (
                        1 => 'Mon activit&eacute; 1',
                        2 => ''
                    ),

                'INDEX' => '/sese/index.php',
                'BUTTON_ADD_NAME' => 'ButtonSubmitAddActivity',
                'BUTTON_DEL_NAME' => 'ButtonSubmitDelActivity'
            ),
            'footer' => Array(
                'INDEX' => '/sese/index.php',
                'URI_COMPANY' => 'www.avalone-fr.com',
                'SHOW_MODAL' => 'false'
            )
        );
        $this->eraseActivitiesFromDb();
    }

    /**
     * @depends testCompute_AddOneActivity
     */
    public function testBuildModelView_oneActivity(){
        $exp = array(
            'header' => Array(
                'VERSION' => '010614',
                'CURRENT_STEP_NUMBER' => 6,
                'STEP_NUMBER' => 11,
                'BACK_BUTTON' => 'true',
                'FORWARD_BUTTON' => 'true',
                'PREVIOUS_URI' => '/sese/index.php/previous',
                'NEXT_URI' => '/sese/index.php/next',
            ),
            'body' => Array(
                'form_activitiesReferencesList' => '_activitiesReferencesList',
                'form_functionsList' => '_functionsList',
                'form_activitiesDescriptionsList' => '_activitiesDescriptionsList',
                'form_ph_activitiesReferencesList' => '',
                'form_ph_functionsList' => '',
                'form_ph_activitiesDescriptionsList' => '',
                'form_val_activitiesReferencesList' => Array
                    (
                        1 => 'A1-1',
                        2 => ''
                    ),

                'form_val_functionsList' => Array
                    (
                        1 => Array
                            (
                                0 => 'Fonction 3',
                                1 => 'Fonction 1',
                                2 => 'Fonction 2',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            ),
                        2 => Array
                            (
                                0 => 'Fonction 1',
                                1 => 'Fonction 2',
                                2 => 'Fonction 3',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            )

                    ),

                'form_val_activitiesDescriptionsList' => Array
                    (
                        1 => 'Mon activit&eacute; 1',
                        2 => ''
                    ),

                'INDEX' => '/sese/index.php',
                'BUTTON_ADD_NAME' => 'ButtonSubmitAddActivity',
                'BUTTON_DEL_NAME' => 'ButtonSubmitDelActivity'
            ),
            'footer' => Array(
                'INDEX' => '/sese/index.php',
                'URI_COMPANY' => 'www.avalone-fr.com',
                'SHOW_MODAL' => 'false'
            )
        );
        $this->addActivitiesToDb(1);
        $this->_object->setStateController(AControllerState::STOPPED); //restore model
        $this->_object->run();//restore model, build view
        $this->assertEquals($exp,$this->_object->getModelView());
        $this->eraseActivitiesFromDb(); //clean db
    }
    
    /**
     * @depends testCompute_AddOneActivity
     */
    public function testCompute_DelOneActivity(){
//        $this->markTestSkipped('NOT YET');
        $this->addActivitiesToDb(2);
        $parameters = array(  '_activitiesReferencesList#1' => "A1-1",
                                                '_functionsList#1' => 'Fonction 3',
                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
                                                'ButtonSubmitDelActivity' =>  '1'
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $this->_object->setStateController(AControllerState::RUNNING);
        $this->_object->run();
        $r=$this->_object->compute($this->_request->request->all());//compute datas
        $this->assertTrue($r); //controller still running
        $exp = array(
            'header' => Array(
                'VERSION' => '010614',
                'CURRENT_STEP_NUMBER' => 6,
                'STEP_NUMBER' => 11,
                'BACK_BUTTON' => 'true',
                'FORWARD_BUTTON' => 'true',
                'PREVIOUS_URI' => '/sese/index.php/previous',
                'NEXT_URI' => '/sese/index.php/next',
            ),
            'body' => Array(
                'form_activitiesReferencesList' => '_activitiesReferencesList',
                'form_functionsList' => '_functionsList',
                'form_activitiesDescriptionsList' => '_activitiesDescriptionsList',
                'form_ph_activitiesReferencesList' => '',
                'form_ph_functionsList' => '',
                'form_ph_activitiesDescriptionsList' => '',
                'form_val_activitiesReferencesList' => Array
                    (
                        1 => 'A1-2',
                        2 => ''
                    ),

                'form_val_functionsList' => Array
                    (
                        1 => Array
                            (
                                0 => 'Fonction 3',
                                1 => 'Fonction 1',
                                2 => 'Fonction 2',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            ),
                        2 => Array
                            (
                                0 => 'Fonction 1',
                                1 => 'Fonction 2',
                                2 => 'Fonction 3',
                                3 => 'Fonction 4',
                                4 => 'Fonction 5',
                            )

                    ),

                'form_val_activitiesDescriptionsList' => Array
                    (
                        1 => 'Mon activit&eacute; 2',
                        2 => ''
                    ),

                'INDEX' => '/sese/index.php',
                'BUTTON_ADD_NAME' => 'ButtonSubmitAddActivity',
                'BUTTON_DEL_NAME' => 'ButtonSubmitDelActivity'
            ),
            'footer' => Array(
                'INDEX' => '/sese/index.php',
                'URI_COMPANY' => 'www.avalone-fr.com',
                'SHOW_MODAL' => 'false'
            )
        );
        $this->_object->setStateController(AControllerState::STOPPED); //restore model
        $this->_object->run();//restore model, build view
        $this->assertEquals($exp,$this->_object->getModelView());
        $this->eraseActivitiesFromDb(); 
    }
    
    public function testComputeXmlHttpRequest_descriptionUpdate(){
        $parameters = array(    'AJAX_UPDATE' => 'blur',
                                'AJAX_ID' => 'activityDescription#1',
                                'AJAX_VAL' => 'activité 1000'
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $this->_request->headers->set('X-Requested-With', 'XMLHttpRequest'); //AJAX
        $this->_object = new ActivitiesReferenceDefinitionController($this->_request,  $this->_sequenceState);
        $this->addActivitiesToDb(3);
        $this->_object->setStateController(AControllerState::RUNNING);
        $this->_object->run();
        $tst = $this->_object->getModel()->get_activitiesDescriptionsList();
        $this->assertEquals('activité 1000', $tst[0]);
        $this->eraseActivitiesFromDb();
    }
    
    public function testComputeXmlHttpRequest_referenceUpdate(){
        $parameters = array(    'AJAX_UPDATE' => 'blur',
                                'AJAX_ID' => 'activityReference#1',
                                'AJAX_VAL' => 'reference 1000'
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $this->_request->headers->set('X-Requested-With', 'XMLHttpRequest'); //AJAX
        $this->_object = new ActivitiesReferenceDefinitionController($this->_request,  $this->_sequenceState);
        $this->addActivitiesToDb(3);
        $this->_object->setStateController(AControllerState::RUNNING);
        $this->_object->run();
        $tst = $this->_object->getModel()->get_activitiesReferencesList();
        $this->assertEquals('reference 1000', $tst[0]);
        $this->eraseActivitiesFromDb();
    }
    
    public function testComputeXmlHttpRequest_functionUpdate(){
        $parameters = array(    'AJAX_UPDATE' => 'blur',
                                'AJAX_ID' => 'functionChoosenForActivity#1',
                                'AJAX_VAL' => 'Fonction 5'
                                        );
        $this->_request = Request::create('http://localhost/sese/index.php', 'POST', $parameters);
        $this->_request->headers->set('X-Requested-With', 'XMLHttpRequest'); //AJAX
        $this->_object = new ActivitiesReferenceDefinitionController($this->_request,  $this->_sequenceState);
        $this->addActivitiesToDb(3);
        $this->_object->setStateController(AControllerState::RUNNING);
        $this->_object->run(); //instanciate model
        $tst = $this->_object->getModel()->get_functionsList();
        $this->assertEquals('Fonction 5', $tst[0]);
        $this->eraseActivitiesFromDb();
    }
    
    
    
    /**
     * 
     * FOR MULTIPLE ACTIVITIES TO ADD, YOU HAVE TO LOOP OVER ALL ELEMENT OF LIST IN MODEL AND ADD IT INDIVIDUALLY
     */
//    public function testCompute_AddActivities(){
//        $this->_request->setPostRequest(array(  '_activitiesReferencesList#1' => "A1-1",
//                                                '_functionsList#1' => 'Fonction 3',
//                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
//                                                '_activitiesReferencesList#2' => "A2-2",
//                                                '_functionsList#2' => 'Fonction 4',
//                                                '_activitiesDescriptionsList#2' => "Mon activit&eacute; 2",
//                                                '_activitiesReferencesList#3' => "A3-3",
//                                                '_functionsList#3' => 'Fonction 5',
//                                                '_activitiesDescriptionsList#3' => "Mon activit&eacute; 3",
//                                                'ButtonSubmitAddActivity' =>  '' 
//                                        ));
//        $this->_object->setStateController(AControllerState::TERMINATED);
//        $this->_object->run();//instanciate model
//        $this->_object->getModel()->delActivitiesFromDataBase();
//        $this->_object->setStateController(AControllerState::RUNNING);
//        $r=$this->_object->compute($this->_request->consumePostRequest());//compute datas
//        $this->assertTrue($r); //controller still running
//        $exp = array('A1-1', 'A2-2', 'A3-3' ); 
//        $tst = $this->_object->getModel()->get_activitiesReferencesList();
//        $this->assertEquals($exp,$tst);
//        $exp = array('Fonction 3', 'Fonction 4', 'Fonction 5');
//        $tst = $this->_object->getModel()->get_functionsList();
//        var_dump($tst);
//        $this->assertEquals($exp,$tst);
//        $exp = array('Mon activit&eacute; 1', 'Mon activit&eacute; 2', 'Mon activit&eacute; 3');
//        $tst = $this->_object->getModel()->get_activitiesDescriptionsList();
//        $this->assertEquals($exp,$tst);
//    }
    
//    /**
//     * @depends testCompute_AddActivities
//     */
//    public function testCompute_DelActivities(){
//        $this->_request->setPostRequest(array(  '_activitiesReferencesList#1' => "A1-1",
//                                                '_functionsList#1' => "Fonction 3",
//                                                '_activitiesDescriptionsList#1' => "Mon activit&eacute; 1",
//                                                '_activitiesReferencesList#2' => "A2-2",
//                                                '_functionsList#2' => "Fonction 4",
//                                                '_activitiesDescriptionsList#2' => "Mon activit&eacute; 2",
//                                                '_activitiesReferencesList#3' => "A3-3",
//                                                '_functionsList#3' => "Fonction 5",
//                                                '_activitiesDescriptionsList#3' => "Mon activit&eacute; 3",
//                                                'ButtonSubmitDelActivity' =>  '1' 
//                                        ));
//        $this->_object->setStateController(AControllerState::TERMINATED);
//        $this->_object->run();//instanciate model
//        //$this->_object->getModel()->delFunctionsFromDataBase();
//        $this->_object->setStateController(AControllerState::RUNNING);
//        $this->_object->run();//compute datas
//        $exp = array('A2-2', 'A3-3' ); 
//        $tst = $this->_object->getModel()->get_activitiesReferencesList();
//        $this->assertEquals($exp,$tst);
//        $exp = array( 'Fonction 4', 'Fonction 5');
//        $tst = $this->_object->getModel()->get_functionsList();
//        $this->assertEquals($exp,$tst);
//        $exp = array( 'Mon activit&eacute; 2', 'Mon activit&eacute; 3');
//        $tst = $this->_object->getModel()->get_activitiesDescriptionsList();
//        $this->assertEquals($exp,$tst);
//    }
    
}
