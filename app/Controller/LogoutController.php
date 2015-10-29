<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Controller;

use SeseSession;

/**
 * Description of LogoutController
 *
 * @author laurent
 */
class LogoutController extends AControllerState {
    
    public function run(){
        $session=  SeseSession::getInstance();
        $session->invalidate();
        //redirect to login
        $this->redirectTo('/');
    }
    
    
}
