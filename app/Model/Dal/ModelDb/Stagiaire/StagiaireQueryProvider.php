<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stagiaire;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of StagiaireQueryProvider
 *
 * @author laurent
 */
class StagiaireQueryProvider implements IQueryProvider{
    static function InsertQuery(){
        return "Insert into Stagiaire (
                                         sta_civilite_stagiaire ,
                                         sta_nom_stagiaire ,
                                         sta_prenom_stagiaire ,
                                         sta_mel_stagiaire ,
                                         sta_adresse1_stagiaire ,
                                         sta_adresse2_stagiaire ,
                                         sta_url_stagiaire ,
                                         sta_cp_stagiaire ,
                                         sta_civilite_resp_legal ,
                                         sta_nom_resp_legal ,
                                         sta_prenom_resp_legal ,
                                         sta_mel_resp_legal ,
                                         sta_adresse1_resp_legal ,
                                         sta_adresse2_resp_legal ,
                                         sta_url_resp_legal ,
                                         sta_cp_resp_legal ,
                                         sta_affiliation ,
                                         id_promotion , 
                                         id_enseignant 
                                        )
                          values(
                                         :sta_civilite_stagiaire ,
                                         :sta_nom_stagiaire ,
                                         :sta_prenom_stagiaire ,
                                         :sta_mel_stagiaire ,
                                         :sta_adresse1_stagiaire ,
                                         :sta_adresse2_stagiaire ,
                                         :sta_url_stagiaire ,
                                         :sta_cp_stagiaire ,
                                         :sta_civilite_resp_legal ,
                                         :sta_nom_resp_legal ,
                                         :sta_prenom_resp_legal ,
                                         :sta_mel_resp_legal ,
                                         :sta_adresse1_resp_legal ,
                                         :sta_adresse2_resp_legal ,
                                         :sta_url_resp_legal ,
                                         :sta_cp_resp_legal ,
                                         :sta_affiliation ,
                                         :id_promotion , 
                                         :id_enseignant 
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Stagiaire where id_stagiaire=:id_stagiaire";
    }

    static function SelectByValueQuery($column){
        return "Select * from Stagiaire where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Stagiaire";
    }

    static function SelectIDQuery(){
        return "Select max(id_stagiaire) from Stagiaire";
    }

    static function UpdateQuery(){
        return "update Stagiaire set    
                                         sta_civilite_stagiaire=:sta_civilite_stagiaire ,
                                         sta_nom_stagiaire=:sta_nom_stagiaire ,
                                         sta_prenom_stagiaire=:sta_prenom_stagiaire ,
                                         sta_mel_stagiaire=:sta_mel_stagiaire ,
                                         sta_adresse1_stagiaire=:sta_adresse1_stagiaire ,
                                         sta_adresse2_stagiaire=:sta_adresse2_stagiaire ,
                                         sta_url_stagiaire=:sta_url_stagiaire ,
                                         sta_cp_stagiaire=:sta_cp_stagiaire ,
                                         sta_civilite_resp_legal=:sta_civilite_resp_legal ,
                                         sta_nom_resp_legal=:sta_nom_resp_legal ,
                                         sta_prenom_resp_legal=:sta_prenom_resp_legal ,
                                         sta_mel_resp_legal=:sta_mel_resp_legal ,
                                         sta_adresse1_resp_legal=:sta_adresse1_resp_legal ,
                                         sta_adresse2_resp_legal=:sta_adresse2_resp_legal ,
                                         sta_url_resp_legal=:sta_url_resp_legal ,
                                         sta_cp_resp_legal=:sta_cp_resp_legal ,
                                         sta_affiliation=:sta_affiliation ,
                                         id_promotion=:id_promotion , 
                                         id_enseignant=:id_enseignant 
                                    where id_stagiaire=:id_stagiaire";
    }

    static function DeleteQuery(){
        return "delete from Stagiaire where id_stagiaire=:id_stagiaire";
    }
}
