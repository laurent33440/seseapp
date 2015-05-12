<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Utilisateurs;

/**
 * Description of UtilisateursObject
 *
 * @author laurent
 */
class UtilisateursObject {
    public $id_utilisateur;
    public $uti_identifiant;
    public $uti_mot_de_passe;
    public $uti_mel;
    public $uti_etat_compte;
    public $uti_derniere_connexion;
    public $id_groupe;
    
}
