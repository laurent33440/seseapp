<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Entreprise;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of EntrepriseQueryProvider
 *
 * @author laurent
 */
class EntrepriseQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Entreprise(ent_nom_entreprise ,
                             ent_nom_commercial ,
                             ent_siret ,
                             ent_activite ,
                             ent_profil ,
                             ent_stagiaires_recus ,
                             ent_commentaire ,
                             ent_date_enregistrement ,
                             ent_adresse1_entreprise ,
                             ent_adresse2_entreprise ,
                             ent_ville_entreprise ,
                             ent_cp_entreprise ,
                             ent_pays_entreprise ,
                             ent_url_entreprise ,
                             ent_telephone_entreprise ) "
. "                     values(:ent_nom_entreprise,
                            :ent_nom_commercial,
                            :ent_siret,
                            :ent_activite,
                            :ent_profil,
                            :ent_stagiaires_recus,
                            :ent_commentaire,
                            :ent_date_enregistrement,
                            :ent_adresse1_entreprise,
                            :ent_adresse2_entreprise,
                            :ent_ville_entreprise,
                            :ent_cp_entreprise,
                            :ent_pays_entreprise,
                            :ent_url_entreprise,
                            :ent_telephone_entreprise)";
    }

    static function SelectByIDQuery(){
        return "Select * from Entreprise where id_entreprise = :id_entreprise";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Entreprise where $column=:$column";
	}

    static function SelectAllQuery(){
        return "Select * from Entreprise";
    }

    static function SelectIDQuery(){
        return "Select max(id_entreprise) from Entreprise";
    }

    static function UpdateQuery(){
        return "update Entreprise set   ent_nom_entreprise=:ent_nom_entreprise,
                                        ent_nom_commercial=:ent_nom_commercial,
                                        ent_siret=:ent_siret,
                                        ent_activite=:ent_activite,
                                        ent_profil=:ent_profil,
                                        ent_stagiaires_recus=:ent_stagiaires_recus,
                                        ent_commentaire=:ent_commentaire,
                                        ent_date_enregistrement=:ent_date_enregistrement,
                                        ent_adresse1_entreprise=:ent_adresse1_entreprise,
                                        ent_adresse2_entreprise=:ent_adresse2_entreprise,
                                        ent_ville_entreprise=:ent_ville_entreprise,
                                        ent_cp_entreprise=:ent_cp_entreprise,
                                        ent_pays_entreprise=:ent_pays_entreprise,
                                        ent_url_entreprise=:ent_url_entreprise,
                                        ent_telephone_entreprise=:ent_telephone_entreprise"
        . "         where id_entreprise = :id_entreprise";
    }

    static function DeleteQuery(){
        return "delete from Entreprise where id_entreprise = :id_entreprise";
    }
}
