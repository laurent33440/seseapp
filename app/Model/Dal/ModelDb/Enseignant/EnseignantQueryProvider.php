<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Enseignant;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of EnseignantQueryProvider
 *
 * @author laurent
 */
class EnseignantQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Enseignant (ens_civilite_enseignant,
                                        ens_nom_enseignant,
                                        ens_prenom_enseignant,
                                        ens_mel_enseignant,
                                        ens_adresse1_enseignant,
                                        ens_adresse2_enseignant,
                                        ens_url_enseignant,
                                        ens_cp_enseignant,
                                        ens_discipline,
                                        ens_role,
                                        ens_est_referant,
                                        ens_compte_enseignant) "
                              . "values(:ens_civilite_enseignant,
                                        :ens_nom_enseignant,
                                        :ens_prenom_enseignant,
                                        :ens_mel_enseignant,
                                        :ens_adresse1_enseignant,
                                        :ens_adresse2_enseignant,
                                        :ens_url_enseignant,
                                        :ens_cp_enseignant,
                                        :ens_discipline,
                                        :ens_role,
                                        :ens_est_referant,
                                        :ens_compte_enseignant) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Enseignant where id_enseignant = :id_enseignant";
    }
    
    static function SelectByValueQuery($column){
        return "Select * from Enseignant where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Enseignant";
    }

    static function SelectIDQuery(){
        return "Select max(id_enseignant) from Enseignant";
    }

    static function UpdateQuery(){
        return "update Enseignant set   ens_civilite_enseignant=:ens_civilite_enseignant,
                                        ens_nom_enseignant=:ens_nom_enseignant,
                                        ens_prenom_enseignant=:ens_prenom_enseignant,
                                        ens_mel_enseignant=:ens_mel_enseignant,
                                        ens_adresse1_enseignant=:ens_adresse1_enseignant,
                                        ens_adresse2_enseignant=:ens_adresse2_enseignant,
                                        ens_url_enseignant=:ens_url_enseignant,
                                        ens_cp_enseignant=:ens_cp_enseignant,
                                        ens_discipline=:ens_discipline,
                                        ens_role=:ens_role,
                                        ens_est_referant=:ens_est_referant,
                                        ens_compte_enseignant=:ens_compte_enseignant"
            . "where id_enseignant = :id_enseignant";
    }

    static function DeleteQuery(){
        return "delete from Enseignant where id_enseignant = :id_enseignant";
    }
}
