<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Activite_et_visite;

use Model\Dal\DbLibrary\IQueryProvider;

    
/**
 * Description of Activite_et_visiteQueryProvider
 *
 * @author laurent
 */
class Activite_et_visiteQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Activite_et_visite (
                                        aev_date_activite,
                                        aev_description_activite,
                                        aev_type_acteur,
                                        aev_id_type_acteur,
                                        aev_date_viste,
                                        aev_commentaire_viste,
                                        id_enseignant,
                                        id_stagiaire
                                         )
                                      
                          values(
                                        :aev_date_activite,
                                        :aev_description_activite,
                                        :aev_type_acteur,
                                        :aev_id_type_acteur,
                                        :aev_date_viste,
                                        :aev_commentaire_viste,
                                        :id_enseignant,
                                        :id_stagiaire
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Activite_et_visite where id_activite_et_visite=:id_activite_et_visite";
    }

    static function SelectByValueQuery($column){
        return "Select * from Activite_et_visite where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Activite_et_visite";
    }

    static function SelectIDQuery(){
        return "Select max(id_activite_et_visite) from Activite_et_visite";
    }

    static function UpdateQuery(){
        return "update Activite_et_visite set    
                                        aev_date_activite=:aev_date_activite,
                                        aev_description_activite=: aev_description_activite,
                                        aev_type_acteur=:aev_type_acteur,
                                        aev_id_type_acteur=:aev_id_type_acteur,
                                        aev_date_viste=: aev_date_viste,
                                        aev_commentaire_viste=:aev_commentaire_viste,
                                        id_enseignant: id_enseignant,
                                        id_stagiaire=:id_stagiaire
                                    where id_activite_et_visite=:id_activite_et_visite";
    }

    static function DeleteQuery(){
        return "delete from Activite_et_visite where id_activite_et_visite=:id_activite_et_visite";
    }
}
