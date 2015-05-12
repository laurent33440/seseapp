<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View\Page;

use View\Generator\PhpElementGenerator;

/**
 * Description of BodyElement
 *
 * @author laurent
 */
class BodyElement implements IPageElement{
    private $_structure;
    private $_params;
    
    public function __construct($structure, $params) {
        $this->_structure = $structure;
        $this->_params = $params;
    }

    public function generate() {
        $generator  = new PhpElementGenerator($this->_structure, $this->_params);
        $genStruct = $generator->generateElement();
        return $genStruct;
    }

    public function refresh() {
        
    }
}

?>
