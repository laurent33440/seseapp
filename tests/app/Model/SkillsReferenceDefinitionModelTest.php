<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Model\SkillsReferenceDefinitionModel;
use Model\ActivitiesReferenceDefinitionModel;
use Model\FunctionReferentialDefinitionModel;

/**
 * Description of SkillsReferenceDefinitionModelTest
 *
 * @author laurent
 */
class SkillsReferenceDefinitionModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var SkillsReferenceDefinitionModel
     */
    protected $object;

    /**
     * @var ActivitiesReferenceDefinitionModel;
     */
    protected static $activitiesReferences;

    public static function setUpBeforeClass() {
        self::$activitiesReferences = new ActivitiesReferenceDefinitionModel();
//        self::ActivitiesProvider();
    }

    public static function tearDownAfterClass() {
//        self::$activitiesReferences->delActivitiesFromDataBase();
//        self::$activitiesReferences = null;
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new SkillsReferenceDefinitionModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    //some fixture
//    public static function fonctionsListProvider() {
//        $vals = array('Fonction 0', 'Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4');
//        $functionsModel = new FunctionReferentialDefinitionModel();
//        $functionsModel->delFunctionsFromDataBase();
//        foreach ($vals as $val) {
//            $functionsModel->set_descriptions($val);
//        }
//        $functionsModel->addFunctionToDataBase();
//        return array(array($vals));
//    }

//    public static function ActivitiesProvider() {
//        self::fonctionsListProvider();
//        self::$activitiesReferences = new ActivitiesReferenceDefinitionModel();
//        for ($n = 0; $n < 5; $n++) {
//            self::$activitiesReferences->set_activitiesReferencesList("A$n-$n test");
//            self::$activitiesReferences->set_functionsList("Fonction $n");
//            self::$activitiesReferences->set_activitiesDescriptionsList("Mon activit&eacute; test test test -- ligne ($n)");
//            self::$activitiesReferences->addActivityToDataBase();
//        }
//    }


    /**
     * @depends testGetDefinedActivities
     */
    public function testAddBlankToModel() {
        $a = $this->object->addBlank();
        $exp = array('Mon activit&eacute; test test test -- ligne (0)',
            'Mon activit&eacute; test test test -- ligne (1)',
            'Mon activit&eacute; test test test -- ligne (2)',
            'Mon activit&eacute; test test test -- ligne (3)',
            'Mon activit&eacute; test test test -- ligne (4)'
        );
        $this->assertEquals($exp, $this->object->get_activitiesList());
    }

    public function testSet_bindedActivitiesLists() {
        $a11 = 'activity 1 binded to skill 1';
        $a21 = 'activity 2 binded to skill 1';
        $a12 = 'activity 1 binded to skill 2';
        $a22 = 'activity 2 binded to skill 2';
        $a299 = 'activity 99 binded to skill 2';
        $exp1 = array(array($a11));
        $this->object->set_bindedActivitiesLists($a11, 0);
        $this->assertEquals($exp1, $this->object->get_bindedActivitiesLists());
        $exp2 = array(array($a11, $a21));
        $this->object->set_bindedActivitiesLists($a21, 0);
        $this->assertEquals($exp2, $this->object->get_bindedActivitiesLists());
        $exp3 = array(array($a11, $a21), array($a12));
        $this->object->set_bindedActivitiesLists($a12, 1);
        $this->assertEquals($exp3, $this->object->get_bindedActivitiesLists());
        $exp4 = array(array($a11, $a21), array($a12, $a22));
        $this->object->set_bindedActivitiesLists($a22, 1);
        $this->assertEquals($exp4, $this->object->get_bindedActivitiesLists());
        $exp4 = array(array($a11, $a21), array(0 => $a12, 1 => $a22, 99 => $a299));
        $this->object->set_bindedActivitiesLists($a299, 1, 99);
        $this->assertEquals($exp4, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a299, 1); //activity already in model, musn't be added
        $this->assertEquals($exp4, $this->object->get_bindedActivitiesLists()); // no change
    }

    public function isArrayIncludeProvider() {
        $ref1 = array('a', 'b', 'c');
        $tst1 = array('a' => 1, 'b' => 2, 'c' => 3);
        $tst2 = array('a' => 1, 'c' => 3);
        $tst3 = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4);
        $ref2 = array('a', 'b', 'c', 'k1', 'k2');
        $tst4 = array('a' => 1, 'b' => 2, 'c' => 3, 0 => array('k1' => array('val1')), 1 => array('k2' => array('val2')));
        $tst5 = array('a' => 1, 'b' => 2, 1 => array('k2' => array('val2')));
        $tst6 = array('a' => 1, 'b' => 2, 0 => array('k_unknown' => array('val1')), 1 => array('k2' => array('val2')));
        return array(
            array($tst1, $ref1, true),
            array($tst2, $ref1, true),
            array($tst3, $ref1, false),
            array($tst4, $ref2, true),
            array($tst5, $ref2, true),
            array($tst6, $ref2, false),
        );
    }

    /**
     * @dataProvider isArrayIncludeProvider
     */
    public function testIsArrayInclude(array $tst, array $ref, $result) {
        $this->assertEquals($result, $this->object->isArrayInclude($tst, $ref));
    }

    /**
     * tests for setters of models
     */
    public function test_call_user_func_array_PHP() {
        $this->object->set_skillsReferencesList('c1');
        $r = $this->object->get_skillsReferencesList(); //array('c1')
        call_user_func_array(array($this->object, 'set_skillsReferencesList'), array('c2'));
        $r = $this->object->get_skillsReferencesList(); //array('c1','c2');
        $this->assertEquals(array('c1', 'c2'), $r);
        $func = 'set_skillsReferencesList';
        $param = 'c3';
        call_user_func_array(array($this->object, $func), array($param));
        $r = $this->object->get_skillsReferencesList(); //array('c1','c2');
        $this->assertEquals(array('c1', 'c2', 'c3'), $r);
        $func = 'set_bindedActivitiesLists';
        $arrArgs = array('activity 0 skill 0', 0);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array('activity 0 skill 0')), $r);
        $arrArgs = array('activity 1 skill 0', 0);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array('activity 0 skill 0', 'activity 1 skill 0')), $r);
        $arrArgs = array('activity 2 skill 1', 1);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array('activity 0 skill 0', 'activity 1 skill 0'), array('activity 2 skill 1')), $r);
        $arrArgs = array('activity 3 skill 1', 1, 10);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array('activity 0 skill 0', 'activity 1 skill 0'), array('activity 2 skill 1', 10 => 'activity 3 skill 1')), $r);
        $arrArgs = array('activity 3 skill 2', 2, 20);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array('activity 0 skill 0', 'activity 1 skill 0'), array('activity 2 skill 1', 10 => 'activity 3 skill 1'), array(20 => 'activity 3 skill 2')), $r);
    }

    public function testSetClassVarsValues_multipleArgs() {
        $params = array(
            '_skillsReferencesList' => 'c1',
            0 => array('_bindedActivitiesLists' => array('activity 1 binded to skill 0', 0, 0)), //property_name => array(main_value, args...)
            '_skillsDescriptionsList' => 'my foo skill 1'
        ); // filtered datas model from controller
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c2',
            0 => array('_bindedActivitiesLists' => array('activity 2 binded to skill 0', 0, 10)),
            '_skillsDescriptionsList' => 'my foo skill 2'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1', 'c2'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0', 10 => 'activity 2 binded to skill 0')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1', 'my foo skill 2'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c3',
            0 => array('_bindedActivitiesLists' => array('activity 1 binded to skill 1', 1, 20)),
            '_skillsDescriptionsList' => 'my foo skill 3'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1', 'c2', 'c3'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0', 10 => 'activity 2 binded to skill 0'), array(20 => 'activity 1 binded to skill 1')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1', 'my foo skill 2', 'my foo skill 3'), $this->object->get_skillsDescriptionsList());
    }

    public function testSetClassVarsValues_multipleArgs_listOfSettings() {
        $params = array(
            '_skillsReferencesList' => 'c1',
            0 => array('_bindedActivitiesLists' => array('activity 1 binded to skill 0', '0')),
            1 => array('_bindedActivitiesLists' => array('activity 3 binded to skill 0', '0', '4')),
            '_skillsDescriptionsList' => 'my foo skill 1'
        ); // filtered data model from controller
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0', 4 => 'activity 3 binded to skill 0')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c2',
            0 => array('_bindedActivitiesLists' => array('activity 2 binded to skill 1', 1, 2)),
            1 => array('_bindedActivitiesLists' => array('activity 3 binded to skill 1', 1, 3)),
            '_skillsDescriptionsList' => 'my foo skill 2'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1', 'c2'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0', 4 => 'activity 3 binded to skill 0'), array(2 => 'activity 2 binded to skill 1', 3 => 'activity 3 binded to skill 1')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1', 'my foo skill 2'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c3',
            0 => array('_bindedActivitiesLists' => array('activity 1 binded to skill 2', 2, 1)),
            1 => array('_bindedActivitiesLists' => array('activity 2 binded to skill 2', 2, 0)),
            '_skillsDescriptionsList' => 'my foo skill 3'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('c1', 'c2', 'c3'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array('activity 1 binded to skill 0', 4 => 'activity 3 binded to skill 0'), array(2 => 'activity 2 binded to skill 1', 3 => 'activity 3 binded to skill 1'), array(1 => 'activity 1 binded to skill 2', 0 => 'activity 2 binded to skill 2')), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('my foo skill 1', 'my foo skill 2', 'my foo skill 3'), $this->object->get_skillsDescriptionsList());
    }

    ////////////////////////////////////////////////////////////////////////////CRUD tests 

    public function testGetDefinedActivities() {
        $a = $this->object->getDefinedActivities();
        foreach ($a as $key => $val) {
            $this->assertGreaterThanOrEqual(0, $key);
            $this->assertStringMatchesFormat('%s', $val);
        }
    }

  
}
