<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use View\Template\TemplateHandler;
use View\Page\HeadElement;
use View\Page\HeaderElement;
use View\Page\BodyElement;
use View\Page\FooterElement;

/**
 * Description of InternalErrorBuilder
 *
 * @author laurent
 */
class InternalErrorBuilder extends AViewBuilder{
    public function __construct($params) {
        parent::__construct('InternalError', $params);
    }
    
//    public function BuildHead($params){
//            $head = TemplateHandler::getTemplate('Head');
//            $element = new HeadElement($head, $params);
//            $this->_page->addElement($element);  
//    }
//    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderWelcome'); // FIXME : add a specific header for exceptions
            $element = new HeaderElement($header,$params);
            $this->_page->addElement($element);   
    }
//    
//    public function BuildBody($params){
//            $body = TemplateHandler::getTemplate('InternalError');
//            //$index = $_SERVER['REQUEST_URI'];???
//            $element = new BodyElement($body, $params);
//            $this->_page->addElement($element);   
//    }
//    
//    public function BuildFooter($params){
//            $footer = TemplateHandler::getTemplate('FooterWelcome');
//            $element = new FooterElement($footer, $params);
//            $this->_page->addElement($element);       
//    }
}

?>
