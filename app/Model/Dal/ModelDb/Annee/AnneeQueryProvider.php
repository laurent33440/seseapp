<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Dal\ModelDb\Annee;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of AnneeQueryProvider
 *
 * @author laurent
 */
class AnneeQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Annee(annee_scolaire) values(:annee_scolaire)";
    }

    static function SelectByIDQuery(){
        return "Select * from Annee where annee_scolaire = :annee_scolaire";
    }

    static function SelectAllQuery(){
        return "Select * from Annee";
    }

    static function SelectIDQuery(){
        return "Select max(annee_scolaire) from Annee";
    }

    static function UpdateQuery(){
        return "update Annee set annee_scolaire = :annee_scolaire where annee_scolaire = :annee_scolaire";
    }

    static function DeleteQuery(){
        return "delete from Annee where annee_scolaire = :annee_scolaire";
    }
}
