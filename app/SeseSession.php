<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

/**
 * Description of Session
 *
 * @author laurent
 */
class SeseSession {
    const DEBUG_FILE_NAME='SESE_DEV_MOCKSESSION';
    private $session;
    
    private static $_instance;
    
    public function __construct($debug=false){
      $debug = Bootstrap::DEBUG_SESE;//comment it for test with browser
      if($debug){
          $this->session = new Session(new MockFileSessionStorage(ROOT.'/tests', self::DEBUG_FILE_NAME)); //dev, debug
      }else{
          $storage = new NativeSessionStorage(array(), new NativeFileSessionHandler());
          $this->session = new Session($storage);
      }
    }
    
    final public static function getInstance () {
            if (!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance->session;
    }
    
    final public static function getDebugInstance(){
         if (!(self::$_instance instanceof self)){
                self::$_instance = new self(true);
        }
        return self::$_instance->session;
    }
    
    
}
