<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of PreviousStepController
 *
 * @author prog
 */
class PreviousStepController extends AControllerState{
    
    private $_redirect;

    public function __construct(RequestHandler $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    /**
     *  FIXME : this controller should not being saved in history state. 
     *  This is implicitly done by __destruct() method of extended AControllerState.
     *  There is no side effect in logic sequence redirection for now (see log)
     *  But it should not extends AControllerState and only use save/restore logic of history state.
     *  It involves splitting AControllerState in multiple objects (for states, for history states, and further).
     * 
     * Redirect to previous state
     * @throws Exception
     */
    public function run() { 
        try{
            $this->saveControllerState(self::STOPPED); //force callee to stopped state
            Logger::getInstance()->logInfo( __CLASS__.' current  state name : '.$this->_sequenceState->getSequenceStateName());
            $this->_sequenceState->previousState();
            Logger::getInstance()->logInfo( __CLASS__. ' previous  state name : '.$this->_sequenceState->getSequenceStateName());
            Logger::getInstance()->logInfo( __CLASS__.' saved sequence state : '.$this->getSavedSequenceState());
            if ($this->getSavedSequenceState() != self::STOPPED){
                $this->_sequenceState->nextState(); //restore state
            }
            $this->_redirect = $this->_sequenceState->getSequenceStateName();
            $this->_state = self::REDIRECT;
            Logger::getInstance()->logInfo( __CLASS__. ' redirect  to : '.$this->_redirect);
        }catch (Exception $e){
            $this->_state = self::ON_CRITICAL_ERROR;
            $this->_error = $e;
            throw $e;
        }
    }
    
    public function getRedirect(){
        return $this->_redirect;
    }
    
}
