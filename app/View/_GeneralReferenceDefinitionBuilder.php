<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace view;

use view\template\TemplateHandler;
use view\page\HeadElement;
use view\page\HeaderElement;
use view\page\BodyElement;
use view\page\FooterElement;

/**
 * Description of GeneralReferenceDefinitionBuilder
 *
 * @author prog
 */
class GeneralReferenceDefinitionBuilder extends AViewBuilder{
    public function __construct($params) {
        parent::__construct('GeneralReferenceDefinition', $params);
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
            $body = TemplateHandler::getTemplate('GeneralReferenceDefinition');
            $element = new BodyElement($body, $params);
            $this->_page->addElement($element);  
    }
    
    public function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterWelcome');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);
    }
}
