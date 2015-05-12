<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace view;

use view\template\TemplateHandler;
use view\page\FooterElement;

/**
 * Description of SkillsReferenceDefinitionBuilder
 *
 * @author laurent
 */
class SkillsReferenceDefinitionBuilder extends AViewBuilder{
    public function __construct($params) {
        parent::__construct('SkillsReferenceDefinition',  $params);
    }
    
    protected function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterActivitiesReferenceDefinition');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);
    }
}
