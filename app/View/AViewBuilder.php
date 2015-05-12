<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace view;

use View\Page\Page;
use View\Page\HeaderElement;
use View\Page\HeadElement;
use View\Page\BodyElement;
use View\Page\FooterElement;
use View\Template\TemplateHandler;

/**
 * Description of ViewBuilder
 *
 * @author laurent
 */
abstract class AViewBuilder {
    protected  $_page;
    protected $_name;
    

    protected function BuildMenu($params){}
    
    public function __construct( $modelParams=null, $mainViewName = null) { 
        if(!$mainViewName){// main template view name is extract from builder name
            $cl = new \ReflectionClass($this);
            $all = explode('Builder',$cl->getShortName());
            $this->_name = $all[0];
        }else{// main template view name is a parameter : controller use same builder
            $this->_name = $mainViewName;
        }
//        \Logger::getInstance()->logDebug(__CLASS__.' -- child name class : '.$this->_name);
        $this->_page = new Page($this->_name);
        $pageParams = array('head' => null, 'header'=> null, 'body'=> null, 'footer'=> null);
        if($modelParams){
            if(array_key_exists('head', $modelParams)){
                $pageParams['head'] = $modelParams['head'];
            } 
            if(array_key_exists('header', $modelParams)){
                $pageParams['header'] = $modelParams['header'];
            }
            if(array_key_exists('body', $modelParams)){
                $pageParams['body'] = $modelParams['body'];
            }
            if(array_key_exists('footer', $modelParams)){
                $pageParams['footer'] = $modelParams['footer'];
            }
        }
        try{
            $this->BuildHead($pageParams['head']);
            $this->BuildHeader($pageParams['header']);
            $this->BuildBody($pageParams['body']);
            $this->BuildFooter($pageParams['footer']);
        }catch(Exception $e){
            $msg = 'Builder : '.$this->_name. ' '.$e->getMessage();
            throw new InternalException($msg);
        }
    }

    public function getPage(){
        return $this->_page;
    }
    
    protected function BuildHead($params){
            $head = TemplateHandler::getTemplate('Head');
            $element = new HeadElement($head, $params);
            $this->_page->addElement($element);   
    }
    
    protected function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderSetup');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);   
    }
    
    protected function BuildBody($params){
            $body = TemplateHandler::getTemplate($this->_name);
            $element = new BodyElement($body, $params);
            $this->_page->addElement($element);  
    }
    
    protected function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterWelcome');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);
    }
}

?>
