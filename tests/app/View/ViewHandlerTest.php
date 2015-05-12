<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewHandlerTest
 *
 * @author prog
 */
class ViewHandlerTest  extends PHPUnit_Framework_TestCase{
    
     /**
     * @var ViewHandler
     */
    protected $object;

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
    
    /**
     * 
     */
     public function testExtractArraysFromParams1(){
        $params  = array(
                            'header' => array('VERSION'=>123),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                'tab' => array('a'=>'1', 'b'=>'2')),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false' )
                        );
        $this->object = new ViewHandler('test', $params);
        $exp = array(array('a'=>'1', 'b'=>'2'));
        $this->assertEquals($exp, $this->object->extractArraysFromParams());
    }
    
    public function testExtractArraysFromParams2(){
        $params  = array(
                            'header' => array('VERSION'=>123, 'headerList'=>array('menu1', 'menu2')),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'tab' => array('a'=>'1', 'b'=>'2'), 'tab1' => array('c'=>'3', 'd'=>'4')
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false' )
                        );
        $this->object = new ViewHandler('test', $params);
        $exp = array(array('menu1', 'menu2'), array('a'=>'1', 'b'=>'2'), array('c'=>'3', 'd'=>'4'));
        $tst=$this->object->extractArraysFromParams();
        $this->assertEquals($exp, $tst);
    }
    
    public function testBuildReferenceArrayList(){
        $params  = array(
                            'header' => array('VERSION'=>123, 'headerList'=>array('menu1', 'menu2')),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'tab' => array('a'=>'1', 'b'=>'2'), 'tab1' => array('c'=>'3', 'd'=>'4')
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false', 'footerList'=>array('foot1', 'foot2') )
                        );
        $this->object = new ViewHandler('test', $params);
        $exp = array(   ViewHandler::ARRAY_LIST_NAME.'[0]'=>'headerList',
                        ViewHandler::ARRAY_LIST_NAME.'[1]'=>'tab',
                        ViewHandler::ARRAY_LIST_NAME.'[2]'=>'tab1',
                        ViewHandler::ARRAY_LIST_NAME.'[3]'=>'footerList'
            );
        $tst=$this->object->buildReferenceArrayList();
        var_dump($tst);
        $this->assertEquals($exp, $tst);
    }
    
    public function testStrReplaceTree(){
        $params  = array(
                            'header' => array('VERSION'=>123, 'headerList'=>array('menu1', 'menu2')),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'tab' => array('a'=>'1', 'b'=>'2'), 'another' => array('c'=>'3', 'd'=>'4')
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false' , 'footerList'=>array('foot1', 'foot2') )
                        );
        $exp  = array(
                            'header' => array('VERSION'=>123, 'headerList'=>array('menu1', 'menu2')),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            ViewHandler::ARRAY_LIST_NAME.'[1]' => array('a'=>'1', 'b'=>'2'), 'another' => array('c'=>'3', 'd'=>'4')
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false', 'footerList'=>array('foot1', 'foot2') )
                        );
        $this->object = new ViewHandler('test', $params);
        $tst=$this->object->replaceTree('tab', ViewHandler::ARRAY_LIST_NAME.'[1]', $params, true);
        $this->assertEquals($exp, $tst);
    }
    
    public function testStrReplaceTreeFailKeysNameSubset(){
        $params  = array(
                            'header' => array('VERSION'=>123),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'tab' => array('a'=>'1', 'b'=>'2'), 'tab1' => array('c'=>'3', 'd'=>'4') //subset key name 
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false' )
                        );
        $exp  = array(
                            'header' => array('VERSION'=>123),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'arr0' => array('a'=>'1', 'b'=>'2'), 'tab1' => array('c'=>'3', 'd'=>'4')
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false' )
                        );
        $this->object = new ViewHandler('test', $params);
        $tst=$this->object->replaceTree('tab', 'arr0', $params, true);
        $this->assertNotEquals($exp, $tst); //FAILS !!
    }
    
    
    public function testBindArrayNameForTemplate(){
        $params  = array(
                            'header' => array('VERSION'=>'123', 
                                                'headerList'=>array('menu1', 'menu2')
                                        ),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            'myList' => array('a'=>'1', 'b'=>'2'), 
                                            'anOtherList' => array('c'=>'3', 'd'=>'4')  
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false', 
                                                'footerList'=>array('foot1', 'foot2') 
                                        )
                        );
        
        $exp  = array(
                            'header' => array('VERSION'=>'123', 
                                                ViewHandler::ARRAY_LIST_NAME.'[0]'=>array('menu1', 'menu2'),
                                                'headerList' => ViewHandler::ARRAY_LIST_NAME.'[0]'
                                        ),
                            'body' => array('INDEX'=>'/', 'URI_LICENSE'=>'', 
                                            ViewHandler::ARRAY_LIST_NAME.'[1]' => array('a'=>'1', 'b'=>'2'), 
                                            ViewHandler::ARRAY_LIST_NAME.'[2]' => array('c'=>'3', 'd'=>'4'),
                                            'myList' => ViewHandler::ARRAY_LIST_NAME.'[1]',
                                            'anOtherList' => ViewHandler::ARRAY_LIST_NAME.'[2]'
                                        ),
                            'footer' => array('URI_COMPANY'=>  'mycompany', 'SHOW_MODAL' => 'false', 
                                            ViewHandler::ARRAY_LIST_NAME.'[3]'=>array('foot1', 'foot2'),
                                            'footerList' => ViewHandler::ARRAY_LIST_NAME.'[3]'
                                        )
                        );
        
        $this->object = new ViewHandler('test', $params);
        $tst = $this->object->bindArrayNameForTemplate($params);
        $this->assertEquals($exp, $tst);
    }
    
    public function testTab(){
        $a = array( 'a' => array( 'a1' => '1'),
                    'b' => array( 'b1 => 2')
        );
        $e = array( 'a' => array( 'a1' => '1', 'a2'=> '3'),
                    'b' => array( 'b1 => 2')
        );
        
        $a["a"]["a2"] = '3';
        $this->assertEquals($e,$a);
        
    }
    
    
}
