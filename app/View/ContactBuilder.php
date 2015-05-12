<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use View\Template\TemplateHandler;
use View\Page\HeaderElement;
use View\Page\BodyElement;
use View\Page\FooterElement;


/**
 * Description of AboutBuilder
 *
 * @author laurent
 */
class ContactBuilder extends AViewBuilder{
    public function __construct($params, $mainViewTemplate)  {
        parent::__construct($params, $mainViewTemplate) ;
    }
    
    public function BuildHeader($params){
            $header = TemplateHandler::getTemplate('HeaderMain');
            $element = new HeaderElement($header, $params);
            $this->_page->addElement($element);    
    }
    
    public function BuildBody($params){
            $body = TemplateHandler::getTemplate('InternalContact');
            $element = new BodyElement($body, $params);
            $this->_page->addElement($element);
    }
    
    public function BuildFooter($params){
            $footer = TemplateHandler::getTemplate('FooterSeseApp');
            $element = new FooterElement($footer, $params);
            $this->_page->addElement($element);   
    }
}
