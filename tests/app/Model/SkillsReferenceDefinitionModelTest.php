<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Model\SkillsReferenceDefinitionModel;
use Model\ActivitiesReferenceDefinitionModel;


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
    
    //list for model views tests 
    private $activitiesList = array(0=>'activity 0 binded',1=>'activity 1 binded', 2=>'activity 2 binded', 3=>'activity 3 binded', 4=>'activity 4 binded');

    /**
     * @var ActivitiesReferenceDefinitionModel;
     */
    protected static $activitiesReferences;

    public static function setUpBeforeClass() {
        self::$activitiesReferences = new ActivitiesReferenceDefinitionModel();
    }

    public static function tearDownAfterClass() {
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
    
    /**
     * 
     */
    public function testSet_bindedActivitiesLists() {
        $this->object->set_activitiesList($this->activitiesList);
        
        $a1 = '1';$a1T = 'activity 1 binded';
        $a2 = '2';$a2T = 'activity 2 binded';
        $a3 = '3';$a3T = 'activity 3 binded';
        $exp1 = array(1=>array(1=>$a1T));
        $exp2 = array(1=>array(1=>$a1T, 2=>$a2T));
        $exp3 = array(1=>array(1=>$a1T, 2=>$a2T), 2=>array(1=>$a1T));
        $exp4 = array(1=>array(1=>$a1T, 2=>$a2T), 2=>array(1=>$a1T, 2=>$a2T));
        $exp5 = array(1=>array(1=>$a1T, 2=>$a2T), 2=>array(1=>$a1T, 2=>$a2T, 3=>$a3T));
        
        $this->object->set_bindedActivitiesLists($a1, 1);//new
        $this->assertEquals($exp1, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a2, 1);//add
        $this->assertEquals($exp2, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a1, 2);//new
        $this->assertEquals($exp3, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a2, 2);//add
        $this->assertEquals($exp4, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a3, 2);//add
        $this->assertEquals($exp5, $this->object->get_bindedActivitiesLists());
        $this->object->set_bindedActivitiesLists($a2, 2);//already binded
        $this->assertEquals($exp5, $this->object->get_bindedActivitiesLists());
    }


    /**
     * tests for setters of models
     */
    public function test_call_user_func_array_PHP() {
        $this->object->set_activitiesList($this->activitiesList);
        
        $this->object->set_skillsReferencesList('c1');
        $r = $this->object->get_skillsReferencesList(); //array('c1')
        call_user_func_array(array($this->object, 'set_skillsReferencesList'), array('c2'));
        $r = $this->object->get_skillsReferencesList(); //array('c1','c2');
        $this->assertEquals(array('new'=>'c2'), $r);
        $func = 'set_skillsReferencesList';
        $param = 'c3';
        call_user_func_array(array($this->object, $func), array($param));
        $r = $this->object->get_skillsReferencesList(); //array('c1','c2');
        $this->assertEquals(array('new'=> 'c3'), $r);
        $func = 'set_bindedActivitiesLists';
        $arrArgs = array('0', 0);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array($this->activitiesList[0])), $r);
        $arrArgs = array('1', 0);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array($this->activitiesList[0], $this->activitiesList[1])), $r);
        $arrArgs = array('0', 1);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array($this->activitiesList[0], $this->activitiesList[1]), array($this->activitiesList[0])), $r);
        $arrArgs = array('3', 1);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array($this->activitiesList[0], $this->activitiesList[1]), array($this->activitiesList[0],3=>$this->activitiesList[3])), $r);
        $arrArgs = array('2', 1);
        call_user_func_array(array($this->object, $func), $arrArgs);
        $r = $this->object->get_bindedActivitiesLists();
        $this->assertEquals(array(array($this->activitiesList[0], $this->activitiesList[1]), array($this->activitiesList[0],2=>$this->activitiesList[2],3=>$this->activitiesList[3])), $r);
    }

    //
    // view (form) to model setters tests
    //
    public function testSetClassVarsValues_multipleArgs() {
        $this->object->set_activitiesList($this->activitiesList);
        // filtered data model (form) from controller with id skill - see template
        $params = array(
            '_skillsReferencesList' => 'c1',
            1 => array('_bindedActivitiesLists' => array('0', 0)), //property_name => array(main_value, args...)
            '_skillsDescriptionsList' => 'my foo skill 1'
        ); // filtered datas model from controller
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('new'=>'c1'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array($this->activitiesList[0])), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('new'=>'my foo skill 1'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c2',
            1 => array('_bindedActivitiesLists' => array('1', 0)),
            '_skillsDescriptionsList' => 'my foo skill 2'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('new'=>'c2'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array($this->activitiesList[0], 1 => $this->activitiesList[1])), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('new'=> 'my foo skill 2'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c3',
            1 => array('_bindedActivitiesLists' => array('2', 1)),
            '_skillsDescriptionsList' => 'my foo skill 3'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('new'=> 'c3'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array($this->activitiesList[0], 1 => $this->activitiesList[1]), array( 2 => $this->activitiesList[2])), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('new'=> 'my foo skill 3'), $this->object->get_skillsDescriptionsList());
        $params = array(
            '_skillsReferencesList' => 'c4',
            1 => array('_bindedActivitiesLists' => array('2', 1)),
            2 => array('_bindedActivitiesLists' => array('3', 0)),
            '_skillsDescriptionsList' => 'my foo skill 4'
        );
        $this->object->setClassVarsValues($params);
        $this->assertEquals(array('new'=> 'c4'), $this->object->get_skillsReferencesList());
        $this->assertEquals(array(array($this->activitiesList[0], 1 => $this->activitiesList[1], 3 => $this->activitiesList[3]), array( 2 => $this->activitiesList[2])), $this->object->get_bindedActivitiesLists());
        $this->assertEquals(array('new'=> 'my foo skill 4'), $this->object->get_skillsDescriptionsList());
        
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
        $this->assertEquals(array('new'=>''),$this->object->get_skillsReferencesList());
        $this->assertEquals(array('new'=>''),$this->object->get_skillsDescriptionsList());
        $list=$this->object->get_bindedActivitiesLists();
        $activities = $list['new'];
        $this->assertEquals(reset($this->object->get_activitiesList()),reset($activities));
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
        $this->object->set_bindedActivitiesLists(end(array_keys($this->object->get_activitiesList())),'new');//id&activity, id skill
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
        $this->object->set_bindedActivitiesLists(end(array_keys($this->object->get_activitiesList())),'new' );//id&activity, id skill
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
        $this->object->getAll();
        //get skill id
        $t = array_flip($this->object->get_skillsReferencesList());
        $ks  =$t['C99'];
        //form bind first activity (example)  -- see setters
        $this->object->set_bindedActivitiesLists(reset(array_keys($this->object->get_activitiesList())),$ks );//id activity, id skill
        //test
        $t = array_flip($this->object->get_activitiesList());
        $ka = reset($t);//first activity key
        $this->object->bindActivityToSkill($ks);
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
        $ks  =$t['C99'];
        $t = array_flip($this->object->get_activitiesList());
        $ka = reset($t);//first activity key
        $this->object->freeBindedActivity($ks, $ka);//unbind
        $this->object->getAll();
        $bt = $this->object->get_bindedActivitiesLists();
        $at = $bt[$ks];
        $this->assertNotContains(reset($this->object->get_activitiesList()),$at);
    }

  
}
