<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Attitude_professionnelle;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of Attitude_professionnelleQueryProvider
 *
 * @author laurent
 */
class Attitude_professionnelleQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Attitude_professionnelle (
                                        
                                        apro_critere,
                                        apro_choix
                                         )
                                      
                          values(
                                        
                                        :apro_critere,
                                        :apro_choix
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Attitude_professionnelle where id_attitude_professionnelle=:id_attitude_professionnelle ";
    }

    static function SelectByValueQuery($column){
        return "Select * from Attitude_professionnelle where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Attitude_professionnelle";
    }

    static function SelectIDQuery(){
        return "Select max(id_attitude_professionnelle) from Attitude_professionnelle";
    }

    static function UpdateQuery(){
        return "update Attitude_professionnelle set    
                                        
                                        apro_critere=:apro_critere,
                                        apro_choix=:apro_choix
                                    where id_attitude_professionnelle=:id_attitude_professionnelle ";
    }

    static function DeleteQuery(){
        return "delete from Attitude_professionnelle where id_attitude_professionnelle=:id_attitude_professionnelle";
    }
}
