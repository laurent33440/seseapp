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
 * Description of FunctionReferentialDefinition
 *
 * @author prog
 */
class FunctionReferentialDefinitionBuilder extends AViewBuilder{
    
    public function __construct($params) {
        $all = explode('Builder',__CLASS__);
        $this->_name = $all[0];
        parent::__construct($this->_name, $params);
    }
    protected function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterFunctionReferentialDefinition');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);
    }
    

}
