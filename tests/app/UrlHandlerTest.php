<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PathHandlerTest
 *
 * @author prog
 */
class UrlHandlerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var UrlHandler
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new UrlHandler;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function urlTestProvider(){
        return array(array('http://localhost/index.php/page1', true), 
                    array('noslash' , false), 
                    array('http://www.good.com/some/text/here/', true), 
                    array('http://localHost/sese/index.php/license', true),
                    array('====', false),
                    array('http://?<?php some strange code ?>' , false),
                    array(null , false)
                );
    }

    /**
     * 
     * @return array
     */
    public function pathProvider(){
        return array(array('http://localhost/index.php/page1', '/index.php/page1'), 
                    array('noslash' , null), 
                    array('http://www.good.com/some/text/here/', '/some/text/here/'), 
                    array('http://localHost/sese/index.php/license', '/sese/index.php/license'),
                    array('====', null),
                    array('<?php some strange code ?>' , null),
                    array(null , null),
                    array('http://localhost/index.php', '/index.php')
                );
    }
    
    /**
     * 
     * @return array
     */
    public function pathExistProvider(){
        return array(array('http://localhost/index.php/page1', true), 
                    array('noslash' , false), 
                    array('http://www.good.com/some/text/here/', true), 
                    array('http://localHost/sese/index.php/license', true),
                    array('====', false),
                    array('<?php some strange code ?>' , false),
                    array(null , false),
                    array('http://localhost/index.php', true)
                );
    }
    
    /**
     * @dataProvider urlTestProvider
     * @param type $url
     */
    public function testValideUrl($url, $expected){
        $this->assertEquals($expected, $this->object->isValideAbsoluteUrl($url));
//        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//        $this->assertTrue($this->object->isValideUrl($url));
        
    }
    
    /**
     * @dataProvider pathProvider
     * @param type $url
     * @param type $path
     */
    public function testGetPath($url, $path){
        $this->assertEquals($path, $this->object->getPath($url));
    }
    
    /**
     * @depends testGetPath
     * @dataProvider pathExistprovider
     * @param type $url
     * @param type $expected
     */
    public function testIsPathExist($url, $expected){
        
        $this->assertEquals($expected, $this->object->isPathExist($url));
    }

}
