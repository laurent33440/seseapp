<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define("ROOT", realpath(__dir__."/.."));
define("APP", ROOT."/app/");
define("CONFIG", ROOT."/app/config");
define("WWW", ROOT."/www/");
define("INDEX", WWW."index.php");

require_once(APP . "Bootstrap.php");

Bootstrap::run();
?>
