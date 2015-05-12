<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace view;

use view\template\TemplateHandler;
use view\page\HeadElement;
use view\page\HeaderElement;
use view\page\BodyElement;
use view\page\FooterElement;

/**
 * Description of WelcomeBuilder
 *
 * @author laurent
 */
class WelcomeBuilder extends AViewBuilder{
    
    public function __construct($params) {
        $all = explode('Builder',__CLASS__);
        $this->_name = $all[0];
        parent::__construct($this->_name, $params);
    }
    
    public function BuildHead($params=null){
            $head = TemplateHandler::getTemplate('Head');
            $element = new HeadElement($head, $params);
            $this->_page->addElement($element);  
    }
    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderWelcome');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildBody($params){
            $body = TemplateHandler::getTemplate('Welcome');
            $element = new BodyElement($body, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterWelcome');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);       
    }
    
    
}

?>
