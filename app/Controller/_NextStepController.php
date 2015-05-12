<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use Symfony\Component\HttpFoundation\Request;
use SequenceState;
use Logger;

/**
 * Description of NextStepController
 *
 * @author prog
 */
class NextStepController extends AControllerState{
    private $_redirect;

    public function __construct(Request $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    /**
     * FIXME : this controller should not being saved in history state. 
     *  This is implicitly done by __destruct() method of extended AControllerState.
     *  There is no side effect in logic sequence redirection for now (see log)
     *  But it should not extends AControllerState and only use save/restore logic of history state.
     *  It involves splitting AControllerState in multiple objects (for states, for history states, and further).
     * 
     * Redirect to next state if possible
     * @throws Exception
     */
    public function run() { 
        try{
            $this->saveControllerState(self::STOPPED); //force callee to stopped state
            Logger::getInstance()->logInfo( __CLASS__.' current  state name : '.$this->_sequenceState->getSequenceStateName());
            $this->_sequenceState->nextState();
            Logger::getInstance()->logInfo( __CLASS__. ' next  state name : '.$this->_sequenceState->getSequenceStateName());
            Logger::getInstance()->logInfo( __CLASS__.' saved sequence state : '.$this->getSavedSequenceState());
            if ($this->getSavedSequenceState() != self::STOPPED){
                $this->_sequenceState->previousState(); //restore state
            }
            $this->_redirect = $this->_sequenceState->getSequenceStateName();
            $this->_state = self::REDIRECT;
            Logger::getInstance()->logInfo( __CLASS__. ' redirect  to : '.$this->_redirect);
        }catch (Exception $e){
            $this->_state = self::ON_CRITICAL_ERROR;
            $this->_error = $e;
            Logger::getInstance()->logFatal(__CLASS__); 
            throw $e;
        }
    }
    
    public function getRedirect(){
        return $this->_redirect;
    }

}
