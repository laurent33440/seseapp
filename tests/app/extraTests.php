<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of extraTests
 *
 * @author laurent
 */
class extraTests extends PHPUnit_Framework_TestCase {
     /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
    }
    
    //extra tests
    public function testUniqueArray() {
        $array = array('a', 'b', 'c', 'd', 'a', 'c', 1, 2, 3, 2, 3);
        $exp = array('a', 'b', 'c', 'd', 1, 2, 3);
        $unique = array_keys(array_flip($array));
        $this->assertEquals($exp, $unique);
    }
    
     /**
     * Erase empty and blank values from array - keep ordering key 
     * @param array $a : array to clean
     * @return array 
     */
    public function delBlankEmptyValues(array $a){
        $a = array_map('trim', $a); //suppress blanks at begining and at end of values in array
        return array_values(array_filter($a));
    }       

    public function testDelBlankEmptyValues() {
        $tst = array('a', 'b', '   ', 'c', '', 'd', '  ', '', '       ', 'z');
        $exp = array('a', 'b', 'c', 'd', 'z');
        $this->assertEquals($exp, $this->delBlankEmptyValues($tst));
    }

    public function testUnsetArrayElement() {
        $a = array('a', 'b', 'c', 'd');
        $e = array('a', 'c', 'd');
        $a = array_merge(array_diff($a, array('b')));
        $this->assertEquals($e, $a);
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
     * Check if keys in an associative array is include in another
     * @param type $tstArray : testing array's keys
     * @param type $refArray : keys references
     * @return boolean : true, all testing array keys are in array reference
     */
    public function isArrayInclude($tstArray,$refArray) {
        $tk = array_keys($tstArray);
        foreach($tk as $k) {
            if(is_numeric($k)){
                $t = $tstArray[$k];
                $kt = array_keys($t);
                $k = $kt[0];
            }
            if(!in_array($k, $refArray)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * @dataProvider isArrayIncludeProvider
     */
    public function testisArrayInclude(array $tst, array $ref, $result) {
        $this->assertEquals($result, $this->object->isArrayInclude($tst, $ref));
    }
    
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
