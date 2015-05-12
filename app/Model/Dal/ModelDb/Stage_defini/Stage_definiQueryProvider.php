<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stage_defini;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of Stage_defini_definiQueryProvider
 *
 * @author laurent
 */
class Stage_definiQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Stage_defini (
                                         stgdef_est_ouvrable ,
                                         stgdef_status ,
                                         stgdef_commentaire_tuteur ,
                                         id_collaborateur ,
                                         id_stage ,
                                         id_enseignant 
                                         )
                                      
                          values(
                                        :stgdef_est_ouvrable,
                                        :stgdef_status,
                                        :stgdef_commentaire_tuteur,
                                        :id_collaborateur,
                                        :id_stage,
                                        :id_enseignant
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Stage_defini where id_stage_defini=:id_stage_defini";
    }

    static function SelectByValueQuery($column){
        return "Select * from Stage_defini where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Stage_defini";
    }

    static function SelectIDQuery(){
        return "Select max(id_stage_defini) from Stage_defini";
    }

    static function UpdateQuery(){
        return "update Stage_defini set    
                                        stgdef_est_ouvrable=:stgdef_est_ouvrable,
                                        stgdef_status=:stgdef_status,
                                        stgdef_commentaire_tuteur=:stgdef_commentaire_tuteur,
                                        id_collaborateur=:id_collaborateur,
                                        id_stage=:id_stage,
                                        id_enseignant=:id_enseignant
                                    where id_stage_defini=:id_stage_defini";
    }

    static function DeleteQuery(){
        return "delete from Stage_defini where id_stage_defini=:id_stage_defini";
    }
}
