<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-03-25 at 09:50:11.
 */
class ControllerStateStubTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ControllerStateStub
     */
    protected $object;
    
    /**
     * @var Request 
     */
    protected $_request;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->_request = Request::createFromGlobals();
        $this->object = new ControllerStateStub($this->_request, $action=null);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testexplode(){
        $v1 = 'a##b';
        $p= explode('##', $v1);
        $this->assertEquals('a', $p[0]);
        $this->assertEquals('b', $p[1]);
        $v1 = 'a##b#c#d';
        $p= explode('##', $v1);
        $this->assertEquals('a', $p[0]);
        $this->assertEquals('b#c#d', $p[1]);
        $p1= explode('#', $p[1]);
        $this->assertEquals('b', $p1[0]);
        $this->assertEquals('c', $p1[1]);
        $this->assertEquals('d', $p1[2]);
        $v1 = 'x';
        $p1= explode('#', $v1);
        $this->assertEquals(1, count($p1));
    }


    /**
     * paramX : vectors from datas posted
     * model : attributes's names of model
     * expX : vectors expected
     * @return vactors of tests
     */
    public function paramsProvider(){
        $model = array('_var1','_var2','_var3');
        //0
        $param1 = array( 
                '_var1' => 'c100',
                '_var2' => 'Savoir souder',
                '_var3' => 'lundi',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp1 = array(
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    '_var3' => 'lundi',
            );
            
        //1
        $param12 = array( 
                '_var1' => 'c100',
                '_var3' => 'lundi',
                'ButtonSubmitAddSkill' => 0    
                );
        $exp12 = array(
                    '_var1' => 'c100',
                    '_var3' => 'lundi',
                );
        //2
        $param2 = array( 
                '_var1#0' => 'c100',
                '_var2#1' => 'Savoir souder',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp2 = array(  '_var1'=>array('c100',0),
                        '_var2'=>array('Savoir souder',1)
            );
        //3
        $param20 = array( 
                '_var1#a' => 'c100',
                '_var2#b' => 'Savoir souder',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp20 = array(  '_var1'=>array('c100','a'),
                        '_var2'=>array('Savoir souder','b')
            );
        //4
        $param21 = array( 
                '_var1#0#1' => 'c100',
                '_var2#1#2' => 'Savoir souder',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp21 = array(  '_var1'=>array('c100',0,1),
                        '_var2'=>array('Savoir souder',1,2)
            );
        //5
        $param22 = array( 
                '_var1#0#1' => 'c100',
                '_var2#1' => 'Savoir souder',
                '_var3#1#2#3' => 'lundi',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp22 = array(  '_var1'=>array('c100',0,1),
                        '_var2'=>array('Savoir souder',1),
                        '_var3'=>array('lundi',1,2,3)
            );
        //6
        $param23 = array( 
                '_var1#0#1' => 'c100',
                '_var1#1#0' => 'Savoir souder',
                '_var1#1#2' => 'lundi',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp23 = array(  '_var1'=>array('c100',0,1),
                        '_var1'=>array('Savoir souder',0),
                        '_var1'=>array('lundi',1,2)
            );
                  
        //7
        $param3 = array( 
                '_var1##0' => 'c100',
                '_var2##0' => 'Savoir souder',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp3 = array('0'=>array( 
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    )
                );
        //8
        $param30 = array( 
                '_var1##a' => 'c100',
                '_var2##a' => 'Savoir souder',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp30 = array('a'=>array( 
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    )
                );
        //9
        $param31 = array( 
                '_var1##0' => 'c100',
                '_var2##0' => 'Savoir souder',
                '_var3' => 'simple',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp31 = array('0'=>array( 
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    ),
                    '_var3' => 'simple',
                );
        //10
        $param4 = array( 
                '_var1##0' => 'c100',
                '_var2##0' => 'Savoir souder',
                '_var3##0#0#1' => 'Mon activité test test test 2', 
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp4 = array('0'=>array( 
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    0=>array('_var3' => array('Mon activité test test test 2',0,1))
                    )
                );
        //11
        $param41 = array( 
                '_var1##0' => 'c100',
                '_var2' => 'Savoir souder',
                '_var3##0#0#1' => 'Mon activité test test test 2', 
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp41 = array('0'=>array( 
                    '_var1' => 'c100',
                    0=>array('_var3' => array('Mon activité test test test 2',0,1))
                    ),
                    '_var2' => 'Savoir souder'
                );
        //12
        $param42 = array( 
                '_var1##aa' => 'c100',
                '_var2##aa' => 'Savoir souder',
                '_var3##bb#1' => 'Mon activité test test test 2', 
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp42 = array('aa'=>array( 
                            '_var1' => 'c100',
                            '_var2' => 'Savoir souder',),
                        'bb'=>array(0=>array('_var3' => array('Mon activité test test test 2',1)))
                    
                );
        //13
        $param43 = array( 
                '_var1##aa' => 'c100',
                '_var1##aa' => 'Savoir souder',//doublons : valeur retenue
                '_var3##bb#1' => 'Mon activité test test test 2', 
                '_var3##bb#2' => 'Mon activité test test test 3', 
                '_var3##bb#2' => 'Mon activité test test test 4', //doublons overwrite
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp43 = array('aa'=>array( 
                            '_var1' => 'Savoir souder',
                            ),
                       'bb'=>array( 0=>array('_var3' => array('Mon activité test test test 2',1)),
                                    1=>array('_var3' => array('Mon activité test test test 4',2)),
                        )
                );
        //14
        $param5 = array( 
                '_var1##0' => 'c100',
                '_var2##0' => 'Savoir souder',
                '_var3##0#0#0' => 'Mon activité test test test 1',
                '_var1##1' => 'c200',
                '_var2##1' => 'Savoir écrire',
                '_var3##1#1#1' => 'Mon activité test test test 2',
                'ButtonSubmitAddSkill' => 1
                );
        $exp5 = array('0'=>array( 
                    '_var1' => 'c100',
                    '_var2' => 'Savoir souder',
                    0 => array('_var3' =>array('Mon activité test test test 1',0,0)),
                    ),
                    '1'=>array( 
                        '_var1' => 'c200',
                        '_var2' => 'Savoir écrire',
                        0 => array('_var3' =>array('Mon activité test test test 2',1,1)),
                    ),
                );
        //15
        $param51 = array( 
                '_var1##0#1' => 'c100',
                '_var2##0#1#2' => 'Savoir souder',
                '_var3##0#1#2#3' => 'Mon activité test test test 1',
                '_var1##1' => 'c200',
                '_var2##1' => 'Savoir écrire',
                '_var3##1#1#1' => 'Mon activité test test test 2',
                'ButtonSubmitAddSkill' => 1
                );
        $exp51 = array('0'=>array( 
                            0 => array('_var1' =>array('c100',1)),
                            1 => array('_var2' =>array('Savoir souder',1,2)),
                            2 => array('_var3' =>array('Mon activité test test test 1',1,2,3)),
                    ),
                        '1'=>array( 
                            '_var1' => 'c200',
                            '_var2' => 'Savoir écrire',
                            0 => array('_var3' =>array('Mon activité test test test 2',1,1)),
                    ),
                );
        //16
        $param52 = array( 
                '_var1##0#1' => 'c100',
                '_var2##0#1#2' => 'Savoir souder',
                '_var3##0#1#2#3' => 'Mon activité test test test 1',
                '_var2##0#2#3' => 'Savoir cabler', // WILL BE ADDED IN PARAMETERS SETTERS
                '_var1##1' => 'c200',
                '_var2##1' => 'Savoir écrire',
                '_var3##1#1#1' => 'Mon activité test test test 2',
                //'_var1##1' => 'c300',  //!!! WARNING OVERWRITE PREVIOUS SET !!! 
                'ButtonSubmitAddSkill' => 1
                );
        $exp52 = array('0'=>array( 
                            0 => array('_var1' =>array('c100',1)),
                            1 => array('_var2' =>array('Savoir souder',1,2)),
                            2 => array('_var3' =>array('Mon activité test test test 1',1,2,3)),
                            3 => array('_var2' =>array('Savoir cabler',2,3)),
                    ),
                        '1'=>array( 
                            '_var1' => 'c200', // '_var1' => 'c300', SEE WARNING IN VECTOR TEST
                            '_var2' => 'Savoir écrire',
                            0 => array('_var3' =>array('Mon activité test test test 2',1,1)),
                            
                    ),
                );
        //17
        $param10 = array( 
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp10 = array();

        //18 -bug with value 0
        $param90 = array( 
                '_var1' => 'c100',
                '_var2' => 0,
                '_var3' => 'lundi',
                'ButtonSubmitAddSkill' => 0    
            
                );
        $exp90 = array(
                    '_var1' => 'c100',
                    '_var2' => 0,
                    '_var3' => 'lundi',
            );
        
        
        
        return array(
            array($param1,$model, $exp1, 'simple var -> value'),
            array($param12,$model, $exp12, 'simple var -> value incomplete '),
            array($param2,$model, $exp2, 'simple indexé var->value'),
            array($param20,$model, $exp20, 'simple indexé var->value'),
            array($param21,$model, $exp21, 'simple indexé var->value mixe '),
            array($param22,$model, $exp22, 'simple indexé var->value mixe '),
            array($param23,$model, $exp23, 'simple indexé var->value mixe '),
            array($param3,$model, $exp3, 'complex indexé var->value'),
            array($param30,$model, $exp30, 'complex indexé var->value'),
            array($param31,$model, $exp31, 'complex indexé var->value mixe'),
            array($param4,$model, $exp4, 'complex multi indexé var->value'),
            array($param41,$model, $exp41, 'complex multi indexé var->value'),
            array($param42,$model, $exp42, 'complex multi indexé var->value'),
            array($param43,$model, $exp43, 'complex multi indexé var->value'),
            array($param5,$model, $exp5, 'complex multi indexé var->value'),
            array($param51,$model, $exp51, 'complex multi indexé var->value'),
            array($param52,$model, $exp52, 'complex multi indexé var->value'),
            array($param10,$model, $exp10, 'aucun'),
            array($param90,$model, $exp90, 'bug 0'),
        );
    }

     /**
     * @dataProvider paramsProvider
     */
    public function testfindAllParamsFromForm(array $params, array $models, array $exps, $notes){
        $r= $this->object->findAllParamsFromForm($params, $models);
        //var_dump($r);
        $this->assertEquals($exps,$r, $notes);
        
    }
    
    
    public function testFooterParametersIncludeExclude(){
        $exp_default = array('INDEX'=> $this->object->getIndex(),'URI_COMPANY'=> \Bootstrap::COMPANY_URI, 'SHOW_MODAL' => 'false' );
        //prepare footer view to template - generic method
        $this->object->buildFooterView();
        $v = $this->object->getModelView();
        $this->assertEquals($exp_default,  $v['footer']);
        //the controller had create a set of footer parameters -this parameters are priviledged
        $v = $this->object->getModelView(); 
        $v['footer'] = array('INDEX'=>'/here.com', 'SHOW_MODAL'=>true, 'PARAM' => 'some value');
        $this->object->setModelView($v);
        //prepare footer view to template - generic method
        $this->object->buildFooterView();
        $exp = array('INDEX'=>'/here.com', 'URI_COMPANY'=> \Bootstrap::COMPANY_URI, 'SHOW_MODAL'=>true, 'PARAM' => 'some value');
        $v = $this->object->getModelView();
        $this->assertEquals($exp,  $v['footer']);
    }
    
    
    

}
