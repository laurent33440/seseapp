<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Entreprise;

/**
 * Description of EntrepriseObject
 *
 * @author laurent
 */
class EntrepriseObject {
    public $id_entreprise;//PrK
    public $ent_nom_entreprise;
    public $ent_nom_commercial;
    public $ent_siret;
    public $ent_activite;
    public $ent_profil;
    public $ent_stagiaires_recus;
    public $ent_commentaire;
    public $ent_date_enregistrement;
    public $ent_adresse1_entreprise;
    public $ent_adresse2_entreprise;
    public $ent_ville_entreprise;
    public $ent_cp_entreprise;
    public $ent_pays_entreprise;
    public $ent_url_entreprise;
    public $ent_telephone_entreprise;
    
    public $foreignKeyList = array('Employer'=>'id_entreprise');
            
}
