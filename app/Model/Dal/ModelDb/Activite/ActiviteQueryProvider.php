<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Activite;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of ActiviteQueryObject
 *
 * @author laurent
 */
class ActiviteQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Activite (
                                        act_ref_activite,
                                        act_intitule_activite,
                                        act_descriptif_activite,
                                        act_est_realise,
                                        id_referentiel_de_formation,
                                        id_fonction
                                         )
                                      
                          values(
                                        :act_ref_activite,
                                        :act_intitule_activite,
                                        :act_descriptif_activite,
                                        :act_est_realise,
                                        :id_referentiel_de_formation,
                                        :id_fonction
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Activite where id_activite=:id_activite";
    }

    static function SelectByValueQuery($column){
        return "Select * from Activite where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Activite";
    }

    static function SelectIDQuery(){
        return "Select max(id_activite) from Activite";
    }

    static function UpdateQuery(){
        return "update Activite set    
                                        act_ref_activite=:act_ref_activite,
                                        act_intitule_activite=:act_intitule_activite,
                                        act_descriptif_activite=:act_descriptif_activite,
                                        act_est_realise=:act_est_realise,
                                        id_referentiel_de_formation=:id_referentiel_de_formation,
                                        id_fonction=:id_fonction
                                    where id_activite=:id_activite";
    }

    static function DeleteQuery(){
        return "delete from Activite where id_activite=:id_activite";
    }
}
