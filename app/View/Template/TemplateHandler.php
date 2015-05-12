<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View\Template;

/**
 * Description of TemplateHandler
 *
 * @author laurent
 */
class TemplateHandler {

    public static function getTemplate($name='InternalError'){
        $fileName =  __DIR__.DIRECTORY_SEPARATOR.$name.'.tpl.php'; 
        if(is_file($fileName)){  
            $html = file_get_contents($fileName);
            return $html;
        }
        throw new \Exception('template : '.$fileName.' inexistant');
    }
}

?>
