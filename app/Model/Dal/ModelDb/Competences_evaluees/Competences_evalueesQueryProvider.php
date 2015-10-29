<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Competences_evaluees;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of CompetenceQueryProvider
 *
 * @author laurent
 */
class Competences_evalueesQueryProvider implements IQueryProvider{
   
    static function InsertQuery(){
        return "Insert into Competences_evaluees (
                                        coe_annee_evaluation,
                                        coe_ref_competence_evaluee,
                                        coe_intitule_competence_evaluee,
                                        coe_descriptif_competence_evaluee,
                                        coe_niveau_competence,
                                        coe_niveau_autonomie,
                                        id_stagiaire
                                         )
                                      
                          values(
                                        :coe_annee_evaluation,
                                        :coe_ref_competence_evaluee,
                                        :coe_intitule_competence_evaluee,
                                        :coe_descriptif_competence_evaluee,
                                        :coe_niveau_competence,
                                        :coe_niveau_autonomie,
                                        :id_stagiaire
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Competences_evaluees where id_competences_evaluees=:id_competences_evaluees";
    }

    static function SelectByValueQuery($column){
        return "Select * from Competences_evaluees where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Competences_evaluees";
    }

    static function SelectIDQuery(){
        return "Select max(id_competences_evaluees) from Competences_evaluees";
    }

    static function UpdateQuery(){
        return "update Competences_evaluees set    
                                        coe_annee_evaluation= :coe_annee_evaluation,
                                        coe_ref_competence_evaluee= :coe_ref_competence_evaluee,
                                        coe_intitule_competence_evaluee=:coe_intitule_competence_evaluee,
                                        coe_descriptif_competence_evaluee=:coe_descriptif_competence_evaluee,
                                        coe_niveau_competence=:coe_niveau_competence,
                                        coe_niveau_autonomie=:coe_niveau_autonomie,
                                        id_stagiaire=:id_stagiaire     
                                         
                                     
                                    where id_competences_evaluees=:id_competences_evaluees";
    }

    static function DeleteQuery(){
        return "delete from Competences_evaluees where id_competences_evaluees=:id_competences_evaluees";
    }
}
