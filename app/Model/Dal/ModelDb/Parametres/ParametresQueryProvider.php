<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Parametres;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of ParametresQueryProvider
 *
 * @author laurent
 */
class ParametresQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Parametres (par_code_parametre, par_libelle_parametre, par_valeur_parametre) "
                                  . "values(:par_code_parametre, :par_libelle_parametre, :par_valeur_parametre)";
    }

    static function SelectByIDQuery(){
        return "Select * from Parametres where id_parametre = :id_parametre";
    }

    static function SelectAllQuery(){
        return "Select * from Parametres";
    }

    static function SelectIDQuery(){
        return "Select max(id_parametre) from Parametres";
    }

    static function UpdateQuery(){
        return "update Parametres set par_code_parametre = :par_code_parametre, par_libelle_parametre = :par_libelle_parametre, par_valeur_parametre = :par_valeur_parametre"
            . " where id_parametre = :id_parametre";
    }

    static function DeleteQuery(){
        return "delete from Parametres where id_parametre = :id_parametre";
    }
}
