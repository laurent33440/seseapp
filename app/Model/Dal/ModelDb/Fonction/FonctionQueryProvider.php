<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Fonction;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of FonctionQueryProvider
 *
 * @author laurent
 */
class FonctionQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Fonction (
                                        
                                        f_description
                                         )
                                      
                          values(
                                        
                                        :f_description
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Fonction where id_fonction=:id_fonction ";
    }

    static function SelectByValueQuery($column){
        return "Select * from Fonction where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Fonction";
    }

    static function SelectIDQuery(){
        return "Select max(id_fonction) from Fonction";
    }

    static function UpdateQuery(){
        return "update Fonction set    
                                        
                                        f_description=:f_description
                                    where id_fonction=:id_fonction ";
    }

    static function DeleteQuery(){
        return "delete from Fonction where id_fonction=:id_fonction";
    }
}
