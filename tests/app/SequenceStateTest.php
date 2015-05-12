<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-05-17 at 16:00:51.
 */
class SequenceStateTest extends PHPUnit_Framework_TestCase {
    
    private $_sequenceSetupList = array(
        'Welcome',
        'CreateDataBase',
        'CreateAdminAccount',
        'SchoolDefinition',
        'GeneralReferenceDefinition',
        'DocumentsReferenceDefinition',
        'ActivitiesReferenceDefinition',
        'SkillsReferenceDefinition',
        'LevelsSkillReferenceDefinition',
        'StudentsDefinition',
        'TeachersDefinition',
        'Finalize'
        );

    /**
     * @var SequenceState
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new SequenceState(true);//if true SESSION not used
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers SequenceState::getSequenceState
     * @todo   Implement testGetSequenceState().
     */
    public function testGetSequenceState() {
        $this->object->resetState();
        $this->assertEquals($this->_sequenceSetupList[0], $this->object->getSequenceStateName());
    }

    /**
     * @covers SequenceState::nextState
     * @todo   Implement testNextState().
     */
    public function testNextState() {
       $this->object->resetState();
       foreach ($this->_sequenceSetupList as $value){
           $this->assertEquals($value, $this->object->getSequenceStateName());
           $this->object->nextState();
       }
       return $this->object;
       
    }
    
    /**
     * @depends testNextState
     * @param type $seqState
     */
    public function testPreviousState(SequenceState $seqState){
        for ($i = count($this->_sequenceSetupList)-1 ;$i<0 ; $i-- ){
            assertEquals($this->_sequenceSetupList[$i], $this->object->previousState());
        }
    }
    
    /**
     * 
     */
    public function testSetCurrentState(){
        $stateName='unknown';
        $this->assertEquals(false,$this->object->setCurrentState($stateName));
        $stateName='ActivitiesReferenceDefinition';
        $this->assertEquals('ActivitiesReferenceDefinition', $this->object->setCurrentState($stateName));
    }

}
