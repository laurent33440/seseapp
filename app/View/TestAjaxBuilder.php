<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use View\Template\TemplateHandler;
use View\Page\HeadElement;
use View\Page\HeaderElement;
use View\Page\BodyElement;
use View\Page\FooterElement;

/**
 * Description of TestAjaxBuilder
 *
 * @author laurent
 */
class TestAjaxBuilder extends AViewBuilder{
    public function __construct($params, $mainViewTemplate)  {
        parent::__construct($params, $mainViewTemplate) ;
    }
    
    public function BuildHead($params=null){
            $head = TemplateHandler::getTemplate('HeadTestAjax');
            $element = new HeadElement($head, $params);
            $this->_page->addElement($element);  
    }
    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderTestAjax');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildBody($params){
            $body = TemplateHandler::getTemplate('TestAjax');
            $element = new BodyElement($body, $params);
            $this->_page->addElement($element);   
    }
    
    public function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterTestAjax');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);       
    }
}
