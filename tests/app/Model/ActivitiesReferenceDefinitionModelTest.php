<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Model\ActivitiesReferenceDefinitionModel;
use Model\FunctionReferentialDefinitionModel;

/**
 * Description of ActivitiesReferenceDefinitionModelTest
 *
 * @author laurent
 */
class ActivitiesReferenceDefinitionModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ActivitiesReferenceDefinitionModel
     */
    protected $object;
    /**
     * @var FunctonReferentialDefinitionModel
     */
    protected $functionsModel;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new ActivitiesReferenceDefinitionModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testOrderingArray(){
        $functionList =array(20=>'f0', 21=>'f1', 22=>'f2',23=>'f3',24=>'f4');
        $functionDesc = 'f3';
        $kf = array_keys($functionList, $functionDesc, true);
        //remove
        $functionList = array_diff($functionList, array($functionDesc));
        //var_dump($functionList);
        //add
        $functionList = array($kf[0]=>$functionDesc)+$functionList;
        //array_unshift($functionList, $functionDesc);
        $this->assertEquals(array(23=>'f3', 20=>'f0', 21=>'f1', 22=>'f2',24=>'f4'), $functionList);
    }
    
    public function testGetDefinedFunctions() {
        $this->object->set_functionList($this->object->getDefinedFunctions(),0);
        $tst = $this->object->get_functionList();
        foreach ($tst as $list) {
            foreach ($list as $id=>$val){
                $this->assertGreaterThanOrEqual(0, $id);
                $this->assertStringMatchesFormat('%s', $val);
            }
        }
    }
    
    /**
     * @depends testGetDefinedFunctions
     */
    public function testgetReorderFunctionList() {
        $functionsModel = new FunctionReferentialDefinitionModel();
        $functionsModel->getAll();
        $f = $functionsModel->get_descriptionList();
        reset($f);
        $eltToTop = next($f);//second element
        $reorder = $this->object->getReorderFunctionList($eltToTop);
        $this->assertEquals($eltToTop, reset($reorder));
        $eltToTop = next($f);//
        $eltToTop = next($f);//fourth element
        $reorder = $this->object->getReorderFunctionList($eltToTop);
        $this->assertEquals($eltToTop, reset($reorder));
    }
    
    public function testaddBlank(){
        $this->object->resetModel();
        $this->object->addBlank();
        $tst = $this->object->get_functionList();
        //var_dump($tst);
        foreach ($tst as $list) {
            foreach ($list as $id=>$val){
                $this->assertGreaterThanOrEqual(0, $id);
                $this->assertStringMatchesFormat('%s', $val);
            }
        }
    }

    /**
     * 
     */
    public function testsetClassVarsValues() {
        //get a valid function
        $functionsModel = new FunctionReferentialDefinitionModel();
        $functionsModel->getAll();
        $f = $functionsModel->get_descriptionList();
        $formValFunc = reset(array_keys($f)).'#'.reset($f); //structure view
        $model = array(
                '_activityRefList' => array('A1','new'),
                '_functionList' => array($formValFunc,'new'),
                0 => array('_activityDescriptionList' => array('activité1','new'))
        );
        $subset_properties = array(
                    '_activityRefList' => array('A1',2), // activity ref and id
                    '_activityDescriptionList' => array('activité1',2) //activity description and id
            );
        $ko_properties = array(
                    '_activityRefList' => array('A1',1), // activity ref and id
                    '_functionList' => array($formValFunc,1), //here main value is formatted as : id_of_value#value. Second argument is id activity
                    '_activityDescriptionList' => array('activité1',1), //activity description and id
                    '_someWrongProperty' => 'foo'
            );
        $this->assertTrue($this->object->setClassVarsValues($model));
        $this->assertEquals(array('new'=>'A1'), $this->object->get_activityRefList());
        $tst = $this->object->get_functionList();
        foreach ($tst as $key=>$list) {
            $this->assertEquals('new',$key); // id Activity
            foreach ($list as $id=>$val){
                $this->assertGreaterThanOrEqual(0, $id);//id func
                $this->assertStringMatchesFormat('%s', $val);//func
            }
        }
        $this->assertEquals(array('new'=>'activité1'), $this->object->get_activityDescriptionList());
        $this->object->resetModel();
        $this->assertTrue($this->object->setClassVarsValues($subset_properties));
        $this->assertEquals(array(2=>'A1'), $this->object->get_activityRefList());
        $this->assertEquals(array(), $this->object->get_functionList());
        $this->assertEquals(array(2=>'activité1'), $this->object->get_activityDescriptionList());
        $this->object->resetModel();
        $this->assertFalse($this->object->setClassVarsValues($ko_properties));
    }
    
    public function testgetAll(){
        
    }
    
    /**
     * @depends testgetAll
     */
    public function testappend(){
        $this->object->getAll();
        //get a valid function
        $functionsModel = new FunctionReferentialDefinitionModel();
        $functionsModel->getAll();
        $f = $functionsModel->get_descriptionList();
        $formValFunc = reset(array_keys($f)).'#'.reset($f);
        $model = array(
                '_activityRefList' => array('A1','new'),
                '_functionList' => array($formValFunc,'new'),
                0 => array('_activityDescriptionList' => array('activité1','new'))
        );
        $this->object->setClassVarsValues($model);//append this values to model
        $this->object->append();//persistent
    }


}
