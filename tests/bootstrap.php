<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author laurent
 */
// TODO: check include path
//ini_set('include_path', ini_get('include_path'));

define("ROOT", realpath(__dir__."/.."));
define("APP", ROOT."/app");
//define("WWW", ROOT."/www/");

spl_autoload_register('autoload');

function autoload($className){
        $tab = explode('\\', $className);
        $path = APP . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $tab) . '.php';
        if(file_exists($path)){//prevent trying loading PHPUNIT classes from application sources
            //echo(' Autoload : ' . $className." -->  $path\n");
            require $path;
        }
}


?>
