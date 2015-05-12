<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-05-19 at 09:10:42.
 */
class MainSetupRouterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var MainSetupRouter
     */
    protected $object;
    
    private $_defaultRoutes = array(
	'/' => array( // Default controller
		'controller' => 'welcome',
                'action' => 'index'
	),
        '/license' => array(
		'controller' => 'license',
		'action' => 'index'
	),
	'/welcome/index' => array(
		'controller' => 'welcome',
		'action' => 'index'
	),
        '/admin/foo/bar' => array( 
		'controller' => 'admin',
		'action' => 'index'
	),
          'error404' => array(
                'controller' => 'error',
                'action' => 'error404'
          )
        );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new MainSetupRouter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function relativePathProvider(){
        return array( 
            array ('/sese/index.php/', 'welcome'),
            array ('/sese/index.php/license', 'license'),
            array ('/sese/index.php/welcome/index', 'welcome'),
            array ('/sese/index.php/admin/foo/bar', 'admin'),
            array ('/sese/index.php/nowhere', 'error'),
            );
    }
    
    
    /**
     * @dataProvider relativePathProvider
     * @param type $relUrl
     * @param type $ctrl
     */
    public function testAnalysePath($relUrl, $ctrl){
        $this->assertEquals($ctrl, $this->object->analysePath($relUrl, $this->_defaultRoutes));
    }

}