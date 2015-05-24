<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Competence;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of CompetenceQueryProvider
 *
 * @author laurent
 */
class CompetenceQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Competence (
                                        comp_ref_comptetence,
                                        comp_intitule_competence,
                                        comp_descriptif_competence,
                                        comp_est_evaluable,
                                        comp_est_evaluee,
                                        comp_niveau_competence,
                                        comp_niveau_autonomie
                                         )
                                      
                          values(
                                        :comp_ref_comptetence,
                                        :comp_intitule_competence,
                                        :comp_descriptif_competence,
                                        :comp_est_evaluable,
                                        :comp_est_evaluee,
                                        :comp_niveau_competence,
                                        :comp_niveau_autonomie
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Competence where id_competence=:id_competence";
    }

    static function SelectByValueQuery($column){
        return "Select * from Competence where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Competence";
    }

    static function SelectIDQuery(){
        return "Select max(id_competence) from Competence";
    }

    static function UpdateQuery(){
        return "update Competence set    
                                        comp_ref_comptetence=:comp_ref_comptetence,
                                        comp_intitule_competence=:comp_intitule_competence,
                                        comp_descriptif_competence=:comp_descriptif_competence,
                                        comp_est_evaluable=:comp_est_evaluable,
                                        comp_est_evaluee=:comp_est_evaluee,
                                        comp_niveau_competence=:comp_niveau_competence,
                                        comp_niveau_autonomie=:comp_niveau_autonomie
                                    where id_competence=:id_competence";
    }

    static function DeleteQuery(){
        return "delete from Competence where id_competence=:id_competence";
    }
}
