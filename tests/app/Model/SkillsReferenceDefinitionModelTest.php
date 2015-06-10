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
    
    //////////////////////// model view tests

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

    public function testgetDefinedActivities() {
        $a = $this->object->getDefinedActivities();
        foreach ($a as $key => $val) {
            $this->assertGreaterThanOrEqual(0, $key);
            $this->assertStringMatchesFormat('%s', $val);
        }
    }
    
    /**
     * @depends testgetDefinedActivities
     */
    public function testaddBlank(){
        $this->object->addBlank();
        $this->assertEquals(array(''),$this->object->get_skillsReferencesList());
        $this->assertEquals(array(''),$this->object->get_skillsDescriptionsList());
        $list = end($this->object->get_bindedActivitiesLists());
        $this->assertStringMatchesFormat('%s',reset($list));
    }
    
    /**
     * @depends testgetDefinedActivities
     */
    public function testgetAll(){
        $this->object->getAll();
        $a1 = $this->object->get_skillsReferencesList();
        foreach ($a1 as $key => $val) {
            $this->assertGreaterThanOrEqual(0, $key);
            $this->assertStringMatchesFormat('%s', $val);
        }
        $a2 = $this->object->get_skillsDescriptionsList();
        foreach ($a2 as $key => $val) {
            $this->assertGreaterThanOrEqual(0, $key);
            $this->assertStringMatchesFormat('%s', $val);
        }
        $a3 = $this->object->get_bindedActivitiesLists();
        foreach ($a3 as $keySkill=>$arr) {
            $this->assertArrayHasKey($keySkill, $a1);
            $this->assertArrayHasKey($keySkill, $a2);
            foreach ($arr as $key => $val) {
                $this->assertGreaterThanOrEqual(0, $key);
                $this->assertStringMatchesFormat('%s', $val);
            }
        }
    }

    /**
     * @depends testgetAll
     */
    public function testappend(){
        $this->object->set_skillsReferencesList('C99');
        $this->object->set_skillsDescriptionsList('new skill');
        //bind last(for example) activity to new skill
        $this->object->set_bindedActivitiesLists(end($this->object->get_activitiesList()),null, end(array_keys($this->object->get_activitiesList())));//activity, id skill=null, id activity
        $this->object->append();
        $this->object->getAll();
        $this->assertEquals('C99', end($this->object->get_skillsReferencesList()));
        $this->assertEquals('new skill', end($this->object->get_skillsDescriptionsList()));
        $ba_t =$this->object->get_bindedActivitiesLists();
        $t = array_flip($this->object->get_skillsReferencesList());
        $k  =$t['C99'];
        $la_t = $ba_t[$k];
        $this->assertEquals(1, count($la_t));
        $this->assertEquals(end($this->object->get_activitiesList()), $la_t[end(array_keys($this->object->get_activitiesList()))]);
    }
    
    /**
     * @depends testappend
     * @depends testgetAll
     */
    public function testdeleteFromId(){
        $this->object->set_skillsReferencesList('C100');
        $this->object->set_skillsDescriptionsList('new skill to delete');
        //bind last(for example) activity to new skill
        $this->object->set_bindedActivitiesLists(end($this->object->get_activitiesList()),null, end(array_keys($this->object->get_activitiesList())));//activity, id skill=null, id activity
        $this->object->append();
        $this->object->getAll();
        $t = array_flip($this->object->get_skillsReferencesList());
        $k  =$t['C100'];
        $this->assertTrue($this->object->deleteFromId($k));
        $this->assertNotEquals('C100', end($this->object->get_skillsReferencesList()));
        $this->assertNotEquals('new skill to delete', end($this->object->get_skillsDescriptionsList()));
        $this->assertFalse($this->object->deleteFromId(100000));//unknown id 
    }
    
    /**
     * @depends testappend
     * @depends testgetAll
     */
    public function testbindActivityToSkill(){
        $this->object->set_skillsReferencesList('C200_binding');
        $this->object->set_skillsDescriptionsList('new skill to bind');
        //bind last activity
        $this->object->set_bindedActivitiesLists(end($this->object->get_activitiesList()),null, end(array_keys($this->object->get_activitiesList())));//activity, id skill=null, id activity
        $this->object->append();
        $this->object->getAll();
        $t = array_flip($this->object->get_skillsReferencesList());
        $ks  =$t['C200_binding'];
        $t = array_flip($this->object->get_activitiesList());
        $ka = reset($t);//first activity key
        $this->object->bindActivityToSkill($ks, $ka);//bind first activity
        $this->object->getAll();
        $bt = $this->object->get_bindedActivitiesLists();
        $at = $bt[$ks];
        $this->assertEquals(reset($this->object->get_activitiesList()),$at[$ka]);
        
    }
    
    /**
     * @depends testappend
     * @depends testgetAll
     * @depends testbindActivityToSkill
     */
    public function testfreeBindedActivity(){
        $this->object->getAll();
        $t = array_flip($this->object->get_skillsReferencesList());
        $ks  =$t['C200_binding'];
        $t = array_flip($this->object->get_activitiesList());
        $ka = reset($t);//first activity key
        $this->object->freeBindedActivity($ks, $ka);//unbind
        $this->object->getAll();
        $bt = $this->object->get_bindedActivitiesLists();
        $at = $bt[$ks];
        $this->assertNotContains(reset($this->object->get_activitiesList()),$at);
    }

  
}
