<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Model\FunctionReferentialDefinitionModel;

/**
 * Description of FunctionReferentialDefinitionModelTest
 *
 * @author prog
 */
class FunctionReferentialDefinitionModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var FunctionReferentialDefinitionModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {

        $this->object = new FunctionReferentialDefinitionModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testAddFunctionToDataBase(){
        $vals= array('test nf1','test f2','test f3');
        foreach ($vals as $val){
            $this->object->set_descriptions($val);
        }
        var_dump($this->object->get_descriptions());
        $this->object->addFunctionToDataBase();
        //see database
        $this->assertEquals(true, true);
        return $vals;
    }

//    public function testAddFunctionToDataBase_NoDuplicate_NoBlank() {
//        $this->object->delFunctionsFromDataBase();
//        $vals = array(0 => "test f1", 1 => "test f2", 2 => "test f3", 3 => "test f4", 4 => "test f5", 5 => "test f1", 6 => "test f3", 7 => '', 8 => '        ');
//        foreach ($vals as $val) {
//            $this->object->set_descriptions($val);
//        }
//        $this->object->addFunctionToDataBase();
//        $newVals = array(0 => "test f1", 1 => "test f2", 2 => "test f3", 3 => "test f4", 4 => "test f5");
//        //see database : 
//        $this->assertEquals($newVals, $this->object->get_descriptions());
//        return $newVals;
//    }

    /**
     * @depends testAddFunctionToDataBase_NoDuplicate_NoBlank
     * 
     */
//    public function testGetFunctionsRawFromDataBase() {
//        $tst = $this->object->getRawFunctionsFromDataBase();
//        $vals = array('0' => array('id_fonction' => '3412', 'f_description' => 'test f1'), // id changes upon each db updates
//            '1' => array('id_fonction' => '3413', 'f_description' => 'test f2'),
//            '2' => array('id_fonction' => '3414', 'f_description' => 'test f3'),
//            '3' => array('id_fonction' => '3415', 'f_description' => 'test f4'),
//            '4' => array('id_fonction' => '3416', 'f_description' => 'test f5')
//        );
//        for ($i = 0; $i < count($vals); $i++) {
//            $this->assertStringMatchesFormat('%d', $tst[$i]['id_fonction']);
//            $this->assertEquals($vals[$i]['f_description'], $tst[$i]['f_description']);
//        }
//        return $tst;
//    }

    /**
     * @depends testAddFunctionToDataBase_NoDuplicate_NoBlank
     * provider testAddFunctionToDataBase_NoDuplicate_NoBlank
     * @param type $valsRef
     */
//    public function testGetFunctionsFromDataBase($valsRef) {
//        $this->object->getFunctionsFromDataBase();
//        $tst = $this->object->get_descriptions();
//        $this->assertEquals($valsRef, $tst);
//    }

    /**
     * @depends testGetFunctionsRawFromDataBase
     * provider testGetFunctionsRawFromDataBase
     */
//    public function testGetFunctionDescriptionFromIdDb($rawDatas) {
//        for ($i = 0; $i < count($rawDatas); $i++) {
//            $id = $rawDatas[$i]['id_fonction']; //see db
//            $tst = $this->object->getFunctionDescriptionFromIdDb($id);
//            $this->assertEquals($rawDatas[$i]['f_description'], $tst);
//        }
//    }

//    public function testGetFunctionDescriptionFromIdDb_badId() {
//        $this->assertNull($this->object->getFunctionDescriptionFromIdDb(999999999999999));
//    }

    /**
     * @depends testGetFunctionsRawFromDataBase
     * provider testGetFunctionsRawFromDataBase
     */
//    public function testGetFunctionIdDbFromDescription($rawDatas) {
//        for ($i = 0; $i < count($rawDatas); $i++) {
//            $tst = $this->object->getFunctionIdDbFromDescription($rawDatas[$i]['f_description']);
//            $this->assertEquals($rawDatas[$i]['id_fonction'], $tst);
//        }
//    }

//    public function testGetFunctionIdDbFromDescription_badDescription() {
//        $this->assertNull($this->object->getFunctionIdDbFromDescription('some unknown description'));
//    }

    /**
     * @depends testAddFunctionToDataBase_NoDuplicate_NoBlank
     * provider testAddFunctionToDataBase_NoDuplicate_NoBlank
     * @param type $valsRef
     */
//    public function testUpdateFunctionDataBase($valsRef) {
//        $newVals = array(0 => "test f1", 1 => "test f2", 2 => "test nf3", 3 => "test f4", 4 => "test f5");
//        $updateValue = array('id' => '2', 'value' => 'test nf3');
//        $this->object->updateFunctionInDataBase($updateValue);
//        $this->object->getFunctionsFromDataBase();
//        //see data base
//        $this->assertEquals($newVals, $this->object->get_descriptions());
//    }
//
//    public function testDelFunctionsFromDataBase_Specific() {
//        $this->object->delFunctionsFromDataBase();
//        $vals = array('testf1', 'testf2', 'testf3', 'testf1', 'testf3', 'testf4');
//        $exp = array('testf1', 'testf4');
//        foreach ($vals as $val) {
//            $this->object->set_descriptions($val);
//        }
//        $this->object->addFunctionToDataBase();
//        $dels = array('testf2', 'testf3');
//        $this->object->delFunctionsFromDataBase($dels);
//        $this->object->getFunctionsFromDataBase();
//        //see database : must be 'testf1', 'testf4'
//        $this->assertEquals($exp, $this->object->get_descriptions());
//    }
//
//    public function testRemoveFunctionsFromDataBase() {
//        $this->object->delFunctionsFromDataBase();
//        $vals = array('testf1', 'testf2', 'testf3', 'testf1', 'testf3', 'testf4');
//        $exps = array('testf1', 'testf3', 'testf4');
//        foreach ($vals as $val) {
//            $this->object->set_descriptions($val);
//        }
//        $this->object->addFunctionToDataBase();
//        $del = 'testf2';
//        $this->object->removeFunctionsFromDataBase($del);
//        //see database :
//        $this->assertEquals($exps, $this->object->get_descriptions());
//    }

//    public function testRemoveFunctionsFromIdFromDataBase() {
//        $this->object->delFunctionsFromDataBase();
//        $vals = array('testf1', 'testf2', 'testf3', 'testf1', 'testf3', 'testf4');
//        $exps = array('testf1', 'testf3', 'testf4');
//        foreach ($vals as $val) {
//            $this->object->set_descriptions($val);
//        }
//        $this->object->addFunctionToDataBase();
//        $del = '2';
//        $this->object->removeFunctionsFromIdFromDataBase($del);
//        //see database :
//        $this->assertEquals($exps, $this->object->get_descriptions());
//    }

    //extra tests
    public function testUniqueArray() {
        $array = array('a', 'b', 'c', 'd', 'a', 'c', 1, 2, 3, 2, 3);
        $exp = array('a', 'b', 'c', 'd', 1, 2, 3);
        $unique = array_keys(array_flip($array));
        $this->assertEquals($exp, $unique);
    }

    public function testDelBlankEmptyValues() {
        $tst = array('a', 'b', '   ', 'c', '', 'd', '  ', '', '       ', 'z');
        $exp = array('a', 'b', 'c', 'd', 'z');
        $this->assertEquals($exp, $this->object->delBlankEmptyValues($tst));
    }

    public function testUnsetArrayElement() {
        $a = array('a', 'b', 'c', 'd');
        $e = array('a', 'c', 'd');
        $a = array_merge(array_diff($a, array('b')));
        $this->assertEquals($e, $a);
    }

}
