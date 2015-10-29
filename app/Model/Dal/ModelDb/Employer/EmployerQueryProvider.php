<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Dal\ModelDb\Employer;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of EmployerQueryProvider
 *
 * @author laurent
 */
class EmployerQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Employer (id_entreprise, id_collaborateur) values(:id_entreprise, :id_collaborateur) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Employer where id_entreprise=:id_entreprise AND id_collaborateur = :id_collaborateur";
    }
    
    static function SelectByValueQuery($column){
        return "Select * from Employer where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Employer";
    }

    static function SelectIDQuery(){
        //return "Select max(id_entreprise,id_collaborateur) from Employer"; FIXME : max id of composite key?
        return "Select max(id_entreprise) from Employer";
    }

    static function UpdateQuery(){
        return "update Employer set   id_entreprise=:id_entreprise,
                                        id_collaborateur=:id_collaborateur,
                                        "
            . "where id_entreprise=:id_entreprise AND id_collaborateur = :id_collaborateur";
    }

    static function DeleteQuery(){
        return "delete from Employer where id_entreprise=:id_entreprise AND id_collaborateur = :id_collaborateur";
    }
}
