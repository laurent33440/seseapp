<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Activite;

/**
 * Description of ActiviteObject
 *
 * @author laurent
 */
class ActiviteObject {
    public $id_activite;
    public $act_ref_activite;
    public $act_intitule_activite;
    public $act_descriptif_activite;
    public $act_est_realise;
    public $id_referentiel_de_formation;
    public $id_fonction;
    
    public $foreignKeyList = array('Constituer'=>'id_activite');
}
