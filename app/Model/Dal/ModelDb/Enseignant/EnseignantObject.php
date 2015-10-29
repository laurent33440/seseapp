<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Enseignant;

/**
 * Description of EnseignantObject
 *
 * @author laurent
 */
class EnseignantObject {
    public $id_enseignant;
    public $ens_civilite_enseignant;
    public $ens_nom_enseignant;
    public $ens_prenom_enseignant;
    public $ens_mel_enseignant;
    public $ens_adresse1_enseignant;
    public $ens_adresse2_enseignant;
    public $ens_url_enseignant;
    public $ens_cp_enseignant;
    public $ens_discipline;
    public $ens_role;
    public $ens_est_referant;
    public $ens_compte_enseignant;
    
    public $foreignKeyList=array();
}
