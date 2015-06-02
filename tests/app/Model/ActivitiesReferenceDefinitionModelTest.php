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

    public function testisArrayInclude() {
        $a = array('a' => 1, 'b' => 2, 'c' => 3);
        $al = array('a' => 1, 'c' => 3);
        $am = array('a' => 1, 'b' => 2, 'c' => 3, 'foo' => 'bar');
        $r = array('a', 'b', 'c');
        $this->assertTrue($this->object->isArrayInclude($a, $r));
        $this->assertTrue($this->object->isArrayInclude($al, $r));
        $this->assertFalse($this->object->isArrayInclude($am, $r));
    }

    /**
     * 
     */
    public function testsetClassVarsValues() {
        $full_properties = array(
                    0=>array('_activityRefList' => array('A1',1)), // activity ref and id
                    1=>array('_functionList' => array('10#f1',1)), //here main value is formatted as : id_of_value#value. Second argument is id activity
                    2=>array('_activityDescriptionList' => array('activité1',1)) //activity description and id
            );
        $subset_properties = array(
                    0=>array('_activityRefList' => array('A1',2)), // activity ref and id
                    2=>array('_activityDescriptionList' => array('activité1',2)) //activity description and id
            );
        $ko_properties = array(
                    0=>array('_activityRefList' => array('A1',1)), // activity ref and id
                    1=>array('_functionList' => array('10#f1',1)), //here main value is formatted as : id_of_value#value. Second argument is id activity
                    2=>array('_activityDescriptionList' => array('activité1',1)), //activity description and id
                    '_someWrongProperty' => 'foo'
            );
        $this->assertTrue($this->object->setClassVarsValues($full_properties));
        $this->assertEquals(array(1=>'A1'), $this->object->get_activityRefList());
        $tst = $this->object->get_functionList();
        foreach ($tst as $key=>$list) {
            $this->assertEquals(1,$key); // id Activity
            foreach ($list as $id=>$val){
                $this->assertGreaterThanOrEqual(0, $id);//id func
                $this->assertStringMatchesFormat('%s', $val);//func
            }
        }
        $this->assertEquals(array(1=>'activité1'), $this->object->get_activityDescriptionList());
        $this->object->resetModel();
        $this->assertTrue($this->object->setClassVarsValues($subset_properties));
        $this->assertEquals(array(2=>'A1'), $this->object->get_activityRefList());
        $this->assertEquals(array(), $this->object->get_functionList());
        $this->assertEquals(array(2=>'activité1'), $this->object->get_activityDescriptionList());
        $this->object->resetModel();
        $this->assertFalse($this->object->setClassVarsValues($ko_properties));
        $this->assertEquals(array(), $this->object->get_activityRefList());
        $this->assertEquals(array(), $this->object->get_functionList());
        $this->assertEquals(array(), $this->object->get_activityDescriptionList());
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
    
    public function testappend(){
        $model = array('_activityRefList' => 'A4',
                        '_functionList' => '15645#func8',
                        '_activityDescriptionList' => 'mon activité'
            );
        $this->object->setClassVarsValues($model);
        $this->object->append();
    }

//    public function testAddToModelDuplicate() {
//        $tst = array();
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $tst = $this->object->get_activitiesReferencesList();
//        $this->assertEquals(1, count($tst));
//        $this->assertEquals('A1-1 test', $tst[0]);
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $tst = $this->object->get_activitiesReferencesList();
//        $this->assertEquals(2, count($tst));
//        $this->assertEquals('A1-1 test' . ActivitiesReferenceDefinitionModel::ERR_DUPLICATE, $tst[1]);
//    }
//    public function testUpdateModelView() {
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_functionsList(array('Fonction 2', 'Fonction 1', 'Fonction 3', 'Fonction 4', 'Fonction 5'));
//        $this->object->set_functionsList(array('Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4', 'Fonction 5'));
//        $this->object->set_functionsList(array('Fonction 3', 'Fonction 1', 'Fonction 2', 'Fonction 4', 'Fonction 5'));
//        $this->object->set_functionsList('Fonction 4');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 4 ');
//        $this->object->updateModelView();
//        $exp = array(array('Fonction 2', 'Fonction 1', 'Fonction 3', 'Fonction 4', 'Fonction 5'),
//            array('Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4', 'Fonction 5'),
//            array('Fonction 3', 'Fonction 1', 'Fonction 2', 'Fonction 4', 'Fonction 5'),
//            array('Fonction 4', 'Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 5')
//        );
//        $this->assertEquals($exp, $this->object->get_functionsList());
//    }
//    public function testIsExistingBlankInArray(){
//        $a = array('k1'=>'one', 'k2'=>'   ','k3'=>'two    ', 'k4'=>'');
//        $b = array('k1'=>'one', 'k2'=>'bis   ','k3'=>'two    ', 'k4'=>' exist');
//        $this->assertTrue($this->object->isExistingBlankInArray($a));
//        $this->assertFalse($this->object->isExistingBlankInArray($b));
//    }
//    public function testAddActivityToDataBase() {
//        $this->object->set_activitiesReferencesList('A1-1 test');
////        $this->object->set_functionsList(array('Fonction 2', 'Fonction 1','Fonction 3','Fonction 4' )); //'Fonction 2' is the choice -- first element 
//        $this->object->set_functionsList('Fonction 2'); //'Fonction 2' is the choice 
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test -- ligne (n)');
//        $this->object->append();
//        //see data base
//        $this->assertTrue(true);
//    }
//
//    /**
//     * @depends testAddActivityToDataBase 
//     */
//    public function testUpdateActivityDescription() {
//        $this->object->getAll();
//        $this->assertEquals(1, $this->object->updateActivityDescription('activité mise à jour', 1)); //one update
//        $tst = $this->object->get_activitiesDescriptionsList();
//        $this->assertEquals('activité mise à jour', $tst[0]);
//        //test db
//        $this->object->getAll();
//        $tst = $this->object->get_activitiesDescriptionsList();
//        $this->assertEquals('activité mise à jour', $tst[0]);
//    }
//
//    /**
//     * @depends testAddActivityToDataBase 
//     */
//    public function testUpdateActivityReference() {
//        $this->object->getAll();
//        $this->assertEquals(1, $this->object->updateActivityReference('ref à jour', 1)); //one update
//        $tst = $this->object->get_activitiesReferencesList();
//        $this->assertEquals('ref à jour', $tst[0]);
//        //test db
//        $this->object->getAll();
//        $tst = $this->object->get_activitiesReferencesList();
//        $this->assertEquals('ref à jour', $tst[0]);
//    }

    /**
     * @depends testAddActivityToDataBase 
     */
//    public function testUpdateActivityFunction() {
//        $this->object->getAll();
//        $this->assertEquals(1, $this->object->updateActivityFunction('Fonction 5', 1)); //one update
//        $tst = $this->object->get_functionsList();
//        $this->assertEquals('Fonction 5', $tst[0]);
//        //test db
//        $this->object->getAll();
//        $tst = $this->object->get_functionsList();
//        $this->assertEquals(array('Fonction 5', 'Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4'), $tst[0]);
//    }
    // add blank activity
//    public function testAddActivityToDataBase_blank_activity(){ //musn't be added'
//        $this->object->set_activitiesReferencesList('    ');
//        $this->object->set_functionsList(' ');
//        $this->object->set_activitiesDescriptionsList('');
//        $this->object->addActivityToDataBase();
//        //see data base
//        $this->assertTrue(true);
//    }

    /**
     * @depends testAddActivityToDataBase 
     */
//    public function testGetRawActivitiesFromDataBse(){ -OBSOLETTE 
//        $ref= array(   '0' => array(   'id_activite' => '1', // id changes upon each db updates
//                                        'act_ref_activite' => 'A1-1 test', 
//                                        'act_intitule_activite' => null, 
//                                        'act_descriptif_activite' => 'Mon activit&eacute; test test test -- ligne (n)', 
//                                        'act_est_realisee' => '0', 
//                                        'id_referentiel_de_formation' => null,
//                                        'id_fonction' =>3), // id changes upon each db updates
//                );
//        $activities=  $this->object->getRawActivitiesFromDataBase();
//        $this->assertStringMatchesFormat('%d', $activities[0]['id_activite']);
//        $this->assertEquals($ref[0]['act_ref_activite'], $activities[0]['act_ref_activite']);
//        $this->assertEquals($ref[0]['act_intitule_activite'], $activities[0]['act_intitule_activite']);
//        $this->assertEquals($ref[0]['act_descriptif_activite'], $activities[0]['act_descriptif_activite']);
//        $this->assertEquals($ref[0]['act_est_realisee'], $activities[0]['act_est_realisee']);
//        $this->assertEquals($ref[0]['id_referentiel_de_formation'], $activities[0]['id_referentiel_de_formation']);
//        $this->assertStringMatchesFormat('%d', $activities[0]['id_fonction']);
//    }

    /**
     * @depends testAddActivityToDataBase
     */
//    public function testDelActivitiesFromDataBase_oneActivity() {
//        //get id
//        $activities = $rows = $this->object->getDataBaseHandler()->dbQS('Activite');
//        $id = $activities[0]['id_activite'];
//        //echo __METHOD__.' -> id to delete : '.$id;
//        // see db
//        $this->assertTrue(true);
//        $this->object->delActivitiesFromDataBase(array($id));
//        //see data base
//        $this->assertTrue(true);
//    }

    /**
     * @depends  testAddActivityToDataBase
     */
//    public function testAddActivitesNoDuplicate(){
//        $this->object->set_activitiesReferencesList('A1-1 test');
////        $this->object->set_functionsList(array('Fonction 2', 'Fonction 1','Fonction 3','Fonction 4' )); //'Fonction 2' is the choice -- first element 
//        $this->object->set_functionsList('Fonction 2'); //'Fonction 2' is the choice 
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test -- ligne (n)');
//        $this->object->addActivityToDataBase();
//        //duplicate 
//        $this->object->set_activitiesReferencesList('A1-1 test'); 
//        $this->object->set_functionsList('Fonction 2'); //'Fonction 2' is the choice 
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test -- ligne (n)');
//        $this->assertEquals(-1,$this->object->addActivityToDataBase()); //duplicate code
//        //see data base
//        $this->assertTrue(true);
//    }


    /**
     * @depends testAddActivityToDataBase
     */
//    public function testAddActivityToDataBase_multiple(){
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_functionsList(array('Fonction 3')); 
//        $this->object->set_functionsList(array('Fonction 2'));
//        $this->object->set_functionsList(array('Fonction 1')); 
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $this->assertTrue($this->object->addAllActivitiesToDataBase());
//        //see data base
//        $this->assertTrue(true);
//    }
//    public function testNormalizeReferenceInModel(){
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_functionsList(array('Fonction 3')); 
//        $this->object->set_functionsList(array('Fonction 2'));
//        $this->object->set_functionsList(array('Fonction 1'));
//        $this->object->set_functionsList(array('Fonction 4'));
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 4 !!! reference existante !!! ');
//        $this->assertEquals('A1-2 test',  $this->object->NormalizeReferenceInModel());
//        $expRef=array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $this->assertEquals($expRef, $this->object->get_activitiesReferencesList());
//        $expFunc=array( array('Fonction 3'),
//                        array('Fonction 2'), 
//                        array('Fonction 1') 
//            );
//        $this->assertEquals($expFunc,  $this->object->get_functionsList());
//        $expDesc = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $this->assertEquals($expDesc,  $this->object->get_activitiesDescriptionsList());
//        $this->object->resetModel();
//        // 2nd set
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_functionsList(array('Fonction 3')); 
//        $this->object->set_functionsList(array('Fonction 2'));
//        $this->object->set_functionsList(array('Fonction 4'));
//        $this->object->set_functionsList(array('Fonction 1'));
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 4 !!! reference existante !!! ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $this->assertEquals('A1-2 test',  $this->object->NormalizeReferenceInModel());
//        $expRef=array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $this->assertEquals($expRef, $this->object->get_activitiesReferencesList());
//        $expFunc=array( array('Fonction 3'),
//                        array('Fonction 2'), 
//                        array('Fonction 1') 
//            );
//        $this->assertEquals($expFunc,  $this->object->get_functionsList());
//        $expDesc = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $this->assertEquals($expDesc,  $this->object->get_activitiesDescriptionsList());
//    }



    /**
     * @depends testAddActivityToDataBase_multiple
     */
//    public function testAddActivityToDataBase_multiple_noDuplicate(){
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_functionsList(array('Fonction 3')); 
//        $this->object->set_functionsList(array('Fonction 2'));
//        $this->object->set_functionsList(array('Fonction 1'));
//        $this->object->set_functionsList(array('Fonction 4'));
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 4 !!! reference existante !!! ');
//        $duplicateRef = $this->object->addAllActivitiesToDataBase(); //no add to db
//        $this->assertEquals('A1-2 test',$duplicateRef);
//        $expRef=array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $this->assertEquals($expRef, $this->object->get_activitiesReferencesList());
//        $expFunc=array( array('Fonction 3'),
//                        array('Fonction 2'), 
//                        array('Fonction 1') 
//            );
//        $this->assertEquals($expFunc,  $this->object->get_functionsList());
//        $expDesc = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $this->assertEquals($expDesc,  $this->object->get_activitiesDescriptionsList());
//        $this->object->delActivitiesFromDataBase();
//    }

    /**
     * @depends testAddActivityToDataBase_multiple
     */
//    public function testAddActivityToDataBase_multiple_noDuplicate2(){
//        $this->object->set_activitiesReferencesList('A1-1 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-2 test');
//        $this->object->set_activitiesReferencesList('A1-3 test');
//        $this->object->set_functionsList(array('Fonction 3')); 
//        $this->object->set_functionsList(array('Fonction 2'));
//        $this->object->set_functionsList(array('Fonction 4'));
//        $this->object->set_functionsList(array('Fonction 1'));
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 1 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 2 ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 4 !!! reference existante !!! ');
//        $this->object->set_activitiesDescriptionsList('Mon activit&eacute; test test test 3 ');
//        $duplicateRef = $this->object->addAllActivitiesToDataBase(); //no add to db
//        $this->assertEquals('A1-2 test',$duplicateRef);
//        $expRef=array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $this->assertEquals($expRef, $this->object->get_activitiesReferencesList());
//        $expFunc=array( array('Fonction 3'),
//                        array('Fonction 2'), 
//                        array('Fonction 1') 
//            );
//        $this->assertEquals($expFunc,  $this->object->get_functionsList());
//        $expDesc = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $this->assertEquals($expDesc,  $this->object->get_activitiesDescriptionsList());
//    }

    /**
     * @depends testAddActivityToDataBase
     */
//    public function testAddActivityToDataBase_multiple() {
//        $refs = array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $funcs = array('Fonction 3', 'Fonction 2', 'Fonction 1');
//        $descs = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $functionModel = new FunctionReferentialDefinitionModel();
//        for ($i = 0; $i < count($refs); $i++) {
//            $func = $funcs[$i];
//            $functionId = $functionModel->getFunctionIdDbFromDescription($func);
//            $id_activity = $this->object->getDataBaseHandler()->dbQI(array('act_ref_activite' => $refs[$i],
//                'act_descriptif_activite' => $descs[$i],
//                'act_est_realisee' => false,
//                'id_fonction' => $functionId
//                    ), 'Activite');
//        }
//        //see db
//        $this->assertTrue(true);
//    }

    /**
     * @depends testAddActivityToDataBase_multiple
     */
//    public function testGetAllActivitesToModel() {
//        $expRef = array('A1-1 test', 'A1-2 test', 'A1-3 test');
//        $expFunc = array(array('Fonction 3', 'Fonction 1', 'Fonction 2', 'Fonction 4', 'Fonction 5'),
//            array('Fonction 2', 'Fonction 1', 'Fonction 3', 'Fonction 4', 'Fonction 5'),
//            array('Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4', 'Fonction 5')
//        );
//        $expDesc = array('Mon activit&eacute; test test test 1 ', 'Mon activit&eacute; test test test 2 ', 'Mon activit&eacute; test test test 3 ');
//        $this->assertEquals(array('Fonction 1', 'Fonction 2', 'Fonction 3', 'Fonction 4', 'Fonction 5'), $this->object->getDefinedFunctions());
//        $this->object->getAll();
//        $refs = $this->object->get_activitiesReferencesList();
//        $funcs = $this->object->get_functionsList();
//        $descs = $this->object->get_activitiesDescriptionsList();
//        $this->assertEquals($expRef, $refs);
//        $this->assertEquals($expFunc, $funcs);
//        $this->assertEquals($expDesc, $descs);
//    }

    /**
     * @depends testGetAllActivitesToModel
     */
//    public function testGetActivityIdFromActivityReference() {
//        $this->assertStringMatchesFormat('%d', $this->object->getActivityIdFromActivityReference('A1-1 test'));
//    }
//
//    /**
//     * @depends testGetAllActivitesToModel
//     */
//    public function testGetActivityIdFromActivityDescription() {
//        $this->assertStringMatchesFormat('%d', $this->object->getActivityIdFromActivityDescription('Mon activit&eacute; test test test 2 '));
//    }
//
//    /**
//     * @depends testGetAllActivitesToModel
//     */
//    public function testGetClassVarsValues() {
//        $this->object->addBlank();
//        //var_dump($this->object->getClassVarsValues());
//        //must be array of members name and values
//        //function list add a list of all functions descriptions avalaible
//    }
//
//    /**
//     * @depends testAddActivityToDataBase_multiple
//     */
//    public function testRemoveActivityFromIdFromDataBase() {
//        $this->object->getAll();
//        $this->object->removeActivityFromIdFromDataBase(2);
//        //see db
//        $this->assertTrue(true);
//    }
//
//    /**
//     * @depends testAddActivityToDataBase_multiple
//     * @depends testGetAllActivitesToModel
//     * @depends testRemoveActivityFromIdFromDataBase
//     */
//    public function testDelActivitiesFromDataBase_all() {
//        //$this->markTestSkipped('NOT YET');
//        $this->object->delActivitiesFromDataBase();
//        //see data base
//        $this->assertTrue(true);
//    }
//    

    /////////////////////////////////////////////////////////////////////////////extra tests
    public function testreorderFunctionList() {
        $tst = array('testf1', 'testf2', 'testf3', 'testf4', 'testf5');
        $exp = array('testf3', 'testf1', 'testf2', 'testf4', 'testf5');
        //testf3 choosen
        $eltToTop = 'testf3';
        //remove
        $tst = array_diff($tst, array($eltToTop));
        //add
        array_unshift($tst, $eltToTop);
        $this->assertEquals($exp, $tst);
    }

    public function testuniqueInArray() {
        //$a = array('a','b','b','c','d','e','a','d');
        $a = array('a', 'b', 'b', 'c');
//        $b_a=array('aa','bb','cc','dd','ee','aa','dd'); //linked list whith $a
        $b_a = array('aa', 'bb', 'bb2', 'cc'); //linked list whith $a
        $unique = array_keys(array_flip($a));
        $this->assertEquals(array('a', 'b', 'c'), $unique);
        $existDiff = (count($a) - count($unique)) != 0;
        $this->assertTrue($existDiff);
//        if($existDiff){
//            $elt=array_slice($a, -(count($a)-count($unique)),1);
//            $this->assertEquals(array('c'),$elt);
//        }
        $d = null;
        for ($h = 0; $h < count($a) && $d === null; $h++) {
            for ($i = 0; $i < count($a); $i++) {
                if ($a[$h] === $a[$i] && ($h != $i)) {
                    $d = $i;
                    break;
                }
            }
        }
        //duplicate name
        $this->assertEquals('b', $a[$d]);
        //remove first occurence of duplicate value in linked list
        unset($b_a[$d]);
        $arr = array_values($b_a);
        //$this->assertEquals (array('aa','bb','cc','dd','ee','dd'),$arr);
        $this->assertEquals(array('aa', 'bb', 'cc'), $arr);
    }

    public function testnormalizeLists() {
        $a = array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e', 5 => 'a', 6 => 'd');
        $b_a = array(0 => 'aa', 1 => 'bb', 2 => 'cc', 3 => 'dd', 4 => 'ee', 5 => 'aa', 6 => 'dd'); //let say it's linked list whith $a
        $d = null;
        for ($h = 0; $h < count($a) && $d === null; $h++) {
            for ($i = 0; $i < count($a); $i++) {
                if ($a[$h] === $a[$i] && ($h != $i)) {
                    $d = $i;
                    break;
                }
            }
        }
        //$d must be 5
        $this->assertEquals(5, $d);
        //remove first occurence of duplicate value in linked list, thus 5=>'aa'
        unset($b_a[$d]);
        $arr = array_values($b_a);
        $this->assertEquals(array('aa', 'bb', 'cc', 'dd', 'ee', 'dd'), $arr);
    }

}
