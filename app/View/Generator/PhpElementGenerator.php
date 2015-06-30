<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View\Generator;

use Model\AModel;

/**
 * Description of PhpElementGenerator
 *
 * @author laurent
 */
class PhpElementGenerator implements IElementGenerator{
    private $_structElement;
    private $_paramsDatas;
    private $convertArray = array(
            "{?}" => '<?php endif; ?>',
            "{/}" => '<?php endforeach; ?>',
            "{-}" => '<?php endfor; ?>',
            "{{???" => '<?php elseif',
            "{??}" => '<?php else: ?>',
            "{{?" => '<?php if',
            "?}}" => ' endif; ?>',
            "{{/" => '<?php foreach',
            "/}}" => ' endforeach; ?>',
            "{{-" => '<?php for',
            "-}}" => ' endfor; ?>',
            "{{!" => '<?php echo\'',
            "{{" => '<?php ',
            "!}}" => '\'; ?>',
            "}}" => ' ?>',
            "?><?php" => '',
            "?>
            <?php" => '',
            "?>
                <?php" => '',
        //ATL
            "{%!" => 'echo\'',
            "!%}" => '\';',

            );
    
    /**
     * Constructor
     * @param string $structureName : template structure
     * @param array $paramsDatas  : set of name => value
     */
    public function __construct($structDatas, $paramsDatas) {
        $this->_structElement = $structDatas;
        $this->_paramsDatas = $paramsDatas;
    }
    
    /**
     * Generate all the structure of HTML by replacing 'tag' by PHP code and params's names by values
     * @return string HTML structure 
     */
    public function generateElement() {
        foreach($this->convertArray as $k=>$v){
            $this->_structElement = str_replace($k,$v,  $this->_structElement);
        }
        $this->generateSimpleParams();
        return $this->_structElement;

    }   
    
    /**
     * Replace all parameters name by their respectives no array values in template structure 
     */
    private function generateSimpleParams(){
        if(isset($this->_paramsDatas)){
            //var_dump($this->_paramsDatas);
            foreach($this->_paramsDatas as $k=>$v){
                if(!is_array($v)){ // array must be computed in template
                    if(!is_numeric($v)){
                        if(preg_match('/^'.AModel::__BY_VALUE_TO_TEMPLATE__.'/', $v)){
                            $vv = explode(AModel::__BY_VALUE_TO_TEMPLATE__, $v);
                            $v="'$vv[1]'";
                            //$v="'$v'";
                        }
                    }
                    $this->_structElement = str_replace($k,$v,  $this->_structElement);
                }
            }
        }
    }
}

?>
