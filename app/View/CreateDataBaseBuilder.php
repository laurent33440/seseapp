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
 * Description of CreateDataBaseBuilder
 *
 * @author laurent
 */
class CreateDataBaseBuilder extends AViewBuilder{
    
    public function __construct($params) {
        parent::__construct('CreateDataBase', $params);
    }
    
    public function BuildHead($params){
            $head = TemplateHandler::getTemplate('Head');
            $element = new HeadElement($head, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderSetup');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildBody($params){
            $body = TemplateHandler::getTemplate('CreateDataBase');
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
