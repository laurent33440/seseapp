<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Documents_reference;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of Documents_referenceQueryProvider
 *
 * @author laurent
 */
class Documents_referenceQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Documents_reference (
                                        
                                        drf_sujet,
                                        drf_description_doc,
                                        drf_type,
                                        id_referentiel_de_formation
                                         )
                                      
                          values(
                                        
                                        :drf_sujet,
                                        :drf_description_doc,
                                        :drf_type,
                                        :id_referentiel_de_formation
                                        
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Documents_reference where id_documents_reference=:id_documents_reference ";
    }

    static function SelectByValueQuery($column){
        return "Select * from Documents_reference where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Documents_reference";
    }

    static function SelectIDQuery(){
        return "Select max(id_documents_reference) from Documents_reference";
    }

    static function UpdateQuery(){
        return "update Documents_reference set    
                                        
                                        drf_sujet=:drf_sujet,
                                        drf_type=:drf_type,
                                        drf_description_doc=:drf_description_doc,
                                        id_referentiel_de_formation=:id_referentiel_de_formation
                                    where id_documents_reference=:id_documents_reference ";
    }

    static function DeleteQuery(){
        return "delete from Documents_reference where id_documents_reference=:id_documents_reference";
    }
}
