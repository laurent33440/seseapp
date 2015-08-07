<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stage;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of StageQueryProvider
 *
 * @author laurent
 */
class StageQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Stage (
                                         stg_denomination_periode ,
                                         stg_date_debut ,
                                         stg_date_fin ,
                                         stg_annee ,
                                         id_referentiel_de_formation 
                                        )
                          values(
                                        :stg_denomination_periode,
                                        :stg_date_debut,
                                        :stg_date_fin,
                                        :stg_annee,
                                        :id_referentiel_de_formation
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Stage where id_stage=:id_stage";
    }

    static function SelectByValueQuery($column){
        return "Select * from Stage where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Stage";
    }

    static function SelectIDQuery(){
        return "Select max(id_stage) from Stage";
    }

    static function UpdateQuery(){
        return "update Stage set    
                                        stg_denomination_periode=:stg_denomination_periode,
                                        stg_date_debut=:stg_date_debut,
                                        stg_date_fin=:stg_date_fin,
                                        stg_annee=:stg_annee,
                                        id_referentiel_de_formation=:id_referentiel_de_formation
                                    where id_stage=:id_stage";
    }

    static function DeleteQuery(){
        return "delete from Stage where id_stage=:id_stage";
    }
}
