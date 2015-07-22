<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Attitude_professionnelle_evaluee;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of Attitude_professionnelle_evalueeQueryProvider
 *
 * @author laurent
 */
class Attitude_professionnelle_evalueeQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Attitude_professionnelle_evaluee (
                                        
                                        aproeva_critere,
                                        aproeva_choix,
                                        id_stagiaire
                                         )
                                      
                          values(
                                        
                                        :aproeva_critere,
                                        :aproeva_choix,
                                        :id_stagiaire
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Attitude_professionnelle_evaluee where id_attitude_professionnelle_evaluee=:id_attitude_professionnelle_evaluee ";
    }

    static function SelectByValueQuery($column){
        return "Select * from Attitude_professionnelle_evaluee where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Attitude_professionnelle_evaluee";
    }

    static function SelectIDQuery(){
        return "Select max(id_attitude_professionnelle_evaluee) from Attitude_professionnelle_evaluee";
    }

    static function UpdateQuery(){
        return "update Attitude_professionnelle_evaluee set    
                                        
                                        aproeva_critere=:aproeva_critere,
                                        aproeva_choix=:aproeva_choix,
                                        id_stagiaire=:id_stagiaire
                                    where id_attitude_professionnelle_evaluee=:id_attitude_professionnelle_evaluee ";
    }

    static function DeleteQuery(){
        return "delete from Attitude_professionnelle_evaluee where id_attitude_professionnelle_evaluee=:id_attitude_professionnelle_evaluee";
    }
}
