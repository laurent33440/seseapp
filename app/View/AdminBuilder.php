<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace View;

use View\Template\TemplateHandler;
use View\Page\HeaderElement;
use View\Page\FooterElement;


/**
 * Description of AdminWelcomeBuilder
 *
 * @author laurent
 */
class AdminBuilder extends AViewBuilder{
    public function __construct($params, $mainViewTemplate) {
        parent::__construct($params,  $mainViewTemplate);
    }
    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderAdmin');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);    
    }
    
    public function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterAdmin');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);   
    }
}
