<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ControllerStateStub
 * 
 * TEST CLASS FOR ACONTROLLERSTATE
 *
 * @author laurent
 */
class ControllerStateStub extends AControllerState{
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
    
}
