<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Page;

/**
 * Description of Page
 *
 * @author laurent
 */
class PageObject {
    public $id_page;
    public $pge_nom_page;
    
    public $foreignKeyList = array('Page'=>'id_page');
}
