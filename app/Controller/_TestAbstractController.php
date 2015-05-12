<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use Symfony\Component\HttpFoundation\Request;
use SequenceState;
//use exception\InternalException;
//use Version;
//use Kernel;

/**
 * Description of TestAbstractController
 *
 * @author laurent
 */
class TestAbstractController extends AControllerState{
    
    public function __construct(Request $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    
}
